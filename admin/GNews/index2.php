<?php

$publica = $_GET['publica'];
$despublica = $_GET['despublica'];

$palabra = $_POST['palabra'];

if($publica!=""){
$Sql ="UPDATE noticias
	   SET estado =1
	   WHERE id_noticia ='$publica'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
	 //  echo $Sql;
     //  header("Location:index.php?accion=$accion");
}


if($despublica!=""){
$Sql ="UPDATE noticias
	   SET estado =0
	   WHERE id_noticia ='$despublica'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
	   
       header("Location:index.php?accion=$accion");

}


$tipo_new = $_GET['tipo_new'];
/*******************************************
** Realiza la conexion a la base de datos **
*******************************************/
$news .= "<tr class=\"cabeza_rojo\">
    <td align=\"center\" width=\"90%\"  >T&iacute;tulo</td>
    <td align=\"left\">Tipo Noticia</td>
	 <td align=\"left\">Gal</td>
    
	<td align=\"center\">Ver</td> 
     <td align=\"left\" width=\"10%\" >Ok</td>
   <td align=\"left\" width=\"10%\" >Edit</td>
    <td align=\"left\"  width=\"10%\" >Del</td>
	<td align=\"center\" >Click</td> 
  </tr>";



/**********************************************************
** Selecciona todos las contenidos almacenados en la BD. **
**********************************************************/
 // id_noticia idioma  titulo  titulo_corto  contenido  id_imagen  visible  fecha
 if($tipo_new!=""){
 $tem =" and  id_tipo='$tipo_new'"; 
 }

 if($palabra!=""){
 $condicion_palabra =" and titulo like'%$palabra%' or contenido_corto like'%$palabra%' or contenido like'%$palabra%' ";
 
 }

$js_back.=" <script language=\"javascript\">
function objetoAjax(){
          var xmlhttp=false;
           try{
            xmlhttp = new ActiveXObject(\"Msxml2.XMLHTTP\");
           }catch(e){
            try {
             xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
            }catch(E){
             xmlhttp = false;
            }
           }
           if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
            xmlhttp = new XMLHttpRequest();
           }
           return xmlhttp;
         }
		</script>"; 
		
		
$js .="<script language=\"javascript\">
function Pagina(nropagina){
 //donde se mostrará los registros
 divContenido = document.getElementById('contenido');
 
 ajax=objetoAjax();
 //uso del medoto GET
 //indicamos el archivo que realizará el proceso de paginar
 //junto con un valor que representa el nro de pagina
 ajax.open(\"GET\", \"paginador.php?pag=\"+nropagina);
 divContenido.innerHTML= '<img src=\"anim.gif\">';
 ajax.onreadystatechange=function() {
  if (ajax.readyState==4) {
   //mostrar resultados en esta capa
   divContenido.innerHTML = ajax.responseText
  }
 }
 //como hacemos uso del metodo GET
 //colocamos null ya que enviamos 
 //el valor por la url ?pag=nropagina
 ajax.send(null)
}
</script>";


         

 
$query = "SELECT id_noticia,titulo,titulo_url,id_tipo,visible,estado,click
          FROM noticias 
		  WHERE 1 $tem $condicion_palabra
          ORDER BY id_noticia DESC
		  $paginacion";


	  
$result = cms_query($query) or die ("problemas en la consulta 1.<br>$query");
$num = mysql_num_rows($result);


   $query= "SELECT id_publicador   
           FROM  noticias_id_publicador 
           WHERE id_publicador='$id_usuario'";
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
   if(list($id_publicador) = mysql_fetch_row($result2)){
			$publicador="ok";
			   
		 }


while (list($id_contenido,$titulo,$titulo_url,$id_tipo,$visible,$estado_noticia,$click)= mysql_fetch_row($result))
     {
	 
     	
     	
	
     if($estado_noticia=="1"){
     	
     	
	 $bg="style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"";
	 	if($publicador=="ok"){
	
				$link_aprueba="<a href=\"index.php?accion=$accion&despublica=$id_contenido\">
                <img src=\"images/ok.gif\" alt=\"Noticia Publicada\" border=\"0\">
                </a>";
		
		}else{
				$link_aprueba="<img src=\"images/ok.gif\" alt=\"Noticia Publicada\" border=\"0\">";
		
		}
			   
		 }else{
		 $bg="bgcolor=\"#FDD3C6\"";
		 if($publicador=="ok"){
	
		 $link_aprueba ="<a href=\"index.php?accion=$accion&publica=$id_contenido\">
                <img src=\"images/info.png\" alt=\"no Publicada\" border=\"0\">
                </a>";

		 }else{
			$link_aprueba ="<img src=\"images/info.png\" alt=\"no Publicada\" border=\"0\">";
		 
		 
		 }
		 
		 }

	 
	 
	 
	$qry = "SELECT descripcion 
          FROM contenido_tipo 
		  WHERE 1 and id_tipo ='$id_tipo'";
    $result_qry = cms_query($qry) or die ("problemas en la consulta 1.<br>$qry");
    
	list($tema)= mysql_fetch_row($result_qry);
	
   $news .="<tr  $bg>
      <td align=\"left\" class=\"textos_simple\" title=\"$titulo_url\">
	  <a href=\"index.php?accion=$accion&act=2&id_contenido=$id_contenido\" >$titulo</a></td>
     <td align=\"center\" class=\"textos_simple\">$tema</td>
	  <td  class=\"textos\" align=\"center\">
	  <a href=\"index.php?accion=$accion&act=12&id_noticia=$id_contenido\">
	  <img src=\"images/iconos/imagen.jpg\" alt=\"Linkear Galeria\" border=\"0\"></a></td>
      
      
	  <td align=\"center\" class=\"textos\">
	  <a href=\"index.php?accion=noticias&act=5&id_contenido=$id_contenido\" target=\"_blank\">
                <img src=\"images/ojos.gif\" alt=\"Ver noticia\" border=\"0\">
                </a>
	  </td> 
     <td class=\"textos\" align=\"center\">$link_aprueba</td>
      <td align=\"center\"   class=\"textos\">
	  <a href=\"index.php?accion=$accion&act=2&id_contenido=$id_contenido\">
	  <img src=\"images/edit.gif\" alt=\"\" border=\"0\"></a></td>
      <td align=\"center\"   class=\"textos\">
	  <a href=\"index.php?accion=$accion&act=3&id_contenido=$id_contenido\">
	  <img src=\"images/del.gif\" alt=\"\" border=\"0\"></a></td>
	  <td align=\"center\" class=\"textos_simple\">$click</td> </tr>";
     
 }



$query = "SELECT id_tipo, descripcion
          FROM contenido_tipo
          ORDER BY 'id_tipo'";
$result = cms_query($query);
while (list($id_tipo, $descripcion) = mysql_fetch_row($result)){

     $lista_tipos .= "<option value=\"index.php?accion=$accion&tipo_new=$id_tipo\">
	                   $descripcion</option>\n";
              }
 

 $busca_por_tema ="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
                     <option value=\"#\"></option>
					 $lista_tipos
					 <option value=\"index.php?accion=$accion\">Todos </option>
                  </select>";

 

 
  
    
	

$contenido .="<br><table width=\"100%\" border=\"0\" align=\"center\" cellspacing=\"0\" cellpadding=\"1\" >
 <tr >
      <td  class=\"textos\" colspan=\"2\">
	  
	  <table  width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	   <tr>
	   <td  > 
	    <table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                                 <tr >
                                   <td  class=\"textos\" align=\"left\">
								   <a href=\"index.php?accion=$accion&act=4\" >
				 <img src=\"images/new.gif\" alt=\"Agregar Perfil Publisher\" border=\"0\"></a>
								   </td>
									<td  class=\"textos\" align=\"left\">
								   <a href=\"index.php?accion=$accion&act=5\" >
				 <img src=\"images/ordenar.jpg\" alt=\"Plantilla Noticias\" border=\"0\"></a>
								   </td>
								   <td align=\"right\" class=\"textos\">
								  <a href=\"index.php?accion=$accion&act=1\" >
				 					<img src=\"images/new.gif\" alt=\"\" border=\"0\"></a>
								  </td>
                                   </tr>
                             	</table>
  				 
		</td>
	  </tr> 
 		<tr>
			<td>
  				 <table width=\"100%\"  border=\"0\"  cellpadding=\"0\" cellspacing=\"0\">
                                 <tr >
                                   <td align=\"left\" class=\"textos\">
								   <a href=\"index.php?accion=$accion&act=4\" >
				 Agregar Publicador</a>
								   </td>
								 <td align=\"left\" class=\"textos\">
								   <a href=\"index.php?accion=$accion&act=5\" >
									Plantilla Noticias</a>
								   </td>  
                                  <td align=\"right\" class=\"textos\">
								  <a href=\"index.php?accion=$accion&act=1\" >
				 					Nueva News</a>
								  </td>
                                   </tr>
                                   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
                                   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
                             	</table>
			</td>
		</tr> 
	  
	  </table>
	  
	  </td>
      </tr>
 <tr >
          
            <td align=\"right\" colspan=\"2\" class=\"textos\">
			
           
			  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr >
                  <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"palabra\"> <input type=\"submit\" name=\"Submit\" value=\"Buscar palabra\"></td>
				  <td align=\"right\" class=\"textos\"> Ver por tema $busca_por_tema</td> 
                  </tr>
            	</table>
			  
            </td>
			<tr><td align=\"right\" colspan=\"2\">&nbsp; </td></tr> 

          </tr>
		  <tr><td align=\"center\" class=\"textos\" colspan=\"2\">
		  <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" class=\"cuadro\">

$news
</table>
		   </td></tr> 
		  </table>";
 



//$detalle_noticias = $texto;	


?>