<div id="resident_results">
<div>
	<h3>Search results for '<?php echo $clue ?>'</h3>

	<?php
	//arrays for lists
	$res_status_list = $this->config->item('res_status_list');
	$clinic_list = $this->config->item('clinic_list');
	
	$y = 1; //counter for calendar 
	if($like_residents){
		echo "<table class=\"mother_table\">";
		echo "<tr><th class=\"num\">No.</th><th class=\"rname\">Resident Name</th><th class=\"date_picker\">Date Start</th><th class=\"status\">Status</th><th class=\"clinic_sched\">Clinics</th><th class=\"clinic_list\">Revise Schedule</th><th class=\"submit_button\">Action</th></tr>";
	    echo "</table>";
		
		foreach ($like_residents as $row) {
			$date = "date_start".$y;
			echo form_open('admin/editResidents');
			echo "<div>";
			echo "<table class=\"mother_table\">";
			echo form_hidden('r_id', $row->r_id);
			echo form_hidden('dnum', $y);
			echo "<tr><td class=\"num\">".$y."</td>";
			echo "<td class=\"rname\"><input type=\"text\" name=\"rname\" size= 30 value= \"".$row->rname."\"></td>";
			echo "<td class=\"date_picker\">";
			    require_once('calendar/classes/tc_calendar.php');
				$myCalendar = new tc_calendar($date, true, false);
	  			$myCalendar->setIcon(base_url()."calendar/images/iconCalendar.gif");
				$dd = (int)substr($row->date_start,8, 2);
		  		$mm = (int)substr($row->date_start, 5, 2);
		  		$yy = (int)substr($row->date_start, 0, 4);
	  			$myCalendar->setDate($dd, $mm, $yy);
	  			$myCalendar->setPath(base_url()."calendar/");
	  			$myCalendar->setYearInterval(2010, $this->config->item('year2'));
	  			$myCalendar->dateAllow('2010-01-01', $this->config->item('allow_date2'));
	  			$myCalendar->setDateFormat('j F Y');
	  			$myCalendar->setAlignment('left', 'bottom');
	  			$myCalendar->writeScript();
			echo "</td>";
			echo "<td class=\"status\">";
			echo form_dropdown('status', $res_status_list, $row->status);
			echo "</td><td class=\"clinic_sched\">";
			$my_clinics = explode('@', $row->clinics);
			$x = 1;//clinic number
			foreach ($my_clinics as $mc) {

				foreach ($clinic_list as $k => $v) {
					if (!strcmp($k, $mc))
						echo "Clinic ".$x.": ".$v."<br/>";
				}
				$x++;
				
			}
			echo "</td><td class=\"clinic_list\">";
			echo form_multiselect('clinics[]', $clinic_list, $my_clinics);
			echo "</td><td class=\"submit_button\">";
			echo form_submit(array('class'=>"submit"), 'EDIT', 'onClick = "return confirmEdit()"')."<br/>";
			echo form_close();
			$user_access = $this->session->userdata('user_access');
			if($user_access == 0){
				echo form_open('admin/deleteResident');
				echo form_hidden('r_id', $row->r_id);
				echo form_submit(array('class'=>"submit"), 'DELETE', 'onClick = "return confirmDelete()"');
				echo form_close();			
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
	</table>
</div>

<div>
	<h3>Add New Resident</h3>
		<?php
		echo form_open('admin/addResident');
		echo "<table class=\"mother_table\">";
		echo "<tr><th class=\"rname\">Resident Name</th><th class=\"date_picker\">Date Start</th><th class=\"status\">Status</th><th class=\"clinic_list\">Clinics</th><th class=\"submit_button\">Action</th></tr>";
		echo "<tr><td class=\"rname\"><input type=\"text\" name=\"rname\" size=\"30\"></td>";
		echo "<td class=\"date_picker\">";
			    require_once('calendar/classes/tc_calendar.php');
				$myCalendar = new tc_calendar("date_start", true, false);
	  			$myCalendar->setIcon(base_url()."calendar/images/iconCalendar.gif");
				$dd = 1;
				$mm = 1;
				//$dd = (int)substr(date("Y-m-d"),8, 2);
		  		//$mm = (int)substr(date("Y-m-d"), 5, 2);
		  		$yy = (int)substr(date("Y-m-d"), 0, 4);
	  			$myCalendar->setDate($dd, $mm, $yy);
	  			$myCalendar->setPath(base_url()."calendar/");
	  			$myCalendar->setYearInterval(2010, $this->config->item('year2'));
	  			$myCalendar->dateAllow('2010-01-01', $this->config->item('allow_date2'));
	  			$myCalendar->setDateFormat('j F Y');
	  			$myCalendar->setAlignment('left', 'bottom');
	  			$myCalendar->writeScript();		
		
		echo "</td>";
		echo "<td class=\"status\">";
		echo form_dropdown('status', $res_status_list, '1');
		echo "</td><td class=\"clinic_list\">";
		echo form_multiselect('clinics[]', $clinic_list,'');
		echo "</td><td class=\"submit_button\">";
		echo form_submit(array('class'=>"submit"), 'Add Resident');
		echo "</td></tr>";
		echo "</table>";
		echo form_close();
		?>
</div>
</div>
