<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation{
	function has_transactions($value , $params)
	{
		$CI =& get_instance();
		$this->set_message('has_transactions','Cannot DELETE the record. Dependencies exist.');	
		$params_arr = explode('.',$params);
		$tbl_name	=	$params_arr[0];
		$field_name	=	$params_arr[1];
		$CI->db->where($field_name,$value);
		$q = $CI->db->get($tbl_name);
		if($q->num_rows() > 0) return FALSE;
		return TRUE;
		
	}
}