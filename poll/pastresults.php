<?php


/***************************************************************************
			MP Poll
			Morgan Andersson @ Morgande Produsctions (www.morgande.com)
			Free to use, a link to www.morgande.com must be present.
***************************************************************************/

//include "poll/admin/pollconfig.php";
//include "admin/polldb.php";

	$questionquery = cms_query("SELECT * FROM poll WHERE pollid=$pollid") or die("$MSG_DIE -1 QR-$query");
	$answerquery = cms_query("SELECT * FROM poll_answers WHERE pollid=$pollid") or die("$MSG_DIE -2 QR-$query");
	
	

	while($questrow = mysql_fetch_array($questionquery))
	{
		$question = $questrow['question'];
	}

$contenido .="<br><br><table width='300'  align='center' border='0' cellspacing='0' cellpadding='0' class=\"cuadro\">";
$contenido .="<tr ><td class =\"textos\" align='center'><strong>";

$contenido .="</strong></td></tr>";
$contenido .="<tr><td class=\"cabeza_rojo\"><b>";
$contenido .=$question."&nbsp</b></td></tr><tr bgcolor='#F8F8F8'\"><td align=\"center\" class=\"textos\">";

				$resultquery = cms_query("SELECT * FROM poll_answers WHERE pollid=$pollid");
				
				while($resultrow = mysql_fetch_array($resultquery))
				{

					$contenido .="<table width='90%' border='0' cellspacing='0' cellpadding='0'>";
					$contenido .="<tr bgcolor='#F8F8F8' ><td align=\"left\" class =\"textos\">";
					$contenido .="<B>".$resultrow['answers']."</B><BR>";
					
            if($resultrow['result']>0)
			{
				$contenido .="<img src='poll/blue.gif' width='".$resultrow['result']."' height='10'>";
            }
			$contenido .=$resultrow['result']."% (".$resultrow['votes']." votes)";
            $contenido .="</td></tr></table>";
			
			}

	$contenido .="</td></tr></table>";
	
	
	
	
?>