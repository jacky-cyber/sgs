<?php
$id_galeria = $_GET['id_galeria'];
$id_cliente = $_GET['id_cliente'];
$id_imagen = $_GET['id_imagen'];
$act = $_GET['act'];

$mail = $_POST['mail'];
$nombre = $_POST['nombre'];
$comentario = $_POST['comentario'];

if($act!="" and $nombre!="" and $mail!="" and $comentario!=""){
	$qry_insert="INSERT INTO imagenes_comentarios(id_comentario,id_galeria,id_imagen,mail,nombre,comentario) 
	 values ('','$id_galeria','$id_imagen','$mail','$nombre','$comentario')";
	              
	$result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
	
}




  $query= "SELECT imagen1    
           FROM  imagenes 
           WHERE id_imagen='$id_imagen'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($imagen) = mysql_fetch_row($result);

  $query= "SELECT mail,nombre,comentario   
           FROM  imagenes_comentarios 
           WHERE id_galeria='$id_galeria'
           AND id_imagen=$id_imagen";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($mail,$nombre,$comentario) = mysql_fetch_row($result)){
      	
			$tabla_comentarios .= "
			<tr>
			      <td align=\"left\" class=\"textos\">Nombre : $nombre </td>
			      </tr>
			      <tr>
			      <td align=\"left\" class=\"textos\">Comentario : $comentario</td>
			      </tr>
			      
			      <tr><td align=\"left\" class=\"textos\">-------------------------</td></tr>
			      ";	   
		 }
		 
		$accion_form = "index.php?accion=$accion&id_imagen=$id_imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&act=1"; 
		 
		  
      $formulario_comentario ="<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		     <tr >
		       <td align=\"left\" class=\"textos\">Nombre</td>
		       <td align=\"left\" class=\"textos\">
		       <input type=\"text\" name=\"nombre\" class=\"textos\">
		       </td>
		       </tr>
		 	 <tr >
		       <td align=\"left\" class=\"textos\" class=\"textos\">Mail</td>
		       <td align=\"left\" class=\"textos\">
		       <input type=\"text\" name=\"mail\" class=\"textos\">
		       </td>
		       </tr>
		 	 <tr >
		       <td align=\"left\" class=\"textos\" >Comentario</td>
		       <td align=\"left\" class=\"textos\">
		       <textarea name=\"comentario\" cols=\"30\" rows=\"3\" class=\"textos\"></textarea>
		       </td>
		       </tr>
		 	</table>";
		 
		 
      $tabla_comentarios ="<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			    $tabla_comentarios
				</table>";

      
      $js ="<script language=\"JavaScript\">
      function validaforma(theForm){
      
      	if (theForm.nombre.value == \"\"){
      			alert(\"Debes ingresar un nombre.\");
      			theForm.nombre.focus();
      			return false;
      	}
      	if (theForm.mail.value == \"\"){
      			alert(\"Debes ingresar un mail.\");
      			theForm.mail.focus();
      			return false;
      	}
      if (theForm.comentario.value == \"\"){
      			alert(\"Debes ingresar un Comentario.\");
      			theForm.comentario.focus();
      			return false;
      	}
      
      	
      
      
      }
      </script>";
      
      
      $onsubmit ="onSubmit=\"return validaforma(this)\"";
      
      
      
      
$contenido = "<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">
                  
                  <img src=\"gal/imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=100\" alt=\"\" border=\"0\">
                  </td>
                </tr>
             <tr>
                  <td align=\"center\" class=\"textos\">
                  
                  $tabla_comentarios
                  </td>
                </tr>
             <tr>
                  <td align=\"center\" class=\"textos\">
                  $formulario_comentario
                  </td>
                </tr>
             <tr>
                  <td align=\"center\" class=\"textos\">
                 <input type=\"submit\" name=\"Submit\" value=\"Aceptar\" class=\"textos\">
                  </td>
                </tr>
                <tr><td align=\"center\" class=\"textos\">
                <a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user\">Volver a Galeria</a>
      
                </td></tr>
              </table>";


?>