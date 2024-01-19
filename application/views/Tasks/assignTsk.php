<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>


<script type="text/javascript">
	jQuery(document).ready(function(){
		$( "#datepicker1" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});
			$( "#datepicker1" ).datepicker( "option", "firstDay", 1 );
			$( "#datepicker1" ).datepicker( "option", "dateFormat", "yy-mm-dd" );

		get_result();
		jQuery('#supervisor_id').keyup(function(){
			get_result();
		});
		jQuery('#superName').keyup(function(){
			get_result();
		});
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		jQuery('#datepicker').change(function(){
			get_result();
		});
		jQuery('#datepicker1').change(function(){
			get_result();
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/task_search') ?>',
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
            	<h2>Search all Tasks </h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                	
                     <tr>
                    <td><?php echo form_label('From','From'); ?></td>
                    <td>
                        <input class="From" name="From" id='datepicker'/>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('To','To'); ?></td>
                    <td>
                        <input class="To" name="To" id='datepicker1'/>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Supervisor Name','superName'); ?></td>
                    <td>
						<?php //echo form_input('superName',$this->input->get('superName'),'class = "mini" id="superName"'); ?>
                        <?php echo form_dropdown('supervisor_id',$Supervisor_cmb,$this->input->get('supervisor_id')); ?>
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
                </div><!--block-->
                </div>
                <div id="result"></div>
            </div><!-- box round first grid -->
        </div><!--grid_10-->
	</div><!-- container_12-->
