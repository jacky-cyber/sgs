<?php
$prueba = $HTTP_GET_VARS['prueba'];

if(!isset($prueba)){




  $query= "SELECT id_receptor,nombre,mail   
           FROM mailing_receptores ";
          $result= cms_query($query);
		  $tabla_recept ="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"center\" class=\"textos\">Nombre</td>
							   <td align=\"center\" class=\"textos\">Mail</td>
							    <td align=\"center\" class=\"textos\">
							</td>
                            </tr>
                        ";
          while (list($id_receptor,$nombre,$mail) = mysql_fetch_row($result)){
				$tabla_recept .= " <tr>
                              <td align=\"center\" class=\"textos\">$nombre</td>
							   <td align=\"center\" class=\"textos\">$mail</td>
							    <td align=\"center\" class=\"textos\">
								<input type=\"checkbox\" name=\"id_r_$id_receptor\" value=\"checkbox\">
							</td>
                            </tr>";		   
			   }

			   $tabla_recept .="  </table>";
			   
		$accion_form="$PHP_SELF?accion=$accion&act=1005&id_mailing=$id_mailing&prueba=ok";  
		$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">Enviar mail de Prueba a los sig mailing_receptores</td>
                        </tr>
                      </table>
					  
					  <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\">
                         $tabla_recept
						        </td>
                        </tr>
                      </table><div align=\"center\">
					  <input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
                         </div> ";
						  
						  
	}else{
	
	  $query= "SELECT id_receptor,nombre,mail   
           FROM mailing_receptores ";
          $result= cms_query($query);
		  $tabla_recept ="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"center\" class=\"textos\">Nombre</td>
							   <td align=\"center\" class=\"textos\">Mail</td>
							    <td align=\"center\" class=\"textos\">
							</td>
                            </tr>
                        ";
          while (list($id_receptor,$nombre,$mail) = mysql_fetch_row($result)){
		  $temp = "id_r_$id_receptor";
		  $temp = $act = $HTTP_POST_VARS[$temp];
		  
		           if(isset($temp)){
		            $receptores .="<div class=\"textos\">Mail enviado  a $nombre ($mail)</div><br>";
								   
	                 include("manda_mail_p.php");
		                
						  $query = "SELECT id_mailing   
                                    FROM mailing_mail_apro 
                                    WHERE id_mailing='$id_mailing' AND id_receptor ='$id_receptor'";
                                   $result_aprob= cms_query($query);
								   $num_res= mysql_num_rows($result_aprob);
								   echo $query;
								   if($num_res==0){
								   
						     $qry_insert="INSERT INTO mailing_mail_apro values ('$id_mailing','$id_receptor','','no','no','no')";
                             $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
							     
								  $Sql ="UPDATE mailing_mailing
         	                              SET estado='3'
         	                              WHERE id_mailing ='$id_mailing'";
    
         		 
         	   cms_query($Sql)or die ("ERROR 1 <br>$Sql"); 
								 
		   
								   }
            $link ="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                      <td align=\"center\" class=\"textos\">
					  <a href=\"index.php?accion=$accion&id_mailing=$id_mailing&act=1006\">Estado de Pre-Mailing-></a></td>
                    </tr>
                  </table>";	          
						
		            }
		  
		  
		  }
	
	     
	
	}
	$contenido .=$receptores ;	
	$contenido .=$link;
	
?>