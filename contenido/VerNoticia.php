<?php
$apellido_amigo = $_POST['apellido_amigo'];
$nombre_amigo = $_POST['nombre_amigo'];
$email_amigo = $_POST['email_amigo'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$mensaje = $_POST['mensaje'];




$js ="

<script src=\"js/mootools-release-1.11.rr.js\" type=\"text/javascript\"></script>

<script src=\"js/jd.gallery.js\" type=\"text/javascript\"></script>

<SCRIPT LANGUAGE=\"JavaScript\"> 
function isEmailAddress(theElement, nombre_del_elemento)
{
var s = theElement.value;
var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (s.length == 0 ) return true;
if (filter.test(s))
return true;
else

return false;
}
</SCRIPT>


<script language=\"JavaScript\">
function validaforma_2(theForm){

	if (theForm.nombre_amigo.value == \"\"){
			alert(\"Por favor ingrese el Nombre.\");
			theForm.nombre_amigo.focus();
			return false;
	}
	if (theForm.apellido_amigo.value == \"\"){
			alert(\"Por favor ingrese el Apellido.\");
			theForm.apellido_amigo.focus();
			return false;
	}
	if (theForm.email_amigo.value == \"\"){
			alert(\"Por favor ingrese el email.\");
			theForm.email_amigo.focus();
			return false;
	}
	if (theForm.mensaje.value == \"\"){
			alert(\"Por favor ingrese el mensaje.\");
			theForm.mensaje.focus();
			return false;
	}
	
	
	if (isEmailAddress(theForm.email_amigo,'theForm.email_amigo')== false){
  	 					alert(\"Por favor ingrese el email.\");
  	 					theForm.email_amigo.focus();
  	 					return false;
  	}
  	
	
  	 			
}
</script>";






	
$css .= "<link rel=\"stylesheet\" href=\"css/jd.gallery.css\" type=\"text/css\" media=\"screen\" charset=\"utf-8\"/>

<style>
        .black_overlay{
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;           
            z-index:1001;         
           
        }
        .white_content {
            display: none;
            position: absolute;
            top: 40%;
            left: 35%;
            width: 70%;
            height: 25%;
            padding: 16px;
            border: 6px solid orange;
            background-color: white;
            z-index:1002;
            overflow: auto;    

            
        }
    </style>

";
	




$act_f = $_GET['act_f'];
$id_contenido = $_GET['id_contenido'];
$op = $_GET['op'];

$accion_galeria=7;

$tamanio_image =160;


if(!is_numeric($id_contenido)){
	
	$id_contenido = texto_to_id_noticia($id_contenido);
}


$query = "SELECT titulo,titulo_corto,contenido,id_imagen,id_tipo,fecha,fuente,visible,id_galeria,id_cliente,id_user,click,link,ptos,imprimir,amigo,id_autor
          FROM noticias 
          WHERE id_noticia='$id_contenido'";


$resultado = cms_query($query) or die ("problemas en la consulta 1.2<br>$query");

list($titulo,$titulo_corto,$contenido2,$id_imagen2,$id_tipo,$fecha,$fuente,$opinable,$id_galeria,$id_cliente,$id_user,$click,$link,$ptos,$imprimir,$amigo,$id_autor) = mysql_fetch_row($resultado);

$seccion_titulo .= " -- ".$titulo;

$fuente = usuario_nombre($id_autor);


$seccion_titulo ="-- $titulo";
 if($id_galeria!=""){
 	
 	include("contenido/agregar_galeria.php");
   
    }
 
//echo "$id_galeria";
   $click++;
   

   
					$Sql ="UPDATE noticias 
                    	   SET id_user ='$id_usuario',click='$click'
                    	   WHERE id_noticia='$id_contenido'";
                    		
					//echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
                    	  
 
if($opinable == "si"){	//el isset($variable) para ver si se han llenado los campos de un formulario
	
if($act_f==1){

	
	
      $id_opinion = new_uid();
     $opinion = $_POST['opinion'];
	
	 if ($opinion!=""){
	 
	   $qry_insert="INSERT INTO noticia_opina (id_opinion,id_noticia,id_usuario,opinion)
                    VALUES ('$id_opinion','$id_contenido','$id_usuario','$opinion')";
       // echo "$quy_insert";   
               $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
           
	 }
  
  }

}


     	  $query= "SELECT id_usuario,opinion
                        FROM  noticia_opina 
                        WHERE id_noticia='$id_contenido'";
                $result_r= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
                
                while (list($id_autor,$opinion) = mysql_fetch_row($result_r)){
             		
			  $query_u= "SELECT nombre   
                       FROM  usuario
                       WHERE id_usuario='$id_autor'";
                 $result_u= cms_query($query_u)or die (error($query_a,mysql_error(),$php));
                list($autor) = mysql_fetch_row($result_u);
					
						if($fondo==1){
                                		$bg= "bgcolor=\"#ffffff\"";
                                		$fondo=0;
                                		}else{
                                		$fondo=1;
                                		$bg= "bgcolor=\"#F7F7F7\"";
                                		}
					
					$opinion= nl2br($opinion);
					$opiniones .= "<table width=\"100%\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\" align=\"center\" bordercolor=\"#ffffff\" $bg>
											  <tr>
                                               <td class=\"textos_plomo\" align=\"left\" width=\"18%\">&nbsp;Autor </td>
											   <td class=\"textos\" align=\"left\">:&nbsp;$autor</td>
                                         </tr>
										  <tr>
                                               <td class=\"textos_plomo\" align=\"left\" valign=\"top\" width=\"18%\">&nbsp;Comentario </td>
											   <td class=\"textos\" align=\"left\">:&nbsp;$opinion</td>
                                         </tr>
                                      </table><br>";				   
                }

                
 $query= "SELECT id_opinion   
                   FROM  noticia_opina
                   WHERE id_noticia='$id_contenido'";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
          $num_opiniones = mysql_num_rows($result);
		


if($opinable=="si" AND $id_usuario!=0 ){

if(isset($id_usuario)){
	
	  $query_nom= "SELECT nombre   
                  FROM  usuario
               WHERE id_usuario='$id_usuario'";
   
		 $result_nom= cms_query($query_nom)or die (error($query_nom,mysql_error(),$php));
         list($nombre) = mysql_fetch_row($result_nom);
		
		 
}



  $accion_form ="index.php?accion=$accion&act=5&act_f=1&id_contenido=$id_contenido";


$opina = "<form name=\"form3\" action=\"index.php?accion=$accion&act=5&act_f=1&id_contenido=$id_contenido\" method=\"post\" enctype=\"multipart/form-data\" >
<br><br><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                 <tr>
                     <td class=\"textos_plomo\" align=\"center\">Existen $num_opiniones opiniones sobre esta noticia</td>
               </tr>
            </table>



<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                     <tr>
                      <td class=\"textos\" align=\"center\">T&uacute; opini&oacute;n aqu&iacute;  $nombre
					 </td>
                </tr>
			       <tr>
                      <td class=\"textos\" align=\"center\">M&aacute;x. 255 Caracteres
					 </td>
                </tr>
				<tr>
				 <td class=\"textos\" align=\"center\">
					  <textarea name=\"opinion\" class=\"textos\" cols=\"50\" rows=\"3\"  onKeyUp=\"return maximaLongitud(this,254)\"></textarea>
					  </td>
                </tr>
				
				<tr>
                      <td class=\"textos\" align=\"center\">
					  &nbsp;   
					  </td>
                </tr>
			<tr>
                      <td class=\"textos\" align=\"center\">
					  <input type=\"submit\" name=\"Submit\" value=\"Enviar\" class=\"boton\">
					  </td>
                </tr>
				
          <tr>
                      <td class=\"textos\" align=\"center\">
					  &nbsp;
					  </td>
                </tr>
				
             </table><br><br></form>";

}
	
if($id_imagen2!=""){
	
$queryi = "SELECT imagen1,pie_esp
           FROM imagenes
           WHERE id_imagen = $id_imagen2";

          
//echo "$queryi";
$resultadoi = @cms_query($queryi) or die ("problemas en la consulta 2.<br>$queryi");



list($imagen,$pie) = mysql_fetch_row($resultadoi);
}
//echo "$imagen,$pie";

 if(is_file("images/news/$id_contenido/$imagen")){		// retorna un true si existe el archivo
           	
//$link ="images/news/marca_p.php?foto=$imagen&id_contenido=$id_contenido";
           
		   		if($imagen!=""){
		   		
		 $imagen= "<a href=\"#\" onClick=\"MM_openBrWindow('images/news/marca_p.php?foto=$imagen&id_noticia=$id_contenido','','width=$imgAncho,height=$imgAlto')\" >
	  <img src=\"contenido/imagen_chica.php?imagen=$imagen&tamanio_image=200&id_contenido=$id_contenido\"  align=\"left\" hspace=\"0\" vspace=\"0\" border=\"0\">
	    </a>
						";
		   			
		   			if($imagen!=""){





// <img src=\"images/pretty_girl.gif\" width=\"200\" height=\"227\" hspace=\"0\" vspace=\"0\" border=\"1\">
$cuerpo_imagen = "
<table width=\"33%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  align=\"left\">
  <tr > 
    <td >
	<table  width=\"33%\" border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td width=\"16\"><img src=\"images/marc_foto/top_lef.gif\" width=\"16\" height=\"16\"></td>
      <td height=\"16\" background=\"images/marc_foto/top_mid.gif\"></td>
      <td width=\"24\"><img src=\"images/marc_foto/top_rig.gif\" width=\"24\" height=\"16\"></td>
    </tr>
    <tr>
      <td width=\"16\" background=\"images/marc_foto/cen_lef.gif\" align=\"center\" class=\"textos-chico\"></td>
      <td align=\"center\" valign=\"middle\" bgcolor=\"#FFFFFF\">
	   
	  $imagen
	 
	  </td>
      <td width=\"24\" background=\"images/marc_foto/cen_rig.gif\"></td>
    </tr>
    <tr>
      <td width=\"16\" height=\"16\"><img src=\"images/marc_foto/bot_lef.gif\" width=\"16\" height=\"16\"></td>
      <td height=\"16\" background=\"images/marc_foto/bot_mid.gif\"></td>
      <td width=\"24\" height=\"16\"><img src=\"images/marc_foto/bot_rig.gif\" width=\"24\" height=\"16\"></td>
    </tr>
	
	
  </table>
	</td>
  </tr>
  <tr > 
    <td align=\"center\" class=\"textos\">
	
	$pie</td>
  </tr>
</table>





";

}
		   		}
		   
		   }






$fecha_aux = explode("-", $fecha);

$fecha = $fecha_aux[2].$fecha_aux[1].".".$fecha_aux[0];


//$contenido2 = nl2br($contenido2);

if($imprimir=="si"){


	$imprimir_ico ="<a href=\"#\" onClick=\"MM_openBrWindow('index.php?accion=$accion&act=6&id_contenido=$id_contenido&axj=1','Intranet','scrollbars=yes,resizable=yes,width=600,height=400')\">
		            <img src=\"images/printButton.jpg\" alt=\"Imprimir\" border=\"0\"></a>";

}
  
$estructura_noticia= html_template('estructura_noticia');
$estructura_noticia = str_replace("#TITULO#","$titulo",$estructura_noticia);
$estructura_noticia = str_replace("#TITULO_CORTO#","$titulo_corto",$estructura_noticia);
$estructura_noticia = str_replace("#CUERPO_IMAGEN#","$cuerpo_imagen",$estructura_noticia);
$estructura_noticia = str_replace("#CONTENIDO2#","$contenido2",$estructura_noticia);

$contenido ="

<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
							<tr>
      								<td align=\"right\" class=\"textos\">
      								$imprimir_ico
									$amigo_ico
									</td>
							</tr>
				<tr> 
                            <td valign=\"top\">
                              $estructura_noticia 
							  </td>

							  <tr><td align=\"center\" class=\"textos\">&nbsp;&nbsp; </td></tr> 
                          </tr>
							
      							   <td align=\"left\" class=\"fuente\">Fuente: $fuente</td>
     							   
     							 </tr>
							
                          <tr> 

                            <td valign=\"middle\" background=\"images/fotos/lin.gif\">
							<img src=\"images/fotos/linb.gif\" width=\"5\" height=\"8\"></td>

                          </tr>
						  </table>
							 <table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
    <tr >
      <td align=\"center\" class=\"textos\">$galeria</td>
      </tr>
      <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
       <tr >
      <td align=\"center\" class=\"textos\">$opina</td>
      </tr>
	</table>";





$contenido .= $tabla ;

if($opiniones!=""){
$contenido .="<table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
	
    <tr><td align=\"center\" class=\"cabeza_rojo\">Opiniones sobre esta noticia</td></tr> 
    <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
	<tr >
      <td align=\"center\" class=\"textos\">$opiniones</td>
      </tr>
	</table>";	
}
 

	


?>