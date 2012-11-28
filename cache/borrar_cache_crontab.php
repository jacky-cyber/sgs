<?php
$path="tmp"; //directorio a listar
		$directorio=dir($path);

		$pn= array();//pila de nombres
		$pf= array();//pila de fechas
		$pt= array();//pila de tamaNos

//bucle para llenar las pilas :P
		while ($archivo = $directorio->read()){
//no mostrar ni "." ni ".." ni el propio "index.php"
			if(($archivo!="index.php")&&($archivo!=".")&&($archivo!="..")){
				unlink("$path/$archivo");

			}
		}
		
		
$path="tmp/mysql_cache"; //directorio a listar
		$directorio=dir($path);

		$pn= array();//pila de nombres
		$pf= array();//pila de fechas
		$pt= array();//pila de tamaNos

//bucle para llenar las pilas :P
		while ($archivo = $directorio->read()){
//no mostrar ni "." ni ".." ni el propio "index.php"
			if(($archivo!="index.php")&&($archivo!=".")&&($archivo!="..")){
				unlink("$path/$archivo");

			}
		}
		
		
		
?>