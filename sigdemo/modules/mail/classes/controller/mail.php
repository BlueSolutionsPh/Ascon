<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Mail extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Mail($this->get_target_client_id());
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
		$all_mail_cnt = $this->model->sel_cnt_mail();

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_mail_cnt[0]->cnt,
		));

		//Data acquisition
		$arr_mail = $this->model->sel_arr_mail();

		//Set value to template
		$this->template->all_dev_cnt = $all_mail_cnt[0]->cnt;
		$this->template->arr_mail = $arr_mail;
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('mail.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('mail.ins_post');

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
				$this->session->set('mail.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("mail.ins_conf.template");
			}
		} else{
			//If there is session data set as initial value
			if($this->session->get('mail.ins_post')){
				$this->post = $this->session->get('mail.ins_post');
				$this->session->delete('mail.ins_post');
			}
		}
	}

	/**
	 * Registration validation
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('mail_addr', 'not_empty')
				->rule('mail_addr', 'email')
				->rule('mail_addr', 'max_length', array(':value', '200'))
				->rule('mail_addr', 'mailaddr_no_exists')
				->rule('note', 'max_length', array(':value', '500'))
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
		$mail = new Db_Ins();
		$mail->mail_addr = $this->post["mail_addr"];
		$mail->note = $this->post["note"];
		//Get id
		$this->model->db->begin();
		$mail_id = $this->model->sel_next_mail_id();
		$mail->mail_id = $mail_id;
		$mail->disp_order = $mail_id;

		//DB registration (terminal)
		$ret = $this->model->ins_mail($mail);

		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$mail_id = $this->post["mail_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		$mail = $this->model->sel_mail($mail_id);
		if(empty($mail[0])){
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$mail = $mail[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('mail.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('mail.up_post');

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
				$this->session->set('mail.up_post', $this->post);

				//Template selection
				$this->template->set_filename("mail.up_conf.template");
			}
		} else {
			//No data update (initial display)
			$this->post = array();
			$this->post["mail_id"] = $mail_id;
			$this->post["client_id"] = $mail->client_id;
			$this->post["mail_addr"] = $mail->mail_addr;
			$this->post["note"] = $mail->note;
			//セッションデータがあれば初期値として設定
			if($this->session->get('mail.up_post')){
				$this->post = $this->session->get('mail.up_post');
				$this->session->delete('mail.up_post');
			}
		}
	}

	/**
	 * Update validation
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('mail_addr', 'not_empty')
				->rule('mail_addr', 'email')
				->rule('mail_addr', 'max_length', array(':value', '200'))
				->rule('note', 'max_length', array(':value', '500'))
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
		$mail = new Db_Up();
		$mail->mail_id = $this->post["mail_id"];
		$mail->mail_addr = $this->post["mail_addr"];
		$mail->note = $this->post["note"];

		//DB registration (terminal)
		$this->model->db->begin();
		$ret = $this->model->up_mail($mail);

		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$mail_id = $this->post["mail_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$mail = null;
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($mail_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$mail = $this->model->sel_mail($mail_id);
			if(!empty($mail[0])){
				$mail = $mail[0];
			} else {
				$mail = null;
			}
		}

		//Set value to template
		if(!is_null($mail)){
			$this->template->mail_id = $mail_id;
			$this->template->mail_addr = $mail->mail_addr;
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
			->rule('mail_id', 'not_empty')
			->rule('mail_id', 'digit')
			->rule('mail_id', 'mail_id')
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
	private function del($mail_id){
		$this->model->db->begin();
		$mail = new Db_Up();
		$mail->mail_id = $mail_id;
		$ret = $this->model->del_mail($mail);
		return $this->model->db->end($ret);
	}
}
