<?php 
class Nurse_model extends CI_Model{

	public function getnurseinfo($username)
	{
		$this->db->where('NID',$username);
		$q = $this->db->get('NURSE');
		$data = null;
		
		if($q->num_rows==1){
			$row =  $q->row();
			$data['name'] = $row->NAME;
			$data['address'] = $row->ADDRESS;
			$data['age'] = $row->AGE;
			$data['phone'] = $row->PHONE;									
			$data['status'] = $row->STATUS;			
			$data['email'] = $row->EMAIL;
			$data['qualification']=$row->QUALIFICATION;
		}
		$data['info'] = $q;
		return $data;
	}


	public function updatenurseinfo($username){
		$name = $this->input->post('nursename');
		$address = $this->input->post('nurseaddress');
		$age = intval($this->input->post('nurseage'));
		$phone = intval($this->input->post('nursephone'));
		$email = $this->input->post('nurseemail');
		$qualification = $this->input->post('nursequalification');
		

		//echo $qualification." ".$specialization;
		
		$this->db->query("UPDATE NURSE SET NAME='$name' , ADDRESS='$address', AGE=$age, 
			PHONE=$phone, EMAIL='$email', QUALIFICATION='$qualification'
			WHERE NID ='$username'");

	}

	public function viewSchedule($username){
		$q= $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $q->row()->SYSDATE;
		$num = $this->input->post('viewSchedule');
		if($num==0){
			$q = $this->db->query("SELECT WARDID, NID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,
			to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM NURSESCHEDULE WHERE STARTDATE >='$sysdate' 
				AND NID = '$username'");
		}
		else {
			$q = $this->db->query("SELECT WARDID, NID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE ,
				to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE  FROM NURSESCHEDULE WHERE STARTDATE <'$sysdate' 
				AND NID = '$username'");
		}
		return $q;
	}
	
}