<?php
class staff_model extends CI_Model{
    
    function insert_hr_log($data)
    {
        //dd($data);
        $test1 = $data['Date'];
        $date = date('Y-m-d',strtotime($test1));
        $dataset = array('event_name'=>$data['event_name'],'Date'=>$date,'actions_taken'=>$data['actions_taken']);
        $sql = $this->db->insert(HR_LOG,$dataset);
        if($sql){
            return $this->db->insert_id();
        }
        
    }
    
    function get_log_by_id($id)
    {
        return $this->db->get_where(HR_LOG,array('hr_id'=>$id))->result_array();
    }
    
    function edit_hr_log($data)
    {
        $test1 = $data['Date'];
        $date = date('Y-m-d',strtotime($test1));
        $dataset = array('Date'=>$date,'actions_taken'=>$data['actions_taken']);
        $this->db->where('hr_id',$data['hr_id']);
        $sql = $this->db->update(HR_LOG,$dataset);
        if($sql){
            return $data['hr_id'];
        }
    }
    
    function remove_hr_log($data)
    {
        $this->db->where('hr_id',$data['hr_id']);
        $sql = $this->db->delete(HR_LOG);
        if($sql != '')
        {
            return TRUE;
        }
    }
    
    function get_all_log($data)
    {
        $this->db->select('*');
        $this->db->from(HR_LOG);
        $this->db->like('event_name',$data['event_name']);
        $this->db->like('Date',$data['Date']);
        return $this->db->get()->result();
    }
    
    function get_all_supervisors()
    {
        $this->db->select('emp.Emp_id,emp.First_name,emp.Middle_name');
        $this->db->from(EMP_TBL.' emp');
        $this->db->join(SUPER_TBL.' sup','sup.Emp_id=emp.Emp_id');
        $this->db->order_by('emp.First_name');
        return $this->db->get()->result();
    }
    
    function get_email_f_sup($data)
    {
      
            $this->db->select('Emp_mail');
            $this->db->from(EMP_TBL);
            $this->db->where('Emp_id',$data['Emp_id']);
            return $this->db->get()->result_array();
        
    }
}

?>