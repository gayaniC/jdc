  	<script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
        <?php $tbl_ary= array(
	
				array('table_name'=>EMP_PROFILE,'field_nmae'=>'Dept_id','value'=>'')
				
							
	);
    //echo '<pre>'; print_r($records); echo '</pre>'; 
     ?>
     <table class="data display datatable" id="example">
     <thead>
		<tr>
		<th>Department Code</th>
		<th>Department Name</th>
		<th>Company</th>
        <th>Options</th>
		</tr>
	</thead>
    <tbody>
    
    <?php foreach($records as $val){
        
        ?>
        <tr>
        <td><?php echo $val->Dept_id; ?></td>
        <td><?php echo $val->Dept_name; ?></td>
        <td><?php echo $val->com_name; ?></td>
        <td>
        <?php echo anchor(site_url('department_ctr/view/'.$val->Dept_id),'<span></span>print','title = "View a Department" class ="btn-mini btn-grey btn-print"'); ?>
								<?php 
                                if($this->session->userdata('user_role_id') == 'ADMIN' || $this->session->userdata('user_role_id') == 'HR'){
                                  echo anchor(site_url('department_ctr/edit/'.$val->Dept_id),'<span></span>check','title = "Edit a Department" class ="btn-mini btn-grey btn-check"'); 
                            
								$tbl_ary[0]['value'] = $val->Dept_id;
								if(!has_transactions($tbl_ary)){
								 echo anchor(site_url('department_ctr/delete/'.$val->Dept_id),'<span></span>Delete','title = "Delete a Department" class="btn-mini btn-grey btn-cross" '); }   
                                }
                                ?>
        </td>
        </tr>
        <?php
    } ?>
    
    
    </tbody>
     </table>
	 
  
             </div>
            </div>
     </div>
    </div>
