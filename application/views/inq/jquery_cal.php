<script>
jQuery(document).ready(function(){
  //$("#datepicker1").datepicker();
  // Enable only Friday
$("#datepicker1").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: 'mm-dd-yy',
    //beforeShowDay: $.datepicker.noWeekends
    beforeShowDay: disableAllTheseDays
    //beforeShowDay: enableFirday
});
var disabledDays = ["8-22-2013", "8-23-2013"];
function disableAllTheseDays(date) {
    var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
    for (i = 0; i < disabledDays.length; i++) {
        if($.inArray((m+1) + '-' + d + '-' + y,disabledDays) != -1) {
            return [false];
        }
    }
    return [true];
}
});
</script>

<style>
.ui-state-default{
    background: #aaaaaa;
    
}

.ui-state-disabled{
    
    background: #aaaaaa;
}
</style>
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
<div class="container_12">
    
    <div class="grid_10">
            <div class="box round first grid">
            	<div class="form_holder">
                <h2>Customer Details</h2>
                <p id="errormsg">
                <?php if($this->session->flashdata('msg') != ''){ 
                echo '<div class="message error"><font color="#FF0000">'.$this->session->flashdata('msg').'</font></div>';
                } ?>
                </p>
                <br />
                <?php echo form_open('','id="myform"'); ?>
                <table class="form">
                <tr>
                <td class="col1">
                <label for="from">From</label>
                </td>
                <td>
                <input type="text" id="from" name="from"/>
                </td>
                
                <td class="col1">
                <label for="to">to</label>
                </td>
                <td>
               <input type="text" id="to" name="to"/>
                </td>
                </tr>
                <tr>
                <td>
                <?php echo form_submit('submit','Search','class="btn btn-blue"'); ?>
                <?php echo form_reset('reset','Cancel','class="btn btn-grey"'); ?>
                
                </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
					<?php echo anchor(site_url('fuel_ctr/add_cus'),'<span></span>New Customer','class = "btn-icon btn-blue btn-plus" style="float:right"'); ?>
					</td>
                    </tr>
                
                </table>
                <?php echo form_close(); ?>
                </div><!-- form_holder -->
             </div><!-- box -->
    </div><!-- grid 10 -->
    <div id="result"></div>
</div> <!--container -->