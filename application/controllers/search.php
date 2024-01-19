<?php

class search extends CI_Controller{
	
	function company_search()
	{
		if(!empty($_POST)){
			$this->load->model('company_model');
			$data['records'] = $this->company_model->load_ajax_search($this->input->post());
			$this->load->view('company/companyRes',$data);
		}
	}
	
	function attendence()
	{
	   // echo $this->input->post('att_date'); die();
        $this->load->model('attendence_model');
		$data['records'] = $this->attendence_model->get_all_att($this->input->post());
		$this->load->view('attendence/att_result',$data);
	}
	
	function leaveType_search()
	{
		$this->load->model('leave_model');
		$data['records'] = $this->leave_model->load_ajax_search($this->input->post());
		$this->load->view('leave/leave_res',$data);
	}
	
	function get_emp()
	{
		$this->load->model('emp_model');
		$data['records'] = $this->emp_model->get_employee($this->input->post());
		//$this->load->view('attendence/autoEmp',$data);
		$this->load->view('leave_allocation/lv_emp',$data);
	}
	
	function load_emp()
	{
		$this->load->model('emp_model');
		$data = $this->emp_model->get_employee_by_id($this->input->post());
		//echo json_encode($data);
		echo $data[0]->First_name;
		
	}
	
	function designation_search()
	{
		$this->load->model('designation_model');
		$data['records'] = $this->designation_model->get_all_job($this->input->post());
		$this->load->view('Designation/designationRes',$data);
	}
	
	function emp_search()
	{
		$this->load->model('emp_model');
		$data['records'] = $this->emp_model->get_all_emp($this->input->post());
		$this->load->view('Employee/employeeRes',$data);
	}
	
	function dept_search()
	{
		$this->load->model('department_model');
		$data['records'] = $this->department_model->get_all_dept_for_res($this->input->post());
		$this->load->view('Department/dept_res',$data);
	}
	
	function all_super()
	{
//		echo '<pre>'; print_r($_POST); echo '</pre>'; die();
		$this->load->model('performance_model');
		$data['records'] = $this->performance_model->get_all_supervisors($this->input->post());
		$this->load->view('supervisor/super_res',$data);
	}
	
	function get_des_fr_sup()
	{
		$this->load->model('performance_model');
		$data['records']=$this->performance_model->selected_des($this->input->post());
		$this->load->view('supervisor/des_sup',$data);
	}
	
	function task_search()
	{
		$this->load->model('performance_model');
		$data['records']=$this->performance_model->get_all_assigned_tasks($this->input->post());
		$this->load->view('Tasks/assignTskRes',$data);
	}
	
	function employee_tsk()
	{
		$this->load->model('performance_model');
		$data['records']=$this->performance_model->get_assign_tsk_fr_each_emp($this->input->post());
		$this->load->view('Emp_tasks/task_each_res',$data);
	}
	
	function approveTsk()
	{
		$this->load->model('performance_model');
		$data['records'] = $this->performance_model->get_task_fr_approval($this->input->post());
		$this->load->view('ApproveTsk/ApproveTskRes',$data);
	}
	
	function lv_allo()
	{
		$this->load->model('leave_model');
		$data['records'] = $this->leave_model->seerch_lv_allo($this->input->post());
		$this->load->view('leave_allocation/leave_allo_res',$data);
	}
    
    function leave_app()
    {
        
        $this->load->model('leave_model');
        $data['records'] = $this->leave_model->get_lv_app($this->input->post());
        $this->load->view('leave_app/leave_app_res',$data);
    }
    function get_lv_ent()
    {
        //echo '<pre>'; print_r($_POST);echo '</pre>';
        $this->load->model('leave_model');
        $lv_ent = $this->leave_model->get_lv_allo_fr_emp($this->input->post());
        foreach($lv_ent as $val){
            echo $val->val_des.','.$val->allocated.','.$val->used.','.$val->bal.',';
        }
      
    }
    function get_lv_appr()
    {
       
        $this->load->model('leave_model');
        $data['records'] = $this->leave_model->get_lv_app_fr_appr($this->input->post());
        $this->load->view('LeaveApprove/lv_appr_res',$data);
    }
    
    function veh_search()
    {
        $this->load->model('fuel_model');
        $data['records'] = $this->fuel_model->get_all_veh_det($this->input->post());
        $this->load->view('vehicle/vehicle_res',$data);
    }
    
    function customers()
    {
        $this->load->model('fuel_model');
        $data['records'] = $this->fuel_model->get_all_customers($this->input->post());
        $this->load->view('customer/cus_res',$data);
    }
    
    function recruitment()
    {
        //echo '<pre>'; print_r($_POST); echo '</pre>';
        $this->load->model('talent_model');
        $data['records'] = $this->talent_model->get_all_jobs($this->input->post());
        $this->load->view('recruitment/job_res',$data);
    }
    
    function get_email()
    {
        $this->load->model('user_model');
        $email = $this->user_model->get_emp_email($this->input->post());
        echo $email;
    }
    
    function search_users()
    {
        //dd($_POST);
        $this->load->model('user_model');
        $data['records'] = $this->user_model->get_all_users($this->input->post());
        $this->load->view('user/user_res',$data);
    }
    
    function hr_log_srch()
    {
        $this->load->model('staff_model');
        $data['records'] = $this->staff_model->get_all_log($this->input->post());
        $this->load->view('HR_log/hr_log_res',$data);
    }
    
    function gatepass_det()
    {
        //dd($_POST);
        $this->load->model('fuel_model');
        $data['records']=$this->fuel_model->get_passes_all($this->input->post());
        $this->load->view('gatepass/gate_pass_det_res',$data);
    }
    function idea_serach()
    {
        //dd($_POST);
        $this->load->model('talent_model');
        $data['records'] = $this->talent_model->get_all_ideas($this->input->post());
        $this->load->view('Ideas/idea_res',$data);
    }
    
    function get_emp_resign()
    {
        $this->load->model('talent_model');
        $data['records'] = $this->talent_model->get_det_fr_resign($this->input->post());
        $this->load->view('Resignation/resig_res',$data);
    }
}//search