<?php

$html ="<html>
<head>
<title>$nombre_pag</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
</head>
<style>


#contenedor{
    text-align: left;
    width: 770px;
    margin: auto;
}
#cabecera{
    background-color: #d0d0ff;
    color: #333300;
    font-size:12pt;
    font-weight: bold;
    padding: 3 3 3 10px;
}
#cuerpo{
    margin: 5 0 5 0px;
}
#lateral{
    width: 160px;
    background-color: #999999;
    float:left;
}
#lateral ul{
    margin : 0 0 0 0px;
    padding: 0 0 0 0px;
    list-style: none;
}
#lateral li{
    background-color: #ffffcc;
    margin: 2 2 2 2px;
    padding: 2 2 2 2px;
    font-weight: bold;
}
#lateral a{
    color: #3333cc;
    text-decoration: none;
}

#principal{
    margin-left: 170px;
    background-color: #ffffff;
    padding: 4 4 4 4px;
    width: 560px;
	border: solid 1px;
}
#pie{
    background-color: #cccccc;
    padding: 3 10 3 10px;
    text-align:right;
    clear: both;
} 


</style>
<body bgcolor=\"#FFFFFF\" text=\"#000000\">
<div id=\"cuerpo\">

       <div id=\"lateral\">
          {MENU}
       </div>
       
       <div id=\"principal\">
	   
         {CONTENIDO}
       </div>
</div> 
</body>
</html>";

echo $html;

?>