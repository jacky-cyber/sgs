<?php

include("lib/cuadro_perfiles.php");




//var sBasePath = document.location.pathname.substring(0,document.location.pathname.lastIndexOf('/')) ;
if($titulo==""){
$titulo ="Titulo";
}

if($titulo2_corto==""){
$titulo2_corto="Bajada";
}

if($contenido2==""){
$contenido2="Cuerpo";
}

$var = "destacado_$destacado";
$$var = "checked";


$fckeditor = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr >
        <td align=\"center\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\"><strong>Titulo</strong></td>
        </tr>
		<tr >
        <td align=\"center\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\">
	<input type=\"text\" name=\"titulo\" id=\"titulo\" value=\"$titulo\" size=\"101\" maxlength=\"100\">
	
		
		</td>
        </tr>
  	</table>
	
		
		 <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr >
        <td align=\"center\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\"></td>
        </tr>
		 <tr >
        <td align=\"center\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\">
		<textarea id=\"titulo2_corto\" name=\"titulo2_corto\"  rows=\"2\">$titulo2_corto</textarea>
		</td>
        </tr>
  	</table>
		
		
	
		<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr >
        <td align=\"center\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\"></td>
        </tr>
  	 <tr >
        <td align=\"center\" class=\"textos\" height=\"2\" bgcolor=\"#FFFFFF\">
		<textarea id=\"contenido2\" name=\"contenido2\" >$contenido2</textarea>
		</td>
        </tr>
  	</table>";
	
	
	
	
$js .=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
      window.onload = function()
      {
        
     
        var oFCKeditor2 = new FCKeditor( 'titulo2_corto' ) ;
        oFCKeditor2.BasePath = \"fckeditor/\" ;
		oFCKeditor2.ToolbarSet = \"Basic\";
		oFCKeditor2.Height = 100 ;
        oFCKeditor2.ReplaceTextarea() ;
     
        var oFCKeditor3 = new FCKeditor( 'contenido2' ) ;
        oFCKeditor3.BasePath = \"fckeditor/\" ;
		oFCKeditor3.Height = 400 ;
		oFCKeditor3.ReplaceTextarea() ;
      }
    </script>";
	
 $id_contenido = $_GET['id_contenido'];

	
	//$onload="onload=\"seleccionar_todo()\"> ";
	
	if(!$filename==""){
	
       $fuentei ="images/news/$id_noticia/".$filename;
		 if(is_file($fuentei)){
			 $fuentei="images/news/$id_noticia/".$filename;
			 
	
		$fuentei = @imagecreatefromjpeg($fuentei); 

		$imgAncho = imagesx ($fuentei); 

        $imgAlto =imagesy($fuentei); 
		}
$link ="images/news/marca_p.php?foto=$filename&id_noticia=$id_noticia";
}else{
$imgAncho = 100; 

        $imgAlto =100; 

}
	
	
if($visible==""){
	$visible_si="checked";
	
}else{
	
	$var = "visible_".$visible;
	$$var ="checked";
	
}

if($imprimir==""){
	$imprimir_si="checked";
	
}else{
	
	$var = "imprimir_".$imprimir;
	$$var ="checked";
	
	
}

if($amigo==""){
	$amigo_si="checked";
}else{
	
	$var = "amigo_".$amigo;
	$$var ="checked";
	
}


include("admin/GNews/tags.php");

	
$contenido .="<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                <tr>
                  <td align=\"right\" class=\"textos\">
				  <a href=\"index.php?id_usuario=$id_usuario&accion=$accion&act=2\">Volver a Administrador de Contenido</a>
				  
				  </td>
                </tr>
             
                </tr>
         
				 <tr>
                  <td align=\"center\" class=\"textos\" >
				   
				   $fckeditor
				   
				  </td>
                </tr>
				
				<tr>
                  <td align=\"center\" class=\"textos\" height=\"8\">
				  
				  </td>
                </tr>
             <tr>
                  <td align=\"center\" class=\"textos\" >
				   
				    <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\">
                      
                          <td align=\"left\" class=\"textos\">Tipo de Noticia 
						  <select name=\"id_tipo\" class=\"textos\">
						   $lista_tipos
						   </select>
						   </td>
                         
                          <td align=\"center\" class=\"textos\">
                          
                          <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\" class=\"cuadro\">
                           <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"
>

                           		<td align=\"right\" class=\"textos\"> Opinable &nbsp;
						   			SI <input type=\"radio\" name=\"visible\" value=\"si\" $visible_si >
						   			NO <input type=\"radio\" name=\"visible\" value=\"no\" $visible_no>
						   		</td>
						  </tr>
                          <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"
>

                          		<td align=\"right\" class=\"textos\">  Imprimir &nbsp;
						   			SI <input type=\"radio\" name=\"imprimir\" value=\"si\" $imprimir_si >
						   			NO <input type=\"radio\" name=\"imprimir\" value=\"no\" $imprimir_no>
						   		</td>
						  </tr>
                          <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"
>

                          		<td align=\"right\" class=\"textos\"> Enviar amigo &nbsp;
						   			SI <input type=\"radio\" name=\"amigo\" value=\"si\" $amigo_si>
						   			NO <input type=\"radio\" name=\"amigo\" value=\"no\" $amigo_no>
						   		</td>
						 </tr>
                           <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"
>

                          		<td align=\"right\" class=\"textos\"> Destacada &nbsp;
						   			SI <input type=\"radio\" name=\"destacado\" value=\"1\" $destacado_1>
						   			NO <input type=\"radio\" name=\"destacado\" value=\"0\" $destacado_0>
						   		</td>
						 </tr>
                         </table> 
                          
                         </td>
                          </tr>
			   
			    $tabla_tag
			    
			    
			<tr>
                    	</table>
				   
				  </td>
                </tr>
				
				<tr>
                  <td align=\"center\" class=\"textos\" height=\"15\">
				  
				  </td>
                </tr>
				<tr>
                  <td align=\"center\" class=\"textos\" height=\"8\">
				   <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr >
        <td align=\"center\" class=\"textos\" width=\"50%\">
		
		
		<table  width=\"33%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"16\"><img src=\"images/marc_foto/top_lef.gif\" width=\"16\" height=\"16\"></td>
      <td height=\"16\" background=\"images/marc_foto/top_mid.gif\"></td>
      <td width=\"24\"><img src=\"images/marc_foto/top_rig.gif\" width=\"24\" height=\"16\"></td>
    </tr>
    <tr>
      <td width=\"16\" background=\"images/marc_foto/cen_lef.gif\" align=\"center\" class=\"textos-chico\"></td>
      <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">
	   
	  <a href=\"#\" onClick=\"MM_openBrWindow('$link','','width=$imgAncho,height=$imgAlto')\" >
		<img src=\"contenido/imagen_chica.php?imagen=$imagen&tamanio_image=120&id_contenido=$id_contenido\" alt=\"\" vspace=\"0\" border=\"0\">
	    </a>
	 
	  </td>
      <td width=\"24\" background=\"images/marc_foto/cen_rig.gif\"></td>
    </tr>
    <tr>
      <td width=\"16\" height=\"16\"><img src=\"images/marc_foto/bot_lef.gif\" width=\"16\" height=\"16\"></td>
      <td height=\"16\" background=\"images/marc_foto/bot_mid.gif\"></td>
      <td width=\"24\" height=\"16\"><img src=\"images/marc_foto/bot_rig.gif\" width=\"24\" height=\"16\"></td>
    </tr>
	
	
  </table>
		</td>
        <td align=\"center\" class=\"textos\" width=\"50%\">
		
		
		<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
   			 <tr >
    		  <td align=\"center\" class=\"textos\">
	 				 Imagen:</b></font><input type=\"file\" name=\"imagen\"  class=\"textos\">
	 			 </td>
     		 </tr>
			<tr >
    		  <td align=\"center\" class=\"textos\">
				  Pie de Foto:
				  <textarea name=\"pie\" class=\"textos\" cols=\"50\" rows=\"4\" >$pie</textarea> 
				  
			  </td>
    		  </tr>
		</table>
		
		
		
		
		
		<input type=\"hidden\" name=\"id_imagen\" value=\"$id_imagen\">
		
		<input type=\"hidden\" name=\"act\" value=\"1\">
  <input type=\"hidden\" name=\"id_contenido\" value=\"$id_contenido\" class=\"textos\">
		
		</td></tr> 
  	</table>
				  </td>
                </tr>
				<tr>
                  <td align=\"Left\" class=\"textos\" height=\"15\">
				Fecha de publicaci&oacute;n de este contenido $fecha_publicacion  (<a href=\"index.php?accion=$accion&act=15&id_noticia=$id_contenido\">REPUBLICAR ESTE CONTENIDO</a>)
				  </td>
                </tr>
				<tr>
                  
				  <td align=\"center\" class=\"textos\">
				 
				  Fuente:</font><input type=\"text\" name=\"fuente\" value=\"$fuente\" class=\"textos\">
				  
				  </td>
                </tr>
				
				<tr>
                  
				  <td align=\"center\" class=\"textos\">
				 
				     $cuadro_perfiles_colegios
				  
				  </td>
                </tr>
				
				<tr><td align=\"center\" class=\"textos\">
<table width=\"80%\" align=\"center\">
    <tr align=\"center\" valign=\"middle\">
      <td>
        <input type=\"button\" value=\"Cancelar\" onClick='window.location.href=\"index.php\"' name=\"button\" class=\"boton\">
      </td>
      <td>
        <input type=\"submit\" name=\"guardar\" value=\" Aceptar \" class=\"boton\">
      </td>
    </tr>
  </table>
 </td></tr> 
              </table>
 
  ";


  
?>