<?php

//$id_perfil_2      = perfil($id_sesion);
//   and gp.id_perfil = $id_perfil

  $query= "SELECT g.id_cliente, g.id_galeria, g.fecha, g.nombre, g.descripcion, g.imagen, g.id_grupo_galeria, gp.id_grupo_galeria_perfiles, gp.id_perfil, gp.id_grupo_galeria
           FROM galerias g, grupo_galeria_perfiles gp
           WHERE g.id_grupo_galeria = gp.id_grupo_galeria and gp.id_perfil=$id_perfil
		   order by g.id_galeria desc";
  //echo $query;
$result2= cms_query($query)or die (error($query,mysql_error(),$php));

//echo " $query<br>";
	 
while(list($id_cliente,$id_galeria,$fecha,$nombre,$descripcion,$imagen,$id_grupo_galeria, $id_galeria_perfiles, $id_perfil) = mysql_fetch_row($result2)) {

 	      
	 $cont_foto=0;
	  $peso_carpeta=0;
	  
	  //echo "$fuente/$id_cliente/$id_galeria/";
	  if(!is_dir("$fuente_relativa/$id_cliente/$id_galeria/") and $id_galeria!="")
	  {
	  	mkdir("$fuente_relativa/$id_cliente/$id_galeria/");
	  }
	  	  $dir = opendir("$fuente_relativa/$id_cliente/$id_galeria/"); 
			$i = 0;
			while ($images[$i][0] = readdir($dir)){
			$cont_foto++;
				if($images[$i][0]=="." or $images[$i][0]=="..") continue;				 
				$aux = filesize("$fuente_relativa/$id_cliente/$id_galeria/".$images[$i][0])/1048576;
				$images[$i][1] = round($aux,2);
			  $peso_carpeta= $peso_carpeta + $images[$i][1];
			}
			
		$grupo_galeria_nom = grupo_galeria_nombre($id_grupo_galeria);	
		   $cont++;
		   
		   
		   $tabla .="
		   <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
		   <td align=\"center\" class=\"textos\">$cont</td>
		   <td align=\"left\" class=\"textos\">
		  &nbsp; $nombre
		   </td> 
		    <td align=\"left\" class=\"textos\">
		  &nbsp; 
		   $grupo_galeria_nom
		   </td> 
		   <td align=\"left\" class=\"textos\">
		     &nbsp;$peso_carpeta Mg
		   </td> 
		 <td align=\"center\" class=\"textos\">
		      &nbsp;$cont_foto
		   </td> 
		  <td align=\"center\" class=\"textos\">
		    <a href=\"index.php?accion=$accion&act=3&id_galeria=$id_galeria\">
 				<img src=\"images/add_foto.gif\" alt=\"Agregar Foto\" border=\"0\">
 			</a>
		   </td> 
		   <td align=\"center\" class=\"textos\">
		    <a href=\"index.php?accion=$accion&act=5&id_galeria=$id_galeria\">
 				<img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\">
 			</a>
		   </td> 
		  <td align=\"center\" class=\"textos\">
		    <a href=\"index.php?accion=$accion&act=6&id_galeria=$id_galeria\">
 				<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\">
 			</a>
		   </td> 
		
		   </tr>"; 
		 }


				  
		   
		 
		 $contenido = "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                         <tr>
                           <td align=\"right\" class=\"textos\">
						   
						   <table width=\"70\"  border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">
             <tr >
               <td align=\"center\" class=\"textos\">
			   <a href=\"index.php?accion=$accion&act=1\">
						   <img src=\"images/new.gif\" alt=\"\" border=\"0\">
						   </a>
			   </td>
               </tr>
         	 <tr>
               <td align=\"center\" class=\"textos\">
			   <a href=\"index.php?accion=$accion&act=1\">
						   Add Galer&iacute;a
						   </a>
			   </td>
               </tr>
         	</table>
						   </td>
                         </tr>
                        <tr>
                           <td align=\"center\" class=\"textos\" >
						   &nbsp;
						   </td>
                         </tr>
                       <tr >
                           <td align=\"center\" class=\"textos\" >
						   <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"2\" class=\"cuadro\">
                            <tr bgcolor=\"#F8F8F8\">
							<td align=\"center\" width=\"30\" class=\"textos\">N&ordm;</td>
							<td align=\"center\" class=\"textos\">Galer&iacute;a</td>
							<td align=\"center\" class=\"textos\">Grupo Galer&iacute;a</td>
							<td align=\"center\" width=\"30\" class=\"textos\">Peso</td>
							<td align=\"center\" width=\"30\" class=\"textos\">Fotos</td>
							<td align=\"center\" width=\"30\" class=\"textos\">Gal</td>
							<td align=\"center\" width=\"30\" class=\"textos\">Edit</td>
							<td align=\"center\" width=\"30\" class=\"textos\">Del</td>
							
							</tr> 
							
							$tabla
                         	</table>
						   </td>
                         </tr>
                       </table>";
		

?>