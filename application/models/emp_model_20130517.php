<?php

class emp_model extends CI_Model{
	
	function get_employee($data)
	{
		$this->db->select('Emp_id,First_name,Middle_name,surname');
		$this->db->from(EMP_TBL);
		$this->db->like('First_name',$data['emp'],'after');
		return $this->db->get()->result();
	}
	
	function get_employee_by_id($emp_id)
	{
		$this->db->select('Emp_id,First_name,Middle_name,surname');
		$this->db->from(EMP_TBL);
		$this->db->where('Emp_id',$emp_id['emp']);
		return $this->db->get()->result();
	}
	
	function get_emp_by_id($id)
	{
		$this->db->select('*');
		$this->db->from(EMP_TBL.' emp');
		$this->db->join(EMP_PROFILE.' pro','emp.Emp_id=pro.Emp_id');
		$this->db->join(EMP_EDU_TBL.' edu','edu.Emp_id=pro.Emp_id');
		$this->db->join(EMP_PRV_WORK.' wrk','wrk.Emp_id=edu.Emp_id');
		$this->db->join(EMP_FAM_TBL.' fam','fam.Emp_id=wrk.Emp_id');
		$this->db->where('emp.Emp_id',$id);
		return $this->db->get()->result_array();
	}
	
	function get_all_emp($data)
	{
		$this->db->select('*');
		$this->db->from(EMP_PROFILE.' emp');
		$this->db->join(DESG_TBL.' desg','emp.Des_code=desg.Des_code');
		$this->db->join(DEPT_TBL.' dept','emp.Dept_id = dept.Dept_id');
		$this->db->join(EMP_TBL.' main','main.Emp_id = emp.Emp_id');
		$this->db->like('main.Emp_id',$data['Emp_id'],'after');
		$this->db->like('main.First_name',$data['First_name'],'after');
		$this->db->like('desg.job_Title',$data['job_Title'],'after');
		$this->db->like('dept.Dept_name',$data['Dept_name']);
		$this->db->like('main.NIC',$data['NIC'],'after');
		$this->db->like('main.Emp_mail',$data['Emp_mail'],'after');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	
	function insert($data,$files)
	{
		$emp_id 			= $data['First_name'].'-'.$data['NIC'];
		$dob 				= $data['year'].'-'.$data['month'].'-'.$data['day'];
		$test1 				= $data['AppointmentDate'];
		$AppointmentDate 	= date('Y-m-d',strtotime($test1));
		$test2 				= $data['resign_date'];
		$resign_date 		= date('Y-m-d',strtotime($test2));
		$test3 				= $data['from'] ;
		$from 				= date('Y-m-d',strtotime($test3));
		$test4				= $data['to'];
		$to					= date('Y-m-d',strtotime($test4)); 
		$test5				= $data['join_date'];
		$join_date			= date('Y-m-d',strtotime($test5)); 
		$test6				= $data['pre_resign_date'];
		$pre_resign_date	= date('Y-m-d',strtotime($test6)); 
		
		if(!empty($files['photo']['file_name'])){
			$dataset_personal = array('Emp_id'=>$emp_id,'title'=>$data['title'],'First_name'=>$data['First_name'],'Middle_name'=>$data['Middle_name'],
			'surname'=>$data['surname'],'NIC'=>$data['NIC'],'DOB'=>$dob,'religion'=>$data['religion'],'nationality'=>$data['nationality'],
			'postal_code'=>$data['postal_code'],'Contact_Address_line1'=>$data['Contact_Address_line1'],'Contact_Address_line2'=>$data['Contact_Address_line2'],
			'Contact_no'=>$data['Contact_no'],'Emp_mail'=>$data['Emp_mail'],'photo'=>$files['photo']['file_name'],'Distance'=>$data['Distance'],'marital_status'=>$data['marital_status']);
			
			$dataset_profile = array('AppointmentDate'=>$AppointmentDate,'EPF_no'=>$data['EPF_no'],'Account_No'=>$data['Account_No'],'resign_date'=>$resign_date,
			'Dept_id'=>$data['Dept_id'],'Emp_id'=>$emp_id ,'Des_code'=>$data['Des_code'],'bank_id'=>$data['bank_id']);
			
			$dataset_edu = array('from'=>$from, 'to'=>$to, 'Institute'=>$data['Institute'],'Qualification'=>$data['Qualification'],'Level' => $data['Level'],'Emp_id'=> $emp_id);
			
			$dataset_work = array('join_date'=>$join_date,'pre_resign_date'=>$pre_resign_date,'position_held'=>$data['position_held'],'company_name'=>$data['company_name'],
			'reason_to_leave'=>$data['reason_to_leave'],'exp_type'=>$data['exp_type'],'total_experience'=>$data['total_experience'],'Emp_id'=>$emp_id);
			
			$dataset_fam	= array('name'=>$data['name'],'relationship'=>$data['relationship'],'Age'=>$data['Age'],'NIC_f_fam_member'=>$data['NIC_f_fam_member'],
			'occupation'=>$data['occupation'],'contact_no'=>$data['contact_no'],'Emp_id'=>$emp_id);
			$this->db->trans_start();
			$this->db->insert(EMP_TBL,$dataset_personal);
			$this->db->insert(EMP_PROFILE,$dataset_profile);
			$this->db->insert(EMP_EDU_TBL,$dataset_edu);
			$this->db->insert(EMP_PRV_WORK,$dataset_work);
			$this->db->insert(EMP_FAM_TBL,$dataset_fam);
			$this->db->trans_complete();
			return $emp_id;
		}
		else{
			$dataset_personal = array('Emp_id'=>$emp_id,'title'=>$data['title'],'First_name'=>$data['First_name'],'Middle_name'=>$data['Middle_name'],
			'surname'=>$data['surname'],'NIC'=>$data['NIC'],'DOB'=>$dob,'religion'=>$data['religion'],'nationality'=>$data['nationality'],
			'postal_code'=>$data['postal_code'],'Contact_Address_line1'=>$data['Contact_Address_line1'],'Contact_Address_line2'=>$data['Contact_Address_line2'],
			'Contact_no'=>$data['Contact_no'],'Emp_mail'=>$data['Emp_mail'],'photo'=>'','Distance'=>$data['Distance'],'marital_status'=>$data['marital_status']);
			
			$dataset_profile = array('AppointmentDate'=>$AppointmentDate,'EPF_no'=>$data['EPF_no'],'Account_No'=>$data['Account_No'],'resign_date'=>$resign_date,
			'Dept_id'=>$data['Dept_id'],'Emp_id'=>$emp_id ,'Des_code'=>$data['Des_code'],'bank_id'=>$data['bank_id']);
			
			$dataset_edu = array('from'=>$from, 'to'=>$to, 'Institute'=>$data['Institute'],'Qualification'=>$data['Qualification'],'Level' => $data['Level'],'Emp_id'=> $emp_id);
			
			$dataset_work = array('join_date'=>$join_date,'pre_resign_date'=>$pre_resign_date,'position_held'=>$data['position_held'],'company_name'=>$data['company_name'],
			'reason_to_leave'=>$data['reason_to_leave'],'exp_type'=>$data['exp_type'],'total_experience'=>$data['total_experience'],'Emp_id'=>$emp_id);
			
			$dataset_fam	= array('name'=>$data['name'],'relationship'=>$data['relationship'],'Age'=>$data['Age'],'NIC_f_fam_member'=>$data['NIC_f_fam_member'],
			'occupation'=>$data['occupation'],'contact_no'=>$data['contact_no'],'Emp_id'=>$emp_id);
			$this->db->trans_start();
			$this->db->insert(EMP_TBL,$dataset_personal);
			$this->db->insert(EMP_PROFILE,$dataset_profile);
			$this->db->insert(EMP_EDU_TBL,$dataset_edu);
			$this->db->insert(EMP_PRV_WORK,$dataset_work);
			$this->db->insert(EMP_FAM_TBL,$dataset_fam);
			$this->db->trans_complete();
			return $emp_id;
		}
	}//insert
	
	
	
	
}