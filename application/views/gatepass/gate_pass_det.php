<script>
jQuery(document).ready(function(){
   get_result();
   jQuery('#veh').change(function(){
        get_result();
   });
   jQuery('#emp').change(function(){
        get_result();
   });
   jQuery('#gt').keyup(function(){
        get_result();
   });
   jQuery('#cus').change(function(){
        get_result();
   });
   jQuery('#myform').submit(function(e){
    e.preventDefault();
    get_result();
   }); 
   
   function get_result(){
    jQuery.ajax({
       url:'<?php echo site_url('search/gatepass_det') ?>',
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
            <?php if($this->session->userdata('user_role_id') == 'ADMIN'){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/vehicle'); ?>"><span>Vehicle Details</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/customer'); ?>"><span>Maintain Customers</span></a></li>
                <?php
            } ?>
                
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/gate_pass'); ?>"><span>Generate Gate Passes</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/gate_pass_det'); ?>"><span>Gate Passe Details</span></a></li>
				
            </ul>
        </div>
        
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Gate Passe Details</h2>
                <p id="errormsg">
                 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    			</p>
                <div class="block">
                 <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Vehicle No','Vehicle_no'); ?></td>
                    <td class="col2">
					<?php echo form_dropdown('Vehicle_no',$vehicle,set_value('Vehicle_no'),'id="veh"');?>
                                       
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Employee','Emp_id'); ?></td>
                    <td><?php 
                   
                    echo form_dropdown('Emp_id',$employee,set_value('Emp_id'),'id="emp"'); ?>
                    
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Customer','cus_id'); ?></td>
                    <td>
                    <?php echo form_dropdown('cus_id',$customer,set_value('cus_id'),'id="cus"'); ?>
                    
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Gate Pass ID','gate_pass_id') ?></td>
                    <td><?php echo form_input('gate_pass_id',$this->input->post('gate_pass_id'),'id="gt"'); ?></td>
                    </tr>
                    <tr>
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue" id="submit"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                </table>
                <?php echo form_close(); ?>
                </div>
                </div><!-- formholder-->
            </div><!-- box -->
       </div><!-- grid10-->
       
</div><!-- container12-->
<div id="result"></div>