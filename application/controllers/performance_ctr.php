<?php
class performance_ctr extends CI_Controller{
	
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
	
	function supervisor()
	{
		$data['main_content'] = 'supervisor/super';
		$this->load->view('includes/template.php',$data);
	}
	
	function add_super($msg="")
	{
		$data 					= $this->_load_data_super();
		$data['action'] 		= 'Add';
		$data['msg']			= $msg;
		$data['main_content'] 	= 'supervisor/super_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function edit_super($id="",$lvl="",$msg="")
	{
		$data 					= $this->_load_data_super($id,$lvl);
		$data['action'] 		= 'Edit';
		$data['msg']			= $msg;
		$data['main_content'] 	= 'supervisor/super_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function delete_super($id="",$lvl="",$msg="")
	{
		$data 					= $this->_load_data_super($id,$lvl);
		$data['action'] 		= 'Delete';
		$data['msg']			= $msg;
		$data['main_content'] 	= 'supervisor/super_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function view_super($id="",$lvl="")
	{
		$data 					= $this->_load_data_super($id,$lvl);
		$data['action'] 		= 'View';
		$data['main_content']	= 'supervisor/super_mgt';
		$this->load->view('includes/template.php',$data);	
	}
	
	function assign_super($id="",$lvl="",$msg="")
	{
		$data 					= $this->_load_data_super($id,$lvl);
		$data['action'] 		= 'Assign';
		$data['msg']			= $msg;
		$data['main_content']	= 'supervisor/super_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function _load_data_super($id="",$lvl="")
	{
		$this->load->model('performance_model');
		$data['super'] = array('supervisor_id'=>'','Emp_id'=>'','job_Title'=>'','level'=>'L');
		
		$super = $this->performance_model->get_employees();
		$data['supervisor'] = get_combo_from_results_another($super,'Emp_id','First_name','Middle_name','Please Select a Supervisor');
		
		
		
        if($lvl == 'L'){
            $data['Employees'] = $this->performance_model->get_employees();
        }
        if($lvl == 'H'){
            $data['Employees'] = $this->performance_model->get_low_sup();
        }
		
		
		if($id != ''){
			$sup = $this->performance_model->get_employees_fr_edit();
		    $data['supervisorEdit'] = get_combo_from_results_another($sup,'Emp_id','First_name','Middle_name','Please Select a Supervisor');
		
			$data['super'] = $this->performance_model->get_super_by_id($id);
			$data['assigned_emp'] = $this->performance_model->get_emp_by_sup_id($id);
		}
		return $data;
	}
	
	function validate_super()
	{
	   //dd($_POST);
		if($this->input->post('action') == 'Add'){
		$this->form_validation->set_rules('supervisor_id','Supervisor ID','trim|required|alpha_dash|is_unique['.SUPER_TBL.'.supervisor_id]');
		$this->form_validation->set_rules('Emp_id','Supervisor','required');

		}
		if($this->input->post('action') == 'Edit'){
		$this->form_validation->set_rules('Emp_id','Supervisor','required');
		//$this->form_validation->set_rules('Emp','Employees','required');
		}
		if($this->input->post('action') == 'Assign'){
			$this->form_validation->set_rules('Emp','Employees','required');
		}
		if($this->input->post('action') == 'View'){
			$this->supervisor();
		}
		if($this->input->post('action') == 'Delete'){
			$this->form_validation->set_rules('supervisor_id','Supervisor ID','has_transactions['.TASK_TBL.'.supervisor_id]');
		}
		if($this->form_validation->run()==FALSE){
			switch($this->input->post('action')){
				case 'Add':	
					$this->add_super();
				break;
				case 'Edit':
					$this->edit_super($this->input->post('supervisor_id'));
				break;
				case 'Delete':
					$this->delete_super($this->input->post('supervisor_id'));
				break;
				case 'Assign':
					$this->assign_super($this->input->post('supervisor_id'));				
				break;
			}
		}else{
			switch($this->input->post('action')){
				case 'Add':	
					$this->create_super();
				break;
				case 'Edit':
					$this->update_super();
				break;
				case 'Delete':
					$this->remove_super();
				break;
				case 'Assign':
					$this->insert_assign();				
				break;
			}
		}
	}//validate_super
		
		function create_super()
		{
			if(!empty($_POST))	{
				$this->load->model('performance_model');
				$id = $this->performance_model->insert_super($this->input->post());
				if($id!= ''){
					$this->session->set_flashdata('msg',RECORD_ADD);
					redirect('performance_ctr/edit_super/'.$id);
				}else{
					$this->session->set_flasfdata('msg',ERROR);
					redirect('performance_ctr/add_super/');
				}
			}
		}
		
		function update_super()
		{
			if(!empty($_POST)){
				$this->load->model('performance_model');
				$id = $this->performance_model->update_super($this->input->post());
				if($id!= ''){
					$this->session->set_flashdata('msg',RECORD_UPDATE);
					redirect('performance_ctr/edit_super/'.$id);
				}else{
					$this->session->set_flasfdata('msg',ERROR);
					redirect('performance_ctr/edit_super/'.$id);
				}
			}
		}
		
		function remove_super()
		{
			if(!empty($_POST)){
				$this->load->model('performance_model');
				$id = $this->performance_model->delete_super($this->input->post('supervisor_id'));
				if($id == 1){
					$this->session->set_flashdata('msg',RECORD_DELETE);
					redirect('performance_ctr/supervisor/');
				}else{
					$this->session->set_flasfdata('msg',ERROR);
					redirect('performance_ctr/delete_super/'.$id);
				}
			}
		}
		
		function insert_assign()
		{
			if(!empty($_POST)){
				$this->load->model('performance_model');
				$id=$this->performance_model->insert_assign_emp($this->input->post());
				if($id != ''){
					$this->session->set_flashdata('msg','Employees are Assgned to the Supervisor');
					redirect('performance_ctr/assign_super/'.$id);
				}else{
					$this->session->set_flashdata('msg',ERROR);
					redirect('performance_ctr/assign_super/'.$id);
				}
			}
		}
		
		//***********************************************Assign Tasks**************************************************************//
		function check_wether_supervsor($emp)
        {
            $this->load->model('performance_model');
            $res = $this->performance_model->get_supervisor_session($emp);
            
            if(!empty($res)){
                return true;
            }
        }
        
		function assign_tasks()
		{
            $id = $this->check_wether_supervsor($this->session->userdata('Emp_id'));
           
            if($id != ''){
               $data                 = $this->_load_data_tasks_fr_add();
                $data['main_content'] = 'Tasks/assignTsk';
			    $this->load->view('includes/template.php',$data); 
            }else{
                $this->session->set_flashdata('msg',SUP_ERROR);
                redirect('home_page');
            }
            
		}
		
		function add_task($id="",$msg="")
		{
			$data 					= $this->_load_data_tasks_fr_add($id);
			$data['action'] 		= 'Add';
			$data['msg']    		= $msg;
			$data['main_content'] 	= 'Tasks/assignTskMgt';
			$this->load->view('includes/template.php',$data);
		}
		
		function edit_task($id="",$supr_id="",$msg="")
		{
			$data 					= $this->_load_data_tasks($id,$supr_id);
			$data['action'] 		= 'Edit';
			$data['msg']			= $msg;
			$data['main_content']	= 'Tasks/assignTskMgtfrEdit';
			$this->load->view('includes/template.php',$data);
		}
		
		
		function view_task($id="",$supr_id="")
		{
			$data 					= $this->_load_data_tasks($id,$supr_id);
			$data['action'] 		= 'View';
			$data['main_content'] 	= 'Tasks/assignTskMgtfrEdit';
			$this->load->view('includes/template.php',$data);
		}
		
		function _load_data_tasks_fr_add($id="")
		{
			$this->load->model('performance_model');
            $Supervisor_cmb = $this->performance_model->get_supervisor_session($this->session->userdata('Emp_id'));
            $data['Supervisor_cmb'] = get_combo_from_results_another($Supervisor_cmb,'supervisor_id','First_name','Middle_name','');
			$data['super'] = $this->performance_model->get_super_by_id($id);
			$data['tasks'] = array('task_id'=>'','task_name'=>'','From'=>date('Y-m-d'),'To'=>'');
			$data['Employees'] = $this->performance_model->get_assigned_emp($id);
			
			return $data;
		}
		
		function _load_data_tasks($id,$supr_id)
		{
			$this->load->model('performance_model');
			//$data['super'] = $this->performance_model->get_super_by_id($id);
			$data['tasks'] = $this->performance_model->get_tsk_by_id($id);
			$data['Employees'] = $this->performance_model->get_assigned_emp($supr_id);
			$data['tsk_as_emp'] = $this->performance_model->get_tsk_assigned_emp($id);
			return $data;
		}
		
		function validate_task()
		{
			if($this->input->post('action') == 'Add'){
			$this->form_validation->set_rules('task_id','Task ID','trim|required|alpha_dash|is_unique['.TASK_TBL.'.task_id]');
			}
			if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
			$this->form_validation->set_rules('task_name','Task','trim|required');
			$this->form_validation->set_rules('From','From','trim|required');
			$this->form_validation->set_rules('To','To','trim|required');
			$this->form_validation->set_rules('Emp','Employees','required');
			}
			
			if($this->input->post('action') == 'View'){
				$this->assign_tasks();
			}
			if($this->form_validation->run()==FALSE){
				switch($this->input->post('action')){
					case 'Add':
						$this->add_task($this->input->post('supervisor_id'));
					break;
					case 'Edit':
						$this->edit_task($this->input->post('task_id',$this->input->post('supervisor_id')));
					break;
					
				}
			}else{
				switch($this->input->post('action')){
					case 'Add':
						$this->create_tsk();
					break;
					case 'Edit':
						$this->update_tsk();
					break;
					
				}
			}
		}//validate_tsk
		
		function create_tsk()
		{
			if(!empty($_POST)){
				$this->load->model('performance_model');
				$id = $this->performance_model->insert_tasks($this->input->post());
				if($id != ''){
					$this->session->set_flashdata('msg',RECORD_ADD);
					redirect('performance_ctr/edit_task/'.$this->input->post('task_id').'/'.$this->input->post('supervisor_id'));
				}else{
					$this->session->set_flashdata('msg',ERROR);
					redirect('performance_ctr/add_task/'.$this->input->post('supervisor_id'));
				}
			}
		}//create_tsk
		
		function update_tsk()
		{
			if(!empty($_POST)){
				$this->load->model('performance_model');
				$id = $this->performance_model->update_tasks($this->input->post());
				if($id != ''){
					$this->session->set_flashdata('msg',RECORD_UPDATE);
					redirect('performance_ctr/edit_task/'.$this->input->post('task_id').'/'.$this->input->post('supervisor_id'));
				}else{
					$this->session->set_flashdata('msg',ERROR);
					redirect('performance_ctr/edit_task/'.$this->input->post('task_id').'/'.$this->input->post('supervisor_id'));
				}
			}
		}
		//*************************** emp_task*******************************************************************************//
		
		function emp_tasks()
		{
			$data 					= $this->_load_emp_tsk();
			$data['main_content'] 	= 'Emp_tasks/Tasks_each';
			$this->load->view('includes/template.php',$data);
		}
		
		function mark_progress($id="",$msg="")
		{
			$data					= $this->_load_emp_tsk($id);
			$data['action'] 		= 'Edit';
			$data['msg']			= $msg;
			$data['main_content']	=	'Emp_tasks/task_each_mgt';
			$this->load->view('includes/template.php',$data);
		}
		
		function view_mark_progress($id="")
		{
			$data 					= $this->_load_emp_tsk($id);
			$data['action']			=	'View';
			$data['main_content']	=	'Emp_tasks/task_each_mgt';
			$this->load->view('includes/template.php',$data);
		}
		
		function _load_emp_tsk($id="")
		{
			$this->load->model('performance_model');
			$emp = $this->performance_model->get_all_employees();
			$data['emp'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','Please Select a Employee');
			$data['tsk_Mark'] = $this->performance_model->get_emp_tsk_by_id($id);
			return $data;
		}
		
		function validate_emp_tsk()
		{
			$this->form_validation->set_rules('feedback_date','Feedback Date','required');
			$this->form_validation->set_rules('status','Progress Status','trim|required');
			
			if($this->input->post('action') == 'View'){
				$this->emp_tasks();
			}
			
			if($this->form_validation->run() == FALSE){
				switch($this->input->post('action')){
					case 'Edit':
						$this->mark_progress($this->input->post('task_id'));
					break;
				}
			}else{
				switch($this->input->post('action')){
					case 'Edit':
						$this->update_progress();
					break;
				}
			}
		}//validate_emp_tsk
		
		function update_progress()
		{
			if(!empty($_POST)){
				$this->load->model('performance_model');	
				$id = $this->performance_model->edit_emp_progress($this->input->post());
				if($id != ''){
					$this->session->set_flashdata('msg',RECORD_UPDATE);	
					redirect('performance_ctr/mark_progress/'.$this->input->post('task_id'));
				}else{
					$this->session->set_flashdata('msg',ERROR);
					redirect('performance_ctr/mark_progress/'.$this->input->post('task_id'));
				}
			}
		}
	//***************************** Approving Tasks *********************************************************************//
	
	function app_tasks()
	{
	    $id = $this->check_wether_supervsor($this->session->userdata('Emp_id'));
        if($id != ''){
           $data = $this->_load_data_fr_approve();
		  $data['main_content'] = 'ApproveTsk/approveTsk';
		  $this->load->view('includes/template.php',$data);
        }else{
            $this->session->set_flashdata('msg',SUP_ERROR);
            redirect('home_page');
        }
		
	}
	
	function _load_data_fr_approve()
	{
		$this->load->model('performance_model');
		$sup = $this->performance_model->get_all_supervisors_fr_approve();
		$data['sup'] = get_combo_from_results_another($sup,'Emp_id','First_name','Middle_name','');
		$data['approve_tsk'] = array('feedback_date'=>date('Y-m-d'));
		
		return $data;
	}
	
	function approval($id,$stat)
	{
		$this->load->model('performance_model');
		$id = $this->performance_model->mark_approval($id,$stat);
		if($id == 'Approve'){
		   $this->session->set_flashdata('msg','Approved the Task successfully');
			redirect('performance_ctr/app_tasks/');
		}
        if($id == 'Reject'){
            $this->session->set_flashdata('msg','Task is Rejected');
            redirect('performance_ctr/app_tasks/');
        }
	}
}