<?php


   $id_estado_inicio = $_POST['id_estado_inicio'];
		 $id_estado_fin_si = $_POST['id_estado_fin_si'];
		 $id_estado_fin_no = $_POST['id_estado_fin_no'];
		 

switch ($act) {
     case 1:
      
         $qry_insert="INSERT INTO sgs_enrutamiento_estados(id_enrutamiento,id_estado_inicio,id_estado_fin_si,id_estado_fin_no)  
		              values (null,'$id_estado_inicio','$id_estado_fin_si','$id_estado_fin_no')";
                       
         $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");
		 $id= mysql_insert_id();
		 header("Location:index.php?accion=$accion&id=$id");
		 
         break;
	  case 2:
	  
	   $id = $_GET['id'];
	  		 $Sql ="DELETE FROM sgs_enrutamiento_estados where id_enrutamiento=$id ";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
			  
			  header("Location:index.php?accion=$accion");
	   break;
   	default:
	



  $query= "SELECT  id_estado_solicitud,estado_solicitud  
           FROM  sgs_estado_solicitudes
		   ORDER BY orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result)){
	  		if($id_estado_solicitud==$id_estado_fin_si){
			$lista_ini .="<option value=\"$id_estado_solicitud\" selected>$estado_solicitud</option>";
			}else{
			$lista_ini .="<option value=\"$id_estado_solicitud\">$estado_solicitud</option>";
			}
	  
			 			   
		 }
		 
		$select_estado_ini = " <select name=\"id_estado_inicio\">
         <option value=\"#\">Selecciones estado</option>
         $lista_ini 
         </select>";


$query= "SELECT  id_estado_solicitud,estado_solicitud  
           FROM  sgs_estado_solicitudes
		   ORDER BY orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result)){
			if($id_estado_solicitud==$id_estado_fin_si){
			$lista_fin_si .="<option value=\"$id_estado_solicitud\">$estado_solicitud *</option>"; 	
			}else{
			$lista_fin_si .="<option value=\"$id_estado_solicitud\">$estado_solicitud</option>"; 	
			}
				   
		 }
		 
		$select_estado_fin_si = " <select name=\"id_estado_fin_si\">
         <option value=\"#\">Selecciones estado positivo</option>
         $lista_fin_si 
         </select>";
	
	
	
$query= "SELECT  id_estado_solicitud,estado_solicitud  
           FROM  sgs_estado_solicitudes
		   ORDER BY orden";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_estado_solicitud,$estado_solicitud) = mysql_fetch_row($result)){
			$lista_fin_no .="<option value=\"$id_estado_solicitud\">$estado_solicitud</option>"; 			   
		 }
		 
		$select_estado_fin_no = " <select name=\"id_estado_fin_no\">
         <option value=\"#\">Selecciones estado negativo</option>
         $lista_fin_no 
         </select>";
	
	
	
	
	
	$accion_form = "index.php?accion=$accion&act=1";
	
	
	$contenido = "<table width=\"98%\" border=\"0\" align=\"left\" cellpadding=\"3\" cellspacing=\"3\">
                    <tr>
                      <td align=\"left\" colspan=\"2\" >Asignaci&oacute;n de Rutas</td>
                    </tr>
					<tr>
					<td align=\"left\" class=\"textos\" >Estado Origen </td>
					<td align=\"center\" class=\"textos\">$select_estado_ini</td>
					 </tr> 
                 <tr>
				 <td align=\"left\" class=\"textos\">Estado Destino Positivo (SI) </td>
				 <td align=\"center\" class=\"textos\">$select_estado_fin_si</td> 
				 </tr>
				 <tr><td align=\"left\" class=\"textos\">Estado Destino Negativo (NO)  </td>
				 <td align=\"center\" class=\"textos\">$select_estado_fin_no</td> </tr> 
				 <tr><td align=\"center\" class=\"textos\" colspan=\"2\">
				 	<input type=\"submit\" name=\"Submit\" value=\"Asignar Ruta\"> 
				 </td></tr> 
				 <tr><td align=\"center\" class=\"textos\" colspan=\"2\">$lista_mapa </td></tr>  
                  </table>";	 
				  
				  
				  
 }
 
 
 
 
 $id = $_GET['id'];
	  $query= "SELECT id_enrutamiento ,id_estado_inicio, id_estado_fin_si,id_estado_fin_no 
               FROM  sgs_enrutamiento_estados";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_enrutamiento ,$id_estado_inicio, $id_estado_fin_si,$id_estado_fin_no) = mysql_fetch_row($result)){
    			
				$estado_ini = rescata_valor('sgs_estado_solicitudes',$id_estado_inicio,'estado_solicitud') ;
				$estado_fin_si = rescata_valor('sgs_estado_solicitudes',$id_estado_fin_si,'estado_solicitud') ;
				$estado_fin_no = rescata_valor('sgs_estado_solicitudes',$id_estado_fin_no,'estado_solicitud') ;
				
				if($id_enrutamiento==$id){
				
				$lista_enrutamiento .="<tr style=\"background-color: #E1F3FF;\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#E1F3FF'\">
										<td align=\"left\" >* $estado_ini </td>
										<td align=\"center\" >-></td> 
										<td align=\"left\" >$estado_fin_si </td>
										<td align=\"left\" >$estado_fin_no</td>
										<td align=\"left\" >
										<a href=\"index.php?accion=$accion&act=2&id=$id_enrutamiento\">
										<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
										</td> 
									   </tr> ";	
									   
				}else{
				$lista_enrutamiento .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
										<td align=\"left\" >$estado_ini</td>
										<td align=\"center\" >-></td> 
										<td align=\"left\" >$estado_fin_si </td>
										<td align=\"left\" >$estado_fin_no</td>
										<td align=\"left\" >
										<a href=\"index.php?accion=$accion&act=2&id=$id_enrutamiento\">
										<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
										</td> 
									   </tr> ";	
				}
				
						   
    		 }
	
					
			$lista_enru = "  <table width=\"98%\"  border=\"0\" align=\"left\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\">
                               <tr class=\"cabeza\">
                                 <td align=\"left\" >Estado Origen</td>
								 <td align=\"center\" ></td> 
                                 <td align=\"left\" >Destino SI</td>
                                 <td align=\"left\">Destino NO</td>
								 <td align=\"left\" >Borrar</td> 
                                 </tr>
								 $lista_enrutamiento
                           	</table>";			
	
 $contenido =  "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                    <tr >
                      <td align=\"center\" class=\"textos\">$contenido</td>
                      </tr>
					  <tr><td align=\"center\" class=\"textos\"> $lista_enru</td></tr> 
                	</table>" ;
 /**/
?>