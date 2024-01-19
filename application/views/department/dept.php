<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		jQuery('#Dept_id').keyup(function(){
			get_result();
		});
		jQuery('#Dept_name').keyup(function(){
			get_result();
		});
        jQuery('#comp_id').change(function(){
           get_result(); 
        });
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/dept_search') ?>',
				type: 'post',
				data: jQuery('#myform').serializeArray(),
				success: function(msg){
					jQuery('#result').html(msg)	;
				}
			});	
		}
		jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('department_ctr/add/');?>";
	   });
	});
</script> 
<?php 
	 switch($action){
		case 'Add':
			$result 	= $dept;
			$heading	= 'Add';
			$dis 		= '';
			$view		= '';
		break;
		case 'Edit':
			$result 	= $dept[0];
			$heading	= 'Edit';
			$dis		= 'DISABLED';
			$view		= '';
		break;
		case 'Delete':
			$result 	= $dept[0];
			$heading	= 'Delete';
			$dis = $view = 'DISABLED';
		break;
		case 'View':
			$result 	= $dept[0];
			$heading	= 'View';
			$dis = $view = 'DISABLED';
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
        
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Departments</h2>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
               
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Department Code','Dept_id'); ?></td>
                    <td class="col2">
					<?php echo form_input('Dept_id',$this->input->get('Dept_id'),'class="mini" maxlength="30" id="Dept_id"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Department Name','Dept_name'); ?></td>
                    <td>
						<?php echo form_input('Dept_name',$this->input->get('Dept_name'),'class = "mini" id="Dept_name"'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Company','comp_id'); ?></td>
                    <td><?php echo form_dropdown('comp_id',$company,$this->input->get('comp_id'),'id="comp_id"'); ?></td>
                    </tr>
                    <tr>
                   
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
                    </td>
                   
                    </tr>
                    
                </table>
                <?php echo form_close(); ?>
                </div><!--block-->
                </div>
                <?php //if($this->session->userdata('user_role_id') == 'ADMIN' || $this->session->userdata('user_role_id') == 'HR' ){
                    ?>
                    <div class="block">
                <div class="form_holder">
                <font color="#1B548D"><p><b><?php echo $heading; ?> Department</b></p></font>
                 	<p id="errormsg">
						 <?php if($this->session->flashdata('msg') != ''){ 
                        echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                         } ?>
    				</p>
                	<?php echo form_open('department_ctr/validate'); ?>
                     <?php if($action != 'Add'){
						echo form_hidden('Dept_id',set_value('Dept_id',$result['Dept_id']));	
					}?>
                    <table class="form">
                    <tr>
                    	<td class="col1">
                        <?php echo form_label('Department Code','Dept_id'); ?>
                        </td>
                        <td class="col2">
                        <?php echo form_input('Dept_id',set_value('Dept_id',$result['Dept_id']),'id = "Dept_id" '.$dis.' '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('Dept_id'); ?>
                    	</div>
                        </td>
                     
                        <td>
                        <?php echo form_label('Department Name','Dept_name'); ?>
                        </td>
                        <td>
                        <?php echo form_input('Dept_name',set_value('Dept_name',$result['Dept_name']),'id = "Dept_name" '.$view.' '); ?>
                        <div class="validate error">
                   		<?php echo form_error('Dept_name'); ?>
                    	</div>
                        </td>
                      </tr>
                      
                      <tr>
                      <td>
                      <?php echo form_label('Department Description','dept_description'); ?>
                      </td>
                      <td>
                      <?php echo form_input('dept_description',set_value('dept_description',$result['dept_description']),'id="dept_description" '.$view.' '); ?>
                       <div class="validate error">
                   		<?php echo form_error('dept_description'); ?>
                    	</div>
                       </td>
                     
                    <td>
                    <?php echo form_label('Company','comp_id'); ?>
                    </td>
                    <td>
                    <?php echo form_dropdown('comp_id',$company,set_value('comp_id',$result['comp_id'])); ?>
                    <div class="validate error">
                   		<?php echo form_error('comp_id'); ?>
                    </div>
                    </td>
                    </tr>
                    
                      <tr>
                        <td>
                        <?php echo form_hidden('action',set_value('action',$action));?>
                        <?php if($action != 'View'){?>
                        <?php echo form_submit('submit',$action,'class="btn btn-blue"');?>
                        <?php echo form_reset('cancel','Cancel','class="btn btn-grey" id = "cancel"');?>
                        <?php } ?>
                        <?php if($action == 'View'){
							echo form_submit('submit','OK','class="btn btn-blue"');	
						}?>
                        </td>
                        <?php if($action != 'Add'){?>
                        <td>
                        <?php
						echo form_reset('back','New','class="btn btn-blue" id="back"');
						?>
                        </td>
                        <?php } ?>
                    </tr>
                    </table>
                    <?php echo form_close(); ?>
                    </div><!-- form_holder -->
                </div><!-- block -->
                    <?php
                //} ?>
                
                <div id="result"></div>
                
            </div><!-- box round first grid -->
        </div><!--grid_10-->
	</div><!-- container_12-->
