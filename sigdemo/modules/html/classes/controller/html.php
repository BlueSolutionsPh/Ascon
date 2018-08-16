<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Html extends Controller_Template {
	/**
	 * Update screen directly
	 */
	public function action_up(){
		if($this->request->param("param1", false)){
			$html_id = $this->request->param("param1");
			$this->post["disp"] = "up";
			$this->post["html_id"] = $html_id;
			$this->action_index();
		}
	}

	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Html($this->get_target_client_id());
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
				//一覧
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
		$all_html_cnt = $this->model->sel_cnt_html($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_html_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_html = $this->model->sel_arr_html($this->search);
		foreach($arr_html as $html){
			$html->update_user = $this->get_user_name_from_db_user($html->update_user);

			//URL
			if(!empty($html->orig_file_exte)){
				$html->html_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/html/" . $html->file_name . $html->orig_file_exte;
			}

			//tag
			$arr_html_tag = $this->model->sel_arr_html_tag_by_html_id($html->html_id);
			$html->arr_tag = $arr_html_tag;
		}

		//Set value to template
		$this->head_add = "head.html.template";
		$this->template->arr_all_tag = Controller_Template::get_arr_html_tag();
		$this->template->tag_and_or = Controller_Template::get_arr_tag_and_or(false);
		$this->template->all_html_cnt = $all_html_cnt[0]->cnt;
		$this->template->arr_html = $arr_html;
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('html.ins_post');
			$_FILES = $this->session->get('html.ins_file');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//セッション破棄
				$this->session->delete('html.ins_post');
				$this->session->delete('html.ins_file');

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
				//Move temporary file
				$temp_html_file = TEMP_FILE_DIR.basename($_FILES["html_file"]["tmp_name"]);
				if(move_uploaded_file($_FILES["html_file"]["tmp_name"], $temp_html_file)){
					$_FILES["html_file"]["tmp_name"] = $temp_html_file;
				}

				//Store in session
				$this->session->set('html.ins_post', $this->post);
				$this->session->set('html.ins_file', $_FILES);

				//Template selection
				$this->template->set_filename("html.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('html.ins_post')){
				$this->post = $this->session->get('html.ins_post');
				$this->session->delete('html.ins_post');
				$this->session->delete('html.ins_file');
			}
		}

		//Set value to template
		$this->template->arr_all_tag = Controller_Template::get_arr_html_tag(false);
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			//HTML file
			if(!empty($_FILES["html_file"])){
				$html_file = $_FILES["html_file"]["name"];
				if(!empty($html_file) && is_uploaded_file($_FILES["html_file"]["tmp_name"])){
					$this->post["file_size"] = filesize($_FILES["html_file"]["tmp_name"]);
					$orig_file_name = substr($html_file, 0, strrpos($html_file, '.'));
					$this->post["orig_file_name"] = $orig_file_name;
					$orig_file_exte = substr($html_file, strrpos($html_file, '.'));
					$this->post["orig_file_exte"] = $orig_file_exte;
				}
			}

			//File check
			if(empty($html_file)){
				//Error if file does not exist
				$this->arr_ret_error = array("html_file" => array("not_empty"));
				$ret = false;
			}

			//Validation
			$this->validation = Validation::factory($this->post)
				->rule('html_name', 'not_empty')
				->rule('html_name', 'max_length', array(':value', '60'))
				->rule('html_name', 'html_name_exists')
				->rule('file_size', 'client_total_file_size')
				->rule('sta_dt', 'date')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
				->rule('orig_file_name', 'max_length', array(':value', '256'))
				->rule('orig_file_exte', 'max_length', array(':value', '8'))
				->rule('orig_file_exte', 'html_exte')
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
		$ret = true;
		$temp_html_file = $_FILES["html_file"]["tmp_name"];

		$html = new Db_Ins();
		$html->html_name = $this->post["html_name"];
		$html->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$html->end_dt = Text::chk_str($this->post, "end_dt", null);
		$html->orig_file_name = $this->post["orig_file_name"];
		$html->orig_file_exte = $this->post["orig_file_exte"];
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$html->orig_file_dir = null;
		$html->orig_hash = null;
		$html->file_name = null;

		//DB registration
		$this->model->db->begin();
		$src_html_file = null;
		$html_id = $this->model->sel_next_html_id();
		if(is_null($html_id)){
			$ret = false;
		} else {
			$html->html_id = $html_id;
			$html->file_name = str_pad(strval($html->html_id), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT);
			$client_dir = str_pad(strval($this->get_target_client_id()), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT) . "/";
			$html->orig_file_dir = $client_dir . HTML_FILE_DIR . str_pad(strval(intval(sqrt($html->html_id / CTS_PER_DIR))), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT) . "/";
		}

		//Data file move
		if($ret){
			if(file_exists(ORIG_FILE_DIR . $client_dir) === false){
				mkdir(ORIG_FILE_DIR . $client_dir);
				chmod(ORIG_FILE_DIR . $client_dir, 0775);
			}
			if(file_exists(ORIG_FILE_DIR . $client_dir . HTML_FILE_DIR) === false){
				mkdir(ORIG_FILE_DIR . $client_dir . HTML_FILE_DIR);
				chmod(ORIG_FILE_DIR . $client_dir . HTML_FILE_DIR, 0775);
			}
			if(file_exists(ORIG_FILE_DIR . $html->orig_file_dir) === false){
				mkdir(ORIG_FILE_DIR . $html->orig_file_dir);
				chmod(ORIG_FILE_DIR . $html->orig_file_dir, 0775);
			}
			$dest_html_file = ORIG_FILE_DIR . $html->orig_file_dir . $html->file_name . $html->orig_file_exte;
			$ret = (is_file($temp_html_file) && copy($temp_html_file, $dest_html_file));
			if($ret){
				chmod($dest_html_file, 0664);
				$html->orig_hash = hash_file(HASH_ALGO, $dest_html_file);
				$html->orig_file_size = filesize($dest_html_file);
			}
		}

		//DB registration (movie)
		if($ret){
			$ret = $this->model->ins_html($html);
		}

		// DB registration (tag)
		if($ret && !empty($arr_tag)){
			foreach($arr_tag as $tag){
				$html_tag_rela = new Db_Ins();
				$html_tag_rela->html_id = $html->html_id;
				$html_tag_rela->html_tag_id = $tag;
				$ret = $this->model->ins_html_tag_rela($html_tag_rela);
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
			$html_id = $this->post["html_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$arr_sel_tag = $this->model->sel_arr_html_tag_by_html_id($html_id);
		$html = $this->model->sel_html($html_id);
		if(empty($html[0])){
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$html = $html[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('html.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
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
				$this->session->set('html.up_post', $this->post);

				//Template selection
				$this->template->set_filename("html.up_conf.template");
			}
		} else {
			//display
			$this->post["html_id"] = $html_id;
			$this->post["html_name"] = $html->html_name;
			$this->post["sta_dt"] = $html->sta_dt;
			$this->post["end_dt"] = $html->end_dt;
			$this->post["arr_tag"] = array();
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->html_tag_id);
			}
			//If there is session data set as initial value
			if($this->session->get('html.up_post')){
				$this->post = $this->session->get('html.up_post');
				$this->session->delete('html.up_post');
			}
		}
		$this->post["orig_file_name"] = $html->orig_file_name;
		$this->post["orig_file_exte"] = $html->orig_file_exte;

		//Set value to template
		$this->template->arr_all_tag = Controller_Template::get_arr_html_tag(false);
	}

	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('html_id', 'not_empty')
				->rule('html_id', 'digit')
				->rule('html_id', 'html_id')
				->rule('html_name', 'not_empty')
				->rule('html_name', 'max_length', array(':value', '60'))
				->rule('html_name', 'html_name_exists_exclude_id', array(':validation', 'html_name', 'html_id'))
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
		$html = new Db_Up();
		$html->html_id = $this->post["html_id"];
		$html->html_name = $this->post["html_name"];
		$html->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$html->end_dt = Text::chk_str($this->post, "end_dt", null);
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}

		// DB registration (movie)
		$this->model->db->begin();
		$ret = $this->model->up_html($html);

		//DB registration (tag)
		$arr_old_tag = $this->model->sel_arr_html_tag_by_html_id($html->html_id);
		if($ret){
			foreach($arr_old_tag as $old_tag){
				$exists = false;
				foreach($arr_tag as $tag){
					if($old_tag->html_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$html_tag_rela = new Db_Up();
					$html_tag_rela->html_id = $html->html_id;
					$html_tag_rela->html_tag_id = $old_tag->html_tag_id;
					$this->model->del_html_tag_rela($html_tag_rela);
				}
			}

			foreach($arr_tag as $tag){
				$exists = false;
				foreach($arr_old_tag as $old_tag){
					if($old_tag->html_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//If it does not exist, register
					$html_tag_rela = new Db_Ins();
					$html_tag_rela->html_id = $html->html_id;
					$html_tag_rela->html_tag_id = $tag;
					$this->model->ins_html_tag_rela($html_tag_rela);
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
			$html_id = $this->post["html_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($html_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$html = $this->model->sel_html_name($html_id);
			if(!empty($html[0])){
				$html = $html[0];
			} else {
				$html = null;
			}
		}

		//Set value to template
		if(!is_null($html)){
			$this->template->html_id = $html_id;
			$this->template->html_name = $html->html_name;
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
			->rule('html_id', 'not_empty')
			->rule('html_id', 'digit')
			->rule('html_id', 'html_id')
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
	private function del($html_id){
		$html = $this->model->sel_html($html_id);
		if(!empty($html[0])){
			$html = $html[0];

			//Delete DB
			$this->model->db->begin();
			$html_db = new Db_Up();
			$html_db->html_id = $html_id;
			$ret = $this->model->del_html($html_db);
			if($ret){
				File::del_html_files($html);	//The active file is automatically deleted at the next synchronous batch execution
			}
			$ret = $this->model->db->end($ret);
		}
		return $ret;
	}

	/**
	 * Delete screen display
	 */
	private function disp_lump_del(){
		try{
			$temp_buff =  $this->post["chk_html"];
			$loop_cnt = count($temp_buff);
			$arr_html_name = null;
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		for($i=0;$i<$loop_cnt;$i++){
			try{
				$html_id =  $this->post["chk_html"][$i];
			}catch(Exception $e){
				//When parameter invalid, return to the list screen
				$this->request->redirect($this->module_name);
			}
			if($this->act === "lump_del"){
				//Delete data
				if($this->chk_token() && $this->lump_del_validation() && $this->lump_del($html_id)){
					//Redirect to list on success
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => true));
					$this->request->redirect($this->module_name);
				} else {
					//Data registration failure display
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false));
				}
			} else {
				//display
				$html = $this->model->sel_html_name($html_id);
				if(!empty($html[0])){
					$html = $html[0];
					$arr_html_name[$i] = $html->html_name;
				} else {
					$html = null;
				}
			}
			$arr_html_id[$i]=$html_id;
		}

		//Set value to template
		if(!is_null($html)){
			$this->template->html_id = $arr_html_id;
			$this->template->html_name = $arr_html_name;
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
			->rule('chk_html', 'not_empty')
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
	private function lump_del($html_id){
		$ret = false;
		$html_db = new Db_Up();
		$this->model->db->begin();

		$del_cnt = count($this->post["chk_html"]);
		for($i=0;$i<$del_cnt;$i++){
			$html_id = $this->post["chk_html"][$i];
			$html = $this->model->sel_html($html_id);

			if(!empty($html[0])){
				$html = $html[0];
				//Delete DB
				$html_db->html_id = $this->post["chk_html"][$i];
				$ret = $this->model->del_html($html_db);
				if($ret){
					File::del_html_files($html);	//The active file is automatically deleted at the next synchronous batch execution
				}
			}
		}
		$ret = $this->model->db->end($ret);
		return $ret;
	}
}
