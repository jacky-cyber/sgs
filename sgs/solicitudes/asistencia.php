<?php
	

	
	$_SESSION['id_preg']++;
	$id_preg = $_SESSION['id_preg'];
	  $query= "SELECT count(*)   
               FROM  sgs_wizard";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($total_preguntas) = mysql_fetch_row($result);
	
	if($id_preg>$total_preguntas){
	header("HTTP/1.0 307 Temporary redirect");
    header("Location:index.php?accion=$accion&act=2");
	
	}
	
	  $query= "SELECT id_wizard ,pregunta,respuesta_positiva  
               FROM  sgs_wizard
			   WHERE orden = $id_preg";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_pregunta,$pregunta,$respuesta_positiva ) = mysql_fetch_row($result);
		  
		  $preguntas = "
					<p>$pregunta</p>
					<div id=\"respuesta_no\"><a href=\"?accion=$accion&act=$act\">No</a></div>
					<div id=\"respuesta_si\"><a href=\"#\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=3&id_p=$id_pregunta&axj=1','respuesta');\">SI</a></div>
					
					<div id=\"respuesta\"></div>
					<p><br />
			         ";

                    

       $contenido = html_template('contenedor_preguntas_asistencia_solicitud');	
	   
	   $contenido = cms_replace("#PREGUNTAS#","$preguntas",$contenido);
	   $contenido = cms_replace("#TOT_PREGUNTAS#","$total_preguntas",$contenido);
	   $contenido = cms_replace("#ACTUAL_PREGUNTAS#","$id_preg",$contenido);
	   $contenido = cms_replace("#LINK_FORMULARIO#","?accion=$accion&act=2",$contenido);
	  
/* template  contenedor_preguntas_asistencia_solicitud


   <h3>Solicitud de Acceso </h3>
              <p>Para ayudarlo hemos dise&ntilde;ado este asistente que le permitir&aacute; encontrar la informaci&oacute;n que usted busca.</p>
              
              <div id="form-block">
				
				
				   <label for="field_1">Pregunta #ACTUAL_PREGUNTAS# de #TOT_PREGUNTAS#</label>
				   <h3>#PREGUNTAS#</h3>
</div>
            
            
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>
              <p>&nbsp;</p>



*/
?>