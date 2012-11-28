<?php

$tipo = $HTTP_GET_VARS['tipo'];

if(isset($tipo)){

  if($tipo=="all"){
  
  }else{
  
  $condicion="WHERE tipo='$tipo'";
  
  }


}else{
//  $tipo=9;
 $condicion="WHERE tipo ='0'";
}


    $query= "SELECT  id_tipo_u,descrip   
           FROM mailing_usuario_tipo ";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
            
			$tabla_bases ="   <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Seleccione Bases de Datos a <br> enviar Mailing.</td>
                                  </tr>
								  <tr>
                                  <td align=\"center\" class=\"textos\">&nbsp;</td>
                                  </tr>
                            	</table>
			<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			
			 while (list($id_tipo_u,$descrip) = mysql_fetch_row($result)){
			 
			  $query= "SELECT id_usuario,nombre,apellido,mail,mail2  
                       FROM mailing_usuario
		               where tipo='$id_tipo_u'";
                  
				   $result2= cms_query($query);
		           $num=mysql_num_rows($result2);
			 
			 
			 
			 $tabla_bases .=" <tr>
                             <td align=\"left\" class=\"textos\">$descrip</td>
							 <td align=\"left\" class=\"textos\">$num Mails</td>
							  <td align=\"left\" class=\"textos\">
							  <input type=\"checkbox\" name=\"id_base_$id_tipo_u\" value=\"$id_tipo\"></td>
                             </tr>";
			 
			 
			$option_sel .="<option value=\"mailing.php?id_mailing=$id_mailing&accion=$accion&tipo=$id_tipo_u\">$descrip</option>";   
						   }
			
						   
		$tabla_bases .="</table>
			
			  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr><td align=\"center\" class=\"textos\">Reenviar a los mails solo vistos
              <input type=\"checkbox\" name=\"vistos_ok\" value=\"ok\"></td></tr> 
			   <tr>
                  <td align=\"center\" class=\"textos\">
				  <input type=\"submit\" name=\"Submit\" value=\"Enviar\"></td>
                  </tr>
            	</table>
			";

$bases ="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
          <tr>
             <td align=\"center\">
			   <form name=\"form1\">
                <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
            <option value=\"#\" selected>---></option>
			<option value=\"mailing.php?id_mailing=$id_mailing&accion=$accion&tipo=all\" >Todos</option>
               $option_sel
              </select>
             </form>
          </td>
           </tr>
         </table>";



  $query= "SELECT id_usuario,nombre,apellido,mail,mail2  
           FROM mailing_usuario
		   $condicion
		   ORDER BY mail ";
           $result= cms_query($query);
		    $num=mysql_num_rows($result);
			
			
$usuarios = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
               <tr>
                 <td align=\"center\" class=\"textos\"><b>Total de mail en la Base de Datos: $num</b></td>
               </tr>
			    <tr>
              <td align=\"center\" class=\"textos\">&nbsp;</td>
               </tr>
			    <tr>
              <td align=\"center\" class=\"textos\">
              <a href=\"$PHP_SELF?accion=$accion&act=1008&tipo=$tipo&id_mailing=$id_mailing\"><b>Enviar Mailing</b></a></td>
               </tr>
             </table><br><br><br>
<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
            	<tr>
                  <td align=\"center\" class=\"textos_plomo\">Nombre</td>
				  <td align=\"center\" class=\"textos_plomo\">Mail 1</td>
				   <td align=\"center\" class=\"textos_plomo\">Mail 2</td>
                </tr>
              ";
            
			  while (list($id_usuario,$nombre,$apellido,$mail,$mail2) = mysql_fetch_row($result)){
				$usuarios .="   <tr>
                  <td align=\"left\" class=\"textos\">$nombre</td>
				  <td align=\"left\" class=\"textos\">$mail</td>
				   <td align=\"left\" class=\"textos\">$mail2</td>
                </tr>";		   
			   }

						   
			$usuarios .="</table>";			   
	$accion_form ="$PHP_SELF?accion=$accion&act=1008&act_all=1&id_mailing=$id_mailing";		   
	$contenido .="$tabla_bases <br> $bases <br>$usuarios";					   
?>