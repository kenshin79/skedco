<?php
	if ($charts_list){
		echo "<h3>Appointments for period ".date('F j, Y', strtotime($date1))." to ".date('F j, Y', strtotime($date2)).".</h3>";
		
		$y = 1;
		$period_list = $this->config->item('period_list');
		echo "<table>";
		echo "<tr><th>No.</th><th>Date of Appointment</th><th>Case Number</th><th>Patient</th><th>Resident in Charge</th></tr>";

		foreach ($charts_list as $cl){
			echo "<tr><td>".$y."</td>";
			echo "<td>".date('m/d/Y', strtotime($cl->app_date))."-".$period_list[$cl->period]."</td>";
			echo "<td>".$cl->casenumber."</td>";
			echo "<td>".strtoupper($cl->pname)." ".compute_age($cl->app_date, $cl->birthdate)."/".$cl->sex."</td>";
			echo "<td>".$cl->rname."</td></tr>";
			$y++;
		
		}
		echo "</table>";
	}
	else{
		echo "<h3>No Appointments from ".$date1." to ".$date2.".</h3>";
		
	}
?>