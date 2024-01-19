<?php 
class email extends CI_Controller{
	function index()
	{
		$this->load->library('email');

		$this->email->from('gchathurika9@gmail.com', 'Gayani');
		$this->email->to('gyth1988@gmail.com'); 
		$this->email->cc('another@another-example.com'); 
		$this->email->bcc('them@their-example.com'); 
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	
		
		$this->email->send();
		
		echo $this->email->print_debugger();	
	}
}