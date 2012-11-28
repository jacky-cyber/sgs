<?php
$imagen_name= $HTTP_POST_FILES['imagen']['name'];
$imagen= $HTTP_POST_FILES['imagen']['tmp_name'];


$nombre = $_POST['nombre'];
$descrip = $_POST['descrip'];
$fecha = $_POST['fecha'];

//$id_cliente = $_GET['id_entidad'];
$gal_admin = $_GET['gal_admin'];
$id_cliente =$_GET['id_cliente'];
$id_gal_del = $_GET['id_gal_del'];
$delgal = $_GET['delgal'];


if($delgal=="ok"){

   $Sql ="DELETE FROM galerias
			          WHERE id_galeria='$id_gal_del'";
             if(cms_query($Sql) or die("$MSG_DIE -1 QR-$Sql")){
			 
			 //echo "gal/$id_cliente/$id_gal_del";
			 
			 removedir("gal/$id_cliente/$id_gal_del");
			 }

			  
}



$accion_form ="index.php?id_usuario=$id_usuario&accion=5006&user=$user&id_cliente=$id_cliente&gal_admin=1";

if($gal_admin==1){
       $id_galeria = new_uid();
               $qry_insert="INSERT INTO galerias  (id_cliente,id_galeria,nombre,descripcion,fecha,imagen)
                            VALUES ('$id_cliente','$id_galeria','$nombre','$descrip','$fecha','$imagen_name')";
	
          $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
			
		
			
		
		
			//umask(011); 
			if(is_dir("gal/$id_cliente")){
					mkdir("gal/$id_cliente/$id_galeria",0777);	
			        chmod("gal/$id_cliente/$id_galeria",0777);
			}else{
					mkdir("gal/$id_cliente",0777);	
			        chmod("gal/$id_cliente",0777);
					
					
							mkdir("gal/$id_cliente/$id_galeria",0777);	
			                chmod("gal/$id_cliente/$id_galeria",0777);
			
			
			}
		
		           if (isset($imagen)){
                      $imagen2 = ereg_replace('&','*',$imagen_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);
					      if (!copy($imagen, "gal/$id_cliente/$id_galeria/$imagen2"))
					         {
					         echo "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         echo "La imagen chica no exixte o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name";
					         }
					
                      }
	
	}
	
	

 $query= "SELECT id_cliente,id_galeria,fecha,nombre,descripcion 
                   FROM  galerias
                   WHERE id_cliente='$id_cliente'";
 $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
		   
		   $galerias ="<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
             <tr>
               <td class=\"textos\" align=\"center\">N°</td>
			   <td class=\"textos\" align=\"center\">Nombre</td>
			   <td class=\"textos\" align=\"center\">Fecha</td>
             </tr>";
          
		   
           while (list($id_cliente,$id_gal_del,$fecha,$nombre,$descripcion) = mysql_fetch_row($result)){
        		$cont++;
				$galerias .="<tr>
               <td class=\"textos\">$cont</td>
			   <td class=\"textos\">$nombre</td>
			   <td class=\"textos\">$fecha</td>
			   <td class=\"textos\">
			   <a href=\"index.php?id_usuario=$id_usuario&user=$user&accion=2600&id_cliente=$id_cliente&id_galeria=$id_gal_del\">
							  <img src=\"images/iconos/lupa.jpg\" alt=\"Ver Galeria\" border=\"0\"></a>
			   </td>
			   <td class=\"textos\">
			   <a href=\"index.php?id_usuario=$id_usuario&accion=5006&user=$user&id_cliente=$id_cliente&id_gal_del=$id_gal_del&delgal=ok\">
							  <img src=\"images/iconos/not_ok.jpg\" alt=\"Borrar Galeria\" border=\"0\"></a>
			   </td>				   
             </tr>"	;
           }
		   
		   
		   $galerias .="</table>";



$contenido .="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td align=\"center\" class=\"textos\" >Crear una Gleria Nueva</td>
  </tr>
  <tr>
    <td align=\"center\" class=\"textos\">&nbsp;</td>
  </tr>
</table>";

$fecha =   date (d)."-". date(m)."-".date(Y);

$contenido .="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td>
				  <table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
            <tr>
                   <td align=\"left\" class=\"textos\">Nombre</td>
               <td align=\"left\" class=\"textos\">
             <input type=\"text\" name=\"nombre\" class=\"inp2\" > 
                    </td>
             </tr>
               <tr>
               <td align=\"left\" class=\"textos\" valign=\"top\">Descripci&oacute;n</td>
                 <td>
                <textarea name=\"descrip\" cols=\"30\" class=\"inp2\" rows=\"7\"></textarea>
                   </td>
              </tr>
			  <tr>
               <td align=\"left\" class=\"textos\">Fecha</td>
                 <td>
                      <input type=\"text\" name=\"fecha\" class=\"inp2\" value=\"$fecha\" size=\"10\"> 
                   </td>
              </tr>
			  <tr>
               <td align=\"left\" class=\"textos\">Imagen</td>
                 <td>
                      
					  <input type=\"file\" name=\"imagen\" class=\"inp2\">
                   </td>
              </tr>
			  
                </table>
				  
				  </td>
                </tr>
				<tr><td height=\"15\"></td></tr>
				<tr><td align=\"center\">
				<input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
                            </td></tr>
              </table>
			  <br>$galerias
";


?>