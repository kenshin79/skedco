    <script type="text/javascript">
      $(document).ready(function() {
      		prepCensus();
      });
      
      censusPatients2('<?php echo date('Y-m-d')?>');
    </script>
<div id="search_patients">
<?php echo form_open('', array('name'=>"census_day")); 
      require_once('calendar/classes/tc_calendar.php');	  
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
	  
//<button onclick="censusPatients2(document.census_day.mydate.value);">Refresh</button>	  
//<input name="search_p" type="text" size="20" id="search_p" onkeyup="censusPatients(document.census_day.mydate.value)"/>

?>
<?php echo form_close(); ?>
<button onclick="censusPatients2(document.getElementById('mydate').value);">Refresh</button>
<h2>Search patients</h2>
<h4>(min 3 chars):</h4>
<input name="search_p" type="text" size="20" id="search_p" onkeyup="censusPatients(document.getElementById('mydate').value)"/>


</div>
<div id="show_patients"></div>


</body>
</html>