<?php

$accion_form = $PHP_SELF."?accion=1401&id=$id_noticia&id_usuario=$id_usuario&user=$user&act=1&datos=ok";

if($idm=='eng'){
	
	
	$contenido .="<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">

    <tr> 

      <td width=\"152\" class=\"textos\">Name igrese Men&uacute;</td>

      <td width=\"148\">

	   

        <input type=\"text\" name=\"apodo\" class=\"textos\">

      </td>

    </tr>

    <tr> 

      <td width=\"152\" class=\"textos\">Name igrese PhP</td>

      <td width=\"148\">

        <input type=\"text\" name=\"file_php\" class=\"textos\">

      </td>

    </tr>

  </table>

    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
        <td align=\"center\" class=\"textos\">En Home <input type=\"checkbox\" name=\"home\" value=\"checkbox\">
		</td>
		<td align=\"center\" class=\"textos\">It verifies<input type=\"checkbox\" name=\"verifica\" value=\"checkbox\">
		</td>
        </tr>
  	</table>

  <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">

  

  <tr>

    <td align=\"center\" >

	&nbsp;

	</td>

  <tr>

    <td align=\"center\">

	<input name=\"Submit\" type=\"image\" value=\"Aceptar\" src=\"images/bot_aceptar.gif\">

        

	</td>

  </tr>

</table>

";

}
else {
	




$contenido .="<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">

    <tr> 

      <td width=\"152\" class=\"textos\">Ingrese Nombre Men&uacute;</td>

      <td width=\"148\">

	   

        <input type=\"text\" name=\"apodo\" class=\"textos\">

      </td>

    </tr>

    <tr> 

      <td width=\"152\" class=\"textos\">Ingrese Nombre PhP</td>

      <td width=\"148\">

        <input type=\"text\" name=\"file_php\" class=\"textos\">

      </td>

    </tr>

  </table>

    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
        <td align=\"center\" class=\"textos\">En Home <input type=\"checkbox\" name=\"home\" value=\"checkbox\">
		</td>
		<td align=\"center\" class=\"textos\">Verifica <input type=\"checkbox\" name=\"verifica\" value=\"checkbox\">
		</td>
        </tr>
  	</table>

  <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">

  

  <tr>

    <td align=\"center\" >

	&nbsp;

	</td>

  <tr>

    <td align=\"center\">

	<input name=\"Submit\" type=\"image\" value=\"Aceptar\" src=\"images/bot_aceptar.gif\">

        

	</td>

  </tr>

</table>

";

}

?>