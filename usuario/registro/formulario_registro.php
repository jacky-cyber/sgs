<?php
$paterno = $_POST['paterno'];
$materno = $_POST['materno'];


include("comuna_select/comuna_select.php");

$select_regiones = generaRegion();
 

$js .="<script type=\"text/javascript\" src=\"comuna_select/js/select_dependientes.js\"></script>";





switch ($msj) {
     case 1:
     	$cuenta_de_correo_ya_utlizada=html_template('cuenta_de_correo_ya_utlizada');	
        $mensaje = "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr >
                 <td align=\"center\" class=\"textos\">
				 $cuenta_de_correo_ya_utlizada
				  </td>
                  </tr>
            	</table>";
				$login = "";
				$mensaje = cuadro_rojo($mensaje);
         break;
	 case 2:
	 $cuenta_de_correo_ya_utlizada=html_template('cuenta_de_correo_ya_utlizada');	
          $mensaje = "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr >
                  <td align=\"center\" class=\"textos\"> $cuenta_de_correo_ya_utlizada
				  </td>
                  </tr>
            	</table>";
				$mensaje = cuadro_rojo($mensaje);
				
				$email = "";
         break;
	  case 3:

	     	 
   	default:
	   $def ="ok";
	 
       
 }





$accion_form = "index.php?accion=$accion&act=1";


	include("usuario/registro/formulario.php");
	//$login_chileatiende= html_template('registro_help');
	$login_chileatiende= html_template('texto registro');
	
	$contenido = $mensaje .$contenido;
?>