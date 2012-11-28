<?php
//Rescata datos opcionales de un usuario con su id_usuario

/*
 * Select tabla usuario
 * 
 */
 
 if($_GET['folio']){
 	$folio = $_GET['folio'];
 
 
 
     $query= "SELECT id_usuario
            FROM  sgs_solicitud_acceso
            WHERE folio='$folio'";
      $result= mysql_query($query)or die (error($query,mysql_error(),$php));
       list($id_usuario_folio) = mysql_fetch_row($result);
	   
	
 

$query= "SELECT id_usuario,login,password,id_perfil,establecimiento,nombre,apellido,paterno,materno,razon_social,apoderado,email,session,rut,fecha_nac,edad,estado_civil,direccion,numero,depto,fono,hijos,ocupacion,escolaridad,estado,celular,orden,equipo,id_region,ciudad,id_comuna,comuna,empresa,direccion_empresa,comuna_empresa,codigo,telefono,id_ocupacion,id_rango_edad,id_sexo,id_nacionalidad,id_nivel_educacional,id_organizacion,id_frecuencia_organizacion,fecha_crea,fecha_ingreso,id_tipo_persona,id_entidad_padre,id_entidad,id_departamento,id_pais  
           FROM  usuario
           WHERE id_usuario = $id_usuario_folio";
     $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
    list($id_usuario,$login,$password,$id_perfil,$establecimiento,$nombre,$apellido,$paterno,$materno,$razon_social,$apoderado,$email,$session,$rut,$fecha_nac,$edad,$estado_civil,$direccion,$numero,$depto,$fono,$hijos,$ocupacion,$escolaridad,$estado,$celular,$orden,$equipo,$id_region,$ciudad,$id_comuna,$comuna,$empresa,$direccion_empresa,$comuna_empresa,$codigo,$telefono,$id_ocupacion,$id_rango_edad,$id_sexo,$id_nacionalidad,$id_nivel_educacional,$id_organizacion,$id_frecuencia_organizacion,$fecha_crea,$fecha_ingreso_u,$id_tipo_persona,$id_entidad_padre,$id_entidad,$id_departamento,$id_pais) = mysql_fetch_row($result_usuario);
}

    if($rut!=""){
        $rut_html = formato_rut_bd($rut);
      $rut_tr="<tr >
          <td colspan=\"2\" class=\"alt\">Rut</td>
          <td colspan=\"4\" align=\"left\">$rut_html</td> 
      </tr>"; 
      $datos_ok=1;  
    }
    if($id_nivel_educacional!=0){
        
        $nivel_educacional =  rescata_valor('usuario_nivel_educacional',$id_nivel_educacional,'nivel_educacional') ;
      $nivel_educacional_tr= " <tr >
          <td colspan=\"2\" class=\"alt\">Nivel Educacional</td>
          <td colspan=\"4\" align=\"left\">$nivel_educacional</td> 
      </tr>";
      $datos_ok=1;
    }
    if($telefono!=""){
        
         $telefono_tr= " <tr >
          <td colspan=\"2\" class=\"alt\">Tel&eacute;fono</td>
          <td colspan=\"4\" align=\"left\">$telefono</td> 
      </tr>";
      $datos_ok=1;
    }
    if($id_nacionalidad!=0){
      $nacionalidad =  rescata_valor('usuario_nacionalidad',$id_nacionalidad,'nacionalidad') ;
      $nacionalidad_tr= " <tr >
          <td colspan=\"2\" class=\"alt\">Nacionalidad</td>
          <td colspan=\"4\" align=\"left\">$nacionalidad</td> 
      </tr>";
      $datos_ok=1;
    }
    
    if($id_sexo!=0){
      $sexo =  rescata_valor('usuario_sexo',$id_sexo,'sexo') ;
      $sexo_tr = "<tr >
          <td colspan=\"2\" class=\"alt\">Sexo</td>
          <td colspan=\"4\" align=\"left\" >$sexo</td> 
      </tr>";
      $datos_ok=1;
    }
    
    if($edad!=0){
      $edad =  rescata_valor('usuario_rango_edad',$id_rango_edad ,'rango_edad') ;
      $edad_tr ="<tr >
          <td colspan=\"2\" class=\"alt\">Edad</td>
          <td colspan=\"4\" align=\"left\" >$edad</td> 
      </tr>";
      $datos_ok=1;
        
    }
    if($id_organizacion!=0){
        
        
     $organizacion =  rescata_valor('usuario_organizacion',$id_organizacion,'organizacion') ;
    $organizacion_tr = " <tr >
          <td colspan=\"2\" class=\"alt\">Tipo de organizaci&oacute;n en la que participa</td>
          <td colspan=\"4\" align=\"left\" >$organizacion</td> 
      </tr>";
      $datos_ok=1;
    }
    if($id_ocupacion!=0){
      $ocupacion =  rescata_valor('usuario_ocupacion',$id_ocupacion,'ocupacion') ;
      $ocupacion_tr = " <tr >
          <td colspan=\"2\" class=\"alt\">Ocupaci&oacute;n</td>
          <td colspan=\"4\" align=\"left\" >$ocupacion</td> 
      </tr>";
      $datos_ok=1;
    }
    if($id_frecuencia_organizacion!=0){
      $frecuencia_organizacion =  rescata_valor('usuario_frecuencia_organizacion',$id_frecuencia_organizacion,'frecuencia_organizacion') ;
      $frecuencia_organizacion_tr ="<tr >
          <td colspan=\"2\" class=\"alt\">Frecuencia</td>
          <td colspan=\"4\" align=\"left\" >$frecuencia_organizacion</td> 
      </tr>";
      $datos_ok=1;
    }
    
  
  if($datos_ok==1){
   $opcionales = " <tr>
                
                 <th colspan=\"6\">Datos Opcionales</th>
               </tr>
               $rut_tr
               $telefono_tr
               $nivel_educacional_tr
               $nacionalidad_tr
               $sexo_tr   
               $edad_tr
               $ocupacion_tr
               $organizacion_tr
               $frecuencia_organizacion_tr
                "; 
  }
   
    
    
    
/** fin select usuario***/

 /************************************/
 
	 $contenido = cms_replace("#OPCIONALES#",$opcionales,$contenido);
	/**************************************/
?>