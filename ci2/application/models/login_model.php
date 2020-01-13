<?php 
class login_model extends CI_Model{
	function validate(){
		/*$this->db->where('USERNAME',$this->input->post('Username'));
		$this->db->where('PASSWORD',$this->input->post('Password'));
		$q = $this->db->get('LOGIN');*/
		$data = null;
		
		$username = $this->input->post('Username');
		$password = $this->input->post('Password');
		$q=$this->db->query("SELECT * FROM LOGIN WHERE USERNAME='$username' AND PASSWORD = '$password'");

		if($q->num_rows==1){
			$row =  $q->row();
			$data['username'] = $row->USERNAME;
			$data['type'] = $row->TYPE;
			echo $data['type'];
			$data['success'] = true;
			echo $data['success'];
		}
		//echo "failed";
		return $data;
	}

	public function updatepassword($username){
		$curPassword = $this->input->post('curPassword');
		$newPassword = $this->input->post('NewPassword');
		$newPasswordAgain = $this->input->post('NewPasswordAgain');
		$pw=null;
		$q = $this->db->query("SELECT PASSWORD FROM LOGIN WHERE USERNAME='$username'");
		if($q->num_rows==1){
			$row = $q->row();
			$pw = $row->PASSWORD;
		}
		if($curPassword==$pw and $newPassword==$newPasswordAgain){
			$this->db->query("UPDATE LOGIN SET PASSWORD='$newPassword' WHERE USERNAME='$username'");
			return true;
		}
		return false;
	}

	
}