<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_User($this->get_target_client_id());
		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
				break;
			case ACTION_UP:
				//update
				parent::disp_up_before();
				$this->disp_up();
				parent::disp_up_after();
				break;
			case ACTION_DEL:
				//Delete
				parent::disp_del_before();
				$this->disp_del();
				parent::disp_del_after();
				break;
			default:
				//List
				parent::disp_list_before();
				$this->disp_list();
				parent::disp_list_after();
				break;
		}
	}
	
	/**
	 * List screen display
	 */
	private function disp_list(){
		//Acquisition of data number
		$all_user_cnt = $this->model->sel_cnt_user($this->search);
		
		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_user_cnt[0]->cnt,
		));
		
		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_user = $this->model->sel_arr_user($this->search);
		
		//Set value to template
		$this->head_add = "head.user.template";
		$this->template->arr_all_auth_grp = Controller_Template::get_arr_auth_grp();
		$this->template->all_user_cnt = $all_user_cnt[0]->cnt;
		$this->template->arr_user = $arr_user;
		$this->template->pagination = $pagination->render();
		
		// Create user name list
		$arr_ret = array();
		$arr_ret[""] = "";
		if(!empty($arr_user)){
			foreach($arr_user as $user){
				$arr_ret[$user->user_id] = $user->user_name;
			}
		}
		$this->template->arr_user_name = $arr_ret;
	}
	
	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('user.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('user.ins_post');
				
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Store in session
				$this->session->set('user.ins_post', $this->post);
				
				//Template selection
				$this->template->set_filename("user.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('user.ins_post')){
				$this->post = $this->session->get('user.ins_post');
				$this->session->delete('user.ins_post');
			}
		}
		
		//Set value to template
		$this->template->arr_all_shop = Controller_Template::get_arr_shop();
		$this->template->arr_all_auth_grp = Controller_Template::get_arr_auth_grp();
		$this->template->arr_all_invalid_flag = Controller_Template::get_arr_invalid();
		$this->template->arr_all_client = Controller_Template::get_arr_client();
	}
	
	/**
	 * Registration validation
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('user_name', 'not_empty')
				->rule('user_name', 'max_length', array(':value', '20'))
				->rule('user_name', 'user_name_exists')
				->rule('login_acnt', 'not_empty')
				->rule('login_acnt', 'email')
				->rule('login_acnt', 'max_length', array(':value', '256'))
				->rule('login_acnt', 'login_acnt_exists')
				->rule('passwd', 'not_empty')
				->rule('passwd', 'max_length', array(':value', '20'))
				->rule('passwd_veri', 'not_empty')
				->rule('passwd_veri', 'max_length', array(':value', '20'))
				->rule('passwd', 'matches', array(':validation', 'passwd', 'passwd_veri'))
				->rule('auth_grp_id', 'not_empty')
				->rule('invalid_flag', 'not_empty')
				->rule('invalid_flag', 'digit')
				->rule('invalid_flag', 'invalid_flag')
				->rule('client_id', 'not_empty')
				->rule('client_id', 'digit')
				->rule('client_id', 'client_id')
			;
			if($this->validation->check() === false){
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
				$ret = false;
			}
		}
		return $ret;
	}
	
	/**
	 * registration process
	 */
	private function ins(){
		$user = new Db_Ins();
		$user->client_id = $this->post["client_id"];
		$user->auth_grp_id = $this->post["auth_grp_id"];
		$user->login_acnt = $this->post["login_acnt"];
		$user->passwd = $this->post["passwd"];
		$user->user_name = $this->post["user_name"];
		$user->admin_flag = 0;
		$user->invalid_flag = $this->post["invalid_flag"];
		
		$this->model->db->begin();
		$user_id = $this->model->sel_next_user_id();
		$user->user_id = $user_id;
		$ret = $this->model->ins_user($user);
		
		return $this->model->db->end($ret);
	}
	
	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$user_id = $this->post["user_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		
		$user = $this->model->sel_user($user_id);
		if(empty($user[0])){
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$user = $user[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('user.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('user.up_post');
				
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
				if(empty($this->post["arr_tag"])){
					$this->post["arr_tag"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('user.up_post', $this->post);
				
				//Template selection
				$this->template->set_filename("user.up_conf.template");
			}
		} else {
			//No data update (initial display)
			$this->post = array();
			$this->post["user_id"] = $user->user_id;
			$this->post["user_name"] = $user->user_name;
			$this->post["login_acnt"] = $user->login_acnt;
			$this->post["passwd"] = "";
			$this->post["passwd_veri"] = "";
			$this->post["auth_grp_id"] = $user->auth_grp_id;
			$this->post["client_id"] = $user->client_id;
			$this->post["invalid_flag"] = $user->invalid_flag;
			//If there is session data set as initial value
			if($this->session->get('user.up_post')){
				$this->post = $this->session->get('user.up_post');
				$this->session->delete('user.up_post');
			}
		}
		
		//Set value to template
		$this->template->arr_all_shop = Controller_Template::get_arr_shop();
		$this->template->arr_all_auth_grp = Controller_Template::get_arr_auth_grp();
		$this->template->arr_all_invalid_flag = Controller_Template::get_arr_invalid();
		$this->template->arr_all_client = Controller_Template::get_arr_client();
	}
	
	/**
	 * Update validation
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('user_id', 'not_empty')
				->rule('user_id', 'digit')
				->rule('user_id', 'user_id')
				->rule('user_name', 'not_empty')
				->rule('user_name', 'max_length', array(':value', '20'))
				->rule('user_name', 'user_name_exists_exclude_id', array(':validation', 'user_name', 'user_id'))
				->rule('login_acnt', 'not_empty')
				->rule('login_acnt', 'max_length', array(':value', '256'))
				->rule('login_acnt', 'email')
				->rule('login_acnt', 'login_acnt_exists_exclude_id', array(':validation', 'login_acnt', 'user_id'))
				->rule('passwd', 'not_empty')
				->rule('passwd', 'max_length', array(':value', '20'))
				->rule('passwd_veri', 'not_empty')
				->rule('passwd_veri', 'max_length', array(':value', '20'))
				->rule('passwd', 'matches', array(':validation', 'passwd', 'passwd_veri'))
				->rule('auth_grp_id', 'not_empty')
				->rule('invalid_flag', 'not_empty')
				->rule('invalid_flag', 'digit')
				->rule('invalid_flag', 'invalid_flag')
				->rule('client_id', 'not_empty')
				->rule('client_id', 'digit')
				->rule('client_id', 'client_id')
			;
			if($this->validation->check() === false){
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
				$ret = false;
			}
		}
		return $ret;
	}
	
	/**
	 * Update processing
	 */
	private function up()
	{
		$user = new Db_Up();
		$user->user_id = $this->post["user_id"];
		$user->client_id = $this->post["client_id"];
		$user->auth_grp_id = $this->post["auth_grp_id"];
		$user->login_acnt = $this->post["login_acnt"];
		$user->passwd = $this->post["passwd"];
		$user->user_name = $this->post["user_name"];
		$user->invalid_flag = $this->post["invalid_flag"];
		$user->note = $this->post["note"];
		
		$this->model->db->begin();
		$ret = $this->model->up_user($user);
		
		return $this->model->db->end($ret);
	}
	
	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$user_id = $this->post["user_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		
		$user = null;
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($user_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$user = $this->model->sel_user_name($user_id);
			if(!empty($user[0])){
				$user = $user[0];
			} else {
				$user = null;
			}
		}
		
		//Set value to template
		if(!is_null($user)){
			$this->template->user_id = $user_id;
			$this->template->user_name = $user->user_name;
		} else {
			//Redirect to list if parameter is invalid
			$this->session->set($this->module_name, array(ACTION_DEL => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
	}
	
	/**
	 * Deletion validation
	 */
	private function del_validation(){
		$ret = true;
		$this->validation = Validation::factory($this->post)
			->rule('user_id', 'not_empty')
			->rule('user_id', 'user_id')
		;
		if($this->validation->check() === false){
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Deletion processing
	 */
	private function del($user_id){
		$this->model->db->begin();
		$user = new Db_Up();
		$user->user_id = $user_id;
		$ret = $this->model->del_user($user);
		return $this->model->db->end($ret);
	}
}