
function createObject() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
	request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		request_type = new XMLHttpRequest();
	}
		return request_type;
 }

<!-- wordpress gellery starts -->

function thumbnail_next(url,row,perpage){
   var http = createObject();
	var counter = parseInt(document.getElementById('counter').value);
	
	if(counter >= row){
			document.getElementById('counter').value = 1;
			}else{
			        document.getElementById('counter').value = counter+3;
			}
	counter = document.getElementById('counter').value;
	http.open('post',url+'?nxt='+counter, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function()
	   {
		if(http.readyState < 4)
		  {
			var loading='<table width="100%" border="0" cellspacing="4" cellpadding="4" width="100%" height="100%"><tr>'   
			for(var i =0;i<perpage;i++){
loading=loading+'<td align="center" valign="middle" colspan="'+perpage+'"><img src="http://localhost/wordpress//wp-content/plugins/image-gallery/images/loading.gif"/></td>';
			}
			loading=loading+'</tr></table>';
		    document.getElementById("thumbnails").innerHTML=loading;
			} 
		   
		   
	     if(http.readyState == 4)
		     {
			document.getElementById("thumbnails").innerHTML= http.responseText;				 
 		     }
	 }
  http.send(null);

}


function thumbnail_previous(url,row,perpage){
   var http = createObject();
	
	var counter = parseInt(document.getElementById('counter').value);
		
		if(counter <= 0){
			document.getElementById('counter').value = row;
			}else{
			document.getElementById('counter').value = counter-3;
			}
   counter = document.getElementById('counter').value;
	
	http.open('post',url+'?prv='+counter, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function()
	   {
		 if(http.readyState < 4)
		  {
			var loading='<table width="100%" border="0" cellspacing="4" cellpadding="4" width="100%" height="100%"><tr>'   
			for(var i =0;i<perpage;i++){
loading=loading+'<td align="center" valign="middle" colspan="'+perpage+'"><img src="http://localhost/wordpress//wp-content/plugins/image-gallery/images/loading.gif"/></td>';
			}
			loading=loading+'</tr></table>';
		    document.getElementById("thumbnails").innerHTML=loading;
			}  
		   
		   
	     if(http.readyState == 4)
		     {
			document.getElementById("thumbnails").innerHTML= http.responseText;				 
//document.getElementById("image_content").innerHTML='<img src="'+base_url+'images/'+ http.responseText+'" width="528" height="300" alt="No Image" />';
	        //alert(http.responseText);
			  //alert(imagecount);
 		     }
	 }
  http.send(null);

}


function setimage(id){

    var http = createObject();
	//var url = document.getElementById('baseurl').value;
	http.open('post','http://localhost/wordpress/wp-content/plugins/image-gallery/scripts/setimage.php?id=' + id, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function()
	   {
		 if(http.readyState < 4)
		    {
				document.getElementById("large_image").innerHTML='<table width="100%" border="0" cellspacing="4" cellpadding="4" width="100%" height="100%"><tr><td align="center" valign="middle"><img src="http://localhost/wordpress//wp-content/plugins/image-gallery/images/loading.gif"/></td></tr></table>';
						
			}  
		   
		   
	     if(http.readyState == 4)
		     {
			   document.getElementById("large_image").innerHTML=http.responseText;
 		     }
	 }
  http.send(null);

}





function show_popup(id,position){
document.getElementById("hideshow").style.visibility = "visible";
document.getElementById('position').value=position;
var url = document.getElementById('baseurl').value;
    var http = createObject();
	 
	
	http.open('post',url+'/wp-content/plugins/image-gallery/scripts/setimage.php?id=' + id, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function()
	   {
		 if(http.readyState < 4)
		    {
			document.getElementById("container").innerHTML='<table width="100%" border="0" cellspacing="4" cellpadding="4" width="100%" height="100%"><tr><td align="center" valign="middle"><img src="'+ url +'/wp-content/plugins/image-gallery/images/loading.gif"/></td></tr></table>';
			}  

	     if(http.readyState == 4)
		     {
				document.getElementById("container").innerHTML=http.responseText;
	         }
	 }
  http.send(null);
}


function hide_popup(){
document.getElementById("hideshow").style.visibility = "hidden";
}






function popup_next(max_row,url){
    var http = createObject();
	var pos=document.getElementById('position').value;
   if( parseInt(pos)>= parseInt(max_row))
	  {
		  document.getElementById('position').value=0;
		  pos=1;
	  }
	
	http.open('post',url+'/wp-content/plugins/image-gallery/scripts/popup.php?nxt='+pos, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function()
	   {
		if(http.readyState < 4)
		  {
			 // '+ url +'/wp-content/plugins/image-gallery/images/
		document.getElementById("container").innerHTML='<table width="100%" border="0" cellspacing="4" cellpadding="4" width="100%" height="100%"><tr><td align="center" valign="middle"><img src="'+ url +'/wp-content/plugins/image-gallery/images/loading.gif"/></td></tr></table>';
		  } 
		   
		   
	     if(http.readyState == 4)
		     {
			   document.getElementById("container").innerHTML= http.responseText;	
			//alert(http.responseText);
			document.getElementById('position').value= parseInt(pos)+1;
 		     }
	 }
  http.send(null);
	

}

function popup_previous(max_row,url){
    var http = createObject();
	var pos=document.getElementById('position').value;
	//pos=pos-1;
   if( parseInt(pos)<0)
	  {
		  document.getElementById('position').value=max_row;
		  pos=max_row;
	  }
	
	http.open('post',url+'/wp-content/plugins/image-gallery/scripts/popup.php?prv='+pos, true);
	http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	http.onreadystatechange = function()
	   {
		if(http.readyState < 4)
		  {
		
			document.getElementById("container").innerHTML='<table width="100%" border="0" cellspacing="4" cellpadding="4" width="100%" height="100%"><tr><td align="center" valign="middle"><img src="'+ url +'/wp-content/plugins/image-gallery/images/loading.gif"/></td></tr></table>';
			} 
		   
		   
	     if(http.readyState == 4)
		     {
			   document.getElementById("container").innerHTML= http.responseText;	
			   document.getElementById('position').value= parseInt(pos)-1;
 		     }
	 }
  http.send(null);
	

}






<!-- wordpress gellery ends -->

























   
