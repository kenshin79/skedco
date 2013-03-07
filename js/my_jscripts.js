/*jquery*/
function prepAdminMenu(){
	$("table").addClass('center_menu');
	$("table tr td").addClass('menu_text');
    $(".menu_img").hover(function() {
                    $(this).addClass('hover_icon');
                    }, function() {
                    $(this).removeClass('hover_icon');
                    }
                    );	
}

function prepViewSchedule(){
	$("h2").addClass('headers');
	$("th, td").addClass('name_length');
	
}

function prepSchedulePatient(){
	$("#schedule1").addClass('datePickScreen');
	$("#schedule2").addClass('changeScreen');
	$(".clickable").hover(function() {
                    $(this).addClass('hover_click');
                    }, function() {
                    $(this).removeClass('hover_click');
                    }
                    );	
	
}

function prepCensus(){
	$("#search_patients").addClass('datePickScreen');
	$("#show_patients").addClass('changeScreen');
	
}
function prepResidents(){
	$("table").addClass("mother_table");
}


function searchResidents(){
var clue;
clue = $("#search_r").val();
if (clue.length < 3)
  {
  document.getElementById("show_residents").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_residents").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/admin/getResidents?clue="+clue+"&rand="+rand ,true);
xmlhttp.send();
}    

function searchPatients(){
var clue;
clue = $("#search_p").val();
if (clue.length < 3)
  {
  document.getElementById("show_patients").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/admin/getPatients?clue="+clue+"&rand="+rand ,true);
xmlhttp.send();
}    


/*validation*/
function confirmDelete(){
		 
	 e=confirm("Are you sure you want to DELETE this entry?");
	 if (e==true)
	 {
	   return true;
	  }
	 return e;
	
}

function confirmEdit(){
		 
	 e=confirm("Are you sure you want to EDIT this entry?");
	 if (e==true)
	 {
	   return true;
	  }
	 return e;
	
}

/*schedule*/
function showClinicDay(mydate){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("schedule2").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","/skedco/index.php/schedule/getClinicResidents?date="+mydate ,true);
xmlhttp.send();
}    

function showAppointments(period, date, rid){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("schedule2").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/showAppointments?period="+period+"&date="+date+"&rid="+rid+"&rand="+rand ,true);
xmlhttp.send();
}    
//Patients
function editPatient(id, clue, pname, sex, casenumber, birthdate, address){
	if (confirmEdit()){	
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
		else{
			// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
		xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
  		    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    	}
  	}
		var rand = parseInt(Math.random()*999999999999);  
		xmlhttp.open("GET","/skedco/index.php/admin/editPatients?p_id="+id+"&clue="+clue+"&pname="+pname+"&sex="+sex+"&casenumber="+casenumber+"&birthdate="+birthdate+"&address="+address+"&rand="+rand ,true);
		xmlhttp.send();
	}
}    	

function deletePatient(id, clue){
	if (confirmDelete()){	
	if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
	else{
			// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
  		    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    	}
  	}
	var rand = parseInt(Math.random()*999999999999);  
	xmlhttp.open("GET","/skedco/index.php/admin/deletePatient?p_id="+id+"&clue="+clue+"&rand="+rand ,true);
	xmlhttp.send();
	}
}    	

//Appointments
function editApp(period, type, source, sched_id, r_id, date){
	
	if (confirmEdit()){	
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
		else{
			// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
		xmlhttp.onreadystatechange=function(){
  			if (xmlhttp.readyState==4 && xmlhttp.status==200){
  		    document.getElementById("schedule2").innerHTML=xmlhttp.responseText;
    	}
  	}
	var rand = parseInt(Math.random()*999999999999);  
	xmlhttp.open("GET","/skedco/index.php/schedule/editAppointments?period="+period+"&type="+type+"&source="+source+"&sched_id="+sched_id+"&r_id="+r_id+"&date="+date+"&rand="+rand ,true);
	xmlhttp.send();
	}
}    

function deleteApp(period, sched_id, r_id, date){
	
	if (confirmDelete()){	
		if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
	else{
			// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
  		    document.getElementById("schedule2").innerHTML=xmlhttp.responseText;
    	}
  	}
	var rand = parseInt(Math.random()*999999999999);  
	xmlhttp.open("GET","/skedco/index.php/schedule/deleteAppointments?period="+period+"&sched_id="+sched_id+"&r_id="+r_id+"&date="+date+"&rand="+rand ,true);
	xmlhttp.send();
	}
}    

function newApp(period, date, r_id){
		
	if (window.XMLHttpRequest){
			// code for IE7+, Firefox, Chrome, Opera, Safari
  			xmlhttp=new XMLHttpRequest();
  		}
	else{
			// code for IE6, IE5
  			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  		}
	xmlhttp.onreadystatechange=function(){
  		if (xmlhttp.readyState==4 && xmlhttp.status==200){
  		    document.getElementById("schedule2").innerHTML=xmlhttp.responseText;
    	}
  	}
	var rand = parseInt(Math.random()*999999999999);  
	xmlhttp.open("GET","/skedco/index.php/schedule/newAppointments?period="+period+"&date="+date+"&r_id="+r_id+"&rand="+rand ,true);
	xmlhttp.send();
	
}    

function selectPatients(period, rid, date){
var clue;
clue = $("#search_p").val();
if (clue.length < 3)
  {
  document.getElementById("show_patients").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/selectPatients?clue="+clue+"&period="+period+"&r_id="+rid+"&date="+date+"&rand="+rand ,true);
xmlhttp.send();
}    

function pickPatient(period, pid, rid, date){

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("schedule2").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/addAppointments?period="+period+"&p_id="+pid+"&r_id="+rid+"&date="+date+"&rand="+rand ,true);
xmlhttp.send();
}    

function addSchedPatient(period, rid, date, pname, sex, casenumber, birthdate, address){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("schedule2").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/addSchedPatient?period="+period+"&r_id="+rid+"&date="+date+"&pname="+pname+"&sex="+sex+"&casenumber="+casenumber+"&birthdate="+birthdate+"&address="+address+"&rand="+rand ,true);
xmlhttp.send();	
	
}

function censusPatients(date){
var clue;
clue = $("#search_p").val();
if (clue.length < 3)
  {
  document.getElementById("show_patients").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/searchCensusPatient?date="+date+"&clue="+clue+"&rand="+rand ,true);
xmlhttp.send();
}    

function censusPatients2(date){

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/searchCensusPatient2?date="+date+"&rand="+rand ,true);
xmlhttp.send();
}    

function editLikeApp(sched_id, status, dx, date, clue){
if (confirmEdit()){	
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/editCensusPatient?sched_id="+sched_id+"&status="+status+"&dx="+dx+"&date="+date+"&clue="+clue+"&rand="+rand ,true);
xmlhttp.send();
}
}    	

function deleteLikeApp(sched_id, date, clue){
if (confirmDelete()){	
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_patients").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/schedule/deleteCensusPatient?sched_id="+sched_id+"&date="+date+"&clue="+clue+"&rand="+rand ,true);
xmlhttp.send();
}
}    	

//reports
function getCharts(date1, date2){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_reports").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/reports/getCharts?date1="+date1+"&date2="+date2+"&rand="+rand ,true);
xmlhttp.send();	
	
}

function getOpdCensus(date1, date2){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_reports").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/reports/getOpdCensus?date1="+date1+"&date2="+date2+"&rand="+rand ,true);
xmlhttp.send();	
	
}

function getResidentCensus(date1, date2, resident){
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.getElementById("show_reports").innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/reports/getResidentCensus?date1="+date1+"&date2="+date2+"&resident="+resident+"&rand="+rand ,true);
xmlhttp.send();	
	
}
//manage users
function deleteUser(id){
if (confirmDelete()){	
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.body.innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/admin/deleteUser?id="+id+"&rand="+rand ,true);
xmlhttp.send();
}
}    	

function editUser(id, access){
if (confirmEdit()){	
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.body.innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/admin/editUser?id="+id+"&access="+access+"&rand="+rand ,true);
xmlhttp.send();
}
}    	

function addUsers(uname, pword, access){

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()

  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    
    document.body.innerHTML=xmlhttp.responseText;
    }
  }
var rand = parseInt(Math.random()*999999999999);  
xmlhttp.open("GET","/skedco/index.php/admin/addUser?uname="+uname+"&pword="+pword+"&access="+access+"&rand="+rand ,true);
xmlhttp.send();
}
  	
