<?php


$file_name= $_FILES['archivo_excel']['name'];
$file= $_FILES['archivo_excel']['tmp_name'];


$carpeta = "deuman/importar_excel/temp";


if(is_dir($carpeta)){
	@chmod($carpeta, 0777);
}else{
	@mkdir($carpeta);
	@chmod($carpeta, 0777);
}
    
 	     $file2 = ereg_replace('&','*',$file_name);
 		 $file2 = ereg_replace(' ',':',$file_name);
 		 //echo "$carpeta/$file2";
 		 if (!copy($file, "$carpeta/$file_name")){
 				
 		 $contenido = "Fallo, La file chica no se a podido subir al servidor. <br>
 		 La file chica no existe o es muy grande.<br>
 		 file temp: $file<br> file nombre : $file_name";
 		
 		 }
		 
		 
?>