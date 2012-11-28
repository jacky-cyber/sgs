<?php


function returnGlobal($var,$type){
if (phpversion() >= "4.1.0") {
	if ($type == "SERVER") {
		return $_SERVER[$var];
	}
	if ($type == "POST") {
		return $_POST[$var];
	}
	if ($type == "GET") {
		return $_GET[$var];
	}
	if ($type == "SESSION") {
		return $_SESSION[$var];
	}
	if ($type == "REQUEST") {
		return $_REQUEST[$var];
	}
	if ($type == "COOKIE") {
		return $_COOKIE[$var];
	}
} else {
	if ($type == "SERVER") {
		return $_SERVER[$var];
	}
	if ($type == "POST") {
		return $HTTP_POST_VARS[$var];
	}
	if ($type == "GET") {
		return $HTTP_GET_VARS[$var];
	}
	if ($type == "SESSION") {
		return $HTTP_SESSION_VARS[$var];
	}
	if ($type == "REQUEST") {
		if ($HTTP_POST_VARS[$var] != "") {
			return $HTTP_POST_VARS[$var];
		} else if ($HTTP_GET_VARS[$var] != "") {
			return $HTTP_GET_VARS[$var];
		}
	}
	if ($type == "COOKIE") {
		return $HTTP_COOKIE_VARS[$var];
	}
}
}


 

$local_query = "SELECT VERSION() as version";
	$res = @mysql_query($local_query);
	$databaseVersion = @mysql_result($res, 0, 'version');
//echo "Mysql $databaseVersion<br>";

$version_php = phpversion();

//echo "Version de php $version_php<br>";
$extencion_dir = ini_get(extension_dir);
//echo "extencion_dir $extencion_dir<br>";

$ext = get_loaded_extensions();
$comptExt = count($ext);

for ($i=0;$i<$comptExt;$i++) {
$extensions .= "$ext[$i]";
if ($i != $comptExt-1) {
$extensions .= ", ";
}
}

//echo "$extensions <br><br>";

$include_path = ini_get(include_path);
if ($include_path == "") {
$include_result = "<i>No value</i>";
} else {
$include_result = $include_path;
}

//echo "$include_path<br><br>"; 

$register_globals = ini_get(register_globals);
if ($register_globals == "1") {
$register_result = "On";
} else {
$register_result = "Off";
}
//echo "Register global $register_result<br><br>"; 

$magic_quotes_gpc = ini_get(magic_quotes_gpc);
if ($magic_quotes_gpc == "1") {
$magic_gpc_result = "On";
} else {
$magic_gpc_result = "Off";
}

//echo "magic_quotes_gpc $magic_gpc_result<br>"; 


$magic_quotes_runtime = ini_get(magic_quotes_runtime);
if ($magic_quotes_runtime == "1") {
$magic_runtime_result = "On";
} else {
$magic_runtime_result = "Off";
}
//echo "magic_quotes_runtime $magic_runtime_result<br>"; 



$safemodeTest = ini_get(safe_mode);
if ($safemodeTest == "1") {
$safe_mode_result = "On";
} else {
$safe_mode_result = "Off";
}

//echo "safemode $safe_mode_result<br>"; 


$notificationsTest = function_exists('mail');
if ($notificationsTest == "true") {
$mail_result = "On";
} else {
$mail_result = "Off";
}

//echo "Mail $mail_result<br>"; 

$gdlibraryTest = function_exists('imagecreate');
if ($gdlibraryTest == "true") {
	ob_start();
	phpinfo();
	$buffer = ob_get_contents();
	ob_end_clean();
	preg_match("|<b>GD Version</b></td><td align=\"left\">([^<]*)</td>|i", $buffer, $matches);
	preg_match("|GD Version </td><td class=\"v\">([^<]*)</td>|i", $buffer, $matches);
$gd_result = "On";
} else {
$gd_result = "Off";
}

if ($matches[1] != "") {
$version_gd= $matches[1];
$GD = "GD $gd_result Versi&oacute;n $version_gd<br>"; 
}else{
$GD= "GD $gd_result <br>"; 
}



$smtp= ini_get(SMTP);
//echo "$smtp <br>"; 



$upload_max_filesize=ini_get(upload_max_filesize);
//echo "$upload_max_filesize<br>"; 




$session_name=session_name();
//echo "$session_name<br>"; 



$session_path=session_save_path();
//echo "$session_path<br>"; 


$HTTP_HOST=returnGlobal('HTTP_HOST','SERVER');
//echo "$HTTP_HOST<br>"; 




if (substr(PHP_OS,0,3) == "WIN") {
//$block1->contentRow("PATH_TRANSLATED",stripslashes(returnGlobal('PATH_TRANSLATED','SERVER')));
$SO=  "Windows <br>"; 

} else {
//$block1->contentRow("PATH_TRANSLATED",returnGlobal('PATH_TRANSLATED','SERVER'));

$SO = "linux<br>"; 
}




$SERVER_NAME=returnGlobal('SERVER_NAME','SERVER');
//echo "Servidor $SERVER_NAME<br>"; 

$SERVER_PORT=returnGlobal('SERVER_PORT','SERVER');
//echo "SERVER_PORT $SERVER_PORT<br>"; 
$SERVER_SOFTWARE=returnGlobal('SERVER_SOFTWARE','SERVER');
//echo "SERVER_SOFTWARE $SERVER_SOFTWARE<br>"; 
$SERVER_OS= PHP_OS;
//echo "SERVER_OS $SERVER_OS<br>"; 
/*
*/

$query = "SHOW GRANTS FOR $DB_USERNAME";
	if($result=mysql_query($query)){
		$permisos = "";
		while($row=mysql_fetch_array($result)){
			$permisos .= $row[0];
		}
	} 



$juego_cars = @mysql_client_encoding($DB);
$server_info = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                <tr><td align=\"center\" class=\"textos\" colspan=\"2\"><h3>Informaci&oacute;n del Servidor</h3> </td></tr> 
				<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td width=\"120\"  align=\"left\" class=\"textos\">Versi&oacute;n PHP </td>
                  <td align=\"left\" class=\"textos\">$version_php</td>
                </tr>
               <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Versi&oacute;n Msysql </td>
                  <td align=\"left\" class=\"textos\">$databaseVersion</td>
                </tr>
		<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Codificaci&oacute;n de caracteres Msysql </td>
                  <td align=\"left\" class=\"textos\">$juego_cars</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Extension_dir</td>
                  <td align=\"left\" class=\"textos\">$extencion_dir</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Extension</td>
                  <td align=\"left\" class=\"textos\">$extensions</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Include_path</td>
                  <td align=\"left\" class=\"textos\">$include_path</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Register global</td>
                  <td align=\"left\" class=\"textos\">$register_result</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Magic_quotes_gpc</td>
                  <td align=\"left\" class=\"textos\">$magic_gpc_result</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Safemode</td>
                  <td align=\"left\" class=\"textos\">$safe_mode_result</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Mail </td>
                  <td align=\"left\" class=\"textos\">$mail_result</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">GD</td>
                  <td align=\"left\" class=\"textos\">$GD</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">SMTP </td>
                  <td align=\"left\" class=\"textos\">$smtp</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">upload_max_filesize </td>
                  <td align=\"left\" class=\"textos\">$upload_max_filesize</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">session_name</td>
                  <td align=\"left\" class=\"textos\">$session_name</td>
                </tr>
				 <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">session_path</td>
                  <td align=\"left\" class=\"textos\">$session_path</td>
                </tr>
			    <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">HTTP_HOST</td>
                  <td align=\"left\" class=\"textos\">$HTTP_HOST</td>
                </tr>
			   <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Sistema Operativo</td>
                  <td align=\"left\" class=\"textos\">$SO</td>
                </tr>
			   <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Servidor</td>
                  <td align=\"left\" class=\"textos\">$SERVER_NAME</td>
                </tr>
			   <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">SERVER_PORT</td>
                  <td align=\"left\" class=\"textos\">$SERVER_PORT</td>
                </tr>
			  <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">SERVER_SOFTWARE</td>
                  <td align=\"left\" class=\"textos\">$SERVER_SOFTWARE</td>
                </tr>
			  <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">SERVER_OS</td>
                  <td align=\"left\" class=\"textos\">$SERVER_OS</td>
                </tr>
			<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
                  <td align=\"left\" class=\"textos\">Permisos para el usuario $DB_USERNAME</td>
                  <td align=\"left\" class=\"textos\">$permisos</td>
                </tr>	
			
              </table>";

?>