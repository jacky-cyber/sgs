<?php
$id_mailing = $HTTP_GET_VARS['id_mailing'];
 
 
  $query= "SELECT subjet,tipo,br    
            FROM  mailing_mailing
            WHERE id_mailing='$id_mailing'";
                           $result= cms_query($query);
                  list($subjet,$tipo_mailing,$formato) = mysql_fetch_row($result);
		
		$contenido .="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">
						  <a href=\"$PHP_SELF?accion=$accion&act=1005&id_mailing=$id_mailing\">Generar Prueba</a></td>
                        </tr>
                      </table>
		                 <table width=\"100%\" border=\"0\"  cellpadding=\"0\" cellspacing=\"0\">
                                  <tr>
                                    <td align=\"left\" class=\"textos\" width=\"120\">Subjet: </td>
									<td align=\"left\" class=\"textos\"><b>$subjet</b>
									</td>
                                  </tr>
						</table>";
								  
				
				
				
								  
     $query= "SELECT id_texto,titulo,bajada,contenido,image,link
            FROM  mailing_mail_texto  
            WHERE id_mailing='$id_mailing'";
                           $result= cms_query($query);
                 while(list($id_texto,$titulo,$bajada,$contenid,$image,$link) = mysql_fetch_row($result)){
				
				
				if($formato=='of'){
			     $bajada =nl2br($bajada);
			     $contenid =nl2br($contenid);
				  } 
						
			if($tipo_mailing==3){
			if($image!=""){
			$image ="<a href=\"".$_SERVER['SERVER_NAME']."/visit.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">
			<img src=\"".$_SERVER['SERVER_NAME']."/images/sitio/mail/$image\" alt=\"\" border=\"0\">
			</a>";
			//echo $_SERVER['SERVER_NAME']."/images/sitio/mail/$image\"";
			
			}
				 
				 
			$html_mail .="<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr> 
     <td class=\"titulo\" align=\"center\">
	 <a href=\"".$_SERVER['SERVER_NAME']."/visit.php?id_receptor=$id_receptor&id_mailing=$id_mailing&prueba=ok\">$titulo</a><br>
    </td>
             </tr>
		  <tr> 
    <td class=\"bajada\">$bajada
	</td>
      </tr>
        <tr> 
        <td width=\"603\" valign=\"top\"><br>
     
	        <table border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
              <tr> 
                <td width=\"16\" align=\"center\">$image</td>
              </tr>
            </table>
	

	 <p align=\"justify\" class=\"textos\">$contenid</p>
      </td></tr>
	  </table>";
			
				
				 
				 }else{
			
	$html_mail .="<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			        <tr>
                      <td align=\"center\">
					  <a href=\"".$_SERVER['SERVER_NAME']."/visit.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">
			           <img src=\"http://".$_SERVER['SERVER_NAME']."/images/sitio/mail/$image\" alt=\"\" border=\"0\"></a>
			          </td>
                      </tr>
				</table>";
		//".$_SERVER['SERVER_NAME']."
			
			      }  
				  
				  
			}					
								
								
		
$html ="
  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td align=\"left\" class=\"textos\">Cuerpo del Mail:</td>
          </tr>
			<tr>
           <td align=\"center\" class=\"textos\"  bgcolor=\"$fondo_tabla\">
		   $si_ud_no_ve 
		   <a href=\"#\">aqu&iacute;</a></font><br>


           $html_mail


          <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr>
                <td>
                  <div align=\"center\">
	               <font color=\"#FF6600\" size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">
	               $no_desea</font>
		           <font face=\"Arial, Helvetica, sans-serif\" size=\"1\" > 
                    <a href=\"#\">aqu&iacute;</a></font></font></div>
                   </td>
                 </tr>
                </table>
		   </td>
        </tr>
   </table>";	

$contenido .=$html;
?>