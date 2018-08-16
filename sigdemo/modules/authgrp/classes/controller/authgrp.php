<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Authgrp extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Authgrp($this->get_target_client_id());
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
		$all_auth_grp_cnt = $this->model->sel_cnt_auth_grp($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_auth_grp_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_auth_grp = $this->model->sel_arr_auth_grp($this->search);
		foreach($arr_auth_grp as $auth_grp){
			$auth_grp->update_user = $this->get_user_name_from_db_user($auth_grp->update_user);
		}

		//Set value to template
		$this->head_add = "head.authgrp.template";
		$this->template->arr_auth_grp = $arr_auth_grp;
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('authgrp.ins_post');
			if($this->ins_validation() && $this->ins()){
				//With data registration...
				$this->session->delete('authgrp.ins_post');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
				if(empty($this->post["arr_auth"])){
					$this->post["arr_auth"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Store in session
				$this->session->set('authgrp.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("authgrp.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('authgrp.ins_post')){
				$this->post = $this->session->get('authgrp.ins_post');
				$this->session->delete('authgrp.ins_post');
			}
		}
		$arr_module = Controller_Template::get_arr_auth();
		$arr_module_cat = array();
		$arr_module_conf = array();
		foreach($arr_module as $module){
			$cat_child = Controller_Template::$arr_module_name_cat_map[$module["module"]];
			$cat_parent = Controller_Template::$arr_module_name_cat_map[$cat_child];
			if(!isset($arr_module_cat[$cat_parent])){
				$arr_module_cat[$cat_parent] = array();
			}
			if(!isset($arr_module_cat[$cat_parent][$cat_child])){
				$arr_module_cat[$cat_parent][$cat_child] = array();
			}
			array_push($arr_module_cat[$cat_parent][$cat_child], array("module" => $module["module"], "module_name" => $module["module_name"], "arr_auth" => $module["arr_auth"]));
			array_push($arr_module_conf, array("module" => $module["module"], "module_name" => $module["module_name"], "arr_auth" => $module["arr_auth"]));
		}
		$this->head_add = "head.authgrp.ins.template";
		$this->template->arr_module_cat = $arr_module_cat;
		$this->template->arr_module = $arr_module_conf;
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('auth_grp_name', 'not_empty')
				->rule('auth_grp_name', 'max_length', array(':value', '20'))
				->rule('auth_grp_name', 'auth_grp_name_exists')
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
		$auth_grp = new Db_Ins();
		$auth_grp->auth_grp_name = $this->post["auth_grp_name"];
		if(!empty($this->post["arr_auth"])){
			$arr_auth = $this->post["arr_auth"];
		} else {
			$arr_auth = array();
		}
		$this->model->db->begin();
		$auth_grp->auth_grp_id = $this->model->sel_next_auth_grp_id();
		$ret = $this->model->ins_auth_grp($auth_grp);

		//DB registration (authority group related)
		if($ret && !empty($arr_auth)){
			foreach($arr_auth as $auth_id){
				$auth_grp_rela = new Db_Ins();
				$auth_grp_rela->auth_grp_id = $auth_grp->auth_grp_id;
				$auth_grp_rela->auth_id     = $auth_id;
				$ret = $this->model->ins_auth_grp_rela($auth_grp_rela);
				if($ret === false){
					break;
				}
			}
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$auth_grp_id = $this->post["auth_grp_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$auth_grp = $this->model->sel_auth_grp($auth_grp_id);
		if(empty($auth_grp[0])){
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$auth_grp = $auth_grp[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('authgrp.up_post');
			if($this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('authgrp.up_post');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
				if(empty($this->post["arr_auth"])){
					$this->post["arr_auth"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('authgrp.up_post', $this->post);

				//Template selection
				$this->template->set_filename("authgrp.up_conf.template");
			}
		} else {
			$arr_auth_id = array();
			$arr_tmp_auth_grp_rela = $this->model->sel_arr_auth_grp_rela($auth_grp_id);
			foreach($arr_tmp_auth_grp_rela as $tmp_auth_grp_rela){
				array_push($arr_auth_id, $tmp_auth_grp_rela->auth_id);
			}

			//display
			$this->post["auth_grp_id"] = $auth_grp_id;
			$this->post["auth_grp_name"] = $auth_grp->auth_grp_name;
			$this->post["arr_auth"] = $arr_auth_id;

			//If there is session data set as initial value
			if($this->session->get('authgrp.up_post')){
				$this->post = $this->session->get('authgrp.up_post');
				$this->session->delete('authgrp.up_post');
			}
		}
		$arr_module = Controller_Template::get_arr_auth();
		$arr_module_cat = array();
		$arr_module_conf = array();
		foreach($arr_module as $module){
			$cat_child = Controller_Template::$arr_module_name_cat_map[$module["module"]];
			$cat_parent = Controller_Template::$arr_module_name_cat_map[$cat_child];
			if(!isset($arr_module_cat[$cat_parent])){
				$arr_module_cat[$cat_parent] = array();
			}
			if(!isset($arr_module_cat[$cat_parent][$cat_child])){
				$arr_module_cat[$cat_parent][$cat_child] = array();
			}
			array_push($arr_module_cat[$cat_parent][$cat_child], array("module" => $module["module"], "module_name" => $module["module_name"], "arr_auth" => $module["arr_auth"]));
			array_push($arr_module_conf, array("module" => $module["module"], "module_name" => $module["module_name"], "arr_auth" => $module["arr_auth"]));
		}
		$this->head_add = "head.authgrp.ins.template";
		$this->template->arr_module_cat = $arr_module_cat;
		$this->template->arr_module = $arr_module_conf;
	}

	/**
	 * Validation for registration
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('auth_grp_id', 'not_empty')
				->rule('auth_grp_id', 'digit')
				->rule('auth_grp_id', 'auth_grp_id')
				->rule('auth_grp_name', 'not_empty')
				->rule('auth_grp_name', 'max_length', array(':value', '20'))
				->rule('auth_grp_name', 'auth_grp_name_exists_exclude_id', array(':validation', 'auth_grp_name', 'auth_grp_id'))
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
	private function up(){
		$auth_grp = new Db_Up();
		$auth_grp->auth_grp_id = $this->post["auth_grp_id"];
		$auth_grp->auth_grp_name = $this->post["auth_grp_name"];
		if(!empty($this->post["arr_auth"])){
			$arr_auth = $this->post["arr_auth"];
		} else {
			$arr_auth = array();
		}
		$this->model->db->begin();
		$ret = $this->model->up_auth_grp($auth_grp);

		//DB registration (authority group related)
		if($ret){
			$arr_old_auth = $this->model->sel_arr_auth_grp_rela($auth_grp->auth_grp_id);
			foreach($arr_old_auth as $old_auth){
				$exists = false;
				foreach($arr_auth as $auth){
					if($old_auth->auth_id == $auth){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$auth_grp_rela = new Db_Up();
					$auth_grp_rela->auth_grp_id = $auth_grp->auth_grp_id;
					$auth_grp_rela->auth_id = $old_auth->auth_id;
					$this->model->del_auth_grp_rela($auth_grp_rela);
				}
			}

			foreach($arr_auth as $auth){
				$exists = false;
				foreach($arr_old_auth as $old_auth){
					if($old_auth->auth_id == $auth){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//If it does not exist, register
					$auth_grp_rela = new Db_Ins();
					$auth_grp_rela->auth_grp_id = $auth_grp->auth_grp_id;
					$auth_grp_rela->auth_id = $auth;
					$this->model->ins_auth_grp_rela($auth_grp_rela);
				}
			}
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$auth_grp_id = $this->post["auth_grp_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		if($this->act === "del"){
			//Delete data
			if($this->del_validation() && $this->del($auth_grp_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$auth_grp = $this->model->sel_auth_grp_name($auth_grp_id);
			if(!empty($auth_grp[0])){
				$auth_grp = $auth_grp[0];
			} else {
				$auth_grp = null;
			}
		}

		//Set value to template
		if(isset($auth_grp)){
			$this->template->auth_grp_id = $auth_grp_id;
			$this->template->auth_grp_name = $auth_grp->auth_grp_name;
		} else {
			//Redirect to list if parameter is invalid
			$this->session->set($this->module_name, array(ACTION_DEL => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
	}

	/**
	 * Validation for deletion processing
	 */
	private function del_validation(){
		$ret = true;
		$this->validation = Validation::factory($this->post)
			->rule('auth_grp_id', 'not_empty')
			->rule('auth_grp_id', 'digit')
			->rule('auth_grp_id', 'auth_grp_id')
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
	private function del($auth_grp_id){
		$this->model->db->begin();
		$auth_grp = new Db_Up();
		$auth_grp->auth_grp_id = $auth_grp_id;
		$ret = $this->model->del_auth_grp($auth_grp);
		return $this->model->db->end($ret);
	}
}
