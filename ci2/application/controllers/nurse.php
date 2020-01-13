<?php 

class Nurse extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->is_logged_in();
	}

	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		$type = $this->session->userdata('type');

		if(!isset($is_logged_in) || $is_logged_in!= true || $type!='NURSE'){
			redirect('login/no_permission','refresh');
		}
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$this->load->model('Nurse_model');
		//$username = 
		$data['query'] = $this->Nurse_model->getnurseinfo($data['username']);
		$data['username'] = $data['query']['name'];
		
		$data['main_content']='nurse_home';
		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');
		$this->load->view('includes/template',$data);
		
	}

	public function view_info(){

		$data['main_content']='nurse/view_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function edit_info(){
		$this->load->model('Nurse_model');
   		$username = $this->session->userdata('username');   
		$data = $this->Nurse_model->getnurseinfo($username);

		$data['main_content']='nurse/edit_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function update_info(){
		$this->load->model('Nurse_model');
   		$username = $this->session->userdata('username');   
		$this->Nurse_model->updatenurseinfo($username);

		redirect("nurse/index");
	}

	public function view_schedule(){

		$data['scheduleList'] = array(
   				'Upcoming',
   				'Past'
   			);

		$num = $this->input->post('viewSchedule');
		$this->load->model('Nurse_model');
		$username = $this->session->userdata('username'); 
				
		if($this->input->post('viewSchedule')!=null)
		{
			//$name = $data['viewSchedule'][$num];
			$data['query'] = $this->Nurse_model->viewSchedule($username);
		}

		$data['main_content']='nurse/view_schedule';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}


	public function change_password(){

		$data['main_content']='nurse/change_password';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function update_password(){


		$this->load->model('Login_model');
   		$username = $this->session->userdata('username');   
		$success = $this->Login_model->updatepassword($username);
		if($success)
   			redirect("nurse/index");
   		else 
   			echo "you made some mistake";
   		//redirect("patient/index");
	}

	public function log_out(){
		
   		$this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
	}


	
}

