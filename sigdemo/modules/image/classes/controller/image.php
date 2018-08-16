<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Image extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Image($this->get_target_client_id());
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
		$all_image_cnt = $this->model->sel_cnt_image($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_image_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_image = $this->model->sel_arr_image($this->search);
		foreach($arr_image as $image){
			$image->update_user = $this->get_user_name_from_db_user($image->update_user);

			//URL
			if(!empty($image->orig_file_exte)){
				$image->image_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/image/" . $image->file_name . $image->orig_file_exte;
			}

			//tag
			$arr_image_tag = $this->model->sel_arr_image_tag_by_image_id($image->image_id);
			$image->arr_tag = $arr_image_tag;

			//Image size
			$image->draw_size_name = sprintf('%s*%s', $image->width, $image->height);

			//Thumbnail image path
			$chk_thum_file = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . "_thum" . $image->orig_file_exte;
			if(is_file($chk_thum_file)){
				$image->thum_image_file = SERVER_URL . $image->orig_file_dir . $image->file_name . "_thum" . $image->orig_file_exte;
			} else {
				$image->thum_image_file = $image->image_url;
			}
		}

		//Set value to template
		$this->head_add = "head.image.template";
		$this->template->arr_all_draw_size = Controller_Template::get_arr_draw_size();
		$this->template->arr_all_tag = Controller_Template::get_arr_image_tag();
		$this->template->arr_all_playlist = Controller_Template::get_arr_playlist();
		$this->template->tag_and_or = Controller_Template::get_arr_tag_and_or(false);
		$this->template->all_image_cnt = $all_image_cnt[0]->cnt;
		$this->template->arr_image = $arr_image;
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
			$this->post = $this->session->get('image.ins_post');
			$_FILES = $this->session->get('image.ins_file');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('image.ins_post');
				$this->session->delete('image.ins_file');

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
				$temp_image_file = TEMP_FILE_DIR.basename($_FILES["image_file"]["tmp_name"]);
				if(move_uploaded_file($_FILES["image_file"]["tmp_name"], $temp_image_file)){
					$_FILES["image_file"]["tmp_name"] = $temp_image_file;
				}

				//Store in session
				$this->session->set('image.ins_post', $this->post);
				$this->session->set('image.ins_file', $_FILES);

				//Template selection
				$this->template->set_filename("image.ins_conf.template");
			}
		} else {
			$this->post["property_id"] = "";
			//If there is session data set as initial value
			if($this->session->get('image.ins_post')){
				$this->post = $this->session->get('image.ins_post');
				$this->session->delete('image.ins_post');
				$this->session->delete('image.ins_file');
			}
		}

		//Set value to template
		$this->template->arr_all_draw_size = Controller_Template::get_arr_draw_size();
		$this->template->arr_all_tag = Controller_Template::get_arr_image_tag(false);
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
			//File check
			if(!empty($_FILES["image_file"]["name"])){
				$image_file = $_FILES["image_file"]["name"];
				if(!empty($image_file)){
					$orig_file_name = substr($image_file, 0, strrpos($image_file, '.'));
					$this->post["orig_file_name"] = $orig_file_name;
					$orig_file_exte = substr($image_file, strrpos($image_file, '.'));
					$this->post["orig_file_exte"] = $orig_file_exte;
				}

				//Image file size consistency check
				$temp_image_file = $_FILES["image_file"]["tmp_name"];
				$this->post["file_size"] = filesize($_FILES["image_file"]["tmp_name"]);
				try{
					$im = new imagick($temp_image_file);
					$geo = $im->getImageGeometry();
					$width = $geo["width"];
					$height = $geo["height"];
				}catch(Exception $e){
					//File format error
					Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
					$this->arr_ret_error["image_file"] = array("file");
					$ret = false;
				}
				//Image file size consistency check
				if(!empty($width) && !empty($height)){
					$draw_size = sprintf('%s*%s', $width, $height);
					$this->post["draw_size"] = $draw_size;
				}
			}
			if(empty($this->post["orig_file_name"]) || empty($this->post["orig_file_exte"])){
				//Error if file does not exist
				$this->arr_ret_error = array("image_file" => array("not_empty"));
				$ret = false;
			}

			//Validation
			$this->validation = Validation::factory($this->post)
				->rule('image_name', 'not_empty')
				->rule('image_name', 'max_length', array(':value', '60'))
				->rule('image_name', 'image_name_exists')
				->rule('file_size', 'client_total_file_size')
				->rule('sta_dt', 'date')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
				->rule('orig_file_name', 'max_length', array(':value', '256'))
				->rule('orig_file_name', 'image_file_name_exists', array(':validation', 'orig_file_name', 'orig_file_exte'))
				->rule('orig_file_exte', 'max_length', array(':value', '8'))
				->rule('orig_file_exte', 'image_exte')
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
		$image = new Db_Ins();
		$temp_image_file = $_FILES["image_file"]["tmp_name"];
		try{
			$im = new imagick($temp_image_file);
			$geo = $im->getImageGeometry();
			$width = $geo["width"];
			$height = $geo["height"];
			$this->post["rotate_flag"] = 0;
		}catch(Exception $e){
			//File format error
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$this->arr_ret_error["image_file"] = array("file");
			$ret = false;
		}
		$image->image_name = $this->post["image_name"];
		$image->width = $width;
		$image->height = $height;
		$image->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$image->end_dt = Text::chk_str($this->post, "end_dt", null);
		$image->orig_file_name = $this->post["orig_file_name"];
		$image->orig_file_exte = $this->post["orig_file_exte"];
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
			$client_dir = str_pad(strval($this->get_target_client_id()), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT) . "/";
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

			$dest_image_file = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . $image->orig_file_exte;
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
			$thum_image_file = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . "_thum" . $image->orig_file_exte;
			$im_thum->writeImage($thum_image_file);

		}

		// DB registration (tag)
		if($ret && !empty($arr_tag)){
			foreach($arr_tag as $tag){
				$image_tag_rela = new Db_Ins();
				$image_tag_rela->image_id = $image->image_id;
				$image_tag_rela->image_tag_id = $tag;
				$ret = $this->model->ins_image_tag_rela($image_tag_rela);
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
			$image_id = $this->post["image_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$arr_sel_tag = $this->model->sel_arr_image_tag_by_image_id($image_id);
		$image = $this->model->sel_image($image_id);
		if(empty($image[0])){
			//Redirect to list when target is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$image = $image[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('image.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('image.up_post');

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
				$this->session->set('image.up_post', $this->post);

				//Template selection
				$this->template->set_filename("image.up_conf.template");
			}
		} else {
			//display
			$this->post["image_id"] = $image_id;
			$this->post["image_name"] = $image->image_name;
			$this->post["sta_dt"] = $image->sta_dt;
			$this->post["end_dt"] = $image->end_dt;
			$this->post["arr_tag"] = array();
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->image_tag_id);
			}
			if(isset($image->property_id)){
				$this->post["property_id"] = $image->property_id;
			}else{
				$this->post["property_id"] = "";
			}
			//If there is session data set as initial value
			if($this->session->get('image.up_post')){
				$this->post = $this->session->get('image.up_post');
				$this->session->delete('image.up_post');
			}
		}
		$this->post["orig_file_name"] = $image->orig_file_name;
		$this->post["orig_file_exte"] = $image->orig_file_exte;
		if(!empty($image->width) && !empty($image->height)){
			$this->post["draw_size"] = $image->width . "*" . $image-> height;
		}

		//Set value to template
		$this->template->arr_all_tag = Controller_Template::get_arr_image_tag(false);
		$this->template->arr_all_property = array(""=>"なし");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
		}
	}

	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('image_id', 'not_empty')
				->rule('image_id', 'digit')
				->rule('image_id', 'image_id')
				->rule('image_name', 'not_empty')
				->rule('image_name', 'max_length', array(':value', '60'))
				->rule('image_name', 'image_name_exists_exclude_id', array(':validation', 'image_name', 'image_id'))
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
		$image = new Db_Up();
		$image->image_id = $this->post["image_id"];
		$image->image_name = $this->post["image_name"];
		$image->sta_dt = Text::chk_str($this->post, "sta_dt", null);
		$image->end_dt = Text::chk_str($this->post, "end_dt", null);
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$image->property_id = Text::chk_str($this->post, "property_id", null);

		// DB registration (image)
		$this->model->db->begin();
		$ret = $this->model->up_image($image);

		//DB registration (tag)
		if($ret){
			$arr_old_tag = $this->model->sel_arr_image_tag_by_image_id($image->image_id);
			foreach($arr_old_tag as $old_tag){
				$exists = false;
				foreach($arr_tag as $tag){
					if($old_tag->image_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$image_tag_rela = new Db_Up();
					$image_tag_rela->image_id = $image->image_id;
					$image_tag_rela->image_tag_id = $old_tag->image_tag_id;
					$this->model->del_image_tag_rela($image_tag_rela);
				}
			}

			foreach($arr_tag as $tag){
				$exists = false;
				foreach($arr_old_tag as $old_tag){
					if($old_tag->image_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//If it does not exist, register
					$image_tag_rela = new Db_Ins();
					$image_tag_rela->image_id = $image->image_id;
					$image_tag_rela->image_tag_id = $tag;
					$this->model->ins_image_tag_rela($image_tag_rela);
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
			$image_id = $this->post["image_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($image_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$image = $this->model->sel_image_name($image_id);
			if(!empty($image[0])){
				$image = $image[0];
			} else {
				$image = null;
			}
		}

		//Set value to template
		if(isset($image)){
			$arr_playlist = $this->model->sel_arr_playlist_by_image_id($image_id);
			$arr_ret_playlist = array();
			foreach($arr_playlist as $playlist){
				array_push($arr_ret_playlist, $playlist->playlist_name);
			}
			$this->template->arr_playlist = $arr_ret_playlist;
			$this->template->image_id = $image_id;
			$this->template->image_name = $image->image_name;
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
			->rule('image_id', 'not_empty')
			->rule('image_id', 'digit')
			->rule('image_id', 'image_id')
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
	private function del($image_id){
		$ret = false;
		$image = $this->model->sel_image($image_id);
		if(!empty($image[0])){
			$this->model->db->begin();
			$image = $image[0];
			$image_db = new Db_Up();
			$image_db->image_id = $this->post["image_id"];
			$ret = $this->model->del_image($image_db);
			if($ret){
				File::del_image_files($image);	//The active file is automatically deleted at the next synchronous batch execution
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
			$temp_buff =  $this->post["chk_image"];
			$loop_cnt = count($temp_buff);
			$arr_image_name = null;
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		for($i=0;$i<$loop_cnt;$i++){
			try{
				$image_id =  $this->post["chk_image"][$i];
			}catch(Exception $e){
				//When parameter invalid, return to the list screen
				$this->request->redirect($this->module_name);
			}

			if($this->act === "lump_del"){
				//Delete data
				if($this->chk_token() && $this->lump_del_validation() && $this->lump_del($image_id)){
					//Redirect to list on success
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => true));
					$this->request->redirect($this->module_name);
				} else {
					//Data registration failure display
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false));
				}
			} else {
				//display
				$image = $this->model->sel_image_name($image_id);
				if(!empty($image[0])){
					$image = $image[0];
					$arr_image_name[$i] = $image->image_name;
				} else {
					$image = null;
				}
			}
			$arr_image_id[$i]=$image_id;
		}

		//Set value to template
		if(isset($image)){
			$arr_ret_playlist = array();
			for($i=0;$i<count($arr_image_id);$i++){
				$arr_playlist = $this->model->sel_arr_playlist_by_image_id($arr_image_id[$i]);
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
			$this->template->image_id = $arr_image_id;
			$this->template->image_name = $arr_image_name;
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
			->rule('chk_image', 'not_empty')
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
	private function lump_del($image_id){
		$ret = false;
		$image_db = new Db_Up();
		$this->model->db->begin();

		$del_cnt = count($this->post["chk_image"]);
		for($i=0;$i<$del_cnt;$i++){
			$image_id = $this->post["chk_image"][$i];
			$image = $this->model->sel_image($image_id);
			if(!empty($image[0])){
				$image = $image[0];
				$image_db->image_id = $this->post["chk_image"][$i];
				$ret = $this->model->del_image($image_db);
				if($ret){
					File::del_image_files($image);	//The active file is automatically deleted at the next synchronous batch execution
				}
			}
		}
		$ret = $this->model->db->end($ret);
		return $ret;
	}
}
