<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>
<script type="text/javascript">
	jQuery(document).ready(function() {
       jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('user_ctr');?>";
	   });
       <?php if($action == 'Add'){ ?>
       get_result();
       jQuery('#Emp_id').change(function(e){
        e.preventDefault();
            get_result();
       });
       function get_result()
       {
        jQuery.ajax({
            url:'<?php echo site_url('search/get_email') ?>',
            type:'post',
            data:jQuery('#Emp_id').serializeArray(),
            success:function(msg){
                jQuery('#email').val(msg);
            }
        });
       }
       <?php } ?>
    });
</script>

<?php 
	switch($action){
		case 'Add':
			$heading = 'Add';
			$dis = '';
			$view = '';
			$result = $user;
		break;
		case 'Edit':
			$heading = 'Edit';
			$dis = 'DISABLED';
			$view = '';
			$result = $user[0];
		break;
		case 'Delete':
			$heading = 'Delete';
			$dis = $view = 'DISABLED';
			$result = $user[0];
		break;
		case 'View':
			$heading = 'View';
			$dis = $view = 'DISABLED';
			$result = $user[0];
		break;
	}
?>
 <div class="container_12">
 	<div class="grid_10">
            <ul class="nav main">
             <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
            </ul>
        </div><!--grid_10-->
         <div class="grid_10">
            <div class="box round first grid">
            <div class="form_holder">
            <h2><?php echo $heading;?> User</h2>
            <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
             <div class="block">
              <?php echo form_open('user_ctr/validate');?>
              <?php if($action != 'Add'){
				 echo form_hidden('id',set_value('id',$result['id'])); 
                 //echo '<pre>'; print_r($user); echo '</pre>';
			  }?>
             <table class="form">
                    <?php if($action == 'Add'){ ?>
                    <tr>
                    <td class="col1"><?php echo form_label('Employee Name','Emp_id'); ?></td>
                    <td class="col2">
                   <?php echo form_dropdown('Emp_id',$emp,set_value('Emp_id',$result['Emp_id']),'id="Emp_id" '.$dis);?>
                   <div class="validate error">
                    <?php echo form_error('Emp_id'); ?>
                    </div>
                    </td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td><?php echo form_label('User Role','user_role_id'); ?></td>
                    <td>
                    <?php echo form_dropdown('user_role_id',$userRole,set_value('user_role_id',$result['user_role_id']),'id="user_role_id" '.$view); ?>
                    <div class="validate error">
                    <?php echo form_error('user_role_id'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo  form_label('Username','username') ?></td>
                    <td>
                    <?php echo form_input('username',set_value('username',$result['username']),'class="mini" '.$view); ?>
                    <div class="validate error">
                    <?php echo form_error('username'); ?>
                    </div>
                    </td>
                    </tr>
                   <?php if($action != 'View'){ ?> 
                    <tr>
                    <td><?php echo form_label('Password','password'); ?></td>
                    <td>
                    <?php echo form_password('password',set_value('password'),'class="mini"'); ?>
                    <div class="validate error">
                    <?php echo form_error('password'); ?>
                    </div>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Confirm Password','password_confirm'); ?></td>
                    <td>
                    <?php echo form_password('password_confirm',set_value('password_confirm'),'class="mini" '); ?>
                    <div class="validate error">
                    <?php echo form_error('password_confirm'); ?>
                    </div>
                    </td>
                    </tr>
                    <?php } ?>
                    <tr>
                    <td><?php echo form_label('Email','user_email'); ?></td>
                    <td>
                    <?php echo form_input('user_email',set_value('user_email',$result['user_email']),'class="mini" id="email" '.$dis); ?>
                    <?php if($action != 'Add'){
                        echo form_hidden('user_email',$result['user_email']);
                    } ?>
                    <div class="validate error">
                    <?php echo form_error('user_email'); ?>
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
             </div><!-- block -->
                    
            </div><!-- form_holder -->
            </div><!-- box -->
            </div><!-- grid_10 -->
 </div><!-- container_12 -->