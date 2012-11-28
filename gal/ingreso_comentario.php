<?php
 
include("../lib/connect_db.inc");    


$galeria_id = $_POST['galeria_id'];

  $query= "SELECT id_imagen
           FROM  imagenes 
           WHERE id_galeria='$galeria_id'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_imagen) = mysql_fetch_row($result)){
						   
	
    
    $var = "nombre_$id_imagen";
    $nombre= $_POST[$var];

    $var = "mail_$id_imagen";
    $mail= $_POST[$var];
    
    $var = "comentario_$id_imagen";
    $comentario= $_POST[$var];

    $var = "imagen_id_$id_imagen";
    $id_imag= $_POST[$var];
    
   
    
    
  if($nombre!=""){
  	
  	// echo "nombre_$id_imagen = $nombre : mail_$id_imagen = $mail : comentario_$id_imagen= $comentario<br>";
  	
$qry_insert="INSERT INTO imagenes_comentarios(id_comentario,id_galeria,id_imagen,mail,nombre,comentario)  
			  values ('','$galeria_id','$id_imagen','$mail','$nombre','$comentario')";
              
 $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
// echo $qry_insert."<br>";

	      $query= "SELECT nombre,comentario     
		                       FROM imagenes_comentarios 
		                       WHERE id_galeria='$galeria_id' and id_imagen = $id_imagen";
	      
	     
		                 $result_i= cms_query($query)or die (error($query,mysql_error(),$php));
		                  while (list($nombre,$comentario) = mysql_fetch_row($result_i)){
		            			
		                  	$comentario_txt .= "<tr>
		                  						<td align=\"left\" valign=\"top\" width=\"20%\" class=\"textos\"><b>$nombre</b> </td>
		                  						<td align=\"left\" valign=\"top\" width=\"2\" class=\"textos\">:</td>
		                  						<td align=\"left\" class=\"textos\">$comentario</td>
		                  						</tr> ";
		            		 }
		              
		           	
		             	echo  "
							<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\">
					            	$comentario_txt	  
					            	<tr>
		                  						<td align=\"left\"  class=\"textos\" colspan=\"3\">
		                  						
		                  						
		                  						<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	<tr>
	<td align=\"center\"  class=\"textos\" colspan=\"3\">
	
	
	
			</td>
		                  						
		    </tr>		     
	<tr>
	<td align=\"center\"  class=\"textos\" colspan=\"3\"><br>
		                  						
			<b>Agrega un comentario a esta foto:</b>
			</td>
		                  						
		    </tr>		     
			<tr>
				<td align=\"center\"  class=\"textos\" colspan=\"3\">&nbsp;</td>
		                  						
		    </tr>		     
			<tr >
		       <td align=\"left\" class=\"textos\">Nombre</td>
		       <td align=\"left\" class=\"textos\">
		       <input type=\"text\" name=\"nombre_$id_imagen\" class=\"inp2\" id=\"nombre_$id_imagen\">
		       </td>
		       <td align=\"center\" class=\"textos\"> &nbsp;</td>
		       </tr>
		 	 <tr >
		       <td align=\"left\" class=\"textos\" >Mail</td>
		       <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"mail_$id_imagen\" class=\"inp2\"></td>
		       <td align=\"center\" class=\"textos\"> &nbsp;</td>
		       </tr>
		 	 <tr >
		       <td align=\"left\" class=\"textos\">Comentario</td>
		       <td align=\"left\" class=\"textos\"><textarea name=\"comentario_$id_imagen\" cols=\"30\" rows=\"3\" class=\"inp2\"></textarea></td>
		       <td align=\"center\" class=\"textos\"> &nbsp;</td>
		       </tr>
		       <tr>
		       <td align=\"center\"  class=\"textos\" colspan=\"3\" height=\"27\" >
		       <input type=\"submit\"  name=\"bot_image_$id_imagen\" value=\"Agregar Comentario...\" class=\"boton\" >
		        </td>
		        <td align=\"center\" class=\"textos\"> &nbsp;
		        <input type=\"hidden\" name=\"imagen_id_$id_imagen\" value=\"$id_imagen\">
		        </td>          						
		     </tr>
		 	</table>
		 	
		        	      
		        	      </td>
		        	      </tr>
		        
		        		</table>
		                  						
		                  						 </td>
		                  						
		                  						</tr> 
		                  						 
		            		 	  </table> ";
		            		 
		            		 
		           
		           
  

		        	 


  }
    
    
  
 }



?>