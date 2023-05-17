<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		jQuery('#comp_id').keyup(function(){
			get_result();
		});
		
		jQuery('#com_name').keyup(function(){
			get_result();
		});
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/company_search') ?>',
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
            <?php if($this->session->userdata('user_role_id') == 'ADMIN'){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('company_ctr'); ?>"><span>Company Details</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('department_ctr'); ?>"><span>Department Details</span></a></li>
                <?php
            } ?>
                
                <li class="ic-form-style"><a href="<?php echo site_url('employee_ctr'); ?>"><span>Employee Details</span></a></li>
				
            </ul>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Company Details </h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Company ID','comp_id'); ?></td>
                    <td class="col2">
					<?php echo form_input('comp_id',$this->input->get('comp_id'),'class="mini" id="comp_id"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Company Name','com_name'); ?></td>
                    <td>
						<?php echo form_input('com_name',$this->input->get('com_name'),'class = "mini" id="com_name"'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
                    </td>
                    <td>
					<?php 
                    if($this->session->userdata('user_role_id') == 'ADMIN'){
                        echo anchor(site_url('company_ctr/add'),'<span></span>New Company','class = "btn-icon btn-blue btn-plus" style="float:right"');
                    }
                     ?>
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
