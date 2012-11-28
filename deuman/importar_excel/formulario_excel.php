<?php



$js .="

<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}

</style>


<script type=\"text/javascript\">










$(document).ready(function () 
		{
			$('#boton').click(function() 
			{ procesar('index.php?accion=$accion&act=1&axj=1','div_respuesta');
			});
		});
		
		</script>



";



$accion_form = "index.php?accion=$accion&act=1";



$contenido = "  <table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
            <tr >
              <td align=\"center\" class=\"textos\">
			  <table   border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"2\">
                               <tr >
                                 <td align=\"center\" class=\"texnormalbold2\"><strong>Subir Excel</strong> >></td>
                                 <td align=\"center\" class=\"textos\"><strong>Indicar Titulos</strong> >></td>
                                 <td align=\"center\" class=\"textos\">Indicar Titulos</td>
                                 </tr>
                           	</table>
			  </td>
              </tr>
			  <tr><td align=\"center\" class=\"textos\">
			  
			  <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\" class=\"cuadro\">

				<tr><td align=\"center\" class=\"textos\">Ingresa Archivo Excel
				 </td>
				<td align=\"left\" class=\"textos\"><input type=\"file\" name=\"archivo_excel\" id=\"archivo_excel\"></td> </tr> 
				<tr><td align=\"center\" class=\"textos\">
				Fila de titulo  </td>
				<td align=\"left\" class=\"textos\" title=\"Indique la posici&oacute;n o numero de la fila de titulos\"><input type=\"text\" name=\"id_fila_titulo\" id=\"id_fila_titulo\"></td> </tr> 
				<tr><td align=\"center\" class=\"textos\" colspan=\"2\"> 
				<input type=\"submit\" id=\"boton\" name=\"boton\" value=\"Enviar\"></td></tr> 
              <tr><td align=\"center\" colspan=\"2\" class=\"textos_plomo\">* Solo archivos Excel 97-2003 (*.xls)</td></tr> 
			  </table><br>
			  <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
				     <tr >
				      <td class=\"textos\" align=\"center\" class=\"textos\">
					   <div id=\"div_respuesta\" align=\"center\"></div>
						<div id=\"div_cargando\" style=\"display:none\">Enviado datos, espere un momento...</div>
					   </td>
			       	</tr>
			 		</table>
			  
			   </td></tr> 
        	</table> 

";
?>