<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Login extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){

		//Redirect to menu if logged in
		if(Auth::instance()->logged_in() === true){
			$this->request->redirect(MODULE_NAME_MENU);
		}

		//Processing sorting
		$this->template->set_filename("login.template");
		if(isset($this->post)){
			if(isset($this->post["user"]) && isset($this->post["pass"])){
				//Number of login attempts increment
				$login_try_cnt = $this->session->get(SESS_LOGIN_TRY_CNT);
				if(!isset($login_try_cnt)){
					$this->session->set(SESS_LOGIN_TRY_CNT, 1);
				} else {
					$this->session->set(SESS_LOGIN_TRY_CNT, $login_try_cnt + 1);
				}

				//Login processing
				$user = $this->post["user"];
				$pass = $this->post["pass"];
				if($user !== "" && $pass !== ""){
					$is_login = Auth::instance()->login($user, $pass);
					if($is_login){
						//When login is successful, delete the login attempt counter and redirect it to the menu
						$this->session->delete(SESS_LOGIN_TRY_CNT);
						$this->request->redirect(MODULE_NAME_MENU);
					}
				}

				//Transition to another page when the number of login attempts is a multiple of the set number
				$login_try_cnt = $this->session->get(SESS_LOGIN_TRY_CNT);
				if(isset($login_try_cnt)){
					if(($login_try_cnt % LOGIN_FAULT_THRE) === 0){
						//TODO To change to a login failure warning page, password reset page, etc., describe the redirect destination
						//$this->request->redirect("");
					}
				}

				//Restore form when refreshing login failed
				$this->template->post = $this->post;
				$this->template->login_ng = true;
			} else {
				//Screen display
				$this->template->post = array();
				$this->template->post["user"] = "";
				$this->template->post["pass"] = "";
			}
		} else {
			//Initial display
			$this->template->post = array();
			$this->template->post["user"] = "";
			$this->template->post["pass"] = "";
		}
	}

	/**
	 * Direct login
	 */
	public function action_login(){
		//If you are already logged in, log out and reload
		if(Auth::instance()->logged_in() === true){
			Auth::instance()->logout(true);
			$this->request->redirect($this->request->uri());
		}

		if($this->request->param("param1", false) && $this->request->param("param2", false)){
			//Number of login attempts increment
			$login_try_cnt = $this->session->get(SESS_LOGIN_TRY_CNT);
			if(!isset($login_try_cnt)){
				$this->session->set(SESS_LOGIN_TRY_CNT, 1);
			} else {
				$this->session->set(SESS_LOGIN_TRY_CNT, $login_try_cnt + 1);
			}

			//Login processing
			$user = $this->request->param("param1");
			$pass = $this->request->param("param2");
			if($user !== "" && $pass !== ""){
				$is_login = Auth::instance()->login($user, $pass);
				if($is_login){
					$this->session->set(SESS_LOGIN_TARGET_CLIENT_ID, $this->session->get(SESS_LOGIN_USER_CLIENT_ID));

					//When login is successful, delete the login attempt counter and redirect it to sold out setting
					$this->session->delete(SESS_LOGIN_TRY_CNT);
					$this->request->redirect(MODULE_NAME_SOLDOUT);
				}
			}

			//Transition to another page when the number of login attempts is a multiple of the set number
			$login_try_cnt = $this->session->get(SESS_LOGIN_TRY_CNT);
			if(isset($login_try_cnt)){
				if(($login_try_cnt % LOGIN_FAULT_THRE) === 0){
					//TODO To change to a login failure warning page, password reset page, etc., describe the redirect destination
					//$this->request->redirect("");
				}
			}
		}

		//Display login screen at login failure
		$this->request->redirect($this->module_name);
	}

	/**
	 * Logout
	 */
	public function action_logout(){
		Auth::instance()->logout(true);
		$this->request->redirect($this->module_name);
	}
}
