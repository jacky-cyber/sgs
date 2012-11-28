<?php



include("lib/connect_db.inc.php");

//mysql Cache
include('deuman/mysql_cache/class_db.php');

include("lib/lib.inc.php");
include("lib/lib.inc2.php");





$time_ini = @getmicrotime();
if($BASE==true and $_GET['accion']!="login"){
	$cache=configuracion_cms('activar cache');
	if($cache==1){
		
		include("cache/cache.php");
		$cache1 = new cache();
		$cache1->iniciar('cache/tmp/',3600,$no_cache,$BASE);	
	
	}
}	


include("lib/ft.inc");




//header("Content-Type: text/html; charset=$codificacion_caracteres"); 

if($_GET['tp']==2){
	error_reporting(E_ALL);
}else{
	error_reporting(E_PARSE);
}

if(configuracion_cms('en_desarrollo')==0){
	
	$_GET['tp']="";
}

//

set_time_limit(0);
/****************************************************/
/*    Este programa es software libre: usted puede redistribuirlo y/o modificarlo 
    bajo los t�rminos de la Licencia P�blica General GNU publicada 
    por la Fundaci�n para el Software Libre, ya sea la versi�n 3 
    de la Licencia, o (a su elecci�n) cualquier versión posterior.

    Este programa se distribuye con la esperanza de que sea �til, pero 
    SIN GARANTÍA ALGUNA; ni siquiera la garant�a impl�cita 
    MERCANTIL o de APTITUD PARA UN PROP�SITO DETERMINADO. 
    Consulte los detalles de la Licencia P�blica General GNU para obtener 
    una informaci�n m�s detallada. 

    Deber� haber recibido una copia de la Licencia P�blica General GNU 
    junto a este programa. 
    En caso contrario, consulte <http://www.gnu.org/licenses/>.

	
* Administrador de Solicitudes de Informaci�n Publica
* 
* Este software permite el ingreso de solicitudes de 
* informaci�n publica y su seguimiento.
* 
* Copyright (C) 2009 Comisi�n de Probidad y Transparencia
* 
* Equipo de Desarrollo
*
* Ricardo Rosende 
* Claudia Cornejo
* Claudio Vega
* Manuel Muñoz
* Jaime Rocha
*
* Colaboradores
* 
* Felipe Mancini
* Leonardo Sandoval
* Francisco Gayan
* Valentina Raddatz
* Rolando Martinez
* 
* Sgs
* Version 1.03
* 13-04-2009
* 
* **************************************************/

if (ereg('iPhone',$_SERVER['HTTP_USER_AGENT'])) { 
$IPHONE = 1; 

}  
else { 
$IPHONE = 0; 
}





$charset=configuracion_cms('charset');
header("Content-type: text/html; charset=$charset");

session_start();
session_register_cms('mod_session');
session_register_cms('mensaje');
session_register_cms('url_login');
session_register_cms('buscar_folio_sess');

session_register_cms('js_sess');

session_register_cms('mail_enviado');



/*Variables de session sgs*/
session_register_cms('campo_ordena');
session_register_cms('campo_ordena_desc');
session_register_cms('id_ntd');
session_register_cms('idioma');
session_register_cms('dia_patch');
session_register_cms('html_sess');
/*chileatiende*/
session_register_cms('rut_atencion');
session_register_cms('session_atencion');
/**/

$id_sesion = session_id();



	include("lib/lib.sgs.php");	




include("lib/seguridad.inc.php");



//include("chileatiende/chileatiende.inc.php");

//Funcion que finaliza las solicitudes fuera de plazo de pago en SGS
//Calcula_plazo_finalizacion_retiro_pago_pendiente();
//Reversa_calcula_plazo_finalizacion_retiro_pago_pendiente();









//include("lib/indicadores_economicos.php");

include("lib/correos2.inc.php");

include("lib/perfiles_config.php");




//include("templates/template.php");


//$codificacion_caracteres=configuracion_cms('charset');



//$_SESSION['campo_ordena_desc']=1; desc
//$_SESSION['campo_ordena_desc']=0; asc
//$ordenar_datosxx ="fecha_termino asc ";


if($_GET['lng']!="" ) {
$_SESSION['idioma']=$_GET['lng'];
}elseif($_SESSION['idioma']==""){
	       $query= "SELECT sigla
           		    FROM  deuman_idioma
           			WHERE defecto='1'";
	$identificador_idioma = "idioma_def";			
      $sigla = cache_mysql_solo_un_valor($query,$identificador_idioma,3600);
     // $result= cms_query($query)or die (error($query,mysql_error(),$php));
      //list($sigla) = mysql_fetch_row($result);
	  $_SESSION['idioma']=$sigla;
}


 
if($_GET['campo_ordena']!= $_SESSION['campo_ordena'] and $_SESSION['campo_ordena']!="" and $_GET['campo_ordena']!=""){
	//Estamos en el primer caso de orden 
	$_SESSION['campo_ordena'] =$_GET['campo_ordena'];
	$_SESSION['campo_ordena_desc']=1;
	$ordenar_datosxx =$_SESSION['campo_ordena'] ." asc "; 
	
}elseif($_GET['campo_ordena']== $_SESSION['campo_ordena'] and $_SESSION['campo_ordena_desc']==1 and $_SESSION['campo_ordena']!=""){
	
	$_SESSION['campo_ordena_desc']=0;
	$ordenar_datosxx =$_SESSION['campo_ordena'] ." desc "; 
	
}elseif($_GET['campo_ordena']== $_SESSION['campo_ordena'] and $_SESSION['campo_ordena_desc']==0 and $_SESSION['campo_ordena']!=""){
	
	$_SESSION['campo_ordena_desc']=1;
	$ordenar_datosxx =$_SESSION['campo_ordena'] ." asc "; 
	
}elseif($_GET['campo_ordena']=="" and  $_SESSION['campo_ordena']!="" ){
	
	if($_SESSION['campo_ordena_desc']==1){
		$ordenar_datosxx =$_SESSION['campo_ordena'] ." asc "; 
	}else{
		$ordenar_datosxx =$_SESSION['campo_ordena'] ." desc "; 
	}
	
}else{
	$ordenar_datosxx ="fecha_termino asc ";
	$_SESSION['campo_ordena'] =" fecha_termino ";
	$_SESSION['campo_ordena_desc']=1;
}


if($_GET['id_ntd']!=""){
	$_SESSION['id_ntd'] =$_GET['id_ntd'];
}



$id_ntd=$_SESSION['id_ntd'];




	

//echo $ordenar_datos .$_SESSION['campo_ordena']."  dsfsdf";

/**************************/

	if(isset($_COOKIE['cookname_sgs']) && isset($_COOKIE['cookpass_sgs'])){
      		//echo $_COOKIE['cookname_sgs']." user<br>";
     // 	    echo $_COOKIE['cookpass_sgs']." pass<br>";
   	}

/*****************************/
function mensaje($mensaje_session,$opcion){
 	           
			   if($mensaje_session==""){
		    		$mensaje ="$opcion";
		    		$_SESSION['mensaje']="";
			    }else{
		    		$mensaje=$mensaje_session;
		    		$_SESSION['mensaje']="";
			    } 
return $mensaje;
}







$accion = $_GET['accion'];
$act    = $_GET['act'];
$axj = $_GET['axj'];
$pagina_info = $_GET['pagina_info'];

$ip= configuracion_cms('ip');	
if($ip=="" and $accion!="Configuracion"){
	header("Location:instalacion.php");
}

$mesj = $_GET['mesj'];

//$url = "ok";
if($url=="ok"){
//echo $_SERVER["REQUEST_URI"];
}


switch ($mesj) {
     case 'err':
      echo  "<script>alert('Sesion Expirada.'); document.location.href='index.php'; </script>\n";


         break;
	 case 'u':
	  /// echo  "<script>alert('Sesion Expirada.'); document.location.href='index.php'; </script>\n";
       break;
	
   	default:
	   
   }
$sess= $_GET['sess'];

if($sess!=""){
	
  $query= "SELECT id_usuario
           FROM  usuario
           WHERE session='$sess'";
 


  $result36= cms_query($query)or die (error($query,mysql_error(),$php));
     if(list($id_usuar) = mysql_fetch_row($result36)){
     	
    	
 $Sql ="UPDATE usuario
     		   SET estado ='1', session=''
     		   WHERE id_usuario='$id_usuar'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
     	
		

   header("Location:index.php?accion=Registro&act=2");
   $accion="registro";

     
  
     }
 }



$sec = $_GET['sec'];


function php($accion){
	
	  $query= "SELECT php
	           FROM  acciones
	           WHERE accion='$accion'";
	 
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	     list($php) = mysql_fetch_row($result);
	     
	     
	     
	     return $php;
	
}



$mod_session =  $_SESSION['mod_session'];



if($pagina_info=="ok"){
	
	$informacion_pagina = php($accion);
	
 $informacion_pagina=  "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
        <td align=\"center\" class=\"textos\">php -> $informacion_pagina</td>
        </tr>
  	</table>";
	
	
}


	$nombre_usuario = nombre($id_sesion);
	$id_usuario     = id_usuario($id_sesion);
	
	$id_perfil      = perfil($id_sesion);
	//$id_establecimiento = id_establecimiento($id_sesion);
	//$establecimiento_u  = establecimiento($id_sesion);
	//$acceso             = acceso($id_sesion);
	$perfil_on_line = perfil_on_line($id_perfil);	
	
	include("usuario/ficha_usuario.php");
 	
	  $query= "SELECT administracion 
           FROM  usuario_perfil
           WHERE id_perfil='$id_perfil'";


     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($administracion_tpl) = mysql_fetch_row($result);
	 
	 
	 
	
$mod = $_GET['mod'];


if($accion==""){

  $query= "SELECT url_defecto 
           FROM  usuario_perfil
           WHERE id_perfil='$id_perfil'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
   		 if(list($url_defecto) = mysql_fetch_row($result) and $url_defecto!=""){
	
	  		$url_defecto=explode("=", $url_defecto);
      		$accion =  trim($url_defecto[1]);

			}else{
	             $query= "SELECT  accion
				FROM acciones 
				WHERE defecto=1";
    		     $resultde = cms_query($query)or die (error($query,mysql_error(),$php));
    		     list($accion) = mysql_fetch_row($resultde);
		 }


}



 
/*idiomas*/
$i = $_GET['i'];
	if($i!=""){
		 $_SESSION['idm']=$i;
		 $idm =  $_SESSION['idm'];
	}
	if($idm==""){
	   $idm="esp";
	}

/***********/



if($administracion_tpl==1 and $_GET['axj']==""){
	include("deuman/menu/menu_admin.php");

	}else{
		if($_GET[tp]!=8){}
		include("menu/menu.php");
		
}



if($_SESSION['url_login']!="" and verifica($id_sesion)!=false){

 header("Location:",$_SESSION['url_login']);
}


		
			if(!is_numeric($accion)){
				$accion = traduce_accion($accion);
			}
			
			
		 $query_acciones= "SELECT php,descrip_php_$idm,icono,id_acc    
		 				   FROM acciones 
						   WHERE accion='$accion'";
//					echo $query_acciones;	   
         $result_acciones= cms_query($query_acciones)or die (error($query_acciones,mysql_error(),$php));
	/*if acciones*/
      if (list($php,$seccion,$icono,$id_acc) = mysql_fetch_row($result_acciones)){

      	if(file_exists($php)){
	
      	  $query= "SELECT count(*)
		  		   FROM accion_perfil 
		  		   WHERE id_perfil='$id_perfil' and accion='$accion'";
				
      	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
		  list($tot_accion) = mysql_fetch_row($result);
	
		
      		if ($tot_accion==1){
			
			$query= "SELECT descrip_url,id_tipo,id_acc    
           			 FROM  acciones
           			 WHERE accion='$accion'";
				
						
     $result_acc= cms_query($query)or die (error($query,mysql_error(),$php));
     list($accion_txt,$id_tipo_cont,$id_accion) = mysql_fetch_row($result_acc);
	
	     $accion_txt = titulo_url($accion_txt);
	      $accion =strtolower($accion_txt);
	  
	  		
			
			
			if($_GET['tp']==1){
			
			$info_tp .="llamando a archivo $php rr<br>";
			
			}
			
	 		 if(is_file($php)){

	 	   	 include($php);
			
			   
			   $_SESSION['url_login']="";
			    
      				
				}else{		
      		    	include("desarrollo.php");
			}
	  
			}else{
			
     		 	if($id_perfil==4){
			
			   				$_SESSION['url_login'] =$_SERVER["REQUEST_URI"];
							
			  				include("deuman/formulario_login/formulario_login.php");
				
				}else{
							$query= "SELECT url_defecto    
							FROM  usuario_perfil 
							WHERE id_perfil='$id_perfil'";
							$identificador = "url_defecto_perfil_$id_perfil";
							$url_defecto=  cache_mysql_solo_un_valor($query,$identificador,$tiempo = 3600)   ; 
					     
                                header("Location:$url_defecto");
				}
      		    	
      		    	
      		 }
	     }else{
			     include("desarrollo.php");
			  }	
		
		
			  
		$modulo = "<a href=\"index.php?accion=$accion\">$seccion</a>";
		$modulo_icono = "<a href=\"index.php?accion=$accion\"><img src=\"icons/$icono\" alt=\"$seccion\" border=\"0\"></a>";	
		   
	 }else{
		
		
		header("Location:index.php");
	
		
	 }
	 
	 
	
	 $query= "SELECT a.php   
                          FROM  accion_acciones aa, acciones a
                          WHERE aa.accion='$id_acc' and aa.acciones=a.accion";
						
					//
                    $result_acc2= cms_query($query)or die (error($query,mysql_error(),$php));
                     while (list($php2) = mysql_fetch_row($result_acc2)){
					 	if($tp!=""){
						echo $query;
						$info_tp .= "Linea 419 Se carga modulo asociado a la accion $accion &nbsp; -->&nbsp; $php2<br>";
						}
						//echo "Hola accion $php2";
               				include($php2);		   
               		 }
			  
	
	
	
	/*fin if acciones*/
	
	$url = $_SERVER['QUERY_STRING'];
	$accion_modulo = traduce_accion($accion);	

		if($_GET['axj']==""){
		 $query= "SELECT descrip_php_esp, descrip_url,help 
		 		  FROM acciones  
				  WHERE accion='$accion_modulo'";
		 
		//echo $query."<br>";
		 
		 $result= cms_query($query)or die (error($query,mysql_error(),$php));
		  if(list($descrip_modulo, $descrip_url,$help) = mysql_fetch_row($result)){
		//  echo "$descrip_modulo, $descrip_url <br>";
				if($descrip_url!="Home"){
				$idioma = $_SESSION['idioma'];
				if($idioma!=""){
    					$query= "SELECT id_idioma   
          			 			 FROM  deuman_idioma 
           			 			 WHERE sigla='$idioma'";
					
     					$result_idm= cms_query($query)or die (error($query,mysql_error(),$php));
    					list($id_idioma) = mysql_fetch_row($result_idm);

						if(!is_numeric($accion)){
							$accion = traduce_accion($accion);
						}
		   				 $query= "SELECT traduccion   
                   					FROM  accion_idioma
                   					WHERE accion='$accion' and id_idioma='$id_idioma'";

            			 $result_idm= cms_query($query)or die (error($query,mysql_error(),$php));
         				 list($traduccion) = mysql_fetch_row($result_idm);

					}
				if($traduccion!=""){
				$descrip_modulo = $traduccion;
				}else{
				$descrip_modulo = acentos($descrip_modulo);
				}
		
				
				if($modulo!="home"){
				$modulo =" &raquo; <a href=\"?accion=$descrip_url\" >$descrip_modulo</a>";
				}
				
		        
    
				}
		        

      if($act_modulo!=""){
	  	$act_modulo ="$act_modulo";
	  }
    }
		}
		
if($help!="" and $act==""){
$help_seccion = "<a href=\"index.php?accion=help&acci=$accion&width=320&axj=1\" class=\"jTip\" id=\"Help Accion\" name=\"$descrip_modulo\"><img src=\"images/help.png\" alt=\"\" border=\"0\">Ayuda</a>";
}


if(verifica_pass($id_sesion)){
/*
$contenidoXX=   "<table width=\"200\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro_rojo\">
                            <tr><td align=\"center\" class=\"textos\"> <a href=\"index.php?accion=6\">
							<img src=\"images/atencion.gif\" alt=\"\" border=\"0\"></td></tr> </a>
							 <tr >
                               <td align=\"center\" class=\"textos_rojo\">
							   <a href=\"index.php?accion=6\" ><div class=\"textos_rojo\">
							   Su contrase&ntilde;a no presenta un buen nivel de seguridad le recomendamos cambiarla 
Clickee aqu&iacute;</div></a>
							   </td>
                               </tr>
							   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
                         	</table>".$contenido;
  			*/
  		}
	
		//
if($help_seccion=="" and $_GET['accion']!="" and $id_perfil!=4){
$url=$_SERVER['REQUEST_URI'];
$url= str_replace("&axj=1","",$url);
$url= $url."&axj=1";
//$url= str_replace("/sgs/","",$url);

//$print= "<a  href=\"#\"  class=\"comprobante\"><img onclick=\"MM_openBrWindow('$url','','scrollbars=yes,width=650,height=820')\"  src=\"images/print.png\" alt=\"\" border=\"0\"></a>";

}

$version =  configuracion_cms('version');


//$contenido = utf8_encode($contenido);

$js= acentos_unicode($js);


$id_perfil      = perfil($id_sesion);
 $query= "SELECT a.id_acc,a.php
           FROM  acciones a, accion_perfil ap
           WHERE a.presente='1' and ap.id_perfil=$id_perfil and ap.accion=a.accion and a.opcion=3 
		   order by id_acc asc"; 
                     $result34= cms_query($query)or die (error($query,mysql_error(),$php));
                      while (list($accion_presente,$php) = mysql_fetch_row($result34)){
                			//echo $php."<br>";
							if($_GET['tp']==1){
								$info_tp .= "Linea 600 Se carga modulo siempre presente a la accion $accion_presente &nbsp; -->&nbsp; $php<br>";
						
							}
							include($php);
								
										   
                		 } 
//$ss=$_SESSION["valida_pass"];						 
if($axj==''){
	$_SESSION["texto_advertencia_up"]= trim($_SESSION["texto_advertencia_up"]);
	$_SESSION["texto_error_up"]= trim($_SESSION["texto_error_up"]);
	$_SESSION["texto_exito_up"]= trim($_SESSION["texto_exito_up"]);
	
	
	
	if($_SESSION["texto_advertencia_up"]!="" || $_SESSION["texto_error_up"]!="" || $_SESSION["texto_exito_up"]!=""){
		$texto_advertencia_up=$_SESSION["texto_advertencia"];
		$texto_error_up=$_SESSION["texto_error_up"];
		$texto_exito_up=$_SESSION["texto_exito_up"];
		
		/*
		$cortina="		
						var advertencia_up='$texto_advertencia_up';
						var exito_up='$texto_exito_up';
						var error_up='$texto_error_up';
						var cortina ='<div id=\"cortina\" style=\"width:980px;background-color:#F8F8F8;box-shadow: 0 0 5px #D8D8D8;min-height:40px;position:absolute;\">'
							cortina +='<span id=\"cierra_cortina\" style=\"float:right;margin-right:10px;text-decoration:underline;cursor:pointer;\">Cerrar</span>';
							if(error_up!=''){
								cortina +='<div style=\"float:left;margin-left:10px;\" class=\"tabla_rojo_sin_ico_dup\">$texto_error</div><br/>';	
							}
							if(exito_up!=''){ 
								cortina +='<div style=\"float:left;margin-left:10px;\" class=\"tabla_verde_sin_ico_dup\" >$texto_exito </div><br/>';		
							}
							if(advertencia_up!=''){
								cortina +='<div style=\"float:left;margin-left:10px;\" class=\"tabla_amarillo_sin_ico_dup\">$texto_advertencia </div><br/>';
							}
							
							var elemento = $('#header');
							var posicion = elemento.position();
							$('body').prepend(cortina);
							$('#cortina').hide();
							$('#cortina').slideDown('slow');
							$('#cortina').css('left',posicion.left+'px');
							setTimeout('$(\"#cortina\").slideUp(\"slow\")',5000);
						";
						
		*/
	} 
}
					 
if($alerta!=""){
	$js .="<script type=\"text/javascript\">
	
	$(document).ready(function(){

	
    $('#alerta').click(function () {
       $('#op_alerta').slideToggle(\"fast\");
    });
	 $('#opAlerta').click(function () {
       $('#op_alerta').slideToggle(\"fast\");
    });
  });

</script>";
 include("sgs/buscar_solicitudes/formulario_busqueda.php"); 	
/*
$alerta= "
 <table width=\"160\" width=\"160\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
               
				 <tr id=\"alerta\" style=\"cursor:pointer\">
                 <td valign=\"middle\"  align=\"center\" >
				   <h4>Alertas</h4>
				   <p>Click aqu&iacute;</p>
                  </td>
				  </tr>
				 <tr id=\"op_alerta\" style=\"display:none;\"><td align=\"center\">$alerta</td></tr> 
           	</table>";
*/

$estados_alerta= configuracion_cms('Estados_alerta');
$id_usuario     = id_usuario($id_sesion);

$query= "SELECT id_entidad   
		 FROM  usuario
		 WHERE id_usuario='$id_usuario'";
$result_alerta= cms_query($query)or die (error($query,mysql_error(),$php));
list($id_entidad) = mysql_fetch_row($result_alerta);

  $query= "SELECT count(folio)
           FROM  sgs_solicitud_acceso
		   WHERE id_sub_estado_solicitud in ($estados_alerta)
		   and id_entidad= '$id_entidad'
		   ORDER BY fecha_termino asc
		   ";

$result_= cms_query($query)or die (error($query,mysql_error(),$php));		   
list($contador) = mysql_fetch_row($result_);

if($contador>0){
	$contendor_ul=html_template('contenedor_ul_alerta');
	$contendor_ul=cms_replace("#UL_ALERTA#",$alerta,$contendor_ul);
	$alerta=$contendor_ul;
}else{
	$alerta="";
}
}


	$_SESSION["texto_advertencia_up"]="";		
	$_SESSION["texto_error_up"]="";		
	$_SESSION["texto_exito_up"]="";		

$charset= configuracion_cms('charset');


if($tp==1 and $info_tp!=""){
$info_tp = "<div class=\"info_tp\">$info_tp</div>";
}

	 
if($_GET['accion']==""){
$modulo="";
}



		
if($axj==""){

/* if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
    {return true;}
    else
    {return false;}*/



if($administracion_tpl==1 ){

  $query= "SELECT help   
               FROM  acciones 
               WHERE accion='$accion'";
			   
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
		 list($help_txt) = mysql_fetch_row($result3);
          if ($help_txt!=""){
    			$help="<a href=\"#\"  class=\"info\"><img src=\"images/help_auto.gif\" alt=\"\" border=\"0\"><span>$help_txt</span></a>";
    		 }else{
			 	$help="";
			 }
	
	 
	 


//$js = acentos($js);
$js2 = acentos_unicode($js2);

$css= acentos($css);
///$contenido= cambio_texto($contenido);
if($mensaje_tool!=""){
	$mensaje_tool_div="<div id=\"mensaje_tool\" class=\"textos\">$mensaje_tool</div>";
}




$tpl = new FastTemplate("tpl");

if($_GET['tp']=='new'){
	
$tpl->define(array(main  => "index_admin_boot.html"));	
}else{
$tpl->define(array(main  => "admin-bootstrap.html"));		
}


$tpl->no_strict();


//$nombre_usuario = nombre($id_sesion);

$tpl->assign(
                 array(
                       CONTENIDO     => "$contenido",
                       ONSUBMIT      => "$onsubmit",
                       ACCION_FORM   => "$accion_form",
                       JS            => "$js",
                       JS2           => "$js2",
                       CSS           => "$css",
                       PERSONAL      => "$datos_personal",
                       BUSCADOR      => "$buscador_cuadro",
                       CUADRO_RESUMEN=> "$cuadro_resumen",
                       MENU_TOP      => "$menu_top",
                       MODULO        => "$modulo",
                       ONLOAD        => "$onload",
					   POLL			 => "$poll",
					   CARGANDOPAGINA=> "$cargando_pagina",
					   TITULO 		 => "$title_pagina",
					   TOMA_PEDIDO   => "$pedidos",
					   FOOTER        => "$footer",
					   FLASH_TOP	 => "$flash_top",
					   NOTICIAS_RIGHT=> "$noticias_right",
					   LOGIN         => "$login_form",
					   PAGE_NAME     => "$page_name",
					   MENU          => "$menu_user",
					   MENU_TOP      => "$menu_top",
					   MENU_ADMIN	 => "$menu_admin",
					   LOGIN         => "$login_html",
					   SECCION       => "$seccion_titulo",
					   TITULO_PAGINA =>  "$titulo_pagina",
					   MENSAJE_TOOL => "$mensaje_tool_div",
					   HELP => "$help",
					   VERSION => "$version",
					   TIEMPO_EJECUCION =>"$tiempo_ejecucion",
					   CHARSET => "$charset",
					   BANDERAS=>"$lista_banderas",
					   USUARIO => "$nombre_usuario",
					   PERFIL => "$perfil",
					   TITULO_MODAL => "$titulo_modal",
					   CONTENIDO_MODAL => "$contenido_modal",
					   BOTONERA_MODAL => "$botonera_modal"
					  
                       
           )
      );



}else{


$modulo =" $modulo $act_modulo";
if($act_modulo!=""){
	
$title_pagina = $act_modulo ." - ";	
}


//$contenido .= "<br><br><br><br><br><br><br><br><br><br><br><br>";

 if(configuracion_cms('Activar_Piwik_analytics')==1){
 
 $id_entidad_link=explode(",", $id_entidad);
 $id_entidad_link = $id_entidad_link[0];
 
 $link_piwik =" <!-- Piwik --> 
<script type=\"text/javascript\">
var pkBaseURL = ((\"https:\" == document.location.protocol) ? \"https://sgs.probidadytransparencia.gob.cl/stats/\" : \"http://sgs.probidadytransparencia.gob.cl/stats/\");
document.write(unescape(\"%3Cscript src='\" + pkBaseURL + \"piwik.js' type='text/javascript'%3E%3C/script%3E\"));
</script><script type=\"text/javascript\">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + \"piwik.php\", $id_entidad_link);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src=\"http://sgs.probidadytransparencia.gob.cl/stats/piwik.php?idsite=$id_entidad_link\" style=\"border:0\" alt=\"\" /></p></noscript>
<!-- End Piwik Tracking Code -->";
 }
 
 


$tpl = new FastTemplate("tpl");



/*
if($IPHONE==1 or $_GET['m']==1){
$tpl->define(array(main  => "mobile.html"));
}else{
$tpl->define(array(main  => "index.htm"));
}
*/

	$tpl->define(array(main  => "index_new.htm"));
	//include("deuman/agranda_texto/agranda_texto.php");
	if(verifica($id_sesion)){
	
		$menu_izq== html_template('contenedor_menu');
	
		$tpl->define(array(main  => "index_new.htm"));
		$registro_header = html_template('registro header usuario logeado');
		$clase_menu = "class=\"main_cont\"";
		//$login_chileatiende = html_template('login new CHLA ');
		//$contenido= html_template('main chileatiende');
		$menu_izq=$menu;
		$modulo = "<div class=\"semilla\">
			   								<a href=\"index.php\">Inicio</a> 
											$modulo &raquo;
			   							 </div>";
	
	}else{
	
	
		$tpl->define(array(main  => "index_new.htm"));
		$registro_header = html_template('registro header');
		if($login_chileatiende==""){
			if($_COOKIE['cookpass_sgs']=="" and $_GET['accion']==""){
				$login_chileatiende = html_template('login new CHLA ');	
			}elseif($_GET['accion']==""){
				$username=$_COOKIE['cookname_sgs'];
				$userpass=$_COOKIE['cookpass_sgs'];
				/*
				$login_chileatiende ="<div id=\"menu\"> <h2>Acceso usuarios registrados </h2>
									  	<div class=\"login\">
									  	  <p>Si ya está registrado ingrese su nombre de usuario y contraseña.</p>
									  	  <form id=\"form1\" name=\"form1\" method=\"post\" action=\"\">
									  	    <p>
									  	      <label for=\"login\">Usuario</label>
									  	      <input type=\"text\" name=\"login\" id=\"login\" value=\"$username\" /> 
									          </p>
									          <p>
									  	      <label for=\"password\">Contraseña</label>
									  	      <input type=\"password\" name=\"password\" value=\"$userpass\" id=\"password\" />
										     </p>
									          <p class=\"derecha\"><span id=\"alertBoxes\" ></span>
											  <input type=\"submit\" value=\"Ingresar\" name=\"Ingresar\" id=\"Ingresar\"/></p>
									          
									          <p class=\"centro\">
									            <input type=\"checkbox\" name=\"remember\" id=\"remember\" />
									            <label for=\"remember\" class=\"recordar\">Recordar en este equipo </label>
									          </p>
									          <p class=\"centro\"><a href=\"?accion=olvido\">¿Olvidó su contraseña?</a></p>
									          <div class=\"clearfloat\"></div>
									  	  </form>
									  	</div>
									    <h2>Registro de usuarios</h2>
									  	<div class=\"login\">
									  	  <p><a href=\"?accion=Registro\" class=\"registro\">DESEO REGISTRARME</a></p>
									  	</div>
										<h2>Consultas de Solicitudes</h2>
									  	<div class=\"login\">
									  	  <p><a href=\"?accion=consulta-de-solicitudes\" class=\"registro\">Buscar Solicitud</a></p>
									  	</div>
										</div>";
					*/
					$login_chileatiende = html_template('login new CHLA ');	
			}
		}
		
		
		
	
	}
	//$menu_izq=$menu;


// $buscador=html_template("formulario_buscador");

 
 /*
 $meta_description = getMetaDescription(elimina_acentos(utf8_encode(acentos_inverso($contenido))));
 $meta_keywords=getMetaKeywords(elimina_acentos(utf8_encode(acentos_inverso($contenido))));
 $meta_tag =getMetaKeywords(elimina_acentos(utf8_encode(acentos_inverso($contenido)))); 
 */
$tpl->no_strict();

$google_analytics = configuracion_cms('google_analytics_key');

//$contenido = utf8_decode($contenido);
//$contenido = html_entity_decode($contenido,ENT_COMPAT,'UTF-8');
$url_servidor = configuracion_cms('url_servidor');
$tpl->assign(
                 array(
				CONTENIDO     => "$contenido",
				ONSUBMIT      => "$onsubmit",
				ACCION_FORM   => "$accion_form",
				JS            => "$js",
				CSS           => "$css",
				PERSONAL      => "$datos_personal",
				BUSCADOR      => "$buscador_cuadro",
				MENU_TOP      => "$menu_top",
				MODULO        => "$modulo",
				ONLOAD        => "$onload",
					   POLL			 => "$poll",
					   CARGANDOPAGINA=> "$cargando_pagina",
					   TITULO 		 => "$title_pagina",
					   TOMA_PEDIDO   => "$pedidos",
					   HEADER        => "$header",
					   FOOTER        => "$footer",
					   FLASH_TOP	 => "$flash_top",
					   NOTICIAS_RIGHT=> "$noticias_right",
					   LOGIN_FORM    => "$login_form2",
					   PAGE_NAME     => "$page_name",
					   MENU_USER     => "$menu_user",
					   LOGIN         => "$login_html",
                       JS2           => "$js2",
					   SECCION       => "$seccion_titulo",
					   RANKING		 => "$ranking",
					   COLLALL       => "$collall",
					   RESTRICCION   => "$restriccion_re",
					   BANNER_HEAD   => "$banner_head",
					   BANNER_FOOT   => "$banner_foot",
					   BANNER_MENU   => "$banner_menu",
					   CONTENEDOR  =>  "",
					   CONTENEDOR_LATERAL_DERECHO => "$contenedor_lateral_derecho",
					   CONTENEDOR_MENU => "",
					   MENU => "$menu",
					   DATOS_USUARIO =>"$datos_usuario",
					   MENSAJE_TOOL => "$mensaje_tool",
					   VERSION => "$version",
					   HELP_SECCION => "$help_seccion",
                       PRINTT => "$print",
					   TIEMPO_EJECUCION =>"$tiempo_ejecucion",
					   ALERTA =>"$alerta",
					   CHARSET => "$charset",
					   BANDERAS=>"$lista_banderas",
					   BUSCADOR=>"$buscador",
					   INFO_TP => "$info_tp",
					   NOMBRE_SERVICIO => "$nombre_servicio",
					   ID_ENTIDAD_PIWIK => "$link_piwik",
					   TOTAL_PACK => "$total_pack",
					   REGISTRO_HEADER => "$registro_header",
					   LOGIN_SGS => "$login_chileatiende",
					   MENU_IZQ => "$menu_izq",
					   CLASE_MENU => "$clase_menu",
					   AGRANDA_TEXTO => "$agranda_texto",
					   META_DESCRIPTION =>"$meta_description",
					   META_KEYWORDS => "$meta_keywords",
					   META_TAGS => "$meta_tag",
					   VOLVER => "$volver",
					   ULTIMOS_INGRESOS =>"$ultimos_ingresos",
					   GOOGLE_ANALYTICS => "$google_analytics",
					   URL_SERVIDOR => "$url_servidor"
					   
					   
                       
           )
      );


//echo $contenido;



/*
  $query= "SELECT html_template   
           FROM  sitio_templates
           WHERE defecto='1'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($template) = mysql_fetch_row($result);
	*/  
	  //echo $template;



		if(!is_numeric($accion)){
			
		$accion = traduce_accion($accion);
		
		}
		
		

		
	     $query= "SELECT etiqueta,id_contenido
                 FROM  accion_etiqueta
                 WHERE accion='$accion'";
	

           $result2= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($etiqueta,$id_contenido) = mysql_fetch_row($result2)){
      				
					  $query= "SELECT contenido
                               FROM  noticias
                               WHERE id_noticia='$id_contenido'";
					  //echo $query."<br>";
                         $result= cms_query($query)or die (error($query,mysql_error(),$php));
                         list($html_etiqueta) = mysql_fetch_row($result);

				$tpl->assign($etiqueta, $html_etiqueta);
    
					
							   
      		 }
				 
		
						
			  $query= "SELECT publica_noticia
                       FROM  acciones
                       WHERE accion='$accion'";
					   
					  
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($publica_noticia) = mysql_fetch_row($result);
				  
				  
				  $id_contenido = $_GET['id_contenido'];
				  if($publica_noticia==1 and $id_contenido!=""){
				 // echo "dfdd";
				  
				  
				  
				  if(is_numeric($id_contenido)){
				  
				    include("contenido/VerNoticia.php");
				    $contenido2= $estructura_noticia;
				  }else{
				 $id_contenido =texto_to_id_noticia($id_contenido);
				// echo $id_contenido;
				   include("contenido/VerNoticia.php");
				   // $contenido= $estructura_noticia;
				  }
				  
                       
				 $tpl->assign('CONTENIDO', $contenido2);
					  
				  }
				  
		
		
				
 $id_perfil      = perfil($id_sesion);				  				
 $query= "SELECT a.id_acc
           FROM  acciones a, accion_perfil ap
           WHERE a.presente='1' and ap.id_perfil=$id_perfil and ap.accion=a.accion"; 
                     $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      while (list($accion_presente) = mysql_fetch_row($result)){
                			
					$query= "SELECT etiqueta,id_contenido  
                                           FROM  accion_etiqueta
                                           WHERE accion='$accion_presente'";
					//echo $query."<br>";
                                     $result1= cms_query($query)or die (error($query,mysql_error(),$php));
                                      while (list($etiqueta,$id_contenido) = mysql_fetch_row($result1)){
                                				
												  $query= "SELECT  contenido
	           												  FROM  noticias
	           												  WHERE id_noticia='$id_contenido'";
	  
												
	     												  $result2= cms_query($query)or die (error($query,mysql_error(),$php));
	     												  list($contenido2) = mysql_fetch_row($result2);
												
												$tpl->assign($etiqueta, $contenido2);
														   
                                		 }
								
								
										   
                		 }  
	
    


$id_acc= id_acc($accion);

	 $query= "SELECT etiqueta,id_contenido
                 FROM  accion_etiqueta
                 WHERE accion='$id_acc'";
	

           $result2= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($etiqueta,$id_contenido) = mysql_fetch_row($result2)){
      				
					  $query= "SELECT contenido
                               FROM  noticias
                               WHERE id_noticia='$id_contenido'";
					  //echo $query."<br>";
                         $result= cms_query($query)or die (error($query,mysql_error(),$php));
                         list($html_etiqueta) = mysql_fetch_row($result);
/******************************************************************************************************/
				$tpl->assign($etiqueta, $html_etiqueta);
    
/********************************************************************************************************/				
							   
      		 }


}




if(configuracion_cms('en_mantencion') and $administracion_tpl!=1){

 $contenido_noticia = contenido_noticia('Sitio-en-Mantencion');
  $contenido = $html ="<html>
               <head>
               <title>Sitio en mantenci&oacute;n</title>
               <meta http-equiv=\"Content-Type\" content=\"text/html; charset=$charset\">
               </head>
               
               <body bgcolor=\"#FFFFFF\" text=\"#000000\">
               <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"4\" cellspacing=\"4\">
                        <tr >
                          <td align=\"left\" class=\"textos\">$contenido_noticia<br></td>
                          </tr>
						 </table>
               </body>
               </html>";
			  	

$tpl = new FastTemplate("tpl");
$tpl->define(array(main  => "mantencion.html"));
$tpl->no_strict();

$tpl->assign(
                 array(
                       CONTENIDO     => $contenido_noticia 
                       
           )
      );


}  
	  
$tpl->parse(MAIN,"main");
$tpl->FastPrint("MAIN");	


    
}else{
$p = $_GET['p'];



if($accion_form==""){



if($p==1){

//onload="window.print(); window.close();">
$contenido ="<html>
<head>
<title>Sgs</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$charset\">
</head>
$jst2

$css2

<link href=\"css/deuman.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"images/sitio/sgs/css/606006.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"css/sitio.css\" rel=\"stylesheet\" tyspe=\"text/css\"/>
 <link href=\"images/sitio/sgs/css/base.css\" rel=\"stylesheet\" type=\"text/css\" />
<link type=\"text/css\" href=\"images/sitio/sgs/css/assets/css/style.css\" rel=\"stylesheet\" media=\"screen, projection\" />

<body  onload=\"window.print(); window.close();\">


$contenido

</body>
</html>";
echo $contenido;

}else{


/*

$html ="<html>
<head>
<title>Sgs</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=$charset\">
</head>
$jst2

$css2

<link href=\"css/deuman.css\" rel=\"stylesheet\" type=\"text/css\" />

<link href=\"css/sitio.css\" rel=\"stylesheet\" tyspe=\"text/css\"/>
<body bgcolor=\"#FFFFFF\" text=\"#000000\">
<a   href=\"javascript:window.print();\" >imprimir</a>
<form action=\"$accion_form\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\" accept-charset=\"$charset\">


$contenido

</form>
</body>
</html>";
echo $html;


*/

echo $contenido;
}

	
}else{

//header("Content-Type: text/html; charset=$charset");
echo $contenido;

 

}



		

if(!is_numeric($accion)){
$accion = traduce_accion($accion);
}


  $query= "SELECT id_contenido  
                       FROM  accion_etiqueta
                       WHERE accion='$accion' and etiqueta ='CONTENIDO'";
					   
					//echo $query;  
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($id_contenido) = mysql_fetch_row($result);
				  
				  
				 // $id_contenido = $_GET['id_contenido'];
				  if( $id_contenido!=""){
				  
				    $query= "SELECT contenido    
                             FROM  noticias
                             WHERE id_noticia='$id_contenido'";
                       $result= cms_query($query)or die (error($query,mysql_error(),$php));
                       list($contenido2) = mysql_fetch_row($result);
					   
					 echo "  <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                               <tr >
                                 <td align=\"center\" class=\"textos\">
								 $contenido2
								 </td>
                                 </tr>
                           	</table>";
					   
				  }
				  
				  
				  
 



}

if($axj=="" and $_GET['tp']=="sesion"){

echo "  <table   border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
          
      	";
foreach($_SESSION as $variable=>$valor){
		$sesss=$_SESSION[$variable];
		 echo "<tr><td align=\"left\" class=\"textos\">$variable </td>
		 <td align=\"center\" class=\"textos\">$sesss</td> </tr> ";
		  
		 }
echo " </table>";
}


if(configuracion_cms('activar cache')==1){
	$cache1->cerrar();
}else{
	include("admin/estadisticas/estadistica.php");
}


	if($_GET['tp']==2){
	   foreach($_SESSION as $variable=>$valor){
		echo "var sess $variable ->".$_SESSION[$variable]."<br>";
		}	
	
	}
//mysql_close($DB);
////fin validacion de password para ingreso

include("cache/borra_cache_old.php");

function isAjax(){

    $xhr = strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
    if( !empty($xhr) &&
        $xhr == 'xmlhttprequest'){ 

        return true;
    }else{

        return false;
    }

}

if(isAjax()){
   // die('Es una peticion Ajax.');
}else{
   // die('peticion normal!');
}

function isAjax2(){

    $xhr = strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
    if( !empty($xhr) &&
        $xhr == 'xmlhttprequest'){ 

        return true;
    }else{

        return false;
    }

}
?>