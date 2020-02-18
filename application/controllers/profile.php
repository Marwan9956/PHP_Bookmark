<?php
/*
 *	Profile Controller 
 *	
 *	Profile views 
 *	@author Marwan
 */
class Profile extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	/*
	 *	Index function -> /profile
	 *	
	 *	@access public
	 *	@param  0
	 *	@return profile view  
	 *
	 */
	public function index(){
		if(!$this->session->userdata('logged_in')){
			$this->session->set_flashdata("Err_msg","This is a member page Login first");
			redirect(base_url());
		}else{
			$user_id = $this->session->userdata('user_id');
			$data['title']		  =  "Profile";
			$data['view_content'] = 'profile';
			$data['user'] = $this->user_model->getUserByID($user_id);
			$config = array(
				array(
						'field' => 'username',
						'label' => 'Username',
						'rules' => 'required'
				),
				array(
						'field' => 'email',
						'label' => 'Email',
						'rules' => 'required|valid_email'
				),
				array(
						'field' => 'firstname',
						'label' => 'Firstname',
						'rules' => 'required'
				),
				array(
						'field' => 'lastname',
						'label' => 'Lastname',
						'rules' => 'required'
				)
			);
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() == false){
				$this->load->view('inc/main',$data);
			}else{
				//process the editing
				try{
					$this->user_model->update_user();
					$this->session->set_flashdata("msg","your profile updated successfully");
					redirect(base_url("table"));
				}catch(mysql_exception $e){
					$this->session->set_flashdata("Err_msg",$e->getMessage());
					redirect(base_url("profile"));
				}catch(Exception $e){
					$this->session->set_flashdata("Err_msg",'Your Data has not been updated ,server Error occur Contact admin');
					redirect(base_url("profile"));
				}
				
			}
			
		}
	}
	
	
}