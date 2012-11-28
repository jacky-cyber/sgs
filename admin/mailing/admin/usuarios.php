<?php
$msg = $HTTP_GET_VARS['msg'];


if($msg==1){
$mensaje ="Datos Guardados";
}



$contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Administraci&oacute;n  de Usuarios</td>
                </tr>
				<tr>
                  <td align=\"center\" class=\"textos\">&nbsp;</td>
                </tr>
              </table>";

			  
			  

    $query= "SELECT  id_tipo_u,descrip   
             FROM mailing_usuario_tipo ";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
            
			$tabla_bases ="   <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Seleccione Bases de Datos:</td>
                                  </tr>
								  <tr>
                                  <td align=\"center\" class=\"textos\">&nbsp;</td>
                                  </tr>
								   <tr>
                                  <td align=\"center\" class=\"textos_rojo\">$mensaje</td>
                                  </tr>
                            	</table>";
			
			 while (list($id_tipo_u,$descrip) = mysql_fetch_row($result)){
			 
			  $query= "SELECT count(*)  
                       FROM mailing_usuario
		               where tipo='$id_tipo_u'";
                  
				   $result2= cms_query($query);
		         //  $num=mysql_num_rows($result2);
			       list($tot_user) = mysql_fetch_row($result2);
				   
				   $lista_datos_tabla .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
				                         <td align=\"left\" class=\"textos\">$descrip </td>
				   						 <td align=\"center\" class=\"textos\">$tot_user</td> </tr> ";
			 
			 
			$option_sel .="<option value=\"$PHP_SELF?accion=$accion&act=$act&tipo=$id_tipo_u&act_all=1\">$descrip </option>";   
						   }
			  
			  
			  
			  
$bases ="   <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr>
                <td align=\"center\" class=\"textos\"><a href=\"$PHP_SELF?accion=$accion&act=$act&act_all=6\">Crear Usuario</a> 
				</td>
				<td align=\"center\" class=\"textos\"><a href=\"$PHP_SELF?accion=$accion&act=$act&act_all=7\">Crear Base</a> 
				</td>
                </tr>
          	</table>

 <table width=\"50%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
             <tr>
               <td align=\"center\" class=\"textos\">Listar Usuarios por Bases: </td>
               <td align=\"center\" class=\"textos\">
			   
		
			
            <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
            <option value=\"#\" selected>---></option>
			<option value=\"$PHP_SELF?accion=$accion&act=$act&tipo=all&act_all=1\" >Todos</option>
               $option_sel
              </select>
       
           
			   </td>			   
               </tr>
			   <tr><td>&nbsp;</td>
			   <td></td>
			   </tr>
         	<tr><td colspan=\"2\">
			    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\" bgcolor=\"#666666\">
                  $lista_datos_tabla
              	</table>
			</td></tr>
         	</table>  
			<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                     <tr>
					      <td align=\"center\" class=\"textos_rojo\">$mensaje</td>
                           </tr>
                    	</table>
			";		  
			  
			  
$contenido .=$bases;


if(isset($act_all)){


switch ($act_all) {
     case 1:
         include ("admin/mailing/admin/listar_usuarios.php");
         break;
	 case 2:
         include ("admin/mailing/admin/VerContenido.php");//no tiene codigo
         break;
      case 3:
         include ("admin/mailing/admin/editar_usuarios.php");
         break;
	   case 4:
         include ("admin/mailing/admin/guardar_edit_usuarios.php");
         break;
	  case 5:
         include ("admin/mailing/admin/borrar_usuarios.php");
         break;
	  case 6:
         include ("admin/mailing/admin/add_usuario.php");
         break;
	   case 7:
         include ("admin/mailing/admin/add_base.php");
         break;
	 case 8:
         include ("admin/mailing/admin/actualizar_estado.php");
         break;
	
       case 9:
         include ("admin/mailing/admin/agrega_base.php");
         break;
       
	    case 10:
         include ("admin/mailing/admin/borrar_base.php");
         break;
	   case 11:
         include ("admin/mailing/admin/exp_csv.php");
         break;
	
   	default:
	   $def ="ok";
	 
       
 }




}

?>