<?php defined('SYSPATH') or die('No direct access allowed.');

class Kohana_Auth_Db extends Auth {
	/**
	 * Constructor loads the user list into the class.
	 */
	public function __construct($config = array())
	{
		parent::__construct($config);
	}

	/**
	 * Logs a user in.
	 *
	 * @param   string   username
	 * @param   string   password
	 * @param   boolean  enable autologin (not supported)
	 * @return  boolean
	 */
	protected function _login($username, $password, $remember)
	{
		$user = false;
		if(isset($username) && $username !== "" && isset($password) && $password !== ""){
			$model_auth = new Model_Auth();
			$user = $model_auth->sel_user_by_login_acnt_passwd($username, $password);

			if($user !== false){
				if(!empty($user[0]) && isset($user[0]->user_id) && $user[0]->user_id !== ""){
					$user_id = $user[0]->user_id;
					$client_id = $user[0]->client_id;
					$auth_grp_id = $user[0]->auth_grp_id;
					$admin_flag = $user[0]->admin_flag;

					Session::instance()->set(SESS_LOGIN_USER_CLIENT_ID, $client_id);
					Session::instance()->set(SESS_LOGIN_ADMIN_FLAG, $admin_flag);
					if($admin_flag !== 1){
						Session::instance()->set(SESS_LOGIN_TARGET_CLIENT_ID, $client_id);
					}

					//Authorization
					$arr_user_auth_rela = $model_auth->sel_arr_user_auth_rela($auth_grp_id, $client_id);
					$arr_auth = array();
					foreach($arr_user_auth_rela as $user_auth_rela){
						if(!isset($arr_auth[$user_auth_rela->module])){
							$arr_auth[$user_auth_rela->module] = array();
						}
						array_push($arr_auth[$user_auth_rela->module], $user_auth_rela->auth);
					}
					Session::instance()->set(SESS_ARR_USER_AUTH, $arr_auth);

					//Login success history registration
					$now = Request::$request_dt;
					$user_login_hist = new stdClass();
					$user_login_hist->user_id = $user_id;
					$user_login_hist->client_id = $client_id;
					$user_login_hist->success = 1;
					$user_login_hist->ip_addr = Request::$client_ip;
					$user_login_hist->create_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->create_dt = $now;
					$user_login_hist->update_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->update_dt = $now;
					$model_auth->ins_user_login_hist($user_login_hist);

					return $this->complete_login($user_id);
				}
			}

			//Login failure (input information error)
			$user = $model_auth->sel_user_by_login_acnt($username);
			if($user !== false){
				if(!empty($user[0]) && isset($user[0]->user_id) && $user[0]->user_id !== ""){
					//Create login failure history
					$user_id = $user[0]->user_id;
					$client_id = $user[0]->client_id;
					$now = Request::$request_dt;
					$user_login_hist = new stdClass();
					$user_login_hist->user_id = $user_id;
					$user_login_hist->client_id = $client_id;
					$user_login_hist->success = 0;
					$user_login_hist->ip_addr = Request::$client_ip;
					$user_login_hist->create_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->create_dt = $now;
					$user_login_hist->update_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->update_dt = $now;
					$model_auth->ins_user_login_hist($user_login_hist);
				}
			}
			return FALSE;
		}

		//Login failure (no input)
		return FALSE;
	}

	/**
	 * Logs a user in.
	 *
	 * @param   string   username
	 * @param   string   password
	 * @param   boolean  enable autologin (not supported)
	 * @return  boolean
	 */
	protected function _login_hash($username, $password, $remember)
	{
		$user = false;
		if(isset($username) && $username !== "" && isset($password) && $password !== ""){
			$model_auth = new Model_Auth();
			$user = $model_auth->sel_user_by_login_acnt_passwd_hash($username, $password);

			if($user !== false){
				if(!empty($user[0]) && isset($user[0]->user_id) && $user[0]->user_id !== ""){
					$user_id = $user[0]->user_id;
					$client_id = $user[0]->client_id;
					$auth_grp_id = $user[0]->auth_grp_id;
					$admin_flag = $user[0]->admin_flag;

					Session::instance()->set(SESS_LOGIN_USER_CLIENT_ID, $client_id);
					Session::instance()->set(SESS_LOGIN_ADMIN_FLAG, $admin_flag);
					if($admin_flag !== 1){
						Session::instance()->set(SESS_LOGIN_TARGET_CLIENT_ID, $client_id);
					}

					//Authorization
					$arr_user_auth_rela = $model_auth->sel_arr_user_auth_rela($auth_grp_id, $client_id);
					$arr_auth = array();
					foreach($arr_user_auth_rela as $user_auth_rela){
						if(!isset($arr_auth[$user_auth_rela->module])){
							$arr_auth[$user_auth_rela->module] = array();
						}
						array_push($arr_auth[$user_auth_rela->module], $user_auth_rela->auth);
					}
					Session::instance()->set(SESS_ARR_USER_AUTH, $arr_auth);

					//Login success history registration
					$now = Request::$request_dt;
					$user_login_hist = new stdClass();
					$user_login_hist->user_id = $user_id;
					$user_login_hist->client_id = $client_id;
					$user_login_hist->success = 1;
					$user_login_hist->ip_addr = Request::$client_ip;
					$user_login_hist->create_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->create_dt = $now;
					$user_login_hist->update_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->update_dt = $now;
					$model_auth->ins_user_login_hist($user_login_hist);

					return $this->complete_login($user_id);
				}
			}

			//Login failure (input information error)
			$user = $model_auth->sel_user_by_login_acnt($username);
			if($user !== false){
				if(!empty($user[0]) && isset($user[0]->user_id) && $user[0]->user_id !== ""){
					//Create login failure history
					$user_id = $user[0]->user_id;
					$client_id = $user[0]->client_id;
					$now = Request::$request_dt;
					$user_login_hist = new stdClass();
					$user_login_hist->user_id = $user_id;
					$user_login_hist->client_id = $client_id;
					$user_login_hist->success = 0;
					$user_login_hist->ip_addr = Request::$client_ip;
					$user_login_hist->create_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->create_dt = $now;
					$user_login_hist->update_user = DB_USER_PREFIX_USER . $user_id;
					$user_login_hist->update_dt = $now;
					$model_auth->ins_user_login_hist($user_login_hist);
				}
			}
			return FALSE;
		}

		//Login failure (no input)
		return FALSE;
	}

	/**
	 * Get the stored password for a username.
	 *
	 * @param   mixed   username
	 * @return  string
	 */
	public function password($username)
	{
	}

	/**
	 * Compare password with original (plain text). Works for current (logged in) user
	 *
	 * @param   string  $password
	 * @return  boolean
	 */
	public function check_password($password)
	{
	}

} // End Auth Db File
