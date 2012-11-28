<?php

$imagen_del = $_GET['imagen_del'];
$id_galeria_d = $_GET['id_galeria_d'];
$id_cliente_d = $_GET['id_cliente_d'];


$razon = $_POST['razon'];


switch ($act) {
     case 1:
         include ("gal/envia_peti.php");
         break;
	   	default:
	   $def ="ok";
	 

if($id_usuario!="0"){

$link ="gal/imagen_chica_gal.php?filename=$imagen_del&id_cliente=$id_cliente_d&id_galeria=$id_galeria_d&tamanio_image=350";
		           

$accion_form = "index.php?id_usuario=$id_usuario&user=$user&accion=$accion&act=1&filename=$imagen_del&id_cliente=$id_cliente_d&id_galeria=$id_galeria_d";


$contenido = "<table width=\"70%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                 <tr>
                   <td align=\"center\" class=\"textos\"><b>Deseas borrar esta foto $nombre?</b> </td>
                 </tr>
               <tr>
			    <tr><td align=\"center\" class=\"textos\" height=\"10\"></td>
				 </tr> 
                   <td align=\"left\" class=\"textos\">
				   Para hacerlo debes argumentar tu razón, si es razonable y justa 
				   la borraremos de nuestros registros.<br><br>

				   Ten en cuenta de que no aceptaremos como razón valida cosas como: 
				   no me gusta como salgo o cosas por el estilo ok…<br><br>

				   Y también ten en cuenta que guardaremos un registro de las 
				   peticiones hechas por ti.
					</td>
                 </tr>
				  <tr><td align=\"center\" class=\"textos\" height=\"10\"></td>
				 </tr> 
				 <tr><td align=\"center\" class=\"textos\">
				 	Razon por la cual quiero borrar la foto:</td>
				 </tr> 
				  <tr><td align=\"center\" class=\"textos\" height=\"10\">
				 	
				 </td>
				 </tr>
				 <tr><td align=\"center\" class=\"textos\">
				 	<textarea name=\"razon\" cols=\"60\" rows=\"10\" class=\"textos\"></textarea>
				 </td>
				 </tr>
				 
				 <tr><td align=\"center\" class=\"textos\" height=\"10\"></td>
				 </tr> 
				 <tr>
				 <td align=\"center\" class=\"textos\">
				   <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                     <tr>
                       <td align=\"center\" class=\"textos\">
					   <input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\"></td>
                       <td align=\"center\" class=\"textos\">
					   <A HREF=\"#\" ONCLICK=\"window.history.back();\"><img src=\"images/bot_cancelar.gif\" alt=\"\" border=\"0\"></A></td> 
					   
					   </tr>
					   
                 	</table>
				    
				 </td></tr> 
               </table>
			   <br>
			   
			     <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                   <tr>
                     <td align=\"center\" class=\"textos\">&nbsp;</td>
                     </tr>
					 <tr><td align=\"center\" class=\"textos\">
					 <img src=\"$link\" alt=\"\" border=\"0\">
					 </td></tr> 
               	</table>
			   
			   
			   ";
			   
			   
			   
	

}else{

$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">
				  Para tener acceso a este modulo debes ser un usuario registrado de nuestro sitio.
				  </td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">&nbsp;</td></tr> 
				<tr><td align=\"center\" class=\"textos\">Para registrarte clickea <a href=\"index.php?accion=2\">AQUI</a></td></tr> 
              </table>";

}




 }
?>