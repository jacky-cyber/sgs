<?php
  
  $query= "SELECT id_perfil   
           FROM  usuario_perfiles 
           WHERE id_usuario='$id_user'";
     $result= mysql_query($query)or die (mysql_error());
      while (list($id_perfil_relacion) = mysql_fetch_row($result)){
			$nombre_perfil_relac = nombre_perfil($id_perfil_relacion);
			
			$tabla_perfil_r .="<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp;$nombre_perfil_relac</td>
			<td align=\"center\" class=\"textos\">
			<a href=\"index.php?accion=$accion&act=6&id_user=$id_user&id_perf=$id_perfil_relacion\">
			<img src=\"images/del.gif\" alt=\"Borrar Perfil\" border=\"0\"></td></a></tr> ";
			
						   
		 }
		if($tabla_perfil_r!="") {
		$tabla_perfil_r ="<table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                               <tr >
                                 <td align=\"center\" class=\"cabeza_rojo\" colspan=\"2\">Perfiles asigandos este Usuario</td>
                                 <td align=\"center\" class=\"cabeza_rojo\"></td>
                                 </tr>
								 $tabla_perfil_r
                           	</table><br>";   

		}
		 
	
	
	  $query= "SELECT id_establecimiento  
           FROM  usuario_establecimientos
           WHERE id_usuario='$id_user'";
     $result= mysql_query($query)or die (mysql_error());
      while (list($id_estable) = mysql_fetch_row($result)){
	  		$nombre_establecimiento = establecimiento_nombre($id_estable);
			$tabla_establecimientos .="<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp; $nombre_establecimiento</td>
						<td align=\"center\" class=\"textos\">
						<a href=\"index.php?accion=$accion&act=6&id_user=$id_user&id_est=$id_estable\">
 						<img src=\"images/del.gif\" alt=\"\" border=\"0\">
 						</a></td></tr> "; 			   
		 }


 if($tabla_establecimientos!=""){
 $tabla_establecimientos ="<table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\" >
                                <tr class=\"cabeza_rojo\">
                                  <td align=\"center\" colspan=\"2\">Lista de Escuelas Asigandas a este Ususario</td>
                                  </tr>
								  $tabla_establecimientos
                            	</table>";
 }
				  
  
?>