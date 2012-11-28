<?php
$id = $_GET['id'];

$tabla = "sgs_departamentos";
$campo_id  = campo_pk_tabla($tabla);
$campo_txt = campo_txt($tabla);

$titulo_administracion="Administraci&oacute;n Departamentos";

$id_entidad_padre= configuracion_cms('id_servicio');


$condicion = "Where id_entidad_padre = '$id_entidad_padre'";


 $ids_entidades = configuracion_cms('id_entidad');	


$condicion_filtro=" and  id_entidad_padre = '$id_entidad_padre' and id_entidad in ($ids_entidades)";
//$titulo_columna_txt="Departamento";

if($id!=""){
    $query= "SELECT * 
			FROM $tabla
			WHERE $campo_id ='$id'"; 
			//echo $query;
	$result_q= cms_query($query)or die (error($query,mysql_error(),$php));
	$num_filas = mysql_num_fields($result_q); 
	$resultado = mysql_fetch_row($result_q); 
	for ($i = 1; $i < $num_filas; $i++){ 
			$nom_campo = mysql_field_name($result_q,$i); 
			$valor = $resultado[$i]; 
			$$nom_campo = $valor; 
		}

}

//id_departamento  id_entidad_padre  id_entidad  departamento  

    $query= "SELECT id_entidad , entidad  
           FROM  sgs_entidades 
           WHERE  id_entidad_padre ='$id_entidad_padre' and id_entidad in ($ids_entidades)";
		   
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_entidad_sel , $entidad_sel) = mysql_fetch_row($result2)){
			
			if($id_entidad_sel==$id_entidad){
				$lista_sel .="<option value=\"$id_entidad_sel\" selected>$entidad_sel</option>";
				
			}else{
				$lista_sel .="<option value=\"$id_entidad_sel\">$entidad_sel</option>";
			}
			
			
						   
		 }

$select_entidad ="<select name=\"id_entidad\" id=\"id_entidad\">$lista_sel </select>";

$formulario = "  <table width=\"450\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                   <tr><td align=\"center\" class=\"textos\" colspan=\"2\">
				   <strong>Ingreso de Departamentos por Servicio </strong></td></tr> 
				   <tr >
                     <td align=\"left\" class=\"textos\">Departamento</td>
					 <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"departamento\" id=\"departamento\" value=\"$departamento\"></td> 
                  </tr>
				  <tr>
					 <td align=\"left\" class=\"textos\">Selecciona Entidad</td>
					 <td align=\"left\" class=\"textos\">$select_entidad</td> 
				 </tr>
				 <tr>
				 	<td align=\"center\" class=\"textos\" colspan=\"2\">
					  <input type=\"hidden\" name=\"id_entidad_padre\" id=\"id_entidad_padre\" value=\"$id_entidad_padre\">
					 <input type=\"button\" name=\"boton\" id=\"boton\" value=\"Aceptar\">
					</td> 
				</tr> 
               	</table>";


include('admin/listado_general/listado_general.php');

?>