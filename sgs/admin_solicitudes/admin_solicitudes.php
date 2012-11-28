<?php

switch ($act) {
     case 1:
	  $url=$_SERVER['REQUEST_URI'];
			 $url= str_replace("&axj=1","",$url);
			 $url= $url."&axj=1&p=1";
	 		 //$print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"MM_openBrWindow('$url','','scrollbars=yes,width=650,height=820')\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";
			 $folio = $_GET['folio'];
			 $print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"window.open('index.php?accion=$accion&act=13&folio=$folio&axj=1&p=1','ventana','width=800,height=800,resizable=no');\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";
        
         include ("sgs/admin_solicitudes/admin_solicitudes_ver.php");
	 //$act_modulo="Editar Solicitud a Asignar";
         break;
	 case 2:
         include ("sgs/admin_solicitudes/admin_solicitudes_update.php");
		 header("location:index.php?accion=$accion&act=1&folio=$folio&mensaje=ok");
         break;
	 case 3:
	 
	  $url=$_SERVER['REQUEST_URI'];
			 $url= str_replace("&axj=1","",$url);
			 $url= $url."&axj=1&p=1";
	 		 $print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"MM_openBrWindow('$url','','scrollbars=yes,width=650,height=820')\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";
        
        
	    include ("sgs/reasignacion/detalle_reasignacion.php");
     
         break;
	 case 4:
         include ("sgs/reasignacion/reasignar_solicitud.php");
         break;
   	 case 6:
         include ("sgs/admin_solicitudes/listado.php");
         break;
   	 case 7:
         //include ("sgs/admin_solicitudes/listado.php");
		 $condicion ="";
		 $filtro_oficina = $_POST['filtro_oficina'];
		 $filtro_responsable = $_POST['filtro_responsable'];
		 
		 $Estados_etapa_fin	= configuracion_cms('Estados_etapa_fin');
	$Estados_etapa_respondida =  configuracion_cms('Estados_etapa_respondida');
	$Estados_pendiente_rectificacion =  configuracion_cms('Estados_pendiente_rectificacion');
	
		 
		     $query= "SELECT id_entidad  
                    FROM  usuario
                    WHERE id_usuario='$id_usuario'";
              $result= mysql_query($query)or die (error($query,mysql_error(),$php));
              list($id_entidad) = mysql_fetch_row($result);
			  
			  
		if($filtro_oficina!=""){
		 $condicion .=" and id_departamento ='$filtro_oficina' ";
		 }
		 
		 
		 if($filtro_responsable!=""){
		 
		 
         		
				
				
		 
		     $query= "SELECT DISTINCT id_usuario  
                    FROM  usuario
                    WHERE nombre like '%$filtro_responsable%' or paterno like '%$filtro_responsable%'";
              $result= mysql_query($query)or die (error($query,mysql_error(),$php));
               while (list($id_us) = mysql_fetch_row($result)){
         				$lista_id .="$id_us,";		   
         		 }
		 		$lista_id = substr($lista_id, 0, strlen($lista_id) - 1);
				if($lista_id!=""){
					$condicion .=" and u.id_usuario IN($lista_id)";
				}
				
		 }
		 
		 
		   $query= "SELECT id_usuario,nombre,paterno , up.perfil 
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil and up.maneja_solicitudes = 1 
			   and id_entidad= '$id_entidad' and u.estado=1 $condicion
			   order by perfil,nombre,paterno asc";
			  
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
  
	while (list($id_responsable,$nombre,$paterno, $perfil_user) = mysql_fetch_row($result)){
		
		    $query= "SELECT count(*)
                   FROM  sgs_solicitud_acceso 
                   WHERE id_responsable='$id_responsable' and id_sub_estado_solicitud not in ($Estados_etapa_fin,$Estados_etapa_respondida,$Estados_pendiente_rectificacion)";
           
			 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
              list($tot_asigaciones) = mysql_fetch_row($result2);
			  
			  
		
		
		if ($id_responsable_seleccionado==$id_responsable){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$id_responsable\" ".$seleccionado.">$nombre $paterno ($perfil_user), $tot_asigaciones solicitudes asignadas</option>";
		}
		
		
		 
		 
		 $contenido = "$estados";
         break;
		 case 8:
		 //agrega categoria a solicitud
         	$add_categorias = $_POST['add_categorias'];
			$folio = $_GET['folio'];
			   
					      $query= "SELECT id_solicitud_acceso_categoria   
                           FROM  sgs_solicitud_acceso_categoria
                           WHERE folio='$folio' and id_categoria='$add_categorias'";
                     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
                      if(!list($id_solicitud_acceso_categoria) = mysql_fetch_row($result)){
                			
                             $qry_insert="INSERT INTO sgs_solicitud_acceso_categoria(id_solicitud_acceso_categoria,folio,id_categoria) 
										  values (id_solicitud_acceso_categoria,'$folio','$add_categorias')";
                             $result_insert=mysql_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));			   
                		 }
			
			//$contenido = $add_categorias;
			  
				  
				  $query= "SELECT id_categoria   
                           FROM  sgs_solicitud_acceso_categoria
                           WHERE folio='$folio' ";
                     $result_sol_cat= mysql_query($query)or die (error($query,mysql_error(),$php));
                      while(list($id_categorias) = mysql_fetch_row($result_sol_cat)){
					   $query= "SELECT id_categoria,categoria   
                            FROM  sgs_solicitud_categoria
                            WHERE id_categoria ='$id_categorias'";
                      $result_cat= mysql_query($query)or die (error($query,mysql_error(),$php));
                       while (list($id_categoria,$categoria) = mysql_fetch_row($result_cat)){
					   
                 			$lista_categorias .= "<li id=\"id_cat_$id_categoria\" class=\"link_cat\">
									<img src=\"images/not_ok2.gif\" title=\"Borar esta Categoria\" border=\"0\">&nbsp;
									<a href=\"?accion=$accion&act=9&id=$id_categoria&axj=1\" id=\"link_id_cat_$id_categoria\" name=\"Descripci&oacute;n Categoria\"   >$categoria</a>
									</li>";		   
                 		 }
					  }	 
				  
			$contenido = "<ul>$lista_categorias</ul>";
		  break;

		 
		 
         
		  case 9:
		  $id= $_GET['id'];
			$query= "SELECT descripcion   
                            FROM  sgs_solicitud_categoria
                            WHERE id_categoria ='$id'";
                      $result= mysql_query($query)or die (error($query,mysql_error(),$php));
                       list($descrip) = mysql_fetch_row($result);
					   $contenido = "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                       <tr>
                                         <td align=\"left\" class=\"textos\">$descrip</td>
                                       </tr>
									   <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
									   <tr><td align=\"right\" class=\"mensaje\">Para eliminar esta categor&iacute;a pinche sobre el icono <img src=\"images/not_ok2.gif\" alt=\"\" border=\"0\"></td></tr> 
                                     </table>";
			
         break;
		 
		case 10:
		  //elimina categoria de solicitud
		    $id= $_POST['id'];
			$id = str_replace("id_cat_","",$id);
			$folio= $_POST['folio'];
			
				    $query= "SELECT id_solicitud_acceso_categoria   
                           FROM  sgs_solicitud_acceso_categoria
                           WHERE folio='$folio' and id_categoria='$id'";
                     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
                      if(list($id_solicitud_acceso_categoria) = mysql_fetch_row($result)){
                			
                             $Sql ="DELETE FROM sgs_solicitud_acceso_categoria 
							 		where id_solicitud_acceso_categoria='$id_solicitud_acceso_categoria'";
                              mysql_query($Sql)or die (error($Sql,mysql_error(),$php));
							
							 }
				
				
         break;
		case 11:		
			include ("sgs/reasignacion/ingreso_archivos.php");
			break;
		case 12:
			include("sgs/documentos_sistema/descarga.php");
			break;
		case 13:
			include ("sgs/admin_solicitudes/detalle_solicitud_imprimir.php");
			break;
		 
   	default:
	  
	if($_GET['tp']!=3){
	include ("sgs/reasignacion/lista_solicitudes_reasignacion.php");
	$contenido2 = $contenido;
	
	
	include ("sgs/admin_solicitudes/pantalla_ini.php");
	 $contenido = $contenido2 .$contenido;
	}else{
	include ("sgs/reasignacion/lista_solicitudes_reasignacion.php");
	$contenido2 = $contenido;
	
	include("sgs/admin_solicitudes/lista_admin_solicitudes.php");
	
	 $contenido = $contenido2 .$contenido;
    
	}
	   
 }


 
$css .="<style type=\"text/css\">
	

	.suggestionsBox {
		position: absolute;
		left: 100px;
		margin: 40px 0px 0px 0px;
		width: 200px;
		background-color: #212427;
		-moz-border-radius: 7px;
		-webkit-border-radius: 7px;
		border: 2px solid #000;	
		color: #fff;
		font-family: Helvetica;
		font-size: 11px;
	}
	
	.suggestionList {
		margin: 0px;
		padding: 0px;
	}
	
	.suggestionList li {
		
		margin: 0px 0px 3px 0px;
		padding: 3px;
		cursor: pointer;
	}
	
	.suggestionList li:hover {
		background-color: #659CD8;
	}
</style>";
 
?>