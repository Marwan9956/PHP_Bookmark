<?php 
/*
 *	Register Controller 
 *	
 *	Handle reigster process and views
 *	@author Marwan
 */
class Register extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('file_upload');
	}
	
	/*
	 *	Index function -> /register
	 *	
	 *	@access public
	 *	@param  0
	 *	@return Register view  
	 *
	 */
	public function index(){
		//main content view 
		$data['title']		  =  "Register";
		$data['view_content'] = 'register';
		
		$args = array([
			"field" => "username",
			"label" => "Username",
			"rules" => "required|min_length[3]"
		],[
			"field" => "email",
			"label" => "Email",
			"rules" => "required|valid_email"
		],[
			"field" => "password",
			"label" => "Password",
			"rules" => "required|min_length[6]|max_length[16]"
		],[
			"field" => "password2",
			"label" => "Confirm Password",
			"rules" => "required|matches[password]"
		],[
			"field" => "firstname",
			"label" => "Firstname",
			"rules" => "required"
		],[
			"field" => "lastname",
			"label" => "Lastname",
			"rules" => "required"
		]);
		$this->form_validation->set_rules($args);
		
		if($this->form_validation->run() == false){
			//not valid data
			$this->load->view('inc/main',$data);
		}else{
			//check if user upload file
			if(isset($_FILES['profile-img'])){
				$this->file_upload->upload_file($_FILES['profile-img'],'assets/img/user_profiles/');
			}
			
			$username = $this->input->post("username");
			$email    = $this->input->post("email");
			//Register new user
			try{
				if(!$this->user_model->check_username($username)){
					throw new Exception("username is been used by other member if that is you then login");
				}else if(!$this->user_model->check_email($email)){
					throw new Exception("Email is been used by other member if that is you then login");
				}
				$this->user_model->sign_up();
				$this->session->set_flashdata("msg","You Sign up successfully you can log in");
				redirect(base_url());
			}catch(Exception $e){
				$this->session->set_flashdata("Err_msg",$e->getMessage());
				redirect(base_url("register"));
			}
			
			
		}
		
		
		
	}
}