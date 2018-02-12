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
//define('URL', 'http://nlp-87356376.ap-southeast-1.elb.amazonaws.com/asosiantale/');
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

/* define constant Ezytravel Server */
define('DA1', "http://54.179.134.45");
define('DA2', "http://54.169.16.176");
define('DA3', "http://52.77.226.134");
define('DA4', "http://54.169.197.235");

/* define constant Ezytravel Monitoring */
define('DA1_MONITOR', DA1 . "/myserver");
define('DA1_ADMIN', DA1 . "/phpmyadmin");

define('DA2_MONITOR', DA2 . "/myserver");
define('DA2_ADMIN', DA2 . "/phpmyadmin");

define('DA3_MONITOR', DA3 . "/myserver");
define('DA3_ADMIN', DA3 . "/phpmyadmin");

define('DA4_MONITOR', DA4 . "/myserver");
define('DA4_ADMIN', DA4 . "/phpmyadmin");

/* define constant Ezytravel String root */
define('DA1_STR', "root@172.31.18.119");
define('DA2_STR', "root@172.31.18.30");
define('DA3_STR', "root@172.31.11.216");
define('DA4_STR', "root@172.31.28.92");

/* define all image */
define('LOGO_FULL', DIST_IMG . '/logo/logos.png');
define('LOGO_SINGLE', DIST_IMG . '/logo/logo_single.jpg');
define('ICON', DIST_IMG . '/logo/analytic1.png');
define('EZY_ICON', DIST_IMG . '/logo/kumparan_icon.jpg');
define('MAN', DIST_IMG . '/avatar/avatar5.png');
define('WOMAN', DIST_IMG . '/avatar/avatar2.png');
define('USER_ICON', DIST_IMG . '/avatar/admin.png');
define('APPS_ICON', DIST_IMG . '/avatar/apps.png');
define('DIST_IMG_BIGDATA', DIST_IMG . '/bigdata');

/* define Socmend API url */
define('SM_SOCMED', "http://localhost/sm_socmed/");
//define('SM_SOCMED', "http://172.31.11.216/sm_socmed/");

define('FACEBOOK', "http://www.facebook.com/");

/* define Facebook API url */
define('FB_SEARCH', SM_SOCMED . "fb_api/search/");
define('FB_PAGE', SM_SOCMED . "fb_api/page_info/");
define('FB_POST', SM_SOCMED . "fb_api/post/");
define('FB_COMMENT', SM_SOCMED . "fb_api/comment/");
define('FB_TOKEN', SM_SOCMED . "fb_api/token/");

/* define Twitter API url  */
define('TWITTER', "https://twitter.com/");
define('HASHTAG', TWITTER . "hashtag/");

/* define instagram API url  */
define('INSTAGRAM', "https://www.instagram.com/");
define('IHASHTAG', INSTAGRAM . "explore/tags/");
define('INS_PAGE', INSTAGRAM . "p/");
define('INS_SEARCH', SM_SOCMED . "ins_api/get_page/");
define('INS_TOKEN', SM_SOCMED . "ins_api/get_token/1/");

/* define Facebook API url */
define('TW_SEARCH', SM_SOCMED . "tw_api/search_user/");
define('TW_ACCOUNT', SM_SOCMED . "tw_api/account_info/");
define('TW_TWEET', SM_SOCMED . "tw_api/tweet/");
define('FB_MENTIONS', SM_SOCMED . "tw_api/mentions/");
define('TW_TOKEN', SM_SOCMED . "tw_api/token/");

define('MYTIME', date_default_timezone_set('Asia/Jakarta'));
define('MY_MEMORY_LIMIT', ini_set('memory_limit', '-1'));
define('MY_EXECUTION_TIME', ini_set('max_execution_time', 0));

/* End of file constants.php */
/* Location: ./application/config/constants.php */