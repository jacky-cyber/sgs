<?php

		

	
	$t = $_GET['t'];
	$tbl = $_GET['tbl'];
	
	switch ($t) {
         case 'e':
            echo  extrae_estructura($tbl,$DATABASE);
             break;
    	 case 'd':
		 	//$condicion = " Where ";
            echo extrae_datos_tabla($tbl,$condicion,$DATABASE);
             break;
       case 'c':
		 	  $query= "SELECT id_auto_admin   
                       FROM  auto_admin
                       WHERE tabla='$tbl'";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($id_a_a) = mysql_fetch_row($result);
				 
				 
				 
			$condicion = " Where id_auto_admin = $id_a_a";
            echo extrae_datos_tabla('auto_admin',$condicion);
            echo extrae_datos_tabla('auto_admin_campo',$condicion);
             break;
       
	   
	   case 'all':
	   
	    $tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
			{
				$tbla= $line[0];
		   	echo  extrae_estructura($tbla);
			}
	   
	   break;
	   
       	 default:
    	   //include ("proceso/lista.php");
     }
	
		
		
?>