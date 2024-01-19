<?php // dd($records); ?>
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
             <!--data table-->
             <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Log ID</th>
							<th>Event Name</th>
							<th>Date</th>
							<th>Actions Taken</th>
							<th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->hr_id;?></td>
                            <td><?php echo $val->event_name;?></td>
                            <td><?php echo $val->Date; ?></td>
                            <td><?php echo $val->actions_taken;?></td>
                            <td>
								<?php echo anchor(site_url('staff_ctr/log_view/'.$val->hr_id),'<span></span>print','title = "View a Log" class ="btn-mini btn-grey btn-print"'); ?>
                                
								<?php 
                                
                                echo anchor(site_url('staff_ctr/log_edit/'.$val->hr_id),'<span></span>check','title = "Edit a Log" class ="btn-mini btn-grey btn-check"');
                                
                            	 echo anchor(site_url('staff_ctr/log_delete/'.$val->hr_id),'<span></span>Delete','title = "Delete a Log" class="btn-mini btn-grey btn-cross" '); 
                               
                                  ?>
                               
                            </td>
                        </tr>
                    <?php } ?>
					</tbody>
             </table>
             <!--data table-->
             </div>
             
            </div>
     </div>
    </div>
