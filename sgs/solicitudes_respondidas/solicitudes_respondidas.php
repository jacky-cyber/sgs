<?php
$id_usuario     = id_usuario($id_sesion);


switch ($act) {
     case 1:
	 		 $url=$_SERVER['REQUEST_URI'];
			 $url= str_replace("&axj=1","",$url);
			 $url= $url."&axj=1&p=1";
	 		 //$print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"MM_openBrWindow('$url','','scrollbars=yes,width=650,height=820')\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";
			
			$folio = $_GET['folio'];
			 $print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"window.open('index.php?accion=$accion&act=13&folio=$folio&axj=1&p=1','ventana','width=800,height=800,resizable=no');\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";
			
			
         	include ("sgs/solicitudes_respondidas/admin_solicitudes_ver.php");
			/*************************************************/
			include("sgs/opcionales/opcionales.php");
			/*************************************************/
		
		
         break;
	 case 2:
	 	 //include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_update.php");
		 include ("sgs/solicitudes_respondidas/admin_solicitudes_cambia_estado.php");
		 header("location:index.php?accion=$accion&act=1&folio=$folio&mensaje=$mensaje");
         break;
   case 3:
       
	    
		 
         break;
   case 4:
        		 $id_e = $_GET['id_e'];
				 
					$contenido = rescata_valor('sgs_estado_solicitudes',$id_e,'pregunta');
					
					//$contenido =  "hola";
         break;
   
     case 6 :
  		include("sgs/solicitudes_respondidas/listado2.php");	
		break;
	case 9:
		include ("sgs/documentos_sistema/descarga.php");
	break;
	case 13:
		include ("sgs/admin_solicitudes/detalle_solicitud_imprimir.php");
		break;
   	default:
	   $def ="ok";
	
	$condicion_mis_solicitudes = "";
	$Estados_etapa_respondida = configuracion_cms('Estados_etapa_respondida');	
	
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
                   WHERE id_responsable='$id_responsable_f' and  id_sub_estado_solicitud in ($Estados_etapa_respondida)";
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
	
				
	$tipo="	<select  class=\"combo\" Class=\"\" name=\"tipo_filtro\" id=\"tipo_filtro\" >
				    <option value=\"\" >Todos</option> 
					<option value=\"W\" ".$seleccionadoW.">Web</option>
				    <option value=\"P\" ".$seleccionadoP.">Formulario</option>
				    <option value=\"C\" ".$seleccionadoC.">Carta</option>
				
				</select>
				 
				
				";
	
				$filtro = cambio_texto($filtro);		
				
				$query= "SELECT id_estado_solicitud,estado_solicitud
		 				 FROM  sgs_estado_solicitudes
             			 WHERE id_estado_solicitud  in ($Estados_etapa_respondida) ";
			 
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
	$filtro = "	<select  class=\"combo\" class=\"\" name=\"id_estado_solicitud_filtro\"  id=\"id_estado_solicitud_filtro\" >
					".$estados."
				</select><br>";

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
						\"sSearch_help\": \"<br><div class='msg_search'>Buscar : Folio, Fecha Ingreso, Estado, Nombre Responsable</div >\"
						}

				} );
				$(\"#listado\").css(\"width\",\"100%\");
					
	//oTable.fnDraw(); 
	
	} );
	
} );


		</script>

			
";

$formulario_solicitudes = html_template("contenedor_solicitudes_respondidas");
$formulario_solicitudes = cms_replace("#FILTRO#",$filtro,$formulario_solicitudes);
$formulario_solicitudes = cms_replace("#TIPO#",$tipo,$formulario_solicitudes);
$formulario_solicitudes = cms_replace("#RESPONSABLE#",$responsable,$formulario_solicitudes);
$contenido = $formulario_solicitudes;
	
	
	//include("sgs/solicitudes_respondidas/lista_admin_solicitudes.php");

	
	
	 
       
 }
 
 
 
/*

<table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr >
                    <td align=\"left\"><h3>Solicitudes Respondidas</h3></td>
                    </tr>
					
              	</table><br>

<!--			
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
				
				<br>
				
			
			<div id=\"container\">
			<div id=\"dynamic\">
			
<table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
	
	
	<thead>
				
		<tr>
			<th>Folio</th>
			<th>Fecha Ingreso</th>
			<th>Fecha Finalizaci&oacute;n</th>
			<th>Responsable</th>
			<th>Respondida en</th>
			<th>Estado</th>
			<th >Editar</th>
			
			
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
			<th>Respondida en </th>
			<th>Estado</th>
			<th >Editar</th>
		</tr>
	</tfoot>
</table>
		
		</div>	
		</div>	
-->


*/ 

?>