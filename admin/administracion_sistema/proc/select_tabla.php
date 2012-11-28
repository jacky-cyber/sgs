<?php

$id_auto_admin_tab= $_GET['id_auto'];  //id de la tabla primaria (formulario total) con eso sabemos si existe algo en el campo relacion
$tabla = $_GET['tabla']; //tabla que se generara el combolist
$id_filtro = $_GET['id_filtro']; //dato seleccionado del combolist que genera este combolist se filtra segun este dato ejem: id_regionpara las comunas de esa region


//$id_auto_admin= id_tabla($tabla);				   
$campo_pk = pk_tabla($tabla);	
//$campo_txt=campo_txt($id_auto_admin);
//$tabla = busca_tabla($nom_campo,$DATABASE); 

                     
$id_campo_selecionado="$valor";


$js_sel="";
$clase="texto";
//echo "$nom_campo";

$campo_select="$nom_campo";

    

	 	     $query= "SELECT relacion   
	 	              FROM  auto_admin_campo
	 	              WHERE id_auto_admin='$id_auto_admin_tab' and id_tipo_campo=6  and campo='$campo_pk' ";	 	     
//echo "$query<br>";  
	 	        $result4= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($tabla_relacion2) = mysql_fetch_row($result4);
	 	      	
	 	 
//echo "$tabla, $id_campo_selecionado, $js_sel, $clase, $id_opcional,$tabla_relacion2,$id_auto_admin_tab)";
//$html_form= select_admin_campo($tabla,$id_campo_selecionado,$nombre_campo_id,$nombre_campo_texto,$js_sel,$clase,$campo_select);  

//familia_productos
       $contenido= select_admin_campo_relacion($tabla, $id, $js_sel, $clase, $id_filtro,$tabla_relacion2,$id_auto_admin_tab);  
 
?>