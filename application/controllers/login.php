<?php
/*
 *	Login Controller 
 *	
 *	Login logout process and views
 *	@author Marwan
 */
class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	/*
	 *	Index function -> /login
	 *	
	 *	@access public
	 *	@param  0
	 *	@return Login view  
	 *
	 */
	public function index(){
		if($this->session->userdata('logged_in')){
			redirect(base_url('table'));
		}
		//main content view 
		$data['title']		  =  "Login";
		$data['view_content'] = 'login_view';
		
		$args = array([
			"field" => "loginEmail",
			"label" => "Email",
			"rules" => "required|valid_email"
		],[
			"field" => "loginPass",
			"label" => "Password",
			"rules" => "required"
		]);
		$this->form_validation->set_rules($args);
		
		if($this->form_validation->run() == false){
			//Load View
			$this->load->view('inc/main',$data);
		}else{
			//success
			try{
				$this->user_model->login();
				$this->session->set_flashdata("msg","You Login successfully");
				redirect(base_url('table'));
			}catch(Exception $e){
				//Error
				$this->session->set_flashdata("Err_msg",$e->getMessage());
				redirect(base_url());
			}
		}
	}
	
	public function logout(){
		if($this->session->userdata("logged_in")){
			try{
				$this->user_model->logout();
				$this->session->set_flashdata("msg","You Logout successfully");
				redirect(base_url());
			}catch(Exception $e){
				//Error
				$this->session->set_flashdata("Err_msg",$e->getMessage());
				redirect(base_url());
			}
		}else{
			$this->session->set_flashdata("Err_msg","Your Not Allowed please login or sign up");
			redirect(base_url());
		}
	}
}