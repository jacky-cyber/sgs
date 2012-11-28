<?php

session_start();

	
if(configuracion_cms('usar_captcha')==1){
 if( $_SERVER['HTTP_USER_AGENT'] !="" and  $_SERVER['HTTP_REFERER'] !=""){
   
	  /*
	  * Select tabla deuman_gente_online
	  * 
	 */
	 $query= "SELECT id_gente_online  
		    FROM  deuman_gente_online
		    WHERE session = '$id_sesion'";
	      $result_deuman_gente_online= cms_query($query)or die (error($query,mysql_error(),$php));
	       if(list($id_gente_online) = mysql_fetch_row($result_deuman_gente_online)){
			/////
			  		    
			  include("captcha/securimage.php");
			  $img = new Securimage();
			  $valid = $img->check($_POST['texto_ingresado']);
				$captcha_ok=0;
				
			  if($valid == true) {
			    $captcha_ok = 1;
				exit("1");
			  }else{
				exit("0");
			  }
	 
		 }else{
		    exit("0");
	   
		 }
		 
		  
		 
		 	
		 
	   
 }else{
    exit("0");
  
 }
}else{
	$captcha_ok = 1;
}
 
  
?>
