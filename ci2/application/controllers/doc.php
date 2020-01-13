<?php 

class Doc extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->is_logged_in();
	}

	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		$type = $this->session->userdata('type');

		if(!isset($is_logged_in) || $is_logged_in!= true || $type!='DOCTOR'){
			redirect('login/no_permission','refresh');
		}
	}

	public function index()
	{
		$data['username'] = $this->session->userdata('username');
		$this->load->model('Doc_model');
		//$username = 
		$data['query'] = $this->Doc_model->getDocinfo($data['username']);
		$data['username'] = $data['query']['name'];
		
		
		
		$data['hello'] = "Hello";
		$data['main_content']='doc_home';
		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');
		$this->load->view('includes/template',$data);
		//echo "hello";
	}

	public function view_patient_info(){

		$data['main_content']='doc/view_patient_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_patient_history(){

		$username = $this->session->userdata('username');
		$num = $this->input->post('patients');
		$this->load->model('Doc_model');
		$data['queryAll'] = $this->Doc_model->getPTlistofDOC($username);
		if($this->input->post('searchPTbyname')!=null ){
			$data['query'] = $this->Doc_model->getPTlistbyName($username);		
		}
				
		if($this->input->post('patients')!=null)
		{
			$name = $data['queryAll']['name'][$num];
			$data['ptinfo'] = $this->Doc_model->getPTinfo($name);
			$data['ptpres'] = $this->Doc_model->getPTPresinfo($name);
		}
		

		$data['main_content']='doc/view_patient_history';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function give_prescription(){
		$num = $this->input->post('medList');
		$this->load->model('Doc_model');
		$username = $this->session->userdata('username');   
		$data['queryAll'] = $this->Doc_model->getMedList();
		if(!$this->Doc_model->getPTlist($username))
			$data['ptlist'] = $this->Doc_model->getPTlist($username);
		else 
			$data['ptlist'] =null;
		
		
		if($this->input->post('medList')!=null ){
			//$data['query'] = $this->Doc_model->getPTlistbyName();		
		}
				
		if($this->input->post('medList')!=null)
		{
			//$name = $data['queryAll']['name'][$num];
			//$data['ptinfo'] = $this->Doc_model->getPTinfo($name);
		}
		$data['dosage'] = array(
			'1+1+1',
			'1+0+1',
			'1+1+1',
			'0+1+1',
			'0+1+0',
			'0+0+1',
			'1+0+0'
			);

		$data['main_content']='doc/give_prescription';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function add_prescription(){
		$this->load->model('Doc_model');
		$username = $this->session->userdata('username');  
		$data['queryAll'] = $this->Doc_model->getMedList();
		$data['ptlist'] = $this->Doc_model->getPTlist($username); 
		$data['dosage'] = array(
			'1+1+1',
			'1+0+1',
			'1+1+1',
			'0+1+1',
			'0+1+0',
			'0+0+1',
			'1+0+0'
			);

		

		$this->Doc_model->addPres();
	}

	public function add_patient(){

		$data['main_content']='doc/add_patient';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function search_for_doc(){

		$data['main_content']='doc/search_for_doc';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_info(){

		$data['main_content']='doc/view_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function edit_info(){
		$this->load->model('Doc_model');
   		$username = $this->session->userdata('username');   
		$data = $this->Doc_model->getDocinfo($username);

		$data['main_content']='doc/edit_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function update_info(){
		$this->load->model('Doc_model');
   		$username = $this->session->userdata('username');   
		$this->Doc_model->updateDocinfo($username);

		redirect("doc/index");
	}

	public function view_schedule(){

		$data['scheduleList'] = array(
   				'Upcoming',
   				'Past'
   			);

		$num = $this->input->post('viewSchedule');
		$this->load->model('Doc_model');
		$username = $this->session->userdata('username'); 
				
		if($this->input->post('viewSchedule')!=null)
		{
			//$name = $data['viewSchedule'][$num];
			$data['query'] = $this->Doc_model->viewSchedule($username);
		}

		$data['main_content']='doc/view_schedule';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}


	public function change_password(){

		$data['main_content']='doc/change_password';

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
   			redirect("doc/index");
   		else 
   			echo "you made some mistake";
   		//redirect("patient/index");
	}


	public function log_out(){

		/*$data['main_content']='doc/view_schedule';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);*/
   		$this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
	}


	
}

