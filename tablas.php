<?php
include("lib/connect_db.inc.php");
include("lib/lib.inc.php");
include("lib/lib.inc2.php");



 $tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
{

		$tabla = $line[0];
		
		 $sql = "SELECT * FROM $tabla";
  			$qry = cms_query($sql)or die (error($query,mysql_error(),$php));
   			$num_filas = mysql_num_fields($qry);
			
			
	$lista_campos="";
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
      $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	  $flag      = mysql_field_flags($qry,$i);
	  $largo     = mysql_field_len($qry,$i);
	  $tipo      = mysql_field_type($qry,$i);

	 
	$lista_campos .="$nom_campo#$tipo,";
							   

 
   
   }  		 
	  $lista_campos= elimina_ultimo_caracter($lista_campos);
			
   echo "$tabla,$num_filas,$lista_campos\n";
		
		
	
	
}

?>