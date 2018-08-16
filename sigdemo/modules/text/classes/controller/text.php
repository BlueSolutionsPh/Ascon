<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Text extends Controller_Template {
	/**
	 * true = success, false = failure
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Text($this->get_target_client_id());
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
			
			//tag
			$arr_text_tag = $this->model->sel_arr_text_tag_by_text_id($text->text_id);
			$text->arr_tag = $arr_text_tag;
		}
		
		//Set value to template
		$this->head_add = "head.text.template";
		$this->template->arr_all_tag = Controller_Template::get_arr_text_tag();
		$this->template->arr_all_playlist = Controller_Template::get_arr_playlist();
		$this->template->tag_and_or = Controller_Template::get_arr_tag_and_or(false);
		$this->template->all_text_cnt = $all_text_cnt[0]->cnt;
		$this->template->arr_text = $arr_text;
		$this->template->arr_all_property = array(""=>"-");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
		}
		$this->template->pagination = $pagination->render();
		
	}
	
	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('text.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('text.ins_post');
				
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
				//On failure
				$this->session->set('text.ins_post', $this->post);
				
				//Store in session
				$this->template->set_filename("text.ins_conf.template");
			}
		} else {
			$this->post["property_id"] = "";
			//Template selection
			if ( $this->session->get('text.ins_post') ) {
				$this->post = $this->session->get('text.ins_post');
				$this->session->delete('text.ins_post');
			}
		}
		
		//If there is session data set as initial value
		$this->template->arr_all_tag = Controller_Template::get_arr_text_tag(false);
		$this->template->arr_all_property = array(""=>"None");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
		}
	}
	
	/**
	 * Set value to template
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('text_name', 'not_empty')
				->rule('text_name', 'max_length', array(':value', '60'))
				->rule('text_name', 'text_name_exists')
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
		$text->property_id = Text::chk_str($this->post, "property_id", null);
		$this->model->db->begin();
		$text->text_id = $this->model->sel_next_text_id();
		$ret = $this->model->ins_text($text);
		
		//registration process
		if($ret && !empty($arr_tag)){
			foreach($arr_tag as $tag){
				$text_tag_rela = new Db_Ins();
				$text_tag_rela->text_id = $text->text_id;
				$text_tag_rela->text_tag_id = $tag;
				$ret = $this->model->ins_text_tag_rela($text_tag_rela);
				if($ret === false){
					break;
				}
			}
		}
		return $this->model->db->end($ret);
	}
	
	/**
	 * DB registration (tag)
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
			//When object is not present
			$this->post = $this->session->get('text.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('text.up_post');
				
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
				$this->session->set('text.up_post', $this->post);
				
				//Template selection
				$this->template->set_filename("text.up_conf.template");
			}
		} else {
			//display
			$this->post["text_id"] = $text_id;
			$this->post["text_name"] = $text->text_name;
			$this->post["text_msg"] = $text->text_msg;
			$this->post["sta_dt"] = $text->sta_dt;
			$this->post["end_dt"] = $text->end_dt;
			$this->post["arr_tag"] = array();
			$arr_sel_tag = $this->model->sel_arr_text_tag_by_text_id($text_id);
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->text_tag_id);
			}
			if(isset($text->property_id)){
				$this->post["property_id"] = $text->property_id;
			}else{
				$this->post["property_id"] = "";
			}
			//If there is session data set as initial value
			if($this->session->get('text.up_post')){
				$this->post = $this->session->get('text.up_post');
				$this->session->delete('text.up_post');
			}
		}
		
		//Set value to template
		$this->template->arr_all_tag = Controller_Template::get_arr_text_tag(false);
		$this->template->arr_all_property = array(""=>"None");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
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
				->rule('text_id', 'text_id')
				->rule('text_name', 'not_empty')
				->rule('text_name', 'max_length', array(':value', '60'))
				->rule('text_name', 'text_name_exists_exclude_id', array(':validation', 'text_name', 'text_id'))
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
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$text->property_id = Text::chk_str($this->post, "property_id", null);
		$this->model->db->begin();
		$ret = $this->model->up_text($text);
		
		//DB registration (tag)
		if($ret){
			$arr_old_tag = $this->model->sel_arr_text_tag_by_text_id($text->text_id);
			foreach($arr_old_tag as $old_tag){
				$exists = false;
				foreach($arr_tag as $tag){
					if($old_tag->text_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$text_tag_rela = new Db_Up();
					$text_tag_rela->text_id = $text->text_id;
					$text_tag_rela->text_tag_id = $old_tag->text_tag_id;
					$this->model->del_text_tag_rela($text_tag_rela); 
				}
			}
			
			foreach($arr_tag as $tag){
				$exists = false;
				foreach($arr_old_tag as $old_tag){
					if($old_tag->text_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//If it does not exist, register
					$text_tag_rela = new Db_Ins();
					$text_tag_rela->text_id = $text->text_id;
					$text_tag_rela->text_tag_id = $tag;
					$this->model->ins_text_tag_rela($text_tag_rela); 
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
				array_push($arr_ret_playlist, $playlist->playlist_name);
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
			->rule('text_id', 'text_id')
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
					//Redirect to list on success
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
					if(0 == count($arr_ret_playlist)){
						array_push($arr_ret_playlist, $playlist->playlist_name);
					}else{
						$j=1;
						foreach($arr_ret_playlist as $ret_playlist){
							if($ret_playlist === $playlist->playlist_name){
								break;
							}else{
								if($j == count($arr_ret_playlist)){
									array_push($arr_ret_playlist, $playlist->playlist_name);
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