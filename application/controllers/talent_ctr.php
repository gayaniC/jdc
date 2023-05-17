<?php 
class talent_ctr extends CI_Controller{
	
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
	
	function designation()
	{
		$this->add_desig();
	}
	
	function add_desig($msg = "")
	{
		$data = $this->_load_data_desig();
		$data['action'] = 'Add';
		$data['msg'] = $msg;
		$data['main_content'] = 'Designation/designation';
		$this->load->view('includes/template.php',$data);
		
	}
	
	function edit_desig($ID="",$msg = "")
	{
		$data = $this->_load_data_desig($ID);
		$data['action'] = 'Edit';
		$data['msg'] = $msg;
		$data['main_content'] = 'Designation/designation';
		$this->load->view('includes/template.php',$data);
	}
	
	function delete_desig($ID = "", $msg ="")
	{
		$data = $this->_load_data_desig($ID);
		$data['action'] = 'Delete';
		$data['msg'] = $msg;
		$data['main_content'] = 'Designation/designation';
		$this->load->view('includes/template.php',$data);
		
	}
	
	function view_desig($ID = "")
	{
		$data = $this->_load_data_desig($ID);
		$data['action'] = 'View';
		$data['main_content'] = 'Designation/designation';
		$this->load->view('includes/template.php',$data);
		
	}
	
	function _load_data_desig($ID = "")
	{
		$this->load->model('designation_model');
		$data['designation'] = array('Des_code' => '','job_Title'=>'','des_type'=>'','basic_Salary'=>'');
		
		if($ID != ''){
			$data['designation'] = $this->designation_model->get_jobs_by_id($ID);
		}
		
		return $data;
	}
	
	function validation_desig()
	{
		if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
		$this->form_validation->set_rules('job_Title','Designation','trim|required');
		$this->form_validation->set_rules('des_type','Designation Type','required');
		$this->form_validation->set_rules('basic_Salary','Basic Salary','trim|required|numeric');
		}
		if($this->input->post('action') == 'View'){$this->designation();}
		if($this->input->post('action')=='Delete')
		{
		$this->form_validation->set_rules('Des_code', 'Designation', 'has_transactions['.EMP_PROFILE.'.Des_code]|has_transactions['.SUPER_TBL.'.Des_code]');
		}
		if($this->form_validation->run() == FALSE){
			switch($this->input->post('action')){
				case 'Add':
					$this->add_desig();
				break;
				case 'Edit':
					$this->edit($this->input->post('Des_code'));
				break;
				case 'Delete':
					$this->delete($this->input->post('Des_code'));
				break;
				
			}
		}else{
			switch($this->input->post('action')){
				case 'Add':
					$this->create_desig();
				break;
				case 'Edit':
					$this->update_desig();
				break;
				case 'Delete':
					$this->remove_desig();
				break;
				
			}	
		}
	}//validate
	
	function create_desig()
	{
		if(!empty($_POST)){
			$this->load->model('designation_model');
			$id = $this->designation_model->insert_designation($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_ADD);
				redirect('talent_ctr/edit_desig/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('talent_ctr/add_desig/');
			}
		}
	}//create
	
	function update_desig()
	{
		if(!empty($_POST)){
			$this->load->model('designation_model');
			$id = $this->designation_model->edit_des($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_UPDATE);
				redirect('talent_ctr/edit_desig/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('talent_ctr/edit_desig/'.$id);
			}
		}
	}//update
	
	function remove_desig()
	{
		if(!empty($_POST)){
			$this->load->model('designation_model');
			$id = $this->designation_model->delete_des($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_DELETE);
				redirect('talent_ctr/designation');
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('talent_ctr/delete_desig/'.$id);
			}
		}
	}//remove
    
    //***************************************recruitment **********************************************//
    
    function recruitment()
    {
        $data['main_content'] = 'recruitment/job';
        $this->load->view('includes/template.php',$data);
    }
    
    function new_job($msg='')
    {
        $data['action'] = 'Add';
        $data['msg']    = $msg;
        $data['main_content'] = 'recruitment/job_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function edit_job($id='',$msg='')
    {
        $data = $this->_load_data_fr_job($id);
        $data['action'] = 'Edit';
        $data['msg']    = $msg;
        $data['main_content'] = 'recruitment/job_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function delete_job($id='',$msg='')
    {
        $data = $this->_load_data_fr_job($id);
        $data['action'] = 'Delete';
        $data['msg']    = $msg;
        $data['main_content'] = 'recruitment/job_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function view_job($id='')
    {
        $data = $this->_load_data_fr_job($id);
        $data['action'] = 'View';
        $data['main_content'] = 'recruitment/job_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function _load_data_fr_job($id)
    {
        $this->load->model('talent_model');
        $data['job'] = $this->talent_model->get_job_by_id($id);
        
        return $data;   
    }
    
    function validate_job()
    {
        if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
            $this->form_validation->set_rules('vacancy','Vacancy','trim|required');
            $this->form_validation->set_rules('Description','Description','trim|required');
            $this->form_validation->set_rules('Edu_qualification','Educational Qualification','trim|required');
            $this->form_validation->set_rules('Prf_qualification','Professional Qualification','trim|required');
            $this->form_validation->set_rules('opening_date','Opening Date','trim|required');
            $this->form_validation->set_rules('closing_date','Closing Date','trim|required');
        }
        if($this->input->post('action') == 'Delete'){
            $this->remove_job();
        }
        if($this->form_validation->run() == FALSE){
            switch($this->input->post('action'))
            {
                case 'Add':
                    $this->new_job();
                break;
                case 'Edit':
                    $this->edit_job($this->input->post('rec_id'));
                break;
                
            }
        }else{
            switch($this->input->post('action'))
            {
                case 'Add':
                    $this->create_job();
                break;
                case 'Edit':
                    $this->update_job();
                break;
                
            }
        }
    }//validate
    
    function create_job()
    {
        $this->load->model('talent_model');
        $id = $this->talent_model->insert_job($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_ADD);
            redirect('talent_ctr/edit_job/'.$id);
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('talent_ctr/new_job');
        }
    }
    
    function update_job()
    {
        $this->load->model('talent_model');
        $id = $this->talent_model->edit_job_db($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_UPDATE);
            redirect('talent_ctr/edit_job/'.$this->input->post('rec_id'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('talent_ctr/edit_job/'.$this->input->post('rec_id'));
        }
        
    }
    
    function remove_job()
    {
        $this->load->model('talent_model');
        $id = $this->talent_model->delete_job_db($this->input->post('rec_id'));
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('talent_ctr/recruitment/');
        }else{
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('talent_ctr/delete_job/'.$this->input->post('rec_id'));
        }
    }
    
    //************************************* ideas *************************************************************//
    function ideas()
    {
        $data                 = $this->_load_data_fr_ideas();
        $data['main_content'] = 'Ideas/idea_vw';
        $this->load->view('includes/template.php',$data);
    }
    
    function new_ideas($msg='')
    {
        $data = $this->_load_data_fr_ideas();
        $data['action'] = 'Add';
        $data['msg']    = $msg;
        $data['main_content'] = 'Ideas/idea_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function edit_idea($id='',$msg='')
    {
        $data = $this->_load_data_fr_ideas($id);
        $data['action'] = 'Edit';
        $data['msg']    = $msg;
        $data['main_content'] = 'Ideas/idea_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function delete_idea($id='',$msg='')
    {
        $data = $this->_load_data_fr_ideas($id);
        $data['action'] = 'Delete';
        $data['msg']    = $msg;
        $data['main_content'] = 'Ideas/idea_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function view_idea($id='')
    {
        $data = $this->_load_data_fr_ideas($id);
        $data['action'] = 'View';
        $data['main_content'] = 'Ideas/idea_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function approve_idea($id='',$msg='')
    {
        $data = $this->_load_data_fr_ideas($id);
        $data['action'] = 'Submit';
        $data['msg']    = $msg;
        $data['main_content'] = 'Ideas/idea_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function _load_data_fr_ideas($id='')
    {
        $data['idea'] = array('idea_inq'=>'','details'=>'','app_status'=>'N');
        $this->load->model('emp_model');
        $this->load->model('talent_model');
        $emp = $this->emp_model->get_all_emp_by_sup();
        $data['employee'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','');
        
        if($id != ''){
            $data['idea'] = $this->talent_model->get_idea_by_id($id);
        }
        
        return $data;
    }
    function validate_idea()
    {
        if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
            $this->form_validation->set_rules('idea_inq','Suggestion','trim|required');
            $this->form_validation->set_rules('details','Suggestion in Detail','trim|required');
        } 
        if($this->input->post('action') == 'Submit'){
            $this->form_validation->set_rules('app_status','Approval','trim|required');
        }
        if($this->input->post('action') == 'Delete'){
            $this->remove_idea();
        }
        if($this->form_validation->run() == FALSE){
            switch($this->input->post('action')){
                case 'Add':
                    $this->new_ideas();
                break;
                case 'Edit':
                    $this->edit_idea($this->input->post('id'));
                break;
                case 'Submit':
                    $this->approve_idea($this->input->post('id'));
                break;
            }
        }else{
            switch($this->input->post('action')){
                case 'Add':
                    $this->create_idea();
                break;
                case 'Edit':
                    $this->update_idea();
                break;
                case 'Submit':
                    $this->approve_idea_db();
                break;
            }
        }
    }
	
    
    
    function create_idea()
    {
        $this->load->model('talent_model');
        $id = $this->talent_model->insert_idea($this->input->post());
        if($id!= ''){
            $this->session->set_flashdata('msg',RECORD_ADD);
            redirect('talent_ctr/ideas');
        }
    }
    
    function update_idea()
    {
        $this->load->model('talent_model');
        $id = $this->talent_model->edit_idea_db($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_UPDATE);
            redirect('talent_ctr/edit_idea/'.$this->input->post('id'));
        }
    }
    
    function remove_idea()
    {
         $this->load->model('talent_model');
         $id = $this->talent_model->delete_idea_db($this->input->post());
         if($id != ''){
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('talent_ctr/ideas');
         }
    }
	function approve_idea_db()
    {
	     $this->load->model('talent_model');
         $id = $this->talent_model->approve($this->input->post());
         if($id != '')
         {
            $this->session->set_flashdata('msg','Give feedback successfully');
            redirect('talent_ctr/ideas');
         }
	}
    //*************************************** resignation ******************************************************//
    
    function resign()
    {
        $data                 = $this->_load_data_resign();
        $data['main_content'] = 'Resignation/resig';
        $this->load->view('includes/template.php',$data);
    }
    
    function _load_data_resign($rowno='')
    {
        $this->load->model('talent_model');
        $emp = $this->talent_model->get_emp_considering_sess();
        if($this->session->userdata('user_role_id') == 'DEO' || $this->session->userdata('user_role_id') == 'NEMP'){
            $data['employee'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','');
        }else{
            $data['employee'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','Please select an Employee');
        }
        
        if($rowno != '')
        {
            $data['resig'] = $this->talent_model->get_resign_date($rowno);
        }
        return $data;
    }
    
    function edit_resig($rowno,$msg='')
    {
        $data = $this->_load_data_resign($rowno);
        $data['action'] = 'Edit';
        $data['msg']    = $msg;
        $data['main_content'] = 'Resignation/Resig_mgt';
        $this->load->view('includes/template.php',$data);    
    }
    
    function view_resig($rowno)
    {
        $data = $this->_load_data_resign($rowno);
        $data['action'] = 'View';
        $data['main_content'] = 'Resignation/Resig_mgt';
        $this->load->view('includes/template.php',$data);    
    }
    
    function inactive($emp_id)
    {
        
    }
    
    function validate_resign()
    {
        $this->form_validation->set_rules('resign_date','Resign Date','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            if($this->input->post('action') == 'Edit'){
                $this->edit_resig($this->input->post('id'));
            }
        }else{
            if($this->input->post('action') == 'Edit'){
                $this->mark_resig();
            }
        }
    }
    
    function mark_resig()
    {
        $this->load->model('talent_model');
        $id = $this->talent_model->update_resign($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_UPDATE);
            redirect('talent_ctr/edit_resig/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('talent_ctr/edit_resig/'.$this->input->post('id'));
        }
    }
}