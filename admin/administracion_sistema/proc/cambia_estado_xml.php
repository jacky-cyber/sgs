<?php
//en el switch creas el act que cambie el estado del campo xml a 1 o 0 dependiendo del estado actual si es 1 entonces lo cambiamos por un cero


$id_campo = $_GET['id_campo'];
//echo $id_campo. "</br>";
$query= "SELECT xml
FROM auto_admin_campo
WHERE id_campo='$id_campo'";
$result= cms_query($query)or die (error($query,mysql_error(),$php));
list($xml) = mysql_fetch_row($result);
//echo $xml;

if($xml==1){
//echo $xml."hola";
$Sql ="UPDATE auto_admin_campo 
	   SET xml=0 WHERE id_campo ='$id_campo'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
//update a la xml.tabla =0 donde el id_campo sea XX
//echo $sql;
echo "<span class=\"icon-remove\"></spam>";

}else{
//echo "chao";
$Sql2 ="UPDATE auto_admin_campo 
	   SET xml='1'
	   WHERE id_campo ='$id_campo'";

 cms_query($Sql2)or die (error($Sql2,mysql_error(),$php));

//update a la xml.tabla =1 donde el id_campo sea XX
echo "<span class=\"icon-ok\"></spam>";
}


                                        
                                        
?>