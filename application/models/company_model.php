<?php 

class company_model extends CI_Model
{
	
	function get_combo_res()
	{
		$this->db->select('comp_id,com_name');
		$this->db->from(COMPANY);
        $this->db->order_by('com_name');
		return $this->db->get()->result();
	}
	
	function load_ajax_search($data)
	{
		$this->db->select('*');
		$this->db->from(COMPANY);
		$this->db->or_like('comp_id',$data['comp_id'],'after');
		$this->db->like('com_name',$data['com_name'],'after');
		return $this->db->get()->result();
		//echo $this->db->last_query();
	}
	
	function insert($data)
	{
		$dataset = array(
			'comp_id' 					=>$data['comp_id'],
			'com_name'					=>$data['com_name'],
			'com_postal_code'			=>$data['com_postal_code'],
			'com_contact_Address_line1'	=>$data['com_contact_Address_line1'],
			'com_contact_Address_line2'	=>$data['com_contact_Address_line2'],
			'com_contact_no'			=>$data['com_contact_no']
		);
		if($this->db->insert(COMPANY,$dataset)){return $data['comp_id'];}else{return FALSE;}
		
	}
	
	function update_company($data)
	{
		$dataset = array(
			'com_name'					=>$data['com_name'],
			'com_postal_code'			=>$data['com_postal_code'],
			'com_contact_Address_line1'	=>$data['com_contact_Address_line1'],
			'com_contact_Address_line2'	=>$data['com_contact_Address_line2'],
			'com_contact_no'			=>$data['com_contact_no']
		);
		$this->db->where('comp_id',$data['comp_id']);
		$query = $this->db->update(COMPANY,$dataset);
		if($query){return $data['comp_id'];}
	}
	
	function delete_company($data)
	{
		$this->db->where('comp_id',$data['comp_id']);
		$query = $this->db->delete(COMPANY);
		if($query){return $data['comp_id'];}
	}
	
	function get_data_by_id($com_id)
	{
		$this->db->select('*');
		$this->db->from(COMPANY);
		$this->db->where('comp_id',$com_id);
		return $this->db->get()->result_array();
	}
}