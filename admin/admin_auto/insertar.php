<?php
$tbl= $_GET['tbl'];

$pk = $_POST['pk'];
$txt = $_POST['txt'];
$help = $_POST['help'];
$envia_mail = $_POST['envia_mail'];
$ingresado_envia_mail  = $_POST['ingresado_envia_mail'];
$actualiza_envia_mail  = $_POST['actualiza_envia_mail'];
$borrar_envia_mail  = $_POST['borrar_envia_mail'];
$email_aviso = $_POST['email_aviso'];

  $query= "SELECT id_auto_admin   
           FROM  auto_admin
           WHERE tabla='$tbl'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (!list($id_auto_admin) = mysql_fetch_row($result)){
			
			
            $qry_insert="INSERT INTO auto_admin
                        (id_auto_admin,tabla,accion,tabla_relacion,help,ingresado_envia_mail,actualiza_envia_mail,borrar_envia_mail,email_aviso )
                values  (null,'$tbl','$accion','$tabla_relacion','$help','$ingresado_envia_mail','$actualiza_envia_mail','$borrar_envia_mail','$email_aviso')";
            
        
              $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");	 
		
		 $id_auto_admin = mysql_insert_id();
				 
					 
 $sql = "SELECT * FROM $tbl";
  $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);


   
 for ($i = 0; $i < $num_filas; $i++){
    $nom_campo = mysql_field_name($qry,$i);
	$flag      = mysql_field_flags($qry,$i);
	$largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);

	    						   
$campo_select="sel_$nom_campo";
//echo $campo_select."<br>";
$var=$_POST[$campo_select];	

if($var==8){

	if(!is_dir("images/sitio/sistema/$tbl")){
		mkdir("images/sitio/sistema/$tbl");
	}
	
	if(!is_dir("images/sitio/sistema/$tbl/$nom_campo")){
		mkdir("images/sitio/sistema/$tbl/$nom_campo");
	}
}
$var2 = "checkbox_$nom_campo";
$existe_listado= $_POST[$var2];

$var2 = "unic_$nom_campo";
$unico= $_POST[$var2];

$var2 = "xml_$nom_campo";
$xml= $_POST[$var2];


 if($nom_campo==$pk){
 	$campos_pk_txt ="1";
 }else{
 	$campos_pk_txt ="0";
 
 }
 
 if($nom_campo==$txt){
 	$campos_pk_txt .=",1";
 }else{
 	$campos_pk_txt .=",0";
 
 }

$qry_insert="INSERT INTO auto_admin_campo( id_campo,campo,id_tipo_campo,relacion,id_auto_admin,js,carpeta,existe_listado,pk,txt,help,unic,xml,txt_xml)
 values (null,'$nom_campo','$var','','$id_auto_admin','','','$existe_listado',$campos_pk_txt,'$help','$unico','$xml','$txt_xml')";              
                $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
				
}
		echo "<script>alert('La configuración de la tabla fue creada satisfactoriamente'); document.location.href='index.php?accion=$accion&tbl=$tbl&edit=ok';</script>\n";
	 			 		   
		 }else{
	
		 	
		 	$Sql ="UPDATE auto_admin 
		 		   SET tabla_relacion ='$tabla_relacion',
				   ingresado_envia_mail='$ingresado_envia_mail',
				   actualiza_envia_mail='$actualiza_envia_mail',
				   borrar_envia_mail ='$borrar_envia_mail',
				   email_aviso='$email_aviso', 
				   help='$help'
		 		   WHERE id_auto_admin ='$id_auto_admin'";
		 	
//		 		echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
		 		   
		 		 
		 					 
 $sql = "SELECT * FROM $tbl";
  $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);

     
 for ($i = 0; $i < $num_filas; $i++){
 	
    $nom_campo = mysql_field_name($qry,$i);
	$flag      = mysql_field_flags($qry,$i);
	$largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);

	
	 
	   
$campo_select="sel_$nom_campo";
//echo $campo_select."<br>";
$id_tipo_campo=$_POST[$campo_select];	    						   
 	 

$var2 = "checkbox_$nom_campo";
$existe_listado= $_POST[$var2]; 


$var3 = "unic_$nom_campo";
$unico= $_POST[$var3];

$var4 = "xml_$nom_campo";
$xml= $_POST[$var4];




 if($nom_campo=="$pk"){
 	$campos_pk_txt =" pk='1',";
	
	$campos_pk_txt_insert =" '1',";
	
 }else{
 	$campos_pk_txt =" pk='0',";
 	$campos_pk_txt_insert =" '0',";
	
 }
 
 if($nom_campo=="$txt"){
 	$campos_pk_txt .=" txt='1'";
	$campos_pk_txt_insert .=" '1'";
	
 }else{
 	$campos_pk_txt .=" txt='0'";
	$campos_pk_txt_insert .=" '0'";
 
 }
 

 
 
 $id_tabla=id_tabla($tbl);
 
  $query= "SELECT id_campo
            FROM  auto_admin_campo
            WHERE id_auto_admin='$id_tabla' and campo='$nom_campo'";
  
 // echo "$query<br>";
      $result66= cms_query($query)or die (error($query,mysql_error(),$php));
   list($id_campo) = mysql_fetch_row($result66);
   	
  $html = str_replace("#valor_campo#",$valor_capo,$html);
  
  
 		if($id_campo !="" and $nom_campo!=""){
		
		 $Sql ="UPDATE auto_admin_campo
   	   SET 
   	   id_tipo_campo='$id_tipo_campo',
   	   id_auto_admin='$id_auto_admin',
   	   existe_listado='$existe_listado',
	   unic = '$unico',
	   xml= '$xml',
   	    $campos_pk_txt
   	   WHERE id_campo ='$id_campo'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
		}else{
		
	
//												   
		$qry_insert="INSERT INTO auto_admin_campo( id_campo,campo,id_tipo_campo,relacion,id_auto_admin,js,carpeta,existe_listado,pk,txt,help,unic,xml )
					 values (null,'$nom_campo','$id_tipo_campo','','$id_auto_admin','','','$existe_listado',$campos_pk_txt_insert,'$help','$unico','$xml')";              
                     $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
			
	
	
		}
 		


   				  
   	  
 
 
   	if($id_tipo_campo==8){

	if(!is_dir("images/sitio/sistema/$tbl")){
		mkdir("images/sitio/sistema/$tbl");
	}
	
	if(!is_dir("images/sitio/sistema/$tbl/$nom_campo")){
		mkdir("images/sitio/sistema/$tbl/$nom_campo");
	}
}
   
  
   	   
/*$qry_insert="INSERT INTO auto_admin_campo( id_campo,campo,id_tipo_campo,relacion,id_auto_admin,js,carpeta,existe_listado,pk,txt)
 values (null,'$nom_campo','$var','','$id_auto_admin','','','$existe_listado',$campos_pk_txt)";              
                $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
	
		 */
}

echo "<script>alert('Configuración creada'); document.location.href='index.php?accion=$accion&tbl=$tbl&edit=ok';</script>\n";
	 
}

	

?>