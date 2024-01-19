<script>
jQuery(document).ready(function(){
   jQuery( "#datepicker1" ).datepicker({
      			changeMonth: true,
      			changeYear: true,
                beforeShowDay: $.datepicker.noWeekends
    		}); 
});
</script>
<div class="container_12">
<div class="grid_10">
            <ul class="nav main">
             <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
             
                <li class="ic-form-style"><a href="<?php echo site_url('report_ctr/attendance_report'); ?>"><span>Attendence Report</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('report_ctr/employee_report'); ?>"><span>Employee Details Report</span></a></li>
               
				<li class="ic-form-style"><a href="<?php echo site_url('report_ctr/fuel_consump_report'); ?>"><span>Fuel Consumption Report</span></a></li>
                
                <li class="ic-form-style"><a href="<?php echo site_url('report_ctr/leave_report'); ?>"><span>Leave Report</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('report_ctr/progress_report'); ?>"><span>Progress Report</span></a></li> 
                <li class="ic-form-style"><a href="<?php echo site_url('report_ctr/salary_report'); ?>"><span>Salary Details Report</span></a></li>   
				
            </ul>
        </div>
<div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Salary Details Report</h2>
                <p id="errormsg">
						 <?php if($this->session->flashdata('msg') != ''){ 
                        echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                         } ?>
    				</p>
                <div class="block">
                 <?php echo form_open('Generate/report','id="myform"'); ?>
                 <table class="form">
                 
                    <tr>
                    <td class="col1"><?php echo form_label('Department','Dept_id'); ?></td>
                    <td><?php echo form_dropdown('Dept_id',$dept,$this->input->get('Dept_id')); ?></td>
                    <td><?php echo form_label('Company','comp_id'); ?></td>
                    <td><?php echo form_dropdown('comp_id',$com,$this->input->post('comp_id')); ?></td>
                    </tr>
                    
                    <tr>
                    <td><?php echo form_label('Salary','basic_Salary'); ?></td>
                    <td><?php echo form_input('basic_Salary',$this->input->get('basic_Salary'),'class="smallinput"'); ?></td>
                    <td><?php echo form_label('Type of Designation','des_type'); ?></td>
                    <td><?php 
                    $type = array(''=>'All','P'=>'Permanent','T'=>'Trainee');
                    echo form_dropdown('des_type',$type,$this->input->get('des_type')); ?></td>
                    </tr>
                    
                    <tr>
                   
                    <td><font color="#0000ff"><?php echo form_label('Export As','export'); ?></font></td>
                    <td><?php 
					$exp = array(''=>'Please select Export Type','X'=>'Excel','P'=>'Pdf');
					echo form_dropdown('export',$exp,$this->input->get('export')); ?></td>
                    </tr>
                    <tr>
                    <td><?php 
					echo form_hidden('report_type','Salary');
					echo form_submit('submit','Generate','class="btn btn-blue" id="submit"');
                    echo form_reset('reset','Reset','class="btn btn-blue"');
                     ?>
                    </td>
                    </tr>
                 </table>
                 <?php echo form_close(); ?>
                </div><!-- block -->
                
                </div><!-- form_holder-->
        </div><!-- box -->
</div><!-- grid10 -->
</div><!-- con12-->