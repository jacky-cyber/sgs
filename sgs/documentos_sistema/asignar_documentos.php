<?php


$tagsHTML = html_template('contenedor_lista_de_archivos');
include ("chileatiende/documentos_sistema/formulario.php");
include ("chileatiende/documentos_sistema/listado.php");
$tagsHTML= cms_replace("#LISTA#",$lista,$tagsHTML);
$tagsHTML= cms_replace("#FORMULARIO#",$formulario,$tagsHTML);
$accion_form = "index.php?accion=$accion&act=3&folio=$folio&axj=1";

$contenido = cms_replace("#ADJUNTA_DOCUMENTOS#",$tagsHTML,$contenido);

?>