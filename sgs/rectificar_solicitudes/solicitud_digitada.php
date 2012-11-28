<?php
//sacar los datos de la solicitud y cargarlos en el formulario


//echo "<br>aca solicitud digitada";
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
	var valida_radio = $('[name=\"firmada\"]:checked').val();
	var valida_radio_envio = $('[name=\"id_formato_entrega\"]:checked').val();
	/*
	if(valida_radio_envio==1){
		if($('#id_pais').val()==51){
			if($('#direccion').val()=='' && $('#numero').val()=='' && $('#ciudad').val()=='');
		}else{
		}
	}*/
	if(confirm(\"\u00BFEst\u00E1 seguro de rectificar esta solicitud?\")) { 
		 if(valida_radio==1){
			document.getElementById('form1').submit();
		 }else{
			alert('La solicitud debe estar firmada');
		 }
		 
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
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '1'
			}

			},
			paterno: {
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '1'
			}

			},
			materno: {
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '1'
			}

			},
			razon_social: {
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '2'
			}

			},
			
			apoderado: {
			required: function(element) {
				return $(\"#id_tipo_persona\").val() == '2'
			}

			},
			
			folio: {
			required : true
			}
			,
			identificacion_documentos: {
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
			id_forma_recepcion: {
			   required : true,
			  required: function(element) {
				  return $(\"#id_forma_recepcion\").val() != '0'
			  }
			  
		  }
		},
		messages: {
			nombre: \"Ingrese su nombre\",
			paterno: \"Ingrese su Apellido Paterno\",
			materno: \"Ingrese su Apellido Materno\",
			email: \"Email no valido\",
			id_entidad: \"Debe indicar una entidad\",
			folio: \"Ingrese el folio de la solicitud\",
			oficina: \"Debe indicar una dirección\",
			identificacion_documentos: \"<br>Debe especificar que requerimientos de informaci&oacute;n o documentos\",
			entidad_origen: \"Debe ingresar la Entidad Origen\",
			fecha_original: \"Debe ingresar la fecha original\"
				
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

$(document).ready(function(){

	$(\"#email\").keyfilter(/[a-z0-9_\.\-@]/i);

	$('#bt_rectificar2').live('click', function(){
		
		var valor = $('#id_forma_recepcion').val();
		if(valor == 1){
			$('#email').addClass('required email');
			$('#direccion').removeClass('required error');
			$('#numero').removeClass('required error');
			$('#ciudad').removeClass('required error');
			$('#id_pais').removeClass('required error');
			$('#id_region').removeClass('required error');
			$('#id_comuna').removeClass('required error');
		}else if(valor == 4){
			$('#email').removeClass('required error email');
			$('#direccion').addClass('required');
			$('#numero').addClass('required');
			$('#ciudad').addClass('required');
			$('#id_pais').addClass('required');
			$('#id_region').addClass('required');
			$('#id_comuna').addClass('required');
		}
		
		/*
		if($('#form1').valid()==true){
		
			var valida_radio = $('[name=\"firmada\"]:checked').val();
			if(confirm(\"\u00BFEst\u00E1 seguro de rectificar esta solicitud?\")){
				if(valida_radio==1){
					$('#form1').submit();
				}else{
					alert('La solicitud debe estar firmada');
				}
			} 
		}
		*/
				
	});
	

});

</script>";

//$formulario_registro = html_template('detallle_solicitud_digitada');	
$formulario_registro = html_template('detallle_solicitud_digitada2');	

 $query= "SELECT id_solicitud_acceso,
				folio,
				a.id_entidad,
				a.id_entidad_padre,
				identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,a.orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,id_usuario,prorroga,firmada
				FROM sgs_solicitud_acceso a
					
				WHERE folio='$folio' ";
				
$datos_derivacion = Recupera_datos_derivacion_tabla($folio);				
$result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
				
if(list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$id_usuario,$prorroga,$firmada) = mysql_fetch_row($result)){
	
	$identificacion_documentos = str_replace("<br />","",$identificacion_documentos);
		//validar existencia de rectificacion
				$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna, id_pais 						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
				$result_rectificar = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$correo_electronico,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna,$id_pais) = mysql_fetch_row($result_rectificar);
				}else{
					$id_tipo_persona = rescata_valor('usuario',$id_usuario,'id_tipo_persona') ;
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
					$id_pais = rescata_valor('usuario',$id_usuario,'id_pais') ;
					$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;			
				}
		//fin validar existencia rectificacion
	
	
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
		$formulario_registro = cms_replace("#EMAIL#","$email",$formulario_registro);
		
		//direccion
		//$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
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
		
		//$id_tipo_persona = rescata_valor('usuario',$id_usuario,'id_tipo_persona') ;
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

		$formulario_registro = cms_replace("#SI_FIRMADO#","<input type=\"radio\" name=\"firmada\" id=\"firmada\" $checked_si value=\"1\"> S&iacute;   <input type=\"radio\" name=\"firmada\" id=\"firmada\" value=\"0\" $checked_no > No    ",$formulario_registro);
		
		$formulario_registro = cms_replace("#JSCRIPT_COMBOS#","$jscript_combos",$formulario_registro);
		
		
		
		
		
		

		
}

	/**********************************/
	$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
			 $sql = "Select observacion 
						from sgs_flujo_estados_solicitud 
						where folio='$folio' 
								and id_estado_solicitud in ($Estados_pendiente_rectificacion) 
						order by id_flujo_estados_solicitud desc";
				$resultado_observacion = cms_query($sql)or die("La consulta fall�:".mysql_error());
				list($observacion_solicitud) = mysql_fetch_row($resultado_observacion);
										
				if ($sub_estado_solicitud==""){
					if ($observacion_solicitud==""){
						$sub_estado_solicitud = "Sin observaci&oacute;n";
					}else{
						$sub_estado_solicitud = $observacion_solicitud;
					}
				}else{
					$sub_estado_solicitud = $sub_estado_solicitud."<br>".$observacion_solicitud;
				}
				
				$fecha_peticion_rectificacion = Recupera_fecha_ultimo_estado($folio);
				$formulario_registro = cms_replace("#FECHA_PETICION_RECTIFICACION#","$fecha_peticion_rectificacion",$formulario_registro);
				$formulario_registro = cms_replace("#SUBESTADO#","$sub_estado_solicitud",$formulario_registro);
				
	$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
		$formulario_registro = cms_replace("#ESTADO#","$estado_solicitud",$formulario_registro);
						
	/*************************************/
	
	




//para armar el formulario acceso
$dias_rectificar = Calcula_plazo_rectificar($folio);
$formulario_registro = cms_replace("#PLAZO_RECTIFICAR#",$dias_rectificar,$formulario_registro);

$formulario_registro = cms_replace("#DATOS_DERIVACION#","$datos_derivacion",$formulario_registro);   





$sql = "Select id_pais,pais from pais order by orden asc";
$result_pais = cms_query($sql)or die ("Error en la consulta de paises");
$paises .= "<option value=\"\" \"selected\" >--Seleccione-></option>";

while (list($id_pais2,$pais) = mysql_fetch_row($result_pais)){
	if ($id_pais == $id_pais2){
		$selected = "selected";
	}else{
		$selected = "";
	}
	$paises .= "<option value=\"$id_pais2\" $selected  >".$pais."</option>";
}

$paises = "<select name=\"id_pais\" id=\"id_pais\" onchange='muestraOcultaRegionComuna();' >
				".$paises."
			</select>";



$region = select_admin_campo_simple("regiones",$id_region, "onChange='cargaContenido(this.id)'", $clase,$id_opcional);
	
   $comunas_lista = "";
   
      if($id_region!=""){

 	    $query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region=$id_region";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while(list($id_comuna2,$comuna) = mysql_fetch_row($result)){
		  
			  if($id_comuna==$id_comuna2){
					$comunas_lista .="<option value=\"$id_comuna2\" selected>$comuna</option>";
		  
			  }else{
					$comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";
			  }
		  
		 } 
		  
  	 }
	$comuna= "<select  name=\"id_comuna\" id=\"id_comuna\">
						<option value=\"\">Seleccione comuna..</option>
						$comunas_lista
					</select>";

    
     $query= "SELECT id_tipo_persona,tipo_persona 
           FROM  tipo_persona
		   order by orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_persona,$tipo_persona) = mysql_fetch_row($result)){
				
				
		$lista_select_tipo_persona .="<option value=\"$id_tipo_persona\">$tipo_persona</option>\n";
				   
		 }
$tipo_persona = "<select name=\"id_tipo_persona\" id=\"id_tipo_persona\" onChange=\"displayOne('cdiv', this.selectedIndex);\">
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
	$formulario_registro = cms_replace("#PAIS#","$paises",$formulario_registro);
	$formulario_registro = cms_replace("#LINK_PRINT#","$print",$formulario_registro);
	
	

	
	
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
	
	//$formulario_registro = cms_replace("#SI#","$notificacion",$formulario_registro);
	/********************************************************/
	$formulario_registro = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$formulario_registro);
	/********************************************************/
	/*Forma de recepción de la información solicitada*/
	
	$query= "SELECT  id_forma_recepcion,forma_recepcion,obliga      
               FROM  sgs_forma_recepcion
			   order by orden";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_forma_recepcion2,$forma_recepcion,$obliga) = mysql_fetch_row($result)){
		 $cont_obliga++;
		  			if($obliga ==1){
					$case_js .="case $cont_obliga:\n 
						       oficina.disabled = false;\n 
							   break;\n";
					}else{
					$case_js .="case $cont_obliga:\n 
						       oficina.disabled = true;\n 
       						   break;\n";
					}
					
					
					
		  		if($id_forma_recepcion==$id_forma_recepcion2){
					$for_rec.="<option value=\"$id_forma_recepcion2\" selected>$forma_recepcion</option>";
				}else{
					$for_rec.="<option value=\"$id_forma_recepcion2\">$forma_recepcion</option>";
				}
    			
    		 }
			 
			 $forma_recepcion = "<select name=\"id_forma_recepcion\" id=\"id_forma_recepcion\" onchange=\"accion()\">
                    <option value=\"\" >Seleccione una forma de recepci&oacute;n</option>
                      $for_rec
                    </select>";
	$js.="<script language='javascript'> 
			
   				function accion(){ 
    						with (document.form1){ 
     						switch (id_forma_recepcion.selectedIndex){ 
     
	 						case 0:\n 
						       oficina.disabled = true;\n 
       						   break;
	    					$case_js
     							} 
    						} 
   						 } 

  </script> 
  
 
";


	
	  $query= "SELECT id_entidad_oficina,oficina    
               FROM  sgs_entidades_oficinas";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_entidad_oficina,$oficina) = mysql_fetch_row($result)){
    				$oficinas .="<option value=\"$oficina\">$oficina</option>";
    		 }
			 
			 $oficina = "<select name=\"oficina\" disabled>
                   
                    $oficinas
                    </select>";
	
	$formulario_registro = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$formulario_registro);
	$formulario_registro = cms_replace("#OFICINA#","$oficina (Solo si Retira en Oficina)",$formulario_registro);
	
	/*Formato de entrega*/
	
	
	$formato_entrega = "<input type=\"radio\" name=\"id_formato_entrega\" id=\"id_formato_entrega\" $notificacion_1 value=\"1\"> Copia en Papel   <input type=\"radio\" $notificacion_0 name=\"id_formato_entrega\" id=\"id_formato_entrega\" value=\"2\"> Formato electr&oacute;nico / Digital ";
	
	/************************************************************/
	//$formulario_registro = cms_replace("#FORMATO_ENTREGA#","$formato_entrega",$formulario_registro);
	$formulario_registro = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$formulario_registro);
	/****************************************************************/
	$formulario_registro = cms_replace("#FECHA#","$fecha",$formulario_registro);
	
	include ("sgs/gestion/gestion.php");
	include("sgs/historial_estado/historial_estado.php");
	
	$formulario_registro = cms_replace("#HISTORIAL#","$template_historial",$formulario_registro);
	
	$boton_enviar = "<input name=\"bt_rectificar2\" type=\"submit\" class=\"boton\" id=\"bt_rectificar2\" value=\"Rectificar solicitud de informaci&oacute;n\" />";
	$formulario_registro = cms_replace("#BOTON_ENVIAR#","$boton_enviar",$formulario_registro);
	
	/*********************************************/
	/* Modulo Archivos */
	/*********************************************/
	$check_archivos .= "<input type=\"checkbox\" name=\"consulta_archivos\" id=\"consulta_archivos\"><span class=\"agregar_archivo\">Agregar Archivo&nbsp</span>";
	$check_archivos .= "<input type=\"hidden\" id=\"fol\" name=\"fol\" value=\"$folio\"> ";
	$check_archivos .= "<input type=\"hidden\" id=\"direccionar\" name=\"direccionar\" value=\"1\"> ";
	$formulario_registro = cms_replace("#DETALLE_ARCHIVOS#",$check_archivos,$formulario_registro);
	include ("sgs/rectificar_solicitudes/formulario.php");
	include ("sgs/rectificar_solicitudes/listado_archivos.php");
	$formulario_registro= cms_replace("#CARGA_ARCHIVOS#",$formulario,$formulario_registro);
	$formulario_registro= cms_replace("#LISTADO_ARCHIVOS#",$lista,$formulario_registro);
	$accion_form_ = "index.php?accion=$accion&act=7";
	
	
	
	$js .="

					<script type=\"text/javascript\">
					
						$(document).ready(function(){
						
							$('#consulta_archivos').click(function(){
								var checkeado=$(\"#consulta_archivos\").attr(\"checked\");
								if(checkeado){
									// div_archivos
									$('#carga').show(100);
								}else{
									$('#carga').css(\"display\", \"none\");
								}
							});
							
							$('#btnguardar').click(function(){
								$('#archivodoc').addClass('required');
								$('#form1').valid();
								if($(\"#archivodoc\").val()!=''){
									document.getElementById('form1').action='$accion_form_';	
									$('#form1').submit();
								}
								
							});
						
						});
					
					</script>

				";	
	
	
	
	$contenido= $formulario_registro;	//fin para armar el formulario acceso

?>