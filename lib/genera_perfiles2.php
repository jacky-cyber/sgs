<?php

$query_check = "SELECT id_perfil,perfil  
          		FROM usuario_perfil 
		  		
		  		ORDER BY id_perfil";		  
//	echo $query;  
	
$result_user_check = cms_query($query_check) or die ("problemas en la consulta 1.<br>$query_check");


 while(list($id_perfil_check,$perfil_check) = mysql_fetch_row($result_user_check)){
	           
			 
				 if($id_perfil_check==$id_perfil_u or $desabilita_ext=="ok"){
				  $check_check="checked";
				  $desabilita= "disabled";
				 }else{
				  $desabilita= "";
				  $check_check="";
				 }
			 
	        $nivel2_check= nivel_perfil($id_perfil_check);
			
			if($id_contenido!=""){
			
			   if(contenido_perfil($id_contenido,$id_perfil_check)){
   
				  $check_check="checked";
				  $oculta ="<input type=\"hidden\" name=\"temp_id_perfil_check_$id_perfil_check\" value=\"1\">";
				 // echo "temp_id_perfil_check_$id_perfil_check <br>";
			   }else{
			   	  $oculta = "";
				
			   }
			}
			
			
			if($nivel_check==$nivel2_check and hijos_perfil($id_perfil_check)==true){
	
	
			
	
	
				$check_perfiles_check .= "<td align=\"center\" class=\"textos\">
				<span onClick=\"sendQuerystring('$id_perfil_check')\">
					<a href=\"#lperf\">$perfil_check</a></span>
       	        <input type=\"$tipo\" name=\"id_perfil_check_$id_perfil_check\" value=\"$id_perfil_check\" ".$check_check." $desabilita >
				$oculta</td>";
       
		    }elseif($nivel_check==$nivel2_check){
				
				$check_perfiles_check .= "<td align=\"center\" class=\"textos\">$perfil_check
       			<input type=\"$tipo\" name=\"id_perfil_check_$id_perfil_check\" value=\"$id_perfil_check\" ".$check_check."  $desabilita>
				$oculta</td>";
       
				
			}
	
		
	}
	
	$check_perfiles_check=" <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		<tr><td align=\"center\" class=\"textos\">
		$camino_perfil_check
		</td></tr>
		<tr>
		$check_perfiles_check
		</tr>
		<tr><td align=\"center\" class=\"textos\">
		<input type=\"hidden\" name=\"id_p_check\"> </td></tr> 
		</table>";


?>