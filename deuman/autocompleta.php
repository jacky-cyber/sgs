<?php
/*
Este php entrega los li necesarios para funcion de auto completado de campos de texto

* 
* ejem: 
* 
* 
* 	$campo_ciudad="<input type=\"text\" id=\"ciudad\" name=\"ciudad\" value=\"$ciudad\" size=\"15\" onkeyup=\"lookup(this.value,'ciudad','usuario');\"/>
	
			
			<div class=\"suggestionsBox\" id=\"suggestions\" style=\"display: none;\">
				<img src=\"images/upArrow.png\" style=\"position: relative; top: -12px; left: 30px;\" alt=\"upArrow\" />
				<div class=\"suggestionList\" id=\"autoSuggestionsList\">
					&nbsp;
				</div>
			</div>";
			* 
* 
* 
 js esta funcion se encuentra en js/deuman.js
 

	function lookup(inputString,campo_input,tabla_input) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			$.post("deuman/autocompleta.php", {queryString: ""+inputString+"",campo: ""+campo_input+"",tabla: ""+tabla_input+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} // lookup
	
	function fill(thisValue,campo) {
		$("#"+campo).val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
	 
			
*/
include("../lib/connect_db.inc.php");    
include("../lib/lib.inc.php");    
include("../lib/lib.inc2.php");    
include("../lib/seguridad.inc.php");    


	 $campo= $_POST['queryString'];
	 $campo_input= $_POST['campo'];
	 $tabla= $_POST['tabla'];
	
   			
			  $query= "SELECT DISTINCT $campo_input
                       FROM  $tabla
                       WHERE $campo_input like '$campo%'";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  while (list($value) = mysql_fetch_row($result)){
				  	$value = ucwords(strtolower($value));
            			
						echo "<li onClick=\"fill('$value','$campo_input');\">$value</li>\n";				
									   
            		 }

?>