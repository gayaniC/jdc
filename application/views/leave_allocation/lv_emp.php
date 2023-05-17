<style type="text/css">
.emp_list{position:absolute; width: 35.4%; background-color:#fff; margin:-15px 0 0 10px; z-index: 99 !important; border:#000 inset;} 
</style>


<?php //echo '<pre>'; print_r($records); echo '</pre>'; ?>
<?php if(!empty($records)){ ?>
<ul class="emp_list">
	<?php foreach($records as $val){ ?>
	<li><a href="#" class="emp_list_another" id="<?php echo $val->Emp_id; ?>">
	<div align="left"><?php echo $val->First_name.' '.$val->Middle_name.' '.$val->surname; ?></div>
    </a>
    </li>
    <?php } ?>
</ul>
<?php } ?>
<script type="text/javascript">
	jQuery('.emp_list_another').click(function(){
		
			 jQuery.ajax({
				url:'<?php echo site_url('search/load_emp') ?>' 
				type:'post',
				emp:jQuery(this).attr('id'),
				success:function(emp){
					jQuery('#emp_id').val(emp);
				}
			 })
		
		jQuery('.emp_list').hide();
	});
</script>