<?php
$boton = $_POST['boton'];
$id_perfil = $_GET['id_perfil'];
$perfil = $_POST['perfil'];
$url_defecto = $_POST['url_defecto'];
$activo = $_POST['activo'];

$del = $_GET['del'];
$edit= $_GET['edit'];
$id_p= $_GET['id_p'];


if(isset($del)){
	
	 $Sql ="DELETE FROM usuario_perfil where id_perfil='$id_perfil'";

 cms_query($Sql);
	 
	  $Sql ="DELETE FROM accion_perfil where id_perfil='$id_perfil'";

 cms_query($Sql);
	 
	  $perfil_padre = perfil_padre($id_perfil);
	  
	  $Sql ="DELETE FROM usuario_perfil_relacion where id_perfil_hijo='$id_perfil' ";

 cms_query($Sql);
	  
	  if($perfil_padre!=0){
	      header("Location:index.php?accion=$accion&id_p=$perfil_padre");
	  }
	  
	
}


if(isset($boton) and $id_perfil==""){
	
	  $query= "SELECT id_perfil 
	           FROM  usuario_perfil 
	           WHERE perfil='$perfil'";
	  	      
	            $result= cms_query($query)or die (error($query,mysql_error(),$php));
	            if (!list($id_per) = mysql_fetch_row($result)){
	     	
	    $query= "SELECT max(id_perfil)
	     	     FROM  usuario_perfil
				 where id_perfil<>999";
					   
	     	      $result_id= cms_query($query)or die (error($query,mysql_error(),$php));
	     	      list($id_cont) = mysql_fetch_row($result_id);
				  
				 $id_cont++;
					 				
	     	     
	     	
				$qry_insert="INSERT INTO usuario_perfil
				                         (id_perfil,perfil,url_defecto,activo) 
				                         values ('$id_cont','$perfil','$url_defecto','$activo')";
				
				//echo "$qry_insert<br>";
							                 
				$result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR1-Problemas al insertar $qry_insert");
				
								
if($id_p!=""){
					
				$qry_insert="INSERT INTO  usuario_perfil_relacion
				                          (id_perfil_padre,id_perfil_hijo) 
				                           values ('$id_p','$id_cont')";
							                 
				$result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR2-Problemas al insertar $qry_insert");
			
				
             }
				
							   			   
}
	
}elseif($id_perfil!="" and isset($boton)){

$Sql ="UPDATE usuario_perfil
	   SET 
	   perfil ='$perfil',
	   url_defecto='$url_defecto',
	   activo='$activo'
	   WHERE id_perfil ='$id_perfil'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
}

if($id_p!=""){
        $accion_form_url ="&id_p=$id_p";

        $id_perf_padre = perfil_padre($id_p);
	
        $nivel_perfil=0;
	    $perfil = perfil_padre($id_p);
		//echo $perfil;
		$perfil_nombre = nombre_perfil($id_p);
		$camino_perfil = "<a href=\"index.php?accion=$accion&id_p=$id_p\">$perfil_nombre</a> / ".$camino_perfil;
		
	    while($perfil!=0){
		    
			$perfil_nombre = nombre_perfil($perfil);
			
			//echo $perfil_nombre ."<br>";
			$camino_perfil = "<a href=\"index.php?accion=$accion&id_p=$perfil\">$perfil_nombre</a> / ".$camino_perfil;
			$perfil = perfil_padre($perfil);
		}

}

if(isset($edit)){

  $query= "SELECT perfil,url_defecto,activo    
           FROM  usuario_perfil
           WHERE id_perfil='$id_perfil'";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
      
      list($perfil,$url_defecto,$activo) = mysql_fetch_row($result);
      
	  $var = "check$activo";
	  $$var= "checked";
	  $accion_form = "?accion=$accion&act_perfiles=$act_perfiles&id_perfil=$id_perfil".$accion_form_url; 
	
}else{

      $accion_form = "?accion=$accion&act_perfiles=$act_perfiles".$accion_form_url;

}


$js ="<script language=\"JavaScript\">
function validaforma(theForm){

	  if (theForm.perfil.value == \"\"){
			alert(\"Por favor ingrese un perfil.\");
			theForm.perfil.focus();
			return false;
	}

}
</script>";



$onsubmit ="onSubmit=\"return validaforma(this)\"";


$contenido = "<br><table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\" cuadro\">
              <tr>
                   <td align=\"center\" class=\"textos\">
            <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
            <tr><td align=\"center\" class=\"cabeza_rojo\" colspan=\"3\">Perfiles</td></tr>  
            <tr>
                   <td align=\"left\" class=\"textos\">&nbsp;Agrege Perfil</td>
                   <td align=\"left\" class=\"textos\">:</td>
               	   <td align=\"left\" class=\"textos\">
               	   <input type=\"text\" name=\"perfil\" value=\"$perfil\"></td>
            </tr>
			<tr>
              	   <td align=\"left\" class=\"textos\">&nbsp;Agrege url defecto</td>
              	   <td align=\"left\" class=\"textos\">:</td>
                   <td align=\"left\" class=\"textos\">
               	   <input type=\"text\" name=\"url_defecto\" value=\"$url_defecto\"></td>
            </tr>
			<tr>
              	 <td align=\"left\" class=\"textos\">&nbsp;Activo&nbsp;&nbsp;
				 <input type=\"radio\" name=\"activo\" value=\"1\" $check1></td> 
              	 <td align=\"left\" class=\"textos\">Desactivo&nbsp;&nbsp;
				 <input type=\"radio\" name=\"activo\" value=\"0\" $check0></td>
              	 <td align=\"left\" class=\"textos\" ></td>
          </tr>
          <tr>
                  <td align=\"center\" class=\"textos\"></td>             
                  <td align=\"center\" class=\"textos\"></td>              
                  <td align=\"center\" class=\"textos\">
                  <input class=\"boton\" type=\"submit\" name=\"boton\" value=\"Aceptar\"></td>
         </tr>
         <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
         <tr>
                  <td align=\"left\" class=\"textos\"> $camino_perfil</td>
                  <td align=\"left\" class=\"textos\"></td>
                  <td align=\"left\" class=\"textos\"></td>
         </tr> 
                
       </table>
                </td>
             </tr>
	 </table>"; 
	 
	
      if($id_p!=""){
      	
		 $tablas_cond =", usuario_perfil_relacion ";

		 $condicion_relacion ="WHERE id_perfil_padre=$id_p AND id_perfil= id_perfil_hijo";
		 $nivel_perfil_p= nivel_perfil($id_p);
			$nivel_perfil_p++;
			
		 }else{
		 $nivel_perfil_p=0;
		 }
		 
			 
$query= "SELECT id_perfil,perfil,url_defecto    
           FROM  usuario_perfil  $tablas_cond
		   $condicion_relacion";	   
		  // echo $query; 
          $result= cms_query($query)or die (error($query,mysql_error(),$php));  

 /* $query= "SELECT u.id_perfil,u.perfil,u.url_defecto    
           FROM  usuario_perfil u as usuario_perfil_relacion up
		   WHERE  WHERE up.id_perfil_padre=u.$id_p AND u.id_perfil= up.id_perfil_hijo";	   
	 echo $query; 
          $result= cms_query($query)or die (error($query,mysql_error(),$php));  */

  
         
   
          while (list($id_perfil,$perfil,$url_defecto) = mysql_fetch_row($result)){
      	  $cont++;
      				
      	$nivel_perfil = nivel_perfil($id_perfil);
		
		//echo "$nivel_prefil==$nivel_perfil_p<br>";
		
		if($nivel_perfil==$nivel_perfil_p){
			
			$hijos=hijos_perfil($id_perfil);
			
			if($hijos==true){
						$del_img="<img src=\"images/plus.gif\" alt=\"Ver\" border=\"0\">";			
			}else{
			$del_img="<a href=\"javascript:confirmar('Esta Seguro de Borrar $perfil','$PHP_SELF?accion=$accion&act_perfiles=$act_perfiles&id_perfil=$id_perfil&del=ok')\">
			     			    <img src=\"images/del.gif\" alt=\"Del\" border=\"0\">
			     			    </a>";
			}
			
		   	$lista_perfil.= "<tr>
			      				<td align=\"left\" class=\"textos\">$cont</td>
			     				<td align=\"left\" width=\"100\" class=\"textos\">
								<a href=\"index.php?accion=$accion&act_perfiles=1&id_p=$id_perfil\">$perfil</a></td>
			     				<td align=\"left\" class=\"textos\">$url_defecto</td>
			     			    <td align=\"center\" class=\"textos\">$nivel_perfil</td>	    			  
			     			    <td align=\"center\" class=\"textos\">
								<a href=\"index.php?accion=$accion&act_perfiles=$act_perfiles&id_perfil=$id_perfil&edit=ok$accion_form_url\">
        						 <img src=\"images/edit.gif\" alt=\"\" border=\"0\"></a></td>
			     			    <td align=\"center\" class=\"textos\">$del_img</td>     			 
			     		</tr>";
			     			  	
		}
				   
		 }
		 
		 
		 
		 $lista_perfil=  " <br><br>
		 <script languaje=\"javascript\">
		 function confirmar( mensaje, destino) {  
		   if (confirm(mensaje)) {     
		      document.location = destino ;  
		 	   }
		 }
		 
		 </script>
		
		 <table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\" cuadro\">
		     				<tr>
		      					  <td align=\"center\" class=\"cabeza_rojo\">N°</td>
		      					  <td align=\"center\" class=\"cabeza_rojo\">Perfil</td>
		      					  <td align=\"center\" class=\"cabeza_rojo\">PHP x defecto</td>
		      					  <td align=\"center\" class=\"cabeza_rojo\" >Nivel</td>
		      					  <td align=\"center\" class=\"cabeza_rojo\" >Editar</td>
		      					  <td align=\"center\" class=\"cabeza_rojo\" >Borrar</td>
		      				</tr>
		      				 $lista_perfil
		 				</table>";
		 
		$contenido .= $lista_perfil;

?>