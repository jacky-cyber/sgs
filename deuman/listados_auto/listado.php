<?php

/*
<style type=\"text/css\" title=\"currentStyle\">
			@import \"deuman/listados_auto/css/demo_table_juiX.css\";
			@import \"deuman/listados_auto/css/demo_pageX.css\";
			
		</style>

*/
if($id_auto_admin==""){
			

   		$query= "SELECT id_auto_admin   
           FROM  acciones
           WHERE accion='$accion'";

   		$result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin) = mysql_fetch_row($result);
   		
   	}
	$id_auto_admin = 156;

switch ($act) {
     case 1:
         include("deuman/listados_auto/listados_auto.php");
		 
		 
         break;

   	default:
	  
	
	
	
	
	   						$query= "SELECT campo,pk,txt,existe_listado,txt_xml
   		      	          				 FROM auto_admin_campo 
   		      	          				 WHERE id_auto_admin='$id_auto_admin' and  campo<>'orden'";

   		      					 $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
   		      	     			 while(list($campo_txt_tbl,$pk_campo,$txt_campo,$existe_listado,$txt_xml) = mysql_fetch_row($resultq)){
								// echo "$campo_txt_tbl,$pk_campo,$txt_campo,$existe_listado,$txt_xml<br>" ;
								
								 if($existe_listado==1){ 
								 	$cont_col++;
									
									if($txt_xml!=""){
									$txt_xml= ucwords(strtolower($txt_xml));
								
								        $lista_head .="<th >$txt_xml</th>";
									}else{
										$campo_txt_tbl = str_replace("id_","",$campo_txt_tbl);	//reemplaza "_" por blanco en $campos 
										$campo_txt_tbl = str_replace("_"," ",$campo_txt_tbl);	//reemplaza "_" por blanco en $campos 
										$campo_txt_tbl= ucwords(strtolower($campo_txt_tbl));
										$lista_head .="<th >$campo_txt_tbl</th>";
									}
									
								 }
								 
								 
								// echo $campo_txt_tbl_pk;
								 
								 }
	
	$col_ver=$cont_col;
	$col_edit=$cont_col+1;
	$col_del=$cont_col+2;
	


	
if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$titulo_ver= "<th >Ver</th>>";
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$titulo_editar = "<th >Editar</th>";
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$titulo_borrar = "<th >Borrar</th>";
}



$contenido = "

		
		
		<script type=\"text/javascript\" language=\"javascript\" src=\"js/jquery/listado_auto/jquery.dataTables.min2.js\"></script>
		<script type=\"text/javascript\" charset=\"utf-8\">
			$(document).ready(function() {
				$('#listado').dataTable( {
					\"bServerSide\": true,
					\"bProcessing\": true,
					\"sAjaxSource\": \"?accion=$accion&act=1&axj=1\",
					\"sPaginationType\": \"full_numbers\",
					\"aoColumnDefs\": [{ \"bSortable\": false, \"aTargets\": [ $col_ver ,$col_edit,$col_del ] }]
				} );
			

			} );
			
			


		</script>
			
			<div id=\"container\">
			<div id=\"dynamic\">
<table width=\"100%\" class=\"textos\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
	<thead>
		<tr>
			$lista_head
			$titulo_ver
			$titulo_editar
			$titulo_borrar
			
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan=\"5\" class=\"dataTables_empty\">Cargando Datos del Servidor</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			$lista_head
			$titulo_ver
			$titulo_editar
			$titulo_borrar
		</tr>
	</tfoot>
</table>
		
		</div>	
		</div>	
			
	 	
			
";

/*
#table-block table tr.header2 td {
  background: url("../menu/fondo_tabla.jpg") repeat scroll 0 0 transparent;
  color: #FFFFFF;
  font: bold 11px Arial,Tahoma,sans-serif;
  padding: 5px;
  text-align: center;
}*/

/*
$css .="<style>
		
        </style>";

*/ 
       
 }


?>