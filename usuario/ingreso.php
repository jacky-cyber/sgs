<?php

 
	
	
	

$js ="<script language=\"JavaScript\">
function validaforma(theForm){

	if (theForm.login.value == \"\"){
			alert(\"Please your Login.\");
			theForm.login.focus();
			return false;
	}
	if (theForm.password.value == \"\"){
			alert(\"Please your Password.\");
			theForm.password.focus();
			return false;
	}
	
	


}
</script>";





$onsubmit ="onSubmit=\"return validaforma(this)\"";

$accion_form = "index.php";

/*

$contenido= "<TABLE cellSpacing=0 cellPadding=0 width=453 bgColor=#ffffff 
            border=0><!-- fwtable fwsrc=\"usuario1.png\" fwbase=\"pass.jpg\" fwstyle=\"Dreamweaver\" fwdocid = \"742308039\" fwnested=\"0\" -->
              <TBODY>
              <TR>
                <td class=\"textos\"><IMG height=1 src=\"\" width=453 border=0></TD>
                <td class=\"textos\"><IMG height=1 src=\"\" width=1 border=0></TD></TR>
              <TR>
                <td class=\"textos\"><IMG height=62 src=\"images/pas_1.jpg\" 
                  width=453 border=0 name=pas_1></TD>
                <td class=\"textos\"><IMG height=62 src=\"\" width=1 border=0></TD></TR>
              <TR>
                <TD align=middle background=\"images/pas_2.jpg\" 
                height=125>
                  <TABLE cellSpacing=0 cellPadding=0 width=\"100%\" align=center 
                  border=0>
                    <TBODY>
                    <TR>
                      <td class=\"textos\">
                        <TABLE class=formFields cellSpacing=0 cellPadding=0 
                        width=\"72%\" align=center border=0>
                          <TBODY>
                          <TR>
                            <TD class=textos>Login :</TD>
                            <td class=\"textos\">
                            <?php
                            $lista_establecimientos
                            ?>
                            </TD></TR> <TR>
                            <TD class=textos>Login :</TD>
                            <td class=\"textos\"><INPUT class=tex id=login_name tabIndex=1 
                              maxLength=255 size=25 name=login> </TD></TR>
                          <TR>
                            <TD class=textos height=18>Password :</TD>
                            <TD height=18>
                        <INPUT class=tex id=passwd 
                              tabIndex=2 type=password size=25 name=password> 
                          </TD></TR> 
                        </TBODY></TABLE></TD></TR>
                    <TR>
                      
                <TD vAlign=bottom align=center height=44>
<input class=\"boton\" type=submit value=Entrar name=\"boton\">
                </TD>
              </TR></TBODY></TABLE></TD>
                <td class=\"textos\"><IMG height=125 src=\"\" width=1 border=0></TD></TR>
              <TR>
                
          <TD vAlign=center align=center 
                background=\"images/pas3.jpg\" class=textos>&nbsp;
                <a href=\"".$PHP_SELF."?msg=1\">Forget your  password?</a>
                 </TD>
                <td class=\"textos\"><IMG height=10 src=\"\" width=1 border=0></TD></TR>
              <TR>
                <td class=\"textos\"><IMG height=9 src=\"images/pas4.jpg\" 
                  width=453 border=0 name=pas4></TD>
                <td class=\"textos\"><IMG height=9 src=\"\" width=1 
          border=0></TD></TR></TBODY></TABLE>
	
	

";
*/

$contenido = "<TABLE cellSpacing=0 cellPadding=0 width=453 bgColor=#ffffff 
            border=0><!-- fwtable fwsrc=\"usuario1.png\" fwbase=\"pass.jpg\" fwstyle=\"Dreamweaver\" fwdocid = \"742308039\" fwnested=\"0\" -->
              <TBODY>
              <TR>
                <td class=\"textos\"><IMG height=1 src=\"\" width=453 border=0></TD>
                <td class=\"textos\"><IMG height=1 src=\"\" width=1 border=0></TD></TR>
              <TR>
                <td class=\"textos\"><IMG height=62 src=\"images/pas_1.jpg\" 
                  width=453 border=0 name=pas_1></TD>
                <td class=\"textos\"><IMG height=62 src=\"\" width=1 border=0></TD></TR>
              <TR>
                <TD align=middle background=\"images/pas_2.jpg\" 
                height=125>
                  <TABLE cellSpacing=0 cellPadding=0 width=\"100%\" align=center 
                  border=0>
                    <TBODY>
                    <TR>
                      <td class=\"textos\">
                        <TABLE class=formFields cellSpacing=0 cellPadding=0 
                        width=\"72%\" align=center border=0>
                          <TBODY>
                          <TR>
                            <TD class=textos>Establecimiento :</TD>
                            <td class=\"textos\">$lista_establecimientos</TD></TR>
                              <TR>
                            <TD class=textos>Usuario :</TD>
                            <td class=\"textos\"><INPUT class=tex id=login_name tabIndex=1 
                              maxLength=255 size=25 name=login> </TD></TR>
                          <TR>
                            <TD class=textos height=18>Contraseña :</TD>
                            <TD height=18>
                        <INPUT class=tex id=passwd 
                              tabIndex=2 type=password size=25 name=password> 
                          </TD></TR> 
                        </TBODY></TABLE></TD></TR>
                    <TR>
                      
                <TD vAlign=bottom align=center height=44>
<input class=\"boton\" type=submit value=Entrar name=\"boton\">
                </TD>
              </TR></TBODY></TABLE></TD>
                <td class=\"textos\"><IMG height=125 src=\"\" width=1 border=0></TD></TR>
              <TR>
                
          <TD vAlign=center align=center 
                background=\"images/pas3.jpg\" class=textos>&nbsp;
                <a href=\"".$PHP_SELF."?msg=1\">¿Olvido su Contraseña?</a>
                 </TD>
                <td class=\"textos\"><IMG height=10 src=\"\" width=1 border=0></TD></TR>
              <TR>
                <td class=\"textos\"><IMG height=9 src=\"images/pas4.jpg\" 
                  width=453 border=0 name=pas4></TD>
                <td class=\"textos\"><IMG height=9 src=\"\" width=1 
          border=0></TD></TR></TBODY></TABLE>
	
	

";


?>