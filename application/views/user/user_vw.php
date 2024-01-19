<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		jQuery('#user_role_id').change(function(){
			get_result();
		});
		jQuery('#username').keyup(function(){
			get_result();
		});
        
        jQuery('#user_email').keyup(function(){
			get_result();
		});
        
        jQuery('#Emp_id').change(function(){
			get_result();
		});
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/search_users') ?>',
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
            </ul>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Users</h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                    <div class="block">
                    <?php echo form_open('','id="myform"'); ?>
                     <table class="form">
                     
                    <tr>
                    <td class="col1"><?php echo form_label('User Role','user_role_id'); ?></td>
                    <td class="col2"><?php echo form_dropdown('user_role_id',$userRole,$this->input->get('user_role_id'),'id="user_role_id"'); ?></td> 
                    </tr>
                	<tr>
                    <td class="col1"><?php echo form_label('Username','username'); ?></td>
                    <td class="col2">
					<?php echo form_input('username',$this->input->post('username'),'class="mini" id="username" ');?>
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Email','user_email'); ?></td>
                    <td>
                    <?php echo form_input('user_email',$this->input->post('user_email'),'class="mini" id="user_email"'); ?>
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Employee Name','Emp_id'); ?></td>
                    <td><?php echo form_dropdown('Emp_id',$emp,$this->input->get('Emp_id'),'id="Emp_id"');?></td>
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
					<?php echo anchor(site_url('user_ctr/add'),'<span></span>New User','class = "btn-icon btn-blue btn-plus" style="float:right"'); ?>
					</td>
                    </tr>
                    
                    </table>
                    <?php echo form_close(); ?>
                    </div>
                </div><!-- form_holder -->
            </div><!-- box round -->
        </div><!-- grid 10 -->
</div><!-- container_12 -->
<div id="result"></div>