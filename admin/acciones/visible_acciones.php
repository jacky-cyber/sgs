<?php
  

   $query= "SELECT home
            FROM  acciones
            WHERE accion='$id'";
   
   //echo "$query<br>";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
       list($home) = mysql_fetch_row($result);
    

$Sql ="UPDATE acciones 
	   SET home ='$cambia'
	   WHERE accion ='$id'";

//echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
	   
	  
	   header("Location:?accion=$accion&act=0&id_gru=$id_gru");

						

?>