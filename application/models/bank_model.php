<?php
class bank_model extends CI_Model{
	
	function getAllBank()
	{
		return $this->db->get(BANK_TBL)->result();	
	}
}