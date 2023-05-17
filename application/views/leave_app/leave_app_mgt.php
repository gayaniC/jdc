<script>
jQuery(document).ready(function(){
   
   var dateToday = new Date();
    var dates = $("#from, #to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 3,
    minDate: dateToday,
    beforeShowDay: $.datepicker.noWeekends,
    onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});
});
</script>
<script>
jQuery(document).ready(function(){
   jQuery('#to').change(function(){
		//alert(1);
		var from = jQuery('#from').val();
		 var to = jQuery('#to').val();
		 //alert(new Date(resig));
		 if(new Date(from) > new Date(to)){
			 alert('Please Select correct dates for From and To');
		 }
	}); 
    jQuery('#grumble').change(function(){
        
        var from = jQuery('#from').val();
         var to = jQuery('#to').val();
         var dur = jQuery('#grumble').val();
         var uom = jQuery('#uom').html();
         //alert(uom);
         switch(uom){
            case 'Days':
              
              var diff = (new Date(to) - new Date(from))/(1000*60*60*24);
               if(dur != diff){
                alert('Please Select correct dates for From and To');
               }
            break;
            case 'Hours':
              //alert('hours');
              var diff1 = (new Date(to) - new Date(from))/(1000*60*60);
              if(dur < diff1){
                alert('Please Select correct dates for From and To');
              }
            break;
            case 'Months':
                var diff2 = new Date(to).getMonth() - new Date(from).getMonth();
                if(dur != diff2){
                    alert('Please Select correct dates for From and To');
                }
            break;
            case 'Years':
                
                var diff3 = new Date(to).getFullYear() - new Date(from).getFullYear();
                if(dur != diff3){
                    alert('Please Select correct dates for From and To');
                }
            break;
         }
         
    });
    jQuery('#to').change(function(){
         var from = jQuery('#to').val();
         var to = jQuery('#from').val();
         var dur = jQuery('#grumble').val();
         var uom = jQuery('#uom').html();
         if(dur != ''){
            switch(uom){
            case 'Days':
              
              var diff = (new Date(to) - new Date(from))/(1000*60*60*24);
               if(dur != diff){
                alert('Please Select correct dates for From and To');
               }
            break;
            case 'Hours':
              //alert('hours');
              var diff1 = (new Date(to) - new Date(from))/(1000*60*60);
              if(dur < diff1){
                alert('Please Select correct dates for From and To');
              }
            break;
            case 'Months':
                var diff2 = new Date(to).getMonth() - new Date(from).getMonth();
                if(dur != diff2){
                    alert('Please Select correct dates for From and To');
                }
            break;
            case 'Years':
                
                var diff3 = new Date(to).getFullYear() - new Date(from).getFullYear();
                if(dur != diff3){
                    alert('Please Select correct dates for From and To');
                }
            break;
         }
         }
         
    });
    
});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
    
    <?php if($action != 'Add'){
        ?>
        jQuery('#leave_type').attr('readonly',true);
        <?php
    } ?>
    
    jQuery('#back').click(function(){
		  window.location = "<?php echo site_url('leave_ctr/requests/');?>";
	   });
       jQuery("#datepicker1").datepicker({
      			changeMonth: true,
      			changeYear: true
  		});
        jQuery("#datepicker2").datepicker({
      			changeMonth: true,
      			changeYear: true
  		});
        get_allo(); 
        jQuery('#leave_type').change(function(){
           get_allo(); 
        });
        function get_allo(){
            jQuery.ajax({
               url:'<?php echo site_url('search/get_lv_ent'); ?>',
               type:'post',
               data:jQuery('#leave_type').serializeArray(),
               success:function(data){
                  //alert(data);
                  result=data.split(',');
                  //alert(result[0]);
                  jQuery('#allo_uom').val(result[0]);
                  jQuery('#uom').html(result[0]);
                  jQuery('#allocated').val(result[1]);
                  jQuery('#used').val(result[2]);
                  jQuery('#bal').val(result[3]);
                  //jQuery('#bal').val(data.bal);
                 } 
 
            });
        }
});
</script>
<?php
	switch($action){
	   case 'Add':
        $heading= 'Add ';
        $result = $lv_app;
        $add    = 'DISABLED';
        $dis    = '';
        $view   = '';
       break;
       case 'Edit':
        $heading= 'Add ';
        $result = $lv_app[0];
        $add    = 'DISABLED';
        $dis    = 'DISABLED';
        $view   = '';
        
       break;
       case 'Delete':
        $heading= 'Add ';
        $result = $lv_app[0];
        $add    = 'DISABLED';
        $dis    = 'DISABLED';
        $view   = 'DISABLED';
       break;
       case 'View':
        $heading= 'Add ';
        $result = $lv_app[0];
        $add    = 'DISABLED';
        $dis    = 'DISABLED';
        $view   = 'DISABLED';
       break;
       
       
	}
?>



<div class="container_12">
    <div class="grid_10">
            <ul class="nav main">
             <li class="ic-dashboard"><a href="<?php echo site_url('home_page');?>"><span>Dashboard</span></a> </li>
             <?php if($this->session->userdata('user_role_id') == 'HR'){
                ?>
                <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/types'); ?>"><span>Leave Types</span></a></li>
                <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/allocation'); ?>"><span>Leave Allocation</span></a></li>
                <?php
             } ?>
                
				<li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/requests'); ?>"><span>Leave Requests</span></a></li>
                <?php if($this->session->userdata('user_role_id') == 'HR' ||$this->session->userdata('user_role_id') == 'ADMIN'||$this->session->userdata('user_role_id') == 'MGER') {
                    ?>
                    <li class="ic-form-style"><a href="<?php echo site_url('leave_ctr/approvals'); ?>"><span>Leave Approvals</span></a></li>
                    <?php
                     }?>
				
            </ul>
        </div>
        
        <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
            	<h2><?php echo $heading; ?>Leave Application</h2>
               <p id="errormsg">
   					 <?php if($this->session->flashdata('msg') != ''){ 
    				echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
    				 } ?>
    				</p>
               	<div class="block">
                <?php echo form_open('leave_ctr/validate_lv_app'); ?>
                <?php if($action != 'Add'){
                    echo form_hidden('lv_app_no',set_value('lv_app_no',$result['lv_app_no']));
                }?>
                <table class="form">
                <tr>
                <td><?php echo form_label('Employee','Emp_id'); ?></td>
                <td>
                <?php echo form_dropdown('Emp_id',$emp,set_value('Emp_id',$this->session->userdata('Emp_id')),'class="smallinput" '.$add); ?>
                <?php echo form_hidden('Emp_id',set_value('Emp_id',$this->session->userdata('Emp_id'))); ?>
                </td>
                <td><?php echo form_label('Leave Type','leave_type_code'); ?></td>
                <td>
                <?php echo form_dropdown('leave_type_code',$lv_type,set_value('leave_type_code',$result['leave_type_code']),'id="leave_type" '
        ); ?>
        
                <div class="validate error">
                <?php echo form_error('leave_type_code'); ?>
                </div>
                </td>
                </tr>
                </table>
                
                </div><!-- block -->
                </div><!-- form holder -->
                <br />
                <div class="form_holder">
                <h2>Leave Entitlement</h2>
                <div class="block">
                <table class="form">
                <tr>
                <td><?php echo form_label('Units','allo_uom'); ?></td>
                <td><?php echo form_input('allo_uom',set_value('allo_uom',$result['val_des']),'id="allo_uom" '.$add); ?></td>               
                <td><?php echo form_label('Leave Allocated','allocated'); ?></td>
                <td><?php echo form_input('allocated',set_value('allocated',$result['allocated']),'id="allocated" '.$add); ?></td>
                </tr>
                <trr>
                <td><?php echo form_label('Leave Taken','used'); ?></td>
                <td><?php echo form_input('used',set_value('used',$result['used']),'id="used" '.$add); ?></td>
                
                <td><?php echo form_label('Balance','bal'); ?></td>
                <td><?php echo form_input('bal',set_value('bal',$result['bal']),'id="bal" '.$add); ?></td>
                </trr>
                </table>
                </div>
                </div>
                <br />
                <div class="form_holder">
                <div class="block">
                <table class="form">
                <tr>
                <td>
                <?php echo form_label('From','From'); ?>
                </td>
                <td><?php echo form_input('From',set_value('From',$result['From']),'id="from" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('From'); ?>
                </div>
                </td>
                <td><?php echo form_label('To','to'); ?></td>
                <td><?php echo form_input('to',set_value('to',$result['to']),'id="to" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('to'); ?>
                </div>
                </td>
                </tr>
                <tr>
                <td><?php echo form_label('Duration','no_of_days'); ?></td>
                <td><?php echo form_input('no_of_days',set_value('no_of_days',$result['no_of_days']),'id="grumble" '.$view); ?><span id="uom"></span>
                <?php if($action != 'Add'){
                    echo form_hidden('db_no_of_days',set_value('db_no_of_days',$result['no_of_days']));
                } ?>
                <div class="validate error">
                <?php echo form_error('no_of_days'); ?>
                </div></td>
                <td><?php echo form_label('Applied On','applied_on'); ?></td>
                <td><?php echo form_input('applied_on',set_value('applied_on',$result['applied_on']),'id="datepicker2" '.$view); ?>
                <div class="validate error">
                <?php echo form_error('applied_on'); ?>
                </div>
                </td>
                </tr>
                <tr>
                <td><?php echo form_label('Reason','reason_for_leave'); ?></td>
                <td><?php echo form_textarea('reason_for_leave',set_value('reason_for_leave',$result['reason_for_leave']),' '.$view); ?>
                 <div class="validate error">
                <?php echo form_error('reason_for_leave'); ?>
                </div>
                </td>
                </tr>
                <?php if($action != 'Add'){
                    ?>
                    <tr>
                    <td><?php echo form_label('Approval Status','app_status'); ?></td>
                    <td><?php 
                    $app_status = array('N'=>'Never','P'=>'Pending','A'=>'Approved','R'=>'Rejected');
                    echo form_dropdown('app_status',$app_status,set_value('app_status',$result['app_status']),''.$dis); ?></td>
                    </tr>
                    <?php
                } ?>
                <tr>
                    
                     <?php echo form_hidden('action',$action); ?>
                    <?php if($action != 'View'){?>
                    <td>
					<?php echo form_submit('submit',$action,'class="btn btn-blue"'); ?>
                    </td>
                    <td colspan="2">
                    <?php echo form_reset('reset','Cancel','class="btn btn-grey" id = "cancel"');?>
                   
                    <?php
					echo form_reset('back','Back','class="btn btn-grey" id="back"');
					 ?>
                   </td>
                    <?php }?>
                    <?php if($action == 'View'){?>
                    <td>
                    <?php echo form_submit('submit','OK','class="btn btn-blue"');?>
                    </td>
                    <?php } ?>
                    
                    
                    </tr>
                </table>
                </div>
                </div><!-- form_holder -->
                <?php echo form_close(); ?>
            </div>
        </div>