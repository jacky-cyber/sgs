<?php
//ver listado



//include ("admin/administracion_sistema/proc/consulta.php");

function busca_tabla($nom_campo,$DATABASE){

$tables = cms_list_tables($DATABASE );					//conexion con la base de datos
	 
		while( $line = @cms_fetch_row($tables) )
{
	$tabla = $line[0];
	
	$sql = "SELECT * FROM $tabla  LIMIT 0,1";
 
   $qry = cms_query($sql);
   
   $num_columnas = @cms_num_fields($qry);
  // echo $num_filas." $tabla<br>";
   for ($i = 0; $i < $num_columnas; $i++){	
   		//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo_tabla = @cms_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	$flag      = cms_field_flags($qry,$i);
	
	
	if(substr_count($flag, "not_null primary_key auto_increment") and $nom_campo_tabla==$nom_campo ){
	
	 $tabla_campo = $tabla;
	 
	 
	}
	
	}
	
			
}
return $tabla_campo;
}



function html_form_ver($html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor,$DATABASE){
//echo "$html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor<br>";
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
	 case 6:
	 	
	 
	 	 
$tabla = busca_tabla($nom_campo,$DATABASE);     		 
    
$id_campo_selecionado="$valor";


$js_sel="";
$clase="texto";

$campo_select="$nom_campo";
//echo "$campo_select<br>";

		     $query= "SELECT relacion   
	 	              FROM  auto_admin_campo
	 	              WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo'";
	//echo $query."<br>"; 	     
	
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($tabla_relacion) = cms_fetch_row($result);
				
	 	      if($tabla_relacion!=""){
	 	      	
	 	      	
	 	      		  $query= "SELECT campo
	 	      		           FROM  auto_admin_campo
	 	      		           WHERE relacion='$tabla' and id_auto_admin=$id_auto_admin";
	 	      		  //echo $query;
	 	      		     $result23= cms_query($query)or die ("ERROR sql 23 linea 100 $php <br>$query");
	 	      		    list($filtro) = cms_fetch_row($result23);
	 	      		    
	 	      		     if($filtro!=""){
	 	      		     	
	 	      		     	
	 	      		     	$id_busca_get = $_GET[id];
	 	      		     	$id_tabla_get = $_GET[id_a];
	 	      		     	  $query= "SELECT tabla   
         								FROM  auto_admin 
           								WHERE id_auto_admin='$id_tabla_get'";
 							 //echo $query;
    						 $result34= cms_query($query)or die ("ERROR $php linea 114 1 <br>$query");
    						  list($nom_tabla_get) = cms_fetch_row($result34);
	 	      		     	
    						  $campo_pk_get = pk_tabla($nom_tabla_get);	
	 	      		     	
	 	      		     	$query= "SELECT $filtro   
	 	      		               FROM  $nom_tabla_get
	 	      		               WHERE $campo_pk_get='$id_busca_get'";
	 	      		         $result34= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      		          list($id_opcional) = cms_fetch_row($result34);
	 	      		     	
	 	      		     } else{
	 	      		     	
	 	      		     	$id_opcional="";
	 	      		     }
	 	      		    
	 	      		
	 	      	}
	 	    
	//echo "$tabla, $id_campo_selecionado, $js_sel, $clase, $id_opcional,$tabla_relacion,$id_auto_admin<br>";
	
	if($_GET['id']==""){
		$id_campo_selecionado="";
	}
	if($tabla_relacion=="#"){
	$tabla_relacion="";
	}
$html_form= select_admin_campo_relacion2($tabla, $id_campo_selecionado, $js_sel, $clase, $id_opcional,$tabla_relacion,$id_auto_admin);  
//echo "$tabla, $id_campo_selecionado, $js_sel, $clase, $id_opcional,$tabla_relacion,$id_auto_admin<br>";
     break;
      
	
   	default:
	   
	
 }      

$html_form =  str_replace("#nombre_campo#",$nom_campo,$html_form);
//echo $html_form;


return $html_form;
//echo $html_form;

}


$css .="<link rel=\"stylesheet\" type=\"text/css\" href=\"css/consolidated_common.css\" />";



//formulario
$nom_campo_form = $_POST['nom_campo_form'];
$html_form= $_POST['html_form'];
$nom_campo_tabla = $_POST['nom_campo_tabla'];


  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";
 // echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($nom_tabla) = cms_fetch_row($result)){

      	
      	   
			$query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
			// echo $query;
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = cms_fetch_row($result);
             
   	
             
     if($id!=""){
     	$condicion= "where $pk_campo=$id";
     }
             	
 $sql = "SELECT * FROM $nom_tabla
 			$condicion
			 LIMIT 0,1";
 
 //echo $sql;
  $qry = cms_query($sql);
  
   $num_filas = cms_num_fields($qry);
   

   $query= "SELECT formulario   
                FROM  auto_admin 
                WHERE id_auto_admin='$id_auto_admin'";
  
   
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($formu) = cms_fetch_row($result);
			 
			 
			 
   
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = cms_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	
    
    
      $query= "SELECT id_tipo_campo
               FROM  auto_admin_campo
               WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo' ";     
        //  echo "$query<br>"; 
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_tipo_campo) = cms_fetch_row($result);

          
     if($id_tipo_campo!=1 and $id_tipo_campo!="" ){//id_tipo_campo=8 ya que es un PK en la tabla auto_admin_tipo_campo  
   	
    
      $query= "SELECT html ,js, visible
               FROM  auto_admin_tipo_campo
               where id_tipo_campo= '$id_tipo_campo'";
    //  echo "$query<br>"; 
             
         $result33= cms_query($query)or die (error($query,mysql_error(),$php));
         list($html_form,$js_html, $visible) = cms_fetch_row($result33);
         
         
   		
   		$query= "SELECT $nom_campo
                 FROM $nom_tabla
                $condicion";
   		
   		//echo "<br> $query <br>";
     $resultff= @cms_query($query)or die (error($query,mysql_error(),$php));
	 $valor_nom_campo= @cms_result($resultff,0);
	  
	 
	 
    if($js_html!=""){
    	
       $js_form= str_replace("#nombre_campo#","$nom_campo","$js_html");
       //echo $js_form;
        $js_html_form .=$js_form."\n\n";
       //echo $js_html_form;
     }			 
   	
     $html_form= html_form_ver($html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor_nom_campo,$DATABASE);	 
     //echo "$html_form,$nom_campo,$id_tipo_campo,$id_auto_admin,$valor_nom_campo <br>";
	if($id!=""){
		 
	
	if($id_tipo_campo==8 and $valor_nom_campo!=""){
		
		//echo "$valor_nom_campo";
		
		
/*		
	$valor_nom_campo= "		    
<a href=\"images/sitio/sistema/$nom_tabla/$nom_campo/$id/$valor_nom_campo\" target=\"_blanck\"><img src=\"images/min_dw.jpg\" border=\"0\" alt=\"images/sitio/sistema/$nom_tabla/$nom_campo/$id/$valor_nom_campo\"></a>
				<a href=\"#\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=7&axj=1&tabla=$nom_tabla&nom_campo=$nom_campo&id=$id&campo=$valor_nom_campo','file_$nom_campo');\">
		      <img src=\"images/del_p.gif\" alt=\"borrar\" border=\"0\"></a>	      
";	
	*/	

		
		
	}
	
	
	if($id_tipo_campo==9){
	
	$valor_nom_campo = fechas_html($valor_nom_campo);
     
	}
	
	
	if($$nom_campo==""){
	$valor_nom_campo = trim($valor_nom_campo);
	//echo "$valor_nom_campo<br>";
	$html_form=$valor_nom_campo;
	//$html_form= str_replace("#valor_campo#","$valor_nom_campo",$html_form); 
	//echo $html_form;
	}else{
	$$nom_campo = trim($$nom_campo);
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
//echo $nom_campo_form;
    $nom_campo_form= str_replace("_"," ",$nom_campo_form);
    
    $nom_campo_form = ucwords($nom_campo_form);//para poner mayusculas
        
    // echo "$nom_campo_form<br>";	// muestra los campos de la tabla
	 //$id_auto_admin,$valor_nom_campo
	  $query= "SELECT help,unic   
               FROM  auto_admin_campo 
               WHERE id_auto_admin='$id_auto_admin' and campo = '$nom_campo'";
			   
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
		 list($help_txt,$unic) = cms_fetch_row($result3);
		 
	
	 	
			 
	 if($formu!=""){
	 
	 $formu = str_replace("#$nom_campo#",$html_form,$formu);
	//echo $formu;
	 
	 }else{
	 
	 
	  		  if($visible!=1){
			  // $id_tipo_campo =16 fckeditor
			  	if($id_tipo_campo !=16 and $id_tipo_campo !=17){
				$registros_form .= "<tr>
                         <td align=\"left\" class=\"textos\" valign=\"top\">$nom_campo_form</td>
                         <td align=\"left\" class=\"textos\">:&nbsp;$html_form</td>
						 <td align=\"right\" ><div id=\"div_$nom_campo\" class=\"textos\"></div>$help2</td>                          
                    </tr>";
				
				}else{
				$registros_form .= "<tr>
                         <td align=\"left\" class=\"textos\" valign=\"top\" colspan=\"3\">$nom_campo_form $help</td>
                                                 
                    </tr>
					<tr><td align=\"center\" class=\"textos\" colspan=\"3\">$html_form </td></tr> ";
				
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

$contenido=  "
 
            
            $formu
               
            $js2";
 
 }else{
 
 $js2 .="<script type=\"text/javascript\">
$js_html_form

</script>";


$contenido .=  "
 
            <table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"2\" class=\"cuadro\">
            		<tr> 
                         <td align=\"center\" class=\"cabeza_rojo\" colspan=\"32\"> $nom_tabla</td>
					</tr>
                	<tr>
                 		<td align=\"center\" colspan=\"3\">$agregar</td>
                                         
               		</tr>
            			$registros_form
                		$botones4
                	<tr>
                         <td align=\"center\" class=\"textos\">&nbsp;</td>
                         <td align=\"center\" class=\"textos\">&nbsp;</td> 
						 <td align=\"center\" class=\"textos\">&nbsp</td>                        
                	</tr>
 	       </table>$js2";
 
 
 }
 
//este include muestra la tabla relacionada
//include("admin/administracion_sistema/form/formulario_tablas_relacionadas.php");
 

 $id_perfil=perfil($id_sesion);



?>