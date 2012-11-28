<?php


$act_f = $_GET['act_f'];

$op = $_GET['op'];

$accion_galeria=7;




$tamanio_image =160;

if(!is_numeric($accion)){

$accion = traduce_accion($accion);
}



$contenido_estatico = "contenido_estatico_$accion";
if(!isset($_SESSION[$contenido_estatico]) ){
    session_register_cms($contenido_estatico);
}

/*
if($_SESSION[$contenido_estatico]==""){
    
}else{
  $contenido .= $_SESSION[$contenido_estatico];  
    
}*/











      
      
      
      	$d_acciones_estatico = new db(1); 	  
	$query_acciones="SELECT id_acc   
           FROM  acciones 
           WHERE accion='$accion'";
           
	$data_acciones_estatico = $d_acciones_estatico->fetch($query_acciones, 7200,'estatico_'.$id_acc);
	
	list($id_acc) = current($data_acciones_estatico);
		
	  


/*$query= "SELECT id_contenido
           FROM  accion_etiqueta
           WHERE accion='$id_acc' and etiqueta ='CONTENIDO'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_contenido) = mysql_fetch_row($result);*/

	$d_accion_etiqueta = new db(1);
	$query_accion_etiqueta= "SELECT id_contenido
           FROM  accion_etiqueta
           WHERE accion='$id_acc' and etiqueta ='CONTENIDO'";
	 
	$data_accion_etiqueta = $d_accion_etiqueta->fetch($query_accion_etiqueta, 7200,'etiqueta_'.$id_acc);
	list($id_contenido) = current($data_accion_etiqueta);
/*
        $query_accion_etiqueta= "SELECT id_contenido
           FROM  accion_etiqueta
           WHERE accion='$id_acc' and etiqueta ='CONTENIDO'";
	 $id_contenido = cache_mysql_solo_un_valor($query_accion_etiqueta,'rr_'.$id_acc);
*/	 
	 

/*$query = "SELECT contenido,click
          FROM noticias 
          WHERE id_noticia='$id_contenido'";
$resultado = cms_query($query) or die ("problemas en la consulta 1.2<br>$query");
list($contenido2,$click) = mysql_fetch_row($resultado);*/
   
   $d_noticias = new db(1);
   $query_contenido_noticias = "SELECT contenido,click
          FROM noticias 
          WHERE id_noticia='$id_contenido'";
	$data_noticias = $d_noticias->fetch($query_contenido_noticias, 7200,'noticia_'.$id_acc);
	list($contenido2,$click) = current($data_noticias);
   

 
/*
   $click++;
			$Sql ="UPDATE noticias 	
                    	   SET id_user ='$id_usuario',click='$click'
                    	   WHERE id_noticia='$id_contenido'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
*/					
  


$contenido .="$contenido2";

$_SESSION[$contenido_estatico]=$contenido2;
 
 //include("deuman/agranda_texto/agranda_texto.php"); 

 if($_GET['tp']==1){
    
    $contenido .="<div class=\"alert alert-warnnig\">Contenido Estatico $id_contenido contenido/contenido_estatico.php</div>";
    
 }

?>