<?php



  $query= "SELECT id_tag,tag   
           FROM  tags";
     $result= mysql_query($query)or die ("ERROR $php <br>$query");
      while (list($id_tag,$tag) = mysql_fetch_row($result)){
	  		
			
			  $query= "SELECT id_contenido_tag   
                       FROM  contenido_tag
                       WHERE id_tag='$id_tag' and id_contenido='$id_contenido'";
                 $result22= mysql_query($query)or die ("ERROR $php <br>$query");
                list($id_contenido_tag) = mysql_fetch_row($result22);
				if($id_contenido_tag!=""){
				
				$checked = "checked";
				
				}else{
				$checked = " ";
				
				}
			
	  
			$lista_tag .=" <tr><td align=\"left\" class=\"textos\">
			              <input type=\"checkbox\" name=\"$tag"."_tag\" value=\"1\" $checked onclick=\"ObtenerDatos('index.php?accion=$accion&act=6&id_tag=$id_tag&id_c=$id_contenido&axj=1','noticias_relacionadas');\";>$tag </td></tr> ";   
		 }
include ("admin/GNews/noticias_relacionadas.php");
		 
	$tabla_tag = "  <div id=\"resultado\">
	<tr>
			 <td align=\"left\" class=\"textos\" >
			 
			 
			 <table width=\"150\"  border=\"0\"  cellpadding=\"2\" cellspacing=\"2\">
                             <tr >
                               <td align=\"center\" class=\"textos\">Nuevo Tag</td>
                               </tr>
                         	 <tr >
                               <td align=\"center\" class=\"textos\">
							   <input type=\"text\" name=\"nuevo_tag\">
							   </td>
                               </tr>
                         	 <tr >
                               <td align=\"center\" class=\"textos\">
							   
							   <table width=\"150\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
             <tr >
               <td align=\"center\" class=\"textos\">TAGS</td>
               </tr>
			   $lista_tag
         	</table>
			</td>
                 </tr>
		 <tr><td align=\"center\" class=\"textos\">
		<!--  </div> esto fue movido al modulo noticias relacionadas    -->
		 </td></tr> 
          </table>
	  </td>
			 <td align=\"center\" class=\"textos\">
			 <div id=\"noticias_relacionadas\">
			 $noticias_relacionadas
			 </div>
			 </td> 
			 </tr>
			 </div>
			 ";
			
			
		 

?>