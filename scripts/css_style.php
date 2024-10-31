<?php
if (!function_exists('add_action'))
{
    require_once("../../../../wp-config.php");
	
}

$GalleryOptions = get_option('image_gallery_options');

?>

<style type="text/css">
<!--
#popup {
	position:absolute;
	width:642px;
	height:<?=$GalleryOptions['GalleryHeight']?>px;
	z-index:1;
	left: 211px;
	top: 26px;
	background: #ddd;
}
#fade {
	background:white;
	position:fixed;
	width: 100%;
	height: 100%;
	filter:alpha(opacity=80);
	opacity: .80;
	-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)"; /*--IE 8 Transparency--*/
	left: 0;
	top: 0;
	z-index: 10;
}


#hideshow {
    margin-top:<?=$GalleryOptions['PopupTop']?>px;
	margin-left:<?=$GalleryOptions['PopupLeft']?>px;
	position: absolute;
	width: 100%;
	height: 100%;
	top: 0;
	left: 0;
	
}
.popup_block {
	background: #ddd;
	padding: 10px 20px;
	border: 1px solid #000;
	float: left;
	width: <?=$GalleryOptions['GalleryWidth']?>px;

	top: 20%;
	left: 50%;
	margin: 0 0 0 -210px;
	z-index: 100;
}
.popup_block .popup {
	float: left;
	width: 100%;
	background: #fff;
	margin: 10px 0;
	padding: 10px 0;
	border: 1px solid #bbb;
}

.popup h3 {

}
.popup p {
	padding: 5px 10px;
	margin: 5px 0;
}
.popup img.cntrl {
	position: absolute;
	right: -20px;
	top: -20px;
}
*html #fade {
	position: absolute;

	top:expression(eval(document.compatMode &&
	document.compatMode=='CSS1Compat') ?
	documentElement.scrollTop
	: document.body.scrollTop);
}
*html .popup_block {
	position: absolute;

	top:expression(eval(document.compatMode &&
	document.compatMode=='CSS1Compat') ?
	documentElement.scrollTop
	+((documentElement.clientHeight-this.clientHeight)/2)
	: document.body.scrollTop
	+((document.body.clientHeight-this.clientHeight)/2));

	left:expression(eval(document.compatMode &&
	document.compatMode=='CSS1Compat') ?
	documentElement.scrollLeft
	+ (document.body.clientWidth /2 )
	: document.body.scrollLeft
	+ (document.body.offsetWidth /2 ));
}

#container{
	width:<?=$GalleryOptions['GalleryWidth']?>px;
	height:<?=$GalleryOptions['GalleryHeight']?>px;
	z-index:1;
	left: 240px;
	top: 293px;
	 bgcolor="#000"
}


#large_image {

	background-color:#<?=$GalleryOptions['GalleryBgColor']?>;
	width:<?=$GalleryOptions['GalleryWidth']?>px;
	height:<?=$GalleryOptions['GalleryHeight']?>px;
	z-index:1;
	left: 240px;
	top: 293px;
}








<!-- tooltip css ends here !>






-->
</style>