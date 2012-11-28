<?php

// Evitamos la inyeccion SQL
 





 
// Modificamos las variables pasadas por URL
foreach($_GET as $variable=>$valor){ 
 
 
   $_GET[$variable] = str_replace("'","&apos;",$_GET[$variable]);
   $_GET[$variable] = str_replace(";","&#59;",$_GET[$variable]);
   $_GET[$variable] = str_replace("\"","&#34;",$_GET[$variable]);
   $_GET[$variable] = str_replace(">","&#62;",$_GET[$variable]);
   $_GET[$variable] = str_replace(")","&#40;",$_GET[$variable]);
   
   $_GET[$variable] = str_replace("submit","s ubmit",$_GET[$variable]);
   
  
   
}
// Modificamos las variables de formularios


/* */
  //echo "Dgffgf";
  /**/
  

    
 if(configuracion_cms('trasformar_formato_html')==1){
    
   
	 if(perfil($id_sesion)!=999 and perfil($id_sesion)!=1004){
	 
	 /*  foreach($_POST as $variable=>$valor){
	  	
	    $_POST[$variable]=htmlspecialchars($_POST[$variable], ENT_QUOTES);
	    $_POST[$variable] = str_replace("submit","s ubmit",$_POST[$variable]);
	    $_POST[$variable] = str_replace(")","&#40;",$_POST[$variable]);
	    $_POST[$variable] = str_replace("'","´",$_POST[$variable]);
	  }
   	*/
     

   }else{
		 // foreach($_POST as $variable=>$valor){
		  ///$_POST[$variable]=utf8_decode($_POST[$variable]);
		  
		 // }
	  }
   
   // $_POST[$variable]= nl2br($_POST[$variable]);
}else{
		 // foreach($_POST as $variable=>$valor){
		 // $_POST[$variable]=utf8_decode($_POST[$variable]);
		  
		 // }
	  }


  foreach($_POST as $variable=>$valor){
		 $post_var .= $variable."=".$_POST[$variable]."<br>\n";
		  
		 } 
 
function sql_quote($value){
        if(get_magic_quotes_gpc())
        $value = stripslashes($value);
        if(function_exists("mysql_real_escape_string"))
                $value = mysql_real_escape_string( $value );
            else
                $value = addslashes( $value );
       
        return $value;
    } 



//function verifica_folio_usuario($folio){}
//Verificamos que cualquier folio que se ingrese corresponda al usuario en Logueado
$accion = $_GET['accion'];
if($_REQUEST['folio'] and perfil($id_sesion)!=999){
	//echo $_REQUEST['folio']." --- $id_usuario $id_sesion<br>";
	$id_sesion=session_id();
	
	
	   $query= "SELECT ssa.id_solicitud_acceso, up.funcionario
                       FROM  sgs_solicitud_acceso ssa, usuario u, usuario_perfil up
                       WHERE u.session ='$id_sesion' and u.id_perfil=up.id_perfil and u.id_usuario=ssa.id_usuario and ssa.folio='".$_REQUEST['folio']."' ";
					 
					
					  $result_seg= cms_query($query)or die (error($query,mysql_error(),$php));
                  if(!list($d_solicitud_acceso_seg,$funcionario ) = mysql_fetch_row($result_seg)){
            			
						if($funcionario==0){
							
					$query2= "SELECT  u.id_usuario
                             FROM  usuario u, usuario_perfil up
                             WHERE u.session ='$id_sesion' and u.id_perfil=up.id_perfil and up.funcionario=0 ";
					 
					
					  $result_seg2= cms_query($query2)or die (error($query2,mysql_error(),$php));
                  	   if(list($d_u ) = mysql_fetch_row($result_seg2)){
            				
						$Sql ="UPDATE usuario
                        	   SET session =''
                        	   WHERE session ='$id_sesion' ";
                        	mysql_query($Sql)or die (error($Sql,mysql_error(),$php));			   
            		
						}
						}
					}
	
	

	
}


	
?>