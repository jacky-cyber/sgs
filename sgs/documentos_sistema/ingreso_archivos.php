<?php

$folio = $_POST['fol'];
$existe_carpeta = is_dir("chileatiende/documentos_sistema/docs/$folio/");
if(!$existe_carpeta){
	mkdir("chileatiende/documentos_sistema/docs/$folio/",0777);
	$path = "chileatiende/documentos_sistema/docs/$folio/";
}
else{
	$path = "chileatiende/documentos_sistema/docs/$folio/";
}

	//$valid_formats = array(configuracion_cms('formato_permitido'));
	
	/*
	$formato_per=configuracion_cms("formato_permitido");
	$formato_per=str_replace("'","\"",$formato_per2);
	
	$valid_formats = array($formato_per);
	//$valid_formats = array("txt","gif","doc","xls","pdf","docx","jpeg","jpg");
	*/
	
	$formato_per=configuracion_cms("formato_permitido");	
	$valid_formats = explode(",",$formato_per);
	
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
	{
			
		$name = $_FILES["archivodoc"]["name"];
		$size = $_FILES["archivodoc"]["size"];

		if(strlen($name)&& $_POST["tipo_documento"]!="")
		{
			list($txt, $ext) = explode(".", $name);
			if(in_array($ext,$valid_formats))
			{
				$name = str_replace(" ","_",$txt);
				$name = $name.".".$ext;
				$obs=$_POST["observacion_adjunto"];
				$tipo_doc=$_POST["tipo_documento"];
				$documento_origen = $_POST['docto'];
				$qry_insert="INSERT INTO sgs_solicitudes_documentos (folio,archivo_solicitudes_doc,id_usuario,observacion_solicitudes_doc,id_solicitud_documentos_tipo,id_archivo_origen) VALUES ('$folio','$name',$id_usuario,'$obs','$tipo_doc','$documento_origen')";
				$result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
				$ingreso = mysql_insert_id();
				$query="SELECT MAX( id_solicitudes_doc) 
						FROM sgs_solicitudes_documentos WHERE folio='$folio'";
				$result_select= cms_query($query)or die (error($query,mysql_error(),$php));
				list($id_sol) = mysql_fetch_row($result_select);
				mkdir("chileatiende/documentos_sistema/docs/$folio/$id_sol/",0777);
				$path = "chileatiende/documentos_sistema/docs/$folio/$id_sol/";
				//$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
				$tmp = $_FILES['archivodoc']['tmp_name'];
				copy($tmp, $path.$name);
				
				// Historial	
				$fecha = new DateTime();
				$fecha = $fecha->format('Y-m-d');
				
				
				$query="SELECT archivo_solicitudes_doc
						FROM sgs_solicitudes_documentos WHERE id_solicitudes_doc='$ingreso'";
				$result_select= cms_query($query)or die (error($query,mysql_error(),$php));
				list($nombre_archivo) = mysql_fetch_row($result_select);
				/*
				$observacionzz = "<a href=\"index.php?accion=$accion&act=4&iddoc=$ingreso&folio=$folio&axj=1&nombrearchivo=$nombre_archivo\" target=\"_blank\">
				$nombre_archivo</a>";
				*/
				$observacion = "<a href=\"index.php?accion=$accion&act=4&iddoc=$ingreso&folio=$folio&axj=1\" target=\"_blank\">
				$nombre_archivo</a>";
				//$observacion = stripslashes($observacion);
				$qry_insert = "INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion)
						values ('$folio','$id_estado_solicitud','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
				
				$result_insert = cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
				// Historial
				
				header("Location:index.php?accion=$accion&act=1&folio=$folio");
			}
			else{
				echo "Formato Inv&aacute;lido";	
			}
		}else{
			echo "<h3>Por favor seleccione un archivo</h3>";
		}
		exit;
	}
		
?>