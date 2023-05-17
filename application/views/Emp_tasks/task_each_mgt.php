<?php 
switch($action){
	case 'Edit':
		$heading = 'Mark ';
		$dis     = 'DISABLED';
		$view	 =  '';
		$result	 = $tsk_Mark[0];
	break;
	case 'View':
		$heading = 'View ';
		$dis = $view = 'DISABLED';
		$result	 = $tsk_Mark[0];
	break;
}
?>
<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>

<script type="text/javascript">
	jQuery(document).ready(function() {
       jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('performance_ctr/emp_tasks');?>";
	   });	
	    $( "#datepicker1" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});
			 $( "#datepicker2" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});		
    });
</script>
<script type="text/javascript">
/* <?php if($action == 'Edit'){ ?>
	jQuery(document).ready(function()
	{
		jQuery('#incom').click(function(){
			
			jQuery('tr#reason_fr_late').show();
		
		});
		var st = jQuery('#incom').is(':checked');
		if(st == true){
			jQuery('tr#reason_fr_late').show();
		}
		jQuery('#half').click(function(){
			
			jQuery('tr#reason_fr_late').show();
		
		});
		
		
		jQuery('tr#reason_fr_late').hide();
	});
<?php } ?> */
</script>
<div class="container_12">
	<div class="grid_10">
            <ul class="nav main">
             <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
             <?php switch($this->session->userdata('user_role_id')){
                case 'ADMIN':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/assign_tasks'); ?>"><span>Assign Tasks</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/app_tasks'); ?>"><span>Approving Tasks</span></a></li>
                
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/supervisor'); ?>"><span>Maintain Supervisors</span></a></li>
                <?php
                break;
                case 'DEO':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
                <?php
                break;
                case 'NEMP':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
                <?php
                break;
                case 'VEMP':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
                <?php
                break;
                case 'MGER':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/assign_tasks'); ?>"><span>Assign Tasks</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/app_tasks'); ?>"><span>Approving Tasks</span></a></li>
                <?php
                break;
                case 'HR':
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/assign_tasks'); ?>"><span>Assign Tasks</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/emp_tasks'); ?>"><span>Employee Tasks</span></a></li>
				<li class="ic-form-style"><a href="<?php echo site_url('performance_ctr/app_tasks'); ?>"><span>Approving Tasks</span></a></li>
                <?php
                break;
             } ?>
                
                
            </ul>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            <div class="form_holder">
                    <h2><?php echo $heading;?> Working Progress </h2>
                    <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                    <?php echo form_open('performance_ctr/validate_emp_tsk'); ?>
                    <?php echo form_hidden('task_id',set_value('task_id',$result['task_id'])); ?>
                    <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Task','task_name'); ?></td>
                    <td class="col2">
                    <?php echo form_input('task_name',set_value('task_name',$result['task_name']),'class="mini" '.$dis); ?>
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Task Initiated','From'); ?></td>
                    <td>
                    <?php echo form_input('From',set_value('From',$result['From']),'id="grumble" '.$dis) ?>
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Task Expires','To'); ?></td>
                    <td><?php echo form_input('To',set_value('To',$result['To']),'id="grumble" '.$dis); ?></td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Supervised By','supervisor_id'); ?></td>
                    <td><?php echo form_input('supervisor_id',set_value('supervisor_id',$result['supervisor_id']),'class="mini" '.$dis); ?></td>
                    </tr>
                    <?php if($result['feedback_date'] == '0000-00-00'){ ?>
                    <tr>
                    <td><?php echo form_label('Feedback Date','feedback_date'); ?></td>
                    <td> <input id="datepicker" name="feedback_date" value="<?php echo date('Y-m-d'); ?>"class='feedback_date'/>
                    	 <div class="validate error">
                    	<?php echo form_error('feedback_date'); ?>
                        </div>
                    </td>
                    </tr>
                    <?php }else{ ?>
                   
                    <tr>
                    <td><?php echo form_label('Feedback Date','feedback_date'); ?></td>
                    <td> <input id="datepicker" name="feedback_date" value="<?php echo $result['feedback_date']; ?>"class='feedback_date'/>
                    	 <div class="validate error">
                    	<?php echo form_error('feedback_date'); ?>
                        </div>
                    </td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td><?php echo form_label('Progress Status','status'); ?></td>
                    
                    <?php 
                    //echo $result['status'];
					if($result['status'] == 1){
					    $complete 		= TRUE;
						$incomplete		= FALSE;
						$halfcomplete	= FALSE;
					
					}else if($result['status'] == 9){
						$complete 		= FALSE;
						$incomplete		= FALSE;
						$halfcomplete	= TRUE;
					}else{
                        $complete 		= FALSE;
						$incomplete		= TRUE;
						$halfcomplete	= FALSE;
					}
				
					?>
                    <td><label class="radio inline"><?php echo form_radio('status','1',$complete,'id="radio" '.$view); ?>Complete</label>
                    	<label class="radio inline"><?php echo form_radio('status','0',$incomplete,'id="incom" '.$view);?>Incomplete</label>
                        <label class="radio inline"><?php echo form_radio('status','9',$halfcomplete,'id="half" '.$view);?>Half Complete</label>
                         <div class="validate error">
                         <?php echo form_error('status'); ?>
                         </div>
                    </td>
                    </tr>
                    
                    <tr id="reason_fr_late">
                    <div id="reason_fr_late">
                    <td><?php echo form_label('Comments','comments'); ?></td>
                    <td><?php echo form_input('comments',set_value('comments',$result['comments']),'class="mini" id="a" '.$view); ?>
                    </td>
                     </div>
                    </tr>
                   
                    <?php if($result['approved'] != 'N'){ 
					if($result['approved'] == 'A'){ $app = 'Approved';}
					if($result['approved'] == 'R') {$app = 'Rejected';}
					?>
                    <tr>
                    <td><?php echo form_label('Approval Status'); ?></td>
                    <td><?php echo form_input('approved',set_value('approved',$app),'class="mini" '.$dis)?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td>
                     <?php echo form_hidden('action',$action); ?>
                    <?php if($action != 'View'){?>
					<?php echo form_submit('submit',$action,'class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey" id = "cancel"');?>
                    <td>
                    <?php
					echo form_reset('back','Back','class="btn btn-grey" id="back"');
					 ?>
                    </td>
                    <?php }?>
                    <?php if($action == 'View'){?>
                    <?php echo form_submit('submit','OK','class="btn btn-blue"');?>
                    <?php } ?>
                    
                    </td>
                    </tr>
                    </table>
            </div><!-- form_holder -->