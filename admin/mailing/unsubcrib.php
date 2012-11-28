<?php
include ("../../lib/connect_db.inc");
//include ("l../../ib/config.inc");

$id_usuario = $HTTP_GET_VARS['id_usuario'];
$id_mailing = $HTTP_GET_VARS['id_mailing'];


$Sql ="Update mailing_usuario
 SET nomas = 'ok' , id_mailing_nomas ='$id_mailing'
        Where id_usuario='$id_usuario'";
  // echo $Sql;
   cms_query($Sql)or die("2: Error en Update a la base de datos");
  

  

?>
<html>
<head>
<title>Xerox</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
 <table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
          Hemos recibido su solicitud, por su tiempo<br>Muchas Gracias.
        </font></div>
		</td>
    </tr>
  </table>
</body>
</html>