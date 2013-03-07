<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['year1_bday'] = "1900";

$config['year1'] = "2013";

$config['year2'] = "2050";

$config['allow_date1_bday'] = "1900-01-01";

$config['allow_date1'] = "2013-01-01";

$config['allow_date2'] = "2050-01-01";

$config['salt1'] = "274924902";
$config['salt2'] = "749320340";

$config['res_status_list'] = array(
						'0'=>'Not Active',
						'1'=>'Active',

					);

$config['access_list'] = array(
						'0'=>'Administrator',
						'1'=>'Resident',
						'2'=>'Nurse'
					);

$config['clinic_list'] = array(
						'0'=>'Monday AM',
						'1'=>'Monday PM',
						'2'=>'Tuesday AM',
						'3'=>'Tuesday PM',
						'4'=>'Wednesday AM',
						'5'=>'Wednesday PM',
						'6'=>'Thursday AM',
						'7'=>'Thursday PM',
						'8'=>'Friday AM',
						'9'=>'Friday PM',

					);

$config['type_list'] = array(
						'0'=>"New Primary",
						'1'=>"Co-managed",
						'2'=>"Pre-operative",
						'3'=>"Continuity",
					);

$config['source_list'] = array(
						'0'=>"Walk-in",
						'1'=>"ER",
						'2'=>"Ward",
						'3'=>"Continuity",
						'4'=>"CI",
						'5'=>"Dent",
						'6'=>"OBGYN",
						'7'=>"Ortho",
						'8'=>"Psych",
						'9'=>"Burn",
						'10'=>"Surgery",
						'11'=>"NSS",
						'12'=>"Neuro",
						'13'=>"Plastic",
						'14'=>"Urology",
						'15'=>"TCVS",
						'16'=>"ORL",
						'17'=>"Ophtha",
						'18'=>"Family Med",
						'19'=>"Pedia",
						'20'=>"Rehab",
					);

$config['app_status_list'] = array(
						'0'=>"Not Attended",
						'1'=>"Attended",
						'2'=>"Unscheduled", 
					);					

$config['period_list'] = array(
						'0'=>"AM",
						'1'=>"PM",	
					);
?>