<?php
//sacar los datos de la solicitud y cargarlos en el formulario

$folio = $_GET['folio'];
$id_usuario     = id_usuario($id_sesion);
$formulario_registro = html_template('contenedor_rectificacion_solicitante');	

 $query= "SELECT id_solicitud_acceso,
				folio,
				a.id_entidad,
				a.id_entidad_padre,
				identificacion_documentos,
				notificacion,
				id_forma_recepcion,
				oficina,
				id_formato_entrega,
				fecha_inicio,
				fecha_termino,
				a.orden,
				id_estado_solicitud,
				id_sub_estado_solicitud,
				id_responsable,
				fecha_formulacion,
				id_digitador,
				hash,
				prorroga,
				firmada,
				id_tipo_solicitud
				FROM sgs_solicitud_acceso a
					
				WHERE folio='$folio' and id_usuario=$id_usuario and id_estado_solicitud=3 and id_sub_estado_solicitud =5"; 
				

				
$datos_derivacion = Recupera_datos_derivacion_tabla($folio);				
$result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
				
if(list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$prorroga,$firmada,$id_tipo_solicitud) = mysql_fetch_row($result)){
	
		
		/*****************PARA RECTIFICAR********************/
		$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
		$aEstadosRectificacion = split(",",$Estados_pendiente_rectificacion);
		$glosa_estado_encontrado = Encuentra_estado($id_sub_estado_solicitud,$aEstadosRectificacion); 
		
		
		
		$plazo_rectificar = Calcula_plazo_rectificar($folio);
		
		$fecha_peticion_rectificacion = Recupera_fecha_ultimo_estado($folio);
		$formulario_registro = cms_replace("#FECHA_PETICION_RECTIFICACION#","$fecha_peticion_rectificacion",$formulario_registro);
		
		
		$formulario_registro = cms_replace("#PLAZO_RECTIFICAR#","$plazo_rectificar",$formulario_registro);
		
		$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
		$estado_solicitud = $estado_solicitud.$glosa_estado_encontrado;
		$formulario_registro = cms_replace("#ESTADO#","$estado_solicitud",$formulario_registro);
		
		
		//validar existencia de rectificacion
				$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna,id_pais						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
				$result_rectificar = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$correo_electronico,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$id_pais) = mysql_fetch_row($result_rectificar);
				}else{
					$nombre = rescata_valor('usuario',$id_usuario,'nombre');
					$paterno = rescata_valor('usuario',$id_usuario,'paterno');
					$materno = rescata_valor('usuario',$id_usuario,'materno');
					$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
					$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
					$email = rescata_valor('usuario',$id_usuario,'email');	
					$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
					
					$numero = rescata_valor('usuario',$id_usuario,'numero') ;
					$depto = rescata_valor('usuario',$id_usuario,'depto') ;
					$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
					$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
					$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
					$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;
					$id_pais = rescata_valor('usuario',$id_usuario,'id_pais');
					//verificar la region y comuna
					if (($id_pais!="") and ($id_pais >0)){
						$sql = "Select pais from pais where id_pais = '$id_pais'";
						$result_pais = cms_query($sql)or die (error($sql,mysql_error(),$php));
						list($pais)=  mysql_fetch_row($result_pais);
						if ($pais != "Chile"){
							$id_region = 0;
							$id_comuna = 0;
						}
			
					}
					
					
				}
		//fin validar existencia rectificacion
		
		
			$sql = "Select id_pais,pais from pais order by orden asc";
			$result_pais = cms_query($sql)or die ("Error en la consulta de paises");
			$paises .= "<option value=\"0\" \"selected\" >--Seleccione-></option>";
			
			while (list($id_pais2,$pais) = mysql_fetch_row($result_pais)){
				if ($id_pais == $id_pais2){
					$selected = "selected";
				}else{
					$selected = "";
				}
				$paises .= "<option value=\"$id_pais2\" $selected  >".utf8_encode($pais)."</option>";
			}
			
			$paises = "<select name=\"id_pais\" onchange='muestraOcultaRegionComuna();' >
							".$paises."
						</select>";

		
		
		$formulario_registro = cms_replace("#ID_SOLICITANTE#","$id_usuario",$formulario_registro);
		//$nombre = rescata_valor('usuario',$id_usuario,'nombre');
		$formulario_registro = cms_replace("#NOMBRES#","$nombre",$formulario_registro);
		
		//$paterno = rescata_valor('usuario',$id_usuario,'paterno');
		$formulario_registro = cms_replace("#PATERNO#","$paterno",$formulario_registro);
		
		//$materno = rescata_valor('usuario',$id_usuario,'materno');
		$formulario_registro = cms_replace("#MATERNO#","$materno",$formulario_registro);
		
		//$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
		$formulario_registro = cms_replace("#RAZON_SOCIAL#","$razon_social",$formulario_registro);
		
		//$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
		$formulario_registro = cms_replace("#APODERADO#","$apoderado",$formulario_registro);
		
		//$email = rescata_valor('usuario',$id_usuario,'email');	
		$formulario_registro = cms_replace("#EMAIL#","$correo_electronico",$formulario_registro);
		
		//direccion
		$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
		$formulario_registro = cms_replace("#DIRECCION#","$direccion",$formulario_registro);
		
		//$numero = rescata_valor('usuario',$id_usuario,'numero') ;
		$formulario_registro = cms_replace("#NUMERO#","$numero",$formulario_registro);
		
		//$depto = rescata_valor('usuario',$id_usuario,'depto') ;
		$formulario_registro = cms_replace("#DEPARTAMENTO#","$depto",$formulario_registro);
		
		//$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
		$formulario_registro = cms_replace("#CIUDAD#","$ciudad",$formulario_registro);
		
		
		
		$formulario_registro = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$formulario_registro);
		
		$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
		
		$formulario_registro = cms_replace("#ENTIDAD#","$entidad",$formulario_registro);
		
		$id_tipo_persona = rescata_valor('usuario',$id_usuario,'id_tipo_persona') ;
		//para los combo box
		//$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
		
		$jscript_combos = " selectInCombo('id_region','$id_region');
							selectInCombo('id_tipo_persona','$id_tipo_persona');						
							";
		
		//$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
		$checked_si = "";
		$checked_no = "";
		
		if($firmada==1){
			 $firmada = "si";
			 $checked_si = "checked";
		}else{
			 $firmada= "no";
			 $checked_no = "checked";
		}
		 $firmado = $firmada;
		
		if($firmado ==""){
			$firmado =0;
			$checked_no = "checked";
		}

		//sacar la observación del responsable para mostrarla al solicitante
		$sql = "Select observacion 
				from sgs_flujo_estados_solicitud 
				where folio='$folio' 
						and id_estado_solicitud in ($Estados_pendiente_rectificacion) 
				order by id_flujo_estados_solicitud desc";
		$resultado_observacion = cms_query($sql)or die("La consulta falló:".mysql_error());
		list($observacion_solicitud) = mysql_fetch_row($resultado_observacion);


		$sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'comentario_para_usuario') ;
		
		if ($sub_estado_solicitud==""){
			if ($observacion_solicitud==""){
				$sub_estado_solicitud = "Sin observaci&oacute;n";
			}else{
				$sub_estado_solicitud = $observacion_solicitud;
			}
		}else{
			$sub_estado_solicitud = $sub_estado_solicitud."<br>".$observacion_solicitud;
		}		
		
		$formulario_registro = cms_replace("#SUBESTADO#","$sub_estado_solicitud",$formulario_registro);

		//echo $tipo;
		if($id_tipo_solicitud=1){
			$desabledd ="disabled";
		}
		$formulario_registro = cms_replace("#SI_FIRMADO#","<input type=\"radio\" name=\"firmada\" id=\"firmada\" $checked_si value=\"1\" $desabledd> S&iacute;   <input type=\"radio\"  name=\"firmada\" id=\"firmada\" value=\"0\" $checked_no $desabledd> No    ",$formulario_registro);
		
		$formulario_registro = cms_replace("#JSCRIPT_COMBOS#","$jscript_combos",$formulario_registro);
		
		
		
		
		
		

		
}else{

header("Location:index.php");
}






//para armar el formulario acceso

$formulario_registro = cms_replace("#DIAS_RECTIFICAR#",$dias_rectificar,$formulario_registro);

$formulario_registro = cms_replace("#DATOS_DERIVACION#","$datos_derivacion",$formulario_registro);   



$css.="<link rel='stylesheet' href='js/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112' media='screen'></LINK>";



$js .="<SCRIPT type=\"text/javascript\" src=\"js/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112\"></script>
 <script type=\"text/javascript\" src=\"comuna_select/js/select_dependientes.js\"></script>
 
 ";
   
$js .="<script src=\"js/jquery/jquery.Rut.min.js\" type=\"text/javascript\"></script>

<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}

</style>

<script type=\"text/javascript\">

var disStyle=0
var dom=document.getElementById||document.all

function getItem(id) {
return document.getElementById&&document.getElementById(id)? document.getElementById(id) : document.all&&document.all[id]? document.all[id] : null;
}

if(dom)
document.write('<style type=\"text/css\" id=\"dummy\">\
.tlink{\
display:none;\
}\
<\/style>')

if(dom&&typeof getItem('dummy').disabled=='boolean'){
document.write('<style type=\"text/css\" id=\"showhide\">\
.showhide{\
display:none;\
}\
#cdiv0 {\
display:block;\
}\
<\/style>');
disStyle=1;
}

function displayOne(idPrefix, idNum){
var i=0;
while (getItem(idPrefix+i)!==null){
getItem(idPrefix+i).style.display='none';
i++;
}
if (typeof idNum!=='undefined')
getItem(idPrefix+idNum).style.display='';
}

onload=function(){
displayOne('cdiv', 0);
if (disStyle)
getItem('showhide').disabled=true;
}
</script>



<script type=\"text/javascript\">

$.validator.setDefaults({
	submitHandler: function() {
	
	if(confirm(\"\u00BFEst\u00E1 seguro de rectificar esta solicitud?\")) { 
		 //$(\"#form1\").submit();
		 form.submit();
      } 

	}
});



$(document).ready(function(){

$('#rut').Rut(
function(){ 
alert('Rut incorrecto');
document.getElementById('rut').value = \"\";
});


});


$().ready(function() {

	
	// validate signup form on keyup and submit
	$(\"#form1\").validate({
		rules: {
			nombre : {
			required : true,
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '1'
			}

			},
			paterno: {
			required : true,
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '1'
			}

			},
			materno: {
			required : true,
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '1'
			}

			},
			razon_social: {
			required : true,
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '2'
			}

			},
			
			apoderado: {
			required : true,
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '2'
			}

			},
			
			folio: {
			required : true
			}
			,
			ciudad: {
				required: true
			},
			identificacion_documentos: {
				required: true
			},
			id_region: {
				required: true,
				required: function(element) {
				   return $(\"#id_region\").val() != '0'
			        }
			},
			id_comuna: {
				required: true,
				required: function(element) {
				    return $(\"#id_comuna\").val() != '0'
			        }
			},
			ciudad: {
				required: true
			},
			direccion: {
				required: true
			},
			numero: {
				required: true
			},
			
			fecha_ingreso:{
			required : true
			},
			id_entidad : {
			    required : true
			
			},
			entidad_origen: {
				required : true
			},
			fecha_original: {
				required : true
				
			},
			email: {
				required: true,
				email: true
			},
			id_forma_recepcion: {
			   required : true,
			  required: function(element) {
				  return $(\"#id_forma_recepcion\").val() != '0'
			  }			
		  }
		},
		messages: {
			nombre: \"<br>Ingrese su nombre\",
			paterno: \"<br>Ingrese su Apellido Paterno\",
			materno: \"<br>Ingrese su Apellido Materno\",
			email: \"<br>Correo Electr&oacute;nico no v&aacute;lido\",
			direccion: \"\",
			numero: \"\",
			ciudad: \"\",
			id_entidad: \"<br>Debe indicar una entidad\",
			folio: \"<br>Ingrese el folio de la solicitud\",
			oficina: \"<br>Debe indicar una direcci&oacute;n\",
			identificacion_documentos: \"<br>Debe especificar que requerimientos de informaci&oacute;n o d|ocumentos<br>\",
			entidad_origen: \"<br>Debe ingresar la Entidad Origen\",
			fecha_original: \"<br>Debe ingresar la fecha original\"
				
		}
	});
});




function muestraDerivacion(){
	document.getElementById('entidadOrigenTr').style.display = '';
	document.getElementById('fechaOriginalTr').style.display = '';
	
}
function ocultaDerivacion(){
   document.getElementById('entidadOrigenTr').style.display = 'none';
   document.getElementById('fechaOriginalTr').style.display = 'none';
}

function selectInCombo(combo,val)
{
    for(var indice=0 ;indice<document.getElementById(combo).length;indice++)
    {
        if (document.getElementById(combo).options[indice].value==val )
            document.getElementById(combo).selectedIndex =indice;
    }        
}

function muestraOcultaRegionComuna(){
	indice = document.form1.id_pais.selectedIndex ;
	if (document.form1.id_pais.options[indice].text == 'Chile' ){//Etiqueta del combo si se selecciona chile
		document.getElementById('region_comuna').style.display = '';
	}else{
		document.getElementById('region_comuna').style.display = 'none';
	}
}


</script>";





$clase = "";
$region = select_admin_campo_simple("regiones",$id_region, "onChange='cargaContenido(this.id)'", $clase,$id_opcional);
	
   $comunas_lista = "";
   
      if($id_region!=""){

 	    $query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region='$id_region'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while(list($id_comuna2,$comuna) = mysql_fetch_row($result)){
		  
			  if($id_comuna==$id_comuna2){
					$comunas_lista .="<option value=\"$id_comuna2\" selected>$comuna</option>";
		  
			  }else{
					$comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";
			  }
		  
		 } 
		  
  	 }
	$comuna= "<select  name=\"id_comuna\" id=\"id_comuna\" >
						<option value=\"\">Seleccione comuna..</option>
						$comunas_lista
					</select>";

    
     $query= "SELECT id_tipo_persona,tipo_persona 
           FROM  tipo_persona
		   order by orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_persona,$tipo_persona) = mysql_fetch_row($result)){
				
				
		$lista_select_tipo_persona .="<option value=\"$id_tipo_persona\" >$tipo_persona</option>\n";
				   
		 }
$tipo_persona = "<select name=\"id_tipo_persona\"  id=\"id_tipo_persona\" onChange=\"displayOne('cdiv', this.selectedIndex);\">
                 $lista_select_tipo_persona
                 </select>";

   
  /* 
$js .=" 

<script language=\"javascript\">
function desmarca(){
	if(form1.tipo_folio.value=='P'){
		form1.folio.disabled=false;
	}else{
	    form1.folio.disabled=true;
	}
  
}
</script>";*/
   
   $css .="<style type=\"text/css\">
			#folio {
    			text-transform: uppercase;
				}
			</style>";
			
$formulario_registro = cms_replace("#RADIOS#","$radios",$formulario_registro);


$entidad_origen = "<input type=\"text\" name=\"entidad_origen\" id=\"entidad_origen\" />";
$formulario_registro = cms_replace("#ENTIDAD_ORIGEN#","$entidad_origen",$formulario_registro);


$fecha_original = "<table width=\"300\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
              <tr >
                <td align=\"left\" width=\"200\" ><input type=\"text\" name=\"fecha_original\" id=\"fecha_original\"  readonly=\"readonly\" onclick=\"displayCalendar(document.form1.fecha_original,'dd-mm-yyyy',this)\"/></td>
                <td align=\"left\" ><img src=\"images/calendario.gif\" alt=\"\" border=\"0\" onclick=\"displayCalendar(document.form1.fecha_original,'dd-mm-yyyy',this)\"></td></tr> 
          	</table>";
$formulario_registro = cms_replace("#FECHA_ORIGINAL#","$fecha_original",$formulario_registro);

$fecha_ingreso = fechas_html($fecha_inicio);
$formulario_registro = cms_replace("#FOLIO#","$folio",$formulario_registro);
$formulario_registro = cms_replace("#FECHA_INGRESO#","$fecha_ingreso ",$formulario_registro);

  
   $fecha = date(d)."-".date(m)."-".date(Y);
   
	if($apoderado!=""){
	
	$apoderado ="<label>Apoderado</label>(si corresponde) $apoderado  <br />  ";	
	}

    $formulario_registro = cms_replace("#TIPO_PERSONA#","$tipo_persona",$formulario_registro);
	
	
	/*domicilio*/
	$formulario_registro = cms_replace("#REGION#","$region",$formulario_registro);
	$formulario_registro = cms_replace("#COMUNA#","$comuna",$formulario_registro);
	
	/*Información de la solicitud*/
	
	$id_servicio = configuracion_cms('id_servicio');	
	
	$servicio = rescata_valor('sgs_entidad_padre',$id_servicio,'entidad_padre'); 
	
	$servicio = acentos($servicio);
	$servicio = ucwords(strtolower(trim($servicio)));
	
	
		/*Datos estadáticos (opcionales)*/
		
	$ocupacion = select_admin_campo_simple("usuario_ocupacion",$id_ocupacion, $js_sel, $clase,$id_opcional);
    $rango_edad = select_admin_campo_simple("usuario_rango_edad",$id_rango_edad, $js_sel, $clase,$id_opcional);
    $sexo = select_admin_campo_simple("usuario_sexo",$id_sexo, $js_sel, $clase,$id_opcional);
	$nacionalidad = select_admin_campo_simple("usuario_nacionalidad",$id_nacionalidad, $js_sel, $clase,$id_opcional);
    $nivel_educacional = select_admin_campo_simple("usuario_nivel_educacional",$id_nivel_educacional, $js_sel, $clase,$id_opcional);
    $organizacion_sindical = select_admin_campo_simple("usuario_organizacion",$id_organizacion, $js_sel, $clase,$id_opcional);
    $frecuencia = select_admin_campo_simple("usuario_frecuencia_organizacion",$id_frecuencia_organizacion, $js_sel, $clase,$id_opcional);

	$formulario_registro = cms_replace("#PAIS#","$paises",$formulario_registro);
	$formulario_registro = cms_replace("#RUT#","<input type=\"text\" id=\"rut\" name=\"rut\" value=\"$rut\" size=\"12\" maxlength=\"12\" />",$formulario_registro);
	$formulario_registro = cms_replace("#CODIGO#","<input type=\"text\" id=\"codigo\" name=\"codigo\" value=\"$codigo\" size=\"3\" />",$formulario_registro);
	$formulario_registro = cms_replace("#TELEFONO#","<input type=\"text\" id=\"telefono\" name=\"telefono\" value=\"$telefono\" size=\"30\" />",$formulario_registro);
	$formulario_registro = cms_replace("#SEXO#","$sexo",$formulario_registro);
	$formulario_registro = cms_replace("#RANGO_EDAD#","$rango_edad",$formulario_registro);
	$formulario_registro = cms_replace("#NACIONALIDAD#","$nacionalidad",$formulario_registro);
	$formulario_registro = cms_replace("#NIVEL_EDUCACIONAL#","$nivel_educacional",$formulario_registro);
	$formulario_registro = cms_replace("#OCUPACION#","$ocupacion",$formulario_registro);
	$formulario_registro = cms_replace("#ORGANIZACION_SINDICAL#","$organizacion_sindical",$formulario_registro);
	$formulario_registro = cms_replace("#FRECUENCIA#","$frecuencia",$formulario_registro);
	
	
	
	
	
	//$nombre_caja = str_replace("$prod ","",$nombre_caja);
	
	//$lista_entidades = select_admin_campo_simple("sgs_entidades",$id_entidad, $js_sel, $clase,$id_opcional);
	//sacar las entidades de configuracion
	$sql = "Select valor from cms_configuracion where configuracion='id_entidad'";
	$result = cms_query($sql) or die ("La consulta falló");
	list($valor) = mysql_fetch_row($result);
	$aEntidad = split(',',$valor);
	
	  $query= "SELECT id_entidad,entidad 
               FROM  sgs_entidades
               WHERE id_entidad_padre='$id_servicio'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
		 $lista_select .= "<option value=\"\" selected >--Seleccione--></option>";
          while (list($id_entidad,$entidad) = mysql_fetch_row($result)){
		  		$entidad = cambio_texto($entidad);
				$encontrado =  buscarCodigo($aEntidad,$id_entidad);
				if ($encontrado==1){
					$lista_select .="<option value=\"$id_entidad\">$entidad</option>";			   
				}
    		 }
	
	
	$lista_entidades = "<br><select name=\"id_entidad\">$lista_select</select>";
	
	$formulario_registro = cms_replace("#LISTA_ENTIDADES#","$lista_entidades",$formulario_registro);
	
	$formulario_registro = cms_replace("#SERVICIO#","$servicio",$formulario_registro);
	
	
	
	
	
	
	
	/*Notificación*/
	if($notificacion==""){
	$notificacion=0;
	}
	$var = "notificacion_$notificacion";
	$$var = "checked";
	

	$notificacion = "<input type=\"radio\" name=\"notificacion\" id=\"notificacion\" $notificacion_1 value=\"1\"  > S&iacute;   <input type=\"radio\" $notificacion_0 name=\"notificacion\" id=\"notificacion\" value=\"0\"  > No    ";
	
	$formulario_registro = cms_replace("#SI#","$notificacion",$formulario_registro);
	
	/*Forma de recepción de la información solicitada*/
	
	$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;

	$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
	$formulario_registro = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$formulario_registro);
	
	if($notificacion==0)$notificacion="No";
	if($notificacion==1)$notificacion="Si";
	$formulario_registro = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$formulario_registro);

	
	  $query= "SELECT id_entidad_oficina,oficina    
               FROM  sgs_entidades_oficinas";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_entidad_oficina,$oficina) = mysql_fetch_row($result)){
    				$oficinas .="<option value=\"$oficina\">$oficina</option>";
    		 }
			 
			 $oficina = "<select name=\"oficina\" id=\"oficina\" disabled>
                   
                    $oficinas
                    </select>";
	
	$formulario_registro = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$formulario_registro);
	$formulario_registro = cms_replace("#OFICINA#","$oficina (Solo si Retira en Oficina)",$formulario_registro);
	
	/*Formato de entrega*/
	
	
	$formato_entrega = "<input type=\"radio\" name=\"id_formato_entrega\" id=\"id_formato_entrega\" $notificacion_1 value=\"1\"> Copia en Papel   <input type=\"radio\" $notificacion_0 name=\"id_formato_entrega\" id=\"id_formato_entrega\" value=\"2\"> Formato electr&oacute;nico / Digital ";
	$formulario_registro = cms_replace("#FORMATO_ENTREGA#","$formato_entrega",$formulario_registro);
	$formulario_registro = cms_replace("#FECHA#","$fecha",$formulario_registro);
	
	
	$contenido= $formulario_registro;	//fin para armar el formulario acceso

?>