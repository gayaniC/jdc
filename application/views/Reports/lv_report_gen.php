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
            	<h2>Leave Report</h2>
                <p id="errormsg">
						 <?php if($this->session->flashdata('msg') != ''){ 
                        echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                         } ?>
    				</p>
                <div class="block">
                 <?php echo form_open('Generate/report','id="myform"'); ?>
                 <table class="form">
                 <tr>
                    <td class="col1"><?php echo form_label('Employee','Emp_id'); ?></td>
                    <td>
						<?php echo form_dropdown('Emp_id',$employee,$this->input->get('Emp_id')); ?>
                    </td>
                    <td class="col1"><?php echo form_label('Leave Type','leave_type_code'); ?></td>
                    <td>
						<?php echo form_dropdown('leave_type_code',$LeaveType,$this->input->get('leave_type_code')); ?>
                    </td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Applied Date','applied_on'); ?></td>
                    <td><?php echo form_input('from',$this->input->post('from'),'class="span1" placeholder="From" id="datepicker" ');
                    echo '&nbsp';
                    echo form_input('to',$this->input->post('to'),'class="span1" placeholder="To" id="datepicker1" ');
                     ?></td>
                    <td><?php echo form_label('Applied Month','month'); ?></td>
                    <td><?php
                    $month = array(''=>'Month',1=>'January',2=>'February',3=>'March',4=>'April',5=>'May',6=>'June',7=>'July',8=>'August',9=>'September',10=>'October',
						11=>'November',12=>'December');
                        echo form_dropdown('month',$month,$this->input->get('month'),'class="span1" placeholder="From"');
                    ?></td>
                    </tr>
                    <tr>
                    <td><?php echo form_label('Approval Status','app_status'); ?></td>
                    <td><?php 
					$app = array(''=>'All','A'=>'Approved','P'=>'Pending','R'=>'Reject','N'=>'Never');
					echo form_dropdown('app_status',$app,$this->input->get('app_status')); ?></td>
                    <td><?php echo form_label('Applied Year','year'); ?></td>
                    <td><?php  echo form_input('year',set_value('year',date('Y')),'class = "mini" '); ?></td>
                    <td></td>
                    </tr>
                    <tr>
                    <tr>
                    <td><?php echo form_label('Department','Dept_id'); ?></td>
                    <td><?php echo form_dropdown('Dept_id',$dept,$this->input->get('Dept_id')); ?></td>
                    <td><?php echo form_label('Company','comp_id'); ?></td>
                    <td><?php echo form_dropdown('comp_id',$com,$this->input->post('comp_id')); ?></td>
                    </tr>
                    <td><font color="#0000ff"><?php echo form_label('Export As','export'); ?></font></td>
                    <td><?php 
					$exp = array(''=>'Please select Export Type','X'=>'Excel','P'=>'Pdf');
					echo form_dropdown('export',$exp,$this->input->get('export')); ?></td>
                    </tr>
                    <tr>
                    <td><?php 
					echo form_hidden('report_type','Leave');
					echo form_submit('submit','Generate','class="btn btn-blue" id="submit"');
                    echo form_reset('reset','Reset','class="btn btn-blue"');
                     ?>
                    </td>
                    </tr>
                    </table>
                 <?php echo form_close(); ?>
                </div><!-- block -->
                </div><!-- form_holder -->
            </div><!-- box round first grid -->
</div><!-- grid_10 -->
</div><!-- container_12 -->