<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		jQuery('#Emp_id').keyup(function(){
			get_result();
		});
		jQuery('#First_name').keyup(function(){
			get_result();
		});
		jQuery('#job_Title').keyup(function(){
			get_result();
		});
		jQuery('#Dept_name').keyup(function(){
			get_result();
		});
		jQuery('#NIC').keyup(function(){
			get_result();
		});
		jQuery('#Emp_mail').keyup(function(){
			get_result();
		});
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/emp_search') ?>',
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
                <h2>Employee Details </h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
                <?php
	//echo '<pre>'; print_r($this->session->all_userdata()); echo '</pre>';
?>
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Employee ID','Emp_id'); ?></td>
                    <td class="col2">
                    <?php if($this->session->userdata('user_role_id') == 'NEMP' || $this->session->userdata('user_role_id') == 'VEMP'){
                        echo form_input('Emp_id',set_value('Emp_id',$this->session->userdata('Emp_id')),'id="Emp_id" DISABLED');
                        echo form_hidden('Emp_id',set_value('Emp_id',$this->session->userdata('Emp_id')));
                    }else{
                         echo form_input('Emp_id',$this->input->get('Emp_id'),'id="Emp_id"');
                    } ?>
					
                    </td>
                    
                    <td><?php echo form_label('Employee Name','First_name'); ?></td>
                    <td>
						<?php echo form_input('First_name',$this->input->get('First_name'),'id="First_name"'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Designation','job_Title'); ?></td>
                    <td>
						<?php echo form_input('job_Title',$this->input->get('job_Title'),'id="job_Title"'); ?>
                    </td>
                   
                    <td><?php echo form_label('Department','Dept_name'); ?></td>
                    <td>
						<?php echo form_input('Dept_name',$this->input->get('Dept_name'),'id="Dept_name"'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('NIC','NIC'); ?></td>
                    <td>
						<?php echo form_input('NIC',$this->input->get('NIC'),'id="NIC"'); ?>
                    </td>
                   
                    <td><?php echo form_label('Email','Emp_mail'); ?></td>
                    <td>
						<?php echo form_input('Emp_mail',$this->input->get('Emp_mail'),'id="Emp_mail"'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
					</td>
                    </tr>
                    
                </table>
                <?php echo form_close(); ?>
                </div><!-- block -->
                </div><!-- form-holder-->
               	<div class="block">
                
                <?php if($this->session->userdata('user_role_id') == 'DEO'){
                    echo anchor(site_url('employee_ctr/add'),'<span></span>New Employee','class = "btn-icon btn-blue btn-plus" style="float:right"');
                }  ?>
				</div><!-- second block -->
                <div id="result"></div>
            </div><!-- box round first grid -->
       </div><!-- grid_10 -->
</div><!-- container_12 -->
