<?php


switch ($act) {
     case 1:
	  $url=$_SERVER['REQUEST_URI'];
			 $url= str_replace("&axj=1","",$url);
			 $url= $url."&axj=1&p=1";
	 		 $print= "<div align=\"right\">
			 <a  href=\"#\"  class=\"comprobante\"><img onclick=\"MM_openBrWindow('$url','','scrollbars=yes,width=650,height=820')\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a></div>";
        
        
	 	 $accion_form = "index.php?accion=$accion&act=2";
         include ("sgs/rectificar_solicitudes/admin_solicitudes_ver.php");
		 
		  /*************************************************/
			include("sgs/opcionales/opcionales.php");
			
		 /*************************************************/
		 
         break;
	 case 2:
	 	 //include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_update.php");
		// include ("sgs/rectificar_solicitudes/admin_solicitudes_cambia_estado.php");
		// header("location:index.php?accion=$accion&act=1&folio=$folio&mensaje=$mensaje");
		
			//echo "<br> antes de boton: ".$bt_rectificar;
			$bt_rectificar = $_POST['bt_rectificar2'];
			//echo "<br> bt rectificar: ".$bt_rectificar;
			$folio = $_POST['folio'];
			$identificacion_documentos = $_POST['identificacion_documentos'];
			//echo "<br>bt_rectificar:".$bt_rectificar;
			if ($bt_rectificar!=""){
					$tipo = trim(substr($folio, 5, 1));
					//echo "tipo: ".$tipo;
				if ($tipo=="W"){
				$id_usuario     = id_usuario($id_sesion);
					Rectificar_solicitud_web($folio,$identificacion_documentos);	
				}else{
		
					$id_tipo_persona = $_POST['id_tipo_persona'];
					$nombre = $_POST['nombre'];
					$paterno = $_POST['paterno'];
					$materno = $_POST['materno'];
					$razon_social = $_POST['razon_social'];
					$apoderado = $_POST['apoderado'];
					$email = $_POST['email'];
					$direccion = $_POST['direccion'];
					$numero = $_POST['numero'];
					$depto = $_POST['depto'];
					$ciudad = $_POST['ciudad'];
					$id_region = $_POST['id_region'];
					$id_comuna = $_POST['id_comuna'];
		
					$firmada = $_POST['firmada'];
					$id_solicitante = $_POST['id_solicitante'];
					//echo "entra a rectificar";
					//echo "$folio,$id_usuario,$id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$email,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$firmada,$id_solicitante RR,$identificacion_documentos";
		
					Rectificar_solicitud_digitada($folio,$id_usuario,$id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$email,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$firmada,$id_solicitante,$identificacion_documentos);	
					
				}
			}
			
			
			if($_POST['firmada']==1){
				
				    header("Location:index.php?accion=$accion");
			}else{
				//si la solicitud no esta firmada se cambian de forma automatica sus estados a solicitudes pendientes de rectificación
				$folio = $_POST['folio'];
				$observacion="Cambio por reasignaci&oacute;n autom&aacute;tica por ingreso de solicitud no firmada, 
				se cambia a estado Pendiente Rectificaci&oacute;n";
				Insertar_historial($folio,5,$observacion);
		
		
		    $query= "SELECT id_perfil   
                   FROM  usuario_perfil 
                   WHERE perfil='Digitador'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($id_perfil_digitador) = mysql_fetch_row($result);
			 
			 if($id_perfil_digitador==perfil($id_sesion)){
			 	$id_perfil_asignacion_automatica = configuracion_cms('perfil_asignacion_defecto');
				
				    $query= "SELECT id_entidad
                           FROM  sgs_solicitud_acceso
                           WHERE folio = '$folio'";
                     $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      list($id_entidad_auto) = mysql_fetch_row($result);
					  
					      $query= "SELECT id_usuario
                                 FROM  usuario
                                 WHERE id_perfil='$id_perfil_asignacion_automatica' and id_entidad='$id_entida_auto'";
								 echo $query;
                           $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                           if(!list($id_usuario_asig) = mysql_fetch_row($result2)){
						   $id_usuario_asig = id_usuario($id_sesion);
						   }
						   $responsable_asig = nombre_usuario2($id_usuario_asig);
				
				
			 }else{
			  $id_usuario_asig = id_usuario($id_sesion);
			  $responsable_asig = nombre_usuario2($id_usuario_asig);
			 }
			 
			 
				$Sql ="UPDATE sgs_solicitud_acceso 
					   SET id_responsable = '$id_usuario_asig'
					   WHERE folio ='$folio'";

 				cms_query($Sql)or die (error($query,mysql_error(),$php));
				    
					   echo "<script>alert('La solicitud $folio NO ha sido firmada, se ha ingresado como una solicitud pendiente de Rectificaci\u00F3n y asignada a $responsable_asig'); document.location.href='index.php?accion=$accion&act=5&folio=$folio';</script>\n";
				
			}
			


		
         break;
   case 3:
       
	    
		 
         break;
		  case 4:
        		 $id_e = $_GET['id_e'];
				 
					$contenido = rescata_valor('sgs_estado_solicitudes',$id_e,'pregunta');
					
					//$contenido =  "hola";
         break;
    case 6 :
  		include("sgs/rectificar_solicitudes/listado.php");	
		break;
	case 7:
		
		include ("sgs/solicitudes/ingreso_archivos.php");
		break;	
	case 8:
		include("sgs/documentos_sistema/descarga.php");
		break;
   
   
   	default:
	   $def ="ok";
	
	$condicion_mis_solicitudes = "";
	
	if($_GET['tp']!=3){
			$condicion_mis_solicitudes = "";
			
			$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
			
			//Folio Fecha Solicitud  Fecha Finalización  Plazo Estado 
			$query= "SELECT id_usuario,nombre,paterno  
					   FROM  usuario u, usuario_perfil up
					   WHERE u.id_perfil=up.id_perfil 
					   and up.maneja_solicitudes = 1"; 
		
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			$estados = "<option value=\"\" ".$seleccionado.">Todos</option>";
			while (list($id_responsable_f,$nombre_f,$paterno_f) = mysql_fetch_row($result)){
				$paterno_f=utf8_encode($paterno_f);
				$nombre_f=utf8_encode($nombre_f);
					$query= "SELECT count(*)  
						   FROM  sgs_solicitud_acceso
						   WHERE id_responsable='$id_responsable_f' and  id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)";
					 $result_resp= mysql_query($query)or die (error($query,mysql_error(),$php));
					  list($tot_sol) = mysql_fetch_row($result_resp);
				
				if ($id_responsable_seleccionado==$id_responsable_f){
					$seleccionado = "selected";
				}else{
					$seleccionado = "";
				}
				if ($tot_sol > 0){
					$listado_responsables .= "<option value=\"$id_responsable_f\" ".$seleccionado.">$nombre_f $paterno_f ($tot_sol)</option>";
				}
			}
	
	
	
			$responsable = "<select  class=\"combo\" name=\"id_responsable_filtro\"  id=\"id_responsable_filtro\"   >
							<option value=\"#\" >Todos</option>
												".$listado_responsables."
						</select>";
						//llenar el combobox de estados
			
						
			$tipo="	<select  class=\"combo\"  name=\"tipo_filtro\" id=\"tipo_filtro\" >
							<option value=\"\" >Todos</option> 
							<option value=\"W\" ".$seleccionadoW.">Web</option>
							<option value=\"P\" ".$seleccionadoP.">Formulario</option>
							<option value=\"C\" ".$seleccionadoC.">Carta</option>
						
						</select>";
	
			$filtro = cambio_texto($filtro);		
			
			$query= "SELECT id_estado_solicitud,estado_solicitud
					 FROM  sgs_estado_solicitudes
					 WHERE id_estado_solicitud  in ($Estados_pendiente_rectificacion) ";
			 
			// echo $query;
			$result34= cms_query($query)or die (error($query,mysql_error(),$php));
			
			if ($id_estado_solicitud_seleccionado==0){
					$seleccionado = "selected";
			}else{
				$seleccionado = "";
			}
	  
			$estados = "<option value=\"\" ".$seleccionado.">Todas</option>";
	
			while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result34)){
				$estado_solicitud= cambio_texto($estado_solicitud);
		
				if ($id_estado_solicitud_seleccionado==$id_estado_solicitud){
					$seleccionado = "selected";
				}else{
					$seleccionado = "";
				}
					$estados .= "<option value=\"$id_estado_solicitud\" $seleccionado>$estado_solicitud  </option>";
			}
			
	
				$var = "seleccionado$tipo";
				$$var = "selected";
				/*$filtro = "	<select  class=\"combo\"  name=\"id_estado_solicitud_filtro\"  id=\"id_estado_solicitud_filtro\" >
								".$estados."
							</select><br>";*/
				
				
				//mis solicitudes
				  $id_usuario     = id_usuario($id_sesion);
				  $query= "SELECT count(*)   
						  FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
							WHERE a.id_estado_solicitud = b.id_estado_solicitud 
							
							  and c.id_estado_solicitud = a.id_sub_estado_solicitud
							  $condicion and  id_responsable='$id_usuario' $condicion_mis_solicitudes and  id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)
						";
				  //echo $query;
				  $result= cms_query($query)or die ("error 3");//(error($query,mysql_error(),$php));
				  list($tot_mis_solicitudes) = mysql_fetch_row($result);

				 if ($tot_mis_solicitudes>0){
					$mis_solicitudes =  "<a href=\"#\" id = \"mis_solicitudes\">Mis Solicitudes ($tot_mis_solicitudes)</a>";
				 }else{
					$mis_solicitudes = "Mis Solicitudes ($tot_mis_solicitudes)";
				 }
				
				
				//fin mis solicitudes
				
				$contenido = html_template('contenedor_listado_solicitudes_rectificadas_2');	
		
				$js .= "
				
				
				<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
				<script type=\"text/javascript\" charset=\"utf-8\">
					$(document).ready(function() {
						$('#listado').dataTable( {
							\"bServerSide\": true,
							\"bProcessing\": true,
							\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
							\"sPaginationType\": \"full_numbers\",
							\"bAutoWidth\": false,
							\"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 2,3,4,6 ] }], 
							\"aaSorting\": [[ 1, \"desc\" ]],
							\"aoColumns\": [ 
								/* Folio */   null,
								/* Fecha Solicitud */  null,
								/* Fecha Finalizacion */ { \"bSearchable\": false, \"bVisible\":    true },
								/* responsable */ { \"bSearchable\": false, \"bVisible\":    false },
								/* Plazo */  { \"bSearchable\": false },
								/* Estado */ { \"bSearchable\": false, \"bVisible\":    false },
								/* Ver */   { \"bSearchable\": false }
								],
							\"oLanguage\": {
								\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Folio, Fecha Ingreso</div >\"
								}
		
						} );
						$(\"#listado\").css(\"width\",\"100%\");
				
					
		
					} );
					
				$.fn.dataTableExt.afnFiltering.push(
					function( oSettings, aData, iDataIndex ) {
						return true;
					}
				);
		
				$(document).ready(function() {
					/* Initialise datatables */
					var oTable = $('#listado').dataTable();
					
					/* Add event listeners to the two range filtering inputs */
				
					
					$('.combo').change( function() { 
						
						oTable = $('#listado').dataTable();
						oTable.fnDestroy();
						
						$('#listado').dataTable( {
									\"bServerSide\": true,
									\"fnServerData\": function ( sSource, aoData, fnCallback ) {
											aoData.push( { \"name\": \"mis_solicitudes\", \"value\": $id_usuario } );
											aoData.push( { \"name\": \"id_responsable\", \"value\": $('#id_responsable_filtro').val() } );
											
											aoData.push( { \"name\": \"tipo_filtro\", \"value\": $('#tipo_filtro').val() } );
											$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
										},
									\"bProcessing\": true,
									\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
									\"sPaginationType\": \"full_numbers\",
									\"bAutoWidth\": false,
									\"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 2,3,4,6 ] }], 
									\"aaSorting\": [[ 1, \"desc\" ]],
									\"aoColumns\": [ 
										/* Folio */   null,
										/* Fecha Solicitud */  null,
										/* Fecha Finalizacion */ { \"bSearchable\": false, \"bVisible\":    true },
										/* responsable */ { \"bSearchable\": false, \"bVisible\":    false },
										/* Plazo */  { \"bSearchable\": false },
										/* Estado */ { \"bSearchable\": false, \"bVisible\":    false },
										/* Ver */   { \"bSearchable\": false }
										],
									\"oLanguage\": {
										\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Folio, Fecha Ingreso, Estado, Nombre Responsable</div >\"
										}
				
								} );
								$(\"#listado\").css(\"width\",\"100%\");
									
					//oTable.fnDraw(); 
					
					} );
					
					
					$('#mis_solicitudes').click( function() { 
						
						oTable = $('#listado').dataTable();
						oTable.fnDestroy();
						
						$('#listado').dataTable( {
									\"bServerSide\": true,
									\"fnServerData\": function ( sSource, aoData, fnCallback ) {
											aoData.push( { \"name\": \"id_responsable\", \"value\": $('#id_responsable_filtro').val() } );
											
											aoData.push( { \"name\": \"tipo_filtro\", \"value\": $('#tipo_filtro').val() } );
											$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
										},
									\"bProcessing\": true,
									\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
									\"sPaginationType\": \"full_numbers\",
									\"bAutoWidth\": false,
									\"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 2,3,4,6 ] }], 
									\"aaSorting\": [[ 1, \"desc\" ]],
									\"aoColumns\": [ 
										/* Folio */   null,
										/* Fecha Solicitud */  null,
										/* Fecha Finalizacion */ { \"bSearchable\": false, \"bVisible\":    true },
										/* responsable */ { \"bSearchable\": false, \"bVisible\":    false },
										/* Plazo */  { \"bSearchable\": false },
										/* Estado */ { \"bSearchable\": false, \"bVisible\":    false },
										/* Ver */   { \"bSearchable\": false }
										],
									\"oLanguage\": {
										\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Folio, Fecha Ingreso, Estado, Nombre Responsable</div >\"
										}
				
								} );
								$(\"#listado\").css(\"width\",\"100%\");
									
					//oTable.fnDraw(); 
					
					} );					
					
					
					
					
					
					
					
					
				} );
		
		
				</script>
					
	
					
		";
		
		$contenedor_rectificar_solicitudes = html_template('contenedor_rectificar_solicitudes');
		$contenedor_rectificar_solicitudes = cms_replace("#TIPO#","$tipo",$contenedor_rectificar_solicitudes);
		$contenedor_rectificar_solicitudes = cms_replace("#RESPONSABLE#","$responsable",$contenedor_rectificar_solicitudes);
		$contenedor_rectificar_solicitudes = cms_replace("#MIS_SOLICITUDES#","$mis_solicitudes",$contenedor_rectificar_solicitudes);
		$contenido .= $contenedor_rectificar_solicitudes;
		
		
		/*
		
		<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
  <tr>
    <td class=\"datos_sgs\"><table width=\"100%\" border=\"0\"  cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <th colspan=\"5\">Filtros de b&uacute;squeda</th>
      </tr>
      <tr>
        <td width=\"21%\" class=\"alt\">Seleccione un Tipo</td>
        <td><span class=\"textos\">$tipo</span></td>
        </tr>
      <tr>
        <td  class=\"alt\">Responsable</td>
        <td>$responsable &nbsp;&nbsp;$mis_solicitudes
            <input name=\"ms\" type=\"hidden\" id=\"ms\" value=\"0\" />
        </td>
       
      </tr>
    </table></td>
  </tr>
</table>					<br>
						
					
					<div id=\"container\">
					<div id=\"dynamic\">
					
		<table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
			
			
			<thead>
						
				<tr>
					<th>Folio</th>
					<th>Fecha Ingreso</th>
					<th>Fecha petici&oacute;n rectificaci&oacute;n</th>
					<th>Responsable</th>
					<th>Plazo para rectificar</th>
					<th>Estado</th>
					<th >Rectificar</th>
					
					
				</tr>
				
			</thead>
			
			<tbody>
			
				<tr>
					<td colspan=\"7\" class=\"dataTables_empty\"></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th>Folio</th>
					<th>Fecha Ingreso</th>
					<th>Fecha petici&oacute;n rectificaci&oacute;n</th>
					<th>Responsable</th>
					<th>Plazo para rectificar</th>
					<th>Estado</th>
					<th >Rectificar</th>
				</tr>
			</tfoot>
		</table>
				
	</div>	
	</div>
		
		
		*/
		

		
	}else{
		include("sgs/rectificar_solicitudes/lista_admin_solicitudes.php");
	}
	
	 
       
 }

?>