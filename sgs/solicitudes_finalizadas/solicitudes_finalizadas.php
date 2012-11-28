<?php
session_register_cms('ver_archivadas');

//echo "<br>act:".$act;
switch ($act) {
     case 1:
	         $url=$_SERVER['REQUEST_URI'];
			 $url= str_replace("&axj=1","",$url);
			 $url= $url."&axj=1&p=1";
	 		 //$print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"MM_openBrWindow('$url','','scrollbars=yes,width=650,height=820')\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";
       		 $folio = $_GET['folio'];
			 $print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"window.open('index.php?accion=$accion&act=13&folio=$folio&axj=1&p=1','ventana','width=800,height=800,resizable=no');\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";
			 
        
	 	 $accion_form = "index.php?accion=$accion&act=2";
         include ("sgs/solicitudes_finalizadas/admin_solicitudes_ver.php");
		 
		 /*************************************************/
			include("sgs/opcionales/opcionales.php");
		 /*************************************************/
		
         break;
     case 2:
        $observacion_reactivar = $_POST['observacion_reactivar'];
		//echo "<br>reactivar:".$reactivar;
		if ($observacion_reactivar!=""){
			//echo "<br>reactivar".$reactivar;
			$folio = $_POST['folio'];
			$id_usuario = id_usuario($id_sesion);
			Reactivar_solicitud($folio,$id_usuario,$observacion_reactivar);
		}
		header("Location:index.php?accion=$accion");
        break;
    case 3:
	$folio = $_GET['folio'];
	//<a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" >$grupo_productos</a>
			$Sql ="UPDATE sgs_solicitud_acceso
            	   SET archivada ='1'
            	   WHERE folio ='$folio'";
            				  
            	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
	
        $contenido = "<div onclick=\"click_des_archivar();\"  class=\"tabla_amarillo_sin_ico\" style=\"width:120px; padding:1px; text-align:center; cursor: pointer;  cursor: hand;\">
						Solicitud Archivada</div>";
        break;
   case 4:
   $folio = $_GET['folio'];
   $Sql ="UPDATE sgs_solicitud_acceso
            	   SET archivada ='0'
            	   WHERE folio ='$folio'";
            				  
            	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
	
        $contenido = "<div onclick=\"click_archivar();\" class=\"tabla_verde_sin_ico\" style=\"width:120px; padding:1px; margin:0; text-align:center; cursor: pointer;  cursor: hand;\">
		Archivar esta solicitud</div>";
        break;
  
  case 5:
  
  			if($_SESSION['ver_archivadas']==1){
			$_SESSION['ver_archivadas']=0;
			}else{
			$_SESSION['ver_archivadas']=1;
			}
  			

            header("Location:index.php?accion=$accion");
  
         break;
  case 6 :
  		include("sgs/solicitudes_finalizadas/listado.php");	
  break;
  case 9:
		include ("sgs/documentos_sistema/descarga.php");
  break;
	case 13:
		include ("sgs/admin_solicitudes/detalle_solicitud_imprimir.php");
		break;
   	default:
	include("sgs/solicitudes_finalizadas/pantalla_ini.php"); 
       
 }


?>