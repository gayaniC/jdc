<?php echo 'abc'; die; ?>
<html>
	<head>
    	<title>Login</title>

        <link rel="stylesheet" type="text/css" href="<?php echo site_url(); ?>css/style.css" />
        
    
    </head>
    <body>
<div id="login_form">

	<div id="main"><img src="<?php echo site_url(); ?>images/jdclogo.png"/>
    JDC Management System</div>
    <p id="errormsg">
    <?php if($this->session->flashdata('msg') != ''){ 
    	echo '<font color="#FF0000">'.$this->session->flashdata('msg').'</font>';
     } ?>
     </p>
    <p id="sub">
    <?php echo form_open('login/validate'); ?>
    <?php session_start(); ?>
    <?php echo form_label('Username','username'); ?>
    <?php echo form_input('username',set_value('username')); ?>
    <div class="error"><?php echo form_error('username'); ?></div>
    
    
    <?php echo form_label('Password','password');?>
   	<?php echo form_password('password',set_value('password')); ?>
    <div class="error"> <?php echo form_error('password'); ?></div>
    
    <?php echo form_submit('submit','Login'); ?>
    <?php echo form_close(); ?>
    </p>
</div>

	</body>
</html>