<?php

$act = $_GET['act'];
$id_cliente = $_GET['id_cliente'];
$id_gal = $_GET['id_gal'];
$id_noticia = $_GET['id_noticia'];
$add = $_GET['add'];
$id_galeria = $_GET['id_galeria'];




  
      if($add=="ok"){  
      	
      	
        $Sql ="UPDATE noticias
        	   SET id_galeria='$id_galeria'
        	   WHERE id_noticia ='$id_noticia'";
      // echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
		 
		 $msg ="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">Galeria Agregada</td>
                        </tr>
                      </table>";
		 
   
      }


  $query= "SELECT id_cliente,id_galeria,nombre,imagen, fecha  
           FROM  galerias 
		   ORDER BY fecha";
     $result1= cms_query($query);    
	
  
  while(list($id_cliente,$id_galeria,$nom_galeria,$imagen, $fecha) = mysql_fetch_row($result1)){
  
	//echo "$id_cliente, $id_galeria,$nom_galeria,$imagen";
	
	
	  $query= "SELECT id_galeria   
               FROM  noticias
               WHERE id_noticia='$id_noticia'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_g) = mysql_fetch_row($result);
		  
		  if($id_galeria==$id_g){
		  		$marca ="*";
		  }else{
		  		$marca ="";
		  }
		  
		  
	 
	$tabla .="
	
	          <tr>
              <td align=\"left\">
			     <a href=\"index.php?accion=$accion&id_galeria=$id_galeria&id_noticia=$id_noticia&act=$act&add=ok\">
			     <img src=\"gal/imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=70\" alt=\"thumbnail\"  border=\"0\" title=\"ver la im&aacute;gen ampliada\"/></a>
			  </td>
			  <td align=\"left\" class=\"textos\" valign=\"top\">
			  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	             <tr>
	                  <td align=\"left\" class=\"textos\"> $marca Nombre Galeria: $nom_galeria</td>	                  
	             </tr>
	             <tr>
	                  <td align=\"left\" class=\"textos\">Fecha Galeria: $fecha</td>	                  
	             </tr>
		</table>
		</td>
		</tr>";
			  
			  
			 
						   
			   }

    

  
$contenido .= "<table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"4\">
	  <tr><td align=\"center\" class=\"textos\" colspan=\"2\">$msg</td></tr> 
	<tr><td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp; </td></tr>
	<tr><td align=\"center\" class=\"textos\" colspan=\"2\"><h3>Galerias Disponibles</h3></td></tr> 
   $tabla
  
	</table>";
?>