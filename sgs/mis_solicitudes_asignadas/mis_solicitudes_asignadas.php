<?php
$id_usuario     = id_usuario($id_sesion);


switch ($act) {
     case 1:
	 		 $folio = $_GET['folio'];
			
			 
			 
			 $link_print= "
			 <div align=\"right\"><a  href=\"#\"  class=\"comprobante\">
			 <img onclick=\"window.open('index.php?accion=$accion&act=13&folio=$folio&axj=1&p=1','ventana','width=800,height=800,resizable=no');\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a></div>";
			
			 
	 		 
         include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_ver.php");
         break;
	 case 2:
	 	 //include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_update.php");
		 include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_cambia_estado.php");
		header("location:index.php?accion=$accion&act=1&folio=$folio&mensaje=$mensaje");
         break;
   case 3:
       
	    
		 
         break;
   case 4:
        $id_e = $_GET['id_e'];
		$contenido = rescata_valor('sgs_estado_solicitudes',$id_e,'pregunta');
			
         break;
   
   case 5:
   $id_estado_padre = $_POST['id_estado_solicitud'];
       
	       $query= "SELECT id_estado_solicitud,estado_solicitud
                  FROM  sgs_estado_solicitudes
                  WHERE id_estado_padre='$id_estado_padre' and id_estado_solicitud<>id_estado_padre";
				
				  
            $result= cms_query($query)or die (error($query,mysql_error(),$php));
             while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result)){
       		$lista_sel .="<option value=\"$id_estado_solicitud\">$estado_solicitud</option>\n";		   
		 		}
         $contenido .= "<option value=\"0\">Seleccione un Estado</option>\n
		 				$lista_sel";
	   	
         break;
  case 6 :
  		include("sgs/mis_solicitudes_asignadas/listado.php");	
		break;
  case 7 :	
  			$id_estado_solicitud = $_POST['id_estado_solicitud'];
  		    $query= "SELECT comentario_para_usuario   
                     FROM  sgs_estado_solicitudes 
				     WHERE id_estado_solicitud='$id_estado_solicitud'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              list($contenido) = mysql_fetch_row($result);
			  
				 
				 
		break;
		

	case 8:
		
		include ("sgs/solicitudes/ingreso_archivos.php");
		break;
	
	case 9:
		include ("sgs/documentos_sistema/descarga.php");
		break;
	case 13:
		include ("sgs/admin_solicitudes/detalle_solicitud_imprimir.php");
		break;
		
	case 14:
		include ("sgs/plantilla_respuestas/carga_plantilla.php");
		break;
   	default:
		$def ="ok";
		$contenido = html_template('contenedor_listado_admin_solicitudes2');	
		$condicion_mis_solicitudes = "";
		
		$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
		$Estados_etapa_fin= configuracion_cms('Estados_etapa_fin');	
		$Estados_etapa_respondida= configuracion_cms('Estados_etapa_respondida');	

		$and_solicitudes_en_proceso = " and id_sub_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";
		$and_id_estado_solicitud = " and id_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";

	
		if ($_GET['tp']!=3){
			$id_user= id_usuario($id_sesion);
			$query= "SELECT id_entidad 
					   FROM  usuario
					   WHERE id_usuario='$id_user'";
			 $result= mysql_query($query)or die (error($query,mysql_error(),$php));
			  if(list($id_entidad_user) = mysql_fetch_row($result)){
				$and = $and." AND id_entidad =  '$id_entidad_user' ";
			  }
			
			//mis solicitudes
			$id_usuario = id_usuario($id_sesion);
			
			$query= "SELECT count(*)   
					  FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
						WHERE a.id_estado_solicitud = b.id_estado_solicitud 
						  and c.id_estado_solicitud = a.id_sub_estado_solicitud
						  $and_solicitudes_en_proceso and  id_responsable='$id_usuario' 
						  and a.id_entidad =  '$id_entidad_user'  ";
			 //echo $query;
			 $result= cms_query($query)or die (error($query,mysql_error(),$php));
			 list($tot_mis_solicitudes) = mysql_fetch_row($result);
			 
			 if ($tot_mis_solicitudes>0){
				$mis_solicitudes =  "<input type=\"checkbox\" name=\"mis_solicitudes\"  id=\"mis_solicitudes\" value=\"checkbox\">
				Mis Solicitudes ($tot_mis_solicitudes)";
			 }else{
				$mis_solicitudes = "<input type=\"hidden\" name=\"mis_solicitudes\"  id=\"mis_solicitudes\">Mis Solicitudes ($tot_mis_solicitudes)";
			 }
	 
	 		//fin mis solicitudes
	 
			 
			 //solicitudes sin asignar
			 $sol_sin_asignar = 0;
			 $fecha_sol_mas_antigua = "9999-99-99";
			 
			 $query= "SELECT folio,id_solicitud_acceso, fecha_inicio,
							fecha_termino					
					FROM  sgs_solicitud_acceso 
					WHERE id_responsable = 0 
						and id_estado_solicitud = 1
					and id_sub_estado_solicitud = 2
					and id_entidad = '$id_entidad_user'
					order by fecha_inicio asc";
			//echo "<br> dos: ".$query."<br>";
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
			$sol_sin_asignar = mysql_num_rows($result);
		
			while (list($folio,$id_solicitud_acceso,$fecha_ingreso,$fecha_termino) = mysql_fetch_row($result)){
			//echo $folio."<br>";
					if ($fecha_sol_mas_antigua > $fecha_ingreso ) {
						$fecha_sol_mas_antigua = $fecha_ingreso;
					}
					
			}
			$fecha_sol_mas_antigua = fechas_html($fecha_sol_mas_antigua);
	 
	 		
	 
			 if ($sol_sin_asignar > 0 ){
				//template de mensaje de solicitudes sin asignar
				$mensaje_sin_asignar = html_template('mensaje_cantidad_solicitudes_responsable');
				$estado_glosa =  html_template('estado_glosa_responsable');
				$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
				$contenido = cms_replace("#ESTADO_GLOSA#",$estado_glosa,$contenido);
		
				//template de link sin asignar
				$mensaje_sin_asignar = html_template('link_cantidad_solicitudes_responsable');
				$contenido = cms_replace("#LINK_SOLICITUDES_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
				$contenido = cms_replace("#LINK_ASIGNAR_SOLICITUDES_PENDIENTES#","index.php?accion=$accion&id_estado_solicitud=2",$contenido);	
				
				$contenido = cms_replace("#TOTAL_SOLICITUDES_SIN_ASIGNAR#",$sol_sin_asignar,$contenido);
				$contenido = cms_replace("#FECHA_MAS_ANTIGUA#",$fecha_sol_mas_antigua,$contenido);
				
			}else{
				$mensaje_sin_asignar = html_template('mensaje_vacio_solicitudes_responsable');
				$contenido = cms_replace("#MENSAJE_SIN_ASIGNAR#",$mensaje_sin_asignar,$contenido);
				
				$contenido = cms_replace("#LINK_SOLICITUDES_SIN_ASIGNAR#"," ",$contenido);
				
			}
			//fin solicitudes sin asignar
	
	
		
				//Folio Fecha Solicitud  Fecha Finalización  Plazo Estado 
				
			//responsables con cantidad de solicitudes en proceso	
			$query= "SELECT id_usuario,nombre,paterno  
					   FROM  usuario u, usuario_perfil up
					   WHERE u.id_perfil=up.id_perfil 
					   and u.id_entidad = '$id_entidad_user'
					   and up.maneja_solicitudes = 1"; 
		
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			$estados = "<option value=\"\" ".$seleccionado.">Todos</option>";
			while (list($id_responsable_f,$nombre_f,$paterno_f) = mysql_fetch_row($result)){
				$paterno_f=utf8_encode($paterno_f);
				$nombre_f=utf8_encode($nombre_f);
					$query= "SELECT count(*)  
						   FROM  sgs_solicitud_acceso
						   WHERE id_responsable='$id_responsable_f' $and_solicitudes_en_proceso and id_entidad = '$id_entidad_user' ";
					 //echo "\n\n $query";
					 $result_resp= mysql_query($query)or die (error($query,mysql_error(),$php));
					 $tot_sol = 0;
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
	
				
			$tipo="	<select  class=\"combo\" name=\"tipo_filtro\" id=\"tipo_filtro\" >
							<option value=\"\" >Todos</option> 
							<option value=\"W\" ".$seleccionadoW.">Web</option>
							<option value=\"P\" ".$seleccionadoP.">Formulario</option>
							<option value=\"C\" ".$seleccionadoC.">Carta</option>
						
						</select>";
	
			$filtro = cambio_texto($filtro);		
			
			//armar el combo con el estado de las solicitudes
			$query= "SELECT id_estado_solicitud,
					estado_solicitud
			 FROM  sgs_estado_solicitudes 
			 where id_estado_padre=3 and id_estado_solicitud<>3 $and_id_estado_solicitud "; 
			 
			//echo $query;
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
	$filtro = "	<select  class=\"combo\" name=\"id_estado_solicitud_filtro\"  id=\"id_estado_solicitud_filtro\" >
					".$estados."
				</select><br>";
				
				
				
				
	$contenido .= "

		
		
		<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
		<script type=\"text/javascript\" charset=\"utf-8\">
			$(document).ready(function() {
				$('#listado').dataTable( {
					\"bServerSide\": true,
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": false,
				    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 3,4,5,6 ] }], 
					\"aaSorting\": [[ 1, \"desc\" ]],
					\"aoColumns\": [ 
						/* Folio */   null,
						/* Fecha Solicitud */  null,
						/* Fecha Finalizacion */ { \"bSearchable\": true, \"bVisible\":    true },
						/* responsable */ { \"bSearchable\": false, \"bVisible\":    false },
						/* Plazo */  { \"bSearchable\": false },
						/* Estado */  null,
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
							aoData.push( { \"name\": \"id_responsable\", \"value\": $('#id_responsable_filtro').val() } );
							aoData.push( { \"name\": \"id_estado_solicitud_filtro\", \"value\": $('#id_estado_solicitud_filtro').val() } );
							aoData.push( { \"name\": \"tipo_filtro\", \"value\": $('#tipo_filtro').val() } );
							$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
						},
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": false,
				    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 3,4,5,6 ] }], 
					\"aaSorting\": [[ 1, \"desc\" ]],
					\"aoColumns\": [ 
						/* Folio */   null,
						/* Fecha Solicitud */  null,
						/* Fecha Finalizacion */ { \"bSearchable\": true, \"bVisible\":    true },
						/* responsable */ { \"bSearchable\": false, \"bVisible\":    false },
						/* Plazo */  { \"bSearchable\": false },
						/* Estado */  null,
						/* Ver */   { \"bSearchable\": false }
						],
					\"oLanguage\": {
						\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Folio, Fecha Ingreso, Estado, Nombre Responsable</div >\"
						}

				} );
					
	//oTable.fnDraw(); 
	 $(\"#listado\").css(\"width\",\"100%\");
	} );
	
	
	
	$('#mis_solicitudes').click( function() { 
		


		if ($('#mis_solicitudes').is(':checked')) {
			
			

		oTable = $('#listado').dataTable();
		oTable.fnDestroy();

		$('#listado').dataTable( {
					\"bServerSide\": true,
					\"fnServerData\": function ( sSource, aoData, fnCallback ) {
							aoData.push( { \"name\": \"mis_solicitudes\", \"value\": $id_user } );
							aoData.push( { \"name\": \"id_responsable\", \"value\": $('#id_responsable_filtro').val() } );
							aoData.push( { \"name\": \"id_estado_solicitud_filtro\", \"value\": $('#id_estado_solicitud_filtro').val() } );
							aoData.push( { \"name\": \"tipo_filtro\", \"value\": $('#tipo_filtro').val() } );
							$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
						},
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": false,
				    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 3,4,5,6 ] }], 
					\"aaSorting\": [[ 1, \"desc\" ]],
					\"aoColumns\": [ 
						/* Folio */   null,
						/* Fecha Solicitud */  null,
						/* Fecha Finalizacion */ { \"bSearchable\": true, \"bVisible\":    true },
						/* responsable */ { \"bSearchable\": false, \"bVisible\":    false },
						/* Plazo */  { \"bSearchable\": false },
						/* Estado */  null,
						/* Ver */   { \"bSearchable\": false }
						],
					\"oLanguage\": {
						\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Folio, Fecha Ingreso, Estado, Nombre Responsable</div >\"
						}
				 
				} );
				  $(\"#listado\").css(\"width\",\"100%\");
					
	} else {
			oTable = $('#listado').dataTable();
		oTable.fnDestroy();

		$('#listado').dataTable( {
					\"bServerSide\": true,
					\"fnServerData\": function ( sSource, aoData, fnCallback ) {
							aoData.push( { \"name\": \"id_responsable\", \"value\": $('#id_responsable_filtro').val() } );
							aoData.push( { \"name\": \"id_estado_solicitud_filtro\", \"value\": $('#id_estado_solicitud_filtro').val() } );
							aoData.push( { \"name\": \"tipo_filtro\", \"value\": $('#tipo_filtro').val() } );
							$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
						},
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": false,
				    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 3,4,5,6 ] }], 
					\"aaSorting\": [[ 1, \"desc\" ]],
					\"aoColumns\": [ 
						/* Folio */   null,
						/* Fecha Solicitud */  null,
						/* Fecha Finalizacion */ { \"bSearchable\": true, \"bVisible\":    true },
						/* responsable */ { \"bSearchable\": false, \"bVisible\":    false },
						/* Plazo */  { \"bSearchable\": false },
						/* Estado */  null,
						/* Ver */   { \"bSearchable\": false }
						],
					\"oLanguage\": {
						\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Folio, Fecha Ingreso, Estado, Nombre Responsable</div >\"
						}

				} );
				$(\"#listado\").css(\"width\",\"100%\");
		}
	
	} );
	
	
	
	
	
	
	
	
	
} );


		</script>
			
<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
  <tr>
    <td class=\"datos_sgs\"><table width=\"100%\" border=\"0\"  cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <th colspan=\"7\">Filtros de b&uacute;squeda</th>
      </tr>
      <tr>
        <td width=\"21%\" class=\"alt\">Seleccione un estado</td>
        <td width=\"33%\">$filtro</td>
        <td width=\"20%\" class=\"alt\">Seleccione un Tipo</td>
        <td width=\"26%\"   >$tipo</td>
      </tr>
      <tr>
        <td  class=\"alt\">Responsable</td>
        <td colspan=\"3\">$responsable &nbsp;&nbsp;$mis_solicitudes
            <input name=\"ms\" type=\"hidden\" id=\"ms\" value=\"0\" />
        </td>
       
      </tr>
    </table></td>
  </tr>
</table>				

<br>
				
			
			<div id=\"container\">
			<div id=\"dynamic\">
			
<table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
	
	
	<thead>
				
		<tr>
			<th>Folio</th>
			<th>Fecha Ingreso</th>
			<th>Fecha estimada de t&eacute;rmino</th>
			<th>Responsable</th>
			<th>Plazo<a href=\"index.php?accion=help&c=plazo-solicitude-finalizadas&width=320&axj=1\" class=\"jTip\" id=\"Plazo_termino\" name=\"Plazo de t&eacute;rmino de solicitud\"><img src=\"images/help.png\" alt=\"\" class=\"valign\" border=\"0\"></a></th>
			<th>Estado</th>
			<th ></th>
			
			
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
			<th>Fecha estimada de t&eacute;rmino</th>
			<th>Responsable</th>
			<th>Plazo</th>
			<th>Estado</th>
			<th >Editar</th>
		</tr>
	</tfoot>
</table>
		
		</div>	
		</div>	
			
";

		
	}else{
		include("sgs/mis_solicitudes_asignadas/lista_admin_solicitudes.php");
	}
	
	 
       
 }

?>