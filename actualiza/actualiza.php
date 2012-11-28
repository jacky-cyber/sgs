<?php


$version= version();

include("admin/server_info/server_info.php");



$tablas_verifica = configuracion_cms('tablas_verifica');

$variables_sistema =configuracion_cms('variables_sistema');





 $base_compara = $_POST['base_compara'];
switch ($act) {
     case 1:
	 include("actualiza/analisis.php");

	
    	
	 break;
	 case 2:
    
     break;
		  case 3:
		  include("actualiza/actualiza_traspasa_datos.php");
		  
		  include("actualiza/analisis_datos_actual.php");
		  
		  
         $contenido = "<div class=\"alert alert-success\">
			 <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                         <tr>
                           <td align=\"center\" class=\"textos\"><h3>Actualizaci&oacute;n Completa. </h3></td>
                         </tr>
						
						 <tr><td align=\"center\" class=\"textos\">$datos_actual </td></tr>  
                       </table></div><br>
		       <div class=\"alert alert-warning\"><h2><a href=\"index.php?accion=Salir\">Clikea aqu&iacute; para Salir</a></h2></div>";
					
		    include("cache/borrar_cache.php");
		     $_SESSION = array(); // reset session array
		    session_destroy();   // destroy session.
		    
		    
		    foreach($_SESSION as $variable=>$valor){
				 $_SESSION[$variable]="";
				  }
	  break;
      case 4:
	  
	//  $contenido =  "sdfdsfadf";
    	
	 break;
	 case 2:
    
     break;

   	default:
	  
	 
	/*
		Lista de bases disponibles
	*/
	
	

  
$js .="<script>

$(document).ready(function(){
   $(\"#mostar_paso2\").click(function(evento){
      if ($(\"#mostar_paso2\").attr(\"checked\")){
       	 $(\"#aviso\").fadeOut(300); 
		 $(\"#paso2\").fadeIn(300); 
	     
	   }else{
         $(\"#paso2\").fadeOut(300); 
		 $(\"#paso3\").fadeOut(300); 
         $(\"#aviso\").fadeIn(300); 
      }
   });
   
   $(\"#mostar_paso3\").click(function(evento){
      if ($(\"#mostar_paso3\").attr(\"checked\")){
       
		  $(\"#paso3\").fadeIn(300); 
	   }else{
         $(\"#paso3\").fadeOut(300); 
      }
   });
   
});

	function procesar_actualiza(url)
		{
		var url_consulta=url;
		

		
			$.ajax ({
				url:  url_consulta,								/* URL a invocar asíncronamente */
				type: 'post',										/* Método utilizado para el requerimiento */
				data: $('#form1').serialize(),		/* Información local a enviarse con el requerimiento */
				
				async:true,
       			beforeSend: function(objeto){ /*mostramos un mensaje de espera*/
          		   $('#div_cargando').show(); 
				   $('#contenido_paso2').hide();
				   $('#boton').attr('disabled',true);
       			 },
				success: function(request, settings)/* Que hacer en caso de ser exitoso el requerimiento */
				{	
					 $('#div_cargando').hide();
					 $('#contenido_paso2').show(); 
					 $('#contenido_paso2').html(request); /*Mostramos resultados del php*/
					 $('#boton').attr('disabled',false);
					 //  resetForm('form1');
				},
				error: function(request, settings)/*Upsss... algun problema*/
				{
					$('#contenido_paso2').html('Error');
				}				
			});
		}


		function actualiza_datos(url)
		{
		var url_consulta=url;
		

		
			$.ajax ({
				url:  url_consulta,								/* URL a invocar asíncronamente */
				type: 'post',										/* Método utilizado para el requerimiento */
				data: $('#form1').serialize(),		/* Información local a enviarse con el requerimiento */
				
				async:true,
       			beforeSend: function(objeto){ /*mostramos un mensaje de espera*/
				   $('#div_cargando_paso3').show(); 
				   $('#contenido_paso3').hide();
				   $('#boton').attr('disabled',true);
       			 },
				success: function(request, settings)/* Que hacer en caso de ser exitoso el requerimiento */
				{	
					 $('#div_cargando_paso3').hide();
					 $('#contenido_paso3').show(); 
					 $('#contenido_paso3').html(request); /*Mostramos resultados del php*/
					 $('#boton').attr('disabled',false);
					 //  resetForm('form1');
				},
				error: function(request, settings)/*Upsss... algun problema*/
				{
					$('#contenido_paso3').html('Error');
				}				
			});
		}


$(document).ready(function () 
		{
			$('#base_compara').change(function() 
			{ procesar_actualiza('index.php?accion=$accion&act=1&axj=1');
			});
		});

</script>
";   

$db_list = mysql_list_dbs($DB);

while ($db = mysql_fetch_object($db_list))
  {
  
 $base = $db->Database;
  	if($base==$base_compara){
	$lista_bases .=  "<option value=\"$base\" selected>$base</option><br />";
	}else{
	$lista_bases .=  "<option value=\"$base\">$base</option><br />";
	}
  
  }
  
	

    
$contenido = " <input type=\"hidden\" name=\"mostar_paso3\" id=\"mostar_paso3\"><div id=\"paso1\">
<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
 <tr><td align=\"left\" class=\"textos_h2\">Paso 1 >> Respaldo de base de datos actual </td></tr>
  <tr>
    <td align=\"left\">
<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
    
	<tr>
        <td class=\"textos\"  align=\"center\">
	  <h2>Actualizaci&oacute;n de Estructura de Base de Datos Generica de 
	   $version</h2>
	    </td>
     </tr>
	 
	   <tr><td align=\"center\" class=\"textos\">Ya realice el respaldo, seguir al siguiente paso 
	  <input type=\"checkbox\" name=\"mostar_paso2\" id=\"mostar_paso2\"></td></tr> 
	 <tr>

	  <td   align=\"center\" >
	  
	   <table width=\"100%\"  style=\"width:500px; \" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"tabla_amarillo\">
          
		  <tr>
            <td align=\"center\" class=\"textos\">
			
			<b>Aviso:</b>Antes de ejecutar la actualizaci&oacute;n, 
			le recordamos realizar un respaldo de la base de datos. Puede respaldar de forma r&aacute;pida 
	  <a href=\"index.php?accion=respaldo-de-bd\"><strong>AQU&Iacute;</strong></a><br><br>
	  		
	  </td>
            </tr>
      	</table>
	  
	  
	  </td></tr>

	

 
 </table>
</td>
  </tr>
  <tr>
    <td align=\"center\">

	  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr >
          <td align=\"center\" >
		  <div id=\"contenido2\" ></div>
		  </td>
          </tr>
    	</table>
</td>
  </tr>
</table>
</div>


<br>
<div id=\"paso2\" style=\"display:none\">
 <table width=\"100%\"  border=\"0\"  cellpadding=\"2\" cellspacing=\"2\">
   <tr><td align=\"left\" class=\"textos_h2\">Paso 2 >> Configuraci&oacute;n de origen de datos </td></tr>
   <tr><td align=\"center\" class=\"textos\">
     <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro_light\">
       	  <tr><td align=\"center\" class=\"textos\">Seleccione la Base de Datos de origen del Sgs antiguo </td></tr> 
	  <tr><td align=\"center\" class=\"textos\">
				 <select name=\"base_compara\" id=\"base_compara\">
  						$lista_bases
  
  				</select>
				 </td></tr> 
				
      <tr><td align=\"center\" class=\"textos\"><div id=\"contenido_paso2\" ></div>
	</td></tr>         
   	</table>
    </td></tr> 
	
	  
	
 </table>
</div>


<br>
<div id=\"contenido_paso3\"></div>

<div id=\"paso3\" style=\"display:none\">
 <table width=\"95%\"  border=\"0\"  cellpadding=\"0\" cellspacing=\"0\">
   <tr><td align=\"left\" class=\"textos_h2\">Paso 3 >> Configuraci&oacute;n de origen de datos </td></tr>
   <tr><td align=\"center\" class=\"textos\">
     <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro_light\">
       	 <tr> <td align=\"center\" class=\"textos\"></td></tr>
	  <tr><td class=\"textos\"  align=\"center\" >
	  <h2>Nombre de la Base de Datos a modificar: <strong>\"$DATABASE\"</strong></h2></td></tr>
	  <tr><td class=\"textos\"  align=\"center\" >Informaci&oacute;n actual presente en la 
	  base de datos</td></tr> 
	  <tr><td class=\"textos\"  align=\"center\">$info_base</td></tr> 
	  <tr><td class=\"textos\"  align=\"center\" >
	  <div id=\"contenido\">Para realizar el proceso de actualizaci&oacute;n  haga clic <br>
	  <a href=\"#\"  onclick=\"ObtenerDatos('index.php?accion=$accion&act=1&axj=1','contenido2');\">
	  <h2><strong>Aqu&iacute;</strong></a></h2></div> 
	  </td></tr> 
	  <tr><td align=\"center\" class=\"textos\">&nbsp;</td></tr>         
   	</table>
    </td></tr> 
	  <tr >
       <td class=\"textos\" align=\"center\" class=\"textos\">
	   
	   <div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
		   </td>
       </tr>
 </table>
</div>
  <div align=\"center\" style=\"display:none\" id=\"div_cargando_paso3\" >Importando datos, Espere...
  <img src=\"images/ajax-loader.gif\" alt=\"\" border=\"0\"></div>
		  
<br><br>
$server_info
	
	 ";
// 
	 }
?>
