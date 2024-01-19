<style>
.form_holder {border:1px groove;
			padding:10px;}

</style>

<script type="text/javascript">
	jQuery(document).ready(function() {
			   jQuery('#hd').hide();

       jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('performance_ctr/supervisor');?>";
	   });
	 
    });
</script>
<script type="text/javascript">
	jQuery(document).ready(function(){
			  get_result();
		  jQuery('#super').change(function(){
			  get_result();
			   jQuery('#hd').show();
		  });
		  function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/get_des_fr_sup') ?>',
				type: 'post',
				data: jQuery('#super').serializeArray(),
				success: function(data){
					jQuery('#des').html(data)	;
				}
			});	  
		  }
			
	});
</script>

<?php 
	 switch($action){
		case 'Add':
			$heading = 'Add New';
			$dis = '';
			$view = '';
			$result = $super;
		break;
		case 'Edit':
			$heading = 'Edit';
			$dis = 'DISABLED';
			$view = '';
			$result = $super[0];
		break;
		case 'Delete':
			$heading = 'Delete';
			$dis = $view = 'DISABLED';
			$result = $super[0];
		break;
		case 'View':
			$heading = 'View';
			$dis = $view = 'DISABLED';
			$result = $super[0];
		break;
		case 'Assign':
			$heading = 'Assign Employees to';
			$dis = $view = 'DISABLED';
			$result = $super[0];
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
                    <h2><?php echo $heading;?> Supervisor </h2>
                    <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                <div class="block">
               
                <?php echo form_open('performance_ctr/validate_super');?>
                    <table class="form">
                    
                    <tr>
                    <td class="col1"><?php echo form_label('Supervisor ID','supervisor_id'); ?></td>
                    <td class="col2">
                    <?php if($action != 'Add'){ ?>
                    <?php echo form_hidden('supervisor_id',set_value('supervisor_id',$result['supervisor_id'])); ?>
                    <?php } ?>
					<?php echo form_input('supervisor_id',set_value('supervisor_id',$result['supervisor_id']),'class="mini"'.$dis);?>
                    <div class="validate error">
                    <?php echo form_error('supervisor_id'); ?>
                    </div>
                    </td>
                    </tr>
                    <?php if($action == 'Add'){ ?>
                    <tr>
                    <td><?php echo form_label('Supervior','Emp_id'); ?></td>
                    <td>
                    	<?php echo form_dropdown('Emp_id',$supervisor,set_value('Emp_id',$result['Emp_id']),'id="super" '.$view); ?>
                        <div class="validate error">
                    	<?php echo form_error('Emp_id'); ?>
                   		</div>
                    </td>
                    </tr>
                    <?php } if($action != 'Add'){ ?>
                    <tr>
                    <td><?php echo form_label('Supervior','Emp_id'); ?></td>
                    <td>
                    	<?php echo form_dropdown('Emp_id',$supervisorEdit,set_value('Emp_id',$result['Emp_id']),'id="super" '.$view); ?>
                        <div class="validate error">
                    	<?php echo form_error('Emp_id'); ?>
                   		</div>
                    </td>
                    </tr>
                    <?php } ?>
                    
                   <?php if($action == 'Add' || $action == 'Edit'){ ?>
                    <tr>
                    <td> <div id="hd"><?php echo form_label('Designation','Des_code'); ?></div></td> 
                    <td>
                    <div id="des"></div>
                    </td>
                    </tr>
                    <?php } ?>
                    <?php if($action != 'Add' && $action != 'Edit'){ ?>
                    <tr>
                    <td><?php echo form_label('Designation','job_Title'); ?></td> 
                    <td>
                    <?php echo form_input('job_Title',set_value('job_Title',$result['job_Title']),'class="smallinput" '.$view); ?>
                    </td>
                    </tr>
                    <?php } ?>
                    
                   <tr>
                   <td>
                   <?php echo form_label('Level','level'); ?>
                   </td>
                   <td>
                   <?php 
				   $hig = ""; $low ="";
				   if($result['level'] == 'L'){$hig = FALSE; $low = TRUE;}
				   else{$hig = TRUE; $low = FALSE;}
				   ?>
                   <label class="radio inline"><?php echo form_radio('level','H',$hig,$view); ?> High</label>
                   <label class="radio inline"><?php echo form_radio('level','L',$low,$view); ?> Low</label>
                   
                   
                   </td>
                   </tr>
                   
                   <?php if($action == 'Assign'){ ?>
                    <tr>
                    <td>
                    <?php echo form_label('Employees','Emp'); ?>
                    </td>
                    <td>
                   <?php $chk = array('id'=>'','name'=>'','value'=>'','checked'=>'');
				   if(!empty($Employees)){
					   foreach($Employees as $emp){
						   
						   $chk = array('id'=>'chk[]','name'=>'Emp[]','value'=>$emp->Emp_id,'checked'=>FALSE);
						   if(!empty($assigned_emp)){
							   foreach($assigned_emp as $assign){
								   if($assign->Emp_id == $emp->Emp_id){
									   $chk['checked'] = TRUE;break;
								   }//update
							   }
						   }//!empty $assigned
						   if($action == 'View'){
								$chk['disabled']  = 'disabled';
						   }
                           echo '<label class="checkbox inline">';
						   echo form_checkbox($chk);
						   echo $emp->First_name;
                           echo '</label>';
					   }//foreach 1 
				   }//!empty emp
				    ?>
                    <?php } ?>
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
   