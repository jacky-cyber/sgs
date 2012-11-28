<?php
$boton = $_POST['boton'];

inserta("usuario_amigo");
envia_amigo($id_usuario,$nombre_amigo,$mail_amigo,$id_mail);

if($boton!=""){
	$contenido="<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
         <tr>
             <td align=\"center\" class=\"texto-bold\">Su email fue enviado satisfactoriamente.</td>
         </tr>
         <tr>
             <td align=\"center\" class=\"textos\">&nbsp;</td>
         </tr>
         <tr>
             <td align=\"center\" class=\"textos\">&nbsp;</td>
         </tr>
         <tr>
              <td align=\"center\" class=\"textos\">
              <a href = \"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">
              <img src=\"images/volver.gif\" alt=\"Volver\" border=\"0\"></a></td>
        </tr>
	</table>";

}


   


?>