<?php

         $tabla_l = campo_pk($campo_tabla,$DATABASE);
            
            $campo_pk_l = pk_tabla($tabla_l);
            $campo_txt_l = campo_txt($tabla_l);
            //$valor_campo = htmlentities($valor_campo);
            
              $query= "SELECT $campo_pk_l 
               FROM  $tabla_l 
               WHERE $campo_txt_l='$valor_campo'";
			   
			   
	//echo "$query<br>"; 

         $result= cms_query($query)or die (error($query,mysql_error(),$php));
       		list($valor_camp) = mysql_fetch_row($result);
  	  	
            if($valor_camp==""){
                $valor_camp="0";
            }
            //$tablas_l.=$tabla_l." ";
               
            $condicion_sql .= " and $tabla.$campo_tabla = '$valor_camp' ";
            
            
            $_SESSION['condicion_sess'] .=$condicion_sql;
            
            	
$query = "select COUNT(*) as cantidad
		  from $tabla 
		  where 1 $condicion_sql and id_perfil=1";	
		
		
		
		 $result33= mysql_query($query)or die (error($query,mysql_error(),$php));
   
  $strXML2="";
    
	  list($cantidad) = mysql_fetch_row($result33);
?>