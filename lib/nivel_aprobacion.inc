<?php

	     $acceso_usuario    = $id_perfil;


           if (($acceso_act == $perfil_administrador OR $acceso_act == $perfil_wm) && $nivel == 1){
			   $disable1 = "disabled";
			   $disable2 = "disabled";
			   $disable3 = "disabled";
	           }
           if (($acceso_act  == $perfil_administrador OR $acceso_act == $perfil_wm) && $nivel == 2){
			   $disable1 = "disabled";
			   $disable2 = "disabled";
			   $disable3 = "";
		   }

           if ($acceso_act == $perfil_funcionario){
			   $disable1 = "disabled";
			   $disable2 = "disabled";
			   $disable3 = "disabled";
		   }

           if ($acceso_act == $perfil_director){
			   if ($nivel <> 1){
				   $disable1 = "disabled";
				   $disable2 = "disabled";
				   $disable3 = "disabled";
			   }
		       else {
				   $disable1 = "";
				   $disable2 = "disabled";
				   $disable3 = "disabled";		   
				}

		   }

//  echo "ID $acceso $id_perfil<br>";
    

		 switch ($nivel){
			 case 1:
			   $nivel_ok = "
			 <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
			  <tr> 
			    <td align=\"center\" class=\"texto\"><img src=\"images/ok.gif\"></td>
			    <td align=\"center\" class=\"texto\">
			    <input type=\"checkbox\" name=\"aprueba_dire_$id\" value=\"$id\" $disable1></td>
			    <td align=\"center\" class=\"texto\">
			    <input type=\"checkbox\" name=\"aprueba_central\" $disable2></td>
			   </tr>
			  </table>";
			 break;

			 case 2:
			   $nivel_ok = "
			 <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
		          <tr> 
		           <td align=\"center\" class=\"texto\"><img src=\"images/ok.gif\"></td>
		           <td align=\"center\" class=\"texto\"><img src=\"images/ok.gif\"></td>
		           <td align=\"center\" class=\"texto\">
		           <input type=\"checkbox\" name=\"aprueba_central_$id\" value=\"$id\" $disable3></td>
			   </tr>
			  </table>";

			 break;
			 case 3:
			   $nivel_ok = "
			 <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
                          <tr> 
		           <td align=\"center\" class=\"texto\"><img src=\"images/ok.gif\"></td>
		           <td align=\"center\" class=\"texto\"><img src=\"images/ok.gif\"></td>
		           <td align=\"center\" class=\"texto\"><img src=\"images/ok.gif\"></td>
			  </tr>
			 </table>";
			 break;

			 case 13:
			   if ($acceso_usuario == $perfil_administrador OR $acceso_usuario == $perfil_wm){
			       $nivel2_objetado = "---&nbsp;";
			       
			       $nivel3_objetado = "<img src=\"images/not.gif\" alt=\"Objetado\" >";
			   }
			   else {
			       $nivel2_objetado = "<img src=\"images/not.gif\"  border=\"0\" >";
			       $nivel3_objetado = "---&nbsp;";
			   }

			   $nivel_ok = "
			 <table width=\"98%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">
                          <tr> 
		           <td align=\"center\" class=\"texto\">---&nbsp;</td>
			   <td align=\"center\" class=\"texto\">&nbsp;$nivel2_objetado</td>
		           <td align=\"center\" class=\"texto\">&nbsp;$nivel3_objetado</td>
			  </tr>

			 </table>";
			 break;

			 default:
			   $nivel_ok = "";
			 break;
	 
		 }



//Si es perfil administrador o WM
	 	 if ($id_perfil == $perfil_remuneraciones){
			 if ($nivel == 1){
			    $link_obj = "<a href=\"index.php?accion=$accion&act=13&$id_query\">
			    <img src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"\"></a>";
			 }

			 if ($nivel == 2){
			    $link_obj = "<a href=\"?accion=$accion&act=13&$id_query\">
			    <img src=\"images/minus_circle.gif\" border=\"0\" alt=\"Objetar Solicitud\"></a>";
				$botton_aprobar = 1;
			 }

			if ($nivel == 3) {
				$link_obj = "
				<img src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Aprobado\">";
			 }

			 if ($nivel == 13) {
				 if ($id_usuario == $id_usuario_act){
			       $link_obj = "<a href=\"index.php?accion=$accion&act=15&$id_query\">
			       <img src=\"images/plus.gif\" alt=\"Corregir Datos\" border=\"0\"></a>";
			    }
				else {
			     $link_obj = "<img src=\"images/minus.gif\">";
			    }
		     }

			 $objetar     = "<td align=\"center\">$link_obj</td>";
		 }
		 
	///////////////////////////

	
	
	//Perfil Director
		 
	 	 if ($id_perfil == $perfil_director){
			 if ($nivel == 1){
			    $link_obj = "<a href=\"?accion=$accion&act=13&$id_query\">
			    <img src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Objetar Solicitud\">";
				$botton_aprobar = 1;
			 }
			 if ($nivel == 2){
			  /*  $link_obj = "<a href=\"index.php?accion=$accion&act=13&$id_query\">
			    <img src=\"images/minus_circle.gif\" border=\"0\" alt=\"\"></a>";
				* */
				
				  $link_obj = "<img src=\"images/minus_circle.gif\" border=\"0\" alt=\"\">";
			
			 }

			if ($nivel == 3) {
				$link_obj = "
				<img src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Aprobado\">";
				
				
			 }

			 if ($nivel == 13) {
				 if ($id_usuario == $id_usuario_act){
			      $link_obj = "<a href=\"index.php?accion=$accion&act=15&$id_query\">
			       <img src=\"images/plus.gif\" alt=\"Corregir Datos\" border=\"0\"></a>";
			    }
				
				else {
			     $link_obj = "<img src=\"images/minus.gif\">";
			    }
					
		     }

			 $objetar     = "<td align=\"center\">$link_obj</a></td>";
		 }
		 
		 
//////////////////////


// Perfil Funcionario
	 	 if ($id_perfil == $perfil_funcionario){
			
			 if ($nivel == 1 ){
			    $link_obj = "
			    <img src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"\">";
			 }
			 if ($nivel == 2){
			    $link_obj = "
			    <img src=\"images/minus_circle.gif\" border=\"0\" alt=\"\">";
			 }

			if ($nivel == 3) {
				$link_obj = "
				<img src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Aprobado\">";
			 }

			 if ($nivel == 13) {
			  

			        $link_obj = "<a href=\"index.php?accion=$accion&act=15&$id_query\">
			       <img src=\"images/minus.gif\" alt=\"Corregir Datos\" border=\"0\"></a>";
		         }


			 $objetar     = "<td align=\"center\">$link_obj</a></td>";
		 }
///////////////////////////	 


		 //echo $id_query;

?>