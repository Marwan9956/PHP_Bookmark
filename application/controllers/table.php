<?php 
/*
 *	Table Controller 
 *	
 *	Handle Bookmark process and views
 *	@author Marwan
 */
 
class Table extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("bookmark_model");
	}
	
	/*
	 *	Index function -> /table
	 *	
	 *	@access public
	 *	@param  0
	 *	@return Bookmark Table  
	 *
	 */
	public function index(){
		if($this->session->userdata("logged_in")){
			//main content view 
			$data['title']		  =  SITE_TITLE . "Table";
			$data['view_content'] = 'table';
			$data['bookmarks']    = $this->bookmark_model->getBookmarks();
			//$data['user_bookmarks'] = $this->bookmark_model->getBookmarkById($id);
			
			$this->load->view('inc/main',$data);
		}else{
			$this->session->set_flashdata("Err_msg","You are not a member sign up first");
			redirect(base_url());
		}
	}
	
	/*
	 *	Index function -> /table/suggest
	 *	
	 *	@access public
	 *	@param  0
	 *	@return Bookmark Table  
	 *
	 */
	public function suggest(){
		//main content view 
		$data['title']		  =  SITE_TITLE . "Suggestion Table";
		$data['view_content'] = 'table';
		
		$this->load->view('inc/main',$data);
	}
	
	
	/*
	 *	Add function -> /table/add
	 *	
	 *	@access public
	 *	@param  0
	 *	@return   
	 *
	 */
	public function add(){
		if($this->session->userdata("logged_in")){
			//main content view 
			$data['title']		  =  SITE_TITLE . "Table";
			$data['view_content'] = 'addbookmark';
			
			
			$args = array([
				'field' =>  'title',
				'label' =>  'Title',
				'rules' =>  'required'
			],[
				'field' =>  'category_id',
				'label' =>  'Category',
				'rules' =>  'required'
			]);
			$this->form_validation->set_rules($args);
			// check url
			$url = $this->input->post("bookmark_url");
			$valid_url = filter_var($url, FILTER_VALIDATE_URL);
			
			if($this->form_validation->run() == false){
				$this->load->view('inc/main',$data);
			}else{
				
				if(!$valid_url){
					$this->session->set_flashdata("Err_msg","Not a Valid URL");
					redirect(base_url('table/add'));
				}else{
					try{
						$this->bookmark_model->add_bookmark();
						$this->session->set_flashdata("msg","Your bookmark added successfully");
						redirect(base_url('table'));
					}catch(mysql_exception $e){
						$this->session->set_flashdata("Err_msg",$e->getMessage());
						redirect(base_url('table/add'));
					}catch(Exception $e){
						//echo $e->getMessage();
					}
				}
			}
			
			
		}else{
			$this->session->set_flashdata("Err_msg","You are not a member sign up first");
			redirect(base_url());
		}
	}
	public function edit($id = ""){
		if(empty($id)){
			$this->session->set_flashdata("Err_msg","Your didn't add an id");
			redirect(base_url('table'));
		}
		//main content view 
		$data['title']		  =  SITE_TITLE . "Table";
		$data['view_content'] =  'edit_bookmark';
		
		$args = array([
			'field' =>  'title',
			'label' =>  'Title',
			'rules' =>  'required'
		],[
			'field' =>  'category_id',
			'label' =>  'Category',
			'rules' =>  'required'
		]);
		$this->form_validation->set_rules($args);
		
		
		
		$data['bookmark']     =  $this->bookmark_model->getBookmarkById($id);
		
		
		if($this->form_validation->run() == false){
			if(empty($data['bookmark']->id)){
				$this->session->set_flashdata("Err_msg","There is no bookmark with this id");
				redirect(base_url('table'));
			}
			$this->load->view('inc/main',$data);
		}else{
			//success
			
			//perform Editing bookmark by id
			try{
				$this->bookmark_model->edit($id);
				$this->session->set_flashdata("msg","Your bookmark Updated successfully");
				redirect(base_url('table'));
			}catch(mysql_exception $e){
				$this->session->set_flashdata("Err_msg",$e->getMessage());
				redirect(base_url('table'));
			}catch(Exception $e){
				$this->session->set_flashdata("Err_msg","There is an error on the server contact the admin");
				redirect(base_url('table'));
			}
			
		}
		
		
	}
	
	
	
	public function delete_bookmark($id = ""){
		if(empty($id)){
			$this->session->set_flashdata("Err_msg","Your didn't add an id");
			redirect(base_url('table'));
		}
		
		//perform delete bookmark by id
		try{
			$this->bookmark_model->delete_bookmark($id);
			$this->session->set_flashdata("msg","Your bookmark deleted successfully");
			redirect(base_url('table'));
		}catch(mysql_exception $e){
			$this->session->set_flashdata("Err_msg",$e->getMessage());
			redirect(base_url('table'));
		}catch(Exception $e){
			$this->session->set_flashdata("Err_msg","There is an error on the server contact the admin");
			redirect(base_url('table'));
		}
	}
}