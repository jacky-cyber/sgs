<?php
	
        
        if($id_auto_admin==""){
			
            
                            $query= "SELECT id_auto_admin   
                                    FROM  acciones
                                    WHERE accion='$accion'";
            
                            $result= cms_query($query)or die (error($query,mysql_error(),$php));
                            list($id_auto_admin) = mysql_fetch_row($result);
   		
	}
                
                $query= "SELECT campo,existe_listado,pk,id_tipo_campo,txt,txt_xml 
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and campo<>'orden' and existe_listado=1
			   ORDER BY id_campo";
   		  
   			//echo "$query<br>";
   		      $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$existe_listado,$pk,$id_tipo_campo,$txt,$txt_xml) = mysql_fetch_row($resultc)){
   		      	//echo "$campos<br>";
                        $cont_columnas++;
   				$campo_txt_tbl_pk="";
				if($existe_listado==1){
   		       
   					if(substr_count ($campos, "id_") and $pk!=1){
   						//encontramos un pk de otra tabla 
   						$tbl_pk= campo_pk($campos,$DATABASE);
						
   						if($tbl_pk!=""){
                                                                $campo_tbl_pk = $campos;
                                                                $query= "SELECT id_auto_admin  
                                                                         FROM auto_admin 
                                                                         WHERE tabla='$tbl_pk'";
                                                                
                                                                $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
                                                                list($id_auto_admin_tbl_pk) = mysql_fetch_row($resultq);
                                                                    //rescatamos el id de la tabla del campo pk encontrado
                                                                $query= "SELECT campo
                                                                         FROM auto_admin_campo 
                                                                         WHERE id_auto_admin='$id_auto_admin_tbl_pk' and existe_listado =1";
        
                                                                 $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
                                                                 list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
                                                                    //encontramos el campo tx que corresponde al pk que encontramos
                                                                        $contador_pk= $cont;
                                                                        $ver_pk="ok";
							}
   					}else{
   						
                                                        $query= "SELECT campo
   		      	          				 FROM auto_admin_campo 
   		      	          				 WHERE id_auto_admin='$id_auto_admin' and existe_listado =1";

   		      					 $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
                                                        list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
					}
   					
                                    $cont++;
                          
                                    $cont_c++;
                                    $lista_de_campos .="$campos,";
                                    
                                    $campos2 = str_replace("_"," ",$campos);	//reemplaza "_" por blanco en $campos 
                                    $campos2 = str_replace("id "," ",$campos2);	//reemplaza "_" por blanco en $campos 
                                    $campos2 = ucwords($campos2);				//pone la primera letra en mayuscula
                                    $nom_columnas .="<th align=\"center\">$campos2</th>\n ";	
   		      	
				}
				
				
                                    $campos2 = str_replace("_"," ",$campos);
                                    if($txt==1){
                                    $lista_campos .="<option value=\"$campos\" selected>$campos2</option>";		   
                                    }else{
                                    $lista_campos .="<option value=\"$campos\">$campos2</option>";		   
				}
   		      
   		}
   		
                
                ////////
        
if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$configurar_ver= "<th align=\"center\" class=\"nosort\" style=\"width:40px; text-align:center;\">Ver</th>";
$cont_columnas++;
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$configurar_editar = "<th align=\"center\" class=\"nosort\" style=\"width:40px; text-align:center;\">Editar</th>";
$cont_columnas++;
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$configurar_borrar = "<th align=\"center\" class=\"nosort\" style=\"width:40px; text-align:center;\">Borrar</th>";
$cont_columnas++;
}
   
   
include('admin/administracion_sistema/filtros_lista.php');


   $nom_columnas .= $configurar_ver.$configurar_editar.$configurar_borrar;    
        /////
        
        

	$contenido = "<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.js\"></script>
		<script type=\"text/javascript\" charset=\"utf-8\">
			$(document).ready(function() {
				$('#listado').dataTable( {
					\"bServerSide\": true,
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=22&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": false,
                                       \"aaSorting\": [[ 1, \"desc\" ]],
                                       \"oLanguage\": {
                                            \"sSearch\": \"Buscar: \"
                                          }

				} );
			
				
			

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
					\"sAjaxSource\": \"?accion=$accion&act=22&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": true,
				   	\"aaSorting\": [[ 1, \"desc\" ]],
                                       \"oLanguage\": {
                                            \"sSearch\": \"Buscar: \"
                                            }

		});
					
		//oTable.fnDraw(); 
	
	});
	
	$('#filtrar').click( function() {
		oTable = $('#listado').dataTable();
		oTable.fnDestroy();

		$('#listado').dataTable( {
					\"bServerSide\": true,
					\"fnServerData\": function ( sSource, aoData, fnCallback ) {
							aoData.push( { \"name\": \"campo\", \"value\": $('#campo').val() } );
							aoData.push( { \"name\": \"texto_filtro\", \"value\": $('#texto_filtro').val() } );
							aoData.push( { \"name\": \"select\", \"value\": $('#select').val() } );
							$.getJSON( sSource, aoData, function (json) {fnCallback(json)} );
						},
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=22&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"bAutoWidth\": true,
				   	\"aaSorting\": [[ 1, \"desc\" ]],
                                       \"oLanguage\": {
                                            \"sSearch\": \"Buscar: \"
                                            }
		});
		
	});
	
	$('#reset').click( function() {
		window.location.href = 'index.php?accion=$accion';
	});
	
	
} );


		</script>
			
			
				
			
			<div id=\"container \">
                        $tabla_filtros
			<div id=\"dynamic\">
			
<table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
	
	
	<thead>
				
		<tr>
			$nom_columnas
		</tr>
		
	</thead>
	
	<tbody>
	
		<tr>
			<td colspan=\"$cont_columnas\" class=\"dataTables_empty\"></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			$nom_columnas
		</tr>
		
	</tfoot>
</table>
		
		</div>	
		</div>	
	
			
";

		   $js .= "
		
			<script type=\"text/javascript\">
				
				function ver_popover(link,id,table){
					
					$.get(link,{
						
					}, function(resp){
												
						$('#'+id).attr(\"data-content\", resp);
						//$('.popover-inner').addClass(\"ancho_auto_admin\");
						$('#'+id).attr(\"data-original-title\", 'Tabla '+table+' Reg:'+id);
						$('#'+id).popover({placement:'left', delay: { show: 0, hide: 800 }});
						
					});
				
				}
				
			</script>
		";	
	
?>