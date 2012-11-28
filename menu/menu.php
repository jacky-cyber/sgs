<?php
	
	$id_entidad_usuario = rescata_valor('usuario',$id_usuario,'id_entidad');
	
	
	$query="SELECT id_grupo,grupo  FROM  accion_grupo ORDER BY orden asc";
	
	$identificador = $accion.'_accion_grupo';
	$data2 = cache_mysql_muchos_valores($query,$identificador,3600);
	while (list($id_grupo,$grupo) = current($data2)){
		next($data2);
		
		$cont_sub=0;				   

	
	/* Select tabla acciones*/
	$estado_pendiente_rectificacion = configuracion_cms('estado_pendiente_rectificacion');
	$estados_etapa_respondida = configuracion_cms('Estados_etapa_respondida');
	
	$query_acciones="SELECT ac.id_acc,ac.accion, ac.descrip_php_$idm,ac.descrip_url,ac.id_estado_solicitud
                   FROM  acciones ac
                   WHERE  ac.home='si' 
		   and ac.id_grupo='$id_grupo'
		   ORDER BY ac.id_acc";
        $identificador = $accion.'_acciones_'.$id_grupo;
	$data_acciones = cache_mysql_muchos_valores($query_acciones,$identificador,3600);
	while (list($id_acc,$accion_id, $descrip_php,$descrip_url,$id_estado_solicitud) = current($data_acciones)){
		next($data_acciones);
		//echo "$id_acc,$accion_id $descrip_php $id_grupo rerere <br>";
		
		
		if($id_estado_solicitud != 0){
			
			$listado_estados = "";
			$estado = $id_estado_solicitud;
			
			$query_estado = "SELECT id_estado_padre
								FROM sgs_estado_solicitudes
								WHERE id_estado_solicitud IN ($estado)";
			$result= mysql_query($query_estado)or die (error($query_estado,mysql_error(),$php));
			list($id_estado_padre) = mysql_fetch_row($result);
			if($id_estado_padre == $estado){
				
				$query = "SELECT id_estado_solicitud
								FROM sgs_estado_solicitudes
								WHERE id_estado_padre = '$id_estado_padre'
								AND id_estado_solicitud NOT IN ($estado_pendiente_rectificacion,$estados_etapa_respondida)";
				
				$result= mysql_query($query)or die (error($query,mysql_error(),$php));
				while(list($estado_solicitud) = mysql_fetch_row($result)){
					$listado_estados .= $estado_solicitud.",";
				}
				$listado_estados = elimina_ultimo_caracter($listado_estados);
			}else{
				$listado_estados = $estado;
			}
			
			//echo $descrip_url."--".$listado_estados."<br>";
			if($listado_estados != ""){
			
				$query_solicitudes = "SELECT count(id_solicitud_acceso)
										FROM sgs_solicitud_acceso
										WHERE id_sub_estado_solicitud IN ($listado_estados) and id_entidad ='$id_entidad_usuario'";
				$result_solicitudes= mysql_query($query_solicitudes)or die (error($query_solicitudes,mysql_error(),$php));
				list($cantidad_solicitudes) = mysql_fetch_row($result_solicitudes);
				
				if($cantidad_solicitudes>0){
					$cantidad_solicitudes = "<span class=\"label-warning label pull-right\" style=\"top:12px; background-color:#F89406;\">$cantidad_solicitudes</span>";	
				}else{
					$cantidad_solicitudes = "";	
				}
				
				
			}
		}else{
			$cantidad_solicitudes = "";
		}
		
		
		$si=false;
		   
			
			 $si= menu_perfil($id_perfil,$accion_id);	
		 // echo $descrip_php ." $si<br>"  ;
			if($si==false){
			//echo $descrip_url."<br>";
			
			$query_sub_perfiles= "SELECT id_perfil   
				   FROM  usuario_perfiles 
			          WHERE id_usuario='$id_usuario'";
              
			$data_sub_perfiles = cache_mysql_muchos_valores($query_sub_perfiles,'dub_perfiles_'.$id_usuario,3600);
			      while (list($id_sub_perfil) = current($data_sub_perfiles)){
			      next($data_acciones);
		 
		 			$si= menu_perfil($id_sub_perfil,$accion_id);	
            				
            		 }
			}
			  $descrip_php2 = $descrip_php;
				$descrip_php  = str_replace(" ","_",$descrip_php);
					
			    if($si){  
			  $cont_sub++;

		  	
            		 
		//onclick=\"ObtenerDatos('index.php?accion=$descrip_php&axj=1','contenido');\"       		
		//<a href=\"index.php?accion=$descrip_php\">
		//$descrip_php= acentos($descrip_php);
		
		if($idioma!=""){
    		
		     
      
			$query_deuman_idioma="SELECT id_idioma   
							 FROM  deuman_idioma 
							 WHERE sigla='$idioma";
			   $id_idioma = cache_mysql_solo_un_valor($query_deuman_idioma,'deuman_idioma2_');
			
				
				
				  
			  $query_traduccion="SELECT traduccion   
						   FROM  accion_idioma
						   WHERE accion='$accion_id' and id_idioma='$id_idioma'";
			  $traduccion = cache_mysql_solo_un_valor($query_traduccion,'treduccion_');


		}
		
		if($traduccion!=""){
			$descrip_php2= $traduccion;	
		}else{
			$descrip_php2= acentos($descrip_php2);	
		}
		
		
		
		//$descrip_php= titulo_url($descrip_php);
		
		$accion_url = strtolower($_GET['accion']);
		if(is_numeric($accion_url)){
		
			$accion_url = accion_palabra($accion_url);
			$accion_url = strtolower($accion_url);
			//echo $accion_url;
		}
		
		if($_GET['accion']==""){
		//$id_perfil  = perfil($id_sesion);
		  $query= "SELECT url_defecto 
           		   FROM  usuario_perfil
           		   WHERE id_perfil='$id_perfil'";
		 $accion_url = cache_mysql_solo_un_valor($query,$accion.'_ur_defecto_'.$id_perfil,3600);	
     		
		
		$accion_url = str_replace("?accion=","",$accion_url);
			//echo $accion_url;
			//$accion_url = strtolower($accion_url);
			
		}else{
			$accion_url = $_GET['accion'];
		}
		
		
		
	
		$descrip_url = strtolower($descrip_url);
		if($accion_url==$descrip_url){
				$tabla_menu .= " <li ><a href=\"index.php?accion=$descrip_url\" class=\"selected\" id=\"id_mem_$id_acc\">$descrip_php2  $cantidad_solicitudes</a> </li>\n";
		}else{
				
				$tabla_menu .= " <li><a href=\"index.php?accion=$descrip_url\" id=\"id_mem_$id_acc\">$descrip_php2 $cantidad_solicitudes</a></li>\n";
				
		}
			
		
		
	}
			
			
      }
     
}
		if($_GET['tp']=="new"){
			
		}else{
			$menu= html_template('menu');	
			
		}

	$menu= html_template('contenedor_menu');		
	$menu = str_replace("#MENU#",$tabla_menu,$menu);	


			 
?>