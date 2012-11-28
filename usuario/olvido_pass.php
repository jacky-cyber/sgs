<?php
$boton = $_POST['boton'];
$mail = $_POST['mail'];

$login_chileatiende = html_template('login new CHLA ');	

switch ($act) {
     case 1:
	 
			include("usuario/asigna_new_pass_olvido.php");
		 
		 
         break;
	
   	default:
	  
	 
       




$js ="<script language=\"javascript\">  
	 function verificar(){
	 
	if(document.form1.mail.value =='')
	{
		window.alert('Por favor, ingrese \"email\"')
		document.form1.mail.focus();
		return false;
	}

	return true;
	
}
</script>";

$onsubmit = "onSubmit=\"return verificar(this)\"";
 
$accion_form = "index.php?accion=$accion";


if($mail !=""){
	//echo "hola";
	
  $mail = mysql_escape_string($mail);

  $query= "SELECT id_usuario, estado, id_perfil
           FROM  usuario
           WHERE email='$mail' ";
    // echo $query;
	 
	 
	 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($id, $estado, $id_perfil) = mysql_fetch_row($result2)){
      	  if($id_perfil==1 and $estado ==1){
		  
       $qry_insert="INSERT INTO usuario_cambio_pass(id_usuario_cambia_pass,id_usuario,session,ok) 
	   				values (null,'$id','$id_sesion','0')";
                     
       $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
	
	
				envia_mail_rescate_contrasena($id);
				    
					$contenido = html_template('Mensaje_solicitud_cambio_contrasena');
				   
				    $nombre = nombre_usuario2($id);
				    $id_entidad_padre = configuracion_cms('id_servicio');
				    $entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					$entidad_padre= acentos($entidad_padre);
				
					$contenido = str_replace("#NOMBRE#",$nombre,$contenido);
				    $contenido = str_replace("#SERVICIO#",$servicio,$contenido);
				    
				}elseif($id_perfil==1 and $estado !=1){
					$contenido = html_template('mensaje_error_no_activado');
					
					
				}else{
		
					$contenido = html_template('mensaje_error_pass2');
				}  
				
		 }else{
		 	
				$contenido = html_template('mensaje_error_pass');
		
		 }


}else{

$contenido = html_template('olvido_pass');


}

 }
 

 
?>