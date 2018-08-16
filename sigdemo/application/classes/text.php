<?php defined('SYSPATH') or die('No direct script access.');

class Text extends Kohana_Text {
	public static function get_japanese_day_of_week($day_of_week){
		if(isset($day_of_week) && $day_of_week >= 0 && $day_of_week <= 6){
			$weekday = array( "Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday" );
			return $weekday[$day_of_week];
		} else {
			return false;
		}
	}
	public static function chk_str($arr, $str, $default = null){
		$ret = $default;
		if(isset($arr[$str]) && is_string($arr[$str]) && $arr[$str] !== ""){
			$ret = $arr[$str];
		}
		return $ret;
	}
}
