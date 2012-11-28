<?php
error_reporting(E_PARSE);
include("../../lib/lib.inc");  
include("../../lib/connect_db.inc.php");    

 function linea($texto,$valor){
		
		$linea = "<$texto>$valor</$texto>\n";
 return $linea;
 }
 
 $fecha_ini = $_GET['fecha_ini'];
 $fecha_fin = $_GET['fecha_fin'];
 
 if($fecha_fin!="" and $fecha_ini!=""){
 
 $condicion = "and ssa.fecha_inicio >= '$fecha_ini' and ssa.fecha_inicio <= '$fecha_fin'";
 }elseif($fecha_ini!=""){
 $condicion = "and ssa.fecha_inicio >= '$fecha_ini'";
  }
 
 
$xml="";
  $query= "SELECT ssa.folio,ssa.id_entidad_padre,ssa.id_entidad,id_region,id_comuna,id_ocupacion,id_rango_edad,id_sexo,id_nacionalidad,id_nivel_educacional,id_organizacion,id_frecuencia_organizacion,ssa.fecha_inicio,ssa.fecha_termino 
           FROM  sgs_solicitud_acceso ssa , usuario u
		   where ssa.id_usuario=u.id_usuario
		   $condicion";
		  
       $result= cms_query($query);
      while (list($folio,$id_entidad_padre,$id_entidad_hija,$id_region,$id_comuna,$id_ocupacion,$id_rango_edad,$id_sexo,$id_nacionalidad,$id_nivel_educacional,$id_organizacion,$id_frecuencia_organizacion,$fecha_inicio,$fecha_termino) = mysql_fetch_row($result)){
						   
		$xml .="<sgs_estadistica_opcionales>";
			
			
			$xml .=linea('folio',$folio);
			$xml .=linea('id_entidad_padre',$id_entidad_padre);
			$xml .=linea('id_entidad_hija',$id_entidad_hija);
			$xml .=linea('id_region',$id_region);
			$xml .=linea('id_comuna',$id_comuna);
			$xml .=linea('id_ocupacion',$id_ocupacion);
			$xml .=linea('id_rango_edad',$id_rango_edad);
			$xml .=linea('id_sexo',$id_sexo);
			$xml .=linea('id_nacionalidad',$id_nacionalidad);
			$xml .=linea('id_nivel_educacional',$id_nivel_educacional);
			$xml .=linea('id_organizacion',$id_organizacion);
			$xml .=linea('id_frecuencia_organizacion',$id_frecuencia_organizacion);
			$xml .=linea('fecha_inicio',$fecha_inicio);
			$xml .=linea('fecha_termino',$fecha_termino);
			
			$xml .="</sgs_estadistica_opcionales>";
		//echo "#;'$folio';$id_entidad_padre;$id_entidad_hija;$id_region;$id_comuna;$id_nacionalidad;$id_nivel_educacional;$id_ocupacion;$id_rango_edad;$id_sexo;$id_organizacion\n";
		
		
		 }


		 
		 
		echo  "<?xml version=\"1.0\" encoding=\"utf-8\"?>
				<transaccion>
					$xml
				</transaccion>";
		
		

?>