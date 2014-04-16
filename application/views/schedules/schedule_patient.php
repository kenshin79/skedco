    <script type="text/javascript">
      $(document).ready(function() {
      		prepSchedulePatient();
      });
      showClinicDay('<?php echo date('Y-m-d');?>');
    </script>

<div id="schedule1">
	<h3>Select Clinic Date</h3>
	<?php
      require_once('calendar/classes/tc_calendar.php');	  
	  echo form_open('', array('name'=>"date1_form"));
	  $myCalendar = new tc_calendar("mydate");
	  $myCalendar->setIcon(base_url()."calendar/images/iconCalendar.gif");
	  $myCalendar->setDate(date('d'), date('m'), date('Y'));
	  $myCalendar->setPath(base_url()."calendar/");
	  $myCalendar->setYearInterval($this->config->item('year1'), $this->config->item('year2'));
	  $myCalendar->dateAllow($this->config->item('allow_date1'), $this->config->item('allow_date2'), false);
	  $myCalendar->startMonday(true);
	  $myCalendar->disabledDay("Sat");
	  $myCalendar->disabledDay("sun");
	  $myCalendar->writeScript();
	  echo form_close();
	  //echo "<button name = \"date\" onClick = \"showClinicDay(document.forms['date1_form']['mydate'].value)\" >Refresh Tally</button>";
	  echo "<button name = \"date\" onClick = \"showClinicDay(document.getElementById('mydate').value)\" >Refresh Tally</button>";
	  	  ?> 
</div>

<div id="schedule2">
	
</div>