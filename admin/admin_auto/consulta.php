<?php
$tbl= $_GET['tbl'];
  $query= "SELECT id_auto_admin   
           FROM  auto_admin
           WHERE tabla='$tbl'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (!list($id_auto_admin) = mysql_fetch_row($result)){
			
            $qry_insert="INSERT INTO auto_admin(id_auto_admin,tabla,accion) values (null,'$tbl','$accion')";
            
			              
                     $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");	 
					 
					 
 $sql = "SELECT * FROM $tbl";
  $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);


   
 for ($i = 0; $i < $num_filas; $i++){
    $nom_campo = mysql_field_name($qry,$i);
	$flag      = mysql_field_flags($qry,$i);
	$largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);

	
	 
	   $query= "SELECT id_tipo_campo   
                FROM  auto_admin_combinacion
                WHERE flag='$flag' and tipo='$tipo' and largo='$largo' ";
          $result2= cms_query($query)or die (error($query,mysql_error(),$php));
           list($id_tipo_campo) = mysql_fetch_row($result2);
     						   
     $id_auto_admin = mysql_insert_id();		 

$qry_insert="INSERT INTO auto_admin_campo( id_campo,campo,id_tipo_campo,relacion,id_auto_admin,js,carpeta ) values 
(null,'$nom_campo','$id_tipo_campo','','$id_auto_admin','','')";
              
                $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");

	 
}
	
	
	
					 
					 		   
		 }else{
		 echo "<script>alert('La tabla ya esta configurada'); document.location.href='index.php?accion=$accion';</script>\n";
}

		
		
		$nom_tabla=$tbl;




?>