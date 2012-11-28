<?php
 
include("../../lib/connect_db.inc");    

include("../../lib/lib.inc");    



  $query= "SELECT id_usuario,mail
           FROM  mailing_usuario ";
     $result= cms_query($query)or die ("ERROR 1 <br>$query");
      while (list($id_usuario,$mail) = mysql_fetch_row($result)){

      		  $query= "SELECT id_usuario,mail
      		           FROM  mailing_usuario
      		           WHERE id_usuario='$id_usuario' and mail<>'$mail'";
      		     $result2= cms_query($query)or die ("ERROR 1 <br>$query");
      		      while (list($id_usuario_r,$mail_r) = mysql_fetch_row($result2)){
      						$cont_reem++;
      		      	$respuesta=true;
      		      	
      				while($respuesta!=false){
      					
      						$new_uid=new_uid();
      						
      						  $query= "SELECT mail   
      						           FROM  mailing_usuario
      						           WHERE id_usuario='$new_uid'";
      						     $result3= cms_query($query)or die ("ERROR 1 <br>$query");
      						      if(list($emilio) = mysql_fetch_row($result3)){
      									$new_uid=new_uid();
      									$respuesta = true;			   
      								 }else{
      								 	$Sql ="UPDATE mailing_usuario
      		      				 			   SET id_usuario ='$new_uid'
      		      				  			   WHERE id_usuario ='$id_usuario_r' and mail='$mail_r'";
      		      							  
      		      				  		 cms_query($Sql)or die ("ERROR 1 <br>$Sql");
      		      			   			echo $Sql."<br>";
      								 	$respuesta = false;	
      								 }
      					
      				           }
      						
      						
      		      		echo $cont_reem ."<br>"	;
      				 }
      	
      	
      	  
		 }

echo "$cont_reem reparados";




?>