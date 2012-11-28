<?php

/*VARIABLES*/

$msj = $_GET['msj'];

/*Usuario*/
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$rut = $_POST['rut'];
$dv = $_POST['dv'];
$telefono = $_POST['telefono'];
$fijo = $_POST['fijo'];
$celular = $_POST['celular'];
$email = $_POST['email'];
$estado = $_POST['estado'];
$id_region = $_POST['id_region'];
$id_comuna = $_POST['id_comuna'];
$login = $_POST['login'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];
$quiero = $_POST['quiero'];
$tarjeta = $_POST['tarjeta'];
$cotizacion = $_POST['cotizacion'];
$comuna = $_POST['comuna'];
$empresa = $_POST['empresa'];
$direccion_empresa = $_POST['diccion_empresa'];
$comuna_empresa = $_POST['comuna_empresa'];

//include("comuna_select/comuna_select.php");





switch ($act) {
     
        case 1: 
		
		include ("captcha/verificar.php");
		//echo "$texto_ingresado == $captcha_texto<br>";

		if($captcha_ok){
		
		  $query= "
		  SELECT login   
                   FROM  usuario
				   WHERE login='$login'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              list($login_bd) = mysql_fetch_row($result);
                  //echo $query;
                   if($login_bd!=""){
					//echo "El nombre de usuario ya existe. Porfavor ingrese un nuevo nombre de usuario";
					
					header("HTTP/1.0 307 Temporary redirect");
                    header("Location:index.php?accion=Registro&msj=1");
					
				//$accion_form = "index.php?accion=$accion&act=1";
      		  //$select_regiones = generaRegion();
      		//  include ("usuario/registro/formulario_registro.php");
					
					}
						
				  $query= "SELECT email 
                           FROM  usuario
                           WHERE email='$email'";
                     $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      list($email_bd) = mysql_fetch_row($result);
                			
					if($email_bd!="" ){
					
					//echo "El email ya existe. Porfavor ingrese un nuevo email";
					header("HTTP/1.0 307 Temporary redirect");
                    header("Location:index.php?accion=Registro&msj=1");
		//$accion_form = "index.php?accion=$accion&act=1";
        //$select_regiones = generaRegion();
        //include ("usuario/registro/formulario_registro.php");			   
                		 }		


		$_POST['login']=$email;		
		$_POST['fecha_crea']=  date(m)."-".date(m)."-".date(Y); 		   
        $id_auto_admin= id_tabla('usuario');	 
		if($login_bd =="" and $email_bd==""){
			$id_auto_admin="usuario";
			$_GET['id_auto_admin']=$id_auto_admin;
			$password=$_POST['pass'];
			$_POST['pass']=md5($_POST['pass']);
			$_POST['password']=$_POST['pass'];
			$_POST['establecimiento']=11;
			$_POST['estado']=0;
			$_POST['id_perfil']=1;
			$_POST['id_tipo_persona']=1;
			$_POST['session']="xx".$id_sesion;
			$_POST['id_ocupacion'] = $_POST['id_usuario_ocupacion'];
		if ($_POST['apoderado_natural']!=""){
			$_POST['apoderado'] = $_POST['apoderado_natural'];
		}
		
		
		$_POST["id_usuario"]= inserta('usuario');
		
		// Tabla chileatiende_personas
		// mysql_insert_id();
		$id_usuario = $_POST["id_usuario"];
		$query= "SELECT paterno,materno,id_pais,direccion,numero,fecha_nac
					FROM  usuario
                    WHERE id_usuario = '$id_usuario'";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));
		list($apellido_paterno,$apellido_materno,$id_pais,$direccion,$numero,$fecha_nacimiento) = mysql_fetch_row($result);
		
		
		//include ("admin/administracion_sistema/proc/insertar.php");
								 
			if($_SERVER['HTTP_HOST']=='localhost'){
					$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        				<tr>
                          						<td align=\"center\" class=\"textos\"><a href=\"?sess=xx$id_sesion\">Activar cuenta esto es solo cuando se detecta que esta en localhost</a></td>
                       					 </tr>
                      				</table>";
					}else{
		
						//enviar_mail_gracias_registro($email, $password, $email, $id_sesion);
		
		
		
				}
				enviar_mail_gracias_registro($email, $password, $email, $id_sesion);
		
				$contenido .= html_template('gracias_registro');	
				
				$contenido = str_replace("#EMAIL#","$email",$contenido);
				$contenido = cuadro_verde($contenido);
			 }else{
					//header("HTTP/1.0 307 Temporary redirect");
            		header("Location:index.php?accion=$accion&msj=2");	
			}
		}else{
			header("HTTP/1.0 307 Temporary redirect");
            header("Location:index.php?accion=$accion&capt=err");	
	
		}

       
		 break;
		 

			case 2:   
			  
			 $contenido = html_template('gracias_registro_finalizado');	
			  $contenido = str_replace("#EMAIL#","$email",$contenido);
			 $contenido= cuadro_verde($contenido);
			 $login_html = html_template('login');	 
			 $login_html = "$login_html";
			  
			  
		    break;
			
			case 3:
				include ("usuario/registro/carga_combolist.php");
			break;
	case 4:
				include ("captcha/verificar2.php");
				//echo "-- ".$xxx;
			break;


	case 5: 
		
		
		  $query= "
		  SELECT login   
                   FROM  usuario
				   WHERE login='$login'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              list($login_bd) = mysql_fetch_row($result);
                  //echo $query;
                   if($login_bd!=""){
					//echo "El nombre de usuario ya existe. Porfavor ingrese un nuevo nombre de usuario";
					
					header("HTTP/1.0 307 Temporary redirect");
                    header("Location:index.php?accion=Registro&msj=1");
					
				//$accion_form = "index.php?accion=$accion&act=1";
      		  //$select_regiones = generaRegion();
      		//  include ("usuario/registro/formulario_registro.php");
					
					}
						
				  $query= "SELECT email 
                           FROM  usuario
                           WHERE email='$email'";
                     $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      list($email_bd) = mysql_fetch_row($result);
                			
					if($email_bd!="" ){
					
					//echo "El email ya existe. Porfavor ingrese un nuevo email";
					header("HTTP/1.0 307 Temporary redirect");
                    header("Location:index.php?accion=Registro&msj=1");
		//$accion_form = "index.php?accion=$accion&act=1";
        //$select_regiones = generaRegion();
        //include ("usuario/registro/formulario_registro.php");			   
                		 }		


		$_POST['login']=$email;		
		$_POST['fecha_crea']=  date(m)."-".date(m)."-".date(Y); 		   
        $id_auto_admin= id_tabla('usuario');	 
		if($login_bd =="" and $email_bd==""){
			$id_auto_admin="usuario";
			$_GET['id_auto_admin']=$id_auto_admin;
			$password=$_POST['pass'];
			$_POST['pass']=md5($_POST['pass']);
			$_POST['password']=$_POST['pass'];
			$_POST['establecimiento']=11;
			$_POST['estado']=0;
			$_POST['id_perfil']=1;
			$_POST['id_tipo_persona']=1;
			$_POST['session']="xx".$id_sesion;
			$_POST['id_ocupacion'] = $_POST['id_usuario_ocupacion'];
		if ($_POST['apoderado_natural']!=""){
			$_POST['apoderado'] = $_POST['apoderado_natural'];
		}
		
		
		inserta('usuario');
		
		// Tabla chileatiende_personas
		$_POST["id_usuario"]= mysql_insert_id();
		$id_usuario = $_POST["id_usuario"];
		$query= "SELECT paterno,materno,id_pais,direccion,numero,fecha_nac
					FROM  usuario
                    WHERE id_usuario = '$id_usuario'";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));
		list($apellido_paterno,$apellido_materno,$id_pais,$direccion,$numero,$fecha_nacimiento) = mysql_fetch_row($result);
		$_POST['nombres'] = $nombre;
		$_POST['apellidos'] = $apellido_paterno." ".$apellido_materno;
		
		
		//include ("admin/administracion_sistema/proc/insertar.php");
								 
			if($_SERVER['HTTP_HOST']=='localhost'){
					$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        				<tr>
                          						<td align=\"center\" class=\"textos\"><a href=\"?sess=xx$id_sesion\">Activar cuenta esto es solo cuando se detecta que esta en localhost</a></td>
                       					 </tr>
                      				</table>";
					}else{
		
						//enviar_mail_gracias_registro($email, $password, $email, $id_sesion);
		
		
		
				}
				enviar_mail_gracias_registro($email, $password, $email, $id_sesion);
		
				$contenido .= html_template('gracias_registro');	
				
				$contenido = str_replace("#EMAIL#","$email",$contenido);
				$contenido = "<br/><br/>".cuadro_verde($contenido);
			 }else{
					//header("HTTP/1.0 307 Temporary redirect");
            		header("Location:index.php?accion=$accion&msj=2");	
			}
		
       
		 break;








			
   	default:
	
	 	$accion_form = "index.php?accion=$accion&act=1";
		
        include ("usuario/registro/formulario_registro.php");
	
	//$_SESSION['texto_exito']="texto de advertencia";

}
//$contenido = cambio_texto($contenido);

 
?>