<?php 

class employee_ctr extends CI_Controller{
	
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
		$data['main_content'] = 'Employee/employee.php';
		$this->load->view('includes/template.php',$data);
	}
    
	
	function add($msg= "")
	{
		$data 					= $this->_load_data();
		$data['action'] 		= 'Add';
		$data['msg'] 			= $msg;
		$data['main_content'] 	= 'Employee/employeeMgt.php';	
		$this->load->view('includes/template.php',$data);
	}
	
	function edit($id= "",$msg ="")
	{
		$data 					= $this->_load_data($id);
		$data['action'] 		= 'Edit';
		$data['msg'] 			= $msg;
		$data['main_content'] 	= 'Employee/employeeMgt.php';	
		$this->load->view('includes/template.php',$data);
	}
	
	function view($id='')
	{
		$data 					= $this->_load_data($id);
		$data['action'] 		= 'View';
		$data['main_content'] 	= 'Employee/employeeMgt.php';	
		$this->load->view('includes/template.php',$data);
	}
	
	function delete($id="",$msg="")
	{
		$data 					= $this->_load_data($id);
		$data['action'] 		= 'Delete';
		$data['msg'] 			= $msg;
		$data['main_content'] 	= 'Employee/employeeMgt.php';	
		$this->load->view('includes/template.php',$data);	
	}
	
	function _load_data($ID = "")
	{
		$this->load->model('emp_model');
		$this->load->model('designation_model');
		$this->load->model('department_model');
		$this->load->model('bank_model');
		
		$data['employee'] = array('title'=>'',
		'postal_code'=>'',
		'First_name'=>'',
		'Contact_Address_line1'=>'',
		'Middle_name'=>'',
		'Contact_Address_line2'=>'',
		'surname'=>'',
		'Contact_no'=>'',
		'NIC'=>'',
		'Emp_mail'=>'',
		'DOB'=>'',
		'religion'=>'',
		'Distance'=>'',
		'marital_status'=>'',
		'nationality'=>'',
		'AppointmentDate'=>'',
		'Dept_id'=>'',
		'EPF_no'=>'',
		'Des_code'=>'',
		'Account_No'=>'',
		'bank_id'=>'',
		'resign_date'=>'',
		'company_name'=>'',
		'position_held'=>'',
		'join_date'=>'',
		'pre_resign_date'=>'',
		'reason_to_leave'=>'',
		'total_experience'=>'',
		'Qualification'=>'',
		'Institute'=>'',
		'Level'=>'',
		'from'=>'',
		'to'=>'',
		'name'=>'',
		'relationship'=>'',
		'Age'=>'',
		'NIC_f_fam_member'=>'',
		'occupation'=>'',
		'contact_no'=>'',
		'exp_type'=>'',
		'Emp_id'=>''); 
		
		$desig = $this->designation_model->get_all_designation();
		$data['desig'] = get_combo_from_results($desig,'Des_code','job_Title','Please select a Job Title');
		
		$dept = $this->department_model->get_all_dept();
		$data['dept'] = get_combo_from_results($dept,'Dept_id','Dept_name','Please select a department');
		
		$bank = $this->bank_model->getAllBank();
		$data['bank'] = get_combo_from_results($bank,'id','bank_name','Please select a bank');
		
		if($ID != ''){
			$data['employee'] = $this->emp_model->get_emp_by_id($ID);
		}
		return $data;
	}//_load_data
	
	function validate()
	{
		if($this->input->post('action') == 'Add'){
		$this->form_validation->set_rules('NIC','Employee NIC','trim|required|max_length[10]|is_unique['.EMP_TBL.'.NIC]');
		$this->form_validation->set_rules('Emp_mail','Employee Email','trim|required|valid_email|is_unique['.EMP_TBL.'.Emp_mail]');
        $this->form_validation->set_rules('EPF_no','EPF No','trim|required|numeric|is_unique['.EMP_PROFILE.'.EPF_no]');
        $this->form_validation->set_rules('Account_No','Account No','trim|required|numeric|is_unique['.EMP_PROFILE.'.Account_No]');		
		}
		
		if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
		$this->form_validation->set_rules('title','Title','trim|required');
		$this->form_validation->set_rules('postal_code','Postal Code','trim|required');
		$this->form_validation->set_rules('First_name','First Name','trim|required|alpha');
		$this->form_validation->set_rules('Contact_Address_line1','Contact Address Line 1','trim|required');
		$this->form_validation->set_rules('Middle_name','Middle Name','trim|required|alpha');
		$this->form_validation->set_rules('Contact_Address_line2','Contact Address Line 2','trim|required');
		$this->form_validation->set_rules('surname','Surname','trim|required|alpha');
		$this->form_validation->set_rules('Contact_no','Employee Contact No','trim|required|numeric|max_length[10]');
		
		$this->form_validation->set_rules('day','Day','trim|required');
		$this->form_validation->set_rules('month','Month','trim|required');
		$this->form_validation->set_rules('year','Year','trim|required|numeric');
		$this->form_validation->set_rules('religion','Religion','trim|required');
		$this->form_validation->set_rules('Distance','Distance','trim|required|numeric');
		$this->form_validation->set_rules('marital_status','Marital Status','trim|required');
		$this->form_validation->set_rules('nationality','Nationality','trim|required');
		$this->form_validation->set_rules('AppointmentDate','Appointment Date','trim|required');
		$this->form_validation->set_rules('Dept_id','Department','trim|required');
		
		$this->form_validation->set_rules('Des_code','Designation','trim|required');
		
		$this->form_validation->set_rules('bank_id','Bank','trim|required');
		//$this->form_validation->set_rules('resign_date','Resign Date','trim|required');
		$this->form_validation->set_rules('company_name','Name of the Employer','trim|required');
		$this->form_validation->set_rules('position_held','Position','trim|required');
		$this->form_validation->set_rules('join_date','Join Date','trim|required');
		$this->form_validation->set_rules('pre_resign_date','Resigned Date','trim|required');
		$this->form_validation->set_rules('reason_to_leave','Reason to Leave','trim|required');
		$this->form_validation->set_rules('total_experience','Total Experience','trim|required');
		$this->form_validation->set_rules('Qualification','Qualification','trim|required');
		$this->form_validation->set_rules('exp_type','Years/Months','trim|required');
		$this->form_validation->set_rules('Institute','Institute','trim|required');
		$this->form_validation->set_rules('Level','Level','trim|required');
		$this->form_validation->set_rules('from','From','trim|required');
		$this->form_validation->set_rules('to','To','trim|required');
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('relationship','Relationship to you','trim|required');
		$this->form_validation->set_rules('Age','Age','trim|required|numeric');
		$this->form_validation->set_rules('NIC_f_fam_member','National Identity Card','trim|required|max_length[10]');
		$this->form_validation->set_rules('occupation','Occupation','trim|required');
		$this->form_validation->set_rules('contact_no','Contact No','trim|required|numeric|max_length[10]');
		}
		if($this->input->post('action')=='View'){
			$this->index();
		}
		if($this->input->post('action') == 'Delete'){
			$this->form_validation->set_rules('Emp_id','Employee ID','has_transactions['.ATTENDENCE.'.Emp_id]|has_transactions['.EMP_HS_TASK.'.Emp_id]|has_transactions['.ATTENDENCE.'.Emp_id]|has_transactions['.LEAVE_TBL.'.Emp_id]|has_transactions['.LV_ALLO_TBL.'.Emp_id]|has_transactions['.EMP_MANAGED.'.Emp_id]|has_transactions['.SUPER_TBL.'.Emp_id]|has_transactions['.EMP_VEHICLE.'.Emp_id]|has_transactions['.GATE_PASS.'.Emp_id]');
		}

		if($this->form_validation->run() == FALSE){
			switch($this->input->post('action')){
				case 'Add':
					$this->add();
				break;
				case 'Edit':
					$this->edit($this->input->post('Emp_id'));
				break;
				case 'Delete':
					$this->delete($this->input->post('Emp_id'));
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
	
	function create()
	{
        //echo '<pre>'; print_r($_FILES['userfile']['name']); echo '</pre>'; die();
        if (!empty($_FILES['photo']['name'])) {

            $path = 'uploads/Employee/';
            if (!file_exists($path)) {
                mkdir($path, 0777);
            }

            $config['upload_path'] = $path;
            $path = $config['upload_path'];
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '10240';
            $config['overwrite'] = TRUE;

            $this->load->library('upload');

            foreach ($_FILES as $file_ary => $val) {
                if (!empty($val['name'])) {
                    $uploads[$file_ary] = $val;
                }
            }

            foreach ($uploads as $key => $value) {

                $config['file_name'] = $this->input->post('NIC') . '-' . $this->input->post('First_name') . '-' . $key;
                if (!empty($key['name'])) {
                    $this->upload->initialize($config);

                    if (!$this->upload->do_upload($key)) {
                        //error
                        $errors = $this->upload->display_errors();
                        $this->session->set_flashdata('msg', $errors);
                        redirect('employee_ctr/add/');
                    } else {
                        $data[$key] = $this->upload->data();
                    }
                }
            }
            $this->load->model('emp_model');

            $q = $this->emp_model->insert($this->input->post(), $data);
            if ($q != '') {
                $this->session->set_flashdata('msg', RECORD_ADD);
                redirect('employee_ctr/edit/' . $q);
            } else {
                $this->session->set_flashdata('msg', ERROR);
                redirect('employee_ctr/add/');
            }
        } else {
            if (!empty($_POST)) {
                $this->load->model('emp_model');
                $id = $this->emp_model->insert($this->input->post(), '');
                if ($id != '') {
                    $this->session->set_flashdata('msg', RECORD_ADD);
                    redirect('employee_ctr/edit/' . $id);
                } else {
                    $this->session->set_flashdata('msg', ERROR);
                    redirect('employee_ctr/add/');
                }
            }
        }
	}//create
	
	function update()
	{
		//echo '<pre>'; print_r($_FILES['userfile']['name']); echo '</pre>'; die();
		if(!empty($_FILES['photo']['name']))	{
			
			$path =  'uploads/Employee/';
			if(!file_exists($path)){mkdir($path, 0777);} 			
			
			$config['upload_path'] 		= $path;
            $path 						= $config['upload_path'];
            $config['allowed_types'] 	= 'jpg|jpeg|png|gif';
            $config['max_size'] 		= '10240'; 		
			$config['overwrite'] 		= TRUE;	  
			
            $this->load->library('upload');			
			
			foreach($_FILES as $file_ary => $val){if(!empty($val['name'])){ $uploads[$file_ary]= $val; }}
			
            foreach ($uploads as $key => $value)
            {
				
				$config['file_name']= $this->input->post('NIC').'-'.$this->input->post('First_name').'-'.$key; 
				if (!empty($key['name']))
				{
					$this->upload->initialize($config);					
					
					if(!$this->upload->do_upload($key))
					{
						//error
						$errors = $this->upload->display_errors();
						$this->session->set_flashdata('msg',$errors);
						redirect('employee_ctr/add/');
						
					}else{$data[$key] = $this->upload->data();}
					
				}
				
            }
			$this->load->model('emp_model');
			
			$q = $this->emp_model->edit($this->input->post(),$data);
			if($q != ''){
				$this->session->set_flashdata('msg',RECORD_UPDATE);
				redirect('employee_ctr/edit/'.$q);		
			}else{
				$this->session->set_flashdata('msg',ERROR);	
				redirect('employee_ctr/edit/'.$q);
			}
			
		}else{
			if(!empty($_POST)){
				$this->load->model('emp_model')	;
				$id = $this->emp_model->edit($this->input->post(),'');
				if($id != ''){
					$this->session->set_flashdata('msg',RECORD_UPDATE);
					redirect('employee_ctr/edit/'.$id);
				}else{
					$this->session->set_flashdata('msg',ERROR);
					redirect('employee_ctr/edit/'.$id);
				}
			}
		}
	}//create
	
	function remove()
	{
		if(!empty($_POST['photo'])){
			unlink('uploads/Employee/'.$_POST['photo'].'');
		}

		if(!empty($_POST)){
				$this->load->model('emp_model')	;
				$id = $this->emp_model->delete($this->input->post('Emp_id'));
				if($id != ''){
					$this->session->set_flashdata('msg',RECORD_DELETE);
					redirect('employee_ctr/');
				}else{
					$this->session->set_flashdata('msg',ERROR);
					redirect('employee_ctr/delete/'.$id);
				}	
		}
	}//remove
    
    
    function status($id)
    {
        $this->load->model('emp_model');
        $id = $this->emp_model->update_status_of_emp($id);
        if($id!= ''){
            $this->session->set_flashdata('msg','The Employee Deactivate Successfully');
            redirect('employee_ctr');
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('employee_ctr');
        }
    }
}