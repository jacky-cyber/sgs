<?php
$id_receptor = $HTTP_GET_VARS['id_receptor'];
$act = $HTTP_GET_VARS['act'];

$nombre = $HTTP_POST_VARS['nombre'];
$mail = $HTTP_POST_VARS['mail'];


if(isset($act)){

$Sql ="UPDATE mailing_receptores SET nombre ='$nombre',mail='$mail'
	   WHERE id_receptor ='$id_receptor'";
		//echo $Sql;		  
	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");
   header("Location:$PHP_SELF?accion=$accion&act=3030");
}



  $query= "SELECT nombre,mail   
             FROM mailing_receptores WHERE id_receptor='$id_receptor'";
         $result= cms_query($query);
          list($nombre,$mail) = mysql_fetch_row($result);
	
	$accion_form ="$PHP_SELF?accion=$accion&act=$act&act_all=1&id_receptor=$id_receptor";
		  
		$tabla = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">Nombre:</td>
						  <td align=\"center\"><input type=\"text\" name=\"nombre\" value=\"$nombre\"  class=\"textos\"></td>
                        </tr>
                        <tr>
                          <td align=\"center\" class=\"textos\">Mail:</td>
						  <td align=\"center\"><input type=\"text\" name=\"mail\" value=\"$mail\"  class=\"textos\"></td>
                        </tr>
                      </table>
					    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                          <tr>
                            <td align=\"center\" class=\"textos\">
							<input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
                                   </td>
                            </tr>
                      	</table>";
		  
$contenido .=$tabla;
?>