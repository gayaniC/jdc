<?php 
class department_model extends CI_Model{
	
	function get_all_dept()
	{
		return $this->db->get(DEPT_TBL)->result();
	}
    
    //combo
    function get_dept_fr_combo()
    {
        $this->db->select('*');
        $this->db->from(DEPT_TBL);
        $this->db->order_by('Dept_name');
        return $this->db->get()->result();
    }
	
	function get_all_dept_for_res($data)
	{
		$this->db->select('*');
		$this->db->from(DEPT_TBL.' dpt');
	    $this->db->join(COMPANY.' cmp','dpt.comp_id=cmp.comp_id');
		$this->db->like('dpt.Dept_id',$data['Dept_id'],'after');
		$this->db->like('dpt.Dept_name',$data['Dept_name'],'after');
        if($data['comp_id'] != ''){
            $this->db->where('cmp.comp_id',$data['comp_id']);
        }
        
		return $this->db->get()->result();
		//echo $this->db->last_query();
	}
	
	function get_dept_by_id($dept_code)
	{
		return $this->db->get_where(DEPT_TBL,array('Dept_id'=>$dept_code))->result_array();
	}
	
	function insert($data)
	{
		$dataset = array('Dept_id'=>$data['Dept_id'],'Dept_name'=>$data['Dept_name'],'dept_description'=>$data['dept_description'],'comp_id'=>$data['comp_id']);
		$query   = $this->db->insert(DEPT_TBL,$dataset);
		if($query){
			return $data['Dept_id'];
		}
	}
	
	function edit($data)
	{
		$dataset = array('Dept_name'=>$data['Dept_name'],'dept_description'=>$data['dept_description'],'comp_id'=>$data['comp_id']);
		$this->db->where('Dept_id',$data['Dept_id']);
		$query = $this->db->update(DEPT_TBL,$dataset);
		if($query){
			return $data['Dept_id'];
		}
	}
	
	function delete($id)
	{
		$this->db->where('Dept_id',$id)	;
		$query = $this->db->delete(DEPT_TBL);
		if($query){
			return $id;
		}
	}
}