<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index(){
		
		
	}	
//logout
	public function logout(){
		$this->session->sess_destroy();
		$data['title'] = "Logged-out of Skedco";
		$this->load->view('upper/my_header', $data);		
		$this->load->view('logout');
		$this->load->view('upper/footer');		
		
		
	}	
	
//add users
	public function manageUsers(){
		$data['title'] = "Users Page";
		$data['users'] = $this->Users_model->getAllUsers();
		$data['heading'] = "Manage Users Page";
		$this->load->view('upper/my_header', $data);
		$this->load->view('upper/header_menu', $data);
		$this->load->view('admin/manageUsers', $data);

		
	}

	public function editUser(){
		$id = $this->input->get('id', TRUE);
		$access = $this->input->get('access', TRUE);
		
		$formdata = array(
					'access'=>$access
				);	
		$data['heading'] = "Manage Users Page";		
		$this->Users_model->editUser($id, $formdata);
		$this->load->view('upper/header_menu', $data);			
		$data['users'] = $this->Users_model->getAllUsers();
		$this->load->view('admin/manageUsers', $data);		
				
	}
	
	public function addUser(){
		$uname = $this->input->get('uname', TRUE);
		$pword = $this->input->get('pword', TRUE);
		$access = $this->input->get('access', TRUE);
		
		$salt = $this->config->item('salt1').$this->config->item('salt2');
		$spword = crypt($pword, $salt);
		
		$formdata = array(
					'uname'=>$uname,
					'pword'=>$spword,
					'access'=>$access
				);	
		$this->Users_model->addUser($formdata);
		$data['users'] = $this->Users_model->getAllUsers();
		$data['heading'] = "Manage Users Page";
		$this->load->view('upper/header_menu', $data);		
		$this->load->view('admin/manageUsers', $data);		
				
	}
	
	public function deleteUser(){
		$id = $this->input->get('id', TRUE);
		$this->Users_model->deleteUser($id);
		
		$data['users'] = $this->Users_model->getAllUsers();
		$data['heading'] = "Manage Users Page";
		$this->load->view('upper/header_menu', $data);		
		$this->load->view('admin/manageUsers', $data);		
		
	}
	
//start of residents	
	public function manageResidents(){
		$data['title'] = "Residents Page";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Residents Page";
		$this->load->view('upper/header_menu', $data);		
		$this->load->view('residents/main_resident');
		$this->load->view('upper/footer');		
		
	}
	
	public function getResidents(){
		$clue = $this->input->get('clue', TRUE);
		$data['like_residents'] = $this->Residents_model->getLikeResidents($clue);
		$data['clue'] = $clue;
		$this->load->view('residents/search_residents', $data);
	}
	
	public function editResidents(){
		$dnum = $this->input->post('dnum', TRUE);
		$datevar = "date_start".$dnum;
		$form = array(
					'rname'=>$this->input->post('rname', TRUE),
					'date_start'=>$this->input->post($datevar, TRUE),
					'status'=>$this->input->post('status', TRUE),
					'clinics'=>implode('@', $this->input->post('clinics', TRUE)),
				);
		$id = $this->input->post('r_id', TRUE);		
		$this->Residents_model->editResidents($id, $form);
		$data['title'] = "Residents Page";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Manage Residents Page";
		$this->load->view('upper/header_menu', $data);	
		$this->load->view('residents/main_resident');		
		
		
	}
	
	public function addResident(){
		$form = array(
					'rname'=>$this->input->post('rname', TRUE),
					'date_start'=>$this->input->post('date_start', TRUE),
					'status'=>$this->input->post('status', TRUE),
					'clinics'=>implode('@', $this->input->post('clinics', TRUE)),
				);		
		$this->Residents_model->addResident($form);
		$data['title'] = "Residents Page";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Manage Residents Page";
		$this->load->view('upper/header_menu', $data);	
		$this->load->view('residents/main_resident');		
		
	}

	public function deleteResident(){
		$id = $this->input->post('r_id', TRUE);		
		$this->Residents_model->deleteResident($id);
		$data['title'] = "Residents Page";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Manage Residents Page";
		$this->load->view('upper/header_menu', $data);	
		$this->load->view('residents/main_resident');		
	}
//end of residents

//start of patients	
	public function managePatients(){
		$data['title'] = "Patients Page";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Patients Page";
		$this->load->view('upper/header_menu', $data);		
		$this->load->view('patients/main_patient');
		$this->load->view('upper/footer');
				
		
	}
	
	public function getPatients(){
		$clue = $this->input->get('clue', TRUE);
		$data['like_patients'] = $this->Patients_model->getLikePatients($clue);
		$data['clue'] = $clue;
		$this->load->view('patients/search_patients', $data);
	}
	
	
	public function editPatients(){
		$clue = $this->input->get('clue', TRUE);
		$form = array(
					'pname'=>strtoupper($this->input->get('pname', TRUE)),
					'casenumber'=>$this->input->get('casenumber', TRUE),
					'sex' => $this->input->get('sex', TRUE),
					'birthdate'=>$this->input->get('birthdate', TRUE),
					'address'=>$this->input->get('address', TRUE)
				);
		$id = $this->input->get('p_id', TRUE);		
		$this->Patients_model->editPatients($id, $form);
		
		$data['like_patients'] = $this->Patients_model->getLikePatients($clue);
		$data['clue'] = $clue;
		$this->load->view('patients/search_patients', $data);
		
	}	

	public function addPatient(){
		$form = array(
					'pname'=>strtoupper($this->input->post('pname', TRUE)),
					'casenumber'=>$this->input->post('casenumber', TRUE),
					'sex'=>$this->input->post('sex', TRUE),
					'birthdate'=>$this->input->post('birthdate', TRUE),
					'address'=>$this->input->post('address', TRUE)		
				);
		$this->Patients_model->addPatient($form);
		$data['title'] = "Patients Page";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Manage Patients Page";
		$this->load->view('upper/header_menu', $data);			
		$this->load->view('patients/main_patient');		
		
	}	
	
	public function deletePatient(){
		$id = $this->input->get('p_id', TRUE);		
		$this->Patients_model->deletePatient($id);
		$clue = $this->input->get('clue', TRUE);
		$data['like_patients'] = $this->Patients_model->getLikePatients($clue);
		$data['clue'] = $clue;
		$this->load->view('patients/search_patients', $data);
	}	
//end of patients

//start of appointments

	public function viewSchedules(){
		$data['monday1'] = $this->Residents_model->getScheduleResidents("0");
		$data['monday2'] = $this->Residents_model->getScheduleResidents("1");		
		$data['tuesday1'] = $this->Residents_model->getScheduleResidents("2");
		$data['tuesday2'] = $this->Residents_model->getScheduleResidents("3");		
		$data['wednesday1'] = $this->Residents_model->getScheduleResidents("4");		
		$data['wednesday2'] = $this->Residents_model->getScheduleResidents("5");		
		$data['thursday1'] = $this->Residents_model->getScheduleResidents("6");
		$data['thursday2'] = $this->Residents_model->getScheduleResidents("7");				
		$data['friday1'] = $this->Residents_model->getScheduleResidents("8");		
		$data['friday2'] = $this->Residents_model->getScheduleResidents("9");		
		$data['title'] = "Clinic Schedules Page";
		$this->load->view('upper/my_header', $data);		
		$data['heading'] = "";
		$this->load->view('upper/header_menu', $data);		
		$this->load->view('residents/schedules', $data);
		$this->load->view('upper/footer');
	}



//end of appontments
}

?>