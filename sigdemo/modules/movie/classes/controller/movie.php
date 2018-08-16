<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Movie extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Movie($this->get_target_client_id());
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
				//Delete all
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
		$this->template->arr_all_movie = array();
		$this->template->arr_all_movie[""] = "";
		$this->template->arr_all_ad = Controller_Template::get_arr_ad();
		foreach($arr_movie as $movie){
			$this->template->arr_all_movie[$movie->movie_id] = $movie->movie_name;

			$movie->update_user = $this->get_user_name_from_db_user($movie->update_user);

			//URL
			if(!empty($movie->movie_orig_file_exte)){
				$movie->movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $movie->file_name . $movie->movie_orig_file_exte;
			} else if(!empty($movie->sound_orig_file_exte)){
				$movie->movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $movie->file_name . $movie->sound_orig_file_exte;
			}

			//tag
			$arr_movie_tag = $this->model->sel_arr_movie_tag_by_movie_id($movie->movie_id);
			$movie->arr_tag = $arr_movie_tag;

			//Playback time
			$movie->play_time = $this->toggle_time_format($movie->play_time);

			// Advertisement type
			$movie->ad_name = $this->template->arr_all_ad[$movie->ad_flag];
		}

		//Set value to template
		$this->head_add = "head.movie.template";
		$this->template->arr_all_tag = Controller_Template::get_arr_movie_tag();
		$this->template->arr_all_playlist = Controller_Template::get_arr_playlist();
		$this->template->tag_and_or = Controller_Template::get_arr_tag_and_or(false);
		$this->template->all_movie_cnt = $all_movie_cnt[0]->cnt;
		$this->template->arr_movie = $arr_movie;
		$this->template->arr_all_property = array(""=>"-");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
		}
		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('movie.ins_post');
			$_FILES = $this->session->get('movie.ins_file');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('movie.ins_post');
				$this->session->delete('movie.ins_file');

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
				//Move temporary file (movie)
				$temp_movie_file = TEMP_FILE_DIR.basename($_FILES["movie_file"]["tmp_name"]);
				if(move_uploaded_file($_FILES["movie_file"]["tmp_name"], $temp_movie_file)){
					$_FILES["movie_file"]["tmp_name"] = $temp_movie_file;
				}
				//Move temporary file (movie)
				$temp_image_file = TEMP_FILE_DIR.basename($_FILES["image_file"]["tmp_name"]);
				if(move_uploaded_file($_FILES["image_file"]["tmp_name"], $temp_image_file)){
					$_FILES["image_file"]["tmp_name"] = $temp_image_file;
				}

				//Store in session
				$this->session->set('movie.ins_post', $this->post);
				$this->session->set('movie.ins_file', $_FILES);

				//Template selection
				$this->template->set_filename("movie.ins_conf.template");
			}
		} else {
			$this->post["property_id"] = "";
			//If there is session data set as initial value
			if($this->session->get('movie.ins_post')){
				$this->post = $this->session->get('movie.ins_post');
				$this->session->delete('movie.ins_post');
				$this->session->delete('movie.ins_file');
			}
		}

		//Set value to template
		$this->template->arr_all_draw_size = Controller_Template::get_arr_draw_size();
		$this->template->arr_all_tag = Controller_Template::get_arr_movie_tag(false);
		$this->template->map_list = Controller_Template::get_arr_playtime(false);
		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->arr_all_ad = Controller_Template::get_arr_ad();
		$this->template->arr_all_property = array(""=>"なし");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
		}
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			// Video file check
			if(!empty($_FILES["movie_file"])){
				$movie_file = $_FILES["movie_file"]["name"];
				if(!empty($movie_file) && is_uploaded_file($_FILES["movie_file"]["tmp_name"])){
					$this->post["movie_file_size"] = filesize($_FILES["movie_file"]["tmp_name"]);
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

/*
			// テロップ(静止画)ファイルチェック
			if(!empty($_FILES["image_file"]["name"])){
				$image_file = $_FILES["image_file"]["name"];
				if(!empty($image_file)){
					$image_orig_file_name = substr($image_file, 0, strrpos($image_file, '.'));
					$this->post["image_orig_file_name"] = $image_orig_file_name;
					$image_orig_file_exte = substr($image_file, strrpos($image_file, '.'));
					$this->post["image_orig_file_exte"] = $image_orig_file_exte;
				}

				//画像ファイルサイズ整合性チェック
				$temp_image_file = $_FILES["image_file"]["tmp_name"];
				$this->post["image_file_size"] = filesize($_FILES["image_file"]["tmp_name"]);
				try{
					$im = new imagick($temp_image_file);
					$geo = $im->getImageGeometry();
					$width = $geo["width"];
					$height = $geo["height"];
				}catch(Exception $e){
					//ファイル形式エラー
					Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
					$this->arr_ret_error["image_file"] = array("file");
					$ret = false;
				}
				//画像ファイルサイズ整合性チェック
				if(!empty($width) && !empty($height)){
					$draw_size = sprintf('%s*%s', $width, $height);
					$this->post["draw_size"] = $draw_size;
				}
			}
			if(empty($this->post["image_orig_file_name"]) || empty($this->post["image_orig_file_exte"])){
				//ファイルが存在しない場合はエラー
				$this->arr_ret_error = array("image_file" => array("not_empty"));
				$ret = false;
			}
*/

			//Validation
			$this->validation = Validation::factory($this->post)
				->rule('movie_name', 'not_empty')
				->rule('movie_name', 'max_length', array(':value', '60'))
				->rule('movie_name', 'movie_name_exists')
				->rule('sta_dt', 'date')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
				->rule('movie_file_size', 'client_total_file_size', array(':validation', 'movie_file_size', 'client_id'))
//				->rule('image_file_size', 'client_total_file_size', array(':validation', 'image_file_size', 'client_id'))
				->rule('movie_orig_file_name', 'max_length', array(':value', '256'))
				->rule('movie_orig_file_exte', 'max_length', array(':value', '8'))
				->rule('movie_orig_file_exte', 'movie_exte')
//				->rule('image_orig_file_name', 'max_length', array(':value', '256'))
//				->rule('image_orig_file_exte', 'max_length', array(':value', '8'))
//				->rule('image_orig_file_exte', 'image_exte')
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
		// Register ticker first
		$ret = true;
		$image = new Db_Ins();
		$temp_image_file = $_FILES["image_file"]["tmp_name"];
		try{
			$im = new imagick($temp_image_file);
			$geo = $im->getImageGeometry();
			$width = $geo["width"];
			$height = $geo["height"];
			$image->rotate_flag = 0;
		}catch(Exception $e){
			//File format error
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$this->arr_ret_error["image_file"] = array("file");
			$ret = false;
		}
 		$image->image_name = $this->post["movie_name"]."テロップ";
		$image->client_id = $this->post["client_id"];
		$image->width = $width;
		$image->height = $height;
		$image->sta_dt = Text::chk_str($this->post, "sta_dt", null) . " 00:00:00";
		$image->end_dt = Text::chk_str($this->post, "end_dt", null) . " 23:59:59";
		$image->image_orig_file_name = $this->post["image_orig_file_name"];
		$image->image_orig_file_exte = $this->post["image_orig_file_exte"];
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$image->property_id = Text::chk_str($this->post, "property_id", null);
		$image->orig_file_dir = null;
		$image->orig_hash = null;
		$image->file_name = null;

		//DB registration
		$this->model->db->begin();
		$image_id = $this->model->sel_next_image_id();
		if(is_null($image_id)){
			$ret = false;
		} else {
			$image->image_id = $image_id;
			$image->file_name = str_pad(strval($image->image_id), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT);
			$client_dir = str_pad(strval($image->client_id), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT) . "/";
			$image->orig_file_dir = $client_dir . IMAGE_FILE_DIR . str_pad(strval(intval(sqrt($image->image_id / CTS_PER_DIR))), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT) . "/";
		}

		//Data file move
		if($ret){
			if(file_exists(ORIG_FILE_DIR . $client_dir) === false){
				mkdir(ORIG_FILE_DIR . $client_dir);
				chmod(ORIG_FILE_DIR . $client_dir, 0775);
			}
			if(file_exists(ORIG_FILE_DIR . $client_dir . IMAGE_FILE_DIR) === false){
				mkdir(ORIG_FILE_DIR . $client_dir . IMAGE_FILE_DIR);
				chmod(ORIG_FILE_DIR . $client_dir . IMAGE_FILE_DIR, 0775);
			}
			if(file_exists(ORIG_FILE_DIR . $image->orig_file_dir) === false){
				mkdir(ORIG_FILE_DIR . $image->orig_file_dir);
				chmod(ORIG_FILE_DIR . $image->orig_file_dir, 0775);
			}

			$dest_image_file = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . $image->image_orig_file_exte;
			$ret = (is_file($temp_image_file) && copy($temp_image_file, $dest_image_file));

			if($ret){
				chmod($dest_image_file, 0664);
				$image->orig_hash = hash_file(HASH_ALGO, $dest_image_file);
				$image->orig_file_size = filesize($dest_image_file);
			}
		}

		//DB registration (image)
		if($ret){
			$ret = $this->model->ins_image($image);
		}

		//Thumbnail image generation
		if($ret && is_file($dest_image_file)){
			$im_thum = new imagick($dest_image_file);
			$geo = $im_thum->getImageGeometry();
			$width = $geo["width"];
			$im_thum->thumbnailImage($width/10, 0);
			$thum_image_file = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . "_thum" . $image->image_orig_file_exte;
			$im_thum->writeImage($thum_image_file);

		}

//		//DB登録(タグ)
//		if($ret && !empty($arr_tag)){
//			foreach($arr_tag as $tag){
//				$image_tag_rela = new Db_Ins();
//				$image_tag_rela->image_id = $image->image_id;
//				$image_tag_rela->image_tag_id = $tag;
//				$ret = $this->model->ins_image_tag_rela($image_tag_rela);
//				if($ret === false){
//					break;
//				}
//			}
//		}

//		$ret = $image_model->db->end($ret);
//		if(!ret){
//			return ret;
//		}

		// Video registration
		$movie = new Db_Ins();
		$movie->movie_name = $this->post["movie_name"];
		$movie->image_id = $image->image_id;
		$movie->client_id = $this->post["client_id"];
		$movie->ad_flag = $this->post["ad_flag"];
		if(isset($this->post["rotate_flag"])){
			$movie->rotate_flag = $this->post["rotate_flag"];
		} else {
			$movie->rotate_flag = 0;
		}
		$movie->sta_dt = Text::chk_str($this->post, "sta_dt", null) . " 00:00:00";
		$movie->end_dt = Text::chk_str($this->post, "end_dt", null) . " 23:59:59";

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

		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$movie->property_id = Text::chk_str($this->post, "property_id", null);
		$movie->orig_file_dir = null;
		$movie->movie_orig_hash = null;
		$movie->sound_orig_hash = null;
		$movie->movie_orig_file_size = null;
		$movie->sound_orig_file_size = null;
		$movie->file_name = null;

		//DB registration
//		$this->model->db->begin();
		$src_movie_file = null;
		$src_sound_file = null;
		$movie_id = $this->model->sel_next_movie_id();
		if(is_null($movie_id)){
			$ret = false;
		} else {
			$movie->movie_id = $movie_id;
			$movie->file_name = str_pad(strval($movie->movie_id), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT);
			$client_dir = str_pad(strval($movie->client_id), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT) . "/";
			$movie->orig_file_dir = $client_dir . MOVIE_FILE_DIR . str_pad(strval(intval(sqrt($movie->movie_id / CTS_PER_DIR))), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT) . "/";
		}

		//Data file move
		if(file_exists(ORIG_FILE_DIR . $client_dir) === false){
			mkdir(ORIG_FILE_DIR . $client_dir);
			chmod(ORIG_FILE_DIR . $client_dir, 0775);
		}
		if(file_exists(ORIG_FILE_DIR . $client_dir . MOVIE_FILE_DIR) === false){
			mkdir(ORIG_FILE_DIR . $client_dir . MOVIE_FILE_DIR);
			chmod(ORIG_FILE_DIR . $client_dir . MOVIE_FILE_DIR, 0775);
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

			//DB registration (tag)
			if($ret && !empty($arr_tag)){
				foreach($arr_tag as $tag){
					$movie_tag_rela = new Db_Ins();
					$movie_tag_rela->movie_id = $movie->movie_id;
					$movie_tag_rela->movie_tag_id = $tag;
					$movie_tag_rela->client_id = $movie->client_id;
					$ret = $this->model->ins_movie_tag_rela($movie_tag_rela);
					if($ret === false){
						break;
					}
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
			$movie_id = $this->post["movie_id"];
//			$image_id = $this->post["image_id"];
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
		$image = $this->model->sel_image($image_id);
/*
		// It may not be necessary
		if(empty($image[0])){

			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
*/
		$movie = $movie[0];
		$image = $image[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('movie.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('movie.up_post');

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
				$this->session->set('movie.up_post', $this->post);

				//Template selection
				$this->template->set_filename("movie.up_conf.template");
			}
		} else {
			//display
			$this->post["movie_id"] = $movie_id;
			$this->post["image_id"] = $image_id;
			$this->post["movie_name"] = $movie->movie_name;
			$this->post["client_id"] = $movie->client_id;
			$this->post["ad_flag"] = $movie->ad_flag;
			$this->post["rotate_flag"] = (string)$movie->rotate_flag;
			if($movie->play_time == 0){
				$this->post["play_time-m"] = '0';
				$this->post["play_time-s"] = '0';
			} else {
				list($this->post["play_time-m"], $this->post["play_time-s"]) = explode(':', $this->toggle_time_format($movie->play_time));
			}
			$this->post["sta_dt"] = $movie->sta_dt;
			$this->post["end_dt"] = $movie->end_dt;
			$this->post["arr_tag"] = array();
			$arr_sel_tag = $this->model->sel_arr_movie_tag_by_movie_id($movie_id);
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->movie_tag_id);
			}
			if(isset($movie->property_id)){
				$this->post["property_id"] = $movie->property_id;
			}else{
				$this->post["property_id"] = "";
			}

			//If there is session data set as initial value
			if ( $this->session->get('movie.up_post') ) {
				$this->post = $this->session->get('movie.up_post');
				$this->session->delete('movie.up_post');
			}
		}
		$this->post["movie_orig_file_name"] = $movie->movie_orig_file_name;
		$this->post["movie_orig_file_exte"] = $movie->movie_orig_file_exte;
		$this->post["sound_orig_file_name"] = $movie->sound_orig_file_name;
		$this->post["sound_orig_file_exte"] = $movie->sound_orig_file_exte;
		$this->post["image_orig_file_name"] = $image->orig_file_name;
		$this->post["image_orig_file_exte"] = $image->orig_file_exte;

		//Set value to template
		$this->template->arr_all_draw_size = Controller_Template::get_arr_draw_size();
		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->arr_all_ad = Controller_Template::get_arr_ad();
		$this->template->arr_all_tag = Controller_Template::get_arr_movie_tag(false);
		$this->template->map_list = Controller_Template::get_arr_playtime(false);
		$this->template->arr_all_property = array(""=>"None");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
		}
		if(!empty($image->width) && !empty($image->height)){
			$this->post["draw_size"] = $image->width . "*" . $image-> height;
		}
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
				->rule('movie_id', 'movie_id')
				->rule('movie_name', 'not_empty')
				->rule('movie_name', 'max_length', array(':value', '60'))
				->rule('movie_name', 'movie_name_exists_exclude_id', array(':validation', 'movie_name', 'movie_id'))

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
		$ret = true;
		$image = new Db_Up();
		$image->image_id = $this->post["image_id"];

 		$image->image_name = $this->post["movie_name"]."telop";
		$image->client_id = $this->post["client_id"];

		$image->sta_dt = Text::chk_str($this->post, "sta_dt", null) . " 00:00:00";
		$image->end_dt = Text::chk_str($this->post, "end_dt", null) . " 23:59:59";

		$image->property_id = Text::chk_str($this->post, "property_id", null);

		//DB registration (image)
		$this->model->db->begin();

		if(isset($image->image_id) && $image->image_id != ""){
			$ret = $this->model->up_image($image);
		}

		// Update video
		$movie = new Db_Up();
		$movie->movie_id = $this->post["movie_id"];
		$movie->movie_name = $this->post["movie_name"];
		$movie->client_id = $this->post["client_id"];
		$movie->ad_flag = $this->post["ad_flag"];
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
		$movie->sta_dt = Text::chk_str($this->post, "sta_dt", null) . " 00:00:00";
		$movie->end_dt = Text::chk_str($this->post, "end_dt", null) . " 23:59:59";
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$movie->property_id = Text::chk_str($this->post, "property_id", null);

		//DB registration (movie)
		$ret = $this->model->up_movie($movie);

		//DB registration (tag)
		if($ret){
			$arr_old_tag = $this->model->sel_arr_movie_tag_by_movie_id($movie->movie_id);
			foreach($arr_old_tag as $old_tag){
				$exists = false;
				foreach($arr_tag as $tag){
					if($old_tag->movie_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$movie_tag_rela = new Db_Up();
					$movie_tag_rela->movie_id = $movie->movie_id;
					$movie_tag_rela->movie_tag_id = $old_tag->movie_tag_id;
					$movie_tag_rela->client_id = $movie->client_id;
					$this->model->del_movie_tag_rela($movie_tag_rela);
				}
			}

			foreach($arr_tag as $tag){
				$exists = false;
				foreach($arr_old_tag as $old_tag){
					if($old_tag->movie_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//If it does not exist, register
					$movie_tag_rela = new Db_Ins();
					$movie_tag_rela->movie_id = $movie->movie_id;
					$movie_tag_rela->movie_tag_id = $tag;
					$movie_tag_rela->client_id = $movie->client_id;
					$this->model->ins_movie_tag_rela($movie_tag_rela);
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
			$movie_id = $this->post["movie_id"];
			$image_id = $this->post["image_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
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

			$image = $this->model->sel_image_name($image_id);
			if(!empty($image[0])){
				$image = $image[0];
			} else {
				$image = null;
			}
		}

		//Set value to template
		if(isset($movie)){
			$arr_playlist = $this->model->sel_arr_playlist_by_movie_id($movie_id);
			$arr_ret_playlist = array();
			foreach($arr_playlist as $playlist){
				array_push($arr_ret_playlist, $playlist->playlist_name);
			}
			$this->template->arr_playlist = $arr_ret_playlist;
			$this->template->movie_id = $movie_id;
			$this->template->image_id = $image_id;
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
			->rule('movie_id', 'movie_id')
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
			$movie_db->client_id = $movie->client_id;
			$ret = $this->model->del_movie($movie_db);
			if($ret){
				File::del_movie_files($movie);	//The active file is automatically deleted at the next synchronous batch execution
			}
//			$ret = $this->model->db->end($ret);
//		}
//		if(!ret){
//			return ret;
//		}

			$image = $this->model->sel_image($movie->image_id);
			if(!empty($image[0])){
//			$image_model = new Model_Image($movie->client_id);
//			$this->model->db->begin();
				$image = $image[0];
				$image_db = new Db_Up();
				$image_db->image_id = $this->post["image_id"];
				$image_db->client_id = $image->client_id;
				$ret = $this->model->del_image($image_db);
				if($ret){
					File::del_image_files($image);	//The active file is automatically deleted at the next synchronous batch execution
				}
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
