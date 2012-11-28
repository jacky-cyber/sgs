<?php


$act_f = $_GET['act_f'];
$act = $_GET['act'];


$id = $_GET['id'];
$tipo_new = $_GET['tipo_new'];



$imagen= $_FILES['imagen']['tmp_name'];
$imagen_name= $_FILES['imagen']['name'];


$id_noticia = $_POST['id_noticia'];
$idioma = $_POST['idioma'];
$titulo = $_POST['titulo'];
$titulo2_corto = $_POST['titulo2_corto'];
$contenido2 = $_POST['contenido2'];
$id_imagen = $_POST['id_imagen'];
$id_tipo_n = $_POST['id_tipo_n'];
$id_tipo = $_POST['id_tipo'];
$visible = $_POST['visible'];
$pie = $_POST['pie'];
$fecha= $_POST['fecha'];
$id_imagen_pub= $_POST['id_imagen_pub'];
$fuente = $_POST['fuente'];
$act =$_GET['act'];
$guardar = $_POST['guardar'];

$colegio_publico = $_POST['colegio_publico'];
$perfil_publico = $_POST['perfil_publico'];
$imprimir = $_POST['imprimir'];
$amigo = $_POST['amigo'];
$titulo_principal = $_POST['titulo_principal'];
$bajada_principal = $_POST['bajada_principal'];
$destacado = $_POST['destacado'];



switch ($act) {
     case 1:
          
	// include ("admin/GNews/noticias_relacionadas.php");
	 include ("admin/GNews/AgregarContenido.php");
	  include ("admin/GNews/add_tag.php");
         
	 break;
	 case 2:
	   include ("admin/GNews/add_tag.php");
          
	
	 include ("admin/GNews/EditarContenido.php");
	  
         break;
  	case 3:
         include ("admin/GNews/BorrarContenido.php");
         break;
 	case 4:
         include ("admin/GNews/add_publicador.php");
         break;
   	default:
	case 5:
         include ("admin/GNews/listar_plantilla.php");
         case 6:
         include ("admin/GNews/agregar_tag_ajax.php");
         break;
    case 6:
         
    	include ("admin/GNews/plantilla.php");
         
         $accion_form = "index.php?accion=$accion&act=7";
         break;
    case 7:
         //inserta("noticia_plantilla");
		 $nombre_plantilla = $_POST['nombre_plantilla'];
		 $plantilla_html = $_POST['plantilla_html'];
		 $fecha =  date(Y)."-".date(m)."-".date(d);
		 
         $qry_insert="INSERT INTO noticia_plantilla (id_plantilla_noticia,id_usuario,nombre_plantilla,plantilla_html,fecha,defecto) 
		              values (null,$id_usuario,'$nombre_plantilla','$plantilla_html','$fecha',0)";
                       
                         $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");
         header("Location:$PHP_SELF?accion=$accion&act=5");
         break;
     case 8:
          include ("admin/GNews/activa_plantilla.php");
         header("Location:$PHP_SELF?accion=$accion&act=5");
         break;
     case 9:
     	$id_plantilla = $_GET['id_plantilla'];
		$boton_actualiza = $_POST['boton_actualiza'];
		$boton_ok = $_POST['boton_ok'];
         update("noticia_plantilla",$id_plantilla);
		 
		 if($boton_actualiza!=""){
		 	 header("Location:$PHP_SELF?accion=$accion&act=10&id_plantilla=$id_plantilla");
		 }else{
		 	 header("Location:$PHP_SELF?accion=$accion&act=5");
		 }
         
         break;
     case 10:
        include("admin/GNews/rescatar_datos.php"); 
    	include ("admin/GNews/plantilla.php");
         
         $accion_form = "index.php?accion=$accion&act=9&id_plantilla=$id_plantilla";
         break;
     case 11:
     	$id_plantilla = $_GET['id_plantilla'];
         borrar("noticia_plantilla",$id_plantilla);
         header("Location:$PHP_SELF?accion=$accion&act=5");
         break;    
         
    case 12:
	include("admin/GNews/add_galeria_news.php"); 
     	 break;    
         
    case 13:
	include("admin/GNews/lista_noticias.php"); 
     	 break;    
    case 14:
	include("admin/GNews/activa_noticia.php"); 
     	 break;    
    case 15:
	include("admin/GNews/republicar_noticia.php"); 
     	 break;    
         
   	default:   		
	   $def ="ok";
	 
    //include("admin/GNews/index2.php")   ;
    include("admin/GNews/index3.php");
    
 }
 
 
 
 
 /*
 * Select tabla noticias
 * 

$query= "SELECT id_noticia,titulo  
           FROM  noticias";
     $result_noticias= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_noticia,$titulo) = mysql_fetch_row($result_noticias)){
			
			$titulo_url = trim($titulo);
			$titulo_url = str_replace("<strong>","",$titulo_url);
			$titulo_url = str_replace("</strong>","",$titulo_url);
			$titulo_url = str_replace("&nbsp;","",$titulo_url);
			
			$titulo_url = friendlyURL(utf8_encode($titulo_url));
			
			$contenido .= "$id_noticia -- $titulo-->$titulo_url<-<br>";
			
			
			$Sql ="UPDATE noticias
 	   SET titulo_url='$titulo_url'
 	   WHERE id_noticia ='$id_noticia'";
 				  
 	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
						   
		 }
/** fin select noticias***/

?>