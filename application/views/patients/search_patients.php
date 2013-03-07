<div id="patient_results">
<div>
	<h3>Search results for '<?php echo $clue ?>'</h3>


	<?php

	$y = 1; //counter for calendar 
	if($like_patients){
		echo "<table class=\"mother_table\">";
		echo "<tr><th class=\"num\">No.</th><th class=\"rname\">Patient Name</th><th class=\"age\">Sex</th><th class=\"cnum\">Case Number</th><th class=\"date_picker\">Birth Date</th><th class=\"address\">Address</th><th class=\"submit_button\">Action</th></tr>";
		echo "</table>";		
		
		foreach ($like_patients as $row) {
			$date = "birthdate".$y;
			$formname = "editP".$y;
			echo "<table class=\"mother_table\">";			
			echo form_open('', array('name'=>$formname));

			echo "<tr><td class=\"num\">".$y."</td>";
			echo "<td class=\"rname\"><input type=\"text\" name=\"pname\" size= 30 value= \"".strtoupper($row->pname)."\"></td>";
			echo "<td class=\"age\">".form_dropdown('sex', array('M'=>"Male", 'F'=>"Female"), $row->sex)."</td>";
			echo "<td class=\"cnum\"><input type=\"text\" name=\"casenumber\" size=\"10\" value=\"".$row->casenumber."\"></td>";
			echo "<td class=\"date_picker\">";
			    require_once('calendar/classes/tc_calendar.php');
				$myCalendar = new tc_calendar($date, true);
	  			$myCalendar->setIcon(base_url()."calendar/images/iconCalendar.gif");
				$dd = (int)substr($row->birthdate,8, 2);
		  		$mm = (int)substr($row->birthdate, 5, 2);
		  		$yy = (int)substr($row->birthdate, 0, 4);
	  			$myCalendar->setDate($dd, $mm, $yy);
	  			$myCalendar->setPath(base_url()."calendar/");
	  			$myCalendar->setYearInterval($this->config->item('year1_bday'), $this->config->item('year2'));
	  			$myCalendar->dateAllow($this->config->item('allow_date1_bday'), $this->config->item('allow_date2'));
	  			$myCalendar->setDateFormat('j F Y');
	  			$myCalendar->setAlignment('left', 'bottom');
	  			$myCalendar->writeScript();
			echo "</td>";
			echo "<td class = \"address\"><textarea  name=\"address\" cols = 15 rows = 3 >".$row->address."</textarea></td>"; 
			echo form_close();
			echo "<td class=\"submit_button\">";
			$a = "document.".$formname;
			$b = "document.".$formname.".sex.selectedIndex";			
			echo "<button onclick = \"editPatient('".$row->p_id."', '".$clue."', ".$a.".pname.value, ".$a.".sex.options[".$b."].value, ".$a.".casenumber.value, ".$a.".$date.value, ".$a.".address.value)\">SAVE</button>";
			$user_access = $this->session->userdata('user_access');
			if($user_access == 0){
				echo "<button onclick = \"deletePatient('".$row->p_id."', '".$clue."')\">DELETE</button>";
			}	
			echo "</td></tr>";
			echo "</table>";
			
			$y++;//increment calendar counter
		}
	}
	else{
		echo "No Results for '".$clue."'.";		
	}
?>
</div>
<div>
	<h3>Add New Patient</h3>
		<?php
		echo form_open('admin/addPatient');
		echo "<table class=\"mother_table\">";
		echo "<tr><th class=\"rname\">Patient Name</th><th class=\"age\">Sex</th><th class=\"cnum\">Case Number</th><th class=\"date_picker\">Birth Date</th><th class = \"address\">Address</th><th class=\"submit_button\">Action</th></tr>";
		echo "<tr><td class=\"rname\"><input type=\"text\" name=\"pname\" size=\"20\"></td>";
		echo "<td class=\"sex\">".form_dropdown('sex', array('M'=>"Male", 'F'=>"Female"), 'M')."</td>";
		echo "<td><input type=\"text\" name=\"casenumber\" size=\"12\"></td>";
		echo "<td class=\"date_picker\">";
			    require_once('calendar/classes/tc_calendar.php');
				$myCalendar = new tc_calendar("birthdate", true);
	  			$myCalendar->setIcon(base_url()."calendar/images/iconCalendar.gif");
				$dd = (int)substr(date("Y-m-d"),8, 2);
		  		$mm = (int)substr(date("Y-m-d"), 5, 2);
		  		$yy = (int)substr(date("Y-m-d"), 0, 4);
	  			$myCalendar->setDate($dd, $mm, $yy);
	  			$myCalendar->setPath(base_url()."calendar/");
	  			$myCalendar->setYearInterval($this->config->item('year1_bday'), $this->config->item('year2'));
	  			$myCalendar->dateAllow($this->config->item('allow_date1_bday'), $this->config->item('allow_date2'));
	  			$myCalendar->setDateFormat('j F Y');
	  			$myCalendar->setAlignment('left', 'bottom');
	  			$myCalendar->writeScript();		
		echo "</td>";
		echo "<td class = \"address\"><textarea name=\"address\" cols = 15 rows = 3 ></textarea></td>"; 
		echo "<td class=\"submit_button\">";
		echo form_submit(array('class'=>"submit"), 'Add Patient');
		echo "</td></tr>";
		echo "</table>";
		echo form_close();
		?>
</div>
</div>