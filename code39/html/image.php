<?php


$code='code128';
$o=1;
$t=30;
$r=1;

$f1='Arial.ttf';
$f2=8;
//$a1=;
$a2='B';
//$a3=

//require('config.php');
	require('../class/BCGColor.php');
	require('../class/BCGBarcode.php');
	require('../class/BCGDrawing.php');
	require('../class/BCGFont.php');
	include('../class/BCGcode128.barcode.php');
		
                $font = new BCGFont('../class/font/Arial.ttf', intval($f2));
                
		$color_black = new BCGColor(0, 0, 0);
		$color_white = new BCGColor(255, 255, 255);
		$codebar = 'BCGcode128';
		$code_generated = new $codebar();
		
		$code_generated->setStart($a2);
                
		
		$code_generated->setThickness($t);
		$code_generated->setScale($r);
		$code_generated->setBackgroundColor($color_white);
		$code_generated->setForegroundColor($color_black);
		$code_generated->setFont($font);
		$code_generated->parse($_GET['text']);
		$drawing = new BCGDrawing('', $color_white);
		$drawing->setBarcode($code_generated);
		$drawing->draw();
		$drawing->finish(intval($o));
		
		

?>