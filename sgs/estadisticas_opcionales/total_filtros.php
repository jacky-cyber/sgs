<?php
$campo_txt = $_SESSION['campo_txt_sess'];
$tabla = $_SESSION['tabla_sess'];
$tabla_campo = $_SESSION['tabla_campo_sess'];
$campo_pk = $_SESSION['campo_pk_sess'];
$condicion = $_SESSION['condicion_sess'];



$sessss=$_SESSION['criterios_sess'];

//echo $sessss. "ddd";

$criterios = explode(",", $_SESSION['criterios_sess']);
  

 while(list($valor) = each($criterios)) {
    
   $criterios2 = explode("#", $criterios[$valor]);
    
    $campo_tabla = trim($criterios2[0]);
    $valor_campo = trim($criterios2[1]);
    $valor_id_campo = trim($criterios2[2]);
    
   
    
    if($valor_campo!=""){
     
   
        $cont_l++;
        $campo_tabla2 = ucwords(strtolower(str_replace("id_","",$campo_tabla)));
        $campo_tabla2 = str_replace("_"," ",$campo_tabla2);
        
        
        
     if ($valor_campo!="" and $campo_tabla!=""){
        

          
        
        $filtro_sql .=" and $campo_tabla = '$valor_id_campo' ";
        
       // 
         $lista .="<tr  >
   
        <td  align=\"left\" class=\"textos\" >Donde <strong>$campo_tabla2</strong> sea <strong>$valor_campo</strong></td>
    
    <td align=\"center\" ><a href=\"#\" class=\"eliminar\" id=\"id_$cont_l\">
        <img src=\"images/x.png\" alt=\"Borrar este criterio\" border=\"0\"></a>
        </td> </tr> ";
        
        $link_borrar="<tr>
        <td align=\"left\"  class=\"textos_rojo\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"delcriterios();\">Borrar todos los filtros
               </td><td align=\"center\" class=\"textos\"></td> </tr> ";
           
   
         }
    }
    
    
}
  
  //pk_tabla($tabla)
  //campo_txt($id_auto_admin)
  

  /*
 * Select tabla usuario
 * 
 */
$query= "SELECT count(*)  
           FROM  usuario
           WHERE  id_perfil=1 $filtro_sql ";
     $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
     list($cantidad) = mysql_fetch_row($result_usuario);
/** fin select usuario***/
   
    
   $lista_criterios_ajax = "<table  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
               $link_borrar
               $lista
                </table><br> <div id=\"total_reg\">Total $cantidad</div>";
                
?>