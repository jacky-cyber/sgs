<?php


$id_mailing = $HTTP_GET_VARS['id_mailing'];
$visto = $HTTP_GET_VARS['visto'];
$visito = $HTTP_GET_VARS['visito'];


 $query= "SELECT  id_mailing,titulo  
          FROM  mailing_mailing";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
           while (list($id_mailing3,$titulo) = mysql_fetch_row($result)){
        		$option_sel .="<option value=\"$PHP_SELF?accion=$accion&act=2&id_mailing=$id_mailing3\">$titulo</option>";
           }

         $contenido ="  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                            <td align=\"center\" class=\"textos\">
							<form name=\"form1\">
                               <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
                               <option value=\"#\">---></option>
                                 $option_sel
                                </select>
                                </form></td>
                              </tr>
                      	</table>";

if(isset($id_mailing)){








$query= "SELECT id_usuario
         FROM mailing_user_mailing
		 WHERE id_mailing = '$id_mailing' 
		 AND enviado='ok'";
 
     $result2= cms_query($query)or die ("ERROR 1 <br>$query");
      while (list($id_usuario2) = mysql_fetch_row($result2)){

      	$num++;
      	 
		 }



//$num = mysql_num_rows($result);

if($num >0){




$query= "SELECT visit  
         FROM mailing_user_mailing 
		 WHERE reci= 'ok' AND id_mailing = '$id_mailing'";
$result = cms_query($query);


$num_reg_vio = mysql_num_rows($result);

$num_reg_vio_por = ($num_reg_vio*100/$num);
$num_reg_vio_por= round($num_reg_vio_por,2);



$chart .="$num_reg_vio;";


$query= "SELECT id_usuario 
         FROM mailing_user_mailing 
		 WHERE visit= \"ok\" 
		 AND id_mailing = '$id_mailing'";

$result = cms_query($query);
$num_reg_visito = mysql_num_rows($result);

$num_reg_visito_por =($num_reg_visito*100/$num);
$num_reg_visito_por = round($num_reg_visito_por,2);

$chart .="$num_reg_visito;";

//$num_reg_nomas_por =0;
 $query= "SELECT id_usuario 
         FROM mailing_usuario  
		 WHERE nomas = 'ok'";
           $resulte= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
         // $num_reg_nomas = mysql_num_rows($result);
		 
		 
		   while (list($id_usuarior) = mysql_fetch_row($resulte)){
        		
				$query= "SELECT id_usuario 
                         FROM mailing_user_mailing 
		                 WHERE id_usuario= '$id_usuarior'  
						 AND id_mailing='$id_mailing'";
             //  echo $query ."<br>";
                  $resultrr = cms_query($query);	
				
				  if(list($id_usuariotr) = mysql_fetch_row($resultrr)){
				  
				     $num_reg_nomas++;
				 
				  }		   
           }

$chart .="$num_reg_nomas;";

$num_reg_nomas_por = ($num_reg_nomas*10/$num);
$num_reg_nomas_por= round($num_reg_sacame_por,2);

   if(isset($visto)){

    $tabla ="<table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
  <tr><td>&nbsp;</td>
    <td bgcolor=\"#CCCCCC\" class=\"textos\" >Nombre</font></td>
    
    <td bgcolor=\"#CCCCCC\" class=\"textos\" >Mail</font></td>
  </tr>
   ";
     $query= "SELECT id_usuario 
              FROM mailing_user_mailing 
		      WHERE reci= \"ok\" AND id_mailing='$id_mailing'";
		 

     $result = cms_query($query);
	 
	 while(list($id_usuario)= mysql_fetch_row($result)){
	 $cont++;
	    $query= "SELECT nombre,mail,telefono1  
                 FROM mailing_usuario
				 WHERE id_usuario='$id_usuario'";
        $result2 = cms_query($query);
		
		list($nombre,$email,$telefono1)= mysql_fetch_row($result2);
		
	    	     $info .="<tr><td>$cont </td><tdclass=\"textos\" >
		           $nombre</font></td>
				   <tdclass=\"textos\" >
				   $email</font></td>
				   <td align=\"center\" class=\"textos\">$telefono1</td> </tr>";
	 }

    }
	
	
	if(isset($visito)){

    $tabla ="<table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
  <tr><td>&nbsp;</td>
    <td bgcolor=\"#CCCCCC\" class=\"textos\" >Nombre</font></td>
    
    <td bgcolor=\"#CCCCCC\" class=\"textos\" >Mail</font></td>
    <td bgcolor=\"#CCCCCC\" class=\"textos\" >Telefono</font></td>
  </tr>
   ";
     $query= "SELECT id_usuario 
              FROM mailing_user_mailing 
		      WHERE visit= \"ok\" AND id_mailing='$id_mailing'";
		 

     $result7 = cms_query($query);
	 
	 while(list($id_usuario)= mysql_fetch_row($result7)){
	 $cont++;
	    $query= "SELECT nombre,mail,telefono1  
                 FROM mailing_usuario
				 WHERE id_usuario='$id_usuario'";
        $result2 = cms_query($query);
		
		list($nombre,$email,$telefono1)= mysql_fetch_row($result2);
		
	  	     $info .="<tr><td>$cont </td>
			 <td class=\"textos\">
		           $nombre</td>
				   <td class=\"textos\">
				   $email</td>
				   <td align=\"center\" class=\"textos\">$telefono1</td>
				   </tr>";
	 }

    }

	
	if(isset($nomas)){

    $tabla ="<table width=\"90%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
  <tr><td>&nbsp;</td>
    <td bgcolor=\"#CCCCCC\" class=\"textos\" >Nombre</font></td>
     <td bgcolor=\"#CCCCCC\" class=\"textos\" >Mail</font></td>
	 <td bgcolor=\"#CCCCCC\" class=\"textos\" >Telefono</font></td>
	 
  </tr>
   ";
     $query= "SELECT id_usuario 
              FROM mailing_usuario
		      WHERE nomas= 'ok'";
		 

     $result = cms_query($query);
	 
	 while(list($id_usuario)= mysql_fetch_row($result)){
	 
	$cont++;
             						   
      
	    $query= "SELECT nombre,mail,telefono1  
                 FROM mailing_usuario
				 WHERE id_usuario='$id_usuario'";
        $result2 = cms_query($query) or die("$MSG_DIE -1 QR-$query");
		
		list($nombre,$email,$telefono1)= mysql_fetch_row($result2);
		
		//chart=3;4;2;5
				
	     $info .="<tr><td>$cont </td>
		 <td class=\"textos\">
		           $nombre</td>
				   <td class=\"textos\">
				   $email</td>
				   <td align=\"center\" class=\"textos\">$telefono1</td>
				   </tr>";
	    }

    }
	
	
	
	$tabla .= $info ."</table>";
}

  
	

$contenido .="<div align=\"center\">
  <pclass=\"textos\" >Mailinig <font color=\"#0066FF\">$cliente</font></font><br>
    <brclass=\"textos\" >
    Inicio del Mail </font>
  </p>
  
  <table width=\"90%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
            <tr>
			 <td class=\"textos\" align=\"center\" class=\"textos\" > Seleccione estadisticas: </td>
             <td class=\"textos\" align=\"center\"> $sel </font></td>
       </tr>
    </table>
  
  
  <table  border=\"1\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#666666\">
    <tr>
      <td width=\"88\" bgcolor=\"#CCCCCC\" class=\"textos\" >&nbsp;</font></td>
      <td width=\"113\" bgcolor=\"#CCCCCC\"><div align=\"center\" class=\"textos\" >Total</font></div></td>
      <td width=\"91\" bgcolor=\"#CCCCCC\"><div align=\"center\" class=\"textos\" >%</font></div></td>
    </tr>
    <tr>
      <td align=\"center\" class=\"textos\" >
	  Enviados</font></td>
      <td align=\"center\" class=\"textos\" >$num</font></td>
      <td align=\"center\" class=\"textos\" >100%</font></td>
    </tr>
    <tr>
      <td align=\"center\"><pclass=\"textos\" >
	  <a href=\"$PHP_SELF?accion=$accion&act=2&visto=ok&id_mailing=$id_mailing\">
	  Vio  Mail</a></font></p></td>
      <td align=\"center\" class=\"textos\" >$num_reg_vio</font></td>
      <td align=\"center\" class=\"textos\" >$num_reg_vio_por%</font></td>
    </tr>
    <tr>
      <td align=\"center\"><pclass=\"textos\" >
	  <a href=\"$PHP_SELF?accion=$accion&act=2&visito=ok&id_mailing=$id_mailing\">
	  Visito Flash</a></font></p></td>
      <td align=\"center\" class=\"textos\" >$num_reg_visito</font></td>
      <td align=\"center\" class=\"textos\" >$num_reg_visito_por%</font></td>
    </tr>
   
      <td align=\"center\" class=\"textos\" >
	  <a href=\"$PHP_SELF?accion=$accion&act=2&nomas=ok&id_mailing=$id_mailing\">
	  Desuscritos</a></font></td>
      <td align=\"center\" class=\"textos\" >$num_reg_nomas</font></td>
      <td align=\"center\" class=\"textos\" >$num_reg_nomaso_por%</font></td>
    </tr>
  </table><br><br>
  $tabla";

}



 $datos .="<set name='Vio Mail' value='$num_reg_vio' color='F6BD0F' isSliced='1' alpha='70'/><set name='Clickeo Mail' value='$num_reg_visito' color='8BBA00' isSliced='1' alpha='70'/><set name='NO MAS' value='$num_reg_nomas' color='F984A1' isSliced='1' alpha='70'/>";


$tabla .= "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr $bg>
      <td align=\"center\" class=\"textos\"><img src=\"graf/pie.php?chart=$chart\" alt=\"\" border=\"0\"></td>
      </tr>
	</table>";


?>




