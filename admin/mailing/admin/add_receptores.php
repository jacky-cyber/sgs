<?php


$accion_form ="$PHP_SELF?accion=$accion&act=$act&act=1";


if (isset($act)){

$nombre = $HTTP_POST_VARS['nombre'];
$mail = $HTTP_POST_VARS['mail'];

      $query= "SELECT mail   
               FROM mailing_receptores
                WHERE mail='$mail'";
          $result= cms_query($query);
            if(!list($mail_recept) = mysql_fetch_row($result)){
    			
				$id_receptor = new_uid();

          $qry_insert="INSERT INTO mailing_receptores values ('$id_receptor','$nombre','$mail')";
              
                $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");			   
    		 header("Location: $PHP_SELF?accion=$accion&act=3030");
			
			 }else{
			 
			 
			 }


   

}else{



$formulario="  <table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                 <tr>
                   <td align=\"center\" class=\"textos\">
				     <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                       <tr>
                         <td align=\"left\" class=\"textos\">Nombre: </td>
                         <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"nombre\"></td>						 
                         </tr>
						 <tr>
                         <td align=\"left\" class=\"textos\">Mail</td>
                         <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"mail\"></td>						 
                         </tr>
                   	</table>
				   </td>
                   </tr>
				   <tr>
				   <td align=\"center\">&nbsp;
				   </td></tr>
				   <tr>
				   <td align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Agregar\" class=\"textos\">
				   </td></tr>
				   
             	</table>";
}


$contenido .=$formulario;
?>