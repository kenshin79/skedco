<?php
	if ($resident_census){
		echo "<h3>";
		foreach ($res_name as $rn)
			echo $rn->rname;
		echo ": Census for period ".date("F j, Y", strtotime($date1))." to ".date("F j, Y", strtotime($date2)).".</h3>";
		
		if($resident_count){


			foreach($resident_count as $rc){
			$total_type = $rc->new + $rc->comx + $rc->preop + $rc->cont; 	
			if ($total_type){		
			echo "<table id=\"res1\">";				
			echo "<tr><th>Type</th><th>Count</th><th>%Total</th></tr>";	
			echo "<tr><td>New Primary</td><td>".$rc->new."</td><td>".round($rc->new/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Co-managed</td><td>".$rc->comx."</td><td>".round($rc->comx/$total_type*100, 2)."</td></tr>";
			echo "<tr><td>Pre-operative</td><td>".$rc->preop."<td>".round($rc->preop/$total_type*100, 2)."</td></td>";
			echo "<tr><td>Continuity</td><td>".$rc->cont."</td><td>".round($rc->cont/$total_type*100, 2)."</td></tr>";
			echo "<tr><th>TOTAL</th><th>".$total_type."</th><th>100%</th></tr>";
			echo "</table>";
			}
			$total_status = $rc->attend + $rc->unattend + $rc->unsched;
			echo "<table id=\"res2\">";
			echo "<tr><th>Status</th><th>Count</th><th>%Total</th></tr>";
			echo "<tr><td>Attended</td><td>".$rc->attend."</td><td>".round($rc->attend/$total_status*100, 2)."</td></tr>";
			echo "<tr><td>Unattended</td><td>".$rc->unattend."</td><td>".round($rc->unattend/$total_status*100, 2)."</td></tr>";
			echo "<tr><td>Unscheduled</td><td>".$rc->unsched."</td><td>".round($rc->unsched/$total_status*100, 2)."</td></tr>";
			echo "<tr><th>TOTAL</th><th>".$total_status."</th><th>100%</th></tr>";
			echo "</table>";			
			
			}
		}
		
		
		$period_list = $this->config->item('period_list');
		$y = 1;
		echo "<table id=\"res3\">";
		echo "<tr><th>No.</th><th>Date of Appointment</th><th>Patient<th>Case Number</th><th>Type</th><th>Source</th><th>Status</th></tr>";
		$type_list = $this->config->item('type_list');
		$source_list = $this->config->item('source_list');
		$app_status_list = $this->config->item('app_status_list');
		foreach ($resident_census as $rc){
			echo "<tr><td>".$y."</td>";
			echo "<td>".date('m/d/Y', strtotime($rc->app_date))." - ".$period_list[$rc->period]."</td>";
			echo "<td>".strtoupper($rc->pname)." ".compute_age($rc->app_date, $rc->birthdate)."/".$rc->sex."</td>";				
			echo "<td>".$rc->casenumber."</td>";
			echo "<td>".$type_list[$rc->type]."</td>";
			echo "<td>".$source_list[$rc->source]."</td>";
			echo "<td>".$app_status_list[$rc->status]."</td></tr>";
			$y++;
		
		}
		echo "</table>";
	}
	else{
		echo "<h3>";
		foreach ($res_name as $rn)
			echo $rn->rname;
		echo " - No Appointments from ".date('m/d/Y', strtotime($date1))." to ".date('m/d/Y', strtotime($date2)).".</h3>";
		
	}
?>