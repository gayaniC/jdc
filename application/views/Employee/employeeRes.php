<?php //echo '<pre>'; print_r($records); echo '</pre>';?>
<script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
     <?php $tbl_ary= array(
	
				array('table_name'=>ATTENDENCE,'field_nmae'=>'Emp_id','value'=>''),
				array('table_name'=>EMP_HS_TASK,'field_nmae'=>'Emp_id','value'=>''),
				array('table_name'=>LEAVE_TBL,'field_nmae'=>'Emp_id','value'=>''),
				array('table_name'=>LV_ALLO_TBL,'field_nmae'=>'Emp_id','value'=>''),
				array('table_name'=>EMP_MANAGED,'field_nmae'=>'Emp_id','value'=>''),
				array('table_name'=>SUPER_TBL,'field_nmae'=>'Emp_id','value'=>''),
				array('table_name'=>EMP_VEHICLE,'field_nmae'=>'Emp_id','value'=>''),
				array('table_name'=>GATE_PASS,'field_nmae'=>'Emp_id','value'=>'')
							
	); ?>
    <div class="container_12">
     <div class="grid_10">
            <div class="box round first grid">
            <h5><font color="#1B548D"><u>Search Result</u></font></h5>
            
             <div class="block">
             <!--data table-->
             <table class="data display datatable" id="example">
					<thead>
						<tr>
                        	<th>Employee ID</th>
							<th>Employee Name</th>
							<th>Designation</th>
							<th>Department</th>
							<th>Contact No</th>
                            <th>NIC</th>
                            <th>Email</th>
							<th>Options</th>
						</tr>
					</thead>
                    
                    <tbody>
                    <?php
					foreach($records as $val){
					  
					?>
                   <tr class="even gradeX">
                   		<td><?php echo $val['Emp_id']; ?></td>
                    	<td><?php echo $val['title'].' '.$val['First_name'].' '.$val['Middle_name']; ?></td>
                        <td><?php echo $val['job_Title']; ?></td>
                        <td><?php echo $val['Dept_name']; ?></td>
                        <td><?php echo $val['Contact_no'] ?></td>
                        <td><?php echo $val['NIC']; ?></td>
                        <td><?php echo $val['Emp_mail']; ?></td>
                        <td><?php echo anchor(site_url('employee_ctr/view/'.$val['Emp_id']),'<span></span>print','title = "View an Employee" class ="btn-mini btn-grey btn-print"') ?>
                        <?php echo anchor(site_url('employee_ctr/edit/'.$val['Emp_id']),'<span></span>check','title = "Edit an Employee" class ="btn-mini btn-grey btn-check"'); ?>
                        <?php
						$tbl_ary[0]['value']=$tbl_ary[1]['value']=$tbl_ary[2]['value']=$tbl_ary[3]['value']=$tbl_ary[4]['value']=$tbl_ary[5]['value']=$val['Emp_id'];
						if(!has_transactions($tbl_ary)){
						 echo anchor(site_url('employee_ctr/delete/'.$val['Emp_id']),'<span></span>Delete','title = "Delete an Employee" class="btn-mini btn-grey btn-cross" '); 
						}
						 ?>
                         <?php
                         if($this->session->userdata('user_role_id') == 'HR'){
                            if($val['Resign'] != ''){
                                if($val['Resign'] <= 0){
                                     echo anchor(site_url('employee_ctr/status/'.$val['Emp_id']),'<span></span>Down','title = "Deactivate an Employee" class="btn-mini btn-grey btn-arrow-down" ');
                               }
                            }
                           
                         } 
                         ?>
                         
                        </td>
                    </tr>
                    <?php	
					}
					?>
					</tbody>
             </table>
             <!--data table-->
             </div>
             
            </div>
     </div>
    </div>
