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
							<th>Leave Type</th>
							<th>Year</th>
							<th>Allocated Leaves</th>
                            <th>Used Leaves</th>
                            <th>Leave balance</th>
                            <th>Options</th>
						</tr>
					</thead>
                    <tbody>
                    <?php foreach($records as $val){ ?>
                    <tr>
                    <td><?php echo $val->title.' '.$val->First_name.' '.$val->Middle_name; ?></td>
                    <td><?php if($val->Leave_type != ''){echo $val->Leave_type;}else{echo '---';} ?></td>
                    <td><?php if($val->year != ''){ echo $val->year;}else{echo '---';} ?></td>
                    <td><?php if($val->allocated != ''){echo $val->allocated;}else{echo '---';} ?></td>
                    <td><?php if($val->used != ''){echo $val->used;}else{echo '---';} ?></td>
                    <td><?php if($val->allocated != ''){$balance = $val->allocated - $val->used; echo $balance;}else{echo '---';} ?></td>
                    <td><?php 
                        $this->load->model('leave_model');
                        $count = $this->leave_model->count_lv_by_id($val->Emp_id);
                       if($count == 1){
                        echo anchor(site_url('leave_ctr/add_allo_leave/'.$val->Emp_id),'<span></span>Add','title = "Allocate a Leave" class="btn-mini btn-grey btn-cart" ');
                       }
                       
					if($val->leave_allo_id != ''){
                            if($val->used == '0.00'){
                              echo anchor(site_url('leave_ctr/edit_allo_leave/'.$val->leave_allo_id),'<span></span>Edit','title = "Edit an Allocated Leave" class="btn-mini btn-grey btn-check" ');
							  echo anchor(site_url('leave_ctr/delete_allo_leave/'.$val->leave_allo_id),'<span></span>Delete','title = "Delete an Allocated Leave" class="btn-mini btn-grey btn-cross" ');   
                            }
							
                            echo anchor(site_url('leave_ctr/view_allo_leave/'.$val->leave_allo_id),'<span></span>print','title = "View an Allocated Leave" class ="btn-mini btn-grey btn-print"');
					}
					?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
             </table>
             </div><!-- block -->
             </div><!-- box round first grid-->
     </div><!-- grid_10 -->
     <!-- container_12 -->