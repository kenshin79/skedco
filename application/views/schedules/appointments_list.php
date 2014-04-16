
<h2>List of patients for <?php echo date('l : F j, Y', strtotime($date));?></h2>
<table class = "mother_table">
	<tr><th colspan="9">Resident Physician:
		<?php 
	    	foreach ($rname as $r){
	    		
				echo ": ".$r->rname;
	    	}
		$period_list = $this->config->item('period_list');	    
		?>
	<button onclick = "newApp('<?php echo $period; ?>', '<?php echo $date; ?>', '<?php echo $r_id; ?>')">Add New Appointment</button></th></tr>
	<tr><th colspan="9"><?php echo date('l', strtotime($date))." ".date('F j, Y', strtotime($date))." ".$period_list[$period]; ?></th></tr>
	<?php
	//arrays for lists
	$type_list = $this->config->item('type_list');
	$source_list = $this->config->item('source_list');
	$app_status_list = $this->config->item('app_status_list');
	if ($app_list)
		echo "<tr><th>No.</th><th>Patient Name</th><th>Age/Sex</th><th>Case Number</th><th>Type</th><th>Source</th><th>Status</th><th colspan=\"2\">Actions</th></tr>";	
	$x = 1;
	foreach ($app_list as $row){
		$slot = "app".$x;
		echo form_open('', array('name'=>$slot));
		echo "<tr><td>".$x."</td>";
		echo "<td>".strtoupper($row->pname)."</td>";
		echo "<td>".compute_age(date("Y-m-d"), $row->birthdate)."/".$row->sex."</td>";
		echo "<td>".$row->casenumber."</td>";
		$atype = "id=\"".$slot."type\"";
		$asource = "id=\"".$slot."source\"";
		echo "<td>".form_dropdown('type', $type_list, $row->type, $atype)."</td>";
		echo "<td>".form_dropdown('source', $source_list, $row->source, $asource)."</td>";
		echo form_close();
		echo "<td>".$app_status_list[$row->status]."</td>";
		$a = "document.".$slot.".type.selectedIndex";
		$b = "document.".$slot.".source.selectedIndex";
//		echo "<td><button onclick = \"editApp('".$period."', document.".$slot.".type.options[".$a."].value, document.".$slot.".source.options[".$b."].value, '".$row->sched_id."' , '".$row->r_id."' , '".$date."')\">SAVE</button></td>";
		echo "<td><button onclick = \"editApp('".$period."', document.getElementById('".$slot."type').value, document.getElementById('".$slot."source').value, '".$row->sched_id."' , '".$row->r_id."' , '".$date."')\">SAVE</button></td>";
		echo "<td><button onclick = \"deleteApp('".$period."', '".$row->sched_id."' , '".$row->r_id."' , '".$date."')\">DELETE</button></td></tr>";
		$x++;
	}	
	
?>

</table>
