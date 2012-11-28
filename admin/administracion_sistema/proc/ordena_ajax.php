<?php
 if($_GET['act']==""){
include("../../../lib/connect_db.inc.php");    
   


include("../../../lib/lib.inc.php");    
include("../../../lib/lib.inc2.php");    
//include("../../../lib/seguridad.inc.php"); 			
 }



		 
		 
$accion = $_GET['accion'];




$query= "SELECT id_auto_admin   
           FROM  acciones
           WHERE accion='$accion'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_auto_admin) = mysql_fetch_row($result);
	





  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($nom_tabla) = mysql_fetch_row($result);
						   
		  $query= "SELECT campo
                   FROM  auto_admin_campo
                   WHERE id_tipo_campo=1 and id_auto_admin='$id_auto_admin' and pk=1";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
        list($pk_campo) = mysql_fetch_row($result);




$orderArray = $_POST['listContainer'];


	$qry_insert="INSERT INTO error(query_error) values ('$orderArray')";
                  
  $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
	
$aux=explode("&", $var_arreglo);
$a=0;
$orderid = 1;
foreach($orderArray as $catid) {
			$catid = (int) $catid;
						
	$sql = "UPDATE $nom_tabla set orden='$orderid' WHERE $pk_campo='$catid'";

           cms_query($sql)or die (error($query,mysql_error(),$php));
			
	$orderid++;
	
   		
  
		
		}
		
	
while($a<$total){

$orden_x = explode("=", $aux[$a]);

$orden_final = $orden_x[1];

$sql = "UPDATE $nom_tabla set orden='$a' WHERE $pk_campo='$orden_final'";

    cms_query($sql)or die (error($query,mysql_error(),$php));
		
$a++;
}

 

?>