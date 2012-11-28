<?php
$act = $_GET['act'];


if($act!=1){
$valida_pass = ",
			password: {
				required: true,
				minlength: 6
				
			},
			pass2: {
				required: true,
				minlength: 6,
				equalTo: \"#password\"
			}";
}


$js ="
<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}

</style>





<script type=\"text/javascript\">

$.validator.setDefaults({
	//submitHandler: function() { alert(\"submitted!\"); }
});






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
			id_perfil: {
				required: true
			},
			id_entidad: {
				required: true
			},
			id_departamento: {
				required: true
				
			}
			
			$valida_pass
		},
		messages: {
			nombre: \"Ingrese su nombre\",
			paterno: \"Ingrese su Apellido Paterno\",
			materno: \"Ingrese su Apellido Materno\",
			departamento_add: \"\",
			password : {
				required: \"Ingrese su Contrase&ntilde;a\",
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




$(document).ready(function(){
	// Parametros para e id_entidad cambiara a id_departamento
   $(\"#id_entidad\").change(function () {
   		$(\"#id_entidad option:selected\").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post(\"sgs/admin_usuarios/select.php\", { elegido: elegido }, function(data){
				$(\"#id_departamento\").html(data);
				
			});			
        });
   })
	
});


</script>";



$region = select_admin_campo_simple("regiones",$id_region, "onChange='cargaContenido(this.id)'", $clase,$id_opcional);
  
 if(verifica($id_sesion)){
	
	 if($id_region==""){
	 $desactiva = "disabled";
	 }

	
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
		  
  	
		$comuna = "<select name=\"id_comuna\" id=\"id_comuna\" $desactiva>
			<option value=\"\">Seleccione Comuna...</option>
						$comunas_lista
					</select>";
}	
 else
 {
      //  $region = "$select_regiones";
		
		
		$comuna= "<select name=\"id_comuna\" id=\"id_comuna\" $desactiva>
						<option value=\"\">Seleccione Comuna...</option>
					</select>";
}
$js .="<script type=\"text/javascript\" src=\"comuna_select/js/select_dependientes.js\"></script>";

$region_comuna = "<br />
				<label>Regi&oacute;n</label><br/>
				<label>$region</label><br />
				<label>Comuna</label><br />
				<label>$comuna</label><br />";
				
				

    $formulario_registro = html_template('formulario_registro_funcionario');
  
    $formulario_registro = cms_replace("#NOMBRES#","<input type=\"text\" id=\"nombre\" name=\"nombre\" value=\"$nombre\" size=\"30\" />",$formulario_registro);
	$formulario_registro = cms_replace("#PATERNO#","<input type=\"text\" id=\"paterno\" name=\"paterno\" value=\"$paterno\" size=\"30\" />",$formulario_registro);
	$formulario_registro = cms_replace("#MATERNO#","<input type=\"text\" id=\"materno\" name=\"materno\" value=\"$materno\" size=\"30\" />",$formulario_registro);
	$formulario_registro = cms_replace("#TELEFONO#","<input type=\"text\" id=\"fono\" name=\"fono\" value=\"$fono\" size=\"30\" />",$formulario_registro);
	
	/*Datos de Ingreso al sistema*/
	$formulario_registro = cms_replace("#MAIL#","<input type=\"text\" id=\"email\" name=\"email\" value=\"$email\" size=\"30\" onkeyup=\"ObtenerDatos('index.php?accion=$accion&act=10&email='+ form1.email.value +'&axj=1' ,'verifica');\"/>(fmerino@economia.gov.cl)<div id=\"verifica\"></div>",$formulario_registro);
	$formulario_registro = cms_replace("#CONTRASENIA#","<input type=\"password\" id=\"password\" name=\"password\" value=\"\" size=\"30\" />",$formulario_registro);
	$formulario_registro = cms_replace("#CONTRASENIA2#","<input type=\"password\" id=\"pass2\" name=\"pass2\" value=\"\" size=\"30\" />",$formulario_registro);
	
	//CUADRO pERFILES
	

	
	$perfiles = select_admin_campo_simple("usuario_perfil",$id_perfil, "perfil", $clase,$id_opcional);
	
	$oficina = select_admin_campo_simple("sgs_departamentos",$id_departamento, "departamento", $clase,$id_opcional);
	
	$id_entidad_padre = configuracion_cms('id_servicio');	
	  $query= "SELECT entidad_padre  
               FROM  sgs_entidad_padre
               WHERE id_entidad_padre='$id_entidad_padre'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($entidad_padre) = mysql_fetch_row($result);
		  
		  
	$formulario_registro = cms_replace("#ENTIDAD_PADRE#","<strong>$entidad_padre</strong> <input type=\"hidden\" name=\"id_entidad_padre\" value=\"$id_entidad_padre\">",$formulario_registro);
	$formulario_registro = cms_replace("#OFICINA#","<label>$oficina</label>",$formulario_registro);
	$formulario_registro = cms_replace("#REGION#","<label>$region</label>",$formulario_registro);
	$formulario_registro = cms_replace("#COMUNA#","<label>$comuna</label>",$formulario_registro);
	  
	 
	//$condicion = " and id_entidad_padre =$id_entidad_padre ";			 
	//$entidad_hija = select_admin_campo_simple_con_filtro("sgs_entidades",$id_entidad,"entidad", $clase,$id_opcional,$condicion);
	  
	  
	
	  
	
	  
	  $arreglo=explode(",",$ids_entidades);

	
	  $query= "SELECT  id_perfil,perfil  
               FROM  usuario_perfil
               WHERE id_perfil<>'999' and funcionario=1
			   Order by orden";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_perfil_2,$perfil) = mysql_fetch_row($result)){
		  
		  	if($id_perfil==$id_perfil_2 and $act!=4){
			$listado_perfil .="<option value=\"$id_perfil_2\" selected>$perfil</option>";		   
			}else{
			$listado_perfil .="<option value=\"$id_perfil_2\">$perfil</option>";		   
			}
    				
    		 }
			 
			 			 
			 $perfil= "<select name=\"id_perfil\" id=\"id_perfil\">
               					 <option value=\"\">Seleccione Perfil...</option>
                					$listado_perfil
                			  </select>";
	
	$formulario_registro = cms_replace("#PERFIL#","$perfil",$formulario_registro);
	
		
	
	 
	 
	  //$ids_entidades=explode(",", $ids_entidades);
		
		/**/
	$sql = "Select valor from cms_configuracion where  configuracion='id_entidad'";
	$result = cms_query($sql) or die (error($sql,mysql_error(),$php));
	list($ids_entidades) = mysql_fetch_row($result);
	//$aEntidad = split(',',$valor);
	
		
		 //$ids_entidades = configuracion_cms('id_entidad');	
		
	  $query= "SELECT id_entidad,entidad
               FROM  sgs_entidades
               WHERE id_entidad_padre='$id_entidad_padre' and id_entidad in ($ids_entidades)";
			  
			  
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
         while (list($id_entidad2,$entidad) = mysql_fetch_row($result2)){
    			/*
			$encontrado =  buscarCodigo($aEntidad,$id_entidad2);
				if ($encontrado==1 and $valor!=""){
				   
					
				}else{
					$listado .="<option value=\"$id_entidad2\" >$entidad</option>";	
				}*/
				
					 if($id_entidad == $id_entidad2){
					$listado .="<option value=\"$id_entidad2\" selected>$entidad</option>";			   
					}else{
					$listado .="<option value=\"$id_entidad2\" >$entidad</option>";			   
					}		   
    		 }
			 
			 $entidad_hija = "<select name=\"id_entidad\" id=\"id_entidad\">
               					 <option value=\"\">Seleccione...</option>
                					$listado 
                			  </select>";
	
	
	$formulario_registro = cms_replace("#ENTIDAD_HIJA#","$entidad_hija",$formulario_registro);

	
	 
  $contenido=$formulario_registro;
  
  
  
  
  /*
  
  
  
  
  
  
<h4>Registro Funcionario</h4>
<p align="justify"> </p>
<div class="mensaje" id="mensaje">Los campos indicados con (*) son obligatorios</div>
<fieldset>
<legend>Datos personales</legend>

<label></label>
<br />
<div class="showhide" id="cdiv0"><label>Nombres</label> *<br />
#NOMBRES# (Ej. Francisco)<br />
<label>Apellido paterno</label>
 *<br />
#PATERNO# (Ej. Maldonado)<br />
<label>Apellido materno</label>
 *<br />
#MATERNO# (Ej. Soto)<br />
<label>Tel&eacute;fono</label><br />
#TELEFONO# <br />
<label></label>
</div>

</fieldset>

<br /> 
<fieldset>
<legend>Datos Institucionales</legend>

<label></label>
<br />
<div class="showhide" id="cdiv0">
  
<label>Entidad</label>
 *<br />
<label>#ENTIDAD_PADRE# <br /></label>
<label>Servicio</label>
 *<br />
<label>#ENTIDAD_HIJA# <br /></label><br/>
<label>Departamento u Oficina</label>
   *<br />
#OFICINA#  <br />
<label></label>
</div>

</fieldset>


<br /> 
<fieldset>
<legend>Datos de ingreso al sistema</legend>
<br />
<label>Direcci&oacute;n de correo electr&oacute;nico</label> *<br />
#MAIL# (fmerino@economia.gov.cl)<br />
<label>Contrase&ntilde;a  M&iacute;nimo 6 caracteres. </label><br />
#CONTRASENIA# 
<label>(solo si desea cambiar la contrase&ntilde;a)</label>
<br />
<label>Confirme contrase&ntilde;a </label> <br />
#CONTRASENIA2# <br />
<label /></fieldset><br />

<fieldset>
<legend>Perfil</legend>

<label></label>
<br />
<div class="showhide" id="cdiv0">
  <label>Perfil</label>
   *<br />
<label>#PERFIL#</label> <br />

<br />
<label></label>
</div>

</fieldset>

<p> </p>
<div align="center"><input class="botones" id="Registrarse" type="submit" name="Registrarse" value="Aceptar" />
</div>
<div> </div>
  
  
  
  
  
  
  */
  
?>