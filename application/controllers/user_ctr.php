<?php 
class user_ctr extends CI_Controller{
	
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
		$data = $this->_load_data();
		$data['main_content'] = 'user/user_vw';
		$this->load->view('includes/template.php',$data);
		
	}
	
	function add($msg="")
	{
		$data = $this->_load_data();
		$data['action'] = 'Add';
		$data['msg']    = $msg;
		$data['main_content'] = 'user/user_mnt';
		$this->load->view('includes/template.php',$data);
	}
	
	function edit($id="",$msg="")
	{
		$data			= $this->_load_data($id);
		$data['action'] = 'Edit';
		$data['msg']    = $msg;
		$data['main_content'] = 'user/user_mnt';
		$this->load->view('includes/template.php',$data);
	}
	
	function delete($id='',$msg='')
	{
		$data			= $this->_load_data($id);
		$data['action'] = 'Delete';
		$data['msg']    = $msg;
		$data['main_content'] = 'user/user_mnt';
		$this->load->view('includes/template.php',$data);
	}
	
	function view($id='')
	{
		$data			= $this->_load_data($id);
		$data['action'] = 'View';
		$data['main_content'] = 'user/user_mnt';
		$this->load->view('includes/template.php',$data);
	}
	
	function validate()
	{
		if($this->input->post('action') == 'Add'){
			$this->form_validation->set_rules('Emp_id','Employee','required');
			$this->form_validation->set_rules('username','Username','trim|required|is_unique['.USER.'.username]');
			$this->form_validation->set_rules('user_email','Email','trim|required|valid_email|is_unique['.USER.'.user_email]');
		}
		
		if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
			$this->form_validation->set_rules('user_role_id','User Role','required');
			$this->form_validation->set_rules('password','Password','trim|required');
			$this->form_validation->set_rules('password_confirm','Confirm Password','trim|required|matches[password]');
		}
        
        if($this->input->post('action') == 'Edit'){
            $this->form_validation->set_rules('username','Username','trim|required|callback_username_check');
        }
		
		if($this->input->post('action') == 'View'){
			$this->index();
		}
		
		if($this->input->post('action') == 'Delete'){
			$this->remove();
		}
		if($this->form_validation->run()==FALSE){
			switch($this->input->post('action')){
				case 'Add':
					$this->add();
				break;
				case 'Edit':
					$this->edit($this->input->post('id'));
				break;
				
			}
		}else{
			switch($this->input->post('action')){
				case 'Add':
					$this->create();
				break;
				case 'Edit':
                    //$this->change_pw_email($this->input->post('user_email'),$this->input->post('password_confirm'));
					$this->update();
				break;
			}
		}
	}
    
    function username_check()
    {
    
        $this->load->model('user_model');
        $username = $this->user_model->check_unique_username($this->input->post());
        if($username != '')
        {
            $this->form_validation->set_message('username_check', 'The %s field can not be the word '.$username);
            return FALSE;
        }
        return true;
    }
	
	function _load_data($id="")
	{
		$this->load->model('user_model');
		$employee = $this->user_model->get_all_emp();
		$data['emp'] = get_combo_from_results_another($employee,'Emp_id','First_name','Middle_name','Please Select an Employee');
		$userRole = $this->user_model->get_all_user_roles();
		$data['userRole'] = get_combo_from_results($userRole,'user_role_id','user_role','Please Select a User Role');
		$data['user'] = array('Emp_id'=>'','user_role_id'=>'','username'=>'','user_email'=>'');
        if($id != ''){
            $data['user'] = $this->user_model->get_all_users_by_id($id);
        }
		
		return $data;
	}
	
	function send_email($email,$username,$password)
	{
	  //echo $email; die();
	   $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
        );
        $this->load->library('email', $config);
        $this->email->from('info@jdcsl.com', 'JDC Group');
		$this->email->to($email); 	

		$this->email->subject('Verify Login');
			

		
        
        $msg = "<!doctype html><html lang='en'><head><meta charset='UTF-8'><title>Your User Account is created</title></head><body>
		Dear User,<br> Your Username is <b>$username</b> Your Password is <b>$password</b><p>Please login to verify your username and password {unwrap}http://localhost/jdc{/unwrap}</p><p>This Email is auto generated. Please do not reply to this email.</p>Thanking You<br/>Regards,<br/>JDC Printing Technologies(Pvt)Ltd,<br/>304,<br/>Grandpass Road,<br/>Colombo 14.<br/>phone:	+94 (112) 389160<br/>Fax:	+94 (112) 389166<br/>Email:	jdc@jdcsl.com</body></html>";
		//$this->email->message('Your Username is <b>'.$username.'</b> Your Password is <b>'.$password.'</b>.'.LOGIN_EMAIL);	
	    $this->email->message($msg);
        $this->email->send();
        
        //$this->create(); 
        
	}
    
    
	function create()
	{
		
		$this->load->model('user_model');
		$id = $this->user_model->insert($this->input->post());
        
		if($id!=''){
            $this->send_email($this->input->post('user_email'),$this->input->post('username'),$this->input->post('password'));
			$this->session->set_flashdata('msg',RECORD_ADD);
			redirect('user_ctr/edit/'.$id);
		}else{
			$this->session->set_flashdata('msg',ERROR);
			redirect('user_ctr/add/',ERROR);
		}
	}
	
	function update()
	{
		$this->load->model('user_model');
        $id = $this->user_model->edit($this->input->post());
        if($id != '')
        {
            $this->send_email($this->input->post('user_email'),$this->input->post('username'),$this->input->post('password'));
            $this->session->set_flashdata('msg',RECORD_UPDATE);
            redirect('user_ctr/edit/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('user_ctr/edit/'.$this->input->post('id'));
        }
	}
	
	function remove()
	{
		$this->load->model('user_model');
        $id = $this->user_model->delete($this->input->post());
        if($id != ''){
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('user_ctr/');
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('user_ctr/delete/'.$this->input->post('id'));
        }
	}
}