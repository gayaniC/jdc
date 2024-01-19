<?php
class login_model extends CI_model{
	function validate($data)
	{
		$this->db->select('*');
		$this->db->from(USER.' us');
		$this->db->join(USER_ROLE.' ur','us.user_role_id = ur.user_role_id');
		//$this->db->join(EMP_TBL.' emp','emp.Emp_id=us.Emp_id','left');
		$this->db->where('us.username',$data['username']);
		$this->db->where ('us.password',md5($data['password']));
		return $this->db->get()->row();
		
		
	}
	
	
}