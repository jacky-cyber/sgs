<?php

include("lib/connect_db.inc.php");    
include("lib/lib.inc");    

$id = $_GET['id'];

$fp=fopen("http://localhost/sgs/xmlg.php?id=".$id,"r");
 
 $str_xml = "";
 while ($linea=fgets($fp,1024))
 {
   $str_xml = $str_xml.$linea;		
 }
 echo "<br>".$str_xml."<br><br>";
$data = "<?phpxml version='1.0' encoding='UTF-8' ?> 
 <tabla>
   <sgs_formato_entrega>
     <id_formato_entrega>1</id_formato_entrega> 
     <formato_entrega>Copia en papel</formato_entrega> 
     <orden>1</orden> 
  </sgs_formato_entrega>
  <sgs_formato_entrega>
     <id_formato_entrega>2</id_formato_entrega> 
     <formato_entrega>Formato elect&oacute; o digital</formato_entrega> 
     <orden>2</orden> 
  </sgs_formato_entrega>
</tabla>";
	
	
	
	$data = acentos_inverso($data);
	
	$data = cambio_texto($data);
	
	$str_xml =  acentos_inverso($str_xml);
	$str_xml = cambio_texto($str_xml);
	
	
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
			echo $columna ." = ".$msj."<br>";
		}
 		//$subj = $tabla->id_formato_entrega ;
  		echo "<br><br>";
  
  		//echo "asunto : ".$subj."<br>";
  		
  

	}




?>