  	 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    <?php $tbl_ary= array(
	
				array('table_name'=>GATE_PASS,'field_nmae'=>'cus_id','value'=>'')
							
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
							<th>Customer ID</th>
							<th>Name</th>
							<th>Address</th>
							<th>Contact No</th>
                            <th>Options</th>
							
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->cus_id;?></td>
                            <td><?php echo $val->customer_name;?></td>
                            <td><?php echo $val->contactAddress; ?></td>
                            <td><?php echo $val->Contact_no;?></td>
                            
                            <td>
								<?php echo anchor(site_url('fuel_ctr/view_cus/'.$val->cus_id),'<span></span>print','title = "View a Customer Details" class ="btn-mini btn-grey btn-print"'); ?>
                                
								<?php 
                                if($this->session->userdata('user_role_id') == 'ADMIN'){
                                    echo anchor(site_url('fuel_ctr/edit_cus/'.$val->cus_id),'<span></span>check','title = "Edit a Customer Details" class ="btn-mini btn-grey btn-check"');
                                $tbl_ary[0]['value'] = $val->cus_id;
								if(!has_transactions($tbl_ary)){
								 
                            	 echo anchor(site_url('fuel_ctr/delete_cus/'.$val->cus_id),'<span></span>Delete','title = "Delete a Customer Details" class="btn-mini btn-grey btn-cross" '); }
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
