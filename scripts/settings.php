<?php

if(isset($_POST['UpdateGalleryOptions']))
 {
  $UpdateData['GalleryHeight']=$_POST['update_gallery_height'];
  $UpdateData['GalleryWidth']=$_POST['update_gallery_width'];
  $UpdateData['GalleryStyle']=$_POST['update_gallery_style'];
  $UpdateData['ThumbnailHeight']=$_POST['update_thumbnail_height'];
  $UpdateData['ThumbnailWidth']=$_POST['update_thumbnail_width'];
  $UpdateData['ThumbPerPage']=$_POST['update_thumbnail_perpage'];
  $UpdateData['UploadDirectory']=$_POST['update_upload_dir'];
  $UpdateData['ImageDescription']=$_POST['update_image_description'];
  $UpdateData['PopupTop']=$_POST['update_popup_top'];
  $UpdateData['PopupLeft']=$_POST['update_popup_left'];
  $UpdateData['GalleryBgColor']=$_POST['update_gallery_bgcolor'];


// add_option("image_gallery_options", $gallery_options, '', 'yes');
update_option('image_gallery_options', $UpdateData);
$update_setting='<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade"><p>Settings updated successfully</p></div>';
 }
 
 $GalleryOptions = get_option('image_gallery_options');

	//foreach ($GalleryOptions as $key => $option){
		//$GalleryOptions[$key] = $option;
	//}

//echo $GalleryOptions['upload_dir'];


?>
<form action="" method="post">
<table width="100%" border="0" cellspacing="4" cellpadding="4">
<?php if($update_setting){ ?>  
  <tr>
    <td colspan="3"><?php echo $update_setting?></td>
  </tr>
<?php }?>
  
  <tr>
    <td colspan="3"><h3>Gallery Settings</h3></td>
  </tr>
  
   <tr>
    <td colspan="3"><strong>Gallery Style</strong></td>
  </tr>
  
  
  
  
<?php if($GalleryOptions['GalleryStyle']=='default'){ ?>  
   <tr>
    <td><input name="update_gallery_style" type="radio" value="default" checked="checked" />Default Style</td>
    <td><input name="update_gallery_style" type="radio" value="popup" />Popup Style</td>
    <td>&nbsp;</td>
  </tr>
 <?php }else{?>
 <tr>
    <td><input name="update_gallery_style" type="radio" value="default" />Default Style</td>
    <td><input name="update_gallery_style" type="radio" value="popup" checked="checked"/>Popup Style</td>
    <td>&nbsp;</td>
  </tr>
 
 <?php }?>
 
 
 
  <tr>
    <td width="33%"><strong>Popup Gallery Position</strong></td>
    <td width="33%">&nbsp;</td>
    <td width="34%">&nbsp;</td>
  </tr>
 
  <tr>
    <td width="33%"><strong>Top</strong><br />
<input type="text" name="update_popup_top" id="textfield" value="<?=$GalleryOptions['PopupTop']?>"  /></td>
    <td width="33%"><strong>Left</strong><br />
<input type="text" name="update_popup_left" id="textfield" value="<?=$GalleryOptions['PopupLeft']?>"  /></td>
    <td width="34%">&nbsp;</td>
  </tr>
 
 
  
  <tr>
    <td width="33%"><strong>Gallery Height</strong> <br />
 <input type="text" name="update_gallery_height" id="textfield" value="<?=$GalleryOptions['GalleryHeight']?>"  /></td>
    <td width="33%"><strong>Gallery Width</strong><br />
  <input type="text" name="update_gallery_width" id="textfield" value="<?=$GalleryOptions['GalleryWidth']?>"   /></td>
    <td width="34%">&nbsp;</td>
  </tr>
   
  <tr>
    <td><strong>Thumbnails Height</strong><br />
    <input type="text" name="update_thumbnail_height" id="textfield" value="<?=$GalleryOptions['ThumbnailHeight']?>"/></td>
    <td><strong>Thumbnails Width</strong><br />

    <input type="text" name="update_thumbnail_width" id="textfield" value="<?=$GalleryOptions['ThumbnailWidth']?>"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Thumbnails Per Page</strong><br />
<input type="text" name="update_thumbnail_perpage" id="textfield" value="<?=$GalleryOptions['ThumbPerPage']?>"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
   <tr>
    <td><strong>Gallery Bgcolor</strong><br />
#<input type="text" name="update_gallery_bgcolor" id="textfield" value="<?=$GalleryOptions['GalleryBgColor']?>"/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  
  
  
   <tr>
    <td><strong>Upload Directory</strong></td>
    <td><input type="text" name="update_upload_dir" id="textfield" style="height:40px; width:500px;" value="<?=$GalleryOptions['UploadDirectory']?>"/></td>
    <td>&nbsp;</td>
  </tr>
  
  
   <tr>
    <td>
    <?php if($GalleryOptions['ImageDescription']=='on'){ ?> 
    <input name="update_image_description" type="checkbox" checked="checked" />
    <?php }else{?>
    <input name="update_image_description" type="checkbox"/>
    <?php } ?>
    <strong>Show Image Description</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  
  
  
   <tr>
    <td colspan="3"><input type="submit" name="UpdateGalleryOptions" id="button" value="Update" /></td>
  </tr>
</table>

  

