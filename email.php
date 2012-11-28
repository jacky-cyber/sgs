<?php


    require("lib/class.phpmailer.php");
	require("lib/class.smtp.php");


    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "mail.2r.cl"; // SMTP a utilizar. Por ej. smtp.elserver.com
    $mail->Username = "asignador-onemi@2r.cl"; // Correo completo a utilizar
    $mail->Password = "87646954rrP"; // Contraseña
    //$mail->Port = 25; // Puerto a utilizar
    $mail->Port = 587; // Puerto a utilizar
    $mail->From = "asignador-onemi@2r.cl"; // Desde donde enviamos (Para mostrar)
    $mail->FromName = "ricardo";
    $mail->AddAddress("newtemopral@gmail.com"); // Esta es la dirección a donde enviamos
   // $mail->AddCC("cuenta@dominio.com"); // Copia
    //$mail->AddBCC("cuenta@dominio.com"); // Copia oculta
    $mail->IsHTML(true); // El correo se envía como HTML
    $mail->Subject = "Titulo"; // Este es el titulo del email.
    $body = "Hola mundo. Esta es la primer línea<br />";
    $body .= "Acá continuo el <strong>mensaje</strong>";
    $mail->Body = $body; // Mensaje a enviar
    $mail->AltBody = "Hola mundo. Esta es la primer línea\n Acá continuo el mensaje"; // Texto sin html
    //$mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");
    $exito = $mail->Send(); // Envía el correo.
	$error= $mail->ErrorInfo;

    if($exito){
    echo 'El correo fue enviado correctamente.';
    }else{
    echo "Hubo un inconveniente. Contacta a un administrador.<br>$error";
    }
 


?>