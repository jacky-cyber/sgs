<?php

//$id_auto_admin=145;
$id_auto_admin = $_GET['id_auto_admin'];
$tabla_sel= $_GET['tabla_sel'];
$sub = $_GET['sub'];



switch ($sub) {
     case 1:
        	if($tabla_sel!=""){
		
		  $query= "SELECT campo   
		           FROM  auto_admin_campo
		           WHERE id_auto_admin='$tabla_sel'";
		     $result= cms_query($query)or die (error($query,mysql_error(),$php));
		      while (list($campos) = mysql_fetch_row($result)){

		      		$lista_campos .="<option value=\"$campos\">$campos</option>";

				 }
		
		$lista_campos_sel =" <select name=\"select\">
				 $lista_campos
				 
				 </select>";
		
		$contenido = $lista_campos_sel;
	}
         break;
	 case 2:
         include ("contenido/VerContenido.php");
         break;
   	default:
	   
   

  $query= "SELECT tabla 
           FROM  auto_admin
           WHERE id_auto_admin='$id_auto_admin'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($tabla) = mysql_fetch_row($result);
      
      
        $query= "SELECT id_auto_admin, tabla  
                 FROM  auto_admin
                 WHERE tabla_relacion='$tabla'";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($id_auto_admin_rel,$relacion) = mysql_fetch_row($result)){
      						   
      		 $lista_tabla_rel .="<option value=\"$id_auto_admin_rel\">$relacion</option>";
      }
      
$lista_tabla = " <select name=\"tabla_seleccionada\" onChange=\"ObtenerDatos('index.php?accion=$accion&act=$act&sub=1&id_auto_admin=$id_auto_admin&axj=1&tabla_sel='+form1.tabla_seleccionada.value,'lista_campos');\">

      <option value=\" \">---></option>
      <option value=\"$id_auto_admin\">$tabla</option>
      $lista_tabla_rel
      </select>";
//echo "$tabla_sel";




	$contenido =
 " <br><table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
    <tr>
      <td align=\"center\" class=\"textos\">
      $lista_tabla
 	</td>
      <td align=\"center\" class=\"textos\"><DIV id=\"lista_campos\">
      $lista_campos_sel
 		<select name=\"select\">

<option value=\"\">----></option>
</select>
      </DIV></td>
      <td align=\"center\" class=\"textos\">
      <select name=\"select\">
			<option value=\"1\">Igual a</option>
			<option value=\"2\">Mayor a</option>
			<option value=\"3\">Menor a</option>
			<option value=\"4\">Distinto a</option>
			<option value=\"5\">Que contenga </option>
		</select></td>
      <td align=\"center\" class=\"textos\">Ingrese texto
      <input type=\"text\" name=\"texto\"></td>
      <td align=\"center\" class=\"textos\">
      <input type=\"submit\" name=\"Submit\" value=\"Agregar Condici&oacute;n\"></td>
      </tr>
	</table>";
 
 }

?>