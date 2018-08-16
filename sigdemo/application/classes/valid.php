<?php defined('SYSPATH') or die('No direct script access.');

class Valid extends Kohana_Valid {
	public static function client_total_file_size($arr, $file_size, $client_id){
		$ret = false;
		if(isset($arr[$file_size]) && $arr[$file_size] !== "" && isset($arr[$client_id]) && $arr[$client_id] !== ""){
			$file_size = File::get_client_file_size(str_pad(strval($arr[$client_id]), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT) . "/"); // 20180109 hit_update
			$file_size += $arr[$file_size];
			
			$db = Database::instance();
			$rec = Model_Util::sel_client_max_total_cts_file_size($arr[$client_id]); // 20180109 hit_update
			if(!empty($rec[0])){
				$rec = $rec[0];
				if($file_size <= $rec->max_total_cts_file_size){
					$ret = true;
				}
			};
		}
		return $ret;
	}
	
	public static function ants_version($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			if((string)$str === (string)ANTS_ONE_KIND || (string)$str === (string)ANTS_TWO_KIND)
				$ret = true;
		}
		return $ret;
	}
	
	public static function invalid_flag($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			if($str === "0" || $str === "1")
			$ret = true;
		}
		return $ret;
	}
	
	public static function unit_flag($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			if($str === "0" || $str === "1")
			$ret = true;
		}
		return $ret;
	}
	
	public static function sex_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			if($str === "0" || $str === "1")
			$ret = true;
		}
		return $ret;
	}
	
	public static function deliverymonth_id($str){
		$ret = false;
		
		if(isset($str) && $str !== ""){
			if(0 <= intval($str) && intval($str) < 12)
			$ret = true;
		}
		return $ret;
	}
	public static function mail_flag($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			if($str === "0" || $str === "1")
				$ret = true;
		}
		return $ret;
	}
	
	public static function service_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Service($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function mailaddr_no_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_MAIL($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_mail_no($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function rotate_flag($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			if($str === "0" || $str === "1")
			$ret = true;
		}
		return $ret;
	}
	
	public static function random_flag($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			if($str === "0" || $str === "1")
				$ret = true;
		}
		return $ret;
	}
	
	public static function mail_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_MAIL($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function positive_int($str){
		$ret = true;
		if(isset($str) && $str !== "" && Kohana_Valid::digit($str)){
			if($str == 0 || preg_match("|^[1-9]{1}\d*$|", $str) === 0){
				$ret = false;
			}
		}
		return $ret;
	}
	
	public static function time($str){
		if(preg_match("|^\d{1,2}:\d{1,2}:\d{1,2}$|", $str)){
			//time
			return Kohana_Valid::date($str);
		} else if(preg_match("|^\d{1,2}:\d{1,2}$|", $str)){
			//time
			return Kohana_Valid::date($str);
		} else {
			//不正
			return false;
		}
	}
	
	public static function date($str){
		$ret = false;
		if(preg_match("|^\d{4}-\d{1,2}-\d{1,2}$|", $str)){
			//date
			$arr = explode("-", $str);
			if(checkdate($arr[1], $arr[2], $arr[0])){
				$ret = Kohana_Valid::date($str);
			}
		} else if(preg_match("|^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}:\d{1,2}$|", $str) || preg_match("|^\d{4}-\d{1,2}-\d{1,2} \d{1,2}:\d{1,2}$|", $str)){
			//datetime
			$arr = explode(" ", $str);
			$arr = explode("-", $arr[0]);
			if(checkdate($arr[1], $arr[2], $arr[0])){
				$ret = Kohana_Valid::date($str);
			}
		}
		return $ret;
	}
	
	public static function dt_equal($arr, $sta_dt, $end_dt){
		$ret = true;
		if(isset($arr[$end_dt]) && $arr[$end_dt] !== "" && Valid::date($arr[$end_dt])){
			if(isset($arr[$sta_dt]) && $arr[$sta_dt] !== "" && Valid::date($arr[$sta_dt])){
				$ret = !(strtotime($arr[$sta_dt]) === strtotime($arr[$end_dt]));
			}
		}
		return $ret;
	}
	
	public static function dt_reverse($arr, $sta_dt, $end_dt){
		$ret = true;
		if(isset($arr[$end_dt]) && $arr[$end_dt] !== "" && Valid::date($arr[$end_dt])){
			if(isset($arr[$sta_dt]) && $arr[$sta_dt] !== "" && Valid::date($arr[$sta_dt])){
				$ret = !(strtotime($arr[$sta_dt]) > strtotime($arr[$end_dt]));
			}
		}
		return $ret;
	}
	
	public static function dt_past($end_dt){
		$ret = true;
		if(isset($end_dt) && $end_dt != "" && Valid::date($end_dt)){
			$ret = !(strtotime($end_dt) < time());
		}
		return $ret;
	}
	
	public static function dt_future($end_dt){
		$ret = true;
		if(isset($end_dt) && $end_dt != "" && Valid::date($end_dt)){
			$ret = !(strtotime($end_dt) > time());
		}
		return $ret;
	}
	
	public static function client_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Client($db);
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function shop_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Shop($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function floor_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Floor($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function booth_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Booth($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function timezone_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Timezone($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function dev_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Dev($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function user_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_User($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function tag_id($arr, $tag_id, $tag_cat_id){
		$ret = true;
		if(isset($arr[$tag_id]) && $arr[$tag_id] !== "" && isset($arr[$tag_cat_id]) && $arr[$tag_cat_id] !== ""){
			$arr_chk_tag = null;
			$db = Database::instance();
			switch($arr[$tag_cat_id]){
				case "movie":
					$model = new Model_M_Movie_Tag($db, Session::get_target_client_id());
					break;
				case "image":
					$model = new Model_M_Image_Tag($db, Session::get_target_client_id());
					break;
				case "text":
					$model = new Model_M_Text_Tag($db, Session::get_target_client_id());
					break;
				case "html":
					$model = new Model_M_Html_Tag($db, Session::get_target_client_id());
					break;
				case "dev":
					$model = new Model_M_Dev_Tag($db, Session::get_target_client_id());
					break;
				case "shop":
					$model = new Model_M_Shop_Tag($db, Session::get_target_client_id());
					break;
			}
			if(isset($model)){
				$rec = $model->sel_id($arr[$tag_id]);
				$ret = !empty($rec[0]);
			}
		}
		return $ret;
	}
	
	public static function property_id($arr, $property_id){
		$ret = true;
		if(isset($arr[$property_id]) && $arr[$property_id] !== "" ){
			$arr_chk_tag = null;
			$db = Database::instance();
			$model = new Model_M_Property($db, Session::get_target_client_id());

			if(isset($model)){
				$rec = $model->sel_id($arr[$property_id]);
				$ret = !empty($rec[0]);
			}
		}
		return $ret;
	}

	public static function auth_grp_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Auth_Grp($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function movie_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Movie($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function image_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Image($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function text_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Text($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function html_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Html($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function common_movie_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Movie($db);
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function common_image_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Image($db);
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function common_text_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Text($db);
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function playlist_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Playlist($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	public static function commonplaylist_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Commonplaylist($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function prog_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Prog($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function dev_html_rela_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Dev_Html_Rela($db, Session::get_target_client_id());
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function draw_tmpl_id($str){
		$ret = false;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Draw_Tmpl($db);
			$rec = $model->sel_id($str);
			$ret = !empty($rec[0]);
		}
		return $ret;
	}
	
	public static function tag_name_exists($arr, $tag_name, $tag_cat_id){
		$ret = true;
		if(isset($arr[$tag_name]) && $arr[$tag_name] !== "" && isset($arr[$tag_cat_id]) && $arr[$tag_cat_id] !== ""){
			$arr_chk_tag = null;
			$db = Database::instance();
			switch($arr[$tag_cat_id]){
				case "movie":
					$model = new Model_M_Movie_Tag($db, Session::get_target_client_id());
					break;
				case "image":
					$model = new Model_M_Image_Tag($db, Session::get_target_client_id());
					break;
				case "text":
					$model = new Model_M_Text_Tag($db, Session::get_target_client_id());
					break;
				case "html":
					$model = new Model_M_Html_Tag($db, Session::get_target_client_id());
					break;
				case "dev":
					$model = new Model_M_Dev_Tag($db, Session::get_target_client_id());
					break;
				case "shop":
					$model = new Model_M_Shop_Tag($db, Session::get_target_client_id());
					break;
			}
			if(isset($model)){
				$arr_rec = $model->sel_arr_id_by_name($arr[$tag_name]);
				$ret = empty($arr_rec[0]);
			}
		}
		return $ret;
	}
	
	public static function property_name_exists($arr, $property_name){
		$ret = true;
		if(isset($arr[$property_name]) && $arr[$property_name] !== ""){
			$db = Database::instance();
			$model = new Model_M_Property($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($arr[$property_name]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function property_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Property($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function auth_grp_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Auth_Grp($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function auth_grp_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Auth_Grp($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function client_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Client($db);
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function client_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Client($db);
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function shop_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Shop($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function shop_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Shop($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function dev_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Dev($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function dev_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Dev($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function dev_html_rela_dt_exists($arr, $arr_dev_id, $sta_dt, $end_dt){
		$ret = true;
		if(isset($arr[$arr_dev_id]) && is_array($arr[$arr_dev_id]) && isset($arr[$sta_dt]) && $arr[$sta_dt] !== "" && isset($arr[$end_dt]) && $arr[$end_dt] !== ""){
			if(Valid::date($arr[$sta_dt]) && Valid::date($arr[$end_dt])){
				$db = Database::instance();
				$model = new Model_T_Dev_Html_Rela($db, Session::get_target_client_id());
				$arr_rec = $model->sel_arr_id_by_arr_dev_id_sta_dt_end_dt($arr[$arr_dev_id], $arr[$sta_dt], $arr[$$end_dt]);
				$ret = empty($arr_rec[0]);
			}
		}
		return $ret;
	}
	
	public static function dev_html_rela_dt_exists_exclude_id($arr, $arr_dev_id, $sta_dt, $end_dt, $id){
		$ret = true;
		if(isset($arr[$arr_dev_id]) && is_array($arr[$arr_dev_id]) && isset($arr[$sta_dt]) && $arr[$sta_dt] !== "" && isset($arr[$end_dt]) && $arr[$end_dt] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			if(Valid::date($arr[$sta_dt]) && Valid::date($arr[$end_dt])){
				$db = Database::instance();
				$model = new Model_T_Dev_Html_Rela($db, Session::get_target_client_id());
				$arr_rec = $model->sel_arr_id_by_arr_dev_id_sta_dt_end_dt_exclude_id($arr[$arr_dev_id], $arr[$sta_dt], $arr[$$end_dt], $arr[$id]);
				$ret = empty($arr_rec[0]);
			}
		}
		return $ret;
	}
	
	public static function serial_no_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Dev($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_serial_no($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function serial_no_exists_exclude_id($arr, $serial_no, $id){
		$ret = true;
		if(isset($arr[$serial_no]) && $arr[$serial_no] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Dev($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_serial_no_exclude_id($arr[$serial_no], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function user_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_User($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function user_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_User($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function booth_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Booth($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function booth_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Booth($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function login_acnt_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_User($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_login_acnt($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function login_acnt_exists_exclude_id($arr, $login_acnt, $id){
		$ret = true;
		if(isset($arr[$login_acnt]) && $arr[$login_acnt] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_User($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_login_acnt_exclude_id($arr[$login_acnt], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function movie_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Movie($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function movie_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Movie($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function image_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Image($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function image_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Image($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function image_file_name_exists($arr, $file_name, $file_exte){
		$ret = true;
		if(isset($arr[$file_name]) && $arr[$file_name] !== "" && isset($arr[$file_exte]) && $arr[$file_exte] !== ""){
			$db = Database::instance();
			$model = new Model_M_Image($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_orig_file_name_exte($arr[$file_name], $arr[$file_exte]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function image_file_name_exists_soldout($arr, $file_name, $file_exte){
		$ret = true;
		if(isset($arr[$file_name]) && $arr[$file_name] !== "" && isset($arr[$file_exte]) && $arr[$file_exte] !== ""){
			$orig_file_name_1 = substr($arr[$file_name], 0, strlen($arr[$file_name]) - 1) . "1";
			$orig_file_name_2 = substr($arr[$file_name], 0, strlen($arr[$file_name]) - 1) . "2";
			$orig_file_exte = $arr[$file_exte];
			
			$db = Database::instance();
			$model = new Model_M_Image($db, Session::get_target_client_id());
			$arr_rec = $model->sel_image_by_orig_file_name_exte($orig_file_name_1, $orig_file_name_2, $orig_file_exte);
			$ret = !empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function text_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Text($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function text_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Text($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function html_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Html($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function html_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Html($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function common_movie_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Movie($db);
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function common_movie_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Movie($db);
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function common_image_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Image($db);
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function common_image_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Image($db);
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function common_image_file_name_exists($arr, $file_name, $file_exte){
		$ret = true;
		if(isset($arr[$file_name]) && $arr[$file_name] !== "" && isset($arr[$file_exte]) && $arr[$file_exte] !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Image($db);
			$arr_rec = $model->sel_arr_id_by_orig_file_name_exte($arr[$file_name], $arr[$file_exte]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function common_text_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Text($db);
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function common_text_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_M_Common_Text($db);
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function all_playlist_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Playlist($db);
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function playlist_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Playlist($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function playlist_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_T_Playlist($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function all_commonplaylist_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Commonplaylist($db);
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function commonplaylist_name_exists($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$db = Database::instance();
			$model = new Model_T_Commonplaylist($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($str);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function commonplaylist_name_exists_exclude_id($arr, $name, $id){
		$ret = true;
		if(isset($arr[$name]) && $arr[$name] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			$db = Database::instance();
			$model = new Model_T_Commonplaylist($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name_exclude_id($arr[$name], $arr[$id]);
			$ret = empty($arr_rec[0]);
		}
		return $ret;
	}
	
	public static function prog_dt_exists($arr, $arr_dev_id, $sta_dt, $end_dt){
		$ret = true;
		if(isset($arr[$arr_dev_id]) && is_array($arr[$arr_dev_id]) && isset($arr[$sta_dt]) && $arr[$sta_dt] !== "" && isset($arr[$end_dt]) && $arr[$end_dt] !== ""){
			if(Valid::date($arr[$sta_dt]) && Valid::date($arr[$end_dt])){
				$db = Database::instance();
				$model = new Model_T_Prog($db, Session::get_target_client_id());
				$arr_rec = $model->sel_arr_id_by_arr_dev_id_sta_dt_end_dt($arr[$arr_dev_id], $arr[$sta_dt], $arr[$$end_dt]);
				$ret = empty($arr_rec[0]);
			}
		}
		return $ret;
	}
	
	public static function prog_dt_exists_exclude_id($arr, $arr_dev_id, $sta_dt, $end_dt, $id){
		$ret = true;
		if(isset($arr[$arr_dev_id]) && is_array($arr[$arr_dev_id]) && isset($arr[$sta_dt]) && $arr[$sta_dt] !== "" && isset($arr[$end_dt]) && $arr[$end_dt] !== "" && isset($arr[$id]) && $arr[$id] !== ""){
			if(Valid::date($arr[$sta_dt]) && Valid::date($arr[$end_dt])){
				$db = Database::instance();
				$model = new Model_T_Prog($db, Session::get_target_client_id());
				$arr_rec = $model->sel_arr_id_by_arr_dev_id_sta_dt_end_dt_exclude_id($arr[$arr_dev_id], $arr[$sta_dt], $arr[$$end_dt], $arr[$id]);
				$ret = empty($arr_rec[0]);
			}
		}
		return $ret;
	}
	
	public static function target($arr, $target, $arr_dev, $shop_id){
		$ret = true;
		if($arr[$target] === "1" && empty($arr[$arr_dev])){
			$ret = false;
		} else if($arr[$target] === "0" && !isset($arr[$shop_id])){
			$ret = false;
		}
		return $ret;
	}
	
	public static function target_client($arr, $target_client, $arr_client){
		$ret = true;
		if($arr[$target_client] === "1" && empty($arr[$arr_client])){
			$ret = false;
		}
		return $ret;
	}
	
	public static function movie_exte($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$ret = false;
			$arr_exte = array_merge(Controller_Template::$arr_movie_exte, Controller_Template::$arr_sound_exte);
			foreach($arr_exte as $exte){
				if($str === $exte){
					$ret = true;
					break;
				}
			}
		}
		return $ret;
	}
	
	public static function image_exte($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$ret = false;
			$arr_exte = Controller_Template::$arr_image_exte;
			foreach($arr_exte as $exte){
				if($str === $exte){
					$ret = true;
					break;
				}
			}
		}
		return $ret;
	}
	
	public static function html_exte($str){
		$ret = true;
		if(isset($str) && $str !== ""){
			$ret = false;
			$arr_exte = Controller_Template::$arr_html_exte;
			foreach($arr_exte as $exte){
				if($str === $exte){
					$ret = true;
					break;
				}
			}
		}
		return $ret;
	}
	
	public static function sound_name_exists($arr){
		$ret = true;
		$db = Database::instance();
		foreach($arr['sound_orig_file_name'] as $file_name){
			$model = new Model_M_Movie($db, Session::get_target_client_id());
			$arr_rec = $model->sel_arr_id_by_name($file_name);
			$ret = empty($arr_rec[0]);
			if($ret){
				break;
			}
		}
		return $ret;
	}
	
	public static function sound_name_length($arr, $len){
		$ret = true;
		$max_len = intval($len);
		foreach($arr as $file_name){
			if(mb_strlen($file_name) > $max_len){
				$ret = false;
				break;
			}
		}
		return $ret;
	}
}