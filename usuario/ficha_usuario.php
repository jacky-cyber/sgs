<?php

//test ñ

if(verifica($id_sesion)){
$nombre_usuario = nombre($id_sesion);

$date =date(d)."-".date(m)."-".date(Y);
	//echo "efsf";


//<a href=\"?accion=tienda&act=6&id_prod=$id_productos\"><img src=\"images/shopcart.jpg\" alt=\"Mi Carro\" border=\"0\"></a>						 
	
//onclick=\"ObtenerDatos('?accion=$accion&act=6&id_prod=$id_productos&cant=0&axj=1','contenido');\"	
//onclick=\"ObtenerDatos('?accion=tienda&act=13&id_productos=$id_productos&axj=1','contenido');\" style=\"cursor: hand; cursor:pointer;\"


//echo "?accion=tienda&act=13&id_productos=$id_productos&axj=1";
$id_perfil      = perfil($id_sesion);
$queryr= "SELECT perfil ,funcionario 
                       FROM  usuario_perfil
                       WHERE id_perfil='$id_perfil'";
                   $resultr= cms_query($queryr)or die ("ERROR 1 <br>$queryr");
                   list($perfil,$funcionario) = mysql_fetch_row($resultr);
		   
				   

$login_html= html_template('ficha_usuario2');
$login_html= "";
if($funcionario==1){

if($_POST['buscar_folio']!=""){


$_SESSION['buscar_folio_sess']=$_POST['buscar_folio'];


}

include("chileatiende/buscar_solicitudes/formulario_busqueda.php");
}



				  /*aaaaaaaaaa*/
			  
$datos_usuario = html_template("ficha_usuario2");
	/*	*/			  
				  
$id_rand = "ficha_$id_usuario";

$datos_usuario = cms_replace("#USUARIO#","<a href=\"index.php?accion=ficha-usuario&id_user=$id_usuario&width=320&axj=1\" class=\"jTip arr\" id=\"$id_rand\" name=\"Datos del Usuario\">$nombre_usuario</a>",$datos_usuario);
$datos_usuario = cms_replace("#INDICADORES#","$indicadores",$datos_usuario);
$datos_usuario = cms_replace("#DATE#","$date",$datos_usuario);
$datos_usuario = cms_replace("#PERFIL#","$perfil",$datos_usuario);

}





?>