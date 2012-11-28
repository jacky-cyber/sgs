<?php

  $contenido = "<table width=\"300\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                                           <tr>
                                             <td align=\"left\" class=\"textos_plomo\">Receptor</td>
                                             <td align=\"center\" class=\"textos_plomo\">Vi&oacute;</td>											 
                                             <td align=\"center\" class=\"textos_plomo\">Clickeo</td>											 
                                             <td align=\"center\" class=\"textos_plomo\">Aprobo</td>											 
                                           </tr>";


  $query= "SELECT id_receptor,aprobacion,vio,visito,texto 
           FROM mailing_mail_apro
           WHERE id_mailing='$id_mailing'";
           
			$result= cms_query($query);
       while (list($id_receptor,$aprobacion,$vio,$clickeo,$texto) = mysql_fetch_row($result)){
			
			
			if($aprobacion!=""){
			 
			   if($aprobacion=="no"){
			   $aprob=" <td align=\"center\" class=\"textos\">
	 <a href=\"$PHP_SELF?accion=$accion&act=$act&id_mailing=$id_mailing&ver=ok&id_recep=$id_receptor\"><b>$aprobacion</b></a>
						 </td>";
			   
			     }else{
			
			       	  $Sql ="UPDATE mailing_mailing
         	   SET estado='4'
         	   WHERE id_mailing ='$id_mailing'";
    
         		 
         	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");
			
			       $aprob =" <td align=\"center\" class=\"textos\">$aprobacion</td>";
			       $ok = "<table width=\"300\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"center\" class=\"textos\">
							  <a href=\"index.php?accion=$accion&id_mailing=$id_mailing&act=1007\">Enviar Mailing</a></td>
                            </tr>
                          </table>";
			      }
			 
			}else{
			
			 $aprob =" <td align=\"center\" class=\"textos\">$aprobacion</td>";
			
			}
			   $aprobacion ="";
			  
			  $query= "SELECT nombre
                       FROM mailing_receptores WHERE id_receptor='$id_receptor'";
                      $result_recep= cms_query($query);
                       list($receptor) = mysql_fetch_row($result_recep);
			
						   $contenido .= "<tr>
                                             <td align=\"left\" class=\"textos\">$receptor</td>
                                             <td align=\"center\" class=\"textos\">$vio</td>											 
                                             <td align=\"center\" class=\"textos\">$clickeo</td>											 
                                            	$aprob									 
                                           </tr>";
						   
						   }
						   
 $contenido .="</table><br><br><br>$ok ";
 
 
 $ver = $HTTP_GET_VARS['ver'];
 $id_recept = $HTTP_GET_VARS['id_recep'];
 
 if(isset($ver)){
 
  $query= "SELECT texto 
           FROM mailing_mail_apro WHERE id_mailing='$id_mailing' and id_receptor='$id_recept'";
         
			$result= cms_query($query);
          while (list($texto) = mysql_fetch_row($result)){
		  $texto = nl2br($texto);
		  
 						   $contenido .= "<table width=\"300\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                                          
										   <tr>
                                             <td align=\"center\" class=\"textos\">$texto</td>
                                           </tr>
                                         </table>";
 						   }
 
 }
 
?>