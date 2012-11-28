<?php

 $date = date(Y)."-".date(m)."-".date(d);
 $Sql ="DELETE FROM sgs_solicitud_acceso_temp  where fecha_digitacion < '$date' ";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
 

//session_start();
session_register_cms('id_preg');
	$id_preg =  $_SESSION['id_preg'];
	
	/*
	echo $id_usuario;
	 $Sql ="DELETE FROM sgs_solicitud_acceso where id_usuario=$id_usuario and fecha_ingreso='2009-03-18'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	
	*/


session_register_cms('msnj');


switch ($act) {
     case 1:	include ("sgs/solicitudes/ingreso_archivos.php");
                include ("sgs/solicitudes/formulario_acceso.php");
         break;
	 case 2:
	         $accion_form = "index.php?accion=$accion&act=4";
	 	 include ("personal/proc/consulta.php");
	         include ("sgs/solicitudes/formulario_acceso.php");

         break;
   case 3:
        
		$id_p = $_GET['id_p'];
			  $query= "SELECT respuesta_positiva  
                       FROM  sgs_wizard
			           WHERE orden = $id_p";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($respuesta_positiva ) = mysql_fetch_row($result);
		  
		  $contenido = $respuesta_positiva;
		
         break;
   case 4:
        	
			include ("sgs/solicitudes/ingreso_solicitud_temp.php");	
			$_SESSION['hash_temp']= $_POST['hash'];
			$accion_form = "index.php?accion=$accion&act=6";	
			 $paso = "<div align=\"center\">
					<img src=\"images/sitio/sgs/images/paso2.jpg\" alt=\"\" border=\"0\"></div>";
			
			
			
			$contenido = cms_replace("#LOGO_GOBIERNO#","",$contenido);
			
			
         break;
   case 5:
   
			if($_POST['btnguardar']!=""){
				include ("sgs/solicitudes/ingreso_archivos.php");
			}
			$accion_form = "index.php?accion=mis-solicitudes";
   			
			include ("sgs/solicitudes/comprobante_solicitud.php");		 
				
				if($axj==""){
				 $paso = "<div align=\"center\">
					<img src=\"images/sitio/sgs/images/paso3.jpg\" alt=\"\" border=\"0\"></div>";
				
				}
				$contenido =$paso .$contenido;

         break;
   case 6:
   			
			include ("sgs/solicitudes/ingreso_solicitud.php");		
					

         break;
	case 9:
			include ("sgs/documentos_sistema/descarga.php");
		break;	

   	default:
	/*   $_SESSION['id_preg']=0;
	   $contenido = html_template('pantalla_asistencia_solicitud');	
	   $contenido = cms_replace("#LINK_NO_GRACIAS#","?accion=$accion&act=2",$contenido);
	   $contenido = cms_replace("#LINK_SI_GRACIAS#","?accion=$accion&act=1",$contenido);
	 */
	 
	     $accion_form = "index.php?accion=$accion&act=4";
	 	 include ("personal/proc/consulta.php");
	     include ("sgs/solicitudes/formulario_acceso.php");
       $paso = "<div align=\"center\">
					<img src=\"images/sitio/sgs/images/paso1.jpg\" alt=\"\" border=\"0\"></div>";
 }

 $contenido = cms_replace("#PASO#","$paso",$contenido);
 
/*
<img src="images/sitio/sgs/images/logo_gobierno_horizontal.jpg" alt="Gobierno de chile" border="0">
<p>Much&iacute;simas Gracias<br />
<strong>#USUARIO#</strong> <br />
<br />
Usted ha ingresado una consulta dirigida a:<br />
<br />
<strong>#SERVICIO#</strong> <br />

<strong>#ENTIDAD#</strong> <br />
<br />
Su consulta ha sido ingresada con el n&uacute;mero <br />
<br />
<strong>#FOLIO# </strong><br />
<br />
Su solicitud ha sido recibida con fecha:<br />
<strong>#FECHA# </strong><br />
<br />
<br />

<div class="mensaje" id="mensaje"><a  #LINK#><img height="28" alt="" width="27" align="right" border="0" src="images/sitio/sgs/img/imprimir.gif" />Imprimir</a></div>

* 
* 
* 
* 
* 
*/

?>