<?php


$id_estado_solicitud_filtro = $_POST['id_estado_solicitud_filtro'];
$id_responsable_filtro = $_POST['id_responsable_filtro'];
$tipo_filtro = $_POST['tipo_filtro'];

$js .="<script type= \"text/javascript\">/*<![CDATA[*/
$(function(){
	//Get our elements for faster access and set overlay width
	var div = $('div.sc_menu'),
		ul = $('ul.sc_menu'),
		ulPadding = 20;
	
	//Get menu width
	var divWidth = div.width();
 
	//Remove scrollbars	
	div.css({overflow: 'hidden'});
	
	//Find last image container
	var lastLi = ul.find('li:last-child');
	
	//When user move mouse over menu
	div.mousemove(function(e){
		//As images are loaded ul width increases,
		//so we recalculate it each time
		var ulWidth = lastLi[0].offsetLeft + lastLi.outerWidth() + ulPadding;	
		var left = (e.pageX - div.offset().left) * (ulWidth-divWidth) / divWidth;
		div.scrollLeft(left);
	});
});
/*]]>*/


 function pagina(pag){
 var pag;
 var url = \"index.php?accion=$accion&axj=1&pagina=\"+pag; 
		$.get(url, function(data){
  			$(\"#resultado\").html(data);
			
		});

}



</script>";

$css .="<style type=\"text/css\"> 




div.sc_menu {
	/* Set it so we could calculate the offsetLeft */
	position: relative;
	height: 35px;
        width: 525px;	
	
	overflow: auto;
}
ul.sc_menu {
	display: block;
	height:35px;
	/* max width here, for users without javascript */	
	width: 12000px;	
	padding: 8px 0 0 8px; 
	/* removing default styling */
	margin: 0;
	
	list-style: none;
}
.sc_menu li {
	display: block;
	float: left;	
	padding: 0 2px;
}
.sc_menu a {
	display: block;
	text-decoration: none;
}
.sc_menu span {
	display: none;
	margin-top: 3px;
	
	text-align: center;
	font-size: 12px;	
	color: #fff;
}
.sc_menu a:hover span {
	display: block;
}
.sc_menu img {
	border: 3px #fff solid;	
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
}
.sc_menu a:hover img {
	filter:alpha(opacity=50);	
	opacity: 0.5;
}
 
 
/* Here are styles for the back button, don't look at them */


/*Credits: Dynamic Drive CSS Library */

/*URL: http://www.dynamicdrive.com/style/ */



.pagination{
padding: 2px;
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
background-color: #fff;

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
background-color: #ccc;
}



.pagination currentpage{
background-color: #2e6ab1;
color: #ccc !important;
border-color: #2b66a5;
font-weight: bold;
cursor: default;
}

.pagination disablelink, .pagination disablelink:hover{
background-color: white;
cursor: default;
color: #929292;
border-color: #929292;
font-weight: normal !important;
}

.pagination prevnext{
font-weight: bold;
}



</style>";










/*
$kon = mysql_connect ($host, $usr, $pwd) or die ("Error de Conexion");
mysql_select_db ($bdatos, $kon) or ("Error al conectar a la bdatos");
*/

$Etapa_fin= configuracion_cms('Estados_etapa_fin');	

$TAMANO_PAGINA = configuracion_cms('registros_por_pagina');
//$max_paginas=10;



	$id_user= id_usuario($id_sesion);
	 
	 $query= "SELECT id_entidad 
               FROM  usuario
               WHERE id_usuario='$id_user'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_entidad_user) = mysql_fetch_row($result)){
		  	$and = $and." AND id_entidad =  '$id_entidad_user' ";
		  }
	
	if ($ms=="1"){
		$id_entidad = "";
	}

	$id_entidad_selecionada = $id_entidad;
	$select_entidades = select_lista_entidades($id_entidad_selecionada);

//fin poner filtro entidad	

	$sol_sin_asignar = 0;
	$fecha_sol_mas_antigua = "9999-99-99";
	 
	//sacar el html del contenido
	$contenido = html_template('contenedor_listado_solicitudes_finalizadas');	
	
	if($id_estado_solicitud_filtro!=""){
	$and .=" and id_sub_estado_solicitud = '$id_estado_solicitud_filtro' ";
	}
	
	if($id_responsable_filtro!="" and $id_responsable_filtro!="#"){
	$and .=" and id_responsable = '$id_responsable_filtro' ";
	}
	
      

	if($tipo_filtro!=""){
	$and .=" and folio like '%$tipo_filtro-%' ";
	}
	
        $folio_busca = $_POST['folio_busca'];

	if($folio_busca!=""){
	$and .=" and folio like '%$folio_busca%' ";
	}
	
	if($_SESSION['ver_archivadas']==0){
	$and .=" and archivada=0 ";
	}
	
	
	
		//$contenido = ordenar_columnas('sgs_solicitud_acceso').$contenido;
	
	//procesar las solicitudes ingresadas
	
        
       
$query= "SELECT id_solicitud_acceso,folio,fecha_inicio,fecha_termino,id_entidad_padre,id_entidad,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,id_digitador,prorroga,finalizada,firmada,hash,otra_entidad_origen,fecha_original,id_entidad_padre_origen,id_entidad_hija_origen,url_documento_origen,observacion_origen,id_tipo_solicitud,archivada
           FROM  sgs_solicitud_acceso
           WHERE  id_sub_estado_solicitud in ($Etapa_fin) $and
           ORDER BY id_solicitud_acceso desc" ;
    
		//echo $query;	
    /** fin select sgs_solicitudes_acceso***/    
       
	
 // echo  "<br>esta: ".$query;
            $result= cms_query($query)or die (error($query,mysql_error(),$php));
			
	$sol_sin_asignar = mysql_num_rows($result);
	
	while (list($id_solicitud_acceso,$folio,$fecha_inicio,$fecha_termino) = mysql_fetch_row($result)){
			if ($fecha_sol_mas_antigua > $fecha_ingreso ) {
				$fecha_sol_mas_antigua = $fecha_ingreso;
			}
			
	}
	
	$fecha_sol_mas_antigua = fechas_html($fecha_sol_mas_antigua);
	
	$tot_registros = $sol_sin_asignar;
	
	



$sql = mysql_query($query) or die("Error de busqueda");
$total_registros = mysql_affected_rows();

$total_paginas = ceil($total_registros / $TAMANO_PAGINA);


while($pagin<$total_paginas){
$pagin++;

$lista_pagin2 .="<li><a href=\"#\" onClick=\"pagina('$pagin')\">$pagin</a></li> ";

}

$list_paginas2  ="<div class=\"pagination\" > $lista_pagin2</div>";




$pagina = $_GET["pagina"];
if (!$pagina) {
    $inicio = 0;
    $pagina=1;
}
else {
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
} 



$sql = mysql_query($query) or die("Error de busqueda");
$total_registros = mysql_num_rows($sql);
//echo $total;
$total_paginas = ceil($total_registros / $TAMANO_PAGINA);
$query .= " LIMIT $inicio, $TAMANO_PAGINA ";
$sql = mysql_query($query)or die (error($query,mysql_error(),$php));

//while ($row = mysql_fetch_array($sql)){
	//echo $row['id_estadistica']."  -  ". $row['fecha'] . "<br>";
//}





////////////////////////////////////////////////////////////////////

	 while (list($id_solicitud_acceso,$folio,$fecha_ingreso,$fecha_termino,$id_entidad_padre,$id_entidad,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$id_digitador,$prorroga,$finalizada,$firmada,$hash,$otra_entidad_origen,$fecha_original,$id_entidad_padre_origen,$id_entidad_hija_origen,$url_documento_origen,$observacion_origen,$id_tipo_solicitud,$archivada) = mysql_fetch_row($sql)){
	$cont_panel++;
	
			
			
		$query= "SELECT fecha  
	             FROM  sgs_flujo_estados_solicitud
	             WHERE folio='$folio' and id_estado_solicitud=$id_sub_estado_solicitud 
				 order by id_flujo_estados_solicitud desc";
				// echo $query;
	      $result_resp= cms_query($query)or die (error($query,mysql_error(),$php));
	       if(list($fecha_respuesta) = mysql_fetch_row($result_resp)){
	       		//$cont++; 
	       	   $plazo ="";
	 				// $fecha_termino = $fecha_respuesta
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_respuesta);
								
				if($aux[0]>=2009 and $aux1[0]>=2007){
					//echo $aux[0] ." ".$aux1[0]." $fecha_ingreso,$fecha_respuesta<br> ";
				 	$plazo = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_respuesta);
				}else{
					$plazo = "<span style=\"color:#F00\">???</span>";
				}
				
				if (abs($plazo)>1){
					$plazo = $plazo."&nbsp;d&iacute;as";
				}else{
					$plazo = $plazo."&nbsp;d&iacute;a";
				}
	 		   // echo "$cont; $folio ;$fecha_ingreso;$fecha_respuesta ; $plazo<br>";
				 //$plazo = $plazo. " d&iacute;as";
	       	 $fecha_respuesta = fechas_html($fecha_respuesta); 
	       }else{
	       	$random = rand(0,100);
	
	       	$fecha_respuesta="<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
	<font color=\"#FF0000\">???</font></a>";
	$random = rand(100,300);
	       	$plazo =  "<a href=\"index.php?accion=help&c=problema_fecha&width=320&axj=1\" class=\"jTip\" id=\"$random\" name=\"Problemas con calculo de fecha\">
	<font color=\"#FF0000\">???</font></a>";
	       }
					$dias=""; 
				$aux=explode("-", $fecha_ingreso);
				$aux1=explode("-", $fecha_termino);
				
				if($aux[0]>2007 and $aux1[0]>2007){
						$dias = calculaDiasHabilesEntreFechas($fecha_ingreso,$fecha_termino);
				}
				
				
				

				$lista_mis_solicitudes = html_template('linea_lista_solicitudes_finalizadas');
				//echo "$folio $fecha_ingreso<br>";
				
				 $fecha_ingreso= fechas_html($fecha_ingreso);
					
				 $fecha_termino = fechas_html($fecha_termino);
				
				$link_editar = "?accion=$accion&act=1&folio=$folio";
				
				if($cambia_color ==1){
					$clase= "class=\"alternate\"";
					$cambia_color=0;
				}else{
					$clase="";
					$cambia_color=1;
				}
                                
                                /*
 * Select tabla sgs_estado_solicitudes
 * 
 */
$query= "SELECT estado_solicitud  
           FROM  sgs_estado_solicitudes
           WHERE id_estado_solicitud = '$id_sub_estado_solicitud'";
     $result_sgs_estado_solicitudes= cms_query($query)or die (error($query,mysql_error(),$php));
     list($estado_solicitud) = mysql_fetch_row($result_sgs_estado_solicitudes);
     
     
/** fin select sgs_estado_solicitudes***/
												
				$lista_mis_solicitudes = cms_replace("#INTERLINEADO#","$clase",$lista_mis_solicitudes);
				if($archivada==1){
				$lista_mis_solicitudes = cms_replace("#FOLIO#","$folio*",$lista_mis_solicitudes);
				
				}else{
				$lista_mis_solicitudes = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes);
				
				}
				$lista_mis_solicitudes = cms_replace("#FECHA_RESPUESTA#","$fecha_respuesta",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#DIAS# ","$plazo",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#ESTADO#",$estado_solicitud,$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#LINK#","$link_editar",$lista_mis_solicitudes);
				$lista_mis_solicitudes = cms_replace("#ESTADO_PADRE#",acentos($estado_padre),$lista_mis_solicitudes);
				
				
				$lineas .=$lista_mis_solicitudes;
				
			}
		
/////////////////////////////////////////////////////////////////








$lineas = "	  <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
				<tr>
                  
                        <th width=\"110\" align=\"center\"><h3>Folio</h3></th>
                        <th align=\"center\"><h3>Fecha  Solicitud</h3></th>
                       <th align=\"center\"></th>
                       
                        <th  align=\"center\" title=\"Fecha de cierre de solicitud\"><h3>Fecha Finalizaci&oacute;n </h3>
						</th>
                        <th align=\"center\" width=\"70\"><h3>Plazo<a href=\"index.php?accion=help&c=plazo-solicitude-finalizadas&width=320&axj=1\" class=\"jTip\" id=\"Plazo_termino\" name=\"Plazo de t&eacute;rmino de solicitud\"><img src=\"images/help.png\" alt=\"\" border=\"0\" class=\"valign\"></a></h3></th>
                        <th align=\"center\" width=\"190\"><h3>Estado</h3></th>
                        <th  align=\"center\" class=\"nosort\"><h3>Ver</h3></th>
                       
                </tr>
			 </thead>
			  <tbody>
			  $lineas
			     </tbody>
        </table>";



		
		//llenar el combobox de estados
	$query= "SELECT id_estado_solicitud,estado_solicitud
		 	 FROM  sgs_estado_solicitudes
             WHERE id_estado_solicitud  in ($Etapa_fin) ";
			 
			// echo $query;
	$result34= cms_query($query)or die (error($query,mysql_error(),$php));
	
	if ($id_estado_solicitud_seleccionado==0){
			$seleccionado = "selected";
	}else{
		$seleccionado = "";
	}
	  
	$estados = "<option value=\"\" ".$seleccionado.">Todas</option>";
	
	while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result34)){
		$estado_solicitud= cambio_texto($estado_solicitud);

		if ($id_estado_solicitud_seleccionado==$id_estado_solicitud){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		    $estados .= "<option value=\"$id_estado_solicitud\" $seleccionado>$estado_solicitud  </option>";
		}
	
	
	$var = "seleccionado$tipo";
	$$var = "selected";
	$filtro = "	<select  class=\"combo\"  name=\"id_estado_solicitud_filtro\" onChange=\"document.form1.submit()\">
					".$estados."
				</select><br>";
				
	$tipo="	<select  class=\"combo\"  name=\"tipo_filtro\" onChange=\"document.form1.submit();\">
				    <option value=\"\" >Todos</option> 
					<option value=\"W\" ".$seleccionadoW.">Web</option>
				    <option value=\"P\" ".$seleccionadoP.">Formulario</option>
				    <option value=\"C\" ".$seleccionadoC.">Carta</option>
				
				</select>
				 
				
				";
	
				$filtro = cambio_texto($filtro);
	
	  $id_usuario     = id_usuario($id_sesion);
	  $query= "SELECT count(*)   
              FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
	      WHERE a.id_estado_solicitud = b.id_estado_solicitud 
	      and c.id_estado_solicitud = a.id_sub_estado_solicitud
	      $condicion and  a.id_responsable='$id_usuario' $condicion_mis_solicitudes
            ";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($tot_mis_solicitudes) = mysql_fetch_row($result);
		  
	
	//responsables
	$query= "SELECT id_usuario,nombre,paterno  
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil 
			   and up.maneja_solicitudes = 1 
			   and u.id_entidad='$id_entidad_user'"; 

    $result= cms_query($query)or die (error($query,mysql_error(),$php));
  	$estados = "<option value=\"\" ".$seleccionado.">Todos</option>";
	while (list($id_responsable_f,$nombre_f,$paterno_f) = mysql_fetch_row($result)){
		
		if ($id_responsable_seleccionado==$id_responsable_filtro){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$listado_responsables .= "<option value=\"$id_responsable_f\" ".$seleccionado.">$nombre_f $paterno_f</option>";
	}
	
	$responsable = "<select  class=\"combo\" name=\"id_responsable_filtro\"  onChange=\"document.form1.submit()\" >
					<option value=\"#\" >Todos</option>
                                        ".$listado_responsables."
				</select>";
	//fin responsables
		
		
	

/*

    <tr><td align=\"center\" class=\"textos\">
			<!--	Escoge alguna Pagina para mostrar los resultados reg tot $total_registros -- total pag $total_paginas
				 --> </td></tr>
*/

$contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
            
				<tr>
                  <td align=\"center\" class=\"textos\">
				  
				  <div class=\"sc_menu\"  align=\"center\">
	<ul class=\"sc_menu\">
	
	$list_paginas2 
	
	</ul>
</div>
				  
			
			  
			  <div id=\"resultado\" >
					$lineas
			  </div>
                
           
				  
				  
				  
				  
				  </td>
                </tr>
              </table>";

if($axj==1){

$contenido = $lineas;
}else{

if($_SESSION['ver_archivadas']==0){
			$texto_archivadas = "Mostrar Solicitudes Archivadas";
			}else{
			$texto_archivadas = "Ocultar Solicitudes Archivadas";
			}

$contenido = "<table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                
				<tr><td align=\"left\" class=\"textos\">Seleccione un estado $filtro</td></tr> 
				<tr><td align=\"left\" class=\"textos\">Seleccione un Tipo $tipo</td></tr> 
				
				<tr>
                <td align=\"left\" width=\"98%\" class=\"textos\">Responsable :$responsable    <a href=\"#\" onclick=\"document.form1.ms.value=1;document.form1.submit();\">
                  <input name=\"ms\" type=\"hidden\" id=\"ms\" value=\"0\" />
                </a></td>
              </tr>
              <tr><td align=\"left\" class=\"textos\">Buscar por Folio : <input type=\"text\" name=\"folio_busca\" id=\"folio_busca\" maxlength=\"20\" value=\"$folio_busca\"><input type=\"submit\" name=\"Submit\" value=\">>\"></td></tr> 
            	 <tr><td align=\"left\" class=\"textos\">
				 <a href=\"index.php?accion=$accion&act=5\">$texto_archivadas</a> 
                   <a href=\"index.php?accion=help&c=solicitudes-archivadas&width=320&axj=1\" class=\"jTip\" id=\"sol_archiv\" name=\"Solicitudes Archivdas\">
                     <img src=\"images/help.png\" alt=\"\" border=\"0\">
                    </a>
                                                                                  				  </td></tr> 
				 <tr>
                  <td align=\"center\" class=\"textos\">
			
			$contenido
			
			
			</td>
                  </tr>
            	</table>";
		


}
?>