<?php
/*
CREATE TABLE indices_economicos(
id_indices_economicos int( 11 ) NOT NULL auto_increment,
uf varchar( 255 ) NOT NULL default '',
ipsa varchar( 255 ) NOT NULL default '',
igpa varchar( 255 ) NOT NULL default '',
us varchar( 255 ) NOT NULL default '',
euro varchar( 255 ) NOT NULL default '',
fecha varchar( 255 ) NOT NULL default '',
PRIMARY KEY ( id_indices_economicos ) 
)
*/


include("connect_db.inc.php");    
include("lib.inc.php");    






$ver = $_GET['ver'];

$fecha_ingreso  = date(d)."-".date(m)."-".date(Y);


 $query= "SELECT id_indices_economicos   
           FROM  indices_economicos
           WHERE fecha='$fecha_ingreso'";
 //echo $query;
     $result= @cms_query($query)or die (error($query,mysql_error(),$php));
      if(!list($id_indices_economicos) = @mysql_fetch_row($result)){
    



$fp=@fopen("http://si2.bcentral.cl/Basededatoseconomicos/951_portada.asp?idioma=E","r");



while ($linea=@fgets($fp,1024))
      {
	  $cont++;
	//echo $linea."sss <br>";
	 
	  
	  switch ($cont) {
           case 266:
                $linea_aux = str_replace("<TD align=right>","",$linea);
	            $linea_aux = str_replace("</TD>","",$linea_aux);
	            $linea_aux = trim($linea_aux);
				$uf = $linea_aux;
	          //  echo "$cont -UF $linea_aux <br>";
               break;
         case 272:
                $linea_aux = str_replace("<TD align=right>","",$linea);
	            $linea_aux = str_replace("</TD>","",$linea_aux);
	            $linea_aux = trim($linea_aux);
				$utm = $linea_aux;
	           // echo "$cont -UTM $linea_aux <br>";
               break;
        case 278:
                $linea_aux = str_replace("<TD align=right>","",$linea);
	            $linea_aux = str_replace("</TD>","",$linea_aux);
	            $linea_aux = trim($linea_aux);
				$uss_obs = $linea_aux;
	           // echo "$cont -USS Obs $linea_aux <br>";
               break;
        case 285:
                $linea_aux = str_replace("<TD align=right>","",$linea);
	            $linea_aux = str_replace("</TD>","",$linea_aux);
	            $linea_aux = trim($linea_aux);
				$euro = $linea_aux;
	           // echo "$cont -EURO $linea_aux <br>";
               break;
      	 
         	default:
      	   $def ="ok";
      	 
             
       }
	  
	 }
	 
	 

	   
	  $fp=fopen("http://www.valorfuturoplus.com/contenidos_vf/indicadores.asp","r");


$cont=0;
while ($linea=fgets($fp,1024))
      {
	  $cont++;
	 // $linea = htmlentities($linea);
	//echo "$cont - $linea <br>";
	 
	switch ($cont) {
         case 304:
             $ipsa = trim($linea);
			 $ipsa = str_replace("<td class=\"vfresultsSize\" align=\"right\" width=\"91\">","",$ipsa);
             $ipsa = str_replace("</td>","",$ipsa);
			 
             break;
    	 case 314:
		     $igpa = trim($linea);
             $igpa = str_replace("<td class=\"vfresultsSize\" align=\"right\" width=\"91\">","",$igpa);
             $igpa = str_replace("</td>","",$igpa);
			
             break;
       	default:
    	   $def ="ok";
    	 
           
     }
	  
	 } 
	   
	   
	  
	 
	 
	 
	  
     



	$qry_insert="INSERT INTO indices_economicos values (null,'$uf','$ipsa','$igpa','$uss_obs','$euro','$fecha_ingreso')";
      	       //  echo $qry_insert."<br>";    
      	                $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
      	
      	
     	//echo "datos guardados $qry_insert <br>";
      	
      	
      	
      	
      }else{
    
      	  $query= "SELECT id_indices_economicos,uf,ipsa,igpa,us,euro   
      	           FROM  indices_economicos
      	           WHERE fecha='$fecha_ingreso'";
      	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      	     list($id_indices_economicos,$uf,$ipsa,$igpa,$uss_obs,$euro) = mysql_fetch_row($result);
      	
      	      
      	      
      	      
      }




$indicadores = html_template("indicadores");

$contenedor = str_replace("#UF#","$uf",$indicadores);
$contenedor = str_replace("#EURO#","$euro",$contenedor);
$indicadores = str_replace("#US#","$uss_obs",$contenedor);


echo "$uf <br>
$dolar_obs<br>
$euro";


?>