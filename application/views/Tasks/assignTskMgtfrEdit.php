
<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>

<script type="text/javascript">
	jQuery(document).ready(function() {
			   jQuery('#hd').hide();

       jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('performance_ctr/assign_tasks');?>";
	   });
	   $( "#datepicker1" ).datepicker({
      			changeMonth: true,
      			changeYear: true,
                beforeShowDay: $.datepicker.noWeekends
    		});
			 $( "#datepicker2" ).datepicker({
      			changeMonth: true,
      			changeYear: true,
                beforeShowDay: $.datepicker.noWeekends
    		});
			
		
			
	 
    });
</script>


<?php 
	 switch($action){
		
		case 'Edit':
			$heading = 'Edit';
			$add = $dis = 'DISABLED';
			$view = '';
			$result = $tasks[0];
		break;
		case 'View':
			$heading = 'View';
			$add = $dis = $view = 'DISABLED';
			$result = $tasks[0];
		break;
		
	} 
?>

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
            <?php // echo '<pre>'; print_r($super); echo '</pre>';?>
                    <h2><?php echo $heading;?> Task </h2>
                    <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                <div class="block">
                <?php echo form_open('performance_ctr/validate_task');?>
                    <table class="form">
                    
                    <tr>
                    <td class="col1"><?php echo form_label('Supervisor ID','supervisor_id'); ?></td>
                    <td class="col2">
                   
                    <?php echo form_hidden('supervisor_id',set_value('supervisor_id',$result['supervisor_id'])); ?>
                     <?php if($action != 'Add'){ ?>
                    <?php echo form_hidden('task_id',set_value('task_id',$result['task_id'])); ?>
                    <?php } ?>
					<?php echo form_input('supervisor_id',set_value('supervisor_id',$result['supervisor_id']),'class="mini"'.$add);?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Supervior','Emp_id'); ?></td>
                    <td>
                    	<?php 
						echo form_input('Emp_id',set_value('Emp_id',$result['First_name']),'class="mini" '.$add);
						 ?>
                        
                    </td>
                    </tr>
                   <?php if($action != 'Add'){echo form_hidden('task_id',set_value('task_id',$result['task_id']));} ?>
                   
                    <tr>
                    <td><?php echo form_label('Task ID','task_id'); ?></td>
                    <td>
                    	<?php echo form_input('task_id',set_value('task_id',$result['task_id']),'class="mini" maxlength="30" '.$dis); ?>
                        <div class="validate error">
                    	<?php echo form_error('task_id'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    
                    <tr>
                    <td><?php echo form_label('Task','task_name'); ?></td>
                    <td>
                    	<?php echo form_input('task_name',set_value('task_name',$result['task_name']),'class="mini" '.$view); ?>
                        <div class="validate error">
                    	<?php echo form_error('task_name'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('From','From'); ?></td>
                    <td>
                    <input class="From" name="From" value="<?php echo $result['From']; ?>" id='datepicker2'/>
                        <div class="validate error">
                    	<?php echo form_error('From'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('To','To'); ?></td>
                    <td colspan="5">
                    	 <input class="To" name="To" value="<?php echo $result['To']; ?>" id='datepicker1'/>
                        <div class="validate error">
                    	<?php echo form_error('To'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
                    <?php echo form_label('Employees','Emp'); ?>
                    </td>
                    <td>
                    	<?php
						
						$chk = array('id'=>'','name'=>'','value'=>'','checked'=>'');
						 foreach($Employees as $emp){
							
							$chk = array('id'=>'chk','name'=>'Emp[]','value'=>$emp->Emp_id,'checked'=>FALSE); 
							
							if(!empty($tsk_as_emp)){
								//echo '<pre>'; print_r($tsk_as_emp); echo '</pre>';
								foreach($tsk_as_emp as $assigned){
									
									if($assigned->Emp_id == $emp->Emp_id){
										$chk['checked'] = TRUE;break;
									}
								}
							}//empty
                                echo '<label class="checkbox inline">';
								echo form_checkbox($chk);
								echo $emp->First_name;
                                echo '</label>';
							
								
						?>
                         <?php  } ?>
                        <div class="validate error">
                    	<?php echo form_error('Emp'); ?>
                   		</div>
                    </td>
                    </tr>
                   
                   
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
                <?php echo form_close(); ?>
                </div><!-- block-->
                </div>
            </div><!-- box round first grid -->
        </div><!--grid_10-->
        
    </div><!-- container_12 -->
   