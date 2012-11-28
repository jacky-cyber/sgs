<?php


	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	    	header('WWW-Authenticate: Basic realm="My Realm"');
	    	header('HTTP/1.0 401 Unauthorized');
	    	echo 'No autorizado';
	    	exit;
		}
		else {
			if ($_SERVER['PHP_AUTH_USER']=='minsegpres' && sha1($_SERVER['PHP_AUTH_PW'])=='7c4a8d09ca3762af61e59520943dc26494f8941b'){
		    	echo "Hola Acceso";
		    	return;
			}
		    else{
		    	header('WWW-Authenticate: Basic realm="My Realm"');
		    	header('HTTP/1.0 401 Unauthorized');
		    	echo 'No autorizado';
		    	exit;
		    }
		
		}
		
?>