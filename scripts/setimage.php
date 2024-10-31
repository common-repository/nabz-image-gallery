<?php
if (!function_exists('add_action'))
{
    require_once("../../../../wp-config.php");
//define('url' , get_bloginfo('url'));
	//	require_once("../../../../wp-includes/wp-db.php");
$GalleryOptions = get_option('image_gallery_options');
$id=$_GET['id'];
$sql="SELECT * FROM wp_imagegallery where imageid = $id";
$image = $wpdb->get_row("SELECT * FROM wp_imagegallery where imageid = $id");

   if($GalleryOptions['ImageDescription']=='on'){
echo '<DIV TITLE="header=[Description] body=['.$image->shortdesc.']" STYLE="BORDER: #558844 1px solid; display:block"><img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$image->imagename.'" height="'.$GalleryOptions['GalleryHeight'].'" width="'.$GalleryOptions['GalleryWidth'].'" /></DIV>';
  }else{
  echo '<DIV><img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$image->imagename.'" height="'.$GalleryOptions['GalleryHeight'].'" width="'.$GalleryOptions['GalleryWidth'].'" /></DIV>';

 }

}	
?>
        


