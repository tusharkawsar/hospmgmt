<?php 

class rcp extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->is_logged_in();
	}

	function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		$type = $this->session->userdata('type');

		if(!isset($is_logged_in) || $is_logged_in!= true || $type!='RCP'){
			redirect('login/no_permission','refresh');
		}
	}

	public function index()
	{
		$this->load->model('emp_model');
   		$username = $this->session->userdata('username');   
		$data['query'] = $this->emp_model->getempinfo($username);
		$data['username'] = $data['query']['name'];
		$data['hello'] = "Hello";
		$data['main_content']='rcp_home';
		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');
		$this->load->view('includes/template',$data);
		//echo "hello";
	}

	public function create_patient_account(){
		$this->load->model('emp_model');
		if($this->input->post('Name')!=null)
			$data['success'] = $this->emp_model->addpatient();

		$data['main_content']='rcp/create_patient_account';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function manage_leave(){

		$data['main_content']='rcp/manage_leave';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function appointment_assign(){
		$this->load->model('emp_model');
   		$username = $this->session->userdata('username'); 
   		$data['date'] = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15',
   			'16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'); 
   		$data['month'] = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
   		$data['year'] = array('2014','2015');
   		$data['ptlist'] = $this->emp_model->getPID();
   		$data['doclist'] = $this->emp_model->getDID();
   		if($this->input->post('choosePTbyPID')!=null)
			$data['query'] = $this->emp_model->addappointment();

		$data['main_content']='rcp/appointment_assign';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function bed_assign(){

		$this->load->model('emp_model');
   		$username = $this->session->userdata('username'); 
   		$data['ptlist'] = $this->emp_model->getNOTOutdoorPTID();
   		$data['bedlist'] = $this->emp_model->getBedID();
   		if($this->input->post('choosePTbyPID')!=null 
   			&& $this->input->post('choosebedbyBedID')!=null){
   			$data['bedinfo'] = $this->emp_model->assignbed();
   		}

		$data['main_content']='rcp/bed_assign';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_patient_profile(){
		$this->load->model('emp_model');
   		$username = $this->session->userdata('username');  

   		if($this->input->post('searchPTByName')!=null){
   			$data['query'] = $this->emp_model->getPTlistbyName();
   		}
   		else if($this->input->post('searchPTByPhone')!=null){
   			$data['query'] = $this->emp_model->getPTlistbyPhone();
   		}
   		else if($this->input->post('searchPTBystatus')!=null || 
                  $this->input->post('searchPTByType')!=null){
   			$data['query'] = $this->emp_model->getPTlistbyStatusandType();
   		}

   		$data['status'] = array('Current', 'Formaer');
   		$data['type'] = array('Indoor', 'Outdoor');

		$data['main_content']='rcp/view_patient_profile';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function view_info(){

		$data['main_content']='rcp/view_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function edit_info(){
		$this->load->model('Emp_model');
   		$username = $this->session->userdata('username');   
		$data = $this->Emp_model->getempinfo($username);

		$data['main_content']='rcp/edit_info';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}

	public function update_info(){
		$this->load->model('Emp_model');
   		$username = $this->session->userdata('username');   
		$this->Emp_model->updateempinfo($username);

		redirect("rcp/index");
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

		$data['main_content']='rcp/view_schedule';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);
	}


	public function change_password(){

		$data['main_content']='rcp/change_password';

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
   			redirect("rcp/index");
   		else 
   			echo "you made some mistake";
   		//redirect("patient/index");
	}

	public function log_out(){

		/*$data['main_content']='rcp/log_out';

		$data['base']= $this->config->item('base_url');
   		$data['css']= $this->config->item('css');
   		$data['images'] = $this->config->item('images');

   		$this->load->view('includes/template',$data);*/
   		$this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        redirect('login', 'refresh');
	}


	
}

