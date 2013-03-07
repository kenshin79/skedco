
<script type="text/javascript">
		$(document).ready(function(){
        prepAdminMenu();
	    });
	
</script>
<?php
	$user_access = $this->session->userdata('user_access');
?>	
<table id="center_menu">
<tr>
	<td><a href="/skedco/index.php/admin/viewSchedules"><img src="/skedco/img/contact_list.png" class="menu_img" alt="" /></a><br/>View</td>
	<td><a href="/skedco/index.php/schedule/schedulePatient"><img src="/skedco/img/calendar.png" class="menu_img" alt="" /></a><br/>Schedule</td>
<?php
    echo "<td><a href=\"/skedco/index.php/schedule/censusPatient\"><img src=\"/skedco/img/computer_laptop.png\" class=\"menu_img\" alt=\"\" /></a><br/>Census</td>";
	if ($user_access != 2){	
		echo "<td><a href=\"/skedco/index.php/admin/manageResidents\"><img src=\"/skedco/img/stethoscope.png\" class=\"menu_img\" alt=\"\"/></a><br/>Residents</td>";
	}
?>	
	<td><a href="/skedco/index.php/admin/managePatients"><img src="/skedco/img/users_2.png" class="menu_img" alt=""/></a><br/>Patients</td>
	<td><a href="/skedco/index.php/reports"><img src="/skedco/img/report.png" class="menu_img" alt="" /></a><br/>Reports</td>
<?php

	if ($user_access == 0){
		echo "<td><a href=\"/skedco/index.php/admin/manageUsers\" ><img src=\"/skedco/img/key_red.png\" class=\"menu_img\" alt=\"\" /></a><br/>Users</td>";
		
	}	
?>
</tr>
</table>
