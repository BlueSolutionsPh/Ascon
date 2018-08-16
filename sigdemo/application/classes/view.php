<?php defined('SYSPATH') or die('No direct script access.');

class View extends Kohana_View {
	public static $arr_err_col_name = array(
		"arr_dev" => "Terminal:",
		"auth_grp_id" => "Authority:",
		"auth_grp_name" => "Authority name:",
		"booth" => "booth:",
		"booth_id" => "booth:",
		"booth_name" => "Booth name:",
		"ch1" => "playlist:",
		"client_name" => "client name:",
		"common_paylist_name" => "Common playlist name:",
		"dev_html_rela_name" => "HTML delivery name:",
		"dev_name" => "Device name:",
		"draw_tmpl_id" => "template:",
		"draw_size" => "size:",
		"dt" => "Date and time:",
		"end_date" => "End date:",
		"end_dt" => "End date and time:",
		"end_time" => "End time:",
		"html" => "HTML：",
		"html_file" => "HTHTML file: ML:",
		"html_name" => "HTML name:",
		"image_file" => "Still image file:",
		"image_intvl" => "Image switching interval (sec):",
		"image_name" => "Still image name:",
		"image_exte" => "Still image extension:",
		"invalid_flag" => "State:",
		"login_acnt" => "account:",
		"max_total_cts_file_size" => "Content file size Total:",
// 		"movie_file" => "Movie / audio file:",
		"movie_file" => "Movie:",
		"movie_name" => "Movie name:",
		"sound_orig_file_name" => "Movie name:",
		"note" => "Remarks:",
		"orig_file_name" => "file name:",
		"passwd" => "password:",
		"passwd_veri" => "(Re-enter)password：",
		"play_time" => "Playback time:",
		"playlist" => "playlist:",
		"playlist_name" => "Playlist name:",
		"prog_date" => "Delivery Date:",
		"prog_name" => "Program guide name:",
		"serial_no" => "Serial number:",
		"session" => "Invalid screen transition",
		"shop" => "Facility:",
		"shop_name" => "Name of facility:",
		"post" => "Postal code:",
		"lat" => "latitude:",
		"lon" => "longitude:",
		"sta_date" => "start date:",
		"sta_dt" => "Start date and time:",
		"sta_time" => "Start time:",
		"tag_cat_id" => "Tag classification:",
		"tag_name" => "Tag name:",
		"target_client" => "client:",
		"text_msg" => "Ticker contents:",
		"text_name" => "Ticker name:",
		"time" => "Times of Day:",
		"timezone_id" => "Delivery time zone:",
		"user_name" => "Administrator's name:",
		"wifissid" => "Wi-Fi SSID：",
		"wifipass" => "Wi-Fi password:"
	);
	
	public static $arr_err_detail = array(
		"client_total_file_size" => "Content file size total exceeded",
		"alpha_dash" => "
Half size alphabet",
		"alpha_numeric" => "
Half size alphabet",
		"date" => "Date and time format",
		"digit" => "Numeric format",
		"dt_equal" => "Starting end date and time Same",
		"dt_future" => "Future date and time",
		"dt_past" => "Past date and time",
		"dt_reverse" => "Start and end date and time",
		"email" => "Email format",
		"equal" => "Start end time Same",
		"exte" => "Extension",
		"file" => "File contents",
		"image_file_name_exists_soldout" => "No update object",
		"image_exte" => "Still image extension",
		"numeric" => "Numeric format",
		"matches" => "Mismatch",
		"max_length" => "number of characters",
// 		"movie_exte" => "Movie and audio extension",
		"movie_exte" => "Movie extension",
		"not_empty" => "Required",
		"positive_int" => "Numeric format (1 or more)",
		"reverse" => "Start / finish time around",
		"size" => "size inconsistency",
		"time" => "time format",
		"target_client" => "Client selection",
		"sound_name_length" => "number of characters"
	);
	
	public static function get_param_str($param_str){
		$ret = "";
		if(isset($param_str) && $param_str !== ""){
			$ret = $param_str;
		}
		return $ret;
	}
	
	public static function get_param_arr($param_arr){
		$ret = null;
		if(isset($param_arr) && is_array($param_arr)){
			$ret = $param_arr;
		} else {
			$ret = array();
		}
		return $ret;
	}
	
	public static function get_movie_exte(){
		$ret_msg = "";
		$i = 0;
// 		$arr_exte = array_merge(Controller_Movie::$arr_movie_exte, Controller_Movie::$arr_sound_exte);
		$arr_exte = array_merge(Controller_Movie::$arr_movie_exte);
		foreach($arr_exte as $exte){
			if($i > 0){
				$ret_msg .= " / ";
			}
			$ret_msg .= $exte;
			$i++;
		}
		return $ret_msg;
	}
	
	public static function get_sound_exte(){
		$ret_msg = "";
		$i = 0;
		$arr_exte = Controller_Movie::$arr_sound_exte;
		foreach($arr_exte as $exte){
			if($i > 0){
				$ret_msg .= " / ";
			}
			$ret_msg .= $exte;
			$i++;
		}
		return $ret_msg;
	}
	
	public static function get_image_exte(){
		$ret_msg = "";
		$i = 0;
		$arr_exte = Controller_Image::$arr_image_exte;
		foreach($arr_exte as $exte){
			if($i > 0){
				$ret_msg .= " / ";
			}
			$ret_msg .= $exte;
			$i++;
		}
		return $ret_msg;
	}
	
	public static function get_html_exte(){
		$ret_msg = "";
		$i = 0;
		$arr_exte = Controller_Image::$arr_html_exte;
		foreach($arr_exte as $exte){
			if($i > 0){
				$ret_msg .= " / ";
			}
			$ret_msg .= $exte;
			$i++;
		}
		return $ret_msg;
	}
	
	public static function get_max_per_page_msg($arr){
		$ret_msg = "";
		if(!empty($arr) && count($arr) >= MAX_CNT_PER_PAGE){
			$ret_msg .= "<div class=\"msg\">There are more than ". MAX_CNT_PER_PAGE." search results. <br /> Please add search criteria.</div>";
		}
		return $ret_msg;
	}
	
	public static function get_action_msg($arr_action_result = null, $arr_error = null){
		$ret_msg = "";
		$ret_success_msg = "";
		$ret_error_msg = "";
		$ret_valid_error_msg = "";
		
		if(!empty($arr_action_result)){
			foreach($arr_action_result as $module_name => $action_result){
				if(isset($action_result[ACTION_INS])){
					if($action_result[ACTION_INS] === true){
						$ret_success_msg .= "<div style=\"color:#00F\">Has registered</div>";
					} else if($action_result[ACTION_INS] === false){
						$ret_error_msg .= "<div>Signup failed</div>";
					}
				}
				if(isset($action_result[ACTION_UP])){
					if($action_result[ACTION_UP] === true){
						$ret_success_msg .= "<div style=\"color:#00F\">Has been updated</div>";
					} else if($action_result[ACTION_UP] === false){
						$ret_error_msg .= "<div>Update failed</div>";
					}
				}
				if(isset($action_result[ACTION_COPY])){
					if($action_result[ACTION_COPY] === true){
						$ret_success_msg .= "<div style=\"color:#00F\">Duplicated</div>";
					} else if($action_result[ACTION_COPY] === false){
						$ret_error_msg .= "<div>Replication failed</div>";
					}
				}
				if(isset($action_result[ACTION_DEL])){
					if($action_result[ACTION_DEL] === true){
						$ret_success_msg .= "<div style=\"color:#00F\">It has been deleted</div>";
					} else if($action_result[ACTION_DEL] === false){
						$ret_error_msg .= "<div>Delete failed</div>";
					} 
				}
				if(isset($action_result[ACTION_LUMP_DEL])){
					if($action_result[ACTION_LUMP_DEL] === true){
						$ret_success_msg .= "<div style=\"color:#00F\">Bulk Deletion</div>";
					} else if($action_result[ACTION_LUMP_DEL] === false){
						$ret_error_msg .= "<div>Delete failed</div>";
					} 
				}
				if(isset($action_result[TARGET_NOT_FOUND_ERROR])){
					if($action_result[TARGET_NOT_FOUND_ERROR] === true){
						$ret_error_msg .= "<div>Target not found</div>";
					}
				}
				if(isset($action_result[MOVE_ERROR])){
					if($action_result[MOVE_ERROR] === true){
						$ret_error_msg .= "<div>The previous operation failed because an invalid screen transition was made</div>";
					}
				}
				Session::instance()->delete($module_name);
			}
		}
		
		if(!empty($arr_error)){
			$ret_valid_error_msg .= "<div class=\"error\">Input item is invalid</div>";
			$ret_valid_error_msg .= "<ul class=\"error_detail\">";
			foreach($arr_error as $key => $val){
				$ret_valid_error_msg .= "<li>";
				
				//item name
				if(array_key_exists($key, View::$arr_err_col_name)){
					$ret_valid_error_msg .= View::$arr_err_col_name[$key];
				} else if(strpos($key, "_id") !== false){
					$ret_valid_error_msg .= "Update target:";
				}
				
				//error contents
				if(array_key_exists($val[0], View::$arr_err_detail)){
					$ret_valid_error_msg .= View::$arr_err_detail[$val[0]];
				} else if(strpos($val[0], "exists") !== false){
					$ret_valid_error_msg .= "Overlap";
				} else if(strpos($val[0], "id") !== false){
					$ret_valid_error_msg .= "Absence";
				} else {
					$ret_valid_error_msg .= "Error";
				}
				$ret_valid_error_msg .= "</li>";
			}
			$ret_valid_error_msg .= "</ul>";
		}
		
		if(!empty($ret_error_msg)){
			$ret_error_msg = "<div class=\"error\">" . $ret_error_msg . "</div>";
		}
		if(!empty($ret_success_msg)){
			$ret_success_msg = "<div id=\"msg\"><h3 class=\"title\">Confirmation</h3><div class=\"content\">" . $ret_success_msg . "</div></div>"; 
		}
		if(!empty($ret_error_msg) || !empty($ret_valid_error_msg)){
			$ret_error_msg = "<div id=\"error\"><h3 class=\"title\">Error</h3><div class=\"content\">" . $ret_error_msg . $ret_valid_error_msg . "</div></div>";
		}
		$ret_msg = $ret_success_msg . $ret_error_msg;
		
		return $ret_msg;
	}
}
