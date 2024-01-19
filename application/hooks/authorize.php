<?php
    
    function is_logged_in()
    {
        $CI =& get_instance();
        $is_logged_in = $CI->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true )
		{
		  redirect('login');
			//echo '<font color="#FF0000" size="5">You don\'t have permission to access this page. </font>'; echo anchor(site_url('login'),'<font color="#0000FF" size="5">Login</font>','title="login"');
			//die();
		}else{
		  redirect('home_page');
		}
    }
?>