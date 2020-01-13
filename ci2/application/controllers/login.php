<?php 

class Login extends CI_Controller {

	public function index()
	{
		
		$data['main_content']='login_form';
		//$this->load->model('HMS_model');
		//$data['records'] = $this->HMS_model->getAll();
		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');
		$this->load->view('includes/template',$data);
		//echo "hello";
	}

	public function validate_credentials(){
		echo "hello";
		$this->load->model('login_model');
		$query = $this->login_model->validate();
		echo $query['type'];
		echo $query['success'];
		if($query['success']){
			$data = array(
				'username' => $query['username'],
				'type' => $query['type'],
				'flag' => 0,
				'is_logged_in' => true
			);
			$this->session->set_userdata($data);

			if($query['type']=="PATIENT")redirect('patient/index');
			else if($query['type']=="DOCTOR")redirect('doc/index');
			else if($query['type']=="ADMIN")redirect('admin/index');
			else if($query['type']=="RCP")redirect('rcp/index');
			else if($query['type']=="NURSE")redirect('nurse/index');
			//echo "success";
		}

		else{
			$this->index();
		}
		//echo $query;
	}

	

	public function no_permission(){
		$this->load->view('no_permission');
	}
	
}

