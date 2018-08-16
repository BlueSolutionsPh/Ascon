<?php defined('SYSPATH') or die('No direct script access.');

class HTML extends Kohana_HTML {
	public static function fix_dt_str($str){
		if(isset($str) && strlen($str) > 16){
			$str = substr($str, 0, 16);
		}
		return $str;
	}
	
	
	public static function replace_empty_str($search, $property, $replace = "-")
	{
		$ret = $replace;
		if(isset($search) && isset($property)){
			if(is_array($property)){
				foreach($property as $item){
					if(is_string($item) && $item !== "" && isset($search->$item) && $search->$item !== ""){
						$search = $search->$item;
						if(is_string($search)){
							$ret = $search;
						}
					} else {
						break;
					}
				}
			} else if(is_string($property) && $property !== ""){
				if(isset($search->$property) && $search->$property !== ""){
					$ret = $search->$property;
				}
			}
		}
		return $ret;
	}
	
	public static function replace_empty_array_value($arr, $key, $replace = "")
	{
		$ret = $replace;
		if(isset($arr) && isset($key)){
			if(is_array($key)){
				foreach($key as $item){
					if((is_string($item) || is_int($item) ) && $item !== "" && isset($arr[$item]) && $arr[$item] !== ""){
						$arr = $arr[$item];
						if(is_string($arr)){
							$ret = $arr;
						}
					} else {
						break;
					}
				}
			} else if(is_string($key) && $key !== ""){
				if(is_array($arr) && !empty($arr) && isset($arr[$key])){
					$ret = $arr[$key];
				} else if(is_array($arr) && !empty($arr) && isset($arr[$key]) && is_array($arr[$key])){
					$ret = $arr[$key];
				}
			}
		}
		return $ret;
	}
}