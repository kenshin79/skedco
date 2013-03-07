<?php
echo "<h2>Schedules for ".date("l : F j, Y", strtotime($date))."</h2>"; 
?>
<table class="mother_table">
	<tr><th colspan="14"><?php echo $day." ".date('F j, Y', strtotime($date)); ?></th></tr>
	<tr><th class="rname">AM CLINIC</th><th colspan="6">DECKING</th><th class="rname">PM CLINIC</th><th colspan="6">DECKING</th></tr>
	<tr><th class="rname" id = "tally1">RESIDENTS</th><th class = "tally">NP</th><th class="tally">PO</th><th class="tally" >CM</th><th class="tally">C</th><th class="tally">Sched</th><th class="tally">Attend</th><th class="rname">RESIDENTS</th><th class="tally" id="tally2">NP</th><th class="tally">PO</th><th class="tally">CM</th><th class="tally">C</th><th class="tally">Sched</th><th class="tally">Attend</th></tr>
	<tr><th colspan="7" style="margin: 0px;">
	<table class="tally_table">
		<?php
		$amtotal = 0;
		$amnp_total = 0;
		$ampo_total = 0;
		$amcm_total = 0;
		$amc_total = 0;
		$amsched_total = 0;
		$amatt_total = 0;
	    foreach ($residentsAM as $am){
			echo "<tr class=\"clickable\"><th class=\"rname\" onclick = \"showAppointments('0', '".$date."', '".$am->r_id."')\">";
			echo $am->rname;
			$tally = "np_".$am->r_id;
			echo "</th><th class=\"tally\">".$$tally."</th>"; //NP
			$amnp_total = $amnp_total + $$tally;
			$tally = "po_".$am->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//PO
			$ampo_total = $ampo_total + $$tally;
			$tally = "comx_".$am->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//COMX
			$amcm_total = $amcm_total + $$tally;
			$tally = "cont_".$am->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//CONT
			$amc_total = $amc_total + $$tally;			
			$tally = "total_".$am->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//Total scheduled
			$amsched_total = $amsched_total + $$tally;
			$tally = "attend_".$am->r_id;
			echo "<th class=\"tally\">".$$tally."</th></tr>";//Attended
			$amatt_total = $amatt_total + $$tally;
		}
		echo "<tr><td class=\"rname\">TOTALS</td><td>".$amnp_total."</td><td>".$ampo_total."</td><td>".$amcm_total."</td><td>".$amc_total."</td><td>".$amsched_total."</td><td>".$amatt_total."</td></tr>";
		?>
		
	</table></th>		
	<th colspan="7" style="margin:0px;">
	<table class="tally_table">
		<?php
		$pmtotal = 0;
		$pmnp_total = 0;
		$pmpo_total = 0;
		$pmcm_total = 0;
		$pmc_total = 0;
		$pmsched_total = 0;
		$pmatt_total = 0;
		foreach ($residentsPM as $pm){
			echo "<tr class=\"clickable\"><th class=\"rname\" onclick = \"showAppointments('1', '".$date."', '".$pm->r_id."')\">";
			echo $pm->rname;
			$tally = "np_".$pm->r_id;
			echo "</th><th class=\"tally\">".$$tally."</th>"; //NP
			$pmnp_total = $pmnp_total + $$tally;			
			$tally = "po_".$pm->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//PO
			$pmpo_total = $pmpo_total + $$tally;
			$tally = "comx_".$pm->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//COMX
			$pmcm_total = $pmcm_total + $$tally;			
			$tally = "cont_".$pm->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//CONT
			$pmc_total = $pmc_total + $$tally;					
			$tally = "total_".$pm->r_id;
			echo "<th class=\"tally\">".$$tally."</th>";//Total scheduled
			$pmsched_total = $pmsched_total + $$tally;			
			$tally = "attend_".$pm->r_id;
			echo "<th class=\"tally\">".$$tally."</th></tr>";//Attended
			$pmatt_total = $pmatt_total + $$tally;		
				
		}
		echo "<tr><td class=\"rname\">TOTALS</td><td>".$pmnp_total."</td><td>".$pmpo_total."</td><td>".$pmcm_total."</td><td>".$pmc_total."</td><td>".$pmsched_total."</td><td>".$pmatt_total."</td></tr>";
		
		?>
	</table></th></tr>
	</table>
