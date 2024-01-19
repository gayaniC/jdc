<?php //echo '<pre>'; print_r($records); echo '</pre>';?>
<script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    <?php //echo '<pre>'; print_r($records); echo '</pre>'; die(); ?>
    <div class="container_12">
     <div class="grid_10">
            <div class="box round first grid">
            <h5><font color="#1B548D"><u>Search Result</u></font></h5>
            
             <div class="block">
             <!--data table-->
             <table class="data display datatable" id="example">
					<thead>
						<tr>
                        	<th>Employee Name</th>
							<th>User Role</th>
							<th>Username</th>
                            <th>NIC</th>
                            <th>Email</th>
                            <th>Status</th>
							<th>Options</th>
						</tr>
					</thead>
                    
                    <tbody>
                    <?php
					foreach($records as $val){
					  
					?>
                   <tr class="even gradeX">
                   		
                    	<td><?php echo $val['title'].' '.$val['First_name'].' '.$val['Middle_name']; ?></td>
                        <td><?php echo $val['user_role']; ?></td>
                        <td><?php echo $val['username']; ?></td>
                        <td><?php echo $val['NIC']; ?></td>
                        <td><?php echo $val['Emp_mail']; ?></td>
                        <td><?php if($val['status'] == '1'){echo 'Active';}else{echo 'Inactive';} ?></td>
                        <td>
                        <?php //echo anchor(site_url('user_ctr/change')) ?>
                        <?php echo anchor(site_url('user_ctr/view/'.$val['id']),'<span></span>print','title = "View an Employee" class ="btn-mini btn-grey btn-print"') ?>
                        <?php echo anchor(site_url('user_ctr/edit/'.$val['id']),'<span></span>check','title = "Edit an Employee" class ="btn-mini btn-grey btn-check"'); ?>
                        <?php echo anchor(site_url('user_ctr/delete/'.$val['id']),'<span></span>Delete','title = "Delete an Employee" class="btn-mini btn-grey btn-cross" '); ?>
                         
                         
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
