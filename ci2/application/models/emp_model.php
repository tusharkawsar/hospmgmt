<?php 
class Emp_model extends CI_Model{

	public function getempinfo($username)
	{
		$this->db->where('EID',$username);
		$q = $this->db->get('EMP');
		$q = $this->db->query("SELECT * FROM EMP WHERE EID ='$username'");
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

	public function getempinfoasquery($username)
	{
		//$this->db->where('EID',$username);
		//$q = $this->db->get('EMP');
		$q = $this->db->query("SELECT * FROM EMP WHERE EID ='$username'");
		return $q;
	}



	public function updateempinfo($username){
		$name = $this->input->post('adname');
		$address = $this->input->post('adaddress');
		$age = intval($this->input->post('adage'));
		$phone = intval($this->input->post('adphone'));
		$email = $this->input->post('ademail');
		$qualification = $this->input->post('adqualification');
		

		//echo $qualification." ".$specialization;
		
		$this->db->query("UPDATE EMP SET NAME='$name' , ADDRESS='$address', AGE=$age, 
			PHONE=$phone, EMAIL='$email', QUALIFICATION='$qualification'
			WHERE EID ='$username'");

	}
	
	public function getPTlistbyName(){
		$name = $this->input->post('searchPTByName');
		echo $name;
		$q = $this->db->query("SELECT * FROM PATIENT WHERE NAME LIKE '%$name%'");
		return $q;

	}

	public function getPTlistbyPhone(){
		$phone = $this->input->post('searchPTByPhone');
		$q = $this->db->query("SELECT * FROM PATIENT WHERE PHONE LIKE '$phone%'");
		return $q;
	}

	public function getPTlistbyStatusandType(){
		$status = $this->input->post('searchPTBystatus');
		$type = $this->input->post('searchPTByType');
		$status_array = array('CURRENT','FORMER');
		$type_array = array('INDOOR','OUTDOOR');
		$status_value = $status_array[$status];
		$type_value = $type_array[$type];
		echo $status_value;
		echo $type_value;
		if($status != null &&  $type != null){
			$q = $this->db->query("SELECT * FROM PATIENT WHERE STATUS='$status_value' AND PTYPE ='$type_value'");
		}
		else if($status!= null && $type == null ){
			$q = $this->db->query("SELECT * FROM PATIENT WHERE STATUS='$status_value'");
		}
		else if($status == null && $type != null ){
			$q = $this->db->query("SELECT * FROM PATIENT WHERE  PTYPE ='$type_value'");
		}
		return $q;
	}

	public function addappointment(){
		//$this->db->query("EXECUTE ADDAPPOINT('P003', 'D005', '01-APR-2014')");

		$q= $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $q->row()->SYSDATE;
		$date1 = new DateTime($sysdate);
		$data['date'] = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15',
   			'16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'); 
   		$data['month'] = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
   		$data['year'] = array('2014','2015');
   		$data['ptlist'] = $this->emp_model->getPID();
   		$data['doclist'] = $this->emp_model->getDID();
		$pid = $this->input->post('choosePTbyPID');
		$did = $this->input->post('chooseDOCbyDID');
		$date = $this->input->post('chooseDate');
		$month = $this->input->post('choosemonth');
		$year = $this->input->post('chooseYear');
		$appointdate = $data['date'][$date].'-'.$data['month'][$month].'-'.$data['year'][$year];
		$pidinsert = $data['ptlist'][$pid];
		$didinsert = $data['doclist'][$did];

		$date2 = new DateTime($appointdate);

		$q = $this->db->query("SELECT * FROM PDAPPOINT WHERE PID = '$pidinsert' AND DID ='$didinsert'
			AND APPOINTDATE = '$appointdate'");
		if($q->num_rows()!=0 )
			echo "Already Exist";
		else if($date1 > $date2)
			echo "past date";
		else
			$this->db->query("INSERT INTO PDAPPOINT VALUES ('$pidinsert','$didinsert','$appointdate')");

		$q = $this->db->query("SELECT * FROM PDAPPOINT WHERE DID ='$didinsert' 
			AND APPOINTDATE='$appointdate'");

		if($q->num_rows>0)return $q;
		else return false;
		 
	}

	public function getPID(){
		$q = $this->db->query("SELECT PID FROM PATIENT ORDER BY PID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->PID;
			}
			//$data['name']= array_unique($data['name']);
			return $data;
		}
		return false;

	}

	public function getDID(){
		$q = $this->db->query("SELECT DID FROM DOCTOR ORDER BY DID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->DID;
			}
			//$data['name']= array_unique($data['name']);
			return $data;
		}
		return false;
	}

	public function getBedID(){
		$q = $this->db->query("SELECT BEDID FROM BED WHERE BEDTYPE = 'AVAILABLE' ORDER BY BEDID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->BEDID;
			}
			//$data['name']= array_unique($data['name']);
			return $data;
		}
		return false;
	}

	public function getNOTOutdoorPTID(){
		$q = $this->db->query("SELECT PID FROM PATIENT WHERE PTYPE <> 'INDOOR' OR STATUS = 'FORMER' 
			ORDER BY PID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->PID;
			}
			//$data['name']= array_unique($data['name']);
			return $data;
		}
		return false;
	}

	public function assignbed(){
		$q= $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $q->row()->SYSDATE;
		$num1 = $this->input->post('choosePTbyPID');
		$num2 = $this->input->post('choosebedbyBedID');
		$data['ptlist'] = $this->emp_model->getNOTOutdoorPTID();
   		$data['bedlist'] = $this->emp_model->getBedID();
   		$ptval = $data['ptlist'][$num1];
   		$bedval = $data['bedlist'][$num2];
   		$q = $this->db->query("SELECT * FROM PATIENTBED WHERE PID ='$ptval' AND BEDID='$bedval' AND STARTDATE='$sysdate'");
   		$data['success'] = false;
   		if($q->num_rows()==0){
			$this->db->query("INSERT INTO PATIENTBED VALUES ('$ptval','$bedval','$sysdate',NULL)");
			$data['success'] = true;
		}
		$data['query'] = $this->db->query("SELECT * FROM PATIENTBED WHERE ENDDATE IS NULL");

		return $data;
	}

	public function getDoclist(){
		//$q = $this->db->query("SELECT DID,NAME FROM DOCTOR ORDER BY DID");
		$q = $this->db->query("SELECT  DID,NAME FROM DOCTOR ORDER BY DID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->NAME;
			}
			$data= array_unique($data);
			return $data;
		}
		return false;
	}

	public function getdocinfo(){
		$list = $this->getDoclist();
		$num = $this->input->post('doctors');
		$name = $list[$num];
		$q = $this->db->query("SELECT  * FROM DOCTOR WHERE NAME = '$name' ORDER BY DID");
		if($q->num_rows>0)return $q;
		else return false;
	}

	public function getNurselist(){
		//$q = $this->db->query("SELECT DID,NAME FROM DOCTOR ORDER BY DID");
		$q = $this->db->query("SELECT  NID,NAME FROM NURSE ORDER BY NID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->NAME;
			}
			$data= array_unique($data);
			return $data;
		}
		return false;
	}

	public function getnurseinfo(){
		$list = $this->getNurselist();
		$num = $this->input->post('nurses');
		$name = $list[$num];
		$q = $this->db->query("SELECT  * FROM NURSE WHERE NAME = '$name' ORDER BY NID");
		if($q->num_rows>0)return $q;
		else return false;
	}

	public function getEMPlist(){
		//$q = $this->db->query("SELECT DID,NAME FROM DOCTOR ORDER BY DID");
		$q = $this->db->query("SELECT  EID,NAME FROM EMP ORDER BY EID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->NAME;
			}
			$data= array_unique($data);
			return $data;
		}
		return false;
	}

	public function getemployeeinfo(){
		$list = $this->getEMPlist();
		$num = $this->input->post('emp');
		$name = $list[$num];
		$q = $this->db->query("SELECT  * FROM EMP WHERE NAME = '$name' ORDER BY EID");
		if($q->num_rows>0)return $q;
		else return false;
	}


	public function getPTlist(){
		//$q = $this->db->query("SELECT DID,NAME FROM DOCTOR ORDER BY DID");
		$q = $this->db->query("SELECT  PID,NAME FROM PATIENT ORDER BY PID");
		$data = null;
		if($q->num_rows()>0){
			foreach($q->result() as $row){
				$data[] = $row->NAME;
			}
			$data= array_unique($data);
			return $data;
		}
		return false;
	}

	public function getPTinfo(){
		$list = $this->getPTlist();
		$num = $this->input->post('pt');
		$name = $list[$num];
		$q = $this->db->query("SELECT  * FROM PATIENT WHERE NAME LIKE '% $name%' OR NAME LIKE '$name%' ORDER BY PID");
		if($q->num_rows>0)return $q;
		else return false;
	}

	public function getbedstatus(){
		$num = $this->input->post('bed');
		if($num==0){
			$q = $this->db->query("SELECT * FROM BED WHERE BEDTYPE = 'AVAILABLE'");
		}
		else{
			$q = $this->db->query("SELECT DISTINCT B.BEDID, P.PID ,P.NAME ,  B.RENT ,B.WARDID FROM PATIENT P, 
				BED B , PATIENTBED PB WHERE P.PID = PB.PID AND B.BEDID = PB.BEDID
				B.BEDTYPE = 'NOT AVAILABLE'");

		} 
		return $q;

	}

	public function addpatient(){
		$name = $this->input->post('Name');
		$add = $this->input->post('Address');
		$age = intval($this->input->post('Age'));
		$phone = $this->input->post('Phone');
		$bgroup = $this->input->post('Blood Group');
		$email = $this->input->post('Email');
		$ptype = 'OUTDOOR';

		$pid = 'Pxyz';
		$this->db->query("INSERT INTO PATIENT VALUES ('$pid','$name','$add',$age,'$phone','$bgroup',
			NULL,'$email','$ptype')");
		return true;
	}

	public function viewSchedule($username){
		$q= $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $q->row()->SYSDATE;
		$num = $this->input->post('viewSchedule');
		if($num==0){
			$q = $this->db->query("SELECT PLACEID, EID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,
			to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM EMPSCHEDULE WHERE STARTDATE >='$sysdate' 
				AND EID = '$username'");
		}
		else {
			$q = $this->db->query("SELECT PLACEID, EID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE ,
				to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE  FROM EMPSCHEDULE WHERE STARTDATE <'$sysdate' 
				AND EID = '$username'");
		}
		return $q;
	}

	public function getScheduleofAll(){
		$q= $this->db->query("SELECT SYSDATE FROM DUAL");
		$sysdate = $q->row()->SYSDATE;
		$EMPtype = $this->input->post('EMPtype');
        $schType = $this->input->post('schType');
        if($EMPtype == 0 and $schType==0){
        	$q = $this->db->query("SELECT WARDID, DID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE, to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM DOCSCHEDULE WHERE STARTDATE >='$sysdate'");
        	echo "SELECT WARDID, DID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM DOCSCHEDULE WHERE STARTDATE >='$sysdate'";
        }
        else if($EMPtype == 1 and $schType==0){
        	$q = $this->db->query("SELECT WARDID, NID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM NURSESCHEDULE WHERE STARTDATE >='$sysdate'");
        	echo "SELECT WARDID, NID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM NURSESCHEDULE WHERE STARTDATE >='$sysdate'";
        }
        else if($EMPtype == 2 and $schType==0){
        	$q = $this->db->query("SELECT WARDID, EID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM EMPSCHEDULE WHERE STARTDATE >='$sysdate'");
        	echo "SELECT WARDID, EID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM EMPSCHEDULE WHERE STARTDATE >='$sysdate'";
        }
        else if($EMPtype == 0 and $schType==1){
        	$q = $this->db->query("SELECT WARDID, DID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM DOCSCHEDULE WHERE STARTDATE <'$sysdate'");
        	echo "SELECT WARDID, DID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM DOCSCHEDULE WHERE STARTDATE <'$sysdate'";
        }
        else if($EMPtype == 1 and $schType==1){
        	$q = $this->db->query("SELECT WARDID, NID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM NURSESCHEDULE WHERE STARTDATE <'$sysdate'");
        	echo "SELECT WARDID, NID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM NURSESCHEDULE WHERE STARTDATE <'$sysdate'";
        }
        else if($EMPtype == 2 and $schType==1){
        	$q = $this->db->query("SELECT WARDID, EID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM EMPSCHEDULE WHERE STARTDATE <'$sysdate'");
        	echo "SELECT WARDID, EID, to_char(STARTDATE,'yyyy/mm/dd hh:mi:ss AM') AS STARTDATE,to_char(ENDDATE,'yyyy/mm/dd hh:mi:ss AM') AS ENDDATE FROM EMPSCHEDULE WHERE STARTDATE <'$sysdate'";
        }
        return $q;
	}

	public function addEmployee(){
		$name = $this->input->post('Name');
		$add = $this->input->post('Address');
		$age = intval($this->input->post('Age'));
		$phone = $this->input->post('Phone');
		$bgroup = $this->input->post('Blood Group');
		$email = $this->input->post('Email');
		$qualification = $this->input->post('Qualification');
		$specialization = $this->input->post('Specialization');
		$salary = intval($this->input->post('Salary'));
		

		$Did = 'Dxyz';
		$Eid = 'Exyz';
		$Nid = 'Nxyz';

		$type = $this->input->post('EMPtype');
		echo $type;
		if($type == 0){
			$this->db->query("INSERT INTO DOCTOR VALUES ('$Did','$name','$add','$phone',$age,'CURRENT',
			'$email','$qualification','$specialization',$salary)");
			return true;
		}
		else if($type == 1){
			$this->db->query("INSERT INTO NURSE VALUES ('$Nid','$name','$add',$age,'$phone','CURRENT',
			'$email','$qualification',$salary)");
			return true;

		}else if($type == 2){
			$this->db->query("INSERT INTO EMP VALUES ('$Eid','$name','$add','$phone',$age,'CURRENT',
			'$email','$qualification','RECEPTIONIST',$salary)");
			return true;

		}
		return false;
		
	}
}