<?php
	class login extends CI_Controller{
		
		function index()
		{
			$this->load->view('user/login');
		}
		
		function validate()
		{
			$this->form_validation->set_rules('username','Username','trim|required');	
			$this->form_validation->set_rules('password','Password','trim|required');
			
			if($this->form_validation->run() == FALSE){
				//validation fail
				$this->index();
			}else{
				//validation true
				$this->load->model('login_model');
				$query = $this->login_model->validate($this->input->post());
				//echo '<pre>'; print_r($query); echo '</pre>'; die();
				if($query){
					$data = array(
						'username' 		=> $query->username,
						'user_role_id'	=> $query->user_role_id,
						'firstname'		=> $query->firstname,
						'lastname'		=> $query->lastname,
						'is_logged_in' 	=> true
					);
					$this->session->set_userdata($data);
					redirect('home_page/home');
				}else{
					$this->session->set_flashdata('msg',LOGIN_ERROR);
					redirect('login');	
				}
			}
		}//validate
		
		
		
		
	}
?>