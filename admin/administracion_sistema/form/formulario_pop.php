<?php

		
$id_perfil="";
function busca_tabla($nom_campo,$DATABASE){

$tables = mysql_list_tables($DATABASE );					//conexion con la base de datos
	 
		while( $line = @mysql_fetch_row($tables) )
{
	$tabla = $line[0];
	
	$sql = "SELECT * FROM $tabla  LIMIT 0,1";
 
   $qry = cms_query($sql);
   
   $num_columnas = @mysql_num_fields($qry);
  // echo $num_filas." $tabla<br>";
   for ($i = 0; $i < $num_columnas; $i++){	
   		//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo_tabla = @mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	$flag      = mysql_field_flags($qry,$i);
	
	
	if(substr_count($flag, "not_null primary_key auto_increment") and $nom_campo_tabla==$nom_campo ){
	
	 $tabla_campo = $tabla;
	 
	 
	}
	
	}
	
			
}
return $tabla_campo;
}



function html_form($html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor,$DATABASE){

//echo "$html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor,$DATABASE<br>";
//echo "$id_tipo_campo<br>";

		switch ($id_tipo_campo) {
     						case 4:
	 
	 							if($valor==1){
								    $html_form = str_replace("#checked1#","checked",$html_form);
							        $html_form = str_replace("#checked0#","",$html_form);
								 }else{
								    $html_form = str_replace("#checked1#","",$html_form);
							        $html_form = str_replace("#checked0#","checked",$html_form);
								 }
        					 break;
					   	    case 5:
	  								include("admin/administracion_sistema/proc/genera_check_box.php");
				  			 break;
	 						case 6:
	 							include("admin/administracion_sistema/proc/genera_combos_dependientes.php");
						     break;
   							default:
						 }      

$html_form =  str_replace("#nombre_campo#",$nom_campo,$html_form);

return $html_form;


}


$js .= "<script type=\"text/javascript\" src=\"js/livevalidation_standalone.js\"></script>";
$css .="<link rel=\"stylesheet\" type=\"text/css\" href=\"css/consolidated_common.css\" />";

$js .="
	<SCRIPT type=\"text/javascript\" src=\"js/dhtmlgoodies_calendarFull/dhtmlgoodies_calendar.js?random=20051112\"></script>
	<script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
				
				<script>
					function todos(clase){
						$('.'+clase).attr('checked',true);
					}
					function ninguno(clase){
						$('.'+clase).attr('checked',false);
					}
				</script>
";
$css .="<link rel=\"stylesheet\" href=\"js/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112\" media=\"screen\"></LINK>";



//formulario
$nom_campo_form = $_POST['nom_campo_form'];
$html_form= $_POST['html_form'];
$nom_campo_tabla = $_POST['nom_campo_tabla'];


  $query= "SELECT tabla,control_version   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";
  //echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($nom_tabla,$control_version) = mysql_fetch_row($result)){

      	
      	   
			$query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
             
   	 if($control_version==1){
	
	/*
 * Select tabla auto_admin_control_version
 * 
 */
$query= "SELECT id_control_version,id_usuario  
           FROM  auto_admin_control_version
           WHERE id_auto_admin = '$id_auto_admin' and id_registro= '$id' and abierto=1 ";
     $result_auto_admin_control_version= cms_query($query)or die (mysql_error());
      if(!list($id_control_version,$id_user_control_version) = mysql_fetch_row($result_auto_admin_control_version)){
		/** fin select auto_admin_control_version***/
		
			$condicion= "where $pk_campo=$id";
			$date = date('Y-m-d H:i:s');
			$qry_insert="INSERT INTO auto_admin_control_version(id_control_version,id_usuario,id_auto_admin,id_registro,sql_sess,fecha,abierto)
			values (null,'$id_usuario','$id_auto_admin','$id','$sql_sess','$date',1)";
			      
			$result_insert=cms_query($qry_insert) or die (mysql_error());
			$id_user_control_version=$id_usuario;
	}
	 }

             
     if($id!=""){
     	$condicion= "where $pk_campo=$id";
     }
  
         	
 $sql = "SELECT * FROM $nom_tabla
 			$condicion
			 LIMIT 0,1";
 
 
  $qry = cms_query($sql);
  
   $num_filas = mysql_num_fields($qry);
   

   $query= "SELECT formulario   
                FROM  auto_admin 
                WHERE id_auto_admin='$id_auto_admin'";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($formu) = mysql_fetch_row($result);
			 
			 
			 
   
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	
    
    
      $query= "SELECT id_tipo_campo,txt_form
               FROM  auto_admin_campo
               WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo' ";     
        //  echo "$query<br>"; 
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_tipo_campo,$txt_form) = mysql_fetch_row($result);
		$var=  $nom_campo."_txt_from";
		$$var= $txt_form;
  
		  
     if($id_tipo_campo!=1 and $id_tipo_campo!="" ){//id_tipo_campo=8 ya que es un PK en la tabla auto_admin_tipo_campo  
   	
    
      $query= "SELECT html ,js, visible
               FROM  auto_admin_tipo_campo
               where id_tipo_campo= '$id_tipo_campo'";
    //  echo "$query<br>"; 
             
         $result33= cms_query($query)or die (error($query,mysql_error(),$php));
         list($html_form,$js_html, $visible) = mysql_fetch_row($result33);
         
         
   		
   		$query= "SELECT $nom_campo
                 FROM $nom_tabla
                $condicion";
   		
   		//echo "<br> $query <br>";
     $resultff= @cms_query($query)or die (error($query,mysql_error(),$php));
	 $valor_nom_campo= @mysql_result($resultff,0);
	
	 
    if($js_html!=""){
    	
       $js_form= str_replace("#nombre_campo#","$nom_campo","$js_html");
        $js_html_form .=$js_form."\n\n";
       
     }			 
   	
     $html_form= html_form($html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor_nom_campo,$DATABASE);	  
	if($id!=""){
		 
	      

	if($id_tipo_campo==8 and $valor_nom_campo!=""){
		
		//echo "$valor_nom_campo";
		
	$valor_nom_campo= "		    
<a href=\"images/sitio/sistema/$nom_tabla/$nom_campo/$id/$valor_nom_campo\" target=\"_blanck\"><img src=\"images/min_dw.jpg\" border=\"0\" alt=\"images/sitio/sistema/$nom_tabla/$nom_campo/$id/$valor_nom_campo\"></a>
		      <a href=\"#\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=7&axj=1&tabla=$nom_tabla&nom_campo=$nom_campo&id=$id&campo=$valor_nom_campo','file_$nom_campo');\">
		      <img src=\"images/del_p.gif\" alt=\"borrar\" border=\"0\"></a>
			  <input type=\"checkbox\" name=\"mantiene_$nom_campo\" id=\"mantiene_$nom_campo\" value=\"1\" checked>Mantener esta imagen <strong>\"$valor_nom_campo\"</strong>
			 
";	
	/*
		$js_html_form .="$('#mantiene_$nom_campo').change(function() {
  							//$('#$nom_campo').val(\"dfsdfsdf\");
							alert('Handler for .change() called.');
						});";*/
		
		
	}
	
	
	if($id_tipo_campo==9){
	
	$valor_nom_campo = fechas_html($valor_nom_campo);
     
	}
	
	if($id_tipo_campo==20){
	
	$valor_nom_campo = htmlspecialchars($valor_nom_campo);
     
	}
	
	  
	  
	
	if($$nom_campo==""){
	$valor_nom_campo = trim($valor_nom_campo);
	//$valor_nom_campo=  htmlentities($valor_nom_campo);
	$html_form= str_replace("#valor_campo#","$valor_nom_campo",$html_form); 
	}else{
	$$nom_campo = trim($$nom_campo);
	//$valor_nom_campo= htmlentities($$nom_campo);
	$html_form= str_replace("#valor_campo#",$$nom_campo,$html_form); 
	}
    
  }else{
  	
  	
  	if($$nom_campo==""){
	$html_form= str_replace("#nombre_campo#","$nom_campo",$html_form);
  	$html_form=str_replace("#valor_campo#","",$html_form); 
	}else{
	$html_form= str_replace("#nombre_campo#","$nom_campo",$html_form);
  	$html_form=str_replace("#valor_campo#",$$nom_campo,$html_form); 
	
	}
//  echo "$html_form<br>";  // muestra las cajas o los radiobutton dependiendo del tipo
  	
  }

    $nom_campo_form= str_replace("id_","",$nom_campo);

    $nom_campo_form= str_replace("_"," ",$nom_campo_form);
    
    $nom_campo_form = ucwords($nom_campo_form);//para poner mayusculas
        
    // echo "$nom_campo_form<br>";	// muestra los campos de la tabla
	 //$id_auto_admin,$valor_nom_campo
	  $query= "SELECT help,unic   
               FROM  auto_admin_campo 
               WHERE id_auto_admin='$id_auto_admin' and campo = '$nom_campo'";
		
 		   
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
		 list($help_txt,$unic) = mysql_fetch_row($result3);
		 
		 
		 if($unic==1){
		
			$js_div=" onkeyup=\"ObtenerDatos('index.php?accion=$accion&act=15&tabla=$nom_tabla&nom_cmpo=$nom_campo&id_a=$id_a&id=$id&new_dato='+ form1.$nom_campo.value +'&axj=1' ,'div_$nom_campo');\" ";
			
		}else{
		$js_div="";
		}
		$html_form= str_replace("#js_unico#",$js_div,$html_form);
		 $random = rand(0,1000)*microtime() * 1000000;
		 
          if ($help_txt!="" and $help_txt!="<p>&nbsp;</p>"){
		  $help="<a href=\"index.php?accion=$accion&act=20&campo=$nom_campo&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"$descrip_modulo\"><img src=\"images/help.png\" alt=\"\" border=\"0\"></a>";
    			
    		 }else{
			 	$help="";
	  }
		 
	 
	
	 if($formu!=""){
	 
	 $formu = str_replace("#$nom_campo#",$html_form,$formu);
	//echo $formu;
	 
	 }else{
	 
	 
	       $query= "SELECT txt_form
               FROM  auto_admin_campo
               WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo' ";     
       
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($txt_form) = mysql_fetch_row($result);
		  if($txt_form!=""){
		  $nom_campo_form=$txt_form;
		  }
	
	  		  if($visible!=1){
			  // $id_tipo_campo =16 fckeditor
			  	if($id_tipo_campo !=16 and $id_tipo_campo !=17){
				$registros_form .= "<tr style=\"background-color: #F7F7F7;\" onmouseover=\"this.style.backgroundColor='#fff'\" onmouseout=\"this.style.backgroundColor='#F7F7F7'\">
                         <td align=\"left\" class=\"textos\" valign=\"top\">$nom_campo_form $help</td>
                         <td align=\"left\" valign=\"top\" class=\"textos\">$html_form </td>
						 <td align=\"center\"  ></td>                          
                    </tr>";
				
				}else{
				$registros_form .= "<tr style=\"background-color: #F7F7F7;\" onmouseover=\"this.style.backgroundColor='#fff'\" onmouseout=\"this.style.backgroundColor='#F7F7F7'\">
                         <td align=\"left\" class=\"textos\" valign=\"top\" colspan=\"3\">$nom_campo_form $help</td>
                                                 
                    </tr>
					<tr style=\"background-color: #F7F7F7;\" onmouseover=\"this.style.backgroundColor='#fff'\" onmouseout=\"this.style.backgroundColor='#F7F7F7'\">
					<td align=\"center\" class=\"textos\" colspan=\"3\">$html_form </td></tr> ";
				
				}
   
    			
   
   					}else{
   				$registros_form .= "
                    $html_form";
   				}
	 
	 }
	      

   }

  } 	
 }

 
 
 if($formu!=""){
 
 $js2 .="<script type=\"text/javascript\">
			$js_html_form
		</script>";

$contenidoxxx=  "
 
            
            $formu
               
            $js2";
 
 }else{
 
 $js2 .="<script type=\"text/javascript\">
$js_html_form

</script>";
	  
	
if($_GET['id']!=""){
	if($control_version==1){
		
	
	if($id_usuario==$id_user_control_version){
		$nombre_control= nombre_usuario2($id_user_control_version);
	$botones="<tr style=\"background-color: #F7F7F7;\">
                         <td align=\"center\" class=\"textos\">
						 <input type=\"submit\" name=\"actualizar\" value=\"Actualizar\"></td>
						 <td align=\"center\" class=\"textos\">&nbsp</td> 
                         <td align=\"center\" class=\"textos\">
						 <input type=\"submit\" name=\"aceptar\" value=\"Aceptar\"></td>
                	</tr>
			<tr><td align=\"center\"  colspan=\"3\"> <div class=\"alert alert-info\">Registro Bloqueado por $nombre_control Click en Aceptar para liberar</div></td></tr> ";	
	}else{
		$nombre_control= nombre_usuario2($id_user_control_version);
		$botones="
			<tr><td align=\"center\"  colspan=\"3\"> <div class=\"alert alert-error\">Registro Bloqueado por <strong>$nombre_control</strong> </div></td></tr> ";	

	}
	
	}else{
		$botones="<tr style=\"background-color: #F7F7F7;\">
                         <td align=\"center\" class=\"textos\">
						 <input type=\"submit\" name=\"actualizar\" value=\"Actualizar\"></td>
						 <td align=\"center\" class=\"textos\">&nbsp</td> 
                         <td align=\"center\" class=\"textos\">
						 <input type=\"submit\" name=\"aceptar\" value=\"Aceptar\"></td>
                	</tr>
			 ";	
		
		
	}
}else{

	$botones="<tr style=\"background-color: #F7F7F7;\">
                         <td align=\"center\" class=\"textos\">
						 <input type=\"submit\" name=\"crear_otro\" value=\"Guardar y Crear otro nuevo\"></td>
						 <td align=\"center\" class=\"textos\">&nbsp</td> 
                         <td align=\"center\" class=\"textos\">
						 <input type=\"submit\" name=\"aceptar\" value=\"Aceptar\"></td>
                	</tr>";

}


$contenidoxxx .=  "
 
            <table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\" class=\"cuadro_light\">
            		<tr style=\"background-color: #F7F7F7;\"> 
                         <td align=\"center\" class=\"cabeza_rojo\" colspan=\"3\"><strong>Tabla: $nom_tabla</strong></td>
					</tr>
                	<tr style=\"background-color: #F7F7F7;\">
                 		<td align=\"center\" colspan=\"3\">$agregar</td>
                                         
               		</tr>
            			$registros_form
                		$botones
                	<tr style=\"background-color: #F7F7F7;\">
                         <td align=\"center\" class=\"textos\">&nbsp;</td>
                         <td align=\"center\" class=\"textos\">&nbsp;</td> 
						 <td align=\"center\" class=\"textos\">&nbsp</td>                        
                	</tr>
 	       </table>$js2";
 
 
 }
 
 
  //nom_tabla = $nom_tabla;
//$id_auto_admin = $_GET['id_auto_admin'];
//$id_auto_admin=128;
 


//$nom_tabla = $_GET['nom_tabla'];

//$id = $_GET['id'];
//$id_r = $_GET['id_r'];


include("admin/administracion_sistema/form/formulario_tablas_relacionadas_pop.php");
 
 
 /* $query= "SELECT id_auto_admin 
           FROM  auto_admin
           WHERE tabla_relacion ='$nom_tabla'";
		   
//		  echo $query;
     $result_tbla= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_auto_admin_tabla) = mysql_fetch_row($result_tbla)){
	  
 			include("admin/administracion_sistema/form/formulario_tabla.php");
	  }
	  */
	
 $id_perfil=perfil($id_sesion);
?>