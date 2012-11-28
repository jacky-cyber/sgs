  <?php

$def = $_GET['def'];

$id_grupo = $_GET['id_grupo'];

$id_perfil_usuario = perfil($id_sesion);
$id_p = $_GET['id_p'];
//echo $id_perfil_usuario."sdfsfsdf";
/*
if($id_perfil_usuario!=$perfil_wm ){
	//$desactiva = "disabled";
	$condicion = " WHERE id_perfil<> $id_perfil_admin";
	
}*/

$cascada = $_POST['cascada'];

 if($id_grupo!="" and $id_grupo!="all"){
 $condicion_grupo = " and acciones.id_grupo='$id_grupo' ";
 
 $url_grupo ="&id_grupo='$id_grupo'";
 }
 
 

 if($def!=""){
 	$Sql ="UPDATE acciones 
 		   SET defecto='0'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
 	
	$Sql ="UPDATE acciones 
 		   SET defecto='1'
 		   WHERE accion='$def'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
 		  
 		   header("Location:$PHP_SELF?accion=$accion"); 
 }
 
    if($id_p!=""){
		 $tablas_cond =", usuario_perfil_relacion";
		 $condicion_relacion ="WHERE id_perfil_padre=$id_p AND id_perfil= id_perfil_hijo";
		 $nivel_perfil_p= nivel_perfil($id_p);
		 $nivel_perfil_p++;
		 $url_id_p="&id_p=$id_p";
		 $nivel=nivel_perfil($id_p);
	     $nivel++;
		 
	}else{
		 
		 $nivel_perfil_p=0;
		 $nivel=0;
	}
		 
		
if($id_p!=""){
$accion_form_url ="&id_p=$id_p";


$id_perf_padre = perfil_padre($id_p);
	
$nivel_perfil=0;
	    $perfil = perfil_padre($id_p);
		//echo $perfil;
		$perfil_nombre = nombre_perfil($id_p);
		$camino_perfil = "<a href=\"index.php?accion=$accion&id_p=$id_p".$url_grupo."\">$perfil_nombre</a> / ".$camino_perfil;
		
	    while($perfil!=0){
		    
			$perfil_nombre = nombre_perfil($perfil);
			$camino_perfil = "<a href=\"index.php?accion=$accion&id_p=$perfil".$url_grupo."\">$perfil_nombre</a> / ".$camino_perfil;
			$perfil = perfil_padre($perfil);
		}
$camino_perfil = "<a href=\"index.php?accion=$accion".$url_grupo."\">Raiz</a> / ".$camino_perfil;
			
}
 
		 
 
 

 
 
 
 $tabla_perfiles .="<tr>";
 
 
 
$query = "SELECT accion,descrip_php_$idm    
          FROM acciones
		  Where 1 $condicion_grupo";		  
	  
$result_vistas = cms_query($query) or die ("problemas en la consulta 2.<br>$query");

if(isset($_POST['boton'])){

		
	
	/**/
while(list($acc,$descrip_php) = mysql_fetch_row($result_vistas)){
		$query = "SELECT id_perfil,perfil  
          			FROM usuario_perfil $tablas_cond
		  			$condicion_relacion";			  
	
		$result_user = cms_query($query) or die ("problemas en la consulta 1.<br>$query");
 		while(list($id_per,$perf) = mysql_fetch_row($result_user)){
 			$var = "check_$id_per"."_$acc";
 			$nivel_perf= nivel_perfil($id_per);
			if($nivel_perf==$nivel){
				if(isset($_POST[$var]))	{
 				$query= "SELECT  id_perfil
	            		 FROM  accion_perfil  
	            		 WHERE id_perfil =$id_per
						 AND accion = $acc";
				
	     		$result= cms_query($query)or die (error($Sql,mysql_error(),$php));
	    
	          if(!list($perfil) = mysql_fetch_row($result)){
 			 	$qry_insert="INSERT INTO accion_perfil (id_perfil,accion)
 			 				 values ('$id_per','$acc')";
 			   
			
			    $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
 			 	$check = "checked";
 			 	  if($cascada!=""){
					marca_arbol($id_per,$acc);
				  }
 			   }
			
			
			 }else{
			 
			 	$var2 = "temp_".$var;
			 	if(!isset($_POST[$var2])){
				$Sql ="DELETE FROM accion_perfil 
					       WHERE 1
					       AND id_perfil=$id_per AND accion=$acc";
					//echo $Sql."<br>";

 cms_query($Sql) or die ("problemasal borrar as <br>$Sql");	
				  
				  	 if($cascada!=""){
					    des_marca_arbol($id_per,$acc);
				      }
 			 	     $check = ""; 
				}
 			    	
 			 }
			}
 			
 			/**/    	
 			    	
 		}
	
   }
 
}
 


$query = "SELECT id_perfil,perfil  
          FROM usuario_perfil $tablas_cond
		  $condicion_relacion
		  ORDER BY id_perfil";		  
	
	
$result_user = cms_query($query) or die ("problemas en la consulta 1.<br>$query");


 while(list($id_perf,$perfil) = mysql_fetch_row($result_user)){
	
	        $nivel2= nivel_perfil($id_perf);
			if($nivel==$nivel2 and hijos_perfil($id_perf)==true){
				
				$perfil_titulo .= "<td align=\"center\" class=\"cabeza_rojo\">
			 	<a href=\"index.php?accion=$accion&id_p=$id_perf".$url_grupo."\">
				<font color=\"#ffffff\"> $perfil</font></a></td> ";
		    }elseif($nivel==$nivel2){
				$perfil_titulo .= "<td class=\"cabeza_rojo\" align=\"center\" width=\"15%\" >$perfil</td> ";
			}
	
 }
 
 
 
 
 
$query = "SELECT accion,descrip_php_$idm ,grupo ,defecto
          FROM acciones,accion_grupo
          WHERE acciones.id_grupo=accion_grupo.id_grupo
		  $condicion_grupo
          ORDER BY acciones.id_grupo";		  
	  
$result_vistas = cms_query($query) or die ("problemas en la consulta 2.<br>$query");


while(list($acc,$descrip_php,$grupo,$defecto) = mysql_fetch_row($result_vistas)){
	
		 if($defecto==1){
 		      	$default ="(*)";
 		      }else{
 		      	$default ="";
 		      }
 		//<td align=\"left\" class=\"textos\">$grupo</td>   
		
	
	$tabla_perfiles = "<td align=\"left\" class=\"textos\">
	<a href=\"?accion=$accion&def=$acc\">
	 $descrip_php $default </a></td>
	";	
	
	$query = "SELECT id_perfil  
       		  FROM usuario_perfil  
			  $tablas_cond
		      $condicion_relacion
			  ORDER BY id_perfil";		  
	
		$result_user = cms_query($query) or die ("problemas en la consulta 1.<br>$query");
 		while(list($id_per) = mysql_fetch_row($result_user)){

 				
 			 $var = "check_$id_per"."_$acc";
 			  $query2= "SELECT accion   
 			    	    FROM  accion_perfil
 			    	    WHERE id_perfil=$id_per and accion=$acc";
 			    	     $result2= cms_query($query2)or die (error($query2,mysql_error(),$php));
 			    	         if (list($a) = mysql_fetch_row($result2)){
							 
							 	$busca = busca_sin_marca_arbol($id_per,$acc);
								
							 	if($busca==true){
								
								 $desactiva = "disabled";
								 $hidden = "<input type=\"hidden\" name=\"temp_".$var."\" value=\"1\">"; 
								}else{
								 $desactiva="";
								 $hidden ="";	
								}
 			    				$check = "checked";	
										   
 			    			 }else{
							 	$desactiva="";
							 								
 			    			 	$check = ""; 
 			    			 }
 			
			     
			
			 
			 if($id_p==""){
				$nivel= nivel_perfil($id_per);
					if($nivel==0){
						$tabla_perfiles .= "<td align=\"center\"  >
 			  			 <input type=\"checkbox\" name=\"$var\" $check $desactiva >$hidden</td>";	
 
					}
	 
			 }else{
				$tabla_perfiles .= "<td align=\"center\">
 			   <input type=\"checkbox\" name=\"$var\" $check $desactiva >$hidden</td>";	
			 }
	
			 
			   
 			}
 	
    
   $perfil_t .= "<tr align=\"center\" style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
                  $tabla_perfiles 
               </tr>\n";

     }
     
     
     

	if($datos=="ok"){

	 $titulo ="<div align=\"center\" class=\"textos\"><font color=\"#FF0000\">Datos Cambiados.</font></div>";

	}

	
	
	
	  $query= "SELECT id_grupo,grupo     
               FROM  accion_grupo";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_grupo_sql,$grupo) = mysql_fetch_row($result)){
		  		if($id_grupo==$id_grupo_sql){
					$selected = "selected";
				}else{
					$selected = "";
				}
    			$lista_mmnu .="<option value=\"?accion=$accion&id_grupo=$id_grupo_sql".$url_id_p."\" $selected>$grupo</option>";			   
    		 }
			 
$lista_grupos_menu ="Filtrar por: <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
        <option value=\"#\">---></option>
		 <option value=\"?accion=$accion&id_grupo=all".$url_id_p."\">Todos</option>
		$lista_mmnu
      </select>";

$accion_form = $PHP_SELF."?accion=$accion&act=$act".$url_grupo."$url_id_p";

$js.="
<script>
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == \"checkbox\") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == \"checkbox\") 
         document.form1.elements[i].checked=0 
} 
	
 </script>
 
 
";
  
 


//<td align=\"center\" class=\"textos\">Grupo</td>
$contenido = "

<div align=\"center\" class=\"textos\"><b>Tabla Navegaci&oacute;n</b></div><br>
     <div align=\"center\" class=\"textos\">$lista_grupos_menu</div><br>    
     
     <div align=\"center\" class=\"textos\">Marcar en Cascada 
	 <input type=\"checkbox\" name=\"cascada\" value=\"1\" checked></div><br>
	 
    <table width=\"190\" border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">
          <tr>	      
	      <td align=\"center\" class=\"textos\">
	      <a href=\"?accion=$accion&act_perfiles=1\"><img src=\"images/new.gif\" alt=\"\" border=\"0\"></a></td>	         
	     </tr>
	     <tr>	      
	      <td align=\"center\" class=\"textos\">
	      <a href=\"?accion=$accion&act_perfiles=1\">Agregar Perfil</a></td>
	    </tr>
	 </table><br><br>
	 
	  <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">  
	    <tr>
            <td align=\"center\" class=\"textos\">&nbsp;</td>
      </tr>
    
    <tr>
    <td align=\"right\" class=\"textos\"><a href=\"javascript:seleccionar_todo()\">Marcar todos</a> | 
     <a href=\"javascript:deseleccionar_todo()\">Marcar ninguno</a></td></tr>
	<tr>
      <td align=\"left\" class=\"textos\"><b>$camino_perfil</b></td>
      </tr>
	</table>
	
	
	 <table width=\"90%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" class=\"cuadro\">\n
          <tr><td align=\"center\"  class=\"cabeza_rojo\">Menu</td>
          
          $perfil_titulo</tr>
          $perfil_t

          
		  </table>
		  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
     <tr>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      </tr>
	 <tr>
      <td align=\"center\" class=\"textos\">
      <input class=\"boton\" type=\"submit\" name=\"boton\" value=\"Modificar\" ></td>
      </tr>
	 <tr>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      </tr>
     
	</table>"

?>