<?php //dd($records); ?>
 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    <?php $tbl_ary= array(
	
				array('table_name'=>FUEL_CONSUMP,'field_nmae'=>'gate_pass_id','value'=>'')
							
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
							<th>Gate Pass ID</th>
							<th>Vehicle No</th>
							<th>Date</th>
                            <th>Customer</th>
							<th>Time Depature</th>
                            <th>Time Return</th>
                            <th>Distance</th>
                            <th>Options</th>
							
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->gate_pass_id;?></td>
                            <td><?php echo $val->Vehicle_no; ?></td>
                            <td><?php echo $val->Date;?></td>
                            <td><?php echo $val->customer_name; ?></td>
                            <td><?php if($val->departure != ''){echo $val->departure; if($val->departure_unit == 'P'){echo ' pm';}if($val->departure_unit == 'A'){echo ' am';}}
                            else{echo '---';} ?></td>
                            <td><?php if($val->return != ''){echo $val->return; if($val->return_unit == 'P'){echo ' pm';}if($val->return_unit == 'A'){echo ' am';}}else{echo '---';}?></td>
                            <td><?php if($val->distance != ''){echo $val->distance;}else{echo '---';} ?></td>
                            
                            
                            <td>
								<?php echo anchor(site_url('fuel_ctr/view_gatepass/'.$val->gate_pass_id),'<span></span>print','title = "View a Gate Pass Details" class ="btn-mini btn-grey btn-print"'); ?>
                                
								<?php 
                               
                                    echo anchor(site_url('fuel_ctr/edit_gatepass/'.$val->gate_pass_id),'<span></span>check','title = "Edit a Gate Pass Details" class ="btn-mini btn-grey btn-check"');
                                $tbl_ary[0]['value'] = $val->gate_pass_id;
								if(!has_transactions($tbl_ary)){
								 
                            	 echo anchor(site_url('fuel_ctr/delete_gate_pass/'.$val->gate_pass_id),'<span></span>Delete','title = "Delete a Gate Pass Details" class="btn-mini btn-grey btn-cross" '); }
                                
                                
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