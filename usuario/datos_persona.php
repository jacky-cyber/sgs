<?php
$persona = $_GET['ficha'];

 $query= "SELECT rut, dig, paterno, materno, nombres,razon_social,apoderado
  			fechanac, estcivil, nacionalidad, telefono,
  			celular, email, domicilio, id_comuna, escolaridad,
  			titulo, universidad, especialidad, banco, ctacte,
  			jefatura, bono, colacion, movilizacion, ley,
  			afp, afpafiliacion, afpcotizacion, isapre, isaprecotizacion,
			apv, apvcotizacion, ahorro, ahorrocotizacion, desempeno, beneficio,
  			contacto, parentesco, telparentesco, celparentesco,
  			cargo,  ccosto, asigjefatura, estado,establecimiento,id_tipo_persona    
           FROM  personal
           WHERE id = '$persona'";
 // echo $query." <b>datos personales</b><br>";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($rut, $dig, $paterno, $materno, $nombres,$razon_social,$apoderado
  		  $fechanac, $estcivil, $nacionalidad, $telefono,
  		  $celular, $email, $domicilio, $id_comuna, $escolaridad,
  		  $titulo, $universidad, $especialidad, $banco, $ctacte,
  		  $jefatura, $bono, $colacion, $movilizacion, $ley,
  		  $afp, $afpafiliacion, $afpcotizacion, $isapre, $isaprecotizacion, 
		  $apv, $apvcotizacion, $ahorro, $ahorrocotizacion, $desempeno, $beneficio,
  		  $contacto, $parentesco, $telparentesco, $celparentesco,
  		  $cargo, $ccosto, $asigjefatura, $estado,$id_estab,$id_tipo_persona) = mysql_fetch_row($result);
						   
	$fechanac = fechas_html($fechanac);
	$afpafiliacion= fechas_html($afpafiliacion);
	$escolaridad = escolaridad($escolaridad);
	
	

	
	
	$nombre_colegio = establecimiento_nombre($id_estab);



		//$lista_escolaridad =$escolaridad;
				 
		$banco = nombre_banco($banco);
		  
		$comuna = nombre_comuna($id_comuna); 
		 
		 
		/*Selected estado civil*/ 
		$var = $estcivil."_sel";
		$$var= "selected";
		/**/ 
		
		$rut = number_format($rut ,0 , "," ,".");
	

		$query= "SELECT fecha_crea,id_cargo
  			     FROM contratos 
  			     WHERE id_personal = '$persona'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($fecha_crea,$id_cargo) = mysql_fetch_row($result);
	 
	 
	 $fecha_crea = fechas_html($fecha_crea);
	 
	 $nombre_crea = usuario_nombre($id_usr_crea);
		
	 $cargo = tipo_cargo($id_cargo);
	 
if($fecha_crea=="--"){
	$fecha_crea = date(d)."-".date(m)."-".date(Y);
}

$query= "SELECT fecha_crea,id_usr_crea,estado  
         FROM contratos 
         WHERE id_contrato = '$id_contrato'";


$result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($fecha_crea,$id_usr_crea,$estado_c) = mysql_fetch_row($result);
	 $fecha_crea = fechas_html($fecha_crea);
	 
	 $nombre_crea = usuario_nombre($id_usr_crea);
	
	
	$estcivil = estado_civil($estcivil);
	  
  
	$nombre_foto = $rut;
	$nombre_foto = str_replace(".","",$nombre_foto);
	$nombre_foto = $nombre_foto .".jpg"; 
	//echo "images/personal/$nombre_foto";
	
  if(is_file("images/sitio/personal/$nombre_foto")){
  		$foto_persona ="<img src=\"images/imagen_chica.php?carpeta=personal&imagen=$nombre_foto&tamanio_image=100\" alt=\"$nombres $paterno\" border=\"0\" class=\"cuadro\">";
  	}else{
  		$foto_persona ="<img src=\"images/sitio/personal/personalinfo.gif\" alt=\"\" border=\"0\">";
  }
   
		
$contenido .="
	
	<table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\" class=\"cuadro\">
    <tr> 
      <td align=\"left\"  colspan=\"4\" class=\"cabeza\"><table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		     <tr>
		       <td align=\"left\" class=\"cabeza\">- Antecedentes Personales</td>
		      <td align=\"right\" class=\"cabeza\"></td>
		       </tr>
		 	</table>
	</td>
    </tr>
   <tr><td align=\"center\" class=\"textos\">
   
   <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
  <tr>
    <td>
      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td align=\"left\">&nbsp; </td>
		  <td align=\"left\">&nbsp;</td>
          <td align=\"left\">&nbsp;</td>
        </tr>
       
	    <tr> 
          <td align=\"left\">&nbsp;Establecimiento</td>
          <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;<b>$nombre_colegio</b></td>
        </tr>
         <tr>
          <td align=\"left\">&nbsp;Nombre</td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;<b>$nombres $paterno  $materno</b></td>
        </tr>
		<tr> 
          <td align=\"left\">&nbsp;Rut</td>
          <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$rut-$dig</td>
        </tr>
     <tr> 
          <td align=\"left\">&nbsp;Cargo</td>
          <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;<b>$cargo</b></td>
        </tr>
      
        <tr>
          <td align=\"left\">&nbsp;Fecha Nac. </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$fechanac</td>
        </tr>
        <tr>
          <td align=\"left\">&nbsp;Estado Civil </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$estcivil</td>
        </tr>
        <tr>
          <td align=\"left\">&nbsp;Nacionalidad </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$nacionalidad</td>
        </tr>
        <tr>
          <td align=\"left\">&nbsp;Escolaridad </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$escolaridad</td>
        </tr>
        <tr>
          <td align=\"left\">&nbsp;Titulo </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$titulo</td>
        </tr>
        <tr>
          <td align=\"left\">&nbsp;Universidad </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$universidad</td>
        </tr>
		 <tr>
          <td align=\"left\">&nbsp;Especialidad </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$especialidad</td>
        </tr>
        <tr>
          <td align=\"left\">&nbsp;Domicilio </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$domicilio</td>
        </tr>
		 <tr>
          <td align=\"left\">&nbsp;Comuna </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$comuna</td>
        </tr>
        <tr>
          <td align=\"left\">&nbsp;E-Mail </td>
		  <td align=\"left\">:</td>
          <td align=\"left\">&nbsp;$email</td>
        </tr>
       <tr>
          <td align=\"left\">&nbsp; </td>
		  <td align=\"left\">&nbsp;</td>
          <td align=\"left\">&nbsp;</td>
        </tr>
       
       
      </table>
    </td>
    <td align=\"center\" valign=\"top\">
	$foto_persona</td>
  </tr>
</table>
    </td></tr> 

  
   
  </table>
  
  <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
			  <tr><td align=\"center\" class=\"textos\">
			  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr >
        <td align=\"left\" class=\"textos\" width=\"22\">&nbsp;</td>
        <td align=\"center\" class=\"textos\">Bitacora</td>
        <td align=\"right\" class=\"textos\" width=\"22\">
		<a href=\"#formulario\" onclick=\"mostrar_form('')\">
		<img src=\"images/editpaste.png\" alt=\"Agregar Comentario a la Bitacora\" border=\"0\"></a>
		</td>
        </tr>
  	</table>
			  </td>
			  </tr>
			  <tr>
                <td align=\"center\" class=\"textos\">
				<div id=\"divFormulario\" style=\"display:none;\">
				  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr >
                      <td align=\"center\" class=\"textos\">
					     <textarea name=\"html\" cols=\"60\" rows=\"10\" class=\"textos\"></textarea>
					  </td>
                      </tr>
					  <tr><td align=\"center\" class=\"textos\">
					  <input type=\"submit\" name=\"Submit\" value=\"Enviar\"> </td></tr> 
                	</table>
				
				</div></td>
                </tr>
          <tr>
                <td align=\"center\" class=\"textos\">$lista_bitacora</td>
                </tr>
          	</table>

  
    

";


?>