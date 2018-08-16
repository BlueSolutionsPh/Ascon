<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller extends Kohana_Controller {
	protected $module_name = null;
	
	protected function login_check(){
		if(Auth::instance()->logged_in() !== true){
			//Redirect to login screen when not logged in
			$this->request->redirect(MODULE_NAME_LOGIN);
		} else {
			//Confirm existence of client to login
//			if($this->get_user_client_id() && $this->get_target_client_id()){
				$db = Database::instance();
				$m_client = new Model_M_Client($db);
				
				//Set the client name
				$user_client = $m_client->sel($this->get_user_client_id());
				if(!empty($user_client[0])){
					Session::instance()->set(SESS_LOGIN_USER_CLIENT_NAME, $user_client[0]->client_name);
				}
				
				$target_client = $m_client->sel($this->get_target_client_id());
				if(!empty($target_client[0])){
					Session::instance()->set(SESS_LOGIN_TARGET_CLIENT_NAME, $target_client[0]->client_name);
				}
//			}

			//If logged in, update session ID
			Session::instance()->regenerate();
		}
	}
	
	protected function admin_check(){
		$admin_flag = Session::instance()->get(SESS_LOGIN_ADMIN_FLAG);
		if(!isset($admin_flag) || $admin_flag !== 1){
			//Redirecting to the menu screen access to administrator-only page except for administrator
			$this->request->redirect(MODULE_NAME_MENU);
		}
	}
	
	protected function auth_check($module, $auth = null){
		if(!Auth::auth_check($module, $auth)){
			//Redirecting to the menu screen access to administrator-only page except for administrator
			$this->request->redirect(MODULE_NAME_MENU);
		}
	}
	
	protected function target_client_check(){
		if(Session::get_target_client_id() === false){
			$this->request->redirect(MODULE_NAME_MENU);
		}
	}
	
	protected function get_login_db_user(){
		$user_id = Auth::instance()->get_user();
		if(isset($user_id)){
			$user_id = DB_USER_PREFIX_USER . $user_id;
		}
		return $user_id;
	}
	
	protected function get_user_client_id(){
		return Session::get_user_client_id();
	}
	
	protected function get_user_client_name(){
		return Session::get_user_client_name();
	}
	
	protected function get_target_client_id(){
		return Session::get_target_client_id();
	}
	
	protected function get_target_client_name(){
		return Session::get_target_client_name();
	}
}