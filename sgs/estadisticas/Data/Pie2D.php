<?php 

include("lib/connect_db.inc.php");    


  $query= "SELECT id_totales_servicios,fecha,total_url_ok,total_url_no_xml,total_url_problemas,total_res  
           FROM  sgs_totales_servicios";
     $result= cms_query($query)or die ("ERROR $php <br>$query");
      list($id_totales_servicios,$fecha,$total_url_ok,$total_url_no_xml,$total_url_problemas,$total_res) = mysql_fetch_row($result);
	  
	  
	  


echo "<chart >
  <set label=\"Total de Url OK\" value=\"$total_url_ok\" /> 
  <set label=\"Item E\" value=\"5\" isSliced=\"1\" /> 
  <set label=\"Item F\" value=\"5\" isSliced=\"1\" /> 
  <set label=\"Item G\" value=\"4\" /> 
  <set label=\"Item H\" value=\"5\" /> 
  <set label=\"Item I\" value=\"2\" /> 
</chart>";

?>