<?php

include ("poll/admin/pollconfig.php");
include ("poll/admin/pollfunctions.php");


$doit = $_POST['doit'];			  
$dopoll = $_POST['dopoll'];
$pollid = $_POST['pollid'];
$deleteno = $_POST['deleteno'];
$deleteyes = $_POST['deleteyes'];
$addanswer = $_POST['addanswer'];
$modify = $_POST['modify'];
$deleteanswer = $_POST['deleteanswer'];
$deletebox = $_POST['deletebox'];
$newquestion = $_POST['newquestion'];
$addpoll = $_POST['addpoll'];



$answerarray = $_POST['answerarray'];
$deletebox = $_POST['deletebox'];
$ansid = $_POST['ansid'];
$modify = $_POST['modify'];
$deleteanswer = $_POST['deleteanswer'];
$addanswertext = $_POST['addanswertext'];
$addanswer = $_POST['addanswer'];
$deleteno = $_POST['deleteno'];

//echo "$ansid ghgg";


if($pollid!=""){
$id_contenido=$pollid;
include("lib/guarda_cuadro_perfiles.php");	
}




$id_perf = $_GET['id_perf'];

$id_colegio = $_GET['id_colegio'];

if($id_colegio!=""){
$id_contenido = $_GET['id_contenido'];
 $Sql ="DELETE FROM control_contenido_escuela
 WHERE id_contenido ='$id_contenido' and id_establecimiento=$id_colegio";

 cms_query($Sql);
  
  $domodify="modify";
  $modify="Cambiar";
  
  $pollid=$id_contenido;
  
  
 
}


if($id_perf!=""){
$id_contenido = $_GET['id_contenido'];
$Sql ="DELETE FROM control_contenido_perfil
 WHERE id_contenido ='$id_contenido' and id_perfil=$id_perf";

 cms_query($Sql);
  
   $domodify="modify";
   $modify="Cambiar";
   
   $pollid=$id_contenido;
  
  
}



while($a<11){
$a++;
$var= "answer$a";
$$var = $_POST[$var];
}


if(isset($deleteyes)){
$changesindb = cms_query("DELETE FROM poll WHERE pollid=$pollid");
$changesindb = cms_query("DELETE FROM poll_answers WHERE pollid=$pollid");

header("Location:index.php?accion=$accion");   

}
			  
  if(isset($doit)){
  

  
		$poll = explode("_", $dopoll);
		$pollid = $poll[0];
     
	      $query= "SELECT question    
                   FROM  poll
                   WHERE pollid='$pollid'";
             $result= cms_query($query) or die (error($query,mysql_error(),$php));
              list($pregunta) = mysql_fetch_row($result);
	 
          if($poll[1]=='delete')
	           {
		
		
		$contenido .="<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">&nbsp;</td>
                        </tr>
						<tr>
                      <tr>
                          <td align=\"center\" class=\"textos\"><img src=\"images/atencion.gif\" alt=\"\" border=\"0\"></td>
                        </tr>
						<tr>
                          <td align=\"center\" class=\"textos\">Esta seguro de borrar <br><b>\"$pregunta\"</b></td>
                        </tr>
						<tr>
                          <td align=\"center\" class=\"textos\">&nbsp;</td>
                        </tr>
                      </table>
					  <table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                       <tr>
                         <td align=\"center\" class=\"textos\">
						 <input name='deleteyes' type='submit' value='Borrar' class=\"boton\"></td>
						 <td align=\"center\" class=\"textos\">&nbsp;</td>
						 <td align=\"center\" class=\"textos\">
						 <input name='deleteno' type='submit' value='Cancelar' class=\"boton\">	
  					     <input name='pollid' type='hidden' value='".$pollid."'>
						 </td>
                       </tr>
                     </table>";
					 
					 
					 
					 
	             }elseif($poll[1]=='edit'){
			         
					$id_contenido=$pollid;
					
					include("lib/cuadro_perfiles.php");
                    include ("poll/admin/edit.php");
					
				  
			   
			      }elseif($poll[1]=='activate'){
			       
				  activatepoll($pollid);
				  header("Location:index.php?accion=$accion");   
			   
			      }

   }else{
	$id_contenido=$pollid;



	 include("lib/cuadro_perfiles.php");
     include("poll/admin/formulario.php");
     
   }


$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
$answer5 = $_POST['answer5'];
$answer6 = $_POST['answer6'];
$answer7 = $_POST['answer7'];
$answer8 = $_POST['answer8'];
$answer9 = $_POST['answer9'];
$answer10 = $_POST['answer10'];


	   if(isset($addpoll)){
	      addpoll($newquestion, $answer1, $answer2, $answer3, $answer4, $answer5, $answer6, $answer7, $answer8, $answer9, $answer10);
	   header("Location:index.php?accion=$accion"); 
	   $id_contenido=$pollid;
	    include("lib/guarda_cuadro_perfiles.php");
	   }
	   
	   

if(isset($modify) || isset($deleteanswer) || isset($addanswer))
{
	
	if(isset($modify))
	{$domodify='modify';$newanswer=null;}
	
	if(isset($deleteanswer))
	{$domodify='delete';$newanswer=null;}
	
	if(isset($addanswer))
	{
		if($addanswertext)
		{$newanswer = trim($addanswertext);}
		else
		{$newanswer=null;}
		
		if($newanswer==null)
		{
		//return firstscreen();
		}
		else
		{$domodify='add';}
		
	}
	modifypoll($pollid,$answerarray,$ansid,$deletebox,$domodify,$newanswer);
	$id_contenido=$pollid;
	
	//$cuadro_perfiles_colegios="";
	$id_contenido=$pollid;
	//include("lib/cuadro_perfiles.php");
	$answerarray =null;
	include ("poll/admin/edit.php");

		
}



?>