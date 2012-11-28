<?php

$registros_form="";


if($id_r!=""){
	echo "<input type=\"hidden\" name=\"id_r\" value=\"$id_r\">";
	

}


//formulario
$nom_campo_form = $_POST['nom_campo_form'];
$html_form= $_POST['html_form'];
$nom_campo_tabla = $_POST['nom_campo_tabla'];




  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin_tabla'";
  //echo $query;
     $result= cms_query($query)or die ("ERROR $php  1 formulario_tabla.php linea 115<br>$query");
      if (list($nom_tabla) = mysql_fetch_row($result)){

   
      	   
			$query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin_tabla and id_tipo_campo=1
				   order by id_campo";
             $result= cms_query($query)or die ("ERROR $php  1 formulario_tabla.php linea 128<br>$query");
             list($pk_campo) = mysql_fetch_row($result);
             
   	
             
     if($id!=""){
     	$condicion= "where $pk_campo=$id";
     }
             	
 $sql = "SELECT * FROM $nom_tabla
 			$condicion
			 LIMIT 0,1";

 
  $qry = cms_query($sql);
  
   $num_filas = @mysql_num_fields($qry);
   

   $query= "SELECT formulario   
                FROM  auto_admin 
                WHERE id_auto_admin='$id_auto_admin_tabla'";
          $result= cms_query($query)or die ("ERROR $php  1 formulario_tabla.php linea 146<br>$query");
          list($formu) = mysql_fetch_row($result);
			 
			    
	
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	 
   
    
    
      $query= "SELECT id_tipo_campo
               FROM  auto_admin_campo
               WHERE id_auto_admin='$id_auto_admin_tabla' and campo='$nom_campo' ";     
         //  echo "$query<br>"; 
         $result= cms_query($query)or die ("ERROR $php  1 formulario_tabla.php linea 161<br>$query");
          list($id_tipo_campo) = mysql_fetch_row($result);

             
     if($id_tipo_campo!=1 and $id_tipo_campo!=""){//id_tipo_campo=8 ya que es un PK en la tabla auto_admin_tipo_campo  
   	
    
      $query= "SELECT html ,js, visible
               FROM  auto_admin_tipo_campo
               where id_tipo_campo= '$id_tipo_campo'";
    //  echo "$query<br>"; 
             
         $result33= cms_query($query)or die ("ERROR $php  1 formulario_tabla.php linea 172<br>$query");
         list($html_form,$js_html, $visible) = mysql_fetch_row($result33);
         
         
   		
   		$query= "SELECT $nom_campo
                 FROM $nom_tabla
                $condicion";
   		
   		//echo "<br> $query <br>";
     $resultff= @cms_query($query)or die ("ERROR $php  1 formulario_tabla.php linea 182<br>$query");
	 $valor_nom_campo= @mysql_result($resultff,0);
	 
	 
    if($js_html!=""){
    	
       $js_form= str_replace("#nom_campo#","$nom_campo","$js_html");
        $js_html_form .=$js_form."\n\n";
         //
     }			 
   		  
	if($id!=""){
	
		
		
		
	//echo "hola";
	$html_form= html_form2($html_form,$nom_campo,$id_tipo_campo,$id_auto_admin_tabla,$valor_nom_campo,$DATABASE,$id,$id_r);


	  
	
   // $html_form= str_replace("#valor_campo#","$valor_campo",$html_form); 
  }else{

  		
//echo "$html_form,$nom_campo,$id_tipo_campo,$id_auto_admin_tabla,$valor_nom_campo,$DATABASE,$id,$id_r";
  $html_form= html_form2($html_form,$nom_campo,$id_tipo_campo,$id_auto_admin_tabla,$valor_nom_campo,$DATABASE,$id,$id_r);
	
	
  	$html_form= str_replace("#nombre_campo#","$nom_campo",$html_form);
  	//$html_form=str_replace("#valor_campo#","$valor_campo",$html_form); 
  }

  

    $nom_campo_form= str_replace("id_","",$nom_campo);

    $nom_campo_form= str_replace("_"," ",$nom_campo_form);
    
    $nom_campo_form = ucwords($nom_campo_form);//para poner mayusculas
        
     
	 


			 
			 
	 if($formu!=""){
	 
	 $formu = str_replace("#$nom_campo#",$html_form,$formu);
	 
 
	
	 
	 }else{
	 	
	 		
	 
	 $tabla = busca_tabla2($nom_campo,$DATABASE);     		 
$tabla_mandatoria = tabla_mandatoria($id_auto_admin_tabla);


if($tabla != $tabla_mandatoria){
	

	  		  if($visible!=1){
	  		  
   
    			$registros_form .= "<tr>
                         <td align=\"left\" class=\"textos\" valign=\"top\">&nbsp;&nbsp;$nom_campo_form</td>
                         <td align=\"left\" class=\"textos\">&nbsp;&nbsp;$html_form</td>                         
                    </tr>";
   
   					}else{
   				$registros_form .= "<tr>
                         <td align=\"left\" class=\"textos\" valign=\"top\">&nbsp;&nbsp;</td>
                         <td align=\"left\" class=\"textos\">&nbsp;&nbsp;$html_form</td>                         
                    </tr>";
   				}
	 
	 }else{
	 	
	 	   $registros_form .="<tr>
	 	                    <td align=\"left\" class=\"textos\" colspan=\"2\">
	 	                    <input type=\"hidden\" name=\"$nom_campo\" value=\"$id\"></td></tr>";
	 	
	 }
	      
}
     
   
   }  
  } 	
 }
 
 
 
 if($formu!=""){
 /*
 $js2 .="<script type=\"text/javascript\">
$js_html_form

</script>";

$contenido.=  "
 
            
            $formu
               
            $js2";
 */
 }else{
 
 $js2 .="<script type=\"text/javascript\">
$js_html_form

</script>";

$contenido .=  "
 <br><br>
            <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">

           <tr><td align=\"center\" class=\"cabeza_rojo\" colspan=\"2\">$nom_tabla </td></tr> 
            $registros_form
               
                <tr>
                         <td align=\"center\" class=\"textos\"></td>
                         <td align=\"center\" class=\"textos\">
                         <input type=\"submit\" name=\"Submit\" value=\"Aceptar\"></td>
                </tr>
                <tr>
                         <td align=\"center\" class=\"textos\">&nbsp;</td>
                         <td align=\"center\" class=\"textos\">&nbsp;</td>                        
                </tr>
 	       </table>$js2";
 
 
 }
 

 



?>