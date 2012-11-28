<?php
/***************************************************************************************
								VIEW POLL TO MODIFY
***************************************************************************************/

function editpoll($dopoll)
{
	$poll = explode("_", $dopoll);
	
	$pollid = $poll[0];
	
	if($poll[1]=='delete')
	
	{
	
	
		$conten .="<font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";
		$conten .="<input name='deleteyes' type='submit' value='Borrar'  class=\"textos\">";		// Delete poll button
		$conten .="o";
		$conten .="<input name='deleteno' type='submit' value='Atras' class=\"textos\">";		// go back button
		$conten .="<input name='pollid' type='hidden' value='".$pollid."'>";
		$conten .="</font></form>";
		$conten .="<font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";
		
		return($conten);
	}
	if($poll[1]=='edit')
	{
	
		$conten .="</font>";
		$conten .="<form name='modifypollform' method='post'>";
		$conten .="<font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";

		$query = cms_query("SELECT * FROM poll WHERE pollid=$pollid");
		
		while($row = mysql_fetch_array($query))
		{
			$question = $row['question'];
		}		
		
		$query = cms_query("SELECT * FROM poll_answers WHERE pollid='$pollid' ORDER BY answerid ASC");

		while($therow = mysql_fetch_array($query))
		{
			$answerid = $therow['answerid'];
			$answer = $therow['answers'];
			$answerarray[] = $answerid."_".$answer;
		}
		$counter=1;

		$conten .="<div align=center>";
		$conten .="<h3>".$question."</h3></div>";
		$conten .="<table width=100% border=0 cellspacing=0 cellpadding=2>";

		foreach ( $answerarray as $val )
		{
			$data = explode("_", $val);
	
			$answerid = $data[0];
			$answer = $data[1];

		$conten .="<tr>";
		$conten .="<td><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";
		$conten .="Answer&nbsp;".$counter.":";
		$conten .="</font></td>";
		$conten .="<td><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";
		$conten .="<input name='answerarray[]' type='text' value='".$answer."'>";
		$conten .="</font></td>";
		$conten .="<td bgcolor='bfbfbf'><font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";
		$conten .="<input name='deletebox' type='radio' value='".$answerid."' checked>";		// radiobutton for delete answer
		$conten .="</font></td></tr>";
		$conten .="<input name='ansid[]' type='hidden' value='".$answerid."'>";

		$counter++;
		}
		$conten .="<tr><td colspan=2><input name=modify type=submit value='Make Changes'></td>
					<td bgcolor=bfbfbf><input name=deleteanswer type=submit value=Delete></td></tr>"; // delete answer button
		$conten .="<tr><td colspan=3>&nbsp;</td></tr>";
		$conten .="<tr><td colspan=2 bgcolor=cfcfcf><input name=addanswertext type=text></td>
					<td bgcolor=cfcfcf><input name=addanswer type=submit value='Add to poll'></td></tr>"; // add to poll button
        $conten .="</table>";
        
		$conten .="<div align=center>";
		$conten .="<br><input name='deleteno' type='submit' value='Cancel'>"; // Cancel button
		$conten .="</div>";
		
		$conten .="<input name='pollid' type='hidden' value='".$pollid."'>";
        $conten .="</font>";
		$conten .="<font size='1' face='Verdana, Arial, Helvetica, sans-serif'>";
	}
	elseif($poll[1]=='activate')
	{
		activatepoll($pollid);
	}
}

/***************************************************************************************
									 ACTIVATE POLL
***************************************************************************************/

function activatepoll($pollid)
{
	$changesindb = cms_query("UPDATE poll SET active='no' WHERE active='yes'");
	$changesindb = cms_query("UPDATE poll SET active='yes' WHERE pollid=$pollid");
	
}

/***************************************************************************************
									 DELETE POLL
***************************************************************************************/

function deletepoll($pollid)
{
		$changesindb = cms_query("DELETE FROM poll WHERE pollid=$pollid");
		$changesindb = cms_query("DELETE FROM poll_answers WHERE pollid=$pollid");
		
}

/***************************************************************************************
									 EDIT/MODIFY POLL
***************************************************************************************/

function modifypoll($pollid,$answerarray,$ansid,$deletebox,$domodify,$newanswer)
{
		$counter1 = 1;
		$counter2 = 1;
		
		foreach ( $answerarray as $val )
		{
			$answer[$counter1] = $val;
			$counter1++;			
		}
		foreach($ansid as $val2)
		{
			$answerid[$counter2] = $val2;
			$counter2++;
		}
		
		if($domodify=='modify')
		{
			for($counter=1;$counter<$counter1;$counter++)
			{
				$changesindb = cms_query("UPDATE poll_answers SET answers='$answer[$counter]' WHERE answerid=$answerid[$counter]");
			}
		}
		if($domodify=='delete')
		  {
				$changesindb = cms_query("DELETE FROM poll_answers WHERE answerid=$deletebox");
		  }
		if($domodify=='add')
		  {
			$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$newanswer')");
		  }
		
}

/***************************************************************************************
									 ADD POLL
***************************************************************************************/

function addpoll($newquestion, $answer1, $answer2, $answer3, $answer4, $answer5, $answer6, $answer7, $answer8, $answer9, $answer10)
{
	if(!$newquestion || !$answer1 || !$answer2)
	{
		
	}
	else
	{
		$pollid= new_uid();

		$newpollquest = cms_query("INSERT INTO poll (pollid,question) VALUES ('$pollid','$newquestion')");
		
		/*
		$querypoll = cms_query("SELECT * FROM poll WHERE question='$newquestion'");

		while($pollrow=mysql_fetch_array($querypoll))
		{
			$pollid = $pollrow['pollid'];
		}
		
		*/
		if($answer1 && $answer2)
		{	
		$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer1')");
		$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer2')");
		}
		if($answer3)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer3')");}
		if($answer4)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer4')");}
		if($answer5)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer5')");}
		if($answer6)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer6')");}
		if($answer7)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer7')");}
		if($answer8)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer8')");}
		if($answer9)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer9')");}
		if($answer10)
		{$newpollanswer = cms_query("INSERT INTO poll_answers (pollid,answers) VALUES ('$pollid','$answer10')");}
	//return firstscreen();
	
	 
	}
	
	
}
?>