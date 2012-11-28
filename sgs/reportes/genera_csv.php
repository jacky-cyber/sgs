<?php

include("../../lib/lib.inc.php");  

 

@session_register('encabezados_csv');
@session_register('tabla_csv');
@session_register('titulo_informe');

$ext       = 'csv';
$mime_type = 'text/x-csv';
$filename = $_SESSION['titulo_informe'];

// Se envian los encabezados
header('Content-Type: ' . $mime_type);

// lem9 & loic1: IE necesita encabezados especiales
if (PMA_USR_BROWSER_AGENT == 'IE') {
        header('Content-Disposition: inline; filename="' . $filename . '.' . $ext . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
}
else {
        header('Content-Disposition: attachment; filename="' . $filename . '.' . $ext . '"');
        header('Expires: 0');
        header('Pragma: no-cache');
}

echo $_SESSION['titulo_informe'];
echo "\n\n";
echo $_SESSION['encabezados_csv'];
echo "\n\n";
echo $_SESSION['tabla_csv'];

/*$_SESSION['titulo_informe'] = "";
$_SESSION['encabezados_csv'] = "";
$_SESSION['tabla_csv'] = "";*/



?>