<?php

$filtro_estado = "<select class=\"combo\" name=\"estado\" id=\"estado\">
<option value=\"#\">Seleccione Estado</option>
<option value=\"0\">Registro Incompleto</option>
<option value=\"1\">Registro Completo</option>
<option value=\"2\">Bloqueado</option>
</select>";
			
$id_perfil_conect = perfil($id_sesion);

    	if($id_perfil_conect!=1004){
	
		    $query= "SELECT id_perfil   
                   FROM  usuario_perfil
                   WHERE funcionario='0' and administracion='0'";
             $result= mysql_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_perfil) = mysql_fetch_row($result)){
        				$lista_perfiles .="$id_perfil,";		   
        		 }
		$lista_perfiles = elimina_ultimo_caracter($lista_perfiles);
		$sWhere_perfiles = " and id_perfil  in ($lista_perfiles) ";
		
		}else{
				$sWhere_perfiles = " and id_perfil<>'999' and id_perfil<>'4'";
				$ico_add_user = "<tr><td align=\"right\"  colspan=\"2\"><a href=\"index.php?accion=$accion&act=4\">
					<img src=\"images/add.png\" alt=\"Nuevo Usuario\" border=\"0\"></a></td></tr> ";	
					$lista_uuarios_xls="<tr>  
<td align=\"right\" colspan=\"2\" class=\"textos\"><a href=\"index.php?accion=$accion&act=11&axj=1\" target=\"_blank\">
Exportar a hoja de c&aacute;lculo los usuarios del sistema
  </a></td></tr>";
		}
	
	
	$query= "SELECT id_perfil,perfil 
           FROM  usuario_perfil
		   WHERE 1 $sWhere_perfiles ";
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_perfil,$perfil) = mysql_fetch_row($result)){
				$lista_perfil .="<option value=\"$id_perfil\">$perfil</option>";		   
		 }
		 
		$filtro_tipo = "<select class=\"combo\" name=\"id_perfil\" id=\"id_perfil\">
							<option value=\"#\">Seleccione Tipo</option>
							$lista_perfil
						</select>"; 
			

	$js .= "

		
		
		<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
		<script type=\"text/javascript\" charset=\"utf-8\">
			$(document).ready(function() {
				$('#listado').dataTable( {
					\"bServerSide\": true,
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=12&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": false,
				     \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 5 ] }], 
					\"aaSorting\": [[ 0, \"asc\" ]],
					\"aoColumns\": [ 
						/* col 0 */   null,
						/* col 1 */  { \"bSearchable\": false },
						/* col 2 */ { \"bSearchable\": false },
						/* col 3 */ null,
						/* col 4 */  { \"bSearchable\": false },
						/* col 5 */  { \"bSearchable\": false }
						],
					\"oLanguage\": {
							\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Nombre, Apellido, Correo Eletr&oacute;nico</div >\"
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
							aoData.push( { \"name\": \"id_perfil\", \"value\": $('#id_perfil').val() } );
							aoData.push( { \"name\": \"estado\", \"value\": $('#estado').val() } );
							$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
						},
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=12&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": true,
				   \"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ 5 ] }],
					\"aaSorting\": [[ 0, \"asc\" ]],
					\"aoColumns\": [ 
						/* col 0 */   null,
						/* col 1 */  { \"bSearchable\": false },
						/* col 2 */ { \"bSearchable\": false },
						/* col 3 */ null,
						/* col 4 */  { \"bSearchable\": false },
						/* col 5 */  { \"bSearchable\": false }
						],
					\"oLanguage\": {
						\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Nombre, Apellido, Correo Eletr&oacute;nico</div >\"
						}

				} );
				$(\"#listado\").css(\"width\",\"100%\");
					
	//oTable.fnDraw(); 
	
	} );
	
} );


		</script>
			
";

	$contenedor_listado_usuarios = html_template('contenedor_listado_usuarios');
	$contenedor_listado_usuarios = cms_replace("#ICO_ADD_USER#","$ico_add_user",$contenedor_listado_usuarios);
	$contenedor_listado_usuarios = cms_replace("#LISTA_USUARIOS_XLS#","$lista_uuarios_xls",$contenedor_listado_usuarios);
	$contenedor_listado_usuarios = cms_replace("#FILTRO_ESTADO#","$filtro_estado",$contenedor_listado_usuarios);
	$contenedor_listado_usuarios = cms_replace("#FILTRO_TIPO#","$filtro_tipo",$contenedor_listado_usuarios);
	$contenido = $contenedor_listado_usuarios;
	
	/*
	
					<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                
				
				$ico_add_user	 
				$lista_uuarios_xls
				<tr><td align=\"left\" class=\"textos\">Seleccione un estado $filtro_estado</td>
				<td align=\"right\" class=\"textos\">Seleccione un Tipo $filtro_tipo</td>
				</tr> 
					
            	</table><br>
			
			<div id=\"container\">
			<div id=\"dynamic\">
			
<table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
	
	
	<thead>
				
		<tr>
			<th>Usuario</th>
			<th>Tipo</th>
			<th>Departamento/Unidad</th>
			<th>Correo Electr&oacute;nico</th>
			<th>Estado</th>
			<th></th>
			
			
			
		</tr>
		
	</thead>
	
	<tbody>
	
		<tr>
			<td colspan=\"7\" class=\"dataTables_empty\"></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<th>Usuario</th>
			<th>Tipo</th>
			<th>Departamento/Unidad</th>
			<th>Correo Electr&oacute;nico</th>
			<th>Estado</th>
			<th>Editar</th>
		</tr>
	</tfoot>
</table>
		
		</div>	
		</div>	
	<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" align=\"center\" width=\"90%\">            			<tbody><tr>        			 
	<td align=\"left\"> <img border=\"0\" src=\"images/ciculo_ok.gif\">  Usuario Activo</td> 	  			</tr>
	<tr>
	<td align=\"left\"><img border=\"0\" src=\"images/ciculo_warring.gif\">  Usuario Inactivo</td></tr>
<tr><td align=\"left\"><img border=\"0\" src=\"images/minus_circle.gif\">  Usuario Bloqueado</td>
</tr> </tbody></table>
	
	
	*/
	
	
	

?>