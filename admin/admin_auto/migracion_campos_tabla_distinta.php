<?php

$tabla_destino = $_POST['tabla_destino'];
$tabla_origen = $_POST['tabla_origen'];
$bdo = $_POST['bdo'];
$bdd = $_POST['bdd'];









$sql = "SELECT * FROM $bdo.$tabla_origen";
 
  $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);		
   
  $tot_reg = mysql_num_rows($qry); 		
   
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
          $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	  $flag      = mysql_field_flags($qry,$i);
	  $largo     = mysql_field_len($qry,$i);
	  $tipo      = mysql_field_type($qry,$i);

	  $not_null     = substr_count ($flag, "not_null");
	  $auto_inc     = substr_count ($flag, "auto_increment");
	  $campo_id     = substr_count ($nom_campo, "id_");
	 
	 $var= "campo_$nom_campo";
	 $$var=1;
         
         
         /*********************************/
         
         
         
         
         $sql_des = "SELECT * FROM $bdd.$tabla_destino";
 
            $qry_des = cms_query($sql_des);
                $num_filas_des = mysql_num_fields($qry_des);		
   
                $tot_reg_des = mysql_num_rows($qry_des); 		
   
            for ($b = 0; $b < $num_filas_des; $b++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
                    $nom_campo_des = mysql_field_name($qry_des,$b);		//y luego va sacando los datos que hay en cada campo
                    $flag_des      = mysql_field_flags($qry_des,$b);
                    $largo_des     = mysql_field_len($qry_des,$b);
                    $tipo_des      = mysql_field_type($qry_des,$b);

                    $not_null_des     = substr_count ($flag_des, "not_null");
                    $auto_inc_des     = substr_count ($flag_des, "auto_increment");
                    $campo_id_des     = substr_count ($nom_campo_des, "id_");
	 
                    $var_des= $nom_campo_des."_$nom_campo";
                    $var_defecto= "valor_def_".$nom_campo_des;
                    //$$var_des=1;
                    if($_POST[$var_des]!="#" and $_POST[$var_des]!=""){
                       //echo $_POST[$var_des]."<br>";
                       $valor_campo_origen = $_POST[$var_des];
                       $lista_campos_migrar .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                                                    <td align=\"left\" class=\"textos\">$nom_campo_des </td>
                                                    <td align=\"center\" class=\"textos\"><-</td>
                                                    <td align=\"left\" class=\"textos\">$valor_campo_origen </td>
                                                  </tr> ";
                                    
                         $lista_campos_orig .="$valor_campo_origen,";
                      $lista_campos_destino .="$nom_campo_des,";
                     
                   
                    }elseif(trim($_POST[$var_defecto])!=""){
                        
                         $valor_campo_origen = $_POST[$var_defecto];
                       $lista_campos_migrar .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                                                    <td align=\"left\" class=\"textos\">$nom_campo_des </td>
                                                    <td align=\"center\" class=\"textos\"><-</td>
                                                    <td align=\"left\" class=\"textos\">$valor_campo_origen </td>
                                                  </tr> ";
                                    
                      $lista_campos_orig_2 .="$valor_campo_origen,";
                      $lista_campos_destino_2 .="$nom_campo_des,";
                      
                      $_POST[$var_defecto]="";  
                    }
                    
         
	 
            }
         
         
         
         /*********************************/
         
         
	 
	}
        
     

        
        $insert = "INSERT INTO $bdd.$tabla_destino (#campos#)  values  (#valores# #val_def#)";
        
        
       // $lista_campos_orig .=$lista_campos_orig_2;
        $lista_campos_orig_2= elimina_ultimo_caracter($lista_campos_orig_2);
        
        
        $lista_campos_destino .=$lista_campos_destino_2;
        $lista_campos_destino= elimina_ultimo_caracter($lista_campos_destino);
        
       // $lista_campos_destino = str_replace(",","','",$lista_campos_destino);
        $lista_campos_orig_2 = str_replace(",","','",$lista_campos_orig_2);
        
        
        $insert = str_replace("#campos#","$lista_campos_destino",$insert);
       if($lista_campos_orig_2!=""){
        $insert = str_replace("#val_def#",",'$lista_campos_orig_2'",$insert);
       }else{
        $insert = str_replace("#val_def#","",$insert);
       }
        
        
       $lista_campos_orig = elimina_ultimo_caracter($lista_campos_orig);
       
        $sql = "select $lista_campos_orig  FROM $bdo.$tabla_origen";
       	
        $result_q= cms_query($sql)or die ("ERROR $php <br>$sql");
        $num_filas = mysql_num_fields($result_q);
	$tot_resultado = mysql_num_rows($result_q);
	 	while ($resultado = mysql_fetch_row($result_q)){
				$cont++;
			$datos_tabla ="";			
			for ($i = 0; $i < $num_filas; $i++){
        
        			$nom_campo = mysql_field_name($result_q,$i);
        			$nom_campo .=$agregar_nombre_campo;
				
				if($_POST['utf8code']==2){
				    
				    $valor =  utf8_decode(mysql_real_escape_string(trim($resultado[$i])));
				    
				}elseif($_POST['utf8code']==1){
				    $valor =  utf8_encode(mysql_real_escape_string(trim($resultado[$i])));
				}else{
				    $valor =  mysql_real_escape_string(trim($resultado[$i]));
				}
        			
        			//$$nom_campo = $valor;
        			$datos_tabla .="'$valor',";
        		}
		
                $datos_tabla  = elimina_ultimo_caracter($datos_tabla);
                $insert_fin = str_replace("#valores#","$datos_tabla",$insert);
                
                if($_POST['insert_radio']==2){
                
                        cms_query($insert_fin) or die (cuadro_rojo (mysql_error()."<br> $insert_fin")) ;

                    
                }
                
		$lista_insert .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                <td align=\"center\" class=\"textos\">$insert_fin</td></tr> ";		
		}
       
       
       
        
 $contenido = "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                  <tr>
                    <td align=\"center\" class=\"textos\">Mirar desde la tabla
                    <strong>$bdo.$tabla_origen</strong> a la tabla destino
                    <strong>$bdd.$tabla_destino</strong></td>
                  </tr>
                  <tr><td align=\"center\" class=\"textos\">
                <table  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                  $lista_campos_migrar
                </table></td></tr> 
                </table><br>
                
                <table  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
    
     
      $lista_insert
	</table>
               
               ";

?>