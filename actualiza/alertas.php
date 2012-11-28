<?php

$tp = $_GET['tp'];

if($tp==2){
error_reporting(E_ALL);
}else{
error_reporting(E_PARSE);
}

/*
$HOST_NAME="localhost"; // por lo general es localhost puede ser otra configuracion pero depende del server 
$DB_USERNAME="root";  //usuarios con permisos en la base
$DB_PASSWORD="8764695rr"; //pass del usuario
$DATABASE="sgs"; //nombre de la base de datos 

//
$DB = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD);
*/

include("../lib/connect_db.inc.php");    
include("../lib/lib.inc.php");
include("../lib/lib.inc2.php");
include("../lib/lib.sgs.php");   
include("../lib/seguridad.inc.php");   

$id_entidad_padre = configuracion_cms('id_servicio');	
	  $query= "SELECT entidad_padre  
               FROM  sgs_entidad_padre
               WHERE id_entidad_padre='$id_entidad_padre'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($entidad_padre) = mysql_fetch_row($result);
		  

    $query= "SELECT id_usuario,nombre,paterno,id_entidad_padre,id_entidad  
           FROM  usuario";
     $result_entidad= cms_query($query)or die (error($query,mysql_error(),$php));
    while (list($id_usuario,$nombre,$paterno,$id_entidad_padre,$id_entidad) = mysql_fetch_row($result_entidad)){
    						   
    	  if($id_entidad_padre=="0" or $id_entidad=="0"){
		   
		   
		   
		    $query= "SELECT id_usuario,nombre   
                   FROM  usuario
                   WHERE id_usuario='$id_usuario'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_usuario,$nombre) = mysql_fetch_row($result)){
        						   
        		 }
				 
				 
	
	$texto_alerta .="  <tr>
                      <td align=\"left\" class=\"textos\">$nombre</td>
					  <td align=\"left\" class=\"textos\">$paterno</td> 
					  <td align=\"center\" class=\"textos\">&nbsp</td> 
                      </tr>";
					

	 		}
	
	  }
	    
	
	
	$contenido = "<table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    $texto_alerta
                  </table>";



$js .="
<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}

</style>





<script type=\"text/javascript\">

$.validator.setDefaults({
	//submitHandler: function() { alert(\"submitted!\"); }
});






$().ready(function() {

	
	// validate signup form on keyup and submit
	$(\"#form1\").validate({
		rules: {
			nombre : {
			required : true

			},
			paterno: {
			required : true

			},
			materno: {
			required : true

			},
			
			email: {
				required: true,
				email: true
			},
			id_perfil: {
				required: true
			},
			
			
			id_departamento: {
				required: true
				
			}
			
			
		},
		messages: {
			nombre: \"Ingrese su nombre\",
			paterno: \"Ingrese su Apellido Paterno\",
			materno: \"Ingrese su Apellido Materno\",
			departamento_add: \"\",
			password : {
				required: \"Ingrese su Contrase&ntilde;a\",
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




$(document).ready(function(){
	// Parametros para e id_entidad cambiara a id_departamento
   $(\"#id_entidad\").change(function () {
   		$(\"#id_entidad option:selected\").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post(\"sgs/admin_usuarios/select.php\", { elegido: elegido }, function(data){
				$(\"#id_departamento\").html(data);
				
			});			
        });
   })
	
});


</script>";


			  
				
	$html ="<html>
    <head>
    <title>$nombre_pag</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    </head>
    <link href=\"../css/sitio.css\" rel=\"stylesheet\" type=\"text/css\" />
<link href=\"../css/deuman.css\" rel=\"stylesheet\" type=\"text/css\" />




<script src=\"../js/jquery/jquery.js\" type=\"text/javascript\"></script>
<script src=\"../js/jquery/jquery.metadata.js\" type=\"text/javascript\"></script>
<script src=\"../js/jquery/jquery.validate.js\" type=\"text/javascript\"></script>
<script src=\"../js/jquery/cmxforms.js\" type=\"text/javascript\"></script>
<script src=\"../js/deuman.js\" type=\"text/javascript\"></script>
<script src=\"../js/jquery/plugin/jtip.js\" type=\"text/javascript\"></script>

$js
$css
    <body bgcolor=\"#FFFFFF\" text=\"#000000\">
    
	<form action=\"\" method=\"post\" enctype=\"multipart/form-data\" name=\"form1\" accept-charset=\"UTF-8\">
   		
   
    </form>
	
    </body>
    </html>";
?>