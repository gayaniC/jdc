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
							<th>ID</th>
							<th>Employee Name</th>
							<th>Idea</th>
							<th>Feedback</th>
							<th>Approval Status</th>
                            <th>Approval Date</th>
                            <th>Option</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->id;?></td>
                            <td><?php echo $val->First_name.' '.$val->Middle_name;?></td>
                            <td><?php echo $val->idea_inq; ?></td>
                            <td><?php if($val->feedbck_sup != ''){echo $val->feedbck_sup;} else{echo '---';}?></td>
                            <td><?php if($val->app_status == 'N'){echo '---';}
                            if($val->app_status == 'A'){echo 'Approve';}
                            if($val->app_status == 'R') {echo 'Rejected';} ?></td>
                            <td><?php if($val->app_date != ''){echo $val->app_date;} else{echo '---';}?></td>
                            <td>
								<?php echo anchor(site_url('talent_ctr/view_idea/'.$val->id),'<span></span>print','title = "View a Suggeation" class ="btn-mini btn-grey btn-print"'); ?>
                                
								<?php 
                                if($this->session->userdata('user_role_id') == 'NEMP' ||$this->session->userdata('user_role_id') == 'VEMP'||
                    $this->session->userdata('user_role_id') == 'DEO'||$this->session->userdata('user_role_id') == 'DVP'){
                                echo anchor(site_url('talent_ctr/edit_idea/'.$val->id),'<span></span>check','title = "Edit a Suggeation" class ="btn-mini btn-grey btn-check"');
                                }
                                if($this->session->userdata('user_role_id') == 'ADMIN'){
                            	 echo anchor(site_url('talent_ctr/delete_idea/'.$val->id),'<span></span>Delete','title = "Delete a Suggeation" class="btn-mini btn-grey btn-cross" '); 
                               }
                               if($val->app_status == 'N'){
                               if($this->session->userdata('user_role_id') == 'ADMIN'||$this->session->userdata('user_role_id') == 'HR'||$this->session->userdata('user_role_id') == 'MGER'
                               ||$this->session->userdata('user_role_id') == 'DVP'){
                               echo anchor(site_url('talent_ctr/approve_idea/'.$val->id),'<span></span>Comment','title="Give Approval" class="btn-mini btn-grey btn-comment"');
                               }
                               }
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
