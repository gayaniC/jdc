<?php

class user_model extends CI_Model{
	
	function get_all_emp()
	{
	
    $sql = "SELECT Emp_id,First_name,Middle_name FROM ".EMP_TBL." WHERE Emp_id NOT IN (SELECT Emp_id FROM ".USER.")";
    return $this->db->query($sql)->result();
	}
	
	function get_all_user_roles()
	{
		$this->db->select('user_role_id,user_role');
		$this->db->from(USER_ROLE);
		$this->db->order_by('user_role');
		return $this->db->get()->result();
	}
	
	function insert($data)
	{
		$dataset = array('user_role_id'=>$data['user_role_id'],'username'=>$data['username'],'password'=>md5($data['password_confirm']),
		'user_email'=>$data['user_email'],'Emp_id'=>$data['Emp_id'],'active'=>'1');
		$query = $this->db->insert(USER,$dataset);
		if($query){
			return $this->db->insert_id();
		}
	}
    
    function edit($data)
    {
        //dd($data);
        
        $dataset = array('user_role_id'=>$data['user_role_id'],'password'=>md5($data['password_confirm']));
        $this->db->where('id',$data['id']);
        $sql = $this->db->update(USER,$dataset);
        if($sql){
            return TRUE;
        }
        
    }
    
    function delete($data){
        
        $this->db->where('id',$data['id']);
        $sql = $this->db->delete(USER);
        if($sql){
            return TRUE;
        }
    }
    
    function get_emp_email($emp_id)
    {
        
        $this->db->select('Emp_mail')  ;
        $this->db->from(EMP_TBL);
        $this->db->where('Emp_id',$emp_id['Emp_id']);
        $res = $this->db->get()->result();
        foreach($res as $row){
            return $row->Emp_mail;
        }
      
    }
    
    function get_all_users_by_id($id)
    {
        $this->db->select('*');
        $this->db->from(USER);
        $this->db->where('id',$id);
        return $this->db->get()->result_array();
    }
    
    function get_all_users($data)
    {
       // dd($data);
        $this->db->select('*');
        $this->db->from(USER.' usr');
        $this->db->join(USER_ROLE.' role','role.user_role_id = usr.user_role_id');
        $this->db->join(EMP_TBL.' emp','emp.Emp_id = usr.Emp_id');
        $this->db->like('usr.username',$data['username']);
        $this->db->like('usr.user_email',$data['user_email']);
        $this->db->like('usr.Emp_id',$data['Emp_id']);
        $this->db->like('usr.user_role_id',$data['user_role_id']);
        return $this->db->get()->result_array();
        //echo $this->db->last_query();
    }
    
    function check_unique_username($data)
    {
        $this->db->select('username');
        $this->db->from(USER);
        $this->db->where_not_in('id',$data['id']);
        $this->db->where('username',$data['username']);
        $sql = $this->db->get()->result();
        foreach($sql as $row){
            return $row->username;
        }
    }
}