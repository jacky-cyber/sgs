<?php


					$query= "SELECT id_categoria   
                           FROM  sgs_solicitud_acceso_categoria
                           WHERE folio='$folio' ";
                     $result_sol_cat= mysql_query($query)or die (error($query,mysql_error(),$php));
                      while(list($id_categorias) = mysql_fetch_row($result_sol_cat)){
					   $query= "SELECT id_categoria,categoria   
                            FROM  sgs_solicitud_categoria
                            WHERE id_categoria ='$id_categorias'";
                      $result_cat= mysql_query($query)or die (error($query,mysql_error(),$php));
                       while (list($id_categoria,$categoria) = mysql_fetch_row($result_cat)){
					   
                 			$lista_categorias_folio .= "<li id=\"id_cat_$id_categoria\" class=\"link_cat\">$categoria </li>";		   
                 		 }
					  }	
					  
					  if($lista_categorias_folio!=""){
					  	$css .="<style>
								#div_categorias ul {
								 
								  list-style-type: none;
								  padding-left: 0;
								}
								#div_categorias li{
									float: left;
									padding : 5px;
									
								}
								#div_categorias ul li a:hover {
								  text-decoration: none;
								
								  
								}
                        </style>";
						
					  $lista_categorias_folio = "
					  <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
		
		
                <tbody><tr>
					<th colspan=\"6\">Categor&iacute;as de la solicitud </th>
				</tr>
                <tr style=\"border-top: 1px solid rgb(193, 218, 215);\">
                  
                    <td colspan=\"6\"> <div id=\"div_categorias\"><ul >
						$lista_categorias_folio</ul></div></td>

                </tr>
		</tbody>
	</table>";
					  }
		

?>