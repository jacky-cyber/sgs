<?php




 $html ="<html>
 <head>
 <title>$nombre_pag</title>
 <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
 </head>
 

	

	<link rel=\"stylesheet\" href=\"js/jquery/tipsy/tipsy.css\" type=\"text/css\" />

	<script type=\"text/javascript\" src=\"js/jquery/tipsy/jquery.tipsy.js\"></script>
        
        
	<script type='text/javascript'>

	$(function() {

                $('.clase-tipsy').tipsy({fade: true ,gravity: 'w'}); // nw | n | ne | w | e | sw | s | se

    	});
        
        </script>
 <body bgcolor=\"#FFFFFF\" text=\"#000000\">
 <a href=\"index.php?accion=$accion\" class=\"clase-tipsy\" original-title=\"test de sistemas con texto descriptivo &ntilde;\">test</a>
 </body>
 </html>";
 
 echo $html;
 
 ?>