<?php

    
	//include("captcha/captcha.php");
	

	
	
	$nombre = cambio_texto($nombre);
	$paterno= cambio_texto($paterno);
	$materno= cambio_texto($materno);
	/*PERSONALES*/
	$formulario_registro = str_replace("#TIPO_PERSONA#","$tipo_persona",$formulario_registro);
	$formulario_registro = str_replace("#NOMBRES#","<input type=\"text\" id=\"nombre\" name=\"nombre\" value=\"$nombre\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#PATERNO#","<input type=\"text\" id=\"paterno\" name=\"paterno\" value=\"$paterno\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#MATERNO#","<input type=\"text\" id=\"materno\" name=\"materno\" value=\"$materno\" size=\"30\" />",$formulario_registro);
	
	$formulario_registro = str_replace("#RAZON_SOCIAL#","<input type=\"text\" id=\"materno\" name=\"razon_social\" value=\"$razon_social\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#APODERADO#","<input type=\"text\" id=\"materno\" name=\"apoderado\" value=\"$apoderado\" size=\"30\" />",$formulario_registro);
	
	/*domicilio*/
	$formulario_registro = str_replace("#DIRECCION#","<input type=\"text\" id=\"direccion\" name=\"direccion\" value=\"$direccion\" size=\"60\" />",$formulario_registro);
	$formulario_registro = str_replace("#NUMERO#","<input type=\"text\" id=\"numero\" name=\"numero\" value=\"$numero\" size=\"20\" />",$formulario_registro);
	$formulario_registro = str_replace("#DEPTO#","<input type=\"text\" id=\"depto\" name=\"depto\" value=\"$depto\" size=\"20\" />",$formulario_registro);
	$formulario_registro = str_replace("#REGION#","$region",$formulario_registro);
	$formulario_registro = str_replace("#CIUDAD#","<input type=\"text\" id=\"ciudad\" name=\"ciudad\" value=\"$ciudad\" size=\"15\" />",$formulario_registro);
	$formulario_registro = str_replace("#COMUNA#","$comuna",$formulario_registro);
	
	/*Datos de Ingreso al sistema*/
	$formulario_registro = str_replace("#MAIL#","$email",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA_ACTUAL#","<input type=\"password\" id=\"pass_actual\" name=\"pass_actual\" size=\"30\" />",$formulario_registro);
    $formulario_registro = str_replace("#CONTRASENIA2#","<input type=\"password\" id=\"pass2\" name=\"pass2\"  size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA#","<input type=\"password\" id=\"pass\" name=\"pass\" size=\"30\" />",$formulario_registro);
   
	/*Datos estadáticos (opcionales)*/
	
	$ocupacion = select_admin_campo_simple("usuario_ocupacion",$id_ocupacion, $js_sel, $clase,$id_opcional);
    $rango_edad = select_admin_campo_simple("usuario_rango_edad",$id_rango_edad, $js_sel, $clase,$id_opcional);
    $sexo = select_admin_campo_simple("usuario_sexo",$id_sexo, $js_sel, $clase,$id_opcional);
	$nacionalidad = select_admin_campo_simple("usuario_nacionalidad",$id_nacionalidad, $js_sel, $clase,$id_opcional);
    $nivel_educacional = select_admin_campo_simple("usuario_nivel_educacional",$id_nivel_educacional, $js_sel, $clase,$id_opcional);
    $organizacion_sindical = select_admin_campo_simple("usuario_organizacion",$id_organizacion, $js_sel, $clase,$id_opcional);
    $frecuencia = select_admin_campo_simple("usuario_frecuencia_organizacion",$id_frecuencia_organizacion, $js_sel, $clase,$id_opcional);

	
	$formulario_registro = str_replace("#RUT#","<input type=\"text\" id=\"rut\" name=\"rut\" value=\"$rut\" size=\"12\" maxlength=\"12\" />",$formulario_registro);
	$formulario_registro = str_replace("#CODIGO#","<input type=\"text\" id=\"codigo\" name=\"codigo\" value=\"$codigo\" size=\"3\" />",$formulario_registro);
	$formulario_registro = str_replace("#TELEFONO#","<input type=\"text\" id=\"telefono\" name=\"telefono\" value=\"$telefono\" size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#SEXO#","$sexo",$formulario_registro);
	$formulario_registro = str_replace("#RANGO_EDAD#","$rango_edad",$formulario_registro);
	$formulario_registro = str_replace("#NACIONALIDAD#","$nacionalidad",$formulario_registro);
	$formulario_registro = str_replace("#NIVEL_EDUCACIONAL#","$nivel_educacional",$formulario_registro);
	$formulario_registro = str_replace("#OCUPACION#","$ocupacion",$formulario_registro);
	$formulario_registro = str_replace("#ORGANIZACION_SINDICAL#","$organizacion_sindical",$formulario_registro);
	$formulario_registro = str_replace("#FRECUENCIA#","$frecuencia",$formulario_registro);
	
	
	
	$formulario_registro = str_replace("#CAPTCHA#","<input type=\"hidden\" name=\"id_tipo_persona\" value=\"$id_tipo_persona\">",$formulario_registro);
	

?>