  	
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
							<th>Leave Type Code</th>
							<th>Leave Type</th>
							<th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){ ?>
                    <tr>
                    	<td><?php echo $val->leave_type_code; ?></td>
                        <td><?php echo $val->Leave_type; ?></td>
                        <td>
								<?php echo anchor(site_url('leave_ctr/view/'.$val->leave_type_code),'<span></span>print','title = "View a Leave Type" class ="btn-mini btn-grey btn-print"') ?>
								<?php echo anchor(site_url('leave_ctr/edit/'.$val->leave_type_code),'<span></span>check','title = "Edit a Leave Type" class ="btn-mini btn-grey btn-check"') ?>
                            	<?php echo anchor(site_url('leave_ctr/delete/'.$val->leave_type_code),'<span></span>Delete','title = "Delete a Leave Type" class="btn-mini btn-grey btn-cross" '); ?>
                               
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
