<?php

header("Content-type: image/jpeg");






$id_noticia = $_GET['id_noticia'];

$foto = $_GET['foto'];


$tamanio =$_GET['tamanio'];

$id_tipo =$_GET['id_tipo'];



//function marcadeagua($img_original, $img_marcadeagua, $img_nueva, $calidad)
/*
if($id_tipo!=""){

$img_original ="../images/news/$id_img_p";

}else{



}
*/
$img_original ="$id_noticia/$foto";
if($tamanio=="") {
$tamanio= 200;
}
//echo $img_original ."dfsfsdfdsf";

$url = $_GET['url'];

$img_original=$url;

$img_marcadeagua ="logo/logo.png";

$calidad =70;

$tamanio_image=120;

define(thumbnailWidth, "$tamanio_image");    
   header("Content-type: image/jpeg");
  // $filename = $_GET["filename"];   
     
	 
	 if(is_file("sitio/$carpeta/".$filename)){
	 $imagen="sitio/$carpeta/".$filename;
	 }else{
	 $imagen="sin_imagen.jpg";
	 }
	 
	 
   $source = imagecreatefromjpeg($url);  
   $thumbX = thumbnailWidth;    
   $imageX = imagesx($source);
   $imageY = imagesy($source);    
   $thumbY = (int)(($thumbX*$imageY) / $imageX );        
   $dest  = imagecreatetruecolor($thumbX, $thumbY);
   imagecopyresampled ($dest, $source, 0, 0, 0, 0, $thumbX, $thumbY, $imageX, $imageY);        
   imagejpeg($dest);
   imagedestroy($dest);
   imagedestroy($source);


?>