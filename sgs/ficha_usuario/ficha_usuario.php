<?php

$id_user = $_GET['id_user'];

			    $query= "SELECT count(*)
                   FROM  sgs_solicitud_acceso 
                   WHERE id_responsable='$id_user'";
           
			 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
              list($tot_asigaciones) = mysql_fetch_row($result2);
			  


    $query= "SELECT nombre,paterno,id_entidad_padre,id_entidad,id_departamento ,id_perfil,fono,email
           FROM  usuario
           WHERE id_usuario='$id_user'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($nombre,$paterno,$id_entidad_padre,$id_entidad,$id_departamento,$id_perfil_user,$telefono,$email_user) = mysql_fetch_row($result);
	  
	  
	     $query= "SELECT icono ,perfil,funcionario   
           FROM  usuario_perfil
           WHERE id_perfil='$id_perfil_user'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($icono,$perfil,$funcionario) = mysql_fetch_row($result);
	  
	  
	  
	  if($id_entidad!=0){
	  $entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
	  }
	  if( $id_entidad_padre!=0){
	  $entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
	  }
	  if($id_departamento!=0){
	  $depto="Depto ".rescata_valor('sgs_departamentos',$id_departamento,'departamento') ;
	  }
	
	  $perfil_user="Perfil $perfil";
	
	
	
	 $id_perfil=perfil($id_sesion);
	$query= "SELECT funcionario   
           FROM  usuario_perfil
           WHERE id_perfil='$id_perfil'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($funcionario_usuario) = mysql_fetch_row($result);
	 
	 
	 
	 if($funcionario_usuario==1){
	 
	  $contenido = "<table  border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"2\">
                      <tr>
                        <td align=\"left\" class=\"textos\"><strong> <table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" >
  <tr>
  <td  align=\"center\" valign=\"middle\" ><img src=\"images/sitio/sistema/usuario_perfil/icono/$id_perfil_user/$icono\"  title=\"Perfil $perfil\" border=\"0\"/></td>
   
  <td>&nbsp;$nombre $paterno $materno</td>
     
   
  </tr>

</table></strong></td>
                      </tr>
                    <tr>
                        <td align=\"left\" class=\"textos\">$entidad_padre</td>
                      </tr>
                    <tr>
                        <td align=\"left\" class=\"textos\">$entidad</td>
                      </tr>
                    <tr>
                        <td align=\"left\" class=\"textos\">$depto</td>
                      </tr>
                  <tr>
                        <td align=\"left\" class=\"textos\">Fono : $telefono</td>
                      </tr>
                 <tr>
                        <td align=\"left\" class=\"textos\">$email_user</td>
                      </tr>
                  <tr>
                        <td align=\"left\" class=\"textos\">$perfil_user</td>
                      </tr>
                <tr>
                        <td align=\"left\" class=\"textos\">Solicitudes Asignadas $tot_asigaciones</td>
                      </tr>
                   <tr>
                        <td align=\"left\" class=\"textos\">&nbsp; </td>
                      </tr>
                    </table>";
	 }else{
	 
	  $contenido = "<table  border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"2\">
                      <tr>
                        <td align=\"left\" class=\"textos\">
						 <table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" >
  							<tr>
     							<td  align=\"center\" valign=\"middle\" >
     								<img src=\"images/sitio/sistema/usuario_perfil/icono/$id_perfil_user/$icono\"  title=\"Perfil $perfil\" border=\"0\"/>
     							</td>
     							<td>&nbsp;$nombre $paterno $materno
	 							</td>
   							</tr>

						</table>
						</td>
                      </tr>
                    <tr>
                        <td align=\"left\" class=\"textos\">$perfil_user</td>
                      </tr>
             
                        <td align=\"left\" class=\"textos\">&nbsp;</td>
                      </tr>
                    </table>";
	 }
	 
	  

?>