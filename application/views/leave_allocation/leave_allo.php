<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		jQuery('#Emp_id').change(function(){
			get_result();
		});
		jQuery('#Leave_type').change(function(){
			get_result();
		});
		jQuery('#grumble').keyup(function(){
			get_result();
		});
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
		});
		function get_result(){
			jQuery.ajax({
				url:'<?php echo site_url('search/lv_allo') ?>',
				type:'post',
				data:jQuery('#myform').serializeArray(),
				success:function(msg){
					jQuery('#result').html(msg);
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
            	<h2>Leave Allocation</h2>
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
					<?php echo form_dropdown('Emp_id',$emp,$this->input->get('Emp_id'),'id="Emp_id"');?>
                    </td>
                    </tr>
                    
                	<tr>
                    <td class="col1"><?php echo form_label('Leave Type','Leave_type'); ?></td>
                    <td class="col2">
					<?php echo form_dropdown('Leave_type',$lv_type,$this->input->get('Leave_type'),'id="Leave_type"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td class="col1"><?php echo form_label('Year','year'); ?></td>
                    <td class="col2">
					<?php echo form_input('year',$this->input->get('year'),'id="grumble" ');?>
                    </td>
                    </tr>
                    
                     <tr>
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
               </table>
               	</div><!-- block -->
                
                </div><!-- form_holder-->
                <div id="result"></div>
</div><!-- container_12 -- >
