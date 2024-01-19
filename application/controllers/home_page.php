<?php 
class home_page extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->is_logged_in();
	}
	
	function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true )
		{
		  redirect('login');
			//echo '<font color="#FF0000" size="5">You don\'t have permission to access this page. </font>'; echo anchor(site_url('login'),'<font color="#0000FF" size="5">Login</font>','title="login"');
			//die();
		}
	}
	
	function index()
	{
		if($this->session->userdata('user_role_id') == 'DVP'){
			$data['main_content'] = 'dashboard/dvp.php';
			$this->load->view('includes/template.php',$data);
		}
		if($this->session->userdata('user_role_id') == 'NEMP'){
			$data['main_content'] = 'dashboard/NEMP.php';
			$this->load->view('includes/template.php',$data);
		}
        if($this->session->userdata('user_role_id') == 'ADMIN'){
            $data['main_content'] = 'dashboard/ADMIN.php';
			$this->load->view('includes/template.php',$data);
        }
        if($this->session->userdata('user_role_id') == 'DEO'){
            $data['main_content'] = 'dashboard/DEO.php';
			$this->load->view('includes/template.php',$data);
        }
        if($this->session->userdata('user_role_id') == 'HR'){
            $data['main_content'] = 'dashboard/HR.php';
			$this->load->view('includes/template.php',$data);
        }
        if($this->session->userdata('user_role_id') == 'MGER'){
            $data['main_content'] = 'dashboard/MGER.php';
			$this->load->view('includes/template.php',$data);
        }
        if($this->session->userdata('user_role_id') == 'VEMP'){
            $data['main_content'] = 'dashboard/VEMP.php';
			$this->load->view('includes/template.php',$data);
        }
	}
		
	
}