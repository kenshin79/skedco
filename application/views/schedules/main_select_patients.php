<?php
	echo "<h3>Add New Appointment:</h3>";
	foreach ($rname as $rn)
		echo "<h3>".$rn->rname;
	echo " (".date('F j, Y', strtotime($date)).")</h3>";
?>

<div id="search_patients2">

<h3>Search patients (min 3 characters):</h3>
<input name="search_p" type="text" size="40" id="search_p" onkeyup="selectPatients('<?php echo $period; ?>', '<?php echo $r_id; ?>', '<?php echo $date; ?>')"/>	

</div>

<div id="show_patients"></div>