<?php
switch($action){
    case 'Add':
        $heading = 'Add ';
        $result = $hr;
        $dis = '';
        $view = '';
    break;
    case 'Edit':
        $heading = 'Edit ';
        $result = $hr[0];
        $dis = 'DISABLED';
        $view = '';
    break;
    case 'Delete':
        $heading = 'Delete ';
        $result = $hr[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
    break;
    case 'View':
        $heading = 'View ';
        $result = $hr[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
    break;
}
?>

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
                    <h2><?php echo $heading;?> HR Log </h2>
                    <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                <div class="block">
                <?php echo form_open('staff_ctr/log_validate');?>
               <?php if($action != 'Add'){ ?>
                    <?php echo form_hidden('hr_id',set_value('hr_id',$result['hr_id'])); ?>
                    <?php } ?>
                    <table class="form">
                    
                    <tr>
                    <td class="col1"><?php echo form_label('Event','event_name'); ?></td>
                    <td class="col2">
                    
					<?php echo form_input('event_name',set_value('event_name',$result['event_name']),'class="mini" maxlength="50" '.$dis);?>
                    <div class="validate error">
                    <?php echo form_error('event_name'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Actions Taken','actions_taken'); ?></td>
                    <td>
                    	<?php 
                    if($action == 'Add' || $action == 'Edit'){
                       $data = array(
                      'name'        => 'actions_taken',
                      'id'          => 'actions_taken',
                      'value'       => $result['actions_taken'],
                      'rows'        => '5',
                      'cols'        => '50',
                      'style'       => 'width:50%'
                    ); 
                    }else{
                        $data = array(
                      'name'        => 'actions_taken',
                      'id'          => 'actions_taken',
                      'value'       => $result['actions_taken'],
                      'rows'        => '5',
                      'cols'        => '50',
                      'style'       => 'width:50%',
                      'readonly'    => 'readonly'
                    ); 
                }
                echo form_textarea($data); ?>
						<div class="validate error">
                    	<?php echo form_error('actions_taken'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Date','Date'); ?></td>
                    <td>
						<?php echo form_input('Date',set_value('Date',$result['Date']),'id = "datepicker"'.$view); ?>
                        <div class="validate error">
                    	<?php echo form_error('Date'); ?>
                   		</div>
                    </td>
                    </tr>
                    
                   
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
                    <a class="btn btn-grey" style="float:right;" href="javascript:void(0)" onClick="window.history.back();">
                                    <span>Back</span>
                    </a>
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
        
        