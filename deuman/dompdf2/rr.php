<?php


$html = "<table width=\"98%\" border=\"0\" >
  <tr>
    <td>#LOGO#</td>
    <td align=\"right\"><p align=\"right\" id=\"p1\">Centro de Atenci&oacute;n Previsional</p>
      <p align=\"right\" id=\"p2\">www.ips.gob.cl - 600 370 0100</p>
      <p align=\"right\" id=\"p3\">Instituto de Previsi&oacute;n Social</p></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align=\"right\"><p align=\"right\" id=\"p4\"3>Ticket Atenci&oacute;n Nro:#FOLIO#</p>
      <p align=\"right\" id=\"p5\">#FECHA#</p></td>
  </tr>
  <tr>
    <td colspan=\"2\">#TEXTO#</td>
  </tr>
  <tr>
    <td colspan=\"2\">SALUDA ATENTAMENTE A USTED</td>
  </tr>
  <tr>
    <td colspan=\"2\"><p align=\"center\" id=\"p7\"2>#FIRMA#</p>
      <p align=\"center\" id=\"p8\">JEFE CENTRO DE ATENCION PREVISIONAL IPS #NO DEFINIDO#</p>
      <p align=\"center\" id=\"p9\">DIVISION ATENCION CLIENTES</p></td>
  </tr>
  <tr>
    <td colspan=\"2\"><p align=\"left\" id=\"p10\"2>CC.- ARCHIVO CAP</p>
      <p align=\"left\" id=\"p11\">template 3 - Formato Respuesta Jefe CAP</p>      <p align=\"right\" id=\"p1\"2>&nbsp;</p></td>
  </tr>
</table>";


$rnd = rand(1,5);


$carpeta = "docs/nombre_".$rnd;
mkdir($carpeta,0777);


require_once("dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();



$save_file =true;

$file = "respuesta_$folio.pdf";
if ( $save_file ) {
//   if ( !is_writable($outfile) ) 
//     throw new DOMPDF_Exception("'$outfile' is not writable.");
  if ( strtolower(DOMPDF_PDF_BACKEND) == "gd" ) 
    $outfile = str_replace(".pdf", ".png", $outfile);
    
  list($proto, $host, $path, $file) = explode_url($outfile);
  if ( $proto != "" ) // i.e. not file://
    $outfile = $file; // just save it locally, FIXME? could save it like wget: ./host/basepath/file

  $outfile = realpath(dirname($outfile)) . DIRECTORY_SEPARATOR . basename($outfile);

  if ( strpos($outfile, DOMPDF_CHROOT) !== 0 )
    throw new DOMPDF_Exception("Permission denied. $carpeta");

  file_put_contents($outfile, $dompdf->output( array("compress" => 0) ));
  exit(0);
}else{
$dompdf->stream($file);
}






?>