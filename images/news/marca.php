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

//echo $img_original ."dfsfsdfdsf";



$img_marcadeagua ="logo/logo.png";

$calidad =70;



if (file_exists($img_original)){



    $info_original = getimagesize($img_original);

}else{



    $info_original = getimagesize("../images/sin_image.jpg");

}







    $anchura_original = $info_original[0];

    $altura_original = $info_original[1];

   // obtener datos de la "marca de agua"
/*
    $info_marcadeagua = getimagesize($img_marcadeagua);

    $anchura_marcadeagua = $info_marcadeagua[0];

    $altura_marcadeagua = $info_marcadeagua[1];

 // calcular la posición donde debe copiarse la "marca de agua" en la fotografia



    $horizextra = $anchura_original - $anchura_marcadeagua;

    $vertextra = $altura_original - $altura_marcadeagua;

    $horizmargen =  round($horizextra / 1);

    $vertmargen =  round($vertextra / 1);

*/

    // crear imagen desde el original

	

	if (file_exists($img_original)){

        $original = ImageCreateFromJPEG($img_original);

        }else{

       $original = ImageCreateFromJPEG("../images/sin_image.jpg");

     }


/*
    ImageAlphaBlending($original, true);

   // crear nueva imagen desde la marca de agua

   
   
   // copiar la "marca de agua" en la fotografia

    ImageCopy($original, $marcadeagua, $horizmargen, 0, 0, 0, $anchura_marcadeagua,$altura_marcadeagua);

   // guardar la nueva imagen

  
*/
 
  ImageJPEG($original,'',$calidad);


   // cerrar las imágenes

  ImageDestroy($original);
//////////////
  // ImageDestroy($marcadeagua);



?>