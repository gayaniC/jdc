<div class="container_12">

    <div class="grid_10">
            <div class="box round first grid">
            <div class="form_holder">
                    <h2>Upload Attendance</h2>
                    <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
                <div class="block">
                
                <?php echo form_open_multipart('attendence_ctr/validate'); ?>
                <table id="form">
                <tr>
                <td><?php echo form_label('Upload Daily Attendance'); ?></td>
                <td><?php echo form_upload('Attendance'); ?>
                <div class="validate error">
                <?php echo form_error('attendance'); ?>
                </div>
                <i>Allow file type is csv</i>
                </td>
                </tr>
                <tr>
               <td>
               <?php echo form_submit('submit','Upload','class = btn btn-blue'); ?>
               <?php echo form_reset('reset','Cancel','class = "btn btn-grey"'); ?>
               
               </td> 
               <td></td>
               <td>
               <br />
               <a class="btn btn-grey" style="float:right;" href="javascript:void(0)" onClick="window.history.back();">
                                    <span>Back</span>
                    </a>
               </td>
                </tr>
                </table>
                <?php echo form_close(); ?>
                </div><!-- block -->
            </div><!-- form_holder -->
            
            </div><!-- box -->
    </div><!-- grid 10 -->
</div><!-- container -->