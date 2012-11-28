<?php



$js .=" <script language=\"JavaScript\">
$(function(){
 $('#boton').click(function(event){
   
     procesar('$url/?accion=$accion&act=3&axj=1','resultado');
  });
 });



</script>";


                    $contenido .= "
                                        <h2>Completa tu informaci&oacute;n</h2>
                                        <div class=\"alert alert-success\">Token Valido</div>
                                                            <div class=\"banner_home form-horizontal\" >
                                                           
                                                             <div class=\"control-group\">
                                                               Cuenta de usuario <strong>$email</strong>
                                                                
                                                              </div>
                                                                                                                
                                                            <div class=\"control-group\">
                                                                <label class=\"control-label\" for=\"input01\">Nombre</label>
                                                                <div class=\"controls\">
                                                                  <input type=\"text\" name=\"nombre\" id=\"nombre\" maxlength=\"50\"  >
                                                                
                                                                </div>
                                                              </div>
                                                                                                                
                                                            <div class=\"control-group\">
                                                                <label class=\"control-label\" for=\"input01\">Apellido Paterno</label>
                                                                <div class=\"controls\">
                                                                  <input type=\"text\" name=\"paterno\" id=\"paterno\" maxlength=\"50\"  >
                                                                
                                                                </div>
                                                              </div>
                                                             <div class=\"control-group\">
                                                                <label class=\"control-label\" for=\"input01\">Apellido Materno</label>
                                                                <div class=\"controls\">
                                                                  <input type=\"text\" name=\"materno\" id=\"materno\" maxlength=\"50\"  class=\"error\">
                                                                
                                                                </div>
                                                              </div>
                                                              <div class=\"control-group\">
                                                                <label class=\"control-label\" for=\"input01\">Contrase&ntilde;a</label>
                                                                <div class=\"controls\">
                                                                  <input type=\"password\" name=\"contrasenia\" id=\"contrasenia\" maxlength=\"50\"  >
                                                                
                                                                </div>
                                                              </div>
                                                                       <div class=\"control-group\">
                                                                <label class=\"control-label\" for=\"input01\">Repite Contrase&ntilde;a</label>
                                                                <div class=\"controls\">
                                                                  <input type=\"password\" name=\"recontrasenia\" id=\"recontrasenia\" maxlength=\"50\"  >
                                                                
                                                                </div>
                                                              </div>
                                                                                                                
                                                                  <div class=\"form-actions\">
                                                                   
                                                                    <input type=\"button\" name=\"boton\" id=\"boton\" value=\"Validar Cuenta\" class=\"btn btn-success\">
                                                                  </div>
                                                             
                                                                <div class=\"clearfloat\"/>
                                                                
                                                                </div>
                                                                </div>
                                                                
                                                                <div ></div><br>
                                                                <div id=\"resultado\"></div>
                                                                
                                                                <input type=\"hidden\" name=\"token\" id=\"token\" value=\"$token\">
                                                                 ";

  $contenedor_lateral_derecho =html_template('Ayuda formulario registro desarrolladores');
  
  
  
  
?>