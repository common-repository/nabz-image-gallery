<?php
global $wpdb; 
$GalleryOptions = get_option('image_gallery_options');
if(isset($_POST['submit'])){
$description=$_POST['image_desc'];
$page_id=$_POST['page_id'];
$image_name=$_FILES['image']['name'];
$thumb_name="thumb_" . $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_type = $_FILES['image']['type'];
$image_tmp_nm = $_FILES['image']['tmp_name'];
$valid_extension=array('JPEG','jpeg','PNG','png' ,'GIF','gif','JPG','jpg');
$uploads_dir = $GalleryOptions['UploadDirectory'] ;
 $ext = explode('/' ,$image_type);
  if(!in_array($ext['1'] , $valid_extension))
          {
              $error = "File is not valid";
          } 
  
       if($image_size > 3000000 or $image_size == 0)
            {
              $error = "File is too large or there is no file to upload";
            }
if(!$error){	
	     //start of image resize
		  	$src = imagecreatefromjpeg($image_tmp_nm);
			list($width,$height)=getimagesize($image_tmp_nm);
			//$newwidth=150;
			$newwidth=150;
			$newheight=($height/$width)*$newwidth;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			$filename = $uploads_dir . "thumb_" . $image_name;
			imagejpeg($tmp,$filename,100);
		
		  //end of image resize
		 
			 move_uploaded_file($image_tmp_nm, $uploads_dir . $image_name);
			 imagedestroy($src);
             imagedestroy($tmp);
			 $query="insert into wp_imagegallery(imageid,imagename,thumbname,shortdesc,imageurl) values('','$image_name','$thumb_name','$description','')";
			$wpdb->query($query); 
	echo '<script>window.location="'.get_bloginfo('url').'/wp-admin/options-general.php?page=image-gallery.php&message=1"</script>';
 }
}



if(isset($_POST['update'])){

$image_id=$_POST['image_id'];
$description=$_POST['image_desc'];
$page_id=$_POST['page_id'];
$image_name=$_FILES['image']['name'];
$thumb_name="thumb_" . $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_type = $_FILES['image']['type'];
$image_tmp_nm = $_FILES['image']['tmp_name'];
$valid_extension=array('JPEG','jpeg','PNG','png' ,'GIF','gif','JPG','jpg');
$uploads_dir = $GalleryOptions['UploadDirectory'] ;
$ext = explode('/' ,$image_type);
 
 
  if($image_name){
  if(!in_array($ext['1'] , $valid_extension))
          {
              $error = "File is not valid";
          } 
  
       if($image_size > 3000000 or $image_size == 0)
            {
              $error = "File is too large or there is no file to upload";
            }
			
		if(!$error){	
	     //start of image resize
		  	$src = imagecreatefromjpeg($image_tmp_nm);
			list($width,$height)=getimagesize($image_tmp_nm);
			//$newwidth=150;
			$newwidth=150;
			$newheight=($height/$width)*$newwidth;
			$tmp=imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
			$filename = $uploads_dir . "thumb_" . $image_name;
			imagejpeg($tmp,$filename,100);
		
		  //end of image resize
		  if(file_exists($uploads_dir.$_POST['image_name'])){
		  unlink($uploads_dir.$_POST['image_name']);
		  }
		  if(file_exists($uploads_dir.$_POST['thumb_name'])){
		  unlink($uploads_dir.$_POST['thumb_name']);
		  }
		  move_uploaded_file($image_tmp_nm, $uploads_dir . $image_name);
		  imagedestroy($src);
          imagedestroy($tmp);	
		  
		  
	}
	}else{	
		$image_name=$_POST['image_name'];
		$thumb_name=$_POST['thumb_name'];
			
}
		$query="update wp_imagegallery set imagename='$image_name',thumbname='$thumb_name',shortdesc='$description' where imageid='$image_id'";
		$wpdb->query($query); 
	$update_success='<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade"><p>Image updated successfully</p></div>';
 }



?>
<div class="wrap">
 <table width="100%" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td colspan="4"><h2>Image Gallery</h2></td>
   </tr>
  <tr>
    <td width="25%"><a href="<?php echo $base_url?>?page=image-gallery.php" class="current"><strong>Gallery Home</strong></a></td>
    <td width="25%"><a href="<?php echo $base_url?>?page=image-gallery.php&option=add_new" class="current"><strong>Upload New</strong></a></td>
    <td width="25%"><a href="<?php echo $base_url?>?page=image-gallery.php&option=settings" class="current"><strong>Settings</strong></a></td>
    <td width="25%"><a href="<?php echo $base_url?>?page=image-gallery.php&option=help" class="current"><strong>Help</strong></a></td>
  </tr>
   <tr>
    <td colspan="4"><hr></td>
    </tr>
  <?php if($_GET['message']) {?>
   <tr>
    <td colspan="4">
      
    <?php if($_GET['message']==1){
	echo '<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade"><p>Image successfully uploaded</p></div>';
	}else{
	if($_GET['message']==2){
	echo '<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade"><p>Image successfully deleted</p></div>';
	}else{
	echo '<div style="background-color: rgb(255, 251, 204);" id="message" class="updated fade"><p>Image successfully restored</p></div>';
	}
	}
	?>
    </td>
  </tr>
 <?php } ?>
    
    
  <tr><td colspan="4">
<?php 
	$option=$_GET['option'];
	switch($option){
	  case 'add_new': 
	    {
?>
<form action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td><h3>Add Image</h3></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Browase a Image</strong></td>
    <td><input type="file" name="image" id="textfield" size="45" /><br><?php echo $error;?></td>
  </tr>
   
  <tr>
    <td valign="top"><strong>Image short description</strong></td>
    <td><textarea name="image_desc" id="textarea" cols="40" rows="3"></textarea></td>
  </tr>
  <tr>
    <td><strong>Page Link</strong></td>
    <td><input type="text" name="page_id" id="textfield" /></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="submit" id="button" value="Submit" /></td>
    </tr>
</table>
</form>

<?php
break;
}
case 'edit':
$imgid=$_GET['img_id'];
$sql="SELECT * FROM wp_imagegallery WHERE imageid='$imgid'";
$row = $wpdb->get_row("SELECT * FROM wp_imagegallery WHERE imageid='$imgid'");
{
 ?>
 <form action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="4" cellpadding="4">


  <tr>
    <td><h3>Edit Image</h3></td>
    <td>&nbsp;</td>
  </tr>
  <?php if($update_success){?>
<tr>
    <td colspan="2"><?=$update_success?></td>
 </tr>
<?php } ?>
  <tr>
    <td valign="top"><strong>Browase a Image</strong></td>
    <td><input type="file" name="image" id="textfield" size="45" /><input name="image_name" type="hidden" value="<?php echo $row->imagename;?>" /><input name="thumb_name" type="hidden" value="<?php echo $row->thumbname;?>" /><input name="image_id" type="hidden" value="<?php echo $row->imageid;?>" />
    <br><?php echo $row->imagename;?>
    <?php echo '<br>'.$error;?></td>
  </tr>
   
  <tr>
    <td><strong>Image short description</strong></td>
    <td><textarea name="image_desc" id="textarea" cols="40" rows="3"><?php echo $row->shortdesc;?></textarea></td>
  </tr>
  <tr>
    <td><strong>Page Link</strong></td>
    <td><input type="text" name="page_id" id="textfield" /></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="update" id="button" value="Submit" /></td>
    </tr>
</table>
</form>

<?php
break;
}


case 'delete':
	    {
			if($_POST['imagedeleteyes']){
					$thumb_name=$_POST['thumb_name'];
					$image_name=$_POST['image_name'];
					$image_id= $_POST['image_id'];
					$delete_query="delete from wp_imagegallery where imageid='$image_id'";
					$wpdb->query($delete_query);
					if(file_exists($thumb_name))
					  {
						unlink($thumb_name);
					  }
					  if(file_exists($image_name))
					  {
						unlink($image_name);
					  }
			echo '<script>window.location="'.get_bloginfo('url').'/wp-admin/options-general.php?page=image-gallery.php&message=2"</script>';	  
		  }else{
		  if($_POST['imagedeleteno']){
		  echo '<script>window.location="'.get_bloginfo('url').'/wp-admin/options-general.php?page=image-gallery.php&message=3"</script>';
		  }
     }


 
$imgid=$_GET['img_id'];
$sql="SELECT * FROM wp_imagegallery WHERE imageid='$imgid'";
$row = $wpdb->get_row("SELECT * FROM wp_imagegallery WHERE imageid='$imgid'");

?>

<form action="" method="post" enctype="multipart/form-data">
<table width="100%" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td width="25%"><h3>Confirm Delete</h3></td>
    <td width="75%">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
    <img src="<?=get_bloginfo('wpurl')?>/wp-content/plugins/image-gallery/images/<?=$row->thumbname?>"/>
      <input name="thumb_name" type="hidden" value="<?php echo $row->thumbname;?>" />
      <input name="image_name" type="hidden" value="<?php echo $row->imagename;?>" />
      <input name="image_id" type="hidden" value="<?php echo $row->imageid;?>" />
      <br></td>
    </tr>
   
  <tr>
    <td><strong>Image short description</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $row->shortdesc;?></td>
    </tr>
  
  
  
  <tr>
    <td><strong>Page Link</strong></td>
    <td></td>
  </tr>
   <tr>
     <td colspan="2">&nbsp;</td>
     </tr>
  <tr>
    <td><input type="submit" name="imagedeleteyes" id="button" value="Yes" /></td>
    <td><input type="submit" name="imagedeleteno" id="button" value="No" /></td>
  </tr>
</table>
</form>

 <?php	 
	 break;
}

case 'settings':
	{
       include('settings.php');
	   break;
		}
		
		
		
case 'help':
	{
       include('help.php');
	   break;
	}		
		

		
		
	default :	
	   {
		
    $checkpost = $wpdb->get_results("SELECT * FROM wp_imagegallery ");
		?>	
          <table width="100%" border="0" cellspacing="4" cellpadding="4">
          <tr>
            <td><strong>Thumbnal</strong></td>
            <td><strong>Description</strong></td>
            <td colspan="3"><strong>Actions</strong></td>
          </tr>
			
<?php foreach($checkpost as $checkposts){?>
<tr>
<td width="18%"><img src="<?=get_bloginfo('wpurl')?>/wp-content/plugins/nabz-image-gallery/images/<?php echo $checkposts->thumbname?>"/></td>
<td valign="top" width="44%"><?php echo $checkposts->shortdesc?></td>
<td valign="bottom"><a href="<?php echo $base_url?>?page=image-gallery.php&option=edit&img_id=<?php echo $checkposts->imageid ?>" class="current"><strong>Edit Image</strong></a></td>
<td valign="bottom"><a href="<?php echo $base_url?>?page=image-gallery.php&option=delete&img_id=<?php echo $checkposts->imageid ?>" class="current"><strong>Delete Image</strong></a></td>
</tr>
<?php }?>
</table>
<?php break;
	   }
	}
	?>
</td> </tr>   
</table>
</div>