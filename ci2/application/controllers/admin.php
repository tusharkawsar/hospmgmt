<?php 

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->is_logged_in();
	}

	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		$type = $this->session->userdata('type');

		if(!isset($is_logged_in) || $is_logged_in!= true || $type!='ADMIN'){
			redirect('login/no_permission','refresh');
		}
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$this->load->model('emp_model');
		//$username = 
		$data['query'] = $this->emp_model->getempinfo($data['username']);
		$data['username'] = $data['query']['name'];
		$data['hello'] = "Hello";
		$data['main_content']='admin_home';
		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');
		$this->load->view('includes/template',$data);
		//echo "hello";
	}

	public function create_employee_account(){
		$this->load->model('emp_model');
		if($this->input->post('Name')!=null)
			$data['success'] = $this->emp_model->addEmployee();
		$data['emptype'] = array('Doctor','Nurse','Other Employee');
		$data['main_content']='admin/create_employee_account';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function manage_leave(){

		$data['main_content']='admin/manage_leave';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_bed_status(){
		$this->load->model('emp_model');
		$bedstatus = $this->input->post('bed');
		$data['type'] = array('Available','Not Available');
		if($bedstatus!=null){
			$data['query'] = $this->emp_model->getbedstatus();
		}
		$data['main_content']='admin/view_bed_status';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_employee_profile(){
		$doc = $this->input->post('doctors');
		$nur = $this->input->post('nurses');
		$emp = $this->input->post('emp');
		$this->load->model('emp_model');

		$data['doclist'] = $this->emp_model->getDoclist();
		$data['nurselist'] = $this->emp_model->getNurselist();
		$data['emplist'] = $this->emp_model->getEMPlist();
		$data['main_content']='admin/view_employee_profile';
		if($doc !=null || $nur==null || $emp ==null){
			$data['queryd']= $this->emp_model->getdocinfo();
			$data['queryn']= $this->emp_model->getnurseinfo();
			$data['querye']= $this->emp_model->getemployeeinfo();
		}

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_employee_schedule(){

		$this->load->model('emp_model');
		$EMPtype = $this->input->post('EMPtype');
        $schType = $this->input->post('schType');
		$data['emptype'] = array('Doctor','Nurse','Other Employee');
		$data['schtype'] = array('Present','Past');
		if($EMPtype != null || $schType != null){
			$data['query'] = $this->emp_model->getScheduleofAll();
			echo $EMPtype." ".$schType;
		}


		$data['main_content']='admin/view_employee_schedule';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_patient_profile(){

		$pt = $this->input->post('pt');
		$Ptbyname = $this->input->post('searchPTByName');
		echo $Ptbyname;
		$this->load->model('emp_model');

		$data['ptlist'] = $this->emp_model->getPTlist();
		
		if($Ptbyname != null){
			$data['ptinfo'] = $this->emp_model->getPTlistbyName();
		}
		else if($pt !=null ){
			$data['query']= $this->emp_model->getPTinfo();			
		}

		$data['main_content']='admin/view_patient_profile';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_info(){

		$data['main_content']='admin/view_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function edit_info(){
		$this->load->model('Emp_model');
   		$username = $this->session->userdata('username');   
		$data = $this->Emp_model->getempinfo($username);

		$data['main_content']='admin/edit_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function update_info(){
		$this->load->model('Emp_model');
   		$username = $this->session->userdata('username');   
		$this->Emp_model->updateempinfo($username);

		redirect("admin/index");
	}

	public function view_schedule(){
		$data['scheduleList'] = array(
   				'Upcoming',
   				'Past'
   			);

		$num = $this->input->post('viewSchedule');
		$this->load->model('emp_model');
		$username = $this->session->userdata('username'); 
				
		if($this->input->post('viewSchedule')!=null)
		{
			//$name = $data['viewSchedule'][$num];
			$data['query'] = $this->emp_model->viewSchedule($username);
		}

		$data['main_content']='admin/view_schedule';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}


	public function change_password(){

		$data['main_content']='admin/change_password';

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
   			redirect("admin/index");
   		else 
   			echo "you made some mistake";
   		//redirect("patient/index");
	}



	public function log_out(){

		/*$data['main_content']='admin/log_out';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);*/
   		$this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
	}


	
}

