<?php
	//check login status
	$user = $this->session->userdata('login_user');
	$user_access = $this->session->userdata('user_access');

	$logged = $this->Users_model->checkLogged($user);
	foreach($logged as $lg){
		$user_stored = $lg->uname;
	}
		if (!strcmp($user, $user_stored) && ($logged)){
			echo "Welcome ".$user." !";
		}
		else{ 			
			header("location: /");
		}	
	
?>	
<div>	
<a href="/skedco/index.php/welcome/admin_page"><img src="/skedco/img/home.png" class="small_icon" alt=""/>Home</a>
<div class="all_right">

<a href="/skedco/index.php/admin/viewSchedules" alt=""><img src="/skedco/img/contact_list.png" class="small_icon" /></a>
<a href="/skedco/index.php/schedule/schedulePatient" alt=""><img src="/skedco/img/calendar.png" class="small_icon" /></a>
<?php
		echo "<a href=\"/skedco/index.php/schedule/censusPatient\" alt=\"\"><img src=\"/skedco/img/computer_laptop.png\" class=\"small_icon\" /></a>";
	if ($user_access !=2){	
		echo "<a href=\"/skedco/index.php/admin/manageResidents\" alt=\"\"><img src=\"/skedco/img/stethoscope.png\" class=\"small_icon\" /></a>";
	}
?>
<a href="/skedco/index.php/admin/managePatients" alt=""><img src="/skedco/img/users_2.png" class="small_icon" /></a>
<a href="/skedco/index.php/reports" alt=""><img src="/skedco/img/report.png" class="small_icon" alt="" /></a>
<?php
	if ($user_access == 0){
		echo "<a href=\"/skedco/index.php/admin/manageUsers\" alt=\"\"><img src=\"/skedco/img/key_red.png\" class=\"small_icon\" /></a>"; 
	}
?>		
<a href="/skedco/index.php/admin/logout" alt=""><img src="/skedco/img/application_exit.png" class="small_icon" alt=""/></a>
</div>

</div>
<?php
/*
<div id="xhtml" class="all_right">
<p>
    <a href="http://validator.w3.org/check?uri=referer"><img
      src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Transitional" height="31" width="88" /></a>

<a href="http://jigsaw.w3.org/css-validator/check/referer">
    <img style="border:0;width:88px;height:31px"
        src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
        alt="Valid CSS!" />
</a>
</p>
</div>
*/
?>

<div class="title"><h2><?php echo $heading; ?></h2></div>