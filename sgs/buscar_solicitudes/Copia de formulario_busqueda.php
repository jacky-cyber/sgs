<?php
$buscar_folio_sess = $_SESSION['buscar_folio_sess'];

$buscador= html_template('formulario_buscador');
					
$buscador = cms_replace("#BUSCAR_FOLIO_SESS#","$buscar_folio_sess",$buscador);
?>