<?php


$buscar =  trim($_POST['buscar']);

if($buscar!=""){
	
	$condicion_busca = " and ssa.folio like '%$buscar%'";
	
}

	$reg_por_pagina = configuracion_cms('registros_por_pagina');
	
	
	    $query= "SELECT id_entidad   
               FROM  usuario
               WHERE id_usuario='$id_usuario'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
         list($id_entidad) = mysql_fetch_row($result);
	

  $query= "SELECT ssa.folio,ssa.fecha_solicita,ssa.hora_solicita,ssa.observacion,ssa.id_estado_asignacion,ssa.id_usuario
           FROM  sgs_solicitud_asignacion ssa, sgs_solicitud_acceso ssaa
           WHERE ssa.id_estado_asignacion =1 and ssaa.id_entidad='$id_entidad' and 
		   ssa.folio=ssaa.folio
           $condicion_busca
           ORDER BY ssa.fecha_solicita ,ssa.hora_solicita asc";
		
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($folio_reasig,$fecha_solicita,$hora_solicita,$observacion,$id_estado_asignacion, $id_usuario_reasig) = mysql_fetch_row($result)){

      	$nombre_reasig = nombre_usuario2($id_usuario_reasig);
$query= "SELECT * 
         FROM sgs_solicitud_acceso
         WHERE folio='$folio_reasig'";

$result_q= cms_query($query)or die (error($query,mysql_error(),$php));

$num_filas = mysql_num_fields($result_q);
$resultado = mysql_fetch_row($result_q);
for ($i = 1; $i < $num_filas; $i++){
	$nom_campo = mysql_field_name($result_q,$i);
	$valor = $resultado[$i];
	$$nom_campo = $valor;
}

$fecha_solicita = fechas_html($fecha_solicita);

$lista_contenido .= "<tr>
                  <td align=\"left\" >$nombre_reasig</td>
                  <td align=\"center\" >$folio</td>
                  <td align=\"center\" >$fecha_solicita</td>
                  <td align=\"center\" >$hora_solicita</td>
                  <td align=\"center\" > <a href=\"index.php?accion=$accion&act=3&folio=$folio\">Editar</a></td>
                </tr>";

      	  
		 }
		 

		
		 
	$titulo_columnas = "<tr>
                  			<th align=\"center\" class=\"alt\" >Responsable</th>
               			    <th align=\"center\" class=\"alt\" >Folio</th>
                			<th align=\"center\" class=\"alt\" >Fecha Solicitud Reasignaci&oacute;n</th>
                			<th align=\"center\" class=\"alt\" >Hora Solicitud Reasignaci&oacute;n</th>
                       <th align=\"center\" class=\"alt\" ></th>
                        </tr>";





$contenido = listado_generico ($titulo_panel,$titulo_columnas, $lista_contenido, $paginacion);




		
function listado_generico ($titulo_panel,$titulo_columnas, $lista_contenido, $paginacion){
		
		
		
/*
<tr>
                        <td>
                        <div align=\"center\">Buscar por N&#186; de solicitud: 
                          <input id=\"buscar\" name=\"buscar\" type=\"text\" /> 
                          <input id=\"buscar2\" type=\"submit\" name=\"buscar2\" value=\"Buscar...\" />
                          </div>                       
                          </td>
                    </tr>

*/
 
$contenedor_generico ="<table cellspacing=\"0\" cellpadding=\"0\" width=\"98%\" border=\"0\">
    <tbody>
        <tr>
            <td valign=\"top\"> </td>
        </tr>
        <tr>
            <td valign=\"top\">
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                <tbody>
                    <tr>
                        <td>
                        <div align=\"center\"><strong>#TITULO_PANEL#</strong></div>                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp </td>
                    </tr>
                     
			
                    <tr>
                        <td><strong>Bandeja de Solicitudes </strong><br></td>
                    </tr>
                    <tr>
                        <td>&nbsp </td>
                    </tr>
                    <tr>
                        <td >
                        <div class=\"wide\" id=\"table-block\">
                        <table cellspacing=\"0\" cellpadding=\"0\">
                            <tbody>
                                
                                    #TITULOS_COLUMNAS#
                               
                                #LISTA_SOLICITUDES#
                            </tbody>
                        </table>
                        </div>                        </td>
                    </tr>
                </tbody>
            </table>
            <br />
            <div align=\"center\"><br />
            <br />
            #PAGINACION#</div>
            </td>
        </tr>
    </tbody>
</table>";
//templates 	html
$template = "contenedor_lista_reasignacion";



	$template="titulo_panel_reasignacion";
	
	$asunto =configuracion_cms($template);
	
	$valor= "Solicitudes a Reasignar";
	$tabla = "cms_configuracion";
	$publico = 0;
	
	if($asunto=="$template no existe"){
			
			$_POST['configuracion']="$template";
			$_POST['valor']=$valor;
			$_POST['descripcion']="Titulo de modulo de reasignaci&oacute;n";
			
			$_POST['publico']=$publico;
			inserta($tabla);
		//echo $asunto;	
		}


$titulo_panel=configuracion_cms($template);

$mensaje = html_template($template);
		if($mensaje=="$template no existe"){
			
			$_POST['templates']="$template";
			$_POST['html']=$contenedor_generico;
			inserta("templates_acciones");
			
		}

		$contenido =  html_template('contenedor_lista_reasignacion');
		
		if($lista_contenido==""){
		
		$lista_contenido ="<tr>
                  <td align=\"center\" class=\"textos\"  colspan=\"5\"><center>Sin solicitudes</center></td>
                </tr>";
		}
		
		$contenido = cms_replace("#TITULO_PANEL#",$titulo_panel,$contenido);
		$contenido = cms_replace("#TITULOS_COLUMNAS#",$titulo_columnas,$contenido);
		$contenido = cms_replace("#LISTA_SOLICITUDES#",$lista_contenido,$contenido);
		$contenido = cms_replace("#PAGINACION#",$paginacion,$contenido);
		
		
		if($_SESSION['mensaje_reasignacion']!=""){
		//echo $_SESSION['mensaje_reasignacion'];
		$mensaje_reasi= cuadro_verde($_SESSION['mensaje_reasignacion']);
		$contenido .="<br>".$mensaje_reasi;
		$_SESSION['mensaje_reasignacion']="";
		}
		return $contenido;
		
	}
		
?>