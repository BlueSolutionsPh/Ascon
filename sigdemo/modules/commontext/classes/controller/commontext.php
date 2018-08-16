<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Commontext extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->model = new Model_Commontext();
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
			case ACTION_LUMP_DEL:
				//Delete
				parent::disp_lump_del_before();
				$this->disp_lump_del();
				parent::disp_lump_del_after();
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
		$all_text_cnt = $this->model->sel_cnt_text($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_text_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_text = $this->model->sel_arr_text($this->search);
		foreach($arr_text as $text){
			$text->update_user = $this->get_user_name_from_db_user($text->update_user);
		}

		//Set value to template
		$this->head_add = "head.commontext.template";
		$this->template->arr_all_playlist = Controller_Template::get_arr_playlist_client();
		$this->template->all_text_cnt = $all_text_cnt[0]->cnt;
		$this->template->arr_text = $arr_text;
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('commontext.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//セッション破棄
				$this->session->delete('commontext.ins_post');

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
				$this->session->set('commontext.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("commontext.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if ( $this->session->get('commontext.ins_post') ) {
				$this->post = $this->session->get('commontext.ins_post');
				$this->session->delete('commontext.ins_post');
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
				->rule('text_name', 'not_empty')
				->rule('text_name', 'max_length', array(':value', '60'))
				->rule('text_name', 'common_text_name_exists')
				->rule('text_msg', 'not_empty')
				->rule('text_msg', 'max_length', array(':value', '500'))
				->rule('sta_dt', 'date')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
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
		$text = new Db_Ins();
		$text->text_name = $this->post["text_name"];
		$text->text_msg = $this->post["text_msg"];
		$text->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$text->end_dt = Text::chk_str($this->post, "end_dt", null);
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$this->model->db->begin();
		$text->text_id = $this->model->sel_next_text_id();
		$ret = $this->model->ins_text($text);
		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$text_id = $this->post["text_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$text = $this->model->sel_text($text_id);
		if(empty($text[0])){
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$text = $text[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('commontext.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('commontext.up_post');

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
				$this->session->set('commontext.up_post', $this->post);

				//Template selection
				$this->template->set_filename("commontext.up_conf.template");
			}
		} else {
			//display
			$this->post["text_id"] = $text_id;
			$this->post["text_name"] = $text->text_name;
			$this->post["text_msg"] = $text->text_msg;
			$this->post["sta_dt"] = $text->sta_dt;
			$this->post["end_dt"] = $text->end_dt;

			//If there is session data set as initial value
			if($this->session->get('commontext.up_post')){
				$this->post = $this->session->get('commontext.up_post');
				$this->session->delete('commontext.up_post');
			}
		}
	}

	/**
	 * Validation for registration
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('text_id', 'not_empty')
				->rule('text_id', 'digit')
				->rule('text_id', 'common_text_id')
				->rule('text_name', 'not_empty')
				->rule('text_name', 'max_length', array(':value', '60'))
				->rule('text_name', 'common_text_name_exists_exclude_id', array(':validation', 'text_name', 'text_id'))
				->rule('text_msg', 'not_empty')
				->rule('text_msg', 'max_length', array(':value', '500'))
				->rule('sta_dt', 'date')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
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
		$text = new Db_Up();
		$text->text_id = $this->post["text_id"];
		$text->text_name = $this->post["text_name"];
		$text->text_msg = $this->post["text_msg"];
		$text->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$text->end_dt = Text::chk_str($this->post, "end_dt", null);
		$this->model->db->begin();
		$ret = $this->model->up_text($text);
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$text_id = $this->post["text_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($text_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$text = $this->model->sel_text_name($text_id);
			if(!empty($text[0])){
				$text = $text[0];
			} else {
				$text = null;
			}
		}

		//Set value to template
		if(isset($text)){
			$arr_playlist = $this->model->sel_arr_playlist_by_text_id($text_id);
			$arr_ret_playlist = array();
			foreach($arr_playlist as $playlist){
				array_push($arr_ret_playlist, "(" . $playlist->client_name . ") " . $playlist->playlist_name);
			}
			$this->template->arr_playlist = $arr_ret_playlist;
			$this->template->text_id = $text_id;
			$this->template->text_name = $text->text_name;
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
			->rule('text_id', 'not_empty')
			->rule('text_id', 'digit')
			->rule('text_id', 'common_text_id')
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
	private function del($text_id){
		$this->model->db->begin();
		$text = new Db_Up();
		$text->text_id = $text_id;
		$ret = $this->model->del_text($text);
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_lump_del(){
		try{
			$temp_buff =  $this->post["chk_text"];
			$loop_cnt = count($temp_buff);
			$arr_text_name = null;
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		for($i=0;$i<$loop_cnt;$i++){
			try{
				$text_id =  $this->post["chk_text"][$i];
			}catch(Exception $e){
				//When parameter invalid, return to the list screen
				$this->request->redirect($this->module_name);
			}

			if($this->act === "lump_del"){
				//Delete data
				if($this->chk_token() && $this->lump_del_validation() && $this->lump_del($text_id)){
					//Redirect to list on success
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => true));
					$this->request->redirect($this->module_name);
				} else {
					//Data registration failure display
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false));
				}
			} else {
				//display
				$text = $this->model->sel_text_name($text_id);
				if(!empty($text[0])){
					$text = $text[0];
					$arr_text_name[$i] = $text->text_name;
				} else {
					$text = null;
				}
			}
			$arr_text_id[$i]=$text_id;
		}

		//Set value to template
		if(isset($text)){
			$arr_ret_playlist = array();
			for($i=0;$i<count($arr_text_id);$i++){
				$arr_playlist = $this->model->sel_arr_playlist_by_text_id($arr_text_id[$i]);
				foreach($arr_playlist as $playlist){
					$tmp_name="(" . $playlist->client_name . ") " . $playlist->playlist_name;
					if(0 == count($arr_ret_playlist)){
						array_push($arr_ret_playlist, $tmp_name);
					}else{
						$j=1;
						foreach($arr_ret_playlist as $ret_playlist){
							if($ret_playlist === $tmp_name){
								break;
							}else{
								if($j == count($arr_ret_playlist)){
									array_push($arr_ret_playlist, $tmp_name);
									break;
								}
							}
							$j++;
						}
					}
				}
			}

			$this->template->arr_playlist = $arr_ret_playlist;
			$this->template->text_id = $arr_text_id;
			$this->template->text_name = $arr_text_name;
		} else {
			//Redirect to list if parameter is invalid
			$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
	}

	/**
	 * Validation for deletion processing
	 */
	private function lump_del_validation(){
		$ret = true;
		$this->validation = Validation::factory($this->post)
			->rule('chk_text', 'not_empty')
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
	private function lump_del($text_id){
		$this->model->db->begin();
		$text = new Db_Up();
		$del_cnt = count($this->post["chk_text"]);

		for($i=0;$i<$del_cnt;$i++){
			$text->text_id = $this->post["chk_text"][$i];
			$ret = $this->model->del_text($text);
		}
		return $this->model->db->end($ret);
	}
}
