<?php

$folio = $_POST['folio'];
switch ($act) {
     case 1:
         include("sgs/mis_solicitudes/detalle_solicitud.php");
		
		 break;
     case 2:
	 	 $accion_form = "index.php?accion=$accion&act=3";
         include("sgs/mis_solicitudes/solicitud_digitada.php");
		 break;	
     case 3:
			$bt_rectificar = $_POST['bt_rectificar'];
			
			
			
			if ($_POST['identificacion_documentos']!=""){
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
				$id_solicitante = id_usuario($id_sesion);
				$identificacion_documentos = $_POST['identificacion_documentos'];
				$id_pais = $_POST['id_pais'];
				if($identificacion_documentos!="" and $paterno!="" and $materno!="" and $email!=""){
					Rectificar_solicitud_digitada($folio,$id_usuario,$id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$email,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$firmada,$id_solicitante,$identificacion_documentos,$id_pais);	
					header("Location:index.php?accion=$accion");
				}else{
//					 header("Location:index.php?accion=$accion");
					echo  "<script>alert('Lo sentimos no fue posible rectificar.'); document.location.href='index.php?accion=$accion'; </script>\n";


				}
				
			}else{
			echo  "<script>alert('Lo sentimos no fue posible rectificar.'); document.location.href='index.php?accion=$accion'; </script>\n";

			
			}    
		// 
		 	
			break;	
			
      case 4:
	 
	 	 include("sgs/mis_solicitudes/desistir_solicitud.php");
		 break;	
  	 case 6 :
  		include("sgs/mis_solicitudes/listado.php");	
		break;
	case 7 :
  		include("sgs/mis_solicitudes/detalle_solicitud_imprimir.php");
		break;
	case 8:
		include ("sgs/documentos_sistema/descarga.php");	
		break;
		
		default:
		
	
	
	if($_GET['tp']==3){
		include("sgs/mis_solicitudes/lista_mis_solicitudes.php");
	}else{
		
		$Estados_pendiente_rectificacion= configuracion_cms('Estados_pendiente_rectificacion');	
		$aEstadosRectificacion = explode(",",$Estados_pendiente_rectificacion);
		$id_user= id_usuario($id_sesion);
		
	    $query2= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable     
			 FROM  sgs_solicitud_acceso
			 where id_usuario= $id_user 
			 and id_sub_estado_solicitud in ($Estados_pendiente_rectificacion)
			 order by fecha_inicio desc ";

		$result_rec= cms_query($query2)or die (mysql_error());//(error($query,mysql_error(),$php));
		//echo mysql_num_rows($result_rec);
	    while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable) = mysql_fetch_row($result_rec)){
			
				
				$lista_mis_solicitudes = html_template('linea_lista_mis_solicitudes');	
				$link_editar = "?accion=$accion&act=1&folio=$folio";
				
				$fecha_ingreso= fechas_html($fecha_ingreso);
				$fecha_termino = fechas_html($fecha_termino);
				$fecha_ingreso2 =  date(d)."-".date(m)."-".date(Y);
	
				//$dias = diferencia_entre_fechas($fecha_termino,$fecha_ingreso2);
				
				if (abs($dias) > 1)  {
					$dias = $dias."&nbsp; d&iacute;as";
				}else{
					$dias = $dias."&nbsp; d&iacute;a";
				}
						
				
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
				$fecha_peticion_rectificacion = Recupera_fecha_ultimo_estado($folio);
				//echo "  $aEstadosRectificacion,";
				$glosa_estado_encontrado = Encuentra_estado($id_sub_estado_solicitud,$aEstadosRectificacion); 
				//echo " glosa estado encontrado:".$glosa_estado_encontrado;
				if ($glosa_estado_encontrado!=""){
					$glosa_link = "RECTIFICAR";
					$fecha_termino = "&nbsp;";
					$dias = "&nbsp;";
					
					
					//completar las rectificaciones
					$lista_mis_solicitudes_rectificadas = html_template('linea_lista_mis_solicitudes_rectificadas');	
					$lista_mis_solicitudes_rectificadas = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#FECHA_PETICION_RECTIFICACION#","$fecha_peticion_rectificacion",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#LINK_EDITAR#","$link_editar",$lista_mis_solicitudes_rectificadas);
					$lista_mis_solicitudes_rectificadas = cms_replace("#GLOSA_LINK#","$glosa_link",$lista_mis_solicitudes_rectificadas);
					
					/**/
					$dias_rectificar = Calcula_plazo_rectificar($folio);
					/**/
					
					$lista_mis_solicitudes_rectificadas = cms_replace("#DIAS#","$dias_rectificar",$lista_mis_solicitudes_rectificadas);

					$linea_lista_mis_solicitudes_rectificadas = $linea_lista_mis_solicitudes_rectificadas. $lista_mis_solicitudes_rectificadas;
					// FIN completar las rectificaciones
					
				}					
				 
		 }

//fin las solicitudes rectificadas
//echo $linea_lista_mis_solicitudes_rectificadas;

		if ($linea_lista_mis_solicitudes_rectificadas != ""){
			$rectificaciones = html_template('contenedor_lista_mis_solicitudes_rectificadas');	
			$rectificaciones = cms_replace("#REGISTROS_RECTIFICACIONES#","$linea_lista_mis_solicitudes_rectificadas", $rectificaciones);
		}

//echo $rectificaciones;

$contenedor_mis_solcitudes = html_template('contenedor mis solicitudes');
		
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

	

	
} );


		</script>
			
		
				

$contenedor_mis_solcitudes	
			
";

$contenido = cms_replace("#RECTIFICACIONES#","$rectificaciones", $contenido);

		
	
}
	
	
	
 }


?>