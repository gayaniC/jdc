<?php

class bckup_ctr extends CI_Controller{
    
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
    
	
	function index(){
		
		$this->view();
		}
		
	function view($ID=''){		
		$this->get_db_backup();
		$data['main_content'] = 'db_bkup/db_bkup_vw';
		$this->load->view('includes/template.php',$data);
		
		}
		
	function get_db_backup()
	{
		$this->load->dbutil();		
		$prefs = array(
                'format'      => 'zip',             									// gzip, zip, txt
                'filename'    => 'database_backup_'.date('Y-m-d-H-i-s').'.sql',		// File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              							// Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              						// Whether to add INSERT data to backup file
                'newline'     => "\n"               					// Newline character used in backup file
              );

		$backup=$this->dbutil->backup($prefs);		
		$this->load->helper('file');
		$this->load->helper('download');
		force_download('db_backup_on_'. date('Y_m_d_H_i_s') .'.zip', $backup);	
	}

	
}?>