<?php

class Patient_model extends CI_Model
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
		$data['info'] = $q;
		return $data;
	}


	public function getPtinfo($username)
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

	public function updatePtinfo($username){
		$name = $this->input->post('ptname');
		$address = $this->input->post('ptaddress');
		$age = intval($this->input->post('ptage'));
		$phone = intval($this->input->post('ptphone'));
		$email = $this->input->post('ptemail');

		$this->db->query("UPDATE PATIENT SET NAME='$name' , ADDRESS='$address', AGE=$age, 
			PHONE=$phone,EMAIL='$email' WHERE PID ='$username'");

	}


	public function getDOClist(){
		$q = $this->db->query("SELECT  DID,NAME FROM DOCTOR ORDER BY DID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data['name'][] = $row->NAME;
			}
			$data['name']= array_unique($data['name']);
			return $data;
		}
		return $data;
		//return false;
	}

	public function getDOClistbyName(){
		$name = $this->input->post('searchDOCbyname');
		$q = $this->db->query("SELECT  * FROM DOCTOR WHERE NAME  LIKE '% $name%' OR NAME LIKE '$name%' ORDER BY DID");
		//echo "SELECT  DID, NAME FROM DOCTOR WHERE NAME  LIKE '%$name%' ORDER BY DID";
		$data = null;
		//if($q->num_rows()>0){
			return $q;
		//}
		//return false;
	}

	public function getDOCinfo($name){
		$q = $this->db->query("SELECT * FROM DOCTOR WHERE NAME ='$name' ORDER BY DID");
		if($q->num_rows()>0){			
			return $q;
		}
		return $q;
		//return false;
	}


	public function getmedicalHistory($username){
		$q= $this->db->query("SELECT P.PID,D.NAME, D.SPECIALIZATION , H.STARTDATE , H.ENDDATE 
			FROM PATIENT P,DOCTOR D, PDHISTORY H 
			WHERE P.PID ='$username' AND P.PID = H.PID AND D.DID=H.DID ");
	
		if($q->result()>0){
			return $q;
		}
		return $q;
		 //return false;
	}

	public function getPrescription($username){
		$q = $this->db->query("SELECT PID AS PATIENTID , DID AS DOCTORID , PRESID AS PRESCRIPTIONID 
			FROM DOCPRESCRIBES WHERE PID='$username'");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row;
			}
			return $q;
		}
		return $q;
		//return false;

	}

	public function getPresDate($username){
		$q = $this->db->query("SELECT DISTINCT PR.BEGINDATE FROM DOCPRESCRIBES DP ,PATIENT P , PRES PR
			WHERE P.PID='$username' AND DP.PID = P.PID AND DP.PRESID = PR.PRESID ");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->BEGINDATE;
			}
			return $data;
		}
		return $data;
		//return false;

	}

	public function getSearchPrescription($docName , $date, $username){
		$q = null;
		if($docName !='All' && $date !='All'){
			$q = $this->db->query("SELECT P.NAME AS PATINET, D.NAME AS DOCTOR , M.NAME AS MEDICINE, PR.BEGINDATE ,
				PR.NUMBERTAKEN , PR.ENDDATE FROM PATIENT P, DOCTOR D, PRES PR, DOCPRESCRIBES DP, 
				MEDICINE M WHERE P.PID = DP.PID AND D.DID=DP.DID AND PR.PRESID = DP.PRESID AND 
				PR.MEDID = M.MEDID AND P.PID='$username' AND D.NAME = '$docName' AND PR.BEGINDATE='$date'");
		}
		else if($docName == 'All' && $date !='All'){
			$q = $this->db->query("SELECT P.NAME AS PATINET, D.NAME AS DOCTOR , M.NAME AS MEDICINE, PR.BEGINDATE ,
				PR.NUMBERTAKEN , PR.ENDDATE FROM PATIENT P, DOCTOR D, PRES PR, DOCPRESCRIBES DP, 
				MEDICINE M WHERE P.PID = DP.PID AND D.DID=DP.DID AND PR.PRESID = DP.PRESID AND 
				PR.MEDID = M.MEDID AND P.PID='$username' AND PR.BEGINDATE='$date'");

		}
		else if($docName !=  'All' && $date =='All'){
			$q = $this->db->query("SELECT P.NAME AS PATINET, D.NAME AS DOCTOR , M.NAME AS MEDICINE, PR.BEGINDATE , 
				PR.NUMBERTAKEN , PR.ENDDATE FROM PATIENT P, DOCTOR D, PRES PR, DOCPRESCRIBES DP, 
				MEDICINE M WHERE P.PID = DP.PID AND D.DID=DP.DID AND PR.PRESID = DP.PRESID AND 
				PR.MEDID = M.MEDID AND P.PID='$username' AND D.NAME = '$docName'");

		}
		else {
			$q = $this->db->query("SELECT P.NAME AS PATINET, D.NAME AS DOCTOR , M.NAME AS MEDICINE, PR.BEGINDATE , 
				PR.NUMBERTAKEN , PR.ENDDATE FROM PATIENT P, DOCTOR D, PRES PR, DOCPRESCRIBES DP, 
				MEDICINE M WHERE P.PID = DP.PID AND D.DID=DP.DID AND PR.PRESID = DP.PRESID AND 
				PR.MEDID = M.MEDID AND P.PID='$username' ");
		}
		return $q;
	}

	public function getAppoointmentinfo($status,$username){
		$sq = $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $sq->row()->SYSDATE;
		$q= null;
		if($status == 'Present'){
			$q= $this->db->query("SELECT D.NAME , PD.APPOINTDATE FROM DOCTOR D, PDAPPOINT PD ,PATIENT P
			 WHERE P.PID=PD.PID AND P.PID='$username' AND D.DID = PD.DID AND  PD.APPOINTDATE >= '$sysdate'");
		}
		else
		{
			$q= $this->db->query("SELECT D.NAME , PD.APPOINTDATE FROM DOCTOR D, PDAPPOINT PD ,PATIENT P
			 WHERE P.PID=PD.PID AND P.PID='$username' AND D.DID = PD.DID AND  PD.APPOINTDATE < '$sysdate'");

		}
		return $q;
	}
}