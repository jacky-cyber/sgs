<?php


$id_fila_titulo = $_POST['id_fila_titulo'];


function lista_campos_tabla($tabla){
 $sql = "SELECT * FROM $tabla";
  $qry = cms_query($sql)or die (error($sql,mysql_error(),$php));
   $num_filas = mysql_num_fields($qry);		 		
   
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	$flag      = mysql_field_flags($qry,$i);
	$largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);

	  $not_null     = substr_count ($flag, "not_null");
	  $auto_inc     = substr_count ($flag, "auto_increment");
	  $campo_id     = substr_count ($nom_campo, "id_");
	 
	 $lista_campos_tabla .= "<option value=\"$nom_campo\">$nom_campo</option>";
	
	}
	
	return $lista_campos_tabla;
	
}

switch ($act) {
     case 1:
		
		include("deuman/importar_excel/sube_excel.php");
		$excel = "$carpeta/$file_name";
		include("deuman/importar_excel/lee_primera_fila.php");
		

         break;
	 case 2:
        	$tabla = $_POST['elegido'];
			if($tabla!="#"){
				$contenido = lista_campos_tabla($tabla);
			}else{
				$contenido = "<option value=\"#\">Seleccione</option>";
			}
			
         break;
   	default:
	 
	 
	 include("deuman/importar_excel/formulario_excel.php");
	 
       
 }

?>