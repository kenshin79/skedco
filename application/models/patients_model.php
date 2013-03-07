<?php

class Patients_model extends CI_Model {
var $p_id = "";
var $pname = "";
var $casenumber = "";
var $birthdate = "";
var $address = "";

    function __construct()
    {
        parent::__construct();
    }
    
	function getLikePatients($clue){
		$this->db->select('p_id, pname, sex, casenumber, birthdate, address');
		$this->db->like('pname', $clue);
		$this->db->or_like('casenumber', $clue);
		$query = $this->db->get('patients');
		return $query->result();
		
	}	
	
	function editPatients($id, $form){
		$data = array(
						'pname'=>$form['pname'],
						'casenumber'=>$form['casenumber'],
						'sex'=>$form['sex'],
						'birthdate'=>$form['birthdate'],
						'address'=>$form['address'],
				);
		$this->db->where('p_id', $id);
		$this->db->update('patients', $data);
				
		
	}	
	function addPatient($form){
		$data = array(
						'pname'=>$form['pname'],
						'casenumber'=>$form['casenumber'],
						'sex'=>$form['sex'],
						'birthdate'=>$form['birthdate'],
						'address'=>$form['address'],
				);
		$this->db->insert('patients', $data);	
		return $this->db->insert_id();					
	}
	
	function deletePatient($id){
		$this->db->where('p_id', $id);
		$this->db->delete('patients');
		
	}	
	
}    
?>    