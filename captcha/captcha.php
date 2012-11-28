<?php
/*
include("../lib/lib.inc.php");  
include("../lib/connect_db.inc.php");    

session_start();
*/


$template="usar_captcha";


   $configuracion_capt =configuracion_cms($template);
	
	$valor= "1";
	$tabla = "cms_configuracion";
	$publico = 1;
	if($configuracion_capt=="$template no existe"){
			
			$_POST['configuracion']="$template";
			$_POST['valor']=$valor;
			$_POST['descripcion']="Desplegar Captcha en modulos que hagan uso de este";
			 
			$_POST['publico']=$publico;
			inserta($tabla);
		
		}

		

if(configuracion_cms("usar_captcha")==1){
if($_GET['capt']=="err"){

   $msg_captcha= "Lo sentimos ingresa nuevamente el texto de validaci&oacute;n";

}
	$var_seg= md5(uniqid(time()));
	
	/*$captcha_form = "  <table  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr><td align=\"center\" class=\"textos_rojo\" colspan=\"2\"> $msg_captcha </td></tr> 
				   <tr><td align=\"center\" class=\"textos\" colspan=\"2\"> Texto de Validaci&oacute;n</td></tr> 
				   <tr >
                       <td align=\"center\" class=\"textos\" colspan=\"2\">
					     <table   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                           <tr>
                             <td align=\"center\" class=\"textos\">
							$captcha_form
							 </td>
                             <td align=\"center\" class=\"textos\">
							  <a href=\"#captcha\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('captcha/refresh.php','captcha');\">
                        <img src=\"captcha/images/refresh.gif\" alt=\"Renovar Imagen\" border=\"0\" >
                        </a>
							 </td>
                             </tr>
                       	</table>
					   </td>
                      </tr>
				    <tr >
                      <td align=\"center\" class=\"textos\">Ingrese el texto de la imagen</td>
                      <td align=\"center\" class=\"textos\"><input type=\"text\" name=\"texto_ingresado\"></td>
                      </tr>
                	
                	</table>";*/
					$imagen = "<div id=\"captcha\"  >
								<img style=\"float: left;	display: block\" src=\"captcha/securimage_show.php?sid=$var_seg\" alt=\"img\" border=\"0\">
					  		 </div>
							 <a href=\"#captcha\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('captcha/refresh.php','captcha');\">
                        			<img src=\"captcha/images/refresh.gif\"  style=\"float: left; display: block\" alt=\"Renovar Imagen\" border=\"0\" >
                        	 </a>";
					$texto_ingresado ="<input type=\"text\" id=\"texto_ingresado\" style=\"text-transform: uppercase;\"  name=\"texto_ingresado\" maxlength=\"4\" />
								<input type=\"hidden\" name=\"$id_sesion\" id=\"$id_sesion\" value=\"1\">";
					$captcha_form = html_template('captcha');
					
					$captcha_form = cms_replace("#IMAGEN#",$imagen,$captcha_form);
					$captcha_form = cms_replace("#TEXTO#",$texto_ingresado,$captcha_form);
					
					
					/*
					$captcha_formX  = "  <td class=\"alt\" >Captcha</td>
        <td colspan=\"2\">  </td>
      </tr>
	  <tr>
        <td class=\"alt\" >Ingrese el texto de la imagen:</td>
        <td >    </td>
      </tr>
	  <tr><td align=\"center\" colspan=\"3\"> $msg_captcha</td></tr> 


					   ";*/
}
					
					

?>