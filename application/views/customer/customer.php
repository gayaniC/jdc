<script>
jQuery(document).ready(function(){
   get_result();
   jQuery('#myform').submit(function(e){
    e.preventDefault();
    get_result();
   }); 
   jQuery('#ID').keyup(function(){
        get_result();
   });
   jQuery('#name').keyup(function(){
    get_result();
   });
   function get_result(){
    jQuery.ajax({
       url:'<?php echo site_url('search/customers') ?>',
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
                <h2>Customer Details</h2>
                <p id="errormsg">
                <?php if($this->session->flashdata('msg') != ''){ 
                echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                } ?>
                </p>
                <br />
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                <tr>
                <td class="col1">
                <?php echo form_label('Customer ID','cus_id'); ?>
                </td>
                <td>
                <?php echo form_input('cus_id',$this->input->post('cus_id'),'id="ID"'); ?>
                </td>
                
                <td class="col1">
                <?php echo form_label('Customer','customer_name'); ?>
                </td>
                <td>
                <?php echo form_input('customer_name',$this->input->post('customer_name'),'id="name"'); ?>
                </td>
                </tr>
                <tr>
                <td>
                <?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                <?php echo form_reset('reset','Cancel','class="btn btn-grey"'); ?>
                
                </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
					<?php echo anchor(site_url('fuel_ctr/add_cus'),'<span></span>New Customer','class = "btn-icon btn-blue btn-plus" style="float:right"'); ?>
					</td>
                    </tr>
                
                </table>
                <?php echo form_close(); ?>
                </div><!-- form_holder -->
             </div><!-- box -->
    </div><!-- grid 10 -->
    <div id="result"></div>
</div> <!--container -->