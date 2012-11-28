<?php

   $boton = "<input type=\"submit\" name=\"Grabar\" id=\"Grabar\" value=\"Grabar\" />";
   $ejemplo = "Formato: Oficina - Direcci&oacute;n.&nbsp;&nbsp;Ejemplo: <strong>Oficina de partes - Moneda 1160</strong>";
   $act = $_GET['act'];
   switch ($act){
   
   	case 1://ingresar oficina
	
			
			$js .= "<style type=\"text/css\">
						.cmxform  p.error  { 
						
						color: red; 
						}
						
						input.error { 
						
						border: 2px solid red; 
						}
						select.error {
							border: 2px solid red; 
						}
						textarea.error {
							border: 2px solid red; 
						}
						
						</style> 
			
					<script type=\"text/javascript\">
					$().ready(function() {
					// validate signup form on keyup and submit
							$(\"#form1\").validate({
											rules: {
													id_entidad: {
														required: true,
														required: function(element) {
														   return $(\"#id_entidad\").val() != '0'
															}
													},
													oficina: {
														required: true
													//}
												 }
								},
								messages: {
									id_entidad: \"<br>Debe seleccionar la entidad\",
									oficina: \"<br>Debe ingresar la oficina\"
									
										
								}
					});
				});
					
			</script>";
	
	
	
			$contenido = html_template('contenedor_crear_editar_oficina');
			$oficina = "<input type=\"text\" name=\"oficina\" id=\"oficina\"   />";
			$contenido = str_replace("#OFICINA#",$oficina,$contenido);
			$combo_entidades = select_lista_entidades($id_entidad_selecionada);
   		    $contenido = str_replace("#FILTRO_ENTIDAD#",$combo_entidades,$contenido);
   			$contenido = str_replace("<strong> Entidad:</srtong>","",$contenido);
			$contenido = str_replace("onChange=\"document.form1.submit();\"","",$contenido);
			$accion_form = "index.php?accion=$accion&act=2";
			$contenido = str_replace("#BOTON#",$boton,$contenido);
			$contenido = str_replace("#EJEMPLO#",$ejemplo,$contenido);
			$contenido = str_replace("#FUNCION#","Crear",$contenido);
			

		break;
	 case 2://ingresar oficina
	 		$oficina = $_POST['oficina'];
			$id_entidad_oficina = $_GET['id_entidad_oficina'];
			$id_entidad = $_POST['id_entidad'];
			
			
			if ($id_entidad_oficina==""){
				if (($id_entidad!="")and ($oficina!="")){
					$sql = "insert into sgs_entidades_oficinas (oficina,id_entidad) values ('$oficina','$id_entidad')";
					cms_query($sql)or die (error($query,mysql_error(),$php));
				}
			}else{
				if (($id_entidad!="")and ($oficina!="")){
					 $sql = "update sgs_entidades_oficinas set  oficina = '$oficina',id_entidad = '$id_entidad' where id_entidad_oficina = '$id_entidad_oficina'";
					cms_query($sql)or die (error($query,mysql_error(),$php));
				}
			}
			
			header("Location:index.php?accion=$accion");

		break;
	case 3://modificar oficina
	  		
						$js .= "<style type=\"text/css\">
						.cmxform  p.error  { 
						
						color: red; 
						}
						
						input.error { 
						
						border: 2px solid red; 
						}
						select.error {
							border: 2px solid red; 
						}
						textarea.error {
							border: 2px solid red; 
						}
						
						</style> 
			
					<script type=\"text/javascript\">
					$().ready(function() {
					// validate signup form on keyup and submit
							$(\"#form1\").validate({
											rules: {
													id_entidad: {
														required: true,
														required: function(element) {
														   return $(\"#id_entidad\").val() != '0'
															}
													},
													oficina: {
														required: true
													//}
												 }
								},
								messages: {
									id_entidad: \"<br>Debe seleccionar la entidad\",
									oficina: \"<br>Debe ingresar la oficina\"
									
										
								}
					});
				});
					
			</script>";

			
			$id_entidad_oficina = $_GET['id_entidad_oficina'];
			$sql = "select id_entidad_oficina,oficina,entidad,a.id_entidad
						from sgs_entidades_oficinas a,
							sgs_entidades b
							where a.id_entidad = b.id_entidad and id_entidad_oficina = $id_entidad_oficina ";
			  $result = cms_query($sql)or die (error($query,mysql_error(),$php));
		   
			list($id_entidad_oficina,$oficina,$entidad,$id_entidad)= mysql_fetch_row($result);
			$contenido = html_template('contenedor_crear_editar_oficina');
			$oficina = "<input type=\"text\" name=\"oficina\" id=\"oficina\" value= \"$oficina\"  />";
			$contenido = str_replace("#OFICINA#",$oficina,$contenido);
			$combo_entidades = select_lista_entidades($id_entidad);
   		    $contenido = str_replace("#FILTRO_ENTIDAD#",$combo_entidades,$contenido);
   			$contenido = str_replace("<strong> Entidad:</srtong>","",$contenido);
			$contenido = str_replace("onChange=\"document.form1.submit();\"","",$contenido);
			$accion_form = "index.php?accion=$accion&act=2&id_entidad_oficina=$id_entidad_oficina";
			$contenido = str_replace("#BOTON#",$boton,$contenido);
			$contenido = str_replace("#EJEMPLO#",$ejemplo,$contenido);
			$contenido = str_replace("#FUNCION#","Modificar",$contenido);

		break;
		case 4://detalle oficina
	  		
			$id_entidad_oficina = $_GET['id_entidad_oficina'];
			$sql = "select id_entidad_oficina,oficina,entidad,a.id_entidad
						from sgs_entidades_oficinas a,
							sgs_entidades b
							where a.id_entidad = b.id_entidad and id_entidad_oficina = $id_entidad_oficina ";
			  $result = cms_query($sql)or die (error($query,mysql_error(),$php));
		   
			list($id_entidad_oficina,$oficina,$entidad,$id_entidad)= mysql_fetch_row($result);
			$contenido = html_template('contenedor_crear_editar_oficina');
			$contenido = str_replace("#OFICINA#","<b>$oficina</b>",$contenido);
			$contenido = str_replace("#FILTRO_ENTIDAD#","<b>$entidad</b>",$contenido);
			$boton = "";
			$ejemplo = "";
			$contenido = str_replace("#BOTON#",$boton,$contenido);
			$contenido = str_replace("#EJEMPLO#",$ejemplo,$contenido);
			$contenido = str_replace("#FUNCION#","Detalle",$contenido);
   						

		break;
		case 5://eliminar el registro
			$id_entidad_oficina = $_GET['id_entidad_oficina'];
			$sql = "delete from sgs_entidades_oficinas
					where id_entidad_oficina = $id_entidad_oficina ";
			$result = cms_query($sql)or die (error($query,mysql_error(),$php));
			header("Location:index.php?accion=$accion");
			break;
			

	default:
			   $contenido = html_template('contenedor_oficinas');
			   $sql = "select id_entidad_oficina,oficina,entidad
						from sgs_entidades_oficinas a,
							sgs_entidades b
							where a.id_entidad = b.id_entidad ";
			   $result = cms_query($sql)or die (error($query,mysql_error(),$php));
		   
				while (list($id_entidad_oficina,$oficina,$entidad) = mysql_fetch_row($result)){
						$lista_td .="<tr>
										<td>$id_entidad_oficina</td>
										<td>$oficina</td>
										<td>$entidad</td>
										<td align=\"center\"><a href=\"index.php?accion=$accion&act=4&id_entidad_oficina=$id_entidad_oficina\"><img src=\"images/lupa.gif\" width=\"21\" height=\"24\"  border=\"0\" /></a></td>
										<td align=\"center\"><a href=\"index.php?accion=$accion&act=3&id_entidad_oficina=$id_entidad_oficina\"><img src=\"images/edit.gif\" width=\"22\" height=\"22\" border=\"0\" /></a></td>
										<td align=\"center\"><a href=\"javascript:if (confirm('Va a eliminar el registro. ¿ Está seguro?')==true){ location.href('index.php?accion=$accion&act=5&id_entidad_oficina=$id_entidad_oficina');}\"><img src=\"images/del.gif\" width=\"22\" height=\"22\"  border=\"0\" /></a></td>
									  </tr>
									";
				 }
				 
				 $tabla = "<table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
							<thead>
								  <tr>
									<th width=\"10%\"><h3>Id</h3></th>
									<th width=\"40%\"><h3>Oficina</h3> </th>
									<th width=\"38%\"><h3>Entidad</h3> </th>
									<th width=\"3%\"><h3>Ver</h3></th>
									<th width=\"3%\"><h3>Editar</h3></th>
									<th width=\"3%\"><h3>Borrar</h3></th>
								  </tr>
							 </thead>
							 <tbody>
								$lista_td
							 </tbody>				 
								
							</table>";
				 $tabla = crea_tabla_tiny($tabla);
				 $contenido = str_replace("#LINK_CREAR#","index.php?accion=$accion&act=1",$contenido);
				 
		
				 $contenido = str_replace("#TABLA#",$tabla,$contenido);
				 break;
   	}
			  

?>