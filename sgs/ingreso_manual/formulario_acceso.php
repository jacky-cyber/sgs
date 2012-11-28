<?php
   
//include("comuna_select/comuna_select.php");

//$select_regiones = generaRegion();

$id_region = 0;
$id_comuna = ""; 
$clase = "";

$css.="<link rel='stylesheet' href='js/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112' media='screen'></LINK>";



$js .="<SCRIPT type=\"text/javascript\" src=\"js/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112\"></script>
 <script type=\"text/javascript\" src=\"comuna_select/js/select_dependientes.js\"></script>
 <script type=\"text/javascript\" src=\"sgs/ingreso_manual/select_dependientes_entidad.js\"></script>

  ";



  
$js .="<script src=\"js/jquery/jquery.Rut.min.js\" type=\"text/javascript\"></script>

<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}
select.error {
	border: 2px solid red; 
}
textarea.error {
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

/*
$.validator.setDefaults({
	submitHandler: function() {
	
	if(confirm(\"\u00BFEst\u00E1 seguro de ingresar esta solicitud?\")) { 
		 //$(\"#form1\").submit();
		 form.submit();
      } 

	}
});
*/


$(document).ready(function(){

$('#rut').Rut(
function(){ 
alert('Rut incorrecto');
document.getElementById('rut').value = \"\";
});

});

 //$('input.notificacion').click(function(event){
//		alert('email obligatorio');
// });


 


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
			id_aviso_asig: {
				required: true
			},
			
			identificacion_documentos: {
				required: true
			},
			id_region: {
				//required: true,
				//required: function(element) {
				//   return $(\"#id_region\").val() != '0'
			    //    }
				required: function(element) {
					indice = document.form1.id_pais.selectedIndex ;
        			return document.form1.id_pais.options[indice].text == 'Chile';
      			}
			},
			id_comuna: {
				//required: true,
				//required: function(element) {
				//    return $(\"#id_comuna\").val() != '0'
			    //    }
				required: function(element) {
					indice = document.form1.id_pais.selectedIndex ;
        			return document.form1.id_pais.options[indice].text == 'Chile';
      			}
			},
			ciudad: {
				required: true
			},			
			fecha_ingreso:{
			required : true
			},
			id_entidad : {
			    required : true
			
			},
			entidad_origen: {
				required : true,
			  required: function(element) {
				  return $(\"#tipo_folio\").val() == 'D'
			  }			
			},
			fecha_original: {
				required : true,
			  required: function(element) {
				  return $(\"#tipo_folio\").val() == 'D'
			  }		
				
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
			email: \"<br>Email no valido\",
			ciudad: \"\",
			id_region: \"<br>Debe indicar una regi&oacute;n\",
			id_comuna: \"<br>Debe indicar una comuna\",
			id_entidad: \"<br>Debe indicar una entidad\",
			folio: \"<br>Ingrese el folio de la solicitud\",
			oficina: \"<br>Debe indicar una direcci&oacute;n\",
			identificacion_documentos: \"<br>Debe especificar que requerimientos de informaci&oacute;n o documentos\",
			entidad_origen: \"Debe ingresar la Entidad Origen\",
			fecha_original: \"Debe ingresar la fecha original\",
			id_aviso_asig: \"Debe indicar un Asignador para dar aviso de nueva solicitud\"
				
		}
	});
});


$(function(){
	
	$(\".calendario_datepicker\").datepicker({ maxDate:0});
	$(\".calendario_datepicker\").datepicker( \"option\", \"dateFormat\",'dd-mm-yy');
	
});




function muestraDerivacion(){

	document.getElementById('entidadPadreTr').style.display = '';
	document.getElementById('entidadOrigenTr').style.display = '';
	document.getElementById('otraEntidadOriginalTr').style.display = '';
	document.getElementById('documentoOriginalTr').style.display = '';
	document.getElementById('documentoOriginalTr2').style.display = '';
	document.getElementById('observacionOriginalTr').style.display = '';
	document.getElementById('fechaOriginalTr').style.display = '';
	
	
	
}
function ocultaDerivacion(){
	document.getElementById('entidadPadreTr').style.display = 'none';
	document.getElementById('entidadOrigenTr').style.display = 'none';
	document.getElementById('otraEntidadOriginalTr').style.display = 'none';
	document.getElementById('documentoOriginalTr').style.display = 'none';
	document.getElementById('documentoOriginalTr2').style.display = 'none';
	document.getElementById('observacionOriginalTr').style.display = 'none';
	document.getElementById('fechaOriginalTr').style.display = 'none';
	
}


function validaCombos(esto){
	
	

if (document.form1.check_otra.checked)	{
	document.form1.id_entidad_padre_origen.disabled=true;
	document.form1.id_entidad_padre_origen.value=0;
	document.form1.id_entidad_hija_origen.disabled=true;
	document.form1.id_entidad_hija_origen.value=0;
	document.form1.entidad_origen.disabled=false;
}else{
	document.form1.entidad_origen.disabled=true;
	document.form1.id_entidad_padre_origen.disabled=false;
	document.form1.id_entidad_hija_origen.disabled=false;

}
/*	if (document.form1.id_entidad_padre_origen.value!=\"0\"){
		if (document.form1.id_entidad_hija_origen.value!==\"0\"){
			document.form1.entidad_origen.disabled=true;
			
		}else{
			document.form1.entidad_origen.disabled=false;
			
		}
		
	}else{
		if (document.form1.entidad_origen.value==\"\"){
			alert(\"Debe seleccionar la entidad padre y la hija o ingresar otra entidad\");
		}
		else{
			
		}
	}*/
}

$(document).ready(function(){
	// Parametros para e id_entidad
   $(\"#id_entidad\").change(function () {
   		$(\"#id_entidad option:selected\").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post(\"sgs/solicitudes/select.php\", { elegido: elegido }, function(data){
				$(\"#oficina\").html(data);
				
			});			
        });
   })
	
});


function muestraOcultaRegionComuna(){
	indice = document.form1.id_pais.selectedIndex ;
	if (document.form1.id_pais.options[indice].text == 'Chile' ){//Etiqueta del combo si se selecciona chile
		document.getElementById('region_comuna').style.display = '';
	}else{
		document.getElementById('region_comuna').style.display = 'none';
	}
}

function contacto_no_obligatorio(){
	$('#direccion').removeClass('required error');
	$('#numero').removeClass('required error');
}





</script>";


$js .= "

	<script type=\"text/javascript\">
		$(document).ready(function(){
			
			$('#Registrarse').click(function(){
				

				var tipo_folio = $('[name=\"tipo_folio\"]:checked').val();
				
				if(tipo_folio == 'D'){
					if( $('#email').val() == \"\" && $('#direccion').val() == \"\" ){
						alert('Debe ingresar al menos un correo electr\u00f3nico o una direcci\u00f3n');
						return false;
					}else{
					
						/*	
						if($('#email').val() == \"\"){
							$('#numero').addClass('required');
						}*/
						
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
						
						if($('#form1').valid()==true){
							if(confirm(\"\u00BFEst\u00E1 seguro de ingresar esta solicitud?\")) { 
								$(\"#form1\").submit();
							}
						}
					}
				}else{
					if($('#form1').valid()==true){
						
						if( $('#email').val() == \"\" && $('#direccion').val() == \"\" ){
							
							$(\"#dialog\").dialog({
							   modal: true,
							   title: \"Advertencia de ingreso\",
							   width: 550,
							   minWidth: 400,
							   maxWidth: 650,
							   show: \"fold\",
							   hide: \"scale\",
							   buttons: {
									Aceptar: function(){
									
										if(confirm(\"\u00BFEst\u00E1 seguro de ingresar esta solicitud?\")) { 
											 $(\"#form1\").submit();
											 $(this).dialog('close'); 
										}
									},
									Cancelar: function(){
										$(this).dialog('close'); 
									}
							   }
							});
							
						}else{
							if(confirm(\"\u00BFEst\u00E1 seguro de ingresar esta solicitud?\")) { 
								$(\"#form1\").submit();
							}
						}
					}
				}
				
				
				
			});

		});
	
	</script>
";




$check = "<input type=\"checkbox\" name=\"check_otra\" id=\"check_otra\" onclick=\"validaCombos(this);\" />Otra";

   	$region = select_admin_campo_simple("regiones",$id_region, "onChange='cargaContenido(this.id)'", $clase,$id_opcional);
   
   
      if($id_region!=""){

 	  $query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region=$id_region";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while(list($id_comuna2,$comuna) = mysql_fetch_row($result)){
		  //$comuna= acentos_inverso($comuna);
		  if($id_comuna==$id_comuna2){
	  			$comunas_lista .="<option value=\"$id_comuna2\" selected>$comuna</option>";
	  
	      }else{
	  			$comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";
	      }
		  
		  
		  
		  
		 } 
		  
  	 }
		$comuna= "<select  class=\"combo\" name=\"id_comuna\" id=\"id_comuna\">
						<option value=\"\">Seleccione comuna..</option>
					</select>";

    
     $query= "SELECT id_tipo_persona,tipo_persona 
           FROM  tipo_persona
		   order by orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_persona,$tipo_persona) = mysql_fetch_row($result)){
				
				
		$lista_select_tipo_persona .="<option value=\"$id_tipo_persona\">$tipo_persona</option>\n";
				   
		 }
		$tipo_persona = "<select   name=\"id_tipo_persona\" id=\"id_tipo_persona\" onChange=\"displayOne('cdiv', this.selectedIndex);\">
                 $lista_select_tipo_persona
                 </select>";

$sql = "Select id_pais,pais from pais order by orden asc";
$result_pais = cms_query($sql)or die ("Error en la consulta de paises");
$paises .= "<option value=\"\" \"selected\" >--Seleccione-></option>";
while (list($id_pais2,$pais) = mysql_fetch_row($result_pais)){
	$paises .= "<option value=\"$id_pais2\" >$pais</option>";
}

$paises = "<select id=\"id_pais\" name=\"id_pais\" onchange='muestraOcultaRegionComuna();' >
				".$paises."
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
			
   $formulario_acceso = html_template('formulario_solicitud_papel');	
   
   
   $radios="
      
   <input type=\"radio\" name=\"tipo_folio\" id=\"tipo_folio\" value=\"P\" checked=\"checked\" onclick=\"document.form1.folio.value='';contacto_no_obligatorio();document.form1.folio.disabled = false;ocultaDerivacion();document.form1.fecha_original.value = '#COMODIN#';document.form1.entidad_origen.value = '#COMODIN#';document.form1.radio_oculto.value = this.value;\"/>
        Formulario
          <input type=\"radio\" name=\"tipo_folio\" id=\"tipo_folio\" value=\"C\" onclick=\"document.form1.folio.value='Folio autom&aacute;tico';contacto_no_obligatorio();document.form1.folio.disabled = true;ocultaDerivacion();document.form1.fecha_original.value = '#COMODIN#';document.form1.entidad_origen.value = '#COMODIN#';document.form1.radio_oculto.value = this.value;\" />
Carta
	
          <input type=\"radio\" name=\"tipo_folio\" id=\"tipo_folio\" value=\"D\" onclick=\"document.form1.folio.value='';document.form1.folio.disabled = false; muestraDerivacion();document.form1.fecha_original.value = '';document.form1.entidad_origen.value = '';document.form1.radio_oculto.value = this.value;\" />
Derivaci&oacute;n
<input type=\"hidden\" id=\"radio_oculto\" name=\"radio_oculto\" value=\"\">

";

$formulario_acceso = cms_replace("#RADIOS#","$radios",$formulario_acceso);



/***LLENAR ENTIDAD PADRE**/
		 $query= "SELECT id_entidad_padre,entidad_padre 
				   FROM  sgs_entidad_padre  ";
				   
		//echo "<br>".$query;
		 $result= cms_query($query)or die (error($query,mysql_error(),$php));
		 
		 $id_entidad_padre_origen_seleccionada = $id_entidad_padre_origen;
		 
		 $lista_select = "";
		 $num_registros = mysql_num_rows($result);
		
		 if ($num_registros >1){
			$lista_select .= "<option value=\"0\"  $selected >Seleccione...</option>";
		 }
		  while (list($id_entidad_filtro_origen,$entidad_filtro_origen) = mysql_fetch_row($result)){
		  		
				$entidad_filtro_origen = cambio_texto($entidad_filtro_origen);
				//$encontrado =  buscarCodigo($aEntidad,$id_entidad_filtro);
				//if ($encontrado==1){
					$selected= "";
					if($id_entidad_padre_origen_seleccionada==$id_entidad_filtro_origen){
						$selected = "selected";
					}
					$lista_select .="<option value=\"$id_entidad_filtro_origen\" $selected >$entidad_filtro_origen</option>";			   				//}
		   		
		 }
		
		//echo $lista_select;
		$entidad_padre_origen = "<select  class=\"combo\" name=\"id_entidad_padre_origen\"  id= \"id_entidad_padre_origen\"  onChange='cargaContenidoEntidad(this.id);'>$lista_select</select>";
		
		$lista_select = "<option value=\"0\">Seleccione una opci&oacute;n</option>";	
		if ($id_entidad_padre_origen_seleccionada==0) {
			$id_entidad_padre_origen_seleccionada = "";
		}	
		//filtro servicio
		


/*****/

$formulario_acceso = cms_replace("#ENTIDAD_PADRE_ORIGEN#","$entidad_padre_origen",$formulario_acceso);

/***LLENAR ENTIDAD HIJA  se llena con ajax**/
$filtro_entidad = "<select class=\"combo\" name=\"id_entidad_hija_origen\" id=\"id_entidad_hija_origen\" disabled> $lista_select </select>";

/*****/

$formulario_acceso = cms_replace("#ENTIDAD_HIJA_ORIGEN#","$filtro_entidad",$formulario_acceso);



$url_documento = "<input type=\"text\" class=\"combo\" name=\"url_1\" id=\"url_1\" size=\"60\" />";
$formulario_acceso = cms_replace("#DOCUMENTO#","$url_documento",$formulario_acceso);


$observacion = "<textarea name=\"observacion\" cols=\"48\" rows=\"7\" id=\"observacion\"></textarea>";
$formulario_acceso = cms_replace("#OBSERVACION#","$observacion",$formulario_acceso);





$entidad_origen = "<input type=\"text\" class=\"combo\" name=\"entidad_origen\" id=\"entidad_origen\" />";
$formulario_acceso = cms_replace("#ENTIDAD_ORIGEN#","$entidad_origen",$formulario_acceso);


$fecha_original = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_original\" id=\"fecha_original\"  readonly=\"readonly\" />
					<img src=\"images/calendario.gif\" alt=\"\" border=\"0\" >";
$formulario_acceso = cms_replace("#FECHA_ORIGINAL#","$fecha_original",$formulario_acceso);

$id_entidad = configuracion_cms('id_entidad');
$folio_demo=genera_folio($id_entidad,$tipo);

/*$folio = "<input type=\"text\" class=\"combo\" name=\"folio\" id=\"folio\" maxlength=\"20\" onkeyup=\"ObtenerDatos('index.php?accion=$accion&act=7&fol='+ form1.folio.value +'&radioOculto='+form1.radio_oculto.value+'&axj=1' ,'verifica');\"/>
				Ejem: $folio_demo <br><div id=\"verifica\" style=\"float: left;\" ></div> ";*/

$folio = "<input type=\"text\" class=\"combo\" name=\"folio\" id=\"folio\" maxlength=\"20\" onblur=\"ObtenerDatos('index.php?accion=$accion&act=7&fol='+ form1.folio.value +'&radioOculto='+form1.radio_oculto.value+'&axj=1' ,'verifica');\"/>
				Ejem: $folio_demo <br><div id=\"verifica\" style=\"float: left;\" ></div> ";
				
$formulario_acceso = cms_replace("#FOLIO#","$folio",$formulario_acceso);
/*$fecha_ingreso= "<input type=\"text\" class=\"combo\" name=\"fecha_ingreso\" id=\"fecha_ingreso\"  readonly=\"readonly\" onclick=\"displayCalendar(document.form1.fecha_ingreso,'dd-mm-yyyy',this)\"/>
				";*/
$fecha_ingreso = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_ingreso\" id=\"fecha_ingreso\" readonly=\"readonly\"/>
					<img src=\"images/calendario.gif\" alt=\"\" border=\"0\">";
$formulario_acceso = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$formulario_acceso);


$nombres = "<input type=\"text\" class=\"combo\" name=\"nombre\" id=\"nombre\" />";  
$paterno = "<input type=\"text\" class=\"combo\" name=\"paterno\" id=\"paterno\" />";
$materno = "<input type=\"text\" class=\"combo\" name=\"materno\" id=\"materno\" />";  

$razon_social = "<input type=\"text\" class=\"combo\" name=\"razon_social\" id=\"razon_social\" />";
$apoderado = "<input type=\"text\" class=\"combo\" name=\"apoderado\" id=\"apoderado\" />";
$email = "<input type=\"text\" class=\"combo\" name=\"email\" id=\"email\" />";
$direccion = "<input type=\"text\" class=\"combo\" name=\"direccion\" id=\"direccion\"  size=\"30\" />";
$numero = "<input type=\"text\" class=\"combo\" name=\"numero\" id=\"numero\" size=\"3\" />";
$depto = "<input type=\"text\" class=\"combo\" name=\"depto\" id=\"depto\" size=\"3\" />";
$ciudad = "<input type=\"text\" class=\"combo\" name=\"ciudad\" id=\"ciudad\" />";


   //include("personal/form/etiquetas_formulario.php");
  // $formulario_acceso = $formulario_registro;

   
   $fecha = date(d)."-".date(m)."-".date(Y);
   
	if($apoderado!=""){
	
	$apoderado ="<label>Apoderado</label>(si corresponde) $apoderado  <br />  ";	
	}

    $formulario_acceso = cms_replace("#TIPO_PERSONA#","$tipo_persona",$formulario_acceso);
	$formulario_acceso = cms_replace("#NOMBRES#","$nombre",$formulario_acceso);
	$formulario_acceso = cms_replace("#PATERNO#","$paterno",$formulario_acceso);
	$formulario_acceso = cms_replace("#MATERNO#","$materno",$formulario_acceso);
	$formulario_acceso = cms_replace("#RAZON_SOCIAL#","$razon_social $nombre $paterno $materno",$formulario_acceso);
	$formulario_acceso = cms_replace("#APODERADO#","$apoderado",$formulario_acceso);
	
	/*domicilio*/
	$formulario_acceso = cms_replace("#DIRECCION#","$direccion",$formulario_acceso);
	$formulario_acceso = cms_replace("#NUMERO#","$numero",$formulario_acceso);
	$formulario_acceso = cms_replace("#DEPTO#","$depto",$formulario_acceso);
	$formulario_acceso = cms_replace("#REGION#","$region",$formulario_acceso);
	$formulario_acceso = cms_replace("#CIUDAD#","$ciudad",$formulario_acceso);
	$formulario_acceso = cms_replace("#COMUNA#","$comuna",$formulario_acceso);
	$formulario_acceso = cms_replace("#PAIS#","$paises",$formulario_acceso);
	
	/*Datos de Ingreso al sistema*/
	$formulario_acceso = cms_replace("#MAIL#","$email",$formulario_acceso);
	
	

	/*Informaci�n de la solicitud*/
	
	$id_servicio = configuracion_cms('id_servicio');
	
	$servicio = rescata_valor('sgs_entidad_padre',$id_servicio,'entidad_padre'); 
	
	$servicio = acentos($servicio);
	$servicio = ucwords(strtolower(trim($servicio)));
	
	
		/*Datos estadísticos (opcionales)*/
		
	$ocupacion = select_admin_campo_simple("usuario_ocupacion",$id_ocupacion, $js_sel, $clase,$id_opcional);
    $rango_edad = select_admin_campo_simple("usuario_rango_edad",$id_rango_edad, $js_sel, $clase,$id_opcional);
    $sexo = select_admin_campo_simple("usuario_sexo",$id_sexo, $js_sel, $clase,$id_opcional);
	$nacionalidad = select_admin_campo_simple("usuario_nacionalidad",$id_nacionalidad, $js_sel, $clase,$id_opcional);
    $nivel_educacional = select_admin_campo_simple("usuario_nivel_educacional",$id_nivel_educacional, $js_sel, $clase,$id_opcional);
    $organizacion_sindical = select_admin_campo_simple("usuario_organizacion",$id_organizacion, $js_sel, $clase,$id_opcional);
    $frecuencia = select_admin_campo_simple("usuario_frecuencia_organizacion",$id_frecuencia_organizacion, $js_sel, $clase,$id_opcional);

		
	$formulario_acceso = cms_replace("#RUT#","<input type=\"text\" class=\"combo\" id=\"rut\" name=\"rut\" value=\"$rut\" size=\"12\" maxlength=\"12\" />",$formulario_acceso);
	$formulario_acceso = cms_replace("#CODIGO#","<input type=\"text\" class=\"combo\" id=\"codigo\" name=\"codigo\" value=\"$codigo\" size=\"3\" />",$formulario_acceso);
	$formulario_acceso = cms_replace("#TELEFONO#","<input type=\"text\" class=\"combo\" id=\"telefono\" name=\"telefono\" value=\"$telefono\" size=\"30\" />",$formulario_acceso);
	$formulario_acceso = cms_replace("#SEXO#","$sexo",$formulario_acceso);
	$formulario_acceso = cms_replace("#RANGO_EDAD#","$rango_edad",$formulario_acceso);
	$formulario_acceso = cms_replace("#NACIONALIDAD#","$nacionalidad",$formulario_acceso);
	$formulario_acceso = cms_replace("#NIVEL_EDUCACIONAL#","$nivel_educacional",$formulario_acceso);
	$formulario_acceso = cms_replace("#OCUPACION#","$ocupacion",$formulario_acceso);
	$formulario_acceso = cms_replace("#ORGANIZACION_SINDICAL#","$organizacion_sindical",$formulario_acceso);
	$formulario_acceso = cms_replace("#FRECUENCIA#","$frecuencia",$formulario_acceso);
	
	

	
	
	//$nombre_caja = str_replace("$prod ","",$nombre_caja);
	
	//$lista_entidades = select_admin_campo_simple("sgs_entidades",$id_entidad, $js_sel, $clase,$id_opcional);
	//sacar las entidades de configuracion
	$sql = "Select valor 
			from cms_configuracion 
			where configuracion='id_entidad'";
	$result = cms_query($sql) or die (error($sql,mysql_error(),$php));
	list($valor) = mysql_fetch_row($result);
	$aEntidad = split(',',$valor);
        
        
	
	
	$id_user= id_usuario($id_sesion);
	 
	 $query= "SELECT id_entidad , super_admin
               FROM  usuario u, usuario_perfil up
               WHERE id_usuario='$id_user' and  u.id_perfil=up.id_perfil";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_entidad_user,$super_admin) = mysql_fetch_row($result)){
		  	if($super_admin==0){
			$condw = " AND id_entidad =  '$id_entidad_user' ";
			}
			
		  }
		  
		  

		
	   $query= "SELECT id_entidad,entidad 
               FROM  sgs_entidades
               WHERE id_entidad_padre='$id_servicio'";
			   //$condw
			   
		
		//echo $query;	  
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
		// $lista_select_entidad_hija .= "<option value=\"\" selected >--Seleccione--></option>";
          while (list($id_entidad,$entidad) = mysql_fetch_row($result)){
		  		$entidad = cambio_texto($entidad);
				$encontrado =  buscarCodigo($aEntidad,$id_entidad);
				if ($encontrado==1){
					$lista_select_entidad_hija .="<option value=\"$id_entidad\">$entidad</option>";			   
				}
    		 }
	
	
	$lista_entidades = "<br><select class=\"combo\" name=\"id_entidad\" id=\"id_entidad\">$lista_select_entidad_hija</select>";
	
	$identificacion_documentos = "   <textarea name=\"identificacion_documentos\" id=\"identificacion_documentos\" cols=\"80\" rows=\"8\" class=\"combo\"></textarea>";
	$formulario_acceso = cms_replace("#LISTA_ENTIDADES#","$lista_entidades",$formulario_acceso);
	$formulario_acceso = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$formulario_acceso);
	$formulario_acceso = cms_replace("#SERVICIO#","$servicio",$formulario_acceso);
	
	
	
	if($firmado ==""){
	$firmado =1;
	}
	$var = "firmado_$firmado";
	$$var = "checked";
	
	$formulario_acceso = cms_replace("#SI_FIRMADO#","<input type=\"radio\" name=\"firmada\" id=\"firmada_si\" $firmado_1 value=\"1\"> S&iacute;  
	 <input type=\"radio\"  name=\"firmada\" id=\"firmada_no\" value=\"0\" $firmado_0> No    ",$formulario_acceso);
	
	
	
	/*Notificaci�n*/
	if($notificacion==""){
	$notificacion=0;
	}
	$var = "notificacion_$notificacion";
	$$var = "checked";
	

	$notificacion = "<input type=\"radio\" name=\"notificacion\" class=\"notificacion\" id=\"notificacion_1\" $notificacion_1 value=\"1\"  >Correo electr&oacute;nico&nbsp;&nbsp;   
					 <input type=\"radio\" $notificacion_0 name=\"notificacion\" id=\"notificacion_0\" class=\"notificacion\" value=\"0\"  >Correo postal    ";
	
	$formulario_acceso = cms_replace("#SI#","$notificacion",$formulario_acceso);
	
	/*Forma de recepci�n de la informaci�n solicitada*/
	
	$query= "SELECT  id_forma_recepcion,forma_recepcion,obliga      
               FROM  sgs_forma_recepcion
			   order by orden";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_forma_recepcion,$forma_recepcion,$obliga) = mysql_fetch_row($result)){
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
					
					
					
		  		
    				$for_rec.="<option value=\"$id_forma_recepcion\">$forma_recepcion</option>";
    		 }
			 
			 $forma_recepcion = "<select  class=\"combo\" name=\"id_forma_recepcion\" id=\"id_forma_recepcion\" onchange=\"accion()\">
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
               FROM  sgs_entidades_oficinas
			   $cond ";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_entidad_oficina,$oficina) = mysql_fetch_row($result)){
		  $oficina= ucwords($oficina);
    				$oficinas .="<option value=\"$oficina\">$oficina </option>";
    		 }
			 
			 $oficina = "<select  name=\"oficina\" id=\"oficina\" disabled>
                   <option value=\"0\">Seleccione una oficina</option>
                    $oficinas
                    </select>";
	
	$formulario_acceso = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$formulario_acceso);
	$formulario_acceso = cms_replace("#OFICINA#","$oficina (S&oacute;lo si Retira en Oficina)",$formulario_acceso);
	
	/*Formato de entrega*/
	
	
	$formato_entrega = "<input type=\"radio\" name=\"id_formato_entrega\" id=\"id_formato_entrega\" $notificacion_1 value=\"1\"> Copia en Papel   <input type=\"radio\" $notificacion_0 name=\"id_formato_entrega\" id=\"id_formato_entrega\" value=\"2\"> Formato electr&oacute;nico / Digital ";
	$formulario_acceso = cms_replace("#FORMATO_ENTREGA#","$formato_entrega",$formulario_acceso);
	$formulario_acceso = cms_replace("#FECHA#","$fecha",$formulario_acceso);
	$formulario_acceso = cms_replace("#CHECK_OTRA#","$check",$formulario_acceso);
	
	
	
	      $query= "SELECT id_entidad 
                 FROM  usuario
                 WHERE id_usuario='$id_usuario'";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($id_entidad_asig) = mysql_fetch_row($result);
		   

 	  $query= "SELECT id_usuario,nombre , paterno 
               FROM  usuario
			   WHERE id_entidad='$id_entidad_asig' and estado =1 and id_perfil = 1003
			   order by nombre";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while(list($id_usuario_asig,$nombre_asig, $paterno_asig) = mysql_fetch_row($result)){
		
			  			$aviso_asig_lista .="<option value=\"$id_usuario_asig\">$nombre_asig $paterno_asig</option>";
	    
		  } 
		  
  
		$aviso_asig_lista = "<select  class=\"combo\" name=\"id_aviso_asig\" id=\"id_aviso_asig\">
						<option value=\"\">Seleccione asignador para aviso</option>
						$aviso_asig_lista 
					</select>";
	
	$formulario_acceso = cms_replace("#LISTA_ASIGNADORES#","$aviso_asig_lista",$formulario_acceso);
	
	//$boton_enviar = "<input name=\"Registrarse\" class=\"btn btn-primary\" type=\"submit\" id=\"Registrarse\" value=\"Enviar Solicitud\" />";
	$boton_enviar = "<button name=\"Registrarse\" class=\"btn btn-primary\" type=\"button\" id=\"Registrarse\">Enviar Solicitud</button> ";
	$formulario_acceso = cms_replace("#BOTON_ENVIAR#","$boton_enviar",$formulario_acceso);
	
	$observaciones_adicionales = "<textarea name=\"observaciones_adicionales\" id=\"observaciones_adicionales\" cols=\"80\" rows=\"8\" class=\"textos\"></textarea>";
	$formulario_acceso = cms_replace("#OBSERVACIONES_ADICIONALES#","$observaciones_adicionales",$formulario_acceso);
	
	// Documentos adjuntos
	$archivo .= "Seleccione un archivo &nbsp&nbsp <input type=\"file\" id=\"archivo_1\" name=\"archivo_1\"><br>";
	$archivo .= "Seleccione un archivo &nbsp&nbsp <input type=\"file\" id=\"archivo_2\" name=\"archivo_2\"><br>";
	$archivo .= "Seleccione un archivo &nbsp&nbsp <input type=\"file\" id=\"archivo_3\" name=\"archivo_3\">";
	$formulario_acceso = cms_replace("#ADJUNTA_DOCUMENTOS#","$archivo",$formulario_acceso);
	
	
	
	$contenido= $formulario_acceso." <script language='javascript'> 
										  	ocultaDerivacion();
     										document.form1.radio_oculto.value = 'P';
  									</script> ";
	
	
	
	/*formulario de solicitud de acceso

/*

<h3>Solicitud de Acceso a Informaci&oacute;n P&uacute;blica:</h3>
<br> <strong>#SERVICIO#</strong>
              <p>Los campos indicados con (*) son obligatorios 
  <fieldset><legend>Informaci&oacute;n del formulario</legend>
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td>Medio de ingreso</td>
      <td>
	  <input type="radio" name="tipo_folio" id="tipo_folio" value="P" checked="checked" />
        Formulario
          <input type="radio" name="tipo_folio" id="tipo_folio" value="C" />
Carta
</td>
    </tr>
    <tr>
      <td width="24%"><label>Folio </label>
        *     </td>
      <td width="76%"><input type="text" name="folio" id="folio" />#AJAX#</td>
    </tr>
    <tr>
      <td><label>Fecha del formulario </label>
* </td>
      <td><input type="text" name="fecha_ingreso" id="fecha_ingreso" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>(Ingrese la fecha que figura en el formulario DD-MM-AAAA)</td>
    </tr>
  </table>
  <br />
  </fieldset>
<fieldset><legend>Datos Personales</legend><br />
<label>Tipo de Persona</label> <br />
&nbsp; #TIPO_PERSONA# <br />
<div class="showhide" id="cdiv0"><label>Nombres</label> *<br />
 
  <input type="text" name="nombre" id="nombre" />
 
  (Francisco)<br />
<label>Apellido Paterno</label> *<br />
<input type="text" name="paterno" id="paterno" /> 
(Merino)<br />
<label>Apellido Materno</label> *<br />
<input type="text" name="materno" id="materno" /> 
(Echeverria)</div>
<div class="showhide" id="cdiv1"><label>Raz&oacute;n Social</label> *<br />
  <input type="text" name="razon_social" id="razon_social" />
  <br />
<label>Apoderado</label> *<br />
<input type="text" name="apoderado" id="apoderado" />
</div>

</span><label>Email</label> <br />
<input type="text" name="email" id="email" />
</fieldset>
             <br /><br />
              <br />
             <fieldset>
             <legend> Domicilio</legend>
             

<br />
<table width="100%" class="tabla_nb" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td align="left" ><label>Direcci&oacute;n</label></td>
        <td align="left" ><input type="text" name="direccion" id="direccion" /></td>
        <td align="left" ><label>N&uacute;mero</label></td>
        <td align="left" ><input type="text" name="numero" id="numero" /></td>
      </tr>
      <tr>
        <td align="left" ><label>Departamento</label></td>
        <td align="left" ><input type="text" name="depto" id="depto" /></td>
        <td align="left" ><label></label></td>
        <td align="left" >&nbsp;</td>
      </tr>
      <tr>
        <td align="left" ><label>Ciudad</label></td>
        <td align="left" ><input type="text" name="ciudad" id="ciudad" /></td>
        <td align="left" >&nbsp;</td>
        <td align="left" >&nbsp;</td>
      </tr>
    <tr>
       <td width="8%" align="left" ><label> Regi&oacute;n </label></td>
       <td width="38%" align="left" >#REGION#</td> 
     <td width="11%" align="left" ><label> Comuna </label></td>
	   <td width="43%" align="left" >#COMUNA#</td> 
        </tr>
  	</table>




<br />
<br />
             </fieldset>
             <br />
 <br />
     


               <fieldset>
              <legend>Informaci&oacute;n de la Solicitud</legend>
              <label></label>
              <label></label>
               <br/>
			  <label>Nombre de la entidad a la que dirige la solicitud</label> #LISTA_ENTIDADES#<br/><br/>
              <label>Identificaci&oacute;n de los documentos solicitados. Se&ntilde;ale la materia, fecha de 
			  emisi&oacute;n o per&iacute;odo de vigencia del documento, origen o destino, soporte, etc.:</label>
              <p>
               <textarea name="identificacion_documentos" id="identificacion_documentos" cols="80" rows="8" class="textos"></textarea>
                <br />
              </p>
              <label></label>
              <br />         
            
              </fieldset>
               <br />
               <br />

<fieldset>
              <legend>Notificaci&oacute;n</legend>
              <br />
<label>Deseo ser notificado por correo electr&oacute;nico #SI#</label><label><br />
              </label>
<br />
</fieldset>
              
              <br/>
              <br/>
               <fieldset>
              <legend>Forma de recepci&oacute;n de la informaci&oacute;n solicitada</legend>
              <br />
              <label>Seleccione forma #FORMA_RECEPCION#</label><br />
              <div class="showhide" id="cdiv0">
              <label>Especificar oficina: #OFICINA#</label><br /><br />
              </div>
             
</fieldset> <br /><br />
              
<fieldset>
              <legend>Formato de entrega</legend>
              <br />
              <label>Seleccione formato de entrega <br/> #FORMATO_ENTREGA#<br />
              <br />
              </label>
              <br />
</fieldset>
              
                            <fieldset>
              <legend>Datos  estad&iacute;sticos (opcionales)</legend>
              <br /><label>
              RUT / RUN</label>
              <br />
             #RUT#
              (ej: 12233456-8)
              <br /><label>
              Tel&eacute;fono de Contacto</label>
              <br />
              #CODIGO# -#TELEFONO#<label></label>(ej: 562-456 78 90) 
              <label><br />
              </label>
              <hr />
              <label>Sexo </label>#SEXO# <label>Edad</label>#RANGO_EDAD# <br/>
			  <label>Nacionalidad </label>#NACIONALIDAD#
            
              <hr />
              
              <label>Nivel Educacional </label>#NIVEL_EDUCACIONAL#  
			  <br /><label>Ocupaci&oacute;n </label>#OCUPACION#
              <hr />
               <label>Tipo de Organizaci&oacute;n en la que participa</label>
             
              #ORGANIZACION_SINDICAL#
         <br />
              <label>
              Frecuencia</label> #FRECUENCIA#
<br />
              </fieldset>
              
              <div align="center"></div>
              <div align="center"></div>
 
     
              </div>

              
              <div align="center">
                <input name="Registrarse" type="submit" class="botones" id="Registrarse" value="Enviar Solicitud" />
              </div>
 
     
              </div>
	*/
	
	
?>