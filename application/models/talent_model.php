<?php
class talent_model extends CI_Model{
    
    function insert_job($data)
    {
        $test1 = $data['opening_date'];
        $opening_date = date('Y-m-d',strtotime($test1));

        $test2 = $data['closing_date'];
        $closing_date = date('Y-m-d',strtotime($test2));
        
        $rec_id = $data['vacancy'].$data['opening_date'];
        $dataset = array('vacancy'=>$data['vacancy'],'Description'=>$data['Description'],'Edu_qualification'=>$data['Edu_qualification'],'Prf_qualification'=>$data['Prf_qualification'],'opening_date'=>$opening_date,'closing_date'=>$closing_date);
        
        $sql = $this->db->insert(RECRUIT_TBL,$dataset);
        if($sql){
            return $this->db->insert_id();
        }
    }
    
    function edit_job_db($data)
    {
        $test1 = $data['opening_date'];
        $opening_date = date('Y-m-d',strtotime($test1));

        $test2 = $data['closing_date'];
        $closing_date = date('Y-m-d',strtotime($test2));
        
        $dataset = array('vacancy'=>$data['vacancy'],'Description'=>$data['Description'],'Edu_qualification'=>$data['Edu_qualification'],'Prf_qualification'=>$data['Prf_qualification'],'opening_date'=>$opening_date,'closing_date'=>$closing_date);
        
        $this->db->where('rec_id',$data['rec_id']);
        $sql = $this->db->update(RECRUIT_TBL,$dataset);
        if($sql){
            return TRUE;
        }
    }
    
    function delete_job_db($rec_id)
    {
        $this->db->where('rec_id',$rec_id);
        $sql = $this->db->delete(RECRUIT_TBL);
        if($sql){
            return TRUE;
        }    
    }
    
    function get_all_jobs($data)
    {
        
        $test1 = $data['opening_date'];
        $opening_date = date('Y-m-d',strtotime($test1));
        
        $test2 = $data['closing_date'];
        $closing_date = date('Y-m-d',strtotime($test2));
        
        $this->db->select('*');
        $this->db->from(RECRUIT_TBL);
        $this->db->like('vacancy',$data['vacancy']);
        if(!empty($data['opening_date'])){
            $this->db->like('opening_date',$opening_date);
        }
        if(!empty($data['closing_date'])){
            $this->db->like('closing_date',$closing_date);
        }
        
        $this->db->order_by('vacancy');
        return $this->db->get()->result();
        //echo $this->db->last_query();
    }
    
    function get_job_by_id($recid)
    {
        $this->db->select('*');
        $this->db->from(RECRUIT_TBL);
        $this->db->where('rec_id',$recid);
        return $this->db->get()->result_array();
    }
    
    //*********************************************new ideas ****************************************************//
    function insert_idea($data)
    {
        $dataset = array('idea_inq'=>$data['idea_inq'],'details'=>$data['details'],
        'inq_idea_status'=>$data['inq_idea_status'],'Emp_id'=>$this->session->userdata('Emp_id'));
        
        $this->db->insert(IDEAS,$dataset);
        return TRUE;
    }
    
    function edit_idea_db($data)
    {
        //dd($data);
        $dataset = array('idea_inq'=>$data['idea_inq'],'details'=>$data['details'],'inq_idea_status'=>$data['inq_idea_status']);
        $this->db->where('id',$data['id']);
        $this->db->update(IDEAS,$dataset);
        return TRUE;
    }
    
    function get_all_ideas($data)
    {
        $this->db->select('*');
        $this->db->from(EMP_TBL.' emp');
        $this->db->join(IDEAS.' idea','idea.Emp_id = emp.Emp_id');
        $this->db->where('emp.Emp_id',$data['Emp_id']);
        return $this->db->get()->result();
    }
    
    function get_idea_by_id($id)
    {
        $this->db->select('*');
        $this->db->from(EMP_TBL.' emp');
        $this->db->join(IDEAS.' idea','idea.Emp_id = emp.Emp_id');
        $this->db->where('idea.id',$id);
        return $this->db->get()->result_array();
    }
    
    function delete_idea_db($data)
    {
        $this->db->where('id',$data['id']);
        $this->db->delete(IDEAS);
        return TRUE;
    }
    
    function approve($data)
    {
       // dd($data);
        $dataset = array('app_date'=>$data['app_date'],'feedbck_sup'=>$data['feedbck_sup'],'app_status'=>$data['app_status']);
        $this->db->where('id',$data['id']);
        $this->db->update(IDEAS,$dataset);
        return TRUE;
    }
    //****************************** resignation *********************************************************//
    function get_emp_considering_sess()
    {
        if($this->session->userdata('user_role_id') == 'DEO' || $this->session->userdata('user_role_id') == 'NEMP'){
            $this->db->select('*');
            $this->db->from(EMP_TBL);
            $this->db->order_by('First_name');
            $this->db->where('Emp_id',$this->session->userdata('Emp_id'));
            return $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from(EMP_TBL);
            $this->db->order_by('First_name');
            return $this->db->get()->result();
        }
    }
    
    function get_det_fr_resign($data)
    {
        $test1 = $data['resign_date'];
        $resign_date = date('Y-m-d',strtotime($test1));
        
        $this->db->select('emp.First_name,emp.Middle_name,pro.AppointmentDate,pro.EPF_no,pro.Account_No,pro.resign_date,(pro.resign_date > CURRDATE()) AS inact');
        $this->db->from(EMP_TBL.' emp');
        $this->db->join(EMP_PROFILE.' pro','pro.Emp_id=emp.Emp_id');
        if(!empty($data['resign_date'])){
            $this->db->like('pro.resign_date',$resign_date);
        }
        $this->db->like('emp.Emp_id',$data['Emp_id']);
        return $this->db->get()->result();
        
    }
    
    function get_resign_date($id)
    {
        $this->db->select('*');
        $this->db->from(EMP_PROFILE);
        $this->db->where('id',$id);
        return $this->db->get()->result_array();
    }
    
    function update_resign($data)
    {
        
        $test1 = $data['resign_date'];
        $resign_date = date('Y-m-d',strtotime($test1));
        
        $this->db->where('id',$data['id']);
        $sql = $this->db->update(EMP_PROFILE,array('resign_date'=>$resign_date));
        if($sql){return TRUE;}
    }
}
?>