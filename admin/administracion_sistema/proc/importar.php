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

	if($id_auto_admin!=""){

 		$query= "SELECT tabla  
           FROM  auto_admin
           WHERE id_auto_admin ='$id_auto_admin'";
    	 $result= cms_query($query)or die (error($query,mysql_error(),$php));
      	 list($tabla) = mysql_fetch_row($result);
		 
		//echo "tabla: ".$tabla."<br><br>";
		 
		 $query= "SELECT campo,txt_xml,pk,txt    
           FROM  auto_admin_campo
           WHERE id_auto_admin ='$id_auto_admin' and xml=1";
     	$result= cms_query($query)or die (error($query,mysql_error(),$php));
		
		$array_campos = array();
		$i= 0;
		
      	while (list($campo,$txt_xml,$pk,$txt) = mysql_fetch_row($result)){
		
		if($txt_xml!=""){
		$array_campos[$i] = $txt_xml;
		}else{
		$array_campos[$i] = $campo;
		}
		if($pk==1){
		$campo_pk = "$campo";
		
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
	$cont_reg2++;
$dato="";
$campos_insert="";
$valores_insert="";
		foreach($array_campos as $columna){
 			$msj = $registro->$columna ;
			$msj = utf8_decode($msj);
			if($columna==$campo_pk){
				$condicion ="$columna = '".$msj."'";
			}else{
			$dato .= $columna ." = '".$msj."',";
			
			$campos_insert .= "$columna,";
			$valores_insert .="'$msj',";
			
			}
		}
 		$campos_insert = elimina_ultimo_caracter($campos_insert);
			$valores_insert = elimina_ultimo_caracter($valores_insert);
			
		$dato = elimina_ultimo_caracter($dato);
	
	  $query= "SELECT $campo_pk   
               FROM  $tabla
               WHERE $condicion";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          if(list($campo_id) = mysql_fetch_row($result)){
    			$Sql ="UPDATE $tabla
    	   			   SET $dato
    	   			   WHERE $condicion";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
				   
    		 }else{
			 
			 
             $qry_insert="INSERT INTO $tabla($campos_insert) values ($valores_insert)";
             $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");
			 
			 
			 }
			
	 

	}

	$contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
                    <tr>
                      <td align=\"center\" class=\"textos\">Se han actualizado <strong>$cont_reg2</strong> registros.</td>
					  
                    </tr>
					<tr><td align=\"center\" class=\"textos\">
					<a href=\"index.php?accion=$accion\">Volver a la lista</a> </td></tr> 
                  </table>";
	
?>