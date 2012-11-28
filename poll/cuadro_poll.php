<?php
include("poll/conf.php");
/****************************************
*			Functions Started			*
****************************************/
$theanswer = $_POST['theanswer'];
 
$poll_submit = $_POST['poll_submit'];

$showresult= $_POST['showresult'];



function viewanswers($pollid, $question)
{
	$answerquery = cms_query("SELECT * FROM poll_answers WHERE pollid=$pollid ORDER BY answerid ASC");
	$num_answers = mysql_num_rows($answerquery);
	$counter = 1;


		while($answerrow = mysql_fetch_array($answerquery))
		{
			$pregunta .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
			<td align=\"left\" class=\"textos\"> ";
			$answerid = $answerrow['answerid'];
			$radiob = ("<input type=radio name=theanswer value=$answerid");
			if($counter==1)
			{
				$radiob = $radiob . " checked>";
			}
			else
			{
				$radiob = $radiob. ">";
			}
			$pregunta .= $radiob;
			$pregunta .= $answerrow['answers']."</td></tr>";
			$counter++;
		}
		
		return $pregunta ;
}

function calculatevote($pollid, $theanswer, $pollip,$id_usuario)
{
	$ipquery = cms_query("SELECT p.question , a.pollid  
	                        FROM poll p , poll_usuarios a 
							WHERE p.pollid ='$pollip'  AND a.id_usuario='$id_usuario'");
	$checkrows = mysql_num_rows($ipquery);
	
	if($checkrows==0)
	{
		$voted='no';
	}
	else
	{
		$voted='yes';
	}
	
	if($voted=='no')
	{
		$updateip = cms_query("UPDATE poll SET lastip='$pollip' WHERE pollid='$pollid'");
		$answerquery = cms_query("SELECT * FROM poll_answers WHERE answerid='$theanswer'");

		while($answerrow = mysql_fetch_array($answerquery))
		{
			$newvote = $answerrow['votes']+1;
		}
		
		$changesindb = cms_query("UPDATE poll_answers SET votes='$newvote' WHERE answerid='$theanswer'");
		
		
			
		
     $qry_insert="INSERT INTO poll_usuarios (id_usuario,pollid ,answerid)
                  VALUES ('$id_usuario','$pollid','$theanswer')";
      
        $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
				
		
		
		$answerquery = cms_query("SELECT * FROM poll_answers WHERE pollid=$pollid");
		$num_answers = mysql_num_rows($answerquery);
		$total=0;
	
			while($answerrow = mysql_fetch_array($answerquery))
			{
				$answer[] = $answerrow['answers'];
				$votes[] = $answerrow['votes'];
				$id[] = $answerrow['answerid'];
			}
			for($counter=0;$counter<$num_answers;$counter++)
			{
				$total=$total+$votes[$counter];
			}
			for($counter=0;$counter<$num_answers;$counter++)
			{
				if($votes[$counter]!=0)
				{
					$votecalc[] = 100/$total*$votes[$counter];
					
					if($votecalc[$counter]>=10)
					{$votetotal = substr($votecalc[$counter],0,2);}
					if($votecalc[$counter]==100)
					{$votetotal = substr($votecalc[$counter],0,3);}
					if($votecalc[$counter]<10)
					{$votetotal = substr($votecalc[$counter],0,1);}
					if($votecalc[$counter]==0)
					{$votetotal=0;}
				}
				else
				{
					$votecalc[] = 0;
					$votetotal=0;
				}
				$theid = $id[$counter];
				
				$calc = $votecalc[$counter];
	
				$changesindb = cms_query("UPDATE poll_answers SET result='$calc' WHERE answerid='$theid'");
				
				
			
				
				
		}
	}
	else
	{
		//no se agrego voto
	}
	
	return  $ress;
}



function viewresults($pollid,$question)
{
	$resultquery = cms_query("SELECT * FROM poll_answers WHERE pollid=$pollid ORDER BY answerid ASC");
		$encss = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\">
                     
                 		";	
	while($resultrow = mysql_fetch_array($resultquery))
	{
		$encss .= "<tr >
                       <td align=\"left\" class=\"textos\">".$resultrow['answers']."</td>
					   <td align=\"left\" class=\"textos\">";
		
		if($resultrow['result']>0)
		{
		
		
			$encss .= "<img src='poll/blue.gif' width=";
			$encss .= $resultrow['result'];
			$encss .= "\" height='10'>";
			$encss .= $resultrow['result'];
			$encss .= "% (".$resultrow['votes'];
			$encss .= "v)";
		}
			$encss .= "</td></tr>";
	}
$encss .="</table>";
return $encss;
}	



/***************************************************************************
			MP Poll
			Morgan Andersson @ Morgande Produsctions (www.morgande.com)
			Free to use, a link to www.morgande.com must be present.
***************************************************************************/
include "poll/admin/pollconfig.php";
//include "poll/admin/polldb.php";

$pollip = $GLOBALS['REMOTE_ADDR'];

$pollquery = cms_query("SELECT * FROM poll WHERE active='yes'");
$numrows = mysql_num_rows($pollquery);

if($numrows==0)
{
	$question = "Ninguna Encuesta Activa";
	$pollid = 0;
}
else
{
while($poll = mysql_fetch_array($pollquery))
{
	$question = $poll['question'];
	$pollid = $poll['pollid'];
}
}

$accion_encuesta ="index.php";




		   
//$encuesta .= "";

//
$encuesta .= "<form name='pollform' method='post' accion=\"$accion_encuesta\">
<table width='97%' border='0' cellspacing='1' cellpadding='0' bordercolor='$bgcolor2' class=\"cuadro\">";
$encuesta .= "<tr>";
$encuesta .= "<td class=\"cabeza_rojo\" align='center'>";

if($boldtitle==true)
{$encuesta .= "<b>";}

$encuesta .= "$question";

if($boldtitle==true)
{$encuesta .= "</b>";}

$encuesta .= "</td></tr>";

$encuesta .= "<tr >";
$encuesta .= "<td align=\"left\">";
$encuesta .= "";






 $query= "SELECT answerid  
                   FROM  poll_usuarios
                   WHERE id_usuario='$id_usuario' and pollid='$pollid'";
           $result= @cms_query($query) or die("$MSG_DIE -1 poll.php linea 204 QR-$query");
    // echo $query ;
	 
	   if(!(list($pollid2) = mysql_fetch_row($result))){
	   
                if(!isset($poll_submit) && !isset($showresult))
                {
                	$encuesta .= viewanswers($pollid, $question);
                }
                if(isset($showresult) && !isset($poll_submit))
                {
                	$encuesta .= viewresults($pollid,$question);	
                }

                if(isset($poll_submit))
                {	
                	if(!isset($theanswer))
                	{
					  //  echo "1";
					
                		$encuesta .= viewanswers($pollid, $question);
                	}
                	else
                	{
					   // echo "2";
                		$encuesta .= calculatevote($pollid, $theanswer, $pollip,$id_usuario);
                		$encuesta .= viewresults($pollid, $question);
                	}
	
                }
	   
	   
	   
	   if(!isset($poll_submit) && !isset($showresult))
{

     $boton = "<input name='poll_submit' type=\"submit\" value='Votar' class=\"boton\">";		// Vote Button

}
	   
	   
	   }else{
	   
	                   $encuesta .= calculatevote($pollid, $theanswer, $pollip,$id_usuario);
                		$encuesta .= viewresults($pollid, $question);
	   
	   }
		   



    
$encuesta .= $boton2;
 
    $encuesta .= "</td></tr>
	<tr ><td align=\"center\" bgcolor=\"#f8f8f8\">$boton </td></tr> 
	<tr><td  align=\"center\"  bgcolor=\"#f8f8f8\">";
	$encuesta .= "<a href='index.php?accion=$accion_poll&act=1'>
	               Ver otras Encuestas</a>";
  
   $encuesta .= "</td></tr></table></form>";
		   
		   
		   
		$poll=$encuesta;   
	$contenido = $encuesta;

?>