<?php 

class patient extends CI_Controller {


	function __construct(){
		parent::__construct();
		$this->is_logged_in();
	}

	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		$type = $this->session->userdata('type');

		if(!isset($is_logged_in) || $is_logged_in!= true || $type!='PATIENT'){
			redirect('login/no_permission','refresh');
		}
	}

	public function index()
	{
		$this->load->model('Patient_model');
   		$username = $this->session->userdata('username');   
		$data['query'] = $this->Patient_model->getPatientInfo($username);
		$data['username'] = $data['query']['name'];
		$data['main_content']='patient_home';
		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');
   		$data['username'] = $username;
   				
		$this->load->view('includes/template',$data);
	}

	public function search_for_doctors(){
		$num = $this->input->post('doctors');
		$this->load->model('Patient_model');
		$data['queryAll'] = $this->Patient_model->getDOClist();
		if($this->input->post('searchDOCbyname')!=null ){
			$data['query'] = $this->Patient_model->getDOClistbyName();		
		}
				
		if($this->input->post('doctors')!=null)
		{
			$name = $data['queryAll']['name'][$num];
			$data['docinfo'] = $this->Patient_model->getDOCinfo($name);
		}
		

		$data['main_content']='patient/search_for_doctors';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		

   		$this->load->view('includes/template',$data);
	}

/*	public function update_serach(){
		$num = $this->input->post('doctors');
		$this->load->model('Patient_model');
		$data['query'] = $this->Patient_model->getDOClist();
		$name = $data['query']['name'][$num];

		$data['query'] = $this->Patient_model->getDOCinfo($name);
		//echo "$name";
		$data['main_content']='patient/search_for_doctors';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		echo $this->table->generate($data['query']);
   		//$this->load->view('includes/template',$data);
	}*/

	public function view_appointment_schedule(){
		$data['AppointmentType'] = array(
   				'Present',
   				'Past'
   			);

		$num = $this->input->post('viewAppointment');
		$this->load->model('Patient_model');
		$username = $this->session->userdata('username'); 
				
		if($this->input->post('viewAppointment')!=null)
		{
			$name = $data['AppointmentType'][$num];
			$data['query'] = $this->Patient_model->getAppoointmentinfo($name,$username);
		}

		$data['main_content']='patient/view_appointment_schedule';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		

   		$this->load->view('includes/template',$data);
	}

	public function view_dues_status(){

		$data['main_content']='patient/view_dues_status';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_medical_history(){
		$this->load->model('Patient_model');
		$username = $this->session->userdata('username'); 
		$data['query'] = $this->Patient_model->getmedicalHistory($username);

		$data['main_content']='patient/view_medical_history';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_prescription(){
		$this->load->model('Patient_model');
   		$username = $this->session->userdata('username');   
		$data['pres'] = $this->Patient_model->getPrescription($username);


		$num = $this->input->post('searchPresByDOC');
		$data['queryAll'] = $this->Patient_model->getDOClist();
		$data['queryAll']['name'][] = 'All';

		
		$num2 = $this->input->post('searchPresByDate');
		$data['queryDate'] = $this->Patient_model->getPresDate($username);
		$data['queryDate'][] = 'All';

				
		if($this->input->post('searchPresByDOC')!=null && $this->input->post('searchPresByDate')!=null)
		{
			$docname = $data['queryAll']['name'][$num];
			$date = $data['queryDate'][$num2];
			
			$data['query'] = $this->Patient_model->getSearchPrescription($docname,$date,$username);
		}
		

		$data['main_content']='patient/view_prescription';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}


	public function view_info(){

		$data['main_content']='patient/view_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function edit_info(){
		$this->load->model('Patient_model');
   		$username = $this->session->userdata('username');   
		$data = $this->Patient_model->getPtinfo($username);

		$data['main_content']='patient/edit_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function update_info(){
		$this->load->model('Patient_model');
   		$username = $this->session->userdata('username');   
		$this->Patient_model->updatePtinfo($username);

		redirect("patient/index");
	}

	public function change_password(){

		$data['main_content']='patient/change_password';

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
   			redirect("patient/index");
   		else 
   			echo "you made some mistake";
   		//redirect("patient/index");
	}


	public function log_out(){

		/*$data['main_content']='patient/log_out';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);*/
   		/*$data = array(
				//'username' => null,
				'type' => null,
				//'is_logged_in' => false
			);*/
		$this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
	}


	
}

