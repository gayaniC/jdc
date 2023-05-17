
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
							<th>Leave Application No</th>
                            <th>Leave Type</th>
							<th>From</th>
							<th>To</th>
							<th>Duration</th>
                            <th>Approval Status</th>
                            <th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){ ?>
                    <tr>
                    <td><?php echo $val->lv_app_no; ?></td>
                    <td><?php echo $val->Leave_type; ?></td>
                    <td><?php echo $val->From; ?></td>
                    <td><?php echo $val->to; ?></td>
                    <td><?php echo $val->no_of_days; ?></td>
                    <td><?php if($val->app_status == 'P'){echo 'Pending'; }if($val->app_status == 'A'){echo 'Approved';} else if($val->app_status == 'R'){echo 'Rejected';} ?></td>
                    
                    <td><?php 
                    echo anchor(site_url('leave_ctr/view_lv_app/'.$val->lv_app_no),'<span></span>print','title = "View a Leave Application" class ="btn-mini btn-grey btn-print"');
                    if($val->app_status == 'P'){
                       echo anchor(site_url('leave_ctr/edit_lv_app/'.$val->lv_app_no),'<span></span>Edit','title = "Edit a Leave Application" class="btn-mini btn-grey btn-check" ');
					   echo anchor(site_url('leave_ctr/delete_lv_app/'.$val->lv_app_no),'<span></span>Delete','title = "Delete a Leave Application" class="btn-mini btn-grey btn-cross" '); 
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