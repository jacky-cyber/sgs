<?php
$Etapa_fin= configuracion_cms('Estados_etapa_fin');	
$titulo_seccion = "Solicitudes a Asignar";	
	
				
	$tipo="	<select  class=\"combo\"  name=\"tipo_filtro\" id=\"tipo_filtro\" >
				    <option value=\"\" >Todos</option> 
					<option value=\"W\" ".$seleccionadoW.">Web</option>
				    <option value=\"P\" ".$seleccionadoP.">Formulario</option>
				    <option value=\"C\" ".$seleccionadoC.">Carta</option>
				
				</select>
				 
				
				";
	
	
				
	$listado_solciitudes_asignar = html_template('listado_solicitudes_asignar');			
	$listado_solciitudes_asignar = cms_replace("#TIPO_SOLICITUD#","$tipo",$listado_solciitudes_asignar);			
	$listado_solciitudes_asignar = cms_replace("#TITULO_SECCION#","$titulo_seccion",$listado_solciitudes_asignar);			
				
	$contenido = "

		
		
		<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
		<script type=\"text/javascript\" charset=\"utf-8\">
			$(document).ready(function() {
				$('#listado').dataTable( {
					\"bServerSide\": true,
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=6&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": false,
				    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 2,3,4,5 ] }], 
					\"aaSorting\": [[ 2, \"asc\" ]],
					\"aoColumns\": [ 
						/* Folio */   null,
						/* Fecha Solicitud */  null,
						/* Fecha Finalizacion */ { \"bSearchable\": false, \"bVisible\":    true },
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
				    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 2,3,4 ] }], 
					\"aaSorting\": [[ 2, \"asc\" ]],
					\"aoColumns\": [ 
						/* Folio */   null,
						/* Fecha Solicitud */  null,
						/* Fecha Finalizacion */ { \"bSearchable\": false, \"bVisible\":    true },
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


		</script>
			
			$listado_solciitudes_asignar
			
";
	
	
	
?>