<?php
include("../../lib/connect_db.inc.php");
include("../../lib/lib.inc.php");
include("../../lib/lib.inc2.php");
include("../../lib/seguridad.inc.php");

/*
$tabla = "usuario";
$campo_txt_def = "sexo";
$campo_pk_def= "id_sexo";
$tabla_campo_def = "usuario_sexo";


*/

include("genera_xml.php");

echo $xml_grafico;
?>