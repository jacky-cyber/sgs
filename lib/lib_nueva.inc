<?php


function id_establecimiento2($id_sesion){
$query= "SELECT establecimiento
FROM usuario
WHERE session='$id_sesion'";
$result= cms_query($query)or die (error($query,mysql_error(),$php));
list($id_establecimiento) = mysql_fetch_row($result);

return $id_establecimiento;


}

function establecimiento2($id_sesion){
	  $query= "SELECT establecimientos.establecimiento
	           FROM   establecimientos, usuario
	           WHERE usuario.session='$id_sesion' and usuario.establecimiento=establecimientos.id";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($establecimiento) = mysql_fetch_row($result);
	      
	       return $establecimiento;	
	      
	
}
function establecimiento_nombre2($id_establecimiento){

$query= "SELECT establecimiento
FROM establecimientos
WHERE id='$id_establecimiento'";


$result= cms_query($query)or die (error($query,mysql_error(),$php));
if(list($establecimiento) = mysql_fetch_row($result)){
return $establecimiento;
}else{
return $id_establecimiento;
}



}
function contrato_name2($id_tipo_contrato){
	  $query= "SELECT tipo   
	           FROM  tipos_contratos
	           WHERE id='$id_tipo_contrato'";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	     list($tipo) = mysql_fetch_row($result);
	return  $tipo;
}

function verifica_bloqueo2($id_acc){

$query= "SELECT estado
FROM modulos_bloqueo
WHERE accion='$id_acc'";
$result= cms_query($query)or die (error($query,mysql_error(),$php));
list($estado) = mysql_fetch_row($result);

return $estado;


}

function escolaridad2($id_escolaridad){
	
  $query= "SELECT escolaridad   
	           FROM  personal_escolaridad  
	           WHERE id='$id_escolaridad'";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($escolaridad) = mysql_fetch_row($result);
	      
	      return $escolaridad;
	
}
function nombre_asignatura2($id_asignatura){
	
  $query= "SELECT asignatura  
	           FROM  asignaturas 
	           WHERE id='$id_asignatura'";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($asignatura_nombre) = mysql_fetch_row($result);
	      
	      return $asignatura_nombre;
	
}
function tipo_contrato2($id_tipo_contrato){
	  $query= "SELECT tipo     
	           FROM  tipos_contratos 
	           WHERE id='$id_tipo_contrato'";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	    
	     if(list($tipo) = mysql_fetch_row($result)){
	        return $tipo;
	     }else{
	     	return $id_tipo_contrato;
	     }
	
}

?>