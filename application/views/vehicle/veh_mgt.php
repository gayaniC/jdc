
<?php 
	switch($action){
		case 'Add':
			$heading = 'Add';
			$dis = '';
			$view = '';
			$result = array('Vehicle_no'=>'','Vehicle_name'=>'','Brand'=>'','ltr_per_km'=>'','Emp_id'=>'','usage_type'=>'C');
		break;
		case 'Edit':
			$heading = 'Edit';
			$dis = 'DISABLED';
			$view = '';
			$result = $veh[0];
		break;
		case 'Delete':
			$heading = 'Delete';
			$dis = $view = 'DISABLED';
			$result = $veh[0];
		break;
		case 'View':
			$heading = 'View';
			$dis = $view = 'DISABLED';
			$result = $veh[0];
		break;
	}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {
       jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('fuel_ctr/vehicle');?>";
	   });
       
       <?php if($action == 'Add'){ ?>
	   jQuery('#pers').click(function(){
	       jQuery('#users').show('slow');
	   });
       jQuery('#com').click(function(){
            jQuery('#users').hide('slow');
       });
       jQuery('#users').hide();	
       <?php } if($action != 'Add'){ 
       if($result['usage_type'] == 'P'){
        ?>
        jQuery('#users').show();
        <?php
       }else{
        ?>
        jQuery('#users').hide();
        <?php
       }
        } ?>
        <?php if($action == 'Edit'){ ?>
        jQuery('#pers').click(function(){
	       jQuery('#users').show('slow');
	   });
       jQuery('#com').click(function(){
            jQuery('#users').hide('slow');
       });
        <?php } ?>
        
       
    });
</script>
<div class="container_12">
       <div class="grid_10">
            <ul class="nav main">
            <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
            <?php if($this->session->userdata('user_role_id') == 'ADMIN'){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/vehicle'); ?>"><span>Vehicle Details</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/customer'); ?>"><span>Maintain Customers</span></a></li>
                <?php
            } ?>
                
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/gate_pass'); ?>"><span>Generate Gate Passes</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('fuel_ctr/gate_pass_det'); ?>"><span>Gate Passe Details</span></a></li>
				
            </ul>
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            <div class="form_holder">
            <?php //echo '<pre>'; print_r($veh); echo '</pre>'; ?>
                    <h2><?php echo $heading;?> Vehicle Details </h2>
                    <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                <div class="block">
                <?php echo form_open('fuel_ctr/validate_veh');?>
               
                    <table class="form">
                    <tr>
                    <td class="col1">
                    <?php echo form_label('Vehicle No/Chassis No','Vehicle_no'); ?>
                    </td>
                    <td class="col2">
                    <?php echo form_input('Vehicle_no',set_value('Vehicle_no',$result['Vehicle_no']),'class="mini" maxlength="50" '.$dis);?>
                    <div class="validate error">
                    <?php echo form_error('Vehicle_no'); ?>
                    <?php if($action != 'Add'){
                        echo form_hidden('Vehicle_no',set_value('Vehicle_no',$result['Vehicle_no']));
                    } ?>
                    </div>
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Vehicle Name/Model','Vehicle_name');?></td>
                    <td><?php echo form_input('Vehicle_name',set_value('Vehicle_name',$result['Vehicle_name']),'class="mini" '.$view) ?>
                    <div class="validate error">
                    <?php echo form_error('Vehicle_name'); ?>
                    </div>
                    </td>
                    
                    </tr>
                    <tr>
                    <td><?php echo form_label('Brand','Brand') ?></td>
                    <td><?php echo form_input('Brand',set_value('Brand',$result['Brand']),'class="mini" '.$view); ?>
                    <div class="validate error">
                    <?php echo form_error('Brand'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Fuel usage(Liter per Kilometer)','ltr_per_km'); ?></td>
                    <td><?php echo form_input('ltr_per_km',set_value('ltr_per_km',$result['ltr_per_km']),'id="grumble" '.$view); ?>
                    <div class="validate error">
                    <?php echo form_error('ltr_per_km'); ?>
                    </div>
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Purpose of usage','usage_type'); ?></td>
                    <td><?php 
                    if($result['usage_type'] == 'C'){$com = true; $pers = false;}else{$com = false; $pers = true;}?>
                    
                    <label class="radio inline"><?php echo form_radio('usage_type','P',$pers,'id="pers" '.$view); ?>Personal</label>
                    <label class="radio inline"><?php echo form_radio('usage_type','C',$com,'id="com" '.$view); ?>Company</label>
                    <?php echo form_error('usage_type'); ?>
                    </td>
                    </tr>
                    <tr id="users">
                    <td><?php echo form_label('Vehicle users','Emp_id'); ?></td>
                    <td>
                    <?php
                   // print_r($veh); 
                    $arr = array();
                    if($action != 'Add'){
                            foreach ($veh as $val){
                            array_push($arr,$val['Emp_id']);
                            
                            }
                      
                    }
                    
                    ?>
                    <?php echo form_dropdown('Emp_id[]',$employees,set_value('Emp_id',$arr),'class="selectpicker" multiple '); ?>
                    
                    <div class="validate error">
                    	<?php echo form_error('Emp_id[]'); ?>
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
                    <a class="btn btn-grey" style="float:right;" href="javascript:void(0)" onClick="window.history.back();">
                                    <span>Back</span>
                    </a>
                    </td>
                    <?php }?>
                    <?php if($action == 'View'){?>
                    <a class="btn btn-grey" style="float:right;" href="javascript:void(0)" onClick="window.history.back();">
                                    <span>Back</span>
                    </a>
                    <?php } ?>
                    
                    </td>
                    </tr>
                    </table>
               <?php echo form_close(); ?>
        </div><!-- form_holder -->
        </div><!-- box -->
    </div><!-- grid 10 -->
</div><!-- container -->
