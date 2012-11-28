<?php
include("connect_db.inc.php");    
include("lib.inc"); 


$var = $_GET['vari'];

$var=explode("_",$var);


$id_contenido=$var[0];
$id_perfild=$var[1];

 $Sql ="DELETE FROM control_contenido_perfil 
 		WHERE id_contenido ='$id_contenido' 
		and id_perfil='$id_perfild'";

 cms_query($Sql);


  
  
  				  
     $query= "SELECT id_perfil    
              FROM  control_contenido_perfil 
              WHERE id_contenido ='$id_contenido'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_perf) = mysql_fetch_row($result)){
				
				$var_perf_cont="$id_contenido"."_$id_perf";
				
				$nombre_perfil = nombre_perfil($id_perf);
				$tabla_perfil .="<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp;$nombre_perfil</td>
				<td align=\"center\" class=\"textos\">
				<a href=\"#perfil_contenido\" onClick=\"sendperfilcontenido('$var_perf_cont')\">
				
				<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
				</td></tr>";
				
		 }

		$tabla_perfil = "<br><div id=\"resultadoPerfCont\">
		<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                        <tr class=\"cabeza\">
                          <td align=\"center\" >Perfiles</td>
                       <td align=\"center\" class=\"textos\"></td>
                        </tr>
						$tabla_perfil
                      </table>
					  </div>";
					  
					  
					  
		echo $tabla_perfil

?>