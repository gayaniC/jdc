<?php

class leave_ctr extends CI_Controller{
	
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
			
		}
	}
	
	function types()
	{
		$this->add();
	}
	
	function add($msg = "")
	{
		$data = $this->_load_data();
		$data['action'] = 'Add';
		$data['msg'] = $msg;
		$data['main_content'] = 'leave/leave.php';
		$this->load->view('includes/template.php',$data);
	}
	
	function edit($id = "", $msg ="")
	{
		$data = $this->_load_data($id);
		$data['action'] = 'Edit';
		$data['msg'] = $msg;
		$data['main_content'] = 'leave/leave.php';
		$this->load->view('includes/template.php',$data);
	}
	function delete($id = '',$msg = '')
	{
		$data = $this->_load_data($id);
		$data['action'] = 'Delete';
		$data['msg'] = $msg;
		$data['main_content'] = 'leave/leave.php';
		$this->load->view('includes/template.php',$data);
	}
	function view($id = '')
	{
		$data = $this->_load_data($id);
		$data['action'] = 'View';
		$data['main_content'] = 'leave/leave.php';
		$this->load->view('includes/template.php',$data);
		
	}
	
	function _load_data($id = '')
	{
		$data['leave_type'] = array('leave_type_code' => '','Leave_type' => '');
		$this->load->model('leave_model');
		if($id != ''){
			$data['leave_type'] = $this->leave_model->get_leave_type_by_id($id);
		}
	return $data;
	}
	
	function validation_type()
	{
		if($this->input->post('action') == 'Add'){
			$this->form_validation->set_rules('leave_type_code','Leave Type Code','trim|required|alpha_dash|is_unique['.LEAVE_TYPE.'.leave_type_code]');	
		}
		
		$this->form_validation->set_rules('Leave_type','Leave Type','trim|required|is_unique['.LEAVE_TYPE.'.Leave_type]');
		
		if($this->input->post('action') == 'Delete'){
			$this->remove();	
		}
		if($this->input->post('action') == 'View'){
			$this->types();
		}
		
		if($this->form_validation->run() == FALSE){
			switch($this->input->post('action')){
				case 'Add':
					$this->add();
				break;
				case 'Edit':
					$this->edit($this->input->post('leave_type_code'));
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
			}
		}
	}//validation_type
	
	function create()
	{
		if(!empty($_POST)){
			$this->load->model('leave_model');
			$id = $this->leave_model->insert_leave_type($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_ADD);
				redirect('leave_ctr/edit/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);	
				redirect('leave_ctr/add');
			}
		}
	}//create
	
	function update()
	{
		if(!empty($_POST)){
			$this->load->model('leave_model');
			$id = $this->leave_model->edit_leave_type($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_UPDATE);
				redirect('leave_ctr/edit/'.$id);
			}else{
				$this->session->set_flashdata('msg',ERROR);	
				redirect('leave_ctr/edit/',$id);
			}
		}
	}//update
	
	function remove()
	{
		if(!empty($_POST))	{
			$this->load->model('leave_model');
			$id = $this->leave_model->delete_leave_type($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_DELETE);
				redirect('leave_ctr/add/');
			}else{
				$this->session->set_flashdata('msg',ERROR);	
				redirect('leave_ctr/delete/',$id);
			}
		}
	}
	//******************************************* Leave Allocation *******************************************************//
	
	function allocation()
	{
		$data = $this->_load_data_fr_lv_allo();
		$data['main_content'] = 'leave_allocation/leave_allo';
		$this->load->view('includes/template.php',$data); 
	}
	
	function add_allo_leave($id = '',$msg = '')
	{
		$data = $this->_load_data_fr_lv_allo($id);
		$data['action'] = 'Add';
		$data['msg'] = $msg;
		$data['main_content'] = 'leave_allocation/leave_allo_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function edit_allo_leave($id="",$msg="")
	{
		$data = $this->_load_data_fr_lv_allo($id);
		$data['action'] = 'Edit';
		$data['msg'] = $msg;
		$data['main_content'] = 'leave_allocation/leave_allo_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function delete_allo_leave($id="",$msg="")
	{
		$data = $this->_load_data_fr_lv_allo($id);
		$data['action'] = 'Delete';
		$data['msg'] = $msg;
		$data['main_content'] = 'leave_allocation/leave_allo_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function view_allo_leave($id="")
	{
		$data = $this->_load_data_fr_lv_allo($id);
		$data['action'] = 'View';
		$data['main_content'] = 'leave_allocation/leave_allo_mgt';
		$this->load->view('includes/template.php',$data);
	}
	
	function validate_allo_leave()
	{
		if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
			
			$this->form_validation->set_rules('year','Year','trim|required|numeric');
			$this->form_validation->set_rules('allocated','Allocated Leaves','trim|required|numeric');
			$this->form_validation->set_rules('allo_uom','Unit','required');
		}
        if($this->input->post('action') == 'Add'){
            $this->form_validation->set_rules('leave_type_code','Leave Type','trim|required');
        }
		if($this->input->post('action') == 'Delete'){
			$tbl_ary = array(array('table_name'=>LEAVE_TBL,'field_nmae'=>'Emp_id','value'=>$this->input->post('Emp_id')));
			if(has_transactions($tbl_ary)){
				$this->session->set_flashdata('msg','Cannot delete Dependencies Exist!');
				redirect('allocation');
			}else{
			     $this->remove_allo();
			}
		}
		if($this->input->post('action') == 'View'){
			$this->allocation();
		}
		if($this->form_validation->run() == FALSE){
			switch($this->input->post('action')){
				case 'Add':
					$this->add_allo_leave($this->input->post('Emp_id'));
				break;
				case 'Edit':
				    $this->edit_allo_leave($this->input->post('leave_allo_id'));
				break;
				
				case 'Delete':
				    $this->delete_allo_leave($this->input->post('leave_allo_id'));
				break;
			}
		}else{
			switch($this->input->post('action')){
				case 'Add':
					$this->create_allo();
				break;
				case 'Edit':
				    $this->update_allo();
				break;
				
				case 'Delete':
				    $this->remove_allo();
				break;
			}
		}
	}//validate_allo_leave
	
	function _load_data_fr_lv_allo($id='')
	{
		$this->load->model('emp_model');
		$this->load->model('leave_model');
		$emp = $this->emp_model->get_all_emp_fr_combo();
		$data['emp'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','Please select an Employee');
		
		$lv_type = $this->leave_model->get_all_lvtype_combo();
		
		$data['lv_type'] = get_combo_from_results($lv_type,'leave_type_code','Leave_type','Please select a Leave Type');
		//echo '<pre>'; print_r($data['lv_type']); echo '</pre>';
		$uom = $this->leave_model->get_lv_uom();
		$data['uom'] = get_combo_from_results($uom,'val_id','val_des','Please select an unit');
		if($id != ''){
			$lvtype = $this->leave_model->get_lv_type_fr_allo($id);
			$data['lv'] = get_combo_from_results($lvtype,'leave_type_code','Leave_type','Please select a Leave Type');//get lv type considering emp_id 
			$a = $this->leave_model->get_lv_allo_by_emp($id);
			$b = array('year'=>'','allocated'=>'','allo_uom'=>'','leave_type_code'=>'','val_des'=>'');
			$data['allo'] = array_merge($a,$b);
			$data['another_allo'] = $this->leave_model->get_lv_allo_by_allo_id($id);
		}
		return $data;
	}//_load_data_fr_lv_allo
	
	function create_allo()
	{
		if(!empty($_POST)){
			$this->load->model('leave_model');
			$id = $this->leave_model->insert_allo_lv($this->input->post());
			if($id != ''){
				$this->session->set_flashdata('msg',RECORD_ADD);
				redirect('leave_ctr/allocation/');
			}else{
				$this->session->set_flashdata('msg',ERROR);
				redirect('leave_ctr/add_allo_leave/'.$this->input->post('Emp_id'));
			}
		}
	}
    
    function update_allo()
    {
        if(!empty($_POST)){
            $this->load->model('leave_model');
            $id = $this->leave_model->edit_allo_lv($this->input->post());
            if($id != ''){
                $this->session->set_flashdata('msg',RECORD_UPDATE);
                redirect('leave_ctr/edit_allo_leave/'.$this->input->post('leave_allo_id'));
                
            }else{
                $this->session->set_flashdata('msg',ERROR);
                redirect('leave_ctr/edit_allo_leave/'.$this->input->pos('leave_allo_id'));
            }
        }
    }
    
    function remove_allo()
    {
        if(!empty($_POST)){
            $this->load->model('leave_model');
            $id = $this->leave_model->delete_allo_lv($this->input->post());
            if($id != ''){
                $this->session->set_flashdata('msg',RECORD_DELETE);
                redirect('leave_ctr/allocation/');
            }else{
                $this->session->set_flashdata('msg',ERROR);
                redirect('leave_ctr/delete_allo_leave/'.$this->input->post('leave_allo_id'));
            }
        }
    }
    //*********************************** Leave application ************************************************//
    function requests()
    {
        $data = $this->_load_data_lv_app();
        $data['main_content'] = 'leave_app/leave_app';
        $this->load->view('includes/template.php',$data);
    }
    function add_lv_app($msg='')
    {
        $data = $this->_load_data_lv_app();
        $data['action'] = 'Add';
        $data['msg'] = $msg;
        $data['main_content'] = 'leave_app/leave_app_mgt';
        $this->load->view('includes/template.php',$data);
    }
    function edit_lv_app($id='',$msg='')
    {
        $data = $this->_load_data_lv_app($id);
        $data['action'] = 'Edit';
        $data['msg'] = $msg;
        $data['main_content'] = 'leave_app/leave_app_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function delete_lv_app($id='',$msg='')
    {
        $data = $this->_load_data_lv_app($id);
        $data['action'] = 'Delete';
        $data['msg'] = $msg;
        $data['main_content'] = 'leave_app/leave_app_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function view_lv_app($id='')
    {
        $data = $this->_load_data_lv_app($id);
        $data['action'] = 'View';
        $data['main_content'] = 'leave_app/leave_app_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function _load_data_lv_app($id='')
    {
        $this->load->model('performance_model');
        $this->load->model('leave_model');
        $emp = $this->performance_model->get_all_employees();
        $data['emp'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','Please Select a Employee');
        
        $lv_type = $this->leave_model->get_all_lvtype_combo();
		$data['lv_type'] = get_combo_from_results($lv_type,'leave_type_code','Leave_type','Please select a Leave Type');
        
        
        $data['lv_app'] = array('leave_type_code'=>'','val_des'=>'','allocated'=>'','used'=>'','bal'=>'','From'=>'','to'=>'','no_of_days'=>'','reason_for_leave'=>'','applied_on'=>date('Y/m/d'));
        if($id != ''){
            $data['lv_app'] = $this->leave_model->get_lv_app_by_id($id);
        }
        return $data;
        
    }
    
    function validate_lv_app()
    {
        if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
            $this->form_validation->set_rules('leave_type_code','Leave Type','required');
            $this->form_validation->set_rules('From','From','required');
            $this->form_validation->set_rules('to','To','required');
            $this->form_validation->set_rules('no_of_days','Duration','trim|required|numeric');
            $this->form_validation->set_rules('applied_on','Applied On','required');
            $this->form_validation->set_rules('reason_for_leave','Reason','trim|required');
        }
        if($this->input->post('action') == 'Delete'){
            $this->remove_lv_app();
        }
        
        if($this->input->post('action') == 'View'){
            $this->requests();
        }
        
        if($this->form_validation->run()==FALSE){
            switch($this->input->post('action')){
                case 'Add':
                    $this->add_lv_app();
                break;
                case 'Edit':
                    $this->edit_lv_app($this->input->post('lv_app_no'));
                break;
            }
        }else{
            switch($this->input->post('action')){
                case 'Add':
                    $this->create_lv_app();
                break;
                case 'Edit':
                    $this->update_lv_app();
                break;
            }
        }
    }//validate
    
    function create_lv_app()
    {
        if(!empty($_POST)){
            
            $this->load->model('leave_model');
            $id = $this->leave_model->inser_lv_app($this->input->post());
            if($id != ''){
                $this->session->set_flashdata('msg',RECORD_ADD);
                redirect('leave_ctr/requests/');
            }else{
                $this->session->set_flashdata('msg',ERROR);
                redirect('leave_ctr/add_lv_app');
            }
        }
    }
    
    function update_lv_app()
    {
        if(!empty($_POST)){
            $this->load->model('leave_model');
            $id = $this->leave_model->edit_lv_app($this->input->post());
            if($id!= ''){
                $this->session->set_flashdata('msg',RECORD_UPDATE);
                redirect('leave_ctr/edit_lv_app/'.$this->input->post('lv_app_no'));
            }else{
                $this->session->set_flashdata('msg',ERROR);
                redirect('leave_ctr/edit_lv_app/'.$this->input->post('lv_app_no'));
            }
        }
    }
    
    function remove_lv_app()
    {
        if(!empty($_POST))
        {
            $this->load->model('leave_model');
            $id = $this->leave_model->remove_lv_app_from_db($this->input->post());
            if($id != ''){
                $this->session->set_flashdata('msg',RECORD_DELETE);
                redirect('leave_ctr/requests/');
            }else{
                $this->session->set_flashdata('msg',ERROR);
                redirect('leave_ctr/delete_lv_app/'.$this->input->post('lv_app_no'));
            }
        }
    }
    //**************************** Leave Approval ************************************************************//
    
    function approvals()
    {
        $data = $this->_load_data_fr_approval();
        $data['main_content'] = 'LeaveApprove/lv_appr';
        $this->load->view('includes/template.php',$data);
    }
    
    function _load_data_fr_approval()
    {
        $this->load->model('leave_model');
        $sup = $this->leave_model->get_supervisors();
        $data['sup'] = get_combo_from_results_another($sup,'Emp_id','First_name','Middle_name','');
        
        return $data;
    }
    
    function approval($id,$status)
    {
        $this->load->model('leave_model');
        $id = $this->leave_model->mark_lv_appr($id,$status);
        if($id == 'Approve'){
            $this->session->set_flashdata('msg','Leave Application has approved successfully');
            redirect('leave_ctr/approvals');
        }
        if($id == 'Reject'){
            $this->session->set_flashdata('msg','Leave Application is Rejected');
            redirect('leave_ctr/approvals');
        }
    }
}//leave_ctr