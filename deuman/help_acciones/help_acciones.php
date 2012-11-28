<?php

$acci = $_GET['acci'];
$c = $_GET['c'];


if($acci!=""){
	if(!is_numeric($acci)){
		$acci = traduce_accion($acci);	
	}


    $query= "SELECT help  
           FROM  acciones
           WHERE accion='$acci'";
		//echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($contenido) = mysql_fetch_row($result);
	  
	  
	  $contenido = "  <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr >
                          <td align=\"left\" class=\"textos\">$contenido <br></td>
                          </tr>
                    	</table>";
}




						
 if($c!=""){
 $contenido_noticia = contenido_noticia($c);
 $contenido_noticia= utf8_encode(acentos_inverso($contenido_noticia));

  $contenido = "  <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"4\" cellspacing=\"4\">
                        <tr >
                          <td align=\"left\" class=\"textos\">$contenido_noticia<br></td>
                          </tr>
						 </table>";		
}
	
		
	
?>