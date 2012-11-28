<?php
//ingreso registro
$nombre = $_POST['nombre'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$boton = $_POST['boton'];
$error = $_GET['error'];
//$rut = $_GET['rut'];

if(isset($error)){
	
	$msg =  "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	    <tr >
	      <td align=\"center\" class=\"textos\">
	      <font color=\"#cc0000\" >'Este rut ya existe'</font>
	     </td>
	      </tr>
		</table>";	
}

switch ($act) {
     case 1:
     	 include ("registro/form_ingreso/mensaje_ingreso.php");
         break;
         
    case 2:
     	  include ("registro/form_ingreso/mensaje_error.php");
         break;
	
       
	
   	default:
	   
  

$js ="<script language=\"JavaScript\">

function CheckRutField(rut)
{
	var tmpstr = \"\";
	for ( i=0; i < rut.length ; i++ )
		if ( rut.charAt(i) != ' ' && rut.charAt(i) != '.' && rut.charAt(i) != '-' )
			tmpstr = tmpstr + rut.charAt(i);
	rut = tmpstr;
	largo = rut.length;
// [VARM+]
	tmpstr = \"\";
	for ( i=0; rut.charAt(i) == '0' ; i++ );
		for (; i < rut.length ; i++ )
			tmpstr = tmpstr + rut.charAt(i);
	rut = tmpstr;
	largo = rut.length;
// [VARM-]
	if ( largo < 2 )
	{
		alert(\"Debe ingresar el rut completo.\");
		document.form1.rut.value = \"\";
		document.form1.rut.select();
		document.form1.rut.focus();
		return false;
	}
	for (i=0; i < largo ; i++ )
	{
		if ( rut.charAt(i) != \"0\" && rut.charAt(i) != \"1\" && rut.charAt(i) !=\"2\" && rut.charAt(i) != \"3\" && rut.charAt(i) != \"4\" && rut.charAt(i) !=\"5\" && rut.charAt(i) != \"6\" && rut.charAt(i) != \"7\" && rut.charAt(i) !=\"8\" && rut.charAt(i) != \"9\" && rut.charAt(i) !=\"k\" && rut.charAt(i) != \"K\" )
		{
			alert(\"El valor ingresado no corresponde a un R.U.T valido.\");
			document.form1.rut.value = \"\";
			document.form1.rut.select();
			document.form1.rut.focus();
			return false;
		}
	}
	var invertido = \"\";
	for ( i=(largo-1),j=0; i>=0; i--,j++ )
		invertido = invertido + rut.charAt(i);
	var drut = \"\";
	drut = drut + invertido.charAt(0);
	drut = drut + '-';
	cnt = 0;
	for ( i=1,j=2; i<largo; i++,j++ )
	{
		if ( cnt == 3 )
		{
			drut = drut + '.';
			j++;
			drut = drut + invertido.charAt(i);
			cnt = 1;
		}
		else
		{
			drut = drut + invertido.charAt(i);
			cnt++;
		}
	}
	invertido = \"\";
	for ( i=(drut.length-1),j=0; i>=0; i--,j++ )
		invertido = invertido + drut.charAt(i);
	document.form1.rut.value = invertido;
	if ( checkDV(rut) )
		return true;
	return false;
    }
	
function checkDV( crut )
    {
	largo = crut.length;
	if ( largo < 2 )
	{
		alert(\"Debe ingresar el rut completo.\");
		document.form1.rut.value = \"\";
		document.form1.rut.select();
		document.form1.rut.focus();
		return false;
	}
	if ( largo > 2 )
		rut = crut.substring(0, largo - 1);
	else
		rut = crut.charAt(0);
	dv = crut.charAt(largo-1);
	checkCDV( dv );
	if ( rut == null || dv == null )
		return 0;
	var dvr = '0';
	suma = 0;
	mul = 2;
	for (i= rut.length -1 ; i >= 0; i--)
	{
		suma = suma + rut.charAt(i) * mul;
		if (mul == 7)
			mul = 2;
		else
			mul++;
	}
	res = suma % 11;
	if (res==1)
		dvr = 'k';
	else if (res==0)
		dvr = '0';
	else
	{
		dvi = 11-res;
		dvr = dvi + \"\";
	}
	if ( dvr != dv.toLowerCase() )
	{
		alert(\"EL rut es incorrecto.\");
		document.form1.rut.value = \"\";
		document.form1.rut.focus();
		return false;
	}
	return true;
    }
	
function checkCDV( dvr )
    {
	dv = dvr + \"\";
	if ( dv != '0' && dv != '1' && dv != '2' && dv != '3' && dv != '4' && dv != '5' && dv != '6' && dv != '7' && dv != '8' && dv != '9' && dv != 'k'  && dv != 'K')
	{
		alert(\"Debe ingresar un digito verificador valido.\");
		
		document.form1.rut.select();
		document.form1.rut.focus();
		document.form1.rut.value = \"\";
		return false;
	}
	return true;
    }


</script>

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
 
<SCRIPT LANGUAGE=\"JavaScript\"> 
function isEmailAddress(theElement, nombre_del_elemento )
{
var s = theElement.value;
var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (s.length == 0 ) return true;
if (filter.test(s))
return true;
else

return false;
}
</SCRIPT>
 
 
 <script language=\"JavaScript\">
  	 	   function validaforma(theForm){
  	 		if (theForm.nombre.value == \"\"){
  	 					alert(\"Por favor ingrese su nombre.\");
  	 					theForm.nombre.focus();
  	 					return false;
  	 			}
     if (theForm.rut.value == \"\"){
  	 					alert(\"Por favor ingrese su rut.\");
  	 					theForm.rut.focus();
  	 					return false;
  	 			}
  if (theForm.email.value == \"\"){
  	 					alert(\"Por favor ingrese su email.\");
  	 					theForm.email.focus();
  	 					return false;
  	 			}

  	if (isEmailAddress(theForm.email,'theForm.email' ) == false){
  	 					alert(\"Por favor ingrese su email.\");
  	 					theForm.email.focus();
  	 					return false;
  	 			}
 		
  	 			
  }
  
  	 		
  		  </script>
 ";

$accion_form = "index.php?accion=$accion";

$onsubmit ="onSubmit=\"return validaforma(this)\"";	

	
	
$formulario = "$msg	    		  
  		<table width=\"350\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\" >
             <tr>
                  <td align=\"center\" class=\"cabeza_rojo\"><b>Registro de Usuario</b></td>
            </tr>        
        </table>
       <table width=\"350\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\" >  
             <tr bgcolor='#F8F8F8'\">
		         <td align=\"center\" colspan=\"3\">&nbsp; </td>
	         </tr> 
             <tr bgcolor='#F8F8F8'\">
                 <td align=\"center\" class=\"textos\">          
       <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >          
             <tr >
                 <td align=\"left\" class=\"textos\"  width=\"40%\">Ingrese su nombre</td>
                 <td align=\"left\" class=\"textos\" >:&nbsp;&nbsp;</td>
		         <td align=\"left\" class=\"textos\" >
		         <input type=\"text\" name=\"nombre\" value=\"$nombre\" size=\"18\"></td>
		    </tr>
		    <tr>
		          <td align=\"left\" class=\"textos\" > Ingrese su rut</td>
		          <td align=\"left\" class=\"textos\" >:&nbsp;&nbsp;</td> 
		          <td align=\"left\" class=\"textos\">
		          <input class=\"textos\" type=\"text\" name=\"rut\" value=\"$rut\" onChange=\"CheckRutField(document.form1.rut.value)\" maxlength=\"12\" size=\"20\" >&nbsp;(*)</td>
		   </tr>
		   <tr>
		         <td align=\"left\" class=\"textos\" >Ingrese su email</td>
		         <td align=\"left\" class=\"textos\" >:&nbsp;&nbsp;</td>
		         <td align=\"left\" class=\"textos\">
		         <input class=\"textos\"type=\"text\" name=\"email\" value=\"$email\" size=\"20\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<td>
		  </tr>
		  <tr>
		        <td align=\"center\" colspan=\"3\">&nbsp;</td>
	      </tr>
		  <tr>
		       <td align=\"left\" class=\"textos\"></td>
		       <td align=\"left\" class=\"textos\"></td>
		       <td align=\"left\" class=\"textos\">    
		       <input class=\"textos\" type=\"submit\" value=\"Ingresar\" name=\"boton\" class=\"boton\" onclick=\"CheckRutField(document.form1.rut.value)\"></td>
		 </tr>        
        																								
            </td>
          </tr>
          <tr>
		        <td align=\"center\" colspan=\"3\">&nbsp;</td>
	      </tr>
           <tr>
		          <td align=\"right\" colspan=\"3\" class=\"textos\"><b>
                  (*) Nota:&nbsp;&nbsp; Escriba el rut sin gui&oacute;n o puntos.</b></td>
	     </tr>
	     <tr>
		        <td align=\"center\" colspan=\"3\">&nbsp;</td>
	      </tr>	                 
     </table>
           </table>";





if($boton!=""){
	
	  $query= "SELECT id_usuario  
	           FROM  usuario
	           WHERE rut='$rut'";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      if(list($ide) = mysql_fetch_row($result)){
	      	
	      	$contenido = "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	      	    <tr>
	      	      <td align=\"center\" class=\"texto_rojo\">
	      	      Este Rut ya existe, intente nuevamente.</td>
	      	      </tr>
	      		</table>
				$formulario";
	      	
	      	
	    
	      }else{
	      	
	      	
	      	$rut2 = str_replace("-","",$rut);
	      	$rut2 = str_replace(".","",$rut2);
	        $rut_encrip = md5($rut2);
	        
	        $id_sesion .="xxx";
	           	
	      	$qry_insert="INSERT INTO usuario(login,password,nombre,rut,email, id_perfil, session) 
	      		values ('$email','$rut_encrip','$nombre','$rut','$email',1, '$id_sesion')";
	  
	       // echo "$id_sesion<br>";   
	        
	                $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
	//funcion enviarmail	

	
	enviar_mail_gracias_registro($nombre, $email, $rut2, $id_sesion);
	
	$contenido = "<table width=\"60%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">
	                    <tr>
	                  <td align=\"center\" class=\"textos\">
	                  <span class=\"categoria_p\">Bienvenido(a) $nombre</span>
	                  </td>
	                  </tr>
	                  <tr>
	                  <td align=\"center\" class=\"textos\">
	                  Enviamos un correo a su cuenta de email, 
	                  donde encontrará los datos necesarios para su ingreso al Sistema.
	                  </td>
	                  </tr>
	              </table>";
	      }
		
		
	
}else{
	


	      	$contenido = "$formulario";


	  
}

 }


?>