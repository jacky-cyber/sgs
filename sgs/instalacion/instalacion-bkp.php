<?php 


switch ($act) {
     case 1:
         include ("sgs/instalacion/actualiza.php");
		  header("Location:index.php");		   
		 break;
	
   	default:
	
	$accion_form = "index.php?accion=$accion&act=1";
	include("sgs/instalacion/instalador.php");
	   
 }
	
?>