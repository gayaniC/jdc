<script>
jQuery(document).ready(function(){
   get_result();
   jQuery('#myform').submit(function(e){
    e.preventDefault();
    get_result();
   }); 
   function get_result(){
    jQuery.ajax({
       url:'<?php echo site_url('search/get_emp_resign') ?>',
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
            <?php if($this->session->userdata('user_role_id') == 'ADMIN' ||$this->session->userdata('user_role_id') == 'DVP' ){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('talent_ctr/designation'); ?>"><span>Maintain Designations</span></a></li>
                
                <?php
            } ?>
                
                <li class="ic-form-style"><a href="<?php echo site_url('talent_ctr/recruitment'); ?>"><span>Recruitment</span></a></li>
                
                <li class="ic-form-style"><a href="<?php echo site_url('talent_ctr/resign'); ?>"><span>Resignations</span></a></li>
              
				
            </ul>
    </div>
    <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
                <h2>Job Details</h2>
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
                <?php echo form_label('Employee','Emp_id'); ?>
                </td>
                <td>
                <?php echo form_dropdown('Emp_id',$employee,$this->input->get('Emp_id')); ?>
                </td>
                
                <td class="col1">
                <?php echo form_label('Resign Date','resign_date'); ?>
                </td>
                <td>
                <?php echo form_input('resign_date',$this->input->post('resign_date'),'id="datepicker"'); ?>
                </td>
                </tr>
                
               
                <tr>
                <td>
                <?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                <?php echo form_reset('reset','Cancel','class="btn btn-grey"'); ?>
                
                </td>
                </tr>
                
                
                </table>
                <?php echo form_close(); ?>
                </div><!-- form_holder -->
             </div><!-- box -->
    </div><!-- grid 10 -->
    
</div> <!--container -->
<div id="result"></div>