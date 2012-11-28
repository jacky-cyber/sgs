<?php
$id_acc = $_GET['id_acc'];
$id_cole = $_GET['id_cole'];

session_register('filtro');

ini_set("memory_limit","50M");



if($_POST['filtro']!=""){
     
$_SESSION['filtro'] =$_POST['filtro'];
     
}

if($_SESSION['filtro']!="" ){
     $filtro=$_SESSION['filtro'];
     
     $condicion_filtro= "and estadisticas_acciones.datos_post like '%$fitro%' or estadisticas_acciones.url like '%$filtro%' ";
     
}
if($_POST['boton_sacar_filtro']!=""){
$_SESSION['filtro']="";
$filtro="";
$condicion_filtro= "";
}


switch ($act) {
     case 1:
        $id_estadistica = $_GET['id_estadistica'];
		
		/*$tabla ="";
        $condicion =" ";//WHERE id_reclamo='$id_reclamo'
        $agregar_nombre_campo = "";
      */
		  $query = "SELECT * 
        		  FROM estadisticas_acciones
        		  WHERE id_estadistica='$id_estadistica' $condicion_filtro";
        
        $result_q= cms_query($query)or die ("ERROR $php  ddd <br>$query");
        $num_filas = mysql_num_fields($result_q);
        $resultado = mysql_fetch_row($result_q);
        for ($i = 0; $i < $num_filas; $i++){
        
        $nom_campo = mysql_field_name($result_q,$i);
        $nom_campo .=$agregar_nombre_campo;
        $valor = $resultado[$i];
        $$nom_campo = $valor;
        $datos_tabla .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
		<td align=\"left\" valign=\"top\" class=\"textos\">$nom_campo</td>
		<td align=\"center\"  valign=\"top\" class=\"textos\">:</td> 
		 <td align=\"left\" class=\"textos\">$valor</td> </tr>";
        }
		if($datos_post!=""){
		$datos_post = " <tr>
                          <td align=\"left\" class=\"textos\">Datos Post $datos_post</td>
                        </tr>";
		}
		$contenido = "
					    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                          
                            $datos_tabla
                          
                      	</table>";
		
         break;
	case 2 :
	        $contenido = "0.".rand(1,1000);
	  break;
   	default:
	

$query = "SELECT * FROM deuman_gente_online";
// Ocultamos algún mensaje de error con @
$resp = @mysql_query($query) or die(mysql_error());
// almacenamos la consulta en la variable $usuarios_online
$usuarios_online = mysql_num_rows($resp);


include ("admin/estadisticas/quick_calendar.php");


$ajaxPath="admin/estadisticas/quick_calendar.php";


$js .="
<script language=\"javascript\">

function createQCObject() { 
   var req; 
   if(window.XMLHttpRequest){ 
      // Firefox, Safari, Opera... 
      req = new XMLHttpRequest(); 
   } else if(window.ActiveXObject) { 
      // Internet Explorer 5+ 
      req = new ActiveXObject(\"Microsoft.XMLHTTP\"); 
   } else { 
      alert('Problem creating the XMLHttpRequest object'); 
   } 
   return req; 
} 

// Make the XMLHttpRequest object 
var http = createQCObject(); 

function displayQCalendar(m,y,accion,id_u,fecha) {
	var ran_no=(Math.round((Math.random()*9999))); 
	http.open('get', '$ajaxPath?m='+m+'&y='+y+'&accion='+accion+'&id='+id_u+'&fecha='+fecha+'&ran='+ran_no);
   	http.onreadystatechange = function() {
		if(http.readyState == 4 && http.status == 200) { 
      		var response = http.responseText;
      		if(response) { 
				document.getElementById(\"quickCalender\").innerHTML = http.responseText; 
      		} 
   		} 
	} 
   	http.send(null); 
}





</script>
";



if($id_acc!="" and $id_perfil==999){
 $Sql ="DELETE FROM estadisticas_acciones where id_accion=$id_acc";
 mysql_query($Sql);

}


   //$Sql ="DELETE FROM estadisticas_acciones where id_accion=$accion";

   //cms_query($Sql);

  
  $id = $_GET['id'];
  if($id!=""){
  $condicion =" and id_usuario=$id ";
  
  }

   $fecha = $_GET['fecha'];
  if($fecha!=""){
  $condicion .= " and fecha like '$fecha%' ";
  
  }
  $id_accion2=  $_GET['id_accion'];
  if($id_accion2!=""){
  
    if($fecha!=""){
  		$condicion2 .= " and ea.fecha like '$fecha%' ";
  
  	}
  
  $condicion .= " and id_accion = '$id_accion2' ";
  
      $query= "SELECT distinct u.id_usuario     
             FROM  usuario u , estadisticas_acciones ea
             WHERE u.id_usuario=ea.id_usuario and ea.id_accion = '$id_accion2' $condicion2 $condicion_filtro";
       $result= cms_query($query)or die (error($query,mysql_error(),$php));
        while (list($id_us) = mysql_fetch_row($result)){
		   
		   
		     $query= "SELECT sum(click)
                      FROM estadisticas_acciones ea
                      WHERE ea.id_usuario='$id_us' and ea.id_accion = '$id_accion2' $condicion2 ";
                $resultw= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($click_u) = mysql_fetch_row($resultw);
			
			  $query= "SELECT nombre  
                       FROM  usuario
                       WHERE id_usuario='$id_us'";
                 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($nombre_us) = mysql_fetch_row($result2);
			
  			$tabla_lista_ususarios .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
			<td align=\"left\" class=\"textos\" width=\"90%\">$nombre_us  dd</td>
			<td align=\"center\" class=\"textos\">$click_u</td> 
			<td align=\"center\" class=\"textos\" >
			<a  href=\"index.php?accion=$accion&id_accion=$id_accion2&fecha=$fecha&id=$id_us&detalle=ok\" >
			<img src=\"images/lupa.gif\" alt=\"Ver detalles de Visitas\" border=\"0\"></a></td> </tr>\n";			   
  		 }
  
  $fecha_html = fechas_html($fecha);
  
  $tabla_lista_ususarios ="  <table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro\">
                               <tr >
                                 <td align=\"center\" class=\"textos\" colspan=\"3\" class=\"cabeza\">Usuario visitantes el d&iacute;a $fecha_html</td>
                                 </tr>
								 $tabla_lista_ususarios
								
                           	</table>";
  
  
   }
   
   $detalle = $_GET['detalle'];
   $fecha_url = $_GET['fecha'];
   $id_url = $_GET['id'];
   if($fecha_url!=""){
   $cond_fecha ="and fecha='$fecha_url'";
   
   }
   if($id_url!=""){
   $cond_id_url = "and id_usuario='$id_url'";
   } 
   
   
   if($id_url!="" or $fecha_url!=""){
   $query= "SELECT id_estadistica,id_accion,act,fecha,hora,id_usuario,click,url,datos_post,ip,tiempo,sqls   
               FROM  estadisticas_acciones
               WHERE 1 $cond_id_url $cond_fecha $condicion_filtro
			   order by hora desc";
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_estadistica,$id_accion,$act_est,$fecha,$hora,$id_usuario_est,$click,$url,$datos_post,$ip,$tiempo,$sqls ) = mysql_fetch_row($result3)){
		  		$nombre_usuario = nombre_usuario2($id_usuario_est);
				$accion_txt = accion_palabra($id_accion);
				if($nombre_usuario==""){
				$nombre_usuario="NB";
				}
    			$lista_detalle .="<tr style=\"background-color: #F9FFFF;\" >
				<td align=\"center\" class=\"textos\" title=\"$id_usuario_est\">
					<a href=\"?accion=$accion&id=$id_usuario_est\">$nombre_usuario</a></td> 
				<td align=\"left\" class=\"textos\" title=\"$url\">$accion_txt</td>
				<td align=\"center\" class=\"textos\">$act_est </td> 
				<td align=\"center\" class=\"textos\">$fecha</td> 
				<td align=\"center\" class=\"textos\">$tiempo</td>
				<td align=\"center\" class=\"textos\">$sqls</td> 
				<td align=\"center\" class=\"textos\">
				<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=1&id_estadistica=$id_estadistica&axj=1','contenido_$id_estadistica');\" src=\"images/b_search.png\" alt=\"Ver\" border=\"0\">
				</td>
				<tr >
				<td  class=\"textos\" colspan=\"7\" >
				<div id=\"contenido_$id_estadistica\" ></div></td></tr>  
				 </tr> ";			   
    		
   $detalle_visita ="  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\">
                         <tr style=\"background-color: #ccc;\"  >
				<td align=\"center\" class=\"textos\" >Nombre</td> 
				<td align=\"left\" class=\"textos\">Acci&oacute;n</td>
				<td align=\"center\" class=\"textos\">Act</td> 
				<td align=\"center\" class=\"textos\">Fecha</td> 
				<td align=\"center\" class=\"textos\">Tiempo</td>
				<td align=\"center\" class=\"textos\">Sqls</td> 
				<td align=\"center\" class=\"textos\">
				</td>
				
						 $lista_detalle
                     	</table>";
   }
   
   	  
   }
  
$query= "SELECT sum(click)
           FROM  estadisticas_acciones
		   WHERE 1 $condicion ";
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      list($tot_click) = mysql_fetch_row($result2);
      
      if($tot_click==0){
      	
      	$contenido.=  "<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      	    <tr>
      	      <td align=\"center\" class=\"textos_rojo\">&nbsp;No se han realizado movimientos en esta fecha</td>
      	      </tr>
      		</table>";
      	
      	
      }
	  
	  // PIE QUE CARGA LOS INGRESOS POR MODULO
	  
  $query= "SELECT a.accion,a.descrip_php_esp
           FROM  acciones a";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_accion,$descrip_php_esp) = mysql_fetch_row($result)){
						   
		 

	


  $query= "SELECT sum(click)
           FROM  estadisticas_acciones
           WHERE id_accion='$id_accion' $condicion ";
		//echo $query."<br>"; 
     $result3= cms_query($query)or die (error($query,mysql_error(),$php));
      list($click) = mysql_fetch_row($result3);
	  if($click>0){
	  
	   if($fecha!=""){
	     $url="&fecha=$fecha";
	   }
	   
	   if($id!=""){
	     $url .="&id=$id";
	   }
	   
	   
	   
	        	
			$porcentaje = ($click/$tot_click)*100;
			$porcentaje = round($porcentaje,0);
				$largo=$porcentaje*2;
			
			$tablaXXX .= "   <tr  style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
                           <td align=\"left\" class=\"textos\" >&nbsp;
						   <a href=\"index.php?accion=$accion&id_accion=$id_accion\">$descrip_php_esp </a></td>
                          <td align=\"center\" class=\"textos\">$click </td>
                          <td align=\"left\" class=\"textos\">
						  <img src=\"images/barrita.gif\" alt=\"\" border=\"0\" width=\"$largo\" height=\"10\">$porcentaje%</td>
                          <td align=\"center\" class=\"textos\">
						  <a href=\"javascript:confirmar('Esta seguro de eliminar este dato','index.php?accion=$accion&id_acc=$id_accion')\">
						  <img src=\"images/trash.jpg\" alt=\"\" border=\"0\"></a></td>
                           </tr>";
			if($porcentaje >= 1){
				$datos_pai .="['$descrip_php_esp', $porcentaje.0],\n";			   
			}
			   
	  }
			
					   
		 
	}
	
	
	
	$query= "SELECT count(*)
           FROM  estadisticas_acciones
		   WHERE 1 $condicion $condicion_filtro";
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      list($tot_click) = mysql_fetch_row($result2);
	
	 /* $query= "SELECT id,establecimiento    
               FROM  establecimientos";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_e,$estable) = mysql_fetch_row($result)){*/
    				
		
		
					
							   
    		 /*}*/
	
	if($fecha!=""){
	$url_fecha="&fecha=$fecha";
	}
  $query= "SELECT id_usuario,nombre,apellido
           FROM  usuario
	   order by apellido ";  

     $result2= cms_query($query)or die (error($query,mysql_error(),$php));  
  
      while (list($id,$nombre2,$apellido2) = mysql_fetch_row($result2)){
      	   
      	        
			$lista .= "<option value=\"index.php?accion=$accion&id=$id"."$url_fecha\">$apellido2 $nombre2</option>";	   
		 }
			 
		$lista_personas ="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
                    <option value=\"#\">Seleccione persona</option>
					$lista
                  </select>	";
		 
			
			
		 $lista_detalle="";
	     $query= "SELECT id_estadistica,id_accion,act,fecha,hora,id_usuario,click,url,datos_post,ip,tiempo,sqls,online   
               FROM  estadisticas_acciones
               WHERE 1 $cond_id_url $cond_fecha $condicion_filtro
			  
			  
			    order by tiempo desc
			    LIMIT 0,10";
		echo $query;	  
			  
         $result34= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_estadistica,$id_accion,$act_est,$fecha,$hora,$id_usuario_est,$click,$url,$datos_post,$ip,$tiempo,$sqls,$online ) = mysql_fetch_row($result34)){
		  		$nombre_usuario = nombre_usuario2($id_usuario_est);
				$accion_txt = accion_palabra($id_accion);
				if($nombre_usuario==""){
				$nombre_usuario="NB";
				}
    			$lista_detalle .="<tr style=\"background-color: #F9FFFF;\" >
				<td align=\"center\" class=\"textos\" title=\"$id_usuario_est\">
					<a href=\"?accion=$accion&id=$id_usuario_est\">$nombre_usuario</a></td> 
				<td align=\"left\" class=\"textos\" title=\"$url\">$accion_txt</td>
				
				<td align=\"center\" class=\"textos\">$fecha</td> 
				<td align=\"center\" class=\"textos\">$tiempo</td>
				<td align=\"center\" class=\"textos\">$sqls</td> 
				<td align=\"center\" class=\"textos\">$online</td> 
				<td align=\"center\" class=\"textos\">
				<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=1&id_estadistica=$id_estadistica&axj=1','contenido_sql_$id_estadistica');\" src=\"images/b_search.png\" alt=\"Ver\" border=\"0\">
				</td>
				<tr >
				<td  class=\"textos\" colspan=\"7\" >
				<div id=\"contenido_sql_$id_estadistica\" ></div></td></tr>  
				 </tr> ";			   
    		 }
   $detalle_max_sqls="<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\">
                         <tr><td align=\"center\" colspan=\"7\" class=\"textos\">Modulos con mas ejecuciones de Sql </td></tr> 
						  <tr style=\"background-color: #ccc;\" >
				<td align=\"center\" class=\"textos\" >Nombre</td> 
				<td align=\"left\" class=\"textos\">Acci&oacute;n</td>
				
				<td align=\"center\" class=\"textos\">Fecha</td> 
				<td align=\"center\" class=\"textos\">Tiempo</td>
				<td align=\"center\" class=\"textos\">Sqls</td> 
				<td align=\"center\" class=\"textos\">Online</td> 
				<td align=\"center\" class=\"textos\">
				</td>
						 $lista_detalle
                     	</table>";
	
	
	$contenido .= "<script languaje=\"javascript\">
function confirmar( mensaje, destino){  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

</script> 
 
	
	
  <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"10\" cellspacing=\"0\">
  <tr><td align=\"center\" class=\"textos\"><input type=\"text\" name=\"filtro\" id=\"filtro\" value=\"$filtro\"> </td></tr> 
  <tr><td align=\"center\" class=\"textos\">
  <input type=\"submit\" name=\"boton_filtro\" id=\"boton_filtro\" value=\"Crear Filtro\"> &nbsp;&nbsp;
  <input type=\"submit\" name=\"boton_sacar_filtro\" id=\"boton_sacar_filtro\" value=\"Eliminar Filtro\"> </td></tr> 
   <tr >
      <td align=\"center\" class=\"textos\">$lista_personas</td>
      </tr>
      <tr><td align=\"center\" class=\"textos\"> Usuarios en linea $usuarios_online</td></tr> 
	<tr >
      <td align=\"center\" class=\"textos\">
	  
	   
	 <br><table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr >
      <td align=\"center\" class=\"cabeza_rojo\" >Estad&iacute;stica de M&oacute;dulos $fecha</td>
      </tr>  
	</table>
<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\"cuadro\">
                    <tr >
                      <td align=\"center\" class=\"cabeza_rojo\" >Acci&oacute;n</td>
                 	  <td align=\"center\" class=\"cabeza_rojo\" >Click</td>
                   	  <td align=\"center\"  class=\"cabeza_rojo\">%</td>
                   <td align=\"center\"  class=\"cabeza_rojo\">Borrar</td>
                    </tr>
					$tabla
                  </table>
				  
				  
	  </td>
      </tr>
	  <tr><td align=\"center\" class=\"textos\">$tabla_lista_ususarios </td></tr> 
	  <tr><td align=\"center\" class=\"textos\">$detalle_visita</td></tr> 
	 <tr>
      <td align=\"center\" class=\"textos\"><div id=\"quickCalender\">$calendario</div></td>
      </tr>
	 <tr><td align=\"center\" class=\"textos\">$detalle_max_sqls </td></tr> 
	</table>


 ";
	  
       
	
 
 //$hoy = date(Y)."-".date(m)."-".date(d);
 //$hora = date('h:m:s');
 $fecha_hora =date('Y-m-d h:i:s');
     
     $query= "SELECT INTERVAL -1 DAY + '$fecha_hora';";
      $result= mysql_query($query)or die (error($query,mysql_error(),$php));
      list($ayer) = mysql_fetch_row($result);
	  
	  
	      $query= "SELECT tiempo,sqls,online  
					FROM estadisticas_acciones 
					WHERE hora > '$ayer  $hora'
					AND hora < '$fecha_hora'
					order by id_estadistica  desc
					Limit 0,40";
					
           $result= mysql_query($query)or die (error($query,mysql_error(),$php));
            while (list($tiempo,$sqls,$online) = mysql_fetch_row($result)){
      				$lista_datos .="<tr>
									<td align=\"center\" class=\"textos\">$tiempo</td>
									<td align=\"center\" class=\"textos\">$sqls</td>
									<td align=\"center\" class=\"textos\">$online</td>
									</tr> ";		   
									
					$conectados .="$online ,";
      				$tiempos .="$tiempo ,";
      		 }
 
 			$conectados = elimina_ultimo_caracter($conectados);
 			$tiempos = elimina_ultimo_caracter($tiempos);
 	
	$contenido .= "fecha : $fecha_hora
		  <br>
		  
		  
		  
		    <div id=\"container_pai\" style=\"width: 550px; height: 400px; margin: 0 auto\"></div>
		<div id=\"container2\" style=\"width: 550px; height: 400px; margin: 0 auto\"></div>
		  <div id=\"tiempo_php\"></div><br>
		  
";
 
 $js .="
		<script type=\"text/javascript\" src=\"js/jquery/highcharts2_1_9/js/highcharts.js\"></script>
		
		<!-- 1a) Optional: add a theme file -->
		<!--
			<script type=\"text/javascript\" src=\"js/jquery/highcharts2_1_9/js/themes/gray.js\"></script>
		-->
		
		<!-- 1b) Optional: the exporting module -->
		<script type=\"text/javascript\" src=\"js/jquery/highcharts2_1_9/js/modules/exporting.js\"></script>
		
		
		<!-- 2. Add the JavaScript to initialize the chart on document ready -->
		<script type=\"text/javascript\">
		
			function datos(){
			
			
			var existe;
 
			 $.ajax({
			 type: \"POST\",
			 url: \"tiempo.php\",
			 data: $(this).val(),
					 async: false,
			 success: function(data){
			 //alert(data); //TEST ALERT
			 existe = data;}
			 });
 
			      return existe;
			    //  

			}
			
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container2',
						zoomType: 'xy'
					},
					title: {
						text: 'Tiempo de respuesta v/s Usuarios Conectados'
					},
					subtitle: {
						text: 'Datos de la últimas 24 Hrs'
					},
					xAxis: [{
						categories: [$conectados]
					}],
					yAxis: [{ // Primary yAxis
						labels: {
							formatter: function() {
								return this.value +'seg';
							},
							style: {
								color: '#89A54E'
							}
						},
						title: {
							text: 'Tiempo respuesta',
							style: {
								color: '#89A54E'
							}
						}
					}, { // Secondary yAxis
						title: {
							text: 'Conectados',
							style: {
								color: '#4572A7'
							}
						},
						labels: {
							formatter: function() {
								return this.value +' online';
							},
							style: {
								color: '#4572A7'
							}
						},
						opposite: true
					}],
					tooltip: {
						formatter: function() {
							return ''+ this.y +
								(this.series.name == 'Usuarios' ? ' Online' : ' Seg');
						}
					},
					legend: {
						layout: 'vertical',
						align: 'left',
						x: 120,
						verticalAlign: 'top',
						y: 100,
						floating: true,
						backgroundColor: '#FFFFFF'
					},
					series: [{
						name: 'Usuarios',
						color: '#4572A7',
						type: 'spline',
						yAxis: 1,
						data: [$conectados]		
					
						  }, {
						name: 'Tiempo Respuesta',
						color: '#89A54E',
						type: 'spline',
						data: [$tiempos]
					     }]
				});
				
				
			});
		
		
		
	       var chart;
$(document).ready(function() {
	chart = new Highcharts.Chart({
		chart: {
			renderTo: 'container_pai',
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false
		},
		title: {
			text: 'Ingresos por Modulo SACH'
		},
		tooltip: {
			formatter: function() {
				return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					color: '#000000',
					connectorColor: '#000000',
					formatter: function() {
						return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
					}
				}
			}
		},
		series: [{
			type: 'pie',
			name: 'Browser share',
			data: [
				$datos_pai
			]
		}]
	});
});
		
		
				
		</script>

		";
		
		
/*
 * Select tabla estadisticas_acciones
 * 
 */
$query= "SELECT AVG(tiempo) from estadisticas_acciones where cache=1";
     $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
     list($promedio_con_cache) = mysql_fetch_row($result_estadisticas_acciones);
     
$query= "SELECT AVG(tiempo) from estadisticas_acciones where cache=0";
     $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
     list($promedio_sin_cache) = mysql_fetch_row($result_estadisticas_acciones);
	 
$query= "SELECT AVG(online) from estadisticas_acciones";
     $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
     list($promedio_visitas) = mysql_fetch_row($result_estadisticas_acciones);	 
     
     
    
     
    $contenido .= "<br>
		    <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                  <tr>
                    <td align=\"center\" class=\"textos\">Tiempos promedios de respuesta con cache activado $promedio_con_cache seg.</td>
                  </tr>
                <tr>
                    <td align=\"center\" class=\"textos\">Tiempos promedios de respuesta sin cache  $promedio_sin_cache seg.</td>
                  </tr>
                <tr>
                    <td align=\"center\" class=\"textos\">Visitas promedio  $promedio_visitas visitantes.</td>
                  </tr>
		  <tr><td align=\"center\" class=\"textos\"> $tabla_promedios_tiempos_accion</td></tr> 
                </table>";  
			
			
			
			
/** fin select estadisticas_acciones***/	
		
	  
	/*
		Highcharts.setOptions({
				global: {
					useUTC: false
				}
			});
				
			var chart;
			$(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'container',
						defaultSeriesType: 'spline',
						marginRight: 10,
						events: {
							load: function() {
				
								// set up the updating of the chart each second
								var series = this.series[0];
								setInterval(function() {
											  var x = (new Date()).getTime(),
											  //y=Math.random()
											 y = datos();
											  //alert(y);
											 $('#tiempo_php').html(y);
											  series.addPoint([x, y], true, true);
										       }, 1000);
							}
						}
					},
					title: {
						text: 'Tiempo de respuesta online'
					},
					xAxis: {
						type: 'datetime',
						tickPixelInterval: 150
					},
					yAxis: {
						title: {
							text: 'Value'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						formatter: function() {
				                return '<b>'+ this.series.name +'</b><br/>'+
								Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+ 
								Highcharts.numberFormat(this.y, 2);
						}
					},
					legend: {
						enabled: false
					},
					exporting: {
						enabled: false
					},
					series: [{
						name: 'Random data',
						data: (function() {
							// generate an array of random data
							var data = [],
								time = (new Date()).getTime(),
								i;
							
							for (i = -45; i <= 0; i++) {
								data.push({
									x: time + i * 1000,
									//y: Math.random()
									//  y : datos()
									y: 0.8
								});
							}
							return data;
						})()
					}]
				});
				
				
			});
				
	
	*/	
 }		
  /*
  
  SELECT * 
FROM `estadisticas_acciones` 
WHERE hora > '2012-01-13 00:00:00'
AND hora < '2012-01-14 00:00:00'
* 
* 
* 
SELECT INTERVAL 1 DAY + '2008-12-31'; //suma o resta (-1) la cantidad de dias que indiquemos

* 
* 
* 
  */				    
?>