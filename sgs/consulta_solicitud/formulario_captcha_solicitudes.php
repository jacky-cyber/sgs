<?php




$js .="

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
	//$('#boton').click(function(){ 
	$(\"#form1\").validate({
		rules: {
			buscar : {
			required : true
			

			},
			texto_ingresado: {
			required : true
			
			}
			,
			apellido: {
			required : true
			
			}
			
			
			
		},
		messages: {
			buscar: \"Ingrese el n&uacute; de solicitud\",
			texto_ingresado: \"Ingrese texto de validaci&oacute;n\"
			
			
		}
	});
});


</script>



";





//sacar el html del contenido
$contenido = html_template('contenedor_buscador_solicitudes');	


$buscar =  $_POST['buscar'];
//echo "buscar :".$buscar;
	
	include("captcha/captcha.php");
	
	
					  
	//$captcha = str_replace($captcha,$captcha_salida,$captcha);				  
	
	
	$contenido = cms_replace("#CAPTCHA#",$captcha_form,$contenido);
	
	$contenido = cms_replace("#CANT_PAGINAS#",$paginas, $contenido);
	$contenido = cms_replace("#PAGINACION#","$paginacion", $contenido);
	$mensaje_usuarios = html_template('buscador_solicitudes_mensaje_usuarios');
	$contenido = cms_replace("#INFORMACION_PARA_EL _USUARIO#","$mensaje_usuarios",$contenido);
	
	$contenido = $contenido."  <table width=\"80%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
     <tr >
       <td class=\"textos\" align=\"center\" class=\"textos\">
	   <div id=\"div_respuesta\" align=\"center\"></div>
<div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
	   </td>
       </tr>
 	</table>";

	
	/*
	
	
	

<tr>

<td>#FOLIO#</td>

<td>#FECHA_INGRESO# </td>
<td>#FECHA_TERMINO# </td>
<td>#DIAS# d&iacute;as</td>
<td width="100">#ESTADO_PADRE#</td>
<td>#ESTADO#</td>
<td class="actions"><a class="edit" href="#LINK#">Editar</a></td>

</tr>
	
	*/
	
	
	
	/*CONTENEDOR
	
	
	
	
	<table cellspacing="0" cellpadding="0" width="98%" border="0">
    <tbody>
        <tr>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
            <td valign="top">
                      
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><div align="center"><strong>Panel de Gesti&oacute;n de Solicitudes</strong></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center">Existen <span class="style1">#TOTAL_SOLICITUDES_SIN_ASIGNAR#</span> solicitudes sin asignar. La m&aacute;s antigua fue ingresada el <span class="style1">#FECHA_MAS_ANTIGUA#</span></div></td>
              </tr>
              <tr>
                <td><div align="center"><strong><a href="#LINK_ASIGNAR_SOLICITUDES_PENDIENTES#">Haga click aqu&iacute; para asignar Solicitudes Pendientes (<span class="style1">#TOTAL_SOLICITUDES_SIN_ASIGNAR#</span>)</a></strong></div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><div align="center">Buscar Solicitud:
                  <input id="buscar" name="buscar" type="text" />
                  <input id="buscar2" type="submit" name="buscar2" value="buscar..." />
                </div></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><strong>Bandeja de Solicitudes</strong></td>
              </tr>
              <tr>
                <td><strong>Mostrar:</strong> #FILTROS# </td>
              </tr>
			   <tr><td align=\"center\"> </td></tr> 
              <tr>
                <td  valign="top">  <div class="wide" id="table-block">
              <table cellspacing="0" cellpadding="0">
                <tbody>
                    <tr class="header2">
                        <td width="15%">N&ordm; de Solicitud</td>
                        <td width="20%">Fecha de la Solicitud</td>
                        <td width="20%">Fecha T&eacute;rmino de Solicitud</td>
                        <td width="20%">Plazo</td>
                        <td width="23%">Etapa</td>
                        <td width="23%">Estado</td>
                        <td width="14%">Ver</td>
                    </tr>
                    #LISTA_ADMINISTRACION_SOLICITUDES#
                </tbody>
            </table>
            </div></td>
              </tr>
            </table>
            <br />
            <div align="center"><br />
            <br />
            #PAGINACION#</div>            </td>
        </tr>
    </tbody>
</table> 
	
	
		
	
	
	*/
	
?>