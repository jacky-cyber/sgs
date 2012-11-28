<?php
$pollid = $_GET['pollid'];
include ("poll/pastpoll.php");
switch ($act) {
     case 1:
       //  include ("poll/pastpoll.php");
         break;
	 case 2:
	 
         include ("poll/pastresults.php");
         break;
   	default:
	 // include ("poll/pastpoll.php");
	 
       
 }

?>