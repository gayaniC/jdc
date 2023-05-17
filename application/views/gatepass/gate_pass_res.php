<style>

.table_holder {border:1px groove;
            width:60%;
			padding:50px;
            margin:40px;}
#insert{margin-left: 30%;}
@media print{
    
    .table_holder {border:2px groove;
            width:60%;
			padding:50px;
            margin:40px;}
#insert{margin-left: 30%;}
    #print_content{
        display:block;
    }
}
</style>

<script>
function printDiv(divName) {
    //alert(divName);
      var printContents = document.getElementById(divName).innerHTML;     
       var originalContents = document.body.innerHTML;       
       document.body.innerHTML = printContents;      
       window.print();      
       document.body.innerHTML = originalContents;
}
</script>

<div class="container_12">
<div class="grid_10">
<div class="block">
<p align="left"><button onclick="printDiv('print_content')" class="btn btn-blue">Print</button></p>
 <div id="print_content">
 <div class="table_holder">
    <?php foreach($records as $val){ ?>
    <img src="<?php echo site_url(); ?>images/jdclogo.png"/><br /><b>JDC Group of companies,<br />No:304,<br />Grand Pass Road,<br />Colombo 14.</b>
    <h2 align="center"><u>Gate Pass</u></h2>
    
    <div style="float:left"><b>Date: <u><?php echo date('Y-m-d'); ?></u></b></div>
    <div style="float:right"><b>Vehicle No: <u><?php echo $val['Vehicle_no']; ?></u></b></div>
    <br />
    <br />
    <div style="float:left"><b>Customer: <u><?php echo $val['cus_id']; ?></u></b></div>
    <div style="float:right"><b>Employee: <u><?php echo $val['Emp_id']; ?></u></b></div>
    <br />
    <br />
    <div id="insert">
    <p><b>Time Out(Departure):</b></p><p>......................................</p>
    <p><b>Time In(Return):    </b></p><p>......................................</p>
    <p><b>Purpose :           </b></p><p>......................................</p>
    </div>
    
    <div style="float:left">..................<br /><b>Signature of Employee</b></div>
    <div style="float:right">.................<br /><b>Signature of HOD</b></div>
    
    <?php } ?>
 </div>
 </div>
 
 
 </div>
 </div>
 </div>