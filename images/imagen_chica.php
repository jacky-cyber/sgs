<?php
header("Content-type: image/jpeg");


$tamanio_image= $_GET['tamanio_image'];
$id_contenido = $_GET['id_contenido'];
$carpeta = $_GET['carpeta'];
$filename = $_GET['imagen'];	


define(thumbnailWidth, "$tamanio_image");    
   header("Content-type: image/jpeg");
  // $filename = $_GET["filename"];   
     
	 
	 if(is_file("sitio/$carpeta/".$filename)){
	 $imagen="sitio/$carpeta/".$filename;
	 }else{
	 $imagen="sin_imagen.jpg";
	 }
	 
	 
   $source = imagecreatefromjpeg($imagen);  
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