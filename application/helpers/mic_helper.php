<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('get_combo_from_results')){
	function get_combo_from_results($result , $id, $name , $empty_option = ''){
		$combo_ary = array();
		if($empty_option != ''){
			$combo_ary[''] = $empty_option;
		}
		if(count($result) > 0){
			foreach($result as $row){
				$combo_ary[$row->$id] = $row->$name;
			}	
		}
		return 	$combo_ary;	
	}
	
	function get_combo_from_results_another($result , $id, $name1 , $name2 , $empty_option = ''){
		$combo_ary = array();
		if($empty_option != ''){
			$combo_ary[''] = $empty_option;
		}
		if(count($result) > 0){
			foreach($result as $row){
				$combo_ary[$row->$id] = $row->$name1.' '.$row->$name2;
				//$combo_ary[$row->$id] = $row->$name2;
				
			}	
		}
		return 	$combo_ary;	
	}
}

if(!function_exists('has_transactions')){
	function has_transactions($tbl_ary='')
	{
		
		$has_transactions=FALSE;
		$CI =& get_instance();
		
		foreach($tbl_ary as $ary)
		{
			
			$rows = $CI->db->get_where($ary['table_name'],array($ary['field_nmae']=>$ary['value']))->num_rows();
			
			if($rows > 0){ $has_transactions = TRUE; break; }
		}
		return $has_transactions;
	}

}