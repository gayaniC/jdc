<?php 
switch($action)
{
    
    case 'Edit':
        $result = $resig[0];
        $dis = 'DISABLED';
        $view = '';
        $heading = 'Edit ';
    break;
   
    case 'View':
        $result = $resig[0];
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
            <?php if($this->session->userdata('user_role_id') == 'ADMIN' ||$this->session->userdata('user_role_id') == 'DVP' ){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('talent_ctr/designation'); ?>"><span>Maintain Designations</span></a></li>
                
                <?php
            } ?>
                
                <li class="ic-form-style"><a href="<?php echo site_url('talent_ctr/recruitment'); ?>"><span>Recruitment</span></a></li>
                
                <li class="ic-form-style"><a href="<?php echo site_url('talent_ctr/resign'); ?>"><span>Resignations</span></a></li>
              
				
            </ul>
    </div>
<div class="grid_10">
            <div class="box round first grid">
            <div class="form_holder">
            <h2><?php echo $heading; ?>Vacancy</h2>
            <?php //echo '<pre>'; print_r($job); echo '</pre>'; ?>
                <p id="errormsg">
                <?php if($this->session->flashdata('msg') != ''){ 
                echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                } ?>
                </p>
                <div class="block">
                <?php echo form_open('talent_ctr/validate_resign'); ?>
                <table class="form">
                <?php 
                    echo form_hidden('id',set_value('id',$result['id'])); 
                 ?>
               
                <tr>
                <td class="col1"><?php echo form_label('Employee','Emp_id'); ?></td>
                <td>
                <?php 
               
                echo form_dropdown('Emp_id',$employee,set_value('Emp_id',$result['Emp_id']),'class="mini" '.$dis);?>
                
                </td>
                </tr>
                
                <tr>
                <td class="col1"><?php echo form_label('Resign Date','resign_date'); ?></td>
                <td>
                <?php 
                if($result['resign_date'] == '0000-00-00'){
                    $resign_date = '';
                }else{
                    $resign_date = $result['resign_date'];
                }
                echo form_input('resign_date',set_value('resign_date',$resign_date),'class="mini" id="datepicker" '.$view);?>
                <div class="validate error">
                <?php echo form_error('resign_date'); ?>
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
