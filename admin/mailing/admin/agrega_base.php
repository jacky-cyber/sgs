<?php
$imp_base = $HTTP_GET_VARS['imp_base'];
$tipo = $HTTP_GET_VARS['tipo'];
$ok = $HTTP_GET_VARS['ok'];


 if($ok=="ok"){

 $Sql ="UPDATE usuario
 	   SET tipo ='$imp_base'
 	   WHERE tipo ='$tipo'";
 				  
 	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");
	   
	    header("Location:$PHP_SELF?accion=$accion&act=3010&tipo=$imp_base&act_all=1");
	   
 }else{
 
 
      $query= "SELECT descrip   
             FROM mailing_usuario_tipo WHERE id_tipo_u = '$tipo'";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
			
			list($base1) = mysql_fetch_row($result);

  
      $query= "SELECT descrip   
             FROM mailing_usuario_tipo WHERE id_tipo_u = '$imp_base'";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
			
			list($base2) = mysql_fetch_row($result);
			
			

$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Sumar base \"<b>$base1</b>\" a base \"<b>$base2</b>\"</td>
                </tr>
				  <tr>
                  <td align=\"center\" class=\"textos\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                </tr>
				 <tr>
                  <td align=\"center\" class=\"textos\"><b>
				  <a href=\"$PHP_SELF?accion=$accion&act=$accion&tipo=$tipo&act_all=9&imp_base=$imp_base&ok=ok\">Si</a></b>
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>
				  <a href=\"$PHP_SELF?accion=$accion&act=3010&tipo=$tipo&act_all=1\">No</a></b></td>
                </tr>
				
              </table>";

} 
 
?>