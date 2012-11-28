<?php
$Etapa_fin= configuracion_cms('Estados_etapa_fin');	
	
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
                   WHERE id_responsable='$id_responsable_f' and  id_sub_estado_solicitud in ($Etapa_fin)";
             $result_resp= mysql_query($query)or die (error($query,mysql_error(),$php));
              list($tot_sol) = mysql_fetch_row($result_resp);
		
		if ($id_responsable_seleccionado==$id_responsable_f){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		if($tot_sol>0){
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
				
				</select>
				 
				
				";
	
				$filtro = cambio_texto($filtro);		
				$Etapa_fin= configuracion_cms('Estados_etapa_fin');	
				$query= "SELECT id_estado_solicitud,estado_solicitud
		 				 FROM  sgs_estado_solicitudes
             			 WHERE id_estado_solicitud  in ($Etapa_fin) ";
			 
			// echo $query;
	$result34= cms_query($query)or die (error($query,mysql_error(),$php));
	
	if ($id_estado_solicitud_seleccionado==0){
			$seleccionado = "selected";
	}else{
		$seleccionado = "";
	}
	  
	$estados = "<option value=\"\" ".$seleccionado.">Todas</option>";
	
	while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result34)){
		$estado_solicitud= $estado_solicitud;

		if ($id_estado_solicitud_seleccionado==$id_estado_solicitud){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		    $estados .= "<option value=\"$id_estado_solicitud\" $seleccionado>$estado_solicitud  </option>";
		}
	
	
	$var = "seleccionado$tipo";
	$$var = "selected";
	$filtro = "	<select  class=\"combo\"  name=\"id_estado_solicitud_filtro\"  id=\"id_estado_solicitud_filtro\" >
					".$estados."
				</select><br>";
				
				
		$js .="<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
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
				    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 2,3,4,6 ] }], 
					\"aaSorting\": [[ 1, \"desc\" ]],
					\"aoColumns\": [ 
						/* Folio */   null,
						/* Fecha Solicitud */  null,
						/* Fecha Finalizacion */ { \"bSearchable\": false, \"bVisible\":    true },
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
					
	//oTable.fnDraw(); 
	
	} );
	
} );


		</script>";		


/*
		
	$contenido = "

		<h3>Solicitudes Finalizadas</h3>
<br>
				
<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
  <tr>
    <td class=\"datos_sgs\"><table width=\"100%\" border=\"0\"  cellspacing=\"0\" cellpadding=\"0\">
      <tr>
        <th colspan=\"7\">Filtros de b&uacute;squeda</th>
      </tr>
      <tr>
        <td width=\"21%\" class=\"alt\"><span class=\"textos\">Seleccione un Estado</span></td>
        <td width=\"33%\">$filtro</td>
        <td width=\"20%\" class=\"alt\">Seleccione un Tipo</td>
        <td width=\"26%\"   >$tipo</td>
      </tr>
      <tr>
        <td  class=\"alt\">Responsable</td>
        <td colspan=\"3\">$responsable&nbsp;&nbsp;<input name=\"ms\" type=\"hidden\" id=\"ms\" value=\"0\" />
        </td>
       
      </tr>
    </table></td>
  </tr>
</table>	

		
			
			<div id=\"container\">
			<div id=\"dynamic\">
			
<table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
	
	
	<thead>
				
		<tr>
			<th>Folio</th>
			<th>Fecha Ingreso</th>
			<th>Fecha Finalizaci&oacute;n</th>
			<th>Responsable</th>
			<th>Plazo<a href=\"index.php?accion=help&c=plazo-solicitude-finalizadas&width=320&axj=1\" class=\"jTip\" id=\"Plazo_termino\" name=\"Plazo de t&eacute;rmino de solicitud\"><img src=\"images/help.png\" alt=\"\" class=\"valign\" border=\"0\"></a></th>
			<th>Estado</th>
			<th >Ver</th>
			
			
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
			<th>Fecha Finalizaci&oacute;n</th>
			<th>Responsable</th>
			<th>Plazo</th>
			<th>Estado</th>
			<th >Ver</th>
		</tr>
	</tfoot>
</table>
		
		</div>	
		</div>	
			
";

*/
	
	$contenedor_solicitudes_finalizadas = html_template('contenedor_solicitudes_finalizadas');
	$contenedor_solicitudes_finalizadas = cms_replace("#FILTRO#","$filtro",$contenedor_solicitudes_finalizadas);
	$contenedor_solicitudes_finalizadas = cms_replace("#TIPO#","$tipo",$contenedor_solicitudes_finalizadas);
	$contenedor_solicitudes_finalizadas = cms_replace("#RESPONSABLE#","$responsable",$contenedor_solicitudes_finalizadas);
	
	$contenido = $contenedor_solicitudes_finalizadas;
	
	
?>