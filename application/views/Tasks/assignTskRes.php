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
							<th>Supervisor ID</th>
							<th>Supervisor Name</th>
							<th>Task</th>
							<th>From</th>
                            <th>To</th>
                            <th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->supervisor_id; ?></td>
                            <td><?php echo $val->title.' '.$val->First_name.' '.$val->surname; ?></td>
                            <td><?php if($val->task_name != ''){echo $val->task_name;}else{echo '---';} ?></td>
                            <td><?php if($val->From != ''){echo $val->From;}else{echo '0000-00-00';} ?></td>
                            <td><?php if($val->To != '') {echo $val->To;}else{echo '0000-00-00';} ?></td>
                            <td><?php if($val->task_id != ''){echo anchor(site_url('performance_ctr/view_task/'.$val->task_id.'/'.$val->supervisor_id),'<span></span>print','title = "View an Assign Task" class ="btn-mini btn-grey btn-print"'); ?>
								<?php echo anchor(site_url('performance_ctr/edit_task/'.$val->task_id.'/'.$val->supervisor_id),'<span></span>check','title = "Edit an Assign Task" class ="btn-mini btn-grey btn-check"');
                            	}?>
                                <?php echo anchor(site_url('performance_ctr/add_task/'.$val->supervisor_id),'<span></span>Add user','title = "Assign Tasks" class="btn-mini btn-grey btn-cart" ');
								
                                ?></td>
                        </tr>
                    <?php } ?>
					</tbody>
             </table>
             <!--data table-->
             </div>
             
            </div>
     </div>
    </div>
