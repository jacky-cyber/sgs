<?php

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];


if($nombre!=""){

$Sql ="UPDATE oc 
	   SET nombre ='$nombre',descripcion='$descripcion'
	   WHERE id_galeria ='$id_galeria'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
}

  $query= "SELECT id_cliente,id_galeria,fecha, nombre,descripcion,imagen 
           FROM  galerias
		   WHERE id_galeria='$id_galeria'";
		   
   $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 
   list($id_cliente,$id_galeria,$fecha,$nombre,$descripcion,$imagen) = mysql_fetch_row($result);
   
   
     
   $accion_form = "index.php?accion=$accion&act=$act&id_galeria=$id_galeria";
   
   $contenido .= "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
       <tr >
         <td align=\"left\" class=\"textos\">Nombre Galeria</td>
        <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"nombre\" value=\"$nombre\"></td>
         </tr>
    <tr >
         <td align=\"center\" class=\"textos\" colspan=\"2\">Descripcion</td>
        
         </tr>
      <tr >
         <td align=\"center\" class=\"textos\" colspan=\"2\">
		    <textarea name=\"descripcion\" cols=\"60\" rows=\"10\" >$descripcion</textarea>
		 </td>
        
      </tr>
	 <tr >
         <td align=\"center\" class=\"textos\" colspan=\"2\">
		   <img src=\"gal/imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=200\" alt=\"\" border=\"0\" class=\"foto\">
		 </td>
        
      </tr>
	  
    <tr >
         <td align=\"center\" class=\"textos\">&nbsp;</td>
        <td align=\"center\" class=\"textos\">&nbsp;</td>
         </tr>
	<tr >
         <td align=\"center\" class=\"textos\" colspan=\"2\">
		   <input type=\"submit\" name=\"Submit\" value=\"Actualizar\">
		 </td>
        
      </tr>
	
   	</table>";

		
				
?>