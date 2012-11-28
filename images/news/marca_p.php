<?php 


$id_noticia = $_GET['id_noticia'];

$foto = $_GET['foto'];

$contenido ="<img src=\"marca.php?id_noticia=$id_noticia&foto=$foto\" border=\"0\">";

?>

<html>
<head>



<title><?php echo $page_name ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="javascript"> window.opener.name = "madre"; </SCRIPT> 
</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div align="center">
<?php echo $contenido ?>
</div>
</body>
</html>