<?php
if (!function_exists('add_action'))
{
    require_once("../../../../wp-config.php");

	//	require_once("../../../../wp-includes/wp-db.php");
$data="";	
$GalleryOptions = get_option('image_gallery_options');
$per_page=$GalleryOptions['ThumbPerPage'];
	if($_GET['nxt']){
	
			if($_GET['nxt']+$per_page > $_GET['row']){
				$nevication=$_GET['nxt'];
				while($nevication >= $_GET['row']){
				$nevication=$nevication-1;
			}
		}else{
			$nevication=$_GET['nxt'];
			}
	//$sql="SELECT * FROM wp_imagegallery limit $nevication , $per_page";
	$thumbs = $wpdb->get_results("SELECT * FROM wp_imagegallery limit $nevication , $per_page");
	}else{
		if($_GET['prv']-$per_page <= 0 or $_GET['prv']==$_GET['row']){
		$nevication=0;
		}else{
		$nevication=$_GET['prv'];
		}
		$thumbs = $wpdb->get_results("SELECT * FROM wp_imagegallery limit $nevication , $per_page");
		
		}
$data='<table width="99%" border="0" cellspacing="4" cellpadding="4" align="center" style="height:';
$data.=$GalleryOptions['ThumbnailHeight'];
$data.='px;" ><tr>';
foreach($thumbs as $row){
$data.='<td  width="'.$GalleryOptions['ThumbnailWidth'].'"&nbsp; height="' .$GalleryOptions['ThumbnailHeight'] .'" valign="middle"><img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$row->imagename.'" height="' .$GalleryOptions['ThumbnailHeight'] .'" width="'.$GalleryOptions['ThumbnailWidth'].'" onclick="setimage('.$row->imageid.');" /></td>';
}
$data.=' </tr></table>';
echo $data;


}	
?>
        


