<script>
jQuery(document).ready(function(){
    get_result();
    jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/idea_serach') ?>',
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
            <li class="ic-form-style"><a href="<?php echo site_url('talent_ctr/ideas'); ?>"><span>Innovative Ideas</span></a></li>
            <li class="ic-form-style"><a href="<?php echo site_url('staff_ctr/hr_log'); ?>"><span>HR Log</span></a></li>
            </ul>
    </div>
    <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
                <h2>Innovative Ideas</h2>
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
                <?php echo form_dropdown('Emp_id',$employee,$this->input->get('Emp_id'),'id="Emp_id"'); ?>
                </td>
                
               
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
                    if($this->session->userdata('user_role_id') == 'NEMP' ||$this->session->userdata('user_role_id') == 'VEMP'||
                    $this->session->userdata('user_role_id') == 'DEO'||$this->session->userdata('user_role_id') == 'DVP'){
                      echo anchor(site_url('talent_ctr/new_ideas'),'<span></span>Suggestions','class = "btn-icon btn-blue btn-plus" style="float:right"');  
                    }
                     ?>
					</td>
                    </tr>
                
                </table>
                <?php echo form_close(); ?>
                </div><!-- form_holder -->
             </div><!-- box -->
    </div><!-- grid 10 -->
   
</div><!-- container -->
 <div id="result"></div>