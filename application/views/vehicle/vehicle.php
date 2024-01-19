<script type="text/javascript">
jQuery(document).ready(function(){
   get_result();
   jQuery('#myform').submit(function(event){
        event.preventDefault();
        get_result();
   }); 
   jQuery('#usage').change(function(){
        get_result();
   });
   jQuery('#Vehicle_no').keyup(function(){
        get_result();
   });
   function get_result()
   {
    jQuery.ajax({
        url:'<?php echo site_url('search/veh_search') ?>',
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
            	<h2>Vehicle Details </h2>
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
					<?php echo form_input('Vehicle_no',$this->input->get('Vehicle_no'),'id="Vehicle_no"');?>
                    </td>
                    
                    <td><?php echo form_label('Vehicle Type','usage_type'); ?></td>
                    <td><?php 
                    $usg = array(''=>'All','P'=>'Personal','C'=>'Company');
                    echo form_dropdown('usage_type',$usg,$this->input->get('usage_type'),'id="usage"'); ?></td>
                    </tr>
                    <tr>
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                    <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
					<?php echo anchor(site_url('fuel_ctr/add_veh'),'<span></span>New Vehicle','class = "btn-icon btn-blue btn-plus" style="float:right"'); ?>
					</td>
                    </tr>
                    
                </table>
                <?php echo form_close(); ?>
                </div><!-- block -->
                </div><!-- form-hoder -->
           </div><!-- box -->
           <div id="result"></div>
     </div><!-- grid_10 -->
</div><!-- container_12 -->