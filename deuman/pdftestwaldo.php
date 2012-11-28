<?php

include 'dompdf2/dompdf_config.inc.php';

$html = "<html>
<head>
<style>



</style>
</head>

<body>

<table width=\"100%\" border=\"1\" >
<tr>
	<td width=\"20%\"><img src=\"dompdf_simple.png\"/></td>
	<td width=\"80%\">
 <P ALIGN=\"right\" ID=\"p1\">Sub Departamento Atenci&oacute;n Virtual</P>
 <P ALIGN=\"right\" ID=\"p2\">Departamento Gesti&oacute;n Canales No Presenciales</P> 
 <P ALIGN=\"right\" ID=\"p3\">Divisi&oacute;n Atenci&oacute;n a Clientes</P>
 <P ALIGN=\"right\" ID=\"p4\">www.ips.gob.cl - 600 370 0100</P>
 <P ALIGN=\"right\" ID=\"p5\">Instituto de Previsi&oacute;n Social</P></td>
</tr>
</table>

</body>
</html>";



$dompdf = new DOMPDF();

$dompdf->load_html($html);

$dompdf->render();

//permitir al usuario descargar pdf - lo usual

//$dompdf->stream("doc.pdf");



//o guardarlo en el servidor

$archivo = "documento.pdf";

$arch = fopen($archivo, 'w');

//sacar codigo del documento pdf

$contenido = $dompdf->output();

//guardar en archivo

fwrite($arch, $contenido);

echo "<h3>PDF Creado...</h3>";

fclose($arch);

?>