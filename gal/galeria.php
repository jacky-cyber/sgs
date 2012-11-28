<?php

switch ($act) {
     case 1:
         include ("gal/galeria2.php");
         break;
	 case 2:
         include ("contenido/VerContenido.php");
         break;
   	default:
	    include ("gal/ult_gal.php");
	 
       
 }

?>