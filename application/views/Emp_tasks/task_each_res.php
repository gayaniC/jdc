<?php //echo '<pre>'; print_r($records); echo '</pre>'; ?>

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
             <?php if(!empty($records)) {?>
              <!--data table-->
             <table class="data display datatable" id="example">
					<thead>
						<tr>
                        	<th>Task</th>
							<th>Initiated</th>
							<th>Expired</th>
							<th>Supervised By</th>
                            <th>Completion Status</th>
                            <th>Date(Last Feedback)</th>
							<th>Approval Status</th>
							<th>Options</th>
						</tr>
					</thead>
                    
                    <tbody>
                    <?php foreach($records as $val){ ?>
                    <tr>
                    	<td><?php echo $val->task_name; ?></td>
                        <td><?php echo $val->From; ?></td>
                        <td><?php echo $val->To; ?></td>
                        <td><?php echo $val->title.' '.$val->First_name.' '.$val->Middle_name; ?></td>
                        <td><?php if($val->status == '1'){echo 'Completed';}
						else if($val->status == '0'){echo 'Incompleted';} 
						else if($val->status == '9'){echo 'Half Completed';} else if($val->status == ''){echo '---';} ?></td>
                        <td><?php echo $val->feedback_date; ?></td>
                        <td><?php if($val->approved == 'N'){echo '---';}else if($val->approved == 'A'){echo 'Approved';} else if($val->approved == 'P'){echo 'Pending';} ?></td>
                        <td><?php echo anchor(site_url('performance_ctr/view_mark_progress/'.$val->task_id),'<span></span>print','title = "View a Progress" class ="btn-mini btn-grey btn-print"') ?>
                         <?php if($val->status != '1'){ echo anchor(site_url('performance_ctr/mark_progress/'.$val->task_id),'<span></span>check','title = "Edit a Progress" class ="btn-mini btn-grey btn-check"'); } ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
           </table>
           <?php }else{ echo '<strong>There are no assign tasks for you</strong>';} ?>
             </div><!-- block -->
             </div><!-- box -->
     </div><!-- grid_10 -->
     </div><!-- container_12 -->
