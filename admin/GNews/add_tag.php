<?php

$id_contenido = $_GET['id_contenido'];

if($id_contenido!=""){


	  
	  if($_POST['nuevo_tag']!=""){
	  
	  $tag_nuevo =$_POST['nuevo_tag'];
      $qry_insert="INSERT INTO tags(id_tag,tag) values (null,'$tag_nuevo')";
                    
      $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
	  
	  $id_tag= mysql_insert_id();
	  
	          $qry_insert="INSERT INTO contenido_tag(id_contenido_tag ,id_tag,id_contenido )
			       values (null,'$id_tag','$id_contenido')";          
                        $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
	 
	  
	  }
	  
}
?>