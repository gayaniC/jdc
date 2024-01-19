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
							<th>Vacancy</th>
							<th>Educational Qualification</th>
							<th>Professional Qualification</th>
							<th>Open Date</th>
                            <th>Closing Date</th>
							<th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->vacancy;?></td>
                            <td><?php echo $val->Edu_qualification;?></td>
                            <td><?php echo $val->Prf_qualification; ?></td>
                            <td><?php echo $val->opening_date;?></td>
                            <td><?php echo $val->closing_date; ?></td>
                            <td>
								<?php echo anchor(site_url('talent_ctr/view_job/'.$val->rec_id),'<span></span>print','title = "View a Vacancy" class ="btn-mini btn-grey btn-print"'); ?>
                                
								<?php 
                                if($this->session->userdata('user_role_id') == 'HR'){
                                    echo anchor(site_url('talent_ctr/edit_job/'.$val->rec_id),'<span></span>check','title = "Edit a Vacancy" class ="btn-mini btn-grey btn-check"');
                                		
                            	 echo anchor(site_url('talent_ctr/delete_job/'.$val->rec_id),'<span></span>Delete','title = "Delete a Vacancy" class="btn-mini btn-grey btn-cross" '); 
                                }
                                
                                  ?>
                                  <?php echo mailto('jdc@jdcsl.com','<span></span>Apply now','class="btn-icon btn-grey btn-plus"'); ?>
                               
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
