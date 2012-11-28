<?php

if($_GET['tp']!=""){

include("../../lib/connect_db.inc.php");
include("../../lib/lib.inc.php");
include("../../lib/lib.inc2.php");
$id_auto_admin = $_GET['id'];
}

	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * Easy set variables
	 */
	
	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	     $query= "SELECT tabla   
                FROM  auto_admin
                WHERE id_auto_admin='$id_auto_admin'";
          $result= mysql_query($query)or die (error($query,mysql_error(),$php));
           list($sTable) = mysql_fetch_row($result);
		  
		      $query= "SELECT id_campo,campo,pk,txt,existe_listado,txt_xml,id_tipo_campo
   		      	       FROM auto_admin_campo 
   		      	       WHERE id_auto_admin='$id_auto_admin' and  campo<>'orden'";
//echo $query."<br>";
   		      $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
   		      $cont=0;
			  while(list($id_campo,$campo_txt_tbl,$pk_campo,$txt_campo,$existe_listado,$txt_xml,$id_tipo_campo) = mysql_fetch_row($resultq)){
			  			
						
							if($pk_campo==1){
							$campo_pk= $campo_txt_tbl;
							//echo $campo_pk." pk<br>";
							$sIndexColumn = "$campo_pk";
							}	
								
								$campo_txt_tbl= strtolower($campo_txt_tbl);
								$txt_xml= strtolower($txt_xml);
								 if($existe_listado==1){ 
									$var = $campo_txt_tbl."_tipo_campo";
									$$var =$id_tipo_campo;
								 	$aColumns[$cont]=$campo_txt_tbl;
									$lista_campos .="$campo_txt_tbl,";
									 $cont++;	
								 }
								 
			  }
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE (";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	//echo $sQuery."<br>";
	
	$rResult = mysql_query( $sQuery ) or die(mysql_error()." linea 167<br>$sQuery");
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 173<br>$sQuery");
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 182<br>$sQuery");
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iTotal,
		"aaData" => array()
	);
	//echo $sQuery." ddd<br>";
//	print_r($aResultTotal);
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
//		echo "--".count($aColumns)." rrr<br>";
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
		//$a++;
		//echo $i ."col <br>";
			if ( $aColumns[$i] == "version" )
			{

				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
			    $tipo_campo= $aColumns[$i]."_tipo_campo";
				
				$row[]=extrae_valor($$tipo_campo,$aColumns[$i],$aRow[$aColumns[$i]]);
				 
				
			}
		}
		
		$aRow[$i+1]="<a href=\"?accion=$accion&act=ver&id=\"><img src=\"images/lupa.gif\" alt=\"\" border=\"0\"></a>";
		
		$aRow[$i+2]="<a href=\"?accion=$accion&act=edit\"><img src=\"images/edit.gif\" alt=\"\" border=\"0\"></a>";
		
		$aRow[$i+3]="<a href=\"?accion=$accion&act=del\"><img src=\"images/del.gif\" alt=\"\" border=\"0\"></a>";
		
		
		//echo "---------<br>";
		$row[] = $aRow[$i+1];
		$row[] = $aRow[$i+2];
		$row[] = $aRow[$i+3];
	/*
	$cont_lista = $i;
	
		
if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$row[] = "<a href=\"?accion=$accion&act=ver&id=\"><img src=\"images/lupa.gif\" alt=\"\" border=\"0\"></a>";
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$titulo_editar  ="<a href=\"?accion=$accion&act=edit\"><img src=\"images/edit.gif\" alt=\"\" border=\"0\"></a>";
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$titulo_borrar ="<a href=\"?accion=$accion&act=del\"><img src=\"images/del.gif\" alt=\"\" border=\"0\"></a>";
}
	*/	
		
		
		$output['aaData'][] = $row;
	}
	
	require_once("lib/json.php");

		$json = new Services_JSON;

		echo $json->encode($output);
	


function extrae_valor($tipo_campo,$campo,$valor){
	
	 
	
	switch ($tipo_campo) {
         case 6: //clave de otra tabla
             
			      $query= "SELECT id_auto_admin  
			          FROM  auto_admin_campo
			          WHERE campo='$campo' and pk=1";
						// echo $query."<br>";
				 $result_r= cms_query($query)or die (error($query,mysql_error(),$php));
			         list($id_auto_tabla_r) = mysql_fetch_row($result_r);
				  if($id_auto_tabla_r!=""){
				  
				     $tabla_r= tabla($id_auto_tabla_r);
				     $campo_txt_r =campo_txt($id_auto_tabla_r);	
				     $campo_pk_r=campo_pk_tabla($id_auto_tabla_r);	
					 
					//  $valor="&nbsp sss $id_auto_tabla_r $campo_txt_r $campo_pk_r $valor";
					
			             $valor= valor_campo_tabla ($tabla_r, $campo_txt_r, $valor);
							    if($valor==""){
							           $valor="&nbsp";
							    }
						
				      }
				      
             break;
    	case 9://fecha
             
			     $valor=fechas_html($valor);
				      
             break;
   		case 4://si no
             
			     if($valor==1){
				 $valor="si";
				 }else{
				 $valor="no";
				 }
				      
             break;
   
       	default:
    	  
    	 
           
     }
	
	
	 return $valor;
	}
?>