<?php 
switch($action)
{
    case 'Add':
        $result = array('cus_id'=>'','customer_name'=>'','contactAddress'=>'','Contact_no'=>'');
        $dis = '';
        $view = '';
        $heading = 'Add new ';
    break;
    case 'Edit':
        $result = $cus[0];
        $dis = 'DISABLED';
        $view = '';
        $heading = 'Edit ';
    break;
    case 'Delete':
        $result = $cus[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
        $heading = 'Delete ';
    break;
    case 'View':
        $result = $cus[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
        $heading = 'View ';
    break;
}
?>
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
            <h2><?php echo $heading; ?>Customer</h2>
            <?php //echo '<pre>'; print_r($cus); echo '</pre>'; ?>
                <p id="errormsg">
                <?php if($this->session->flashdata('msg') != ''){ 
                echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                } ?>
                </p>
                <div class="block">
                <?php echo form_open('fuel_ctr/validate_cus'); ?>
                <table class="form">
                <tr>
                <td><?php echo form_label('Customer ID','cus_id'); ?></td>
                <td>
                <?php echo form_input('cus_id',set_value('cus_id',$result['cus_id']),'class="mini" maxlength="20" '.$dis); ?>
                <?php if($action != 'Add'){echo form_hidden('cus_id',set_value('cus_id',$result['cus_id']));} ?>
                <div class="validate error">
                <?php echo form_error('cus_id'); ?>
                </div>
                </td>
                </tr>
                <tr>
                <td><?php echo form_label('Name','customer_name'); ?></td>
                <td>
                <?php echo form_input('customer_name',set_value('customer_name',$result['customer_name']),'class="mini" maxlength="50" '.$view) ?>
                <div class="validate error">
                <?php echo form_error('customer_name'); ?>
                </div>
                </td>
                </tr>
                <tr>
                <td><?php echo form_label('Address','contactAddress'); ?></td>
                <td>
                <?php 
                if($action == 'Add' || $action == 'Edit'){
                   $data = array(
                  'name'        => 'contactAddress',
                  'id'          => 'contactAddress',
                  'value'       => $result['contactAddress'],
                  'rows'        => '5',
                  'cols'        => '50',
                  'style'       => 'width:50%'
                ); 
                }else{
                    $data = array(
                  'name'        => 'contactAddress',
                  'id'          => 'contactAddress',
                  'value'       => $result['contactAddress'],
                  'rows'        => '5',
                  'cols'        => '50',
                  'style'       => 'width:50%',
                  'readonly'    => 'readonly'
                ); 
                }
                
               //$options = array('name'=>'contactAddress','value'=>$result['contactAddress'],'rows'=>'10','cols' => '40',);
                echo form_textarea($data); ?>
                <div class="validate error">
                <?php echo form_error('contactAddress'); ?>
                </div>
                </td>
                </tr>
                <tr>
                <td><?php echo form_label('Contact No','Contact_no'); ?></td>
                <td>
                <?php echo form_input('Contact_no',set_value('Contact_no',$result['Contact_no']),'class="mini" maxlength="10" '.$view);?>
                <div class="validate error">
                <?php echo form_error('Contact_no'); ?>
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
            </div>
            </div>
    </div>
</div>
    
</div>
</div>
