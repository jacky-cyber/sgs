<?php
$id = $_GET['id'];
$tipo_new = $_GET['tipo_new'];

/*******************************************
** Realiza la conexion a la base de datos **
*******************************************/
include("../lib/connect_db.inc");


/***************************************************
** Si el orden de las categorias no esta definido **
** se ordena por defecto por id_categoria.        **
***************************************************/
if (empty($orden)) $orden='id_contenido';



/**********************************************************
** Selecciona todos las contenidos almacenados en la BD. **
**********************************************************/
/*$query = "SELECT c.id_contenido,
                 c.imagen,
                 c.titulo,
                 c.visible,
                 ct.descripcion
          FROM contenidos c, contenido_tipo ct
          WHERE c.id_tipo=ct.id_tipo
          ORDER BY $orden";
$result = cms_query($query) or die ("problemas en la consulta 1.<br>$query");*/
$query = "SELECT *
          FROM noticias
          ORDER BY id_noticia";
$result = cms_query($query) or die ("problemas en la consulta 1.<br>$query");

$num = mysql_num_rows($result);

?>
<html>
<head>
<title>Mantenci&oacute;n de categorias</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<STYLE type=text/css>
A.link1        {COLOR: #FFFFFF; FONT-FAMILY: Arial, Helvetica, sans-serif; FONT-SIZE: 10pt; FONT-STYLE: normal; TEXT-DECORATION: none }
A.link1:hover {        COLOR: #6699FF; FONT-SIZE: 10pt; FONT-WEIGHT: bold; TEXT-DECORATION: none }
A.link2 { font-family: Arial, Helvetica, sans-serif; font-size: 10pt; text-decoration: none; font-weight; color: #0000ff; font-style: normal}
A.link2:Hover { font-size: 10pt;color: #000000; text-decoration: underline; font-weight }
</STYLE>
</head>
<body bgcolor="#FFFFFF" text="#666666" link="#000000" vlink="#000000" alink="#000000">
<?php echo $CABECERA_PAGINA; ?>
<p>&nbsp;</p>
<p align="center"><font size="3" face="Arial, Helvetica, sans-serif" color="#FF0000"><b><font color="#990000">Mantenci&oacute;n
  de contenido</font></b></font></p>
<br>
<table bgcolor="#000000" align="center" cellspacing="0" cellpadding="0" border="0" width="600">
  <tr>
    <td bgcolor="#999999">
      <table align="center" width="100%" height="67" cellspacing="1">
        <tr bgcolor="#CC6600" align="center" valign="middle">
          <td height="2" width="66">
            <div align="center"><font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><b>Imagen</b></font></div>
          </td>
          <td height="2" width="243"><font color="#FFFFFF"><b><font face="Arial, Helvetica, sans-serif" size="2">Titulo</font></b></font></td>
          <td height="2" width="79"><font face="Arial, Helvetica, sans-serif" size="2"><b><font color="#FFFFFF">Visible</font></b></font></td>
          <td height="2" width="78">
            <div align="center"><b><font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><a class=link1 href="mantencion_categoria.php3?orden=nombre_cat_esp">Tipo</a></font></b></div>
          </td>
          <td colspan="2" height="2">
            <div align="center"><font color="#FFFFFF"><b><font face="Arial, Helvetica, sans-serif" size="2">Acci&oacute;n</font></b></font></div>
          </td>
        </tr>
        <?php
if ($num > 0)
   {
    while  (list($id_contenido, $imagen, $titulo, $visible, $descripcion) = mysql_fetch_row($result))
           {
?>
        <tr bgcolor="#E5E5E5">
          <td height="43" bgcolor="#FFFFFF" width="66" align="center" valign="middle"><img src="../../imagenes_clasificadas/imagenes_chicas/<?php echo $imagen ?>" width="100" height="100"></td>
          <td height="43" bgcolor="#FFFFFF" width="243"><font face="Arial, Helvetica, sans-serif" size="2" color="#000000">
            <?php echo $titulo ?>
            </font></td>
          <td height="43" bgcolor="#FFFFFF" width="79" align="center" valign="middle"><font face="Arial, Helvetica, sans-serif" size="2" color="#000000">
            <?phpecho $visible?>
            </font></td>
          <td height="43" bgcolor="#FFFFFF" width="78" align="center" valign="middle"><font face="Arial, Helvetica, sans-serif" size="2" color="#000000">
            <?php echo $descripcion ?>
            </font></td>
          <td align="center" bgcolor="#E8F2FD" height="43" width="58"><font face="Arial, Helvetica, sans-serif" size="2"><a class=link2 href="<?php echo "EditarContenido.php?id_contenido=$id_contenido"; ?>"><font color="#000000">Editar</font></a></font></td>
          <td align="center" bgcolor="#E8F2FD" height="43" width="55"><font face="Arial, Helvetica, sans-serif" size="2"><a class=link2 href="<?php echo "BorrarContenido.php?id_contenido=$id_contenido"; ?>"><font color="#000000">Borrar</font></a></font>
          </td>
        </tr>
        <?php
           }
   }
else
   {
      echo "<div align=center><font face=Arial size=3 color=#000000>No se han encontrado categorias</font></div>";
   }
?>
      </table>
    </td>
  </tr>
</table>
<p><br>
</p>
<table width="250" align="center" bgcolor="#FFFFFF" cellspacing="0">
  <tr>
    <td align="center" valign="middle" height="2"><font face="Arial, Helvetica, sans-serif" size="2" color="#000000"><a class=link2 href="AgregarContenido.php">Agregar
      nuevo contenido</a></font></td>
  </tr>
</table>
<p><br>
</p>
<p>
  <?php echo $PIE_PAGINA; ?>
</p>
</body>
</html>
