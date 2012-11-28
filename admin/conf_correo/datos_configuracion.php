<?php

$remitente =configuracion_cms('mail_remitente');
$nombre_remitente =configuracion_cms('nombre_de_envio');
$host =configuracion_cms('servidor_de_envio');

$metodo_envio =configuracion_cms('metodo_de_envio');
$var = "check_".$metodo_envio;
$$var= "checked=\"checked\"";

$port =configuracion_cms('port');

$smtp =configuracion_cms('smtp_autentification');
$var = "check_$smtp";
$$var= "checked=\"checked\"";

$username =configuracion_cms('cuenta_smtp');
$password =configuracion_cms('pass_smtp');

$parar_mail =configuracion_cms('parar_mail');
if($parar_mail==1){
$check_parar_mail = " checked";
}


$firma_envio_mails = configuracion_cms('firma_envio_mails');

?>