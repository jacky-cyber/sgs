<?php
if($id_perfil!=999){
	header("HTTP/1.0 307 Temporary redirect");
    header("Location:index.php?accion=$accion'");
}else{

$del = $_GET['del'];
$add = $_GET['add'];
if($del!=""){
 $Sql ="DELETE FROM noticias_id_publicador where id_publicador=$del";

 cms_query($Sql);
}

$add=trim($add);
if($add!=""){

  $query= "SELECT id_publicador   
           FROM  noticias_id_publicador
           WHERE id_publicador='$add'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if (!list($id) = mysql_fetch_row($result) and $add!=""){
		$qry_insert="INSERT INTO noticias_id_publicador values ('$add')";
              
                $result_insert=cms_query($qry_insert) or die(error($qry_insert,mysql_error(),$php));
						   
		 }

}

  $query= "SELECT id_usuario,nombre,apellido   
           FROM  usuario WHERE 1 and id_perfil=999";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_public,$nombre,$apellido) = mysql_fetch_row($result)){
			
			$lista_select .="<option value=\"?accion=$accion&act=$act&add=$id_public\">$nombre $apellido</option>"			   ;
		 }

		   $query= "SELECT id_publicador   
                    FROM  noticias_id_publicador";
              $result= cms_query($query)or die (error($query,mysql_error(),$php));
               while (list($id_publicador) = mysql_fetch_row($result)){
			   
			   $nombre = usuario_nombre($id_publicador);
         				$tabla_publicadores .="<tr><td align=\"center\" class=\"textos\">$nombre </td>
								<td align=\"center\" class=\"textos\">
                                 <a href=\"?accion=$accion&act=$act&del=$id_publicador\">
                                     <img src=\"images/del.gif\" alt=\"\" border=\"0\">
                                   </a>
                                </td>  </tr>  "	;	   
         		 }
		 
		 
		 $select="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
		 			<option value=\"#\">----></option>
					$lista_select
		 		</select>";
		 
		 $contenido = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                          <tr >
                           <td align=\"center\" class=\"textos\">
						   $select
						   
						   </td>
                         </tr>
						   <tr >
                             <td align=\"center\" class=\"textos\">&nbsp;</td>
                             </tr>
                       	</table>
		 <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                         <tr><td align=\"center\" class=\"cabeza_rojo\" colspan=\"2\">Publicador </td></tr>
						 
						 
						 
						 $tabla_publicadores
						 
						 
						 </tr>
						 
						 
                       </table>";

}


?>