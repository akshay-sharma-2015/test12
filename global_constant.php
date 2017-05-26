<?php 

// D:\xampp\htdocs\casino\bin>cake bake all Master.Masters
define('SUBDIR','cake/');
define('SUBDIR_CSS_PATH','');


define('ADMIN_SUBDIR','admin/');

// $host = $_SERVER['HTTP_HOST'];
$host = 'localhost';



define('JS_URL','js/');
define('CSS_URL','css/');

define('WEBSITE_URL','http://'.$host.'/'.SUBDIR);
define('WEBSITE_ADMIN_URL','http://'.$host.'/'.SUBDIR.ADMIN_SUBDIR);




define('WEBSITE_CSS_URL',WEBSITE_URL.'css/');
define('WEBSITE_JS_URL',WEBSITE_URL.'js/');

// define('WEBSITE_ADMIN_CSS_URL',WEBSITE_URL.'css/admin/');
define('WEBSITE_ADMIN_JS_URL',WEBSITE_URL.'js/admin/');

define('WEBSITE_ADMIN_CSS_URL',WEBSITE_ADMIN_URL.'css/');
define('WEBSITE_ADMN_JS_URL',WEBSITE_ADMIN_URL.'js/');


define('WEBSITE_APP_WEBROOT_ROOT_PATH', ROOT . DS . 'webroot' . DS);

define('APP_WEBROOT_ROOT_PATH', WEBSITE_APP_WEBROOT_ROOT_PATH);


define('APP_UPLOADS_ROOT_PATH', APP_WEBROOT_ROOT_PATH . 'uploads' . DS);
define('WEBSITE_UPLOADS_URL', WEBSITE_URL . 'webroot/uploads/');

define('WEBSITE_IMG_URL',WEBSITE_URL.'img/');
define('COMPLETE_UPLOAD_PATH',WEBSITE_URL.'webroot/uploads/');


define('BLOG_IMG_URL',COMPLETE_UPLOAD_PATH.'blog/');
define('BLOG_IMG_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'blog'.DS);

define('NEWS_IMG_URL',COMPLETE_UPLOAD_PATH.'blog/');
define('NEWS_IMG_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'blog'.DS);


define('SLIDER_IMG_URL',COMPLETE_UPLOAD_PATH.'slider/');
define('SLIDER_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'slider'.DS);

define('PROFILE_IMG_URL',COMPLETE_UPLOAD_PATH.'profile/');
define('PROFILE_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'profile'.DS);

define('GALLERY_IMG_URL',COMPLETE_UPLOAD_PATH.'gallery/');
define('GALLERY_ROOT_PATH',APP_UPLOADS_ROOT_PATH.'gallery'.DS);

define('ADMIN',1);
define('ADMIN_USER','admin');
define('FRONT_USER','front');

define('ADMIN_ID',423424651);

define('DEFAULT_LANG','en');


$config['language_translate_module']    =    array(
		'homepage'    => 'Homepage',
		'menu'    => 'Header Menu'
	);	
	
$config['image_array']    =    array('gambling_options','devices','deposit_methods','language','withdrawal_methods','guide','amenities_info');
$config['seo_array']    =    array('news_category');


define('FILE_SIZE_IN_KB','1024kb');
define('FILE_SIZE_IN_MB','1MB');

 ?>