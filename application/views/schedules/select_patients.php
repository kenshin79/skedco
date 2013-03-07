<div id="search_addapp">
	<?php
	if($like_patients){
		echo "<h3>Search results for '".$clue."'</h3>";
		echo "<table class=\"tally_table2\">";
		echo "<tr><th>No.</th><th>Patient Name</th><th>Case Number</th><th>Age/Sex</th><th>Address</th><th>Schedule Status</th></tr>";

		$y = 1;
		foreach ($like_patients as $row){
			$sched_status = 0;
			echo "<tr onclick = \"pickPatient('".$period."', '".$row->p_id."', '".$r_id."', '".$date."' )\"><td>".$y."</td><td>".strtoupper($row->pname)."</td><td>".$row->casenumber."</td><td>".compute_age(date("Y-m-d"), $row->birthdate)."/".$row->sex."</td><td>".$row->address."</td>";
			echo "<td>";
			foreach($p_list as $pl){
				if ($row->p_id == $pl->p_id)
					$sched_status = 1;
			}
			if ($sched_status == 1){
				echo "Scheduled";
			}	
			else {
				echo "Not Scheduled";	
			}
			echo "</td></tr>";
			$y++;
		}
	}
	else{
		echo "<h3>No results found for '".$clue."'.</h3><br/>";
		echo "Add new patient below.";
	}
	?>
</table>
<div>
	<h3>Add New Patient</h3>
		<?php
		echo "<table>";
		echo form_open('', array('name'=>"addP"));		
		echo "<tr><th class=\"name\">Patient Name</th><th>Sex</th><th>Case Number</th><th class=\"date_picker\">Birth Date</th><th class = \"address\">Address</th><th class=\"submit_button\">Action</th></tr>";
		echo "<tr><td class=\"name\"><input type=\"text\" name=\"pname\" size=\"30\"></td>";
		echo "<td class=\"sex\">".form_dropdown('sex', array('M'=>"Male", 'F'=>"Female"), 'M')."</td>";
		echo "<td><input type=\"text\" name=\"casenumber\" size=\"12\"></td>";
		echo "<td class=\"date_picker\">";
			    require_once('calendar/classes/tc_calendar.php');
				$myCalendar = new tc_calendar("birthdate", true, false);
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
		echo "<td><textarea name=\"address\" cols = 10 rows = 3 ></textarea></td>"; 
		echo "<td class=\"submit_button\">";
		echo form_close();		
		$a = "document.addP";
		$b = "document.addP.sex.options.selectedIndex";
		echo "<button onclick = \"addSchedPatient('".$period."', '".$r_id."','".$date."', ".$a.".pname.value, ".$a.".sex.options[".$b."].value, ".$a.".casenumber.value, ".$a.".birthdate.value, ".$a.".address.value)\">ADD</button>";
		echo "</td></tr>";
		echo "</table>";

		?>
</div>	
	
	
</table>
</div>