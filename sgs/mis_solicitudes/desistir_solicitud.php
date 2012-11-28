<?php
$folio = $_POST['folio'];
if($folio==""){
$folio = $_GET['folio'];
}



$obs_desisitir = $_POST['obs_desisitir'];


if($obs_desisitir!=""){
$_SESSION['obs_des']=$obs_desisitir;
echo $_SESSION['obs_des'];
}

session_register_cms('obser');
echo " &nbsp;";

//16
//23
$id_usuario= id_usuario($id_sesion);
if($obs_desisitir=="" and $_SESSION['obs_des']==""){

$contenido = "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
				    <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
					<tr >
				      <td align=\"center\" class=\"textos_rojo\">
				     <strong>Para desistir una solicitud se debe ingresar una observaci&oacute;n</strong>
				      </td>
				      </tr>   
					 <tr >
				      <td align=\"center\" class=\"textos\">
					   <a href=\"?accion=$accion&act=1&folio=$folio\" >Volver al formulario</a>
				      </td>
				      </tr>
					  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
				      
					</table>";
$contenido = cuadro_rojo($contenido);

}else{



$ok = $_GET['ok'];
if($ok==""){



	$contenido = "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\"  >
				    <tr >
				      <td align=\"center\" class=\"textos\">
				    <h3> <strong>&iquest;Est&aacute;  seguro de desitir esta solicitud?</strong></h3>
				      </td>
				      </tr>   
					 <tr >
				      <td align=\"center\" class=\"textos\">
					    <table width=\"30%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                          <tr >
                            <td align=\"center\" class=\"textos\">
								<input type=\"button\" name=\"desistir_si\" value=\"Si\" class=\"botoncla\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=4&folio=$folio&ok=1&axj=1','div_respuesta');\"  />
							</td>
                            <td align=\"center\" class=\"textos\">
								
								<input type=\"button\" name=\"desistir_no\" value=\"No\" class=\"botonred\"  onclick=\"cancelar_desistir();\"  />
							</td>
                            </tr>
                      	</table>
				    	
				      </td>
				      </tr>
					  
				      
					</table>";
	$contenido = cuadro_amarillo($contenido);
}else{
$folio = $_GET['folio'];
$obs_des= $_SESSION['obs_des'];
$id_usuario     = id_usuario($id_sesion);

		$query= "SELECT id_solicitud_acceso,id_estado_solicitud,id_sub_estado_solicitud,id_responsable
				  FROM  sgs_solicitud_acceso 
				  WHERE folio='$folio' and id_usuario=$id_usuario";


			 $result= cms_query($query)or die (error($query,mysql_error(),$php));
			 if(list($id_solicitud_acceso,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable) = mysql_fetch_row($result)){
			
			
			//if($id_estado_solicitud==1){
			$observacion= "Finalizada por el usuario solicitante : <br><br> $obs_des";
		
	
	
	$contenido = "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
				    <tr >
				      <td align=\"center\" class=\"textos\">
				    <h3> <strong>Solicitud desitida.</strong></h3>
				      </td>
				      </tr>   
					 <tr >
				      <td align=\"center\" class=\"textos\">
				   <a href=\"index.php?accion=$accion\">Volver al listado</a>
				      </td>
				      </tr>
					  <tr><td align=\"center\" class=\"textos\"> &nbsp; </td></tr> 
				      
					</table>";
					
					$fecha_termino = date(Y)."-".date(m)."-".date(d);
				$sql = "UPDATE sgs_solicitud_acceso set 
						fecha_termino='$fecha_termino'
				where folio = '$folio'";

 cms_query($sql)or die (error($query,mysql_error(),$php));
	
	
	
					Insertar_historial($folio,27,$observacion);
			//} 	
	
		/*
			if($id_estado_solicitud==3){
			$observacion= "Solicitud de desestimiento por el usuario solicitante : <br><br> $obs_des";
		
	
	
	$contenido = "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
				    <tr >
				      <td align=\"center\" class=\"textos\">
				    <h3> <strong>Se ha solicitado el desistimiento de su solicitud, &eacute;ste debe ser aprobado por el encargado de solicitudes.</strong></h3>
				      </td>
				      </tr>   
					 <tr >
				      <td align=\"center\" class=\"textos\">
				   <a href=\"index.php?accion=$accion\">Volver a Mis Solicitudes</a>
				      </td>
				      </tr>
					  <tr><td align=\"center\" class=\"textos\"> &nbsp; </td></tr> 
				      
					</table>";
					Insertar_historial($folio,26,$observacion);
			} 	
	*/
	
	
					$contenido = cuadro_verde($contenido);
					$_SESSION['obs_des']="";
			 }
				




}


}

?>