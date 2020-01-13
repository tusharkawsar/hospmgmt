<?php 
class Doc_model extends CI_Model{

	public function getDocinfo($username)
	{
		$this->db->where('DID',$username);
		$q = $this->db->get('DOCTOR');
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
			$data['specialization']=$row->SPECIALIZATION;
		}
		$data['info'] = $q;
		return $data;
	}


	public function updateDocinfo($username){
		$name = $this->input->post('docname');
		$address = $this->input->post('docaddress');
		$age = intval($this->input->post('docage'));
		$phone = intval($this->input->post('docphone'));
		$email = $this->input->post('docemail');
		$qualification = $this->input->post('docqualification');
		$specialization = $this->input->post('docspecialization');

		echo $qualification." ".$specialization;
		
		$this->db->query("UPDATE DOCTOR SET NAME='$name' , ADDRESS='$address', AGE=$age, 
			PHONE=$phone, EMAIL='$email', QUALIFICATION='$qualification', SPECIALIZATION='$specialization' 
			WHERE DID ='$username'");

	}

	public function getPTlistofDOC($username){
		$q = $this->db->query("SELECT  P.PID, P.NAME FROM DOCTOR D , PATIENT P , PDHISTORY PD 
			WHERE D.DID = PD.DID AND P.PID = PD.PID AND D.DID='$username' ORDER BY PID");
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

	public function getPTlistbyName($username){
		$name = $this->input->post('searchPTbyname');
		$q = $this->db->query("SELECT DISTINCT P.PID, P.NAME, P.AGE, P.ADDRESS ,P.EMAIL ,P.PHONE,P.BLOOD_GROUP,
		P.STATUS ,P.PTYPE FROM DOCTOR D , PATIENT P , PDHISTORY PD 
		WHERE D.DID = PD.DID AND P.PID = PD.PID AND D.DID='$username' AND P.NAME LIKE '% $name%' 
		OR P.NAME LIKE '$name%' ORDER BY PID");
		echo "SELECT DISTINCT P.PID, P.NAME FROM DOCTOR D , PATIENT P , PDHISTORY PD 
		WHERE D.DID = PD.DID AND P.PID = PD.PID AND D.DID='$username' AND P.NAME LIKE '% $name%' 
		OR P.NAME LIKE '$name%' ORDER BY PID";
		$data = null;
		if($q->num_rows()>0){
			return $q;
		}
		return $q;
		//return false;
	}

	public function getPTinfo($name){
		$q = $this->db->query("SELECT * FROM PATIENT WHERE NAME ='$name' ORDER BY PID");
		if($q->num_rows()>0){			
			return $q;
		}
		return $q;
		//return false;
	}

	public function getPTPresinfo($name){
		$docID = $this->session->userdata('username');
		$q = $this->db->query("SELECT P.NAME AS PATINET, D.NAME AS DOCTOR , M.NAME AS MEDICINE, PR.BEGINDATE , 
				PR.NUMBERTAKEN , PR.ENDDATE FROM PATIENT P, DOCTOR D, PRES PR, DOCPRESCRIBES DP, 
				MEDICINE M WHERE P.PID = DP.PID AND D.DID=DP.DID AND PR.PRESID = DP.PRESID AND 
				PR.MEDID = M.MEDID AND P.NAME='$name' AND D.DID = '$docID'");
		return $q;

	}

	public function getMedList(){
		$q = $this->db->query("SELECT NAME FROM MEDICINE ORDER BY MEDID");
		$data['name'] = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data['name'][] = $row->NAME;
			}
			return $data;
		}
		return false;
	}

	public function getPTlist($username){
		$q= $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $q->row()->SYSDATE;
		$data=null;
		//echo "hello $username bye";
		/*$sql = "SELECT DISTINCT P.PID FROM DOCTOR D, PDAPPOINT PD ,PATIENT P 
			WHERE P.PID=PD.PID AND PD.DID='D001' AND D.DID = PD.DID AND  
			PD.APPOINTDATE = '3-APR-14';";*/
		//echo $sql;
		$q = $this->db->query("SELECT DISTINCT P.PID FROM DOCTOR D, PDAPPOINT PD ,PATIENT P 
			WHERE P.PID=PD.PID AND PD.DID='$username' AND D.DID = PD.DID AND  
			PD.APPOINTDATE = '$sysdate'");
		if($q->num_rows()>0){
			$data=null;
			foreach($q->result() as $rows){
				$data[] = $rows->PID; 
			}
			echo $data[0];
			return $data;
		}
		//echo "false";
		return false;
	}

	public function viewSchedule($username){
		$q= $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $q->row()->SYSDATE;
		$num = $this->input->post('viewSchedule');
		if($num==0){
			$q = $this->db->query("SELECT WARDID, DID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,
			to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM DOCSCHEDULE WHERE STARTDATE >='$sysdate' 
				AND DID = '$username'");
		}
		else {
			$q = $this->db->query("SELECT WARDID, DID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE ,
				to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE  FROM DOCSCHEDULE WHERE STARTDATE <'$sysdate' 
				AND DID = '$username'");
		}
		return $q;
	}
	
}