<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['title'] = "Log-in to SkedCo!";	
		$this->load->view('upper/my_header', $data);
		$this->load->view('log_in');
		$this->load->view('upper/footer');		
	}
	
	public function admin_page(){
		$data['title'] = "SkedCo Home";
		$this->load->view('upper/my_header', $data);
		$data['heading'] = "";
		$this->load->view('upper/header_menu', $data);		
		$this->load->view('upper/skedco');
		$this->load->view('admin/admin_menu');
		$this->load->view('upper/footer');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */