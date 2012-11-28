<?php



switch ($act) {
     case 1:
         include ("deuman/disenio/subir_css.php");
		 $contenido =$contenido_css;
         include ("deuman/disenio/subir_imagen.php");
		 $contenido .= $contenido_img;
		 
		 $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
                         <tr>
                           <td align=\"center\" class=\"textos\">$contenido_css</td>
                         </tr>
						 <tr><td align=\"center\" class=\"textos\">$contenido_img </td></tr> 
						 <tr><td align=\"center\" class=\"textos\"><a href=\"index.php?accion=$accion\">Volver</a> </td></tr> 
                       </table>";
					   
					   
         break;
	 case 2:
        
         break;
   	default:
	  
	 
$directorio=opendir("sgs/images/"); 

while ($archivo = readdir($directorio)){
	
	if($archivo!="." and $archivo !=".."){
	
	  $lista_images .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
	  <td align=\"left\" class=\"textos\">
	  <a href=\"sgs/images/$archivo\">$archivo</a> </td></tr> "; 
	}

}

closedir($directorio);
       

$accion_form = "index.php?accion=$accion&act=1";

$contenido = "<table width=\"100%\" border=\"0\" align=\"left\" cellpadding=\"3\" cellspacing=\"3\" class=\"cuadro_light\">
                <tr>
                  <td align=\"left\" class=\"textos\">
				  Subir css <input type=\"file\" id=\"archivo_css\" name=\"archivo_css\">
				  <br>Este archivo se debera llamar chileatiende.css y estara ubicado en la carpeta <br>
				  <strong>\"sgs/css/nuevos_css.css\"</strong> asi lo cargaremos </td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">&nbsp;</td></tr> 
				<tr><td align=\"left\" class=\"textos\">
				Subir imagen <input type=\"file\" id=\"archivo_imagen\" name=\"archivo_imagen\"> 
				<br>Las imagenes se guardaran en la carpeta <strong>\"sgs/images/\"</strong></td></tr> 
				<tr><td align=\"center\" class=\"textos\">
				<input type=\"submit\" name=\"Submit\" value=\"subir\"> </td></tr> 
				<tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
				<tr><td align=\"center\" class=\"textos\"> </td></tr> 
              </table>
			<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
				<tr><td align=\"center\" class=\"textos\"> <b>Directorio actual: sgs/images</b><br>$dir<br>
<b>Imagenes:</b><br></td></tr> 
                  $lista_images
              	</table> 
			   ";
			  
			  
	
		 }

?>