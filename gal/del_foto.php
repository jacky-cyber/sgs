<?php
include("../lib/lib.inc");  
include("../lib/connect_db.inc");    

$id_cliente = $_GET['id_cliente'];
$id_galeria = $_GET['id_galeria'];
$imagen = $_GET['imagen'];


$link_del= "$id_cliente/$id_galeria/$imagen";
	
	
	if(is_file($link_del)){
			if(unlink($link_del)){
 			$Sql ="DELETE FROM imagenes where id_galeria='$id_galeria' and imagen1='$imagen'";

 cms_query($Sql);
  				
			$html ="<html>
            <head>
			
		<style>
		textos {
        	font-family: Verdana, Arial, Helvetica, sans-serif;
        	font-size: 11px;
        	color: #000000;
        	
        	
        }
        </style>
			
            <title>Foto Borada </title>
            <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
            </head>
            
            <body bgcolor=\"#FFFFFF\" text=\"#000000\">
            		  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">Foto borrada con exito</td>
                          </tr>
						  <tr><td align=\"center\" class=\"textos\">
						  <A HREF=\"#\" ONCLICK=\"window.history.back();\"> Volver a la página anterior </A>
						  </td></tr> 
                    	</table>
            </body>
            </html>";
			
			echo $html;
			
			sleep(3);
			
			
			
			}


	}





?>