<script>
jQuery(document).ready(function(){
    jQuery('#dis').click(function(){
        var dep     = jQuery('#dep').val();
        var re      = jQuery('#re').val();
        var depunit = jQuery('#depunit').val();
        var reunit  = jQuery('#reunit').val();
        
        if(dep > re && depunit == 'P' && reunit == 'P'){
            alert('Please enter valid time period..');
        }
        if(dep > re && depunit == 'A' && reunit == 'A'){
            alert('Please enter valid time period..');
        }
        
         
    });
   
});
</script>
<?php
switch($action){
    case 'Edit':
    
    $heading = 'Edit ';
    $dis     = 'DISABLED';
    $view    = '';
    $result  = $gt_det[0];
    break;
    case 'Delete':
    $heading = 'Delete ';
    $dis     = 'DISABLED';
    $view    = 'DISABLED';
    $result  = $gt_det[0];
    break;
    case 'View':
    $heading = 'View ';
    $dis     = 'DISABLED';
    $view    = 'DISABLED';
    $result  = $gt_det[0];
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
            <h2><?php echo $heading; ?>Gate Pass Details</h2>
            <?php //echo '<pre>'; print_r($cus); echo '</pre>'; ?>
                <p id="errormsg">
                <?php if($this->session->flashdata('msg') != ''){ 
                echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                } ?>
                </p>
                <div class="block">
                <?php echo form_open('fuel_ctr/validate_gt_det'); ?>
                <table class="form">
                <tr>
                <td class="col1"><?php echo form_label('Gate Pass ID','gate_pass_id'); ?></td>
                <td class="col2">
                <?php echo form_input('gate_pass_id',set_value('gate_pass_id',$result['gate_pass_id']),'class="mini" '.$dis); ?>
                <?php echo form_hidden('gate_pass_id',set_value('gate_pass_id',$result['gate_pass_id'])); ?>
                </td>
                </tr>
                <tr>
                <td><?php echo form_label('Vehicle No','Vehicle_no'); ?></td>
                <td>
                <?php echo form_input('Vehicle_no',set_value('Vehicle_no',$result['Vehicle_no']),'class="mini" '.$dis); ?>
                <?php echo form_hidden('Vehicle_no',$result['Vehicle_no']); ?>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Date','Date'); ?></td>
                <td>
                <?php echo form_input('Date',set_value('Date',$result['Date']),'class="mini" '.$dis);?>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Customer','customer_name'); ?></td>
                <td>
                <?php echo form_input('customer_name',set_value('customer_name',$result['customer_name']),'class="mini" '.$dis);?>
                </td>
                </tr>
                
                <?php
                if($action != 'Edit'){
                 if($result['departure'] != ''){ ?>
                <tr>
                <td><?php echo form_label('Time Departure','departure'); ?></td>
                <td>
                <?php echo form_input('departure',set_value('departure',$result['departure']),'class="span1" '.$view);?>
                <?php echo form_dropdown('departure_unit',$dt_unit,set_value('departure_unit',$result['departure_unit']),'class="span1" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('departure'); ?>
                </div>
                </td>
                </tr>
                <?php } }else{ ?>
                <tr>
                <td><?php echo form_label('Time Departure','departure'); ?></td>
                <td>
                <?php echo form_input('departure',set_value('departure',$result['departure']),'class="span1" id="dep" '.$view);?>
                <?php echo form_dropdown('departure_unit',$dt_unit,set_value('departure_unit',$result['departure_unit']),'class="span1" id="depunit" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('departure'); ?>
                </div>
                </td>
                </tr>
                <?php } ?>
                
                <?php
                if($action != 'Edit'){
                 if($result['return'] != ''){ ?>
                <tr>
                <td><?php echo form_label('Time Return','return'); ?></td>
                <td>
                <?php echo form_input('return',set_value('return',$result['return']),'class="span1"  '.$view);?>
                <?php echo form_dropdown('return_unit',$dt_unit,set_value('return_unit',$result['return_unit']),'class="span1" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('return'); ?>
                </div>
                </td>
                </tr>
                <?php } } else{ ?>
                <tr>
                <td><?php echo form_label('Time Return','return'); ?></td>
                <td>
                <?php echo form_input('return',set_value('return',$result['return']),'class="span1" id="re" '.$view);?>
                <?php echo form_dropdown('return_unit',$dt_unit,set_value('return_unit',$result['return_unit']),'class="span1" id="reunit" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('return'); ?>
                </div>
                </td>
                </tr>
                <?php } ?>
                
                <?php
                if($action != 'Edit'){
                 if($result['distance'] != ''){ ?>
                <tr>
                <td><?php echo form_label('Distance','distance'); ?></td>
                <td>
                <?php echo form_input('distance',set_value('distance',$result['distance']),'class="span1" '.$view);?><i>km</i>
                <div class="validate error">
                <?php echo form_error('distance'); ?>
                </div>
                </td>
                </tr>
                <?php } }else{ ?>
                <tr>
                <td><?php echo form_label('Distance','distance'); ?></td>
                <td>
                <?php echo form_input('distance',set_value('distance',$result['distance']),'class="span1" id="dis" '.$view);?><i>km</i>
                <div class="validate error">
                <?php echo form_error('distance'); ?>
                </div>
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
