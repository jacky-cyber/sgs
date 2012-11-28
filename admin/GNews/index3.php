<?php

	$qry = "SELECT id_tipo,descripcion 
          FROM contenido_tipo ";
    $result_qry = cms_query($qry) or die ("problemas en la consulta 1.<br>$qry");
    
	while (list($id_tipo,$descripcion)= mysql_fetch_row($result_qry)){
	  $lista_tipo_contenido .="<option value=\"$id_tipo\">$descripcion</option>";
	  
	}

$slect_filtro_tipo="<select name=\"id_tipo\" id=\"id_tipo\" class=\"combo\">

<option value=\"\">---></option>
$lista_tipo_contenido
</select>";

$tabla_filtro ="<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
    <tr >
      <td ><a href=\"index.php?accion=$accion&act=4\">Agregar Publicador</a></td>
      
      <td  > <a href=\"index.php?accion=$accion&act=5\">Plantila de Noticias</a></td>
      <td  ><a href=\"index.php?accion=$accion&act=1\">Agregar Noticia</a></td> </tr>
      <tr><td   colspan=\"3\">Tipo de Noticia $slect_filtro_tipo
      
  
      </td></tr> 
	</table>
	
	
	
	";
	
	
 $css .="<link rel=\"stylesheet\" type=\"text/css\" href=\"css/listado_auto.css\"/>
	";
  $contenido = "
		
			<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
			<script type=\"text/javascript\" charset=\"utf-8\">		
			  $(document).ready(function() {
		
					oTable = $('#listado').dataTable();
					oTable.fnDestroy();
					$('#listado').dataTable( {
						\"bServerSide\": true,
						\"bProcessing\": true,
						\"sAjaxSource\": \"?accion=$accion&act=13&axj=1\",
						\"sPaginationType\": \"full_numbers\",
						\"bAutoWidth\": false,
						\"bFilter\": true,
					    \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [4,5,6,7] }], 
						\"aoColumns\": [ 
							/* Titulo */  { \"sWidth\": \"55%\" }
							],
						\"oLanguage\": {
							\"sSearch_help\": \"<br><div class='msg_search'>Buscar :</div >\"
							}
					});
			  });
			  
			$(document).ready(function(){
				/* Initialise datatables */
				var oTable = $('#listado').dataTable();
				
				/* Add event listeners to the two range filtering inputs */

				
				$('.combo').change( function() { 
					
					oTable = $('#listado').dataTable();
					oTable.fnDestroy();
					
						
					$('#listado').dataTable( {
						\"bServerSide\": true,
						\"fnServerData\": function ( sSource, aoData, fnCallback ) {
							aoData.push( { \"name\": \"id_tipo\", \"value\": $('#id_tipo').val() } );
							$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
						},
						\"bProcessing\": true,
						\"sAjaxSource\": \"?accion=$accion&act=13&axj=1\",
						\"sPaginationType\": \"full_numbers\",
						\"bAutoWidth\": false,
						\"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [4,5,6,7] }], 
						\"aoColumns\": [ 
							/* Titulo */  { \"sWidth\": \"55%\" }
							],
						\"oLanguage\": {
							\"sSearch_help\": \"<br><div class='msg_search'>Buscar : </div >\"
							}

					});
				//oTable.fnDraw();
				});
			});

					
			</script>
			  $tabla_filtro
			
			
			  <table  class=\"texto\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" style=\"width: 100%;\">
			  	<thead>
				<tr>
					<th>Titulo</th>
					<th>Tipo</th>
					<th>Gal</th>
					<th>Activo</th>
					<th >Edit</th>
					<th >Del</th>
					<th >Clicks</th>
					
				</tr>
				</thead>
				
				<tbody>
				
				</tbody>
				
				<tfoot>
					<tr>
					<th>Titulo</th>
					<th>Tipo</th>
					<th>Gal</th>
					<th>Activo</th>
					<th >Edit</th>
					<th >Del</th>
					<th >Clicks</th>
					</tr>
				</tfoot>
				

			</table>
			
			
			  
			  ";
			  
			  $contenedor = html_template('contenedor');
			  
			  $contenido  = cms_replace("#CONTENIDO#","$contenido",$contenedor);

?>