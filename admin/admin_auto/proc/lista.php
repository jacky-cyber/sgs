<?php 
$accion_form = "index.php?accion=$accion&act=1&tbl=$nom_tabla";

$tbl = $_GET['tbl'];
$buscar_tabla = $_POST['buscar_tabla'];

if($buscar_tabla != ""){
		$query = "SHOW TABLES LIKE '%$buscar_tabla%' ";
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		while($line = mysql_fetch_row($result))
		{
			$tbla= $line[0];
			   
			$query= "SELECT id_auto_admin  
				   FROM  auto_admin 
				   WHERE tabla='$tbla'";
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			if(!list($id_tbl) = mysql_fetch_row($result)){
				$lista_tablas_bd .= "<tr>
									<td align=\"center\" class=\"textos\">$line[0]</td>
									<td align=\"center\" class=\"textos\">
									   <a class=\"btn btn-small\" href=\"index.php?accion=$accion&act=$act&tbl=".$line[0]."&#tbl\">
											<i class=\"icon-edit\"></i>
									   </a>
									</td>
								</tr>";
			}
		}
}
else{
		$tables = mysql_list_tables( $DATABASE );
		while($line = mysql_fetch_row($tables))
		{
				$tbla= $line[0];
				   
				$query= "SELECT id_auto_admin  
					   FROM  auto_admin 
					   WHERE tabla='$tbla'";
				 $result= cms_query($query)or die (error($query,mysql_error(),$php));
				  if(!list($id_tbl) = mysql_fetch_row($result)){
						$lista_tablas_bd .= "<tr>
											<td align=\"center\" class=\"textos\">$line[0]</td>
											<td align=\"center\" class=\"textos\">
											   <a class=\"btn btn-small\" href=\"index.php?accion=$accion&act=$act&tbl=".$line[0]."&#tbl\">
													<i class=\"icon-edit\"></i>
											   </a>
											</td>
										</tr>";
					 }
		}
}

//para seleccionar la tabla en la pag.			 

/*
$tablas ="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">		
              <option value=\"#\">Seleccione tabla </option>
			 $lista_tablas_bd
            </select>";
*/			
			

$js .= "<link href=\"admin/admin_auto/adminia.css\" rel=\"stylesheet\" type=\"text/css\" />";
$tablas = "

	<div class=\"widget widget-table\">
		
			<div class=\"widget-header\">
				<div class=\"izquierda\">
				<i class=\"icon-th-list\"></i>
				<h3>Tablas no administradas</h3>
				</div>
			
			
			<div class=\"derecha\">
				Buscar tabla 
				<input type=\"text\" name=\"buscar_tabla\" id=\"buscar_tabla\" value=\"$buscar_tabla\" >
				<input class=\"btn btn-small\" type=\"button\" id=\"buscar\" name=\"buscar\" value=\"Buscar\">
			</div>
	</div>
	<div class=\"widget-content\">
		<table class=\"table table-striped table-bordered\">
		
			<thead>
				<tr>
					<th align=\"center\" class=\"cabeza_rojo\">Tabla</th>
					<th align=\"center\" class=\"cabeza_rojo\">Edit</th>
				</tr>
				
			</thead>
			
			<tbody>
				$lista_tablas_bd
			</tbody>
		
		</table>
		</div>
	
	</div>	

";



$edit = $_GET['edit'];  
$nom_tabla=$tbl;

						  $query= "SELECT  id_auto_admin  
                               FROM  auto_admin
                               WHERE tabla ='$nom_tabla'";
                         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                          if (list($id_tbla) = mysql_fetch_row($result2)){
						 
                          $edit ="ok";
						  }

if($nom_tabla!=""){	
	//?
	
	
	
crear_campo_orden($nom_tabla);
	
	//si el nom_tabla es distinto a vacio selecciona todas las tablas


  $query= "SELECT id_auto_admin,help,ingresado_envia_mail,actualiza_envia_mail,borrar_envia_mail,email_aviso      
           FROM  auto_admin
           WHERE tabla='$nom_tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin,$help_tabla,$ingresado_envia_mail,$actualiza_envia_mail,$borrar_envia_mail,$email_aviso  ) = mysql_fetch_row($result);
						   
				   
 $sql = "SELECT * FROM $nom_tabla";
  $qry = cms_query($sql)or die (error($query,mysql_error(),$php));
   $num_filas = mysql_num_fields($qry);		 		
   
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	$flag      = mysql_field_flags($qry,$i);
	$largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);

	  $not_null     = substr_count ($flag, "not_null");
	  $auto_inc     = substr_count ($flag, "auto_increment");
	  $campo_id     = substr_count ($nom_campo, "id_");
	 
	
							   
   if($id_auto_admin!=""){
   	
     $query= "SELECT id_tipo_campo,existe_listado,pk,txt,help,unic,xml 
              FROM  auto_admin_campo
              WHERE campo='$nom_campo' and id_auto_admin= $id_auto_admin";				
			  
        $result20= cms_query($query)or die (error($query,mysql_error(),$php));
        list($id_tipo_campo,$existe_listado,$pk,$txt,$help,$unic,$xml) = mysql_fetch_row($result20);
   						   
   		if($existe_listado==1){
			$cheked_opcion = "checked";	
		}else{
			$cheked_opcion = "";	
		} 
		
   }else{
   	
   	
      $query= "SELECT id_tipo_campo   
                FROM  auto_admin_combinacion
                WHERE flag='$flag' and tipo='$tipo' and largo='$largo' ";
				//echo $query."<br>";
          $result2= cms_query($query)or die (error($query,mysql_error(),$php));
           list($id_tipo_campo) = mysql_fetch_row($result2);
   		if(substr_count($flag, "primary_key")){
		
			$pk=1;
		}else{
			$pk=0;
		}
 		
   		if($i==1){
			$cheked_opcion="checked";
			$txt=1;
		}else{
			$txt=0;
			$cheked_opcion="";
		}
		
		
   }  		 
	  $precaucion = 0;
	if(substr_count($nom_campo, "id_")){
	//echo $nom_campo."<br>";
	     $query2= "SELECT id_auto_admin   
          		  FROM  auto_admin_campo
                  WHERE campo='$nom_campo' and pk=1";
     	 $result22= cms_query($query2)or die (error($query,mysql_error(),$php));
         if(!list($id_tabla_pk) = mysql_fetch_row($result22) and $id_auto_admin<>$id_tabla_pk){
		// echo "-->$nom_campo--<br>";
		 $nom_camp_w= $nom_campo;
		 	$precaucion = 1;
		 }
			
	}




 $lista_de_campos2="";
 $query= "SELECT  id_tipo_campo, tipo_campo  
           FROM  auto_admin_tipo_campo";
          
     $result5= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_campo23, $tipo_campo23) = mysql_fetch_row($result5)){
           	 
      	if($id_tipo_campo23==$id_tipo_campo){ 
      		      		
      		//echo "$id_tipo_campo2==$id_tipo_campo2<br>";
      			 $lista_de_campos2.= "<option value=\"$id_tipo_campo23\" selected>$tipo_campo23</option>";
      			 
			}else{
				 $lista_de_campos2.= "<option value=\"$id_tipo_campo23\">$tipo_campo23</option>";
			}
			
	 }			
	 	 
		 
$lista_tipo_campo2 =	"<select name=\"sel_$nom_campo\">
						   $lista_de_campos2						
					 </select>";	
  

 


$cheked_pk1="";
$cheked_txt1="";
$cheked_xml_1="";

$var2="cheked_pk$pk";
$$var2="checked";

$var="cheked_txt$txt";
$$var="checked";

$var="cheked_xml_$xml";
$$var="checked";

$cheked_1="";
$cheked_0="";


$var="cheked_$unic";

$$var="checked";

//echo $var ."-->".$$var."<br>";
$checke_unic= $$var;

   
if($ingresado_envia_mail==1){
	$checked_ingresado_envia_mail="checked";
}else{
	$checked_ingresado_envia_mail="";
}

if($actualiza_envia_mail==1){
	$checked_actualiza_envia_mail="checked";
}else{
	$checked_actualiza_envia_mail="";
}

if($borrar_envia_mail==1){
	$checked_borrar_envia_mail="checked";
}else{
	$checked_borrar_envia_mail="";
}


///////////////////////////////



$fckeditor = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" colspan=\"2\>
		<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
      <tr>
        <td align=\"left\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\"></td>
        <td align=\"center\" class=\"textos\"> &nbsp;</td>
        </tr>
  	 <tr>
        <td align=\"center\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\">
		<textarea id=\"help\" name=\"help\" >$help_tabla</textarea>
		</td>
        </tr>
  	</table>";
	
	
	
	
$js.=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
      window.onload = function()
      {
        var oFCKeditor2 = new FCKeditor( 'help' ) ;
        oFCKeditor2.BasePath = \"fckeditor/\" ;
		oFCKeditor2.ToolbarSet = \"Basic\";
		oFCKeditor2.Height = 100 ;
        oFCKeditor2.ReplaceTextarea() ;
      }
    </script>";




////////////////////////////////






	if($precaucion==1){
	$nom_campo_html = "<td align=\"left\" class=\"textos\" title=\"No es posible encontrar la tabla donde este campo $nom_camp_w deber&iacute;a ser PK, esto podr&iacute;a producir un error en el administrador autom&aacute;tico\">
					   <font color=\"#FF0000\">$nom_campo</font><img src=\"images/atencion_pequenia.gif\" alt=\"No es posible encontrar la tabla donde este campo $nom_camp_w deber&iacute;a ser PK, esto podr&iacute;a producir un error en el administrador autom&aacute;tico\" border=\"0\"> </td>";
	}else{
	$nom_campo_html = "<td align=\"left\" class=\"textos\" title=\"$flag\">
					   $nom_campo </td>";
	}

	  $estructura_tabla .="<tr>								
	  							$nom_campo_html 
								<td align=\"left\" class=\"textos\">$lista_tipo_campo2</td>
						  		<td align=\"center\" class=\"textos\">
									<a href=\"index.php?accion=$accion&act=3&tbl=$nom_tabla&nom_campo=$nom_campo\">
									<img src=\"images/edit.png\" alt=\"\" border=\"0\"></a></td>	
						  		<td align=\"center\" class=\"textos\">
									<input type=\"checkbox\" name=\"unic_$nom_campo\" value=\"1\" $cheked_1></td> 
								<td align=\"center\" class=\"textos\">
									<input type=\"checkbox\" name=\"xml_$nom_campo\" value=\"1\" $cheked_xml_1></td> 
								<td align=\"center\" class=\"textos\"> 
									<input type=\"checkbox\" name=\"checkbox_$nom_campo\" value=\"1\" $cheked_opcion>
						  		</td>
								<td align=\"center\" class=\"textos\"> 
									<input type=\"radio\" name=\"pk\" value=\"$nom_campo\" $cheked_pk1>
						  		 </td>
								<td align=\"center\" class=\"textos\"> 
									<input type=\"radio\" name=\"txt\" value=\"$nom_campo\" $cheked_txt1>
						  		</td>
						  </tr>";
	
	
	    

	
	$formulario .=" <tr>
          <td align=\"center\" class=\"textos\">$nombre_campo</td>
          
          <td align=\"left\" class=\"textos\">
		 $campo_formulario  
		  </td>
		  </tr>  ";
		  
		
	

	
	}
	
	
	
	$tabla_estructura ="
	
	
	<div class=\"widget widget-table\">
	
		<div class=\"widget-header\">
				<i class=\"icon-th-list\"></i>
				<h3>Tabla $tbl</h3>
		</div>
		<div class=\"widget-content\">
	
			<table class=\"table table-striped table-bordered\">
				
				<thead>
						<tr>
							<th> Campo</th>
							<th> Campo Form</th>
							<th> Ver</th>					
							<th> Unic</th>					
							<th> Xml</th>					
							<th> Col</th>					
							<th> PK</th>					
							<th> txt</th>
						</tr>
				</thead>
				<tbody>
						$estructura_tabla
				</tbody>
			</table>
		</div>		
    </div>
	
	
	$fckeditor
	
	
	";
	
	
	
	
	
	
	$formulario="  <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
       					$formulario
    				</table>";
	
	}
	
	  $query= "SELECT tabla_relacion  
               FROM  auto_admin 
               WHERE tabla='$tbl'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($tabla_relacion) = mysql_fetch_row($result);

$tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos		 

while( $line = mysql_fetch_row($tables) )
{
	if($tabla_relacion==$line[0]){
		$lista_tabla_relacion	 .= "<option value=\"".$line[0]."\" selected>".$line[0]."</option>";
	}else{
		$lista_tabla_relacion	 .= "<option value=\"".$line[0]."\">".$line[0]."</option>";
	}
	
	 
	
}

//para seleccionar la tabla en la pag.			 
$lista_de_tabla_relacion ="<select name=\"tabla_relacion\">		
              <option value=\"\">Seleccione Tabla Relaci&oacute;n</option>
			  $lista_tabla_relacion	
            </select>";


  
	
	
$edit = $_GET['edit'];
if($edit == 'ok'){
	$tablas = "";
}
	
	$contenido ="	

		$tablas

		<a name=\"tbl\" id=\"a\"></a>
		$tabla_estructura

		<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro_light\">
             	<tr><td align=\"center\" class=\"textos\"><strong>Enviar aviso por Email por cada registro:  </strong></td></tr> 
			<tr><td align=\"center\" class=\"textos\">
			Ingresado	<input type=\"checkbox\" name=\"ingresado_envia_mail\" id=\"ingresado_envia_mail\" value=\"1\" $checked_ingresado_envia_mail> 
			Actualizado	<input type=\"checkbox\" name=\"actualiza_envia_mail\" id=\"actualiza_envia_mail\" value=\"1\" $checked_actualiza_envia_mail> 
			Eliminado	<input type=\"checkbox\" name=\"borrar_envia_mail\" id=\"borrar_envia_mail\" value=\"1\" $checked_borrar_envia_mail> 
		</td></tr>
		<tr><td align=\"center\" class=\"textos\">Ingrese el o los mail a informar, si es mas de uno debe estar separado por ; </td></tr> 
		<tr><td align=\"center\" class=\"textos\"><input type=\"text\" size=\"80\" name=\"email_aviso\" id=\"email_aviso\" value=\"$email_aviso\"> </td></tr> 
		<tr><td align=\"center\" class=\"textos_plomo\">Estas opciones solo funcionan si en la programaci&oacute;n se utiliza los metodos inserta , borrar, update </td></tr>  
		<tr>
          <td align=\"center\" class=\"textos\">Relacionar con: $lista_de_tabla_relacion</td>
          </tr>
		  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
		  <tr><td align=\"center\" class=\"textos\">
		  <input type=\"button\" name=\"agregar_configuracion\" id=\"agregar_configuracion\" value=\"Agregar configuraci&oacute;n\" class=\"btn btn-primary\"> </td></tr> 
          
        </table>

";
		  
		  

	
	
	//$contenido .= "$html";
	
	//include ("admin/admin_auto/lista_tablas.php");
	//echo $html;

	$accion_agregar_configuracion = "index.php?accion=$accion&act=1&tbl=$nom_tabla";
$js .= "

		<script type=\"text/javascript\">
		
			$(document).ready(function(){
				
				$('#buscar').live('click', function(){
					document.getElementById('form1').action='index.php?accion=$accion&act=$act';
					$('#form1').submit();
				});
				
				$('#agregar_configuracion').live('click', function(){
					document.getElementById('form1').action='$accion_agregar_configuracion';
					$('#form1').submit();
				});
				
			});
				
		</script>


";


?>