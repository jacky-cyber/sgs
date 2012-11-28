<?php

$act_f = $_GET['act_f'];
$id_contenido = $_GET['id_contenido'];
$op = $_GET['op'];

$accion_galeria=7;

$tamanio_image =160;


if(!is_numeric($id_contenido)){
	
	$id_contenido = texto_to_id_noticia($id_contenido);
}

$query = "SELECT titulo,titulo_corto,contenido,id_imagen,id_tipo,fecha,fuente,visible,id_galeria,id_cliente,id_user,click,link,ptos,imprimir,amigo
          FROM noticias 
          WHERE id_noticia='$id_contenido'";
//echo "$query";

$resultado = cms_query($query) or die ("problemas en la consulta 1.2<br>$query");

list($titulo,$titulo_corto,$contenido2,$id_imagen2,$id_tipo,$fecha,$fuente,$opinable,$id_galeria,$id_cliente,$id_user,$click,$link,$ptos,$imprimir,$amigo) = mysql_fetch_row($resultado);
   
 
//echo "$id_galeria";
   $click++;
   
					$Sql ="UPDATE noticias 
                    	   SET id_user ='$id_usuario',click='$click'
                    	   WHERE id_noticia='$id_contenido'";
                    		
					//echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));


if($id_imagen2!=""){
	
$queryi = "SELECT imagen1,pie_esp
           FROM imagenes
           WHERE id_imagen = $id_imagen2";

          
//echo "$queryi";
$resultadoi = @cms_query($queryi) or die ("problemas en la consulta 2.<br>$queryi");


list($imagen,$pie) = mysql_fetch_row($resultadoi);
}
//echo "$imagen,$pie";

 if(is_file("images/news/$id_contenido/$imagen")){		// retorna un true si existe el archivo

           
		   		if($imagen!=""){
		   			
		 $imagen= "<a href=\"#\" onClick=\"MM_openBrWindow('$link','','width=$imgAncho,height=$imgAlto')\" >
	  <img src=\"contenido/imagen_chica.php?imagen=$imagen&tamanio_image=200&id_contenido=$id_contenido\"  align=\"left\" alt=\"$pie\" hspace=\"0\" vspace=\"0\" border=\"0\">
	    </a>
						";
		   			
		   			if($imagen!=""){


$link ="images/news/marca_p.php?foto=$imagen&id_contenido=$id_contenido";


// <img src=\"images/pretty_girl.gif\" width=\"200\" height=\"227\" hspace=\"0\" vspace=\"0\" border=\"1\">



$cuerpo_imagen = "


<table width=\"33%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  align=\"left\">
  <tr > 
    <td >
	<table  width=\"33%\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"16\"><img src=\"images/marc_foto/top_lef.gif\" width=\"16\" height=\"16\"></td>
      <td height=\"16\" background=\"images/marc_foto/top_mid.gif\"></td>
      <td width=\"24\"><img src=\"images/marc_foto/top_rig.gif\" width=\"24\" height=\"16\"></td>
    </tr>
    <tr>
      <td width=\"16\" background=\"images/marc_foto/cen_lef.gif\" align=\"center\" class=\"textos-chico\"></td>
      <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">
	   
	  $imagen
	 
	  </td>
      <td width=\"24\" background=\"images/marc_foto/cen_rig.gif\"></td>
    </tr>
    <tr>
      <td width=\"16\" height=\"16\"><img src=\"images/marc_foto/bot_lef.gif\" width=\"16\" height=\"16\"></td>
      <td height=\"16\" background=\"images/marc_foto/bot_mid.gif\"></td>
      <td width=\"24\" height=\"16\"><img src=\"images/marc_foto/bot_rig.gif\" width=\"24\" height=\"16\"></td>
    </tr>
	
	
  </table>
	</td>
  </tr>
  <tr > 
    <td align=\"center\" class=\"textos\">
	
	$pie</td>
  </tr>
</table>";

}
		   		}
		   
		   }


$fecha_aux = explode("-", $fecha);

$fecha = $fecha_aux[2].$fecha_aux[1].".".$fecha_aux[0];


//$contenido2 = nl2br($contenido2);

if($imprimir=="si"){

	
/*<a href="#" onclick="javascript:window.print(); return false;" title="Imprimir">
'<img src="images/printButton.png" alt="Imprimir" name="Imprimir" align="middle" border="0" />
</a>
*/	
	
 $imprimir_ico ="<a href=\"#\" onclick=\"javascript:window.print(); return false;\" title=\"Imprimir\">
<img src=\"images/printButton.png\" alt=\"Imprimir\" name=\"Imprimir\" align=\"middle\" border=\"0\"/></a>";

}

$estructura_noticia= html_template('estructura_noticia');
$estructura_noticia = str_replace("#TITULO#","$titulo",$estructura_noticia);
$estructura_noticia = str_replace("#TITULO_CORTO#","$titulo_corto",$estructura_noticia);
$estructura_noticia = str_replace("#CUERPO_IMAGEN#","$cuerpo_imagen",$estructura_noticia);
$estructura_noticia = str_replace("#CONTENIDO2#","$contenido2",$estructura_noticia);


$contenido .="
<link href=\"tienda/css/tienda.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"css/sitio.css\" rel=\"stylesheet\" tyspe=\"text/css\"/>
<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
							<tr>
      								<td align=\"right\" class=\"textos\">
      								$imprimir_ico
									
									</td>
							</tr>
				

                         
					
						  </table>$estructura_noticia";

$contenido .= $tabla ;

?>