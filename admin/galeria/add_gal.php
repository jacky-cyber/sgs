<?php


$imagen_name= $HTTP_POST_FILES['imagen']['name'];
$imagen= $HTTP_POST_FILES['imagen']['tmp_name'];


$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$id_grupo_galeria = $_POST['id_grupo_galeria'];


$id_cliente=1;


$fecha=  date(y)."-".date(m)."-".date(d);

       $id_galeria = new_uid();

	   
	   $id_contenido=$id_galeria;
	   
	    include("lib/guarda_cuadro_perfiles.php");
	   											  
               $qry_insert="INSERT INTO galerias  (id_cliente,id_galeria,nombre,descripcion,fecha,imagen,id_grupo_galeria)
                            VALUES ('$id_cliente','$id_galeria','$nombre','$descripcion','$fecha','$imagen_name','$id_grupo_galeria')";
				//echo $qry_insert;
          $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");


			if(is_dir("$fuente_relativa/$id_cliente")){
					mkdir("$fuente_relativa/$id_cliente/$id_galeria",0777);	
			        chmod("$fuente_relativa/$id_cliente/$id_galeria",0777);

			}else{

					mkdir("$fuente_relativa/$id_cliente",0777);	
			        chmod("$fuente_relativa/$id_cliente",0777);

							mkdir("$fuente_relativa/$id_cliente/$id_galeria",0777);	
			                chmod("$fuente_relativa/$id_cliente/$id_galeria",0777);

			}

		           if (isset($imagen)){

                      $imagen2 = ereg_replace('&','*',$imagen_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);

					   if (!copy($imagen, "$fuente_relativa/$id_cliente/$id_galeria/$imagen2"))
						     {

					         echo "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         echo "La imagen chica no exixte o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name";

					         }else{
							 $file="$imagen2";
							 $destino="$fuente_relativa/$id_cliente/$id_galeria";
							 resize($file,700,$destino);
							 }
                      }


header("HTTP/1.0 307 Temporary redirect");
header("Location:index.php?accion=$accion");
					  
					  
?>