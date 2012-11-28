<?php
session_start();
/*
session_start();
session_register_cms('mod_session');
$id_sesion = session_id();
*/

echo $_SESSION['xml_estadisticas'];

//Esta variable de session se llena en el modulo de estadisticas.php aqui solo se lee


?>