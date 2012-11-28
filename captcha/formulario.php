<?php
	session_start();
		
	$captcha_texto = "";
		
	for ($i = 1; $i <= 4; $i++) {
	    $captcha_texto .= caracter_aleatorio();
	}
		
	$HTTP_SESSION_VARS["captcha_texto_session"] = $captcha_texto;

	function caracter_aleatorio() {

		mt_srand((double)microtime()*1000000);
		
		$valor_aleatorio = mt_rand(1,3);
		
		switch ($valor_aleatorio) {
	    case 1:
	        $valor_aleatorio = mt_rand(97, 122); 
	        break;
	    case 2:
	        $valor_aleatorio = mt_rand(48, 57);
	        break;
	    case 3:
	        $valor_aleatorio = mt_rand(65, 90);
	        break;
		}
		
		return chr($valor_aleatorio);
	}

?>
<head>
<title>Captcha: Formularios mas seguros.</title>
</head>

<body style="font-family: Verdana, Arial, Helvetica, sans-serif ; font-size: 12px">
	<p>Captcha: Formularios mas seguros.</p>
	<hr size="1" noshade="noshade" />
	<p>Por favor ingrese el codigo que ve en la imagen, sino puede leerlo actualize la pagina.</p>
	<p align="center"><img src="crear_imagen.php" /></p>
		<form action="verificar.php" method="POST">
			<p>Ingrese el codigo:
				<input name="texto_ingresado" type="text" id="texto_ingresado" size="30" />			
				<input type="submit" name="Submit" value="OK" />
			</p>
		</form>
    <p
	><b>Nota:</b> El codigo es sensible a las mayuculas y minisculas</p>
</body>
</html>