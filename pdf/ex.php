<?php
require('html_table.php');



$pdf=new PDF_HTML_Table();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->WriteHTML("Start of the HTML table.<BR>$htmlTable<BR>End of the table.");
$pdf->Output();
?>
