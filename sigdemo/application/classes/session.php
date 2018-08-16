<?php defined('SYSPATH') or die('No direct script access.');

abstract class Session extends Kohana_Session {
	public static function is_admin(){
		$ret = false;
		$admin_flag = Session::instance()->get(SESS_LOGIN_ADMIN_FLAG);
		if(isset($admin_flag) && $admin_flag === 1){
			$ret = true;
		}
		return $ret;
	}
	
	public static function get_user_client_id(){
		$ret = false;
		$client_id = Session::instance()->get(SESS_LOGIN_USER_CLIENT_ID);
		if(isset($client_id) && $client_id !== ""){
			$ret = $client_id;
		}
		return $ret;
	}
	
	public static function get_user_client_name(){
		$ret = false;
		$client_name = Session::instance()->get(SESS_LOGIN_USER_CLIENT_NAME);
		if(isset($client_name) && $client_name !== ""){
			$ret = $client_name;
		}
		return $ret;
	}
	
	public static function get_target_client_id(){
		$ret = false;
		// 20180109 hit_update
		// ログインクライアントに縛られないようにするため、nullを返却
		//$client_id = Session::instance()->get(SESS_LOGIN_TARGET_CLIENT_ID);
		//if(isset($client_id) && $client_id !== ""){
		//	$ret = $client_id;
		//}
		//return $ret;
		return null;
	}
	
	public static function get_target_client_name(){
		$ret = false;
		$client_name = Session::instance()->get(SESS_LOGIN_TARGET_CLIENT_NAME);
		if(isset($client_name) && $client_name !== ""){
			$ret = $client_name;
		}
		return $ret;
	}

	public static function get_disp_module_name(){
		$ret = false;
		$disp_module_name = Session::instance()->get(SESS_DISP_MODULE_NAME);
		if(isset($disp_module_name) && $disp_module_name !== ""){
			$ret = $disp_module_name;
		}
		return $ret;
	}
	
	public static function get_login_db_user(){
		$user_id = Auth::instance()->get_user();
		if(isset($user_id)){
			$user_id = DB_USER_PREFIX_USER . $user_id;
		}
		return $user_id;
	}
}

