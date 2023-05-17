  	 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    <?php //echo '<pre>'; print_r($records); echo '</pre>'; ?>
   
    <div class="container_12">
     <div class="grid_10">
            <div class="box round first grid">
            <h5><font color="#1B548D"><u>Search Result</u></font></h5>
            
             <div class="block">
             <?php if(!empty($records)){ ?>
             <!--data table-->
             <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Task</th>
							<th>Task Expired Date</th>
							<th>Satus of Completion</th>
                            <th>Feedback Date</th>
							<th>Comments by Employee</th>
							<th>Employee for the task</th>
                            <th>Previous Approval Status</th>
                            <th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->task_name; ?></td>
                            <td><?php echo $val->To;?></td>
                            <td><?php if($val->status == 1) {echo 'Completed';} else if($val->status == 9){echo 'Half Completed';}else{ echo 'Incomplete';} ?></td>
                            <td><?php echo $val->feedback_date;?></td>
                            <td><?php if($val->comments != '')echo $val->comments; else{echo '---';} ?></td>
                            <td><?php echo $val->First_name.' '.$val->Middle_name; ?></td>
                            <td><?php if($val->approved == 'A'){ echo 'Approved';}else if($val->approved == 'R'){ echo 'Rejected';}
							else if($val->approved == 'N'){echo 'Not Approved';} ?></td>
                            <td>
                            <?php echo anchor('performance_ctr/approval/'.$val->id.'/App','<span></span>','class="btn-mini btn-grey btn-arrow-up" title="Approve"'); ?>
                            <?php echo anchor('performance_ctr/approval/'.$val->id.'/Rej','<span></span>','class = "btn-mini btn-grey btn-arrow-down" title="Reject"'); ?>
							<?php 
							if($val->expiry < 1){
							 echo anchor(site_url('performance_ctr/edit_task/'.$val->task_id.'/'.$val->supervisor_id),'<span></span>check','title = "Edit an Assign Task" class ="btn-mini btn-grey btn-cart"'); 
								
							}?>
                               
                            </td>
                        </tr>
                    <?php } ?>
					</tbody>
             </table>
             <!--data table-->
             <?php }else{
				echo '<strong>No tasks for approval</strong>'; 
			 }?>
             </div>
             
            </div>
     </div>
    </div>
