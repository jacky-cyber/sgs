<?php


/*
 * Select tabla contenido_tag
 * 
 */

//$id_contenido  = $_GET['id_contenido'];

$query= "SELECT id_tag  
           FROM  contenido_tag
           WHERE id_contenido = '$id_contenido'";
           //echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tag) = mysql_fetch_row($result)){
			$id_tags .="$id_tag,";			   
		 }
     $id_tags = elimina_ultimo_caracter($id_tags);
     
/** fin select contenido_tag***/


/*
 * Select tabla contenido_tag
 * 
 */

if($id_tags!=""){
    
    
 $query= "SELECT DISTINCT id_contenido    
           FROM  contenido_tag
           WHERE  id_tag in ($id_tags) and id_contenido<>'$id_contenido'";
          
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_contenido_tag  ) = mysql_fetch_row($result)){
                
				    /*
				    * Select tabla noticias
				    * 
				    */
				   $query= "SELECT titulo  
					      FROM  noticias
					      WHERE id_noticia = '$id_contenido_tag'";
					$result_noticias= cms_query($query)or die (error($query,mysql_error(),$php));
					list($titulo) = mysql_fetch_row($result_noticias);
				   /** fin select noticias***/
						   
					$lista_not_rel .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
								   <td align=\"left\" class=\"textos\">$titulo</td></tr> ";				   
		 }


/** fin select contenido_tag***/
$noticias_relacionadas = " <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro_light\">
                  <tr>
                    <td align=\"center\" class=\"textos\"><strong>Lista de noticias relacionadas</strong>
                    </td>
                  </tr>
                  $lista_not_rel
                </table>";   
}



?>