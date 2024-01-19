
<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/leave_app') ?>',
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
             <?php if($this->session->userdata('user_role_id') == 'HR'){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/types'); ?>"><span>Leave Types</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/allocation'); ?>"><span>Leave Allocation</span></a></li>
                <?php
             } ?>
                
				<li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/requests'); ?>"><span>Leave Requests</span></a></li>
                <?php if($this->session->userdata('user_role_id') == 'HR' ||$this->session->userdata('user_role_id') == 'ADMIN'||$this->session->userdata('user_role_id') == 'MGER') {
                    ?>
                    <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/approvals'); ?>"><span>Leave Approvals</span></a></li>
                    <?php
                     }?>
				
            </ul>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Leave Applications</h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Employee','Emp_id'); ?></td>
                    <td class="col2">
					<?php echo form_dropdown('Emp_id',$emp,set_value('Emp_id',$this->session->userdata('Emp_id')),'disabled');?>
                    <?php echo form_hidden('Emp_id',set_value('Emp_id',$this->session->userdata('Emp_id'))); ?>
                    </td>
                    </tr>
                    
                    
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
                    </td>
                    <td>
					<?php echo anchor(site_url('leave_ctr/add_lv_app'),'<span></span>New Leave App','class = "btn-icon btn-blue btn-plus" style="float:right"'); ?>
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
