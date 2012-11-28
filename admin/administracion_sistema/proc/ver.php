<?php


  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($nom_tabla) = mysql_fetch_row($result)){

      	
      	   
			$query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
			
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
             
   	
             
     if($id!=""){
     	$condicion= "where $pk_campo=$id";
     }
             	
 $sql = "SELECT * FROM $nom_tabla
 			$condicion
			 LIMIT 0,1";
 
 //echo $sql;
  $qry = cms_query($sql);
  
   $num_filas = mysql_num_fields($qry);
   

   $query= "SELECT formulario   
                FROM  auto_admin 
                WHERE id_auto_admin='$id_auto_admin'";
  
   
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($formu) = mysql_fetch_row($result);
			 
			 
			 
   
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	
    
    
      $query= "SELECT id_tipo_campo,campo_relacion
               FROM  auto_admin_campo
               WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo' and id_tipo_campo<>7";     
        //  echo "$query<br>"; 
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_tipo_campo,$campo_relacion) = mysql_fetch_row($result);

          //echo "$nom_campo -->." .$campo_relacion."    $id_tipo_campo<br>";
     if($id_tipo_campo!=1 and $id_tipo_campo!="" ){//id_tipo_campo=8 ya que es un PK en la tabla auto_admin_tipo_campo  
   	
 
   		
   		$query= "SELECT $nom_campo
                 FROM $nom_tabla
                $condicion";
   		
   		//echo "<br> $query <br>";
     $resultff= @cms_query($query)or die (error($query,mysql_error(),$php));
	 $valor_nom_campo= @mysql_result($resultff,0);
	  
	 
	 
    if($js_html!=""){
    	
       $js_form= str_replace("#nombre_campo#","$nom_campo","$js_html");
       //echo $js_form;
        $js_html_form .=$js_form."\n\n";
       //echo $js_html_form;
     }			 
   	
  if($id!=""){
		
		switch ($id_tipo_campo) {
             case 1: //PK
                 //include ("contenido/contenido.php");
                 break;
        	 case 4://text
                 if($valor_nom_campo==1){
				 $valor_nom_campo='si';
				 }else{
				 $valor_nom_campo='no';
				 }
                 break;
           	 case 5://text
                	
			  $os = explode(",", $valor_nom_campo);
	 //<input type="checkbox" name="#nombre_campo#" value="#valor_campo_pk#"  id="#nombre_campo#" #checked1#>#valor_campo_txt#
		     $query= "SELECT relacion   
	 	              FROM  auto_admin_campo
	 	              WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo'";
	 	     
	// echo "$query<br>";
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($tabla_relacion) = mysql_fetch_row($result);
       		   
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
											//$checked = "checked";
											$check_campos .="$txt_campo_txt_rel ,";
									}
									  
						 }
				  
				 $valor_nom_campo = trim($check_campos);
				 $valor_nom_campo= elimina_ultimo_caracter($valor_nom_campo);
					
                 break;
			 case 6://text
               
				
	      $query= "SELECT id_auto_admin
	 	              FROM  auto_admin_campo
	 	              WHERE pk='1' and campo='$nom_campo'";
	 	
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      if(!list($id_auto_admin_tabla_relacion) = mysql_fetch_row($result) ){
			  	
				
				
				
	 	      	if($campo_relacion!=""){}
					 
					     $query= "SELECT id_auto_admin
	 	              		      FROM  auto_admin_campo
	 	              			  WHERE pk='1' and campo='$campo_relacion'";
								// echo $query." -->$nom_campo<br>";
                         $result= cms_query($query)or die (error($query,mysql_error(),$php));
                         list($id_auto_admin_tabla_relacion) = mysql_fetch_row($result);
                    											   
                    		 
				
			
			  }
       		   
			    $query= "SELECT tabla
                       FROM  auto_admin
                       WHERE   id_auto_admin  ='$id_auto_admin_tabla_relacion'";
                 $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tabla_relacion) = mysql_fetch_row($result21);
				  
				  $campo_pk_rel = campo_pk_tabla($id_auto_admin_tabla_relacion);
				  $campo_txt_rel= campo_txt($id_auto_admin_tabla_relacion);
				  		$valor_pk = $valor_nom_campo;
						if($campo_pk_rel!="" and $campo_txt_rel!="" and $tabla_relacion!=""){
						$query= "SELECT $campo_txt_rel  
                             FROM  $tabla_relacion
							 WHERE $campo_pk_rel='$valor_pk'";
                         $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      	 list($txt_campo_txt_rel) = mysql_fetch_row($result);
					  
							
						 $valor_nom_campo = $txt_campo_txt_rel ;
				
						}
				      
                 break;
			case 9://text
               	 $valor_nom_campo = fechas_html($valor_nom_campo);
                 break;
            case 10://text
               	 if($valor_nom_campo==1){
				 $valor_nom_campo='Mujer';
				 }else{
				 $valor_nom_campo='Hombre';
				 }
                 break;
          
           case 19://text
               	 $query= "SELECT id_auto_admin  
	 	              FROM  auto_admin_campo
	 	              WHERE pk='1' and campo='$nom_campo'";
	 	   
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($id_auto_admin_tabla_relacion) = mysql_fetch_row($result);
       		   
			    $query= "SELECT tabla
                       FROM  auto_admin
                       WHERE   id_auto_admin  ='$id_auto_admin_tabla_relacion'";
                 $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tabla_relacion) = mysql_fetch_row($result21);
				  
				  $campo_pk_rel = campo_pk_tabla($id_auto_admin_tabla_relacion);
				  $campo_txt_rel= campo_txt($id_auto_admin_tabla_relacion);
				  		$valor_pk = $valor_nom_campo;
				      $query= "SELECT $campo_txt_rel  
                             FROM  $tabla_relacion
							 WHERE $campo_pk_rel='$valor_pk'";
                       $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      list($txt_campo_txt_rel) = mysql_fetch_row($result);
					  
							
				 $valor_nom_campo = $txt_campo_txt_rel ;
			
                 break;
               case 7://text
               	 $visible=1;
                 break;
		       case 18://text
               	 $visible=1;
                 break;
		
           
           	 
           	default:
			//id_tipo_campo 2,3,7,8,11,12,13,14,15,16,17
                
         }
		 
	

	$valor_nom_campo = trim($valor_nom_campo);
	$html_form= $valor_nom_campo;
	
    
  }

    $nom_campo_form= str_replace("id_","",$nom_campo);
//echo $nom_campo_form;
    $nom_campo_form= str_replace("_"," ",$nom_campo_form);
    
    $nom_campo_form = ucwords($nom_campo_form);//para poner mayusculas
        
    
	  		  if($visible!=1){
			  // $id_tipo_campo =16 fckeditor
			  	if($id_tipo_campo !=16 and $id_tipo_campo !=17 and $id_tipo_campo!=3){
				$registros_form .= "<tr >
                         <td align=\"left\" valign=\"top\"><strong>$nom_campo_form </strong></td>
                         <td align=\"left\" class=\"textos\" >:&nbsp;$html_form</td>
						                           
                    </tr>";
				
				}else{
				$html_form= acentos($html_form);
				$registros_form .= "<tr>
						      <td colspan=\"2\" align=\"left\"  valign=\"top\">
							    <strong>$nom_campo_form : </strong>
							</td>
						      </tr>
						    <tr>
							<td align=\"left\" colspan=\"2\" >
							<i>$html_form</i></td>
						    </tr> ";
				}
   
    			
   
   					}
	 
	
   }  
  } 	
 }
 
 
$datos_registro =  "<table   class=\"table table-striped\">
            		  
            			$registros_form
            	  </table>";
 
 





?>