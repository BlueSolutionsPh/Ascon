<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Commonmovie extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->model = new Model_Commonmovie();
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
		$all_movie_cnt = $this->model->sel_cnt_movie($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_movie_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_movie = $this->model->sel_arr_movie($this->search);
		foreach($arr_movie as $movie){
			$movie->update_user = $this->get_user_name_from_db_user($movie->update_user);

			//URL
			if(!empty($movie->movie_orig_file_exte)){
				$movie->movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $movie->file_name . $movie->movie_orig_file_exte;
			} else if(!empty($movie->sound_orig_file_exte)){
				$movie->movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $movie->file_name . $movie->sound_orig_file_exte;
			}

			//Playback time
			$movie->play_time = $this->toggle_time_format($movie->play_time);
		}

		//Set value to template
		$this->head_add = "head.commonmovie.template";
		$this->template->arr_all_playlist = Controller_Template::get_arr_playlist();
		$this->template->all_movie_cnt = $all_movie_cnt[0]->cnt;
		$this->template->arr_movie = $arr_movie;
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//Registration screen display data registered
			$this->post = $this->session->get('commonmovie.ins_post');
			$_FILES = $this->session->get('commonmovie.ins_file');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('commonmovie.ins_post');
				$this->session->delete('commonmovie.ins_file');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Move temporary file
				$temp_movie_file = TEMP_FILE_DIR.basename($_FILES["movie_file"]["tmp_name"]);
				if(move_uploaded_file($_FILES["movie_file"]["tmp_name"], $temp_movie_file)){
					$_FILES["movie_file"]["tmp_name"] = $temp_movie_file;
				}

				//Store in session
				$this->session->set('commonmovie.ins_post', $this->post);
				$this->session->set('commonmovie.ins_file', $_FILES);

				//Template selection
				$this->template->set_filename("commonmovie.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('commonmovie.ins_post')){
				$this->post = $this->session->get('commonmovie.ins_post');
				$this->session->delete('commonmovie.ins_post');
				$this->session->delete('commonmovie.ins_file');
			}
		}

		//Set value to template
		$this->template->map_list = Controller_Template::get_arr_playtime(false);
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			//Movie file
			if(!empty($_FILES["movie_file"])){
				$movie_file = $_FILES["movie_file"]["name"];
				if(!empty($movie_file) && is_uploaded_file($_FILES["movie_file"]["tmp_name"])){
					$movie_orig_file_name = substr($movie_file, 0, strrpos($movie_file, '.'));
					$this->post["movie_orig_file_name"] = $movie_orig_file_name;
					$movie_orig_file_exte = substr($movie_file, strrpos($movie_file, '.'));
					$this->post["movie_orig_file_exte"] = $movie_orig_file_exte;

					$exte_err = true;
					$arr_exte = array_merge(Controller_Movie::$arr_movie_exte, Controller_Movie::$arr_sound_exte);
					foreach($arr_exte as $exte){
						if($movie_orig_file_exte === $exte){
							$exte_err = false;
							break;
						}
					}
					if($exte_err){
						//File format error
						$this->arr_ret_error["movie_file"] = array("exte");
						$ret = false;
					}
				}
			}
			if(!isset($this->post["movie_orig_file_name"]) && !isset($this->post["movie_orig_file_exte"])){
				//Required check error
				$this->arr_ret_error["movie_file"] = array("not_empty");
				$ret = false;
			}

			//Validation
			$this->validation = Validation::factory($this->post)
				->rule('movie_name', 'not_empty')
				->rule('movie_name', 'max_length', array(':value', '60'))
				->rule('movie_name', 'common_movie_name_exists')
				->rule('play_time', 'digit')
				->rule('play_time', 'max_length', array(':value', '5'))
				->rule('rotate_flag', 'rotate_flag')
				->rule('sta_dt', 'date')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
				->rule('movie_orig_file_name', 'max_length', array(':value', '256'))
				->rule('movie_orig_file_exte', 'max_length', array(':value', '8'))
				->rule('movie_orig_file_exte', 'movie_exte')
				->rule('sound_orig_file_name', 'max_length', array(':value', '256'))
				->rule('sound_orig_file_exte', 'max_length', array(':value', '8'))
				->rule('sound_orig_file_exte', 'movie_exte')
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
		$movie = new Db_Ins();
		$movie->movie_name = $this->post["movie_name"];
		if(isset($this->post["rotate_flag"])){
			$movie->rotate_flag = $this->post["rotate_flag"];
		} else {
			$movie->rotate_flag = 0;
		}
		if(isset($this->post["play_time-m"]) && isset($this->post["play_time-s"]) && $this->post["play_time-m"] !== "" && $this->post["play_time-s"] !== ""){
			$movie->play_time = $this->toggle_time_format(sprintf('%02d:%02d', $this->post["play_time-m"], $this->post["play_time-s"]));
		} else {
			$movie->play_time = null;
		}
		$movie->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$movie->end_dt = Text::chk_str($this->post, "end_dt", null);
		$is_sound = false;
		foreach(Controller_Movie::$arr_sound_exte as $sound_exte){
			if($this->post["movie_orig_file_exte"] === $sound_exte){
				$is_sound = true;
				break;
			}
		}
		if($is_sound){
			$movie->sound_orig_file_name = $this->post["movie_orig_file_name"];
			$movie->sound_orig_file_exte = $this->post["movie_orig_file_exte"];
			$movie->movie_orig_file_name = null;
			$movie->movie_orig_file_exte = null;
		} else {
			$movie->movie_orig_file_name = $this->post["movie_orig_file_name"];
			$movie->movie_orig_file_exte = $this->post["movie_orig_file_exte"];
			$movie->sound_orig_file_name = null;
			$movie->sound_orig_file_exte = null;
		}
		$movie->orig_file_dir = null;
		$movie->movie_orig_file_size = null;
		$movie->sound_orig_file_size = null;
		$movie->movie_orig_hash = null;
		$movie->sound_orig_hash = null;
		$movie->file_name = null;

		//DB registration
		$this->model->db->begin();
		$src_movie_file = null;
		$src_sound_file = null;
		$movie_id = $this->model->sel_next_movie_id();
		if(is_null($movie_id)){
			$ret = false;
		} else {
			$movie->movie_id = $movie_id;
			$movie->file_name = str_pad(strval($movie->movie_id), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT);
			$movie->orig_file_dir = COMMON_FILE_DIR . MOVIE_FILE_DIR . str_pad(strval(intval(sqrt($movie->movie_id / CTS_PER_DIR))), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT) . "/";
		}

		//Data file move
		if(file_exists(ORIG_FILE_DIR . COMMON_FILE_DIR) === false){
			mkdir(ORIG_FILE_DIR . COMMON_FILE_DIR);
			chmod(ORIG_FILE_DIR . COMMON_FILE_DIR, 0775);
		}
		if(file_exists(ORIG_FILE_DIR . COMMON_FILE_DIR . MOVIE_FILE_DIR) === false){
			mkdir(ORIG_FILE_DIR . COMMON_FILE_DIR . MOVIE_FILE_DIR);
			chmod(ORIG_FILE_DIR . COMMON_FILE_DIR . MOVIE_FILE_DIR, 0775);
		}
		if(file_exists(ORIG_FILE_DIR . $movie->orig_file_dir) === false){
			mkdir(ORIG_FILE_DIR . $movie->orig_file_dir);
			chmod(ORIG_FILE_DIR . $movie->orig_file_dir, 0775);
		}

		$movie_file = $_FILES["movie_file"]["name"];
		if(!empty($movie_file)){
			if(!$is_sound){
				$temp_movie_file = $_FILES["movie_file"]["tmp_name"];
				$dest_movie_file = ORIG_FILE_DIR . $movie->orig_file_dir . $movie->file_name . $movie->movie_orig_file_exte;
				if(is_null($src_movie_file)){
					$temp_movie_file = $_FILES["movie_file"]["tmp_name"];
					$ret = (rename($temp_movie_file, $dest_movie_file));
				} else {
					$temp_movie_file = $src_movie_file;
					$ret = (is_file($temp_movie_file) && copy($temp_movie_file, $dest_movie_file));
				}

				if($ret){
					$src_movie_file = $dest_movie_file;
					chmod($dest_movie_file, 0664);
					$movie->movie_orig_hash = hash_file(HASH_ALGO, $dest_movie_file);
					$movie->movie_orig_file_size = filesize($dest_movie_file);
				}

			} else {
				$temp_sound_file = $_FILES["movie_file"]["tmp_name"];
				$dest_sound_file = ORIG_FILE_DIR . $movie->orig_file_dir . $movie->file_name . $movie->sound_orig_file_exte;
				if(is_null($src_sound_file)){
					$temp_sound_file = $_FILES["movie_file"]["tmp_name"];
					$ret = (rename($temp_sound_file, $dest_sound_file));
				} else {
					$temp_sound_file = $src_sound_file;
					$ret = (is_file($temp_sound_file) && copy($temp_sound_file, $dest_sound_file));
				}

				if($ret){
					$src_sound_file = $dest_sound_file;
					chmod($dest_sound_file, 0664);
					$movie->sound_orig_hash = hash_file(HASH_ALGO, $dest_sound_file);
					$movie->sound_orig_file_size = filesize($dest_sound_file);
				}
			}

			//DB registration (movie)
			if($ret){
				$ret = $this->model->ins_movie($movie);
			}
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$movie_id = $this->post["movie_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$movie = $this->model->sel_movie($movie_id);
		if(empty($movie[0])){
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$movie = $movie[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('commonmovie.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('commonmovie.up_post');

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
				$this->session->set('commonmovie.up_post', $this->post);

				//Template selection
				$this->template->set_filename("commonmovie.up_conf.template");
			}
		} else {
			//display
			$this->post["movie_id"] = $movie_id;
			$this->post["movie_name"] = $movie->movie_name;
			$this->post["rotate_flag"] = (string)$movie->rotate_flag;
			if($movie->play_time == 0){
				$this->post["play_time-m"] = '0';
				$this->post["play_time-s"] = '0';
			} else {
				list($this->post["play_time-m"], $this->post["play_time-s"]) = explode(':', $this->toggle_time_format($movie->play_time));
			}
			$this->post["sta_dt"] = $movie->sta_dt;
			$this->post["end_dt"] = $movie->end_dt;

			//If there is session data set as initial value
			if ( $this->session->get('commonmovie.up_post') ) {
				$this->post = $this->session->get('commonmovie.up_post');
				$this->session->delete('commonmovie.up_post');
			}
		}
		$this->post["movie_orig_file_name"] = $movie->movie_orig_file_name;
		$this->post["movie_orig_file_exte"] = $movie->movie_orig_file_exte;
		$this->post["sound_orig_file_name"] = $movie->sound_orig_file_name;
		$this->post["sound_orig_file_exte"] = $movie->sound_orig_file_exte;

		//Set value to template
		$this->template->map_list = Controller_Template::get_arr_playtime(false);
	}

	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('movie_id', 'not_empty')
				->rule('movie_id', 'digit')
				->rule('movie_id', 'common_movie_id')
				->rule('movie_name', 'not_empty')
				->rule('movie_name', 'max_length', array(':value', '60'))
				->rule('movie_name', 'common_movie_name_exists_exclude_id', array(':validation', 'movie_name', 'movie_id'))
				->rule('play_time', 'digit')
				->rule('play_time', 'max_length', array(':value', '5'))
				->rule('rotate_flag', 'rotate_flag')
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
		$movie = new Db_Up();
		$movie->movie_id = $this->post["movie_id"];
		$movie->movie_name = $this->post["movie_name"];
		if(isset($this->post["rotate_flag"])){
			$movie->rotate_flag = $this->post["rotate_flag"];
		} else {
			$movie->rotate_flag = 0;
		}
		if(isset($this->post["play_time-m"]) && isset($this->post["play_time-s"]) && $this->post["play_time-m"] !== "" && $this->post["play_time-s"] !== ""){
			$movie->play_time = $this->toggle_time_format(sprintf('%02d:%02d', $this->post["play_time-m"], $this->post["play_time-s"]));
		} else {
			$movie->play_time = null;
		}
		$movie->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$movie->end_dt = Text::chk_str($this->post, "end_dt", null);

		$this->model->db->begin();
		$ret = $this->model->up_movie($movie);

		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$movie_id = $this->post["movie_id"];
		}catch(Exception $e){
			//When deleted screen display parameter is invalid, return to list screen
			$this->request->redirect($this->module_name);
		}

		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($movie_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$movie = $this->model->sel_movie_name($movie_id);
			if(!empty($movie[0])){
				$movie = $movie[0];
			} else {
				$movie = null;
			}
		}

		//Set value to template
		if(isset($movie)){
			$arr_playlist = $this->model->sel_arr_playlist_by_movie_id($movie_id);
			$arr_ret_playlist = array();
			foreach($arr_playlist as $playlist){
				array_push($arr_ret_playlist, "(" . $playlist->client_name . ") " . $playlist->playlist_name);
			}
			$this->template->arr_playlist = $arr_ret_playlist;
			$this->template->movie_id = $movie_id;
			$this->template->movie_name = $movie->movie_name;
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
			->rule('movie_id', 'not_empty')
			->rule('movie_id', 'digit')
			->rule('movie_id', 'common_movie_id')
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
	private function del($movie_id){
		$ret = false;
		$movie = $this->model->sel_movie($movie_id);
		if(!empty($movie[0])){
			$this->model->db->begin();
			$movie = $movie[0];
			$movie_db = new Db_Up();
			$movie_db->movie_id = $this->post["movie_id"];
			$ret = $this->model->del_movie($movie_db);
			if($ret){
				File::del_movie_files($movie);	//The active file is automatically deleted at the next synchronous batch execution
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
			$temp_buff =  $this->post["chk_movie"];
			$loop_cnt = count($temp_buff);
			$arr_movie_name = null;
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		for($i=0;$i<$loop_cnt;$i++){
			try{
				$movie_id = $this->post["chk_movie"][$i];
			}catch(Exception $e){
				//When parameter invalid, return to the list screen
				$this->request->redirect($this->module_name);
			}
			if($this->act === "lump_del"){
				//Delete data
				if($this->chk_token() && $this->lump_del_validation() && $this->lump_del($movie_id)){
					//Redirect to list on success
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => true));
					$this->request->redirect($this->module_name);
				} else {
					//Data registration failure display
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false));
				}
			} else {
				//display
				$movie = $this->model->sel_movie_name($movie_id);
				if(!empty($movie[0])){
					$movie = $movie[0];
					$arr_movie_name[$i] = $movie->movie_name;
				} else {
					$movie = null;
				}
			}
			$arr_movie_id[$i] = $movie_id;

		}

		//Set value to template
		if(isset($movie)){
			$arr_ret_playlist = array();
			for($i=0;$i<count($arr_movie_id);$i++){
				$arr_playlist = $this->model->sel_arr_playlist_by_movie_id($arr_movie_id[$i]);
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
			$this->template->movie_id = $arr_movie_id;
			$this->template->movie_name = $arr_movie_name;

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
			->rule('chk_movie', 'not_empty')
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
	private function lump_del($movie_id){
		$ret = false;
		$movie_db = new Db_Up();
		$this->model->db->begin();

		$del_cnt = count($this->post["chk_movie"]);
		for($i=0;$i<$del_cnt;$i++){
			$movie_id = $this->post["chk_movie"][$i];
			$movie = $this->model->sel_movie($movie_id);
			if(!empty($movie[0])){
				$movie = $movie[0];
				$movie_db->movie_id = $this->post["chk_movie"][$i];
				$ret = $this->model->del_movie($movie_db);
				if($ret){
					File::del_movie_files($movie);	//The active file is automatically deleted at the next synchronous batch execution
				}
			}
		}
		$ret = $this->model->db->end($ret);
		return $ret;
	}
}
