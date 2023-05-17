<script>
jQuery(document).ready(function(){
   get_result();
   jQuery( "#datepicker1" ).datepicker({
      			changeMonth: true,
      			changeYear: true
  });
            
   jQuery('#myform').submit(function(e){
    e.preventDefault();
    get_result();
   }); 
   jQuery('#ID').keyup(function(){
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
       url:'<?php echo site_url('search/recruitment') ?>',
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
                <?php echo form_label('Vacancy','vacancy'); ?>
                </td>
                <td>
                <?php echo form_input('vacancy',$this->input->post('vacancy'),'id="ID"'); ?>
                </td>
                
                <td class="col1">
                <?php echo form_label('Opening Date','opening_date'); ?>
                </td>
                <td>
                <?php echo form_input('opening_date',$this->input->post('opening_date'),'id="datepicker"'); ?>
                </td>
                </tr>
                
                <tr>
                <td class="col1"><?php echo form_label('Closing Date','closing_date'); ?></td>
                <td>
                <?php echo form_input('closing_date',$this->input->post('closing_date'),'id="datepicker1"'); ?>
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
					<?php 
                    if($this->session->userdata('user_role_id') == 'HR'){
                      echo anchor(site_url('talent_ctr/new_job'),'<span></span>New Vacancy','class = "btn-icon btn-blue btn-plus" style="float:right"');  
                    }
                     ?>
					</td>
                    </tr>
                
                </table>
                <?php echo form_close(); ?>
                </div><!-- form_holder -->
             </div><!-- box -->
    </div><!-- grid 10 -->
    
</div> <!--container -->
<div id="result"></div>