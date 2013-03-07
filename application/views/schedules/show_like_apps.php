
<?php
if ($like_apps){
	$user_access = $this->session->userdata('user_access');	
	echo "<h3>Scheduled Appointments on ".date('l : F j, Y ', strtotime($date))." for '".$clue."'</h3>";
	echo "<table class=\"mother_table\">";	
	echo "<tr><th>No.</th><th class=\"rname\">Patient</th><th>Case Number</th><th>Resident</th><th>Type</th><th>Source</th>";
	if ($user_access !=1){
		echo "<th>Status</th>";

	}	
	echo "<th>Diagnosis</th><th>Action</th></tr>";	
	//arrays for lists
	$type_list = $this->config->item('type_list');
	$source_list = $this->config->item('source_list');
	$period_list = $this->config->item('period_list');
	$app_status_list = $this->config->item('app_status_list');
	$y = 1;
	foreach($like_apps as $la){
		$formname = "editApp".$y;
		echo form_open('', array('name'=>$formname));		
		echo "<tr><td>".$y.":".$period_list[$la->period]."</td><td>".$la->pname." ".compute_age(date("Y-m-d"), $la->birthdate)."/".$la->sex."</td>";
		echo "<td>".$la->casenumber."</td>";
		echo "<td>".$la->rname."</td>";
		echo "<td>".form_dropdown('', $type_list, $la->type, 'disabled = "disabled"')."</td>";
		echo "<td>".form_dropdown('', $source_list, $la->source, 'disabled = "disabled"')."</td>";
	    $user_access = $this->session->userdata('user_access');
		if ($user_access !=1 ){
			echo "<td>".form_dropdown('status', $app_status_list, $la->status)."</td>";
		}	
		echo "<td><textarea name = \"dx\" cols=\"15\" rows=\"3\" >".revert_input($la->dx)."</textarea></td>";
		$a = "document.".$formname.".status";
		echo form_close();
		echo "<td><button onclick = \"editLikeApp('".$la->sched_id."', ".$a.".options[".$a.".selectedIndex].value, document.".$formname.".dx.value, '".$date."', '".$clue."')\">SAVE</button>";
		echo "<button onclick = \"deleteLikeApp('".$la->sched_id."', '".$date."', '".$clue."')\">DELETE</button></td>";
		echo "</tr>";
		$y++;
	}
}
else{
	echo "<h3>No scheduled appointments on ".date('F j, Y', strtotime($date))." for '".$clue."'</h3>";
	
}
?>
</table>