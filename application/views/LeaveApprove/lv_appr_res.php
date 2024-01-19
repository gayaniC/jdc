<?php //echo '<pre>'; print_r($records); echo '</pre>'; die(); ?>
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
                            <th>Reason for Leave</th>
							<th>From</th>
							<th>To</th>
							<th>Duration</th>
                            <th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){ ?>
                    <tr>
                    <td><?php echo $val->First_name.' '.$val->Middle_name; ?></td>
                    <td><?php echo $val->reason_for_leave; ?></td>
                    <td><?php echo $val->From; ?></td>
                    <td><?php echo $val->to; ?></td>
                    <td><?php echo $val->no_of_days; ?></td>
                    <td>
                    <?php echo anchor('leave_ctr/approval/'.$val->lv_app_no.'/App','<span></span>','class="btn-mini btn-grey btn-arrow-up" title="Approve"'); ?>
                    <?php echo anchor('leave_ctr/approval/'.$val->lv_app_no.'/Rej','<span></span>','class = "btn-mini btn-grey btn-arrow-down" title="Reject"'); ?>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
             </table>
             </div><!-- block -->
             </div><!-- box round first grid-->
     </div><!-- grid_10 -->
     </div><!-- container_12 -->