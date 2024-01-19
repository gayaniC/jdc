<?php //echo '<pre>'; print_r($records); echo '</pre>'; ?>
<script type="text/javascript">

        jQuery(document).ready(function () {
            setupLeftMenu();

            jQuery('.datatable').dataTable();
			setSidebarHeight();


        });
    </script>
    
    <div class="container_12">
     <div class="grid_10">
            <div class="box round first grid">
            <h5><font color="#1B548D"><u>Search Result</u></font></h5>
            
             <div class="block">
             <!--data table-->
             <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Date</th>
							<th>Employee Name</th>
							
							<th>In time</th>
							<th>Out time</th>
                            <th>Duration</th>
						</tr>
					</thead>
                    <tbody>
                    
                    <?php foreach($records as $val){?>
                    <?php if($i=0){$bg="#000000";$i++;}
					
					 ?>
						<tr class="even gradeX">
                        	<td ><?php echo $val->att_date;?></td>
                            <td><?php echo $val->title.' '.$val->First_name.' '.$val->Middle_name;?></td>
                            
                            <td><?php echo $val->In_Time;?></td>
                            <td ><?php echo $val->Out_time; ?> </td>
                            <td><?php echo $val->duration; ?></td>
                        </tr>
                    <?php } ?>
					</tbody>
             </table>
             <!--data table-->
             </div>
             
            </div>
     </div>
    </div>