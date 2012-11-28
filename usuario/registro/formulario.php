<?php

				 
//$select_regiones = generaRegion();


if(!verifica($id_sesion)){

$css="
	<style type='text/css'>
		
	</style>";


$js .="<script src=\"js/jquery/jquery.Rut.min.js\" type=\"text/javascript\"></script>



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
	//submitHandler: function() { alert(\"submitted!\"); }
});




$(document).ready(function(){
$('#rut').Rut(
			function(){ 
			alert('Rut incorrecto');
			document.getElementById('rut').value = \"\";
});
	$('#id_nacionalidad').change(function(){
		if($(this).val()==1 ||$(this).val()==''){
			document.getElementById('rut').value = \"\";
			$('#rut').Rut(
			function(){ 
			alert('Rut incorrecto');
			document.getElementById('rut').value = \"\";
			});
		}else{
			$('#rut').unbind();
			document.getElementById('rut').value = \"\";
		}		
	});
});

$(function(){
	$(\"#fecha_nac\").datepicker({ maxDate:0/*,maxDate: '-19Y/12M'*/});
	$( \"#fecha_nac\" ).datepicker( \"option\", \"dateFormat\",'dd-mm-yy');
	
});



$().ready(function() {


	var container2 = $('div.container2');
	// validate signup form on keyup and submit
	$(\"#form1\").validate({

rules: {
			nombre : {
				
				required : true
			},
			paterno: {
				required : true
			},
			materno: {
				required : true
			},
			email: {
				required: true,
				email: true
			},
			id_pais: {
				required: function(element) {
					return $(\"#id_pais\").val() != '0'
      			}
			},
			id_region: {
				//required: true,
				//required: function(element) {
				//   return $(\"#id_region\").val() != '0'
			    //    }
				required: function(element) {
					return $(\"#id_region\").val() != '0'
      			}
			},
			id_comuna: {
				//required: true,
				//required: function(element) {
				//    return $(\"#id_comuna\").val() != '0'
			    //    }
				required: function(element) {
					return $(\"#id_comuna\").val() != '0'
      			}
			},
			id_sexo: {
				required: function(element) {
					return $(\"#id_sexo\").val() != '0'
      			}
			},
			fecha_nac: {
				required: true
			},
			ciudad: {
				required: true
			},
			
			direccion: {
				required: true
			},
			pass: {
				required: true,
				minlength: 6
			},
			pass2: {
				required: true,
				minlength: 6,
				equalTo: \"#pass\"
			},
			texto_ingresado:{
				required: true
				
			},
			terminos_condiciones:{
				required:true
			}
		},
		messages: {
			nombre: \"Ingrese su nombre\",
			paterno: \"Ingrese su Apellido Paterno\",
			materno: \"Ingrese su Apellido Materno\",
			fecha_nac:\"Falta la Fecha de nacimiento\",
			direccion:\"Falta la direcci&oacute;n\",
			ciudad: \"Falta Ciudad\",
			texto_ingresado: \" Ingrese Captcha\",
			terminos_condiciones: \"Seleccione terminos y condiciones\",			
			pass: {
				required: \"Ingrese su Contrase&ntilde;a\",
				minlength: \"Su contrase&ntilde;a debe contener a lo menos 6 caracteres\"
			},
			pass2: {
				required: \"Confirme su contrase&ntilde;a\",
				minlength: \"Su contrase&ntilde;a debe contener a lo menos 6 caracteres\",
				equalTo: \"Las contrase&ntilde;as no son iguales\"
			},
			email: \"Email no valido\"
		},	
		errorcontainer2: container2,
		errorLabelcontainer2: $(\"div'\", container2),
		/*wrapper: 'li',*/
		meta: \"validate\"
	});
});

 
</script>";

//$onsubmit ="onSubmit=\"return validaforma2(this)\"";
}

 	$paterno = $_POST['paterno'];
	$materno = $_POST['materno'];
	$razon_social = $_POST['razon_social'];
	$apoderado = $_POST['apoderado'];
	$direccion = $_POST['direccion'];
	$numero = $_POST['numero'];
	$depto = $_POST['depto'];
	//$id_usuario_ocupacion = $_POST['id_usuario_ocupacion'];
	//$id_rango_edad = $_POST['id_rango_edad'];
	$id_sexo = $_POST['id_sexo'];
	$id_nacionalidad = $_POST['id_nacionalidad'];
	//$id_nivel_educacional = $_POST['id_nivel_educacional'];
	//$id_organizacion = $_POST['id_organizacion'];
	//$id_frecuencia_organizacion = $_POST['id_frecuencia_organizacion'];
	$id_region = $_POST['id_region'];
	$id_tipo_persona = $_POST['id_tipo_persona'];
	$id_comuna = $_POST['id_comuna'];
	$ciudad = $_POST['ciudad'];
	$email = $_POST['email'];
	$codigo = $_POST['codigo'];
	$telefono = $_POST['telefono'];
	$id_pais = $_POST['id_pais'];


$sql = "Select id_pais,pais from pais order by orden asc";
$result_pais = cms_query($sql)or die ("Error en la consulta de paises");
$paises .= "<option value=\"0\" \"selected\" >--Seleccione--</option>";
while (list($id_pais2,$pais) = mysql_fetch_row($result_pais)){
	$pais = utf8_encode($pais);
	$paises .= "<option value=\"$id_pais2\" >".$pais."</option>";
}

$paises = "<select name=\"id_pais\" id=\"id_pais\" onchange='muestraOcultaRegionComuna();' >
				".$paises."
		   </select>";



//$pais = select_admin_campo_simple("pais",$id_pais, "onChange='cargaContenido(this.id)'", $clase,$id_opcional);
$region = select_admin_campo_simple("regiones",$id_region, "onChange='cargaContenido(this.id)'", $clase,$id_opcional);

$query= "SELECT id_pais 
               FROM  pais
			   WHERE pais LIKE '%Chile%'";
$result= cms_query($query)or die (error($query,mysql_error(),$php));
list($id_pais_chile) = mysql_fetch_row($result);
  
 if(verifica($id_sesion)){
	
	 

	
	  $query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region='$id_region'
			   order by orden";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while(list($id_comuna2,$comuna) = mysql_fetch_row($result)){
		  
		  if($id_comuna==$id_comuna2){
	  			$comunas_lista .="<option value=\"$id_comuna2\" selected>$comuna</option>";
	  
	      }else{
	  			$comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";
	      }
		  
		  
		  
		  
		 } 
		  
  	
		$comuna = "<select name=\"id_comuna\" id=\"id_comuna\">
						$comunas_lista
					</select>";
}	
 else
 {
      //  $region = "$select_regiones";
	 
 		if($id_comuna!=""){
		  $query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region='$id_region'
			   order by orden";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while(list($id_comuna2,$comuna) = mysql_fetch_row($result)){
		   	if($id_comuna==$id_comuna2){
	  			$comunas_lista .="<option value=\"$id_comuna2\" selected>$comuna</option>";
	  
	      	}else{
	  			$comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";
	      	}
		  
		  }
		  $comuna= "<select name=\"id_comuna\" id=\"id_comuna\">
					<option value=\"\">Seleccione Comuna...</option>
						$comunas_lista
					</select>";
		}else{
		 $comuna= "<select name=\"id_comuna\" id=\"id_comuna\">
					
						<option value=\"\">Seleccione Comuna...</option>
					</select>";
		}
		
		
}


// PAISES, REGIONES Y COMUNAS
$paises = select_tabla('pais',$id_pais,'id_pais','pais',$js_sel,'','');
//$region = select_tabla('regiones',$id_region,'id_region','region',$js_sel,'','');

$query= "SELECT id_region,region
               FROM regiones
			   order by id_region";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
         while(list($id_region,$region) = mysql_fetch_row($result)){
			$region_lista .="<option value=\"$id_region\">$region</option>";
		 }
$region= "<select name=\"id_region\" id=\"id_region\">
			<option value=\"\">--Seleccione--</option>
			$region_lista
		  </select>";


$comuna = "<select id=\"id_comuna\" name=\"id_comuna\">
						<option value=\"\">--Seleccione--</option>
					 </select>";
 
 

// PAISES, REGIONES Y COMUNAS

   
	
	//$ocupacion = select_admin_campo_simple("usuario_ocupacion",$id_usuario_ocupacion, $js_sel, $clase,$id_opcional);
    //$rango_edad = select_admin_campo_simple("usuario_rango_edad",$id_rango_edad, $js_sel, $clase,$id_opcional);
    //$sexo_beneficiario = select_admin_campo_simple("usuario_sexo",$id_sexo, $js_sel, $clase,'');
	$sexo_beneficiario = select_tabla('usuario_sexo',$id_sexo,'id_sexo','sexo',$js_sel,'','');
	//$nacionalidad = select_admin_campo_simple("usuario_nacionalidad",$id_nacionalidad, $js_sel, $clase,$id_opcional);
	$nacionalidad = select_tabla('usuario_nacionalidad',$id_nacionalidad,'id_nacionalidad','nacionalidad',$js_sel,'','');
    //$nivel_educacional = select_admin_campo_simple("usuario_nivel_educacional",$id_nivel_educacional, $js_sel, $clase,$id_opcional);
    //$organizacion_sindical = select_admin_campo_simple("usuario_organizacion",$id_organizacion, $js_sel, $clase,$id_opcional);
    //$frecuencia = select_admin_campo_simple("usuario_frecuencia_organizacion",$id_frecuencia_organizacion, $js_sel, $clase,$id_opcional);
    
	include("captcha/captcha.php");
        
       
	/*PERSONALES*/
	$formulario_registro = html_template('formulario_registro');	
	
	
  $query= "SELECT id_tipo_persona,tipo_persona 
           FROM  tipo_persona
		   order by orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_persona2,$tipo_persona) = mysql_fetch_row($result)){
				
				if($id_tipo_persona==$id_tipo_persona2){
				$lista_select_tipo_persona .="<option value=\"$id_tipo_persona2\" selected>$tipo_persona</option>\n";
				}else{
				$lista_select_tipo_persona .="<option value=\"$id_tipo_persona2\">$tipo_persona</option>\n";
				}
				
						   
		 }
	$tipo_persona = "Seleccione Tipo de Persona <select name=\"id_tipo_persona\" id=\"id_tipo_persona\" onChange=\"displayOne('cdiv', this.selectedIndex);\">
                 $lista_select_tipo_persona
                 </select>";
				 
	/*$tipo_persona = "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                        <tr><td  class=\"textos\" colspan=\"2\"><h3 style=\"text-align:center; margin-top: 0px\">Seleccione Tipo de Persona</h3> </td></tr> 
						 <tr >
                           <td align=\"center\" class=\"textos\" onClick=\"displayOne('cdiv', 0);\" style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">Persona</td>
                           <td align=\"center\" class=\"textos\" onClick=\"displayOne('cdiv', 1);\" style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">Empresa</td>
                           </tr>
                     	</table>";	*/
	
	$formulario_registro = str_replace("#PAIS#","$paises",$formulario_registro);
	
	$formulario_registro = str_replace("#SEXO#",$sexo_beneficiario,$formulario_registro);
	$fecha_nac_beneficiario = "<input type=\"text\" readonly=\"readonly\" name=\"fecha_nac\" id=\"fecha_nac\" class=\"tt valida\">";
	$formulario_registro = str_replace("#FECHA_DE_NACIMIENTO#",$fecha_nac_beneficiario,$formulario_registro);
	
	//$formulario_registro = str_replace("#TIPO_PERSONA#","$tipo_persona",$formulario_registro);
	$formulario_registro = str_replace("#NOMBRES#","<input type=\"text\"  class=\"combo valida\"  id=\"nombre\" name=\"nombre\" value=\"$nombre\" size=\"30\" class=\"username \"/> ",$formulario_registro);
	$formulario_registro = str_replace("#PATERNO#","<input type=\"text\"  class=\"combo valida\"  id=\"paterno\" name=\"paterno\" value=\"$paterno\" size=\"30\" /> ",$formulario_registro);
	$formulario_registro = str_replace("#MATERNO#","<input type=\"text\"  class=\"combo valida\"  id=\"materno\" name=\"materno\" value=\"$materno\" size=\"30\" /> ",$formulario_registro);
	//$formulario_registro = str_replace("#RAZON_SOCIAL#","<input type=\"text\"  class=\"combo\"  id=\"razon_social\" name=\"razon_social\" value=\"$razon_social\" size=\"30\" />",$formulario_registro);
	//$formulario_registro = str_replace("#APODERADO#","<input type=\"text\"  class=\"combo\"  id=\"apoderado\" name=\"apoderado\" value=\"$apoderado\" size=\"30\" />",$formulario_registro);
	//$formulario_registro = str_replace("#APODERADO_NATURAL#","<input type=\"text\"  class=\"combo\"  id=\"apoderado_natural\" name=\"apoderado_natural\" value=\"$apoderado\" size=\"30\" />",$formulario_registro);
	
	/*domicilio*/
	$formulario_registro = str_replace("#DIRECCION#","<input type=\"text\"  class=\"combo valida\"  id=\"direccion\" name=\"direccion\" value=\"$direccion\" size=\"30\"  />",$formulario_registro);
	$formulario_registro = str_replace("#NUMERO#","<input type=\"text\"  class=\"combo\"  id=\"numero\" name=\"numero\" value=\"$numero\" size=\"3\" maxlength=\"100\"  />",$formulario_registro);
	$formulario_registro = str_replace("#DEPTO#","<input type=\"text\"  class=\"combo\"  id=\"depto\" name=\"depto\" value=\"$depto\" size=\"3\" />",$formulario_registro);
	$formulario_registro = str_replace("#REGION#","$region",$formulario_registro);

//	$campo_ciudad="<input type=\"text\"  class=\"combo\"  id=\"ciudad\" name=\"ciudad\" value=\"$ciudad\" size=\"15\" onkeyup=\"lookup(this.value,'ciudad','usuario');\"/>";
	$campo_ciudad="<input type=\"text\"  class=\"combo\"  id=\"ciudad\" name=\"ciudad\" value=\"$ciudad\" size=\"15\" />";
			/*
			<div class=\"suggestionsBox\" id=\"suggestions\" style=\"display: none;\">
				<img src=\"images/upArrow.png\" style=\"position: relative; top: -12px; left: 30px;\" alt=\"upArrow\" />
				<div class=\"suggestionList\" id=\"autoSuggestionsList\">
					&nbsp;
				</div>
			</div>*/
	
	$formulario_registro = str_replace("#CIUDAD#",$campo_ciudad,$formulario_registro);
	$formulario_registro = str_replace("#COMUNA#","$comuna",$formulario_registro);
		
	/*Datos de Ingreso al sistema*/
	$formulario_registro = str_replace("#MAIL#","<input type=\"text\"  class=\"combo\"  id=\"email\" name=\"email\" value=\"$email\" size=\"30\" /> (Ejm. fmerino@economia.gov.cl) ",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA#","<input type=\"password\" id=\"pass\" name=\"pass\" value=\"\" size=\"30\"  />",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA2#","<input type=\"password\" id=\"pass2\" name=\"pass2\" value=\"\" size=\"30\"  />",$formulario_registro);
	
	/*Datos estadáticos (opcionales)*/
	$formulario_registro = str_replace("#RUT#","<input type=\"text\"  class=\"combo\"  id=\"rut\" name=\"rut\" value=\"$rut\" size=\"12\" maxlength=\"12\" /> ",$formulario_registro);
	$formulario_registro = str_replace("#CODIGO#","<input type=\"text\" style=\" width: 20px;\" class=\"combo\"  id=\"codigo\" name=\"codigo\" value=\"$codigo\" maxlength=\"3\" size=\"3\" />",$formulario_registro);
	$formulario_registro = str_replace("#TELEFONO#","<input type=\"text\"  class=\"combo\"  id=\"telefono\" name=\"telefono\" value=\"$telefono\" size=\"30\" maxlength=\"20\"/> (Ej. 562-456 78 90)",$formulario_registro);
	//$formulario_registro = str_replace("#SEXO#","$sexo",$formulario_registro);
	//$formulario_registro = str_replace("#RANGO_EDAD#","$rango_edad",$formulario_registro);
	$formulario_registro = str_replace("#NACIONALIDAD#","$nacionalidad",$formulario_registro);
	//$formulario_registro = str_replace("#NIVEL_EDUCACIONAL#","$nivel_educacional",$formulario_registro);
	//$formulario_registro = str_replace("#OCUPACION#","$ocupacion",$formulario_registro);
	//$formulario_registro = str_replace("#ORGANIZACION_SINDICAL#","$organizacion_sindical",$formulario_registro);
	//$formulario_registro = str_replace("#FRECUENCIA#","$frecuencia",$formulario_registro);
	
	
	
	$texto_form_head = "<p align=\"justify\">Para registrarse en este sistema complete el siguiente formulario y presione el bot&oacute;n &quot;#TEXTO_BOTON#&quot;. A continuaci&oacute;n recibir&aacute; un correo electr&oacute;nico con indicaciones para verificar la validez de los datos proporcionados y activar su cuenta.</p>
<div id=\"mensaje\" class=\"mensaje\">Los campos indicados con (*) son obligatorios</div>";
	//$formulario_registro = str_replace("#TEXTO_FORMULARIO_HEAD#",$texto_form_head,$formulario_registro);
	$formulario_registro = str_replace("#TEXTO_BOTON#","Guardar cambios",$formulario_registro);
	//$formulario_registro = str_replace("#TITULO_FORM#","Formulario Registro",$formulario_registro);
	
	$terminos_condiciones = "<input type=\"checkbox\" id=\"terminos_condiciones\" name=\"terminos_condiciones\">Acepta <a href=\"?accion=terminos-y-condiciones\" target=\"_blank\">t&eacute;rminos y condiciones</a>";
	$formulario_registro = str_replace("#TERMINOS_CONDICIONES#",$terminos_condicionesX,$formulario_registro);
	
	
	$var_div ="<div class=\"container2\" style=\"display: none;\">
	
	<ol><li><h3>Errores</h3></li></ol>
</div>";

	if($captcha_form != ""){
		$boton_captcha = html_template('boton_captcha');
		$captcha_form = cms_replace("#BOTON_CAPTCHA#",$boton_captcha,$captcha_form);
		$formulario_registro = str_replace("#CAPTCHA#","$captcha_form $var_div",$formulario_registro);
		$boton_captcha = html_template('boton_captcha');
		$formulario_registro = cms_replace("#BOTON_CAPTCHA#",$boton_captcha,$formulario_registro);
	}else{
		$sin_captcha = html_template('sin_captcha');
		$formulario_registro = str_replace("#CAPTCHA#","$sin_captcha",$formulario_registro);
	}
	
	$formulario_registro = str_replace("#FORMU#","$formu",$formulario_registro);
	
	
	
	
	$contenido =$formulario_registro .$formu;
	
	$js .="
	
	
	<script type=\"text/javascript\">
	
		$(document).ready(function(){
		
			$(\"#nombre\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s]/i);
			$(\"#paterno\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s -]/i);
			$(\"#materno\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s -]/i);
			$(\"#direccion\").keyfilter(/[a-z0-9_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ ' .\s]/i);
			$(\"#numero\").keyfilter(/[\d\-\.]/);
			$(\"#depto\").keyfilter(/[a-z0-9_\s]/i);
			
			$(\"#email\").keyfilter(/[a-z0-9_\.\-@]/i);
			$(\"#codigo\").keyfilter(/[\d\-\.]/);
			$(\"#telefono\").keyfilter(/[\d\-\.]/);
		
			$('#id_region').attr('disabled', true);
			$('#id_comuna').attr('disabled', true);
		
			$('.tab_content').hide();
				$('ul.tabs li:first').addClass('active').show();
				$('.tab_content:first').show();
				$('ul.tabs li').click(function()
				{
				   
				  $('ul.tabs li').removeClass('active');
					$(this).addClass('active');
					$('.tab_content').hide();
					
					var activeTab = $(this).find('a').attr('href');
					$(activeTab).fadeIn();
					
					
					return false;
			});
			
			$('.next_step input[type=button]').click(function(){
				
				if($('#form1').valid()==true){
				var x;
					$('ul.tabs li').each(function(i){
						if($(this).attr('class')=='active'){
							x=i+1;
							$(this).removeClass('active');
							$($(this).find('a').attr('href')).hide();
						}
						if(x==i){
							$(this).addClass('active');
							$($(this).find('a').attr('href')).show();
						}
					});
				}	
					
			});
			
			// BOTON REGISTRO
			$('#Registrarse').click(function(){
				if($('#form1').valid()==true){
							
							var	valorSelectTab1=0;
							var valorTextTab1=0;
							var valorTextTab2=0;
							var valorPassTab2=0;
							$('#tab_datos_personales input[type=text]').each(function(i){
										if(i!=5 && i!=6)
											if($(this).val()=='')
												valorTextTab1++;
							});
							$('#tab_datos_personales select').each(function(i){
										if($(this).is(':disabled') == false)
											if($(this).val()=='')
												valorSelectTab1++;
							});
							$('#tab_datos_ingreso input[type=text]').each(function(i){
											if($(this).val()==''||($(this).val().indexOf('@', 0) == -1 || $(this).val().indexOf('.', 0) == -1))
												valorTextTab2++;
							});
							$('#tab_datos_ingreso input[type=password]').each(function(i){
											if($(this).val()=='' || $(this).val().length < 6)
												valorPassTab2++;
							});
							if(valorSelectTab1==0 && valorTextTab1==0 && valorTextTab2==0 && valorPassTab2==0){
									$.post('index.php?accion=$accion&act=4',{
										texto_ingresado:$('#texto_ingresado').val()
									}, function(resp){
											if(resp==0){
												ObtenerDatos('captcha/refresh.php','captcha');
												$('ul.tabs li').each(function(i){
														if(i==3){
															$(this).addClass('active');
															$($(this).find('a').attr('href')).show();
															$('#texto_ingresado').val('');
															$('#Registrarse').click();
														}
												});
											}else{
												$('#tr_mensaje').show(); 
												document.getElementById('form1').action='index.php?accion=$accion&act=5';
												$('#form1').submit();
											}
											
									});
							}else{
								if(valorSelectTab1>0 || valorTextTab1>0){
									$('ul.tabs li').each(function(i){
											if(i==0){
												$(this).addClass('active');
												$($(this).find('a').attr('href')).show();
												$('#next_step_1').click();
											}
									});
								}else if(valorTextTab2>0 || valorPassTab2 >0){
									$('ul.tabs li').each(function(i){
											if(i==1){
												$(this).addClass('active');
												$($(this).find('a').attr('href')).show();
												$('#next_step_2').click();
											}
									});
								}
							}			
				}
			});
			
			$('#id_pais').change(function(){
				if($('#id_pais').val() == '$id_pais_chile'){
					$('#id_region').attr('disabled', false);
					$('#id_comuna').attr('disabled', false);
					
				}else{
					$('#id_region option')['0'].selected = true;
					$('#id_region').attr('disabled', true);
					
					var sele = document.createElement(\"select\");
					var opt = document.createElement(\"option\");
					opt.value = \"\";
					opt.innerHTML = \"--Seleccione--\";
					sele.appendChild(opt);
					sele.disabled = true;
					$('#div_comuna').html(sele);
				}
			});
			
			$('#id_region').change(function(){
				$.post('index.php?accion=$accion&act=3&axj=1',{
							idRegion:$(this).val()
				}, function(resp){
						if($('#id_region').val() != \"\"){
							$('#div_comuna').html('');
							$('#div_comuna').html(resp);
							$('#id_comuna').disabled = false;
						}else{
							var sele = document.createElement(\"select\");
							var opt = document.createElement(\"option\");
							opt.value = \"\";
							opt.innerHTML = \"--Seleccione--\";
							sele.appendChild(opt);
							sele.disabled = true;
							$('#div_comuna').html(sele);
						}
				});
			});
			
			
		
		});
	
	</script>
	
	";
		
$css .="<style type=\"text/css\">
	

	.suggestionsBox {
		position: absolute;
		left: 100px;
		margin: 40px 0px 0px 0px;
		width: 200px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		font-family: Helvetica;
		font-size: 11px;
	}
	
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li {
		
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover {
		background-color: #659CD8;
	}
</style>";
	


	
?>