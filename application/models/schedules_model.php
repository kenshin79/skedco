<?php

class Schedules_model extends CI_Model {
var $sched_id = "";
var $p_id = "";
var $r_id = "";
var $app_date = "";
var $type = "";
var $source = "";
var $dx = "";
var $status = "";
var $period = "";

    function __construct()
    {
        parent::__construct();
    }

	function getAppointments($date, $rid){
		$this->db->select('sched_id, schedules.r_id AS r_id, schedules.p_id AS p_id, app_date, type, dx, source, schedules.status AS status, period, rname, pname, sex, casenumber, birthdate');	
		$this->db->from('schedules');
		$this->db->join('patients', 'patients.p_id = schedules.p_id', 'inner');
		$this->db->join('residents', 'residents.r_id = schedules.r_id', 'inner');
		$this->db->where('schedules.r_id', $rid);
		$this->db->where('app_date', $date);
		$query = $this->db->get();
		return $query->result();
		
	}	
	
	function getLikeApps($clue, $date){
		$sql = "SELECT sched_id, schedules.r_id AS r_id, schedules.p_id AS p_id, app_date, dx, type, source, schedules.status AS status, period, rname, pname, sex, casenumber, birthdate 
		        FROM schedules, patients, residents WHERE schedules.p_id = patients.p_id AND residents.r_id = schedules.r_id AND schedules.app_date = ? AND (patients.pname LIKE ? OR patients.casenumber LIKE ?)
		        ";
	 	$query = $this->db->query($sql, array($date, "%".$clue."%", "%".$clue."%"));
	 	return $query->result();
	 	
	}
	function getLikeApps2($date){
		$this->db->select('sched_id, schedules.r_id AS r_id, schedules.p_id AS p_id, app_date, dx, type, source, schedules.status AS status, period, rname, pname, sex, casenumber, birthdate');
		$this->db->from('schedules');
		$this->db->join('patients', 'patients.p_id = schedules.p_id', 'inner');
		$this->db->join('residents', 'residents.r_id = schedules.r_id', 'inner');
		$this->db->where('app_date', $date);
		$this->db->order_by('residents.rname', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function editAppointments($id, $type, $source){
		$data = array(
					'type'=>$type,
					'source'=>$source,
		);
		$this->db->where('sched_id', $id);
		$this->db->update('schedules', $data);
		
	}
	function editAppStatus($id, $status, $dx){
		$data = array(
					'status'=>$status,
					'dx'=>$dx,
		);
		$this->db->where('sched_id', $id);
		$this->db->update('schedules', $data);
	}
	
	function addAppointment($form){
		$data = array(
				'p_id'=>$form['p_id'],
				'r_id'=>$form['r_id'],
				'app_date'=>$form['app_date'],
				'source'=>"3",
				'type'=>"3",
				'dx'=>"",
				'status'=>"0",
				'period'=>$form['period'],
			);
		$this->db->insert('schedules', $data);	
		$id = $this->db->insert_id();	
		return $id;

	}
	
	function deleteAppointments($id){
		$this->db->where('sched_id', $id);
		$this->db->delete('schedules');
		
	}
	
	function countNewPatients($date, $rid){
		$this->db->select('sched_id');
		$this->db->where('r_id', $rid);
		$this->db->where('app_date', $date);
		$this->db->where('type', '0');
		$query = $this->db->get('schedules');
		return $query->num_rows();					
		
	}
//Reports
	function getChartsList($date1, $date2){
		$this->db->select('app_date, pname, sex, birthdate, casenumber, rname, period');
		$this->db->join('patients', 'patients.p_id = schedules.p_id', 'inner');
		$this->db->join('residents', 'residents.r_id = schedules.r_id', 'inner');
		$this->db->where('app_date >=', $date1);
		$this->db->where('app_date <=', $date2);
		$this->db->order_by('app_date', 'asc');
		$this->db->order_by('casenumber', 'asc');
		$query = $this->db->get('schedules');
		return $query->result();
		
	}

	function getOpdCensus($date1, $date2){
		$this->db->select('app_date, pname, sex, birthdate, casenumber, rname, type, source, dx, schedules.status AS status, period');
		$this->db->join('patients', 'patients.p_id = schedules.p_id', 'inner');
		$this->db->join('residents', 'residents.r_id = schedules.r_id', 'inner');
		$this->db->where('app_date >=', $date1);
		$this->db->where('app_date <=', $date2);
		$this->db->order_by('schedules.status', 'desc');			
		$this->db->order_by('period', 'asc');
		$this->db->order_by('app_date', 'asc');
		$this->db->order_by('rname', 'asc');
		$query = $this->db->get('schedules');
		return $query->result();
		
	}

    function getOpdCount($date1, $date2){
   	
    	$sql = "SELECT 
    	
    			COUNT(IF(status = '0', 1, NULL)) AS unattend, 
    	        COUNT(IF(status = '1', 1, NULL)) AS attend, 
    	        COUNT(IF(status = '2', 1, NULL)) AS unsched, 
    	        COUNT(IF(type = '0' AND (status = '1' OR status = '2'), 1, NULL)) AS new, 
    	        COUNT(IF(type = '1' AND (status = '1' OR status = '2'), 1, NULL)) AS comx, 
    	        COUNT(IF(type = '2' AND (status = '1' OR status = '2'), 1, NULL)) AS preop, 
    	        COUNT(IF(type = '3' AND (status = '1' OR status = '2'), 1, NULL)) AS cont,
    	        COUNT(IF(source = '0' AND (status = '1' OR status = '2'), 1, NULL)) AS walkin,
    	        COUNT(IF(source = '1' AND (status = '1' OR status = '2'), 1, NULL)) AS er,
    	        COUNT(IF(source = '2' AND (status = '1' OR status = '2'), 1, NULL)) AS ward,
    	        COUNT(IF(source = '3' AND (status = '1' OR status = '2'), 1, NULL)) AS cont2,
    	        COUNT(IF(source = '4' AND (status = '1' OR status = '2'), 1, NULL)) AS ci,
    	        COUNT(IF(source = '5' AND (status = '1' OR status = '2'), 1, NULL)) AS dent,
    	        COUNT(IF(source = '6' AND (status = '1' OR status = '2'), 1, NULL)) AS ob,
    	        COUNT(IF(source = '7' AND (status = '1' OR status = '2'), 1, NULL)) AS ortho,
    	        COUNT(IF(source = '8' AND (status = '1' OR status = '2'), 1, NULL)) AS psych,
    	        COUNT(IF(source = '9' AND (status = '1' OR status = '2'), 1, NULL)) AS burn,
    	        COUNT(IF(source = '10' AND (status = '1' OR status = '2'), 1, NULL)) AS surgery,
    	        COUNT(IF(source = '11' AND (status = '1' OR status = '2'), 1, NULL)) AS nss,
    	        COUNT(IF(source = '12' AND (status = '1' OR status = '2'), 1, NULL)) AS neuro,
    	        COUNT(IF(source = '13' AND (status = '1' OR status = '2'), 1, NULL)) AS plastic,
    	        COUNT(IF(source = '14' AND (status = '1' OR status = '2'), 1, NULL)) AS uro,
    	        COUNT(IF(source = '15' AND (status = '1' OR status = '2'), 1, NULL)) AS tcvs,
    	        COUNT(IF(source = '16' AND (status = '1' OR status = '2'), 1, NULL)) AS orl,
    	        COUNT(IF(source = '17' AND (status = '1' OR status = '2'), 1, NULL)) AS ophtha,
    	        COUNT(IF(source = '18' AND (status = '1' OR status = '2'), 1, NULL)) AS fm,
    	        COUNT(IF(source = '19' AND (status = '1' OR status = '2'), 1, NULL)) AS pedia,
    	        COUNT(IF(source = '20' AND (status = '1' OR status = '2'), 1, NULL)) AS rehab,
    	        COUNT(IF(sex = 'F' AND (status = '1' OR status = '2'), 1, NULL)) AS females,
    	        COUNT(IF(sex = 'M' AND (status = '1' OR status = '2'), 1, NULL)) AS males,

				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) < 18 AND sex = 'F' AND (status = '1' OR status = '2')), 1, NULL)) AS f1,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 18 AND ROUND(DATEDIFF(app_date, birthdate)/365) < 40 AND sex = 'F' AND (status = '1' OR status = '2')), 1, NULL)) AS f2,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 40 AND ROUND(DATEDIFF(app_date, birthdate)/365) < 60 AND sex = 'F' AND (status = '1' OR status = '2')), 1, NULL)) AS f3,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 60 AND ROUND(DATEDIFF(app_date, birthdate)/365) < 80 AND sex = 'F' AND (status = '1' OR status = '2')), 1, NULL)) AS f4,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 80 AND sex = 'F' AND (status = '1' OR status = '2')), 1, NULL)) AS f5,
				
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) < 18 AND sex = 'M' AND (status = '1' OR status = '2')), 1, NULL)) AS m1,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 18 AND ROUND(DATEDIFF(app_date, birthdate)/365) < 40 AND sex = 'M' AND (status = '1' OR status = '2')), 1, NULL)) AS m2,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 40 AND ROUND(DATEDIFF(app_date, birthdate)/365) < 60 AND sex = 'M' AND (status = '1' OR status = '2')), 1, NULL)) AS m3,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 60 AND ROUND(DATEDIFF(app_date, birthdate)/365) < 80 AND sex = 'M' AND (status = '1' OR status = '2')), 1, NULL)) AS m4,
				COUNT(IF((ROUND(DATEDIFF(app_date, birthdate)/365) >= 80 AND sex = 'M' AND (status = '1' OR status = '2')), 1, NULL)) AS m5
				  	        
    	        
    			FROM schedules, patients WHERE schedules.p_id = patients.p_id AND app_date BETWEEN ? AND ? "; 
		$query = $this->db->query($sql, array($date1, $date2));
		return $query->result();
    }

    function getResCount($rid, $date1, $date2){
    	$sql = "SELECT 
    	
    			COUNT(IF(schedules.status = '0', 1, NULL)) AS unattend, 
    	        COUNT(IF(schedules.status = '1', 1, NULL)) AS attend, 
    	        COUNT(IF(schedules.status = '2', 1, NULL)) AS unsched, 
    	        COUNT(IF(type = '0' AND (schedules.status = '1' OR schedules.status = '2'), 1, NULL)) AS new, 
    	        COUNT(IF(type = '1' AND (schedules.status = '1' OR schedules.status = '2'), 1, NULL)) AS comx, 
    	        COUNT(IF(type = '2' AND (schedules.status = '1' OR schedules.status = '2'), 1, NULL)) AS preop, 
    	        COUNT(IF(type = '3' AND (schedules.status = '1' OR schedules.status = '2'), 1, NULL)) AS cont 
    			FROM schedules WHERE schedules.r_id = ? AND app_date BETWEEN ? AND ? "; 
		$query = $this->db->query($sql, array($rid, $date1, $date2));
		return $query->result();    		
    	
    }
    
	function getResidentCensus($date1, $date2, $resident){
		$this->db->select('app_date, pname, sex, birthdate, casenumber, rname, type, source, schedules.status AS status, period');
		$this->db->join('patients', 'patients.p_id = schedules.p_id', 'inner');
		$this->db->join('residents', 'residents.r_id = schedules.r_id', 'inner');
		$this->db->where('schedules.r_id', $resident);
		$this->db->where('app_date >=', $date1);
		$this->db->where('app_date <=', $date2);
		$this->db->order_by('schedules.status', 'desc');	
		$this->db->order_by('app_date', 'desc');					
		$this->db->order_by('period', 'asc');		
		$query = $this->db->get('schedules');
		return $query->result();
		
	}
	

//Tally	
	function countPreop($date, $rid){
		$this->db->select('sched_id');
		$this->db->where('r_id', $rid);
		$this->db->where('app_date', $date);
		$this->db->where('type', '2');
		$query = $this->db->get('schedules');
		return $query->num_rows();					
	}
	
	function countComx($date, $rid){
		$this->db->select('sched_id');
		$this->db->where('r_id', $rid);
		$this->db->where('app_date', $date);
		$this->db->where('type', '1');
		$query = $this->db->get('schedules');
		return $query->num_rows();					
		
	}
	
	function countCont($date, $rid){
		$this->db->select('sched_id');
		$this->db->where('r_id', $rid);
		$this->db->where('app_date', $date);
		$this->db->where('type', '3');
		$query = $this->db->get('schedules');
		return $query->num_rows();			
		
	}
	
	function countTotal($date, $rid){
		$this->db->select('sched_id');
		$this->db->where('r_id', $rid);
		$this->db->where('app_date', $date);
		$query = $this->db->get('schedules');
		return $query->num_rows();				
		
	}
	
	function countAttended($date, $rid){
		$this->db->select('sched_id');
		$this->db->where('r_id', $rid);
		$this->db->where('app_date', $date);
		$this->db->where('status', '1');
		$query = $this->db->get('schedules');
		return $query->num_rows();			
		
	}
	
	function getPatientsList($date, $rid){
		$this->db->select('schedules.p_id');
		$this->db->from('schedules');
		$this->db->join('patients', 'patients.p_id = schedules.p_id', 'inner');
		$this->db->join('residents', 'residents.r_id = schedules.r_id', 'inner');
		$this->db->where('schedules.r_id', $rid);
		$this->db->where('app_date', $date);
		$query = $this->db->get();
		return $query->result();
		
	}
}	
    