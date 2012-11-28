<?php
/*
* Clase PHP - Cache
* www.baluart.net
*/

if($BASE!=false){
include("admin/estadisticas/estadistica.php");
}
class cache
{
var $cache_dir; // path o ruta donde se almacena la cache
var $cache_time; // tiempo en que expira la cache (en segundos)
var $caching = false; //true, para cachear
var $cleaning = false; //true, para limpiar y actualizar
var $file = ''; // path o ruta del script a cachear

function iniciar($path='',$time,$action=NULL,$BASE = false){

global $_SERVER;

$accion_cache =$_GET['accion'];

	foreach($_GET as $variable=>$valor){
	    
	    $cadena .= $variable .$_GET[$variable];
	}
	$cadena_md5=md5($cadena);
	
	foreach($_POST as $variable=>$valor){
	    
	    $cadena .= $variable .$_POST[$variable];
	}
	
    $cadena_md5 .=md5($cadena);


	    if($BASE==true){
	    $id_sesion = session_id();
	      $query= "SELECT id_usuario
		       FROM  usuario
		       WHERE session='$id_sesion'";
	     
	    
	      $result36= @mysql_query($query);
		if(list($id_usuar) = @mysql_fetch_row($result36)){
		    $id_session_user = "user_".$id_usuar."_";
		    $action=1;
		}
	    }
	    
	if($accion_cache==""){
            $accion_cache="home";
            
        }


$this->cache_dir = $path;
$this->cache_time = $time;
$this->cleaning = $action;
$this->file = $this->cache_dir.$id_session_user.$accion_cache."_$cadena_md5"."_cache_".md5(urlencode($_SERVER['REQUEST_URI'])); //md5, encriptado por seguridad

//condicional: Existencia del archivo, fecha expiracion, accion
if (file_exists($this->file) && (fileatime($this->file)+$this->cache_time)>time() && $this->cleaning == false){

readfile($this->file);


/*
// abrimos el fichero
$handle = fopen( $this->file , "r");
do {
//leemos hasta 8192 bytes por defecto (podemos incrementarlo)
$data = fread($handle, 8192);
if (strlen($data) == 0) {
break;
}
//mostramos la cache
echo $data;
} while (true);
fclose($handle);
*/


exit();
} else {
$this->caching = true;
//grabamos buffer
ob_start();
}
}






function cerrar(){
if ($this->caching){
//Recuperamos informacion del buffer
$data = ob_get_clean();
// mostramos informacion
echo $data;
//borramos cache si existe
if(file_exists($this->file)){
unlink($this->file);

}
//escribimos informacion en cache
$fp = fopen( $this->file , 'w' );
fwrite ( $fp , $data );
fclose ( $fp );
}
}

} // Fin clase Cache






?>