<html>
<head>
<title>Mailing</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style>
.textos {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #000000;
	
	
}
.titulos {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: #000000;
	
	
}
.textos_plomo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #cccccc;
	
	
}
.textos_rojo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #ff0000;
	
	
}
.titulo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 20px;
	color: #000000;
	
	
}
.bajada {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
	
	
}


.menu {  font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold}

A:hover {color: #FF6600; text-decoration: none;}
A:visited {color: #0033FF; text-decoration: none;}


A {text-decoration: none}

body {scrollbar-face-color: #FFFFFF; scrollbar-shadow-color: #FFFFFF; scrollbar-highlight-color: #003366; scrollbar-3dlight-color: #FFFFFF; scrollbar-darkshadow-color: #003366; scrollbar-track-color: #FFFFFF; scrollbar-arrow-color: #003366;}


</style>



<script language="JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>


</head>

<body bgcolor="#FFFFFF" text="#000000">

<form name="form1" method="post" action="{ACCION}" enctype="multipart/form-data">
  <table width="90%" border="0" cellpadding="1" cellspacing="1" bordercolor="#CCCCCC" bgcolor="#CCCCCC" align="center">
    <tr>
    <td>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="#FFFFFF">
          <tr>
            <td align="center" class="titulos">
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr> 
                  <td width="20%">&nbsp;</td>
                  <td align="center"><b>MAILING ROOM 1.0</b></td>
                </tr>
              </table>
              
			</td>
  </tr>
</table>

        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr> 
            <td align="left" valign="top" height="166"> 
              <table width="92%" border="0" cellpadding="0" cellspacing="0" align="center">
                <tr> 
          <td><a href="mailing.php?accion=1"><font face="Arial, Helvetica, sans-serif" size="2">Crear 
            Mailing</font></a></td>
        </tr>
        <tr> 
          <td><a href="mailing.php?accion=2"><font face="Arial, Helvetica, sans-serif" size="2">Ver 
            Estadisticas</font></a></td>
        </tr>
		
		<tr> 
          <td><a href="mailing.php?accion=3"><font face="Arial, Helvetica, sans-serif" size="2">Administración</font></a></td>
        </tr>
		
      </table>
            </td>
            <td width="80%" height="166" valign="top" align="center"><br>
              {CONTENIDO}</td>
  </tr>
</table>

</td>
  </tr>
  
</table>

</form>
  <table width="300"  border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" class="textos">&nbsp;</td>
      </tr>
	   <tr>
      <td align="center" class="textos">&nbsp;</td>
      </tr>	
	</table>
</body>
</html>
