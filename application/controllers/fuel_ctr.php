<?php 
class fuel_ctr extends CI_Controller{
	
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true )
		{
		  redirect('login');
			//echo '<font color="#FF0000" size="5">You don\'t have permission to access this page. </font>'; echo anchor(site_url('login'),'<font color="#0000FF" size="5">Login</font>','title="login"');
			//die();
		}
	}
	
	function vehicle()
	{
		$data['main_content'] = 'vehicle/vehicle';
		$this->load->view('includes/template.php',$data);
		
	}
    
    function add_veh($msg="")
    {
        $data = $this->_load_data_veh();
        $data['action'] = 'Add';
        $data['msg'] = $msg;
        $data['main_content'] = 'vehicle/veh_mgt';
		$this->load->view('includes/template.php',$data);
    }
    
    function edit_veh($id="",$msg="")
    {
        $data = $this->_load_data_veh($id);
        $data['action'] = 'Edit';
        $data['msg'] = $msg;
        $data['main_content'] = 'vehicle/veh_mgt';
		$this->load->view('includes/template.php',$data);
    }
    
    function delete_veh($id="",$msg="")
    {
        $data = $this->_load_data_veh($id);
        $data['action'] = 'Delete';
        $data['msg'] = $msg;
        $data['main_content'] = 'vehicle/veh_mgt';
		$this->load->view('includes/template.php',$data);
    }
    
    function view_veh($id="")
    {
        $data = $this->_load_data_veh($id);
        $data['action'] = 'View';
        $data['main_content'] = 'vehicle/veh_mgt';
		$this->load->view('includes/template.php',$data);
    }
    
    function _load_data_veh($id='')
    {
        $this->load->model('fuel_model');
        
        
        $emp = $this->fuel_model->get_employees();
        $data['employees'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','Please Select an Employee');
        
        if($id != ''){
            $data['veh'] = $this->fuel_model->get_veh_by_id($id);
            //echo '<pre>'; print_r($data['veh']); echo '</pre>'; die();
        }
        return $data;
    }
    
    function validate_veh()
    {
        if($this->input->post('action') == 'Add'){
            $this->form_validation->set_rules('Vehicle_no','Vehicle No','trim|required|alpha_dash|is_unique['.VEHICLE_TBL.'.Vehicle_no]');
        }
        if($this->input->post('action') == 'Edit' || $this->input->post('action') == 'Add'){
            $this->form_validation->set_rules('Vehicle_name','Vehicle Name','trim|required');
            $this->form_validation->set_rules('Brand','Brand','trim|required');
            $this->form_validation->set_rules('ltr_per_km','Fuel Usage','trim|required|numeric');
            $this->form_validation->set_rules('usage_type','Purpose of usage','required');
            if($this->input->post('usage_type') == 'P'){
                $this->form_validation->set_rules('Emp_id[]','Employee','trim|required');
            }
            
        }
       if($this->input->post('action') == 'Delete'){
                $this->remove_veh();
       }
       
       if($this->form_validation->run() == false)
       {
            switch($this->input->post('action')){
                case 'Add':
                    $this->add_veh();
                break;
                case 'Edit':
                    $this->edit_veh($this->input->post('Vehicle_no'));
                break;
                
            }
       }else{
        switch($this->input->post('action')){
                case 'Add':
                    $this->create_veh();
                break;
                case 'Edit':
                    $this->update_veh();
                break;
                
        }
       }
    }//validate
    
    function create_veh()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->insert_veh($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_ADD);
            redirect('fuel_ctr/edit_veh/'.$this->input->post('Vehicle_no'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/add_veh');
        }
    }
    
    function update_veh()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->edit_veh_db($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_UPDATE);
            redirect('fuel_ctr/edit_veh/'.$this->input->post('Vehicle_no'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/edit_veh/'.$this->input->post('Vehicle_no'));
        }
    }
    
    function remove_veh()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->delete_veh_db($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('fuel_ctr/vehicle/');
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/delete_veh/'.$this->input->post('Vehicle_no'));
        }
    }
	
	//*********************** customers *******************************************************************//
    function customer()
    {
        $data['main_content'] = 'customer/customer';
        $this->load->view('includes/template.php',$data);
    }
    
    function add_cus($msg='')
    {
      //$data = $this->_load_data_fr_cus();
      $data['action'] = 'Add';
      $data['msg'] = $msg;
      $data['main_content'] = 'customer/customer_mgt';
      $this->load->view('includes/template.php',$data);  
    }
    
    function edit_cus($id='',$msg='')
    {
      $data = $this->_load_data_fr_cus($id);
      $data['action'] = 'Edit';
      $data['msg'] = $msg;
      $data['main_content'] = 'customer/customer_mgt';
      $this->load->view('includes/template.php',$data);  
    }
    
    function delete_cus($id='',$msg='')
    {
      $data = $this->_load_data_fr_cus($id);
      $data['action'] = 'Delete';
      $data['msg'] = $msg;
      $data['main_content'] = 'customer/customer_mgt';
      $this->load->view('includes/template.php',$data);  
    }
    
    function view_cus($id='')
    {
      $data = $this->_load_data_fr_cus($id);
      $data['action'] = 'View';
      $data['main_content'] = 'customer/customer_mgt';
      $this->load->view('includes/template.php',$data);  
    }
    
    function _load_data_fr_cus($id='')
    {
       $this->load->model('fuel_model');
       
       if($id != ''){
        $data['cus'] = $this->fuel_model->get_cus_by_id($id);
        //echo '<pre>'; echo print_r($data['cus']); echo '</pre>';
       }
       
       return $data; 
    }
    
    function validate_cus()
    {
        if($this->input->post('action') == 'Add'){
            $this->form_validation->set_rules('cus_id','Customer ID','trim|required|alpha_dash|is_unique['.CUST_TBL.'.cus_id]');
        }
        if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
            $this->form_validation->set_rules('customer_name','Name','trim|required');
            $this->form_validation->set_rules('contactAddress','Address','trim|required');
            $this->form_validation->set_rules('Contact_no','Contact No','trim|required|numeric');
        }
        
        if($this->input->post('action') == 'Delete'){
            $this->remove_cus();
        }
        
        if($this->form_validation->run()==false){
            switch($this->input->post('action')){
                case 'Add':
                    $this->add_cus();
                break;
                case 'Edit':
                    $this->edit_cus($this->input->post('cus_id'));
                break;
                
            }
        }else{
            switch($this->input->post('action')){
                case 'Add':
                    $this->create_cus();
                break;
                case 'Edit':
                    $this->update_cus();
                break;
                
            }
        }
    }
    
    function create_cus()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->insert_cus($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_ADD);
            redirect('fuel_ctr/edit_cus/'.$this->input->post('cus_id'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/add_cus');
        }
    }
    
    function update_cus()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->edit_customer($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_UPDATE);
            redirect('fuel_ctr/edit_cus/'.$this->input->post('cus_id'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/edit_cus/'.$this->input->post('cus_id'));
        }
    }
    
    function remove_cus()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->delete_customer($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('fuel_ctr/customer');
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/delete_cus/'.$this->input->post('cus_id'));
        }
    }
    
    //**************************************************gatepass************************************************//
    
    function gate_pass()
    {
        $data = $this->_load_data_fr_gate_pass();
        $data['main_content'] = 'gatepass/gate_pass';
        $this->load->view('includes/template.php',$data);
    }
    
    function _load_data_fr_gate_pass()
    {
        $this->load->model('emp_model');
        $this->load->model('fuel_model');
        
        $emp = $this->fuel_model->get_log_emp();
        $data['employee'] = get_combo_from_results_another($emp,'Emp_id','First_name','Middle_name','');
        
        $veh = $this->fuel_model->get_all_vehicle();
        $data['vehicle'] = get_combo_from_results($veh,'Vehicle_no','Vehicle_no','Please select a vehicle');
        
        $customer = $this->fuel_model->get_all_customer();
        $data['customer'] =  get_combo_from_results($customer,'cus_id','customer_name','Please select a cutomer');
        
        return $data;
    }
    
    function gatepass()
    {
        
        $this->form_validation->set_rules('Vehicle_no','Vehicle No','required');
        $this->form_validation->set_rules('Emp_id','Employee','required');
        $this->form_validation->set_rules('cus_id','Customer','required');
        
        if($this->form_validation->run()==FALSE){
            $this->gate_pass();
        }else{
            
            $this->load->helper('pdf_helper.php');
            $this->load->model('fuel_model');
            //get_data from db
            $customer = $this->fuel_model->get_cus_name($this->input->post('cus_id'));
            $employee = $this->fuel_model->get_emp_name($this->input->post('Emp_id'));
            
            $vehicle = $this->input->post('Vehicle_no');
            
            //get_max_gatepass
            $id = $this->fuel_model->get_max_gate_pass();
            $gatepass_id = $id+1;
            
            $records = array(array('Vehicle_no'=>$vehicle,'cus_id'=>$customer,'Emp_id'=>$employee));
            $veh = array('gate_pass_id'=>$gatepass_id);
            $enter_tbl = array('Vehicle_no'=>$vehicle,'cus_id'=>$this->input->post('cus_id'),'Emp_id'=>$this->input->post('Emp_id'));
            $merge = array_merge($enter_tbl,$veh);
            $this->fuel_model->insert_gatepass($merge);
            
            ?>
            <html>
           <head>
           
           <style>
                
                .table_holder {border:1px groove;
                            width:80%;
                			padding-top:20px;
                            padding-bottom:20px;
                            padding-left: 10px;
                            padding-right:10px;
                            }
                #insert{margin-left: 30%;}
                #left{float: left;}
                #right{float:right;}
                td{padding-left:30px;
                   padding-top:5px;
                   padding-bottom:5px ; }
                
                </style>
           </head> 
           <body>
          
           
            <div class="table_holder">
            <?php foreach($records as $val){ ?>
            <img src="<?php echo site_url(); ?>images/jdclogo.png"/><br /><b>JDC Group of companies,<br />No:304,<br />Grand Pass Road,<br />Colombo 14.</b>
            <h2 align="center"><u>Gate Pass <?php echo $gatepass_id; ?></u></h2>
            <table>
            <tr>
            <td><b>Date: <u><?php echo date('Y-m-d'); ?></u></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><b>Vehicle No: <u><?php echo $val['Vehicle_no']; ?></u></b></td>
            </tr>
            <tr>
            <td><b>Customer: <u><?php echo $val['cus_id']; ?></u></b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><b>Employee: <u><?php echo $val['Emp_id']; ?></u></b></td>
            </tr>
            </table>
          
            <p align="center"><b>Time Out(Departure):</b></p><p align="center">......................................</p>
            <p align="center"><b>Time In(Return):    </b></p><p align="center">......................................</p>
            <p align="center"><b>Purpose :           </b></p><p align="center">......................................</p>
            
           
           <table>
           <tr>
           <td>......................</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>......................</td>
           </tr>
           <tr>
           <td><b>Signature of Employee</b></td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td><b>Signature of HOD</b></td>
           </tr>
           </table>
            
            <?php } ?>
         </div>
        
             
            </body>
            </html>
            <?php
            $content = ob_get_contents();
            ob_end_clean();
			try
        {
        $html2pdf = new HTML2PDF('P', 'A5', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('GatePass.pdf');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }   
        }
       
        
    }
    //***********************************************Gate Pass Details ****************************************************//
    function gate_pass_det()
    {
        $data = $this->_load_data_fr_gate_pass();
        $data['main_content']='gatepass/gate_pass_det';
        $this->load->view('includes/template.php',$data);
    }
    
    function view_gatepass($id)
    {
        $data = $this->_load_data_gt_det($id);
        $data['action'] = 'View';
        $data['main_content'] = 'gatepass/gatepass_det_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function edit_gatepass($id,$msg='')
    {
        $data = $this->_load_data_gt_det($id);
        $data['action'] = 'Edit';
        $data['msg'] = $msg;
        $data['main_content'] = 'gatepass/gatepass_det_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function delete_gate_pass($id,$msg='')
    {
        $data = $this->_load_data_gt_det($id);
        $data['action'] = 'Delete';
        $data['msg'] = $msg;
        $data['main_content'] = 'gatepass/gatepass_det_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function _load_data_gt_det($id = '')
    {
        $this->load->model('fuel_model');
        $data['gt_det'] = $this->fuel_model->get_gt_det_by_id($id);
        
        $dt_unit = $this->fuel_model->get_time_unit();
        $data['dt_unit'] = get_combo_from_results($dt_unit,'val_id','val_des','');
        
        return $data;
    }
    
    function validate_gt_det()
    {
        $this->form_validation->set_rules('departure','Time Departure','trim|required|numeric');
        $this->form_validation->set_rules('return','Time Return','trim|required|numeric');
        $this->form_validation->set_rules('distance','Distance','trim|required|numeric');
        
        if($this->input->post('action') == 'Delete'){
            $this->remove_gt_pass_det();
        }
        
        if($this->form_validation->run() == FALSE){
            if($this->input->post('action') == 'Edit'){
                $this->edit_gatepass($this->input->post('gate_pass_id'));
            }
        }else{
            if($this->input->post('action') == 'Edit'){
               $this->update_gt_pass_det(); 
            }
        }
        
    }
    
    function update_gt_pass_det()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->edit_gt_pass_dt($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_UPDATE);
            redirect('fuel_ctr/edit_gatepass/'.$this->input->post('gate_pass_id'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/edit_gatepass/'.$this->input->post('gate_pass_id'));
        }
    }
    
    function remove_gt_pass_det()
    {
        $this->load->model('fuel_model');
        $id = $this->fuel_model->delete_gt_pass_det($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('fuel_ctr/gate_pass_det');
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('fuel_ctr/delete_gate_pass/'.$this->input->post('gate_pass_id'));
        }
    }
    
    
}