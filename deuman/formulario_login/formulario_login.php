<?php


if($_GET['axj']!=1){

 $js .= "<script language=\"JavaScript\">
	 	  $(document).ready(function () 
		{
			$('#boton').click(function() 
			{
			
			procesar('index.php?accion=login&axj=1','div_respuesta');
			});
		});
			
		  </script>";



 

$accion_form = "index.php?accion=login";
$contenido = html_template('formulario_login_back');

}else{
	$contenido = "<div class=\"alert alert-error\">Sesi&oacute;n Cerrada, debe loguearse nuevamente</div>";
}


 

?>