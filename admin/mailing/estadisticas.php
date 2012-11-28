<?php

if(isset($id_mailing)){



$mail_remi = "newtemopral@hotmail.com";
$cliente ="SIP";



$query= "SELECT id_usuario
         FROM user_mailing
		 WHERE id_mailing = $id_mailing 
		 AND enviado='ok'";
//echo $query;

$result = cms_query($query);

$num = mysql_num_rows($result);



$query= "SELECT visit  
         FROM user_mailing 
		 WHERE reci= \"ok\" AND id_mailing = '$id_mailing'";
$result = cms_query($query);


$num_reg_vio = mysql_num_rows($result);

$num_reg_vio_por = ($num_reg_vio*100/$num);
$num_reg_vio_por= round($num_reg_vio_por,2);



$query= "SELECT id_usuario 
         FROM user_mailing 
		 WHERE visit= \"ok\" 
		 AND id_mailing = '$id_mailing'";

$result = cms_query($query);
$num_reg_visito = mysql_num_rows($result);

$num_reg_visito_por =($num_reg_visito*100/$num);
$num_reg_visito_por = round($num_reg_visito_por,2);

//$num_reg_nomas_por =0;
 $query= "SELECT id_usuario 
         FROM mailing_usuario  
		 WHERE nomas = 'ok'";
           $resulte= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
         // $num_reg_nomas = mysql_num_rows($result);
		 
		 
		   while (list($id_usuarior) = mysql_fetch_row($resulte)){
        		
				$query= "SELECT id_usuario 
                         FROM user_mailing 
		                 WHERE id_usuario= '$id_usuarior'  
						 AND id_mailing='$id_mailing'";
             //  echo $query ."<br>";
                  $resultrr = cms_query($query);	
				
				  if(list($id_usuariotr) = mysql_fetch_row($resultrr)){
				  
				     $num_reg_nomas++;
				 
				  }		   
           }



$num_reg_nomas_por = ($num_reg_nomas*10/$num);
$num_reg_nomas_por= round($num_reg_sacame_por,2);

   if(isset($visto)){

    $tabla ="<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
  <tr><td>&nbsp;</td>
    <td bgcolor=\"#CCCCCC\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Nombre</font></td>
    
    <td bgcolor=\"#CCCCCC\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Mail</font></td>
  </tr>
   ";
     $query= "SELECT id_usuario 
              FROM user_mailing 
		      WHERE reci= \"ok\" AND id_mailing='$id_mailing'";
		 

     $result = cms_query($query);
	 
	 while(list($id_usuario)= mysql_fetch_row($result)){
	 $cont++;
	    $query= "SELECT nombre,mail  
                 FROM mailing_usuario
				 WHERE id_usuario='$id_usuario'";
        $result2 = cms_query($query);
		
		list($nombre,$email)= mysql_fetch_row($result2);
		
	    	     $info .="<tr><td>$cont </td><td><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">
		           $nombre</font></td>
				   <td><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">
				   $email</font></td></tr>";
	 }

    }
	
	
	if(isset($visito)){

    $tabla ="<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
  <tr><td>&nbsp;</td>
    <td bgcolor=\"#CCCCCC\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Nombre</font></td>
    
    <td bgcolor=\"#CCCCCC\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Mail</font></td>
  </tr>
   ";
     $query= "SELECT id_usuario 
              FROM user_mailing 
		      WHERE visit= \"ok\" AND id_mailing='$id_mailing'";
		 

     $result7 = cms_query($query);
	 
	 while(list($id_usuario)= mysql_fetch_row($result7)){
	 $cont++;
	    $query= "SELECT nombre,mail  
                 FROM mailing_usuario
				 WHERE id_usuario='$id_usuario'";
        $result2 = cms_query($query);
		
		list($nombre,$email)= mysql_fetch_row($result2);
		
	  	     $info .="<tr><td>$cont </td>
			 <td><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">
		           $nombre</font></td>
				   <td><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">
				   $email</font></td></tr>";
	 }

    }

	
	if(isset($nomas)){

    $tabla ="<table width=\"600\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
  <tr><td>&nbsp;</td>
    <td bgcolor=\"#CCCCCC\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Nombre</font></td>
     <td bgcolor=\"#CCCCCC\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">Mail</font></td>
  </tr>
   ";
     $query= "SELECT id_usuario 
              FROM mailing_usuario
		      WHERE nomas= 'ok'";
		 

     $result = cms_query($query);
	 
	 while(list($id_usuario)= mysql_fetch_row($result)){
	 
	$cont++;
             						   
      
	    $query= "SELECT nombre,mail  
                 FROM mailing_usuario
				 WHERE id_usuario='$id_usuario'";
        $result2 = cms_query($query) or die("$MSG_DIE -1 QR-$query");
		
		list($nombre,$email)= mysql_fetch_row($result2);
		
	     $info .="<tr><td>$cont </td>
		           <td><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">
		           $nombre</font></td>
				   <td><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">
				   $email</font></td></tr>";
	    }

    }
	
	
	
	$tabla = $info ."</table>";
}
$contenido = $tabla;
?>