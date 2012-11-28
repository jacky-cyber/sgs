<?php
include("../lib/connect_db.inc");
include("../lib/lib.inc");

$id_usuario = $_GET['id_usuario'];
$id_cliente = $_GET['id_cliente'];
$id_galeria = $_GET['id_galeria'];
$user = $_GET['user'];
$imagen = $_GET['imagen'];

 $query= "SELECT nombre,apellido,email   
                   FROM  usuarios
                   WHERE id_usuario='$id_usuario'";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
          list($nombre,$apellido,$email) = mysql_fetch_row($result);

	
		   
		  $foto ="<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
                    <tr>
                      <td align=\"center\">
					  <img src=\"imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=100\"150\" alt=\"thumbnail\"  border=\"0\" title=\"ver la im&aacute;gen ampliada\" /></td>
                    </tr>
                  </table>";

				  
				  
	$accion_form ="../index.php?id_usuario=$id_usuario&user=$user&accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&postal=ok&id_img_p=$imagen";			  
				  
	

$cod_util ="<HTML> 
  <HEAD> 
  <SCRIPT LANGUAGE=\"JavaScript\"> 
 closetime = 10; // Tiempo en segundos que tardara en cerrarse
 function Start(URL, WIDTH,HEIGHT)
 { 
  windowprops = \"left=50,top=50,width=\" + WIDTH + \",height=\" + HEIGHT;
  preview = window.open(URL, \"preview\", windowprops);
  if (closetime) setTimeout(\"preview.close();\", closetime*1000); 
 } 
 function Mostrar()
 {
  url = \"http://www.xlwebmasters.com\"; 
  width = 267; 
  height = 103; 
  delay = 2;
  timer =setTimeout(\"Start(url, width, height)\", delay*1000); 
 } 
</SCRIPT> 
  </HEAD> 
  <BODY ONLOAD=\"Mostrar();\"> </BODY>
</HTML> 

Supongamos que tenemos un formulario en una pop-up y queremos que al
 enviarlo lo envie a la madre(la ventana que origino la pop-up). 


Entonces entre <HEAD> y </HEAD> de la pop-up(la que contiene el formulario) ponemos: 

<SCRIPT LANGUAGE=\"javascript\"> window.opener.name = \"madre\"; </SCRIPT> 

Y al formulario en el target le ponemos: 

<FORM ACTION=\"algo.php\" TARGET=\"madre\"> 

Esto tambien funciona para enlaces: 

<A HREF=\"algo.htm\" TARGET=\"madre\">Algo</A> 

";

		  
?>



<html>
<head>
<style>


#message div.menuBar,
#message div.menuBar a.menuButton {
  font-family: Verdana, Arial, sans-serif;
  font-size: 8pt;
  color: #000000;
}

#message div.menuBar {
  background-color: #666666;
  padding: 6px 2px 6px 2px;
  text-align: center;
  margin-left:20px;
}

#message div.menuBar a.menuButton {
  background-color: trasparent;
  border: 1px solid;
  border-color:  #66666c #333333 #333333 #66666c;
  color: #ffffff;
  cursor: pointer;
  left: 0px;
  margin: 1px;
  padding: 2px 6px 2px 6px;
  xposition: relative;
  text-decoration: none;
  top: 0px;
  z-index: 100;
}

#message div.menuBar a.menuButton:hover {
  background-color: trasparent;
  border-color: #333333 #66666c #66666c #333333;
  color: #ffffff;
}

#im { 
FILTER: alpha(opacity=80) 
} 


.skin0 {
position:absolute;
text-align:left;
width:200px;
border:2px solid black;
background-color:menu;
font-family:Verdana;
line-height:20px;
cursor:default;
visibility:hidden;
}
.skin1 {
cursor:default;
font:menutext;
position:absolute;
text-align:left;
font-family: Arial, Helvetica, sans-serif;
font-size: 10pt;
width:120px;
background-color:menu;
border:1 solid buttonface;
visibility:hidden;
border:2 outset buttonhighlight;
}
.menuitems {
padding-left:15px;
padding-right:10px;
}


.texto-titulo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 15px;
	color: #000000;
	font-weight: bold;
}
.texto-bold {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	font-weight: bold;
}
.texto-bold_det {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #003399;
	font-weight: bold;
}

.textos {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	
	
}
.textos_plomo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #999999;
	
	
}.textos_blanco {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #ffffff;
	
	
}
.textos-chico {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #666666;
	
	
}
.texto2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #000000;
}
.campos {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.derechos {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 9px;
	color: #999999;
}
.inp {
	BORDER-RIGHT: #ececec 1px solid; BORDER-TOP: #c7c7c7 1px solid; 
	MARGIN: 0px 0px 3px; 
	BORDER-LEFT: #c7c7c7 1px solid; 
	WIDTH: 110px; 
	BORDER-BOTTOM: #ececec 1px solid
}
.inp2 {
	BORDER-RIGHT: #ececec 1px solid; 
	BORDER-TOP: #c7c7c7 1px solid; 
	MARGIN: 0px; 
	BORDER-LEFT: #c7c7c7 1px solid; 
	BORDER-BOTTOM: #ececec 1px solid;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	scrollbar-face-color: #FFFFFF; 
	scrollbar-shadow-color: #FFFFFF; 
	scrollbar-highlight-color: #003366; 
	scrollbar-3dlight-color: #FFFFFF; 
	scrollbar-darkshadow-color: #003366; 
	scrollbar-track-color: #FFFFFF; 
	scrollbar-arrow-color: #003366;
}

.TEXTAREA	{
BORDER-TOP-COLOR: #c7c7c7 1px solid; 
BORDER-LEFT-COLOR: #c7c7c7 1px solid; 
BORDER-RIGHT-COLOR: #ececec 1px solid; 
BORDER-BOTTOM-COLOR:  #ececec 1px solid; 
BORDER-TOP-WIDTH: 1px; 
BORDER-LEFT-WIDTH: 1px; 
FONT-SIZE: 11px; 
BORDER-BOTTOM-WIDTH: 1px; 
font-family: Verdana, Arial, Helvetica, sans-serif;
BORDER-RIGHT-WIDTH: 1px}


.inp3 {
	BORDER-RIGHT: #ececec 1px solid; 
	BORDER-TOP: #c7c7c7 1px solid; 
	MARGIN: 0px 0px 20px 20px; 
	BORDER-LEFT: #c7c7c7 1px solid; 
	BORDER-BOTTOM: #ececec 1px solid;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	scrollbar-face-color: #FFFFFF; 
	scrollbar-shadow-color: #FFFFFF; 
	scrollbar-highlight-color: #003366; 
	scrollbar-3dlight-color: #FFFFFF; 
	scrollbar-darkshadow-color: #003366; 
	scrollbar-track-color: #FFFFFF; 
	scrollbar-arrow-color: #003366;
}



.input { 
color : #CCFFFF; 
font-weight : normal; 
line-height : 1.5em; 
}
.select { 
color : #CCFFFF; 
font-weight : normal; 
line-height : 1.5em; 
}
.select {
 font-family: Verdana, Arial, Helvetica, sans-serif; 
 font-size: 10px; border: #000000; border-style: solid; 
 border-top-width: 1px; 
 border-right-width: 1px; 
 border-bottom-width: 1px; 
 border-left-width: 1px
 } 


.menu {  font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold}

A:hover {color: #FF6600; text-decoration: none;}
A:visited {color: #0033FF; text-decoration: none;}


A {text-decoration: none}

body {scrollbar-face-color: #FFFFFF; scrollbar-shadow-color: #FFFFFF; scrollbar-highlight-color: #003366; scrollbar-3dlight-color: #FFFFFF; scrollbar-darkshadow-color: #003366; scrollbar-track-color: #FFFFFF; scrollbar-arrow-color: #003366;}












-->
</style>







<title>Bohemia Postal</title>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
		<meta http-equiv="expires" content="-1" />
		<meta http-equiv= "pragma" content="no-cache" />
		<meta name="author" content=""/>
		<meta name="robots" content="Bohemia Santiago" />
		<meta name="MSSmartTagsPreventParsing" content="true" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="javascript"> window.opener.name = "madre"; </SCRIPT> 

</head>

<body background="../images/cuadro/../images/bk.gif" bgcolor="#ffffff" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

	 <form name="form_menu" method="post" action="<?php echo $accion_form ?>" target="madre">

<table border="0" cellpadding="0" cellspacing="0" width="200">
 
  <tr>
   <td><img src="../images/cuadro/spacer.gif" width="16" height="1" border="0"></td>
   <td><img src="../images/cuadro/spacer.gif" width="300" height="1" border="0"></td>
   <td><img src="../images/cuadro/spacer.gif" width="13" height="1" border="0"></td>
   <td><img src="../images/cuadro/spacer.gif" width="1" height="1" border="0"></td>
  </tr>

  <tr>
    <td width="300"><img name="cuadro_r1_c1" src="../images/cuadro/cuadro_r1_c1.jpg" width="16" height="17" border="0"></td>
    <td width="300"><img name="cuadro_r1_c2" src="../images/cuadro/cuadro_r1_c2.jpg" width="300" height="17" border="0"></td>
   <td><img name="cuadro_r1_c3" src="../images/cuadro/cuadro_r1_c3.jpg" width="13" height="17" border="0"></td>
   <td><img src="../images/cuadro/spacer.gif" width="1" height="17" border="0"></td>
  </tr>
  <tr>
    <td background="../images/cuadro/cuadro_r2_c1.jpg">&nbsp;</td>
    <td align="center" valign="top">
	
	
	
	
<!--contenido -->


<table width="200" border="0">
  <tr> 
    <td class="textos"  height="21">De: <?php echo "$nombre $apellido"; ?></td>
  </tr>
  <tr>
    <td class="textos"  align="center" valign="top"> 
        <table width="200" border="0">
          <tr> 
            <td class="textos" >Nombre de tu amigo:  </td>
          </tr>
          <tr> 
            <td class="textos" > 
              <input class="inp2"  type="text" name="nombre_cont" value="nombre" size="10">
              <input class="inp2"  type="text" name="apellido_cont" value="apellido" size="10">
            </td>
          </tr>
		  <tr> 
            <td class="textos" >E-mailde tu amigo: </td>
          </tr>
          <tr> 
            <td class="textos" > 
              <input class="inp2"  type="text" name="email_cont" value="email" size="20">
            </td>
          </tr>
          <tr> 
            <td class="textos" >Mensaje:</td>
          </tr>
          <tr> 
                  <td class="textos" align="center" > 
                    <textarea name="mensaje" cols="30" rows="5" class="textos"></textarea>
                  </td>
          </tr>
          <tr>
            <td class="textos"  align="center"> 
              <input class="inp2"  type="submit" name="Submit" value="Enviar y Cerrar" onclick="window.parent.close()">
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>


	
	
	</td>
	
	 
	
    <td background="../images/cuadro/cuadro_r2_c3.jpg">&nbsp;</td>
   <td><img src="../images/cuadro/spacer.gif" width="1" height="183" border="0"></td>
  </tr>
  <tr>
   <td><img name="cuadro_r3_c1" src="../images/cuadro/cuadro_r3_c1.jpg" width="16" height="20" border="0"></td>
   <td><img name="cuadro_r3_c2" src="../images/cuadro/cuadro_r3_c2.jpg" width="300" height="20" border="0"></td>
   <td><img name="cuadro_r3_c3" src="../images/cuadro/cuadro_r3_c3.jpg" width="13" height="20" border="0"></td>
   <td><img src="../images/cuadro/spacer.gif" width="1" height="20" border="0"></td>
  </tr>
</table>

	 <?php echo $foto ?>
</form>

</body>
</html>

