<?php 
switch($action)
{
    case 'Add':
        $result = $idea;
        $dis = '';
        $view = '';
        $heading = 'Add new ';
    break;
    case 'Edit':
        $result = $idea[0];
        $dis = 'DISABLED';
        $view = '';
        $heading = 'Edit ';
    break;
    case 'Delete':
        $result = $idea[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
        $heading = 'Delete ';
    break;
    case 'View':
        $result = $idea[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
        $heading = 'View ';
    break;
    case 'Submit':
        $result = $idea[0];
        $dis = 'DISABLED';
        $view = '';
        $heading = 'Approve ';
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
            <h2><?php echo $heading; ?>Suggestion</h2>
            <?php //echo '<pre>'; print_r($cus); echo '</pre>'; ?>
                <p id="errormsg">
                <?php if($this->session->flashdata('msg') != ''){ 
                echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                } ?>
                </p>
                <div class="block">
                <?php echo form_open('talent_ctr/validate_idea'); ?>
                <?php if($action != 'Add'){echo form_hidden('id',set_value('id',$result['id']));} ?>
                <?php echo form_hidden('inq_idea_status',set_value('inq_idea_status','I')); ?>
                <table class="form">
                <tr>
                <td><?php echo form_label('Suggestion','idea_inq'); ?></td>
                <td>
                <?php echo form_input('idea_inq',set_value('idea_inq',$result['idea_inq']),'class="mini" maxlength="50" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('idea_inq'); ?>
                </div>
                </td>
                </tr>
                <tr>
                <td><?php echo form_label('Suggestion in detail','details'); ?></td>
                <td>
						<?php 
                        $data = array(
                      'name'        => 'details',
                      'id'          => 'details',
                      'value'       => $result['details'],
                      'rows'        => '5',
                      'cols'        => '50',
                      'style'       => 'width:50%'
                    ); 
                        echo form_textarea($data); ?>
      
                <div class="validate error">
                <?php echo form_error('details'); ?>
                </div>
                </td>
                </tr>
                
                <?php if($action == 'Submit' || $action == 'View'){
                echo form_hidden('app_date',set_value('app_date',date('Y-m-d')));    
                ?>
                <tr>
                <td><?php echo form_label('Feedback of management','feedbck_sup'); ?></td>
                <td>
                <?php echo form_input('feedbck_sup',set_value('feedbck_sup',$result['feedbck_sup']),'class="mini" maxlength="50" '.$view);?>
                <div class="validate error">
                <?php //echo form_error('feedbck_sup'); ?>
                </div>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Approval Status','app_status'); ?></td>
                <td><?php 
                if($result['app_status'] == 'N'){$app = FALSE;$rej = FALSE;}
                if($result['app_status'] == 'A'){$app = TRUE; $rej = FALSE;}
                if($result['app_status'] == 'R'){$app = FALSE; $rej = TRUE;}
                ?>
                <label class="radio inline">
                <?php
                echo form_radio('app_status','A',$app,$view); ?>Approve
                </label>
                <label class="radio inline">
                <?php echo form_radio('app_status','R',$rej,$view); ?>Reject
                </label>
                <div class="validate error">
                <?php echo form_error('app_status'); ?>
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
