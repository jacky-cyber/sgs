<?php
//	error_reporting();
	//error_reporting(0);
	
	//error_reporting(E_ERROR | E_WARNING | E_PARSE);
	
	
require_once("deuman/dompdf/dompdf_config.inc.php");

$contenido = $_SESSION['html_sess'];
$html ='<html>
        <head>
        <title>$nombre_pag</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        </head>
		<link href="http://sgs.probidadytransparencia.gob.cl/bkp_101/sgs_ips/sgs1.1/images/sitio/sgs/css/606006.css" rel="stylesheet" type="text/css" />
         <link href="http://sgs.probidadytransparencia.gob.cl/bkp_101/sgs_ips/sgs1.1/images/sitio/sgs/css/base_print.css" rel="stylesheet" type="text/css" />
        <body >'.$contenido.'<br>
		  <table width="300"  border="0" align="center" cellpadding="0" cellspacing="0" class="datos_sgs_print">
            <tr >
              <td align="center" class="alt">dfg dfsgsdfg sdf</td>
              </tr>
        	 <tr >
              <td align="center" class="textos">dfg dfsgsdfg sdf</td>
              </tr>
        	 <tr >
              <td align="center" class="textos">dfg dfsgsdfg sdf</td>
              </tr>
        	</table>
		<img src="image.png" alt="" border="0" \>
		
		<style>
.a { font-style: italic; }
.b { font-weight: bold; }
.c { color: red; }

</style>

<p class="a">class="a"</p>
<p class="b">class="b"</p>
<p class="c">class="c"</p>
<p class="a b">class="a b"</p>
<p class="a b c">class="a b c"</p>

		</body>
        </html>';



$dompdf = new DOMPDF();

$dompdf->load_html($html);

$dompdf->render();

$dompdf->stream("sample.pdf");


/*

	
.datos_sgs_print td.alt {
  background: none repeat scroll 0 0 #EFEFEF;
  font-weight: bold;
  text-align: left;
}

.datos_sgs_print td {
background:none repeat scroll 0 0 #FBFBFB;
padding:4px 4px 4px 6px;

}

.datos_sgs_print td {
border:1px solid #B9D0CD;
text-align : left;
}
.datos_sgs_print td.centro {

text-align : center;
}

.datos_sgs_print th {

background: url(../images/line-top.jpg) repeat scroll left top;
color:#13456A;
font-size:12px;
font-weight:bold;
padding:7px 4px 2px 4px;
border:1px solid #B9D0CD;

}


caption, th {
text-align:left;

}

.datos_sgs_print table {
  border-collapse: collapse;
  border-spacing: 0;
  font-size: 12px;
  margin-left: 0;

}


.datos_sgs_print caption {
color:13456A;
font-size: 0.9em;

font-style:italic;
margin:4px 0 -17px;
padding-right:10px;
text-align:right;
}

.mensaje {
  font-family: Arial,Helvetica,sans-serif;
  font-size: 10px;
  font-style: italic;
  margin: 8px;
  padding: 0 5px 0 2px;
  text-align: right;
}
.comprobante {
  font-family: Arial,Helvetica,sans-serif;
  font-size: 12px;
  text-align: right;
}
*/


?>