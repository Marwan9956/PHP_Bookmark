<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_upload {
	
	public function __construct(){
		
	}
	
	
	public function upload_file($file,$path,$maxsize = 2000){
		//getting size in KB kilobayte
		$maxsize = $maxsize * 1000;
		
		//is_uploaded_file
		
		//type sample image/png
		// sample path 'assets/img/user_profiles/'
		try{
			if(isset($file['name'])){
				$filename = $file['name'];
				$type 	  = $file['type'];
				$tmp  	  = $file['tmp_name'];
				$error    = $file['error'];
				$size     = $file['size'];
				if($size <= $maxsize){
					if(!move_uploaded_file($tmp, $path. $filename)){
						throw new Exception('File is not uploaded');
					}
				}else{
					throw new Exception('File size is more then the maximum size allowed 2000KB');
				}
			}else{
				throw new Exception('File is not Set check your upload');
			}
			
		}catch (Exception $e) {
			echo "Oops! " . $e->getMessage();
		}
		
	}
	
	private function check_file_type($file_type,$allowed_type){
		
	}

	private function check_file_size($file_size,$allowed_size){
		
	}
	
	public function upload_files(){
		
	}
}