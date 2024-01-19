<?php 
class company_ctr extends CI_Controller{
	
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
		$data['main_content'] = 'company/company';
		$this->load->view('includes/template.php',$data);
	}
	
	function add($msg = '')
	{
		$data 					= $this->_load_data();
		$data['action'] 		= 'Add';
		$data['msg'] 			= $msg;
		$data['main_content'] 	= 'company/companyMgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function edit($id = '',$msg = '')
	{
		$data 					= $this->_load_data($id);
		$data['action'] 		= 'Edit';
		$data['msg'] 			= $msg;
		$data['main_content'] 	= 'company/companyMgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function delete($id = '', $msg = '')
	{
		$data					= $this->_load_data($id);
		$data['action']			= 'Delete';
		$data['msg']			= $msg;
		$data['main_content'] 	= 'company/companyMgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function view($id = '')
	{
		$data					= $this->_load_data($id);
		$data['action']			= 'View';
		$data['main_content'] 	= 'company/companyMgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function validate()
	{
		if($this->input->post('action') == 'Add'){
		$this->form_validation->set_rules('comp_id','Company ID','trim|required|alpha_dash|is_unique['.COMPANY.'.comp_id]');	
		$this->form_validation->set_rules('com_name','Company Name','trim|required|is_unique['.COMPANY.'.com_name]');
		}
		if($this->input->post('action') != 'Delete'){
		$this->form_validation->set_rules('com_postal_code','Postal Code','trim|required');
		$this->form_validation->set_rules('com_contact_Address_line1','Address Line 1','trim|required');
		$this->form_validation->set_rules('com_contact_Address_line2','Address Line 2','trim|required');
		$this->form_validation->set_rules('com_contact_no','Contact Number','trim|required|max_length[10]|numeric');
		}
		if($this->input->post('action') == 'View'){redirect('company_ctr');}
		if($this->input->post('action')=='Delete')
		{
		$this->form_validation->set_rules('comp_id', 'Company ID', 'has_transactions['.DEPT_TBL.'.comp_id]');
		}
		//if($this->input->post('action') == 'Delete'){$this->remove();}
		
		if($this->form_validation->run() == FALSE){
			switch($this->input->post('action')){
				case 'Add':
					$this->add();
				break;
				case 'Edit':
					$this->edit($this->input->post('comp_id'));
				break;
				case 'Delete':
					$this->delete($this->input->post('comp_id'));
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
	}//validate
	
	function _load_data($id = '')
	{
		$this->load->model('company_model');
		$data['company'] = array(
			'comp_id'					=> '',
			'com_name'					=> '',
			'com_postal_code'			=> '',
			'com_contact_Address_line1'	=> '',
			'com_contact_Address_line2'	=> '',
			'com_contact_no'			=> ''
			
		);
		if($id != ''){
			$data['company'] = $this->company_model->get_data_by_id($id);
		}
		return $data;
	}//_load_data
		
	function create()
	{
		$this->load->model('company_model');
		if(!empty($_POST)){
			$id = $this->company_model->insert($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_ADD);
				redirect('company_ctr/edit/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('company_ctr/add');
			}
		}
	}//create
	
	function update()
	{
		$this->load->model('company_model');
		if(!empty($_POST)){
			$id = $this->company_model->update_company($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_UPDATE);
				redirect('company_ctr/edit/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('company_ctr/edit');
			}
		}
	}//update
	
	function remove()
	{
		$this->load->model('company_model');
		if(!empty($_POST)){
			$id = $this->company_model->delete_company($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_DELETE);	
				redirect('company_ctr');
			}else{
				$this->session->set_flashdata('msg',ERROR);	
				redirect('company_ctr/delete/'.$id);
			}
		}
	}
		
}//company_ctr

?>