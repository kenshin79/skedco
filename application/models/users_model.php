<?php

class Users_model extends CI_Model {
var $id = "";
var $uname = "";
var $pword = "";
var $access = "";

    function __construct()
    {
        parent::__construct();
    }
 
 	function getAllUsers(){
 		$this->db->select('id, uname, pword, access');
		$this->db->order_by('access');
		$query = $this->db->get('users');
		return $query->result();
 	}   
	
	function addUser($formdata){
		$data = array(
					'uname'=>$formdata['uname'],
					'pword'=>$formdata['pword'],
					'access'=>$formdata['access'],
			
				);
		$this->db->insert('users', $data);
	}	
	
	function editUser($id, $formdata){
		$data = array(
					'access'=>$formdata['access']
				);
		$this->db->where('id', $id);
		$this->db->update('users', $data);
	}
	
	function deleteUser($id){
		$this->db->where('id', $id);
		$this->db->delete('users');
		
	}
	
	function checkUserPwd($uname, $pword){
		$this->db->select('id');
		$this->db->where('uname', $uname);
		$this->db->where('pword', $pword);
		$query = $this->db->get('users');
		return $query->num_rows();
		
	}
	function getAccess($uname, $pword){
		$this->db->select('access');
		$this->db->where('uname', $uname);
		$this->db->where('pword', $pword);
		$query = $this->db->get('users');
		return $query->result();
		
	}	
	
	function checkLogged($uname){
		$this->db->select('uname');
		$this->db->where('uname', $uname);
		$query = $this->db->get('users');
		return $query->result();
		
	}
}    