<?php
//session_start();
session_register_cms('id_preg');
	$id_preg =  $_SESSION['id_preg'];
	


$id_entidad_padre_origen = $_POST['id_entidad_padre_origen'];



switch ($act) {
     case 1:
       //  include ("sgs/ingreso_manual/asistencia.php");
	   include ("sgs/ingreso_manual/formulario_acceso.php");
         break;
	 case 2:
	     $accion_form = "index.php?accion=$accion&act=4";
	 	 include ("personal/proc/consulta.php");
	     include ("sgs/ingreso_manual/formulario_acceso.php");

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
   
		
   			
			
				$fol=$_POST['folio'];
        	    $query= "SELECT id_solicitud_acceso  
                       FROM  sgs_solicitud_acceso
                       WHERE folio ='$fol'";
		      // echo $query;
                 $result_acc= cms_query($query)or die (error($query,mysql_error(),$php));
                 if (!list($id_solicitud_acceso) = mysql_fetch_row($result_acc)){
			//echo "sdfdsf";
			
			$_POST['folio'] =$fol;

			include ("sgs/ingreso_manual/ingreso_solicitud.php");  
			
			include("sgs/ingreso_manual/dar_aviso_signador.php");
			
			// header("Location:index.php?accion=$accion&act=5&foilio=$fol");
	
			          						   
            	 }else{
			echo  "<script>alert('Este folio ya existe en nuestra base de datos.'); document.location.href='index.php?accion=$accion'; </script>\n";
					 
					
		 	}
			
			
			
				 
				 
			
         break;
   case 5:
   			 include ("sgs/ingreso_manual/comprobante_solicitud.php");		 
				

         break;
		 
		 
	 case 6:
   			
			 $contenido = html_template('gracias_ingreso_manual');	 
					

         break;
		 
	 case 7:
	 
	            $fol = $_GET['fol'];
				$radioOculto = $_GET['radioOculto'];
   				
				if(verifica_folio($fol,$radioOculto)=="ok"){
					$contenido = "";
					
				}else{
					$contenido = verifica_folio ($fol,$radioOculto);	
					$contenido.="
					<script>
						document.form1.folio.value = '';
					</script>
					";
				}
					

         break;
		 
		 
		 
   	default:
	 
	     $accion_form = "index.php?accion=$accion&act=4";
	 	
	 include ("sgs/ingreso_manual/formulario_acceso.php");
       
 }

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