<?php



function select_admin_campo_relacion($tabla,$id_campo_selecionado, $js_sel, $clase,$id_filtro, $tabla_relacion, $id_auto_admin_tab){
	 //echo "$tabla,TB_RL->$tabla_relacion, $id_auto_admin_tab   $id_filtro<br><br>";
	//cat_familia_productos,2, , texto,, cat_grupo_productos, 131

	//$tabla=entrega el nombre de la tabla   
	//js_sel =viene ""  
	//$id_auto_admin_tab = id de la tabla  cat_productos
	//$id_campo_seleccionado =entrega el valor del select 
	//$tabla_relacion= el campo relacion con la tabla
	//$clase=texto  
	
	
	
	$accion = $_GET['accion'];

	
			crear_campo_orden($tabla);  //para poner el ultimo campo de la tabla orden
			//echo "$id_auto_admin";
			$id_auto_admin= id_tabla($tabla);	
			$campo_pk = pk_tabla($tabla);	
			$campo_txt=campo_txt($id_auto_admin);		   
			
			if($tabla_relacion!=""){
				$var_url="index.php?accion=$accion&act=6&tabla=$tabla_relacion&id_filtro='+form1.$campo_pk.value+'&id_auto=$id_auto_admin_tab&axj=1";
				//echo $var_url."<br>";
				 
				    
				
			}
			
			if($id_filtro!=""){
				//echo $id_filtro ."<br>";
			 $query= "SELECT campo   
				           FROM  auto_admin_campo
				           WHERE relacion ='$tabla' and id_auto_admin=$id_auto_admin_tab";
				//echo $query."<br>";
				  $result22= cms_query($query)or die (error($query,mysql_error(),$php));
				    list($campo_filtro) = mysql_fetch_row($result22);
				    
				    
				    if($campo_filtro!=""){
				    $condicion = " and $campo_filtro = $id_filtro";	
				  //  echo $condicion."<br>";	
				    }
				    	
			}
			
			
		//contenido_etiqueta_definicion	
				    
			
			//$condicion= "  and $campo_pk"
			
	//$contenido =  "$var_url<br>";
$query= "SELECT  $campo_pk,  $campo_txt
	           FROM  $tabla
               WHERE 1 $condicion
	           ORDER BY orden ";
	//echo $query."<br>";
	     $result= cms_query($query)or die ("ERROR 1d Tabla \"$tabla\" no configurada en el auto_admin function select_admin_campo<br>$query");
	      while (list($id_campo_pk,$contenido_campo_txt_bd) = mysql_fetch_row($result)){
	      	
	      	
	      	  //campo_pk corresponde al id del campo seleecion para filtrar el subgrupo del siguiente combolist
	      			
	
				//$var_url="index.php?accion=$accion&act=6&tabla=$tabla_relacion&id=$campo_pk&id_auto=$id_auto_admin_tab&ajx=1&id_valor='+form1.$campo_pk.value+'";
				//	
	      	$contenido_campo_txt_bd = acentos($contenido_campo_txt_bd);
	    	if($id_campo_selecionado==$id_campo_pk){
	    		
	    		
	      		
	      		$lista_select .="<option value=\"$id_campo_pk\" selected> $contenido_campo_txt_bd</option>\n";
	      	}else{
	      		$lista_select .="<option value=\"$id_campo_pk\">$contenido_campo_txt_bd</option>\n";
	      	}
							   
		 }
		 
		
		 		//$campo_pk_relacion = pk_tabla($tabla);			
		 	
		 	   if($tabla_relacion!=""){
		 	   	
		    $campo_pk_relacion = pk_tabla($tabla_relacion);	
      
		   
		     	$onchange="onchange=\"ObtenerDatos('$var_url','div_$campo_pk_relacion');\"";
		     }
		     
	$clase = trim($clase);
	if($id_opcional==""){

		

	 $lista_select ="<div id='div_$campo_pk'><select class=\"$clase\" name=\"$campo_pk\" $onchange $js_sel>
	  							   <option value=\"\">--Seleccione--></option>\";
               							$lista_select 
				   				   </select></div><div id='mensaje_$campo_pk'></div> ";
	}else{
		
	
	
	 $lista_select ="<div id='div_$campo_pk'><select class=\"$clase\" name=\"$campo_pk\" $onchange $js_sel>
	  							   <option value=\"\">--Seleccione--></option>\";
               							$lista_select
				   				   </select></div><div id='mensaje_$campo_pk'></div>";
	
	}
	 
		 	  
		
		return $lista_select; 
		 
}


function select_admin_campo_relacion2($tabla,$id_campo_selecionado, $js_sel, $clase,$id_filtro, $tabla_relacion, $id_auto_admin_tab){
	
	$accion = $_GET['accion'];

	
			crear_campo_orden($tabla);  //para poner el ultimo campo de la tabla orden
			//echo "$id_auto_admin";
			$id_auto_admin= id_tabla($tabla);	
			$campo_pk = pk_tabla($tabla);	
			$campo_txt=campo_txt($id_auto_admin);		   
			
			if($tabla_relacion!=""){
				$var_url="index.php?accion=$accion&act=6&tabla=$tabla_relacion&id_filtro='+form1.$campo_pk.value+'&id_auto=$id_auto_admin_tab&axj=1";
				//echo $var_url."<br>";				
			}
			
			$condicion= " and $campo_pk=$id_campo_selecionado ";
		
	
			
$query= "SELECT  $campo_pk,  $campo_txt
	           FROM  $tabla
               WHERE 1 $condicion
	           ORDER BY orden ";
	//echo $query."<br>";
	     $result= cms_query($query)or die ("ERROR 1d Tabla \"$tabla\" no configurada en el auto_admin function select_admin_campo<br>$query");
	      list($id_campo_pk,$contenido_campo_txt_bd) = mysql_fetch_row($result);
							   
		
		$lista_select=$contenido_campo_txt_bd;
		
		return $lista_select; 
		 
}


function busca_tabla2($nom_campo,$DATABASE){

$tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos
	 
		while( $line = @mysql_fetch_row($tables) )
{
	$tabla = $line[0];
	
	$sql = "SELECT * FROM $tabla  LIMIT 0,1";
 
   $qry = cms_query($sql)or die ("ERROR $php  1 function busca_tabla<br>$sql");
   
   $num_columnas = @mysql_num_fields($qry);
 //echo $num_filas." $tabla<br>";
   for ($i = 0; $i < $num_columnas; $i++){	
   		//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo_tabla = @mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	$flag      = mysql_field_flags($qry,$i);
	
	
	if(substr_count($flag, "not_null primary_key auto_increment") and $nom_campo_tabla==$nom_campo ){
	
	 $tabla_campo = $tabla;
	 //echo $nom_campo." $tabla<br>";
	 
	}
	
	}
	
	
	
	
			
		
}
return $tabla_campo;
}


function html_form2($html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor,$DATABASE,$id,$id_r){

	
//echo "$html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor,$DATABASE,$id,$id_r<br><br>";

		$nom_tabla = tabla($id_auto_admin);
	  //  echo "$nom_tabla $id_auto_admin rrr <br>";
		
		$campo_pk_tabla=pk_tabla($id_auto_admin);
			//echo "$campo_pk_tabla $id_auto_admin<br>";
			
			
			if( $nom_campo!="" and $nom_tabla!="" and $campo_pk_tabla !="" ){
			$query= "SELECT ".$nom_campo." 
				FROM $nom_tabla
				WHERE $campo_pk_tabla='$id_r'";

				//echo "$query<br>";

		$result6= cms_query($query)or die ("ERROR $php 1rr <br>$query");
		list($valor_campo) = mysql_fetch_row($result6);
			}else{
			echo "error  -->  $nom_campo!=\"\" and $nom_tabla!=\"\" and $campo_pk_tabla !=\"\"  <br>";
			
			}
		
	
	
// ECHO "ERERE $valor_campo <BR>";
 
$id_perfil = perfil($id_sesion);


switch ($id_tipo_campo) {
     case 4:
	 
	 if($id_tipo_campo==1){
	    $html_form = str_replace("#checked1#","checked",$html_form);
        $html_form = str_replace("#checked0#","",$html_form);
		
	 }else{
	    $html_form = str_replace("#checked1#","",$html_form);
        $html_form = str_replace("#checked0#","checked",$html_form);
	 }
        
		
         break;
	 case 6:
	 
	 	
	  $query= "SELECT relacion  
	           FROM  auto_admin_campo
	           WHERE campo='$nom_campo' and id_auto_admin=$id_auto_admin";
			   //echo $query."<br>";
	     $result4= cms_query($query)or die (error($query,mysql_error(),$php));
	    list($tabla_relacion) = mysql_fetch_row($result4); 	
	 	//echo $query ."$tabla_relacion  ";
	/*if($tabla==""){
		$tabla = busca_tabla2($nom_campo,$DATABASE);  
	}*/
//echo "$nom_campo,$DATABASE <br>"	 ;
 

//echo "$tabla<br>";
if($tabla_relacion!=""){
	
	
	$campo_pk_tabla_relacion=pk_tabla($tabla_relacion);
	
	



	 $query= "SELECT relacion  
	           FROM  auto_admin_campo
	           WHERE campo='$nom_campo'";
	     $result4= cms_query($query)or die (error($query,mysql_error(),$php));
	    list($tabla) = mysql_fetch_row($result4);
	    
	    
	      $query= "SELECT id_auto_admin
	               FROM  auto_admin
	               WHERE tabla='$tabla'";
	         $result6= cms_query($query)or die (error($query,mysql_error(),$php));
	        list($id_auto_admin) = mysql_fetch_row($result6);
	    						   
	    	
	    
	    
	      $query= "SELECT  campo   
	               FROM  auto_admin_campo 
	               WHERE id_auto_admin='$id_auto_admin' and pk=1";
	     
	         $result5= cms_query($query)or die (error($query,mysql_error(),$php));
	        list($nom_campo) = mysql_fetch_row($result5);
	    
	   
}


//$tabla_mandatoria = tabla_mandatoria($id_auto_admin);


//if($tabla == $tabla_mandatoria){
	
/*	
	$id_tabla_mandatoria =id_tabla($tabla_mandatoria);    
	$campo_txt_tabla = campo_txt($id_tabla_mandatoria);
	
	
	$valor_campo_tabla = valor_campo_tabla ($tabla, $campo_txt_tabla, $id);
	//echo "$valor_campo_tabla";
	*/
	
//$html_hiden= $valor_campo_tabla."<input type=\"hidden\" name=\"$nom_campo\" value=\"$id\"";
	


                     
$id_campo_seleccionado="$valor_campo";
//echo "$valor_campo<br>";

$js_sel="";
$clase="texto";


$campo_select="$nom_campo";

//se forman los select html
//echo "$tabla_relacion, $id_campo_seleccionado, $js_sel, $clase, $id_opcional <br>";
$html_form= select_admin_campo($tabla_relacion,$valor_campo, $js_sel, $clase,$id_opcional); 
 
							
//}


         break;
   	default:
	   
       
 }
 
 
if($id_tipo_campo == 9){
	
	$valor_campo = fechas_html($valor_campo);
	
}
$html_form=str_replace("#valor_campo#","$valor_campo",$html_form);  
//$html_hidden= $html_form."<input type=\"hidden\" name=\"\" value=\"\">";




$html_form =  str_replace("#nombre_campo#",$nom_campo,$html_form);

return $html_form;


}

?>