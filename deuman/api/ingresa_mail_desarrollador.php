<?php





switch ($act) {
     case 1:
        $email = $_POST['email'];
        if (check_email_address($email)) 
                    {
                      
                      
                      /*
                    * Select tabla usuario
                    * 
                    */
                   $query= "SELECT id_usuario  
                              FROM  usuario
                              WHERE email = '$email'";
                        $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
                         if(!list($id_usuario) = mysql_fetch_row($result_usuario)){
                                          
                                           $codigo = codigo();
                                           
                                           $date = date('Y')."-".date('m')."-".date('d')." ".date('mm:ss');
                                           
                                           $token = md5(codigo().$date);
                                           $_POST['login']= $email;
                                           $_POST['email']= $email;
                                         //  $_POST['password']= md5($codigo);
                                           $_POST['id_perfil']= 1048; //perfil desarrollador
                                           $_POST['session']= $token;
                                           
                                           inserta('usuario');
                                           
                                            $url = configuracion_cms('url_servidor');
                                            
                                            $asunto = "Activacion Cuenta desarrollador";
                                            $cuerpo="Activaci—n de cuenta Desarrollador :\n <br>
                                                     <a href=\"$url/token/$token\">Activar Cuenta</a>";
                                            cms_mail($email,$asunto,$cuerpo,$headers, $envio_stop, $folio);
                                            
                                           $contenido = "<div class=\"alert alert-success\">Hemos enviado un correo a <strong>'$email'</strong>, con tu link de validaci&oacute;n</div>";
                                           
                                           
                                           
                                    }else{
                                           $contenido = "<div class=\"alert alert-error\">Este correo ya esta en uso en nuestro sitio, intenta nuevamente.</div>";
                                       
                                    }
                   /** fin select usuario***/
                      
                    } 
                    else 
                    {
                       $contenido = "<div class=\"alert alert-error\">Debe ingresar un correo Valido</div>";
                    
                    }
              
         break;
	 case 2:
                 $token = $_GET['token'];
                  $url = configuracion_cms('url_servidor');
                 //http://sgs.probidadytransparencia.gob.cl/bkp_101/sgs1.3/token/c0b16be1bf15a5fe0bc5438f0cbef0a4
                 
                 /*
                * Select tabla usuario
                * 
                */
               $query= "SELECT id_usuario, login,email  
                          FROM  usuario
                          WHERE session = '$token' and estado =0";
                    $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
                     if(list($id_usuario,$login,$email) = mysql_fetch_row($result_usuario)){
                                   
                                     include('deuman/api/formulario_registro.php');
                                     
                                      		   
                                }else{
                                    
                                   
                            //header("Location: $url");
	
                                }
               /** fin select usuario***/
                                

                 
         break;
         
	 case 3:
           
            
              $token = $_POST['token'];
              
              $nombre = $_POST['nombre']; 
              $paterno = $_POST['paterno']; 
              $materno = $_POST['materno'];
              $contrasenia= $_POST['contrasenia'];
              $repassword = $_POST['recontrasenia'];
             // echo "$nombre, $paterno, $materno, $password , $token <br>";
              
                //  $url = configuracion_cms('url_servidor');
                 //http://sgs.probidadytransparencia.gob.cl/bkp_101/sgs1.3/token/c0b16be1bf15a5fe0bc5438f0cbef0a4
                 
                 /*
                * Select tabla usuario
                * 
                */
                
                 $largo_contr = strlen($contrasenia);
                 if($largo_contr>6 and $nombre!="" and $paterno!="" and $materno!=""){
                    
               
                 if($repassword==$contrasenia){
                    
                   $query= "SELECT id_usuario, login,email  
                          FROM  usuario
                          WHERE session = '$token' and estado =0";
                    $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
                     if(list($id_usuario,$login,$email) = mysql_fetch_row($result_usuario)){
                                   
                                   $contrasenia = md5($contrasenia);
                                  $Sql ="UPDATE usuario
                                        SET nombre ='$nombre',paterno='$paterno',materno='$materno', estado ='1', password= '$contrasenia'
                                        WHERE session ='$token'";
 				  
                                    cms_query($Sql)or die ("ERROR $php <br>$Sql");  
                                     
                                     $contenido = "<div class=\"alert alert-success\">Hemos creado tu cuenta exitosamente, ingresa con tu nombre de usuario y contrase&ntilde;a para crear tu apps</div>"; 		   
                                }else{
                                    
                                   
                                    $contenido = "<div class=\"alert alert-error\">Existe alg&uacute;n problema en esta activaci&oacute;n.</div>";
	
                                }
                                
                 }else{
                    
                         $contenido = "<div class=\"alert alert-error\">Las contrase&ntilde;as no son iguales.</div>";
                 }
                 
                 }else{
                  
                    $contenido = "<div class=\"alert alert-error\">Todos los campos son obligatorios, la contrase&ntilde;a deben tener mas de 6 caracteres</div>";
                 }
            
             
            
         break;
   	default:
	   
	 $accion_form = "index.php?accion=$accion&act=1&axj=1";
       


$js .=" <script language=\"JavaScript\">
$(function(){
 $('#boton').click(function(event){

   procesar('$accion_form ','resultado');
  });
 });


</script>";

 $contenido = "<h2>Ingresa tu Correo Electr&oacute;nico</h2>
                                                            <div class=\"banner_home\">
                                                            
                                                            <ul>
                                                            
                                                            <li class=\"especiales\">
                                                            <div class=\"input-prepend\">
									<span class=\"add-on\">
									<i class=\"icon-envelope\"></i>
									</span>
									<input type=\"text\" name=\"email\" id=\"email\" maxlength=\"150\" placeholder=\"Ingresa tu correo\">
								
                                                                </div><input type=\"button\" name=\"boton\" id=\"boton\" value=\"Validar Cuenta\" class=\"btn btn-success\">
                                                                </li>
                                                                </ul>
                                                                <div class=\"clearfloat\"/>
                                                                
                                                                </div>
                                                                </div>
                                                                
                                                                <div ></div><br><div id=\"resultado\"></div>";

    $contenedor_lateral_derecho =html_template('acceso a desarrolladores');
    
    
    
     }
   
   
function codigo(){
    
$str = "ABCDEFGHIJKLMNPQRSTUVWXYZ123456789";
        $cad = "";
        for($i=0;$i<5;$i++) {
        $cad .= substr($str,rand(0,34),1);
        }
  return $cad;  
}

 
?>