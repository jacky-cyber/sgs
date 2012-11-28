<?php

if($tp==2){
	 $_SESSION['criterios_sess']="";
	 $_SESSION['condicion_sess']="";
}


session_register_cms('tabla_sess');
session_register_cms('campo_txt_sess');
session_register_cms('campo_pk_sess');
session_register_cms('tabla_campo_sess');
session_register_cms('condicion_sess');

session_register_cms('campo_sel_sess');

$_SESSION['tabla_sess']="usuario";	

//Set de variables iniciales 
if($_SESSION['tabla_campo_sess']==""){
	
$_SESSION['tabla_sess']="usuario";	
$_SESSION['campo_txt_sess']="sexo";
$_SESSION['tabla_campo_sess']="usuario_sexo";
$_SESSION['campo_pk_sess']= "id_sexo";
//$_SESSION['condicion_sess']=" and id_perfil=1 ";	
}

/**/

	

$tabla= $_SESSION['tabla_sess'];
$condicion= $_SESSION['condicion_sess'];	
$campo_txt_def= $_SESSION['campo_txt_sess'];
$campo_pk_def= $_SESSION['campo_pk_sess'];
$tabla_campo_def= $_SESSION['tabla_campo_sess'];
$criterios_sess = $_SESSION['criterios_sess'];
/*Fin variables iniciales*/



switch ($act) {
	case 1:
		
		include("sgs/estadisticas_opcionales/genera_xml.php");
		$contenido = $xml_grafico;
		
		  		  
	break;
 
	
	case 4:
		  include ("sgs/estadisticas_opcionales/estadisticas_consulta_simple.php"); 
		  
		  		  
	break;


	case 6:
                  include ("sgs/estadisticas_opcionales/agrega_criterios_ajax.php"); 
		  
		  		  
	break;
	case 7:
		//include ("sgs/estadisticas_opcionales/borrar_criterios_ajax.php"); 
		   $_SESSION['criterios_sess']="";
		   $_SESSION['condicion_sess']="";
		   $contenido = cuadro_verde("Criterios borrados");
		  		  
	break;
	case 8:
		include ("sgs/estadisticas_opcionales/borrar_filtro.php"); 
		  
		  		  
	break;
	case 9:
		include ("sgs/estadisticas_opcionales/total_filtro.php"); 
		  
		  		  
	break;
	case 10:
		
		//include ("sgs/estadisticas_opcionales/agrega_fechas_ajax.php");
		$fecha_ini = $_GET['desde'];
		$fecha_fin = $_GET['hasta'];
		
		$aux_fecha_ini =explode("-", $fecha_ini);
		$fecha_ini = $aux_fecha_ini[2]."-".$aux_fecha_ini[1]."-".$aux_fecha_ini[0];
		
		$aux_fecha_fin =explode("-", $fecha_fin);
		$fecha_fin = $aux_fecha_fin[2]."-".$aux_fecha_fin[1]."-".$aux_fecha_fin[0];
		
		if($fecha_ini!="" and $fecha_fin!=""){
			$cond_fecha = " and fecha_crea > '$fecha_ini' and fecha_crea < '$fecha_fin' "; 
			
		}
		   
		include("sgs/estadisticas_opcionales/lista_criterios_ajax.php");
		

		$contenido = $lista_criterios_ajax;		  
	break;
  
   	default:
	
	 /*
	 	
	    $query= "SELECT count(*) 
               FROM  usuario
               WHERE id_perfil='1' $condicion";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($tot_usuarios) = mysql_fetch_row($result);
		  
		  $contenido .= "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                          <tr>
                            <td align=\"center\" class=\"textos\">
				<h2>Total de Personas Registradas $tot_usuarios</h2></td>
                          </tr>
			 
                        </table>";
	
	*/
	
	/*Ponemos filtro por fechas*/







$filtro = "<div class=\"demo\">

<label for=\"from\">Desde</label>
<input type=\"text\" id=\"desde\" name=\"desde\" value=\"\"/>
<label for=\"to\">hasta</label>
<input type=\"text\" id=\"hasta\" name=\"hasta\" value=\"\"/>

</div>";

	include ("sgs/estadisticas_opcionales/genera_combo_list.php"); 	 
	
	include("sgs/estadisticas_opcionales/lista_criterios_ajax.php");
	include("sgs/estadisticas_opcionales/genera_xml.php");	  
        include ("sgs/estadisticas_opcionales/tot_opcionales.php"); 
/*
$contenido .="<br><br>$query23<br><br>
$tabla=<strong>tabla_sess;</strong><br>
$condicion=<strong>condicion_sess;</strong><br>	
$campo_txt_def=<strong>campo_txt_sess;</strong><br>
$campo_pk_def=<strong>campo_pk_sess;</strong><br>
$tabla_campo_def=<strong>tabla_campo_sess</strong><br>
$criterios_sess = <strong>criterios_sess</strong>s";
*/
	$js .= "
<SCRIPT LANGUAGE=\"Javascript\" SRC=\"sgs/estadisticas/JSClass/FusionCharts.js\"></SCRIPT>
<script language=\"JavaScript\" src=\"sgs/estadisticas/JSClass/FusionChartsExportComponent.js\"></script>
 
<script type=\"text/javascript\" src=\"js/jquery/ui/ui.datepicker.js\"></script>
<link rel=\"stylesheet\" type=\"text/css\" href=\"js/jquery/ui/themes/ui-lightness/ui.all.css\"/>
<script>
	//Js para Calendarios
	$(function() {
		var dates = $( \"#desde, #hasta\" ).datepicker({
			defaultDate: \"+1w\",
			changeMonth: true,
			numberOfMonths: 1,
			dateFormat: 'dd-mm-yy',
			onSelect: function( selectedDate ) {
				var option = this.id == \"desde\" ? \"minDate\" : \"maxDate\",
					instance = $( this ).data( \"datepicker\" );
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( \"option\", option, date );
				
				if($(\"#desde\").val()!=''){
				  if($(\"#hasta\").val()!=''){
					var_desde = $(\"#desde\").val();
					var_hasta = $(\"#hasta\").val();
					var url= '?accion=$accion&act=10&axj=1&desde='+var_desde+'&hasta='+var_hasta;
	   
					ObtenerDatos(url,'criterios');
					updateChart();
					
					};
				};
				
			}
			
			
		});
		
	});
	
	
	
	  function updateChart(){
	  
	    
	       //Get reference to chart object using Dom ID
	       var chartObj = getChartFromId(\"$tabla\");
	         
	       var_select= document.form1.id_campo_tabla.value;
	       chartObj.setDataURL(\"index.php?accion=$accion&act=1&axj=1&campo_sel=\"+ var_select); 
	 
	    }
      
 
       
       function barra_chart_col(){
         
	     var chart1 = new FusionCharts(\"sgs/estadisticas/Charts/Column3D.swf\", \"$tabla\", \"600\", \"400\", \"0\", \"1\"); 
	     var_select= document.form1.id_campo_tabla.value;
	     chart1.setDataURL(\"sgs/estadisticas_opcionales/graf_def.php\"); 
	     chart1.render(\"chart1div2_$tabla\");
     
      }
       function barra_chart_pie(){
         
	     var chart1 = new FusionCharts(\"sgs/estadisticas/Charts/Pie3D.swf\", \"$tabla\", \"600\", \"400\", \"0\", \"1\"); 
	     var_select= document.form1.id_campo_tabla.value;
	     chart1.setDataURL(\"sgs/estadisticas_opcionales/graf_def.php\"); 
	     chart1.render(\"chart1div2_$tabla\");
     
      }
      
        function addcriterio(critVar){
	    var_select= document.form1.id_campo_tabla.value;
            var url= '?accion=$accion&act=6&axj=1&criterio='+critVar+'&tipo='+var_select;
	   
	    ObtenerDatos(url,'criterios');
	    updateChart();
	    
	    
         }
	 
	 
	 
	 function delcriterios(){
	   
	    ObtenerDatos('index.php?accion=$accion&act=7&axj=1','criterios');
	    $(\"#desde\").val()=\"\";
	    updateChart();
         }
	 
	
function eliminar_row(id, element){
    
   
    var resultado = 0;
    
    $.post(    
      \"index.php?accion=$accion&act=8&axj=1\", //Ajax file
      { \"id\": id },  // create an object will all values
   
    	
      function(data){    	 
    	 	 resultado = data.returnValue; 
	       if (resultado) {
	       	 element.remove();
		 updateChart();	
	       }
    	},
     	
    	\"json\"
    );
  }
	   $(document).ready(function() {

        
   
    
    $('a.eliminar', this).live('click',function(){
    	var currentId = $(this).attr('id'); 
    	$(this).html('<img border=\"0\" src=\"images/ajax-loader.gif\">');
    	eliminar_row(currentId,$(this).parents(\"tr:first\"));
	
    });
  });
  
  
	 
	</script>
	

";

}
?>