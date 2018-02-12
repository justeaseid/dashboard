<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/* define base url of the directory */
define('URL', 'http://localhost/justeaseadmin/');

define('IMG', URL . 'public/img');
define('CSS', URL . 'public/css');
define('JS', URL . 'public/js');

/* define puglins base directory */
define('PLUGINS', URL . 'public/plugins');

/* define general base directory */
define('GENERAL', URL . 'public/general');
define('GENERAL_JS', GENERAL . '/js');
define('GENERAL_CSS', GENERAL . '/css');

/* define highchart base directory */
define('HIGHCHART', GENERAL . '/js/highchart/js');
define('HIGHCHART_ADAPTER', GENERAL . '/js/highchart/js/adapter');
define('HIGHCHART_MODULES', GENERAL . '/js/highchart/js/modules');
define('HIGHCHART_THEMES', GENERAL . '/js/highchart/js/themes');

/* define dist base directory */
define('DIST', URL . 'public/dist');
define('DIST_IMG', DIST . '/img');
define('DIST_CSS', DIST . '/css');
define('DIST_JS', DIST . '/js');

/* define bootstrap base directory */
define('BOOTSTRAP', URL . 'public/bootstrap');
define('BOOTSTRAP_IMG', BOOTSTRAP . '/img');
define('BOOTSTRAP_FONTS', BOOTSTRAP . '/fonts');
define('BOOTSTRAP_CSS', BOOTSTRAP . '/css');
define('BOOTSTRAP_JS', BOOTSTRAP . '/js');

/* define root and data base directory */
define('ROOT', getcwd());
define('DATA', ROOT . '/public/data/');

/* define all image */
define('LOGO_FULL', DIST_IMG . '/logo/brand_logo_trans.png');
define('LOGO', DIST_IMG . '/logo/brand_logo_trans.png');
define('LOGO_SINGLE', DIST_IMG . '/logo/brand_logo_trans.png');
define('ICON', DIST_IMG . '/logo/js_logo_small.png');
define('MAN', DIST_IMG . '/avatar/avatar5.png');
define('WOMAN', DIST_IMG . '/avatar/avatar2.png');
//define('USER_ICON', DIST_IMG . '/avatar/admin.png');
define('USER_ICON', DIST_IMG . '/avatar/avatar5.png');

/* special config */
define('MYTIME', date_default_timezone_set('Asia/Jakarta'));
define('MY_MEMORY_LIMIT', ini_set('memory_limit', '-1'));
define('MY_EXECUTION_TIME', ini_set('max_execution_time', 0));

/* End of file constants.php */
/* Location: ./application/config/constants.php */