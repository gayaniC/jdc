<?php

class leave_model extends CI_Model{
	
	function get_all_lvtype_combo()
	{
		$this->db->select('*');
		$this->db->from(LEAVE_TYPE);
		$this->db->order_by('Leave_type');
		return $this->db->get()->result();
		//echo $this->db->last_query();
	}
	
	function load_ajax_search($data)
	{
		$this->db->select('*');
		$this->db->from(LEAVE_TYPE);
		$this->db->like('leave_type_code',$data['leave_type_code'],'after');
		$this->db->like('Leave_type',$data['Leave_type'],'after');
		return $this->db->get()->result();
	}
	
	function get_leave_type_by_id($id)
	{
		return $this->db->get_where(LEAVE_TYPE,array('leave_type_code'=>$id))->result_array();
	}
	
	function insert_leave_type($data)
	{
		$dataset = array('leave_type_code'=>$data['leave_type_code'],'Leave_type' => $data['Leave_type']);
		$query = $this->db->insert(LEAVE_TYPE,$dataset);
		if($query){
			return $data['leave_type_code']	;
		}
	}
	
	function edit_leave_type($data)
	{
		$dataset = array('Leave_type' => $data['Leave_type']);
		$query = $this->db->update(LEAVE_TYPE,$dataset);
		$this->db->where('leave_type_code',$data['leave_type_code']);
		if($query){
			return $data['leave_type_code'];
		}
	}
	
	function delete_leave_type($data)
	{
		$this->db->where('leave_type_code',$data['leave_type_code']);
		$query = $this->db->delete(LEAVE_TYPE);
		if($query){
			return $data['leave_type_code']	;
		}
	}
	//************************************************** Leave Allocation ************************************************************//
	function seerch_lv_allo($data)
	{
		$this->db->select('emp.Emp_id,emp.title,emp.First_name,emp.Middle_name,emp.surname,lvty.Leave_type,lvallo.year,lvallo.allocated,lvallo.leave_allo_id,lvallo.used,lvallo.allo_uom');
		$this->db->from(EMP_TBL.' emp');
		$this->db->join(LV_ALLO_TBL.' lvallo','lvallo.Emp_id=emp.Emp_id','left');
		$this->db->join(LEAVE_TYPE.' lvty','lvty.leave_type_code=lvallo.leave_type_code','left');
		$this->db->join(LEAVE_TBL.' lvapp','lvapp.leave_type_code=lvty.leave_type_code','left');
		$this->db->order_by('emp.First_name,emp.Middle_name');
		$this->db->like('emp.Emp_id',$data['Emp_id']);
		 if(!empty($data['Leave_type'])){
		$this->db->like('lvty.Leave_type',$data['Leave_type']);
		}
		if(!empty($data['year'])){
		$this->db->like('lvallo.year',$data['year']);
		}
		return $this->db->get()->result();
		
		//echo $this->db->last_query();
	}
	
	function get_lv_uom()
	{
		$this->db->select('*');
		$this->db->from(FIXED_VAL);
		$this->db->order_by('val_des');
		return $this->db->get()->result();
	}
	
	function get_lv_allo_by_emp($emp_id)
	{
		
		 $this->db->select('*');
		 $this->db->from(EMP_TBL);
		 $this->db->where('Emp_id',$emp_id);
		 return $this->db->get()->row_array();
	}
	
	function get_lv_allo_by_allo_id($lv_allo)
	{
		$this->db->select('emp.Emp_id,emp.First_name,emp.Middle_name,lvty.leave_type_code,lv_allo.year,lv_allo.allocated,lv_allo.allo_uom,lv_allo.used,fx.val_des,lv_allo.leave_allo_id');
		$this->db->from(EMP_TBL.' emp');
		$this->db->join(LV_ALLO_TBL.' lv_allo','emp.Emp_id = lv_allo.Emp_id','left');
		$this->db->join(FIXED_VAL.' fx','fx.val_id=lv_allo.allo_uom','left');
		$this->db->join(LEAVE_TYPE.' lvty','lvty.leave_type_code=lv_allo.leave_type_code','left');
		$this->db->where('lv_allo.leave_allo_id',$lv_allo);
		//$this->db->or_where('fx.val_type','LV');
		return $this->db->get()->result_array();
		//echo $this->db->last_query();
	}
	
	//get the leave type by considering emp id and leave allo id
	function get_lv_type_fr_allo($id)
	{
		if(is_numeric($id)){
			$this->db->select('ty.leave_type_code,ty.Leave_type');
			$this->db->from(LV_ALLO_TBL.' lv_allo');
			$this->db->join(LEAVE_TYPE.' ty','ty.leave_type_code=lv_allo.leave_type_code');
			$this->db->where('lv_allo.leave_allo_id',$id);
			return $this->db->get()->result();
			//echo $this->db->last_query();
			
		}else{
			
			$sql = 'SELECT * FROM '.LEAVE_TYPE.' WHERE leave_type_code NOT IN (SELECT leave_type_code FROM '.LV_ALLO_TBL.' WHERE Emp_id = "'.$id.'") ORDER BY Leave_type';
			return $this->db->query($sql)->result();
		}
	}
    
    function count_all_lv()
    {
        $this->db->select('COUNT(leave_type_code) AS all_lv');
        $this->db->from(LEAVE_TYPE);
        return $this->db->get()->row_array();
    }
    //count the leave type to add leave allocations for particular employee
	function count_lv_by_id($emp_id)
    {
        $this->db->select('COUNT(leave_type_code) AS cur_lv');
        $this->db->from(LV_ALLO_TBL);
        $this->db->where('Emp_id',$emp_id);
        $lv_allo =  $this->db->get()->row_array();
        
        $all_lv = $this->count_all_lv();
        
        if($lv_allo['cur_lv'] < $all_lv['all_lv']){
            return TRUE;
        }else{
            return FALSE;
        }
        
    }
    
	function insert_allo_lv($data)
	{
		//echo '<pre>'; print_r($data); echo '</pre>'; die();
		$dataset = array('year'=>$data['year'],'allocated'=>$data['allocated'],'allo_uom'=>$data['allo_uom'],'leave_type_code'=>$data['leave_type_code'],'Emp_id'=>$data['Emp_id']);
		$sql = $this->db->insert(LV_ALLO_TBL,$dataset);
		if($sql){
			return TRUE;
		}else{
			return FALSE;
		}
	}
    
    function edit_allo_lv($data)
    {
        
        $dataset = array('year'=>$data['year'],'allocated'=>$data['allocated'],'allo_uom'=>$data['allo_uom']);
        $this->db->where('leave_allo_id',$data['leave_allo_id']);
        $sql = $this->db->update(LV_ALLO_TBL,$dataset);
        if($sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function delete_allo_lv($data)
    {
        $this->db->where('leave_allo_id',$data['leave_allo_id']);
        $sql = $this->db->delete(LV_ALLO_TBL);
        if($sql){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    //*********************************************  Leave App *******************************************//
    function get_lv_app($data)
    {
        
        $this->db->select('*');
        $this->db->from(LEAVE_TBL.' lv');
        $this->db->join(LEAVE_TYPE.' lvty','lvty.leave_type_code = lv.leave_type_code');
        $this->db->where('lv.Emp_id',$data['Emp_id']);
        $this->db->order_by('lv.applied_on','DESC');
        return $this->db->get()->result();
    }
    
    function get_lv_allo_fr_emp($data)
    {
        $this->db->select('lv_allo.allocated,lv_allo.used,fx.val_des,(lv_allo.allocated-lv_allo.used) AS bal');
        $this->db->from(LV_ALLO_TBL.' lv_allo');
        $this->db->join(FIXED_VAL.' fx','fx.val_id=lv_allo.allo_uom','left');
        $this->db->where('Emp_id',$this->session->userdata('Emp_id'));
        $this->db->where('leave_type_code',$data['leave_type_code']);
        $this->db->where('year',date('Y'));
        return $this->db->get()->result();
    }
    
    function get_cur_lv($lv)
    {
        $this->db->select('used,leave_allo_id');
        $this->db->from(LV_ALLO_TBL);
        $this->db->where('leave_type_code',$lv);
        $this->db->where('Emp_id',$this->session->userdata('Emp_id'));
        $this->db->where('year',date('Y'));
        return $this->db->get()->result();
    }
    
    //function get_supervisor($emp_id)
//    {
//        $this->db->select('supervisor_id');
//        $this->db->from(EMP_MANAGED);
//        $this->db->where('Emp_id',$emp_id);
//        return $this->db->get()->result_array();
//    }
    
    function inser_lv_app($data)
    {
        $test1 = $data['From'];
        $From = date('Y-m-d',strtotime($test1));
        $test2 = $data['to'];
        $to = date('Y-m-d',strtotime($test2));
        $test3 = $data['applied_on'];
        $applied_on = date('Y-m-d',strtotime($test3));
        
        $used_lv = $this->get_cur_lv($data['leave_type_code']);
        //$super = $this->get_supervisor($this->session->userdata('Emp_id'));
        
        //$apprv_by =  json_encode($super);
        
        
        $dataset = array('From'=>$From,'to'=>$to,'applied_on'=>$applied_on,'no_of_days'=>$data['no_of_days'],'reason_for_leave'=>$data['reason_for_leave'],'Emp_id'=>$this->session->userdata('Emp_id'),'leave_type_code'=>$data['leave_type_code'],'app_status'=>'P');
        $all_used = $used_lv[0]->used+$data['no_of_days'];
        
        
        $this->db->trans_start();
        $this->db->insert(LEAVE_TBL,$dataset);
        $this->db->where('leave_allo_id',$used_lv[0]->leave_allo_id);
        $this->db->update(LV_ALLO_TBL,array('used'=>$all_used));
        $result = $this->db->trans_complete();
        if($result != ''){
            return TRUE;
        }
    }
    
    function get_lv_app_by_id($lvapp)
    {
        $this->db->select('LV.lv_app_no,LV.From,LV.to,LV.applied_on,LV.no_of_days,LV.reason_for_leave,LV.Emp_id,LV.leave_type_code,LV.app_status,FX.val_des,
LVALLO.used,LVALLO.allocated,(LVALLO.allocated-LVALLO.used) AS bal');
        $this->db->from(LV_ALLO_TBL.' LVALLO');
        $this->db->join(LEAVE_TBL.' LV','LV.leave_type_code=LVALLO.leave_type_code');
        $this->db->join(FIXED_VAL.' FX','FX.val_id = LVALLO.allo_uom');
        $this->db->where('LV.lv_app_no',$lvapp);
        return $this->db->get()->result_array();
        //echo $this->db->last_query();
    }
    
    function edit_lv_app($data)
    {
       
        $test1 = $data['From'];
        $From = date('Y-m-d',strtotime($test1));
        $test2 = $data['to'];
        $to = date('Y-m-d',strtotime($test2));
        $test3 = $data['applied_on'];
        $applied_on = date('Y-m-d',strtotime($test3));
        
        $used_lv = $this->get_cur_lv($data['leave_type_code']);
        $dataset = array('From'=>$From,'to'=>$to,'applied_on'=>$applied_on,'no_of_days'=>$data['no_of_days'],'reason_for_leave'=>$data['reason_for_leave'],'Emp_id'=>$data['Emp_id'],'leave_type_code'=>$data['leave_type_code'],'app_status'=>'P');
        $all_used = ($used_lv[0]->used-$data['db_no_of_days'])+$data['no_of_days'];
        
        $this->db->trans_start();
        $this->db->where('lv_app_no',$data['lv_app_no']);
        $this->db->update(LEAVE_TBL,$dataset);
        $this->db->where('leave_allo_id',$used_lv[0]->leave_allo_id);
        $this->db->update(LV_ALLO_TBL,array('used'=>$all_used));
        $result = $this->db->trans_complete();
        if($result != ''){
            return TRUE;
        }
    }
    
    function remove_lv_app_from_db($data)
    {
        
        $used_lv = $this->get_cur_lv($data['leave_type_code']);
        $all_used = $used_lv[0]->used-$data['db_no_of_days'];
        
        $this->db->trans_start();
        $this->db->where('leave_allo_id',$used_lv[0]->leave_allo_id);
        $this->db->update(LV_ALLO_TBL,array('used'=>$all_used));
        $this->db->where('lv_app_no',$data['lv_app_no']);
        $this->db->delete(LEAVE_TBL);
        $result = $this->db->trans_complete();
        if($result != ''){
            return TRUE;
        }
        
    }
    
    //************************************************ Leave approval *****************************************//
    
    function get_supervisors()
    {
        $this->db->select('*');
        $this->db->from(SUPER_TBL.' sup');
        $this->db->join(EMP_TBL.' emp','emp.Emp_id=sup.Emp_id');
        return $this->db->get()->result();
    }
    
    function get_sup_id($emp)
    {
        $this->db->select('supervisor_id');
        $this->db->from(SUPER_TBL);
        $this->db->where('Emp_id',$emp);
        $res = $this->db->get()->result();
        foreach($res as $row){
            return $row->supervisor_id;
        }
    }
    
    function get_lv_app_fr_appr($data)
    {
        $super = $this->get_sup_id($data['Emp_id']);
        $this->db->select('lv.lv_app_no,lv.From,lv.to,lv.applied_on,lv.no_of_days,lv.reason_for_leave,lv.Emp_id,lv.app_status,emp.First_name,emp.Middle_name');
        $this->db->from(LEAVE_TBL.' lv');
        $this->db->join(EMP_MANAGED.' mng','lv.Emp_id=mng.Emp_id');
        $this->db->join(SUPER_TBL.' sup','sup.supervisor_id=mng.supervisor_id');
        $this->db->join(EMP_TBL.' emp','emp.Emp_id=lv.Emp_id');
        $this->db->where('sup.supervisor_id',$super);
        $this->db->where('lv.app_status','P');
        return $this->db->get()->result();
        //echo $this->db->last_query();
    }
    
    function mark_lv_appr($lvapp,$status)
    {
        if($status == 'App'){
            $dataset = array('appr_by'=>$this->session->userdata('Emp_id'),'app_status'=>'A');
            $this->db->where('lv_app_no',$lvapp);
            $sql = $this->db->update(LEAVE_TBL,$dataset);
            if($sql){
                return 'Approve';
            }
        }
        if($status == 'Rej'){
            $dataset = array('appr_by'=>$this->session->userdata('Emp_id'),'app_status'=>'R');
            $this->db->where('lv_app_no',$lvapp);
            $sql = $this->db->update(LEAVE_TBL,$dataset);
            if($sql){
                return 'Reject';
            }
            
        }
    }
}