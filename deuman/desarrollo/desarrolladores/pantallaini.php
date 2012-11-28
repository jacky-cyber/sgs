<?php





$template_ingreso=html_template('ingreso_app');
$template_ingreso=cms_replace("#TEXTO_NOMBRE_APP#","<input type=\"text\" id=\"nombre_app\" name=\"nombre_app\"/>",$template_ingreso);		
$template_ingreso=cms_replace("#TEXTO_DESCRIPCION_APP#","<textarea id=\"desc_app\" rows=\"5\" cols=\"30\" name=\"desc_app\" ></textarea>",$template_ingreso);		

$template_edicion=html_template('edicion_app');
$template_edicion=cms_replace("#TEXTO_NOMBRE_APP#","<input type=\"text\" id=\"nombre_app2\" name=\"nombre_app2\" value=\"\"/>",$template_edicion);		
$template_edicion=cms_replace("#TEXTO_DESCRIPCION_APP#","<textarea id=\"desc_app2\" rows=\"5\" cols=\"30\" name=\"desc_app2\" ></textarea>",$template_edicion);	


  $contenido = "
		
			<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
			<script type=\"text/javascript\" charset=\"utf-8\">		
			  $(document).ready(function() {
		
					oTable = $('#listado').dataTable();
					oTable.fnDestroy();
					$('#listado').dataTable( {
						\"bServerSide\": true,
						\"bProcessing\": true,
						\"sAjaxSource\": \"?accion=$accion&act=2&axj=1\",
						\"sPaginationType\": \"full_numbers\",
						\"bAutoWidth\": false,
					    \"aoColumnDefs\": [{\"bSortable\": false, \"aTargets\": [3,5]}], 
						\"aaSorting\": [[ 1, \"desc\" ]],
						\"aoColumns\": [ 
							/* Folio */   null,
							/* Fecha Ingreso */  null,
							/* Fecha estimada de t&eacute;rmino */ { \"bSearchable\": true, \"bVisible\":    true },
							/* Plazo */  { \"bSearchable\": false },
							/* editar */  null
							],
						\"oLanguage\": {
							\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Nombre App </div >\"
							,\"sSearch\": 'Buscar por: Nombre App'
							}
						
					});
			  
				$('#creaApp').live('click',function(){
					
					jQuery(\"#dialogo\").dialog({
						modal: true,
						title:'Ingreso App',
						width:500,
						buttons: {
							Guardar: function(){
										if(jQuery.trim($('#nombre_app').val())!=''){
											$.post('index.php?accion=$accion&act=3&axj=1',{
												nombre_app:jQuery.trim($('#nombre_app').val()),
												desc_app:jQuery.trim($('#desc_app').val())
											}, function(resp){
												location.reload();
												$(this).dialog('close');
											});
										}else{
											jQuery(\"#dialogo3\").dialog({
												modal: true,
												buttons: {
														 Cerrar: function(){
															$(this).dialog('close');
														 }
												}
											});
										}
										
							}
						}
					});
				});
				/*$('#editarApp').live('click',function(){
					jQuery(\"#dialogo2\").dialog({
						modal: true,
						title:'Edici&oacute;n App',
						width:500,
						buttons: {
								 Guardar: function(){
									$.post('index.php?accion=$accion&act=4&axj=1',{
											id_app:$('#desc_app').val()
									}, function(resp){
											location.reload();
									});
									$(this).dialog('close');
								 }
						}		 
					});
				});*/
			  });
			  
			 	function editar_app(id) {
				 $(function(){
					
					$.post('index.php?accion=$accion&act=4&axj=1',{
											id_app:id
					}, function(resp){
							$('#nombre_app2').val(resp.nombre_app);
							$('#desc_app2').val(resp.descripcion_app);
							if(resp.estado_app==1)
								$('#estado_app2').attr('checked', true);
							if(resp.estado_app==0)
								$('#estado_app3').attr('checked', true);
							
							
							
					},'json');
				 
					jQuery(\"#dialogo2\").dialog({
						modal: true,
						title:'Edici&oacute;n App',
						width:500,
						buttons: {
								 Guardar: function(){
									 if(jQuery.trim($('#nombre_app2').val())!=''){
										$.post('index.php?accion=$accion&act=5&axj=1',{
												nombre_app2:jQuery.trim($('#nombre_app2').val()),
												desc_app2:jQuery.trim($('#desc_app2').val()),
												estado_app2:1,
												id_app:id
										}, function(resp){
												location.reload();
												$(this).dialog('close');
										});
									 }else{
										jQuery(\"#dialogo3\").dialog({
											modal: true,
											buttons: {
													 Cerrar: function(){
														$(this).dialog('close');
													 }
											}
										});
									 }									 
									
								 }
						}		 
					});
					
					
				 });
			} 
			
			

					
			</script>
<h2>Mis Apps</h2>
	<div  class=\"banner_home\">	
		<div>	
			<a style=\"cursor:pointer;\" id=\"creaApp\"><img height=\"42\" width=\"44\" src=\"sgs/css/../images/home/preferencias.png\" border=\"0\" />Ingresar app</a>
			<br />
			<br />
			<br />
		
			  <table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\"  id=\"listado\" >
			  	<thead>
					<tr>
						<th class=\"alt\">Nombre App</th>
						<th class=\"alt\">Fecha Creaci&oacute;n</th>
						<th class=\"alt\">Token</th>
						<th class=\"alt\">Ping</th>
						<th class=\"alt\">Estado</th>
						<th class=\"alt\">Edici&oacute;n</th>
					</tr>
				</thead>
				<tbody style=\"background-color:#FFF;\">
				</tbody>
				<tfoot>
					<tr>
						<th class=\"alt\">Nombre App</th>
						<th class=\"alt\">Fecha Creaci&oacute;n</th>
						<th class=\"alt\">Token</th>
						<th class=\"alt\">Ping</th>
						<th class=\"alt\">Estado</th>
						<th class=\"alt\">Edici&oacute;n</th>
					</tr>
				</tfoot>
				

			</table>
			
		</div>
<br />
<br />		
	</div>	
$template_ingreso
$template_edicion
<div id=\"dialogo3\" style=\"display:none;\" >Debe Ingresar Nombre App.</div>
<script>
			 /*$(function(){
				$('#listado_first').css('background-color','#000');
				
			 });*/
			  $(function(){
				$('#listado_length').css('width','300px');
				
			 });
			
			
			 </script> 
			  ";

?>