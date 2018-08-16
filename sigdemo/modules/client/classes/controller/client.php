<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Client extends Controller_Template{
	/**
	 * Deselect client
	 */
	public function action_unsel(){
		//Login check
		$this->login_check();

		//Administrator check
		$this->admin_check();

		//Deselect
		$this->session->delete(SESS_LOGIN_TARGET_CLIENT_ID);
		$this->session->delete(SESS_LOGIN_TARGET_CLIENT_NAME);
		$this->request->redirect(MODULE_NAME_MENU);
	}

	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->model = new Model_Client();
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
			case ACTION_SEL:
				//Operation target client selection
				if(isset($this->post["client_id"]) && $this->post["client_id"] !== ""){
					$this->session->set(SESS_LOGIN_TARGET_CLIENT_ID, $this->post["client_id"]);
					$this->request->redirect(MODULE_NAME_MENU);
				}
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
		$all_client_cnt = $this->model->sel_cnt_client($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_client_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_client = $this->model->sel_arr_client($this->search);

		//Set value to template
		$this->head_add = "head.client.template";
		$this->template->all_client_cnt = $all_client_cnt[0]->cnt;
		$this->template->arr_client = $arr_client;
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('client.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('client.ins_post');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
				if(empty($this->post["arr_tag"])){
					$this->post["arr_tag"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Store in session
				$this->session->set('client.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("client.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('client.ins_post')){
				$this->post = $this->session->get('client.ins_post');
				$this->session->delete('client.ins_post');
			}
		}
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('client_name', 'not_empty')
				->rule('client_name', 'max_length', array(':value', '20'))
				->rule('client_name', 'client_name_exists')
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
		$this->model->db->begin();
		$client_id = $this->model->sel_next_client_id();
		$client = new Db_Ins();
		$client->client_id = $client_id;
		$client->client_name = $this->post["client_name"];
		$client->max_total_cts_file_size = CLIENT_MAX_TOTAL_SIZE_DEFAULT * 1024 * 1024 * 1024;
		$client->note = $this->post["note"];
		$ret = $this->model->ins_client($client);
		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$client_id = $this->post["client_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		$client = $this->model->sel_client($client_id);
		if(empty($client[0])){
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$client = $client[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('client.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('client.up_post');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('client.up_post', $this->post);

				//Template selection
				$this->template->set_filename("client.up_conf.template");
			}
		} else {
			//No data update (initial display)
			$this->post = array();
			$this->post["client_id"] = $client->client_id;
			$this->post["client_name"] = $client->client_name;
			$this->post["max_total_cts_file_size"] = $client->max_total_cts_file_size / 1024 / 1024 / 1024;
			$this->post["note"] = $client->note;

			//If there is session data set as initial value
			if($this->session->get('client.up_post')){
				$this->post = $this->session->get('client.up_post');
				$this->session->delete('client.up_post');
			}
		}
	}

	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			//Validation
			$this->validation = Validation::factory($this->post)
				->rule('client_name', 'not_empty')
				->rule('client_name', 'max_length', array(':value', '20'))
				->rule('client_name', 'client_name_exists_exclude_id', array(':validation', 'client_name', 'client_id'))
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
		$client = new Db_Up();
		$client->client_id = $this->post["client_id"];
		$client->client_name = $this->post["client_name"];
		$client->max_total_cts_file_size = CLIENT_MAX_TOTAL_SIZE_DEFAULT * 1024 * 1024 * 1024;
		$client->note = $this->post["note"];
		$this->model->db->begin();
		$ret = $this->model->up_client($client);
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$client_id = $this->post["client_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$client = null;
		if(isset($client_id) && $client_id !== (string)$this->get_user_client_id()){
			if($this->act === "del"){
				//Delete data
				if($this->chk_token() && $this->del_validation() && $this->del($client_id)){
					//Deselect when selected client is deleted
					if($client_id === $this->get_target_client_id()){
						$this->session->delete(SESS_LOGIN_TARGET_CLIENT_ID);
						$this->session->delete(SESS_LOGIN_TARGET_CLIENT_NAME);
					}

					//Redirect to success list
					$this->session->set($this->module_name, array(ACTION_DEL => true));
					$this->request->redirect($this->module_name);
				} else {
					//Data delete failure display
					$this->session->set($this->module_name, array(ACTION_DEL => false));
				}
			} else {
				//display
				$client = $this->model->sel_client_name($client_id);
				if(!empty($client[0])){
					$client = $client[0];
				} else {
					$client = null;
				}
			}
		} else {
			//Can not delete client belonging to login user
			$this->session->set($this->module_name, array(ACTION_DEL => false));
			$this->request->redirect($this->module_name);
		}

		//Set value to template
		if(!is_null($client)){
			$this->template->client_id = $client_id;
			$this->template->client_name = $client->client_name;
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
			->rule('client_id', 'not_empty')
			->rule('client_id', 'digit')
			->rule('client_id', 'client_id')
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
	private function del($client_id){
		$this->model->db->begin();
		$movie_rows = $this->model->sel_arr_movie($client_id);
		$image_rows = $this->model->sel_arr_image($client_id);
		$html_rows = $this->model->sel_arr_html($client_id);
		$mail_rows = $this->model->sel_arr_mail($client_id);

		$client = new Db_Up();
		$client->client_id = $client_id;
		$ret = $this->model->del_client($client);
		if($ret){
			//File deletion (the active file is automatically deleted at the next synchronous batch execution)
			if($movie_rows !== false){
				foreach($movie_rows as $movie_row){
					File::del_movie_files($movie_row);
				}
			}
			if($image_rows !== false){
				foreach($image_rows as $image_row){
					File::del_image_files($image_row);
				}
			}
			if($html_rows !== false){
				foreach($html_rows as $html_row){
					File::del_html_files($html_row);
				}
			}
			if($mail_rows !== false){
				foreach($mail_rows as $mail_row){
					$this->model->del_mail($mail_row, $client_id);
				}
			}
		}
		return $this->model->db->end($ret);
	}
}
