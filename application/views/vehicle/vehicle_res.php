  	 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    <?php $tbl_ary= array(
	
				array('table_name'=>GATE_PASS,'field_nmae'=>'Vehicle_no','value'=>'')
							
	); ?>
    <div class="container_12">
     <div class="grid_10">
            <div class="box round first grid">
            <h5><font color="#1B548D"><u>Search Result</u></font></h5>
            
             <div class="block">
             <!--data table-->
             <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Vehicle No</th>
							<th>Model</th>
							<th>Brand</th>
							<th>Fuel Usage<br />(Liter per kilometre)</th>
                            <th>Purpose of usage</th>
							<th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->Vehicle_no;?></td>
                            <td><?php echo $val->Vehicle_name;?></td>
                            <td><?php echo $val->Brand; ?></td>
                            <td><?php echo $val->ltr_per_km;?></td>
                            <td><?php if($val->usage_type == 'C'){echo 'Company use';}else{echo 'Personal use';} ?></td>
                            <td>
								<?php echo anchor(site_url('fuel_ctr/view_veh/'.$val->Vehicle_no),'<span></span>print','title = "View a Vehicle Details" class ="btn-mini btn-grey btn-print"'); ?>
                                
								<?php 
                                if($this->session->userdata('user_role_id') == 'ADMIN'){
                                    echo anchor(site_url('fuel_ctr/edit_veh/'.$val->Vehicle_no),'<span></span>check','title = "Edit a Vehicle Details" class ="btn-mini btn-grey btn-check"');
                                $tbl_ary[0]['value'] = $val->Vehicle_no;
								if(!has_transactions($tbl_ary)){
								 
                            	 echo anchor(site_url('fuel_ctr/delete_veh/'.$val->Vehicle_no),'<span></span>Delete','title = "Delete a Vehicle Details" class="btn-mini btn-grey btn-cross" '); }
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
