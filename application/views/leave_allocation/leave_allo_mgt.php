<script type="text/javascript">
	jQuery(document).ready(function() {
       jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('leave_ctr/allocation');?>";
	   });
		
    });
</script>
<?php 
switch($action){
	case 'Add':
		$heading = 'Add ';
		$result = $allo;
		$add = 'DISABLED';
		$dis = '';
		$view = '';
	break;
	case 'Edit':
		$heading = 'Edit ';
		$result = $another_allo[0];
		$add = 'DISABLED';
		$dis = 'DISABLED';
		$view = '';
	break;
	case 'Delete':
		$heading = 'Delete ';
		$result = $another_allo[0];
		$add = 'DISABLED';
		$dis = $view = 'DISABLED';
	break;
	case 'View':
		$heading = 'View ';
		$result = $another_allo[0];
		$add = 'DISABLED';
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
                      <h2><?php echo $heading; ?>Leave Allocation</h2>
                      <?php //echo '<pre>'; print_r($another_allo); echo '</pre>'; ?>
                 <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                <div class="block">
                <?php echo form_open('leave_ctr/validate_allo_leave'); ?>
                <table class="form">
                    <?php if($action != 'Add'){
						echo form_hidden('leave_allo_id',set_value('leave_allo_id',$result['leave_allo_id']));
					}?>
                    <tr>
                    <td class="col1"><?php echo form_label('Employee','Emp_id'); ?></td>
                    <td class="col2">
                    <?php $name = $result['First_name'].' '.$result['Middle_name']; ?>
                    <?php echo form_input('Emp_id',set_value('Emp_id',$name),'class="smallinput" '.$add); ?>
                    <?php echo form_hidden('Emp_id',set_value('Emp_id',$result['Emp_id'])); ?>
                    <?php echo form_error('Emp_id'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td class="col1"><?php echo form_label('Leave Type','leave_type_code'); ?></td>
                    <td class="col2">
                    <?php echo form_dropdown('leave_type_code',$lv,set_value('leave_type_code',$result['leave_type_code']),''.$dis); ?>
                    <div class="validate error">
                    <?php echo form_error('leave_type_code'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Year','year'); ?></td>
                    <td>
                   <?php  if($result['year'] == ''){$year = date('Y');}else{$year = $result['year'];}?>
                    <?php echo form_input('year',set_value('year',$year),'id="grumble" maxlength="4"'.$view);?>
                    <div class="validate error">
                    <?php echo form_error('year'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Allocate Leaves','allocated');?></td>
                    <td>
                    <?php echo form_input('allocated',set_value('allocated',$result['allocated']),'id="grumble" '.$view); ?>
                    <div class="validate error">
                    <?php echo form_error('allocated'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Units','allo_uom');?></td>
                    <td>
                  	<?php echo form_dropdown('allo_uom',$uom,set_value('allo_uom',$result['allo_uom']),'id="uom" '.$view);  ?>
                    <div class="validate error">
                    <?php echo form_error('allo_uom'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <?php if($action == 'View'){ ?>
                    <tr>
                    <td><?php echo form_label('Leaves Used','used'); ?></td>
                    <td>
                    
                    <?php echo form_input('used',set_value('used',$result['used']),'id="grumble" '.$view); echo $result['val_des']; ?>
                    </td>
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
               <?php echo form_close(); ?>
                </div>
  </div><!-- container_12 -->
