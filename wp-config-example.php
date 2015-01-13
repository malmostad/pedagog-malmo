<?php

define('DB_NAME', 'db_name');
define('DB_USER', 'db_user');
define('DB_PASSWORD', 'some_secret');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_general_ci');
$table_prefix  = '';


define ('WPLANG', 'sv_SE');
define('WP_SITEURL', 'http://pedagog.malmo.se');
define('WP_HOME',    'http://pedagog.malmo.se');

# Generate new keys at https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         '+A2Ne8E8|_h=aQTNe0S&qE|WWWJd.Hr+a/2coXb->uL3^;TTtih:-yY:i^TM=<TV');
define('SECURE_AUTH_KEY',  '?K=O>4Q>I=+*k%K6D66CJ!amTNeNzg)9!H9q_?i#JMD1#nU9K/yE EtfSp~_S|+e');
define('LOGGED_IN_KEY',    'FBY5A!.-L6jqd&GR:;+ftOsZ0ZGyM|BDk u=+3S)YTv2ds1nRsKG3N#Pf^qQn %9');
define('NONCE_KEY',        '+*Z:wG:LRGLnchyXZ8NK:5_u>oPiS;1B8u-+2Fxv+X3+]4W|+*R|@TfTq4q+25SE');
define('AUTH_SALT',        'ykTzN/>TOUP ^(Zb})<=d+4p+IE v44lWd^j;h(+_4eW&:gdULMe!7MPHByQ3;x4');
define('SECURE_AUTH_SALT', 'Q}u1q)2DD:&a{SYbINr?:|W0A7B$jspm}>uPpr |]1t4ty`2^J-(,|=:roKghQ;E');
define('LOGGED_IN_SALT',   'onVpJ%t$-ykQ}hao7KKe-<=c|V8tDfBDU-#A|Q|rK=Cu{k*DN9I<R-n}3{q8JSN+');
define('NONCE_SALT',       'Us;Q*U+e>{s=!MpZOU(N$mJPJF4Yo@=rPl |a}-/qgTq23TlCi`YI|v)3Lg+G&-4');


define('WP_DEBUG', false);
define( 'SAVEQUERIES', false );

define('FORCE_SSL_LOGIN', true);
define('DISALLOW_FILE_EDIT', true);


if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

require_once(ABSPATH . 'wp-settings.php');