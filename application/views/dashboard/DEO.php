<style type="text/css">
.bor{
    margin:20px;
    padding:20px;
}
</style>
<div class="container_12">
        <div class="grid_10">
        <div class="box round first grid">
        <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
        </p>
            <table border="0">
            <tr>
            <td>
            <div class="bor">
            <a href="<?php echo site_url('leave_ctr/add_lv_app'); ?>"><img src="<?php echo site_url(); ?>/images/app.png" alt="Leave Application"/></a>
            <br />
            <h5 align="center">Leave Application</h5>
            </div>
            </td>
            <td>
            <div class="bor">
            <a href="<?php echo site_url('employee_ctr/add/'); ?>"><img src="<?php echo site_url(); ?>/images/users.png" alt="Add Employee" /></a>
            <br />
            <h5 align="center">New Employee</h5>
            </div>
            </td>
            <td>
            <div class="bor">
            <a href="<?php echo site_url('attendence_ctr'); ?>"><img src="<?php echo site_url(); ?>/images/att.png" alt="Add Employee" /></a>
            <br />
            <h5 align="center">Attendence</h5>
            </div>
            </td>
            <td>
            <div class="bor">
            <a href="<?php echo site_url('performance_ctr/emp_tasks/'); ?>"><img src="<?php echo site_url(); ?>/images/stock_task.png" alt="Add Employee" /></a>
            <br />
            <h5 align="center">Tasks</h5>
            </div>
            </td>
            </tr>
            
            
            <tr>
            <td>
            <div class="bor">
            <a href="<?php echo site_url('fuel_ctr/gate_pass'); ?>"><img src="<?php echo site_url(); ?>/images/gatepasses.png" /></a>
            <br />
            <h5 align="center">Gate Passes</h5>
            </div>
            </td>
           
            <td>
            <div class="bor">
            <a href="<?php echo site_url('leave_ctr/requests/'); ?>"><img src="<?php echo site_url(); ?>/images/log.png" /></a>
            <br />
            <h5 align="center">Approve Leaves</h5>
            </div>
            </td>
            
            <td>
            <div class="bor">
            <a href="<?php echo site_url('talent_ctr/recruitment'); ?>"><img src="<?php echo site_url(); ?>/images/recruitment.png" /></a>
            <br />
            <h5 align="center">Internal Vacancies</h5>
            </div>
            </td>
            </tr>
            
            </table>
       
        </div>
            
        </div>
</div>