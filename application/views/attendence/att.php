	
<script type="text/javascript">
	
	jQuery(document).ready(function(){
		get_result();
		jQuery('#datepicker').change(function(){
			get_result();
		});
        jQuery('#emp_id').change(function(){
           get_result(); 
        });
		jQuery('#myform').submit(function(event){
			event.preventDefault();
			get_result();
			
		});
		function get_result(){
			jQuery.ajax({
				url: '<?php echo site_url('search/attendence') ?>',
				type: 'post',
				data: jQuery('#myform').serializeArray(),
				success: function(msg){
					jQuery('#result').html(msg)	;
				}
			});	
		}
		//jQuery('#emp_id').keyup(function(){
//			jQuery.post('search/get_emp',{emp:jQuery('#emp_id').val()},
//			function(data){
//				jQuery('#emp_result').html(data);
//			})
//		});
	});
</script> 

	<div class="container_12">
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2>Employee Attendence Details </h2>
                <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<font color="#FF0000">'.$this->session->flashdata('msg').'</font>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                	
                    
                    <tr>
                    <td><?php echo form_label('Date','att_date'); ?></td>
                    <td>
                    
                    <input type="text" name="att_date" id="datepicker"/>
                    
                    </td>
                    </tr>
                    
                    <tr>
                    <td class="col1"><?php echo form_label('Employee Name','Emp_id'); ?></td>
                    <td class="col2">
					<?php //echo form_input('Emp_id',$this->input->get('Emp_id'),'class="mini" id="emp_id" autocomplete="off"');?>
                    <?php echo form_dropdown('Emp_id',$employee,$this->input->get('Emp_id'),'id="emp_id"'); ?>
                    <div id="emp_result"></div>
                    </td>
                    </tr>
                    
                    
                    
                    <tr>
                    <td>
					<?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey"');?>
                    </td>
                    </tr>
                   <tr>
                   <td></td>
                   <td><div style="float: right;"><?php echo anchor('attendence_ctr/upload_file','<font size="0.5px"><i>Upload<i></font>','class="btn btn-primary" title="Upload Daily Attendance"'); ?></div></td>
                   </tr>
                    
                </table>
                <?php echo form_close(); ?>
                </div><!--block-->
                
                <div id="result"></div>
                </div>
            </div><!-- box round first grid -->
        </div><!--grid_10-->
	</div><!-- container_12-->
