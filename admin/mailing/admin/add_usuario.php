<?php
$add = $HTTP_GET_VARS['add'];
$lote = $HTTP_GET_VARS['lote'];
if(isset($add)){

$nombre = $HTTP_POST_VARS['nombre'];
$apellido = $HTTP_POST_VARS['apellido'];
$mail1 = $HTTP_POST_VARS['mail1'];
$mail2 = $HTTP_POST_VARS['mail2'];
$telefono1 = $HTTP_POST_VARS['telefono1'];
$telefoni2 = $HTTP_POST_VARS['telefono2'];
$tipo = $HTTP_POST_VARS['tipo'];
$direccion = $HTTP_POST_VARS['direccion'];
$texto = $HTTP_POST_VARS['texto'];


set_time_limit (0);


  

/*Lectura de Archivo txt*/	
$archivo_name= $HTTP_POST_FILES['archivo']['name'];
$archivo= $HTTP_POST_FILES['archivo']['tmp_name'];
			
	   if ($archivo!=""){
              
	   			if(!is_dir("admin/mailing/admin/file")){
	   				mkdir("admin/mailing/admin/file");
	   				chmod("admin/mailing/admin/file",0777);
	   				
	   			}else{
	   				chmod("admin/mailing/admin/file",0777);
	   				
	   			}

	   			
	   			$archivo2 = ereg_replace('&','*',$archivo_name);
	   			
	   			//echo "admin/mailing/admin/file/$archivo2";
	   			
				      $archivo2 = ereg_replace(' ',':',$archivo2);
					      if (copy($archivo, "admin/mailing/admin/file/$archivo2"))
					        {
							 
					        	
					        	$fp=fopen("admin/mailing/admin/file/$archivo2","r");



								while ($texto=fgets($fp,1024))
      								{
    								/*	$cont_file++;
      									$texto = strtolower($texto);
	
	$texto = str_replace("<","",$texto);
	$texto = str_replace(">","",$texto);
	$texto = str_replace("[","",$texto);
	$texto = str_replace("]","",$texto);
	$texto = str_replace(";"," # ",$texto);
	$texto = str_replace("'","",$texto);
	$texto = str_replace(","," # ",$texto);
	
	
	$aux=explode("#", $linea);
	
	$cont_add=0;
	
	
	$caracteres = strlen($texto);
	
	while($a < $caracteres){
		echo " $cont_file $texto<br>";
		if($texto[$a]!=" "){
			$palabra .= $texto[$a];
		}else{
			
			
			}
				}
				
				*/
			
			$palabra = str_replace("#","",$texto);
			//echo $palabra;
			$ocurre = substr_count($palabra,"@");

			if($ocurre==1){
				$con_mail++;
				$mail = $palabra;
				$nombre = explode("@", $palabra);
				$nombre = $nombre[0];
				//$nombre = $palabra;
				
				/********************************************************/
				
				$query= "SELECT id_usuario
                 FROM mailing_usuario
                 WHERE 1 AND mail 
                 LIKE '%$mail%'";
           $result= cms_query($query);
		   
	//	 echo $query ."<br>";
		   
                if (!list($id_usuario) = mysql_fetch_row($result)){
      				$cont_add++;		
				
				$lista_correos  .= "<tr><td align=\"center\" class=\"textos\">$mail</td></tr>";
		  
				$id_usuario = new_uid();


				$qry_insert="INSERT INTO mailing_usuario 
				values ('$id_usuario','$nombre','$apellido','$mail','$mail2','$telefono1','$telefono2','$tipo','$nomas','$id_mailing_nomas','$direccion')";
                  
				$cont_mail++;
				
    			$result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");				
				//  $importa .=  " $id_usuario','$nombre', '$apellido', '$mail'</div><br>";
			$importa .="<div aling=\"center\" class=\"textos\">Mail ($nombre : $mail) agregado </div><br>";
			 
							   
      		 }
			
				$ocurre =0;
				$nombre ="";
			}
			
			$palabra="";
		
		
		$a++;
      									
								
					        	
							  
							 }
					
                      }else{
                      
                      }

                     $lista_correos =  "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                          $lista_correos
                      	</table>";
                      
echo "<script>alert('Se han agregado $cont_mail mails a la BD'); </script>\n";
/*Fin lectura Archivo*/
}

/*Texto en Texarea*/


if($texto!=""){
	$texto = strtolower($texto);
	
	$texto = str_replace("<","",$texto);
	$texto = str_replace(">","",$texto);
	$texto = str_replace("[","",$texto);
	$texto = str_replace("]","",$texto);
	$texto = str_replace(";"," # ",$texto);
	$texto = str_replace("'","",$texto);
	$texto = str_replace(","," # ",$texto);
	
	
	$aux=explode("#", $linea);
	
	$cont_add=0;
	
	
	$caracteres = strlen($texto);
	
	while($a < $caracteres){
		
		if($texto[$a]!=" "){
			$palabra .= $texto[$a];
		}else{
			$palabra = str_replace("#","",$palabra);
			
			$ocurre = substr_count($palabra,"@");

			if($ocurre==1){
				$con_mail++;
				$mail = $palabra;
				
				$nombre = explode("@", $palabra);
				$nombre = $nombre[0];
				//$nombre = $palabra;
				
				/********************************************************/
				
				$query= "SELECT id_usuario
                 FROM mailing_usuario
                 WHERE 1 AND mail 
                 LIKE '%$mail%'";
           $result= cms_query($query);
		   
	//	 echo $query ."<br>";
		   
                if (!list($id_usuario) = mysql_fetch_row($result)){
      				$cont_add++;		
				
				
		  
				$id_usuario = new_uid();


				$qry_insert="INSERT INTO mailing_usuario 
				values ('$id_usuario','$nombre','$apellido','$mail','$mail2','$telefono1','$telefono2','$tipo','$nomas','$id_mailing_nomas','$direccion')";
                  
				//echo $qry_insert."<br>";
				
    			$result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");				
				//  $importa .=  " $id_usuario','$nombre', '$apellido', '$mail'</div><br>";
			$importa .="<div aling=\"center\" class=\"textos\">Mail ($nombre : $mail) agregado </div><br>";
			 
							   
      		 }
			
				$ocurre =0;
				$nombre ="";
			}
			
			$palabra="";
		}
		
		$a++;
	}
	

    echo "<script>alert('Se han creado $cont_add en la base de datos.'); document.location.href='$PHP_SELF?accion=10&act=3010&tipo=$tipo&act_all=1';</script>\n";

	
  }
  
  /*Fin lectura TextArea*/



}

$onsubmit ="onSubmit=\"return validaforma(this)\"";


   $query= "SELECT  id_tipo_u,descrip   
           FROM mailing_usuario_tipo ";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
            
			$tabla_bases .="   <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Bases de Datos:</td>
                                  </tr>
								  <tr>
                                  <td align=\"center\" class=\"textos\">&nbsp;</td>
                                  </tr>
								   <tr>
                                  <td align=\"center\" class=\"textos_rojo\">$mensaje</td>
                                  </tr>
                            	</table>";
			
			 while (list($id_tipo_u,$descrip) = mysql_fetch_row($result)){
			 
		     if($tipo==$id_tipo_u){
			 $var= "selected";
			 }else{
			 $var="";
			 }
			$option_sell .="<option value=\"$id_tipo_u\" $var>$descrip</option>";   
		 }

$accion_form="$PHP_SELF?accion=$accion&act=$act&act_all=6&add=ok";	






if($lote=="ok"){
	$js ="<script language=\"JavaScript\">
function validaforma(theForm){

	if (theForm.tipo.value == \"#\"){
			alert(\"Debes seleccionar una base.\");
			theForm.tipo.focus();
			return false;
	}
	

}
</script>";
	
	$formulario= " <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                             	 <tr>
                             
							  <td align=\"center\" class=\"textos\">Selecione base de datos
							  <select name=\"tipo\">
							  <option value=\"#\">--></option>
                              $option_sell
                              </select>
							  </td>
                            </tr>

	                           <tr>
                                <td align=\"center\" class=\"textos\">
								Ingrese texto con mails...
                                    </td>
                                </tr>
                            <tr>
                                <td align=\"center\" class=\"textos\">
								<textarea name=\"texto\" cols=\"60\" rows=\"5\" class=\"textos\"></textarea>
                                    </td>
                                </tr>
                           <tr>
                                <td align=\"center\" class=\"textos\">&nbsp;</td>
                                </tr>
                           <tr>
                          <tr>
                                <td align=\"center\" class=\"textos\">
                                <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	   							 <tr>
	     							 <td align=\"center\" class=\"textos\">Mediante Archivo :</td>
	    						     <td align=\"center\" class=\"textos\"> 
	    						    	<input type=\"file\" name=\"archivo\">
	    						      </td>
	    						  </tr>
								</table>
                                </td>
                                </tr>
                           <tr>
                                <td align=\"center\" class=\"textos\">
								<input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
                                    </td>
                                </tr>
                          	</table>";
	
}else{
	$js ="<script language=\"JavaScript\">
function validaforma(theForm){

	if (theForm.nombre.value == \"\"){
			alert(\"Debes ingresar un Nombre.\");
			theForm.nombre.focus();
			return false;
	}if (theForm.tipo.value == \"#\"){
			alert(\"Debes seleccionar una base.\");
			theForm.tipo.focus();
			return false;
	}
	

}
</script>";
							   
$formulario = "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                   <tr>
                     <td align=\"center\" class=\"textos\">Creaci&oacute;n de Usuarios</td>
                     </tr>
					 <tr>
                     <td align=\"center\" class=\"textos\">&nbsp;</td>
                     </tr>
               	</table>
<table width=\"60%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"left\" class=\"textos\">Nombre:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"nombre\" class=\"textos\" value=\"$nombre\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Apellido:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"apellido\" class=\"textos\" value=\"$apellido\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Mail1:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"mail1\" class=\"textos\" value=\"$mail1\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Mail2:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"mail2\" class=\"textos\" value=\"$mail2\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Tel&eacute;fono1:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"telefono1\" class=\"textos\" value=\"$telefono1\"></td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Tel&eacute;fono2:</td>
							  <td align=\"center\" class=\"textos\">
							  <input type=\"text\" name=\"telefono2\" class=\"textos\" value=\"$telefono2\">
							  
							  </td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Direcci&oacute;n:</td>
							  <td align=\"center\" class=\"textos\">
							     <input type=\"text\" name=\"direccion\" class=\"textos\" value=\"$direccion\" size=\"30\">
							   </td>
                            </tr>
							 <tr>
                              <td align=\"left\" class=\"textos\">Base:</td>
							  <td align=\"center\" class=\"textos\">
							  <select name=\"tipo\">
							  <option value=\"#\">--></option>
                              $option_sell
                              </select>
							  </td>
                            </tr>
                          </table>
						    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                             <tr>
                                <td align=\"center\" class=\"textos\">
								<input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
                                    </td>
                                </tr>
                           <tr>
                                <td align=\"center\" class=\"textos\">
										<a href=\"?accion=$accion&act=$act&act_all=6&lote=ok\">Subir por Lote</a>
                                    </td>
                                </tr>
                          	</table>";	
	
}





$contenido .= $formulario;

$contenido .= $lista_correos;

?>