<?php
if (ini_get('display_errors')) {
    ini_set('display_errors', '1');
}
ini_set('memory_limit', '256M');
ini_set('post_max_size', '10M');
date_default_timezone_set("Asia/Dhaka");
?>
<?php
setlocale(LC_ALL, 'nl_NL');
//Live ------------------------------------------

/*
define('DB_NAME', 'hcfdbd_epaper');
define('DB_USER', 'hcfdbd_hatia');
define('DB_PASSWORD', 'RJ)1kfD2zU^O');
 */

define('DB_NAME', 'bkhabor_epaper');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

define('DB_HOST', 'localhost');

define('DB_CHARSET', 'utf8');

define('DB_COLLATE', '');

define('TABLE_PREFIX', 'e_');
define('EP_DEBUG', false);
define('TOTALPAGE', 100);

define('SITECODE', 'SHIPLUMTI');
$path = dirname(__FILE__);
$path = str_replace('\\', '/', $path);
if (!defined('ABSPATH')) {
    define('ABSPATH', $path . '/');
}

define('SYSPATH', ABSPATH . 'system/');

/*
define('SITEURL', 'http://hcfdbd.org/epaper_new');
define('UPLOAD_TEMPPATH', ABSPATH.'tempupload/');
define('UPLOAD_ADV', ABSPATH.'advertise/');
define('PAGE_UPLOAD', ABSPATH.'images/');
define('SESSION_PATH', '/home/hcfdbd/public_html/epaper_new/sessions');

 */

define('SITEURL', 'http://localhost/epaperadmin');
define('FRONTURL', 'http://localhost/');
define('UPLOAD_TEMPPATH', ABSPATH . 'tempupload/');
define('UPLOAD_ADV', ABSPATH . 'advertise/');
define('PAGE_UPLOAD', 'http://localhost/images/');
define('SESSION_PATH', '/I:/xampp7.3/htdocs/epaperadmin/sessions/');
// define('SITEURL', 'http://epaper.bangladesherkhabor.net/epaperadmin');
// define('FRONTURL', 'http://epaper.bangladesherkhabor.net/');
// define('UPLOAD_TEMPPATH', ABSPATH.'tempupload/');
// define('UPLOAD_ADV', ABSPATH.'advertise/');
// define('PAGE_UPLOAD', '/home/bkhabor/public_html/epaper.bangladesherkhabor.net/images/');
// define('SESSION_PATH', '/home/bkhabor/public_html/epaper.bangladesherkhabor.net/epaperadmin/sessions');

require_once ABSPATH . 'system/ep-db.php';
global $epdb;
$epdb = new epdb(DB_USER, DB_PASSWORD, DB_NAME, DB_HOST);

require_once ABSPATH . 'system/ep-functions.php';

global $setting;
$setting = array();
$setting = array(
    'site_title' => 'Bangladesher Khabor',
    'site_url' => SITEURL,
    'front_url' => FRONTURL,
    'upload_temp_path' => UPLOAD_TEMPPATH,
    'page_iamge_path' => ABSPATH . '/images/',
    'max_img_with' => 2000,
    'max_img_height' => 3010,
    'max_img_size' => 4096,
    'small_width' => 200,
    'small_height' => 322,
    'medium_width' => 897,
    'medium_height' => 1345,
    'magazine_max_width' => 1445,
    'magazine_max_height' => 2062,
    'magazine_mid_width' => 578,
    'magazine_mid_height' => 720,
    'magazine_small_width' => 114,
    'magazine_small_height' => 170,
    'crop_ratio' => 2.23,
    'adv_locations' => array(
        'left_of_logo' => 'Left of Logo',
        'right_of_logo' => 'Right of Logo',
        'top_of_paper' => 'Below Date - above Top of Paper',
        'below_1st_feature' => 'Below 1st Magazine(Satrong)',
        'below_2nd_feature' => 'Below 2nd Magazine(Abokash)',
        'below_3rd_feature' => 'Below 3rd Magazine(Satrong)',
        'left_side' => 'Rest Left Bottom',
        'right_side' => 'Right Side',
        'top_footer' => 'Top of Footer',
        'popup' => 'Bottom of News Lightbox',
    ),
    'feature_page' => array(
        'abokash' => 'ABC',
        'satrong' => 'EFG',
        'casabad' => 'MNO',
        'science_and_tecnology' => 'OPQ',

        'priojon' => 'EFG',
    ),
);
