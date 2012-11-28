<?php
 $id_galeria = $_GET['id_galeria'];
 
 $fecha= date(y)."-".date(m)."-".date(d);
 

 
 
 
 $boton_eliminar = $_POST['boton_eliminar'];
 if($boton_eliminar!=""){
 
 
  
	  $query= "SELECT id_imagen,imagen1,id_cliente 
               FROM  imagenes
			   where id_galeria=$id_galeria";
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_imagen,$imagen1,$id_cliente) = mysql_fetch_row($result2)){
		  	$nombre_check= str_replace(".","_",$imagen1);
			
			if($_POST[$nombre_check]){
		  		if(is_file("$fuente_relativa/$id_cliente/$id_galeria/$imagen1")){
				if(unlink("$fuente_relativa/$id_cliente/$id_galeria/$imagen1")){
				 $Sql ="DELETE FROM imagenes where id_imagen=$id_imagen";

 cms_query($Sql);
		  
				
				}
				}else{
				$Sql ="DELETE FROM imagenes where id_imagen=$id_imagen";

 cms_query($Sql);
		  
				}
		  		
				
			}
			

		  }

		  
		  header("HTTP/1.0 307 Temporary redirect");
          header("Location:index.php?accion=$accion&act=3&id_galeria=$id_galeria");

 }
 
	  $query= "SELECT id_cliente 
               FROM  imagenes
			   where id_galeria=$id_galeria";
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_cliente) = mysql_fetch_row($result2);
 
$id_cliente=1;
while($a<6){
  $a++;
  $var="file$a";
  
 
	 if($HTTP_POST_FILES[$var]['name']){
			
	//echo "gogogog";

 
$imagen_name= $HTTP_POST_FILES[$var]['name'];
$imagen= $HTTP_POST_FILES[$var]['tmp_name'];
			
	   if (isset($imagen)){
                      $imagen2 = ereg_replace('&','*',$imagen_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);
					   $query= "SELECT id_imagen  
           						FROM  imagenes
           						WHERE imagen1='$imagen_name' and id_galeria='$id_galeria'";
     					$result= cms_query($query)or die (error($query,mysql_error(),$php));
    					  if (!list($id_img) = mysql_fetch_row($result)){
						   
						
					  
					      if (!copy($imagen, "$fuente_relativa/$id_cliente/$id_galeria/$imagen2"))
					         {
					         $contenido .= "Fallo, La imagen chica no se a podido subir al servidor. <br>
							 La imagen chica no exixte o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name";
					         }else{
							 
							 $qry_insert="INSERT INTO imagenes (id_imagen ,imagen1,id_cliente,fecha_clasificacion, id_galeria  ) 
							  values ('' ,'$imagen2','$id_cliente','$fecha','$id_galeria')";
                  
                             $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
							 
							 
							
							 $file="$imagen2";
							 $destino="$fuente_relativa/$id_cliente/$id_galeria/";
							 resize($file,700,$destino);
							
							 
							 
							 
							 }
							 
						}
					
                      }	
	
     }

}

header("HTTP/1.0 307 Temporary redirect");
          header("Location:index.php?accion=$accion&act=3&id_galeria=$id_galeria");
?>