<?php
include("../lib/connect_db.inc.php");
include("../lib/lib.inc.php");
include("../lib/lib.inc2.php");
include("../lib/seguridad.inc.php");

$login = $_POST['usuario'];
$password = $_POST['pass'];


session_start();

$id_sesion = session_id();

if($login!="" and $password!=""){
	
	$password = md5($password);
	
	$login = mysql_escape_string($login);
	$password = mysql_escape_string($password);

	  $query= "SELECT id_usuario   
	           FROM  usuario
	           WHERE login='$login' and password='$password' ";
		
	 
	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      if (list($id_usuario) = mysql_fetch_row($result)){
	      	
			
			$Sql ="UPDATE usuario 
            	   SET session =''
            	   WHERE session ='$session'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
			
			 
					$Sql ="UPDATE usuario
						   SET session ='$id_sesion'
						   WHERE id_usuario ='$id_usuario'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));	
						  
					 header("Location:../index.php");
					 
					 
			 }else{
			 
			 $msj= "<font color=\"#FF0000\">Nombre o contraseña incorrecta</font> ";
			 
			 }
}elseif($log=='ok'){


	$msj= "<font color=\"#FF0000\">Nombre o contraseña incorrecta</font> ";
}


$nombe_pag="Control de Acceso";


$html ="<html>
<head>
<title>$nombre_pag</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
</head>
<style type=\"text/css\">
<!--
.textos {  font-family: Arial, Helvetica, sans-serif; font-size: 10px}
-->
</style>
<body bgcolor=\"#FFFFFF\" text=\"#000000\">
$js
 
<form name=\"form1\" method=\"post\" action=\"admin.php\">
<TABLE cellSpacing=0 cellPadding=0 width=453 
                              bgColor=#ffffff border=0 align=\"center\">
  <!-- fwtable fwsrc=\"usuario1.png\" fwbase=\"pass.jpg\" fwstyle=\"Dreamweaver\" fwdocid = \"742308039\" fwnested=\"0\" -->
  <TBODY> 
  <TR>
                                <TD class=textos><IMG height=1 
                                src=\"images/intra.htm\" width=453 
                                border=0></TD>
                                <TD class=textos><IMG height=1 
                                src=\"images/intra.htm\" width=1 
                                border=0></TD></TR>
                                <TR>
                                <TD class=textos><IMG height=62 
                                src=\"images/pas_1.jpg\" width=453 
                                border=0 name=pas_1></TD>
                                <TD class=textos><IMG height=62 
                                src=\"images/intra.htm\" width=1 
                                border=0></TD></TR>
                                <TR>
                                <TD align=middle 
                                background=images/pas_2.jpg 
                                height=125>
                                <TABLE cellSpacing=0 cellPadding=0 width=\"100%\" 
                                align=center border=0>
                                <TBODY>
                                <TR>
                                <TD class=textos>
                                
            <TABLE class=formFields cellSpacing=0 
                                cellPadding=0 width=\"72%\" align=center border=0>
              <TBODY> 
              <TR> 
                <TD class=textos>Login :</TD>
                <TD class=textos>
                  <INPUT class=tex id=usuario tabIndex=1 maxLength=255 size=25 name=\"usuario\">
                </TD>
              </TR>
              <TR> 
                <TD class=textos height=18>Password :</TD>
                <TD height=18>
                  <INPUT class=tex id=pass  tabIndex=2 type=password size=25 name=\"pass\">
                </TD>
              </TR>
              </TBODY>
            </TABLE>
          </TD></TR>
                                <TR>
                                
          <TD vAlign=bottom align=center height=44>
<INPUT class=textos type=submit value=Entrar name=boton>
          </TD>
        </TR></TBODY></TABLE></TD>
                                <TD class=textos><IMG height=125 
                                src=\"images/intra.htm\" width=1 
                                border=0></TD></TR>
                                <TR>
                                
    <TD class=textos vAlign=center align=middle 
                                background=images/pas3.jpg>&nbsp;</TD>
                                <TD class=textos><IMG height=10 
                                src=\"images/intra.htm\" width=1 
                                border=0></TD></TR>
                                <TR>
                                <TD class=textos><IMG height=9 
                                src=\"images/pas4.jpg\" width=453 
                                border=0 name=pas4></TD>
                                <TD class=textos><IMG height=9 
                                src=\"images/intra.htm\" width=1 
                                border=0></TD></TR></TBODY></TABLE>



</form>
 <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr >
      <td align=\"center\" class=\"textos\">$msj</td>
      </tr>
	</table>
</body>
</html>";


echo $html;
?>