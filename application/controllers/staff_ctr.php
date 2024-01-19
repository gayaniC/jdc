<?php 
class staff_ctr extends CI_Controller{
	
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
	
	function hr_log()
    {
        $data['main_content'] = 'HR_log/hr';
        $this->load->view('includes/template.php',$data);
    }
    
    function log_add($msg='')
    {
        $data = $this->_log_load_data();
        $data['action'] = 'Add';
        $data['msg']    = $msg;
        $data['main_content'] = 'HR_log/hr_log_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function log_edit($id='',$msg='')
    {
        $data = $this->_log_load_data($id);
        $data['action'] = 'Edit';
        $data['msg']    = $msg;
        $data['main_content'] = 'HR_log/hr_log_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function log_view($id='')
    {
        $data = $this->_log_load_data($id);
        $data['action'] = 'View';
        $data['main_content'] = 'HR_log/hr_log_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function log_delete($id='',$msg='')
    {
        $data = $this->_log_load_data($id);
        $data['action'] = 'Delete';
        $data['msg']    = $msg;
        $data['main_content'] = 'HR_log/hr_log_mgt';
        $this->load->view('includes/template.php',$data);
    }
    
    function _log_load_data($id='')
    {
        $data['hr'] = array('hr_id'=>'','event_name'=>'','Date'=>'','actions_taken'=>'');
        
        if($id != '')
        {
            $this->load->model('staff_model');
            $data['hr'] = $this->staff_model->get_log_by_id($id);
        }
        return $data;
    }
    
    function log_validate()
    {
        if($this->input->post('action') == 'Add'){
            $this->form_validation->set_rules('event_name','Event','trim|required|is_unique['.HR_LOG.'.event_name]');
        }
        if($this->input->post('action') == 'Add' || $this->input->post('action') == 'Edit'){
            $this->form_validation->set_rules('Date','Date','trim|required');
            $this->form_validation->set_rules('actions_taken','Actions Taken','trim|required');
        }
        
        if($this->input->post('action') == 'Delete')
        {
            $this->remove_log();
        }
        
        if($this->form_validation->run() == FALSE){
            switch($this->input->post('action'))
            {
                case 'Add':
                    $this->log_add();
                break;
                case 'Edit':
                    $this->log_edit($this->input->post('hr_id'));
                break;
                
            }
        }else{
            switch($this->input->post('action'))
            {
                case 'Add':
                    $this->create_log();
                break;
                case 'Edit':
                    $this->update_log();
                break;
                
            }
        }
        
    }//validate_log
    
    function create_log()
    {
        if(!empty($_POST)){
            $this->load->model('staff_model');
            $id = $this->staff_model->insert_hr_log($this->input->post());
            if($id != '')
            {
                $this->session->set_flashdata('msg',RECORD_ADD);
                redirect('staff_ctr/log_edit/'.$id);
            }else{
                $this->session->set_flashdata('msg',ERROR);
                redirect('staff_ctr/log_add');
            }
        }
    }//create_log
    
    function update_log()
    {
        if(!empty($_POST)){
            $this->load->model('staff_model');
            $id = $this->staff_model->edit_hr_log($this->input->post());
            if($id != ''){
                $this->session->set_flashdata('msg',RECORD_UPDATE);
                redirect('staff_ctr/log_edit/'.$id); 
            }else{
                $this->session->set_flashdata('msg',ERROR);
                redirect('staff_ctr/log_edit/'.$id);
            }
        }
    }//update_log
    
    function remove_log()
    {
        $this->load->model('staff_model');
        $id = $this->staff_model->remove_hr_log($this->input->post());
        if($id != '')
        {
            $this->session->set_flashdata('msg',RECORD_DELETE);
            redirect('staff_ctr/hr_log');
        }else{
            $this->session->set_flashdata('msg',ERROR);
            redirect('staff_ctr/log_delete/'.$this->input->post('hr_id'));
        }
    }
    //********************************************Organize Events ***********************************************//
    
    function hr_event()
    {
        $data = $this->_load_event_data();
        $data['main_content'] = 'HR_log/events';
        $this->load->view('includes/template',$data);
    }
    
    function _load_event_data()
    {
        $this->load->model('staff_model');
        $employees = $this->staff_model->get_all_supervisors();
        $data['employees'] = get_combo_from_results_another($employees,'Emp_id','First_name','Middle_name','Please select a supervisor');
        return $data;
    }
    
    //send a email to oraganize an event
    function send_mail()
    {
        //dd($_FILES['att1']['name']);
        if(!empty($_FILES['att1']['name'])||!empty($_FILES['att2']['name'])||!empty($_FILES['att3']['name'])){
            $path =  'uploads/Attachments/';
			if(!file_exists($path)){mkdir($path, 0777);} 			
			
			$config['upload_path'] 		= $path;
            $path 						= $config['upload_path'];
            $config['allowed_types'] 	= 'jpg|jpeg|png|gif|pdf|docx';
            $config['max_size'] 		= '10240'; 		
			$config['overwrite'] 		= TRUE;	  
			
            $this->load->library('upload');			
			
			foreach($_FILES as $file_ary => $val){if(!empty($val['name'])){ $uploads[$file_ary]= $val; }}
			
            foreach ($uploads as $key => $value)
            {
				
				$config['file_name']= $this->input->post('Event').'-'.$key; 
				if (!empty($key['name']))
				{
					$this->upload->initialize($config);					
					
					if(!$this->upload->do_upload($key))
					{
						//error
						$errors = $this->upload->display_errors();
						$this->session->set_flashdata('msg',$errors);
						redirect('staff_ctr/hr_event/');
						
					}else{$data[$key] = $this->upload->data();}
					
				}
				
            }
        }//check files
        //dd($data);
        $path =  'uploads/Attachments/';
        $file = $path.'/'.$data['att1']['file_name'];
        $this->load->model('staff_model');
        $data = $this->staff_model->get_email_f_sup($this->input->post());
        $email = $data[0]['Emp_mail'];
        
        $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
        );
        $content = $this->input->post('Description');
        $this->load->library('email', $config);
        $msg = "<!doctype html><html lang='en'><head><meta charset='UTF-8'><title>New Event</title></head><body>
		$content
		</body></html>";
        $subject = $this->input->post('Event');
        $this->email->from('info@jdsl.com', 'JDC Group');
		$this->email->to($email); 	

		$this->email->subject($subject);
		$this->email->message($msg);	
        //$this->email->attach($file);
		if($this->email->send()){
		  echo 'success';
		}else{
		  echo 'fail';
		}
        
    }
	//*************************inq***************************************************************************//
    
    function inq()
    {
        $data['main_content'] = 'inq/jquery_cal';
        $this->load->view('includes/template.php',$data);
    }
}