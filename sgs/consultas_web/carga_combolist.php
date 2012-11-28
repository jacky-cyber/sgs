<?php
	
	if($_POST["idRegion"]){
	
		/*
		$idRegion=$_POST["idRegion"];
		$condicion="AND id_region =$idRegion";
		$select_comunas = select_tabla('comunas',$idRegion ,'id_comuna','comuna','','required',$condicion);
		$select_comunas = str_replace("id_comuna",'id_comuna',$select_comunas);
		exit ($select_comunas);
		*/
		
		$idRegion=$_POST["idRegion"];
		$query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region='$idRegion'
			   order by 1";
        $result= cms_query($query)or die (error($query,mysql_error(),$php));
		$comunas_lista .="<option value=\"\">-seleccione-</option>";
		while(list($id_comuna2,$comuna) = mysql_fetch_row($result)){
			$comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";  
		}
		$comuna = "<select name=\"id_comuna\" id=\"id_comuna\">
						$comunas_lista
					</select>";
		
		exit ($comuna);
	}
?>