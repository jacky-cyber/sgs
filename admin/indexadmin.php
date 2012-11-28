<?php

switch ($act) {
     case 1:
         include ("admin/empresa/empresa.php");
         break;
	 case 2:
         include ("admin/usuarios/usuarios.php");
         break;
    
   	default:
   		if($idm=='eng')    {
   			$contenido= "<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	      <tr>
	        <td align=\"center\" class=\"textos\"> <a href=\"".$PHP_SELF."?accion=$accion&act=1\">Edition of Company </a></td>
	        </tr>
	        <tr>
	        <td align=\"center\" class=\"textos\"><a href=\"".$PHP_SELF."?accion=$accion&act=2\">Edition of Users</a></td>
	        </tr>
	  	</table>";
   		}
   		else{
	  $contenido= "<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	      <tr>
	        <td align=\"center\" class=\"textos\"> <a href=\"".$PHP_SELF."?accion=$accion&act=1\">Edicion de Empresa</a></td>
	        </tr>
	        <tr>
	        <td align=\"center\" class=\"textos\"><a href=\"".$PHP_SELF."?accion=$accion&act=2\">Edicion de Usuarios</a></td>
	        </tr>
	  	</table>";
	 }
   
}



?>