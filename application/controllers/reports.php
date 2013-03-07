<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends CI_Controller {
	public function index(){
		$data['title'] = "Reports Page";
		$data['residents_list'] = $this->Residents_model->getAllResidents();
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "Reports Generator";
		$this->load->view('upper/header_menu', $data);			
		$this->load->view('reports/main_reports', $data);
		$this->load->view('upper/footer');
	}
	
	public function getCharts(){
		$date1 = $this->input->get('date1', TRUE);
		$date2 = $this->input->get('date2', TRUE);
		$data['date1'] = $date1;
		$data['date2'] = $date2;
		$data['charts_list'] = $this->Schedules_model->getChartsList($date1, $date2);
		$this->load->view('reports/charts_list', $data);
		
	}
	
	public function getOpdCensus(){
		$date1 = $this->input->get('date1', TRUE);
		$date2 = $this->input->get('date2', TRUE);
		$data['date1'] = $date1;
		$data['date2'] = $date2;
		$data['opd_census'] = $this->Schedules_model->getOpdCensus($date1, $date2);
		$data['opd_count'] = $this->Schedules_model->getOpdCount($date1, $date2);
		$this->load->view('reports/opd_census', $data);
		
	}	
	
	public function getResidentCensus(){
		$date1 = $this->input->get('date1', TRUE);
		$date2 = $this->input->get('date2', TRUE);
		$resident = $this->input->get('resident', TRUE);
		$data['date1'] = $date1;
		$data['date2'] = $date2;
		$data['resident_census'] = $this->Schedules_model->getResidentCensus($date1, $date2, $resident);
		$data['resident_count'] = $this->Schedules_model->getResCount($resident, $date1, $date2);
		$data['res_name'] = $this->Residents_model->getRnameById($resident);
		$this->load->view('reports/resident_census', $data);
		
	}		
}	
