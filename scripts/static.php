<?php
$GalleryOptions = get_option('image_gallery_options');
$per_page=$GalleryOptions['ThumbPerPage'];
$loading.='';
require('css_style.php');
?>

<table width="100%" border="0" cellspacing="4" cellpadding="4" bgcolor="#<?=$GalleryOptions['GalleryBgColor']?>">
  <tr>
    <td colspan="3"><input type="hidden" name="counter" id="counter" value="<?=$per_page?>" />    </td>
  </tr>
  <?php
  global $wpdb; 
  $num_row = $wpdb->get_var("SELECT count(*) FROM wp_imagegallery");
  $row = $wpdb->get_row("SELECT * FROM wp_imagegallery order by imageid");
  ?>
    <tr>
    <td height="<?=$GalleryOptions['GalleryHeight']?>" width="<?=$GalleryOptions['gallery_width']?>" colspan="3" valign="middle" >
  <div id="large_image">

 <?php if($GalleryOptions['ImageDescription']=='on'){?> 

  <DIV TITLE="header=[Description] body=[<?=$row->shortdesc?>]" STYLE="BORDER: #558844 1px solid;display:block">
 <img src="<?=get_bloginfo('url')?>/wp-content/plugins/nabz-image-gallery/images/<?php echo $row->imagename;?>" height="<?=$GalleryOptions['GalleryHeight']?>" width="<?=$GalleryOptions['GalleryWidth']?>"/>
</DIV>
  <?php }else{?>
  
 <div><img src="<?=get_bloginfo('url')?>/wp-content/plugins/nabz-image-gallery/images/<?php echo $row->imagename;?>" height="<?=$GalleryOptions['GalleryHeight']?>" width="<?=$GalleryOptions['GalleryWidth']?>"/></div>
  <?php }?>  
    

   </DIV>   
    </td>
  </tr>
  <tr>
    <td width="2%" height="<?=$GalleryOptions['ThumbnailHeight']?>" valign="middle"><input name="prv" type="button" value="&lt;" style="height:<?=$GalleryOptions['ThumbnailHeight']?>px; width:20px;" onclick="thumbnail_previous('<?=get_bloginfo('url')?>/wp-content/plugins/nabz-image-gallery/scripts/nevication.php','<?=$num_row?>','<?=$per_page?>');"/></td>
    <td width="96%" valign="middle">
    <div id="thumbnails" style="height:<?=$GalleryOptions['ThumbnailHeight']?>px;">
    <table width="100%" border="0" cellspacing="4" cellpadding="4" align="center" style="height:<?=$GalleryOptions['ThumbnailHeight']?>px;">
    <tr>
   	<?php
	$url=get_bloginfo('url');
	$thumbs = $wpdb->get_results("SELECT * FROM wp_imagegallery  order by imageid limit 0,$per_page");
	 foreach($thumbs as $thumbrow){
	 echo '<td height="'.$GalleryOptions['ThumbnailHeight'].'" width="'.$GalleryOptions['ThumbnailWidth'].'" valign="middle">'.
	 '<img src="'.get_bloginfo('url').'/wp-content/plugins/nabz-image-gallery/images/'.$thumbrow->thumbname.'" height="'.$GalleryOptions['ThumbnailHeight'].'" width="'.$GalleryOptions['ThumbnailWidth'].'" onclick="setimage('.$thumbrow->imageid.');" />'.
	 '</td>';
     }
	?>
        </tr>
</table>
 </div>    </td>
    <td width="2%" height="<?=$GalleryOptions['ThumbnailHeight']?>" valign="middle">
<input name="nxt" type="button" value="&gt;" style="height:<?=$GalleryOptions['ThumbnailHeight']?>px; width:20px;"  onclick="thumbnail_next('<?=get_bloginfo('url')?>/wp-content/plugins/nabz-image-gallery/scripts/nevication.php','<?=$num_row?>','<?=$per_page?>');"/>
    </td>
  </tr>

</table>

