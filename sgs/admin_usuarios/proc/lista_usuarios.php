<?php

$filtro = $_POST['filtro'];

//lista para seleccionar el establecimiento
$accion_form = "index.php?accion=$accion";

if($filtro!=""){
	
$condicion =" and  nombre like '%$filtro%' or paterno like '%$filtro%' or materno like '%$filtro%' or email like '%$filtro%' or direccion like '%$filtro%' ";	
	
	
}


$t = $_GET['t'];
	     	    
  $query= "SELECT DISTINCT u.id_usuario,u.nombre,u.paterno, u.id_perfil,u.email, u.estado,u.id_departamento,u.id_entidad_padre,u.id_entidad    
           FROM  usuario u , usuario_perfil up
		   WHERE u.id_perfil=up.id_perfil and up.funcionario=1
            $condicion
            order by nombre
			";
			
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_user_u,$nombre,$paterno2, $id_perfil_u,$email, $estado, $id_depto,$id_entidad_padre,$id_entidad) = mysql_fetch_row($result2)){
      	
		//$linea_listado_usuarios = html_template('linea_listado_usuarios');
   	
	$link_activo="";
	
	
  	if($estado==0 ){
	       
	    $link_activo ="<div id=\"v_$id_user_u\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user_u&axj=1','v_$id_user_u');\" >
					&nbsp;<img src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Usuario creado pero con su cuenta aun desactiva. click para Desactivar Permanentemente\">
					  </div>";
	    
	  }elseif($estado==1){
	  	
	   $link_activo ="<div id=\"v_$id_user_u\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user_u&axj=1','v_$id_user_u');\">
	   					&nbsp;<img  src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Usuario activo. Click para Desactivar\">
						</div>";
	
	  }elseif($estado==2){
	  	
	    $link_activo ="<div id=\"v_$id_user_u\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user_u&axj=1','v_$id_user_u');\">
						&nbsp;<img src=\"images/minus_circle.gif\"  border=\"0\" alt=\"Cuenta Bloqueada. Click para Activar Cuenta\">
                       </div>";
	
	  }  
	  if($id_user_u==id_usuario($id_sesion)){
	 			if($estado==0 ){
	       
	    $link_activo ="&nbsp;<img src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Usuario creado pero con su cuenta aun desactiva. click para Desactivar Permanentemente\">
					  ";
	    
	  }elseif($estado==1){
	  	
	   $link_activo ="&nbsp;<img  src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Usuario activo. Click para Desactivar\">
						";
	
	  }elseif($estado==2){
	  	
	    $link_activo ="&nbsp;<img src=\"images/minus_circle.gif\"  border=\"0\" alt=\"Cuenta Bloqueada. Click para Activar Cuenta\">
                       ";
	
	  } 
	  $link_del ="&nbsp;";
		}else{
		 $link_del = "<a href=\"javascript:confirmar('Esta seguro de eliminar $nombre_u','?accion=$accion&act=3&id_user=$id_user_u')\">
		  <img src=\"images/del.gif\" border=\"0\" alt=\"Borrar\"></a>";
		
		}
        
		//$id_entidad_padre,$id_entidad
		$nombre = nombre_usuario2($id_user_u);
	  $depto= rescata_valor('sgs_departamentos',$id_depto,'departamento'); 
	  $entidad_padre= rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre '); 
	  $entidad_hija= rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
	  
	  if($depto==""){
	  $depto = "<font color=\"#FF0000\">Sin Departamento</font>";
	  }
	  if($entidad_hija=="" or $entidad_padre==""){
			$clase = " style=\"background-color: #FAD1B6;\" ";
 
			}else{
			$clase = "";			
			}
			
	 $link_edit = "<a href=index.php?accion=$accion&act=1&id_user=$id_user_u>
          <img src=\"images/edit.gif\" border=\"0\" alt=\"Editar\"></a>";  
		  
			  $query= "SELECT perfil
	     	           FROM  usuario_perfil
	     	           where id_perfil ='$id_perfil_u'";
	     	     $result3= cms_query($query)or die (error($query,mysql_error(),$php));
	     	    list($perfil) = mysql_fetch_row($result3);
			
			// str_replace("#NOMBRE#","$nombre",$linea_listado_usuarios);
			
      			$lista_usuarios .=asigna_etiquetas('linea_listado_usuarios');

      	 	
		
	     } 	
	

	
	  
      			$cuadro_busquedaS = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                        <tr >
                                          <td align=\"center\" class=\"textos\">Buscar <input type=\"text\" name=\"filtro\" value=\"$filtro\"> 
										  <input type=\"submit\" name=\"Submit\" value=\"Buscar\">
										  </td>
                                          </tr>
										 
                                    	</table>";
      	   
		 $lista_usuarios ="  
							<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
			                    
  <tr class=\"header2\">                               
 <th ><h3>Usuario</h3></th> 
   <th ><h3>Tipo</h3></th>
  <th ><h3>Departamento / Unidad</h3></th>
<th ><h3>Correo Electr&oacute;nico</h3></th>
 <th width=\"10%\"  class=\"nosort\"><h3>Estado</h3></th> 
 <th width=\"8%\"  class=\"nosort\"><h3>Editar</h3></th>


  </thead> 
   <tbody>
   $lista_usuarios
     </tbody> 
 </table>
 ";
		 
	$lista_usuarios = crea_tabla_tiny($lista_usuarios);
	
$modulo_usuarios = html_template('contenedor_lista_usuarios');
$modulo_usuarios = cms_replace("#LINEA_REGISTROS#","$lista_usuarios",$modulo_usuarios);
$modulo_usuarios = cms_replace("#CANT_PAGINAS#",$paginas, $modulo_usuarios);
$modulo_usuarios = cms_replace("#PAGINACION#","$paginacion2",$modulo_usuarios);
$modulo_usuarios = cms_replace("#CUADRO_BUSQUEDA#","$cuadro_busqueda",$modulo_usuarios);
$modulo_usuarios = cms_replace("#ACCION#","$accion",$modulo_usuarios);



  
		  
/*
TEMPLATE

<table width="98%" border="0" cellpadding="0" cellspacing="0">
                 
				 <tr>
                  <td valign="top"><strong>Administración de Usuarios</strong><br />
                  <br />
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>#CUADRO_BUSQUEDA#</td>
<td align="right" > <table   border="0" align="right" cellpadding="0" cellspacing="0">
                                                                     <tr >
                                                                       <td align="center" class="textos">
																	   <a href="index.php?accion=#ACCION#&act=4">
																	    <img src="images/new.gif" alt="Nuevo Usuario" border="0"></a></td>
                                                                       </tr>
                                                                 	<tr >
                                                                       <td align="center" class="textos"> <a href="index.php?accion=#ACCION#&act=4">
																	   Crear Usuario</a></td>
                                                                       </tr>
                                                                 	</table> </td></tr>
</table>
                                        <div align="center">listado de usuarios<br />
                          <br />                   
                    <br />                     
                        <div id="table-block" class="wide">
                          <table cellspacing="0" cellpadding="0">
                            <tbody>
                              <tr class="header">
                                <td width="16%">Usuario</td>
                                <td width="16%">Tipo</td>
                                <td width="14%">Departamento / Unidad</td>
                                <td width="36%">correo electrónico</td>
                                <td width="10%">Estado</td>
                                <td width="8%">Editar</td>
                             <td width="8%">Borrar</td>
                              </tr>
                         
                        
                             #LINEA_REGISTROS#
                            </tbody>
                          </table>
                      </div>
                      <br />
                  <br />
                    #PAGINACION#
					 <br />
                    </div></td>
                </tr>
                <tr><td>
                	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">     
       			<tr>
        			 <td align="left" >
         				<img src="images/ciculo_ok.gif" border="0" >&nbsp;&nbsp;Usuario Activo</td> 
	  			</tr> 
				<tr>
	    			<td align="left" >
	    				<img src="images/ciculo_warring.gif" border="0" >&nbsp;&nbsp;Usuario sin verificar email</td> 
				</tr> 
				<tr>
	    			<td align="left" >
	    				<img src="images/minus_circle.gif" border="0" >&nbsp;&nbsp;Usuario Bloqueado</td> 
				</tr> 
			</table>
                </td></tr>
              </table>


*/


/*linea_listado_usuarios





<tr #CLASE#>
                                <td title="#LOGIN#" align="left" >#NOMBRE# #PATERNO#</td>
                                <td align="left">&nbsp;#PERFIL#</td>
                                <td align="left">&nbsp;#ENTIDAD#</td>
                                <td align="left">&nbsp;#EMAIL#</td>
                                <td>&nbsp;#IMG_ESTADO#</td>
                                <td class="actions">#LINK_EDIT#</td>
                              <td class="actions">#LINK_DEL#</td>
                        </tr>





*/


?>