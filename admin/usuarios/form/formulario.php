<?php
//include("comuna_select/comuna_select.php");

$select_regiones = generaRegion1($id_region2);



$id_cole = $_GET['id_cole'];

if($establecimiento_u!=""){
	$id_cole=$establecimiento_u;
}

  $query= "SELECT id,establecimiento  
           FROM  establecimientos
           order by establecimiento";
     $result= mysql_query($query)or die (mysql_error());
      while (list($id_cole2,$cole) = mysql_fetch_row($result)){
      		if($id_cole==$id_cole2){
      			$lista_colegios  .="<option value=\"?accion=$accion&act=$act&id_cole=$id_cole2\" selected>$cole</option>\n";
      			$lista_colegios2 .="<option value=\"$id_cole2\" selected>$cole</option>\n";
      		}else{
      			$lista_colegios  .="<option value=\"?accion=$accion&act=$act&id_cole=$id_cole2\">$cole</option>\n";
      			$lista_colegios2 .="<option value=\"$id_cole2\" >$cole</option>\n";
      		}
				
		 }
		 
		 
		 
		 
  
		 if($id_cole!=""){
		 	  $query= "SELECT id,paterno,nombres   
		 	           FROM  personal
		 	           WHERE establecimiento ='$id_cole'
					   order by nombres";
		 	     $result= mysql_query($query)or die (mysql_error());
		 	      while (list($id,$paterno,$nombres) = mysql_fetch_row($result)){
		 				if($id==$id_pe){
      						$lista_personal .="<option value=\"?accion=$accion&act=$act&id_cole=$id_cole&id_pe=$id\" selected>$nombres $paterno</option>\n";
      						
      						  $query= "SELECT rut, dig, paterno, nombres,
  											  fechanac, estcivil,  telefono,
  											  email, domicilio, id_comuna, escolaridad,
  											  especialidad, banco, ctacte,
  											  cargo  
           								 FROM  personal
           								 WHERE id = '$id_pe'";

    						 $result= mysql_query($query)or die (mysql_error());
    						 list($rut_u,$dig_u,$apellido_u,$nombre_u,
  											  $fecha_nac_u,$estcivil_u,$fono_u,
  											  $email_u,$direccion_u,$id_comuna_u,$escolaridad_u,
  											  $especialidad_u,$banco_u,$ctacte_u,
  											  $ocupacion_u) = mysql_fetch_row($result);
						   
									  $fechanac_u = fechas_html($fechanac_u);
									  $rut_u = "$rut_u-$dig_u";
									   
									$var = "select_$estcivil_u";
									$$var = "selected";
						
						
      						$login_u = strtolower($apellido_u);
							$letra = strtolower($nombre_u[0]);
							$login_u = $letra.$login_u;
							
						
      						$value_pass= " value=\"$login_u\"";
							//$value_pass= $login_u;
							
      					}else{
      						$lista_personal .="<option value=\"?accion=$accion&act=$act&id_cole=$id_cole&id_pe=$id\" >$nombres $paterno</option>\n";
      					}			   
		 		 }
		 }
	
if($act==4){
	
	$colegios ="<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
		     <tr >
		       <td align=\"center\" class=\"textos\">Seleccione Sistema 
		       <select name=\"colegio\" onChange=\"MM_jumpMenu('parent',this,0)\"  class=\"textos\">
   				 <option value=\"#\">----></option>
  					  $lista_colegios
  				 </select>
		       </td>
		       </tr>
		 	 <tr>
		       <td align=\"center\" class=\"textos\">Seleccione Personal 
		       <select name=\"pers\" onChange=\"MM_jumpMenu('parent',this,0)\"  class=\"textos\">
   				 <option value=\"#\">----></option>
  					 $lista_personal
  				 </select>
		       </td>
		       </tr>
		 	</table>";
		 	 
}
		 
		


if($msg ==1){	
	
		echo "<script>alert('Este login ya existe intente nuevamente');</script>\n";
	
	}
	



if($id_perfil_u==0){
	//administrador
	$checked0="checked";
	
}elseif($id_perfil_u==3){
	//director
	$checked3="checked";
	
}elseif($id_perfil_u==1){
	$checked1="checked";
	//funcionario
	
}elseif($id_perfil_u==999){
	
	//web master	
	
	$checked0="disabled";
	$checked3="disabled";
	$checked1="disabled";
	$webmaster = "<input type=\"hidden\" name=\"id_perfil_u\" value=\"999\">";
	
}else{
	$checked1="checked";
}



		 
		 

  $query= "SELECT id, establecimiento
           FROM establecimientos";
     $result= mysql_query($query)or die (mysql_error());
      while (list($id, $establecimiento) = mysql_fetch_row($result)){
      	
    //para que quede selecionado
		if($id==$id_cole){
			
			$var.= "<option value=\"$id\" selected >$establecimiento</option>";
		}else{
			$var.= "<option value=\"$id\">$establecimiento</option>";
		}
       
      	  
		 }
		 
 $var_1.=  "<select name=\"establecimiento_u\" onkeypress=\"return handleEnter(this, event)\" class=\"textos\" >
 		 
		 <option value=\"#\">--------></option>
		 $var
		 </select>";
 
 
$lista_escolaridad =  "<select name=\"escolaridad_u\" onkeypress=\"return handleEnter(this, event)\" class=\"textos\" >
 		 
		 <option value=\"#\">--------></option>
		   $lista_escolaridad
		 </select>"; 
 
 
 
 if($id_user==''){
 	
 $pass_vlid ="
		if (theForm.password_u.value == \"\"){
				alert(\"Por favor ingrese la password\");
				theForm.password_u.focus();
				return false;
		
		
		}	";
 	
 }
 
 $perfil_n = nombre_perfil($id_perfil_u);
 $perfil_hidden2= "<tr>
      <td  align=\"left\" class=\"textos\">Perfil Principal:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
	  <input type=\"radio\" name=\"id_perfil_u\" value=\"$id_perfil_u\"checked> $perfil_n</td></tr>";
//echo $nivelp;
 /**/
 if($id_pe==""){
 $id_perfil_padre = perfil_padre($id_perfil_u);
 $id_pe=$id_perfil_padre;
 $check= "check_$id_perfil_u";
 //echo $check;
 //$$check = "checked";
 }
 
 /**/
$d_p=$id_pe;	
include("lib/cuadro_perfiles_radio.php");
 
include("lib/cuadro_perfiles_check_box.php");
 
 
 

 $perfil_usuarios=  "<table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr >
		<td>
		<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td align=\"left\"> <input type=\"hidden\" name=\"id_p\" value=\"$id_p\">
				 $camino_perfild
			    </td>
			</tr>
		</table>
	</td>
     
      </tr>
	 <tr >
	 	<td>
		 
	 		$radio_perfiles 
		
     	 </td>
      </tr>
	</table>";

		
$js .="<script type=\"text/javascript\" src=\"js/livevalidation_standalone.js\"></script>
 <script type=\"text/javascript\" src=\"comuna_select/js/select_dependientes.js\"></script>
<script language=\"JavaScript\">
function validaforma(theForm){

	if (theForm.establecimiento_u.value == \"\"){
				alert(\"Por favor Seleccione un Colegio\");
				theForm.colegio.focus();
				return false;
		}
		if(theForm.nombre_u.value == \"\"){
				alert(\"Por favor ingrese el nombre\");
				theForm.nombre_u.focus();
				return false;
		}
		if (theForm.apellido_u.value == \"\"){
				alert(\"Por favor ingrese el apellido\");
				theForm.apellido_u.focus();
				return false;
		}
		
		if (theForm.login_u.value == \"\"){
				alert(\"Por favor ingrese el login\");
				theForm.login_u.focus();
				return false;
		}
		
		if (theForm.id_perfil_u.value == \"\"){
				alert(\"Por favor Seleccione perfil\");
				theForm.id_perfil_u.focus();
				return false;
		}
		
		

		
		$pass_vlid
		
	
}



</script>

<script language=\"javascript\">  
	 function verificar()
{
	
	if(document.form1.id_region.value =='')
	{
		window.alert('Por favor, Seleccione \"Region\"!')
		document.form1.id_region.focus();
		return false;
	}
	
	
	
	return true;
}



</script>




<script type=\"text/javascript\">
            
 function handleEnter (field, event) {  
 var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode; 
 if (keyCode == 13) { 
 var i; 
 for (i = 0; i < field.form.elements.length; i++) 
 if (field == field.form.elements[i]) 
 break; 
 i = (i + 1) % field.form.elements.length; 
 field.form.elements[i].focus(); 
 return false; 
 } 
 else 
 return true; 
 }      
 </script>
 <script language=\"JavaScript\" src=\"calendario/javascripts.js\"></script>
 
 
 
<script language = \"javascript\"> 
var peticion = false; 
try{ 
   // Mozilla/Safari 
   if (window.XMLHttpRequest) 
           peticion = new XMLHttpRequest(); 
   // IE 
   else if (window.ActiveXObject) 
           peticion = new ActiveXObject(\"Microsoft.XMLHTTP\"); 
} 
  
        catch (e) { 
                alert(e); 
        } 
// Error 
  
if(!peticion) 
        alert(\"no se pudo crear\"); 
  
 
function ObtDatos(url) { 
     if(peticion) { 
          peticion.open(\"GET\", url); 
          peticion.onreadystatechange = function(){ 
               if (peticion.readyState == 4 ) { 
                    if(peticion.responseText == \"NO\"){ 
                    var DivDestino = document.getElementById(\"DivDestino\"); 
                    DivDestino.innerHTML = \"<div id='error'><font color='#FF0000'>En uso.</font></div>\"; 
                    }else{
					 var DivDestino = document.getElementById(\"DivDestino\"); 
                    DivDestino.innerHTML = \"<div id='error'>Disponible.</div>\"; 
                 
					}
					 
               } 
          } 
peticion.send(null); 
     } 
} 
  
function compUsuario(Tecla) { 
     Tecla = (Tecla) ? Tecla: window.event; 
     input = (Tecla.target) ? Tecla.target : 
     Tecla.srcElement; 
     if (Tecla.type == \"keyup\") { 
          var DivDestino = document.getElementById(\"DivDestino\"); 
          DivDestino.innerHTML = \"<div></div>\"; 
          if (input.value) { 
               ObtDatos(\"admin/usuarios/verifica_login.php?q=\" + input.value +\"&idm=$id_sesion\"); 
          } 
     } 
} 
</script> 
 
 
	
";






$onsubmit ="onSubmit=\"return validaforma(this)\"";

  $query= "SELECT id
           FROM  establecimientos";
     $result= mysql_query($query)or die (mysql_error());
      while (list($id_establecimiento) = mysql_fetch_row($result)){
	  
	  	$nombre_establecimiento = establecimiento_nombre($id_establecimiento);
			$lista_establecmientos .="<option value=\"$id_establecimiento\">$nombre_establecimiento</option>";
			
			
		 }

		 $lista_establecmientos ="<select name=\"establecimiento_seg\" class=\"textos\">

<option value=\"\">Seleccione un tipo para agregar..</option>
$lista_establecmientos
</select>";


/*<tr><td align=\"center\" class=\"textos\">$colegios</td></tr>	  
<tr >*/


if(!verifica($id_sesion)){

   $query= "SELECT id_region, region   
            FROM  regiones";
   
      $result= mysql_query($query)or die (mysql_error());
      while(list($id_region2, $region) = mysql_fetch_row($result)){
	  
      	
      	if($id_region==$id_region2){
	  $regiones_lista .="<option value=\"$id_region2\" selected>$region</option>";
	  
	  }else{
	  $regiones_lista .="<option value=\"$id_region2\">$region</option>";
	  }
 }
	
	  $query= "SELECT id_comuna, comuna   
               FROM  comunas
			   WHERE id_region='$id_region2'";
	 // echo $query;
         $result2= mysql_query($query)or die (mysql_error());
          while(list($id_comuna2,$comuna) = mysql_fetch_row($result2)){
		  
		  if($id_comuna==$id_comuna2){
	  $comunas_lista .="<option value=\"$id_comuna2\" selected>$comuna</option>";
	  
	  }else{
	  $comunas_lista .="<option value=\"$id_comuna2\">$comuna</option>";
	  }
		  
} 





    	
 $region_comuna = "<tr><td align=\"left\"class=\"textos\"  width=\"20%\">Regi&oacute;n:</td>
               <td align=\"center\" class=\"textos\">&nbsp;</td>
          <td align=\"left\" class=\"textos\"  width=\"80%\"> 
		  		    <select  name=\"id_region\" id=\"id_region\" onChange='cargaContenido(this.id)'>
						$regiones_lista
						
					</select>
            
          </td>
        
		 
		<tr><td align=\"left\" class=\"textos\">Comuna: </td>
		     <td align=\"center\" class=\"textos\">&nbsp;</td>
		<td align=\"left\" class=\"textos\">
		  <select name=\"id_comuna\" id=\"id_comuna\">
		<option value=\"$id_comuna\" selected>$comuna </option>
						$comunas_lista 
					</select> </td>
        </tr>";
}else{

	$query= "SELECT comuna   
               FROM  comunas
			   WHERE id_comuna='$id_comuna2'";
	//echo $query;
         $result2= mysql_query($query)or die (mysql_error());
         list($comuna) = mysql_fetch_row($result2);
	
$region_comuna = "<tr><td align=\"left\"class=\"textos\"  width=\"20%\">Regi&oacute;n: </td>
                  <td align=\"center\" class=\"textos\">&nbsp;</td>
          <td align=\"left\"class=\"textos\"  width=\"80%\"> 
            $select_regiones
          </td>
        </tr>
		 
		<tr><td align=\"left\" class=\"textos\">Comuna: </td>
		     <td align=\"center\" class=\"textos\">&nbsp;</td>
		<td align=\"left\" class=\"textos\">
		  <select  name=\"id_comuna\" id=\"id_comuna\">
						<option value=\"0\">Selecciona opci&oacute;n...</option>
							<option value=\"$id_comuna2\" selected>$comuna </option>
					</select>   
		</td></tr>";
}




$modulo_usuarios= "$msg<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro\">
<tr><td align=\"center\" class=\"textos\">$colegios</td></tr>
    <tr>   
	    <td align=\"center\" class=\"cabeza_rojo\">Ingreso de datos</td>	
	</tr>
     <tr>
          <td align=\"center\" class=\"textos\">
 <table  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
   <tr>
      <td  align=\"left\" class=\"textos\"></td>
      <td align=\"center\" class=\"textos\"> &nbsp;</td>
      <td align=\"left\" class=\"textos\"></td>    
  </tr>
  


    <tr>
      <td  align=\"left\" class=\"textos\">Nombre:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input onkeypress=\"return handleEnter(this, event)\" type=\"text\" size=\"25\" name=\"nombre_u\" value= \"$nombre_u\" class=\"textos\" >(*)
      </td>
      </tr>
      <tr>
      <td  align=\"left\" class=\"textos\">Apellidos:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input onkeypress=\"return handleEnter(this, event)\" type=\"text\" size=\"25\" name=\"apellido_u\" value= \"$apellido_u\" class=\"textos\">(*)
      </td>
      
      </tr>
      
      <tr>
      <td  align=\"left\" class=\"textos\">Telefono</td>
      <td align=\"center\" class=\"textos\"> &nbsp;</td>
      <td align=\"left\" class=\"textos\">
	  <input type=\"text\" name=\"fono_u\" value=\"$fono_u\" size=\"9\" maxlength=\"9\">
      </td>
      <script type=\"text/javascript\">
      var fono_u = new LiveValidation('fono_u');
      fono_u.add( Validate.Numericality );
     </script>
      </tr>
      
      <tr>
      <td  align=\"left\" class=\"textos\">Celular</td>
      <td align=\"center\" class=\"textos\"> &nbsp;</td>
      <td align=\"left\" class=\"textos\">
	  <input type=\"text\" name=\"celular_u\" value=\"$celular_u\" size=\"9\" maxlength=\"9\">
      </td>
       <script type=\"text/javascript\">
      celular_u = new LiveValidation('celular_u');
      celular_u.add( Validate.Numericality );
     </script>
      </tr>
      
       <tr>
      <td  align=\"left\" class=\"textos\">Email:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input onkeypress=\"return handleEnter(this, event)\" type=\"text\" size=\"25\" name=\"email_u\" class=\"textos\" value= \"$email_u\">
      </td>
       <script type=\"text/javascript\">
       var email_u = new LiveValidation('email_u');
       email_u.add( Validate.Email );
      </script>      
     </tr>
       
          $region_comuna
	
      <tr>
      <td  align=\"left\" class=\"textos\">Direcci&oacute;n:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input onkeypress=\"return handleEnter(this, event)\" type=\"text\" size=\"35\" name=\"direccion_u\" class=\"textos\" value= \"$direccion_u\">
      </td>
    </tr>
  
    <tr>      
        <td  align=\"left\" class=\"textos\">Login:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input onkeypress=\"return handleEnter(this, event)\" type=\"text\" size=\"25\" name=\"login_u\" value= \"$login_u\" class=\"textos\" onkeyup = \"compUsuario(event)\">(*)
      <div id=\"DivDestino\"></div></td>
      </tr>
      
      <tr>
      <td  align=\"left\" class=\"textos\">Password:</td>
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      <td align=\"left\" class=\"textos\">
     <input onkeypress=\"return handleEnter(this, event)\" type=\"text\" size=\"25\" name=\"password_u\" class=\"textos\" $value_pass>(1)
      </td>      
     </tr>
       $perfil_hidden2

 
     
     </table>
     </td></tr>
     <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>

<tr><td align=\"center\" class=\"textos\"> Establecimiento
<select name=\"establecimiento_u\" class=\"textos\">
$lista_colegios2
</select>

</td></tr>


      
     
                    
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  <tr><td align=\"center\" class=\"textos\"><b>$perfil_usuarios</b></td></tr>
       <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
 <tr><td align=\"center\" class=\"textos\">$check_perfiles_check2</td></tr>
  <tr><td align=\"center\" class=\"textos\">$tabla_perfil_r </td></tr>
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  <tr><td align=\"center\" class=\"textos\"><b></b></td></tr>
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  <tr><td align=\"center\" class=\"textos\"> $lista_establecmientos2</td></tr>
  
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
 <tr><td align=\"center\" class=\"textos\"> $tabla_establecimientos </td></tr>

    
  
   <tr>
          <td align=\"center\" class=\"textos\">
            <input class=\"boton\" type=\"submit\" name=\"boton\" value=\"Aceptar\">
          </td>
          </tr>
		<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>  
   <td align=\"center\" class=\"textos\"><font color=\"#999999\"><b>(*)Nota:&nbsp;&nbsp;Estos campos son obligatorios.<br>
   (1)Nota:&nbsp;&nbsp;Opcional s&oacute;lo si desea cambiar o crear la password.</b></font> 
   
   </td>
   </tr> 
   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  </table> ";

/* 
    
   
	
    
			
    </table>
	<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
	
	 <tr><td align=\"center\" class=\"textos\"> Establecimiento 
      <select name=\"establecimiento_u\" class=\"textos\">
		 $lista_colegios2
		 </select>
      
      </td></tr>
      <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
	 <tr>
     <td align=\"center\" class=\"textos\">
       $perfil_usuarios
   
     
    	$webmaster
	
      </td>
      </tr>
     
      <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
	
     
          
          <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
          
    
          
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  <tr><td align=\"center\" class=\"textos\"><b></b></td></tr>
       <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
 <tr><td align=\"center\" class=\"textos\">$check_perfiles_check2</td></tr>
  <tr><td align=\"center\" class=\"textos\">$tabla_perfil_r </td></tr>
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  <tr><td align=\"center\" class=\"textos\"><b></b></td></tr>
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
  <tr><td align=\"center\" class=\"textos\"> $lista_establecmientos2</td></tr>
  
  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
 <tr><td align=\"center\" class=\"textos\"> $tabla_establecimientos</td></tr>
  <tr>*/
?>