<?php

	$os = explode(",", $valor);
	 //<input type="checkbox" name="#nombre_campo#" value="#valor_campo_pk#"  id="#nombre_campo#" #checked1#>#valor_campo_txt#
		     $query= "SELECT relacion   
	 	              FROM  auto_admin_campo
	 	              WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo'";
	 	     
	// echo "$query<br>";
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      if(list($tabla_relacion) = mysql_fetch_row($result)){
			  		  $query= "SELECT id_auto_admin
                       FROM  auto_admin
                       WHERE   tabla  ='$tabla_relacion'";
                 $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($id_auto_admin_rel) = mysql_fetch_row($result21);
				  
				  $campo_pk_rel = campo_pk_tabla($id_auto_admin_rel);
				  $campo_txt_rel= campo_txt($id_auto_admin_rel);
				  
				      $query= "SELECT $campo_pk_rel,$campo_txt_rel  
                             FROM  $tabla_relacion";
                       $result= cms_query($query)or die (error($query,mysql_error(),$php));
                        while (list($id_campo_pk_rel,$txt_campo_txt_rel) = mysql_fetch_row($result)){
						
									//echo "<br>$aEntidad $id_entidad encontrado:".$encontrado;
									$checked="";
									if(in_array($id_campo_pk_rel,$os)){
											$checked = "checked";
									}
									  
						
                  				$check_campo =str_replace("#nombre_campo#","$nom_campo"."[]",$html_form);	
								$check_campo =str_replace("#nombre_campo_class#","$nom_campo",$check_campo);	
								$check_campo =str_replace("#valor_campo_pk#","$id_campo_pk_rel",$check_campo);	
								$check_campo =str_replace("#valor_campo_txt#"," $txt_campo_txt_rel",$check_campo);	
								$check_campo =str_replace("#checked1#","$checked",$check_campo);	
								$check_campos .="<tr><td align=\"left\" class=\"textos\"> $check_campo</td></tr> \n";	   
                  		 
						 
						 }
			  	 $html_form = "  <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
				 					<tr><td align=\"right\" class=\"textos\">
									 <span style=\"cursor: pointer;  cursor: hand;\" onclick=\"todos('#nombre_campo#')\">Marcar todos</span> | 
  									  <span style=\"cursor: pointer;  cursor: hand;\" onclick=\"ninguno('#nombre_campo#')\">Marcar Ninguno</span>  
									 </td></tr> 
                                      $check_campos
                                  	</table>" ;
					
				
			  }else{
			  	
				 $html_form = "FALTA DEFINIR LA TABLA RELACION EN AUTOADMIN CAMPO $nom_campo";
				
				
			  }
       		   
			  
				
				
							
									
									

?>