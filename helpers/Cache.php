<?php
/**
 * Select cache engine to use
 *
 * Usage:
 * <code>
 * $cache = new Cache('apc', 'my-prefix');
 * Update:
 * $cache->put('key', 'value' [, 'ttl'] );
 * Retrieve
 * $cache->get('key');
 * Remove
 * $cache->remove('key');
 * </code>
 *
 */
class Cache {
  // Hold an instance of the engine
  private static $engine;

  private function __construct() {
    // private, no external creation
  }
   /*
   * Initialize cache engine in not done
   *
   * @param string Cache engine name
   * @param string Prefix to use for cache keys
   * @return mixed Cache engine object or false if no caching is set or init failed
   */
  public static function getEngine($type=false, $keyPrefix='') {

    if (!isset(self::$engine)) {
      $c = __CLASS__;
      self::$engine = new $c;

      if ($type == 'apc') {
        self::$engine = new CacheApc($keyPrefix);
      }

      // Add other engines here as needed and create a Cache* class wrapper

      else {
        self::$engine = false;
      }
    }

    return self::$engine;
  }
}
