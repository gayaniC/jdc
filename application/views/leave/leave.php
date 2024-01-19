<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		jQuery('#leave_type_code').keyup(function(){
			get_result();
		});
		jQuery('#Leave_type').keyup(function(){
			get_result();
		});
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/leaveType_search') ?>',
				type: 'post',
				data: jQuery('#myform').serializeArray(),
				success: function(msg){
					jQuery('#result').html(msg)	;
				}
			});	
		}
		jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('leave_ctr/add/');?>";
	   });
	});
</script> 
<?php 
	switch($action){
		case 'Add':
			$result 	= $leave_type;
			$heading	= 'Add';
			$dis 		= '';
			$view		= '';
		break;
		case 'Edit':
			$result 	= $leave_type[0];
			$heading	= 'Edit';
			$dis		= 'DISABLED';
			$view		= '';
		break;
		case 'Delete':
			$result = $leave_type[0];
			$heading	= 'Delete';
			$dis = $view = 'DISABLED';
		break;
		case 'View':
			$result = $leave_type[0];
			$heading	= 'View';
			$dis = $view = 'DISABLED';
		break;
	}
?>
	<div class="container_12">
    <div class="grid_10">
            <ul class="nav main">
             <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
             <?php if($this->session->userdata('user_role_id') == 'HR'){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/types'); ?>"><span>Leave Types</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/allocation'); ?>"><span>Leave Allocation</span></a></li>
                <?php
             } ?>
                
				<li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/requests'); ?>"><span>Leave Requests</span></a></li>
                <?php if($this->session->userdata('user_role_id') == 'HR' ||$this->session->userdata('user_role_id') == 'ADMIN'||$this->session->userdata('user_role_id') == 'MGER') {
                    ?>
                    <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/approvals'); ?>"><span>Leave Approvals</span></a></li>
                    <?php
                     }?>
				
            </ul>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Leave Types</h2>
               
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
               
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Leave Type Code','leave_type_code'); ?></td>
                    <td class="col2">
					<?php echo form_input('leave_type_code',$this->input->get('leave_type_code'),'class="mini" maxlength="10" id="leave_type_code" ');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Leave Type','Leave_type'); ?></td>
                    <td>
						<?php echo form_input('Leave_type',$this->input->get('Leave_type'),'class = "mini" id="Leave_type"'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                   
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                    
                   
                    
                </table>
                <?php echo form_close(); ?>
                </div><!--block-->
                </div>
                <div class="block">
                <div class="form_holder">
                <font color="#1B548D"><p><b><?php echo $heading; ?> Leave Type</b></p></font>
                 	<p id="errormsg">
						 <?php if($this->session->flashdata('msg') != ''){ 
                        echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                         } ?>
    				</p>
                	<?php echo form_open('leave_ctr/validation_type'); ?>
                     <?php if($action != 'Add'){
						echo form_hidden('leave_type_code',set_value('leave_type_code',$result['leave_type_code']));	
					}?>
                    <table class="form">
                    <tr>
                    	<td class="col1">
                        <?php echo form_label('Leave Type Code','leave_type_code'); ?>
                        </td>
                        <td class="col2">
                        <?php echo form_input('leave_type_code',set_value('leave_type_code',$result['leave_type_code']),'class = "mini" '.$dis.' '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('leave_type_code'); ?>
                    	</div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                        <?php echo form_label('Leave Type','Leave_type'); ?>
                        </td>
                        <td>
                        <?php echo form_input('Leave_type',set_value('Leave_type',$result['Leave_type']),'class = "mini" '.$view.' '); ?>
                        <div class="validate error">
                   		<?php echo form_error('Leave_type'); ?>
                    	</div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                        <?php echo form_hidden('action',set_value('action',$action));?>
                        <?php if($action != 'View'){?>
                        <?php echo form_submit('submit',$action,'class="btn btn-blue"');?>
                        <?php echo form_reset('cancel','Cancel','class="btn btn-grey" id = "cancel"');?>
                        <?php } ?>
                        <?php if($action == 'View'){
							echo form_submit('submit','OK','class="btn btn-blue"');	
						}?>
                        </td>
                        <?php if($action != 'Add'){?>
                        <td>
                        <?php
						echo form_reset('back','New Leave Type','class="btn btn-blue" id="back"');
						?>
                        </td>
                        <?php } ?>
                    </tr>
                    </table>
                    <?php echo form_close(); ?>
                    </div><!-- form_holder -->
                </div><!-- block -->
                <div id="result"></div>
                
            </div><!-- box round first grid -->
        </div><!--grid_10-->
	</div><!-- container_12-->
