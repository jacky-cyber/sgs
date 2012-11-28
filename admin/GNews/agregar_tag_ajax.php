<?php

$id_tag= $_GET['id_tag'];
$id_c = $_GET['id_c'];


/*
 * Select tabla contenido_tag
 * 
 */
if($id_c!=""){
  $query= "SELECT id_contenido_tag  
           FROM  contenido_tag
           WHERE id_tag = '$id_tag' and id_contenido='$id_c'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if(list($id_contenido_tag) = mysql_fetch_row($result)){
                
        $Sql ="DELETE FROM contenido_tag where id_contenido='$id_c' and id_tag= '$id_tag'";
          cms_query($Sql) or die (error($Sql,mysql_error(),$php));
                					   
     }else{
        
        $qry_insert="INSERT INTO contenido_tag(id_contenido_tag,id_tag,id_contenido)
        values (null,'$id_tag','$id_c')";
              
        $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
      
          
     }
     // $contenido = "Cambio realizado";
     $id_contenido = $id_c;
     include ("admin/GNews/noticias_relacionadas.php");
     echo $noticias_relacionadas;
     
/** fin select contenido_tag***/  
    
}




?>