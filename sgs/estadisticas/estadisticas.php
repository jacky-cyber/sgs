<?php
session_register('xml_estadisticas');
session_register('esSatelite');



if($_SESSION['esSatelite']==""){
	if( $_GET['tipo']!=""){
	$_SESSION['esSatelite']= $_GET['esSatelite'];
	}else{
	$_SESSION['esSatelite']=1;
	}
	
}
$esSatelite= $_SESSION['esSatelite'];

switch ($act) {
     case 1:
         
		  
	    $query= "SELECT sum(tot_solicitudes)  
                 FROM  sgs_llamadas_xml WHERE esSatelite =$esSatelite";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($total_res) = mysql_fetch_row($result);
		  
	    $query= "SELECT count(*)  
                 FROM  sgs_llamadas_xml
				 where lectura_ok=1 and sin_xml =0  and esSatelite =$esSatelite";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($total_url_ok) = mysql_fetch_row($result);
	   
	   
	    $query= "SELECT count(*)  
                 FROM  sgs_llamadas_xml
				 WHERE sin_xml =1 and lectura_ok=1 and esSatelite =$esSatelite";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($total_url_no_xml) = mysql_fetch_row($result);
	   
	    $query= "SELECT count(*)  
                 FROM  sgs_llamadas_xml
				 WHERE lectura_ok=0 and sin_xml =1 and  esSatelite =$esSatelite";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($total_url_problemas) = mysql_fetch_row($result);
	   
	  //$id_totales_servicios,$fecha,$total_url_ok,$total_url_no_xml,$total_url_problemas,
	  
	  
	  

$_SESSION['xml_estadisticas'] = "<chart caption='Total de Lecturas de Datos, Servicios con Sgs Transparencia' palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
           <set label=\"Total de Url OK\" value=\"$total_url_ok\" link=\"index.php?accion=$accion&act=2\"/> 
           <set label=\"Total de Url sin XML\" value=\"$total_url_no_xml\" link=\"index.php?accion=$accion&act=$act&tipo=1\"/> 
           <set label=\"Total de Url Con Problemas\" value=\"$total_url_problemas\" link=\"index.php?accion=$accion&act=$act&tipo=2\"/>
      </chart>";
	  
	 $lista_entidades="" ;
	  $tipo = $_GET['tipo'];
	  if($tipo==1){
	  $cont2=0;
	    $query= "SELECT se.entidad,sep.entidad_padre   
                 FROM  sgs_entidades se, sgs_entidad_padre sep ,sgs_llamadas_xml slx
                 WHERE slx.sin_xml=1 and slx.lectura_ok=1 and slx.esSatelite=$esSatelite 
				 and se.id_entidad_padre = sep.id_entidad_padre and se.id_entidad=slx.id_entidad ";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($entidad_lectura,$entidad_padre_lectura) = mysql_fetch_row($result)){
      				$cont2++;
					$lista_entidades .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"> 
										<td align=\"center\" >$cont2</td> 
										<td align=\"left\" >$entidad_padre_lectura </td>
										<td align=\"left\" >$entidad_lectura</td> 
										</tr> ";
							   
      		 }
			 $cabeza_listado = "<tr><td align=\"center\" colspan=\"3\"><strong>Entidades Sin Lectura de Datos</strong> </td></tr> ";
			 
	  }elseif($tipo==2){
	  
	  $cont2=0;
	    $query= "SELECT se.entidad,sep.entidad_padre   
                 FROM  sgs_entidades se, sgs_entidad_padre sep ,sgs_llamadas_xml slx
                 WHERE slx.lectura_ok = 0 and slx.sin_xml=1  and slx.esSatelite=$esSatelite
				  and se.id_entidad_padre = sep.id_entidad_padre and se.id_entidad=slx.id_entidad";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($entidad_lectura,$entidad_padre_lectura) = mysql_fetch_row($result)){
      				$cont2++;
					$lista_entidades .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"> 
										<td align=\"center\" >$cont2</td> 
										<td align=\"left\" >$entidad_padre_lectura </td>
										<td align=\"left\" >$entidad_lectura</td> 
										</tr> ";
							   
      		 }
			 $cabeza_listado = "<tr><td align=\"center\" colspan=\"3\"><strong>Entidades Con Lectura de Datos Pero con algun Problema</strong> </td></tr> ";
	
	  }
	  
	  $tabla_informe =   "<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                          $cabeza_listado
						 
						   $lista_entidades
                       	</table>";
	  

         break;

    case 2:
         
		  	  
	  $cont2=0;
	    $query= "SELECT sep.id_entidad_padre,sep.entidad_padre, sum(slx.tot_solicitudes) suma
                 FROM  sgs_entidades se, sgs_entidad_padre sep ,sgs_llamadas_xml slx
                 WHERE slx.lectura_ok = 1 and se.id_entidad_padre = sep.id_entidad_padre and se.id_entidad=slx.id_entidad and slx.esSatelite=1 and slx.sin_xml=0 
				 GROUP BY sep.id_entidad_padre
				 ORDER BY suma desc";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($id_entidad_padre_lectura,$entidad_padre_lectura,$tot_solicitudes) = mysql_fetch_row($result)){
      				$cont2++;
					$lista_entidades .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"> 
										<td align=\"center\" >$cont2</td> 
										<td align=\"left\" >
										<a href=\"index.php?accion=$accion&act=3&id_s=$id_entidad_padre_lectura\">
										$entidad_padre_lectura</a></td>
										
										<td align=\"center\" >$tot_solicitudes</td> 
										</tr> ";
					$entidad_padre_lectura= acentos_inverso($entidad_padre_lectura);		
					//$entidad_padre_lectura_flash = str_replace("Ministerio","Min.",$entidad_padre_lectura);			
				$lista_xml .="<set label=\"$entidad_padre_lectura\" value=\"$tot_solicitudes\" link=\"index.php?accion=$accion&act=3&id_s=$id_entidad_padre_lectura\"/> ";
										
							   
      		 }
			 $cabeza_listado = "<tr><td align=\"center\" colspan=\"3\"><strong>Entidades Con Solicitudes de Informaci&oacute;n</strong> </td></tr> ";
	
	  					
$_SESSION['xml_estadisticas'] = "<chart caption='Servicios con Sgs Transparencia' palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
           
           $lista_xml
      </chart>";
	  
	  $tabla_informe =   "<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                          $cabeza_listado
						   <tr > 
										<td align=\"center\" ></td> 
										<td align=\"left\" ></td>
										
										<td align=\"center\" >Solicitudes</td> 
										</tr>
						   $lista_entidades
                       	</table>";
		
         break;

    case 3:
         $id_s = $_GET['id_s'];
		 $cont2=0;
	    $query= "SELECT se.id_entidad ,se.entidad,sep.entidad_padre, slx.tot_solicitudes   
                 FROM  sgs_entidades se, sgs_entidad_padre sep ,sgs_llamadas_xml slx
                 WHERE slx.lectura_ok = 1 and se.id_entidad_padre = sep.id_entidad_padre and se.id_entidad_padre = $id_s and se.id_entidad=slx.id_entidad and slx.esSatelite=1 and slx.sin_xml=0 
				 ORDER BY slx.tot_solicitudes desc";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($id_entidad ,$entidad_lectura,$entidad_padre_lectura,$tot_solicitudes) = mysql_fetch_row($result)){
      				$cont2++;
					$lista_entidades .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"> 
										<td align=\"center\" >$cont2</td> 
										
										<td align=\"left\" >$entidad_lectura</td> 
										<td align=\"center\" >$tot_solicitudes</td> 
										</tr> ";
					$entidad_lectura= acentos_inverso($entidad_lectura);					
				$lista_xml .="<set label=\"$entidad_lectura\" value=\"$tot_solicitudes\" link=\"index.php?accion=$accion&act=4&id_s=$id_entidad\"/> ";
									
				//$entidad_padre_lecturas2=$entidad_padre_lecturas;			   
      		 }
			 
			   $query= "SELECT entidad_padre   
                        FROM  sgs_entidad_padre
                        WHERE id_entidad_padre = $id_s";
                  $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($entidad_padre) = mysql_fetch_row($result);
				  
				  
			 $cabeza_listado = "<tr><td align=\"center\" colspan=\"3\"><strong>$cont2 Entidades con solicitudes de Informaci&oacute;n en $entidad_padre</strong> </td></tr> ";
	
	  					
$_SESSION['xml_estadisticas'] = "<chart caption='Servicios con Sgs Transparencia' palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
           
           $lista_xml
      </chart>";
	  
	  $tabla_informe =   "<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                          $cabeza_listado
						   $lista_entidades
                       	</table>";
		 
		  
		
         break;

		 
		  case 4:
         $id_s = $_GET['id_s'];
		 $cont2=0;
	    $query= "SELECT se.id_entidad ,se.entidad,sep.entidad_padre, slx.tot_solicitudes   
                 FROM  sgs_entidades se, sgs_entidad_padre sep ,sgs_llamadas_xml slx
                 WHERE slx.lectura_ok = 1 and se.id_entidad_padre = sep.id_entidad_padre and se.id_entidad_padre = $id_s and se.id_entidad=slx.id_entidad and slx.esSatelite=1 and slx.sin_xml=0 
				 ORDER BY slx.tot_solicitudes desc";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
            while (list($id_entidad ,$entidad_lectura,$entidad_padre_lectura,$tot_solicitudes) = mysql_fetch_row($result)){
      				$cont2++;
					$lista_entidades .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"> 
										<td align=\"center\" >$cont2</td> 
										
										<td align=\"left\" >$entidad_lectura</td> 
										<td align=\"center\" >$tot_solicitudes</td> 
										</tr> ";
					$entidad_lectura= acentos_inverso($entidad_lectura);					
				$lista_xml .="<set label=\"$entidad_lectura\" value=\"$tot_solicitudes\" link=\"index.php?accion=$accion&act=3&id_s=$id_entidad\"/> ";
									
				//$entidad_padre_lecturas2=$entidad_padre_lecturas;			   
      		 }
			 
			   $query= "SELECT entidad_padre   
                        FROM  sgs_entidad_padre
                        WHERE id_entidad_padre = $id_s";
                  $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($entidad_padre) = mysql_fetch_row($result);
				  
				  
			 $cabeza_listado = "<tr><td align=\"center\" colspan=\"3\"><strong>$cont2 Entidades con solicitudes de Informaci&oacute;n en $entidad_padre</strong> </td></tr> ";
	
	  					
$_SESSION['xml_estadisticas'] = "<chart caption='Servicios con Sgs Transparencia' palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
           
           $lista_xml
      </chart>";
	  
	  $tabla_informe =   "<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                          $cabeza_listado
						   $lista_entidades
                       	</table>";
		 
		  
		
         break;

		 
		 
		 
		 
		 
		 
		 
		 
   	default:
	  
	    $query= "SELECT count(*)
                 FROM  sgs_llamadas_xml
				 WHERE esSatelite=1";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($totales_satelites) = mysql_fetch_row($result);
	  
	  
	  
	    $query= "SELECT count(*)
                 FROM  sgs_llamadas_xml
				 WHERE esSatelite=0";
				 

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($totales_no_satelites) = mysql_fetch_row($result);
	  
	     $query= "SELECT count(*)
                 FROM  sgs_llamadas_xml";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($totales_totales) = mysql_fetch_row($result);
	  
	  
	  

$_SESSION['xml_estadisticas'] = "<chart caption='Total de Servicios Monitoreados $totales_totales' palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
           <set label=\"Servicios Con Sgs Transparencia\" value=\"$totales_satelites\" link=\"index.php?accion=$accion&act=1\"/> 
           <set label=\"Servicios Sin Sgs Transparencia\" value=\"$totales_no_satelites\" link=\"index.php?accion=$accion&act=2\"/> 
          </chart>";
	  
	
 }
 
 
 



	  
      $js .="<script language=\"JavaScript\" src=\"sgs/estadisticas/JSClass/FusionCharts.js\"></script>";

$contenido = "<div id=\"chartdiv\" align=\"center\"> 
        FusionCharts. </div><table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">
				  
				  <script type=\"text/javascript\">
		
		  			 var chart = new FusionCharts(\"sgs/estadisticas/Charts/Pie3D.swf\", \"ChartId\", \"650\", \"300\", \"0\", \"0\");
					 chart.setDataURL(\"sgs/estadisticas/xmls.php\");		   
		   			 chart.render(\"chartdiv\");
				 </script>
		
				  </td>
                </tr>
			
              </table><br>
			  $tabla_informe"; 


?>