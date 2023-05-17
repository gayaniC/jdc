<?php 

class performance_model extends CI_Model{
	
	function get_employees()
	{
		
		$sql = 'SELECT * FROM '.EMP_TBL.' WHERE Emp_id NOT IN (SELECT Emp_id FROM '.SUPER_TBL.') ORDER BY First_name';
		return $this->db->query($sql)->result();
	
	}
    
    //get employee check boxes for higer supervisor
    function get_low_sup()
    {
        $this->db->select('emp.Emp_id,emp.First_name,emp.Middle_name');
        $this->db->from(EMP_TBL.' emp');
        $this->db->join(SUPER_TBL.' sup','sup.Emp_id=emp.Emp_id');
        $this->db->where('sup.level','L');
        return $this->db->get()->result();
    }
    
    //get_session supervisor
    function get_supervisor_session($emp)
    {
        $this->db->select('sup.supervisor_id,emp.First_name,emp.Middle_name');
        $this->db->from(EMP_TBL.' emp');
        $this->db->join(SUPER_TBL.' sup','sup.Emp_id=emp.Emp_id');
        $this->db->where('emp.Emp_id',$emp);
        return $this->db->get()->result();
    }
    
	function get_employees_fr_edit()
	{
		$this->db->select('*');
		$this->db->from(EMP_TBL);
		$this->db->order_by('First_name');
		return $this->db->get()->result(); 
	}
	
	function selected_des($data)
	{
		$this->db->select('des.job_Title,des.Des_code');
		$this->db->from(EMP_TBL.' emp');
		$this->db->join(EMP_PROFILE.' emp_pro','emp.Emp_id=emp_pro.Emp_id');
		$this->db->join(DESG_TBL.' des','emp_pro.Des_code=des.Des_code');
		$this->db->where('emp.Emp_id',$data['Emp_id']);
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	function get_all_supervisors($data)
	{
		$this->db->select('*');
		$this->db->from(SUPER_TBL.' sup');
		$this->db->join(EMP_TBL.' emp','emp.Emp_id=sup.Emp_id');
		$this->db->join(DESG_TBL.' des','des.Des_code=sup.Des_code');
		$this->db->like('sup.supervisor_id',$data['supervisor_id'],'after');
		$this->db->like('emp.First_name',$data['Emp_id'],'after');
		$this->db->order_by('sup.supervisor_id');
		return $this->db->get()->result();
	}
	
	function get_super_by_id($id)
	{
		$this->db->select('*');
		$this->db->from(SUPER_TBL.' sup');
		$this->db->join(EMP_TBL.' emp','emp.Emp_id=sup.Emp_id');
		$this->db->join(DESG_TBL.' des','des.Des_code=sup.Des_code');
		$this->db->where('sup.supervisor_id',$id);
	    return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	function get_emp_by_sup_id($id)
	{
		$this->db->select('em.Emp_id,emp.First_name,emp.Middle_name');
		$this->db->from(EMP_MANAGED.' em');
		$this->db->join(EMP_TBL.' emp','em.Emp_id=emp.Emp_id');
		$this->db->where('em.supervisor_id',$id);
		$this->db->order_by('emp.First_name');
		return $this->db->get()->result();
	}
	
	function insert_super($data)
	{
		$dataset = array('supervisor_id'=>$data['supervisor_id'],'Emp_id'=>$data['Emp_id'],'Des_code'=>$data['Des_code'],'level'=>$data['level']);	
		$query = $this->db->insert(SUPER_TBL,$dataset);
		if($query){
			return $data['supervisor_id'];
		}
	}
	
	function update_super($data)
	{
		//echo '<pre>'; print_r($data); echo '</pre>'; die();
		if(!empty($data['Emp'])){
			$id = $this->exist_emp($data['supervisor_id']);
			if($id){
				foreach($data['Emp'] as $key=>$val){
					$dt = array('Emp_id'=>$val,'supervisor_id'=>$data['supervisor_id']);
					$this->db->insert(EMP_MANAGED,$dt);
				}
			}
		}
		$dataset = array('Emp_id'=>$data['Emp_id'],'Des_code'=>$data['Des_code'],'level'=>$data['level']);
		$this->db->where('supervisor_id',$data['supervisor_id']);
		$query = $this->db->update(SUPER_TBL,$dataset);
		if($query){
			return $data['supervisor_id'];
		}
	}
	
	function delete_super($id)
	{
		$this->db->where('supervisor_id',$id);
		$query = $this->db->delete(SUPER_TBL);
		if($query){
			return TRUE;
		}else{
			return $id;
		}
	}
	 function exist_emp($id)
	{
		$this->db->where('supervisor_id',$id);
		$sql = $this->db->delete(EMP_MANAGED);
		if($sql){return TRUE;}else{return FALSE;}
	} 
	
	function insert_assign_emp($data)
	{
		$id = $this->exist_emp($data['supervisor_id']);
		if($id){
			$this->db->trans_start();
			foreach($data['Emp'] as $key=>$val) {
				$dataset = array('Emp_id'=>$val,'supervisor_id'=>$data['supervisor_id']);
				$this->db->insert(EMP_MANAGED,$dataset);
				
			}
			$this->db->trans_complete();
			return $data['supervisor_id'];
		}else{ 
			$this->db->trans_start();
		foreach($data['Emp'] as $key=>$val) {
			$dataset = array('Emp_id'=>$val,'supervisor_id'=>$data['supervisor_id']);
			$this->db->insert(EMP_MANAGED,$dataset);
			
		}
		$this->db->trans_complete();
		return $data['supervisor_id'];
		}
	}
	//************************************************Assign Tasks***********************************************************//
    
    //combo task
    function get_all_task()
    {
        $this->db->select('*');
        $this->db->from(TASK_TBL);
        $this->db->order_by('task_name');
        return $this->db->get()->result();
    }
    
	function get_all_assigned_tasks($data)
	{//get the result set for assign tasks search criteria
		if(!empty($data['From'])){
			$test1 = $data['From'];
			$From = date('Y-m-d',strtotime($test1));
		}
		if(!empty($data['To'])){
			$test2 = $data['To'];
			$To = date('Y-m-d',strtotime($test2));
		}
		$this->db->select('sup.supervisor_id,emp.First_name,emp.title,emp.surname,tsk.task_name,tsk.From,tsk.To,tsk.task_id');
		$this->db->from(SUPER_TBL.' sup');
		$this->db->join(EMP_TBL.' emp','sup.Emp_id=emp.Emp_id');
		$this->db->join(TASK_TBL.' tsk','sup.supervisor_id=tsk.supervisor_id','left');
		$this->db->order_by('sup.supervisor_id');
		$this->db->like('sup.supervisor_id',$data['supervisor_id'],'after');
		//$this->db->like('emp.First_name',$data['superName'],'after');
		if(!empty($data['From'])){
			$this->db->like('tsk.From',$From);
		}
		if(!empty($data['To'])){
			$this->db->like('tsk.To',$To);
		}
		return $this->db->get()->result();
		//echo $this->db->last_query();
	}
	
	function get_tsk_by_id($id)
	{
		$this->db->select('mn.supervisor_id,emp.First_name,tsk.task_id,tsk.task_name,tsk.From,tsk.To');
		$this->db->from(EMP_TBL.' emp');
		$this->db->join(EMP_MANAGED.' mn','emp.Emp_id=mn.Emp_id');
		$this->db->join(TASK_TBL.' tsk','tsk.supervisor_id=mn.supervisor_id','left');
		$this->db->where('tsk.task_id',$id);
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	function get_assigned_emp($id)
	{//get all the employees 
		$this->db->select('emp.First_name,emp.Emp_id');
		$this->db->from(EMP_MANAGED.' empm');
		$this->db->join(EMP_TBL.' emp','empm.Emp_id=emp.Emp_id');
		$this->db->where('empm.supervisor_id',$id);
		return $this->db->get()->result();
		
	}
	
	function get_tsk_assigned_emp($id)
	{//get assigned employees
		
		$this->db->select('*');
		$this->db->from(EMP_TBL.' emp');
		$this->db->join(EMP_HS_TASK.' emtsk','emtsk.Emp_id=emp.Emp_id');
		//$this->db->join(TASK_TBL.' tsk','tsk.task_id=emtsk.task_id');
		$this->db->where('emtsk.task_id',$id);
		return $this->db->get()->result();
		//echo $this->db->last_query();
		
	}
	
	function insert_tasks($data)
	{
		$test1 = $data['From'];
		$From = date('Y-m-d',strtotime($test1));
		$test2 = $data['To'];
		$To = date('Y-m-d',strtotime($test2));
		
		$dataset = array('task_id'=>$data['task_id'],'task_name'=>$data['task_name'],'From'=>$From,'To'=>$To,'supervisor_id'=>$data['supervisor_id']);
		$this->db->trans_start();
		$this->db->insert(TASK_TBL,$dataset);
		foreach($data['Emp'] as $key=>$val) {
			$dataset1 = array('Emp_id'=>$val,'task_id'=>$data['task_id']);
			$this->db->insert(EMP_HS_TASK,$dataset1);
			
		}
		$this->db->trans_complete();
		 return $data['supervisor_id'];
	}
	
	function del_emp_ass($id)
	{
		$this->db->where('task_id',$id);
		$sql = $this->db->delete(EMP_HS_TASK);
		if($sql){return TRUE;}else{return FALSE;}	
	}
	
	function update_tasks($data)
	{
		$test1 = $data['From'];
		$From = date('Y-m-d',strtotime($test1));
		$test2 = $data['To'];
		$To = date('Y-m-d',strtotime($test2));
		$dataset = array('task_name'=>$data['task_name'],'From'=>$From,'To'=>$To,'supervisor_id'=>$data['supervisor_id']);
		
		$this->db->trans_start();
		$this->db->where('task_id',$data['task_id']);
		$this->db->update(TASK_TBL,$dataset);
		if(!empty($data['Emp'])){
			$id = $this->del_emp_ass($data['task_id']);
			if($id == 1)	{
				foreach($data['Emp'] as $key=>$val) {
					$dataset1 = array('Emp_id'=>$val,'task_id'=>$data['task_id']);
					$this->db->insert(EMP_HS_TASK,$dataset1);
					
				}
			}
		}
		$this->db->trans_complete();
		if($this->db->trans_status() === TRUE){
			 return $data['supervisor_id'];
		}
	}
	
	//***************************************************Employee Tasks***********************************************************//
	function get_all_employees()
	{
		$this->db->select('Emp_id,First_name,Middle_name');
		$this->db->from(EMP_TBL);
		$this->db->order_by('First_name');
		return $this->db->get()->result();
	}
	
	function get_assign_tsk_fr_each_emp($data)
	{
		$this->db->select('tsk.task_id,tsk.task_name,tsk.From,tsk.To,emp.status,emp.approved,emp.feedback_date,em.title,em.First_name,em.Middle_name,em.surname');
		$this->db->from(TASK_TBL.' tsk');
		$this->db->join(EMP_HS_TASK.' emp','emp.task_id=tsk.task_id');
		$this->db->join(SUPER_TBL.' sup','sup.supervisor_id=tsk.supervisor_id');
		$this->db->join(EMP_TBL.' em','em.Emp_id=sup.Emp_id');
		$this->db->where('emp.Emp_id',$data['Emp_id']);
		$this->db->order_by('tsk.task_name');
		return $this->db->get()->result();
	}
	
	function get_emp_tsk_by_id($id)
	{
		$this->db->select('tsk.task_id,tsk.task_name,tsk.From,tsk.To,sup.supervisor_id,emp.feedback_date,emp.status,emp.comments,emp.approved');
		$this->db->from(TASK_TBL.' tsk');
		$this->db->join(EMP_HS_TASK.' emp','emp.task_id=tsk.task_id');
		$this->db->join(SUPER_TBL.' sup','sup.supervisor_id=tsk.supervisor_id');
		$this->db->join(EMP_TBL.' em','em.Emp_id=sup.Emp_id');
		$this->db->where('emp.Emp_id',$this->session->userdata('Emp_id'));
		$this->db->where('tsk.task_id',$id);
		return $this->db->get()->result_array();
        //echo $this->db->last_query();
	}
	
	function edit_emp_progress($data)
	{
		$test1 = $data['feedback_date'];
		$feedback_date = date('Y-m-d',strtotime($test1));
		switch($data['status']){
			case '0':
				$marks = '0';
			break;
			case '1':
				$marks = '100';
			break;
			case '9':
				$marks = '50';
			break;
		}
		if(!empty($data['comments'])){
			$dataset = array('feedback_date'=>$feedback_date,'status'=>$data['status'],'comments'=>$data['comments'],'marks'=>$marks);
		}else{
			$dataset = array('feedback_date'=>$feedback_date,'status'=>$data['status'],'marks'=>$marks);
		}
		$this->db->where('task_id',$data['task_id']);
		$query = $this->db->update(EMP_HS_TASK,$dataset);
		if($query){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	//***************************** approve task ******************************************************************//
	function get_all_supervisors_fr_approve()
	{
		$this->db->select('emp.Emp_id,emp.First_name,emp.Middle_name');
		$this->db->from(SUPER_TBL.' sup');
		$this->db->join(EMP_TBL.' emp','sup.Emp_id=emp.Emp_id');
		$this->db->order_by('First_name','Middle_name');
		return $this->db->get()->result();
	}
	function get_sup_id($emp_id)
	{
		$this->db->select('supervisor_id');
		$this->db->from(SUPER_TBL);
		$this->db->where('Emp_id',$emp_id);
		return $this->db->get()->result();
	}
	
	function get_task_fr_approval($data)
	{
		//echo '<pre>'; print_r($data); echo '</pre>';
		$id = $this->get_sup_id($data['Emp_id']);
		//echo $id[0]->supervisor_id;
		if($id){
			$test1 = $data['feedback_date'];
        	$date = date('Y-m-d',strtotime($test1));

			if($data['status'] == '5') {$complete = '5';}else if($data['status'] == 'Incomplete'){$complete = '0';}
			else if($data['status'] == 'Complete'){$complete = '1';} else if($data['status'] == 'Half'){$complete = '9';}
			else {$complete = '';}
			
			$this->db->select('tsk.*,emptsk.*,emp.First_name,emp.Middle_name,tsk.To - CURDATE() as expiry');
			$this->db->from(TASK_TBL.' tsk');
			$this->db->join(EMP_HS_TASK.' emptsk','emptsk.task_id = tsk.task_id');
			$this->db->join(EMP_TBL.' emp','emptsk.Emp_id = emp.Emp_id');
			$this->db->where('tsk.supervisor_id',$id[0]->supervisor_id);
			$this->db->order_by('tsk.task_name');
			$this->db->like('emptsk.status',$complete);
			$this->db->like('tsk.task_name',$data['task_name']);
			$this->db->like('emptsk.feedback_date',$data['feedback_date']);
			return $this->db->get()->result();
			//echo $this->db->last_query();
		}
		
	}
	
	function mark_approval($id,$stat)
	{
		//echo $id; die();
		//switch($stat){
//			case 'App':
//				$app_status = 'A';
//			break;
//			case 'Rej':
//				$app_status = 'R';
//			break;
//		}
//		$dataset = array('approved_by'=>$this->session->userdata('Emp_id'),'approved'=>$app_status);
//		$this->db->where('id',$id);
//		$query = $this->db->update(EMP_HS_TASK,$dataset);
//		if($query){
//			return TRUE;
//		}

        if($stat == 'App'){
            $dataset = array('approved_by'=>$this->session->userdata('Emp_id'),'approved'=>'A');
            $this->db->where('id',$id);
            $query = $this->db->update(EMP_HS_TASK,$dataset);
            if($query){
                return 'Approve';
            }
        }//app
        if($stat == 'Rej'){
            $dataset = array('approved_by'=>$this->session->userdata('Emp_id'),'approved'=>'R');
            $this->db->where('id',$id);
            $query = $this->db->update(EMP_HS_TASK,$dataset);
            if($query){
                return 'Reject';
            }
        }
	}
	
}