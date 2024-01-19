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
        </div>
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Organize Events</h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open_multipart('staff_ctr/send_mail','id="myform"'); ?>
                <table class="form">
                	<tr>
                    <td class="col1"><?php echo form_label('Supervisor Name','Emp_id'); ?></td>
                    <td class="col2">
					<?php echo form_dropdown('Emp_id',$employees,set_value('Emp_id'),''); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Event','Event'); ?></td>
                    <td><?php echo form_input('Event',set_value('Event'),'class="mini"'); ?></td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Event Description','Description'); ?></td>
                    <td>
						<?php 
                        $data = array(
                      'name'        => 'Description',
                      'id'          => 'Description',
                      'rows'        => '5',
                      'cols'        => '50',
                      'style'       => 'width:50%'
                    ); 
                        echo form_textarea($data); ?>
                    </td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Attachments','att'); ?></td>
                    <td><?php echo form_upload('att1'); ?>
                        </td>
                    </tr>
                    <tr>
                    <td>
					<?php echo form_submit('submit','Send','class="btn btn-blue"'); ?>
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
                <div id="result"></div>
            </div><!-- box round first grid -->
        </div><!--grid_10-->
	</div><!-- container_12-->