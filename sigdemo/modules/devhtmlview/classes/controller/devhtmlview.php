<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Devhtmlview extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Devhtmlview($this->get_target_client_id());
		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				//It is unnecessary because disp_list_after is called in the function
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
		//Always obtain terminal ID from URL
		if($this->request->param("param1", false) === false){
			//Redirect to menu in case of illegal operation
			$this->request->redirect(MODULE_NAME_MENU);
		}
		$dev_id = $this->request->param("param1");
		$dev = $this->model->sel_dev($dev_id);
		if(!empty($dev[0])){
			$this->post["dev_id"] = $dev_id;
			$dev = $dev[0];

			$arr_dev_html_rela = $this->model->sel_arr_dev_html_rela($dev_id);
			foreach($arr_dev_html_rela as $html){
				//URL
				if(!empty($html->orig_file_exte)){
					$html->html_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/html/" . $html->file_name . $html->orig_file_exte;
				}
			}

			//Set value to template
			$this->head_add = "head.devhtmlview.ins.template";
			$this->template->dev_name = $dev->dev_name;
			$this->template->arr_all_html = Controller_Template::get_arr_html();
			$this->template->arr_dev_html_rela = $arr_dev_html_rela;
		} else {
			//Redirect to menu in case of illegal operation
			$this->request->redirect(MODULE_NAME_MENU);
		}
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			if($this->ins_validation() && $this->ins()){
				//success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->post = array();	//Clear condition
			} else {
				//失敗時
				$this->session->set($this->module_name, array(ACTION_INS => false));

			}
		} else {
			//Illegal operation
		}
		parent::disp_list_before();
		$this->disp_list();
		parent::disp_list_after();
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = true;
		$this->post["arr_dev"] = array($this->post["dev_id"]);
		$this->post["dt"] = $this->post["sta_dt"];	//Dummy variables for error display
		$this->validation = Validation::factory($this->post)
			->rule('dev_id', 'not_empty')
			->rule('dev_id', 'digit')
			->rule('dev_id', 'dev_id')
			->rule('dev_html_rela_name', 'not_empty')
			->rule('dev_html_rela_name', 'max_length', array(':value', '20'))
			->rule('html', 'not_empty')
			->rule('html', 'html_id')
			->rule('sta_dt', 'not_empty')
			->rule('sta_dt', 'date')
			->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
			->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
			->rule('end_dt', 'not_empty')
			->rule('end_dt', 'date')
			->rule('end_dt', 'dt_past')
			->rule('dt', 'dev_html_rela_dt_exists', array(':validation', 'arr_dev', 'sta_dt', 'end_dt'))
		;
		if($this->validation->check() === false){
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			$ret = false;
		}
		return $ret;
	}

	/**
	 * registration process
	 */
	private function ins(){
		$ret = true;
		$this->model->db->begin();
		$dev_id = $this->post["dev_id"];
		$dev_html_rela_id = $this->model->sel_next_dev_html_rela_id();
		if(is_null($dev_html_rela_id)){
			$ret = false;
		} else {
			$dev_html_rela = new Db_Ins();
			$dev_html_rela->dev_html_rela_id = $dev_html_rela_id;
			$dev_html_rela->dev_id = $dev_id;
			$dev_html_rela->dev_html_rela_name = $this->post["dev_html_rela_name"];
			$dev_html_rela->sta_dt = $this->post["sta_dt"];
			$dev_html_rela->end_dt = $this->post["end_dt"];
			$dev_html_rela->html_id = $this->post["html"];
			$dev_html_rela->inst_flag = 1;	//TODO Immediate flag
		}

		//DB registration
		if($ret){
			$ret = $this->model->ins_dev_html_rela($dev_html_rela);
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$dev_html_rela_id = $this->post["dev_html_rela_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		if($this->act === "up"){
			//With data registration
			if($this->up_validation() && $this->up()){
				//success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->post = array();	//Clear condition
				parent::disp_list_before();
				$this->disp_list();
				parent::disp_list_after();
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
				$this->post["dev_html_rela_date"] = null;
				parent::disp_list_before();
				$this->disp_list();
				parent::disp_list_after();

				//Restore edited content
				foreach($this->template->arr_dev_html_rela as $dev_html_rela){
					if($dev_html_rela->dev_html_rela_id == $dev_html_rela_id){
						$dev_html_rela->sta_dt = $this->post["sta_dt"];
						$dev_html_rela->end_dt = $this->post["end_dt"];
						$dev_html_rela->dev_html_rela_name = $this->post["dev_html_rela_name"];
						$dev_html_rela->html_id = $this->post["html"];
					}
				}
				$this->template->dev_html_rela_id = $dev_html_rela_id;
			}
		} else {
			//Display list screen in edit mode
			parent::disp_list_before();
			$this->disp_list();
			parent::disp_list_after();
			if($this->del_validation()){
				$this->template->dev_html_rela_id = $dev_html_rela_id;
			}
		}
	}

	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = true;
		$this->post["arr_dev"] = array($this->post["dev_id"]);
		$this->post["dt"] = $this->post["sta_dt"];	//Dummy variables for error display
		$this->validation = Validation::factory($this->post)
			->rule('dev_id', 'not_empty')
			->rule('dev_id', 'digit')
			->rule('dev_id', 'dev_id')
			->rule('dev_html_rela_id', 'not_empty')
			->rule('dev_html_rela_id', 'digit')
			->rule('dev_html_rela_id', 'dev_html_rela_id')
			->rule('dev_html_rela_name', 'not_empty')
			->rule('dev_html_rela_name', 'max_length', array(':value', '20'))
			->rule('html', 'not_empty')
			->rule('html', 'html_id')
			->rule('sta_dt', 'not_empty')
			->rule('sta_dt', 'date')
			->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
			->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
			->rule('end_dt', 'not_empty')
			->rule('end_dt', 'date')
			->rule('end_dt', 'dt_past')
			->rule('dt', 'dev_html_rela_dt_exists_exclude_id', array(':validation', 'arr_dev', 'sta_dt', 'end_dt', 'dev_html_rela_id'))
		;
		if($this->validation->check() === false){
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Update processing
	 */
	private function up(){
		$this->model->db->begin();
		$dev_id = $this->post["dev_id"];
		$dev_html_rela_id = $this->post["dev_html_rela_id"];

		$dev_html_rela = new Db_Up();
		$dev_html_rela->dev_html_rela_id = $dev_html_rela_id;
		$ret = $this->model->del_dev_html_rela($dev_html_rela);

		$dev_html_rela_id = $this->model->sel_next_dev_html_rela_id();
		if(is_null($dev_html_rela_id)){
			$ret = false;
		} else {
			$dev_html_rela = new Db_Ins();
			$dev_html_rela->dev_html_rela_id = $dev_html_rela_id;
			$dev_html_rela->dev_id = $dev_id;
			$dev_html_rela->dev_html_rela_name = $this->post["dev_html_rela_name"];
			$dev_html_rela->sta_dt = $this->post["sta_dt"];
			$dev_html_rela->end_dt = $this->post["end_dt"];
			$dev_html_rela->html_id = $this->post["html"];
			$dev_html_rela->inst_flag = 1;	//TODO Immediate flag
		}

		//DB registration
		if($ret){
			$ret = $this->model->ins_dev_html_rela($dev_html_rela);
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$dev_html_rela_id = $this->post["dev_html_rela_id"];
		}catch(Exception $e){
			//TODO Return to the menu screen when the parameter is invalid
			$this->request->redirect();
		}

		$dev_html_rela = null;
		if($this->act === "del"){
			//Delete data
			if($this->chk_token($this->module_name, $this->request->uri()) && $this->del_validation() && $this->del($dev_html_rela_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->request->uri());
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$dev_html_rela = $this->model->sel_dev_html_rela($dev_html_rela_id);
			if(!empty($dev_html_rela[0])){
				$dev_html_rela = $dev_html_rela[0];
			} else {
				$dev_html_rela = null;
			}
		}

		//Set value to template
		if(!is_null($dev_html_rela)){
			$this->template->url = $this->request->uri();
			$this->template->dev_html_rela_id = $dev_html_rela_id;
			$this->template->dev_html_rela = $dev_html_rela;
		} else {
			//Redirect to list if parameter is invalid
			$this->session->set($this->module_name, array(ACTION_DEL => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->request->uri());
		}
	}

	/**
	 * Validation for deletion processing
	 */
	private function del_validation(){
		$ret = true;
		$this->validation = Validation::factory($this->post)
			->rule('dev_html_rela_id', 'not_empty')
			->rule('dev_html_rela_id', 'digit')
			->rule('dev_html_rela_id', 'dev_html_rela_id')
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
	private function del($dev_html_rela_id){
		$this->model->db->begin();
		$dev_html_rela = new Db_Up();
		$dev_html_rela->dev_html_rela_id = $this->post["dev_html_rela_id"];
		$ret = $this->model->del_dev_html_rela($dev_html_rela);
		return $this->model->db->end($ret);
	}
}
