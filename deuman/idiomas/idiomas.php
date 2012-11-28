<?php

    $query= "SELECT id_idioma,idioma,sigla,bandera
           FROM  deuman_idioma
           WHERE activo='1'
		   order by orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_idioma,$idioma,$sigla,$bandera) = mysql_fetch_row($result)){
			$lista_banderas.="<a class=\"header_banderas\" href=\"index.php?lng=$sigla\">$idioma</a>&nbsp;/&nbsp;";			   
		 }
//<img src=\"images/sitio/sistema/deuman_idioma/bandera/$id_idioma/$bandera\" alt=\"$idioma\" border=\"0\"></a>
		$lista_banderas = substr ($lista_banderas, 0, strlen($texto) - 13);						
$lista_banderas ="<div class=\"header_banderas\" align=\"right\">$lista_banderas</div>";
	

 
?>