<?php

function cache_mysql_solo_un_valor($sql,$identificador,$tiempo = 3600){
        
        $identifica = "d_".$identificador;
   	$$identifica = new db(1); 	  
	$query_d=$sql;
               
	$data = $$identifica->fetch($query_d, $tiempo,'s1v_'.$identifica);
	
	list($valor) = @current($data);
        
  return $valor;
}

function cache_mysql_muchos_valores($sql,$identificador,$tiempo = 3600){
        
        $identifica = "d_".$identificador;
   	$$identifica = new db(1); 	  
	$query_d=$sql;
               
	$data = $$identifica->fetch($query_d, $tiempo,'mv_'.$identifica);
	
	
  return $data;
}

function html_template($nombre_template,$cache =0){
	//global $idioma;
	
$nombre_plantilla  = cms_replace(" ","_",$nombre_template);
if(!isset($_SESSION[$nombre_plantilla]) and $cache==0){

session_register_cms($nombre_plantilla);
}else{
$_SESSION[$nombre_plantilla]="";	
}

$tp = $_GET['tp'];
if($_SESSION[$nombre_plantilla]=="" ){
	 
	$_SESSION[$nombre_plantilla]= $html; 
	
	$idioma = $_SESSION['idioma'];
	

	
	$nombre_template2 = $nombre_template."_".$idioma;

	$query= "SELECT html 
           FROM  templates_acciones
           WHERE templates='$nombre_template2'";
	
        
      
      $identificador_template = $accion."_template_acciones_lib_$nombre_template2";
   
    $html = cache_mysql_solo_un_valor($query,$identificador_template,3600);
   // $result= cms_query($query)or die (error($query,mysql_error(),$php));
    // if(!list($html) = mysql_fetch_row($result)){
	if($html==""){
	  
	   	$query= "SELECT html 
			 FROM  templates_acciones
			 WHERE templates='$nombre_template'";
		
		
     		 //$identificador_template = $accion."_template_acciones_lib_$nombre_template";
		  //$html = cache_mysql_solo_un_valor($query,$identificador_template,3600);
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
     			 
		 if(!list($html) = mysql_fetch_row($result)){
				if($html==""){		
	  			
					$html=  "$nombre_template no existe  eee";
				}
	  
	  }
	  
	 }
	  
	 
	
}else{
	 $html= $_SESSION[$nombre_plantilla];	 
}	
	


 if($tp==1){
	  $html= "<div style=\"border: solid #F00 1px; padding:2px;\">$nombre_template<br> $html</div>";
	  }

	  return $html;
}




function total_tabla($tabla,$condicion){



$query= "SELECT count(*)

           FROM  $tabla

		   WHERE 1 

		   $condicion";

	

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

     list($valor) = mysql_fetch_row($result);

	  

	  return $valor;

	 

	  



}


function usuario_nombre($id_user){
	
		//$id_usuario     = id_usuario($id_sesion);
	
  $query= "SELECT nombre,apellido 
	           FROM usuario
	           WHERE id_usuario='$id_user'";

 
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($nombre,$apellido) = mysql_fetch_row($result);
     	      	
	        $nombre = "$nombre $apellido";
	       
	      	$nombre = ucwords(strtolower(trim($nombre)));
	       
	      	return $nombre;
	
}

function estado_contrato_imagen($estado){
	
  
	if($estado=="0"){
		$imagen="<img src=\"images/minus_circle.gif\" alt=\"Creado\" border=\"0\">";
}
	if($estado=="director"){
		$imagen="<img src=\"images/minus_circle.gif\" alt=\"En AprobacioÔøΩn por el Director\" border=\"0\">";

}
	
	if($estado=="central"){
		
		$imagen="<img src=\"images/ciculo_warring.gif\" alt=\"En AprobacioÔøΩn por Central\" border=\"0\">";
		
	}
	if($estado=="fin"){
		
		$imagen="<img src=\"images/ciculo_ok.gif\" alt=\"Proceso Finalizado Aprobado por Central\" border=\"0\">";
		
	}
   if($estado=="cerrado"){
		
		$imagen="<img src=\"images/ciculo_ok.gif\" alt=\"$estado\" border=\"0\">";
		
	}
	
	      	return $imagen;

}


function personal_rut($id_persona){

	

  $query= "SELECT rut,dig    

	           FROM  personal

	           WHERE id='$id_persona'";



 

      $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($rut,$dig) = mysql_fetch_row($result);

	      

	      $rut= "$rut-$dig";

	      

	       

	      	return $rut;

	    

	

}



/*function personal_contrato($id_persona){

	

  $query= "SELECT id_contrato    

	           FROM  contratos

	           WHERE id_personal='$id_persona'";



 

      $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($id_contrato) = mysql_fetch_row($result);

	      

	     

	      	return $id_contrato;

	    

	

}*/



function personal_cargo($id_persona){

	

  $query= "SELECT id_cargo    

	           FROM  contratos

	           WHERE id_personal='$id_persona'";



 

      $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      if(list($id_cargo) = mysql_fetch_row($result)){

		  

		  return $id_cargo;

		  }else{

		  

		  return "S/C";

		  }

	      

	     

	      

	       

	      	

	    

	

}




function fechas_min_html($fecha){



	$fecha2 = explode(" ",$fecha);

	$fecha = $fecha2[0];

	$min = $fecha2[1];



	$fecha = fechas_html($fecha);		

	

	$fecha_n= "$fecha $min";

	return $fecha_n;

	

}

function fechas_html($fecha){
	if ($fecha!=""){
		$aFecha = explode("-",$fecha);
		if(strlen($aFecha[0])==4){
			$anio = $aFecha[0];
			$mes = $aFecha[1];
			$dia = $aFecha[2];
	
			$fecha= "$dia-$mes-$anio";
		}
	}
	return $fecha;
}

function fechas_bd($fecha){
	if ($fecha!=""){
		$aFecha = explode("-",$fecha);
		if(strlen($aFecha[2])==4){
			$anio = $aFecha[2];
			$mes = $aFecha[1];
			$dia = $aFecha[0];
			$fecha= "$anio-$mes-$dia";
		}
	}
	return $fecha;
}



function fechas_min_bd($fecha){

	

	$fecha2 = explode(" ",$fecha);

	$fecha = $fecha2[0];

	$min = $fecha2[1];

	

	$fecha = fechas_bd($fecha);

	

	

	

	

	$fecha_n= "$fecha $min";

	return $fecha_n;

	

}



function estado_personal($id_contrato){

$estado_ficha= true;

	

	

		//		

		 $query= "SELECT id_personal,id_tipo_contrato 

	             FROM  contratos

	             WHERE id_contrato='$id_contrato'";



	//echo $query ."<br>";	 

		 $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($id_persona,$id_tipo_contrato) = mysql_fetch_row($result);

				

				$query= "SELECT paterno,materno,nombres,fechanac,estcivil,nacionalidad,telefono,domicilio,id_comuna,afp,afpafiliacion,isaprecotizacion,isapre  

	                     FROM  personal

	                     WHERE id='$id_persona'";

//echo $query ."<br>";

				

				$result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($paterno,$materno,$nombres,$fechanac,$estcivil,$nacionalidad,$telefono,$domicilio,$id_comuna,$afp,$afpafiliacion,$isaprecotizacion,$isapre) = mysql_fetch_row($result);

	    

	      //4 = honorarios

	      

	     if($id_tipo_contrato!=4){

	     	if($estcivil==""){$estado_ficha=false;}

		    if($nacionalidad=="" or $nacionalidad=="0"){$estado_ficha=false;}	

		    

		   /* if($afp==""){$estado_ficha=false;} 

		    if($isapre==""){$estado_ficha=false;} 

		    if($isaprecotizacion==""){$estado_ficha=false;} 

		    if($afpafiliacion=="0000-00-00"){$estado_ficha=false;} */

	     }

	      

	    if($paterno=="" or $paterno=="0"){$estado_ficha=false;}

		if($materno=="" or $materno=="0"){$estado_ficha=false;}

		if($nombres=="" or $nombres=="0"){$estado_ficha=false;}

		if($fechanac=="0000-00-00" or $fechanac==""){$estado_ficha=false;}

	 

		if($telefono=="" or $telefono=="0"){$estado_ficha=false;} 

		if($domicilio=="" or $domicilio=="0"){$estado_ficha=false;} 

		if($id_comuna=="" or $id_comuna=="0"){$estado_ficha=false;} 

		

		

			

		

	

		return $estado_ficha;		

	      

}







function estado_personal_detalle($id_contrato){

$estado_ficha= true;

	

	

		//		

		 $query= "SELECT id_personal,id_tipo_contrato 

	             FROM  contratos

	             WHERE id_contrato='$id_contrato'";



	//echo $query ."<br>";	 

		 $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($id_persona,$id_tipo_contrato) = mysql_fetch_row($result);

				

				$query= "SELECT paterno,materno,nombres,fechanac,estcivil,nacionalidad,telefono,domicilio,id_comuna,afp,afpafiliacion,isaprecotizacion,isapre  

	                     FROM  personal

	                     WHERE id='$id_persona'";

//echo $query ."<br>";

				

				$result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($paterno,$materno,$nombres,$fechanac,$estcivil,$nacionalidad,$telefono,$domicilio,$id_comuna,$afp,$afpafiliacion,$isaprecotizacion,$isapre) = mysql_fetch_row($result);

	    

	      //4 = honorarios

	    $dato="";  

	     if($id_tipo_contrato!=4){

	     	if($estcivil==""){$dato .=",Estado civil";}

		    if($nacionalidad=="" or $nacionalidad=="0"){$dato .=",Nacionalidad";}	

		   // if($afp==""){$dato .=",Afp";} 

		   // if($isapre==""){$dato .=",Isapre";} 

		   // if($isaprecotizacion==""){$dato .=",Isapre cotizaciÔøΩn";} 

		   // if($afpafiliacion=="0000-00-00"){$dato .=",Fecha Afp AfiliaciÔøΩn";} 

	     }

	      

	    if($paterno=="" or $paterno=="0"){$dato .=",Apellido paterno";}

		if($materno=="" or $materno=="0"){$dato .=",Apellido Materno";}

		if($nombres=="" or $nombres=="0"){$dato .=",Nombres";}

		if($fechanac=="0000-00-00" or $fechanac==""){$dato .=",Fecha Nacimiento";}

	 

		if($telefono=="" or $telefono=="0"){$dato .=",TelÔøΩfono";} 

		if($domicilio=="" or $domicilio=="0"){$dato .=",Domicilio";} 

		if($id_comuna=="" or $id_comuna=="0"){$dato .=",comuna";} 

		

		

			

		$dato = substr($dato,1);

	

		return $dato;		

	      

}



function estado_contrato($id_contrato){

$estado_contrato=true;	

	 $query= "SELECT ingreso,vencimiento,id_tipo_contrato,valor_hr,valor_jornada,id_cargo,valor_extra,ump

	             FROM  contratos

	             WHERE id_contrato='$id_contrato'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($ingreso,$vencimiento,$id_tipo_contrato,$valor_hr,$valor_jornada,$id_cargo,$valor_extra,$ump) = mysql_fetch_row($result);

	     

	      $campos = mysql_num_fields($result);



			$i=0;

				if($ingreso=="" or $ingreso=="0"){$estado_ficha=false;}

				if($vencimiento=="" or $vencimiento=="0"){$estado_ficha=false;}   

				if($id_tipo_contrato=="" or $id_tipo_contrato=="0"){$estado_ficha=false;}   

				if($valor_hr=="" or $valor_hr=="0"){$estado_ficha=false;}   

				if($valor_jornada=="" or $valor_jornada=="0"){$estado_ficha=false;}   

				if($id_cargo==""){$estado_ficha=false;}   

				if($valor_extra=="" or $valor_extra=="0"){$estado_ficha=false;}   

				//if($ump=="" or $ump=="0"){$estado_ficha=false;}   

			

			

			

	return $estado_contrato;

}





function nombre_perfil($id_perfil){

	$query= "SELECT  perfil  

	           FROM  usuario_perfil 

	           WHERE id_perfil  ='$id_perfil'";

	     $result_nom= cms_query($query)or die (error($query,mysql_error(),$php));

	    

	     if(list($perfil) = mysql_fetch_row($result_nom)){

	        return $perfil;

	     }else{

	     	return $id_perfil;

	     }

	

	

}







function nivel_perfil($id_perfil){

	$nivel_perfil=0;

	    $perfil = perfil_padre($id_perfil);

		

	    while($perfil!=false){

		   $nivel_perfil++;

			$perfil = perfil_padre($perfil);

		//echo $perfil."  $nivel_perfil<br>";

		}

	//echo "$id_perfil ->  $nivel_perfil<br>";

	return $nivel_perfil;

	

}





function perfil_padre($id_perfil){

	$query= "SELECT  id_perfil_padre  

	           FROM  usuario_perfil_relacion  

	           WHERE id_perfil_hijo  ='$id_perfil'";

	     $result1= cms_query($query)or die (error($query,mysql_error(),$php));

	    

	     if(list($perfil) = mysql_fetch_row($result1)){

	         return $perfil;

	     }else{

		 	 return false;

		 }

	

	

}





function hijos_perfil($id_perfil){

	

	   $query= "SELECT  id_perfil_hijo  

	           FROM  usuario_perfil_relacion  

	           WHERE id_perfil_padre  =$id_perfil";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	    

	     if(list($perfil) = mysql_fetch_row($result)){

		 	return true;

		 }else{

		 	return false;

		 }

	

	

}





function marca_perfil($id_perfil,$accion){

	

	   $query= "SELECT  id_perfil

	            FROM  accion_perfil  

	            WHERE id_perfil =$id_perfil 

				AND accion = $accion";

				

				//echo $query."<br>";

				

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	    

	     if(!list($perfil) = mysql_fetch_row($result)){

		 	$qry_insert="INSERT INTO accion_perfil(id_perfil,accion,act) 

						 values ('$id_perfil','$accion','0')";

           

		    //echo $qry_insert." marca <br>";

		    $result_insert=cms_query($qry_insert) or die("$MSG_DIE -marca_perfil QR-Problemas al insertar $qry_insert");

			

			

			$id_padre = perfil_padre($id_perfil);

		 }

	

	return $id_padre;

}









function perfil_hijo_sin_marca($id_perfil_p,$accion){

      $estado=false;

	//  echo "rr $id_perfil_p<br>";

	  if($id_perfil_p!=""){

	  $query= "SELECT id_perfil_hijo   

               FROM  usuario_perfil_relacion 

               WHERE id_perfil_padre = $id_perfil_p";

			 //  echo $query ."<br><br>";

         $result1= cms_query($query)or die ("ERROR 1 perfil_hijo_sin_marca <br>$query");

          while (list($id_perfil_hijo) = mysql_fetch_row($result1)){

    			if($id_perfil_hijo!=""){

				$query= "SELECT  id_perfil

	            		 FROM  accion_perfil  

	            		 WHERE id_perfil =$id_perfil_hijo 

						 AND accion = $accion";

	    		

				 $result2= cms_query($query)or die ("ERROR 2 perfil_hijo_sin_marca <br>$query");

	    

	     		  if(!list($perfil) = mysql_fetch_row($result2)){

		 			$estado= $id_perfil_hijo;

				  }

				

				}

					

			 }

	   }

	   return $estado;

}





function marca_arbol($id_perfil_padre,$accion){

	   

	   $id_perfil_hijo= perfil_hijo_sin_marca($id_perfil_padre,$accion);

	  

	   if($id_perfil_hijo!=false){

	  

	  		 marca_arbol($id_perfil_hijo,$accion);

	   

	   }else{

	 		$nivel= nivel_perfil($id_perfil_padre);

				if($nivel!="0" and $id_perfil_padre!=""){

				

				$id_perfil_padre2 = marca_perfil($id_perfil_padre,$accion);

				marca_arbol($id_perfil_padre2,$accion);

				}

			

	   }

	   

}



/***************************************/





function des_marca_perfil($id_perfil,$accion){

	

	   $query= "SELECT  id_perfil

	            FROM  accion_perfil  

	            WHERE id_perfil =$id_perfil 

				AND accion = $accion";

				

				//echo $query."<br>";

				

	     $result= cms_query($query)or die ("ERROR 1 marca_perfil <br>$query");

	    

	     if(list($perfil) = mysql_fetch_row($result)){

		 	

			 $Sql ="DELETE FROM accion_perfil where id_perfil=$id_perfil and accion=$accion";

 cms_query($Sql)or die("$MSG_DIE -des marca_perfil QR-Problemas al borarr $Sql");

		    //echo $qry_insert." marca <br>";

		    

			

			$id_padre = perfil_padre($id_perfil);

		 }

	

	return $id_padre;

}





function perfil_hijo_con_marca($id_perfil_p,$accion){

      $estado=false;

	//  echo "rr $id_perfil_p<br>";

	  if($id_perfil_p!=""){

	  $query= "SELECT id_perfil_hijo   

               FROM  usuario_perfil_relacion 

               WHERE id_perfil_padre = $id_perfil_p";

			 //  echo $query ."<br><br>";

         $result1= cms_query($query)or die ("ERROR 1 perfil_hijo_sin_marca <br>$query");

          while (list($id_perfil_hijo) = mysql_fetch_row($result1)){

    			if($id_perfil_hijo!=""){

				$query= "SELECT  id_perfil

	            		 FROM  accion_perfil  

	            		 WHERE id_perfil =$id_perfil_hijo 

						 AND accion = $accion";

	    		

				 $result2= cms_query($query)or die ("ERROR 2 perfil_hijo_sin_marca <br>$query");

	    

	     		  if(list($perfil) = mysql_fetch_row($result2)){

		 			$estado= $id_perfil_hijo;

				  }

				

				}

					

			 }

	   }

	   return $estado;

}









function des_marca_arbol($id_perfil_padre,$accion){

		$id_perfil_hijo= perfil_hijo_con_marca($id_perfil_padre,$accion);

	    

	   if($id_perfil_hijo!=false){

	  

	  		 des_marca_arbol($id_perfil_hijo,$accion);

	   

	   }else{

	    		

			 $nivel= nivel_perfil($id_perfil_padre);

				if($nivel!="0" and $id_perfil_padre!=""){

				

				$id_perfil_padre2 = des_marca_perfil($id_perfil_padre,$accion);

				//echo "marca a $id_perfil_padre,$accion<br>";

				des_marca_arbol($id_perfil_padre2,$accion);

				

				}

			

	   }

	   

}









/***************************************/



function busca_sin_marca_arbol($id_perfil_padre,$accion){

		

    $estado=false;

	//  echo "rr $id_perfil_p<br>";

	  if($id_perfil_padre!=""){

	  $query= "SELECT id_perfil_hijo   

               FROM  usuario_perfil_relacion 

               WHERE id_perfil_padre = $id_perfil_padre";

			 //  echo $query ."<br><br>";

         $result1= cms_query($query)or die ("ERROR 1 perfil_hijo_sin_marca <br>$query");

          while (list($id_perfil_hijo) = mysql_fetch_row($result1) and $estado==false){

    			if($id_perfil_hijo!=""){

				$query= "SELECT  id_perfil

	            		 FROM  accion_perfil  

	            		 WHERE id_perfil =$id_perfil_hijo 

						 AND accion = $accion";

	    		

				 $result2= cms_query($query)or die ("ERROR 2 perfil_hijo_sin_marca <br>$query");

	    

	     		  if(!list($perfil) = mysql_fetch_row($result2)){

		 			$estado= true;

					//echo 

				  }else{

				  $estado = busca_sin_marca_arbol($id_perfil_hijo,$accion);

				  }

				

				}

					

			 }

	   }

	   return $estado;

	   



}













function perfil_contenido($id_contenido,$id_perfil){

	

	    $query= "SELECT id_perfil 

                 FROM  control_contenido_perfil 

                 WHERE id_contenido ='$id_contenido' and id_perfil='$id_perfil'";

           $result_cont= cms_query($query)or die ("ERROR perfil_contenido <br>$query");

           if(list($id_perfil_hijo) = mysql_fetch_row($result_cont)){

      			return true;	

			 }else{

			 	return false;	

			 }

	  

	

}





function perfil_hijo_no_perfiles_contenido($id_contenido,$id_perfil_padre){

	$id_hij=false;

	    $query= "SELECT id_perfil_hijo    

                 FROM  usuario_perfil_relacion 

                 WHERE id_perfil_padre ='$id_perfil_padre'";

           $result2= cms_query($query)or die ("ERROR perfil_hijo_no_perfiles_contenido <br>$query");

           while(list($id_perfil_hij) = mysql_fetch_row($result2)){

      				

					//$perf= nombre_perfil($id_perfil_padre);

					//echo "hijos $id_perfil_hij  $perf<br>";

					//echo $query."<br>";

					

					

					if(!perfil_contenido($id_contenido,$id_perfil_hij)){

							//echo "perfil_hijo_no_perfiles_contenido retorna ". $id_perfil_hij."<br>";

							return $id_perfil_hij;

					}	   

      		 }

	  



}



function perfil_si_hijo_perfiles_contenido($id_contenido,$id_perfil_padre){

	

	    $query= "SELECT id_perfil_hijo    

                 FROM  usuario_perfil_relacion 

                 WHERE id_perfil_padre ='$id_perfil_padre'";

           $result22= cms_query($query)or die ("ERROR perfil_hijo_si_perfiles_contenido <br>$query");

           while(list($id_perfil_h) = mysql_fetch_row($result22)){

      				

					if(perfil_contenido($id_contenido,$id_perfil_h)){

					

				    // echo $id_perfil_h."<br>";

						$id_hij = $id_perfil_h;

					}

							   

      		 }

	  

	return $id_hij;

}





function marca_perfil_contenido($id_contenido,$id_perfil){

	//$idp=false;	

	if(!perfil_contenido($id_contenido,$id_perfil)){

	

	$qry_insert="INSERT INTO control_contenido_perfil(id_contenido,id_perfil)  

				 values ('$id_contenido','$id_perfil')";

    //echo $qry_insert."<br>";            

    $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar marca_perfil_contenido $qry_insert");

	

	}

	$idp=perfil_padre($id_perfil);

	

	return $idp;

}





function desmarca_perfil_contenido($id_contenido,$id_perfil){

	

	

	 $Sql ="DELETE FROM control_contenido_perfil

	 		WHERE id_contenido ='$id_contenido' and id_perfil='$id_perfil'";

 cms_query($Sql)or die("$MSG_DIE - QR-Problemas al borrar desmarca_perfil_contenidos $Sql");

	 

	$id_padre = perfil_padre($id_perfil);

	return $id_padre;

	// echo "desmarca_perfil_contenido -----$id_perfil --- $id_padre<br>";

}



/************************/

function marca_arbol_sin_perfiles_contenido($id_contenido,$id_perfil_padre,$id_perfil_orig){

	

	

	

	$id_perfil_padre2 = perfil_hijo_no_perfiles_contenido($id_contenido,$id_perfil_padre);

	

	$perf= nombre_perfil($id_perfil_padre);

	 

	   if($id_perfil_padre2!=false){

	  

	  		 marca_arbol_sin_perfiles_contenido($id_contenido,$id_perfil_padre2,$id_perfil_orig);

	   }else{

	    	 $nivel= nivel_perfil($id_perfil_padre);

		

			if($id_perfil_padre!=$id_perfil_orig){

					$id_perfil_padre2=marca_perfil_contenido($id_contenido,$id_perfil_padre);

					

					marca_arbol_sin_perfiles_contenido($id_contenido,$id_perfil_padre2,$id_perfil_orig);

			}else{

				marca_perfil_contenido($id_contenido,$id_perfil_orig);

	

			}	

		  }

	

		   

}









/******************/



function desmarca_arbol_con_perfiles_contenido($id_contenido,$id_perfil_padre,$id_perfil_orig){

	

	

	$id_perfil_padre2 = perfil_si_hijo_perfiles_contenido($id_contenido,$id_perfil_padre);

	

	$perf= nombre_perfil($id_perfil_padre);

	// echo "marca 0 $perf $id_perfil_padre --> hjo $id_perfil_padre2 <br>";

	  

	  

	   if($id_perfil_padre2!=false){

	 // echo "marca 1 $id_perfil_padre2<br>";

	  		 desmarca_arbol_con_perfiles_contenido($id_contenido,$id_perfil_padre2,$id_perfil_orig);

	   }else{

	    	

			//echo "marca 2 $id_perfil_padre<br>";

			 $nivel= nivel_perfil($id_perfil_padre);

		

			if($id_perfil_padre!=$id_perfil_orig){

					$id_perfil_padre2=desmarca_perfil_contenido($id_contenido,$id_perfil_padre);

					

					desmarca_arbol_con_perfiles_contenido($id_contenido,$id_perfil_padre2,$id_perfil_orig);

			}else{

				desmarca_perfil_contenido($id_contenido,$id_perfil_padre);

	

			}	

		  }

	 

}



/**/










function menu_perfil($id_perfil,$id_accion){
	
//require_once('deuman/mysql_cache/class_db.php'); 
	
/*
 * Select tabla accion_perfil
 * 
 */

	$d_accion_perfil = new db(1); 	  
	$query_accion_perfil="SELECT id_perfil
                              FROM  accion_perfil
                              WHERE  id_perfil = $id_perfil and accion=$id_accion";
                              
	$data_accion_perfil = $d_accion_perfil->fetch($query_accion_perfil, 3600,'funcion_menu_perfil_'.$id_perfil."_$id_accion");
	if ($data_accion_perfil === FALSE) {
	 // error($query_accion_perfil,$d_accion_perfil->log,$php);
	}
	
	if(list($id_p) = current($data_accion_perfil)){
		return true;
	}else{
		return false;
	}
/** fin select accion_perfil***/



	

}





function grupo_perfil($id_perfil,$id_grupo){



$id_p="";

	   $query= "SELECT  ap.accion 

	            FROM  accion_perfil ap, acciones a

	            WHERE ap.id_perfil = $id_perfil 

			    AND a.accion=ap.accion 

			    AND a.id_grupo = $id_grupo";

			  

			   $result_lib= cms_query($query)or die (error($query,mysql_error(),$php));

               list($id_p) = mysql_fetch_row($result_lib);

			   





				  if ($id_p!=""){

				 	return true;

				  }else{

				   	return false;

				  }  

	      

	

}







function menu_id($id_accion,$conn){

	



	   $query= "SELECT  descrip_php_esp  

	           FROM  acciones   

	           WHERE  id_acc=$id_accion";

			// echo $query; 

			  $recordSetlib = &$conn->Execute($query); 

			  $acc = $recordSetlib->fields[0];

			 

	   return $acc;

		   

	

}

/**/





function noticia_perfil($id_contenido,$id_usuario){

	if($id_contenido!=0) {

	

	   $query= "SELECT id_perfil

                FROM  control_contenido_perfil 

                WHERE id_contenido='$id_contenido'";

          $result= cms_query($query)or die (error($query,mysql_error(),$php));

          list($id_perf) = mysql_fetch_row($result);

		  

		  if($id_perf!=0){

		  

		 

	  $query= "SELECT u.id_perfil   

               FROM  usuario u, control_contenido_perfil ccp

               WHERE u.id_usuario='$id_usuario' and ccp.id_contenido=$id_contenido and ccp.id_perfil=u.id_perfil ";

         $result1= cms_query($query)or die (error($query,mysql_error(),$php));

         

		// echo $query."<br>";

		 if(list($id_perfil) = mysql_fetch_row($result1)){

		 	$estado=true;

		 

		 }else{

		 $estado=false;

		 	  $query= "SELECT id_perfil   

               		   FROM  usuario

               		   WHERE id_usuario='$id_usuario'";

         $result2= cms_query($query)or die (error($query,mysql_error(),$php));

         if(list($id_perfil) = mysql_fetch_row($result2)){

		 

		  	   $query= "SELECT id_perfil   

                        FROM  usuario_perfiles 

                        WHERE id_usuario='$id_usuario'";

                  $result3= cms_query($query)or die (error($query,mysql_error(),$php));

                   while (list($id_per) = mysql_fetch_row($result3)){

             			

						  $query= "SELECT id_contenido   

                                   FROM  control_contenido_perfil 

                                   WHERE id_contenido='$id_contenido' and id_perfil=$id_perfil";

								   

                             $result4= cms_query($query)or die (error($query,mysql_error(),$php));

							 

                             if (list($id_cont) = mysql_fetch_row($result4)){

                        			$estado=true;			   

                        		 }

									   

             		 }

			 

		 }

    			   

    	}

			  

			

	}else{

		  $estado=true;

		  }

		

		

	return $estado;

	  

	}

}













/*function noticia_colegio($id_contenido,$id_usuario){

$estado=false;



  $query= "SELECT id_perfil  

           FROM  usuario

           WHERE id_usuario='$id_usuario'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));

     list($id_perf) = mysql_fetch_row($result);

	 

	   $query= "SELECT id_establecimiento

                FROM  control_contenido_escuela

                WHERE id_contenido='$id_contenido' and id_establecimiento=0";

          $result= cms_query($query)or die (error($query,mysql_error(),$php));

          if(list($establ) = mysql_fetch_row($result)){

		  	$estado=true;

		  }else{

		  

		  

		  

		  

		  

		 



		  $query= "SELECT u.establecimiento   

                   FROM  usuario u, control_contenido_escuela cce

                   WHERE id_usuario='$id_usuario' and cce.id_contenido=$id_contenido and cce.id_establecimiento=u.establecimiento";

            

			

			 $result1= cms_query($query)or die (error($query,mysql_error(),$php));

              if(list($id_establecimie) = mysql_fetch_row($result1)){

			  $estado=true;

			  }else{

			  

			    $query= "SELECT id_establecimiento   

                         FROM  control_contenido_escuela 

                         WHERE id_contenido='$id_contenido'";

                   $result2= cms_query($query)or die (error($query,mysql_error(),$php));

                    while (list($id_estbl) = mysql_fetch_row($result2)){

              			 

						  $query= "SELECT id_usuario   

                                   FROM  usuario_establecimientos

                                   WHERE id_usuario='$id_usuario' and id_establecimiento =$id_estbl";

                             $result3= cms_query($query)or die (error($query,mysql_error(),$php));

                              if (list($id_u) = mysql_fetch_row($result3)){

                        			$estado=true;			   

                        		 }			   

              		

					 }

			  }

		

		}

		

	return $estado;		  

	

}*/







/***************************************/





 /* Genera nuevo ID   varchar(16)*/

function new_uid()

{

        usleep(1);

        srand((double)microtime() * 1000000);

        $rand_key=rand(10,99);

        $x=time();

        $f=getdate($x);

        $uid=sprintf("%04d%02d%02d%02d%02d%02d%02d",$f["year"],$f["mon"],$f["mday"],$f["hours"],$f["minutes"],$f["seconds"],$rand_key);

        return $uid;

}



/* Obtiene la extension del archivo $file dado */

function getext($file)

{

        if(strlen($file)==0) {

                return "";

        }

        $string=str_replace("\\","/",$file);

        $c=strrpos($string,'/');

        if(strlen($c)>0) {

                $string=substr($string,$c+1);

                if(strlen($string)==0)

                        return "";

        }

        $a=strrpos($string,'.');

        if(strlen($a)==0) {

                return "";

        }

        return substr($string,$a+1);

}

 



/* retorna la edad en annos con $fecha_nac como referencia en formato

  AAAAMMDD */

function get_age($fecha_nac)

{

//$fa: fecha_actual

        $x=time();

        $fa=getdate($x);

        $fnac[2]=substr($fecha_nac,0,4);

        $fnac[1]=substr($fecha_nac,4,2);

        $fnac[0]=substr($fecha_nac,6);

        switch ($fnac[1]) {

                case "01":

                        $mes=1;

                        break;

                case "02":

                        $mes=2;

                        break;

                case "03":

                        $mes=3;

                        break;

                case "04":

                        $mes=4;

                        break;

                case "05":

                        $mes=5;

                        break;

                case "06":

                        $mes=6;

                        break;

                case "07":

                        $mes=7;

                        break;

                case "08":

                        $mes=8;

                        break;

                case "09":

                        $mes=9;

                        break;

                case "10":

                        $mes=10;

                        break;

                case "11":

                        $mes=11;

                        break;

                case "12":

                        $mes=12;

                        break;

        }

        $edad=$fa[year] - $fnac[2];

        if ($fa["mon"] < $mes) {

                $edad--;

        }

        if ($fa["mon"] == $fnac[1]) {

                if ($fa["mday"] < $fnac[0]) {

                        $edad--;

                }

        }

        return $edad;

}



  

function br2nl($data) {

   return preg_replace( '!<br.*>!iU', "\n", $data );

}

	  





function espar($numero) { 

   // Lista todos os algarismos existentes, e seus respectivos tipos (impar ou par) 

   $tipo = array( 

      "0" => "0", 

      "1" => "1", 

      "2" => "0", 

      "3" => "1", 

      "4" => "0", 

      "5" => "1", 

      "6" => "0", 

      "7" => "1", 

      "8" => "0", 

      "9" => "1" 

   ); 



   // Pega o ÔøΩltimo nÔøΩmero de uma string 

   $ultimo = substr($numero, "-1"); 



   // Faz a verificaÔøΩÔøΩo 

   $resposta = $tipo[$ultimo]; 

    

   // Retorna "impar" ou "par" 

   return $resposta; 

}

	

/*MAILLIG*/	

function fechacorta($id)

{

        $anno= substr($id,0,4);

        $mes = substr($id,4,2);

        $dia = substr($id,6,2);

        return $dia."/".$mes."/".$anno;

}







/* Obtiene la hora de creacion de un UID. (el UID se pasa como parametro) */

function hora($id)

{

        $hrs=substr($id,8,2);

        $min=substr($id,10,2);

        return $hrs.":".$min;



}



/* Idem que la anterior, pero ademas se muestran los segundos */



function hora_completa($id)

{

        $hrs=substr($id,8,2);

        $min=substr($id,10,2);

        $seg=substr($id,12,2);

        return $hrs.":".$min.":".$seg;



}











function fecha_num($id)

{

 $anio=substr($id,0,4);

 $mes=substr($id,4,2);

 $dia =substr($id,6,2);

 return $dia."-".$mes."-".$anio;

}

/*fin Mailing*/









function contenido_colegio($id_contenido,$id_establecimiento)

{

 

  /* $query= "SELECT id_establecimiento

            FROM  control_contenido_escuela 

            WHERE id_contenido='$id_contenido'  and id_establecimiento=$id_establecimiento";

      $result= cms_query($query)or die ("contenido_colegio ERROR 1 <br>$query");

      if(list($id) = mysql_fetch_row($result)){

 			return true; 

 		 }else{

		 	return false;

		 }*/

 

 



}





function contenido_perfil($id_contenido,$id_perfil)

{

 

   $query= "SELECT id_perfil

            FROM  control_contenido_perfil

            WHERE id_contenido='$id_contenido' and id_perfil=$id_perfil";

      $result= cms_query($query)or die (error($query,mysql_error(),$php));

      if(list($id) = mysql_fetch_row($result)){

 			return true; 

 		 }else{

		 	return false;

		 }

 

 



}



//carpeta/archivo.jpg

function resize($file,$tamanio,$destino) {

		

		if($tamanio==""){

			$tamanio = 700; 

		}

		

		$imagen_original="$destino/$file";

		

		$source = imagecreatefromjpeg($imagen_original);  

   		   

      	$imageX = imagesx($source);

		

		if($imageX>$tamanio){

		

		

     	$imageY = imagesy($source);    

   	    $thumbY = (int)(($tamanio*$imageY) / $imageX );        

   	    $dest  = imagecreatetruecolor($tamanio, $thumbY);

   	    imagecopyresampled ($dest, $source, 0, 0, 0, 0, $tamanio, $thumbY, $imageX, $imageY);        

   	   	

		unlink($imagen_original);

		

		ImageJpeg($dest, $imagen_original, 80);

		

		ImageDestroy($source);

		ImageDestroy($dest);

		

		}

		

		

 }





function caracteres_html($texto){
//$texto = utf8_decode($texto);
//$texto= html_entity_decode($texto);



//$texto= html_entity_decode($texto);
$texto= htmlentities($texto);
//echo $texto."---rr--<br>\n";
 if(configuracion_cms('trasformar_formato_html')==1){
 
//$charset = configuracion_cms('charset');
		/*
		for($i=128;$i<=255;$i++){
				
        	$entity = htmlentities(chr($i), ENT_QUOTES,$charset);
       	 	$temp = substr($entity, 0, 1);
        	$temp .= substr($entity, -1, 1);
		
        	if ($temp != '&;'){
            	$texto = str_replace(chr($i), '', $texto);
        	}else{
            	$texto = str_replace(chr($i), $entity, $texto);
        	}
		}
		 */
  //echo $texto."---rr2ddd--<br>\n";
  
        
		if(perfil(session_id())==999){
		    $var= "\ ";
			$var = trim($var)."\"";
        	$texto = str_replace($var,"\"",$texto);
		
			$var= "\'";
			$texto = str_replace($var,"'",$texto);
		}

		
		
}else{
	//echo $texto."---rr2--<br>\n";	
		
		
		if(perfil(session_id())!=999){
		    $texto = str_replace("'","\'",$texto);
		    $texto = str_replace("\"",'\"',$texto);
		}
	
	
}

	    return $texto;

}

 

 

function acentos($texto)

{

    // $texto= caracteres_html($texto);
      return $texto;


}

function acentos_unicode($texto){


$texto = str_replace("·","\u00E1",$texto);
$texto = str_replace("È","\u00E9",$texto);
$texto = str_replace("Ì","\u00ED",$texto);
$texto = str_replace("Û","\u00F3",$texto);
$texto = str_replace("˙","\u00FA",$texto);
$texto = str_replace("Ò","\u00F1",$texto);
$texto = str_replace("ø","\u00BF",$texto);
//$texto = str_replace("?","\u00D1",$texto);

/*
$texto=str_replace("¡ &Aacute; \u00C1 
$texto=str_replace("· &aacute; \u00E1 
$texto=str_replace("… &Eacute; \u00C9 
$texto=str_replace("È &eacute; \u00E9 
$texto=str_replace("Õ &Iacute; \u00CD 
$texto=str_replace("Ì &iacute; \u00ED 
$texto=str_replace("” &Oacute; \u00D3 
$texto=str_replace("Û &oacute; \u00F3 
$texto=str_replace("⁄ &Uacute; \u00DA 
$texto=str_replace("˙ &uacute; \u00FA 
$texto=str_replace("‹ &Uuml; \u00DC 
$texto=str_replace("¸ &uuml; \u00FC 
$texto=str_replace("? &Ntilde; \u00D1 
$texto=str_replace("Ò &ntilde; \u00F1 
$texto=str_replace("& &amp; \u0022 
$texto=str_replace("< &lt; \u003C 
$texto=str_replace("> &gt; \u003E 
$texto=str_replace("Ì &itilde; \u00ED 
$texto=str_replace("  &nbsp; \u00A0 
$texto=str_replace("ì &quot; \u0022 
$texto=str_replace("ë &apos; \u0027 
$texto=str_replace("© &copy; \u00A9 
$texto=str_replace("Æ &reg; \u00AE 
$texto=str_replace("Ä &euro; \u20AC 
$texto=str_replace("º &frac14; \u00BC 
$texto=str_replace("Ω &frac12; \u00BD 
$texto=str_replace("æ &frac34; \u00BE 

*/
return $texto;
}

function acentos_inverso($cadena)

{

    $cadena = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $cadena);
    $cadena = preg_replace('~&#([0-9]+);~e', 'chr(\\1)', $cadena);
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    $var =strtr($cadena, $trans_tbl);
	$var = str_replace("&quot;","\"",$var);
	$var = str_replace("&amp;","&",$var);
   return  $var;

 /*$texto = str_replace("&aacute;","·",$texto);

 $texto = str_replace("&eacute;","È",$texto);

 $texto = str_replace("&iacute;","Ì",$texto);

 $texto = str_replace("&oacute;","Û",$texto);

 $texto = str_replace("&uacute;","˙",$texto);

 $texto = str_replace("&ntilde;","Ò",$texto);

 

 return $texto;*/



}



function traduce_accion($accion)

{



if($accion!=""){



//$accion = str_replace("_"," ",$accion);
if(!is_numeric($accion)){
$accion= titulo_url($accion);




   $query= "SELECT accion    

            FROM  acciones

            WHERE descrip_url='$accion' ";

    

	  $result= cms_query($query)or die (error($query,mysql_error(),$php));

	list($acc) = mysql_fetch_row($result);

	  if($acc!=""){

	 	 $accion=$acc;

	  }else{

	  	$acc=$accion;

	  }

	}else{
	
	$acc=$accion;
	}  

 

 

return $acc;

}

}







function accion_id_acc($accion)

{







   $query= "SELECT accion    

            FROM  acciones

            WHERE id_acc='$accion' ";

    

	//echo "$query<br>";

	  $result= cms_query($query)or die (error($query,mysql_error(),$php));

	list($acc) = mysql_fetch_row($result);

	 

	  

 

	return $acc;



}





function id_acc($accion)

{

   $query= "SELECT id_acc    
            FROM  acciones
            WHERE accion='$accion' ";
    
	//echo "$query<br>";
	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
	list($acc) = mysql_fetch_row($result);
	 
	
return $acc;

}










function accion_palabra($accion){

		$query= "SELECT descrip_url,id_tipo    
           FROM  acciones
           WHERE accion='$accion'";
		   
     $result_acc= cms_query($query)or die (error($query,mysql_error(),$php));
     list($accion_txt,$id_tipo_cont) = mysql_fetch_row($result_acc);
	
	// $accion_txt = str_replace(" ","_",$accion_txt);
	  $accion =strtolower($accion_txt);
	  return $accion;
	
}



function texto_to_url($texto){

	$texto =str_replace(" ","_",$texto);

	$texto = strtolower($texto);

	$texto =urlencode($texto);

	return $texto;

}



function texto_to_id_noticia($texto){

	

	 // $texto =str_replace("_"," ",$texto);

	$texto = titulo_url($texto);

	$query= "SELECT id_noticia  

	           FROM  noticias

	           WHERE titulo_url='$texto'";

			 //  echo $query;

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	    list($id_noticia) = mysql_fetch_row($result);

	return $id_noticia;    

	    

}











function traduce_grupo($grupo)

{

   $query= "SELECT id_grupo      

            FROM  accion_grupo 

            WHERE grupo='$grupo'";

    

	//echo $query;

	  $result= cms_query($query)or die (error($query,mysql_error(),$php));

      list($id_grupo) = mysql_fetch_row($result);

 

 return $id_grupo;



}



function accion_grupo($acc)

{



if($acc==""){

$acc=5;

}

   $query= "SELECT id_grupo      

            FROM  acciones 

            WHERE accion='$acc'";

    

	

	

	

	//echo $query;

	  $result= cms_query($query)or die (error($query,mysql_error(),$php));

      list($id_grupo) = mysql_fetch_row($result);

 

 return $id_grupo;



}



function grupo_nombre($id_grupo)

{

   $query= "SELECT grupo      

            FROM  accion_grupo

            WHERE id_grupo='$id_grupo'";

    

	//echo $query;

	  $result= cms_query($query)or die (error($query,mysql_error(),$php));

      list($grupo_nom) = mysql_fetch_row($result);

 

 return $grupo_nom;



}



  function cliente($id_cliente){

  

    $query= "SELECT cliente

             FROM  clientes

             WHERE id_cliente='$id_cliente'";

       $result= cms_query($query)or die (error($query,mysql_error(),$php));

        list($cliente) = mysql_fetch_row($result);

		

		return $cliente;

  }



 

 

 function generaRegion()

{

	$consulta=cms_query("SELECT id_region, region FROM regiones");

	

	

	// Voy imprimiendo el primer select compuesto por los paises

	$select_regiones = "<select name='id_region' id='id_region' onChange='cargaContenido(this.id)'>";

	$select_regiones .= "<option value='0'>Seleccione Regi&oacute;n</option>";

	while($registro=mysql_fetch_row($consulta))

	{

		$select_regiones .= "<option value='".$registro[0]."'>".$registro[1]."</option>";

	}

	$select_regiones .= "</select>";

	

	return $select_regiones;

	

}



function generaRegion1($id_region2)

{

	$consulta=cms_query("SELECT id_region, region FROM regiones");

	

	

	// Voy imprimiendo el primer select compuesto por los paises

	$select_regiones = "<select name='id_region' id='id_region' onChange='cargaContenido(this.id)'>";

	$select_regiones .= "<option value='0'>Seleccione Regi&oacute;n</option>";

	while($registro=mysql_fetch_row($consulta))

	{

		if($id_region2==$registro[0]){

			$select_regiones .= "<option value='".$registro[0]."' selected>".$registro[1]."</option>";

		

		}else{

				$select_regiones .= "<option value='".$registro[0]."'>".$registro[1]."</option>";

		}

		

		

	}

	$select_regiones .= "</select>";

	

	return $select_regiones;

	

}





function html_banner($id_templates_banner){

	

	      	

	      	 $query= "SELECT html   

	           FROM  templates_acciones

	           WHERE id_templates=$id_templates_banner";

	//echo "$query<br>";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	     list($html_banner) = mysql_fetch_row($result);

	   

			 

	

	 

	return $html_banner;

}









function cambio_texto($texto)

{

$n_texto=ereg_replace("ÔøΩ","&#225;",$texto);

$n_texto=ereg_replace("ÔøΩ","&#233;",$n_texto);

$n_texto=ereg_replace("ÔøΩ","&#237;",$n_texto);

$n_texto=ereg_replace("ÔøΩ","&#243;",$n_texto);

$n_texto=ereg_replace("ÔøΩ","&#250;",$n_texto);



$n_texto=ereg_replace("ÔøΩ","&#193;",$n_texto);

$n_texto=ereg_replace("ÔøΩ","&#201;",$n_texto);

$n_texto=ereg_replace("ÔøΩ","&#205;",$n_texto);

$n_texto=ereg_replace("ÔøΩ","&#211;",$n_texto);

$n_texto=ereg_replace("ÔøΩ","&#218;",$n_texto);



$n_texto=ereg_replace("ÔøΩ", "&#241;", $n_texto);



$n_texto=ereg_replace("ÔøΩ", "&#209;", $n_texto);



$n_texto=ereg_replace("ÔøΩ", "&#191;", $n_texto);
$n_texto=ereg_replace("ÔøΩ", "&ordm;", $n_texto);





return $n_texto;

}





function vuelve_cambio_texto($texto)

{

$n_texto=ereg_replace("&#225;","ÔøΩ",$texto);

$n_texto=ereg_replace("&#233;","ÔøΩ",$n_texto);

$n_texto=ereg_replace("&#237;","ÔøΩ",$n_texto);

$n_texto=ereg_replace("&#243;","ÔøΩ",$n_texto);

$n_texto=ereg_replace("&#250;","ÔøΩ",$n_texto);



$n_texto=ereg_replace("&#193;","ÔøΩ",$n_texto);

$n_texto=ereg_replace("&#201;","ÔøΩ",$n_texto);

$n_texto=ereg_replace("&#205;","ÔøΩ",$n_texto);

$n_texto=ereg_replace("&#211;","ÔøΩ",$n_texto);

$n_texto=ereg_replace("&#218;","ÔøΩ",$n_texto);



$n_texto=ereg_replace("&#241;","ÔøΩ",$n_texto);



$n_texto=ereg_replace("&#209;","ÔøΩ",$n_texto);



$n_texto=ereg_replace("&#191;","ÔøΩ",$n_texto);





return $n_texto;

}









 

	 

function Paginacion($t,$p,$link){

     if($p=="")$p=1;

    

	 if($p>=1 || $p<=$t){

        $o = 5;

        if($t>1){

          // Iniciamos la variable

          $a = "";

          // Link Primera Pagina)

          if($p>2){

            $ln = str_replace('{P}','1',$link);

           $a .= '<li>'.$ln.'<< </a></li>';

         }

         // Link Pagina Anterior

         if($p>1){

           $ln = str_replace('{P}',($p-1),$link);

           $a .= '<li>'.$ln.'< </a></li>';

         }

         $offset = $p-$o;

         $offset_init = ($p-($o+2));

         if($p>4){

           for($i=$offset_init;$i<=($offset+1);$i++){

             if($i>0){

               $ln = str_replace('{P}',$i,$link);

               $a .= '<li>'.$ln.$i.'</a></li>';

             }

           }

           $a .= '<li> ... </li>';  

           for($i=$p;$i<($p+4);$i++){

             if($i<=$t){

               if($i==$p){

                 $a .= '<li><span class="esta">'.$i.'</span></li>';

               }else{

                 $ln = str_replace('{P}',$i,$link);

                 $a .= '<li>'.$ln.$i.'</a></li>';

               }

             }

           } 

         }else{

           for($i=1;$i<($p+4);$i++){

             if($i<=$t){

               // Esta Pagina

              if($i==$p){

                 $a .= '<li><span class="esta">'.$i.'</span></li>';

               }else{

                 $ln = str_replace('{P}',$i,$link);

                 $a .= '<li>'.$ln.$i.'</a></li>';

               }

             }

           }

         }

         // Link Pagina Siguiente

         if($p<$t){

           $ln = str_replace('{P}',($p+1),$link);

           $a .= '<li>'.$ln.' ></a></li>';

         }

         // Link Ultima Pagina
			if($t>3 and $t!=$p){
			

          		 $ln = str_replace('{P}',$t,$link);

          		 $a .= '<li>'.$ln.' >> </a></li>';

        	// if($p<($t-2)){ }
			}
        

       }

	   

	   

	   $a = "

	   <style type=\"text/css\">



/*Credits: Dynamic Drive CSS Library */

/*URL: http://www.dynamicdrive.com/style/ */



.pagination{

padding: 20px;

text-align: center;

}



.pagination ul{

margin: 0;

padding: 0;

text-align: center; /*Set to \"right\" to right align pagination interface*/

font-size: 16px;

}



.pagination li{

list-style-type: none;

display: inline;

padding-bottom: 1px;

}



.pagination a, .pagination a:visited{

padding: 0 5px;

border: 1px solid #9aafe5;

text-decoration: none; 

color: #2e6ab1;

}



.pagination a:hover, .pagination a:active{

border: 1px solid #2b66a5;

color: #000;

background-color: #FFFF80;

}



.pagination a.currentpage{

background-color: #2e6ab1;

color: #FFF !important;

border-color: #2b66a5;

font-weight: bold;

cursor: default;

}



.pagination a.disablelink, .pagination a.disablelink:hover{

background-color: white;

cursor: default;

color: #929292;

border-color: #929292;

font-weight: normal !important;

}



.pagination a.prevnext{

font-weight: bold;

}



</style>

	   

	   <div class=\"pagination\" > $a</div>";

	   

       return $a;

     }

   }



   

//CORP











function personal_establecimiento($id_persona){

	

	

  $query= "SELECT establecimiento     

	           FROM  personal

	           WHERE id='$id_persona'";





      $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($establecimiento) = mysql_fetch_row($result);

	     

	  

	      	$establecimiento = ucwords(strtolower(trim($establecimiento)));

	       

	      	return $establecimiento;

	      	

}





function verifica_bloqueo($id_acc){

	

	  $query= "SELECT estado   

	           FROM  modulos_bloqueo 

	           WHERE accion='$id_acc'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($estado) = mysql_fetch_row($result);

		  

		  return $estado;

		  

}





function contrato_name($id_tipo_contrato){

	  $query= "SELECT tipo   

	           FROM  tipos_contratos

	           WHERE id='$id_tipo_contrato'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	     list($tipo) = mysql_fetch_row($result);

	return  $tipo;

}



function nombre_asignatura($id_asignatura){

	

  $query= "SELECT asignatura  

	           FROM  asignaturas 

	           WHERE id='$id_asignatura'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($asignatura_nombre) = mysql_fetch_row($result);

	      

	      return $asignatura_nombre;

}



function tipo_contrato($id_tipo_contrato){

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





function establecimiento_nombre($id_establecimiento){

	

  $query= "SELECT establecimiento    

	           FROM  establecimientos

	           WHERE id='$id_establecimiento'";



 

      $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      if(list($establecimiento) = mysql_fetch_row($result)){

	      	return $establecimiento;

	      }else{

	      	return $id_establecimiento;

	      }



}



function escolaridad($id_escolaridad){

	

  $query= "SELECT escolaridad   

	           FROM  personal_escolaridad  

	           WHERE id='$id_escolaridad'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($escolaridad) = mysql_fetch_row($result);

	      

	      return $escolaridad;

	

}



function id_establecimiento($id_sesion){

	  $query= "SELECT establecimiento

	           FROM  usuario

	           WHERE session='$id_sesion'";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($id_establecimiento) = mysql_fetch_row($result);

	      

	       return $id_establecimiento;	

	      

	

}

function establecimiento($id_sesion){

	  $query= "SELECT establecimientos.establecimiento
				FROM   establecimientos, usuario
				WHERE usuario.session='$id_sesion' and usuario.establecimiento=establecimientos.id";

	     $result= cms_query($query)or die (error($query,mysql_error(),$php));

	      list($establecimiento) = mysql_fetch_row($result);

	      

	       return $establecimiento;	

	      

	

}

function sumaDiasHabiles($fecha_inicio,$cantidad_dias){


if(!isset($_SESSION['lista_dias_no_habiles']) ){

session_register_cms('lista_dias_no_habiles');
}


if($_SESSION['lista_dias_no_habiles']==""){

/*
 * Select tabla eno_habil
 * 
 */
$query= "SELECT no_habil  
           FROM  no_habil";
     $result_eno_habil= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($no_habil) = mysql_fetch_row($result_eno_habil)){
			$lista_no_habil .="$no_habil,";			   
		 }

      
      
  $_SESSION['lista_dias_no_habiles']= $lista_no_habil;   
/** fin select eno_habil***/
}else{
 $lista_no_habil=$_SESSION['lista_dias_no_habiles'];   		
		
}
$arreglo_no_habil = explode(",", $lista_no_habil);
	if($fecha_inicio!="0000-00-00" and $fecha_inicio!="00-00-0000"){
	$fecha_inicio = fechas_bd($fecha_inicio);
	$aux=explode("-", $fecha_inicio);
	$anio_l    = trim($aux[0]);
     
	 
	if(strlen($anio_l)==4 and $anio_l>2007){
		$dias = 0;
		//echo "<br> fx fecha_inicio: ".$fecha_inicio;
		//echo "<br>cantidad_dias: ".$cantidad_dias;
		while ($dias < $cantidad_dias){
			
			$fecha_inicio = suma_fechas(fechas_html($fecha_inicio),1);
			$fecha_inicio = fechas_bd($fecha_inicio);
			//echo "<br> fecha_inicio : ".$fecha_inicio;
			
			//validar que el dia no sea sab, dom ni fest
			
			  //validar si es sab o dom
			 $aFecha = explode("-",$fecha_inicio);
			 $num = date("w", mktime(0, 0, 0, $aFecha[1],$aFecha[2], $aFecha[0]));
			 //echo "<br>num ".$num ;
			 if (($num!=6)&&($num!=0))
			 {
				 //validar si es festivo
				/*
						 $query= "SELECT count(*)  as cantidad 
							FROM  no_habil 
							WHERE no_habil ='$fecha_inicio' ";
				 $result= cms_query($query)or die (error($query_a,mysql_error(),$php));
				 
				 list($cantidad) = mysql_fetch_row($result);				
				*/
				 
				 if(!in_array($fecha_inicio, $arreglo_no_habil) ){
					$dias ++;
					//echo "<br>dias:".$dias."  fecha_inicio : ".$fecha_inicio;
				 }
			}
			
		}
		return $fecha_inicio;
	}else{
	$random = rand(0,100);
	return "<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
	???</a>";
	}
 }
}

function buscarCodigo($aEntidad,$id_entidad){
  
  		$encontrado=0;
  		for($i=0;$i<=count($aEntidad);$i++){
			if ($id_entidad == $aEntidad[$i]){
				$encontrado=1;
			}
		}
		return $encontrado;
  	
}

function calculaDiasHabiles($fecha_termino){
		
if(!isset($_SESSION['lista_dias_no_habiles']) ){

session_register_cms('lista_dias_no_habiles');
}



if($_SESSION['lista_dias_no_habiles']==""){

/*
 * Select tabla eno_habil
 * 
 */
$query= "SELECT no_habil  
           FROM  no_habil";
     $result_eno_habil= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($no_habil) = mysql_fetch_row($result_eno_habil)){
			$lista_no_habil .="$no_habil,";			   
		 }

      
      
  $_SESSION['lista_dias_no_habiles']= $lista_no_habil;   
/** fin select eno_habil***/
}else{
 $lista_no_habil=$_SESSION['lista_dias_no_habiles'];   		
		
}
$arreglo_no_habil = explode(",", $lista_no_habil);

		
if($fecha_termino!="0000-00-00" and $fecha_termino!="00-00-0000"){

	//calcula la cantidad de dias habiles entre la fecha actual y la fecha de termino
		$fecha_termino = fechas_bd($fecha_termino);
		//echo "<br> en calculadias habiles: ".$fecha_termino;
		
		$fecha_movil = date('Y-m-d');
		
		
		if ($fecha_termino >= $fecha_movil){
			
			$sumando = 1;
			$dias = 1;	
		}
		else{
			$sumando = -1;
			
		}
		
		$aux=explode("-", $fecha_termino);
		
		$anio_l    = trim($aux[0]);
	
		//echo "<br><br> fecha movil antes de ciclo:".$fecha_movil;
		while ($fecha_movil != $fecha_termino and $anio_l>2007){
	
			$cont_f++;
			//en algunas versiones de php el calculo de diferencias de dias produce un loop por esto se 
			//desarrollo este parche que verifica la cantidad de dias sumados no se mayor  400
			if($cont_f<400){
			
			$fecha_movil = suma_fechas($fecha_movil,$sumando);
			//echo "<br> salida de suma fechas :".$fecha_movil;
			/************************************/
			//$fecha_movil = fechas_bd($fecha_movil);
			//echo "<br> conversion a ingles :".$fecha_movil."<br>";
			//validar que el dia no sea sab, dom ni fest
			
			  //validar si es sab o dom
			 $aFecha = explode("-",$fecha_movil);
			 $num = date("w", mktime(0, 0, 0, $aFecha[1],$aFecha[2], $aFecha[0]));
			//echo "<br>num ".$num ;
			 if (($num!=6)&&($num!=0))
			 {
				 //validar si es festivo
				 /*
				 $query= "SELECT count(*)  as cantidad 
							FROM  no_habil 
							WHERE no_habil ='$fecha_movil' ";
							
				 $result= cms_query($query)or die (error($query_a,mysql_error(),$php));
			
				 list($cantidad) = mysql_fetch_row($result);
		*/
				  if(!in_array($fecha_movil, $arreglo_no_habil) ){
					$dias ++;
					//echo "<br>dias:".$dias."  fecha_inicio : ".$fecha_inicio;
				 }
			}
			/************************************/

		}else{
			$dias= "-";
			$fecha_movil=$fecha_termino;
			}
		}
		
		return $dias * $sumando;
	

 }
}


function calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_termino){

if(!isset($_SESSION['lista_dias_no_habiles']) ){

session_register_cms('lista_dias_no_habiles');
}


if($_SESSION['lista_dias_no_habiles']==""){

/*
 * Select tabla eno_habil
 * 
 */
$query= "SELECT no_habil  
           FROM  no_habil";
     $result_eno_habil= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($no_habil) = mysql_fetch_row($result_eno_habil)){
			$lista_no_habil .="$no_habil,";			   
		 }

      
      
  $_SESSION['lista_dias_no_habiles']= $lista_no_habil;   
/** fin select eno_habil***/
}else{
 $lista_no_habil=$_SESSION['lista_dias_no_habiles'];   		
		
}
$arreglo_no_habil = explode(",", $lista_no_habil);


$aux=explode("-", $fecha_inicio);
$aux1=explode("-", $fecha_termino);

//echo "\nfecha inicio:".$fecha_inicio."&nbsp;&nbsp;fecha termino:".$fecha_termino;


if($fecha_termino!="0000-00-00" or $fecha_termino!="00-00-0000" ){
//echo "dsfsdfdsf $fecha_termino<br>";
//calcula la cantidad de dias habiles entre dos fechas
	//echo "$fecha_inicio,$fecha_termino \n";
	//or $aux[2]>2007 or $aux1[2]>2007
	
		$aux=explode("-", $fecha_inicio);
		$anio1    = trim($aux[0]);
		
		$aux=explode("-", $fecha_termino);
		$anio2    = trim($aux[0]);
		
		if($anio1>2007 and $anio2>2007){
		if(strlen($anio1)==4 and strlen($anio2)==4){
		$dias = 0;
		$fecha_movil = $fecha_inicio;
		if ($fecha_termino >= $fecha_movil){
			$sumando = 1;
			//$dias = 1;// se modifico 1 por 0
			
			
		}
		else{
			$sumando = -1;
			//echo "sdfsdf rrrr <br>";
		}
		
		//echo "<br>sumando :".$sumando."\n";
		
		//echo "<br> fx fecha_movil: ".$fecha_movil;
		//echo "\ncantidad_dias: ".$dias;
		while ($fecha_movil != $fecha_termino and $fecha_termino!="0000-00-00" ){
		
			$cont_f++;
			//en algunas versiones de php el calculo de diferencias de dias produce un loop por esto se 
			//desarrollo este parche que verifica la cantidad de dias sumados no se mayor  400
			if($cont_f<400){
			
			$fecha_movil = suma_fechas(fechas_html($fecha_movil),$sumando);
			
			/************************************/
			//$fecha_movil = fechas_bd($fecha_movil);
			//echo "<br> fecha_movil : ".$fecha_movil;
			
			//validar que el dia no sea sab, dom ni fest
			
			  //validar si es sab o dom
			 $aFecha = explode("-",$fecha_movil);
			 $num = date("w", mktime(0, 0, 0, $aFecha[1],$aFecha[2], $aFecha[0]));
			 //echo "<br>num ".$num ;
			 if (($num!=6)&&($num!=0))
			 {
				 //validar si es festivo
				/* $query= "SELECT count(*)  as cantidad 
							FROM  no_habil 
							WHERE no_habil ='$fecha_movil' ";
				 $result= cms_query($query)or die (error($query_a,mysql_error(),$php));
				 
				 list($cantidad) = mysql_fetch_row($result);
				*/
				  if(!in_array($fecha_movil, $arreglo_no_habil) ){
					$dias ++;
					//echo "<br>dias:".$dias."  fecha_inicio : ".$fecha_inicio;
				 }
			}
			/************************************/
			}else{
			$dias= "-";
			$fecha_movil=$fecha_termino;
			}
		
		}
		/*if ($dias == 0){
			$dias = 1;
		}*/
		// $date = date(Y)."-".date(m)."-".date(d);
		
	   
		if (($sumando==1)and($dias<=21)){
			//$dias++;
		}
		
		
		return ($dias * $sumando);
		
		}
		
	 }
		
}
	
	
}

//FIN CORP  


function elimina_ultimo_caracter($texto){

$texto = substr ($texto, 0, strlen($texto) - 1);

return $texto;
}





function cuadro_verde($texto){

$texto = "<div class=\"alert alert-success\">
<div>$texto</div></div>";

return $texto;

}

function cuadro_amarillo($texto){

$texto = "<div class=\"alert alert-block\">
<div>$texto</div></div>";

return $texto;

}

function cuadro_rojo($texto){
$texto = "<div class=\"alert alert-error\">
<div>$texto</div></div>";

return $texto;

}
function cuadro_alerta($texto){
$texto = "<br><table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"tabla_alerta\">
                   
							$texto  
					 </table>";

return $texto;

}

function contenido_noticia($id_noticia){

  
	if(!is_numeric($id_noticia)){
	
	$id_contenido = texto_to_id_noticia($id_noticia);
	}


        $query = "SELECT contenido
          FROM noticias 
          WHERE id_noticia='$id_contenido'";
		
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
        list($contenido) = mysql_fetch_row($result);
	
	//$contenido= str_replace("<br />","",$contenido);
	//$contenido = htmlentities($contenido);
	$contenido = nl2br($contenido);	  
	return $contenido;
   }

   
   function extrae_xml_de_url($url){

$fp=fopen("$url","r");



while ($linea=fgets($fp,1024))
      {
	$xmlstr .=$linea; 
	
	
	//echo $linea."<br>";
		}

return $xmlstr;
 
}
	



function verifica_xml($xml){

	//echo $xml_sgs ;
	//$xml = false;
	$comilla = " \ ";
	$comilla = trim($comilla);
	$comilla .= "\"";
	
	$xml = str_replace($comilla,"",$xml);
	$xml = str_replace($comilla,"",$xml);
	$xml = str_replace($comilla,"",$xml);
	$text = "<?xml version=1.0 encoding=utf-8?>";
	$xml = str_replace($text,"",$xml);
	//$xml = false;
	$xml = @simplexml_load_string($xml);
	if($xml){
		return true;
	}else{
		return false;
	}


}
	
	
		 
function url($url)//Se le pasa la url 
{ 
$fp=@fopen($url,"r");//Utilizamos fopen para abrir esa url 

 if($fp){//Si fopen abre la url 

     return true; 

 }else{//si no devuelve false 

     return false; 
 } 

@fclose($fp);//Cerramos la conexion 
}


function busca_texto($texto,$palabra){
//$palabra=preg_quote('<id_entidad>94</id_entidad>'); 
		if($palabra!="" and $texto!=""){
		if(eregi($palabra,$texto)) { 
    			return true;
		} else { 
			    return false;
		}
		}
		
}

 
function getmicrotime(){
	$micro = microtime();
	$micro = explode(" ",$micro);
	$micro = $micro[1] + $micro[0];
return ($micro);
}





function crea_tabla_tiny($texto){

$paginas =configuracion_cms('registros_por_pagina');

$texto = "


	
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >
	<tr><td align=\"left\" class=\"textos\">
	<div id=\"tableheader\" align=\"left\" >
        	<div class=\"search\" >Buscar por:
                <select id=\"columns\" onchange=\"sorter.search('query')\"></select>
                <input type=\"text\" id=\"query\" onkeyup=\"sorter.search('query')\" />
            </div>
           
        </div><br>
	 </td></tr> 
  <tr>
    <td align=\"left\"><!-- Cabecera -->
	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"left\">
     
      <tr>
        <td align=\"left\" class=\"textos\">
		<div id=\"tablewrapper\" align=\"left\">
		
		 <div id=\"tablefooter\" align=\"left\">
          <div id=\"tablenav\" align=\"left\">
            	
			<div align=\"left\">
                    <img src=\"js/tinytable/images/first.gif\" width=\"16\" height=\"16\" alt=\"First Page\" onclick=\"sorter.move(-1,true)\" />
                    <img src=\"js/tinytable/images/previous.gif\" width=\"16\" height=\"16\" alt=\"First Page\" onclick=\"sorter.move(-1)\" />
                    <img src=\"js/tinytable/images/next.gif\" width=\"16\" height=\"16\" alt=\"First Page\" onclick=\"sorter.move(1)\" />
                    <img src=\"js/tinytable/images/last.gif\" width=\"16\" height=\"16\" alt=\"Last Page\" onclick=\"sorter.move(1,true)\" />
                </div>
                <!--
                <div>
                	<a href=\"javascript:sorter.showall()\">Ver todo</a>
                </div>
				-->
            </div>
			
        </div>
    </div>
		</td>
        <td align=\"right\"  class=\"tinytable\">
		
		
            	
               P&aacute;gina <span id=\"currentpage\"></span>&nbsp; de <span id=\"totalpages\"> </span>
            
			</td>
      </tr>
    </table>
	
	</td>
  </tr>
  <tr>
    <td>
	<!-- Datos -->
	
	$texto
	
	</td>
  </tr>
  

  
  
  
  
  
  
  
    <tr>
    <td align=\"left\"><!-- Cabecera -->
	
	
	</td>
  </tr>
  <tr>
    <td >
	<!-- Footer -->
	&nbsp;
	<span class=\"tinytable\"  align=\"center\" >
				<div align=\"center\" >Registros <span id=\"startrecord\"></span>-<span id=\"endrecord\"></span>&nbsp; de <span id=\"totalrecords\"></span> </div>
        		<!-- <div><a href=\"javascript:sorter.reset()\">reset</a></div>-->
        	</span>
			</td>
  </tr>
</table>
	
	 
                                                             

	
		<script type=\"text/javascript\" src=\"js/tinytable/script.js\"></script>

  	<script type=\"text/javascript\">
	var sorter = new TINY.table.sorter('sorter','table1',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:$paginas,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		//pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:1,
		sortdir:1,
		//sum:[0],
		//avg:[6,7,8,9],
		columns:[{index:7, format:'%', decimals:1},{index:8, format:'$', decimals:0}],
		init:true
	});
  </script>";

return $texto;

}

function rescata_datos_url($url){
   // create curl resource 
        $ch = curl_init(); 
        // set url 
        @curl_setopt($ch, CURLOPT_URL, "http://sgs.probidadytransparencia.gob.cl/tablag.php?tabla=acciones"); 
        //return the transfer as a string 
       @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
       $output = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch);  
	if($output==""){
		echo "error";
	}
	
		return $output;
}

function version(){
  $query= "SELECT  valor 
			FROM cms_configuracion 
			WHERE configuracion LIKE 'version' ";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if(!list($version) = mysql_fetch_row($result)){
	 	$version="No identificada";
	 
	 }else{
	 $version = str_replace("<a href=\"index.php?accion=licencia\">","",$version);
	 $version = str_replace("</a>","",$version);
	 }
return $version;
}
	  


function info_base($DATABASE){

 $tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) ){
		$tablas_actuales++;
		$tabla = $line[0];
		
		    $sql = "DESCRIBE $tabla";
  			$qry = cms_query($sql)or die (error($query,mysql_error(),$php));
   			$num_campos= mysql_num_fields($qry);
			$tot_campos = $tot_campos+$num_campos;
		
			}	
		
		
		$info_bd ="  <table width=\"50%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro\">
                       <tr >
                         <td class=\"textos\"  align=\"left\">Cantidad de tablas <strong>$tablas_actuales</strong></td>
                         </tr>
						 <tr><td class=\"textos\"  align=\"left\">Campos totales de la base <strong>$tot_campos</strong></td></tr> 
                   	</table>";
			
	return $info_bd;

}


function alter($tabla,$campo,$tipo){

switch ($tipo) {
     case 'int':
         $create ="ALTER TABLE $tabla ADD $campo INT NULL ";
         break;
	 case 'date':
         $create ="ALTER TABLE $tabla ADD $campo date NOT NULL default '0000-00-00' ";
         break;
     case 'string':
         $create ="ALTER TABLE $tabla ADD $campo varchar(255) NOT NULL ";
         break;
	 case 'blob':
         $create ="ALTER TABLE $tabla ADD $campo TEXT NOT NULL ";
         break;

   	default:
	 $create ="ALTER TABLE $tabla ADD $campo varchar(255) NOT NULL ";
       
 }
 
 return $create;

}

function cms_replace($template,$template_historial,$contenido){
	
	$contenido = str_replace("<!--$template-->","$template",$contenido);
	
	if($_GET['tp']!="4"){
		return str_replace($template,$template_historial,$contenido);
	}else{
		return $contenido;	
	}
		
		
}

function elimina_acentos($cadena){   
	$a = array('√?','√Å','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√ç','√?','√è','√ê','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√ù','√?','√ ','√°','√¢','√£','√§','√•','√¶','√ß','√®','√©','√™','√´','√¨','√≠','√Æ','√Ø','√±','√≤','√≥','√¥','√µ','√∂','√∏','√π','√∫','√ª','√º','√Ω','√ø','ƒ?','ƒÅ','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒç','ƒ?','ƒè','ƒê','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒù','ƒ?','ƒ?','ƒ ','ƒ°','ƒ¢','ƒ£','ƒ§','ƒ•','ƒ¶','ƒß','ƒ®','ƒ©','ƒ™','ƒ´','ƒ¨','ƒ≠','ƒÆ','ƒØ','ƒ∞','ƒ±','ƒ≤','ƒ≥','ƒ¥','ƒµ','ƒ∂','ƒ∑','ƒπ','ƒ∫','ƒª','ƒº','ƒΩ','ƒæ','ƒø','≈?','≈Å','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈ç','≈?','≈è','≈ê','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈ù','≈?','≈?','≈ ','≈°','≈¢','≈£','≈§','≈•','≈¶','≈ß','≈®','≈©','≈™','≈´','≈¨','≈≠','≈Æ','≈Ø','≈∞','≈±','≈≤','≈≥','≈¥','≈µ','≈∂','≈∑','≈∏','≈π','≈∫','≈ª','≈º','≈Ω','≈æ','≈ø','∆?','∆ ','∆°','∆Ø','∆∞','«∫','«ª','«º','«Ω','«æ','«ø');  
    $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','A','a','AE','ae','O','o');  
  
    
    return str_replace($a, $b, $cadena);  

}

function friendlyURL($string){
 	
	$a = array('√?','√Å','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√ç','√?','√è','√ê','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√?','√ù','√?','√ ','√°','√¢','√£','√§','√•','√¶','√ß','√®','√©','√™','√´','√¨','√≠','√Æ','√Ø','√±','√≤','√≥','√¥','√µ','√∂','√∏','√π','√∫','√ª','√º','√Ω','√ø','ƒ?','ƒÅ','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒç','ƒ?','ƒè','ƒê','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒ?','ƒù','ƒ?','ƒ?','ƒ ','ƒ°','ƒ¢','ƒ£','ƒ§','ƒ•','ƒ¶','ƒß','ƒ®','ƒ©','ƒ™','ƒ´','ƒ¨','ƒ≠','ƒÆ','ƒØ','ƒ∞','ƒ±','ƒ≤','ƒ≥','ƒ¥','ƒµ','ƒ∂','ƒ∑','ƒπ','ƒ∫','ƒª','ƒº','ƒΩ','ƒæ','ƒø','≈?','≈Å','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈ç','≈?','≈è','≈ê','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈?','≈ù','≈?','≈?','≈ ','≈°','≈¢','≈£','≈§','≈•','≈¶','≈ß','≈®','≈©','≈™','≈´','≈¨','≈≠','≈Æ','≈Ø','≈∞','≈±','≈≤','≈≥','≈¥','≈µ','≈∂','≈∑','≈∏','≈π','≈∫','≈ª','≈º','≈Ω','≈æ','≈ø','∆?','∆ ','∆°','∆Ø','∆∞','«∫','«ª','«º','«Ω','«æ','«ø');  
    $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','A','a','AE','ae','O','o');  
  	$string = str_replace($a, $b, $string); 

	$string = preg_replace("`\[.*\]`U","",$string);
	$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
	$string = htmlentities($string, ENT_COMPAT, 'utf-8');
	$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
	$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
	
	$string = str_replace("-acute","",$string);
	$string = str_replace("-uml","",$string);
	$string = str_replace("-circ","",$string);
	$string = str_replace("-grave","",$string);
	$string = str_replace("-ring","",$string);
	$string = str_replace("-ring","",$string);
	$string = str_replace("-cedil","",$string);
	$string = str_replace("-slash","",$string);
	$string = str_replace("-tilde","",$string);
	$string = str_replace("-caron","",$string);
	$string = str_replace("-lig","",$string);
	$string = str_replace("-quot","",$string);
	$string = str_replace("-rsquo","",$string);
	$string = str_replace("-amp","",$string);
	$string = str_replace("-iexcl","",$string);
	$string = str_replace("-not","",$string);
	$string = str_replace("-deg","",$string);
	
	
	return strtolower(trim($string, '-'));
}
function calculaDiasHabilesEntreFechasGestion($fecha_inicio,$fecha_termino){

$aux=explode("-", $fecha_inicio);
$aux1=explode("-", $fecha_termino);




if($fecha_termino!="0000-00-00" or $fecha_termino!="00-00-0000" ){
//echo "dsfsdfdsf $fecha_termino<br>";
//calcula la cantidad de dias habiles entre dos fechas
	//echo "$fecha_inicio,$fecha_termino <BR>";
	//or $aux[2]>2007 or $aux1[2]>2007
	
		$aux=explode("-", $fecha_inicio);
		$anio1    = trim($aux[0]);
		
		$aux=explode("-", $fecha_termino);
		$anio2    = trim($aux[0]);
		
		if($anio1>2007 and $anio2>2007){
		if(strlen($anio1)==4 and strlen($anio2)==4){
		$dias = 0;
		$fecha_movil = $fecha_inicio;
		if ($fecha_termino >= $fecha_movil){
			$sumando = 1;	
			
		}
		else{
			$sumando = -1;
			//echo "sdfsdf rrrr <br>";
		}
		
		//echo "<br>sumando :".$sumando;
		
		//echo "<br> fx fecha_movil: ".$fecha_movil;
		//echo "<br>cantidad_dias: ".$dias;
		while ($fecha_movil != $fecha_termino and $fecha_termino!="0000-00-00" ){
		
		$cont_f++;
			//en algunas versiones de php el calculo de diferencias de dias produce un loop por esto se 
			//desarrollo este parche que verifica la cantidad de dias sumados no se mayor  400
			if($cont_f<400){
			
			$fecha_movil = suma_fechas(fechas_html($fecha_movil),$sumando);
			
			/************************************/
			//$fecha_movil = fechas_bd($fecha_movil);
			//echo "<br> fecha_movil : ".$fecha_movil;
			
			//validar que el dia no sea sab, dom ni fest
			
			  //validar si es sab o dom
			 $aFecha = explode("-",$fecha_movil);
			 $num = date("w", mktime(0, 0, 0, $aFecha[1],$aFecha[2], $aFecha[0]));
			 //echo "<br>num ".$num ;
			 if (($num!=6)&&($num!=0))
			 {
				 //validar si es festivo
				 $query= "SELECT count(*)  as cantidad 
							FROM  no_habil 
							WHERE no_habil ='$fecha_movil' ";
				 $result= cms_query($query)or die (error($query_a,mysql_error(),$php));
				 
				 list($cantidad) = mysql_fetch_row($result);
				 /*if($cantidad>0){
				 	echo "<br>cons: ".$query;
				 	echo "<br>******* feriado fecha_inicio : ".$fecha_inicio;
				 }
				 */
				 if(($cantidad==0)){
					$dias ++;
					//echo "<br>dias:".$dias."  fecha_inicio : ".$fecha_inicio;
				 }
			}
			/************************************/
			}else{
			$dias= "-";
			$fecha_movil=$fecha_termino;
			}
		
		}
		if ($dias == 0){
			//$dias = 1;
		}
		return ($dias * $sumando);
		}
		
		}
		
}
	
	
}


function verifica_campos_obligatorios($tabla){


    $query= "SELECT id_auto_admin
           FROM  auto_admin
           WHERE tabla='$tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_auto_admin) = mysql_fetch_row($result);
	 $valido = true;
	     $query= "SELECT campo 
                FROM  auto_admin_campo
                WHERE id_auto_admin='$id_auto_admin' and obligatorio=1";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           while (list($campo) = mysql_fetch_row($result)){
     				
					if($_POST[$campo]==""){
						$valido=false;
					}
							   
     		 }
	 
return $valido;
}




function radio_tabla($tabla,$id_campo_selecionado,$nombre_campo_id,$nombre_campo_texto,$js_sel,$clase){

crear_campo_orden($tabla);



    $query= "SELECT id_auto_admin
           FROM  auto_admin
           WHERE tabla='$tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_auto_admin) = mysql_fetch_row($result);
	 $valido = true;
	     $query= "SELECT campo 
                FROM  auto_admin_campo
                WHERE id_auto_admin='$id_auto_admin' and txt=1";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($campo) = mysql_fetch_row($result);



$query= "SELECT  $nombre_campo_id ,$campo     
	           FROM  $tabla
	           ORDER BY orden";
    $result= cms_query($query)or die ("ERROR function select_tabla <br>$query");
	      while (list($id_campo_bd,$contenido_campo_txt_bd) = mysql_fetch_row($result)){
	
				$contenido_campo_txt_bd= $contenido_campo_txt_bd;
      	
	      	if($id_campo_selecionado==$id_campo_bd){
	      		
	      	  $lista_radio .="<input type=\"radio\" class=\"$clase\" name=\"$nombre_campo_texto\" value=\"$id_campo_bd\" checked $js_sel> $contenido_campo_txt_bd\n";
	      	}else{
	      		$lista_radio .="<input type=\"radio\" class=\"$clase\" name=\"$nombre_campo_texto\" value=\"$id_campo_bd\" $js_sel> $contenido_campo_txt_bd\n";
      	}
							   
	  }

	return $lista_radio; 
		 
}


function checkbox_tabla($tabla,$id_campo_selecionado,$nombre_campo_id,$nombre_campo_texto,$js_sel,$clase){

crear_campo_orden($tabla);

    $query= "SELECT id_auto_admin
           FROM  auto_admin
           WHERE tabla='$tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_auto_admin) = mysql_fetch_row($result);
	 $valido = true;
	     $query= "SELECT campo 
                FROM  auto_admin_campo
                WHERE id_auto_admin='$id_auto_admin' and txt=1";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($campo) = mysql_fetch_row($result);


$query= "SELECT  $nombre_campo_id ,$campo    
	           FROM  $tabla
	           ORDER BY orden";
    $result= cms_query($query)or die ("ERROR function select_tabla <br>$query");
	      while (list($id_campo_bd,$contenido_campo_txt_bd) = mysql_fetch_row($result)){
	
				$contenido_campo_txt_bd= $contenido_campo_txt_bd;
      		 
			 
			 $aux=explode(",", $id_campo_selecionado);
		
	      	if(in_array($aux,$id_campo_bd)){
	      		
	      	  $lista_checkbox .="<input type=\"checkbox\" class=\"$clase\" name=\"$nombre_campo_texto"."_$id_campo_bd"."\" checked $js_sel> $contenido_campo_txt_bd\n";
	      	}else{
	      	  $lista_checkbox .="<input type=\"checkbox\" class=\"$clase\" name=\"$nombre_campo_texto"."_$id_campo_bd"."\"  $js_sel> $contenido_campo_txt_bd\n";
      	}
							   
	  }

	return $lista_checkbox; 
		 
}
//FIN CORP  


function ver_datos($sql){

if(cms_query($sql)){
					
					$result_q= cms_query($sql)or die ("ERROR $php <br>$query");
        			$num_filas = mysql_num_fields($result_q);
					$tot_resultado = mysql_num_rows($result_q);
					$datos_tabla = "<tr><td colspan=\"2\" align=\"center\" class=\"textos\"> Total de registros $tot_resultado</td></tr> ";
        			while ($resultado = mysql_fetch_row($result_q)){
					$cont++;
					$datos_tabla .="<tr><td colspan=\"2\" align=\"center\" class=\"textos\"><strong>Registro $cont</strong> </td></tr> ";
					
					for ($i = 0; $i < $num_filas; $i++){
        
        			$nom_campo = mysql_field_name($result_q,$i);
        			$nom_campo .=$agregar_nombre_campo;
        			$valor = $resultado[$i];
        			$$nom_campo = $valor;
        			$datos_tabla .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"><td align=\"left\" class=\"textos\">$nom_campo : </td> <td align=\"left\" class=\"textos\">$valor</td> </tr>";
        			}
					
					
					}
        			
						
						
		$ficha = "
					    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" >
                          
                            $datos_tabla
                          
                      	</table>";


}
return $ficha;
}

function formato_rut( $rut ){

$rut = str_replace(".","",$rut);
		$rut = str_replace("-","",$rut);
		$dig = substr ($rut, strlen($rut)- 1, strlen($rut) );
		$rut = number_format( elimina_ultimo_caracter($rut), 0, "", ".");

		$rut = $rut."-".$dig;
	
	return $rut;
}


function cms_utf8_decode($texto){
	return $text;
}


function getMetaKeywords($text) {
	$text = strip_tags($text);
	$text = strtolower($text);
	$text = trim($text);
	$text = preg_replace('/[^a-zA-Z0-9 -]/', ' ', $text);

	$match = explode(" ", $text);
	$count = array();
	if (is_array($match)) {
		foreach ($match as $key => $val) {
			if (strlen($val) > 3) {
				if (isset($count[$val])) {
					$count[$val]++;
				} else {
					$count[$val] = 1;
				}
			}
		}
	}
	arsort($count);
	$count = array_slice($count, 0, 10);
	return implode(", ", array_keys($count));
}
function getMetaDescription($text) {
        $text = eregi_replace("[\n|\r|\n\r]", '', $text);
	$text = strip_tags($text);
	$text = trim($text);
	$text = substr($text, 0, 247);
	return $text."...";
}
function getVariable($vparam, $vdefault) {
	$result = $vdefault;
	if (isset($vparam)) {
  		$result = (get_magic_quotes_gpc()) ? $vparam : addslashes($vparam);
	}
	return $result;
}

function check_email_address($email) 
{
	// Primero, checamos que solo haya un símbolo @, y que los largos sean correctos
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) 
	{
		// correo inválido por número incorrecto de caracteres en una parte, o número incorrecto de símbolos @
    return false;
  }
  // se divide en partes para hacerlo más sencillo
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) 
	{
    if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) 
		{
      return false;
    }
  } 
  // se revisa si el dominio es una IP. Si no, debe ser un nombre de dominio válido
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
	{ 
     $domain_array = explode(".", $email_array[1]);
     if (sizeof($domain_array) < 2) 
		 {
        return false; // No son suficientes partes o secciones para se un dominio
     }
     for ($i = 0; $i < sizeof($domain_array); $i++) 
		 {
        if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) 
				{
           return false;
        }
     }
  }
  return true;
}

function cuadro_informacion($texto){
	$texto = "<div class=\"alert alert-info\">
				$texto
			</div>";

	return $texto;
}

function genera_alerta($texto,$tipo='information',$posicion='top',$tiempo=10000,$nombre = 'top'){
	/*Es necesario cargar
	 <script type="text/javascript" src="{URL_SERVIDOR}/js/noty/js/noty/jquery.noty.js"></script>
	 <script type="text/javascript" src="{URL_SERVIDOR}/js/noty/js/noty/themes/default.js"></script>
	
	
	*/
	
	
			return "<script type=\"text/javascript\">
  
				function generate(layout,tipo) {
				      var n = noty({
					      text: layout,
					      type: tipo,
						  dismissQueue: true,
					      layout: 'top',
					      theme: 'default'
				      });
				      //console.log('html: '+n.options.id);
				}
			      
				
				$(document).ready(function() {
				      
							
					       generate('$texto','$tipo');
				 
				 
				 	});
					
					
					
				 ;(function($) {

						$.noty.layouts.top = {
							name: '$nombres',
							options: {},
							container: {
								object: '<ul id=\"noty_top_layout_container\" />',
								selector: 'ul#noty_top_layout_container',
								style: function() {
									$(this).css({
										top: 0,
										left: '5%',
										position: 'fixed',
										width: '90%',
										height: 'auto',
										margin: 0,
										padding: 0,
										listStyleType: 'none',
										zIndex: 9999999
									});
								}
							},
							parent: {
								object: '<li />',
								selector: 'li',
								css: {}
							},
							css: {
								display: 'none'
							},
							addClass: ''
						};
					
					})(jQuery);
				 
				      
			
				setTimeout(function() {
					$.noty.closeAll();
				      }, $tiempo);
					  
					  
					  
					  
				</script>";	
				
			}
			
function mysql_to_json($tabla,$condicion=''){
    
    $return_arr = Array();

        $query = mysql_real_escape_string("SELECT * FROM $tabla where 1 $condicion");
        $result = mysql_query($query); 
        
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            array_push($return_arr,$row);
        }
return json_encode($return_arr); 
}


?>