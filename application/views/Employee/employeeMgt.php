<style type="text/css">
.form_holder 
{border:1px groove;
padding:10px;}
</style>

<?php

switch($action){
	case 'Add'	:
		$result = $employee;
		$heading = 'Add New';
		$dis = '';
		$view = '';
		$dayy = '';
		$monthh = '';
		$year = '';
	break;
	case 'Edit':
		$result = $employee[0];
		$heading = 'Edit an';
		$dis = 'DISABLED';
		$view = '';
	break;
	case 'Delete':
		$result = $employee[0];
		$heading = 'Delete an';
		$dis = $view = 'DISABLED';
	break;
	case 'View':
		$result = $employee[0];
		$heading = 'View an';
		$dis = $view = 'DISABLED';
	break;
}
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('employee_ctr');?>";
	});
	jQuery('#month').click(function(){
		jQuery('#exp_type').html('Months');
	});
	jQuery('#year').click(function(){
		jQuery('#exp_type').html('Years');
	});
	jQuery('#name').click(function(){
		var from = jQuery('.from').val();
		var to = jQuery('.to').val();
		if(new Date(from) > new Date(to)){
			alert('Please select date for To less than From');
		}
	});
	jQuery('#company_name').click(function(){
		
		
		var app = jQuery('.AppointmentDate').val();
		 var resig = jQuery('.resign_date').val();
		 //alert(new Date(resig));
		 if(new Date(app) > new Date(resig)){
			 alert('Please Select Resign Date greater than Appointment Date');
		 }
	});
	jQuery('#Qualification').click(function(){
		var pre_resign_date = new Date(jQuery('.pre_resign_date').val());
		var join_date		= new Date(jQuery('.join_date').val());
		if(new Date(pre_resign_date) < new Date(join_date)){
			alert('Please select Resign Date greater than Join Date');
		}
		
	}); 
	
		jQuery('.AppointmentDate').click(function()
		{
			alert(jQuery('#datpicker1').val());
		});
		jQuery('#exp_type').html('Years');
		jQuery( "#datepicker1" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});
			jQuery( "#datepicker2" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});
			jQuery( "#datepicker3" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});
			jQuery( "#datepicker4" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});
			jQuery( "#datepicker5" ).datepicker({
      			changeMonth: true,
      			changeYear: true
    		});
			
});
</script>

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
    		
            <h2><?php echo $heading; ?> Employee</h2>
            <p id="errormsg">
						 <?php if($this->session->flashdata('msg') != ''){ 
                        echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                         } ?>
    		</p>
            <br/>
            <?php echo form_open_multipart('employee_ctr/validate'); ?>
            
            <?php if($action != 'Add'){ ?>
            <p align="center"><u><b><?php echo form_label('Employee ID','Emp_id'); ?></b></u>
            <?php echo form_input('Emp_id',set_value('Emp_id',$result['Emp_id']),''.$view.' '.$dis); ?>
            <div class="validate error">
                <?php echo form_error('Emp_id'); ?>
            </div>
            <?php echo form_hidden('Emp_id',set_value('Emp_id',$result['Emp_id'])); ?>
            <?php echo form_hidden('NIC',set_value('NIC',$result['NIC'])); ?>
            <?php echo form_hidden('Emp_mail',set_value('Emp_mail',$result['Emp_mail'])); ?>
            </p>
            <?php } ?>
            
        	<div class="form_holder">
            <font color="#1B548D"><p><b><u>Personal Details</u></b></p></font>
            <?php if($action != 'Add'){
				echo form_hidden('Emp_id',set_value('Emp_id',$result['Emp_id']));	
			}?>
            <?php
			if($action == 'Delete'){
				echo form_hidden('photo',set_value('photo',$result['photo']));	
			}
			 ?>
            <?php if($action != 'Add' && $result['photo'] != ''){ ?>
            <p><img src="<?php echo site_url(); ?>/uploads/Employee/<?php echo $result['photo']; ?>" width="150" height="100"/></p>
            <?php } ?>
            <table class="form">
                    <tr>
                    	<td>
                        <?php echo form_label('Title','title'); ?>
                        </td>
                        <td>
                        <?php $title = array(''=>'Title','Mr'=>'Mr','Mrs'=>'Mrs','Miss'=>'Miss'); ?>
                        <?php echo form_dropdown('title',$title,set_value('title',$result['title']),'class="span1" '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('title'); ?>
                    	</div>
                        </td>
                        <td>
                        <?php echo form_label('Postal Code','postal_code'); ?>
                        </td>
                        <td>
                        <?php echo form_input('postal_code',set_value('postal_code',$result['postal_code']),'class = "mini" '.$view);?>
                        <div class="validate error">
                   		<?php echo form_error('postal_code'); ?>
                    	</div>
                        </td>
                     </tr>
                     <tr>
                     	<td>
                        <?php echo form_label('Firstname','First_name'); ?>
                        </td>
                        <td>
                        <?php echo form_input('First_name',set_value('First_name',$result['First_name']),''.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('First_name'); ?>
                    	</div>
                        </td>
                        <td>
                        <?php echo form_label('Contact Address Line 1','Contact_Address_line1'); ?>
                        </td>
                        <td>
                        <?php echo form_input('Contact_Address_line1',set_value('Contact_Address_line1',$result['Contact_Address_line1']),''.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('Contact_Address_line1'); ?>
                    	</div>
                        </td>
                     </tr>
                     <tr>
                     	<td>
                        <?php echo form_label('Middle Name','Middle_name'); ?>
                        </td>
                        <td>
                        <?php echo form_input('Middle_name',set_value('Middle_name',$result['Middle_name']),''.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('Middle_name'); ?>
                    	</div>
                        </td>
                       <td>
                        <?php echo form_label('Contact Address Line 2','Contact_Address_line2'); ?>
                        </td>
                        <td>
                        <?php echo form_input('Contact_Address_line2',set_value('Contact_Address_line2',$result['Contact_Address_line2']),''.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('Contact_Address_line2'); ?>
                    	</div>
                        </td>
                     </tr>
                     <tr>
                     	<td>
                        <?php echo form_label('Surname','surname'); ?>
                        </td>
                        <td>
                        <?php echo form_input('surname',set_value('surname',$result['surname']),''.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('surname'); ?>
                    	</div>
                        </td>
                        <td>
                        <?php echo form_label('Contact Number','Contact_no'); ?>
                        </td>
                        <td>
                        <?php echo form_input('Contact_no',set_value('Contact_no',$result['Contact_no']),'maxlength="10" '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('Contact_no'); ?>
                    	</div>
                        </td>
                     </tr>
                     <tr>
                     	<td>
                        <?php echo form_label('National Identity Card(NIC)','NIC'); ?>
                        </td>
                        <td>
                        <?php echo form_input('NIC',set_value('NIC',$result['NIC']),'maxlength="10" '.$dis.' '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('NIC'); ?>
                    	</div>
                        </td>
                        <td>
                        <?php echo form_label('Email','Emp_mail'); ?>
                        </td>
                        <td>
                        <?php echo form_input('Emp_mail',set_value('Emp_mail',$result['Emp_mail']),' '.$dis.' '.$view); ?>
                        <div class="validate error">
                   		<?php echo form_error('Emp_mail'); ?>
                    	</div>
                        </td>
                     </tr>
                     <tr>
                     	<td>
                        <?php echo form_label('Date of Birth','DOB'); ?>
                        </td>
                        <td>
                        <?php $day = array(''=>'Day',1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12,13=>13,14=>14,15=>15,16=>16,17=>17,
						18=>18,19=>19,20=>20,21=>21,22=>22,23=>23,24=>24,25=>25,26=>26,27=>27,28=>28,29=>29,30=>30,31=>31);
						$month = array(''=>'Month',01=>'January',02=>'February',03=>'March',04=>'April',05=>'May',06=>'June',07=>'July',08=>'August',09=>'September',10=>'October',
						11=>'November',12=>'December');
						if($action != 'Add'){
							$date = explode('-', $result['DOB']);
							$year =  $date[0];
							$monthh   = $date[1];
							$dayy  = $date[2];
						}
						 ?>
                        <?php echo form_dropdown('day',$day,set_value('day',$dayy),'class="span1" '.$view);
							  echo form_dropdown('month',$month,set_value('month',$monthh),'class="span1" '.$view);
							  echo form_input('year',set_value('year',$year),'class = "mini" maxlength="4" '.$view);
						 ?>
                        <div class="validate error">
                   		<?php echo form_error('day'); ?>
                        <?php echo form_error('month'); ?>
                        <?php echo form_error('year'); ?>
                    	</div>
                        </td>
                        <td>
                        <?php echo form_label('Photo','photo'); ?>
                        </td>
                        <td>
                        <?php echo form_upload('photo'); ?>
                        <i>optional Note: Allow file tyes are jpg|jpeg|png|gif</i>
                        </td>
                     </tr>
                     <tr>
                     	<td>
                        <?php echo form_label('Religion','religion'); ?>
                        </td>
                        <td>
                        <?php echo form_input('religion',set_value('religion',$result['religion']),''.$view); ?>
                         <div class="validate error">
                   		<?php echo form_error('religion'); ?>
                    	</div>
                        </td>
                        <td>
                        <?php echo form_label('Distance(Home to Office)','Distance');?>
                        </td>
                        <td>
                        <?php echo form_input('Distance',set_value('Distance',$result['Distance']),'class="mini" '.$view); ?> Km
                        <div class="validate error">
                        <?php echo form_error('Distance'); ?>
                        </div>
                        </td>
                     </tr>
                     <tr>
                     	<td>
                        <?php echo form_label('Marital Status','marital_status'); ?>
                        </td>
                        <td>
                        <?php if($result['marital_status'] == 0){$sin=TRUE;$mar=FALSE;}else{$sin=FALSE;$mar=TRUE;} ?>
                        <label class="radio inline">
                        <?php echo form_radio('marital_status',0,$sin,$view); ?>Single
                        </label>
                        
                        <label class="radio inline">
                        <?php echo form_radio('marital_status',1,$mar,$view); ?>Married
                        </label>
                        
                        <div class="validate error">
                        <?php echo form_error('marital_status'); ?>
                        </div>
                        </td>
                     	<td>
                        <?php echo form_label('Nationality','nationality'); ?>
                        </td>
                        <td>
                        <?php echo form_input('nationality',set_value('nationality',$result['nationality']),''.$view); ?>
                        <div class="validate error">
                        <?php echo form_error('nationality'); ?>
                        </div>
                        </td>
                     </tr>
                    
                     </table>
            </div><!-- form_holder -->
            <br/>
            <div class="form_holder">
            <font color="#1B548D"><p><b><u>Employee Profile</u></b></p></font>
            <table class="form">
            <tr>
            	<td>
                <?php echo form_label('Appointment Date','AppointmentDate'); ?>
                </td>
                <td>
                <?php // echo form_input('AppointmentDate',set_value('AppointmentDate',$result['AppointmentDate']),'id="datepicker" class="AppointmentDate" '.$view);?>
                <input type="text" id="datepicker" value="<?php echo $result['AppointmentDate'] ?>" name="AppointmentDate"/>
                <div class="validate error">
                <?php echo form_error('AppointmentDate'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Department','Dept_id'); ?>
                </td>
                <td>
                <?php //$dept = array(''=>'Please select a value','1'=>'IT');?>
                <?php echo form_dropdown('Dept_id',$dept,set_value('Dept_id',$result['Dept_id']),''.$view); ?>
                <div class="validate error">
                <?php echo form_error('Dept_id'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('EPF Number','EPF_no'); ?>
                </td>
                <td>
                <?php echo form_input('EPF_no',set_value('EPF_no',$result['EPF_no']),''.$view); ?>
                <div class="validate error">
                <?php echo form_error('EPF_no'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Designation','Des_code'); ?>
                </td>
                <td>
                <?php
				//$desig = array(''=>'Please select a value','1'=>'Trainee');
				echo form_dropdown('Des_code',$desig,set_value('Des_code',$result['Des_code']),''.$view);
				 ?>
                <div class="validate error">
                <?php echo form_error('Des_code'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Account Number','Account_No'); ?>
                </td>
                <td>
                <?php echo form_input('Account_No',set_value('Account_No',$result['Account_No']),''.$view); ?>
                <div class="validate error">
                <?php echo form_error('Account_No'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Bank','bank_id')?>
                </td>
                <td>
                <?php 
				//$bank = array(''=>'Please Select a value','1'=>'HNB');
				echo form_dropdown('bank_id',$bank,set_value('bank_id',$result['bank_id']),''.$view);
				?>
                <div class="validate error">
                <?php echo form_error('bank_id'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Resign Date','resign_date'); ?>
                </td>
                <td>
                <?php echo form_input('resign_date',set_value('resign_date',$result['resign_date']),'id="datepicker1" class="resign_date" '.$view);?>
                <div class="validate error">
                <?php echo form_error('resign_date'); ?>
                </div>
                </td>
            </tr>
            </table>
            </div><!-- second form_holder-->
            <br/>
            <div class="form_holder">
            <font color="#1B548D"><p><b><u>Work Experience</u></b></p></font>
            <p><i>Please enter Last Employment details</i></p>
            <table class="form">
            <tr>
            	<td class="col1">
                <?php echo form_label('Name of the Employer','company_name'); ?>
                </td>
                <td>
                <?php echo form_input('company_name',set_value('company_name',$result['company_name']),' id="company_name" '.$view); ?>
                 <div class="validate error">
                <?php echo form_error('company_name'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Position','position_held');?>
                </td>
                <td>
                <?php echo form_input('position_held',set_value('position_held',$result['position_held']),''.$view); ?>
                 <div class="validate error">
                <?php echo form_error('position_held'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Resigned Date','pre_resign_date');?>
                </td>
                <td>
                <?php echo form_input('pre_resign_date',set_value('pre_resign_date',$result['pre_resign_date']),'id="datepicker2" class="pre_resign_date" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('pre_resign_date'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Joined Date','join_date');?>
                </td>
                <td>
                <?php echo form_input('join_date',set_value('join_date',$result['join_date']),'id="datepicker3" class="join_date" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('join_date'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Years/Months','exp_type');?>
                </td>
                <td>
                <?php if($result['exp_type'] == 'm'){ $mon=TRUE; $yr=FALSE;} else {$mon=FALSE; $yr=TRUE;}?>
                <label class="radio inline">
                <?php echo form_radio('exp_type','m',$mon,'id="month" '.$view); ?>Months
                </label>
                <label class="radio inline">
                <?php echo form_radio('exp_type','y',$yr,'id="year" '.$view); ?>Years
                </label>
                
              
                <div class="validate error">
                <?php echo form_error('exp_type'); ?>
                </div>
                </td>
                
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Reason to Leave','reason_to_leave');?>
                </td>
                <td>
                <?php echo form_input('reason_to_leave',set_value('reason_to_leave',$result['reason_to_leave']),''.$view);?>
                <div class="validate error">
                <?php echo form_error('reason_to_leave'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Total Experience','total_experience'); ?>
                </td>
                <td>
                <?php echo form_input('total_experience',set_value('total_experience',$result['total_experience']),'class ="mini" '.$view);?> <span id='exp_type'></span>
                <div class="validate error">
                <?php echo form_error('total_experience'); ?>
                </div>
                </td>
            </tr>
            </table>
            </div><!-- third form-holder -->
            <br/>
            <div class="form_holder">
            <font color="#1B548D"><p><b><u>Educational Qualifications</u></b></p></font>
            <p><i>Please enter your highest educational qualification</i></p>
            <table class="form">
            <tr>
            	<td class="col1">
                <?php echo form_label('Qualification','Qualification'); ?>
                </td>
                <td>
                <?php echo form_input('Qualification',set_value('Qualification',$result['Qualification']),' id="Qualification" '.$view);?>
                <div class="validate error">
                <?php echo form_error('Qualification'); ?>
                </div>
                </td>
                
            </tr>
            <tr>
            	<td class="col1">
                <?php  echo form_label('School/Institute/College','Institute');?>
                </td>
                <td>
                <?php echo form_input('Institute',set_value('Institute',$result['Institute']),''.$view); ?>
                <div class="validate error">
                <?php echo form_error('Institute'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Level','Level'); ?>
                </td>
                <td>
                <?php 
				if($result['Level'] == 0){$pr=TRUE; $sec=FALSE;}else{$pr=FALSE; $sec=TRUE;}
				?>
                <label class="radio inline">
                <?php echo form_radio('Level',0,$pr,$view); ?>Primary
                </label>
                <label class="radio inline">
                <?php echo form_radio('Level',1,$sec,$view); ?>Secondary
                </label>
                
                
                <div class="validate error">
                <?php echo form_error('Level'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('From','from'); ?>
                </td>
                <td>
                <?php echo form_input('from',set_value('join_date',$result['join_date']),'id="datepicker4" class="from" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('from'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('To','to');?>
                </td>
                <td>
                <?php echo form_input('to',set_value('to',$result['to']),'id="datepicker5" class="to" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('to'); ?>
                </div>
                </td>
            </tr>
            </table>
            </div><!-- fourth form-holder -->
            <br/>
            <div class="form_holder">
            <font color="#1B548D"><p><b><u>Family Details</u></b></p></font>
            <table class="form">
            <tr>
                <td class="col1">
                <?php echo form_label('Name','name'); ?>
                </td>
                <td>
                <?php echo form_input('name',set_value('name',$result['name']),'id="name" '.$view); ?>
                 <div class="validate error">
                <?php echo form_error('name'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Relationship to you','relationship'); ?>
                </td>
                <td>
                <?php echo form_input('relationship',set_value('relationship',$result['relationship']),''.$view); ?>
                <div class="validate error">
                <?php echo form_error('relationship'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Age','Age'); ?>
                </td>
                <td>
                <?php echo form_input('Age',set_value('Age',$result['Age']),''.$view); ?>
                <div class="validate error">
                <?php echo form_error('Age'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('National Identity Card(NIC)','NIC_f_fam_member'); ?>
                </td>
                <td>
                <?php echo form_input('NIC_f_fam_member',set_value('NIC_f_fam_member',$result['NIC_f_fam_member']),'maxlength="10" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('NIC_f_fam_member'); ?>
                </div>
                </td>
            </tr>
            <tr>
            	<td>
                <?php echo form_label('Occupation','occupation'); ?>
                </td>
                <td>
                <?php echo form_input('occupation',set_value('occupation',$result['occupation']),''.$view); ?>
                <div class="validate error">
                <?php echo form_error('occupation'); ?>
                </div>
                </td>
                <td>
                <?php echo form_label('Contact Number','contact_no') ?>
                </td>
                <td>
                <?php echo form_input('contact_no',set_value('contact_no',$result['contact_no']),'maxlength="10" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('contact_no'); ?>
                </div>
                </td>
            </tr>
            </table>
            </div><!-- fifth form-holder -->
            <br/>
            <p align="center">
             <?php echo form_hidden('action',$action); ?>
             <?php if($action != 'View'){ ?>
            <?php echo form_submit('submit',$action,'class="btn btn-blue"'); ?>
            <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
            <a class="btn btn-grey" style="float:right;" href="javascript:void(0)" onClick="window.history.back();">
                                    <span>Back</span>
                    </a>
            <?php //echo form_reset('back','Back','class="btn btn-grey" id="back"');
			 }else{
				 echo form_submit('submit','OK','class="btn btn-blue"');
			 }
			?>
            </p>
        	<?php echo form_close(); ?>
   			 </div><!-- box round first grid -->
    </div><!-- grid_10 -->
    </div><!-- container_12 -->