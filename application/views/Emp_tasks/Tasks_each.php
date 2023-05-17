<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/employee_tsk') ?>',
				type: 'post',
				data: jQuery('#myform').serializeArray(),
				success: function(msg){
					jQuery('#result').html(msg)	;
				}
			});	
		}
	});
</script> 
<div class="container_12">
	<div class="grid_10">
            <ul class="nav main">
             <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
             <?php switch($this->session->userdata('user_role_id')){
                case 'ADMIN':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/assign_tasks'); ?>"><span>Assign Tasks</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/app_tasks'); ?>"><span>Approving Tasks</span></a></li>
                
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/supervisor'); ?>"><span>Maintain Supervisors</span></a></li>
                <?php
                break;
                case 'DEO':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
                <?php
                break;
                case 'NEMP':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
                <?php
                break;
                case 'VEMP':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
                <?php
                break;
                case 'MGER':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/assign_tasks'); ?>"><span>Assign Tasks</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/app_tasks'); ?>"><span>Approving Tasks</span></a></li>
                <?php
                break;
                case 'HR':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/assign_tasks'); ?>"><span>Assign Tasks</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/app_tasks'); ?>"><span>Approving Tasks</span></a></li>
                <?php
                break;
             } ?>
                
                
            </ul>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Employee Tasks </h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                    <div class="block">
                    <?php echo form_open('','id="myform"'); ?>
                     <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Employee Name','Emp_id'); ?></td>
                    <td class="col2">
                    <?php echo form_dropdown('Emp_id',$emp,set_value('Emp_id',$this->session->userdata('Emp_id')),'DISABLED'); ?>
                    <?php echo form_hidden('Emp_id',set_value('Emp_id',$this->session->userdata('Emp_id'))); ?>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                    </table>
                    <?php echo form_close(); ?>
                    </div>
                </div><!-- form_holder -->
                 <div id="result"></div>
            </div><!-- box round -->
        </div><!-- grid 10 -->
</div><!-- container_12 -->