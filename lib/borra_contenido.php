<?php
include("connect_db.inc");    
include("lib.inc");    

//echo "$id_p_check<br>"	

$var = $_GET['vari'];

$var=explode("_",$var);


$id_contenido=$var[0];
$id_establecimientod=$var[1];



 /*$Sql ="DELETE FROM control_contenido_escuela 
 		where id_contenido ='$id_contenido' 
		and id_establecimiento='$id_establecimientod'";

 cms_query($Sql)or die ("ERROR Borrando en ajax  borra_perfil_contenido.php <br>$Sql");

 $query= "SELECT id_establecimiento    
           FROM  control_contenido_escuela
           WHERE id_contenido ='$id_contenido'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_establecimiento) = mysql_fetch_row($result)){
				
				
				$var_perf_cole="$id_contenido"."_$id_establecimiento";
				
				
				$nombre_establecimiento = establecimiento_nombre($id_establecimiento);
				$tabla_escuela .="<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp;$nombre_establecimiento  </td>
				<td align=\"center\" class=\"textos\" >
				<a href=\"#perfil_colegio\" onClick=\"sendcolegiocontenido('$var_perf_cole')\">
				<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
				</td></tr>";
				
		 }

		$tabla_escuela = "<br><div id=\"resultadoColCont\">
						<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                        <tr class=\"cabeza\">
                          <td align=\"center\" >Colegio</td>
                       <td align=\"center\" class=\"textos\"></td>
                        </tr>
						$tabla_escuela
                      </table></div>";

echo $tabla_escuela;*/
?>