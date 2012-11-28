<?php
include("config_gal.php");
header("Content-type: image/jpeg");




$tamanio_image= $_GET['tamanio_image'];
$id_cliente= $_GET['id_cliente'];
$filename = $_GET['filename'];
$id_galeria = $_GET['id_galeria'];

//echo "gal/$id_cliente/$id_galeria/$filename";

define(thumbnailWidth, "$tamanio_image");    

   header("Content-type: image/jpeg");

/*
if(file_exists("$id_cliente/$id_galeria/$filename")){
usleep(100);
$source = imagecreatefromjpeg("/$id_cliente/$id_galeria/$filename");  

}else{
  echo "$id_cliente/$id_galeria/$filename";

//$source = imagecreatefromjpeg("../images/contenido_r1_c1.jpg");  

}
   

    */
 
  usleep(100);
  $source = imagecreatefromjpeg("$fuente/$id_cliente/$id_galeria/$filename");  
 
 
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