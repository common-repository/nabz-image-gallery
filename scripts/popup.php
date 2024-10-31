<?php
if (!function_exists('add_action'))
{
    require_once("../../../../wp-config.php");
	
}
include('css_style.php');
global $wpdb; 
$GalleryOptions = get_option('image_gallery_options');
$per_page=$GalleryOptions['ThumbPerPage'];
$max_row=$wpdb->get_var("SELECT count(*) FROM wp_imagegallery");
if($_GET['nxt']){

$limit = $_GET['nxt'];
$popup = $wpdb->get_row("SELECT * FROM wp_imagegallery  order by imageid limit $limit,1");
if($GalleryOptions['ImageDescription']=='on'){

 echo '<DIV TITLE="header=[Description] body=['.$popup->shortdesc.']" STYLE="BORDER: #558844 1px solid; display:block"><img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$popup->imagename.'" height="'.$GalleryOptions['GalleryHeight'].'" width="'.$GalleryOptions['GalleryWidth'].'"/></DIV></a>';
 }else{
  
  echo '<img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$popup->imagename.'" height="'.$GalleryOptions['GalleryHeight'].'" width="'.$GalleryOptions['GalleryWidth'].'"/>';
  
  
  
 
 }
exit();
}else{
if($_GET['prv']){

 $limit = $_GET['prv'];
$limit=$limit-1;
$popup = $wpdb->get_row("SELECT * FROM wp_imagegallery  order by imageid limit $limit,1");

if($GalleryOptions['ImageDescription']=='on'){
 echo '<DIV TITLE="header=[Description] body=['.$popup->shortdesc.']" STYLE="BORDER: #558844 1px solid; display:block"><img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$popup->imagename.'" height="'.$GalleryOptions['GalleryHeight'].'" width="'.$GalleryOptions['GalleryWidth'].'"/></DIV>';
}else{
 echo '<img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$popup->imagename.'" height="'.$GalleryOptions['GalleryHeight'].'" width="'.$GalleryOptions['GalleryWidth'].'"/>';
}
exit();
}
}

?>
<table width="100%" border="0" cellspacing="4" cellpadding="4" >
  <tr><input id="baseurl" type="hidden" value="<?php echo get_bloginfo('url');?>" />
   <?php 
  $count=0;
   $pos=1;
  $thumbs = $wpdb->get_results("SELECT * FROM wp_imagegallery  order by imageid");
  foreach($thumbs as $thumbrow){
echo '<td height="'.$GalleryOptions['ThumbnailHeight'].'" width="'.$GalleryOptions['ThumbnailWidth'].'" valign="middle"><a href="javascript:void(0)"><img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$thumbrow->thumbname.'" height="'.$GalleryOptions['ThumbnailHeight'].'" width="'.$GalleryOptions['ThumbnailWidth'].'" onclick="show_popup('.$thumbrow->imageid.','.$pos.','.$pos.')"/></a></td>';

  $pos++;
  $count++;
  if($count>=3){
  echo '</tr><tr>';
  $count=0;
  } 
   
  }
  ?>
  </tr>
  
</table>













<div id="hideshow" style="visibility:hidden;">
<table border="1" cellpadding="1" cellspacing="1" style=" border:#000;" width="<?=$GalleryOptions['GalleryWidth']?>">
<tr><td>
 <table  border="0" cellspacing="0" cellpadding="0" width="<?=$GalleryOptions['GalleryWidth']?>" bgcolor="#<?=$GalleryOptions['GalleryBgColor']?>">
  <tr>
    <td><h3>Gallery</h3></td>
    <td align="right"><a href="javascript:hide_popup()"><img src="<?=get_bloginfo('url')?>/wp-content/plugins/nabz-image-gallery/js/icon_close.png" class="cntrl"/></a></td>
  </tr>
  <tr>
    <td colspan="2" valign="middle"><div id="container"></div></td>
    </tr>
  <tr>
    <td align="left"><input name="previous" type="button" value="&lt;&lt;" onclick="popup_previous('<?=$max_row?>','<?=get_bloginfo('url')?>');" /></td>
    <td align="right"><input name="next" type="button" value="&gt;&gt;" onclick="popup_next('<?=$max_row?>','<?=get_bloginfo('url')?>');" /></td>
  </tr>
  
  <tr>
    <td align="left"></td>
    <td align="right"><input id="position" name="position" type="hidden" value="0"  /></td>
  </tr>
</table>
</tr></td>
</table>
</div>

 