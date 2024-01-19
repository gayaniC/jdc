<?php

class designation_model extends CI_Model{
		
	function get_all_job($data)
	{
		$this->db->select('*');
		$this->db->from(DESG_TBL);
		$this->db->like('job_Title',$data['job_Title'],'after');
		$this->db->like('des_type',$data['des_type'],'after');
		return $this->db->get()->result();
	}
	
	function insert_designation($data)
	{
		$des_code = preg_replace('/\s+/', '',$data['job_Title']).'-'.$data['des_type'];
		$dataset = array(
		'Des_code'	=>	$des_code,
		'job_Title'	=>	$data['job_Title'],
		'des_type'	=>	$data['des_type'],
		'basic_Salary'=>$data['basic_Salary']
		);
		//echo '<pre>'; print_r($dataset); echo '</pre>'; die();
		$query = $this->db->insert(DESG_TBL,$dataset);
		if($query){
			return $des_code;
		}
	}
	
	function get_jobs_by_id($id)
	{
		$this->db->select('*');
		$this->db->from(DESG_TBL);
		$this->db->where('Des_code',$id);
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	function get_all_designation()
	{
		return $this->db->get(DESG_TBL)->result();
	}
	
	function edit_des($data)
	{
		$dataset = array('job_Title'=>$data['job_Title'],'des_type'=>$data['des_type'],'basic_Salary'=>$data['basic_Salary']);
		$this->db->where('Des_code',$data['Des_code']);
		$sql = $this->db->update(DESG_TBL,$dataset);
		if($sql){return $data['Des_code'];}
	}
	
	function delete_des($data)
	{
		$this->db->where('Des_code',$data['Des_code']);
		$sql = $this->db->delete(DESG_TBL);
		if($sql){return $data['Des_code'];}
	}
}