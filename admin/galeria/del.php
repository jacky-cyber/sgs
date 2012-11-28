<?php
$id_galeria = $_GET['id_galeria'];

  $query= "SELECT id_cliente
           FROM  galerias
		   where id_galeria=$id_galeria";
		   
   $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 
      list($id_cliente) = mysql_fetch_row($result);


 $dir = opendir("$fuente_relativa/$id_cliente/$id_galeria/"); 
			$i = 0;
			while ($images[$i][0] = readdir($dir)){
				if($images[$i][0]!="." and $images[$i][0]!=".."){
				unlink("$fuente_relativa/$id_cliente/$id_galeria/".$images[$i][0]);
				
				}				 
			 
			}

			@rmdir("$fuente_relativa/$id_cliente/$id_galeria");
		 
		 
		  $Sql ="DELETE FROM imagenes where id_galeria='$id_galeria'";

 cms_query($Sql); 


		   $Sql ="DELETE FROM galerias where id_galeria='$id_galeria'";

 cms_query($Sql);
			
			header("HTTP/1.0 307 Temporary redirect");
            header("Location:index.php?accion=$accion");
?>