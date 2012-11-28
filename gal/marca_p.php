<?php 
include("../lib/lib.inc");  
include("../lib/connect_db.inc");    



$id_img_p = $_GET['id_img_p'];
$id_cliente = $_GET['id_cliente'];
$id_galeria = $_GET['id_galeria'];

$id_usuario = $_GET['id_usuario'];
$id_tipo = $_GET['id_tipo'];



if($click!="no" AND $id_tipo==""){

 $query= "SELECT click  
                   FROM  imagenes
                   WHERE imagen1='$id_img_p' AND id_galeria  = $id_galeria";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
       list($click) = mysql_fetch_row($result);
        	
			
			$click = $click+1;					   
       
//modificado
$Sql ="UPDATE imagenes 
	   SET click ='$click',  ult_id = '$id_usuario'
	   WHERE imagen1='$id_img_p' AND id_galeria  = '$id_galeria' AND ult_id <> '$id_usuario'";
//fin modificacion

$Sql ="UPDATE imagenes 
	   SET click ='$click',  ult_id = '$id_usuario'
	   WHERE imagen1='$id_img_p' AND id_galeria  = '$id_galeria' ";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
}

$contenido ="<img src=\"marca.php?id_img_p=$id_img_p&id_usuario=$id_usuario&id_cliente=$id_cliente&click=no&id_galeria=$id_galeria&id_tipo=$id_tipo\" border=\"0\" class=\"foto\">";
	   


					


/*
if (id_exist($id_usuario)){

		}else{

		

		$contenido .="<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                         <tr>
                          <td class=\"textos\" align=\"center\">&nbsp;</td>
                        </tr>
						 <tr>
                          <td class=\"textos\" align=\"center\">&nbsp;</td>
                        </tr>
						<tr>
                         <td class=\"textos\" align=\"center\">Los sentimos para ver nuestras Galer&iacute;as debes ser un usuario registrado de 
						  <a href=\"index.php\">www.bohemia.cl</a></td>
                       </tr>
					 <tr>
                    <td class=\"textos\" align=\"center\">&nbsp;</td>
                       </tr>
                        <tr>
                          <td class=\"textos\"  align=\"center\">Si deseas Registrarte puedes hacerlo en nuestra sección de Registros</td>
                        </tr>
                      </table>";
	
		
	}*/
if($id_tipo!=5){
 $fuente ="http://www.bohemia.cl/gal/$id_cliente/$id_galeria/$id_img_p";
}else{
 $fuente ="http://www.bohemia.cl/images/news/$id_img_p";
}

		
		           // $imagen = $images[$i][0];
		
		            $fuente = @imagecreatefromjpeg($fuente); 
		            
					$imgAncho = @imagesx ($fuente);
					$imgAlto = @imagesy ($fuente);

?>

<html>

<head>

<title>Bohemia</title>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<SCRIPT LANGUAGE="javascript"> window.opener.name = "madre"; </SCRIPT> 

</head>

<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-522218-1";
urchinTracker();
</script>
<style type="text/css">
#fadeinbox {
 position:absolute;
 width: 0px;
 left: 0;
 top: 0px;
 border: 0px solid black;
 background-color: lightyellow;
 padding: 0px;
 z-index: 0;
 visibility:hidden;
 }
 

<!--
img.foto {
	border: 0px solid #000;
	width: <?php echo $imgAncho ?> px;
	height : <?php echo $imgAlto ?>px;
	background: url("cargando.gif") no-repeat center center;
}


</style>


<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?php echo $contenido ?></td>
  </tr>
 

</table>



</body>

</html>