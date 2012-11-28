<?php




$buscar_tabla = $_POST['buscar_tabla'];
if($buscar_tabla !=""){
$condicion = " and tabla like '%$buscar_tabla%'";
}

  $query= "SELECT id_auto_admin,tabla,accion, tabla_relacion,control_version 
           FROM  auto_admin
		   Where 1 $condicion
		   order by tabla";
		//echo "hola <br>";		   
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_auto_admin,$tabla,$accion_tbl,$tabla_relacion,$control_version) = mysql_fetch_row($result)){

      	$cont++;
      		
			
	 
		
		if(!cms_query("SELECT * FROM $tabla LIMIT 0,1")){
			$tabla_txt ="<font color=\"#FF0000\">$tabla *No existe*</font> ";
		}else{
			$tabla_txt = $tabla;
		}
		
		    $query= "SELECT  id_campo 
                   FROM  auto_admin_campo
                   WHERE id_auto_admin='$id_auto_admin' and pk=1";
				  // echo $query."<br>";
             $result_pk= cms_query($query)or die (error($query,mysql_error(),$php));
             if(!list($id_cam) = mysql_fetch_row($result_pk)){
        			$aviso_pk ="<img src=\"images/atencion_pequenia.gif\" alt=\"Esta tabla no tiene identificado su campo PK\" border=\"0\">";
        		 }else{
				 $aviso_pk="";
				 }
		
			 $query= "SELECT  id_campo 
                   FROM  auto_admin_campo
                   WHERE id_auto_admin='$id_auto_admin' and txt=1";
             $result_txt= cms_query($query)or die (error($query,mysql_error(),$php));
             if(!list($id_cam) = mysql_fetch_row($result_txt)){
        			$aviso_txt ="<img src=\"images/atencion_pequenia.gif\" alt=\"Esta tabla no tiene identificado su campo TXT\" border=\"0\">";
        		 }else{
				 $aviso_txt="";
				 }
				 
				 if($control_version==0 ){
	       			
	   				 $link_activo ="<div id=\"v_$id_auto_admin\"  >
							<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=19&id_auto_admin=$id_auto_admin&axj=1','v_$id_auto_admin');\" src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"\">
					  </div>";
	    
	 				 }elseif($control_version==1){
	  	
	  					 $link_activo ="<div id=\"v_$id_auto_admin\"  >
	   					<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=19&id_auto_admin=$id_auto_admin&axj=1','v_$id_auto_admin');\" src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"\">
						</div>";
						
	
	 				 }  
		
					$lista_tabla .="<tr>
									<td align=\"center\" class=\"textos\">$cont</td>
                                    <td align=\"left\" class=\"textos\" title=\"\">&nbsp;&nbsp;$tabla_txt $aviso_pk $aviso_txt</td>                                   			                      
									<!-- <td align=\"left\" class=\"textos\">&nbsp;&nbsp;$tabla_relacion</td> -->
                                    <td align=\"center\" class=\"textos\">
										<a href=\"index.php?accion=$accion&act=7&tbl=$tabla&t=e&axj=1\" target=\"_blank\" title=\"Exportar Estructura de Tabla $tabla\">
										E</a>
									</td> 		
									<td align=\"center\" class=\"textos\">
									   <a href=\"index.php?accion=$accion&act=7&tbl=$tabla&t=d&axj=1\" target=\"_blank\"  title=\"Exportar Datos de Tabla $tabla a txt\">
									   D</a>
									</td> 
									<td align=\"center\" class=\"textos\">
									   <a href=\"index.php?accion=$accion&act=7&tbl=$tabla&t=c&axj=1\" target=\"_blank\"  title=\"Exportar Configuraci&oacute;n de Tabla $tabla a txt\">
									   C</a>
									</td>
									<td align=\"center\" class=\"textos\">
									   $link_activo
									</td> 
									<td align=\"center\" class=\"textos\">
                                       <a class=\"btn btn-small btn-warning\" href=\"index.php?accion=$accion&tbl=$tabla&act=4&id_auto_admin=$id_auto_admin\">
											<i class=\"icon-ok icon-white\"></i>
									   </a>
									</td>
                                    <td align=\"center\" class=\"textos\">
									   <a class=\"btn btn-small\" href=\"index.php?accion=$accion&act=6&tbl=$tabla&edit=ok\">
											<i class=\"icon-edit\"></i>
									   </a>
									</td>
									<td align=\"center\" class=\"textos\">
										<a class=\"btn btn-small \" href=\"javascript:confirmar('Est&aacute; seguro de eliminar $tabla','index.php?accion=$accion&act=2&tbl=$tabla&del=ok')\">
											<i class=\"icon-remove\"></i>
										</a>
									</td>
                                
								</tr>";
						   
		 }
		 
		
			
			
			
             $js .= "<script language=\"JavaScript\">
            	 	 	

            function confirmar( mensaje, destino){  
       if (confirm(mensaje)) {     
          document.location = destino ;  
     	   }
     } 			
            		  </script>";
		
		
//onkeyup=\"\" 

$js .= "<link href=\"admin/admin_auto/adminia.css\" rel=\"stylesheet\" type=\"text/css\" />";

		 	$lista_tabla =" 
     
<!--     
    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		
      <tr>
        <td align=\"center\" class=\"textos\">Buscar tabla 
		<input type=\"text\" name=\"buscar_tabla\" id=\"buscar_tabla\" value=\"$buscar_tabla\" >
		<input type=\"submit\" name=\"Submit\" value=\"Buscar\">
		
			</td>
        </tr>
  	</table>
<br><br>


<table  width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\" >
    <tr >
      <td align=\"center\" class=\"cabeza_rojo\">&nbsp;<h2>Lista de tablas creadas</h2></td>
      </tr>
	</table>
	-->
	
		<div class=\"widget widget-table\">
		
			<div class=\"widget-header\">
				<i class=\"icon-th-list\"></i>
				<h3>Lista de tablas administradas</h3>
				
				<div class=\"derecha\">
					Buscar tabla 
					<input type=\"text\" name=\"buscar_tabla\" id=\"buscar_tabla\" value=\"$buscar_tabla\" >
					<input class=\"btn btn-small\" type=\"submit\" name=\"Submit\" value=\"Buscar\">
				</div>
			</div>
			<div class=\"widget-content\">
			
				<table class=\"table table-striped table-bordered\" >
			
						<thead>
								<tr>
								  <th align=\"center\" class=\"cabeza_rojo\" >N&deg;</th>
								  <th align=\"center\" class=\"cabeza_rojo\" >Tabla</th>
								  <!--<th align=\"center\" class=\"cabeza_rojo\">Relaci&oacute;n</th>-->
								  <th align=\"center\" class=\"cabeza_rojo\">&nbsp</th> 
								  <th align=\"center\" class=\"cabeza_rojo\">&nbsp</th> 
								  <th align=\"center\" class=\"cabeza_rojo\">&nbsp</th> 
								  <th align=\"center\" class=\"cabeza_rojo\">Ctrl Vs</th> 
								  <th align=\"center\" class=\"cabeza_rojo\" width=\"7%\">Form</th>                                                                    <th align=\"center\" class=\"cabeza_rojo\" width=\"7%\">Edit</th>
								  <th align=\"center\" class=\"cabeza_rojo\" width=\"7%\">Del</th>
						
							 </tr>
						</thead>
						
								  $lista_tabla 
				</table>
			   
			 </div>
	
		</div>		   
				   ";
			
		 

						
					
		  $query= "SELECT id_campo,id_auto_admin     
                   FROM  auto_admin_campo";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_campow,$id_auto_adminw) = mysql_fetch_row($result)){
        			
					  $query= "SELECT  tabla  
                               FROM  auto_admin
                               WHERE id_auto_admin ='$id_auto_adminw'";
                         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                          if (!list($tbla) = mysql_fetch_row($result2)){
                    				
									 $Sql ="DELETE FROM auto_admin_campo where id_auto_admin=$id_auto_adminw";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
										   
                    		 
							 
							 }
					
							   
        		 }
				 
				$query= "SELECT id_auto_admin     
                   FROM  auto_admin_permisos";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_auto_adminw) = mysql_fetch_row($result)){
        			
					  $query= "SELECT  tabla  
                               FROM  auto_admin
                               WHERE id_auto_admin ='$id_auto_adminw'";
                         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                          if (!list($tbla) = mysql_fetch_row($result2)){
                    				
				$Sql ="DELETE FROM  auto_admin_permisos where id_auto_admin=$id_auto_adminw";

				cms_query($Sql)or die (error($Sql,mysql_error(),$php));
										   
                    		 
							 
							 }
					
							   
        		 }
				 
				$query= "SELECT id_auto_admin     
                   FROM  auto_admin_apps";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_auto_adminw) = mysql_fetch_row($result)){
        			
					  $query= "SELECT  tabla  
                               FROM  auto_admin
                               WHERE id_auto_admin ='$id_auto_adminw'";
                         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                          if (!list($tbla) = mysql_fetch_row($result2)){
                    				
									 $Sql ="DELETE FROM  auto_admin_apps where id_auto_admin=$id_auto_adminw";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
										   
                    		 
							 
							 }
					
							   
        		 }
				 
				

?>