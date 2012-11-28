<?php
//error_reporting(E_ALL);
	if (!isset($_SERVER['PHP_AUTH_USER'])) {
	    	header('WWW-Authenticate: Basic realm="Minsegpres"');
	    	header('HTTP/1.0 401 Unauthorized');
	    	echo 'No autorizado';
	    	exit;
		}
		else {

			//if ($_SERVER['PHP_AUTH_USER']=='minsegpres' && md5($_SERVER['PHP_AUTH_PW'])=='e10adc3949ba59abbe56e057f20f883e' and $_SERVER['REMOTE_ADDR']=='163.247.57.10'){
			if ($_SERVER['PHP_AUTH_USER']=='minsegpres' && md5($_SERVER['PHP_AUTH_PW'])=='01b2fd3cfae597cb856983b8af0858bd' ){
		    	//Aqui debe ir el codigo que genera el XML
				
					include("../../lib/connect_db.inc.php");
					include("../../lib/lib.inc.php");
					include("../../lib/lib.inc2.php");
					include("../../lib/lib.sgs.php");
					
					//include("../../lib/seguridad.inc.php");
					//include("../../lib/correos.inc.php");
					
				
						//$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
					//$resultado_int = Verifica_plazo_estado($Estados_pendiente_rectificacion,0);
					
					//set_time_limit(0);
					
					
					Calcula_plazo_finalizacion_retiro_pago_pendiente();
					
					//$id_servicio = configuracion_cms('id_servicio');
					$sigla = $_GET['id_entidad'];//"128";//;configuracion_cms('id_entidad');
					$fecha_inicio = $_GET['fecha_inicio'];
					$fecha_termino = $_GET['fecha_termino'];
					
					$id_entidad = obtieneIdEntidad($sigla);
					//con la sigla sacar el id_entidad
					
					if (($id_entidad!="") and ($id_entidad>0)){
						echo $xml = generaXML($id_entidad,$sigla,$fecha_inicio,$fecha_termino);
					}else{
						echo "Llamado inv&aacute;lido, faltan par&aacute;metros aca";
					}
					

	
		//	echo "hola ".$_SERVER['PHP_AUTH_USER']." ip->".$_SERVER['REMOTE_ADDR'];
		    	//return;
			}
		    else{
		    	header('WWW-Authenticate: Basic realm="My Realm"');
		    	header('HTTP/1.0 401 Unauthorized');
		    	echo 'No autorizado ' ;
		    	exit;
		    }
		}
		
	function generaXML($id_entidad,$sigla,$fecha_inicio,$fecha_termino)
	{
		//calcular la cantidad de usuarios registrados
		$cantidad_registrados = calculaUsuariosRegistrados();
			
		$xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
		$xml = $xml."<transaccion>";	
		$xml = $xml."<cantidad_solicitantes>".$cantidad_registrados."</cantidad_solicitantes>";
		
		$condicion = "";
		if (($fecha_inicio != "") and ($fecha_termino != "")){
			$condicion = " and fecha_inicio >= '".$fecha_inicio."' and fecha_inicio <= '".$fecha_termino."'";
		}else{
			if (($fecha_inicio != "") and ($fecha_termino == "")){
				$condicion = " and fecha_inicio >='".$fecha_inicio."' ";
			}
			if (($fecha_inicio == "") and ($fecha_termino != "")){
				$condicion = " and fecha_inicio <= '".$fecha_termino."'";
			}
		}
		
		$sql = "Select id_sub_estado_solicitud,
					   id_formato_entrega,
					   oficina,
					   id_forma_recepcion,
					   notificacion,
					   id_entidad,
					   fecha_inicio,
					   fecha_inicio as fecha_origina,
					   fecha_termino,
					   fecha_digitacion,
					   folio,
					   prorroga,
					   firmada,
					   0,
					   0,
					   id_usuario,
					   folio_origen
				From sgs_solicitud_acceso
				where id_entidad = '$id_entidad'
						".$condicion."				
				order by fecha_inicio asc";
		$result = mysql_query($sql) 
						or die("<br>La consulta fallo   <br>$sql<br> ".mysql_error());	
		//echo "<br>pasa";
		////echo "<br>cantidad en procesar solicitud:".mysql_num_rows($result);
	
		$i=1;
		while(list($id_sub_estado_solicitud,$id_formato_entrega,$oficina,$id_forma_recepcion,$notificacion,$id_entidad,$fecha_inicio,$fecha_original,$fecha_termino,$fecha_digitacion,$folio,$prorroga,$firmada,$id_categoria,$id_tipo_finalizacion,$id_usuario,$folio_origen) = mysql_fetch_row($result) ){		
			////echo "<br> id_estado:".$id_estado."  id_tramo:".$id_tramo."    cantidad:".$cantidad."<br>";
				$xml = $xml."<sgs_solicitud_acceso>";
				$xml = $xml."<id_estado>".$id_sub_estado_solicitud."</id_estado>";
				$xml = $xml."<id_formato_entrega>".$id_formato_entrega."</id_formato_entrega>";
				$xml = $xml."<oficina>".$oficina."</oficina>";
				$xml = $xml."<id_forma_recepcion>".$id_forma_recepcion."</id_forma_recepcion>";
				$xml = $xml."<notificacion>".$notificacion."</notificacion>";
				$xml = $xml."<id_entidad>".$sigla."</id_entidad>";
				$xml = $xml."<fecha_inicio>".$fecha_inicio."</fecha_inicio>";
				$xml = $xml."<fecha_formulacion>".$fecha_original."</fecha_formulacion>";
				$xml = $xml."<fecha_estimada_termino>".$fecha_termino."</fecha_estimada_termino>";
				$xml = $xml."<fecha_digitacion>".$fecha_digitacion."</fecha_digitacion>";
				$xml = $xml."<folio>".$folio."</folio>";
				$xml = $xml."<prorroga>".$prorroga."</prorroga>";
				//calcular la fecha de finalizacion
				$fecha_finalizada = "0000-00-00";
				if ($id_sub_estado_solicitud >= 13){
					$fecha_finalizada = traeFechaFinalizacion($folio,$id_sub_estado_solicitud);
				}
				$xml = $xml."<fecha_finalizada>".$fecha_finalizada."</fecha_finalizada>";
				$xml = $xml."<firmada>".$firmada."</firmada>";
				
				
				//sacar estos datos de otra tabla
				$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna 						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
				$result_rectificar = mysql_query($sql)or die (mysql_error());//(error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$email,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna) = mysql_fetch_row($result_rectificar);
					$id_pais = verificaPais($id_region,"sgs_rectificacion_solicitud","folio",$folio);
				}else{
					$email = rescata_valor2('usuario',$id_usuario,'email');	
					$id_region = rescata_valor2('usuario',$id_usuario,'id_region') ;
					$id_pais = verificaPais($id_region,"usuario","id_usuario",$id_usuario);
					$id_comuna = rescata_valor2('usuario',$id_usuario,'id_comuna') ;
				}
				
				$id_sexo = rescata_valor2('usuario',$id_usuario,'id_sexo') ;
				$edad = rescata_valor2('usuario',$id_usuario,'edad') ;
				$id_nacionalidad = rescata_valor2('usuario',$id_usuario,'id_nacionalidad') ;
				$id_ocupacion = rescata_valor2('usuario',$id_usuario,'id_ocupacion') ;
				$id_nivel_educacional = rescata_valor2('usuario',$id_usuario,'id_nivel_educacional') ;
				$id_organizacion = rescata_valor2('usuario',$id_usuario,'id_organizacion') ;
				$id_frecuencia_organizacion = rescata_valor2('usuario',$id_usuario,'id_frecuencia_organizacion') ;
	
				/*fin sacar datos*/
				//sacar el pais
				/*if ($id_pais=="51"){
					$nombre="Chile" ;
					$tipo = "pais";
					$id_pais = sacaValorSectores($tipo,$nombre);
				}*/
				$xml = $xml."<pais>".$id_pais."</pais>";
				
				/*if($id_region!=""){
					$nombre = rescata_valor2('regiones',$id_region,'region');
					$tipo = "region";
					$id_region = sacaValorSectores($tipo,$nombre);
					
				}*/
				//$xml = $xml."<region>".$id_region."</region>";
				//sacar la provincia 
				if($id_comuna!=""){
					$id_comuna = sacaValorComunaAEM($id_comuna);
				}
				//$xml = $xml."<provincia>".$id_provincia."</provincia>";
				
				$xml = $xml."<comuna>".$id_comuna."</comuna>";
				$xml = $xml."<nacionalidad>".$id_nacionalidad."</nacionalidad>";
				$xml = $xml."<codigo>".md5($email)."</codigo>";
				$xml = $xml."<sexo>".$id_sexo."</sexo>";
				$xml = $xml."<edad>".$edad."</edad>";
				$xml = $xml."<ocupacion>".$id_ocupacion."</ocupacion>";
				$xml = $xml."<nivel_educacional>".$id_nivel_educacional."</nivel_educacional>";
				$xml = $xml."<tipo_organizacion>".$id_organizacion."</tipo_organizacion>";
				$xml = $xml."<frecuencia>".$id_frecuencia_organizacion."</frecuencia>";
				
				//sacar las categorias asociadas a la solicitud
				$sql = "Select id_categoria from sgs_solicitud_acceso_categoria where folio = '$folio'";
				$res_categorias = mysql_query($sql)or die("error en consulta:<br>".mysql_error()."<br>".$sql);
				$id_categoria = "";
				while($linea = mysql_fetch_array($res_categorias)){
					if ($id_categoria==""){
						$id_categoria = $linea["id_categoria"];
					}else{
						$id_categoria .= ",".$linea["id_categoria"];
					}
				}
				
				$xml = $xml."<id_categoria>".$id_categoria."</id_categoria>";
				$xml = $xml."<tipo_finalizacion>".$id_tipo_finalizacion."</tipo_finalizacion>";
				$xml = $xml."<folio_origen>".$folio_origen."</folio_origen>";
				
				$xml = $xml."</sgs_solicitud_acceso>";
		}
		$xml = $xml."</transaccion>";
	
	
		return $xml;
	}
	
	function calculaUsuariosRegistrados(){
		
		$sql = "Select count(*) as cantidad from usuario where id_perfil = 1 ";
		$result_usuarios = mysql_query($sql) 
						or die("<br>la consulta fallo 1  <br>$sql<br> ".mysql_error());	
		list($cantidad) = mysql_fetch_row($result_usuarios);
		
		return $cantidad;
	}
	
	function traeFechaFinalizacion($folio,$id_estado_solicitud){
		$fecha_finalizacion = "0000-00-00";
		if ($id_estado_solicitud==28){
			$id_estado_solicitud=14;
		}
		if ($id_estado_solicitud==29){
			$id_estado_solicitud=15;
		}
		$sql = "select fecha 
			from sgs_flujo_estados_solicitud 
			where folio = '".$folio."' 
				and id_estado_solicitud = ".$id_estado_solicitud."  
			order by id_flujo_estados_solicitud desc ";
		$result_fecha = mysql_query($sql) 
						or die("<br>la consulta fallo 2  <br>$sql<br> ".mysql_error());	
		list($fecha_finalizacion) = mysql_fetch_row($result_fecha);
		if ($fecha_finalizacion==""){
			$fecha_finalizacion = "SOLICITUD SIN FECHA DE TERMINO EN EL HISTORIAL";
		}
		return $fecha_finalizacion;
	}
	
	function obtieneIdEntidad($sigla){
		$entidadPadre = substr($sigla,0,2);
		$servicio = substr($sigla,2,3);
		
		$sql = "select b.id_entidad
				from sgs_entidad_padre a,
					 sgs_entidades b
				where a.sigla = '$entidadPadre'
					  and a.id_entidad_padre = b.id_entidad_padre
					  and b.sigla = '$servicio'";
		$result = mysql_query($sql)or die("Error en la consulta:".$sql);
		list($id_entidad)=mysql_fetch_row($result);
		return $id_entidad;
		
	}
	function sacaValorComunaAEM($id_comuna){
		$nombre = str_replace("'","\'",$nombre);
		$sql = "Select id_comuna_aem from comunas where id_comuna = '$id_comuna' ";
		$result = mysql_query($sql)or die("Error en la consulta:".$sql);
		list($id_comuna_aem)=mysql_fetch_row($result);
		return $id_comuna_aem;
	}
	function rescata_valor2($tabla,$valor_id_registro,$campo_consulta){

//echo "$tabla,$valor_id_registro,$campo_consulta";

if(!is_numeric($tabla)){

 $query= "SELECT id_auto_admin   
           FROM  auto_admin
           WHERE tabla='$tabla'";
     $result= mysql_query($query)or die (mysql_error()."<br>".mysql_error());
     if(list($id_auto_admin) = mysql_fetch_row($result)){
	    $tabla_consulta=$tabla;
	 }
	 
	
}else{
$id_auto_admin= $tabla;

  $query= "SELECT tabla   
           FROM  auto_admin
           WHERE id_auto_admin='$tabla'";
     $result= mysql_query($query)or die (mysql_error()."<br>".mysql_error());
     if(list($tabla) = mysql_fetch_row($result)){
	    $tabla_consulta=$tabla;
		
	 }
}

$campo_pk = campo_pk_tabla($id_auto_admin);
	if($tabla_consulta!="" and $campo_consulta!="" and $campo_pk!="" and $valor_id_registro!=""){

		  $query= "SELECT $campo_consulta   
                   FROM  $tabla_consulta
                   WHERE $campo_pk='$valor_id_registro'";

//				 echo "<br><br>$query<br><br>";
             $result= mysql_query($query)or die (mysql_error()."<br>".mysql_error());
              list($valor_consulta) = mysql_fetch_row($result);
		
		return utf8_encode($valor_consulta);
	}else{
		 return ".";
	}

}


?>