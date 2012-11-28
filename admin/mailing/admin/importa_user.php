<?php

$existe = $HTTP_POST_VARS['existe'];
$id_tipo =$id_base;

$tipo =$id_base;

$fp=fopen("bases/$base_name","r");
//$fp = fopen("user_vn_tot.csv");

while ($linea=fgets($fp,1024))
      {
      $aux=explode($delimit, $linea);
//erika,zuñiga,aezuniga@ing.puc.cl,2173797,092341563
      $nombre    = ucwords(strtolower(trim($aux[0])));
      $apellido  = ucwords(strtolower(trim($aux[1])));
	  $mail     = strtolower(trim($aux[2]));
      $mail2    = trim($aux[3]);
	  $telefono1    = trim($aux[4]);
	  $telefono2     = trim($aux[5]);
	  $direccion     = trim($aux[6]);
	 
	    $query= "SELECT id_usuario
                 FROM mailing_usuario
                 WHERE 1 AND mail 
                 LIKE '%$mail%'";
           $result= cms_query($query);
		   
		  echo $query ."<br>";
		   
                if (!list($id_usuario) = mysql_fetch_row($result)){
      				$cont_add++;		
				 $id_usuario = new_uid();
				
		   $query="INSERT INTO usuario (id_usuario,nombre,apellido,mail,mail2,telefono1,telefono2,tipo,direccion)
                   VALUES ('$id_usuario','$nombre','$apellido','$mail','$mail2','$telefono1','$telefono2','$tipo','$direccion')";
                   cms_query($query) or die("2: Error en insert a la base de datos $query");
						
				//  $importa .=  " $id_usuario','$nombre', '$apellido', '$mail'</div><br>";
			$importa .="<div aling=\"center\" class=\"textos\">Mail ($nombre : $mail) agregado </div><br>";
			 
							   
      		 }else{
			  $cont_exist++;
			  if($existe=="ok"){
			  
			    $id_usuario = new_uid();
				
				$query="INSERT INTO usuario (id_usuario,nombre,apellido,mail,mail2,telefono1,telefono2,tipo,direccion)
                        VALUES ('$id_usuario','$nombre','$apellido','$mail','$mail2','$telefono1','$telefono2','$tipo','$direccion')";
                   cms_query($query) or die("2: Error en insert a la base de datos $query");
			  
		
				$importa .="<div aling=\"center\" class=\"textos\">
				<font color=\"#FF0000\" >Mail ($nombre  $mail) Actualizado</font> </div><br>";
			    
			  }else{
			 $importa .="<div aling=\"center\" class=\"textos\">
			    <font color=\"#FF0000\" >Mail ($nombre  $mail) ya existe en la Base de Datos </font> 
			  </div><br>";
			  
			  
			  }
			  
			 
			 }
			
			

            /*****************************************
            ** Se ingresa el nuevo usuario a la BD. **
            *****************************************/
			
         
		  
		  $nombre="";
		  $direccion="";
		  $telefono="";
		  $comuna="";
		  
      } 

	  $resumen ="  $importa
	  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                     <tr>
                       <td align=\"center\" class=\"textos\">mail totales agregados: $cont_add</td>
                       </tr>
					   <tr>
                       <td align=\"center\" class=\"textos\">mail totales repetidos: $cont_exist</td>
                       </tr>
                 	</table>";
					
					
					
	$contenido .="$resumen";
	  
?>