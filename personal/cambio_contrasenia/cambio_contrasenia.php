<?php




  switch ($act) {
      case 1:
          
		  $pass_actual = $_POST['pass_actual'];
		 
		  
if($pass_actual!=""){

	  $query= "SELECT password   
               FROM  usuario
               WHERE id_usuario='$id_usuario'";
       
		
		 $result= cms_query($query)or die (error($query,mysql_error(),$php));
         list($pass2) = mysql_fetch_row($result);
		 
		 $password_u_crip = md5($pass_actual);
		 
		 
		 $pass = $_POST['pass'];
		 if($pass2==$password_u_crip ){
		 	
			$pass_crip=md5($pass);
			$Sql ="UPDATE usuario
            	   SET password ='$pass_crip'
            	   WHERE id_usuario='$id_usuario'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
		 	 $formulario_registro = html_template('gracias_cambios_realizados');	
		 }else{
			 $formulario_registro = html_template('password_error');	
			 
			 $formulario_registro = str_replace("#ACCION#","$accion",$formulario_registro);	
		   }
		 

		}
		  
          break;
 	
    	default:
   
   
   $accion_form = "index.php?accion=$accion&act=1";

$js .="<script type=\"text/javascript\" src=\"comuna_select/js/select_dependientes.js\"></script>
<script src=\"js/jquery/jquery.Rut.min.js\" type=\"text/javascript\"></script>

<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}

</style>

<script type=\"text/javascript\">

var disStyle=0
var dom=document.getElementById||document.all

function getItem(id) {
return document.getElementById&&document.getElementById(id)? document.getElementById(id) : document.all&&document.all[id]? document.all[id] : null;
}

if(dom)
document.write('<style type=\"text/css\" id=\"dummy\">\
.tlink{\
display:none;\
}\
<\/style>')

if(dom&&typeof getItem('dummy').disabled=='boolean'){
document.write('<style type=\"text/css\" id=\"showhide\">\
.showhide{\
display:none;\
}\
#cdiv0 {\
display:block;\
}\
<\/style>');
disStyle=1;
}

function displayOne(idPrefix, idNum){
var i=0;
while (getItem(idPrefix+i)!==null){
getItem(idPrefix+i).style.display='none';
i++;
}
if (typeof idNum!=='undefined')
getItem(idPrefix+idNum).style.display='';
}

onload=function(){
displayOne('cdiv', 0);
if (disStyle)
getItem('showhide').disabled=true;
}
</script>



<script type=\"text/javascript\">


$.validator.setDefaults({
	//submitHandler: function() { alert(\"submitted!\"); }
});



//$(document).ready(function(){
// Demo 1
//$('#rut').Rut();

//});



$().ready(function() {

	
	// validate signup form on keyup and submit
	$(\"#form1\").validate({
		rules: {
			
			
			pass: {
				required: true,
				minlength: 6
			},
			pass2: {
				required: true,
				minlength: 6,
				equalTo: \"#pass\"
			},
			pass_actual:{
				required: true
				
			}
		},
		messages: {
		
			pass: {
				required: \"Ingrese su nueva Contrase&ntilde;a\",
				minlength: \"Su contrase&ntilde;a debe contener a lo menos 6 caracteres\"
			},
			pass2: {
				required: \"Confirme su contrase&ntilde;a\",
				minlength: \"Su contrase&ntilde;a debe contener a lo menos 6 caracteres\",
				equalTo: \"Las contrase&ntilde;as no son iguales\"
			},
			email: \"Email no valido\"
		}
	});
});







</script>









</script>





	
	




";
    include ("personal/proc/consulta.php");
    $formulario_registro = html_template('formulario_cambio_contrasenia');	
 	
	$formulario_registro = str_replace("#NOMBRES#","$nombre",$formulario_registro);
	$formulario_registro = str_replace("#PATERNO#","$paterno",$formulario_registro);
	$formulario_registro = str_replace("#MATERNO#","$materno",$formulario_registro);
	$formulario_registro = str_replace("#FONO#","$fono",$formulario_registro);
	                //$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					//$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
	$formulario_registro = str_replace("#ENTIDAD_PADRE#","$entidad_padre",$formulario_registro);
	$formulario_registro = str_replace("#ENTIDAD_HIJA#","$entidad",$formulario_registro);
	
	
	
    $formulario_registro = str_replace("#MAIL#","$email",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA_ACTUAL#","<input type=\"password\" id=\"pass_actual\" name=\"pass_actual\" size=\"30\" />",$formulario_registro);
    $formulario_registro = str_replace("#CONTRASENIA2#","<input type=\"password\" id=\"pass2\" name=\"pass2\"  size=\"30\" />",$formulario_registro);
	$formulario_registro = str_replace("#CONTRASENIA#","<input type=\"password\" id=\"pass\" name=\"pass\" size=\"30\" />",$formulario_registro);
   
 
 	 
        
  }


  
  $contenido = cambio_texto($formulario_registro);
  
  
?>