<?php

function configuracion_cms($configuracion,$verifica = 0){

      
$configuracion_sess= str_replace(" ","_",$configuracion);

if($verifica==1){
$_SESSION[$configuracion_sess] ="";
}
   $idiom = $_SESSION['idioma'];
   if($idioma!="esp"){
   	$idioma = "_$idiom";
   }
   $configuracion2=$configuracion."$idioma";
   

			 
					 
if(!isset($_SESSION[$configuracion_sess]) ){

session_register_cms($configuracion_sess);


	  		$query= "SELECT valor
		     		 FROM  cms_configuracion
	         		 WHERE configuracion='$configuracion'";

	
    			$result= mysql_query($query)or die (mysql_error());
      			if(list($valor) = mysql_fetch_row($result)){
				 
					$_SESSION[$configuracion_sess]=$valor;
					return $valor;
					echo "$configuracion -> $valor sql<br>";
				}else{
					return "$configuracion no existe cofiguracion_cms";
				}
	
	 
	  
    

}else{
     if($_GET['tp']==6){
	  echo "$configuracion -> $_SESSION[$configuracion_sess] sess<br>";
      }	
return $_SESSION[$configuracion_sess];
}



	  
}





function error($query2,$mysql_error,$php){

global $id_sesion;


$id_usuario     = id_usuario($id_sesion);
$nombre_usuario= nombre_usuario($id_usuario);
$contacto_tecnico=configuracion_cms('contacto_tecnico_sgs');
$nombre_contacto_tecnico = configuracion_cms('Nombre_de_contacto_Tecnico');
$url =$_SERVER["REQUEST_URI"];
$servidor =$_SERVER["SERVER_NAME"];

$fecha = date('Y-m-d');
$hora = date('h:m:i');
$mysql_error = str_replace("'","#",$mysql_error);
$query2 = str_replace("'","#",$query2);

$accion = $_GET['accion'];
$act = $_GET['act'];

$qry_insert="INSERT INTO error(id_error,accion,act,query_error,mysql_error,php,id_usuario,fecha,hora,solucionado,descripcion_solucion,id_user_solucion,url,servidor ) 
			values (null,'$accion','$act','$query2','$mysql_error','$php','$id_usuario','$fecha','$hora','$solucionado','$descripcion_solucion','$id_user_solucion','$url','$servidor')";
  
mysql_query($qry_insert)or die ("ERROR $php <br>$qry_insert"); ;
$id_error= @mysql_insert_id();
if (configuracion_cms('Aviso de errores via email')){

$destinatario=configuracion_cms('mail de soporte');

$asunto="Se ha detectado un error en la aplicaci&oacute;n";

$cuerpo = "Id de registro de error : $id_error <br></br>\n\n
Consulta con problemas  : $query2<br></br>\n\n
Error de mysql : $mysql_error<br></br>\n
Usuario: $nombre_usuario ($id_usuario)<br></br>\n\n
Fecha: $fecha<br></br>\n\n
Php : $php<br></br>\n\n
Url : $url<br></br>\n\n
Contacto  :$nombre_contacto_tecnico  $contacto_tecnico<br></br>\n\n
Servidor : $servidor<br></br>\n\n";

cms_mail($destinatario,$asunto,$cuerpo,$headers);


}

if(perfil($id_sesion)==999){
    //header("Location:index.php?accion=54787&act=1&id_a=216&id=$id_error");
}else{
    header("Location:index.php?accion=error&id=$id_error");
  
}
echo $query2;
}



function session_register_cms($variable){
	 $version_php=phpversion();
	// echo $version_php." rrr";
    // $version_php= str_replace(".","",$version_php);
     $version = explode('.', $version_php);
     $version_php=$version[0];
	 if($version_php<6){
	 //session_register($variable);
	
	 }
	 
	if (function_exists('session_register')) {
	 @session_register($variable);
	 } 


}

function tabla_existe($tabla){
$check = cms_query("SELECT * FROM $tabla LIMIT 0,1"); /* >>limit<< is just to make it faster in case the db is huge */

	if ($check){

		return true;

	}else{
		return false;

	}
}

function ip_del_usuario(){
    if( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] )) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if( isset( $_SERVER ['HTTP_VIA'] ))  $ip = $_SERVER['HTTP_VIA'];
    else if( isset( $_SERVER ['REMOTE_ADDR'] ))  $ip = $_SERVER['REMOTE_ADDR'];
    else $ip = null ;
    return $ip;
}


function asigna_etiquetas($template){
$html =  html_template($template);

  $query= "SELECT id_templates 
           FROM  templates_acciones
           WHERE templates='$template'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_template) = mysql_fetch_row($result);
	 
	   $query= "SELECT etiqueta,variable   
                FROM  templates_acciones_etiquetas 
                WHERE id_templates='$id_template'";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           while (list($etiqueta,$variable) = mysql_fetch_row($result)){
     			
				if($variable==""){
				$variable = strtolower($etiqueta);
				
				}
				
				global  $$variable;
				//$var = $$variable;
				
				$html = str_replace("#$etiqueta#",$$variable,$html);
							   
     		 }
	 
	 
	// $html= acentos($html);
	 
	 return $html;
	 

}





function dias_no_habiles($fecha1, $fecha2){

$aux=explode("-", $fecha1);
	
	if($aux[2]!=4){
		$fecha1 = fechas_bd($fecha1);

		}

	$aux=explode("-", $fecha2);

	if($aux[2]!=4){
		
		$fecha2 = fechas_bd($fecha2);
		}
		
	if ($aux[2]>2007){
	  $query= "SELECT count(*)   
           FROM  no_habil 
           WHERE no_habil >='$fecha1' and no_habil<='$fecha2'";
    
	 $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($cant_dias) = mysql_fetch_row($result);
	
	}

	
	 return $cant_dias;

}
	
function rectifica_fechas($fecha1, $fecha2,$dias_de_plazo){
		
if($dias_de_plazo==""){
 $dias_de_plazo=  configuracion_cms('dias_de_plazo');
}
	
   
    $cant_dias= dias_no_habiles($fecha1, $fecha2);

     $cant_dias = $cant_dias+$dias_de_plazo;
	
	 $fecha_mas = suma_fechas($fecha1,$cant_dias);
	 $fecha1 = fechas_html($fecha1);
	
	 $volver=0;
	 while($volver ==1){
	     
	     $dif = rectifica_fechas($fecha1, $fecha_mas);
		
		if($dif !=$fecha_mas){
		  $volver =1;
		}else{
		  $volver =0;
		
		$fecha_mas = $dif;
		}
	 }
	
	
return $fecha_mas;

}


session_register_cms('dia_patch');

/*


function suma_fechas($fecha,$ndias){



	$aux=explode("-", $fecha);
	
	if(strlen($aux[2])==4 and $aux[2]>2007){
		$fecha = fechas_bd($fecha);
	        $anio=$aux[2];
	}else{
	       $anio=$aux[0];
	}
	
	if($ndias<0){
	$nuevafecha = date("Y-m-d", strtotime("$fecha  $ndias days"));
	}else{
	$nuevafecha = date("Y-m-d", strtotime("$fecha + $ndias days"));
	}
	
		if ($nuevafecha==$fecha and $anio>2007){
		$ndias=1+$ndias;
		$nuevafecha = date("Y-m-d", strtotime("$fecha + $ndias days"));
	

	}

	
       return ($nuevafecha);         
}

*/
 

function suma_fechas($fecha,$ndias){

	
	 $sistema_operativo = php_uname ('a');
	//saber si es windows
	 $aux=explode("-", $fecha);
	  
	if(strlen($aux[2])==4 and $aux[2]>2007){
		$fecha = fechas_bd($fecha);
		$anio=$aux[2];
	}else{
		$anio=$aux[0];
	}

	$cantidad = substr_count(strtoupper($sistema_operativo), 'WINDOWS'); 
	//echo "<br>"
	
	if ($cantidad>0){//es windows
		$fecha2 = strtotime($fecha) + $ndias*24*60*60;
		$nuevafecha= date('Y-m-d', $fecha2); 
		//echo " $nuevafecha==$fecha <br>";
		if ($nuevafecha==$fecha and $anio>2007){
			//en versiones php sobre windows existen dias que se le suman 1 dia mas y no da el siguiente
			//dia en ese caso se suman 2 dias
			$ndias=1+$ndias;
			$fecha2 = strtotime($fecha) + $ndias*24*60*60;
			$suma= strtotime($fecha);
			//echo "$suma + ".$ndias*24*60*60;
			$nuevafecha= date('Y-m-d', $fecha2); 
		}
	}else{
	  if($ndias<0){
      	$nuevafecha = date("Y-m-d", strtotime("$fecha  $ndias days"));
      }else{
      	$nuevafecha = date("Y-m-d", strtotime("$fecha + $ndias days"));
      }
      
      if ($nuevafecha==$fecha and $anio>2007){
            $ndias=1+$ndias;
            $nuevafecha = date("Y-m-d", strtotime("$fecha + $ndias days"));
      
      }

	}
	
    return ($nuevafecha);         
}




function diferencia_entre_fechas($fecha1,$fecha2){

$fecha = fechas_bd($fecha1);

$aux=explode("-", $fecha1);


if($aux[0]>2007){
	$dias = calculaDiasHabiles($fecha);
	return $dias;			


}


}





function grupo_galeria_nombre($id_grupo_galeria){

	

  $query= "SELECT grupo_galeria 

         FROM  grupo_galeria

         WHERE id_grupo_galeria='$id_grupo_galeria'";

           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");

          list($grupo_galeria) = mysql_fetch_row($result);

          

            return $grupo_galeria;	



}





function titulo_url($titulo){

$titulo = acentos($titulo);
$titulo = str_replace("&aacute;","a",$titulo);
$titulo = str_replace("&eacute;","e",$titulo);
$titulo = str_replace("&iacute;","i",$titulo);
$titulo = str_replace("&oacute;","o",$titulo);
$titulo = str_replace("&uacute;","u",$titulo);
$titulo = str_replace("&ntilde;","n",$titulo);
$titulo = str_replace("&Aacute;","A",$titulo);
$titulo = str_replace("&Eacute;","E",$titulo);
$titulo = str_replace("&Iacute;","I",$titulo);
$titulo = str_replace("&Oacute;","O",$titulo);
$titulo = str_replace("&Uacute;","U",$titulo);
$titulo = str_replace("&Ntilde;","N",$titulo);
$titulo = str_replace("%20","-",$titulo);
$titulo = str_replace(",","",$titulo);
$titulo = str_replace("\"","",$titulo);
$titulo = str_replace(":","",$titulo);
$titulo = str_replace("?","",$titulo);
$titulo = str_replace("!","",$titulo);
$titulo = str_replace("&","",$titulo);
$titulo = str_replace("(","",$titulo);
$titulo = str_replace(")","",$titulo);
$titulo = str_replace("_"," ",$titulo);
$titulo = str_replace(" ","-",$titulo);
$titulo = str_replace("--","-",$titulo);

return $titulo;
}











function rescata_valor($tabla,$valor_id_registro,$campo_consulta){

//echo "$tabla,$valor_id_registro,$campo_consulta";

if(!is_numeric($tabla)){

 $query= "SELECT id_auto_admin   
           FROM  auto_admin
           WHERE tabla='$tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if(list($id_auto_admin) = mysql_fetch_row($result)){
	    $tabla_consulta=$tabla;
	 }
	 
	
}else{
$id_auto_admin= $tabla;

  $query= "SELECT tabla   
           FROM  auto_admin
           WHERE id_auto_admin='$tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
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
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              list($valor_consulta) = mysql_fetch_row($result);
		
		return $valor_consulta;
	}else{
		 return ".";
	}

}



function campo_txt_combolist($id_auto_admin,$id_registro,$campo){



                      $campo_pk_combolist=$campo;

						

					  $valor_id_combolist=rescata_valor($id_auto_admin,$id_registro,$campo);

						

					  $query= "SELECT id_auto_admin   

                  				 FROM  auto_admin_campo

                   				WHERE campo='$campo' and pk=1";

             			$result= cms_query($query)or die (error($query,mysql_error(),$php));

              			list($id_auto_admin_combolist) = mysql_fetch_row($result);

              				

              							 

				 	  $campo_txt_combolist= campo_txt($id_auto_admin_combolist);

				

				      $valor = rescata_valor($id_auto_admin_combolist, $valor_id_combolist,$campo_txt_combolist);

					

			return $valor;





}





function verfica_permiso($id_auto_admin,$id_perfil,$campo_permiso){

		

	if($id_perfil!="" and $id_auto_admin!="" and $campo_permiso!=""){

	

		$query= "SELECT $campo_permiso

               FROM  auto_admin_permisos

               WHERE id_perfil= $id_perfil

               AND id_auto_admin=$id_auto_admin";

     

         $result22= cms_query($query)or die (error($query,mysql_error(),$php));

      list($respuesta_campo_permiso) = mysql_fetch_row($result22);

	

	}

	

  return $respuesta_campo_permiso;

	

}












function actualiza_configuracion_cms($configuracion,$valor){
			$Sql ="UPDATE cms_configuracion
            	   SET valor ='$valor'
            	   WHERE configuracion ='$configuracion'";
				//  echo $Sql;
            				  
            	   cms_query($Sql)or die (error($Sql,mysql_error(),$php));
			
}

function ficha_ver($id_registro,$id_auto_admin,$template){

//echo "$id_registro,$id_auto_admin,$template<br>";

if(!is_numeric($id_auto_admin)){



  $query= "SELECT id_auto_admin ,tabla  

           FROM  auto_admin

           WHERE tabla='$id_auto_admin'";

  //echo $query;

     $result_0= cms_query($query)or die (error($query,mysql_error(),$php));

     list($id_auto_admin,$tabla_template) = mysql_fetch_row($result_0);

	 

	

}else{

	

 $query= "SELECT tabla  

           FROM  auto_admin

           WHERE id_auto_admin,='$id_auto_admin,'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

     list($tabla_template) = mysql_fetch_row($result);





}













if($template!=false){



		$query= "SELECT campo,id_tipo_campo 

           FROM  auto_admin_campo

           WHERE id_auto_admin='$id_auto_admin'";

		//echo  $query."<br>";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

      while (list($campo,$id_tipo_campo) = mysql_fetch_row($result)){

			

				

				switch ($id_tipo_campo) {

				

                     case 6:

                     	

                        $valor = campo_txt_combolist($id_auto_admin,$id_registro,$campo);

				       break;                  

				

                  

                     case 11:

                   

                           $valor= rescata_valor($id_auto_admin,$id_registro,$campo);

     					$valor = number_format($valor,0,",", ".");

	 					     

                        

				       break;

                	default:

						

                	   $valor=rescata_valor($id_auto_admin,$id_registro,$campo);

                	

                  }

				$valor =acentos($valor);

				//echo "$tabla_template.dd  $campo dd";

			//	echo $template;

				$template = str_replace("#$tabla_template.$campo#",$valor,$template);

				



				

				

				

		 }







}else{



	$query= "SELECT count(*) 

           FROM  auto_admin_campo

           WHERE id_auto_admin='$id_auto_admin' and campo<>'orden'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

      list($filas) = mysql_fetch_row($result);





$template = genera_tabla(2, $filas);





$query= "SELECT campo,id_tipo_campo 

           FROM  auto_admin_campo

           WHERE id_auto_admin='$id_auto_admin' and campo<>'orden'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

      while (list($campo,$id_tipo_campo) = mysql_fetch_row($result)){

				

				$dos=0;

				

				$cont_celdas++;

				$var= "celda_$cont_celdas";

				$dos++;

				

				$template = str_replace($var,$campo,$template);

				while($dos<2){

					$dos++;

					$cont_celdas++;

				$var= "celda_$cont_celdas";

					 switch ($id_tipo_campo) {

                     case 6:

                        $valor = campo_txt_combolist($id_auto_admin,$id_registro,$campo);

				       break;

                	default:

                	    $valor=rescata_valor($id_auto_admin,$id_registro,$campo);

                	 

                  }

				

				$template = str_replace($var,$valor,$template);

		

				}

					

				

		 }



 }



				$template = str_replace("apos;","",$template);

		        $template = str_replace("&amp;","&",$template);

				$template = str_replace("amp;","&",$template);



return $template;



}















function template($nombre_template, $etiqueta,$dato){



$nombre_template = str_replace("$etiqueta","$dato",$nombre_template);



return $nombre_template;

}



function busca_cms_mail($texto){



$caracteres = strlen($texto);

	//$mail="";

	

	//$texto = str_replace(" ","#",$texto);

	while($a < $caracteres){

		

		if($texto[$a]!=" "){

			$palabra .= $texto[$a];

		}else{

			$palabra = str_replace("#","",$palabra);

			$ocurre = substr_count($palabra,"@");

			$largo_palabra= strlen($palabra);

			

			if($ocurre==1 and $largo_palabra>5){

			//echo $palabra;

				$con_mail++;

				$mail = $palabra;

				//$nombre = $palabra;

				$mail = str_replace("'","",$mail);

				$mail = str_replace(")","",$mail);

				$mail = str_replace("(","",$mail);

				$mail = str_replace("#","",$mail);

				

				

					$ocurre =0;

				$nombre ="";

			}

			//echo $palabra."<br>";

			$palabra="";

		}

		

		$a++;

	}

	

	return $mail;

}





function genera_tabla($columnas, $filas){

	

	$class_celda=$_POST['css_celda'];

	if($class_celda==""){

	$css_celda= "textos";

	}

	

	while($filas_tabla < $filas){

		$filas_tabla++;

		

		

		while ($columnas_tabla<$columnas){

			$columnas_tabla++;

			$cont_texto++;

			 

			$td_tabla .="<td align=\"center\"  class=\"$class_celda\" valign=\"top\">#celda"."_$cont_texto# </td>";

		}

		

		$tr_tabla .= "<tr>$td_tabla</tr>";

		$columnas_tabla=0;

		$td_tabla="";

		

	}

	

	$tabla_final= "<table width=\"100%\" border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"2\">

	   					 $tr_tabla

						 <tr><td align=\"center\" class=\"textos\"> </td></tr> 

				   </table>";

	

	return $tabla_final;

	

}









function email($id_sesion){









	$query= "SELECT email 

	           FROM  usuario

	           WHERE session='$id_sesion'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($email) = mysql_fetch_row($result);

	      $nombre = $nombre ." ".$apellido;

	      return $email;

	

}











function borrar($tabla,$id_valorpk){

	
$sql_master = "DESCRIBE $tabla";

$res = mysql_query($sql_master);
while($row = mysql_fetch_array($res)) {
    if($row['Key']=='PRI'){
        $nom_campo =$row['Field'];
        $condicion_pk="$nom_campo='$id_valorpk'";
    }
}
	
	
	
	
  $query= "SELECT id_auto_admin ,borrar_envia_mail,email_aviso  
           FROM  auto_admin
           WHERE tabla='$tabla'";

    $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin,$borrar_envia_mail,$email_aviso) = mysql_fetch_row($result);
	if( $borrar_envia_mail==1 and $id_valorpk!=""){		
 	$id= $id_valorpk;
	include ("admin/administracion_sistema/proc/ver.php");
	
	//se capturaron el id_auto_admin y el id del registro
		//$datos_registro contiene los datos a enviar	
	global $id_sesion;
	$usuario = nombre($id_sesion);
	
	$asunto= "Registro Borrado de tabla $tabla";
	$destinatario = $email_aviso;
	$cuerpo = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                   <tr>
                     <td align=\"center\" class=\"textos\">El usuario $usuario  ha Borrado un registro a la base de datos</td>
                     </tr>
					 <tr><td align=\"center\" class=\"textos\">$datos_registro</td></tr> 
               	</table>";
	cms_mail($destinatario,$asunto,$cuerpo,$headers);
	
	} 
	
	
	borrar_archivos_auto($id_auto_admin,$id_valorpk);
	
  $Sql ="DELETE FROM $tabla
 		WHERE $condicion_pk";
 cms_query($Sql) or die (error($query,mysql_error(),$php));

 
	
	return true;

}

function borrar_archivos_auto($id_auto_admin,$id){


  $query= "SELECT  tabla
           FROM  auto_admin
           WHERE id_auto_admin='$id_auto_admin'";
		//   echo $query;
	$campo_pk=pk_tabla($id_auto_admin);
	//echo $campo_pk;
    $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($nom_tabla) = mysql_fetch_row($result);
	
		
    $query= "SELECT campo,id_tipo_campo, carpeta  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and id_tipo_campo=8
				   order by id_campo";
   		    
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos, $id_tipo_campo, $carpeta) = mysql_fetch_row($resultc)){
   		 
		    			 
			             $campo_pk= campo_pk_tabla($id_auto_admin);
					 	 $valor_campo_pk=valor_campo_tabla($nom_tabla, $campos, $id);
						
							
				    $query= "SELECT $campos   
                           FROM  $nom_tabla
                            WHERE $campo_pk ='$id'";
                     $result_arch= mysql_query($query)or die (error($query,mysql_error(),$php));
                      list($nom_archivo) = mysql_fetch_row($result_arch);
					// echo "dfsdfsdfsdf images/sitio/sistema/$nom_tabla/$campos/$id/$nom_archivo";
					  unlink("images/sitio/sistema/$nom_tabla/$campos/$id/$nom_archivo"); 
	  				  rmdir("images/sitio/sistema/$nom_tabla/$campos/$id");
					   
	  					}
						
		//return $campos_old;
}










function update($tabla,$id_valorpk,$ver=0){



   
   

  $query= "SELECT id_auto_admin ,actualiza_envia_mail,email_aviso  
           FROM  auto_admin
           WHERE tabla='$tabla'";

    $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin,$actualiza_envia_mail,$email_aviso) = mysql_fetch_row($result);
	
	
		if( $actualiza_envia_mail==1 and $id_valorpk!=""){
			   //se capturaron el id_auto_admin y el id del registro
		  $id= $id_valorpk;
		  include ("admin/administracion_sistema/proc/ver.php");
		//$datos_registro contiene los datos a enviar	
		  $datos_registro_antiguo = $datos_registro;

	
	
	 }
	 		
	
	  $query= "SELECT campo,id_tipo_campo,extencion,peso,unic 
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin 
				   order by id_campo";
   		     
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campo,$id_tipo_campo,$extencion,$peso,$unic ) = mysql_fetch_row($resultc)){
			  
			      $query= "SELECT tipo_campo   
                         FROM  auto_admin_tipo_campo 
                         WHERE id_tipo_campo ='$id_tipo_campo'";
                   $result_tipo_campo= cms_query($query)or die (error($query,mysql_error(),$php));
                   list($tipo_campo) = mysql_fetch_row($result_tipo_campo);
				   
				  
			  switch ($tipo_campo) {
                   case 'date':
                   		$_POST[$campo]= fechas_bd($_POST[$campo]);
                       break;
              	   case 'html':
                        
						$_POST[$campo] = str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), $_POST[$campo]); 

                       break;
					   
					case 'checkbox':
					$content="";
						foreach ($_POST[$campo]as $id_check){ 
 									
								$content .=  "$id_check,"; 
								}
								$_POST[$campo] = $content;
				break;
                 	default:
              	  
              	 
                     
               }
			 	
				
				
				  			   
   			  }
				$condicion_unic=trim($condicion_unic); 
	

  $sql = "select * from $tabla LIMIT 0,1";
 

  $qry = cms_query($sql)or die (error($query,mysql_error(),$php));
  $num_filas = mysql_num_fields($qry);
	
					   
		 		
   
 for ($i = 0; $i < $num_filas; $i++){	

 $campo_fecha ="";
 
		//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	$flag      = mysql_field_flags($qry,$i);
	$largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);

	  $not_null     = substr_count ($flag, "not_null");

	  $auto_inc     = substr_count ($flag, "auto_increment");
	  $campo_pk     = substr_count ($flag, "primary_key");
	  $campo_fecha =  substr_count ($tipo, "date");
	  
			
	
	
		$valor = $_POST[$nom_campo];
		$valor = sql_quote($valor);
		if($campo_fecha!=""){
		$valor = fechas_bd($valor);
		}
		//$valor = caracteres_html($valor);
		
		if($campo_pk!=""){
			$condicion_pk="$nom_campo='$id_valorpk'";
		}else{
			$mantiene = "mantiene_$nom_campo";
			if($_POST[$mantiene]==""){
				$lista_campos .="$nom_campo ='$valor',";	
			}
		}
		
		$lista_valores .= "'$valor',";					   
   	
	   
	
}
	 $largo_campos = strlen($lista_campos);
      	 $lista_campos = substr($lista_campos,0,$largo_campos-1);
		
		 
	
     	 $lista_valores = substr($lista_valores,0,$largo_valores-1);
		
 
			$Sql ="UPDATE $tabla 
	   			   SET $lista_campos 
	   			   WHERE $condicion_pk";
			
			if($ver==1){
			   echo $Sql;
			}
			
 			cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	        	
			ingresa_archivo_auto($id_auto_admin,$id_valorpk);	

		
		if( $actualiza_envia_mail==1 and $id_valorpk!=""){
			   //se capturaron el id_auto_admin y el id del registro
			   $id= $id_valorpk;
			   include ("admin/administracion_sistema/proc/ver.php");
				   //$datos_registro contiene los datos a enviar	
			   global $id_sesion;
			   $usuario = nombre($id_sesion);
		   
			   $asunto = "Actualización de registro tabla $tabla";
			   $destinatario = $email_aviso;
			   $cuerpo = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				      <tr>
					<td align=\"center\" class=\"textos\">El usuario $usuario ha actualizado un registro a la base de datos</td>
					</tr>
							    <tr><td align=\"center\" class=\"textos\">Datos anteriores </td></tr> 
							    <tr><td align=\"center\" class=\"textos\">$datos_registro_antiguo </td></tr> 
							    <tr><td align=\"center\" class=\"textos\">Nuevos Datos</td></tr> 
							    <tr><td align=\"center\" class=\"textos\">$datos_registro</td></tr> 
				   </table>";
			   cms_mail($destinatario,$asunto,$cuerpo,$headers);
	
		  }
		
		
		 	return true;
		         
       
		
}







function inserta($tabla,$ver =0){

crear_campo_orden($tabla);

	global $tp;


	 $query="select max(orden)
         from $tabla"; 

		//echo $query;

 $result1= cms_query($query)or die (error($query,mysql_error(),$php));
 list($max_orden) = mysql_fetch_row($result1);

$max_orden++;

$_POST['orden']=$max_orden;


   //echo $num_filas;

  $query= "SELECT id_auto_admin,ingresado_envia_mail,email_aviso  
           FROM  auto_admin
           WHERE tabla='$tabla'";



     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if(!list($id_auto_admin,$ingresado_envia_mail,$email_aviso) = mysql_fetch_row($result)){
	  
	  echo "No encuentro la tabla $tabla en el auto Admin";
	  }
	//  echo "campo_txt -> ".campo_txt($id_auto_admin)."----$tabla ---$id_auto_admin,$ingresado_envia_mail,$email_aviso ZZZZZ<br><br>\n";
	$condicion_unic="";
	//echo campo_txt($id_auto_admin)." campo_txt<br>\n";
	//echo "valor post=".$_POST[campo_txt($id_auto_admin)];
	
	if(trim($_POST[campo_txt($id_auto_admin)])){
	

	   	  $query= "SELECT campo,id_tipo_campo,extencion,peso,unic 
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin 
				   order by id_campo";
   		     
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campo,$id_tipo_campo,$extencion,$peso,$unic ) = mysql_fetch_row($resultc)){
			  
			      $query= "SELECT tipo_campo   
                         FROM  auto_admin_tipo_campo 
                         WHERE id_tipo_campo ='$id_tipo_campo'";
                   $result_tipo_campo= cms_query($query)or die (error($query,mysql_error(),$php));
                   list($tipo_campo) = mysql_fetch_row($result_tipo_campo);
				   
				   
			  
			 	 if($unic==1){
			  		 $valor= $_POST[$campo];
   						if($id_tipo_campo==9){
							$valor = fechas_bd($valor);
				
							}
					$condicion_unic .= " and $campo='$valor'";
			  	}
				
			  switch ($tipo_campo) {
                   case 'date':
                   		$_POST[$campo]= fechas_bd($_POST[$campo]);
                       break;
              	   case 'html':
                        
						$_POST[$campo] = str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), $_POST[$campo]); 

                       break;
					   
					case 'checkbox':
						foreach ($_POST[$campo]as $id_check){ 
 									
								$content .=  "$id_check,"; 
								}
								$_POST[$campo] = elimina_ultimo_caracter($content);
				break;
                 	default:
              	  
              	 
                     
               }
			 	
				
				
				  			   
   			  }
				$condicion_unic=trim($condicion_unic);
				
						/*
						      $sql_master = "DESCRIBE $tabla";
								
								$res = mysql_query($sql_master);
								while($row = mysql_fetch_array($res)) {
										$nom_campo =$row['Field'];
										$primaria = $row['key'];
										$tipo = $row['type'];
										
										$lista_campos .="$nom_campo,";	
										$valor = trim($_POST[$nom_campo]);
		
		
										 if($tipo=='date'){
											  $valor = fechas_bd($valor);
										 }
										 if($tipo=='datetime'){
											  $valor = fechas_min_bd($valor);
										 }
																		 
										 if($primaria=="PRI"){
											  $valor="null";
											  $lista_valores .= "null,";				
										 }else{
											  //mysql_real_escape_string($nombre_usuario) 
											  $lista_valores .= "'".sql_quote($valor)."',";					   
											  // 	echo $lista_valores;
										 }
										 
										 $campo= $nom_campo.$agregar_nombre_campo;
										$_POST[$nom_campo]= $_POST[$campo];
								}
						*/
								
$sql = "select * from  $tabla LIMIT 0,1";  

  $qry = mysql_query($sql)or die (error($sql,mysql_error(),$php));
   $num_filas = mysql_num_fields($qry);				 

 for ($i = 0; $i < $num_filas; $i++){	

 $campo_fecha ="";
 
 		//el num_filas cuenta la cantidad de campos que tiene una tabla 

   $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo   
	//echo $nom_campo;	//muestra los campos de la tabla
	$flag      = mysql_field_flags($qry,$i);
    $largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);
//echo $qry,$i;
	  $not_null     = substr_count ($flag, "not_null");

	  $auto_inc     = substr_count ($flag, "auto_increment");
	  $campo_pk     = substr_count ($flag, "primary_key");
	  $campo_fecha =  substr_count ($tipo, "date");
	  $campo_fecha2 =  substr_count ($tipo, "datetime");
	
		$lista_campos .="$nom_campo,";	
		
		$valor = trim($_POST[$nom_campo]);
		
		
		if($campo_fecha!=""){
		$valor = fechas_bd($valor);
		}
		if($campo_fecha2!=""){
		//echo "$nom_campo min $valor <br>";
		
		$valor = fechas_min_bd($valor);
		}
		
		
		if($campo_pk!=""){
			   $valor="null";
			   $lista_valores .= "null,";				
		  }else{
			   //mysql_real_escape_string($nombre_usuario) 
			   $lista_valores .= "'".sql_quote($valor)."',";					   
			   // 	echo $lista_valores;
		  }
		
	
	 }
	 
	 
		  $largo_campos = strlen($lista_campos);
      	 $lista_campos = substr($lista_campos,0,$largo_campos-1);
		
		 $largo_valores = strlen($lista_valores);
		// echo $largo_valores."<br>";
      	 $lista_valores = substr($lista_valores,0,$largo_valores-1);
      	 
		 //$lista_valores = utf8($lista_valores);
		
			if($condicion_unic!=""){
		$query= "SELECT *   
                   FROM  $tabla
                   WHERE 1 $condicion_unic";
				
				
				
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
			
             if(!list($cond_unic) = mysql_fetch_row($result)){
        			
					$qry_insert="INSERT INTO $tabla($lista_campos) values ($lista_valores)";
    					//echo "insertaaa 1 $qry_insert<br>"; 
							mysql_query($qry_insert)or die (error($qry_insert,mysql_error(),$php));
							$var_insert= "ok";
			   
        		 }else{
				  global $accion;
				     echo  "<script>alert('No fue posible ingresar la información, esta ya existe en nuestra base de datos.'); document.location.href='index.php?accion=$accion'; </script>\n";
				 }
		
		}else{
			 
                     $qry_insert="INSERT INTO $tabla($lista_campos) values ($lista_valores)";
    			
	   				// echo "insertaaa 2 $qry_insert<br>\n"; 
							if(mysql_query($qry_insert)or die (error($qry_insert,mysql_error(),$php))){
							
							$var_insert= "ok";
							
							
							
							}else{
							$var_insert= false;
							}
			if($ver==1){
			  echo "$qry_insert";
			}

		}
				//echo $qry_insert."<br>";
      
	 $id= mysql_insert_id();
		//echo "ingreso $id_auto_admin,$id"	;			
	 ingresa_archivo_auto($id_auto_admin,$id);
	  
		global $id_sql_insert;
		$id_sql_insert=$id;
	}else{
	echo "<font color=\"#FF0000\">no se esta entregando el campo ".campo_txt($id_auto_admin)."  txt en la tabla $tabla es obligatorio diferemte de vacio</font> ";
	$var_insert=  false;
	}
		
	if($var_insert=="ok" and $ingresado_envia_mail==1){
	
	
	
	//se capturaron el id_auto_admin y el id del registro
	include ("admin/administracion_sistema/proc/ver.php");
		//$datos_registro contiene los datos a enviar	
	 global $id_sesion;
	$usuario = nombre($id_sesion);

	$asunto= "Ingreso de registro tabla $tabla";
	$destinatario = $email_aviso;
	$cuerpo = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                   <tr>
                     <td align=\"center\" class=\"textos\">El usuario $usuario ha ingresado un nuevo registro a la base de datos</td>
                     </tr>
					 <tr><td align=\"center\" class=\"textos\">$datos_registro</td></tr> 
               	</table>";
	cms_mail($destinatario,$asunto,$cuerpo,$headers);
	
	}
		   	 		
   return $id_sql_insert;
		
}

function ingresa_archivo_auto($id_auto_admin,$id){

//echo$id_auto_admin,$id."<br>";
  $query= "SELECT  tabla
           FROM  auto_admin
           WHERE id_auto_admin='$id_auto_admin'";
		//   echo $query;
	$campo_pk=pk_tabla($id_auto_admin);
	//echo $campo_pk;
    $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($nom_tabla) = mysql_fetch_row($result);
	
		
    $query= "SELECT campo,id_tipo_campo, carpeta  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and id_tipo_campo=8
				   order by id_campo";
   		    
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos, $id_tipo_campo, $carpeta) = mysql_fetch_row($resultc)){
   		 			$mantiene = "mantiene_$campos";
		    	    if($_POST[$mantiene]==""){
					
					
				         $imagen_name= $_FILES[$campos]['name'];
						 $imagen_producto= $_FILES[$campos]['tmp_name'];
						 
			             $campo_pk= campo_pk_tabla($id_auto_admin);
					 	 $valor_campo_pk=valor_campo_tabla($nom_tabla, $campos, $id);
					 	
					 	
					 //	echo "$nom_tabla, $campos, $id $imagen_producto <<< $imagen_name 33<br>";
					 	 	 
							 if(!is_dir("images/sitio/sistema/$nom_tabla/$campos/$id")){
						 	//echo "images/sitio/sistema/$nom_tabla/$campos/$id";
						 		mkdir("images/sitio/sistema/$nom_tabla/$campos/$id");
						 	
						 	}			
						// echo "dfsdfsdfsdf";
						 
	  						 if($imagen_name!=""){   						 	
	  						 	 
								   $imagen2 = str_replace('&','_',$imagen_name);
				    			   $imagen2 = str_replace(' ',':',$imagen2);
								   $imagen2 = str_replace(":","_",$imagen2);
								   $imagen2 = str_replace("*","_",$imagen2);
					      		if(copy($imagen_producto,"images/sitio/sistema/$nom_tabla/$campos/$id/$imagen2")){
								
									$Sql ="UPDATE $nom_tabla 
                                    	   SET $campos ='$imagen2'
                                    	   WHERE $campo_pk ='$id'";
                                  // 	echo "$Sql";

 									cms_query($Sql)or die (error($Sql,mysql_error(),$php));
 			
								}else{
									
					         $contenido .= "Fallo, La imagen chica no se ha podido subir al servidor. <br>
							 La imagen chica no existe o es muy grande.<br>
							 Imagen temp: $imagen_producto<br> Imagen nombre : $imagen_name";
								}
					      		
					      		//echo "$imagen_producto,$carpeta/$id/$imagen2";
					
                      			}
					
					}
   		       	        	      	         
   		      	   
                     				
   		      	     	
   		      	     	}
						
		return $campos_old;
}




//$home ="http://www.epsi.cl/proyectos/intranet_sip/index.php";



function tabla_mandatoria($id_tabla){

	

	

	  $query= "SELECT tabla_relacion 

	           FROM  auto_admin

	           WHERE id_auto_admin='$id_tabla'";

	     $result= cms_query($query)or die ("ERROR $php  tabla_mandatoria <br>$query");

	     list($tabla_relacion) = mysql_fetch_row($result);

							   

			return $tabla_relacion;

}



function campo_txt($id_auto_admin){

	
if(!is_numeric($id_auto_admin)){
	$id_auto_admin= id_tabla($id_auto_admin);
}
	

	  $query= "SELECT campo
               FROM  auto_admin_campo
	           WHERE id_auto_admin='$id_auto_admin' and txt=1";
	  
	//echo "$query";
	     $result= cms_query($query)or die ("ERROR $php campo_txt <br>$query");
	    list($campo_txt) = mysql_fetch_row($result);
	
return $campo_txt;	

}



function campo_pk_tabla($id_auto_admin){

	
	if(!is_numeric($id_auto_admin)){
		$id_auto_admin= id_tabla($id_auto_admin);
	}
	
	 $query= "SELECT campo
	           FROM  auto_admin_campo
	           WHERE id_auto_admin='$id_auto_admin' and pk=1";

	 $result= cms_query($query)or die ("ERROR $php  campo_pk_tabla <br>$query");
	    list($campo_pk) = mysql_fetch_row($result);
							   
			
	return $campo_pk;	
}





function valor_campo_tabla ($tabla, $campo, $id_campo_pk){

	//echo "$campo";

	$id_tabla_mandatoria =id_tabla($tabla);	

	$campo_pk=campo_pk_tabla($id_tabla_mandatoria);

	

	

	  $query= "SELECT  $campo

	           FROM  $tabla

	           WHERE $campo_pk='$id_campo_pk'";

	  

	//echo $query;

	  



	     $result= cms_query($query)or die ("ERROR $php  valor_campo_tabla <br>$query");

	     list($valor_campo) = mysql_fetch_row($result);



	      	return $valor_campo;	   

			

	

}



function formato_rut_bd($rut){




$rut = str_replace(".","",$rut);
$rut = str_replace(",","",$rut);
$rut = str_replace(" ","",$rut);

$caract = strlen($rut);
$caract = $caract-1;


$dig = substr($rut,$caract);



$rut = substr($rut,0,$caract);

$rut =  number_format($rut, 0, ',', '.');



$rut= $rut ."-".$dig;



return $rut;

}



function formato_rut_bd2($rut){


$rut = str_replace(".","",$rut);
$rut = str_replace(",","",$rut);
$rut = str_replace(" ","",$rut);
$rut = str_replace("-","",$rut);


$caract = strlen($rut);
$caract = $caract-1;


$dig = substr($rut,$caract);

$rut = substr($rut,0,$caract);

return $rut;

}





function id_tabla($tabla){

//id de la tabla en el auto_admin



  $query= "SELECT id_auto_admin  
           FROM  auto_admin
           WHERE tabla='$tabla'";

//echo "$query<br>";

     $result99= cms_query($query)or die ("ERROR function id_tabla  <br>$query");

     list($id_tabla) = mysql_fetch_row($result99);
	 
	    

return $id_tabla;

}

function tabla($id_tabla){

//id de la tabla en el auto_admin

  $query= "SELECT   tabla
           FROM  auto_admin
           WHERE id_auto_admin='$id_tabla'";
     $result= cms_query($query)or die ("ERROR function id_tabla  <br>$query");
     list($tabla) = mysql_fetch_row($result);

return $tabla;

}



function pk_tabla($tabla){

//echo "$tabla es el nombre de la tabla texto<br>";



if($tabla!=""){

if(!is_numeric($tabla) and $tabla!=""){


$id_tabla = id_tabla($tabla);

}else{

$id_tabla = $tabla;

}
/*

$sql_master = "DESCRIBE $id_tabla";

$res = mysql_query($sql_master)or die ("ERROR function pk_tabla($tabla) 44  lib.inc  en la tabla \"$tabla\"<br>$query");
while($row = mysql_fetch_array($res)) {
    if($row['Key']=='PRI'){
        $campo =$row['Field'];
        
    }
}


*/
	  $query= "SELECT campo   
               FROM  auto_admin_campo 
               WHERE id_auto_admin=$id_tabla and pk=1";
			   
			   
	//echo "$query<br>"; 

         $result= cms_query($query)or die ("ERROR function pk_tabla($tabla) 44  lib.inc  en la tabla \"$tabla\"<br>$query");
       		if(!list($campo) = mysql_fetch_row($result)){
	   			 $sql = "SELECT * FROM $tabla  LIMIT 0,1";
  	  				$qry = cms_query($sql)or die ($query);
      				$num_filas = mysql_num_fields($qry);
   
	   
		 		
   
 				for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    					//y luego va sacando los datos que hay en cada campo
						$flag      = mysql_field_flags($qry,$i);
					if(substr_count ($flag, "primary_key")){
	 					$campo = mysql_field_name($qry,$i);
						$i= $num_filas+1;		
	 				}
	 
				}
	   }

}


 
	  // echo $campo."<br>";

return $campo;



}



function campo_pk($campo,$DATABASE){

	

		

	  $query= "SELECT relacion   

	           FROM  auto_admin_campo

	           WHERE campo= '$campo' and pk=0 and txt=0";  

//echo "$query<br>";

	 

	     $result= @cms_query($query) or die ("ERROR 1 function campo_pk <br>$query");

	     list($relacion) = @mysql_fetch_row($result);

	

	if($relacion==""){
		
//echo "$campo,$DATABASE<br>";

/* RR revisar
$tables = @mysql_list_tables( $DATABASE ); //listas de tablas de la base

while( $fin!="ok" ){
	$line = mysql_fetch_row($tables);
	$nom_tabla = $line[0];


$sql = "SELECT * FROM $nom_tabla";
  $qry = cms_query($sql);
   $num_columnas = @mysql_num_fields($qry)or die ("lib.inc.php linea 1766 ERROR 1 function campo_pk no se encontro un nombre de tabla para campo  $campo<br>$sql");
   

 for ($i = 0; $i < $num_columnas; $i++){	
 	//echo $i ."$nom_tabla <br>";		//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i)or die ("ERROR 2 function campo_pk <br>$sql");		//y luego va sacando los datos que hay en cada campo
    
    if($nom_campo==$campo){
    	
    	$flag      = mysql_field_flags($qry,$i)or die ("ERROR 3 function campo_pk $nom_campo<br>$sql");
	
	
    if(substr_count ($flag, "primary_key")){
    	
    	$nom_tabla_ok=$nom_tabla;
    	$i=$num_columnas;
    	$fin="ok";
    	
    	
    	}
    }
        
 }


}*/



return $nom_tabla_ok;



}else{

	

	

	

	return $relacion;

}

	

}





function tipo_campo($campo,$id_tabla){

  $query= "SELECT id_tipo_campo  

           FROM  auto_admin_campo

           WHERE campo='$campo' and id_auto_admin=$id_tabla";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

      list($tipo_campo) = mysql_fetch_row($result);

	  

	  return $tipo_campo;



}



function select_tabla($tabla,$id_campo_selecionado,$nombre_campo_id,$nombre_campo_texto,$js_sel,$clase,$filtro=''){

crear_campo_orden($tabla);

if($filtro!=""){
	$condicion = "WHERE 1 $filtro";
}

$query= "SELECT  $nombre_campo_id ,$nombre_campo_texto     

	           FROM  $tabla
				$condicion
	           ORDER BY orden";



	     $result= cms_query($query)or die ("ERROR function select_tabla <br>$query");

	      while (list($id_campo_bd,$contenido_campo_txt_bd) = mysql_fetch_row($result)){

	

	      	if($id_campo_selecionado==$id_campo_bd){

	      		

	      		$lista_select .="<option value=\"$id_campo_bd\" selected>$contenido_campo_txt_bd </option>\n";

	      	}else{

	      		$lista_select .="<option value=\"$id_campo_bd\">$contenido_campo_txt_bd </option>\n";

	      	}

							   

		 }





	 

		 	   $lista_select ="<select class=\"$clase\" name=\"$nombre_campo_id\" id=\"$nombre_campo_id\" $js_sel>

	  							   <option value=\"\">--Seleccione--</option>\";

               							$lista_select

				   				   </select>";

		

		return $lista_select; 

		 

}





function select_admin_campo_simple($tabla,$id_campo_selecionado, $js_sel, $clase,$id_opcional){

	
//echo $id_campo_selecionado;
			crear_campo_orden($tabla);

			$id_auto_admin= id_tabla($tabla);				   
		    $campo_pk = pk_tabla($tabla);	
			$campo_txt=campo_txt($id_auto_admin);		   
	

	
$query= "SELECT  $campo_pk,  $campo_txt
	           FROM  $tabla
	           ORDER BY orden";
		//echo $query."<br>";	 
     $result= cms_query($query)or die ("ERROR 1d Tabla \"$tabla\" no configurada en el auto_admin function select_admin_campo<br>$query");
	      while (list($id_campo_pk,$contenido_campo_txt_bd) = mysql_fetch_row($result)){
	
				$contenido_campo_txt_bd = $contenido_campo_txt_bd;
				
	      	//$contenido_campo_txt_bd= ucwords($contenido_campo_txt_bd);
	    	if($id_campo_selecionado==$id_campo_pk){
	      		
	      		$lista_select.="<option value=\"$id_campo_pk\" selected>$contenido_campo_txt_bd</option>\n";
	      	}else{
	      		$lista_select.="<option value=\"$id_campo_pk\">$contenido_campo_txt_bd</option>\n";
	      	}
							   
		 }

	if($id_opcional==""){
	 	$lista_select ="<select class=\"$clase\" name=\"$campo_pk\" id=\"$campo_pk\" $js_sel>
	  							   <option value=\"\">--Seleccione--></option>\";
               							 $lista_select
				   				   </select>";
	}else{
		$lista_select ="<select class=\"$clase\" name=\"$id_opcional\" id=\"$id_opcional\" $js_sel>
	  							   <option value=\"\">--Seleccione--></option>\";
               							$lista_select
			   				   </select>";
	}
	 
	return $lista_select; 
		 
}



function select_admin_campo($tabla,$id_campo_selecionado, $js_sel, $clase,$id_opcional){

	

	



			crear_campo_orden($tabla);



			$id_auto_admin= id_tabla($tabla);				   

			$campo_pk = pk_tabla($tabla);	

			$campo_txt=campo_txt($id_auto_admin);		   

	



	

$query= "SELECT  $campo_pk,  $campo_txt

	           FROM  $tabla

	           ORDER BY orden";

		//echo $query."<br>";	 

	     $result= cms_query($query)or die ("ERROR 1d Tabla \"$tabla\" no configurada en el auto_admin function select_admin_campo<br>$query");

	      while (list($id_campo_pk,$contenido_campo_txt_bd) = mysql_fetch_row($result)){

	

				$contenido_campo_txt_bd =acentos_inverso($contenido_campo_txt_bd);

	      	

	    	if($id_campo_selecionado==$id_campo_pk){

	      		

	      		$lista_select.="<option value=\"$id_campo_pk\" selected>$contenido_campo_txt_bd</option>\n";

	      	}else{

	      		$lista_select.="<option value=\"$id_campo_pk\">$contenido_campo_txt_bd</option>\n";

	      	}

							   

		 }



	if($id_opcional==""){

	

		

	 $lista_select ="<div id='div_$campo_pk'><select class=\"$clase\" name=\"$campo_pk\" $js_sel>

	  							   <option value=\"\">--Seleccione--></option>\";

               							$lista_select

				   				   </select></div><div id='mensaje_$campo_pk'></div>";

	}else{

	

	 $lista_select ="<div id='div_$campo_pk'><select class=\"$clase\" name=\"$id_opcional\" $js_sel>

	  							   <option value=\"\">--Seleccione--></option>\";

               							$lista_select

				   				   </select></div><div id='mensaje_$campo_pk'></div>";

	

	}

	 

		 	  

		

		return $lista_select; 

		 

}



function select_admin_campo_tienda($tabla,$id_campo_selecionado, $js_sel, $clase,$id_opciona,$id_auto_admin_combo){

	

	



			crear_campo_orden($tabla);



			$id_auto_admin= id_tabla($tabla);				   

			$campo_pk = pk_tabla($tabla);	

			$campo_txt=campo_txt($id_auto_admin);		   

	



	

$query= "SELECT  $campo_pk,  $campo_txt

	           FROM  $tabla

	           ORDER BY orden";

	

	     $result= cms_query($query)or die ("ERROR 1d Tabla \"$tabla\" no configurada en el auto_admin function select_admin_campo<br>$query");

	      while (list($id_campo_pk,$contenido_campo_txt_bd) = mysql_fetch_row($result)){

	

				

	      	

	    	if($id_campo_selecionado==$id_campo_pk){

	    		

	    	

	      		

	      		$lista_select.="<option value=\"$id_campo_pk\" selected>$contenido_campo_txt_bd</option>\n";

	      	}else{

	      		$lista_select.="<option value=\"$id_campo_pk\">$contenido_campo_txt_bd</option>\n";

	      	}

							   

		 }



	if($id_opcional==""){

	

		

	 $lista_select ="<div id='div_$campo_pk'><select class=\"$clase\" name=\"$campo_pk\" $js_sel>

	  							   <option value=\"\">--Seleccione--></option>\";

               							$lista_select

				   				   </select></div><div id='mensaje_$campo_pk'></div>";

	}else{

	

	 $lista_select ="<div id='div_$campo_pk'><select class=\"$clase\" name=\"$id_opcional\" $js_sel>

	  							   <option value=\"\">--Seleccione--></option>\";

               							$lista_select

				   				   </select></div><div id='mensaje_$campo_pk'></div>";

	

	}

	 

		 	  

		

		return $lista_select; 

		 

}











function valor_admin_campo($tabla,$id_campo_selecionado,$campo){

	if($id_campo_selecionado!=""){

		

		

		

	

	

//echo "$tabla,$id_campo_selecionado,$campo<br>";

			crear_campo_orden($tabla);



			$id_auto_admin= id_tabla($tabla);

			//$campo_pk = pk_tabla($tabla);	

			$campo_txt =campo_txt($id_auto_admin);		   

	

	

$query= "SELECT $campo_txt

	           FROM  $tabla

				WHERE $campo= $id_campo_selecionado";

		//echo $query."<br>";	 

	     $result= cms_query($query)or die ("ERROR 1d Tabla \"$tabla\" no configurada en el auto_admin function select_admin_campo<br>$query");

	     list($campo_txt) = mysql_fetch_row($result);

	     

			 	  

		if($campo_txt==""){

			return $id_campo_selecionado;

		}else{

			return  $campo_txt; 

			

		}

		

}

}


function es_pk($campo){

  $query= "SELECT id_auto_admin   
           FROM  auto_admin_campo
           WHERE campo='$campo' and pk=1";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if(list($id_t) = mysql_fetch_row($result)){
			  $query= "SELECT tabla     
                       FROM  usuarios
                       WHERE id_auto_admin ='$id_t'";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($tabla) = mysql_fetch_row($result);
				 return $tabla;
				 
		 }else{
		 		 return false;
		 }

}


function crear_campo_orden($tabla){



if($tabla!=""){



	$existe_orden=0;

 $sql_master = "DESCRIBE $tabla";

 

  $qry = @mysql_query($sql_master)or die ("ERROR 1a function crear_campo_orden  <br>$sql_master");

  $num_campos = @mysql_num_fields($qry)or die ("ERROR 2 function crear_campo_orden <br>$sql_master");

  

  

  if($num_campos!=0){

   while($a<$num_campos){

  

    $nom_campo = @mysql_field_name($qry,$a);

   

  	if($nom_campo=="orden"){

			$existe_orden=1;

	}

	

  $a++;

  }

			   

  		 

 }

if($existe_orden==0){

  

  	  	 $query= "ALTER TABLE $tabla ADD orden INT NOT NULL";

         $result= @mysql_query($query);
	 // $query= "ALTER TABLE  $tabla ADD INDEX (orden)";

         $result= @mysql_query($query);
	  
    	  

  

  }





}



}





function cuadro($conte){

	

	 $cuadro= "<table width=\"530\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  align=\"center\">

              <tr>

                <td>

				 <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">

  						<tr>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/superior_izq.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/superior_izq.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

				

				

				</td>

   						 <td height=\"10\" width=\"100%\"  class=\"fondo_blanco\"></td>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/superior_der.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/superior_der.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

			  		</td>

  						</tr>

						</table>

						 

				</td>

              </tr>

              <tr>

                <td class=\"fondo_blanco\" align=\"center\" >$conte</td>

              </tr>

              <tr>

                <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">

  						<tr>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/inferior_izq.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/inferior_izq.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

				

				

				</td>

   						 <td height=\"10\" width=\"100%\" class=\"fondo_blanco\"></td>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/inferior_der.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/inferior_der.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

			  		</td>

  						</tr>

						</table>

						

				</td>

              </tr>

            </table>";

	

	

	return $cuadro;

}







function cuadro_gris($conte){

	

	 $cuadro= "<table width=\"530\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  align=\"center\" >

              <tr>

                <td>

				 <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">

  						<tr>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/grisClaro/superior_izq.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/grisClaro/superior_izq.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

				

				

				</td>

   						 <td height=\"10\" width=\"100%\" class=\"fondo_celeste\"></td>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/grisClaro/superior_der.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/grisClaro/superior_der.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

			  		</td>

  						</tr>

						</table>

						 

				</td>

              </tr>

              <tr>

                <td class=\"fondo_celeste\" align=\"center\" width=\"100%\">$conte</td>

              </tr>

              <tr>

                <td><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">

  						<tr>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/grisClaro/inferior_izq.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/grisClaro/inferior_izq.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

				

				

				</td>

   						 <td height=\"10\" width=\"100%\" class=\"fondo_celeste\"></td>

   						 <td width=\"10\" height=\"10\">

						 <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"10\" height=\"10\">

                    <param name=movie value=\"fla/grisClaro/inferior_der.swf\">

                    <param name=quality value=high>

                    <param name=\"wmode\" value=\"transparent\">

                    <embed src=\"fla/grisClaro/inferior_der.swf\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"10\" height=\"10\" wmode=\"transparent\"> 

                    </embed> </object>

			  		</td>

  						</tr>

						</table>

						

				</td>

              </tr>

            </table>";

	

	

	return $cuadro;

}







function verifica($id_sesion){

	if($id_sesion!=""){
	 $query= "SELECT id_usuario   
	           FROM  usuario
	           WHERE session='$id_sesion'";
	  
	
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      if(list($id_usuario) = mysql_fetch_row($result)){
	      	
				return $id_usuario;			   
		 }else{
			 	
			 	return false;
			 }
}
	 
	
}

function id_usuario($id_sesion){
	
	  $query= "SELECT id_usuario  
	           FROM  usuario
	           WHERE session='$id_sesion'";
	 //echo "$query<br>";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($id_usuario) = mysql_fetch_row($result);
	      
	      return $id_usuario;
}








function id_curriculum($id_usuario){

	

	

	  $query= "SELECT id_curriculum  

	           FROM curriculum

	           WHERE id_usuario='$id_usuario'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	   if( list($id_curriculum) = mysql_fetch_row($result)){



	   	return $id_curriculum;

	   }else{

	   	 

	   	return false;

	   	

	   }

			

	

}



function nombre($id_sesion){
if(!isset($_SESSION['nombre_usuario'])){
$query= "SELECT nombre,paterno

	           FROM  usuario

	           WHERE session='$id_sesion'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      if(list($nombre,$apellido) = mysql_fetch_row($result)){
		   $nombre = "$nombre $apellido";
		  $nombre = ucwords(strtolower($nombre));
		 	session_register_cms('nombre_usuario');
		  	$_SESSION['nombre_usuario']=$nombre;
		  }else{
		  $nombre ="no body";
		  }

	     
	      return $nombre;
}else{
	return $_SESSION['nombre_usuario'];
}

}

function telefono($id_sesion){

if(!isset($_SESSION['telefono_usuario'])){
		$query= "SELECT fono 
           FROM  usuario
	           WHERE session='$id_sesion'";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($fono) = mysql_fetch_row($result);
	      $nombre = $nombre ." ".$apellido;
	      return $fono;
	      session_register_cms('telefono_usuario');
	  $_SESSION['telefono_usuario']=$nombre;
	      return $nombre;
}else{
	return $_SESSION['telefono_usuario'];
}

	

	

}



function verifica_pass($id_sesion){



	$query= "SELECT rut,password  
	           FROM  usuario
	           WHERE session='$id_sesion'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($login_usr,$password) = mysql_fetch_row($result);
	     
		 	$login_user_md5= md5($login_usr);
	  if($password==$login_user_md5){
		  	return true;
		  }else{
		  	return false;
	  }
    

	

}





function perfil($id_sesion){
	 
/*
if(!isset($_SESSION['id_perfil_sess']) ){

session_register_cms('id_perfil_sess');
}

if($_SESSION['id_perfil_sess']==""){


  $query= "SELECT id_perfil
	           FROM  usuario
	           WHERE session='$id_sesion'";
			  
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      if(!list($id_perfil_sess) = mysql_fetch_row($result)){
	       $queryr= "SELECT id_perfil  
                       FROM  usuario_perfil
                       WHERE perfil='NB'";
                   $resultr= cms_query($queryr)or die (error($queryr,mysql_error(),$php));
                   list($id_perfil_sess) = mysql_fetch_row($resultr);
 
		  }

      
      
  $_SESSION['id_perfil_sess']= $id_perfil_sess;   

}else{
 $id_perfil_sess=$_SESSION['id_perfil_sess'];   		
		
}

*/

if($id_sesion!=""){

  $query= "SELECT id_perfil
	           FROM  usuario
	           WHERE session='$id_sesion'";
			  
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      if(!list($id_perfil) = mysql_fetch_row($result)){
	       $queryr= "SELECT id_perfil  
                       FROM  usuario_perfil
                       WHERE perfil='NB'";
                   $resultr= cms_query($queryr)or die (error($queryr,mysql_error(),$php));
                   list($id_perfil) = mysql_fetch_row($resultr);
 
		  }

}else{
 $queryr= "SELECT id_perfil  
                        FROM  usuario_perfil
                        WHERE perfil='NB'";
                    $resultr= cms_query($queryr)or die (error($queryr,mysql_error(),$php));
                   list($id_perfil) = mysql_fetch_row($resultr);
		 
}

		   return $id_perfil;	

	      

	

}



function acceso($id_sesion){

	  $query= "SELECT id_perfil

	           FROM  usuario

	           WHERE session='$id_sesion'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($id_perfil2) = mysql_fetch_row($result);

	      

	      if($id_perfil2==0){

	      	$acceso = 3;

	      	//Administrador

	      }

	      if($id_perfil2==1){

	      	//Administrativo

	      	$acceso = 0;

	      }

	      if($id_perfil2==3){

	      	//Director

	      	$acceso = 1;

	      }

	      if($id_perfil2==999){

	      	//Webmaster

	      	$acceso=3;

	      }

	      //Este lindo parche se deriva de la programacion anterior

		  

	       return $acceso;	

}



function perfil_on_line($id_perfil){

  $query= "SELECT activo   

           FROM  usuario_perfil

           WHERE id_perfil='$id_perfil'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

      list($activo) = mysql_fetch_row($result);

	  

	  if($activo==0){

	  	return false;

	  }else{

	  	return true;

	  }



}







function id_usuario_perfil($id_usuario){

	  $query= "SELECT u.id_perfil
			   FROM   u usuario
	           WHERE id_usuario ='$id_usuario'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      if(list($id_perfil) = mysql_fetch_row($result)){

		 	 return $id_perfil;	

		  }else{

		  

		 $queryr= "SELECT id_perfil  

                        FROM  usuario_perfil

                        WHERE perfil='NB'";

                   $resultr= cms_query($queryr)or die (error($queryr,mysql_error(),$php));

                   list($id_perfil) = mysql_fetch_row($resultr);

				   

		  	 return $id_perfil;

		  }

	      

	       

	      

	

}








function nombre_usuario($id_usuario){


	  


	  $query= "SELECT nombre,paterno,materno,id_perfil
			   FROM    usuario
	           WHERE id_usuario ='$id_usuario'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
		$random = rand(0,1000)*microtime() * 1000000;
	      if(list($nombre,$paterno,$materno,$id_perfil) = mysql_fetch_row($result)){
   
   
    $query= "SELECT icono ,perfil   
           FROM  usuario_perfil
           WHERE id_perfil='$id_perfil'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($icono,$perfil) = mysql_fetch_row($result);
	  
	  
		 	
			$ficha = html_template('ficha_nombre_lib');
			$ficha = str_replace("#ID_PERFIL#","$id_perfil",$ficha);
			$ficha = str_replace("#PERFIL#","$perfil",$ficha);
			$ficha = str_replace("#ICONO#","$icono",$ficha);
			$ficha = str_replace("#ID_USUARIO#","$id_usuario",$ficha);
			$ficha = str_replace("#RANDOM#","$random",$ficha);
			$ficha = str_replace("#NOMBRE#","$nombre $paterno $materno",$ficha);
			 return $ficha;
		  }


	      

	       

	      

	

}



function nombre_usuario2($id_usuario){

	  $query= "SELECT nombre,paterno,materno,id_perfil
			   FROM    usuario
	           WHERE id_usuario ='$id_usuario'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
		$random = rand(0,1000)*microtime() * 1000000;
	      if(list($nombre,$paterno,$materno,$id_perfil) = mysql_fetch_row($result)){
    	 		return "$nombre $paterno $materno";	
			 }

}





function perfil_usuario($id_usuario, $id_perfil){

	

	

	  $query= "SELECT nombre  
	           FROM  usuario
	           WHERE id_usuario='$id_usuario' and  id_perfil='$id_perfil'";
  

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	    if(list($nombr) = mysql_fetch_row($result)){

	    	return true;
	    	
	    	   
			 }else{
			 	
			 	  $query= "SELECT count(*)  
			 	           FROM  usuario_perfiles			 	           
			 	           WHERE id_usuario='$id_usuario' and  id_perfil='$id_perfil'";
			 
			 
			 	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
			 	     list($resultado) = mysql_fetch_row($result);
			 	     
			 	      if($resultado!=0){
			 			
			 	      	return true;			   
			 			 }else{
			 			 return false;
			 			
			 			 }
			 }
	
}








function nombre_comuna($id_comuna){

	

  $query= "SELECT comuna   

	           FROM  comunas

	           WHERE id='$id_comuna'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($comuna_nombre) = mysql_fetch_row($result);

	      

	      return $comuna_nombre;

	

}

function nombre_usuario_($id_usuario){


	  


	  $query= "SELECT nombre,paterno,materno,id_perfil
			   FROM    usuario
	           WHERE id_usuario ='$id_usuario'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
		$random = rand(0,1000)*microtime() * 1000000;
	      if(list($nombre,$paterno,$materno,$id_perfil) = mysql_fetch_row($result)){
   
   
    $query= "SELECT icono ,perfil   
           FROM  usuario_perfil
           WHERE id_perfil='$id_perfil'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($icono,$perfil) = mysql_fetch_row($result);
	  
	  
		 	
			$ficha = html_template('ficha_nombre_lib_nuevo');
			$ficha = str_replace("#ID_PERFIL#","$id_perfil",$ficha);
			$ficha = str_replace("#PERFIL#","$perfil",$ficha);
			$ficha = str_replace("#ICONO#","$icono",$ficha);
			$ficha = str_replace("#ID_USUARIO#","$id_usuario",$ficha);
			$ficha = str_replace("#RANDOM#","$random",$ficha);
			$ficha = str_replace("#NOMBRE#","$nombre $paterno $materno",$ficha);
			 return $ficha;
		  }


	      

	       

	      

	

}








?>