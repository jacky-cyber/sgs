<?php
ini_set("memory_limit","30M");

$nom_tabla = $_GET['tbl'];						//pasa por get la tabla tbl de las acciones (tbl es la tabla que elijo)
$formulario = $_POST['formulario'];
$id_auto_admin = $_GET['id_auto_admin'];	
$tabla_relacion = $_POST['tabla_relacion'];
$boton_ok = $_POST['boton_ok'];
$form_activo = $_POST['form_activo'];
$help = $_POST['help'];





switch ($act) {
     case 1:
	     include ("admin/admin_auto/insertar.php");	
	
	     	
         break;
	 case 2:
	 	 $del = $_GET['del'];						//pasan el del por get
         include ("admin/admin_auto/borrar.php");
         break;
    case 3:
	
	     include ("admin/admin_auto/actualizar.php");
         break; 
            
   case 4:		
   		 //include ("admin/admin_auto/proc/consulta_form.php");
   		
	     include ("admin/admin_auto/form/add_formulario.php");
	  $accion_form = "index.php?accion=$accion&act=4&tbl=$nom_tabla&id_auto_admin=$id_auto_admin";
	 
         break; 
    case 5:
   		 
	     include ("admin/admin_auto/proc/actualizar_form.php");
         break; 
   case 6:
   		 
	     include ("admin/admin_auto/proc/lista.php");
         break; 
    case 7:
   		 
	     include ("admin/admin_auto/extrae_tabla.php");
         break; 
 
  
   case 8:
   		   
	     include ("admin/admin_auto/compara_bases.php");
         break; 
  case 9:
   		 
	     include ("admin/admin_auto/compara_tablas.php");
         break; 
 case 10:
   		 
	     include ("admin/admin_auto/alter_add_tabla.php");
         break; 
 
   case 11:
   		 
	     include ("admin/admin_auto/alter_drop_tabla.php");
         break; 
 
  case 12:
   		 
	     include ("admin/admin_auto/pregunta_create_tabla.php");
         break; 
 
  case 13:
   		 $bdo = $_GET['bdo'];
		 $bdd = $_GET['bdd'];
		 $bd = $_GET['bd'];
		 $tabla = $_GET['tabla'];
		 
	    // include ("admin/admin_auto/create_tabla.php");
		
		$sql= extrae_estructura($tabla,$bdo);
		//echo $sql."<br>";
		
		$sql = str_replace("$bdo.","$bdd.",$sql);
		$sql = str_replace(";","",$sql);
		
		//echo $sql." ";

        cms_query($sql) or die (mysql_error());
		echo  "<script>alert('Estructura de tabla creada $tabla'); document.location.href='index.php?accion=$accion&act=8&bd=$bd'; </script>\n";

         break; 
 case 14:
 
         $bdo = $_GET['bdo'];
		 $bdd = $_GET['bdd'];
		 $bd = $_GET['bd'];
		 $tabla = $_GET['tabla'];
		 
		
		$sql= extrae_estructura($tabla,$bdo);
		
		$sql = str_replace($bdo,$bdd,$sql);
		$sql = str_replace(";","",$sql);
		
		//echo $sql;

        @cms_query($sql) or die (error($sql,mysql_error(),$php));
		
		
		//$inserts = extrae_datos_tabla($tabla,$condicion,$bdo) ;
		  $results = cms_query('SELECT * FROM ' .  $bdo.".".$tabla.$condicion); 
							   
						       while ($row = @mysql_fetch_assoc($results)) {             
								 $datos .= 'INSERT INTO ' .  $bdd.".".$tabla .' ('; 
					             $data = Array();            
								 
								  while (list($key, $value) = @each($row)) {
								  
								  $data['keys'][] = $key; 
								  $data['values'][] = addslashes($value); 
								  }             
								  
								  $datos .= join($data['keys'], ', ') . ') VALUES (\'' . join($data['values'], '\', \'') . '\');' ;         
								  
								    
                                  
								     if(cms_query($datos)){
									 	$cont_insert++;
								   //	echo "sql ejecutado";
								   }else{
								   //	echo "<font color=\"#FF0000\"> sql ejecutado no $datos</font><br>";
								   }
								  
								  
								  $datos="";
								  }          
								 
		
		echo  "<script>alert('$cont_insert Datos creados '); document.location.href='index.php?accion=$accion&act=8&bd=$bd'; </script>\n";
				  
         break; 
  case 15:
   		 
	   
         $bdo = $_GET['bdo'];
		 $bdd = $_GET['bdd'];
		 $bd = $_GET['bd'];
		 $tabla = $_GET['tabla'];
		 
		 
		 
		 if($_GET['axj']==1){
$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                <tr>
                  <td align=\"center\" colspan=\"2\" class=\"textos\">¿Est&aacute; seguro de realizar el cambio en $tabla?</td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">
					<a href=\"index.php?accion=$accion&act=$act&tbl=$tabla&tabla=$tabla&bdd=$bdd&bdo=$bdo&bd=$bd\">SI</a> </td>
				<td align=\"center\" class=\"textos\">
					<a href=\"index.php?accion=$accion&act=9&tbl=$tabla&bd=$bd\">NO</a></td> </tr> 
              </table>";

		}else{
		 
  				$qry = cms_query('SELECT * FROM ' .  $bdo.".".$tabla.$condicion); 
  				//$qry = cms_query($sql);
   				$num_filas = mysql_num_fields($qry);		 		
   				$num_registro2 = mysql_num_rows($qry);		 		

 				for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
   					//y luego va sacando los datos que hay en cada campo
					$flag      = mysql_field_flags($qry,$i);
					$var_pk = substr_count($flag, "auto_increment");
					//echo $var_pk;
	  				if($var_pk!=0){
					  $nom_campo_pk = mysql_field_name($qry,$i);	
					  $num_var = $i;
					  //echo "pk $nom_campo_pk $num_var";	
					}
	  				
	 
				}
		
		  $results = cms_query('SELECT * FROM ' .  $bdo.".".$tabla.$condicion); 
							   
						$datos_fila = mysql_num_fields($results);			   
							   
						       while ($row = @mysql_fetch_assoc($results)) {             
								 $datos .= 'INSERT INTO ' .  $bdd.".".$tabla .' ('; 
								
					             $data = Array();            
								 // echo $row[$campo][0]."<br>";
								  while (list($key, $value) = @each($row)) {
								  $i++;
								  
								  $data['keys'][] = $key; 
								  
								  $data['values'][] = addslashes($value); 
								 
								  $campo=$key;
								   
								 if($nom_campo_pk==$key){
								 	 $data['values'][$num_var] ="null";
								 	}
								  }            
								  
								  $datos .= join($data['keys'], ', ') . ') VALUES (\'' . join($data['values'], '\', \'') . '\');' ;         
								  // echo $datos."<br>";
								
								 // echo $datos."<br>";
								   if(cms_query($datos)){
								   //	echo "sql ejecutado";
								   }else{
								   //	echo "<font color=\"#FF0000\"> sql ejecutado no $datos</font><br>";
								   }
								   $datos="";
								  }          
								 
		
		echo  "<script>alert('$cont_insert Datos creados '); document.location.href='index.php?accion=$accion&act=9&tbl=$tabla&bd=$bd'; </script>\n";
		
		
		}
			
		
         break; 
 
  case 16:
   		 
	    $bdo = $_GET['bdo'];
		 $bdd = $_GET['bdd'];
		 $bd = $_GET['bd'];
		 $tabla = $_GET['tabla'];
		 
		 
		 
		 if($_GET['axj']==1){
$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                <tr>
                  <td align=\"center\" colspan=\"2\" class=\"textos\">¿Est&aacute; seguro de realizar el cambio en $tabla?</td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">
					<a href=\"index.php?accion=$accion&act=$act&tbl=$tabla&tabla=$tabla&bdd=$bdd&bdo=$bdo&bd=$bd\">SI</a> </td>
				<td align=\"center\" class=\"textos\">
					<a href=\"index.php?accion=$accion&act=9&tbl=$tabla&bd=$bd\">NO</a></td> </tr> 
              </table>";

		}else{
		 
		 
         $qry="truncate table $bdd.$tabla";
                       
         $result_insert=cms_query($qry) or die("$MSG_DIE $php - QR-Problemas al insertar $qry");
	    $qry="ALTER TABLE $bdd.$tabla AUTO_INCREMENT=1 ";
                       
         $result_insert=cms_query($qry) or die("$MSG_DIE $php - QR-Problemas al insertar $qry");
	    
		
		// include ("admin/admin_auto/create_tabla.php");
		
		//$sql= extrae_estructura($tabla,$bdo);
		
		//$sql = str_replace($bdo,$bdd,$sql);
		//$sql = str_replace(";","",$sql);
		
		//echo $sql;

//        @cms_query($sql) or die (error($sql,mysql_error(),$php));
		
		//$inserts = extrae_datos_tabla($tabla,$condicion,$bdo) ;
		  $results = cms_query('SELECT * FROM ' .  $bdo.".".$tabla.$condicion); 
							   
						       while ($row = @mysql_fetch_assoc($results)) {             
								 $datos .= 'INSERT INTO ' .  $bdd.".".$tabla .' ('; 
					             $data = Array();            
								 
								  while (list($key, $value) = @each($row)) {
								  
								  $data['keys'][] = $key; 
								  $data['values'][] = addslashes($value); 
								  }             
								  
								  $datos .= join($data['keys'], ', ') . ') VALUES (\'' . join($data['values'], '\', \'') . '\');' ;         
								  
								   //  echo $datos."<br>"; 
                                   
								     if(cms_query($datos)){
								   //	echo "sql ejecutado";
								   	$cont_insert++;
								   }else{
								   	//echo "<font color=\"#FF0000\"> sql ejecutado no $datos</font><br>";
								   }
								   
								  
								  
								  $datos="";
								  }          
								 
		
		echo  "<script>alert('$cont_insert Datos creados'); document.location.href='index.php?accion=$accion&act=9&tbl=$tabla&bd=$bd'; </script>\n";
		
		
		}
			
		
		
         break; 
 
  case 17:
   		 
	     include ("admin/admin_auto/migracion_tabla_distinta.php");
         break; 
	  case 18:
   		 
	     include ("admin/admin_auto/migracion_campos_tabla_distinta.php");
         break; 
     case 19:
   		 
	     include ("admin/admin_auto/control_version.php");
         break; 

   	default:
   		 
	 include ("admin/admin_auto/lista_tablas.php");
	 
	 	$contenido .=  "
		
		<div class=\"well\">
			<a class=\"btn btn-primary\" href=\"index.php?accion=$accion&act=8\"><i class=\"icon-random icon-white\"></i> Comparar una base de datos</a>
			<div class=\"derecha\"><a class=\"btn btn-success\" href=\"index.php?accion=$accion&act=6\"><i class=\"icon-plus icon-white\"></i> Agregar Configuraci&oacute;n</a></div>
		</div>
			
		
	
			
		$lista_tabla
			
		
		";
	 
	
	 	
       
 }


//$contenido = cambio_texto($contenido);

 
 

function  existe_en_los_dos($array1, $array2){
//busca los datos que existan en los dos arreglos
//devuelve un arreglo con los datos existentes


//echo "Elementos que existen en las 2 arrays<br>\n";
foreach ($array1 as $value1) {
    foreach ($array2 as $value2) {
        if ($value1 == $value2){
             //  echo "---> $value1<br>\n";
        }
    }
}

}



function solo_en_arreglo1($array1,$array2){
global $accion;
//echo "<br>\nElementos que sólo existen en array1<br>\n";
foreach ($array1 as $value1) {
    $encontrado=false;
    foreach ($array2 as $value2) {
        if ($value1 == $value2){
            $encontrado=true;
            $break;
        }
    }
    if ($encontrado == false){
          $lista_tablas1 .="<tr><td align=\"left\" class=\"textos\">
		  <a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=12&axj=1','contenido_tabla');\">$value1</a> </td></tr> " ;
    }
}
return $lista_tablas1;
}



function solo_en_arreglo2($array1,$array2){
global $accion;
//echo "<br>\nElementos que sólo existen en array2<br>\n";
foreach ($array2 as $value2) {
    $encontrado=false;
    foreach ($array1 as $value1) {
        if ($value1 == $value2){
            $encontrado=true;
            $break;
        }
    }
    if ($encontrado == false){
          $lista_tablas2 .="<tr><td align=\"left\" class=\"textos\"><a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=12&axj=1','contenido_tabla');\">$value2</a> </td></tr> ";
    }
}
return $lista_tablas2;
}
 
 

function extrae_estructura($tabla ,$BASEDATOS){
 $results = cms_query('DESCRIBE ' .  $BASEDATOS.".".$tabla); 
		         $create .='CREATE TABLE IF NOT EXISTS ' .  $BASEDATOS.".".$tabla . ' (' ; 
		         $tmp = '';          
			while ($row = @mysql_fetch_assoc($results)) {
			
			
             $create .= '' . $row['Field'] . ' ' . $row['Type']; 
		            if ($row['Null'] != 'YES') { $create .= ' NOT NULL'; 
					}           
					
					 if ($row['Default'] != '') { $create .= ' DEFAULT \'' . $row['Default'] . '\''; 
					 }            
					 if ($row['Extra']) { $create .= ' ' . strtoupper($row['Extra']); 
					 }           
					  if ($row['Key'] == 'PRI') { 
					  
					  $tmp_pk = 'primary key(' . $row['Field'] . ')'; 
					  //$PK = 
					  }  
					             
					  $create .= ',';         
			 } 
					   
					    if($tmp_pk!=""){
						 $create .= $tmp_pk .");\n" ; 
						}else{
						$create = elimina_ultimo_caracter($create);
						 $create .= ");\n" ; 
						}        
					  
					   
					 
					   
		return $create;
}

  function extrae_datos_tabla($tabla,$condicion,$BASEDATOS) {       
 
				   $results = cms_query('SELECT * FROM ' .  $BASEDATOS.".".$tabla.$condicion); 
							   
						       while ($row = @mysql_fetch_assoc($results)) {             
								 $datos .= 'INSERT INTO ' .  $BASEDATOS.".".$tabla .' ('; 
					             $data = Array();            
								 
								  while (list($key, $value) = @each($row)) {
								  
								  $data['keys'][] = $key; $data['values'][] = addslashes($value); 
								  }             
								  
								  $datos .= join($data['keys'], ', ') . ') VALUES (\'' . join($data['values'], '\', \'') . '\');' . lnbr;         
								  }          
								  $datos .= str_repeat(lnbr, 2);    
								   
					    
						 $datos = str_replace("lnbr","\n",$datos);
								     
									   
		    return $datos;  
		}      
     
		 
		


		
		
?>