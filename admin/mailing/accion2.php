<?php
$nombre_mailing = $HTTP_POST_VARS['nombre_mailing'];
$predefinido = $HTTP_POST_VARS['predefinido'];


 $accion_form= "$PHP_SELF?accion=$accion&act=1002";
  
  

  
   if($nombre_mailing !=""){
       
	    $id_mailing = new_uid();
		//$qry_insert="INSERT INTO  mailing values ( '$id_mailing','$nombre_mailing','','$predefinido','','','','','1','')";
		
		$qry_insert2="INSERT INTO mailing_mailing(id_mailing,titulo,subjet,tipo,tot_mailing,html,txt,url,estado,br)
		   values ( '$id_mailing','$nombre_mailing','','$predefinido','','','','','1','')";
        $result_insert=cms_query($qry_insert2) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert2");
		//echo $qry_insert;
		
		$titulo_subjet=" <tr>
                              <td align=\"center\"  class=\"textos\">Ingresar T&iacute;tulo(Subjet) del Mailing</td>
                              </tr>
							  <tr>
                              <td align=\"center\"  class=\"textos\">
							  <input type=\"text\" name=\"subjet_mail\"  class=\"textos\" size=\"60\"></td>
                              </tr>";
		
		
        if($predefinido==1){
		//include("formato1.php");
		}elseif($predefinido==2){
	//	include("formato2.php");		
		}elseif($predefinido==3){
		//include("formato3.php");		
		}
     
   }else{
      $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr><td align=\"center\" class=\"textos\">Se debe ingresar un nombre al Mailing</td>
                    </tr>
					<tr> <td align=\"center\" class=\"textos\">&nbsp;</td>
                    </tr>
					<tr><td align=\"center\" class=\"textos\">
					   <a href=\"#\" onclick=\"history.go(-1)\">Volver</a></td>
                    </tr></table>";
   
        }

?>