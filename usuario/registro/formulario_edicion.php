<?php


				 
if($id_tipo_persona==1){
	//no pedir el apoderado
	$valida_apoderado ="";
	$muestra_div =0;
}
else{
	//pedir el apoderado
	$valida_apoderado = " apoderado: {
								required : true

							},";
	$muestra_div =1;
}
			 
				 
$select_regiones = generaRegion();



$js .="<script type=\"text/javascript\" src=\"comuna_select/js/select_dependientes.js\"></script>
<script src=\"js/jquery/jquery.Rut.min.js\" type=\"text/javascript\"></script>

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
displayOne('cdiv', $muestra_div);
if (disStyle)
getItem('showhide').disabled=true;
}
</script>



<script type=\"text/javascript\">


$.validator.setDefaults({
	//submitHandler: function() { alert(\"submitted!\"); }
});



//$(document).ready(function(){
// Demo 1
//$('#rut').Rut();

//});



$().ready(function() {


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
			direccion: {
				required: true
			},
			numero: {
				required: true
			},
			
			pass2: {
				
				minlength: 6,
				equalTo: \"#pass\",
				required: function(element) {
				    return $(\"#pass\").val() != ''
			        }
			},
			texto_ingresado:{
				required: true
				
			}
		},
		messages: {
			nombre: \"Ingrese su nombre\",
			paterno: \"Ingrese su Apellido Paterno\",
			materno: \"Ingrese su Apellido Materno\",
			direccion:\"\",
			numero: \"\",
			ciudad: \"\",
			id_region: \"\",
			id_comuna: \"\",
			texto_ingresado: \"\",
			pass: {
				required: \"Ingrese su nueva Contrase&ntilde;a\",
				minlength: \"Su contrase&ntilde;a debe contener a lo menos 6 caracteres\"
			},
			pass2: {
				required: \"Confirme su contrase&ntilde;a\",
				minlength: \"Su contrase&ntilde;a debe contener a lo menos 6 caracteres\",
				equalTo: \"Las contrase&ntilde;as no son iguales\"
			},
			email: \"Email no valido\"
		}
	});
});







function muestraOcultaRegionComuna(){
	indice = document.form1.id_pais.selectedIndex ;
	if (document.form1.id_pais.options[indice].text == 'Chile' ){//Etiqueta del combo si se selecciona chile
		document.getElementById('region_comuna').style.display = '';
	}else{
		document.getElementById('region_comuna').style.display = 'none';
	}
}
</script>
";






 if(verifica($id_sesion)){
	 
	$sql = "Select id_pais,pais from pais order by orden asc";
	$result_pais = cms_query($sql)or die ("Error en la consulta de paises");
	$paises .= "<option value=\"0\" \"selected\" >--Seleccione-></option>";
	
	while (list($id_pais2,$pais) = mysql_fetch_row($result_pais)){
		if ($id_pais == $id_pais2){
			$selected = "selected";
		}else{
			$selected = "";
		}
		$paises .= "<option value=\"$id_pais2\" $selected  >".$pais."</option>";
	}
	
	/*	$paises = "<select name=\"id_pais\" onchange='muestraOcultaRegionComuna();' >
					".$paises."
				</select>";
	*/
	
	$paises = "<select name=\"id_pais\" onchange='muestraOcultaRegionComuna();' >
					$paises
				</select>";
				
	//$paises=select_tabla('pais',$id_pais,'id_pais','pais','onchange="muestraOcultaRegionComuna();"','',$condicion);
	//$paises=str_replace("id_pais",'id_pais',$paises);	
	
	$region = select_admin_campo_simple("regiones",$id_region, "onChange='cargaContenido(this.id)'", $clase,$id_opcional);
   

	
	  $query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region='$id_region'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while(list($id_comuna2,$comuna) = mysql_fetch_row($result)){
		  
		  if($id_comuna==$id_comuna2){
				//$comunas_lista .="<option value=\"$id_comuna2\" selected>".$comuna."</option>";
	  			$comunas_lista .="<option value=\"$id_comuna2\" selected>$comuna</option>";
	  
	      }else{
				//$comunas_lista .="<option value=\"$id_comuna2\">".$comuna."</option>";
	  			$comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";
	      }
		  
		  
		  
		  
		 } 
		  
  	
		$comuna = "<select name=\"id_comuna\" id=\"id_comuna\">
						$comunas_lista
					</select>";
}	
 else
 {
        $region = "$select_regiones";
		
		
		$comuna= "<select disabled=\"disabled\" name=\"id_comuna\" id=\"id_comuna\">
						<option value=\"0\">Seleccione opci&oacute;n...</option>
					</select>";
}
 
//
		
	$ocupacion = select_admin_campo_simple("usuario_ocupacion",$id_ocupacion, $js_sel, $clase,$id_opcional);
    $rango_edad = select_admin_campo_simple("usuario_rango_edad",$id_rango_edad, $js_sel, $clase,$id_opcional);
    $sexo = select_admin_campo_simple("usuario_sexo",$id_sexo, $js_sel, $clase,$id_opcional);
	$fecha_nac = fechas_html($fecha_nac);
	$fecha_nacimiento = "<input type=\"text\" name=\"fecha_nac\" id=\"fecha_nac\" value=\"$fecha_nac\" class=\"tt valida\">";
	$nacionalidad = select_admin_campo_simple("usuario_nacionalidad",$id_nacionalidad, $js_sel, $clase,$id_opcional);
    $nivel_educacional = select_admin_campo_simple("usuario_nivel_educacional",$id_nivel_educacional, $js_sel, $clase,$id_opcional);
    $organizacion_sindical = select_admin_campo_simple("usuario_organizacion",$id_organizacion, $js_sel, $clase,$id_opcional);
    $frecuencia = select_admin_campo_simple("usuario_frecuencia_organizacion",$id_frecuencia_organizacion, $js_sel, $clase,$id_opcional);
	
    
	//include("captcha/captcha.php");
	
//	 if()  formulario_registro_edicion_funcionario
//$id_tipo_persona=1;
$es_funcionario = rescata_valor('usuario_perfil',$id_perfil,'funcionario'); 
		
	if($es_funcionario){
		$formulario_registro = html_template('formulario_registro_edicion_funcionario');	
	}else{
	
	/*
		if($id_tipo_persona==1){
				//$formulario_registro = html_template('formulario_registro_edicion');	
				$formulario_registro = html_template('formulario_registro');	
			}else{
				$formulario_registro = html_template('formulario_registro_edicion_juridica');	
		}
	*/
		$formulario_registro = html_template('formulario_registro_edicion_ciudadano');
	}
	
	
	
	
	$id_tipo_persona_seleccionado = $id_tipo_persona;
	
	//echo "nombre--".$nombre."<br>";
	//echo "paterno--".$paterno."<br>";
	//echo "materno--".$materno."<br>";
	
	$nombre = cambio_texto($nombre);
	$paterno= cambio_texto($paterno);
	$materno= cambio_texto($materno);
	$apoderado= cambio_texto($apoderado);
	
	//echo "nombre--".$nombre."<br>";
	//echo "paterno--".$paterno."<br>";
	//echo "materno--".$materno."<br>";
	
	 $query= "SELECT id_tipo_persona,tipo_persona 
           FROM  tipo_persona
		   order by orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 $selected = "";
      while (list($id_tipo_persona,$tipo_persona) = mysql_fetch_row($result)){
				
			if ($id_tipo_persona_seleccionado == $id_tipo_persona){
				$selected = "selected";
			}else{
				$selected = "";
			}
			$lista_select_tipo_persona .="<option value=\"$id_tipo_persona\" $selected>$tipo_persona</option>\n";
				   
		 }
		$tipo_persona = "<select name=\"id_tipo_persona\" id=\"id_tipo_persona\" onChange=\"displayOne('cdiv', this.selectedIndex);\">
                 $lista_select_tipo_persona
                 </select>";

	
	/*PERSONALES*/
	$formulario_registro = str_replace("#TIPO_PERSONA#","$tipo_persona ",$formulario_registro);
	$formulario_registro = str_replace("#NOMBRES#","<input type=\"text\" class=\"valida\" id=\"nombre\" name=\"nombre\" value=\"$nombre\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#PATERNO#","<input type=\"text\" class=\"valida\" id=\"paterno\" name=\"paterno\" value=\"$paterno\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#MATERNO#","<input type=\"text\" class=\"valida\" id=\"materno\" name=\"materno\" value=\"$materno\" size=\"30\" />",$formulario_registro);
	
	//$formulario_registro = str_replace("#RAZON_SOCIAL#","<input type=\"text\"    id=\"materno\" name=\"razon_social\" value=\"$razon_social\" size=\"30\" />",$formulario_registro);
	//$formulario_registro = str_replace("#APODERADO#","<input type=\"text\"    id=\"apoderado\" name=\"apoderado\" value=\"$apoderado\" size=\"30\" />",$formulario_registro);
	//$formulario_registro = str_replace("#APODERADO_NATURAL#","<input type=\"text\"    id=\"apoderado_natural\" name=\"apoderado_natural\" value=\"$apoderado\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#FONO#","<input type=\"text\" id=\"fono\" name=\"fono\" value=\"$fono\" size=\"30\" />",$formulario_registro);
	
	/*domicilio*/
	$formulario_registro = str_replace("#DIRECCION#","<input type=\"text\" class=\"valida\" id=\"direccion\" name=\"direccion\" value=\"$direccion\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#NUMERO#","<input type=\"text\" class=\"valida\" id=\"numero\" name=\"numero\" value=\"$numero\" size=\"3\" />",$formulario_registro);
	$formulario_registro = str_replace("#DEPTO#","<input type=\"text\" id=\"depto\" name=\"depto\" value=\"$depto\" size=\"3\" />",$formulario_registro);
	$formulario_registro = str_replace("#REGION#","$region",$formulario_registro);
	$formulario_registro = str_replace("#CIUDAD#","<input type=\"text\" id=\"ciudad\" name=\"ciudad\" value=\"$ciudad\" size=\"15\" />",$formulario_registro);
	$formulario_registro = str_replace("#COMUNA#","$comuna",$formulario_registro);
	$formulario_registro = str_replace("#PAIS#","$paises",$formulario_registro);
	
	/*Datos de Ingreso al sistema*/
	$formulario_registro = str_replace("#MAIL#","$email <a href=\"index.php?accion=Actualiza-correo-electronico\">Actualizar correo electr&oacute;nico</a>",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA_ACTUAL#","<input type=\"password\" id=\"pass_actual\" name=\"pass_actual\" size=\"30\" />",$formulario_registro);
    $formulario_registro = str_replace("#CONTRASENIA2#","<input type=\"password\" id=\"pass2\" name=\"pass2\"  size=\"30\" /> ",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA#","<input type=\"password\" id=\"pass\" name=\"pass\" size=\"30\" /><span class=\"mensaje\">(Solo si desea cambiar su contrase&ntilde;a)</span>",$formulario_registro);
   
	/*Datos estadáticos (opcionales)*/
	$formulario_registro = str_replace("#RUT#","<input type=\"text\"    id=\"rut\" name=\"rut\" value=\"$rut\" size=\"12\" maxlength=\"12\" />",$formulario_registro);
	$formulario_registro = str_replace("#CODIGO#","<input type=\"text\"    id=\"codigo\" name=\"codigo\" value=\"$codigo\" size=\"3\" />",$formulario_registro);
	$formulario_registro = str_replace("#TELEFONO#","<input type=\"text\"    id=\"telefono\" name=\"telefono\" value=\"$telefono\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#SEXO#","$sexo",$formulario_registro);
	$formulario_registro = str_replace("#FECHA_DE_NACIMIENTO#","<input type=\"text\" name=\"fecha_nac\" id=\"fecha_nac\">",$formulario_registro);
	$formulario_registro = str_replace("#EDAD#","$rango_edad",$formulario_registro);
	$formulario_registro = str_replace("#NACIONALIDAD#","$nacionalidad",$formulario_registro);
	$formulario_registro = str_replace("#NIVEL_EDUCACIONAL#","$nivel_educacional",$formulario_registro);
	$formulario_registro = str_replace("#OCUPACION#","$ocupacion",$formulario_registro);
	$formulario_registro = str_replace("#ORGANIZACION#","$organizacion_sindical",$formulario_registro);
	$formulario_registro = str_replace("#FRECUENCIA#","$frecuencia ",$formulario_registro);
	
	
	/*Datos para funcionarios del servicio*/
	$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
	$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
	$oficina = rescata_valor('sgs_departamentos',$id_departamento,'departamento'); 
	$formulario_registro = str_replace("#ENTIDAD_PADRE#","$entidad_padre ",$formulario_registro);
	$formulario_registro = str_replace("#ENTIDAD_HIJA#","$entidad_hija ",$formulario_registro);
	$formulario_registro = str_replace("#OFICINA#","$oficina",$formulario_registro);
	
	
	$formulario_registro = str_replace("#TERMINOS_CONDICIONES#","<input id=\"enviar\" name=\"enviar\" type=\"submit\" name=\"Submit\" value=\"Enviar\">",$formulario_registro);
	
	
	$texto_form_head = "
<p align=\"justify\">Para cambiar sus datos en este sistema complete el siguiente formulario y
	 presione el bot&oacute;n &quot;#TEXTO_BOTON#&quot;.</p>
<div id=\"mensaje\" class=\"mensaje\">Los campos indicados con (*) son obligatorios</div>";
	$formulario_registro = str_replace("#TEXTO_FORMULARIO_HEAD#",$texto_form_head,$formulario_registro);
	
	$formulario_registro = str_replace("#TEXTO_BOTON#","Guardar Datos",$formulario_registro);
	$formulario_registro = str_replace("#TITULO_FORM#","Mis Datos",$formulario_registro);
	
	
	
	$formulario_registro = str_replace("#CAPTCHA#","",$formulario_registro);
	
	$contenido =" $formulario_registro ";
	
	$js.= "
	
	<script type=\"text/javascript\">
		
		/*
		$(function(){
			$(\"#fecha_nac\").datepicker();
			$(\"#fecha_nac\").datepicker( \"option\", \"dateFormat\",'dd-mm-yy');
			$(\"#fecha_nac\").val('$fecha_nac');
		
		});
		*/
		
		$(document).ready(function(){
		
			$(\"#nombre\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s]/i);
			$(\"#paterno\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s]/i);
			$(\"#materno\").keyfilter(/[a-z_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ '\s]/i);
			$(\"#direccion\").keyfilter(/[a-z0-9_A-Z ñ Ñ á Á éÉ íÍ óÓ úÚ ' .\s]/i);
			$(\"#numero\").keyfilter(/[\d\-\.]/);
			$(\"#depto\").keyfilter(/[a-z0-9_\s]/i);
			
			$(\"#email\").keyfilter(/[a-z0-9_\.\-@]/i);
			$(\"#codigo\").keyfilter(/[\d\-\.]/);
			$(\"#telefono\").keyfilter(/[\d\-\.]/);
		
			$(\"#fecha_nac\").datepicker({ maxDate: 0 });
			$(\"#fecha_nac\").datepicker(\"option\",\"dateFormat\",'dd-mm-yy');
			$(\"#fecha_nac\").val('$fecha_nac');
		
			$('.tab_content').hide();
			$('ul.tabs li:first').addClass('active').show();
			$('.tab_content:first').show();
			$('ul.tabs li').click(function(){
			   
			  $('ul.tabs li').removeClass('active');
				$(this).addClass('active');
				$('.tab_content').hide();
				
				var activeTab = $(this).find('a').attr('href');
				$(activeTab).fadeIn();
				return false;
			});
			
			$('#enviar').live('click', function(){
				$('#form1').valid();
				var valorTextTab1=0;
				var valorTextTab2=0;
				var valorTextTab3=0;
				var valorPassTab2=0;
				var valorTextTabDinamico=0;
				var valorSelectTab1=0;
				var valorSelectTab2=0;
				
				$('#tab_datos_personales .valida').each(function(i){
					if($(this).val()=='')
						valorTextTab1++;
						
					/*
					if(i==0)
						if($(this).val()=='')
							valorTextTab1++;
					*/	
				});
				
				$('#tab_datos_personales select').each(function(i){
					if(i!=5)
						if($(this).val()==0)
							valorSelectTab1++;
				});
								
				if(valorTextTab1==0 && valorSelectTab1==0){
					$('#form1').submit();
				}else{
					alert('Debe ingresar todos los campos de Datos personales');
					$('ul.tabs li').each(function(i){
						if(i==0){
							$(this).addClass('active').show();
							var idTab=$(this).find('a').attr('href');	
							$(idTab).show();
						}else{					
							$(this).removeClass('active').show();
							var idTab=$(this).find('a').attr('href');	
							$(idTab).hide();
						}
					});
					return false;
				}
			
			});
			
			
			$('#Registrarse').live('click', function(){
			
				$('#form1').valid();
				var valorTextTab1=0;
				var valorTextTab2=0;
				var valorTextTab3=0;
				var valorPassTab2=0;
				var valorTextTabDinamico=0;
				var valorSelectTab1=0;
				var valorSelectTab2=0;
				
				$('#tab_datos_personales .valida').each(function(i){
					if($(this).val()=='')
						valorTextTab1++;
						
					/*
					if(i==0)
						if($(this).val()=='')
							valorTextTab1++;
					*/	
				});
				
				$('#tab_datos_personales select').each(function(i){
					if(i!=5)
						if($(this).val()==0)
							valorSelectTab1++;
				});
								
				if(valorTextTab1==0 && valorSelectTab1==0){
					$('#form1').submit();
				}else{
					alert('Debe ingresar todos los campos de Datos personales');
					$('ul.tabs li').each(function(i){
						if(i==0){
							$(this).addClass('active').show();
							var idTab=$(this).find('a').attr('href');	
							$(idTab).show();
						}else{					
							$(this).removeClass('active').show();
							var idTab=$(this).find('a').attr('href');	
							$(idTab).hide();
						}
					});
					return false;
				}
			});
			
		});
	</script>
	
	
	";

?>