<?php
include("lib/lib.inc");  
include("lib/connect_db.inc.php");    
include("lib/ft.inc");

set_time_limit(30);


function myErrorHandler($errno, $errstr, $errfile, $errline) {
    switch ($errno) {
        case E_NOTICE:
        case E_USER_NOTICE:
            $errors = "Notice  test de error -->";
            break;
        case E_WARNING:
        case E_USER_WARNING:
            $errors = "Warning -->";
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $errors = "Fatal Error -->";
            break;
   		case E_PARSE:
		case E_USER_PARSE:
            $errors = "Fatal Error  sintaxis -->";
            break;

        default:
            $errors = "Unknown -->";
            break; 
        }

    if (ini_get("display_errors")){
	//echo "Lo sentimos experimentamos problemas en este minuto intente mas tarde";
  	}
	
	    // printf ("<br />\n<b>%s</b>: %s in <b>%s</b> on line <b>%d</b><br /><br />\n", $errors, $errstr, $errfile, $errline);
    if (ini_get('log_errors')){
	echo "Upsss, sorry la!!! <br>$errors $errno, $errstr, $errfile, $errline <br>";
	}
	
       // error_log(sprintf("PHP %s:  %s in %s on line %d", $errors, $errstr, $errfile, $errline));
    return true;
}

// set to the user defined error handler
set_error_handler("myErrorHandler");



    $query= "SELECT id_usuario,nombre   
           FROM  usuarioX";
     $result= cms_cms_query($query);
      while (list($id_usuario,$nombre) = mysql_fetch_row($result)){
			
		 }
echo $_SERVER['PHP_SELF'];



?>
