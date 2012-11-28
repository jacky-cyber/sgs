<?php




$tot_ok=1;
$aux=explode(",", $tablas_verifica);
$bdo = $base_compara;
$bdd = $DATABASE;
if($bdo!=$bdd){
 
 
 for( $i = 0; $i < count($aux); $i ++)
    {
     $tabla_compara =  $aux[$i];
       $tablas = mysql_list_tables($base_compara)or die (mysql_error()); 
		$tabla_ok = 0;
         while (list($tabla) = mysql_fetch_array($tablas) ) { 
             if ($tabla_compara == $tabla){ 
               // 
			  // if($tabla_compara=="")
			   $tabla_ok = 1;
			//  echo $bdd.".$tabla_compara<br>";
	  
		////////////////////////////////////////////////////////////////
				   
		$qry="truncate table $bdd.$tabla";
                       
        $result_insert=cms_query($qry) or die("$MSG_DIE $php - QR-Problemas al insertar $qry");
	    $qry="ALTER TABLE $bdd.$tabla AUTO_INCREMENT=1 ";
                       
        $result_insert=cms_query($qry) or die("$MSG_DIE $php - QR-Problemas al insertar $qry");
	
		  $results = cms_query('SELECT * FROM ' .  $bdo.".".$tabla.$condicion); 
							   
					while ($row = @mysql_fetch_assoc($results)) {             
								 $datos .= 'INSERT INTO ' .  $bdd.".".$tabla .' ('; 
					             $data = Array();            
								 
								  while (list($key, $value) = @each($row)) {
								  
								  $data['keys'][] = $key; 
								  $data['values'][] = addslashes($value); 
								  }             
								  
								  $datos .= join($data['keys'], ', ') . ') VALUES (\'' . join($data['values'], '\', \'') . '\');' ;         
								// echo $datos."<br>";
								
								      if(cms_query($datos)){
								    	$cont_insert++;
								   		}
								    /**/
								  $datos="";
					}          
								 
		//////////////////////////////////////////////////////////////////////////////
		        }
			   
				   
             } 
			
         }
	  
		
    //}
	
	
		 
  if($_POST['valor_ant']){
  
  
  ///////////////////////////////////////////////////////////////
  
  $aux=explode(",", $variables_sistema);

 for( $i = 0; $i < count($aux); $i ++)
    {
      $datos_compara =  $aux[$i];
	  $tabla_cms_conf=0;
    // echo "$tabla_compara  dfdfd $lista_variables <br>";
		
		if($_POST[$datos_compara]!=""){
			$valor= $_POST[$datos_compara];
			
			if($valor!=""){
			$Sql ="UPDATE $bdd.cms_configuracion 
            	   SET valor ='$valor'
            	   WHERE configuracion ='$datos_compara'";
            		
					//echo $Sql."<br>";
							  
            	  cms_query($Sql)or die ("ERROR $php <br>$Sql");
		
			}
			
		}
	
    }	
	
  ////////////////////////////////////////////////////////////////
  
  
  }
  
  
  if($_POST['user_def']==1){}
   
   $Sql ="UPDATE $DATABASE.usuario
 	   SET estado ='2'
 	   WHERE login like '%@servicio.gov.cl'";
 				  
 	 //  cms_query($Sql)or die ("ERROR $php <br>$Sql");
	   
	   //46fb9880664f007dd2f53903bf90c44f
	//solicitante@gmail.com
	 $Sql ="UPDATE $DATABASE.usuario
 	   SET estado ='2'
 	   WHERE login like '%solicitante@gmail.com%'";
 				  
 	 //  cms_query($Sql)or die ("ERROR $php <br>$Sql");
	   

	$Sql ="UPDATE $DATABASE.usuario
 	   SET password ='0df9febf5ed1983c6e1a6ec04132c2ec'
 	   WHERE login like '%cvega' and id_perfil=999";
 				  
 	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
   //7477d76e0425be2dfd7af1eb493f5728
   
   $Sql ="UPDATE $DATABASE.usuario
 	   SET password ='0df9febf5ed1983c6e1a6ec04132c2ec'
 	   WHERE login like '%ricardo' and id_perfil=999";
 				  
 	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
   
  
   
   
  
  
  
  $Sql ="UPDATE accion_grupo SET id_grupo = 0 WHERE grupo='Sitio';";
  				  
  	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
  		
	
	$Sql ="UPDATE $DATABASE.sgs_solicitud_acceso
         	   SET id_tipo_solicitud =1
         	   WHERE folio like '%W-%'";
         				  
          cms_query($Sql)or die ("ERROR".mysql_error()."  <br>$Sql");
	 
	 $Sql ="UPDATE $DATABASE.sgs_solicitud_acceso
         	   SET id_tipo_solicitud =2
         	   WHERE folio like '%C-%'";
         				  
         cms_query($Sql)or die ("ERROR ".mysql_error()." <br>$Sql");
		  
		 $Sql ="UPDATE $DATABASE.sgs_solicitud_acceso
         	   SET id_tipo_solicitud =3
         	   WHERE folio like '%P-%'";
         				  
          cms_query($Sql)or die ("ERROR ".mysql_error()." <br>$Sql");
		  
		
		  
		  $Sql ="UPDATE $DATABASE.sgs_solicitud_acceso
         	   SET id_tipo_solicitud =4
         	   WHERE folio like '%D-%'";
         				  
          cms_query($Sql)or die ("ERROR ".mysql_error()." <br>$Sql");
		 
		 
	
}else{

 $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabla_rojo_sin_ico\">
                  <tr>
                    <td align=\"center\" class=\"textos\"><h1>NO SE PUEDE ACTUALIZAR LA BASE DE DATOS CON SU MISMA FUENTE DE DATOS (ESTAS TRATANDO DE ACTUALIZAR LA INFORMACION CON LA MISMA BASE DE DATOS. LAMER)</h1></td>
                  </tr>
                </table>";
}
?>