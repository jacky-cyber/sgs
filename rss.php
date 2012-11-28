<?php
/*
//Definimos los datos de conexión con nuestra base de datos
$connect=mysql_connect("direccion_server_db","user_db","clave_db")
or die ("Imposible conectar");
$base="nombre_bd";
 */
// Definimos variables globales


include("lib/connect_db.inc.php");    
include("lib/seguridad.inc.php");    
include("lib/lib.inc.php");    
include("lib/lib.inc2.php");    
/*

$charset= 'iso-8859-1';
$rss_titulo = 'RSS de Sgs Transparencia';
$rss_url = 'http://sgs.probidadytransparencia.gob.cl/';
$rss_descripcion = 'Noticias de Sgs Transparencia';
$rss_email = 'transparencia@probidadytransparencia.gob.cl';
 
// Header para escribir XML
header("Content-type: application/rss+xml; charset='$charset'", true);
// Escribimos el archivo RSS
echo "<?xml version=\"1.0\" encoding=\"$charset\"?>";
echo'<rss version="2.0">
 <channel>
 <docs>'.$rss_url.'</docs>
 <title>'.$rss_titulo.'</title>
<link>'.$rss_url.'</link>
 <description>'.$rss_descripcion.'</description>
 <language>es</language>
<pubDate>'.date("Y-m-d",strtotime("now")).'</pubDate>'."\r".'
<lastBuildDate>'.date("Y-m-d",strtotime("now")).'</lastBuildDate>'."\r".'
 <managingEditor>'.$rss_email.'</managingEditor>
 <webMaster>'.$rss_email.'</webMaster>';
 
*/
$query = "SELECT id_actualizacion,fecha,hora,titulo,descripcion  
		FROM deuman_actualizaciones order by fecha desc";
$result= cms_query($query)or die (error($query,mysql_error(),$php));
while (list($id_actualizacion,$fecha,$hora,$titulo,$descripcion) = mysql_fetch_row($result)){
   //$titulo= acentos_inverso($titulo);
   $descripcion= htmlentities($descripcion);
   $descripcion = "texto test de sistema" ;
   $cont++;
  /* 						   
$var .= "<item>" ;
	echo "<title>$titulo</title>" ;
	echo "<link>$rss_url</link>";
	echo "<description>$descripcion</description>";
	echo "</item>";
*/

$var .="<item>
    <title>Tutorialzine: @jankowarpspeed Congrats on the re-design, it looks great!</title>
    <description>Tutorialzine: @jankowarpspeed Congrats on the re-design, it looks great!</description>
    <pubDate>Wed, 10 Feb 2010 16:27:44 +0000</pubDate>
    <guid>http://twitter.com/Tutorialzine/statuses/8907974393</guid>
    <link>http://twitter.com/Tutorialzine/statuses/8907974393</link>
  </item>";
 }
		
		

 /*
echo "</channel>";
echo "</rss>";
*/

echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<rss xmlns:atom=\"http://www.w3.org/2005/Atom\" version=\"2.0\" >
  <channel>
    <title>Twitter / Tutorialzine</title>
    <link>http://twitter.com/Tutorialzine</link>
    <atom:link type=\"application/rss+xml\" href=\"http://twitter.com/statuses/user_timeline/67315866.rss\" rel=\"self\"/>
    <description>Twitter updates from Martin / Tutorialzine.</description>
    <language>en-us</language>
    <ttl>$cont</ttl>
 $var
  </channel>

</rss>
";

?>

