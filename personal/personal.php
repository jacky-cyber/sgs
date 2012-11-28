<?php




switch ($act) {
     case 1:
         include ("personal/proc/actualiza_datos.php");        	
         	header("Location:index.php?accion=$accion".$msg);
         
         break;
	 
   case 2:
   

			include ("personal/proc/actualiza_datos.php");
			
	 
		
	
         break;
	 case 3:
	
	 include ("usuario/registro/formulario_contrasenia.php"); 
	 
	 break;
	 
	 case 4:
	 
	 	
	 $pass_nueva1=$_POST['pass_nueva1'];
	 $password=$_POST['password'];
	 
	 include ("admin/administracion_sistema/proc/actualizar_contrasenia.php"); 
	 
	 break;
	 
	 case 5:
	 
	
	 $msg = $_GET['msg'];
	 if($msg ==3){
	  $contenido =  html_template('mensaje_actualizar_datos_contrasena');
	 }else{
	  $contenido =  html_template('mensaje_actualizar_datos');
	 }
	
	 break;
	 
	 
   	default:
	  	 include ("personal/proc/consulta.php");
   		// include ("usuario/registro/formulario_registro.php");
   		 include("usuario/registro/formulario_edicion.php");
   		 $accion_form = "index.php?accion=$accion&act=2";
		
   }


?>