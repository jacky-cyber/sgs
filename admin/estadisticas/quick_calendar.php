<?php
$accion = $_GET['accion'];
$id_u = $_GET['id'];

$id_accion = $_GET['id_accion'];

/*
 * Quick Calendar Using PHP and AJAX
 * Copyright (C) 2005-2007
 * Version 1.1;
 * Last modified: 23 Jan 2007
 * Author: Bernard Peh
 * Email: bpeh@sitecritic.net
 * Website://web-developer.sitecritic.net/
 * File Name: quick_calendar.php
 *
 * LICENSE: 
 * This is my contribution back to the open source community. You may modify the codes according 
 * to your needs but please keep this section intact.
 * 
 * DESCRIPTION:
 * Generate a simple calendar that can integrate seamlessly into any system with minimal 
 * installation. You must be running be running PHP 4 at the minimal. 
 * 
 * SPECIAL THANKS TO FRIENDS FROM EVOLT.ORG
 * Adam Taylor, kirk837
 *
 * INSTALLATION:
 * 1. Save the code in a file call quick_calendar.php. Then Insert this file into anywhere where 
 * you want the calendar to appear. Use:
 *
 *      require_once('quick_calendar.php');
 *
 *		or if you save the file elsewhere, require_once('dir_path/quick_calendar.php')
 *
 * 2. Create a table in your database. If you are using your own table, you need to map the fields
 * appropriately.
 *
 * CREATE TABLE `calendar` ( 
 * `id` INT NOT NULL AUTO_INCREMENT ,
`* day` VARCHAR( 2 ) NOT NULL ,
 * `month` VARCHAR( 2 ) NOT NULL ,
 * `year` VARCHAR( 4 ) NOT NULL ,
 * `link` VARCHAR( 255 ) NOT NULL ,
 * `desc` TEXT NOT NULL ,
 * PRIMARY KEY ( `id` ) 
 * );
 *
 * 3. Configure the db and path access below. Use any db of your choice. You can also configure 
 * the CSS to change the look and feel of the calendar.
 */

// This year
$y = date('Y');
// This month
$m = date('n');
// This Day
$d = date('j');
$today = array('day'=>$d, 'month'=>$m, 'year'=>$y);
// If user specify Day, Month and Year, reset the var
if (isset($_GET['m'])) {
	$y = $_GET['y'];
	$m = $_GET['m'];
	include ("../../lib/connect_db.inc.php");
	
/*

	$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$database = "capel_rrhh";
$dbConnect = mysql_connect($dbhost, $dbuser, $dbpass);
	
	//$dbConnect=$DB;
	if (!$dbConnect) {
   die('Could not connect: ' . mysql_error());
}
$db_selected = mysql_select_db($database, $dbConnect);
if (!$db_selected) {
   die ('db selection error : ' . mysql_error());
}
*/
}

// CONFIGURE THE DB ACCESS

/*
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$database = "capel_rrhh";
$dbConnect = mysql_connect($dbhost, $dbuser, $dbpass);

*/




// name of table
$tableName = 'calendar';

// name of css
$css_name = 'calendar';

// Location of the calendar script file from the root
$ajaxPath = 'quick_calendar.php';

// END OF CONFIGURATION. YOU CAN CHANGE THE CSS. THE OTHER CODES CAN BE KEPT AS DEFAULT IF YOU WANT.

$sql = "SELECT * FROM $tableName 
WHERE (month='$m' AND year='$y') || (month='*' AND year='$y') || (month='$m' AND year='*') || (month='*' AND year='*')";

$rs = @cms_query($sql);
$links = array(); 
while ($rw = @mysql_fetch_array($rs)) {
	extract($rw);
	$links[] = array('day'=>$day, 'month'=>$month, 'year'=>$year, 'link'=>$link, 'desc'=>$desc);
}


// if called via ajax, dont display style sheet and javascript again
if (!isset($_GET['ran'])) {
	




}


class CreateQCalendarArray {

	var $daysInMonth;
	var $weeksInMonth;
	var $firstDay;
	var $week;
	var $month;
	var $year;

	function CreateQCalendarArray($month, $year) {
		$this->month = $month;
		$this->year = $year;
		$this->week = array();
		$this->daysInMonth = date("t",mktime(0,0,0,$month,1,$year));
		// get first day of the month
		$this->firstDay = date("w", mktime(0,0,0,$month,1,$year));
		$tempDays = $this->firstDay + $this->daysInMonth;
		$this->weeksInMonth = ceil($tempDays/7);
		$this->fillArray();
	}
	
	function fillArray() {
		// create a 2-d array
		for($j=0;$j<$this->weeksInMonth;$j++) {
			for($i=0;$i<7;$i++) {
				$counter++;
				$this->week[$j][$i] = $counter; 
				// offset the days
				$this->week[$j][$i] -= $this->firstDay;
				if (($this->week[$j][$i] < 1) || ($this->week[$j][$i] > $this->daysInMonth)) {	
					$this->week[$j][$i] = "";
				}
			}
		}
	}
}

class QCalendar {
	
	var $html;
	var $weeksInMonth;
	var $week;
	var $month;
	var $year;
	var $today;
	var $links;
	var $css_name;
    var $accion;
    var $id_u;
    var $fecha;

	function QCalendar($cArray, $today, &$links, $css_name='', $accion, $id_u, $fecha) {
		$this->month = $cArray->month;
		$this->year = $cArray->year;
		$this->weeksInMonth = $cArray->weeksInMonth;
		$this->week = $cArray->week;
		$this->today = $today;
		$this->links = $links;
		$this->css = $css_name;
		$this->createHeader($accion, $id_u, $fecha);
		$this->createBody($accion, $id_u);
		$this->createFooter();
	}
	
	function createHeader($accion, $id_u, $fecha) {
  		$header = date('M', mktime(0,0,0,$this->month,1,$this->year)).' '.$this->year;
  		$nextMonth = $this->month+1;
  		$prevMonth = $this->month-1;
  		// thanks adam taylor for modifying this part
		switch($this->month) {
			case 1:
	   			$lYear = $this->year;
   				$pYear = $this->year-1;
   				$nextMonth=2;
   				$prevMonth=12;
   				break;
  			case 12:
   				$lYear = $this->year+1;
   				$pYear = $this->year;
   				$nextMonth=1;
   				$prevMonth=11;
      			break;
  			default:
      			$lYear = $this->year;
	   			$pYear = $this->year;
    	  		break;
  		}
		// --
		$this->html = "<table cellspacing='0' cellpadding='2' class='$this->css'>
		<tr>
		<th class='header'>&nbsp;
<a href=\"javascript:;\" onclick=\"displayQCalendar('$this->month','".($this->year-1)."')\" class='headerNav' title='Prev Year'><<</a></th>
     <th class='header'>&nbsp;
<a href=\"javascript:;\" onclick=\"displayQCalendar('$prevMonth','$pYear','$accion','$id_u','$fecha')\" class='headerNav' title='Prev Month'><</a></th>
<th colspan='3' class='header'>$header</th>
     <th class='header'>
<a href=\"javascript:;\" onclick=\"displayQCalendar('$nextMonth','$lYear')\" class='headerNav' title='Next Month'>>
</a>&nbsp;</th>
     <th class='header'>&nbsp;
<a href=\"javascript:;\" onclick=\"displayQCalendar('$this->month','".($this->year+1)."')\"  class='headerNav' title='Next Year'>
>></a></th>
		</tr>";
	}
	
function createBody($accion, $id_u){
		// start rendering table
		
$id_accion = $_GET['id_accion'];
		
		$this->html.= "<tr><th>Domingo</th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th></tr>";
		for($j=0;$j<$this->weeksInMonth;$j++) {
			$this->html.= "<tr>";
			for ($i=0;$i<7;$i++) {
				$cellValue = $this->week[$j][$i];
				// if today
				if (($this->today['day'] == $cellValue) && ($this->today['month'] == $this->month) && ($this->today['year'] == $this->year)) {
					$mes_m=$this->today['month'];
					$mes_m = str_pad("$mes_m",2,"0",STR_PAD_LEFT);
				    $anio_m=$this->today['year'];
					$cellValue=trim($cellValue);
					$cell = "<div class='today'>
					<a href='index.php?accion=$accion&id_accion=$id_accion&id=$id_u&fecha=$anio_m-$mes_m-$cellValue'>$cellValue</a>
					</div>";
					
				}
				// else normal day
				else {
					$mes_m=$this->today['month'];
				    $anio_m=$this->today['year'];
					$cellValue=trim($cellValue);
					
					$cell = "$cellValue";
				}
				// if days with link
				foreach ($this->links as $val) {
					if (($val['day'] == $cellValue) && (($val['month'] == $this->month) || ($val['month'] == '*')) && (($val['year'] == $this->year) || ($val['year'] == '*'))) {
						
						//$cell = "<div class='link'><a href=\"{$val['link']}\" title='{$val['desc']}'>$cellValue</a></div>";
						$mes_n=$val['month'] == $this->month;
						$anio_n=$val['year'] == $this->year;
						$mes_n = str_pad("$mes_n",2,"0",STR_PAD_LEFT);
						$cellValue=trim($cellValue);
						$cell = "<div >
						<a href='index.php?accion=$accion&id_accion=$id_accion&id=$id_u&fecha=$anio_n-$mes_n-$cellValue'>$cellValue</a></div>";
						break;
					}
				}	
				
				//$mes=$val['month'];
				//$anio=$val['year'];
				$mes_m = str_pad("$mes_m",2,"0",STR_PAD_LEFT);
				$cell = str_pad("$cell",2,"0",STR_PAD_LEFT);
				if($cell=="00"){
				$cell="";
				}
				$this->html.= "<td><a href=\"index.php?accion=$accion&id_accion=$id_accion&id=$id_u&fecha=$anio_m-$mes_m-$cell\" >$cell</a></td>";
			}
			$this->html.= "</tr>";
		}	
	}
	
	function createFooter() {
		$this->html .= "<tr><td colspan='7' class='footer'>
<a href=\"javascript:;\" onclick=\"displayQCalendar('{$this->today['month']}','{$this->today['year']}')\" class='footerNav'>
Hoy es {$this->today['day']} ".date('M', mktime(0,0,0,$this->today['month'],1,$this->today['year']))." {$this->today['year']}
</a></td></tr></table>";
	}
	
	function render() {
		return $this->html;
	}
}

// render calendar now
$cArray = &new CreateQCalendarArray($m, $y);
$cal = &new QCalendar($cArray, $today, $links, $css_name, $accion, $id_u, $fecha);


if (!isset($_GET['ran'])) {
	
	
		
}

$calendario = $cal->render();


if (!isset($_GET['ran'])) {
	$var2="";
}

if (isset($_GET['ran'])) {
echo $calendario;
//$ca
}



$css .="
<style type=\"text/css\">
.calendar {
	/** configure the width **/
	width:220px;
	background-color: #D6E8FF;
	border: 1px solid #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	margin:0px;
	padding:0px;
	text-align:center;
}
.calendar th {
	background-color: #FFFFCC;
	font-weight: bold;
	height: 20px;
}
.calendar .header {
	background-color: #5670B3;
	font-weight: bold;
	height: 24px;
	color: #FFFFFF;
}
.calendar .footer {
	background-color: #5670B3;
	font-weight: bold;
	font-size:0.8em;
	color: #FFFFFF;
	width:100%;
}
.calendar td {
	width: 22px;
	height: 20px;
	text-align: center;
	font-size:0.9em;
	padding: 2px;
}
.calendar .today {
	width: 18px;
	height: 16px;
	background-color: #FAD2DA;
	padding: 2px;
	border: 1px solid #000000;
}

.calendar .link {
	width: 18px;
	height: 16px;
	background-color: #D4C9EF;
	padding: 2px;
	border: 1px solid #000000;
}

.calendar a, .calendar a:link, .calendar a:hover {
	font-weight: bold;
	text-decoration: underline;
	color: #000000;

}
.calendar a.headerNav, .calendar a:link.headerNav, .calendar a:hover.headerNav {
	background-color: #5670B3;
	color: #ffffff;
}

.calendar a.footerNav, .calendar a:link.footerNav, .calendar a:hover.footerNav {
	width: 100%;
	background-color: #5670B3;
	color: #ffffff;
}
</style>";

?>