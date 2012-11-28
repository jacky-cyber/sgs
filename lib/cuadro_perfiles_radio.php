<?php

$js .="<SCRIPT LANGUAGE=\"JAVASCRIPT\">
		
   function pasa_id_p(id_p){
		document.form1.id_p.value= id_p;
		document.form1.method = \"POST\";
		document.form1.submit();
		}
		
		</SCRIPT>";

  if($id_p!="" ){
		 $tablas_cond =", usuario_perfil_relacion";
		 $condicion_relacion ="WHERE id_perfil_padre=$id_p AND id_perfil= id_perfil_hijo";
		 $nivel_perfil_p= nivel_perfil($id_p);
		 $nivel_perfil_p++;
		 $url_id_p="&id_p=$id_p";
		 $nivel=nivel_perfil($id_p);
	     $nivel++;
		
		
		
	$accion_form_url ="&id_pe=$id_pe";


$id_perf_padre = perfil_padre($id_p);
	
$nivel_perfil=0;
	    $perfil = perfil_padre($id_p);
		//echo $perfil;
		$perfil_nombre = nombre_perfil($id_p);
		$camino_perfil = "<a href=\"JavaScript:pasa_id_p('$perfil')\">$perfil_nombre</a> / ".$camino_perfil;
		
	    while($perfil!=0){
		    
			$perfil_nombre = nombre_perfil($perfil);
			$camino_perfil = "<a href=\"JavaScript:pasa_id_p('$perfil')\">$perfil_nombre</a> / ".$camino_perfil;
			$perfil = perfil_padre($perfil);
		}
$camino_perfil = "<a href=\"JavaScript:pasa_id_p('0')\">Raiz</a> / ".$camino_perfil;
	
	
		
		
		 
	}else{
		 
		 $nivel_perfil_p=0;
		 $nivel=0;
	}
 

 
$query = "SELECT id_perfil,perfil  
          FROM usuario_perfil $tablas_cond
		  $condicion_relacion
		  ORDER BY id_perfil";		  
	//echo $query;  
	
$result_user = cms_query($query) or die ("problemas en la consulta 1.<br>$query");


 while(list($id_perfil,$perfil) = mysql_fetch_row($result_user)){
	           
			  
				/* if($id_perfil==$id_perfil_u){
				 $$check="checked";
				 }else{
				 $$check="";
				 }*/
			 
	        $nivel2= nivel_perfil($id_perfil);
			if($nivel==$nivel2 and hijos_perfil($id_perfil)==true){
				
				
				//href="JavaScript:pasa_par('$id_perfil')"
				$radio_perfiles .= "<td align=\"center\" class=\"textos\">
				<a href=\"JavaScript:pasa_id_p('$id_perfil')\">
				<font color=\"#FF0000\">$perfil</font></a>
       	        <input type=\"radio\" name=\"id_perfil_u\" value=\"$id_perfil\" ></td>";
       
		    }elseif($nivel==$nivel2){
				
				$radio_perfiles .= "<td align=\"center\" class=\"textos\">$perfil
       	<input type=\"radio\" name=\"id_perfil_u\" value=\"$id_perfil\" ></td>";
       
				
			}
	
	
 }
 $radio_perfiles=" <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		<tr>
		$radio_perfiles
		</tr>
		</table>";

?>