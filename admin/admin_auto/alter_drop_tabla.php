<?php

$tabla = $_GET['tbl'];
$bd_org = $_GET['bd_org'];
$bd_des = $_GET['bd_des'];
$campo = $_GET['campo'];


		         $create .='ALTER TABLE ' .  $bd_org.'.'.$tabla . ' DROP '. $campo.' ' ; 
		     	
				$DB2 = @mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD) ;	
				@mysql_select_db($bd_org, $DB2);	
				@cms_query($create);
				
				
				if($DATABASE==$bd_org){
					$bd = $bd_des;
				}else{
					$bd= $bd_org;
				}
				
            header("Location:index.php?accion=$accion&act=9&tbl=$tabla&bd=$bd");	   

	
?>