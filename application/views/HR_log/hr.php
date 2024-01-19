
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
				url: '<?php echo site_url('search/hr_log_srch') ?>',
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
            	<h2>HR Log Details </h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Event Name','event_name'); ?></td>
                    <td class="col2">
					<?php echo form_input('event_name',$this->input->get('event_name'),'class="mini" id="event_name"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Date','Date'); ?></td>
                    <td>
						<?php echo form_input('Date',$this->input->get('Date'),'id="datepicker"'); ?>
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
                    if($this->session->userdata('user_role_id') == 'HR'){
                        echo anchor(site_url('staff_ctr/log_add'),'<span></span>New HR Log','class = "btn-icon btn-blue btn-plus" style="float:right"');
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
