<?php 
	class report_ctr extends CI_Controller{
		
		function leave_report()
		{
			$data  = $this->_load_data();
			$data['main_content'] = 'Reports/lv_report_gen';
			$this->load->view('includes/template.php',$data);
		}
        
        function progress_report()
        {
            $data  = $this->_load_data();
			$data['main_content'] = 'Reports/prog_report';
			$this->load->view('includes/template.php',$data);
        }
        
        function employee_report()
        {
            $data  = $this->_load_data();
			$data['main_content'] = 'Reports/emp_det_report';
			$this->load->view('includes/template.php',$data);
        }
        
        function attendance_report()
        {
            $data  = $this->_load_data();
			$data['main_content'] = 'Reports/att_report';
			$this->load->view('includes/template.php',$data);
        }
        
        function fuel_consump_report()
        {
            $data  = $this->_load_data();
			$data['main_content'] = 'Reports/fuel_report';
			$this->load->view('includes/template.php',$data);
        }
        
        function salary_report()
        {
            $data  = $this->_load_data();
			$data['main_content'] = 'Reports/salary_det';
			$this->load->view('includes/template.php',$data);
        }
		
		function _load_data()
		{
			$this->load->model('emp_model');
			$this->load->model('leave_model');
            $this->load->model('department_model');
            $this->load->model('company_model');
            $this->load->model('performance_model');
            $this->load->model('fuel_model');
			
			$lvType = $this->leave_model->get_all_lvtype_combo();
			$data['LeaveType'] = get_combo_from_results($lvType,'leave_type_code','Leave_type','Please Select a Leave Type');
			
			$emp = $this->emp_model->get_all_emp_fr_combo();
			$data['employee'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','Please select an Employee');
            
            $dept = $this->department_model->get_dept_fr_combo();
            $data['dept'] = get_combo_from_results($dept,'Dept_id','Dept_name','Please select a department');
            
            $com = $this->company_model->get_combo_res();
            $data['com'] = get_combo_from_results($com,'comp_id','com_name','Please select a company');
            
            $tsk = $this->performance_model->get_all_task();
            $data['tsk'] = get_combo_from_results($tsk,'task_id','task_name','Please select a task');
            
            $veh = $this->fuel_model->get_veh_det();
            $data['vehicle'] = get_combo_from_results($veh,'Vehicle_no','Vehicle_no','Please select a vehicle');
			
			return $data;
		}
	}
?>