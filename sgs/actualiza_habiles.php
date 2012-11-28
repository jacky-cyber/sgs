<?php


include("../lib/connect_db.inc.php");    


/*
 * Select tabla cms_configuracion
 * 
 */
$query= "SELECT valor  
           FROM  cms_configuracion
           WHERE configuracion = 'url_descarga_habiles'";
     $result_cms_configuracion= mysql_query($query)or die (mysql_error());
      list($url) = mysql_fetch_row($result_cms_configuracion);
      
/** fin select cms_configuracion***/

	 

 ob_start(); 
   // echo "<h2>Vespucio Sur  </h2>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_URL,$url );    
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
	
	   
       
 $result = curl_exec($ch);

   
   
curl_close($ch); 
$retrievedhtml = ob_get_contents(); 
ob_end_clean(); 

$json = json_decode($retrievedhtml);


	$fecha_no_habil = $json->{'fechas_no_habil'};
	foreach (  $fecha_no_habil as $fecha )
	{
		
	    $query= "SELECT id_no_habil 
               FROM  no_habil
               WHERE no_habil='$fecha'";
         $result= mysql_query($query);
          if(!list($id) = mysql_fetch_row($result)){
    				
                    $qry_insert="INSERT INTO no_habil(no_habil) values ('$fecha')";
                                  
                   $result_insert=mysql_query($qry_insert);
					$cont_add++;		   
    		 }
	
	}	
		
	if($cont_add>0){
		echo "$cont_add fechas agregadas";	
	}
	
	
		
?>