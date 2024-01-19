<?php 

class department_ctr extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true )
		{
		  redirect('login');
			//echo '<font color="#FF0000" size="5">You don\'t have permission to access this page. </font>'; echo anchor(site_url('login'),'<font color="#0000FF" size="5">Login</font>','title="login"');
			//die();
		}
	}
	
	function index()
	{
		$this->add();
	}
	
	function add($msg="")
	{
		$data				= $this->_load_data();
		$data['action'] 	= 'Add';
		$data['msg']		= $msg;
		$data['main_content']='department/dept.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function edit($id = "",$msg = "")
	{
		$data				= $this->_load_data($id);
		$data['action'] 	= 'Edit';
		$data['msg']		= $msg;
		$data['main_content']='department/dept.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function delete($id ="",$msg = "")
	{
		$data				= $this->_load_data($id);
		$data['action'] 	= 'Delete';
		$data['msg']		= $msg;
		$data['main_content']='department/dept.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function view($id = "",$msg = "")
	{
		$data				= $this->_load_data($id);
		$data['action'] 	= 'View';
		$data['main_content']='department/dept.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function validate()
	{
		if($this->input->post('action') == 'Add'){
			$this->form_validation->set_rules('Dept_id','Department Code','trim|required|alpha_dash|is_unique['.DEPT_TBL.'.Dept_id]');
		}
		if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
			$this->form_validation->set_rules('Dept_name','Department Name','trim|required');
			$this->form_validation->set_rules('dept_description','Department Description','trim|required');
			$this->form_validation->set_rules('comp_id','Company','trim|required');
		}
		if($this->input->post('action')=='Delete')
		{
		$this->form_validation->set_rules('Dept_id', 'Department Code', 'has_transactions['.EMP_PROFILE.'.Dept_id]');
		}
		if($this->input->post('action') == 'View'){
			$this->view();
		}
		if($this->form_validation->run() == FALSE){
			switch($this->input->post('action')){
				case 'Add':
					$this->add();
				break;
				case 'Edit':
					$this->edit($this->input->post('Dept_id'));
				break;
				case 'Delete':
					$this->delete($this->input->post('Dept_id'));
				break;
				
			}
		}else{
			switch($this->input->post('action')){
				case 'Add':
					$this->create();
				break;
				case 'Edit':
					$this->update();
				break;
				case 'Delete':
					$this->remove();
				break;
				
			}
		}
	}
	
	function _load_data($id="")
	{
		$this->load->model('company_model');
		$this->load->model('department_model');
		$data['dept'] = array('Dept_id'=>'','Dept_id'=>'','Dept_name'=>'','dept_description'=>'','comp_id'=>'');
		$cmp = $this->company_model->get_combo_res();
		$data['company'] = get_combo_from_results($cmp,'comp_id','com_name','Please select a company');
		
		if($id != ''){
			$data['dept'] = $this->department_model->get_dept_by_id($id);
		}
		
		return $data;
		
	}//load_data
	
	function create()
	{
		if(!empty($_POST)){
			$this->load->model('department_model');	
			$id = $this->department_model->insert($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_ADD);
				redirect('department_ctr/edit/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('department_ctr/add/');
			}
		}
	}//create
	
	function update()
	{
		if(!empty($_POST))	{
			$this->load->model('department_model');	
			$id = $this->department_model->edit($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_UPDATE);
				redirect('department_ctr/edit/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('department_ctr/edit/'.$id);
			}
		}
	}//update
	
	function remove()
	{
		if(!empty($_POST)){
			$this->load->model('department_model');
			$id = $this->department_model->delete($this->input->post('Dept_id'));
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_DELETE);
				redirect('department_ctr/');
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('department_ctr/delete/'.$id);
			}
		}
	}//remove
}