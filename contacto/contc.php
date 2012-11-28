<?php
$consulta = $_POST['consulta'];
$mensaje = $_GET['mensaje'];


if(isset($mensaje)){
  if($mensaje==1){
    $contenido .="  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <t$monedabg>
                      <td align=\"center\" class=\"textos\">
					  <font color=\"#FF0000\">Debe ingresar un mail	</font> </td>
                      </tr>
                	</table>";
					
			
  }

}


$contenido .="<div align=\"center\" class=\"textos\">Contact Form.</div>";

if ($id_usuario!=""){

$qry_vis = "SELECT  id_usuario,nombre,apellido,email 
  		    FROM usuario 
            WHERE id_usuario='$id_usuario'";

$qry_vi = @cms_query($qry_vis) or die("$MSG_DIE  $php- 1 <br>$qry_vis");


list($id_usuario,$nombre,$apellido,$email)=mysql_fetch_row($qry_vi);

$identif .="<td align=\"center\" class=\"textos\">
             Ingrese su consulta <b>$nombre $apellido</b>
			 		<input type=\"hidden\" name=\"email\" value=\"$email\" > </td>";

	$js ="<script language=\"JavaScript\">
	function validaforma(theForm){
	
		
		if (theForm.consulta.value == \"\"){
				alert(\"Ingrese un consulta.\");
				theForm.consulta.focus();
				return false;
		}
		
		
	
	
	}
	</script>";
}else{

$identif .="<td align=\"center\" class=\"textos\"> 
     <table width=\"50%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
       <tr><td align=\"left\" class=\"textos\">Your name: </td>
         <td align=\"left\" class=\"textos\">
		 <input type=\"text\" name=\"nombre\" class=\"textos\" size=\"30\" value=\"\">
		 </td>
         </tr><tr><td align=\"left\" class=\"textos\">Your email address: </td>
         <td align=\"left\" class=\"textos\"> 
		 <input type=\"text\" name=\"emailp\" class=\"textos\" size=\"30\" value=\"\"></td>
         </tr>
   	</table>  
		  </td> ";



$email = $emailp;

	$js ="<script language=\"JavaScript\">
	function validaforma(theForm){
	
		if (theForm.nombre.value == \"\"){
				alert(\"Ingrese Nombre.\");
				theForm.nombre.focus();
				return false;
		}
		if (theForm.emailp.value == \"\"){
				alert(\"Ingrese Email.\");
				theForm.emailp.focus();
				return false;
		}
		if (theForm.consulta.value == \"\"){
				alert(\"Ingrese su consulta.\");
				theForm.consulta.focus();
				return false;
		}
		
		
	
	
	}
	</script>";

}


if($act!="1"){
	

	
	
	$onsubmit ="onSubmit=\"return validaforma(this)\"";

$accion_form = $PHP_SELF."?accion=$accion&act=1";


$contenido .="  <table width=\"100%\" border=\"0\"><tr> 
              $identif  </tr>
               <tr>
                <td align=\"center\" class=\"textos\">&nbsp;</td>
                </tr>
			  <tr> 
               <td> 
       <div align=\"center\"> 
            <textarea name=\"consulta\" rows=\"5\" cols=\"45\" class=\"texto2\"></textarea>
        </div>
      </td>
    </tr>
    <tr> 
      <td> 
        <div align=\"center\">
          <input name=\"Submit\" type=\"image\" value=\"Aceptar\" src=\"images/bot_aceptar.gif\" ></div>
      </td>
    </tr>
  </table>";



}else{

   if($email!=""){
   
   }else{
      header("Location:?accion=$accion&mensaje=1");
   }

$subject_cliente .="Contacto de usuario desde Sitio Web Bohemia";

$mensaje_cliente .="usuario: $id_usuario \n";
$mensaje_cliente .="nombre: $nombre $apllido \n";
$mensaje_cliente .="mail: $email \n";
$mensaje_cliente .="La Consulta es : $consulta\n";

$mail_from = "FROM: $email";
if(!cms_mail("$mail_contacto", "$subject_cliente","$mensaje_cliente","$mail_from")){
  
$contenido .="<br><div align=\"center\"  class=\"textos\"> <font color=\"#FF0000\">Existe algun tipo de problema intente mas tarde Gracias<br>
           </font> </div>";
   }else{

 $contenido .="<br><div align=\"center\"  class=\"textos\"> Gracias $nombre $apellido su mail<br>
           sera respondido a la brevedad</div>";
   }
    


}

?>