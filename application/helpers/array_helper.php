<?php 
if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 *	CodeIgniter Const var helpers
 *
 *	@package Array Helper
 *	@author Marwan Saleh
 */


/*
 *	Linear Sort
 *	Sort Associative Array numerical on specific key 	
 *
 * 	@access	public
 * 	@param	array  and key 
 *	@return array sorted on the provided key 
 *
 */
function sortArr($arr,$key){
	$switch = 0;
	do{
		$switch = 0;
		for($i =0; $i < count($arr)-1 ;$i++){
			if($arr[$i]->$key < $arr[$i+1]->$key){
				$arr = $this->switch_arr_index($arr,$i,$i+1);
				$i = 0;
				$switch = 1;
			}
		}
	}while($switch > 0);
	return $arr;
	
}



/*
 *	Switch Elements in array 
 *	Switch Elements in array by index  	
 *
 * 	@access	public
 * 	@param	array  and index of first element and index of second element 
 *	@return array after switch
 *
 */
function switch_arr_index($arr , $fromIndex, $toIndex){
	$tmp = $arr[$fromIndex];
	$arr[$fromIndex] = $arr[$toIndex];
	$arr[$toIndex] = $tmp;
	return $arr;
}
