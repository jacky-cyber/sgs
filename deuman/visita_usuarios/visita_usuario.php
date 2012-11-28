<?php


switch ($act) {
     case 1:
            $busca= trim($_GET['busca']);
            
             $tmpArray=array();
            /*
            * Select tabla usuario
            * 
            */
           $query= "SELECT distinct login,nombre,paterno  
                      FROM  usuario
                      WHERE login like '$busca%' or nombre like '$busca%' or paterno like '$busca%' or id_usuario='$busca'";
                $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
                 while (list($login,$nombre,$paterno) = mysql_fetch_row($result_usuario)){
			 $tmpArray[]="$nombre $paterno ($login)";
                          
		 }
                 
                
           /** fin select usuario***/
            
                    $contenido = json_encode($tmpArray);
            
         break;
	 case 2:
           
            $nombre_user = $_POST['nombre_user'];

            $date = date(Y)."-".date(m)."-".date(d);
            
            $usuario = explode("(",$nombre_user);
            $usuario = elimina_ultimo_caracter($usuario[1]);
            
            /*
 * Select tabla usuario
 * 
 */
$query= "SELECT id_usuario  
           FROM  usuario
           WHERE  login= '$usuario'";
        
     $result_user= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_usuario_lista) = mysql_fetch_row($result_user);
      

            $fecha1=  $_POST['fecha1'];
            $fecha2 = $_POST['fecha2'];

          if($fecha1!="" and $fecha2!=""){
            $fecha1_bd = fechas_bd($fecha1);
            $fecha2_bd = fechas_bd($fecha2);
            
            $cond_fecha = " and fecha > '$fecha1_bd' and fecha <'$fecha2_bd' ";
          }
          
$query= "SELECT distinct sesion,hora,fecha, id_usuario
           FROM  estadisticas_acciones
           WHERE id_usuario = $id_usuario_lista and sesion<>''
           $cond_fecha
           GROUP BY sesion
           order by hora desc";
     $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_sess,$hora,$fecha,$id_user) = mysql_fetch_row($result_estadisticas_acciones)){
                /*
                * Select tabla estadisticas_acciones
                * 
                */
               $query_min= "SELECT min(hora)  
                          FROM  estadisticas_acciones
                          WHERE id_usuario = $id_usuario_lista and sesion = '$id_sess'";
                    $result_estadisticas_acciones_min= cms_query($query_min)or die (error($query,mysql_error(),$php));
                    list($min_hora) = mysql_fetch_row($result_estadisticas_acciones_min);
                    $var = explode(" ",$min_hora);
                    $min_hora = $var[1];
               /** fin select estadisticas_acciones***/
               
               /*
                * Select tabla estadisticas_acciones
                * 
                */
               $query_max= "SELECT max(hora)  
                          FROM  estadisticas_acciones
                          WHERE id_usuario = $id_usuario_lista and sesion = '$id_sess' ";
                    $result_estadisticas_acciones_max= cms_query($query_max)or die (error($query,mysql_error(),$php));
                    list($max_hora) = mysql_fetch_row($result_estadisticas_acciones_max);
                     $var = explode(" ",$max_hora);
                    $max_hora = $var[1];
               /** fin select estadisticas_acciones***/
               $fecha= fechas_html($fecha);
               
            
			$lista_sesiones .="<tr><td align=\"center\" class=\"textos\">$id_sess $id_user</td><td align=\"center\" class=\"textos\">$fecha</td> 
                            <td align=\"center\" >$min_hora</td> <td align=\"center\" >$max_hora</td>
                            <td align=\"center\" class=\"textos\"><a class=\"btn btn-small\" href=\"#\"><i class=\"icon-th-list\" onclick=\"ObtenerDatos('?accion=$accion&act=3&id_ses=$id_sess&id_user=$id_user&axj=1','id_$id_sess')\"></i></a></td> </tr>
                            <tr>
                                <td align=\"center\" colspan=\"5\" id=\"id_$id_sess\"></td>
                             </tr> ";			   
		 }
/** fin select estadisticas_acciones***/
             $contenido = "<table class=\"table-bordered\" width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                             <tr><th align=\"center\" class=\"textos\">Sesion </th><th align=\"center\" class=\"textos\">fecha</th> 
                            <th align=\"center\" ><strong>Hora Ingreso</strong></th> <th align=\"center\" ><strong>Hora Salida</strong></th>
                            <th align=\"center\" class=\"textos\"></th> </tr>
                            
                                     $lista_sesiones
                                </table>";
                                
                                
            
         break;
        case 3 :
                $id_ses = $_GET['id_ses'];
                $id_user = $_GET['id_user'];
            
                /*
 * Select tabla accion_estadisticas
 * 
 */
$query= "SELECT id_estadistica,url,ip,tiempo,sqls, hora,datos_post,online
           FROM  estadisticas_acciones
           WHERE sesion = '$id_ses' and id_usuario = $id_user
           order by hora desc";
          
 
     $result_accion_estadisticas= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_estadistica,$url,$ip,$tiempo,$sql,$hora,$datos_post,$online) = mysql_fetch_row($result_accion_estadisticas)){
         $var = explode(" ",$hora);
                    $hora = $var[1];
                    
                    $datos_post = str_replace("[]","",$datos_post);
                    $datos_post= trim($datos_post);
                    
                    if(trim($datos_post)!="" and trim($datos_post)!="[]"){
                        $datos_post_tip = str_replace("<br>","",$datos_post);
                       //
                        $imagen_post = "<a class=\"icon-comment\" href=\"#datos_post\" onclick=\"click_link('$id_estadistica')\" id=\"id_$id_estadistica\" data-toggle=\"modal\" ></a>";
                    }else{
                        $imagen_post = ""; 
                    }
                    if(buscarCadena($url,'accion=error')){
                        $id_error=explode("&id=", $url);
                        $id_error = $id_error[1];
                        $lsita_visita .="<tr class=\"error\">
                                            <td >$id_estadistica</td>
                                            <td ><span class=\"label label-important\">Error!!</span> $url<a class=\"icon-comment\" href=\"#datos_error\" onclick=\"click_error('$id_error')\" id=\"id_$id_estadistica\" data-toggle=\"modal\" ></a></td>
                                            <td >$tiempo</td>
                                            <td >$online</td>
                                            
                                      <td >$sql</td>
                                      <td >$hora</td>
                                       <td >$imagen_post</td>
                                      
                                        </tr> ";
                    }else{
                       $lsita_visita .="<tr>
                                            <td >$id_estadistica</td>
                                            <td >$url</td>
                                            <td >$tiempo</td>
                                            <td >$online</td>
                                            
                                      <td >$sql</td>
                                      <td >$hora</td>
                                       <td >$imagen_post</td>
                                      
                                        </tr> ";
                        
                    }
						   
		 }
               
                
                $contenido = "<table class=\"table table-hover table-striped table-bordered\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                             
                            <tr>
                        <th >id_estadistica</th>
                                            <th >url</th>
                                            <th >tiempo</th>
                                            <th >online</th>
                                            
                                      <th >sql</th>
                                      <th >hora</th>
                                       <th >imagen_post</th>
                                      
                                        </tr>
                                        
                                     $lsita_visita
                                </table>";
  
/** fin select accion_estadisticas***/
            
            break ;
         case 4:
            $id_post = $_GET['id_post'];
            /*
 * Select tabla estadisticas_acciones
 * 
 */
$query= "SELECT datos_post  
           FROM  estadisticas_acciones
           WHERE id_estadistica = $id_post";
     $result_estadisticas_acciones= cms_query($query)or die (error($query,mysql_error(),$php));
      list($datos_post) = mysql_fetch_row($result_estadisticas_acciones);
/** fin select estadisticas_acciones***/
            $arr = json_decode($datos_post, true); //i prefer associative array in this context

                $contenido = "<table class=\"table table-hover table-striped table-bordered\">";
                foreach($arr as $k=>$v)
                    $contenido .= "<tr><td>$k</td><td>$v</td></tr>";
                 $contenido .= "</table>";
            
            
             
         break ;
   	default:
        
         if($fecha1==""){
            $fecha1 = date('d-m-Y', mktime(0, 0, 0, date(n), date('j') - 30, date('Y')));  
        }
        
        if($fecha2==""){
            $fecha2 = date('d-m-Y');  
        }
      
      
      
        $js .="
        
          <script src=\"http://code.jquery.com/ui/1.9.1/jquery-ui.js\"></script>
           <link rel=\"stylesheet\" href=\"js/jquery/jquery-ui/css/ui-lightness/jquery-ui-1.8.16.custom.css\">
           
           
            <link type=\"text/css\" rel=\"stylesheet\" href=\"deuman/visita_usuarios/autocompleta/css/autocomplete.css\"></link>
            
            
        <script src=\"deuman/visita_usuarios/autocompleta/js/autocomplete.jquery.js\"></script>
         
            
        <script language=\"JavaScript\">

		
		$(document).ready(function () 
		{
			$('#boton').click(function() 
			{
                      
                        procesar('index.php?accion=$accion&act=2&axj=1','div_respuesta');
			});
                        
                         $('.autocomplete').autocomplete();
		
		
		
		
    			 $(function() {
                            $( \"#fecha1\" ).datepicker({
                                defaultDate: \"+1w\",
                                changeMonth: true,
                                numberOfMonths: 3,
                                onClose: function( selectedDate ) {
                                    $( \"#fecha2\" ).datepicker( \"option\", \"minDate\", selectedDate );
                                }
                            });
                             $( \"#fecha1\" ).datepicker( \"option\", \"dateFormat\", 'dd-mm-yy' ).val('$fecha1');
                           
                            $( \"#fecha2\" ).datepicker({
                                defaultDate: \"+1w\",
                                changeMonth: true,
                                numberOfMonths: 3,
                                onClose: function( selectedDate ) {
                                    $( \"#fecha1\" ).datepicker( \"option\", \"maxDate\", selectedDate );
                                }
                            });
                            $( \"#fecha2\" ).datepicker( \"option\", \"dateFormat\", 'dd-mm-yy' ).val('$fecha2');
                        });
	
                      
                    
        });
        
        function click_link(id){ 
               $('#contenido_modal').load('index.php?accion=$accion&act=4&axj=1&id_post='+id, function() {});
            } 
		
                
                
            function click_error(id){
             $('#contenido_modal_error').load('index.php?accion=Log-de-Errores&act=18&id_a=216&width=400&axj=1&id='+id, function() {});
            }
          </script>  
                
";
       /*
       <script type=\"text/javascript\">
			$(\"#slider-range\").slider({
				range: true,
				min: 0,
				max: 1439,
				values: [540, 1020],
				slide: slideTime
			});
			function slideTime(event, ui){
				var val0 = $(\"#slider-range\").slider(\"values\", 0),
					val1 = $(\"#slider-range\").slider(\"values\", 1),
					minutes0 = parseInt(val0 % 60, 10),
					hours0 = parseInt(val0 / 60 % 24, 10),
					minutes1 = parseInt(val1 % 60, 10),
					hours1 = parseInt(val1 / 60 % 24, 10);
					
				startTime = getTime(hours0, minutes0);
				endTime = getTime(hours1, minutes1);
				$(\"#time\").text(startTime + ' - ' + endTime);
			}
			function getTime(hours, minutes) {
				var time = null;
				minutes = minutes + \"\";
				if (hours < 12) {
					time = \"AM\";
				}
				else {
					time = \"PM\";
				}
				if (hours == 0) {
					hours = 12;
				}
				if (hours > 12) {
					hours = hours - 12;
				}
				if (minutes.length == 1) {
					minutes = \"0\" + minutes;
				}
				return hours + \":\" + minutes + \" \" + time;
			}
			slideTime();
                        
                        
                        
                        
                        
		</script>
       */ 
       
	    $contenido = "<table   border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
    <tr>
      
      <td align=\"center\" class=\"textos\">
      <div class=\"autocomplete\">
      Ingresa nombre de usuario
           <input type=\"text\" name=\"nombre_user\" id=\"nombre_user\"  class=\"buscar input-xlarge\" data-source=\"index.php?accion=$accion&act=1&axj=1&busca=\">
          
            
      Desde el 
         <input id=\"fecha1\" name=\"fecha1\" type=\"text\" value=\"$fecha1\" class=\"input-small\"/> al <input type=\"text\" name=\"fecha2\" id=\"fecha2\" class=\"input-small\" value=\"$fecha2\">
      <input type=\"button\" name=\"boton\"  id=\"boton\" value=\"Buscar\" class=\"btn\">
     
        </div>
      </td> 
      </tr>
	</table>
        <div id=\"div_respuesta\"></div>
        
       
         



<div id=\"datos_post\" class=\"modal hide fade in\" style=\"display: none; \">
            <div class=\"modal-header\">
              <a class=\"close\" data-dismiss=\"modal\">X</a>
              <h3>Datos POST</h3>
            </div>
            <div class=\"modal-body\" id=\"contenido_modal\">
              Cargando Datos POST		        
            </div>
            <div class=\"modal-footer\">
              
              <a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Cerrar</a>
            </div>
          </div>


<div id=\"datos_error\" class=\"modal hide fade in\" style=\"display: none; \">
            <div class=\"modal-header\">
              <a class=\"close\" data-dismiss=\"modal\">X</a>
              <h3>Datos del Error</h3>
            </div>
            <div class=\"modal-body\" id=\"contenido_modal_error\">
              Cargando Datos	        
            </div>
            <div class=\"modal-footer\">
              
              <a href=\"#\" class=\"btn\" data-dismiss=\"modal\">Cerrar</a>
            </div>
          </div>



                ";
	 
       
 }


/*

function ObtenerNavegador($user_agent) {
     $navegadores = array(
          'Opera' => 'Opera',
          'Mozilla Firefox'=> '(Firebird)|(Firefox)',
          'Galeon' => 'Galeon',
          'Mozilla'=>'Gecko',
          'MyIE'=>'MyIE',
          'Lynx' => 'Lynx',
          'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',
          'Konqueror'=>'Konqueror',
          'Internet Explorer 7' => '(MSIE 9\.[0-9]+)',
          'Internet Explorer 7' => '(MSIE 8\.[0-9]+)',
          'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',
          'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',
          'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',
);
foreach($navegadores as $navegador=>$pattern){
       if (eregi($pattern, $user_agent))
       return $navegador;
    }
return 'Desconocido';
}

*/


function buscarCadena($cadena,$palabra)
    {
        if (strstr($cadena,$palabra))
            return true;
        else
            return false;
    }
    
 
    
?>