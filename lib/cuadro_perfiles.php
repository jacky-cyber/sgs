<?php

//echo $id_contenido." ddddd";


//$colegios_publico = $_POST['colegios_publico'];
$perfiles_publico = $_POST['perfiles_publico'];

$id_p_check = $_POST['id_p_check'];


//$id_colegio = $_GET['id_colegio'];
$id_perf = $_GET['id_perf'];


/*if($id_colegio!=""){

 $Sql ="DELETE FROM control_contenido_escuela
 WHERE id_contenido ='$id_contenido' and id_establecimiento=$id_colegio";

 cms_query($Sql);
  
  header("HTTP/1.0 307 Temporary redirect");
  header("Location:index.php?accion=$accion&act=$act&id_contenido=$id_contenido");
}*/


if($id_perf!=""){
$Sql ="DELETE FROM control_contenido_perfil
 WHERE id_contenido ='$id_contenido' and id_perfil=$id_perf";

 cms_query($Sql);
 // header("HTTP/1.0 307 Temporary redirect");
  header("Location:index.php?accion=$accion&act=$act&id_contenido=$id_contenido");
}





 /* $query= "SELECT id_establecimiento    
           FROM  control_contenido_escuela
           WHERE id_contenido ='$id_contenido'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_establecimiento) = mysql_fetch_row($result)){
				
				
				$var_cont_cole="$id_contenido"."_$id_establecimiento";
				
				
				$nombre_establecimiento = establecimiento_nombre($id_establecimiento);
				$tabla_escuela .="<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp;$nombre_establecimiento  </td>
				<td align=\"center\" class=\"textos\" >
				<a href=\"#colegio_contenido\" onClick=\"sendcolegiocontenido('$var_cont_cole')\">
				<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
				</td></tr>";
				
		 }	

		$tabla_escuela = "<br><div id=\"resultadoColCont\">
						<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                        <tr class=\"cabeza\">
                          <td align=\"center\" >Colegio</td>
                       <td align=\"center\" class=\"textos\"></td>
                        </tr>
						$tabla_escuela
                      </table></div>";*/

					  
				  
					  
					  
     $query= "SELECT id_perfil    
              FROM  control_contenido_perfil 
              WHERE id_contenido ='$id_contenido' and id_perfil<>'0'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_perf) = mysql_fetch_row($result)){
				
				$var_perf_cont="$id_contenido"."_$id_perf";
				
				$nombre_perfil = nombre_perfil($id_perf);
				$tabla_perfil .="<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp;$nombre_perfil</td>
				<td align=\"center\" class=\"textos\">
				<a href=\"#perfil_contenido\" onClick=\"sendperfilcontenido('$var_perf_cont')\">
				
				<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
				</td></tr>
				
			  ";
				
				
				
		 }

		$tabla_peril = "<br><div id=\"resultadoPerfCont\">
		<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                        <tr class=\"cabeza\">
                          <td align=\"center\" >Perfiles</td>
                       <td align=\"center\" class=\"textos\"></td>
                        </tr>
						$tabla_perfil
                      </table>
					  </div>
			  ";


					  
					  
					  


if($id_contenido!=""){
	
	if(contenido_colegio($id_contenido,0)){
		
		$desabilita_ext= "ok";
		$check_perfil_si="checked";
	}else{
	
	  $query= "SELECT id_perfil   
               FROM  control_contenido_perfil 
               WHERE id_contenido='$id_contenido'";
        //echo $query;
		 $result= cms_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_per) = mysql_fetch_row($result)){

				$check_perfil_no="checked";			   
    		 }else{
			 
				 if($id_p_check==""){
					$desabilita_ext= "ok";
					$check_perfil_si="checked";
				 }else{
					$check_perfil_no="checked";
				 }
			 }
	
		
	}
	
}else{
	if($id_p_check==""){
		$desabilita_ext= "ok";
		$check_perfil_si="checked";
	}else{
		$check_perfil_no="checked";
	}
}



if($id_contenido!=""){

	if(contenido_colegio($id_contenido,0)){
	
		$checked_cole_si="checked";
	}else{
		$checked_cole_no="checked";
	}
	
}else{
	$checked_cole_si="checked";
}

 
 include ("lib/cuadro_perfiles_check_box.php");
 
 $js .=" <script language=\"javascript\">

function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == \"checkbox\"){
	     document.form1.elements[i].checked=1 ;
		 document.form1.elements[i].disabled=true; 
		 }
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == \"checkbox\") {
         document.form1.elements[i].checked=0;
		 document.form1.elements[i].disabled=false; 
		 }
} 
	
function desmarca_lista(){
	
	   form1.lista_establecimiento.disabled=true;
	
}
function marca_lista(){
	
		form1.lista_establecimiento.disabled=false;
	
}

 </script>
";



if(perfil_contenido($id_contenido,0)){
			$disabled="disabled";
		}else{
			$disabled="";
		}
		 
   
  /* $query= "SELECT id
           FROM  establecimientos";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_establec) = mysql_fetch_row($result)){
	  	
	  	$nombre_establecimiento = establecimiento_nombre($id_establec);
			$lista_establecmientos .="<option value=\"$id_establec\">$nombre_establecimiento</option>";
			
			
		 }
		
		 
	 $lista_establecmientos ="<select name=\"lista_establecimiento\" class=\"textos\" $disabled>
									<option value=\"\">Seleccione un Colegio para agregar..</option>
										$lista_establecmientos
								</select>";
*/

$cuadro_perfiles_colegios="<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
				<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp;&nbsp;<b>Visualización por Perfiles</b>
				</td></tr> 
				<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp;&nbsp;Publicar todos los perfiles
				  <input type=\"radio\" name=\"perfiles_publico\" value=\"1\" $check_perfil_si onclick=\"seleccionar_todo()\">&nbsp;SI &nbsp;&nbsp;
				  <input type=\"radio\" name=\"perfiles_publico\" value=\"0\" $check_perfil_no onclick=\"deseleccionar_todo()\">&nbsp;NO
				</td></tr> 
				
				<tr>
                  <td align=\"center\" class=\"textos\" height=\"15\">
				  $check_perfiles_check
				  </td>
                </tr>
				 <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
				 <tr><td align=\"center\" class=\"textos\">$tabla_peril</td></tr>
				
				<tr>
                  <td align=\"left\" class=\"textos\" height=\"15\">
				&nbsp;&nbsp;&nbsp; <font color=\"#666666\">&nbsp;(*)&nbsp;Los permisos de Visualizaciones serán asignadas en cascada. </font> 
				  </td>
                </tr>
				<tr>
                  <td align=\"center\" class=\"textos\" height=\"15\">
				 
				  </td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
				
				<tr bgcolor='ffffff'>
				
				<td class=\"textos\" colspan=\"4\" align=\"center\">
				<input class=\"boton\" name='addpoll' type='submit' value='Agregar'>			
				</td></tr>
				
				
</table>




";

$jsCCC ="
<link rel=\"stylesheet\" type=\"text/css\" href=\"js/jquery/multi_select/jquery.multiselect.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"js/jquery/multi_select/assets/style.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"js/jquery/multi_select/assets/prettify.css\" />
<link rel=\"stylesheet\" type=\"text/css\" href=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css\" />
<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js\"></script>
<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js\"></script>
<script type=\"text/javascript\" src=\"js/jquery/multi_select/src/jquery.multiselect.js\"></script>
<script type=\"text/javascript\" src=\"js/jquery/multi_select/assets/prettify.js\"></script>
<script type=\"text/javascript\"> 
$(function(){
 
	$(\"#example-list\").multiselect({
		selectedList: 4
	});
	
});
</script>

<p>
		<select id=\"example-list\" name=\"example-list\" multiple=\"multiple\" style=\"width:400px\">
		<option value=\"$id_perf\">$nombre_perfil</option>
		</select>
	</p>		
";

?>