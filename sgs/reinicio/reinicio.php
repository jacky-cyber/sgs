<?php

 
//include("../lib/connect_db.inc.php");    
session_start();
$id_sesion = session_id();


$borrar = $_POST['borrar'];



if($borrar=="" ){

$contenido = "<table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">
				  <font color=\"#FF0000\"><h1>Esta operaci&oacute;n  borrar&aacute; todo registro del Sgs &iquest;Est&aacute; 100% seguro de realizarla?</h1></font> 
				  </td>
                </tr>
				<tr><td align=\"center\" class=\"textos\"><font color=\"#FF0000\">Esto borrar su propia cuenta</font>  </td></tr> 
				<tr><td align=\"center\" class=\"textos\">Si lo estoy <input type=\"checkbox\" id=\"borrar\" name=\"borrar\" value=\"$id_sesion\"> &nbsp;&nbsp;&nbsp;
				<a href=\"index.php\">No... no lo estoy</a> </td></tr> 
				<tr>
				<tr><td align=\"center\" class=\"textos\">Contrase&ntilde;a de base de datos <input type=\"text\" name=\"passbd\" id=\"passbd\" value=\"...\"> </td></tr> 
				<td align=\"center\" class=\"textos\"><input type=\"submit\" name=\"Submit\" value=\"Yo $nombre_usuario acepto borrar SGS, ya realice un respaldo de la base de datos.\"> </td></tr> 
              </table>";
}elseif($borrar==$id_sesion and $_POST['passbd']==$DB_PASSWORD){

$fp=fopen("sgs/reinicio/sql_reinicio.txt","r");



while ($linea=fgets($fp,1024))
      {
      	 if(trim($linea)!=""){
	    	    mysql_query($linea) or die("2: Error en insert a la base de datos $linea <br>".mysql_error());
				$contenido .= $linea."<br>";
	
		 }
      }






$fecha = date(y)."-".date(m)."-".date(d);
$fecha_hora =date('Y-m-d h:i:s');
if($act==""){
$act=0;
}

if(!is_numeric($accion)){
$accion = traduce_accion($accion);
}

$url =$_SERVER["REQUEST_URI"];

$ip = $_SERVER['REMOTE_ADDR'];
$origen = $_SERVER['HTTP_REFERER'];
$id_usuario     = id_usuario($id_sesion);
$datos_post= trim($datos_post);
$qry_insert="INSERT INTO estadisticas_acciones(id_accion,act,fecha,id_usuario,hora,click,url,datos_post,ip,origen) 
						 values ('$accion','$act','$fecha','$id_usuario','$fecha_hora',1,'$url','$datos_post','$ip','$origen')";
   
	if(cms_query($qry_insert)){
	//echo $qry_insert;    
	}else{
	//echo mysql_error();
	}


}elseif($_POST['passbd']!=$DB_PASSWORD){
	
	$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                      <td align=\"center\" class=\"textos\">No es posible completar la solicitud.</td>
                    </tr>
                  </table>";
}
?>