<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {

	public function index(){
		
		
	}	
	
	public function getClinicResidents(){
		$date = $this->input->get('date', TRUE);
		$data['date'] = $date;
		$day = date('l', strtotime($date));
		switch ($day) {
			case "Monday":
				$slot1 = 0;
				$slot2 = 1;
				break;
			case "Tuesday":
				$slot1 = 2;
				$slot2 = 3;				
				break;
			case "Wednesday":
				$slot1 = 4;
				$slot2 = 5;
				break;	
			case "Thursday":
				$slot1 = 6;
				$slot2 = 7;
				break;	
			case "Friday":
				$slot1 = 8;
				$slot2 = 9;
				break;	
			default:
				$slot1 = 8;
				$slot2 = 9;
				break;
		}
		$data['residentsAM'] = $this->Residents_model->getScheduleResidents($slot1);
		$data['residentsPM'] = $this->Residents_model->getScheduleResidents($slot2);
		
		foreach ($data['residentsAM'] as $row){
			$name = "np_".$row->r_id;
			$data[$name] = $this->Schedules_model->countNewPatients($date, $row->r_id);
			$name = "po_".$row->r_id;
			$data[$name] = $this->Schedules_model->countPreop($date, $row->r_id);
			$name = "comx_".$row->r_id;
			$data[$name] = $this->Schedules_model->countComx($date, $row->r_id);
			$name = "cont_".$row->r_id;
			$data[$name] = $this->Schedules_model->countCont($date, $row->r_id);
			$name = "total_".$row->r_id;
			$data[$name] = $this->Schedules_model->countTotal($date, $row->r_id);
			$name = "attend_".$row->r_id;
			$data[$name] = $this->Schedules_model->countAttended($date, $row->r_id);
			
		}
		
		foreach ($data['residentsPM'] as $row){
			$name = "np_".$row->r_id;
			$data[$name] = $this->Schedules_model->countNewPatients($date, $row->r_id);
			$name = "po_".$row->r_id;
			$data[$name] = $this->Schedules_model->countPreop($date, $row->r_id);
			$name = "comx_".$row->r_id;
			$data[$name] = $this->Schedules_model->countComx($date, $row->r_id);
			$name = "cont_".$row->r_id;
			$data[$name] = $this->Schedules_model->countCont($date, $row->r_id);
			$name = "total_".$row->r_id;
			$data[$name] = $this->Schedules_model->countTotal($date, $row->r_id);
			$name = "attend_".$row->r_id;
			$data[$name] = $this->Schedules_model->countAttended($date, $row->r_id);
			
		}		
		$data['day'] = $day;
		$this->load->view('schedules/clinic_day_residents', $data);
		
	}

	public function showAppointments(){
		$date = $this->input->get('date', TRUE);
		$rid = $this->input->get('rid', TRUE);
		$period = $this->input->get('period', TRUE);
		$data['date'] = $date;
		$data['r_id'] = $rid;
		$data['period'] = $period;
		$data['rname'] = $this->Residents_model->getRnameById($rid);
		$data['app_list'] = $this->Schedules_model->getAppointments($date, $rid);
		$this->load->view('schedules/appointments_list', $data);		
		
	}
	
	public function editAppointments(){
		$date = $this->input->get('date', TRUE);
		$rid = $this->input->get('r_id', TRUE);		
		$period = $this->input->get('period', TRUE);
		$type = $this->input->get('type', TRUE);
		$source = $this->input->get('source', TRUE);
		$sched_id = $this->input->get('sched_id', TRUE);
		$this->Schedules_model->editAppointments($sched_id, $type, $source);
		$data['date'] = $date;
		$data['r_id'] = $rid;
		$data['period'] = $period;
		$data['rname'] = $this->Residents_model->getRnameById($rid);		
		$data['app_list'] = $this->Schedules_model->getAppointments($date, $rid);
		$this->load->view('schedules/appointments_list', $data);				
		
		
	}
	
	public function deleteAppointments(){
		$period = $this->input->get('period', TRUE);
		$date = $this->input->get('date', TRUE);
		$rid = $this->input->get('r_id', TRUE);
		$sched_id = $this->input->get('sched_id', TRUE);
		$this->Schedules_model->deleteAppointments($sched_id);
		$data['date'] = $date;
		$data['r_id'] = $rid;
		$data['period'] = $period;
		$data['rname'] = $this->Residents_model->getRnameById($rid);		
		$data['app_list'] = $this->Schedules_model->getAppointments($date, $rid);
		$this->load->view('schedules/appointments_list', $data);								
		
	}

	public function newAppointments(){
		$date = $this->input->get('date', TRUE);
		$rid = $this->input->get('r_id', TRUE);
		$period = $this->input->get('period', TRUE);
		$rname = $this->Residents_model->getRnameById($rid);
		$data['date'] = $date;
		$data['r_id'] = $rid;
		$data['period'] = $period;
		$data['rname'] = $rname;
		$this->load->view('schedules/main_select_patients', $data);								
		
	}
	
	public function addAppointments(){
		$p_id = $this->input->get('p_id', TRUE);
		$r_id = $this->input->get('r_id', TRUE);
		$date = $this->input->get('date', TRUE);
		$period = $this->input->get('period', TRUE);
		$formdata = array(
					'p_id'=>$p_id,
					'r_id'=>$r_id,
					'app_date'=>$date,
					'period'=>$period,
			);
		$add = $this->Schedules_model->addAppointment($formdata);
		$data['date'] = $date;
		$data['r_id'] = $r_id;
		$data['period'] = $period;
		$data['rname'] = $this->Residents_model->getRnameById($r_id);
		$data['app_list'] = $this->Schedules_model->getAppointments($date, $r_id);
		$this->load->view('schedules/appointments_list', $data);			
		
	}


	public function selectPatients(){
		$clue = $this->input->get('clue', TRUE);
		$r_id = $this->input->get('r_id', TRUE);
		$date = $this->input->get('date', TRUE);
		$period = $this->input->get('period', TRUE);
		$data['like_patients'] = $this->Patients_model->getLikePatients($clue);
		$data['p_list'] = $this->Schedules_model->getPatientsList($date, $r_id);
		$data['clue'] = $clue;
		$data['r_id'] = $r_id;
		$data['date'] = $date;
		$data['period'] = $period;
		$this->load->view('schedules/select_patients', $data);		
		
	}

	public function addSchedPatient(){
		$r_id = $this->input->get('r_id', TRUE);
		$date = $this->input->get('date', TRUE);
		$period = $this->input->get('period', TRUE);
		$pname = $this->input->get('pname', TRUE);
		$sex = $this->input->get('sex', TRUE);
		$casenumber = $this->input->get('casenumber', TRUE);
		$birthdate = $this->input->get('birthdate', TRUE);
		$address = $this->input->get('address', TRUE);
		$formdata = array(
						'pname'=>$pname,
						'sex'=>$sex,
						'casenumber'=>$casenumber,
						'birthdate'=>$birthdate,
						'address'=>$address
				);
		$p_id = $this->Patients_model->addPatient($formdata);

		$formdata2 = array(
						'p_id'=> $p_id,
						'r_id'=> $r_id,
						'app_date'=> $date,
						'period'=>$period,
				);
		$this->Schedules_model->addAppointment($formdata2);
		$data['date'] = $date;
		$data['r_id'] = $r_id;
		$data['period'] = $period;
		$data['rname'] = $this->Residents_model->getRnameById($r_id);
		$data['app_list'] = $this->Schedules_model->getAppointments($date, $r_id);
		$this->load->view('schedules/appointments_list', $data);						
  
	}
	
	public function schedulePatient(){
		$data['title'] = "Schedule Patients Page";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Patient Scheduler";
		$this->load->view('upper/header_menu', $data);		
		$this->load->view('schedules/schedule_patient', $data);
		$this->load->view('upper/footer');		
		
	}
	
	public function censusPatient(){
		$data['title'] = "Clinic Census";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Census Station";
		$this->load->view('upper/header_menu', $data);			
		$this->load->view('schedules/main_clinic_census', $data);
		$this->load->view('upper/footer');
	}
	
	public function searchCensusPatient(){
		$clue = $this->input->get('clue', TRUE);
		$date = $this->input->get('date', TRUE);
		$data['clue'] = $clue;
		$data['date'] = $date;
		$data['like_apps'] = $this->Schedules_model->getLikeApps($clue, $date);
		$this->load->view('schedules/show_like_apps', $data);
	}
	public function searchCensusPatient2(){
		$date = $this->input->get('date', TRUE);
		$data['clue'] = "ALL Patients";
		$data['date'] = $date;
		$data['like_apps'] = $this->Schedules_model->getLikeApps2($date);
		$this->load->view('schedules/show_like_apps', $data);
	}
	
	public function editCensusPatient(){
		$sched_id = $this->input->get('sched_id', TRUE);
		$status = $this->input->get('status', TRUE);
		$dx =  clean_input($this->input->get('dx', TRUE));
		$date = $this->input->get('date', TRUE);
		$clue = $this->input->get('clue', TRUE);
		$this->Schedules_model->editAppStatus($sched_id, $status, $dx);
		$data['clue'] = $clue;
		$data['date'] = $date;
		$data['like_apps'] = $this->Schedules_model->getLikeApps2($date);
		$this->load->view('schedules/show_like_apps', $data);		
	}
	
	public function deleteCensusPatient(){
		$sched_id = $this->input->get('sched_id', TRUE);
		$date = $this->input->get('date', TRUE);
		$clue = $this->input->get('clue', TRUE);
		$this->Schedules_model->deleteAppointments($sched_id);
		$data['clue'] = $clue;
		$data['date'] = $date;
		$data['like_apps'] = $this->Schedules_model->getLikeApps($clue, $date);
		$this->load->view('schedules/show_like_apps', $data);		
	}	
	
}

	