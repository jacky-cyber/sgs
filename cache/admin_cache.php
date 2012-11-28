<?php

switch ($act) {
     case 1:
         /*BORRAR Archivo*/
		 $file = $_GET['f'];
		 unlink("cache/tmp/$file");
		
         header("Location:index.php?accion=$accion");
         break;
	case 2:
		
		include("cache/borrar_cache.php");
		
        header("Location:index.php?accion=$accion");
   break;
	case 3:
			$activa_cache = $_POST['activa_cache'];
			//if($activa_cache==""){$activa_cache=0;}
			$contenido = " $activa_cache";        
			$Sql ="UPDATE cms_configuracion
            	   SET valor ='$activa_cache'
            	   WHERE  configuracion ='activar cache'";
            		 
            	   cms_query($Sql)or die (error($Sql,mysql_error(),$php));
				   $contenido ="Cambio realizado";
	  
	break;
   	default:
	$js = "
 <script language=\"JavaScript\">
$(function(){
 $('#activa_cache').change(function(event){
 checked_value = $(this).val(); 

 		if(this.checked){
 			$.ajax({url: 'index.php?accion=$accion&act=3&axj=1',
					type: 'post',
		 			data: 'activa_cache=1' ,
		 			success: function(result){alert(result)}
				   });
		}else{
			$.ajax({url: 'index.php?accion=$accion&act=3&axj=1',
					type: 'post',
		 			data: 'activa_cache=0',
		 			success: function(result){alert(result)}
				   });
		}
  });
 });


</script>
";  
	 
    
    
    
// para leer el directorio
$ruta = "cache/tmp/"; 
$filehandle = opendir($ruta); 
while ($file = readdir($filehandle)) {
    if ($file != "." && $file != ".." ) {
        $arch=$file;
        $archi=$arch.'*'.$archi;
    }
}

closedir($filehandle); 

$peso_carpeta  = size($ruta);

 
// paginando
$archivosfile=explode("*", $archi);
$currentpage = $_SERVER['PHP_SELF']; // pagina en la que se encuentra
$total=(count($archivosfile)-1);
$maxRows_Blogdenotas = 40;  // cantidad maxima de archivos a mostrar por pagina
$pageNum_Blogdenotas = 0;

if (isset($_GET['pag'])) {
  $pageNum_Blogdenotas = intval($_GET['pag']);
}

$startRow_Blogdenotas = $pageNum_Blogdenotas * $maxRows_Blogdenotas;

if (isset($_GET['pag'])) {
  $pageNum_Blogdenotas = intval($_GET['pag']);
}

$startRow_Blogdenotas = $pageNum_Blogdenotas * $maxRows_Blogdenotas;
$totalRows_Blogdenotas = $total;
$totalPages_Blogdenotas = ceil($totalRows_Blogdenotas/$maxRows_Blogdenotas)-1;
$archivos = array_slice($archivosfile, $startRow_Blogdenotas, $maxRows_Blogdenotas);

// paginando   

$info_carpeta ="Total Archivos:&nbsp;$total;  Peso de Carpeta $peso_carpeta<br /><br />";
$paginas ="<table border=\"0\" >
                    <tr>
                      <td>";
                      
                   if ($pageNum_Blogdenotas > 0) { // Show if not first page
                           $paginas .= "<a href=\"index.php?accion=$accion&pag=0\"> << </a>";
                             }else{ // Show if not first page
                           $paginas .= " <span class=\"style1\"> << </span>";
                           
                           }
                           $paginas .= "</td><td>";
                      
                      if ($pageNum_Blogdenotas > 0) { // Show if not first page
                           $paginas .= " <a href=\"index.php?accion=$accion&pag=".htmlentities($_GET['pag']-1)."\"> < </a>";
                          }else{ // Show if not first page 
                            $paginas .= "<span class=\"style1\"> < </span> ";
                            }                     
                            $paginas .= "</td><td>";
                            
                            if ($pageNum_Blogdenotas < $totalPages_Blogdenotas) { // Show if not last page 
                            $paginas .= "<a href=\"index.php?accion=$accion&pag=".htmlentities($_GET['pag']+1)."\"> > </a>";
                            }else{ // Show if not last page 
                               $paginas .= " <span class=\"style1\"> > </span> </td>";
                            }
                                     $paginas .= "<td>";
                                     
                                if ($pageNum_Blogdenotas < $totalPages_Blogdenotas) { // Show if not last page 
                            $paginas .= "<a href=\"index.php?accion=$accion&pag=$totalPages_Blogdenotas\"> >> </a>";
                               }else{ // Show if not last page 
                            $paginas .= "<span class=\"style1\"> >> </span>  ";
                            }
                            $paginas .= " </td>
                                          </tr>
                                              </table>
                                              ";

                    $mostrando =" <div>Mostrando ". ($startRow_Blogdenotas + 1);
                    
                   $mostrando .= " a ";
                   
                   $mostrando .=  min($startRow_Blogdenotas + $maxRows_Blogdenotas, $totalRows_Blogdenotas) ;
                   
                   $mostrando .= "de $totalRows_Blogdenotas </div>";
          $query= "SELECT valor  
           FROM  cms_configuracion
           WHERE  configuracion ='activar cache'";
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
     list($activa_cache) = mysql_fetch_row($result);
	 
	 
if($activa_cache==1){

$checked = "checked";
}           

                $contenido ="<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
    <tr><td align=\"right\" class=\"textos\" colspan=\"2\">Activar Cache <input type=\"checkbox\" id=\"activa_cache\" name=\"activa_cache\" value=\"1\" $checked > </td></tr>    
    <tr><td align=\"left\" class=\"textos\">$info_carpeta</td>
    <td align=\"right\" class=\"textos\">Borrar Cache <a href=\"index.php?accion=$accion&act=2\"><img src=\"images/del.gif\" alt=\"\" border=\"0\"></a></td> </tr>     
    <tr>
    <td align=\"left\" class=\"textos\" >$mostrando </td>    
    <td align=\"right\" class=\"textos\">$paginas</td>
    
    </tr>     
    
     <tr><td align=\"center\" class=\"textos\" colspan=\"2\">
     <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
    <tr >
      <td align=\"center\" class=\"textos\">Archivo</td>
      <td align=\"center\" class=\"textos\">Fecha</td>
      <td align=\"center\" class=\"textos\">Hora</td>
      <td align=\"center\" class=\"textos\">Peso</td>
      </tr>
	";
                    foreach ($archivos as $archivo) {
                        $nombre_archivo = substr_replace($archivo,"",32,-2);
                        $peso_archivo = size("$ruta".$archivo);
                $contenido .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                    <td align=\"left\" class=\"textos\">&nbsp;<a href='$ruta$archivo' title=\"$archivo\">$nombre_archivo</a> </td>
                <td align=\"center\" class=\"textos\">".date("d-m-Y", filectime ("cache/tmp/$archivo"))."</td>
		<td align=\"center\" class=\"textos\">".date("H:i:s", filectime ("cache/tmp/$archivo"))."</td> 
                        <td align=\"center\" class=\"textos\">$peso_archivo</td> </tr>";
                    }
                    

 
 $contenido .="</table>
</td></tr> <tr>
    <td align=\"left\" class=\"textos\" >$mostrando </td>    
    <td align=\"right\" class=\"textos\">$paginas</td>
    
    </tr> 
                </table>";

 
 
     }



 function size($path, $formated = true, $retstring = null){
        if(!is_dir($path) || !is_readable($path)){
            if(is_file($path) || file_exists($path)){
                $size = filesize($path);
            } else {
                return false;
            }
        } else {
            $path_stack[] = $path;
            $size = 0;
           
            do {
                $path   = array_shift($path_stack);
                $handle = opendir($path);
                while(false !== ($file = readdir($handle))) {
                    if($file != '.' && $file != '..' && is_readable($path . DIRECTORY_SEPARATOR . $file)) {
                        if(is_dir($path . DIRECTORY_SEPARATOR . $file)){ $path_stack[] = $path . DIRECTORY_SEPARATOR . $file; }
                        $size += filesize($path . DIRECTORY_SEPARATOR . $file);
                    }
                }
                closedir($handle);
            } while (count($path_stack)> 0);
        }
        if($formated){
            $sizes = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            if($retstring == null) { $retstring = '%01.2f %s'; }
            $lastsizestring = end($sizes);
            foreach($sizes as $sizestring){
                if($size <1024){ break; }
                if($sizestring != $lastsizestring){ $size /= 1024; }
            }
            if($sizestring == $sizes[0]){ $retstring = '%01d %s'; } // los Bytes normalmente no son fraccionales
            $size = sprintf($retstring, $size, $sizestring);
        }
        return $size;
    }
   



 
?>