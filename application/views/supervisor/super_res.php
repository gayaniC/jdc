  	 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    <?php $tbl_ary= array(
	
				array('table_name'=>TASK_TBL,'field_nmae'=>'supervisor_id','value'=>''),
				array('table_name'=>EMP_MANAGED,'field_nmae'=>'supervisor_id','value'=>'')
							
	);
    
     ?>
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
							<th>Designation</th>
							<th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->supervisor_id;?></td>
                            <td><?php echo $val->title.' '.$val->First_name.' '.$val->Middle_name;?></td>
                            <td><?php echo $val->job_Title; ?></td>
                            <td>
								<?php echo anchor(site_url('performance_ctr/view_super/'.$val->supervisor_id.'/'.$val->level),'<span></span>print','title = "View a supervisor" class ="btn-mini btn-grey btn-print"'); ?>
								<?php echo anchor(site_url('performance_ctr/edit_super/'.$val->supervisor_id.'/'.$val->level),'<span></span>check','title = "Edit a supervisor" class ="btn-mini btn-grey btn-check"'); ?>
                                <?php $tbl_ary[0]['value']= $tbl_ary[1]['value'] = $val->supervisor_id;
								if(!has_transactions($tbl_ary)){
								 ?>
                            	<?php echo anchor(site_url('performance_ctr/delete_super/'.$val->supervisor_id.'/'.$val->level),'<span></span>Delete','title = "Delete a supervisor" class="btn-mini btn-grey btn-cross" '); } ?>
                                <?php echo anchor(site_url('performance_ctr/assign_super/'.$val->supervisor_id.'/'.$val->level),'<span></span>Add user','title = "Assign Employees" class="btn-mini btn-grey btn-person" ');
								
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
