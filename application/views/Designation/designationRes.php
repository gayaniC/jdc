  	 <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
     <?php $tbl_ary= array(
	
				array('table_name'=>EMP_PROFILE,'field_nmae'=>'Des_code','value'=>''),
				array('table_name'=>SUPER_TBL,'field_nmae'=>'Des_code','value'=>'')
							
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
							<th>Designation Code</th>
							<th>Designation</th>
							<th>Desiganation Type</th>
							<th>Basic Salary</th>
							<th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){?>
						<tr class="even gradeX">
                        	<td><?php echo $val->Des_code;?></td>
                            <td><?php echo $val->job_Title;?></td>
                            <td><?php if($val->des_type == 'P'){ echo 'Permanent';}if($val->des_type == 'T'){echo 'Trainee';}?></td>
                            <td><?php echo 'Rs:'.$val->basic_Salary;?></td>
                            <td>
								<?php echo anchor(site_url('talent_ctr/view_desig/'.$val->Des_code),'<span></span>print','title = "View a Designation" class ="btn-mini btn-grey btn-print"') ?>
								<?php echo anchor(site_url('talent_ctr/edit_desig/'.$val->Des_code),'<span></span>check','title = "Edit a Designation" class ="btn-mini btn-grey btn-check"') ?>
                                 <?php $tbl_ary[0]['value'] = $tbl_ary[1]['value'] =  $val->Des_code;
								if(!has_transactions($tbl_ary)){
								 ?>
                            	<?php echo anchor(site_url('talent_ctr/delete_desig/'.$val->Des_code),'<span></span>Delete','title = "Delete a Designation" class="btn-mini btn-grey btn-cross" ');} ?>
                               
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
