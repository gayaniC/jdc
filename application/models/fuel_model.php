<?php
class fuel_model extends CI_Model{
    
    function get_employees()
    {
       $this->db->select('Emp_id,First_name,Middle_name') ;
       $this->db->from(EMP_TBL);
       $this->db->order_by('First_name,Middle_name');
       return $this->db->get()->result();
    }
    
    function get_all_veh_det($data)
    {
        //echo '<pre>'; print_r($data); echo '</pre>';
        $this->db->select('vh.Vehicle_no,vh.Vehicle_name,vh.Brand,vh.ltr_per_km,vh.usage_type');
        $this->db->from(VEHICLE_TBL.' vh');
        $this->db->join(EMP_VEHICLE.' evh','evh.Vehicle_no=vh.Vehicle_no','left');
        $this->db->join(EMP_TBL.' emp','emp.Emp_id = evh.Emp_id','left');
        $this->db->like('vh.Vehicle_no',$data['Vehicle_no']);
        $this->db->like('vh.usage_type',$data['usage_type']);
        $this->db->order_by('vh.Vehicle_name');
        $this->db->group_by('vh.Vehicle_no');
        return $this->db->get()->result();
    }
    
    function get_veh_by_id($veh_no)
    {
        $this->db->select('vh.Vehicle_no,vh.Vehicle_name,vh.Brand,vh.ltr_per_km,vh.usage_type,emp.Emp_id');
        $this->db->from(VEHICLE_TBL.' vh');
        $this->db->join(EMP_VEHICLE.' emp','emp.Vehicle_no=vh.Vehicle_no','left');
        $this->db->where('vh.Vehicle_no',$veh_no);
        return $this->db->get()->result_array();
        //echo $this->db->last_query(); die();
    }
    
    function insert_veh($data)
    {
        
            $dataset = array('Vehicle_no'=>$data['Vehicle_no'],
                        'Vehicle_name'=>$data['Vehicle_name'],
                        'Brand'=>$data['Brand'],
                        'ltr_per_km'=>$data['ltr_per_km'],
                        'usage_type'=>$data['usage_type']);
        
        
        $this->db->trans_start();
        if($data['usage_type'] == 'P'){
          foreach ($data['Emp_id'] as $key=>$val){
            
           $this->db->insert(EMP_VEHICLE,array('Emp_id'=>$val,'Vehicle_no'=>$data['Vehicle_no']));
          }  
        }
        
          $this->db->insert(VEHICLE_TBL,$dataset);
        $result = $this->db->trans_complete();
        if($result != ''){
            return TRUE;
        }
    }//insert
    
    function delete_cur_emp($veh)
    {
        $this->db->where('Vehicle_no',$veh);
        $res = $this->db->delete(EMP_VEHICLE);
        if($res){return TRUE;}
    }
    
    function edit_veh_db($data)
    {
         $dataset = array('Vehicle_name'=>$data['Vehicle_name'],
                        'Brand'=>$data['Brand'],
                        'ltr_per_km'=>$data['ltr_per_km'],
                        'usage_type'=>$data['usage_type']);
         $del_v = $this->delete_cur_emp($data['Vehicle_no']);
         if($del_v != ''){
            $this->db->trans_start();
            $this->db->where('Vehicle_no',$data['Vehicle_no']);
            $this->db->update(VEHICLE_TBL,$dataset);
            if($data['usage_type'] == 'P'){
              foreach($data['Emp_id'] as $key=>$val){
                $this->db->insert(EMP_VEHICLE,array('Emp_id'=>$val,'Vehicle_no'=>$data['Vehicle_no']));
              }  
            }
            
            $result = $this->db->trans_complete();
            if($result != ''){
                return TRUE;
            }
         }
    }//edit
    
    function delete_veh_db($data)
    {
        $this->db->trans_start();
        $this->db->where('Vehicle_no',$data['Vehicle_no']);
        $this->db->delete(VEHICLE_TBL);
        $this->db->where('Vehicle_no',$data['Vehicle_no']);
        $this->db->delete(EMP_VEHICLE);
        $result = $this->db->trans_complete();
        if($result != ''){
            return TRUE;
        }
    }
    //check whether the logged in employee has vehicle
    function chk_emp_hs_veh($emp)
    {
        //echo $emp; 
        $veh = $this->db->get_where(EMP_VEHICLE,array('Emp_id'=>$emp))->result();
        if(empty($veh)){
            return 'C';
        }else{
            return 'P';
        }
    }
    
    function get_all_vehicle()
    {
        $emp = $this->session->userdata('Emp_id');
        $type = $this->chk_emp_hs_veh($emp);
        if($type == 'P'){
          $this->db->select('*');
          $this->db->from(VEHICLE_TBL.' veh');
          $this->db->join(EMP_VEHICLE.' eveh','eveh.Vehicle_no = veh.Vehicle_no');
          $this->db->order_by('veh.Vehicle_no');
          $this->db->where('Emp_id',$emp);  
          return $this->db->get()->result();
        }else{
            $this->db->select('*');
            $this->db->from(VEHICLE_TBL);
            $this->db->where('usage_type','C');
            $this->db->order_by('Vehicle_no');
            return $this->db->get()->result();
        }
        
    }
    
    //get vehicle combo for report
    function get_veh_det()
    {
        $this->db->select('*');
        $this->db->from(VEHICLE_TBL);
        $this->db->order_by('Vehicle_no');
        return $this->db->get()->result();
    }
    
    //get logged in employee
    function get_log_emp()
    {
        $this->db->select('*');
        $this->db->from(EMP_TBL);
        $this->db->where('Emp_id',$this->session->userdata('Emp_id'));
        return $this->db->get()->result();
    }
    
    //******************************************customers *************************************************//
    function insert_cus($data)
    {
        $dataset = array(
            'cus_id' => $data['cus_id'],
            'customer_name' => $data['customer_name'],
            'contactAddress' => $data['contactAddress'],
            'Contact_no'     => $data['Contact_no']        
        );
        
        $query = $this->db->insert(CUST_TBL,$dataset);
        if($query){
            return true;
        }
    }
    
    function edit_customer($data)
    {
        $dataset = array('customer_name' => $data['customer_name'],
            'contactAddress' => $data['contactAddress'],
            'Contact_no'     => $data['Contact_no']);
            
            $this->db->where('cus_id',$data['cus_id']);
            $query = $this->db->update(CUST_TBL,$dataset);
            if($query){
                return true;
            }
    }
    
    function delete_customer($data)
    {
        $this->db->where('cus_id',$data['cus_id']);
        $sql = $this->db->delete(CUST_TBL);
        if($sql){
            return true;
        }
    }
    
    function get_cus_by_id($cus_id)
    {
        $this->db->select('*');
        $this->db->from(CUST_TBL);
        $this->db->where('cus_id',$cus_id);
        return $this->db->get()->result_array();
       // echo $this->db->last_query(); die();
    }
    
    function get_all_customers($data)
    {
        $this->db->select('*');
        $this->db->from(CUST_TBL);
        $this->db->like('cus_id',$data['cus_id']);
        $this->db->like('customer_name',$data['customer_name']);
        $this->db->order_by('customer_name');
        return $this->db->get()->result();
        
    }
    
    function get_all_customer()
    {
        $this->db->select('*');
        $this->db->from(CUST_TBL);
        $this->db->order_by('customer_name');
        return $this->db->get()->result();
    }
    //******************************************gate pass ***********************************************************//
    function get_max_gate_pass()
    {
        $this->db->select_max('gate_pass_id');
        $this->db->from(GATE_PASS);
        $sql= $this->db->get()->result();
        foreach($sql as $row){
            return $row->gate_pass_id;
        }
    }
    
    function get_cus_name($cus_id)
    {
        $this->db->select('customer_name');
        $this->db->from(CUST_TBL);
        $this->db->where('cus_id',$cus_id);
        $sql = $this->db->get()->result();
        foreach($sql as $row){
            return $row->customer_name;
        }
    }
    
    function get_emp_name($emp)
    {
        $this->db->select('First_name,Middle_name');
        $this->db->from(EMP_TBL);
        $this->db->where('Emp_id',$emp);
        $sql = $this->db->get()->result();
        foreach($sql as $row){
            return $row->First_name.' '.$row->Middle_name;
        }
    }
    
    function insert_gatepass($data)
    {
       
        $dataset = array('gate_pass_id'=>$data['gate_pass_id'],'Vehicle_no'=>$data['Vehicle_no'],
                    'Emp_id'=>$data['Emp_id'],'cus_id'=>$data['cus_id'],'Date'=>date('Y-m-d'));
        $this->db->insert(GATE_PASS,$dataset);
                    
        
    }
    
    function get_passes_all($data)
    {
        $this->db->select('*');
        $this->db->from(GATE_PASS.' gt');
        $this->db->join(CUST_TBL.' cus','cus.cus_id = gt.cus_id');
        if(!empty($data['Vehicle_no'])){$this->db->like('gt.Vehicle_no',$data['Vehicle_no']);}
        if(!empty($data['Emp_id'])){$this->db->like('gt.Emp_id',$data['Emp_id']);}
        if(!empty($data['cus_id'])){$this->db->like('gt.cus_id',$data['cus_id']);}
        if(!empty($data['gate_pass_id'])){$this->db->like('gt.gate_pass_id',$data['gate_pass_id']);}
        $this->db->order_by('gt.gate_pass_id','DESC');
        return $this->db->get()->result();
        //echo $this->db->last_query();
    }
    
    function get_gt_det_by_id($id)
    {
        $this->db->select('*');
        $this->db->from(GATE_PASS.' gt');
        $this->db->join(CUST_TBL.' cus','cus.cus_id=gt.cus_id');
        $this->db->where('gt.gate_pass_id',$id);
        return $this->db->get()->result_array();
    }
    
    function get_time_unit()
    {
        $this->db->select('*');
        $this->db->from(FIXED_VAL);
        $this->db->where('val_type','time');
        $this->db->order_by('val_ord');
        return $this->db->get()->result();
    }
    
    //calculation of fuel consumption and insert into fuel consumption tbl
    function cal_fuel_consump($all)
    {
        
        $this->db->select('ltr_per_km');
        $this->db->from(VEHICLE_TBL);
        $this->db->where('Vehicle_no',$all['Vehicle_no']);
        $ltr = $this->db->get()->result();
        foreach($ltr as $row){
             
            $fuel_consump = $row->ltr_per_km * $all['distance'];
            $dataset = array('consumtion_ltr'=>$fuel_consump,'gate_pass_id'=>$all['gate_pass_id']);
            $this->db->insert(FUEL_CONSUMP,$dataset);
        }
        return TRUE;
    }
    
    function edit_gt_pass_dt($data)
    {
        
        $id = $this->cal_fuel_consump($data);
        if($id != ''){
            $dataset = array('departure'=>$data['departure'],
            'departure_unit'=>$data['departure_unit'],
            'return'=>$data['return'],
            'return_unit'=>$data['return_unit'],
            'distance'=>$data['distance']);
            $this->db->where('gate_pass_id',$data['gate_pass_id']);
            $sql = $this->db->update(GATE_PASS,$dataset);
            if($sql){
                return TRUE;
            }
        }
        //dd($data);
    }
    
    function delete_gt_pass_det($data)
    {
        $this->db->where('gate_pass_id',$data['gate_pass_id']);
        $sql = $this->db->delete(GATE_PASS);
        if($sql){
            return TRUE;
        }
    }
}
?>