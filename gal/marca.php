<?php

include("../lib/lib.inc");  
include("../lib/connect_db.inc.php");    
include("config_gal.php");


$id_img_p = $_GET['id_img_p'];
$id_cliente = $_GET['id_cliente'];
$id_galeria = $_GET['id_galeria'];

$id_usuario = $_GET['id_usuario'];
$id_tipo = $_GET['id_tipo'];


$tamanio =$_GET['tamanio'];
//echo "hola";

if($click!="no" AND $id_tipo==""){

	 $query= "SELECT click  
                   FROM  imagenes
                   WHERE imagen1='$id_img_p' AND id_galeria  = $id_galeria";
	 //echo "$query";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
       list($click) = mysql_fetch_row($result);

       
}else{
	
	 $query= "SELECT click  
                   FROM  imagenes
                   WHERE imagen1='$id_img_p' ";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
       list($click) = mysql_fetch_row($result);
	
}
     	
		
			$click = $click+1;					   
       
//modificado
$Sql ="UPDATE imagenes 
	   SET click ='$click',  ult_id = '$id_usuario'
	   WHERE imagen1='$id_img_p' AND id_galeria  = '$id_galeria' AND ult_id <> '$id_usuario'";
//fin modificacion

$Sql ="UPDATE imagenes 
	   SET click ='$click',  ult_id = '$id_usuario'
	   WHERE imagen1='$id_img_p' AND id_galeria  = '$id_galeria' ";

//echo $Sql;

 cms_query($Sql)or die (error($query,mysql_error(),$php));


header("Content-type: image/jpeg");


//function marcadeagua($img_original, $img_marcadeagua, $img_nueva, $calidad)
if($id_tipo!=""){
$img_original ="../images/news/$id_img_p";
}else{
$img_original ="$fuente/$id_cliente/$id_galeria/$id_img_p";
//echo "$fuente/$id_cliente/$id_galeria/$id_img_p";
}

//echo $img_original ."dfsfsdfdsf";

$img_marcadeagua ="logo/logo.png";
$calidad =90;

if (file_exists($img_original)){

    $info_original = getimagesize($img_original);
}else{

    $info_original = getimagesize("../images/sin_image.jpg");
}


    $anchura_original = $info_original[0];
    $altura_original = $info_original[1];
   // obtener datos de la "marca de agua"
    $info_marcadeagua = getimagesize($img_marcadeagua);
    $anchura_marcadeagua = $info_marcadeagua[0];
    $altura_marcadeagua = $info_marcadeagua[1];
 // calcular la posición donde debe copiarse la "marca de agua" en la fotografia

    $horizextra = $anchura_original - $anchura_marcadeagua;
    $vertextra = $altura_original - $altura_marcadeagua;
    $horizmargen =  round($horizextra / 1);
    $vertmargen =  round($vertextra / 1);

    // crear imagen desde el original
	
	if (file_exists($img_original)){

       $original = ImageCreateFromJPEG($img_original);
        }else{
       $original = ImageCreateFromJPEG("../images/sin_image.jpg");

      }

    ImageAlphaBlending($original, true);
   // crear nueva imagen desde la marca de agua
    $marcadeagua = ImageCreateFromPNG($img_marcadeagua);
   // copiar la "marca de agua" en la fotografia
    ImageCopy($original, $marcadeagua, $horizmargen, 0, 0, 0, $anchura_marcadeagua,$altura_marcadeagua);
   // guardar la nueva imagen
   ImageJPEG($original,'',$calidad);
   // cerrar las imágenes
   ImageDestroy($original);
   ImageDestroy($marcadeagua);


?>