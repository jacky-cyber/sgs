<?php

if ($_POST['opcion']=="3"){
	$i=1;
	$cantidad = $_POST['cantidad'];
	while($i<=$cantidad){
		
		$cap = $_POST['caja_'.$i];
		$id = $_POST['id_'.$i];
		//echo "<br>valor: ".$cap;
		//echo "<br>id: ".$id;
		//if ($cap!=""){
			
		//}
		if ($i==($cantidad)){
			//echo "ultimo<br>";
			if ($_POST['entidad_padre']!=""){
				$entidad_padre = $_POST['entidad_padre'];
				//echo "<br>entidad_padre:".$entidad_padre ;
				
			//	echo "<br>cantidad:".mysql_num_rows($result_entidad);
				 $sql = "Select id_entidad,entidad from sgs_entidades where id_entidad_padre = $entidad_padre ";
				$res = cms_query($sql)or die("la consulta falló 5<br>".mysql_error());
				$num_registros = mysql_num_rows($res);
				$r = 1;
				$final = "";
				while ($r <= $num_registros){
					//echo " <br> "."ckb_".$r;
					//$valor = ;
					
					if ($_POST["ckb_".$r]){
						//armar string para guardar los valores separados por coma
						if ($final==""){
							$final = $_POST["ckb_".$r];
						}else{
							$final = $final.",".$_POST["ckb_".$r];
						}
					}
					
					$r++;
				}
				$cap = $final;
				//echo "<br>final:".$final;
			}
		}
		
		$sql = "update cms_configuracion set valor = '".$cap."' where id_configuracion= $id";
		//echo "<br>".$sql."<br>";

 cms_query($sql) or die ("La consulta falló".mysql_error());
		
		
		
		$i++;
	}
	
	$politicas = $_POST['politicas'];
	
	$politicas = str_replace("'"," ",$politicas);
	$Sql ="UPDATE noticias SET contenido ='".$politicas."' WHERE id_noticia ='2009012010144481'";

 cms_query($Sql)or die ("ERROR $php <br>$Sql".mysql_error());

	
		$Sql ="UPDATE accion_grupo SET id_grupo ='0' WHERE grupo ='Sitio'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	

	
	
	  $query= "SELECT id_acc, accion     
               FROM  acciones
               WHERE descrip_url ='Configuracion'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($id_acc, $accion_nro) = mysql_fetch_row($result);
		 	
			$Sql ="UPDATE acciones SET home ='si' WHERE accion =$accion_nro";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	
		 
		   $query= "SELECT id_perfil   
                    FROM accion_perfil where id_perfil=4 and   accion =$accion_nro ";
              $result= cms_query($query)or die (error($query,mysql_error(),$php));
               if (list($id_p) = mysql_fetch_row($result)){
         			
				
	 $Sql ="DELETE FROM accion_perfil where id_perfil=4 and   accion =$accion_nro  ";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
		

					
                       
         		 }
		 // perfil NB 4
		 
		 //1390 54757 
	
	//$contenido = html_template('contenedor_mensaje_configuracion');
	//$contenido = html_template('contenedor_instalador');
	

	
}




?>