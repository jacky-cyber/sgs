<?php
	

        
       $campo_sel = $_GET['campo_sel'];
       
	if($axj==1 and $campo_sel !=""){
	
	$_SESSION['campo_sel_sess']=$campo_sel;
        
	   $queryrr= "SELECT id_auto_admin 
                       FROM  auto_admin_campo
                       WHERE campo='$campo_sel' and pk=1";
                 $result2= cms_query($queryrr)or die (error($queryrr,mysql_error(),$php));
                 list($id_auto_admin2) = mysql_fetch_row($result2);
		
        $_SESSION['campo_txt_sess']=  campo_txt($id_auto_admin2);
	$_SESSION['campo_pk_sess']= campo_pk_tabla($id_auto_admin2);
	$_SESSION['tabla_campo_sess']= tabla($id_auto_admin2);		
	
	
	}

		 
 
$campo_txt = $_SESSION['campo_txt_sess'];
$tabla = $_SESSION['tabla_sess'];
$tabla_campo = $_SESSION['tabla_campo_sess'];
$campo_pk = $_SESSION['campo_pk_sess'];
$condicion = $_SESSION['condicion_sess'];



$query23 = "select $tabla_campo.$campo_pk,$tabla_campo.$campo_txt,COUNT(*) as cantidad
		  from $tabla  LEFT OUTER JOIN $tabla_campo  on $tabla.$campo_pk = $tabla_campo.$campo_pk
		  where 1 $condicion and id_perfil=1
		  GROUP by $tabla.$campo_pk ";	
		
		
		
		 $result33= mysql_query($query23)or die (error($query23,mysql_error(),$php));
   
  $strXML2="";
    
	  while (list($campo_id,$texto_campo,$cantidad) = mysql_fetch_row($result33)){
	    $texto_campo= acentos_inverso($texto_campo);
    			if($texto_campo==""){
					$texto_campo="No Especifica";
				}
				
				if($axj==""){
				 
				 $strXML2 .= "<set label='$texto_campo' value='$cantidad' link='j-addcriterio-$texto_campo,$campo_id'/>";
				}else{
				 $strXML2 .= "<set label='$texto_campo' value='$cantidad' link='j-addcriterio-$texto_campo,$campo_id'/>";
				}
			   
			 }						
	
	
$xml_grafico = "<chart exportCallback='myCallBackFunction' exportEnabled='1' exportAtClient='1' exportHandler='fcExporter1' showExportDataMenuItem='1'  useRoundEdges='1'  showBorder='0'>$strXML2</chart>";



?>