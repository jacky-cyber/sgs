<?php


$HOST_NAME="localhost"; // por lo general es localhost puede ser otra configuracion pero depende del server 
$DB_USERNAME="root";  //usuarios con permisos en la base
$DB_PASSWORD=""; //pass del usuario
$DATABASE="test2"; //nombre de la base de datos 


$DB = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD) or die("0:No se pudo conectar a una base de datos");
mysql_select_db($DATABASE, $DB) or die("1:No se pudo seleccionar una base de datos");



function alter($tabla,$campo,$tipo){


switch ($tipo) {
     case 'int':
         $create ="ALTER TABLE $tabla ADD $campo INT NULL ";
         break;
	 case 'date':
         $create ="ALTER TABLE $tabla ADD $campo date NOT NULL default '0000-00-00' ";
         break;
    case 'string':
         $create ="ALTER TABLE $tabla ADD $campo varchar(255) NOT NULL ";
        
         break;
	 case 'blob':
         $create ="ALTER TABLE $tabla ADD $campo TEXT NOT NULL ";
        
         break;
		 
		  
   	default:
	   $def ="ok";
	 
       
 }
 
 return $create;

}




include("lib/lib.inc.php");
include("lib/lib.inc2.php");




	$fp=fopen("tablas.txt","r");
    
    
    
    while ($linea=fgets($fp,1024))
          {
		  
		  $caracteres_lines = strlen($linea);
          $aux=explode(",", $linea);
    
          $tabla    = trim($aux[0]);
          $num_campos    = trim($aux[1]);
    	  
		  $sql = "SELECT * FROM $tabla";
  			if($qry = cms_query($sql)){
			 $num_filas = mysql_num_fields($qry);
			
		 if($num_filas!=$num_campos){
		echo "-- $tabla txt - $num_campos   tabla - $num_filas<br>";
		//$cont_campos_tabla=2;
		$a=0;
		$b=2;
		while($a<$num_campos){
		$campo_txt_aux = trim($aux[$b]);
		 $aux3=explode("#", $campo_txt_aux);
		$campo_txt =  trim($aux3[0]);
		$tipo_campo_txt =  trim($aux3[1]);
		//echo "$a $campo_txt <br>";
		$a++;
		$b++;
			
			$cont_a=0;
			$campo_ok="ok";
			while ($cont_a<$num_filas){
			
				$nom_campo = mysql_field_name($qry,$cont_a);	
				$tipo      = mysql_field_type($qry,$cont_a);
				//echo "&nbsp;&nbsp;&nbsp;&nbsp; $campo_txt --> $nom_campo<br>";
				if($campo_txt==$nom_campo){
					$campo_ok="no";
				}
				$cont_a++;
			}
			if($campo_ok=="ok"){
			//echo "-------Campo creado $campo_txt $tipo<br>";
			$alter =alter($tabla,$campo_txt,$tipo_campo_txt);
			echo $alter ."<br>";

 cms_query($alter);
			
			}
		 	//echo "<br><br><br>";
		
		  }
	
		 
		 }
	
			
			}else{
		 echo "<font color=\"#FF0000\">$tabla no existe<br></font> ";
		 $link = "http://localhost/sgs/tablag.php?tabla=$tabla";
		
		 $fp2=fopen("$link","r");
		 
		 $create = fgets($fp2,1024);

 cms_query($create);
		 echo $create."<br>";
		 
		 }
   			
	
 			
			  	   
			
		
    	
		}	
			
			
			
			


/*


 $tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
{

		$tabla = $line[0];
		
		 $sql = "SELECT * FROM $tabla";
  			$qry = cms_query($sql)or die (error($query,mysql_error(),$php));
   			$num_filas = mysql_num_fields($qry);
			
			
	$lista_campos=""		  ;
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
      $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	  $flag      = mysql_field_flags($qry,$i);
	  $largo     = mysql_field_len($qry,$i);
	  $tipo      = mysql_field_type($qry,$i);

	 
	$lista_campos .="$nom_campo,";
							   

 
   
   }  		 
	  $lista_campos= elimina_ultimo_caracter($lista_campos);
			
   echo "$tabla,$num_filas,$lista_campos,$lista_campos\n";
		
		
	
	
}

*/

?>