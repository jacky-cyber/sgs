<?php
$tabla = $_GET['tabla'];
$campo = $_GET['campo'];

if($tabla!="" and $campo!=""){

  $query= "SELECT tabla  
           FROM  tab_camp
           WHERE tabla='$tabla' and campo='$campo'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if (!list($id_usuario,$nombre) = mysql_fetch_row($result)){
			$qry_insert="INSERT INTO tab_camp (tabla,campo) values ('$tabla','$campo')";
              
                $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
			   
		 }

}


$add_tabla = $_POST['add_tabla'];
$accion_tabla = $_POST['accion_tabla'];

if($add_tabla!="" and $accion_tabla!=""){

  $query= "SELECT tabla    
           FROM  tab_busqueda 
           WHERE tabla ='$add_tabla' and accion='$accion_tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if (!list($tbla) = mysql_fetch_row($result)){
			
			$qry_insert="INSERT INTO tab_busqueda(tabla,accion) values ('$add_tabla','$accion_tabla')";
                          
             $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
						   
		 }

}


$tabla_del = $_GET['tabla_del'];

if($tabla_del!=""){

 $Sql ="DELETE FROM tab_camp where tabla='$tabla_del'";

 cms_query($Sql);
  
$Sql ="DELETE FROM tab_busqueda where tabla='$tabla_del'";

 cms_query($Sql);
  
}


$campo_del = $_GET['campo_del'];
$tbla= $_GET['tbla'];
if($campo_del!=""){
 $Sql ="DELETE FROM tab_camp where campo='$campo_del' and tabla ='$tbla'";

 cms_query($Sql);
}


$accion_form ="index.php?accion=$accion&act=$act";


  $query= "SELECT tabla,accion    
           FROM  tab_busqueda";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($tabla,$tabla_accion) = mysql_fetch_row($result)){
			
			$list_campos_tabla="";
			 $fields = mysql_list_fields($DATABASE, $tabla);
	 		 $columns = mysql_num_fields( $fields );
				 for ($i = 0; $i < $columns; $i++) 
	 				{
						$nomField = mysql_field_name( $fields, $i );
						if (substr($nomField,0,2) != "id")
							{
								$tc = $tabla.'-'.$nomField;
								$list_campos_tabla .= "<option value=\"index.php?accion=$accion&act=$act&tabla=$tabla&campo=$nomField&$tc\">$nomField</option>";
								
								
							}
	 				}	   
			
			$cont_campos=0;
			$lista_tabla_campos="";
			 $query= "SELECT campo   
                       FROM  tab_camp 
                       WHERE tabla='$tabla'";
                 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                  while (list($campo) = mysql_fetch_row($result2)){
            			$cont_campos++;
						
						$lista_tabla_campos .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
						<td align=\"left\" class=\"textos\">$cont_campos&nbsp;&nbsp;<strong>$campo</strong></td>
						<td align=\"center\" class=\"textos\" width=\"24\">
                              <a href=\"index.php?accion=$accion&act=$act&campo_del=$campo&tbla=$tabla\">
                               <img src=\"images/del.gif\" alt=\"\" border=\"0\"></a>
                          </td></tr> ";
            		 }
					 
					 
			
			
			$lista_tablas .="<tr><td align=\"center\" class=\"cabeza_rojo\">
						  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"left\" width=\"140\" class=\"cabeza_rojo\">&nbsp;Tabla <strong>$tabla</strong></td>
							  <td align=\"left\" >
							    
							  </td> 
                             <td align=\"right\" >
							 <a href=\"index.php?accion=$accion&act=$act&tabla_del=$tabla\">
                               <img src=\"images/del.gif\" alt=\"\" border=\"0\"></a>
							 </td>
                              </tr>
                        	</table>
						</td></tr>
							<tr><td align=\"center\" class=\"textos\">
							  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                               <tr>
							   <td align=\"left\" class=\"textos\" >
							    &nbsp;Agregar Campo
							   <select name=\"select\" class=\"textos\" onChange=\"MM_jumpMenu('parent',this,0)\">
							   <option value=\"#\">---------></option>
                                  $list_campos_tabla
                                </select>
							    </td>
								<td align=\"center\" class=\"textos\">&nbsp</td> 
								</tr>$lista_tabla_campos
								</table>
							 </td></tr>";	
			
			
				   
		 }


		 $tables = mysql_list_tables( $DATABASE );
		 
		while( $line = mysql_fetch_row( $tables ) )
{
	$lista_tablas_bd .= "<option value=\"".$line[0]."\">".$line[0]."</option>";
			
		
}



$sql_accion = "select accion, descrip_php_esp from acciones";
$result_accion = cms_query($sql_accion) or die("$MSG_DIE - No Resulto $sql_accion");
		
while (list($accion_descrip, $descrip_php_esp) = mysql_fetch_row($result_accion))
{
	$lista_acciones .= "<option value=\"$accion_descrip\">$descrip_php_esp</option>";
}


	$contenido = "  <table  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                      <tr>
                        <td align=\"center\" class=\"textos\">Seleccione Tabla						
							   <select name=\"add_tabla\" class=\"textos\">
							   <option value=\"#\">---------></option>
                                  $lista_tablas_bd
                                </select> 
						</td>
						
						<tr>
		<td  align=\"center\" class=\"textos\">Seleccione Acción
			<select name=\"accion_tabla\" class=\"textos\">
				<option value=\"#\">---------></option>
				$lista_acciones
			</select>
		</td>
	</tr>
				<tr><td align=\"center\" class=\"textos\">
				<input type=\"submit\" name=\"Submit\" value=\"Agregar\" class=\"boton\"></td></tr> 		
                       
                  	</table>
					<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                              
								$lista_tablas
                              </table>";



$sql_accion = "select accion, descrip_php_esp from acciones";
$result_accion = cms_query($sql_accion) or die("$MSG_DIE - No Resulto $sql_accion");
		
while (list($accion, $descrip_php_esp) = mysql_fetch_row($result_accion))
{
	$lista_acciones .= '<option>'.$descrip_php_esp.'</option><br />';
}


?>