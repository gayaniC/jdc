<?php 
switch($action)
{
    case 'Add':
        $result = array('vacancy'=>'','Description'=>'','Edu_qualification'=>'','Prf_qualification'=>'','opening_date'=>date('Y-m-d'),'closing_date'=>'');
        $dis = '';
        $view = '';
        $heading = 'Add new ';
    break;
    case 'Edit':
        $result = $job[0];
        $dis = 'DISABLED';
        $view = '';
        $heading = 'Edit ';
    break;
    case 'Delete':
        $result = $job[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
        $heading = 'Delete ';
    break;
    case 'View':
        $result = $job[0];
        $dis = 'DISABLED';
        $view = 'DISABLED';
        $heading = 'View ';
    break;
}
?>
<script>
jQuery(document).ready(function(){
    jQuery( "#datepicker1" ).datepicker({
      			changeMonth: true,
      			changeYear: true,
                beforeShowDay: $.datepicker.noWeekends
    		});
})
</script>
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
                <?php echo form_open('talent_ctr/validate_job'); ?>
                <table class="form">
                <?php if($action != 'Add'){
                    echo form_hidden('rec_id',set_value('rec_id',$result['rec_id'])); 
                } ?>
                <tr>
                <td><?php echo form_label('Vacancy','vacancy'); ?></td>
                <td>
                <?php echo form_input('vacancy',set_value('vacancy',$result['vacancy']),'class="mini" maxlength="50" '.$view); ?>
                
                <div class="validate error">
                <?php echo form_error('vacancy'); ?>
                </div>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Opening Date','opening_date'); ?></td>
                <td>
                <?php echo form_input('opening_date',set_value('opening_date',$result['opening_date']),'class="mini" id="datepicker" '.$view);?>
                <div class="validate error">
                <?php echo form_error('opening_date'); ?>
                </div>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Closing Date','closing_date'); ?></td>
                <td>
                <?php echo form_input('closing_date',set_value('closing_date',$result['closing_date']),'class="mini" id="datepicker1" '.$view);?>
                <div class="validate error">
                <?php echo form_error('closing_date'); ?>
                </div>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Description','Description'); ?></td>
                <td>
                <?php 
                if($action == 'Add' || $action == 'Edit'){
                   $data = array(
                  'name'        => 'Description',
                  'id'          => 'Description',
                  'value'       => $result['Description'],
                  'rows'        => '5',
                  'cols'        => '50',
                  'style'       => 'width:50%'
                ); 
                }else{
                    $data = array(
                  'name'        => 'Description',
                  'id'          => 'Description',
                  'value'       => $result['Description'],
                  'rows'        => '5',
                  'cols'        => '50',
                  'style'       => 'width:50%',
                  'readonly'    => 'readonly'
                ); 
                }
                echo form_textarea($data); ?>
                <div class="validate error">
                <?php echo form_error('Description'); ?>
                </div>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Educational Qualification','Edu_qualification'); ?></td>
                <td>
                <?php echo form_input('Edu_qualification',set_value('Edu_qualification',$result['Edu_qualification']),'class="mini" maxlength="200" '.$view);?>
                <div class="validate error">
                <?php echo form_error('Edu_qualification'); ?>
                </div>
                </td>
                </tr>
                
                <tr>
                <td><?php echo form_label('Professional Qualification','Prf_qualification'); ?></td>
                <td>
                <?php echo form_input('Prf_qualification',set_value('Prf_qualification',$result['Prf_qualification']),'class="mini" maxlength="200" '.$view);?>
                <div class="validate error">
                <?php echo form_error('Prf_qualification'); ?>
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
