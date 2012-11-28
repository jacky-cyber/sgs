<?php


include("lib/connect_db.inc.php");


include('deuman/mysql_cache/class_db.php');

include("lib/lib.inc.php");
include("lib/lib.inc2.php");

if(!$_GET["folio"])
	$folio ="AL005T-0000016";
else
	$folio =$_GET["folio"];	





$query= "SELECT id_estado,id_canal ,id_tipo_consulta
           FROM  chileatiende_consulta
           WHERE folio_consulta = '$folio'";
     $result_chileatiende_consulta= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_estado,$id_canal,$id_tipo_consulta) = mysql_fetch_row($result_chileatiende_consulta);



		
      $query= "SELECT id_nivel_perfil,id_estado_solicitud,id_perfil,id_tipo_consulta, id_estado_escala ,id_estado_rechaza ,id_estado_responde
               FROM  chileatiende_niveles_perfil
               WHERE id_canal='$id_canal' 
			   AND id_tipo_consulta like '%$id_tipo_consulta,%'
               ORDER BY id_nivel_perfil";
			 
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_nivel_perfil,$id_estado_solicitud,$id_perfil,$id_tipo_consulta,$id_estado_escala ,$id_estado_rechaza ,$id_estado_responde ) = mysql_fetch_row($result2)){
		  
                  
                  $es_padre = padre($id_canal,$id_estado,$id_estado_solicitud);
		  $nodo = "nodo_$id_estado_solicitud";
                 // $$nodo = 1;
                  
                  $estado = estado($id_estado_solicitud);
                  
                  
          
                                $estado_rechaza="";
				$estado_escala="";
				$estado_responde="";
                                
                                $perfil= perfil_nodo($id_perfil);
				if(nodo_rechaza($id_canal,$id_estado_rechaza,$id_perfil) and $id_estado_rechaza!=0 and $id_estado_rechaza!=""){
                                     $id_estado_h=nodo_rechaza($id_canal,$id_estado_rechaza,$id_perfil);
                                     $nodo_js .="var connection$id_nivel_perfil".$id_estado_rechaza." = nodo('$nodo','nodo_$id_estado_h','$perfil -><strong>Rechaza $id_estado_h</strong>','#FF5555','l1 component label');\n";
				}
				if(nodo_escala($id_canal,$id_estado_escala,$id_perfil) and $id_estado_escala!=0 and $id_estado_escala!=""){
                                    $id_estado_h=nodo_escala($id_canal,$id_estado_escala,$id_perfil);
                                    $nodo_js .="var connection$id_nivel_perfil".$id_estado_escala." = nodo('$nodo','nodo_$id_estado_h','$perfil -> Escala $id_estado_h','#55FF55','l1 component label_2');\n";
				}
				
				if(nodo_responde($id_canal,$id_estado_responde,$id_perfil) and $id_estado_responde!=0 and $id_estado_rechaza!=""){
                                    $id_estado_h=nodo_responde($id_canal,$id_estado_responde,$id_perfil);
                                     $nodo_js .="var connection$id_nivel_perfil".$id_estado_responde." = nodo('$nodo','nodo_$id_estado_h','$perfil -> Responde $id_estado_h','#5555FF','l1 component label_3');\n";
				}
					
				
				
							   
    		 }
						
			
				
			
			
            
function id_estado_canal($id_canal,$id_estado){
    
     $query= "SELECT id_nivel_perfil
               FROM  chileatiende_niveles_perfil
               WHERE id_canal='$id_canal'
			   and id_perfil <> '1048' and  id_perfil <> '1060' and id_tipo_consulta like '%$id_tipo_consulta,%' and id_estado= $id_estado
			   ORDER BY id_estado_solicitud asc";
			   
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
         list($id_nivel_perfil ) = mysql_fetch_row($result2);
	return $id_nivel_perfil;	
}

function nodo_rechaza($id_canal,$id_estado,$id_perfil){
		  
		 /// id_estado_escala  id_estado_rechaza  id_estado_responde  
		    $query= "SELECT id_estado_solicitud   
                   	 FROM  chileatiende_niveles_perfil 
					 WHERE id_estado_solicitud ='$id_estado' and id_canal= $id_canal  and id_tipo_consulta like '%$id_tipo_consulta,%'
                                         ORDER BY id_nivel_perfil";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              if(list($id_estado) = mysql_fetch_row($result)){
				  return $id_estado;	 
			 }else{
			 		return false;
			 }
		
	} 
	
	function nodo_escala($id_canal,$id_estado,$id_perfil){
		  
		 /// id_estado_escala  id_estado_rechaza  id_estado_responde  
		    $query= "SELECT id_estado_solicitud   
                   	 FROM  chileatiende_niveles_perfil 
					 WHERE id_estado_solicitud ='$id_estado' and id_canal= $id_canal   and id_tipo_consulta like '%$id_tipo_consulta,%'
                                         ORDER BY id_nivel_perfil";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
               
			   if(list($id_estado) = mysql_fetch_row($result)){
				return $id_estado;	 
			 }else{
			 	return false;
			 }
			 
	}
	function nodo_responde($id_canal,$id_estado,$id_perfil){
		  
		 /// id_estado_escala  id_estado_rechaza  id_estado_responde  
		    $query= "SELECT id_estado_solicitud    
                   	 FROM  chileatiende_niveles_perfil 
					 WHERE id_estado_solicitud ='$id_estado' and id_canal= $id_canal  and id_tipo_consulta like '%$id_tipo_consulta,%'
                                         ORDER BY id_nivel_perfil";
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

echo "/*
	this is the JS for the main jsPlumb demo.  it is shared between the YUI, jQuery and MooTools
	demo pages.
*/

;(function() {

	window.jsPlumbDemo = {
			
		init : function() {

			jsPlumb.setRenderMode(jsPlumb.CANVAS);
			
			jsPlumb.DefaultDragOptions = { cursor: 'pointer', zIndex:2000 };
	
			        var connectorStrokeColor = 'rgba(50, 50, 200, 1)',
				connectorHighlightStrokeColor = 'rgba(180, 180, 200, 1)',
				hoverPaintStyle = { strokeStyle:'#7ec3d9' };			
			
                              
                                $nodo_js
				
	       		
				
			
			
			jsPlumb.draggable(jsPlumb.getSelector('.window'));
            
		}
	};	
})();

function nodo(fuente,destino,etiqueta,color,lab){

if (document.getElementById(destino)!=null && document.getElementById(fuente)!=null) {

	
	return jsPlumb.connect({
				source:fuente, 
			   	target:destino, 			   	
				anchors:['BottomRight', 'TopLeft'],
							    paintStyle:{
								lineWidth:7,
								strokeStyle:color,
								// outlineColor:'#666',
								// outlineWidth:1,
								dashstyle:'4 2',
								joinstyle:'miter'
								},
				endpointStyle:{ fillStyle:'#a7b04b' },
			   	overlays : [ ['Label', {													   					
			   					cssClass:lab,
			   					label : etiqueta, 
			   					location:0.7,
			   					id:'label',
								color:color,
			   					events:{
									'click':function(label, evt) {
										alert('clicked on label for connection 1');
			   						}
			   					}
			   				  } ],
			   				['Arrow', {
			   					cssClass:'l1arrow',
				   				location:0.5, width:30
	   						}]
			]});   
	
	}else{
           // alert('no existe ' + destino);
        }
    };
        
        ";
?>