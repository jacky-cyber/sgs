<?php



		
	$jsXX .="<script type=\"text/javascript\" src=\"js/prototypeXXX.js\"></script>
	
	<script language=\"javascript\"  type=\"text/javascript\">

//////////////////////////////////


function sendQuerystring(pagina){
		
		var url = \"lib/perfiles_ajax.php\";
 		var pars = 'id_p_check='+ pagina;
        var myAjax = new Ajax.Updater( 'resultado', url, { method: 'get', parameters: pars });
		}



////////////////////////////////////
 
 function sendcolegiocontenido(colegiocontenido){
 		
 		var urlColcont = \"lib/borra_contenido.php\";
 		var pars = 'vari='+ colegiocontenido;
        var myAjax = new Ajax.Updater( 'resultadoColCont', urlColcont, { method: 'get', parameters: pars });
		}

/////////////////////////////////////

//////////////////////////////////

function sendperfilcontenido(perfilcontenido){
		
		var urlpfcont = \"lib/borra_perfil_contenido.php\"; 
 		var pars = 'vari='+ perfilcontenido;
        var myAjax = new Ajax.Updater( 'resultadoPerfCont', urlpfcont, { method: 'get', parameters: pars });
		}
/////////////////////////////////



</script>";	
		
		
	$js.="
		  
		  
		 ";
	
		
		
	if($id_p_check=="")	{
	include("lib/genera_perfiles.php");
	
	}
	
	

	
	
	$check_perfiles_check="<div id=\"resultado\">
					 $check_perfiles_check
				</div>";
		
?>