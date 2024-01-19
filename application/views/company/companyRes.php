  	 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    <?php $tbl_ary= array(
	
				array('table_name'=>DEPT_TBL,'field_nmae'=>'comp_id','value'=>'')
							
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
							<th>Company ID</th>
							<th>Company Name</th>
							<th>Company Address</th>
							<th>Contact No</th>
							<th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->comp_id;?></td>
                            <td><?php echo $val->com_name;?></td>
                            <td><?php $address = $val->com_postal_code.' '.$val->com_contact_Address_line1.' '.$val->com_contact_Address_line2; echo $address;?></td>
                            <td><?php echo $val->com_contact_no;?></td>
                            <td>
								<?php echo anchor(site_url('company_ctr/view/'.$val->comp_id),'<span></span>print','title = "View a company" class ="btn-mini btn-grey btn-print"'); ?>
                                
								<?php 
                                if($this->session->userdata('user_role_id') == 'ADMIN'){
                                    echo anchor(site_url('company_ctr/edit/'.$val->comp_id),'<span></span>check','title = "Edit a company" class ="btn-mini btn-grey btn-check"');
                                $tbl_ary[0]['value'] = $val->comp_id;
								if(!has_transactions($tbl_ary)){
								 
                            	 echo anchor(site_url('company_ctr/delete/'.$val->comp_id),'<span></span>Delete','title = "Delete a company" class="btn-mini btn-grey btn-cross" '); }
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
