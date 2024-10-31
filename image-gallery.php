<?php
/* 
Plugin Name:Nabz Image Gallery
Plugin URI: http://www.nabz.net/
Version: v1.00
Author: Nabajit Roy
Description: This plagin have a youtube like default view and a popup view to meet your requirment. Please feel free to mail me if you need any upgradition.
Email : nabajitroy@gmail.com
*/
if (function_exists('register_activation_hook')) {
register_activation_hook(__FILE__,'gallery_install');
}
if(function_exists('register_deactivation_hook')){
register_deactivation_hook( __FILE__, 'gallery_uninstall' );
}

//if(function_exists('register_deactivation_hook')){
//register_activation_hook(__FILE__,'gallery_uninstall');
//}

add_action('admin_init', 'GalleryJavascript');
add_action('admin_menu', 'GalleryMenu');
//Creating table Structure




function gallery_install()
{
    global $wpdb;
    global $jal_db_version;
    $table_name = $wpdb->prefix . "imagegallery";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      $sql = "CREATE TABLE " . $table_name . " (
	  imageid mediumint(9) NOT NULL AUTO_INCREMENT,
	  imagename tinytext NOT NULL,
	  thumbname tinytext NOT NULL,
	  shortdesc text NOT NULL,
	  imageurl VARCHAR(55) NOT NULL,
	  UNIQUE KEY imageid (imageid)
	);";
	

$sql.="INSERT INTO `wp_imagegallery` VALUES(1, 'fat-boat-1.jpg', 'thumb_fat-boat-1.jpg', 'With our famous 5-minute installation, setting up WordPress for the first time is simple. We?ve created a handy guide to see you through the installation process. If you''re upgrading your existing installation, we''ve got a guide for that, too. And ', '');INSERT INTO `wp_imagegallery` VALUES(2, 'slide_im_4.jpg', 'thumb_slide_im_4.jpg', 'description here description here description here description here description here description here', '');INSERT INTO `wp_imagegallery` VALUES(3, 'light-fingers.jpg', 'thumb_light-fingers.jpg', 'description here description here description here description here description here description heredescription here description here description heredescription here description here description here', '');INSERT INTO `wp_imagegallery` VALUES(4, 'LEGO-ironman.jpg', 'thumb_LEGO-ironman.jpg', 'description here description here description here description here description here description here description here description here description here description here description here description here description here description here description here', '');INSERT INTO `wp_imagegallery` VALUES(5, 'slide_im_1.jpg', 'thumb_slide_im_1.jpg', 'description here description here description here description here description here description here description here description here ', '');";
      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

     
}

$gallery_options= array(
'GalleryHeight'=>'250',
'GalleryWidth'=>'450',
'GalleryStyle'=>'default',
'ThumbnailHeight'=>'85',
'ThumbnailWidth'=>'110',
'ThumbPerPage'=>'3',
'ImageDescription'=>'on',
'PopupTop'=>'200',
'PopupLeft'=>'300',
'GalleryBgColor'=>'#fff',
'UploadDirectory'=>$_SERVER['DOCUMENT_ROOT'] .'/wp-content/plugins/nabz-image-gallery/images/',
);
 add_option("image_gallery_options", $gallery_options, '', 'yes');
}
//Creating table Structure ends

function gallery_uninstall()
{
 delete_option('image_gallery_options');
}

//include javascripts
wp_enqueue_script('image-gallery', get_bloginfo('wpurl') . '/wp-content/plugins/nabz-image-gallery/js/gallery.js', array('prototype'), 'v1.00');
wp_enqueue_script('image-gallery1', get_bloginfo('wpurl') . '/wp-content/plugins/nabz-image-gallery/js/boxover.js', array('prototype'), 'v1.00');
wp_enqueue_script('image-gallery_css', get_bloginfo('wpurl') . '/wp-content/plugins/inabz-mage-gallery/js/gallery_style.css"', array('prototype'), 'v1.00');
//include javascripts ends



function GalleryJavascript()
 {
  if (function_exists('wp_enqueue_script')) {
wp_enqueue_script('image-gallery', get_bloginfo('wpurl') . '/wp-content/plugins/image-gallery/scripts/gallery.js', array('prototype'), 'v1.00');
}
 }            


function GalleryMenu() {
  add_options_page('Image Gallery', 'Image Gallery', 5, basename(__FILE__), 'GalleryAdminScreen');
}
function GalleryAdminScreen() {
include('scripts/adminscreen.php');
 
}

// front view of gallery
add_shortcode('view_gallery', 'show');
function show(){
$GalleryOptions = get_option('image_gallery_options');
if($GalleryOptions['GalleryStyle']=='default'){
include('scripts/static.php');
}else{
include('scripts/popup.php');
}

 }
  ?>