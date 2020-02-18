<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *	CodeIgniter Const var helpers
 *
 *	@package Array Helper
 *	@author Marwan Saleh
 */



/*
 *	Categories
 *	return all categories in the categories table 	
 *
 * 	@access	public
 * 	
 *	@return categories object
 *
 */

function categories(){
	$CI =& get_instance();
	return $CI->bookmark_model->getAllCategories();
}