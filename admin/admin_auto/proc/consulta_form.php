 <?php
  $query= "SELECT formulario   
           FROM  auto_admin 
           WHERE id_auto_admin ='$id_auto_admin'";
  
  
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($formulario) = mysql_fetch_row($result);

?>