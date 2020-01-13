<?php

class HMS_model extends CI_Model
{
	public function getPatientInfo($username)
	{
		$this->db->where('PID',$username);
		$q = $this->db->get('PATIENT');
		$data = null;
		
		if($q->num_rows==1){
			$row =  $q->row();
			$data['name'] = $row->NAME;
			$data['address'] = $row->ADDRESS;
			$data['age'] = $row->AGE;
			$data['phone'] = $row->PHONE;			
			$data['blood_group'] = $row->BLOOD_GROUP;			
			$data['status'] = $row->STATUS;			
			$data['email'] = $row->EMAIL;
		}
		return $data;
	}
}