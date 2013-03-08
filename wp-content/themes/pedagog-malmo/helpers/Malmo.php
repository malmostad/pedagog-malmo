<?php
class Malmo {
  public static function config($key) {
    global $mconfig;
    return $mconfig[$key];
  }

  public static function getRemoteContent($url) {
    $remoteAsset = new RemoteAsset(self::config('cache_engine'), self::config('cache_id'));
    $remoteAsset->ttl = 60 * 60 * 5;
    $content = $remoteAsset->getFile('http:' . self::config('asset_host') . $url);
    return $content;
  }
}
