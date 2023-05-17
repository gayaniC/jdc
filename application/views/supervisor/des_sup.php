 					<?php 
					if(!empty($records)){
						$result=$records[0];
					?>
                    
                    	<?php echo form_input('job_Title',set_value('job_Title',$result['job_Title']),'class = "mini" id="des" ');?>
                        <?php echo form_hidden('Des_code',set_value('Des_code',$result['Des_code'])); ?>
                        <div class="validate error">
                    	<?php echo form_error('Des_code'); ?>
                   		</div>
                   <?php } ?>