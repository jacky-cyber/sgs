<?php
/*
$separador = $_POST['separador'];


			
$archivo_name= $HTTP_POST_FILES['archivo']['name'];
$archivo= $HTTP_POST_FILES['archivo']['tmp_name'];
			
	   if (isset($archivo)){
                      $archivo2 = ereg_replace('&','*',$archivo_name);
				      $archivo2 = ereg_replace(' ',':',$archivo2);
					      if (!copy($archivo, "images/sitio/sistema/$archivo2"))
					         {
					         $contenido .= "Fallo, el archivo  no se a podido subir al servidor. <br>
							    			 archivo temp: $archivo<br> archivo nombre : $archivo_name";
					         
							 
							 
							 }
					
                      }		
		




  $query= "SELECT campo,relacion   
           FROM  auto_admin_campo
           WHERE id_auto_admin='$id_auto_admin' and pk<>1 and campo<>'orden'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($campo,$relacion) = mysql_fetch_row($result)){
				
				$cont_camp++;
				
				$campos_tabla .="$campo,";
				
						   
		 }
	
	
  $query= "SELECT tabla  
           FROM  auto_admin
           WHERE id_auto_admin=$id_auto_admin";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($tabla) = mysql_fetch_row($result);
	  
	  
	 
$fp=fopen("images/sitio/sistema/$archivo_name","r");



while ($linea=fgets($fp,1024))
      {
	  $a=0;
	  $campos_insert="";
      $aux=explode($separador, $linea);
	  
	 			while($a<$cont_camp){
	  	
	    			$campos_insert .= "'".ucwords(strtolower(trim($aux[$a])))."',";
     				//echo $campos_insert ."<br>";
					$a++;
	  			}

      				//$largo_lista_de_campos1 = strlen($campos_tabla);
      				//$campos_tabla = substr($campos_tabla,0,$largo_lista_de_campos1);
					
					//$largo_lista_de_campos2 = strlen($campos_insert);
      				//$campos_insert = substr($campos_insert,0,$largo_lista_de_campos2);

		
				$query="INSERT INTO $tabla ($campos_tabla orden)
                    VALUES ($campos_insert '')";

 cms_query($query) or die("2: Error en insert a la base de datos $query");	
		}
		
		
		
				

*/



$archivo_name= $HTTP_POST_FILES['archivo']['name'];
$archivo= $HTTP_POST_FILES['archivo']['tmp_name'];



	
	
  $query= "SELECT tabla  
           FROM  auto_admin
           WHERE id_auto_admin=$id_auto_admin";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($tabla) = mysql_fetch_row($result);
	  
			if(!is_dir("images/sitio/sistema/$tabla")){
			mkdir("images/sitio/sistema/$tabla");
			chmod("images/sitio/sistema/$tabla",0775);
			}
	                 if (isset($archivo)){
                      $archivo2 = ereg_replace('&','*',$archivo_name);
				      $archivo2 = ereg_replace(' ',':',$archivo2);
					      if (!copy($archivo, "images/sitio/sistema/$tabla/$archivo2"))
					         {
					         $contenido .= "Fallo, el archivo  no se a podido subir al servidor. <br>
							    			 archivo temp: $archivo<br> archivo nombre : $archivo_name";
					         
							 
							 
							 }
					
                      }		
		

 
$fp=fopen("images/sitio/sistema/$tabla/$archivo_name","r");



while ($linea=fgets($fp,1024))
      {
	
	  $str_xml .="$linea";
	 			
		}
					  
					  

$xml = simplexml_load_string($str_xml);

	if($id!=""){

 		$query= "SELECT tabla  
           FROM  auto_admin
           WHERE id_auto_admin ='$id'";
    	 $result= cms_query($query)or die (error($query,mysql_error(),$php));
      	 list($tabla) = mysql_fetch_row($result);
		 
		 echo "tabla: ".$tabla."<br><br>";
		 
		 $query= "SELECT campo,txt_xml    
           FROM  auto_admin_campo
           WHERE id_auto_admin ='$id' and xml=1";
     	$result= cms_query($query)or die (error($query,mysql_error(),$php));
		
		$array_campos = array();
		$i= 0;
		
      	while (list($campo,$txt_xml) = mysql_fetch_row($result)){
		
		if($txt_xml!=""){
		$array_campos[$i] = $txt_xml;
		}else{
		$array_campos[$i] = $campo;
		}
			
			//echo "<br>campo: ".$array_campos[$i];
			$i++;
			/*$query= "SELECT $campo   
                           FROM  $tabla
                           WHERE 1
						   limit $cont_registro,1";
                     $result_campos= cms_query($query)or die (error($query,mysql_error(),$php));
                     list($valor) = mysql_fetch_row($result_campos);
			
				$valor = cambio_texto($valor);
			$writer->startElement("$campo"); 
			$writer->text($valor);	
			$writer->endElement(); 	*/
		    
		 }
		 
	  }
	

	foreach ($xml->$tabla as $registro){

		foreach($array_campos as $columna){
 			$msj = $registro->$columna ;
			$contenido .= $columna ." = ".$msj."<br>";
		}
 		
  		
  

	}

?>