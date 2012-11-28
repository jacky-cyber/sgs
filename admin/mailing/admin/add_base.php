<?php

$base= $HTTP_POST_FILES['base']['tmp_name'];
$base_name= $HTTP_POST_FILES['base']['name'];
$add = $HTTP_GET_VARS['add'];

$delimit = $HTTP_POST_VARS['delimit'];
$nombre = $HTTP_POST_VARS['nombre'];

$texto = $HTTP_POST_VARS['texto'];

if(isset($add)){

$qry_insert="INSERT INTO mailing_usuario_tipo values (null,'$nombre')";
              
  mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
  $id_base = mysql_insert_id();
  	if($base_name!=""){
	
	      $base2 = ereg_replace('&','*',$base_name);
				      $base2 = ereg_replace(' ',':',$base2);
					      if (!copy($base, "bases/$base2"))
					         {
					         echo "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         echo "La imagen chica no exixte o es muy grande.<br>
							 imagen temp: $base_name<br> imagen nombre : $base_name";
					         }else{
							 
							 
							 include("admin/importa_user.php");
							 
							 
							 
							 }
	
	}
	
	
		
		
		
		
if($texto !=""){
	
	
	
	$texto = strtolower($texto);
	
	$texto = str_replace("<","",$texto);
	$texto = str_replace(">","",$texto);
	$texto = str_replace(",","#",$texto);
	$texto = str_replace("[","",$texto);
	$texto = str_replace("]","",$texto);
	$texto = str_replace(";","",$texto);
	$texto = str_replace("'","",$texto);
	$texto = str_replace('"',"",$texto);
	
	$aux=explode("#", $linea);
	
	
	
	
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
				
				$nombre = $palabra;
				
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
				values ('$id_usuario','$nombre','$apellido','$mail','$mail2','$telefono1','$telefono2','$id_base','$nomas','$id_mailing_nomas','$direccion')";
                  
				//echo $qry_insert."<br>";
				
    			$result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");				
				//  $importa .=  " $id_usuario','$nombre', '$apellido', '$mail'</div><br>";
			$importa .="<div aling=\"center\" class=\"textos\">Mail ($nombre : $mail) agregado </div><br>";
			 
							   
      		 }
				
				/********************************************************/
				
				
				
				
				
				
				
				//echo "$con_mail $palabra<br>";
				$ocurre =0;
				$nombre ="";
			}
			
			$palabra="";
		}
		
		$a++;
	}
	



		
		
		
	}
	
}else{


$accion_form ="$PHP_SELF?accion=$accion&act=$act&act_all=7&add=ok";



$contenido .= "<table width=\"70%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"left\"  class=\"textos\">Ingrese nombre de Base: </td>
                  <td align=\"left\"><input type=\"text\" name=\"nombre\"  class=\"textos\"></td>
                </tr>
			 <tr>
                  <td align=\"left\"  class=\"textos\">Ingrese texto con emails: </td>
                  <td align=\"left\">
                  <textarea name=\"texto\" cols=\"40\" rows=\"5\" class=\"textos\"></textarea>
                  </td>
                </tr>
				<tr>
                  <td align=\"left\"  class=\"textos\">Ingrese Base: </td>
                  <td align=\"left\"  class=\"textos\"><input type=\"file\" name=\"base\" class=\"textos\">(El nombre del archivo no puede contener espacios en blanco)
				  </td>
                </tr>
				<tr>
                  <td align=\"left\"  class=\"textos\">Delimitador: </td>
                  <td align=\"left\">
				  <input type=\"text\" name=\"delimit\"  class=\"textos\" size=\"1\" value=\",\"></td>
                </tr>
				<tr>
                  <td align=\"left\"  class=\"textos\">&nbsp;</td>
                  <td align=\"left\">&nbsp;</td>
                </tr>
				<tr>
                  <td align=\"left\"  class=\"textos\">Crear Usuarios ah&uacute;n que <br> existan en la base</td>
                  <td align=\"left\">&nbsp;<input type=\"checkbox\" name=\"existe\" value=\"ok\"></td>
                </tr>
              </table>
			    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td align=\"center\" class=\"textos\">
					&nbsp;</td>
                    </tr>
				  <tr>
                    <td align=\"center\" class=\"textos\">
					<input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\"></td>
                    </tr>
					<tr>
                    <td align=\"center\" class=\"textos_plomo\">
					nombre,apellido,mail1,mail2,telefono1,telefono2,dirección</td>
                    </tr>
					<tr>
                    <td align=\"center\" class=\"textos\">
					&nbsp;</td>
                    </tr>
					
              	</table>";


$contenido .= "  <table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                   <tr>
                     <td align=\"center\" class=\"textos\">$importa</td>
                     </tr>
               	</table>$resumen";

}


?>