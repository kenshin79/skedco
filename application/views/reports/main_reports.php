<div id="reports_main">
	<div>
	<?php
	  $date_default = date("Y-m-d");
	  require_once('calendar/classes/tc_calendar.php');
	 echo "<table>";
	 echo form_open('', array('name'=>"reports"));
	 echo "<tr><td>FROM:<br/>"; 
	 
	  $myCalendar = new tc_calendar("date1");
	  $myCalendar->setIcon(base_url()."calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date_default))
            , date('m', strtotime($date_default))
            , date('Y', strtotime($date_default)));
	  $myCalendar->setPath(base_url()."calendar/");
	  $myCalendar->setYearInterval($this->config->item('year1'), $this->config->item('year2'));
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date1', 'date2', $date_default);
	  $myCalendar->writeScript();	  
	 echo "</td><td>TO:<br/>"; 
	  $myCalendar = new tc_calendar("date2");
	  $myCalendar->setIcon(base_url()."calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d', strtotime($date_default))
           , date('m', strtotime($date_default))
           , date('Y', strtotime($date_default)));
	  $myCalendar->setPath(base_url()."calendar/");
	  $myCalendar->setYearInterval($this->config->item('year1'), $this->config->item('year2'));
	  $myCalendar->setAlignment('left', 'bottom');
	  $myCalendar->setDatePair('date1', 'date2', $date_default);
	  $myCalendar->writeScript();	  
	echo "</td></tr>";
	echo form_close();
	echo "<tr><td colspan = \"2\">SELECT REPORT<br/>";
	$a = "document.reports";
	echo "<button onclick = \"getCharts(".$a.".date1.value, ".$a.".date2.value)\">Charts List</button><br/>";
	echo "<button onclick = \"getOpdCensus(".$a.".date1.value, ".$a.".date2.value)\">OPD Census</button><br/>";
	echo "</td></tr>";
	echo form_open('', array('name'=>"res_report"));
	echo "<tr><td colspan =\"2\">Resident Census<br/>";
	echo "<select name=\"myresident\">";
	foreach($residents_list as $rl){
		echo "<option value = \"".$rl->r_id."\">".$rl->rname."</option>";		
	}
	echo "</select><br/>";
	echo form_close();
	$b = "document.res_report.myresident";
	
	echo "<button onclick = \"getResidentCensus(".$a.".date1.value, ".$a.".date2.value, ".$b.".options[".$b.".selectedIndex].value)\">Census</button></td>";
	echo "</td></tr></table>";	
	?>
	</div>

</div>

<div id = "show_reports"></div>