<?php
class Generate extends CI_Controller{
    
    function create_csv($data)
    {
		
        $this->load->database();
        //*******************************leave **********************************************************//
		switch($data['report_type']){
			case 'Leave':
			$test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
			
			$this->db->select('lv.lv_app_no,lv.From,lv.to,lv.applied_on,lvty.Leave_type,emp.First_name,emp.Middle_name,dept.Dept_name,com.com_name'); 
			$this->db->from(LEAVE_TBL.' lv');
			$this->db->join(EMP_TBL.' emp','emp.Emp_id=lv.Emp_id');
            $this->db->join(EMP_PROFILE.' pro','pro.Emp_id = emp.Emp_id');
            $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
            $this->db->join(COMPANY.' com','com.comp_id = dept.comp_id');
			$this->db->join(LEAVE_TYPE.' lvty','lvty.leave_type_code = lv.leave_type_code');
            $this->db->where('emp.status','1');
            $this->db->order_by('lv.applied_on','DESC');
            if(!empty($data['month'])){$this->db->where('month(lv.applied_on)',$data['month']);}
            if(!empty($data['year'])){ $this->db->where('year(lv.applied_on)',$data['year']);}
			if(!empty($data['leave_type_code'])){$this->db->like('lv.leave_type_code',$data['leave_type_code']);}
			if(!empty($data['Emp_id'])){$this->db->like('lv.Emp_id',$data['Emp_id']);}
			if(!empty($data['from'])){$this->db->where("lv.applied_on BETWEEN '$from' AND '$to'");}
			if(!empty($data['app_status'])){$this->db->like('lv.app_status',$data['app_status']);}
            if(!empty($data['Dept_id'])) {$this->db->like('dept.Dept_id',$data['Dept_id']);}
            if(!empty($data['comp_id'])){$this->db->like('dept.comp_id',$data['comp_id']);}
			
			$query = $this->db->get();
             //*******************************progress **********************************************************//
			break;
            case 'Progress':
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
            if(!empty($data['com_status'])){
                switch($data['com_status']){
                    case '':
                        $com_status = '';
                    break;
                    case 'A':
                        $com_status = '0';
                    break;
                    case '1':
                        $com_status = '1';
                    break;
                    case '9':
                        $com_status = '9';
                    break;
                }
            }
            
            $this->db->select('tsk.task_name,tsk.From,tsk.To,emp.status,emp.approved,emp.feedback_date,em.First_name,em.Middle_name,com.com_name,dept.Dept_name');
    		$this->db->from(TASK_TBL.' tsk');
    		$this->db->join(EMP_HS_TASK.' emp','emp.task_id=tsk.task_id');
    		$this->db->join(EMP_TBL.' em','em.Emp_id=emp.Emp_id');
            $this->db->join(EMP_PROFILE.' pro','pro.Emp_id = emp.Emp_id');
            $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
            $this->db->join(COMPANY.' com','com.comp_id = dept.comp_id');
            $this->db->where('em.status','1');
            $this->db->order_by('emp.feedback_date','DESC');
    		if(!empty($data['Emp_id'])){$this->db->like('emp.Emp_id',$data['Emp_id']);}
            if(!empty($data['task_id'])){$this->db->like('tsk.task_id',$data['task_id']);}
            if(!empty($data['from'])){$this->db->where("emp.feedback_date BETWEEN '$from' AND '$to'");}
    		if(!empty($data['month'])){$this->db->where('month(emp.feedback_date)',$data['month']);}
            if(!empty($data['year'])){ $this->db->where('year(emp.feedback_date)',$data['year']);}
            if(!empty($data['app_status'])){$this->db->like('emp.approved',$data['app_status']);}
            if(!empty($data['Dept_id'])) {$this->db->like('dept.Dept_id',$data['Dept_id']);}
            if(!empty($data['comp_id'])){$this->db->like('dept.comp_id',$data['comp_id']);}
            if(!empty($data['com_status'])){$this->db->like('emp.status',$com_status);}
    		$query = $this->db->get();
            break;
            //************************************* salary ***********************************************************//
            case 'Salary':
                //dd($data);
                $this->db->select('emp.First_name,emp.Middle_name,pro.AppointmentDate,des.job_Title,des.des_type,des.basic_Salary
                ,dept.Dept_name,comp.com_name');
                $this->db->from(EMP_TBL.' emp');
                $this->db->join(EMP_PROFILE.' pro','emp.Emp_id=pro.Emp_id');
                $this->db->join(DESG_TBL.' des','des.Des_code=pro.Des_code');
                $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
                $this->db->join(COMPANY.' comp','comp.comp_id=dept.comp_id');
                $this->db->where('emp.status','1');
                $this->db->order_by('emp.First_name,emp.Middle_name');
                if(!empty($data['Dept_id'])){$this->db->like('dept.Dept_id',$data['Dept_id']);}
                if(!empty($data['comp_id'])){$this->db->like('comp.comp_id',$data['comp_id']);}
                if(!empty($data['basic_Salary'])){$this->db->like('des.basic_Salary',$data['basic_Salary']);}
                if(!empty($data['des_type'])){$this->db->like('des.des_type',$data['des_type']);}
                $query = $this->db->get();
            break;
            //****************************************Attendance***********************************************//
            case 'Attendance':
           // dd($data);
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
                $this->db->select('emp.First_name,emp.Middle_name,att.att_date,att.In_Time,
                att.Out_time,att.duration,dept.Dept_name,com.com_name');
                $this->db->from(ATTENDENCE.' att');
                $this->db->join(EMP_TBL.' emp','emp.Emp_id=att.Emp_id');
                $this->db->join(EMP_PROFILE.' pro','pro.Emp_id=emp.Emp_id');
                $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
                $this->db->join(COMPANY.' com','com.comp_id=dept.comp_id');
                $this->db->where('emp.status','1');
                $this->db->order_by('emp.First_name,emp.Middle_name');
                if(!empty($data['Emp_id'])){$this->db->like('emp.Emp_id',$data['Emp_id']);}
                if(!empty($data['Dept_id'])){$this->db->like('dept.Dept_id',$data['Dept_id']);}
                if(!empty($data['comp_id'])){$this->db->like('com.comp_id',$data['comp_id']);}
                if(!empty($data['year'])){$this->db->where('year(att.att_date)',$data['year']);}
                if(!empty($data['from'])){$this->db->where("att.att_date BETWEEN '$from' AND '$to'");}
                if(!empty($data['month'])){$this->db->where('month(att.att_date)',$data['month']);}
                $query = $this->db->get();
                
            break;
            //*************************************************Fuel*********************************************//
            case 'Fuel':
            //dd($data);
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
            
            $this->db->select('emp.First_name,emp.Middle_name,gt.Vehicle_no,gt.Date,fl.consumtion_ltr,dept.Dept_name,com.com_name,veh.usage_type');
            $this->db->from(EMP_TBL.' emp');
            $this->db->join(EMP_PROFILE.' pro','pro.Emp_id=emp.Emp_id');
            $this->db->join(GATE_PASS.' gt','gt.Emp_id = emp.Emp_id');
            $this->db->join(FUEL_CONSUMP.' fl','fl.gate_pass_id = gt.gate_pass_id');
            $this->db->join(VEHICLE_TBL.' veh','veh.Vehicle_no = gt.Vehicle_no');
            $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
            $this->db->join(COMPANY.' com','com.comp_id=dept.comp_id');
            $this->db->where('emp.status','1');
            $this->db->order_by('emp.First_name,emp.Middle_name');
            if(!empty($data['Emp_id'])){$this->db->like('emp.Emp_id',$data['Emp_id']);}
            if(!empty($data['year'])){$this->db->where('year(gt.Date)',$data['year']);}
            if(!empty($data['from'])){$this->db->where("gt.Date BETWEEN '$from' AND '$to'");}
            if(!empty($data['month'])){$this->db->where('month(gt.Date)',$data['month']);}
            if(!empty($data['Dept_id'])){$this->db->like('dept.Dept_id',$data['Dept_id']);}
            if(!empty($data['comp_id'])){$this->db->like('com.comp_id',$data['comp_id']);}
            if(!empty($data['usage_type'])){$this->db->like('veh.usage_type',$data['usage_type']);}
            if(!empty($data['Vehicle_no'])){$this->db->like('veh.Vehicle_no',$data['Vehicle_no']);}
            $query = $this->db->get();          
            
            break;
            //*********************************************Employee********************************************//
            case 'Employee':
            //dd($data);
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
                switch($data['status']){
                    case 'R':
                        $status = '0';
                    break;
                    case 'W':
                        $status = '1';
                    break;
                }
                $this->db->select('emp.First_name,emp.Middle_name,pro.AppointmentDate,emp.NIC,emp.DOB,emp.Emp_mail,des.job_Title,com.com_name,dept.Dept_name');
                $this->db->from(EMP_TBL.' emp');
                $this->db->join(EMP_PROFILE.' pro','pro.Emp_id=emp.Emp_id');
                $this->db->join(DESG_TBL.' des','des.Des_code = pro.Des_code');
                $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
                $this->db->join(COMPANY.' com','com.comp_id = dept.comp_id');
                $this->db->order_by('emp.First_name,emp.Middle_name');
                if(!empty($data['status'])){$this->db->like('emp.status',$status);}
                if(!empty($data['Dept_id'])){$this->db->like('pro.Dept_id',$data['Dept_id']);}
                if(!empty($data['comp_id'])){$this->db->like('com.comp_id',$data['comp_id']);}
                if(!empty($data['year'])){$this->db->where('year(pro.AppointmentDate)',$data['year']);}
                if(!empty($data['from'])){$this->db->where("pro.AppointmentDate BETWEEN '$from' AND '$to'");}
                if(!empty($data['month'])){$this->db->where('month(pro.AppointmentDate)',$data['month']);}
                $query = $this->db->get();  
            break;
            
		}
        
        $this->load->helper('csv');
        echo query_to_csv($query,TRUE,'Report.csv');
        
    }//end of csv report
    
  
	function create_pdf($data)
	{
		$this->load->helper('pdf_helper.php');
		
		switch($data['report_type']){
		   //*******************************leave **********************************************************//
			case 'Leave':
			ob_start();
            ?>
            <html>
            <head>
           <style>
            body{padding: 10px;}
            #hdr{background-color: silver;}
             tr{height: 5px;}
             th{width: 12% ;}
             th,td
            {
            padding-top:20px;
            padding-bottom:20px;
            
            }
            </style>
            </head>
            <body>
            <h1><u>Leave Report</u></h1>
            <?php
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test1 = $data['to'];
			$to = date('Y-m-d',strtotime($test1));
            //echo $to; die();
			
			$this->db->select('lv.lv_app_no,lv.From,lv.to,lv.applied_on,lvty.Leave_type,emp.First_name,emp.Middle_name,dept.Dept_name,com.com_name'); 
			$this->db->from(LEAVE_TBL.' lv');
			$this->db->join(EMP_TBL.' emp','emp.Emp_id=lv.Emp_id');
            $this->db->join(EMP_PROFILE.' pro','pro.Emp_id = emp.Emp_id');
            $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
            $this->db->join(COMPANY.' com','com.comp_id = dept.comp_id');
			$this->db->join(LEAVE_TYPE.' lvty','lvty.leave_type_code = lv.leave_type_code');
            $this->db->where('emp.status','1');
            $this->db->order_by('lv.applied_on','DESC');
            if(!empty($data['month'])){$this->db->where('month(lv.applied_on)',$data['month']);}
            if(!empty($data['year'])){ $this->db->where('year(lv.applied_on)',$data['year']);}
			if(!empty($data['leave_type_code'])){$this->db->like('lv.leave_type_code',$data['leave_type_code']);}
			if(!empty($data['Emp_id'])){$this->db->like('lv.Emp_id',$data['Emp_id']);}
			if(!empty($data['from'])){$this->db->where("lv.applied_on BETWEEN '$from' AND '$to'");}
			if(!empty($data['app_status'])){$this->db->like('lv.app_status',$data['app_status']);}
            if(!empty($data['Dept_id'])) {$this->db->like('dept.Dept_id',$data['Dept_id']);}
            if(!empty($data['comp_id'])){$this->db->like('dept.comp_id',$data['comp_id']);}
			$query = $this->db->get()->result_array();
            ?>
            <table cellspacing="0" cellpadding="10px" border="1">
            <tr id="hdr" >
            <th>App No</th>
            <th>From</th>
            <th>To</th>
            <th>Leave Apply Date</th>
            <th>Leave Type</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Company</th>
            </tr>
            <?php foreach($query as $row){ ?>
            <tr>
            <td><?php echo $row['lv_app_no']; ?></td>
            <td><?php echo $row['From']; ?></td>
            <td><?php echo $row['to']; ?></td>
            <td><?php echo $row['applied_on']; ?></td>
            <td><?php echo $row['Leave_type']; ?></td>
            <td><?php echo $row['First_name'].' '.$row['Middle_name']; ?></td>
            <td><?php echo $row['Dept_name']; ?></td>
            <td><?php echo $row['com_name']; ?></td>
            
            </tr>
            <?php } ?>
            </table>
            </body>
            </html>
            <?php
            $content = ob_get_contents();
            ob_end_clean();
			
			break;
             //*******************************progress **********************************************************//
            case 'Progress':
            ?>
            <html>
            <head>
           <style>
            body{padding: 10px;}
            #hdr{background-color: silver;}
             tr{height: 5px;}
             th,td
            {
            padding-top:20px;
            padding-bottom:20px;
            
            }
            </style>
            </head>
            <body>
            <h1><u>Progress Report</u></h1>
            <?php
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
            if(!empty($data['com_status'])){
                switch($data['com_status']){
                    case '':
                        $com_status = '';
                    break;
                    case 'A':
                        $com_status = '0';
                    break;
                    case '1':
                        $com_status = '1';
                    break;
                    case '9':
                        $com_status = '9';
                    break;
                }
            }
            
            $this->db->select('tsk.task_name,tsk.From,tsk.To,emp.status,emp.approved,emp.feedback_date,em.First_name,em.Middle_name,com.com_name,dept.Dept_name');
    		$this->db->from(TASK_TBL.' tsk');
    		$this->db->join(EMP_HS_TASK.' emp','emp.task_id=tsk.task_id');
    		$this->db->join(EMP_TBL.' em','em.Emp_id=emp.Emp_id');
            $this->db->join(EMP_PROFILE.' pro','pro.Emp_id = emp.Emp_id');
            $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
            $this->db->join(COMPANY.' com','com.comp_id = dept.comp_id');
            $this->db->where('em.status','1');
            $this->db->order_by('emp.feedback_date','DESC');
    		if(!empty($data['Emp_id'])){$this->db->like('emp.Emp_id',$data['Emp_id']);}
            if(!empty($data['task_id'])){$this->db->like('tsk.task_id',$data['task_id']);}
            if(!empty($data['from'])){$this->db->where("emp.feedback_date BETWEEN '$from' AND '$to'");}
    		if(!empty($data['month'])){$this->db->where('month(emp.feedback_date)',$data['month']);}
            if(!empty($data['year'])){ $this->db->where('year(emp.feedback_date)',$data['year']);}
            if(!empty($data['app_status'])){$this->db->like('emp.approved',$data['app_status']);}
            if(!empty($data['Dept_id'])) {$this->db->like('dept.Dept_id',$data['Dept_id']);}
            if(!empty($data['comp_id'])){$this->db->like('dept.comp_id',$data['comp_id']);}
            if(!empty($data['com_status'])){$this->db->like('emp.status',$com_status);}
    		$query = $this->db->get()->result_array();
            ?>
            <table cellspacing="0" cellpadding="10px" border="1">
            <tr id="hdr" >
            <th>Task</th>
            <th>Initiated</th>
            <th>Expired</th>
            <th>Staus</th>
           
            <th>Feedback Date</th>
            <th>Employee</th>
            <th>Department</th>
            <th>Company</th>
            </tr>
            <?php foreach($query as $row){ ?> 
            <tr>
            <td><?php echo $row['task_name']; ?></td>
            <td><?php echo $row['From']; ?></td>
            <td><?php echo $row['To']; ?></td>
            <td><?php if($row['status'] == '1'){echo 'Completed';} else if($row['status'] == '0'){echo 'Incomplete';}
            else if($row['status'] == '9'){echo 'Half Completed';}?></td>
            
            <td><?php echo $row['feedback_date']; ?></td>
            <td><?php echo $row['First_name'].' '.$row['Middle_name']; ?></td>
            <td><?php echo $row['Dept_name']; ?></td>
            <td><?php echo $row['com_name']; ?></td>
            </tr>
            <?php } ?> 
            </table>          
            <?php
            $content = ob_get_contents();
            ob_end_clean();
            break;
            //******************************************* Salary *************************************************//
            case 'Salary':
            ?>
            <html>
            <head>
           <style>
            body{padding: 10px;}
            #hdr{background-color: silver;}
             tr{height: 5px;}
             th,td
            {
            padding-top:20px;
            padding-bottom:20px;
            
            }
            </style>
            </head>
            <body>
            <h1><u>Salary Details Report</u></h1>
            <?php
            $this->db->select('emp.First_name,emp.Middle_name,pro.AppointmentDate,des.job_Title,des.des_type,des.basic_Salary
                ,dept.Dept_name,comp.com_name');
                $this->db->from(EMP_TBL.' emp');
                $this->db->join(EMP_PROFILE.' pro','emp.Emp_id=pro.Emp_id');
                $this->db->join(DESG_TBL.' des','des.Des_code=pro.Des_code');
                $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
                $this->db->join(COMPANY.' comp','comp.comp_id=dept.comp_id');
                $this->db->where('emp.status','1');
                $this->db->order_by('emp.First_name,emp.Middle_name');
                if(!empty($data['Dept_id'])){$this->db->like('dept.Dept_id',$data['Dept_id']);}
                if(!empty($data['comp_id'])){$this->db->like('comp.comp_id',$data['comp_id']);}
                if(!empty($data['basic_Salary'])){$this->db->like('des.basic_Salary',$data['basic_Salary']);}
                if(!empty($data['des_type'])){$this->db->like('des.des_type',$data['des_type']);}
                $query = $this->db->get()->result_array();
            ?>
            <table cellspacing="0" cellpadding="10px" border="1">
            <tr id="hdr" >
            <th>Employee Name</th>
            <th>Appointment Date</th>
            <th>Designation</th>
            <th>Type</th>
            <th>Basic Salary</th>
            <th>Department</th>
            <th>Company</th>
            </tr>
            <?php foreach($query as $row){ ?>
                <tr>
                <td><?php echo $row['First_name'].' '.$row['First_name']; ?></td>
                <td><?php echo $row['AppointmentDate']; ?></td>
                <td><?php echo $row['job_Title']; ?></td>
                <td><?php if($row['des_type'] == 'P'){echo 'Permanent';}else {echo 'Trainee';} ?></td>
                <td><?php echo 'Rs '.$row['basic_Salary']; ?></td>
                <td><?php echo $row['Dept_name']; ?></td>
                <td><?php echo $row['com_name']; ?></td>
                </tr>
            <?php } ?>
            </table>
            </body>
            </html>
            <?php
            $content = ob_get_contents();
            ob_end_clean();
            break;
            //**************************************Attendance************************************************//
            case 'Attendance':
            ?>
            <html>
            <head>
           <style>
            body{padding: 10px;}
            #hdr{background-color: silver;}
             tr{height: 5px;}
             th,td
            {
            padding-top:20px;
            padding-bottom:20px;
            
            }
            </style>
            </head>
            <body>
            <h1><u>Attendance Report</u></h1>
            <?php
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
                $this->db->select('emp.First_name,emp.Middle_name,att.att_date,att.In_Time,
                att.Out_time,att.duration,dept.Dept_name,com.com_name');
                $this->db->from(ATTENDENCE.' att');
                $this->db->join(EMP_TBL.' emp','emp.Emp_id=att.Emp_id');
                $this->db->join(EMP_PROFILE.' pro','pro.Emp_id=emp.Emp_id');
                $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
                $this->db->join(COMPANY.' com','com.comp_id=dept.comp_id');
                $this->db->where('emp.status','1');
                $this->db->order_by('emp.First_name,emp.Middle_name');
                if(!empty($data['Emp_id'])){$this->db->like('emp.Emp_id',$data['Emp_id']);}
                if(!empty($data['Dept_id'])){$this->db->like('dept.Dept_id',$data['Dept_id']);}
                if(!empty($data['comp_id'])){$this->db->like('com.comp_id',$data['comp_id']);}
                if(!empty($data['year'])){$this->db->where('year(att.att_date)',$data['year']);}
                if(!empty($data['from'])){$this->db->where("att.att_date BETWEEN '$from' AND '$to'");}
                if(!empty($data['month'])){$this->db->where('month(att.att_date)',$data['month']);}
                $query = $this->db->get()->result_array();
        ?>
        <table cellspacing="0" cellpadding="10px" border="1">
        <tr id="hdr">
            <th>Employee Name</th>
            <th>Date</th>
            <th>In Time</th>
            <th>Out Time</th>
            <th>Duration</th>
            <th>Department</th>
            <th>Company</th>
        </tr>
        <?php foreach($query as $row){ ?>
        <tr>
            <td><?php echo $row['First_name'].' '.$row['Middle_name'];  ?></td>
            <td><?php echo $row['att_date']; ?></td>
            <td><?php echo $row['In_Time']; ?></td>
            <td><?php echo $row['Out_time']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td><?php echo $row['Dept_name']; ?></td>
            <td><?php echo $row['com_name']; ?></td>
        </tr>
        <?php } ?>
        </table>
        </body>
        </html>
        <?php
            $content = ob_get_contents();
            ob_end_clean();
            break;
        //***************************************************Fuel****************************************//
        case 'Fuel':
            ?>
            <html>
            <head>
           <style>
            body{padding: 10px;}
            #hdr{background-color: silver;}
             tr{height: 5px;}
             th,td
            {
            padding-top:20px;
            padding-bottom:20px;
            
            }
            </style>
            </head>
            <body>
            <h1><u>Fuel Consumption Report</u></h1>
            <?php
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
            
            $this->db->select('emp.First_name,emp.Middle_name,gt.Vehicle_no,gt.Date,fl.consumtion_ltr,dept.Dept_name,com.com_name,veh.usage_type');
            $this->db->from(EMP_TBL.' emp');
            $this->db->join(EMP_PROFILE.' pro','pro.Emp_id=emp.Emp_id');
            $this->db->join(GATE_PASS.' gt','gt.Emp_id = emp.Emp_id');
            $this->db->join(FUEL_CONSUMP.' fl','fl.gate_pass_id = gt.gate_pass_id');
            $this->db->join(VEHICLE_TBL.' veh','veh.Vehicle_no = gt.Vehicle_no');
            $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
            $this->db->join(COMPANY.' com','com.comp_id=dept.comp_id');
            $this->db->where('emp.status','1');
            $this->db->order_by('emp.First_name,emp.Middle_name');
            if(!empty($data['Emp_id'])){$this->db->like('emp.Emp_id',$data['Emp_id']);}
            if(!empty($data['year'])){$this->db->where('year(gt.Date)',$data['year']);}
            if(!empty($data['from'])){$this->db->where("gt.Date BETWEEN '$from' AND '$to'");}
            if(!empty($data['month'])){$this->db->where('month(gt.Date)',$data['month']);}
            if(!empty($data['Dept_id'])){$this->db->like('dept.Dept_id',$data['Dept_id']);}
            if(!empty($data['comp_id'])){$this->db->like('com.comp_id',$data['comp_id']);}
            if(!empty($data['usage_type'])){$this->db->like('veh.usage_type',$data['usage_type']);}
            if(!empty($data['Vehicle_no'])){$this->db->like('veh.Vehicle_no',$data['Vehicle_no']);}
            $query = $this->db->get()->result_array();
            ?>
            <table cellspacing="0" cellpadding="10px" border="1">
            <tr id="hdr">
                <th>Employee Name</th>
                <th>Vehicle No</th>
                <th>Date</th>
                <th>Fuel Consumption</th>
                <th>Vehicle Type</th>
                <th>Department</th>
                <th>Company</th>
            </tr>
            <?php foreach($query as $row){ ?>
            <tr>
                <td><?php echo $row['First_name'].' '.$row['Middle_name']; ?></td>
                <td><?php echo $row['Vehicle_no']; ?></td>
                <td><?php echo $row['Date']; ?></td>
                <td><?php echo $row['consumtion_ltr'].' ltr'; ?></td>
                <td><?php if($row['usage_type'] == 'P'){echo 'Personal';}else{echo 'Company';} ?></td>
                <td><?php echo $row['Dept_name']; ?></td>
                <td><?php echo $row['com_name']; ?></td>
            </tr>
            
            <?php } ?>
            </table>
            </body>
            </html>
            <?php
            $content = ob_get_contents();
            ob_end_clean();
        break;
        //******************************************** Employee **********************************************//
        case 'Employee':
        ?>
            <html>
            <head>
           <style>
            body{padding: 10px;}
            #hdr{background-color: silver;}
             tr{height: 5px;}
             th,td
            {
            padding-top:20px;
            padding-bottom:20px;
            
            }
            </style>
            </head>
            <body>
            <h1><u>Employee Details Report</u></h1>
            <?php
            $test1 = $data['from'];
			$from = date('Y-m-d',strtotime($test1));
            $test2 = $data['to'];
			$to = date('Y-m-d',strtotime($test2));
                switch($data['status']){
                    case 'R':
                        $status = '0';
                    break;
                    case 'W':
                        $status = '1';
                    break;
                }
                $this->db->select('emp.First_name,emp.Middle_name,pro.AppointmentDate,emp.NIC,emp.DOB,emp.Emp_mail,des.job_Title,com.com_name,dept.Dept_name');
                $this->db->from(EMP_TBL.' emp');
                $this->db->join(EMP_PROFILE.' pro','pro.Emp_id=emp.Emp_id');
                $this->db->join(DESG_TBL.' des','des.Des_code = pro.Des_code');
                $this->db->join(DEPT_TBL.' dept','dept.Dept_id=pro.Dept_id');
                $this->db->join(COMPANY.' com','com.comp_id = dept.comp_id');
                $this->db->order_by('emp.First_name,emp.Middle_name');
                if(!empty($data['status'])){$this->db->like('emp.status',$status);}
                if(!empty($data['Dept_id'])){$this->db->like('pro.Dept_id',$data['Dept_id']);}
                if(!empty($data['comp_id'])){$this->db->like('com.comp_id',$data['comp_id']);}
                if(!empty($data['year'])){$this->db->where('year(pro.AppointmentDate)',$data['year']);}
                if(!empty($data['from'])){$this->db->where("pro.AppointmentDate BETWEEN '$from' AND '$to'");}
                if(!empty($data['month'])){$this->db->where('month(pro.AppointmentDate)',$data['month']);}
                $query = $this->db->get()->result_array();
   ?>
        <table cellspacing="0" cellpadding="10px" border="1">
            <tr id="hdr">
                <th>Employee Name</th>
                <th>Appointment Date</th>
                <th>NIC</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Designation</th>
                
            </tr>
            <?php foreach($query as $row){ ?>
            <tr>
                <td><?php echo $row['First_name'].' '.$row['Middle_name']; ?></td>
                <td><?php echo $row['AppointmentDate']; ?></td>
                <td><?php echo $row['NIC']; ?></td>
                <td><?php echo $row['DOB']; ?></td>
                <td><?php echo $row['Emp_mail']; ?></td>
                <td><?php echo $row['job_Title']; ?></td>
                
            </tr>
            <?php } ?>
            </table>
            </body>
            </html>
   <?php
            
        $content = ob_get_contents();
            ob_end_clean();
        break;
		}
    	
    	//$content = ob_get_clean();
	
		
		try
        {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
//      $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('report.pdf');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }   

	}//end of create_pdf
	
	function report()
	{
		
		if($this->input->post('export') == 'X'){
			$this->create_csv($this->input->post());
		}
		else if($this->input->post('export') == 'P'){
			$this->create_pdf($this->input->post());
		}else{
		  switch($this->input->post('report_type')){
		      case 'Leave':
              $this->session->set_flashdata('msg','Please select type of Export');
			  redirect('report_ctr/leave_report');
              break;
              case 'Progress':
              $this->session->set_flashdata('msg','Please select type of Export');
			  redirect('report_ctr/progress_report');
              break;
              case 'Salary':
              $this->session->set_flashdata('msg','Please select type of Export');
			  redirect('report_ctr/salary_report');
              break;
              case 'Fuel':
              $this->session->set_flashdata('msg','Please select type of Export');
			  redirect('report_ctr/fuel_consump_report');
              break;
              case 'Employee':
              $this->session->set_flashdata('msg','Please select type of Export');
			  redirect('report_ctr/employee_report');
              break;
              case 'Attendance':
              $this->session->set_flashdata('msg','Please select type of Export');
			  redirect('report_ctr/attendance_report');
              break;
		  }
			
		}
	}
}
?>