<?php


if($id_perfil_u==0){
	//administrador
	$checked0="checked";
	
}elseif($id_perfil_u==3){
	//director
	$checked3="checked";
	
}elseif($id_perfil_u==1){
	$checked1="checked";
	//funcionario
	
}elseif($id_perfil_u==999){
	$checked1="disabled";
	//web master	
	
	$checked0="disabled";
	$checked3="disabled";
	$checked1="disabled";
	$webmaster = "<input type=\"hidden\" name=\"id_perfil_u\" value=\"999\">";
	
}else{
	$checked1="checked";
}



if($msg ==1){	
	
		$msg =  "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                    <td align=\"center\" class=\"textos\"><b>Problemas con su Contrase&ntilde;a</b></td>
                    </tr>
	               </table>";
	
	}
	
if($msg==2){
	$msg =  "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                    <td align=\"center\" class=\"textos\"><b>Sus datos han sido cambiados, gracias.</b></td>
                    </tr>
	               </table>";

}
 
 
 $fecha_nac_u = fechas_html($fecha_nac_u);




 $js .= "<script language=\"JavaScript\">
	 	   function validaforma(theForm){
	 		if (theForm.nombre_u.value == \"\"){
	 					alert(\"Debe Ingresar un Nombre.\");
	 					theForm.nombre_u.focus();
	 					return false;
	 			}
			if (theForm.apellido_u.value == \"\"){
	 					alert(\"Debe Ingresar un Apellido.\");
	 					theForm.apellido_u.focus();
	 					return false;
	 			}

	 		if (theForm.password_u.value !=	\"\"){
	 					
						if(theForm.password_new_u.value == \"\"){
						alert(\"Debe ingresar una contrase\u00F1as nueva valida.\");
	 					theForm.apellido_u.focus();
	 					return false;
						
						}
						
	 			}
			   if(theForm.password_u.value!=\"\"){
			         
	 			
	 			if (theForm.password_u.value == theForm.password_new_u.value ){
	 					alert(\"Las Contrase\u00F1as deben ser distintas.\");
	 					theForm.apellido_u.focus();
	 					return false;
	 			}
			if (theForm.password_new_u.value.length < 6 ){
	 					alert(\"La Contrase\u00F1a nueva debe ser mas larga.\");
	 					theForm.apellido_u.focus();
	 					return false;
	 			}

	 		   return true;
			}

	 	  }
			
		  </script>";



 
 $onsubmit = "onSubmit=\"return validaforma(this)\"";


$contenido= "$msg<table width=\"75%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
	  <tr >
	  <td align=\"center\" class=\"cabeza_rojo\">Ingreso de datos
	  
	  </td>
	  </tr>
      <tr  bgcolor='#F8F8F8'\">
      <td align=\"center\" class=\"textos\" >
 <table width=\"75%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
   <tr >
      <td  align=\"left\" class=\"textos\"></td>
      <td align=\"center\" class=\"textos\"> &nbsp;</td>
      <td align=\"left\" class=\"textos\">
      </td>
      </tr>
    <tr>
      <td  align=\"left\" class=\"textos\">Nombre:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input  type=\"text\" size=\"25\" name=\"nombre_u\" value= \"$nombre_u\" class=\"textos\" > (*)
      </td>
      </tr>
      <tr>
      <td  align=\"left\" class=\"textos\">Apellido:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input  type=\"text\" size=\"25\" name=\"apellido_u\" value= \"$apellido_u\" class=\"textos\"> (*)
      </td>
      </tr>
      <tr>
      
        <td  align=\"left\" class=\"textos\">Login:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input  type=\"text\" size=\"25\" name=\"login_u\" value= \"$login_u\" class=\"textos\" readonly>
      </td>
      </tr>
      
      <tr>
      <td  align=\"left\" class=\"textos\">Password Actual:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input  type=\"password\" size=\"25\" name=\"password_u\" class=\"textos\">
     <font color=\"#999999\"> (1)</font>
      </td>
      
      
        </tr>
		<tr >
  	 	 <td  align=\"left\" class=\"textos\">Nueva Password:</td>
     	 <td align=\"center\" class=\"textos\">&nbsp;</td>
    	 <td align=\"left\" class=\"textos\">
      	 <input  type=\"password\" size=\"25\" name=\"password_new_u\" class=\"textos\">
      	 <font color=\"#999999\"> (1)</font>
      	 </td>
       </tr>
		
     </table>
	</td>
	</tr>
	
	<tr bgcolor='#F8F8F8'\" ><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
	
	
	 <tr bgcolor='#F8F8F8'\" >
     <td align=\"center\" class=\"textos\"> </td>
      </tr>
   
	
     
      
      
      <tr bgcolor='#F8F8F8'\"><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
	
      <tr bgcolor='#F8F8F8'\">
          <td align=\"center\" class=\"textos\">
            <input class=\"boton\" type=\"submit\" name=\"boton\" value=\"Actualizar mis datos\">
          </td>
          </tr>
          
          <tr bgcolor='#F8F8F8'\"><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
          
    <tr >
   <td align=\"center\" class=\"textos\"  bgcolor='#F8F8F8'\"><font color=\"#999999\"><b>(*) Nota:&nbsp;&nbsp;Estos campos son obligatorios.<br></font>
   <font color=\"#999999\">(1) Nota:&nbsp;&nbsp;Opcional solo si desea cambiar la password.</b></font>
   
   </td><br> 
   </tr> 
          
  <tr bgcolor='#F8F8F8'\"><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  </table> ";


?>