<?php
/**
 * Usage:
 * <code>
 * $cache = new CacheApc('my-prefix');
 * Update:
 * $cache->put('key', 'value' [, 'ttl'] );
 * Remove
 * $cache->remove('key');
 * Retrieve
 * $cache->get('key');
 * </code>
 *
 */
class CacheApc {
  /**
   * Prefix
   * @access  private
   * @var   string
   */
  private $prefix = '';

  /**
   * Constructor
   *
   * @access  public
   * @param   string    Unique prefix for each key to not get conflicts in cache
   */
  public function __construct($prefix='') {

    $this->prefix = $prefix . '-';

    if(!function_exists('apc_cache_info')) {
      AppLog::put("APC does not appear to be running.", "error");
      return false;
    } else {
      AppLog::put("Using APC cache engine.", "debug");
    }
  }

  /**
   * Create key for caching of value
   *
   * @param  string Key base (path+query)
   * @return string md5 of prefix + key param
   */
  private function createKey($key) {
    return md5($this->prefix . $key);
  }

  /**
   * Store data into cache store. Returns true if successful.
   *
   * @access  public
   * @param   string    Unique key
   * @param   string    Value to add
   * @param   integer   [Optional] Time to live
   * @return  boolean   True if caching was successful
   */
  public function store($key, $value, $ttl=600) {

    if(apc_store($this->createKey($key), $value, intval($ttl))) {
      AppLog::put('Stored data in APC cache with key ' . $this->createKey($key)  . ' and ttl ' . $ttl,'debug');
      return true;
    }
    else {
      AppLog::put('Failed storing data in APC cache with key ' . $this->createKey($key),'error');
      return false;
    }
  }

  /**
   * Retrieve a value from cache
   *
   * @access  public
   * @param   string    Unique key
   * @return  mixed     Cached value or false
   */
  public function get($key) {

    $val = apc_fetch($this->createKey($key));

    if ($val) {
      AppLog::put('Using cache from key : ' . $this->createKey($key), 'debug');
    } else {
      AppLog::put('No cached data with key : ' . $this->createKey($key), 'debug');
    }

    return $val;
  }

  /**
   * Remove a value from cache. Returns true if successful.
   *
   * @access  public
   * @param   string    Unique key
   * @return  boolean   Cache removal successful
   */
  public function remove($key) {

    if(apc_delete($this->createKey($key))) {
      AppLog::put('Deleted data in APC cache with key ' . $this->createKey($key),'debug');
      return true;
    }

    else {
      AppLog::put('Failed deleting data in APC cache with key ' . $this->createKey($key),'error');
      return false;
    }
  }
}
