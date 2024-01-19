
<script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    
     <div class="container_12">
     <div class="grid_10">
            <div class="box round first grid">
            <h5><font color="#1B548D"><u>Search Result</u></font></h5>
            
             <div class="block">
             <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Employee</th>
                            <th>EPF No</th>
							<th>Account No</th>
							<th>Appointment Date</th>
							<th>Resign Date</th>
                            <th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){ ?>
                    <tr>
                    <td><?php echo $val->First_name.' '.$val->Middle_name; ?></td>
                    <td><?php echo $val->EPF_no; ?></td>
                    <td><?php echo $val->Account_No; ?></td>
                    <td><?php echo $val->AppointmentDate; ?></td>
                    <td><?php if($val->resign_date == '0000-00-00'){echo '---';}else{echo $val->resign_date;} ?></td>
                  
                    <td><?php 
                    if($val->resign_date != '0000-00-00'){
                        echo anchor(site_url('talent_ctr/view_resig/'.$val->id),'<span></span>print','title = "View a Resign Status" class ="btn-mini btn-grey btn-print"');
                    }
                    
                    echo anchor(site_url('talent_ctr/edit_resig/'.$val->id),'<span></span>Edit','title = "Edit a Resign Status" class="btn-mini btn-grey btn-check" ');
                    if($this->session->userdata('user_role_id') == 'HR' || $this->session->userdata('user_role_id') == 'ADMIN' ){
                        echo anchor(site_url('talent_ctr/inactive/'.$val->Emp_id),'<span></span>Comment','title = "Inactive Employee" class="btn-mini btn-grey btn-comment" ');
                    }
                    					    
                   
					
                    
					
					?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
             </table>
             </div><!-- block -->
             </div><!-- box round first grid-->
     </div><!-- grid_10 -->
     </div><!-- container_12 -->