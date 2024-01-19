<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>

<script type="text/javascript">
	jQuery(document).ready(function() {
       jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('company_ctr');?>";
	   });
		
    });
</script>

<?php 
	switch($action){
		case 'Add':
			$heading = 'Add';
			$dis = '';
			$view = '';
			$result = $company;
		break;
		case 'Edit':
			$heading = 'Edit';
			$dis = 'DISABLED';
			$view = '';
			$result = $company[0];
		break;
		case 'Delete':
			$heading = 'Delete';
			$dis = $view = 'DISABLED';
			$result = $company[0];
		break;
		case 'View':
			$heading = 'View';
			$dis = $view = 'DISABLED';
			$result = $company[0];
		break;
	}
?>

    <div class="container_12">
        
        <div class="grid_10">
            <ul class="nav main">
            <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
            <?php if($this->session->userdata('user_role_id') == 'ADMIN'){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('company_ctr'); ?>"><span>Company Details</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('department_ctr'); ?>"><span>Department Details</span></a></li>
                <?php
            } ?>
                
                <li class="ic-form-style"><a href="<?php echo site_url('employee_ctr'); ?>"><span>Employee Details</span></a></li>
				
            </ul>
        </div>
        
            <div class="grid_10">
            <div class="box round first grid">
            <div class="form_holder">
                    <h2><?php echo $heading;?> Company Details </h2>
                    <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                <div class="block">
                <?php echo form_open('company_ctr/validate');?>
               
                    <table class="form">
                    
                    <tr>
                    <td class="col1"><?php echo form_label('Company ID','comp_id'); ?></td>
                    <td class="col2">
                    <?php if($action != 'Add'){ ?>
                    <?php echo form_hidden('comp_id',set_value('comp_id',$result['comp_id'])); ?>
                    <?php } ?>
					<?php echo form_input('comp_id',set_value('comp_id',$result['comp_id']),'class="mini" maxlength="30" '.$dis);?>
                    <div class="validate error">
                    <?php echo form_error('comp_id'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Company Name','com_name'); ?></td>
                    <td>
                    	<?php if($action != 'Add'){ ?>
                    	<?php echo form_hidden('com_name',set_value('com_name',$result['com_name'])); ?>
                   		<?php } ?>
						<?php echo form_input('com_name',set_value('com_name',$result['com_name']),'class = "mini"'.$view); ?>
                        <div class="validate error">
                    	<?php echo form_error('com_name'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Postal Code','com_postal_code'); ?></td>
                    <td>
						<?php echo form_input('com_postal_code',set_value('com_postal_code',$result['com_postal_code']),'id = "grumble"'.$view); ?>
                        <div class="validate error">
                    	<?php echo form_error('com_postal_code'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Contact Address Line 1','com_contact_Address_line1') ?></td>
                    <td>
                    	<?php echo form_input('com_contact_Address_line1',set_value('com_contact_Address_line1',$result['com_contact_Address_line1']),'class = "mini"'.$view);?>
                        <div class="validate error">
                    	<?php echo form_error('com_contact_Address_line1'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Contact Address Line 2','com_contact_Address_line2') ?></td>
                    <td>
                    	<?php echo form_input('com_contact_Address_line2',set_value('com_contact_Address_line2',$result['com_contact_Address_line2']),'class = "mini"'.$view);?>
                        <div class="validate error">
                    	<?php echo form_error('com_contact_Address_line2'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Contact Number','com_contact_no'); ?></td>
                    <td>
                    	<?php echo form_input('com_contact_no',set_value('com_contact_no',$result['com_contact_no']),'class = "mini" maxlength ="10" '.$view); ?>
                        <div class="validate error">
                    	<?php echo form_error('com_contact_no'); ?>
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
					//echo form_reset('back','Back','class="btn btn-grey" id="back"');
                    ?>
                    <a class="btn btn-grey" style="float:right;" href="javascript:void(0)" onClick="window.history.back();">
                                    <span>Back</span>
                    </a>
					
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
   