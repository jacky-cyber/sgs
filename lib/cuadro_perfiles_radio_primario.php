<?php


	$tipo="checkbox";
		
	$js .= "<script type=\"text/javascript\" src=\"js/prototype.js\"></script>
	
	<script language=\"javascript\"  type=\"text/javascript\">

//////////////////////////////////


function sendQuerystring(pagina2){
		
		var url = \"lib/perfiles_ajax2.php?tipo=$tipo\";
 		var pars = 'id_p_check='+ pagina;
        var myAjax = new Ajax.Updater( 'resultado2', url, { method: 'get', parameters: pars });
		}

2

</script>";	
		
	
	
		
		
	if($id_p_check=="")	{
	include("lib/genera_perfiles2.php");
	
	}
	
	

	
	
	$check_perfiles_check="<div id=\"resultado2\">
					 $check_perfiles_check
						</div>";
		
?>