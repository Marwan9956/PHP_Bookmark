<?php 
/*
 *	User Model  
 *	
 *	Handle User Porcess of reigster And Login 
 *
 *	@author Marwan
 */

class User_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	/*
	 *	Sign_up function
	 *	inserting user data in users table	
	 *
	 *	@access public
	 *	@param  0
	 *	@return true if register process is done correctly 
	 *  	    otherwise false  
	 *
	 */
	public function sign_up(){
		$username = $this->input->post("username");
		$email    = $this->input->post("email");
		$password = $this->input->post("password");
		$firstname= $this->input->post("firstname");
		$lastname = $this->input->post("lastname");
		$imgURL   = $this->input->post("profile-img");
		
		
		$data = [
			"username" => $username,
			"password" => md5($password),
			"email"    => $email,
			"firstName"=> $firstname,
			"lastName" => $lastname,
			"imgURL"   => $imgURL
		];
			
		return $this->db->insert("users",$data);
		
	}
	
	/*
	 *	getUserByID function
	 *	return single user object by id 	
	 *
	 *	@access public
	 *	@param  int id
	 *	@return user object or false empty object  	    
	 *
	 */
	public function getUserByID($id){
		$this->db->select("username , email , firstName , lastName , imgURL , joinDate");
		$this->db->where("id",$id);
		$this->db->from("users");
		$query = $this->db->get();
		return $query->row();
	}
	
	/*
	 *	getUser function
	 *	return single user object by id 	
	 *
	 *	@access public
	 *	@param  int id
	 *	@return user object or false empty object  	    
	 *
	 */
	public function getUser($id){
		$this->db->select("*");
		$this->db->where("id",$id);
		$this->db->from("users");
		$query = $this->db->get();
		return $query->row();
	}
	
	/*
	 *	Check Username function
	 *	
	 * 	will check if username is already been used by other member
	 *   
	 *
	 *	@access public
	 *	@param   username string
	 *	@return true for applicable username  false if 
	 * 		    it is used by other member
	 *
	 */
	public function check_username($username = ""){
		$this->db->select("username");
		$this->db->from("users");
		$this->db->where("username",$username);
		$query  = $this->db->get();
		$result = $query->row() ?  false:  true ;
		return $result;
	}
	
	
	/*
	 *	Check Email function
	 *	
	 * 	will check if Email is already been used by other member
	 *   
	 *
	 *	@access public
	 *	@param  email string
	 *	@return true for applicable  email false if 
	 * 		    it is used by other member
	 *
	 */
	public function check_email($email = ""){
		$this->db->select("email");
		$this->db->from("users");
		$this->db->where("email",$email);
		$query  = $this->db->get();
		$result = $query->row() ?  false:  true ;
		return $result;
	}
	
	/*
	 *	Login function
	 *	
	 * 	will Process login for user
	 *   
	 *
	 *	@access public
	 *	@param  0
	 *	@return true when login parameter is correct false otherwise 
	 * 		    
	 *
	 */
	public function login(){
		$email = $this->input->post("loginEmail");
		$password = md5($this->input->post("loginPass"));
		
		$this->db->select("*");
		$this->db->from("users");
		$this->db->where("email",$email);
		$this->db->where("password",$password);
		$query = $this->db->get();
		$result = $query->row();
		
		if($result){
			//user login success
			$this->set_user_session($result);
			if(!$this->session->userdata('logged_in')){
				throw new Exception("login Failed try again");
			}
		}else{
			//login is not success
			//check if user email is correct to send error message other wise
			if($this->check_email($email) == false){
				throw new Exception("Password is not correct ");
			}else{
				throw new Exception("Email is not registered");
			}
		}
	}
	
	/*
	 *	Login function
	 *	
	 * 	will Process Logout for user
	 *   
	 *
	 *	@access public
	 *	@param  0
	 *	@return true when logout Successfully false otherwise 
	 * 		    
	 *
	 */
	public function logout(){
		$data =[
			'user_id',
			'username',
			'email',
			'join_time',
			'img_url',
			'logged_in'
		];
		$this->session->unset_userdata($data);
		$this->session->sess_destroy();
		
		if($this->session->userdata("logged_in")){
			throw new Exception("Logout fail try again");
		}
	}
	
	/*
	 *	update function
	 *	
	 * 	will update user information
	 *   
	 *
	 *	@access public
	 *	@param  0
	 *	@return true when update done successfully false otherwise 
	 * 		    
	 *
	 */
	public function update_user(){
		$id = $this->session->userdata('user_id');
		$username  = $this->input->post('username');
		$email     = $this->input->post('email');
		$firstname = $this->input->post('firstname');
		$lastname  = $this->input->post('lastname');
		
		$this->db->set('username',$username);
		$this->db->set('email',$email);
		$this->db->set('firstName',$firstname);
		$this->db->set('lastName',$lastname);
		
		$this->db->where('id',$id);
		if(!$this->db->update('users')){
			throw new mysql_exception('Your Data has not been updated try again');
		}
	}
	
	
	/*
	 *	Set User data Session function
	 *	
	 * 	setup user data session
	 *   
	 *
	 *	@access private
	 *	@param  user object
	 *	@return void
	 * 		    
	 *
	 */
	private function set_user_session($user){
		$data =[
			'user_id'   => $user->id,
			'username'  => $user->username,
			'email'     => $user->email   ,
			'join_time' => $user->joinDate,
			'img_url'   => $user->imgURL,
			'logged_in' => TRUE
		];
		$this->session->set_userdata($data);
	}
	
	
	
}