<?php

class Residents_model extends CI_Model {
var $r_id = "";
var $rname = "";
var $date_start = "";
var $status = "";
var $clinics = "";

    function __construct()
    {
        parent::__construct();
    }
	
	function getLikeResidents($clue){
		$this->db->select('r_id, rname, date_start, status, clinics');
		$this->db->like('rname', $clue);
		$query = $this->db->get('residents');
		return $query->result();
		
	}
	
	function getAllResidents(){
		$this->db->select('r_id, rname');
		$this->db->order_by('rname', 'asc');
		$query = $this->db->get('residents');
		return $query->result();
		
	}
	
	function editResidents($id, $form){
		$data = array(
					'rname'=>$form['rname'],
					'date_start'=>$form['date_start'],
					'status'=>$form['status'],
					'clinics'=>$form['clinics']
				);
		$this->db->where('r_id', $id);
		$this->db->update('residents', $data);
				
		
	}
	
	function addResident($form){
		$data = array(
				'rname'=>$form['rname'],
				'date_start'=>$form['date_start'],
				'status' =>$form['status'],
				'clinics'=>$form['clinics'] 
			);
		$this->db->insert('residents', $data);				
		
		
	}
	
	function deleteResident($id){
		$this->db->where('r_id', $id);
		$this->db->delete('residents');
		
	}
	
	function getScheduleResidents($slot){
		$this->db->select('r_id, rname');
		$this->db->where('status', '1');	
		$this->db->like('clinics', $slot);
		$query = $this->db->get('residents');
		return $query->result();
	}
	
	function getRnameById($id){
		$this->db->select('rname');
		$this->db->where('r_id', $id);
		$query = $this->db->get('residents');
		return $query->result();
	}
}

?>