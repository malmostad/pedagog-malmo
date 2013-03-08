<?php

class AppLog {
  /**
   * Log a message to an application log
   *
   * @param string  Message to log
   * @param string  Type of message: 'error', warning or 'debug'
   * @return boolean  True if logging was made, otherwis false
   */
  public static function put($msg, $type='debug') {

    global $mconfig;

    $logfile = $mconfig['logdir'] . 'app.log';

    if ($type == 'error' && $mconfig['loglevel'] > 0) {
      $type = 'ERROR';
    }

    elseif ($type == 'warning' && $mconfig['loglevel'] > 1) {
      $type = 'WARNING';
    }
    elseif ($type == 'debug' && $mconfig['loglevel'] > 2) {
      $type = 'DEBUG';
    }

    else {
      return false;
    }

    if(!is_string($msg)) {
      $msg = var_export($msg,true);
    }

    if(!file_put_contents($logfile, date('Y-m-d H:i:s') . "\t" . $type . "\t" . $msg . "\n", FILE_APPEND)) {
      return false;
    }
    return true;
  }
}
