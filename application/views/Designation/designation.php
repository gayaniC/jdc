<style>
.form_holder {border:1px groove;
			padding:10px;}
</style>

<script type="text/javascript">
	jQuery(document).ready(function(){
		get_result();
		jQuery('#job_Title').keyup(function(){
			get_result();
		});
		jQuery('#des_type').change(function(){
			get_result();
		});
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/designation_search') ?>',
				type: 'post',
				data: jQuery('#myform').serializeArray(),
				success: function(msg){
					jQuery('#result').html(msg)	;
				}
			});	
		}
		jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('talent_ctr/add_desig/');?>";
	   });
	});
</script> 
<?php
	switch($action){
		case 'Add':
			$result 	= $designation;
			$heading	= 'Add';
			$dis 		= '';
			$view		= '';
		break;
		case 'Edit':
			$result 	= $designation[0];
			$heading	= 'Edit';
			$dis		= 'DISABLED';
			$view		= '';
		break;
		case 'Delete':
			$result = $designation[0];
			$heading	= 'Delete';
			$dis = $view = 'DISABLED';
		break;
		case 'View':
			$result = $designation[0];
			$heading	= 'View';
			$dis = $view = 'DISABLED';
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
            	<h2>Employee Designations</h2>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Job Title','job_Title'); ?></td>
                    <td class="col2">
					<?php echo form_input('job_Title',$this->input->get('job_Title'),'class="mini" id="job_Title"');?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Type of the Designation','des_type'); ?></td>
                    <td>
						
                        <?php $des_type = array(''=>'All','P'=>'Permanent','T'=>'Trainee'); ?>
                        <?php echo form_dropdown('des_type',$des_type,'','id="des_type"'); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                    
                </table>
                <?php echo form_close(); ?>
                </div><!--block-->
                </div>
                <div class="block">
                <div class="form_holder">
                <font color="#1B548D"><p><b><?php echo $heading; ?> Designation</b></p></font>
                 	<p id="errormsg">
						 <?php if($this->session->flashdata('msg') != ''){ 
                        echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                         } ?>
    				</p>
                	<?php echo form_open('talent_ctr/validation_desig'); ?>
                     <?php if($action != 'Add'){
						echo form_hidden('Des_code',set_value('Des_code',$result['Des_code']));	
					}?>
                    <table class="form">
                    <?php if($action != 'Add'){ ?>
                    <tr>
                    	<td class="col1">
                        <?php echo form_label('Designation Code','Des_code'); ?>
                        </td>
                        <td class="col2">
                        <?php echo form_input('Des_code',set_value('Des_code',$result['Des_code']),'class = "mini" '.$dis.' '.$view); ?>
                        <div class="validate error">
                        <?php echo form_error('Des_code'); ?>
                        </div>
                       
                        </td>
                     </tr>
                     <?php } ?>
                    <tr>
                    	<td class="col1">
                        <?php echo form_label('Designation','job_Title'); ?>
                        </td>
                        <td class="col2">
                        <?php echo form_input('job_Title',set_value('job_Title',$result['job_Title']),'class = "mini" '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('job_Title'); ?>
                    	</div>
                        </td>
                     </tr>
                     <tr>
                        <td>
                        <?php echo form_label('Designation Type','des_type'); ?>
                        </td>
                        <td>
                        <?php if($result['des_type'] == 'T'){$per=FALSE;$trn=TRUE;}else{$per=TRUE;$trn=FALSE;}?>
                        <label class="inline radio"><?php echo form_radio('des_type','P',$per,' '.$view); ?>Permanent</label>
                        <label class="inline radio"><?php echo form_radio('des_type','T',$trn,' '.$view); ?>Trainee</label>
                        <div class="validate error">
                   		<?php echo form_error('des_type'); ?>
                    	</div>
                        </td>
                      </tr>
                      <tr>
                        <td>
                        <?php echo form_label('Basic Salary','basic_Salary'); ?>
                        </td>
                        <td>
                       	Rs: <?php echo form_input('basic_Salary',set_value('basic_Salary',$result['basic_Salary']),'class = "mini" '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('basic_Salary'); ?>
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
						echo form_reset('back','New Designation','class="btn btn-blue" id="back"');
						?>
                        </td>
                        <?php } ?>
                    </tr>
                    </table>
                    <?php echo form_close(); ?>
                    </div><!-- form_holder -->
                </div><!-- block -->
                <div id="result"></div>
            </div><!-- box round first grid -->
        </div><!--grid_10-->
	</div><!-- container_12-->
