<?php

class Bookmark_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function getBookmarks(){
		$this->db->select('*');
		$this->db->from('bookmark');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getBookmarkById($id){
		$this->db->select('*');
		$this->db->from('bookmark');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function getAllCategories(){
		$this->db->select("*");
		$this->db->from("categories");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function add_bookmark(){
		$user_id = $this->session->userdata('user_id');
		$title 	 = $this->input->post("title");
		$url   	 = $this->input->post("bookmark_url");
		$cat_id  = $this->input->post("category_id");
		
		$data = [
			'user_id'     => $user_id,
			'category_id' => $cat_id,
			'title'	  	  => $title,
			'url'     	  => $url
		];
		
		if(!$this->db->insert('bookmark',$data)){
			throw new mysql_exception("There is an error on the server your bookmark was not add try again");
		}
		
	}
	
	public function edit($id){
		$title = $this->input->post('title');
		$url   = $this->input->post('bookmark_url');
		$cat_id= $this->input->post('category_id');
		
		$data=[
			'title' => $title,
			'url'   => $url,
			'category_id' => $cat_id
		];
		
		$this->db->where('id',$id);
		
		if(!$this->db->update('bookmark',$data)){
			throw new mysql_exception("There is an error on the server your bookmark was not Updated with new value try again");
		}
	}
	
	public function delete_bookmark($id){
		$this->db->where('id',$id);
		if(!$this->db->delete('bookmark')){
			throw new mysql_exception("There is an error on the server your bookmark was not Delete Successfully try again");
		}
	}
}