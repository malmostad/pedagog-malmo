<?php
/**
 * Fetch a remote HTML fragment for usage of asset hosting.
 * Cache file if a cache engine is passed.
 *
 * Note: Never use user based input to create the url since it is a security risk
 *
 * Usage:
 * <code>
 * $remote = new RemoteAsset($cacheEngine,$keyPrefix);
 * $remote->ttl = 10000; // cache time in seconds, optional, defaults to 3600
 * $remote->timeout = 2; // optional, timeout for remote request in seconds, defaults to 5
 * $content = $remote->getFile('komin.test.malmo.se/assets/remote/komin-header.jsp?node=forum');
 * echo $content;
 * </code>
 *
 * Requires the Curl PHP lib.
 *
 */
class RemoteAsset {

  /**
   * @var boolean  Connection error
   */
  public $connectionError = false;

  /**
   * @var boolean  Use https: instead of http:
   */
  public $useSSL = false;

  /**
   * @var string  Cache engine
   */
  private $cache;

  /**
   *  @var  integer Time to live in seconds
   */
  public $ttl = 3600;

  /**
   *  @var  integer Timeout in seconds before geting cache instead of remote file
   */
  public $timeout = 5;

  /**
   * Constructor
   *
   * @access  public
   * @param   mixed  Cache engine name or false, optional
   * @param   mixed  Key prefix to use, optional
   */
  public function __construct($cacheEngine=false,$keyPrefix='') {
    $this->cache = Cache::getEngine($cacheEngine,$keyPrefix);
  }


  /**
   * Used both to secure that we start the request with a protocol so no local files will be requested
   * and to get a key for the cache engine
   * Note: Key prefix is set in the Cache class as well as hashing
   *
   * We use the full remote URL
   *
   * @return string Full url
   */
  private function cleanupUrl($url) {

    if(preg_match('!^https?://!', $url) === 0) {

      if($this->useSSL) {
        $url = 'https://' . $url;
      } else {
        $url = 'http://' . $url;
      }
    }

    return $url;
  }

  /**
   * Get the remote file fresh or from cache if $ttl is fresh and we aer using a cache engine
   *
   * @param $url Remote url to be fetched including query if needed
   * @return string File contents
   */
  public function getFile($url) {

    $remoteUrl = $this->cleanupUrl($url);

    if(!$this->cache) {
      $content = $this->getRemoteFile($remoteUrl);
    } else {
      $content = $this->cache->get($remoteUrl);

      if($content === false) { // No fresh data in cache
        $content = $this->getRemoteFile($remoteUrl);

        // Check that we recieved remote data before we cache
        if(!$this->connectionError) {
          $this->cache->store($remoteUrl, $content, $this->ttl);
        }
      }
    }
    return $content;
   }

  /**
   * Get the remote file
   *
   * @return mixed  File contents or false if timeout was reached
   */
  private function getRemoteFile($remoteUrl) {

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
    curl_setopt($curl, CURLOPT_URL, $remoteUrl);

    // get the transfer as a string
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);

    curl_close($curl);

    if (strlen($output) > 0) {
      AppLog::put('Retrieved asset ' . $remoteUrl, 'debug');
      return $output;
    } else {
      AppLog::put('Remote server timeout when getting asset ' . $remoteUrl, 'warning');
      $connectionError = true;
      return false;
    }
  }
}
