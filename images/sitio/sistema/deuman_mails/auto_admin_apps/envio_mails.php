<?php

         
                
 if($_POST['enviar']!=""){
  
  $id= $_GET['id'];
  
  

  
  $query= "SELECT  id_mensaje,remitente,destinatario,id_usuario,id_destinatario,asunto,cuerpo,fecha,hora,orden,enviado,error_envio 
           FROM  deuman_mails
           WHERE  enviado = 0";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
       while (list($id_mensaje,$remitente,$destinatario,$id_usuario,$id_destinatario,$asunto,$cuerpo,$fecha,$hora,$orden,$enviado,$error_envio) = mysql_fetch_row($result)){
    		$var="msj_$id_mensaje";
			
			if($_POST[$var]==1){
			
			if(cms_mail($destinatario,$asunto,$cuerpo,$headers)){
      			$Sql ="UPDATE deuman_mails
 	   				   SET enviado ='1'
 	   				   WHERE id_mensaje= '$id_mensaje'";
 				  
 	   				cms_query($Sql)or die ("ERROR $php <br>$Sql");
           
           			$aviso .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
						<td align=\"left\" class=\"textos\">Email reenviado a <strong>$destinatario</strong> </td>
					<td align=\"left\" class=\"textos\"><img src=\"images/ok2.gif\" alt=\"Se envio Email correctamente\" border=\"0\"></td> </tr> ";
      
     		}else{
            		$aviso .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
						<td align=\"left\" class=\"textos\"> No fue posible reenviar el mail a <strong>$destinatario</strong></td>
					<td align=\"left\" class=\"textos\"><img src=\"images/not_ok2.gif\" alt=\"Se envio Email correctamente\" border=\"0\"></td> </tr>";
      			
     		}  		
			}
			
			 				   
  		 }
      
	$aviso = " <h2>Resultados de Envio</h2><br> 
			<table width=\"96%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"well\">
                  $aviso
              	</table>";
  
  
 }
 
 
 /*
 * Select tabla deuman_mails
 * 
 */
  $buscar= $_POST['buscar'];


  if($buscar!=""){
  	if($_POST['buscar_en']=="mail"){
	$condicion =" and destinatario like '%$buscar%'";
	}else{
	$condicion =" and asunto like '%$buscar%'";
	}
   
   
   }  

$query= "SELECT  id_mensaje,remitente,destinatario,id_usuario,id_destinatario,asunto,cuerpo,fecha,hora,orden,enviado,error_envio 
           FROM  deuman_mails
           WHERE enviado = '0'
           $condicion";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_mensaje,$remitente,$destinatario,$id_usuario,$id_destinatario,$asunto,$cuerpo,$fecha,$hora,$orden,$enviado,$error_envio) = mysql_fetch_row($result)){
		      
                  
                       $lista .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                                <td align=\"left\" class=\"textos\">
                                   $destinatario  
                                   </td>
                                   <td align=\"left\" class=\"textos\">$asunto</td>
                                   <td align=\"center\" class=\"textos\">
                                   <a href=\"index.php?accion=54796&act=18&id_a=$id_mensaje&id=1&id_apps=$id_apps&width=400&axj=1\" class=\"jTip\" id=\"$id_mensaje\" name=\"Detalle de Registro\">
                                   <img src=\"images/lupa.gif\" alt=\"\" border=\"0\"></a>
                                   </td>
								   <!--    
                                   <td align=\"center\" class=\"textos\">
                                   <a href=\"index.php?accion=$accion&act=$act&sub=envia&id_apps=$id_apps&id=$id_mensaje\">
                                       <img src=\"images/emailButton.jpg\" alt=\"\" border=\"0\">
                                   </a>
                                   </td>  -->
								  <td align=\"center\" class=\"textos\"> <input type=\"checkbox\" name=\"msj_$id_mensaje\" id=\"msj_$id_mensaje\" value=\"1\"></td> 
                                   </tr> ";			   
		 }
/** fin select deuman_mails***/


 $contenido = "<br><table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
    <tr >
      <td align=\"center\" class=\"textos\">$aviso <br></td>
      </tr>
	   
      <tr><td align=\"left\" class=\"textos\">Buscar destinatario <input type=\"text\" name=\"buscar\" id=\"buscar\" maxlength=\"50\" value=\"$buscar\">
       Mail<input type=\"radio\" name=\"buscar_en\"  id=\"buscar_en\" value=\"mail\" checked> Asunto <input type=\"radio\" name=\"buscar_en\"  id=\"buscar_en\" value=\"asunto\"> 
	  <input type=\"submit\" name=\"Submit\" value=\"Buscar...\"></td></tr> 
      <tr >
          <td align=\"center\" class=\"textos\">
		  <input type=\"submit\" name=\"enviar\" value=\"Re-enviar Mensajes seleccionados\"></td>
          </tr>
		  <tr><td align=\"right\" class=\"textos\">
		   <table  border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">
       <tr><td align=\"right\" class=\"textos\"><a href=\"javascript:seleccionar_todo()\">Marcar todos</a> | 
   <a href=\"javascript:deseleccionar_todo()\">Marcar ninguno</a> </td></tr>
   	
   	</table>
	 </td></tr> 
	  <tr><td align=\"center\" class=\"textos\"  >
      <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"alert alert-info\">
                <tr>
				<td align=\"center\" class=\"textos\">Destinatario</td>
                <td align=\"center\" class=\"textos\">Asunto</td> 
                <td align=\"center\" class=\"textos\">Ver</td>
                <td align=\"center\" class=\"textos\">Reenviar</td> 
				
                </tr> 
                 $lista
                </table>
              </td></tr> 
	</table><br>
	  <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr >
          <td align=\"center\" class=\"textos\">
		  <input type=\"submit\" name=\"enviar\" value=\"Re-enviar Mensajes seleccionados\"></td>
          </tr>
    	</table>
                ";
                
   $js.="
   <script>
   function seleccionar_todo(){ 
      for (i=0;i<document.form1.elements.length;i++) 
         if(document.form1.elements[i].type == \"checkbox\") 
            document.form1.elements[i].checked=1 
   } 
   
   function deseleccionar_todo(){ 
      for (i=0;i<document.form1.elements.length;i++) 
         if(document.form1.elements[i].type == \"checkbox\") 
            document.form1.elements[i].checked=0 
   } 
   	
    </script>
    
      
    
   ";

?>