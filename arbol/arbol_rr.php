<?php



include("lib/connect_db.inc.php");


include('deuman/mysql_cache/class_db.php');

include("lib/lib.inc.php");
include("lib/lib.inc2.php");

if($_POST['folio']==""){
    $folio ="AL005T-0000016";  
      
}else{
   $folio =$_POST['folio'];   
}






$query= "SELECT id_estado,id_canal ,id_tipo_consulta
           FROM  chileatiende_consulta
           WHERE folio_consulta = '$folio'";
     $result_chileatiende_consulta= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_estado,$id_canal,$id_tipo_consulta) = mysql_fetch_row($result_chileatiende_consulta);



		
      $query= "SELECT id_nivel_perfil,id_estado_solicitud,id_perfil,id_tipo_consulta, id_estado_escala ,id_estado_rechaza ,id_estado_responde
               FROM  chileatiende_niveles_perfil
               WHERE id_canal='$id_canal'
			   and id_perfil <> '1048' and  id_perfil <> '1060' and id_tipo_consulta like '%$id_tipo_consulta,%'
                           GROUP BY id_estado_solicitud";
			 echo $query;
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_nivel_perfil,$id_estado_solicitud,$id_perfil,$id_tipo_consulta,$id_estado_escala ,$id_estado_rechaza ,$id_estado_responde ) = mysql_fetch_row($result2)){
		  
                  
                  //$es_padre = padre($id_canal,$id_estado,$id_estado_solicitud);
				  
		  $nodo = "nodo_$id_estado_solicitud";
                 // $$nodo = 1;
                  
                  $estado = estado($id_estado_solicitud);
                  
                
	
                  
                  if($$nodo ==""){
			echo "entro a $nodo<br>";
                    $altura = rand(10,50);
                    $lado = rand(1,145);
						if($id_estado_solicitud==1)
							$color="#0099FF";
						else	
							$color="#FFF";
                     $nodos .="<div class=\"component window\" style=\"top:$altura em;left:$lado em;background-color:$color\" id=\"$nodo\"><strong>$estado $nodo </strong><br/><br/>#PERFILES_$id_estado_solicitud#</div>\n";
                     
                  }
                  
                  
                  
                   /*
                    * Select tabla ec
                    * 
                    */
                   $query= "SELECT id_perfil
                                  FROM  chileatiende_niveles_perfil
                                  WHERE id_canal='$id_canal'
                                              and id_perfil <> '1048' and  id_perfil <> '1060' and id_tipo_consulta like '%$id_tipo_consulta,%'
                                              GROUP by id_estado_solicitud";
                        $result_ec2= cms_query($query)or die (error($query,mysql_error(),$php));
                         while (list($id_perfil) = mysql_fetch_row($result_ec2)){
                                          $perfil =  perfil_nodo($id_perfil) ;
                                          
                                            /** fin select ec***/
                                      $perfil= perfil_nodo($id_perfil);
                                        $nodos = str_replace("#PERFILES_$id_nivel_perfil#","$perfil<br>#PERFILES_$id_nivel_perfil#",$nodos);
                                    }
                 
                  // $nodos = str_replace("#PERFILES_$id_nivel_perfil#","",$nodos);
                  
                  
                  
                  
				
							   
    		}
						
			
			
			
            
function id_estado_canal($id_canal,$id_estado){
    
     $query= "SELECT id_nivel_perfil
               FROM  chileatiende_niveles_perfil
               WHERE id_canal='$id_canal'
			   and id_perfil <> '1048' and  id_perfil <> '1060' and id_tipo_consulta like '%$id_tipo_consulta,%' and id_estado= $id_estado
			   ORDER BY id_estado_solicitud asc";
			   echo $query;
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
         list($id_nivel_perfil ) = mysql_fetch_row($result2);
	return $id_nivel_perfil;	
}

function nodo_rechaza($id_canal,$id_estado,$id_perfil){
		  
		 /// id_estado_escala  id_estado_rechaza  id_estado_responde  
		    $query= "SELECT id_estado_rechaza  
                   	 FROM  chileatiende_niveles_perfil 
					 WHERE id_estado_solicitud ='$id_estado' and id_canal= $id_canal and id_perfil=$id_perfil";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              if(list($id_estado) = mysql_fetch_row($result)){
				  return $id_estado;	 
			 }else{
			 		return false;
			 }
		
	} 
	
	function nodo_escala($id_canal,$id_estado,$id_perfil){
		  
		 /// id_estado_escala  id_estado_rechaza  id_estado_responde  
		    $query= "SELECT id_estado_escala   
                   	 FROM  chileatiende_niveles_perfil 
					 WHERE id_estado_solicitud ='$id_estado' and id_canal= $id_canal and id_perfil=$id_perfil";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
               
			   if(list($id_estado) = mysql_fetch_row($result)){
				  return $id_estado;	 
			 }else{
			 		return false;
			 }
			 
	}
	function nodo_responde($id_canal,$id_estado,$id_perfil){
		  
		 /// id_estado_escala  id_estado_rechaza  id_estado_responde  
		    $query= "SELECT id_estado_responde   
                   	 FROM  chileatiende_niveles_perfil 
					 WHERE id_estado_solicitud ='$id_estado' and id_canal= $id_canal and id_perfil=$id_perfil";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             if(list($id_estado) = mysql_fetch_row($result)){
				  return $id_estado;	 
			 }else{
			 		return false;
			 }
	}
	
	function padre($id_canal,$id_estado){
		    
			$query= "SELECT id_nivel_perfil   
                   FROM  chileatiende_niveles_perfil 
                   WHERE id_estado_escala=$id_estado or  id_estado_rechaza=$id_estado or  id_estado_responde=$id_estado and id_canal=$id_canal";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              if(list($id_nivel_perfil) = mysql_fetch_row($result)){
			  		return $false;
			  }else{
			  		return true;
			  }
			  
	}
	
	function nodo_padre($id_canal){
	    $query= "SELECT id_estado_solicitud  
               FROM  chileatiende_niveles_perfil 
               WHERE id_canal='$id_canal'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_estado_solicitud) = mysql_fetch_row($result)){
    			$estado_p = padre($id_canal,$id_estado_solicitud);
				if($estado_p){
					$estado_padre =$estado_p;
				}
				
							   
    		 }
	return $estado_padre;
	}
	
	
	function estado($id_estado){
	    $query= "SELECT estado_solicitud   
               FROM  sgs_estado_solicitudes
               WHERE id_estado_solicitud='$id_estado'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($estado_solicitud) = mysql_fetch_row($result);
		 
    						   
    		return $estado_solicitud;
	}
	
	function perfil_nodo($id_perfil){
	
	    $query= "SELECT perfil
               FROM  usuario_perfil
               WHERE id_perfil='$id_perfil'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
        list($perfil) = mysql_fetch_row($result);
		
		return $perfil;
	
	}

?>
<!doctype html>
<html>
	<head>
		<title>jsPlumb 1.3.9 demo - jQuery</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<link rel="stylesheet" href="/mp.css">
				<link rel="stylesheet" href="chileatiende/historial_solicitud/jsPlumb/demo/css/jsPlumbDemo.css">
		<link rel="stylesheet" href="chileatiende/historial_solicitud/jsPlumb/demo/css/demo.css">				
	</head>
	<body onunload="jsPlumb.unload();" data-demo-id="demo" data-library="jquery">
	
		<div style="position:absolute">
		    <div id="demo">
                    <?php echo $nodos ?>
			
                         </div>
		 </div>
	    
	   

	    <!-- DEP -->
	    <script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/lib/jquery-1.7.1-min.js"></script>
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/lib/jquery-ui-1.8.13-min.js"></script>
		<!-- /DEP -->
				
		<!-- JS -->
		<!-- support lib for bezier stuff -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/lib/jsBezier-0.3-min.js"></script>
		<!-- jsplumb util -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jsPlumb-util-1.3.9-RC1.js"></script>
		<!-- main jsplumb engine -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jsPlumb-1.3.9-RC1.js"></script>
		<!-- connectors, endpoint and overlays  -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jsPlumb-defaults-1.3.9-RC1.js"></script>
		<!-- state machine connectors -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jsPlumb-connectors-statemachine-1.3.9-RC1.js"></script>
		<!-- SVG renderer -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jsPlumb-renderers-svg-1.3.9-RC1.js"></script>
		<!-- canvas renderer -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jsPlumb-renderers-canvas-1.3.9-RC1.js"></script>
		<!-- vml renderer -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jsPlumb-renderers-vml-1.3.9-RC1.js"></script>
		<!-- jquery jsPlumb adapter -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/js/1.3.9/jquery.jsPlumb-1.3.9-RC1.js"></script>
		<!-- /JS -->
		
		<!--  demo code -->
		<script type="text/javascript" src="arbol_rr_js.php?folio=<?php echo $folio ?>"></script>
		
               
                
		<!--  demo helper code -->
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/demo/js/demo-list.js"></script>
		<script type="text/javascript" src="chileatiende/historial_solicitud/jsPlumb/demo/js/demo-helper-jquery.js"></script>

	</body>
</html>
