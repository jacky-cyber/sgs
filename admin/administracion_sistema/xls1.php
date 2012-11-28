<?php


$query= "SELECT campo  
           FROM  auto_admin_campo
           WHERE id_auto_admin='$id_auto_admin'";
//echo "$query<br>";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($campos1) = mysql_fetch_row($result)){
      	
      	$cant_cam++;
      	
      	$campos_lista .="$campos1,";
      	
      	$header .="$campos1 \t";
      	
      }

//echo $campos1;
		
		$tot_char= strlen($campos_lista);
		//echo "$tot_char";
		$campos_lista = substr("$campos_lista",0,$tot_char-1);
		
	$tabla= tabla($id_auto_admin);
	
	
	  $query= "SELECT count(*)   
	           FROM  $tabla";
	     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($cant_reg) = mysql_fetch_row($result2);
	     
	      
	      	       
	  $query= "SELECT $campos_lista
	           FROM  $tabla";
	  //echo "$query";
	     $result3= cms_query($query)or die (error($query,mysql_error(),$php));
	     
	     
	            while ($cant_reg>$cta_linea){
	      		
	      		$columnas =0;
	      		
	      		
	         		while ($cant_cam>$columnas){
	         			         			
	         			$valor .= mysql_result($result3,$cta_linea,$columnas)."\t";
	         			$columnas++;
	         			
	         		}
	         		
	            		$cta_linea++;
	            		$valor.="\n";
	            		
	            }
	            
	            
$nombre_archivo ="prueba";
$data = str_replace("\r", "", $data);

header("Content-type: application/octet-stream");
   
   
header("Content-Disposition: attachment; filename=$nombre_archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");

$css="";

echo $header."\n".$valor; 
//echo $header;	            
	           // $contenido ="$valor";
	           
?>