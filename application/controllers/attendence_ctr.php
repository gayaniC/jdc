<?php 
class attendence_ctr extends CI_Controller{
	
	//function __construct()
//	{
//		parent::__construct();
//		$this->is_logged_in();
//	}
//	
//	function is_logged_in()
//	{
//		$is_logged_in = $this->session->userdata('is_logged_in');
//		if(!isset($is_logged_in) || $is_logged_in != true )
//		{
//		  redirect('login');
//			//echo '<font color="#FF0000" size="5">You don\'t have permission to access this page. </font>'; echo anchor(site_url('login'),'<font color="#0000FF" size="5">Login</font>','title="login"');
//			//die();
//		}
//	}
	
	function index()
	{
	    $data = $this->_load_data();
		$data['main_content'] = 'attendence/att';
		$this->load->view('includes/template.php',$data);
		
	}
    
    function _load_data()
    {
        $this->load->model('emp_model');
        
        $emp = $this->emp_model->get_all_emp_fr_combo();
        $data['employee'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','Please select an employee');
        
        return $data;
    }
    
    function upload_file()
    {
        $data['main_content'] = 'attendence/att_upload';
        $this->load->view('includes/template.php',$data);
    }
    
    function validate()
    {
        $this->form_validation->set_rules('attendance','File','callback_upload_error()');
        if($this->form_validation->run() == FALSE){
            $this->upload_file();
        }else{
            $this->create();
        }
    }
    
    function create()
    {
        $this->load->model('attendence_model');
        $this->attendence_model->insert($_FILES);
        
            $this->session->set_flashdata('msg',RECORD_ADD);
            redirect('attendence_ctr/upload_file');
        
    }
    
    
	
    function upload_error()
    {
        //echo '<pre>'; print_r($_FILES); echo '<pre>';
       // die();
        if($_FILES['Attendance']['type'] != 'application/vnd.ms-excel'){
            $this->form_validation->set_message('upload_error', 'Please upload file in csv extension');
			return FALSE;
        }else{
            return TRUE;
        }
    }
	
}