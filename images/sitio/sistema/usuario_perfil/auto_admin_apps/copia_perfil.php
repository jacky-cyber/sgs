<?php

    $query= "SELECT id_perfil,perfil
           FROM  usuario_perfil";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_perfil_c,$perfil) = mysql_fetch_row($result)){
			$lista_perfiles .="<option value=\"$id_perfil_c\">$perfil</option>";			   
		 }


$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Seleccione Perfil Clonar 
				  <select name=\"id_perfil_c\" id=\"id_perfil_c\">
                                                                                 
                    <option value=\"\">Seleccione perfil</option>
                      $lista_perfiles
					</select></td>
                </tr>
              <tr>
                  <td align=\"center\" class=\"textos\">Ingrese nuevo Perfil <input type=\"text\" name=\"nuevo_perfil\" id=\"nuevo_perfil\"></td>
                </tr>
				<tr><td align=\"center\" class=\"textos\"><input type=\"submit\" name=\"Submit\" value=\"Enviar\"> </td></tr> 
              </table>";

			  
	$id_perfil_c = $_POST['id_perfil_c'];
		
	$nuevo_perfil = $_POST['nuevo_perfil'];	  
	
	if($id_perfil_c!="" and $nuevo_perfil!=""){
	    
	    
	    
		  $query= "SELECT perfil,url_defecto,activo,icono   
               FROM  usuario_perfil
               WHERE id_perfil='$id_perfil_c'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($perfil,$url_defecto,$activo,$icono) = mysql_fetch_row($result)){
    			
				
                $qry_insert="INSERT INTO usuario_perfil(perfil,url_defecto,activo,orden,icono) 
							values ('$nuevo_perfil','$url_defecto','$activo','$orden','$icono')";
                // echo $qry_insert."<br>";             
               $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
				$id_nuevo_perfil = mysql_insert_id();		   
    		 }
	
	
	
	    $query= "SELECT accion   
               FROM  accion_perfil
               WHERE id_perfil='$id_perfil_c'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($acc) = mysql_fetch_row($result)){
    				
				   $qry_insert="INSERT INTO accion_perfil(id_perfil,accion) values ('$id_nuevo_perfil','$acc')";
                    //  echo $qry_insert."<br>";             
                    $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
					
							   
    		 }
			 
			 
			 $contenido .=cuadro_verde('Perfil Clonado');
	
	}
	
	
	  
	
?>