<?php

$ruta = "cache/tmp/"; 
$filehandle = opendir($ruta); 
while ($file = readdir($filehandle)) {
    if ($file != "." && $file != ".." ) {
        $arch=$file;
        $archi=$arch.'*'.$archi;
        
       $fecha_archivo =  date("d-m-Y", filectime ("cache/tmp/$file"));
       $fecha_hoy = date(d)."-".date(m)."-".date(Y);
       
      
       if($fecha_archivo !=$fecha_hoy and $file !=""){
       
        unlink("cache/tmp/$file");
        
       }
    }
}

$ruta = "cache/tmp/mysql_cache"; 
$filehandle = opendir($ruta); 
while ($file = readdir($filehandle)) {
    if ($file != "." && $file != ".." ) {
        $arch=$file;
        $archi=$arch.'*'.$archi;
       
       $fecha_archivo =  date("d-m-Y", filectime ("cache/tmp/mysql_cache/$file"));
       $fecha_hoy = date(d)."-".date(m)."-".date(Y);
       
   
         
       if($fecha_archivo !=$fecha_hoy and $file !=""){
        
        unlink("cache/tmp/mysql_cache/$file");
        
       }
    }
}



?>