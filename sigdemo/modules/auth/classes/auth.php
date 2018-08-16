<?php defined('SYSPATH') or die('No direct access allowed.');

abstract class Auth extends Kohana_Auth {
	public static function auth_check($module, $auth = null){
		if(Session::is_admin()){
			//The whole administrator unconditionally holds all authority
			return true;
		}

		$ret = false;
		$arr_auth = Session::instance()->get(SESS_ARR_USER_AUTH);
		if(array_key_exists($module, $arr_auth)){
			if(isset($auth)){
				foreach($arr_auth[$module] as $sess_auth){
					if($sess_auth === $auth){
						$ret = true;
						break;
					}
				}
			} else {
				$ret = true;
			}
		}
		return $ret;
	}
}
