<?php


$strXML2="";
    $query= "SELECT id_auto_admin
           FROM  auto_admin 
           WHERE tabla='$tabla'";
		 
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin) = mysql_fetch_row($result);
	
	
	    $query= "SELECT id_campo,campo
               FROM  auto_admin_campo
               WHERE id_auto_admin='$id_auto_admin' and id_tipo_campo =6"; //6 es tipo de campo combolist
			  
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_auto_admin_campo2,$campo) = mysql_fetch_row($result)){
		  
		 
			    $query= "SELECT id_auto_admin 
                       FROM  auto_admin_campo
                       WHERE campo='$campo' and pk=1";
                 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($id_auto_admin_tabla_campo) = mysql_fetch_row($result2);
				
		  		$campo_txt = ucwords(strtolower(campo_txt($id_auto_admin_tabla_campo)));
				$campo_txt = str_replace("_"," ",$campo_txt);
				
				
				if($id_campo_tabla!=""){
					if($id_auto_admin_campo2==$id_campo_tabla ){
						$titulo_graf= $campo_txt;
						$lista_campos_tabla .="<option value=\"$campo\" selected>$campo_txt</option>\n";
					}else{
						$lista_campos_tabla .="<option value=\"$campo\">$campo_txt</option>\n";
					}
				}else{
					if($campo==$campo_pk_def ){
						$titulo_graf= $campo_txt;
						$lista_campos_tabla .="<option value=\"$campo\" selected>$campo_txt</option>\n";
					}else{
						$lista_campos_tabla .="<option value=\"$campo\">$campo_txt</option>\n";
					}
				}
				
				
				
				
		  	  }
		  //=\"document.form1.id_campo_tabla.value;\" onClick
		  $combo_list ="<select name=\"id_campo_tabla\" id=\"id_campo_tabla\" onchange='javaScript:updateChart();'>
               			 $lista_campos_tabla
                	    </select>";
?>