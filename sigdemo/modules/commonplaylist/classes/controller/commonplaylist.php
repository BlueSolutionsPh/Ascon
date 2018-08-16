<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Commonplaylist extends Controller_Template {
	/**
	 * Update screen directly
	 */
	public function action_up(){
		if($this->request->param("param1", false)){
			$playlist_id = $this->request->param("param1");
			$this->post["disp"] = "up";
			$this->post["playlist_id"] = $playlist_id;
			$this->action_index();
		}
	}

	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Commonplaylist($this->get_target_client_id());
		switch($this->disp){
			case ACTION_INS_SELTMPL:
				//Registration screen template selection
				parent::disp_ins_before();
				$this->disp_ins_seltmpl();
				parent::disp_ins_after();
				break;
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
				break;
			case ACTION_UP_SELTMPL:
				//Registration screen template selection
				parent::disp_up_before();
				$this->disp_up_seltmpl();
				parent::disp_up_after();
				break;
			case ACTION_UP:
				//update
				parent::disp_up_before();
				$this->disp_up();
				parent::disp_up_after();
				break;
			case ACTION_COPY:
				//Replication
				parent::disp_up_before(); //Include authority, make same logic as update
				$this->disp_copy();
				parent::disp_up_after(); //Include authority, make same logic as update
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
				//List display
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
		if(SERVICE_ANTS_ONE_ENABLE === false){
			$this->search->ants_version=ANTS_TWO_KIND;
		}
		//Acquisition of data number
		$all_playlist_cnt = $this->model->sel_cnt_playlist($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_playlist_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_playlist = $this->model->sel_arr_playlist($this->search);
		foreach($arr_playlist as $playlist){
			//number
			$playlist->prog_cnt = $playlist->prog_cnt_now + $playlist->prog_cnt_future + $playlist->prog_cnt_rgl;

			//Get drawing area
			$playlist->arr_draw_area = $this->model->sel_arr_draw_area_by_draw_tmpl_id($playlist->draw_tmpl_id);
			foreach($playlist->arr_draw_area as $draw_area){
				$draw_area->arr_cts = array();
				switch($draw_area->cts_type){
					case "movie":
						$this->get_movie($playlist, $draw_area);
						break;
					case "sound":
						$this->get_sound($playlist, $draw_area);
						break;
					case "image":
						$this->get_image($playlist, $draw_area);
						break;
					case "text":
						$this->get_text($playlist, $draw_area);
						break;
				}
			}
		}

		$this->template->arr_all_playlist = array();
		$this->template->arr_all_playlist[""] = "";
		foreach($arr_playlist as $playlist){
			$this->template->arr_all_playlist[$playlist->playlist_id] = $playlist->playlist_name;
		}
		//Set value to template
		$this->head_add = "head.commonplaylist.template";
		$this->template->all_playlist_cnt     = $all_playlist_cnt[0]->cnt;
		$this->template->arr_playlist         = $arr_playlist;
		$this->template->arr_all_draw_tmpl    = Controller_Template::get_arr_draw_tmpl();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->pagination           = $pagination->render();
		$this->template->arr_time_zone        = Controller_Template::get_arr_time_zone();
		$this->set_template_common();


	}

	/**
	 * Template selection screen display
	 */
	private function disp_ins_seltmpl(){
		if($this->act === "seltmpl"){
			if($this->ins_seltmpl()){
				//Store in session
				$this->session->set('commonplaylist.ins_post', $this->post);
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
				return;
			} else {
					//Input check NG
				$this->session->set($this->module_name, array(ACTION_INS => false));
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('commonplaylist.ins_post')){
				$this->post = $this->session->get('commonplaylist.ins_post');
				$this->session->delete('commonplaylist.ins_post');
			}
		}

		//Set value to template
		$this->template->set_filename("commonplaylist.ins.seltmpl.template");
		$this->template->arr_all_draw_tmpl = Controller_Template::get_arr_draw_tmpl();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$arr_time_zone = array();
		$sel_all_time_zone = Controller_Template::get_arr_time_zone(false);
		$arr_time_zone[0] = "";
		$i = 1;
		foreach($sel_all_time_zone as $time_zone){
			if ( $time_zone != "全日" ){
				$arr_time_zone[$i] = $time_zone;
			}
			$i++;
		}
		$this->template->arr_time_zone      = $arr_time_zone;
		$this->set_template_common();
	}

	/**
	 * Template selection processing
	 */
	private function ins_seltmpl(){
		$ret = true;

		// Check existing data and delivery period duplication
		$ret = $this->check_overlap($this->post);
		$this->validation = Validation::factory($this->post)
			->rule('playlist_name', 'not_empty')
			->rule('playlist_name', 'max_length', array(':value', '60'))
			->rule('playlist_name', 'playlist_name_exists')
			->rule('sex_id', 'not_empty')
			->rule('sex_id', 'digit')
			->rule('sex_id', 'sex_id')
			->rule('timezone_id', 'not_empty')
			->rule('timezone_id', 'digit')
			->rule('timezone_id', 'timezone_id')
			->rule('deliverymonth_id', 'not_empty')
			->rule('deliverymonth_id', 'digit')
			->rule('deliverymonth_id', 'deliverymonth_id')
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
		return $ret;
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		$playlist_ins = $this->session->get('commonplaylist.ins_post');
		$this->post["draw_tmpl_id"] = DRAW_TMPL_LAND_MOVIE;
		$this->post["ants_version"] = ANTS_TWO_KIND;
		$this->chk_sess_post($playlist_ins);
		$playlist_ins["draw_tmpl_id"] = DRAW_TMPL_LAND_MOVIE;
		$playlist_ins["ants_version"] = ANTS_TWO_KIND;
		try{
			//Prerequisite
			foreach ($this->model->getPostDataKeys() as $key) ${$key} = $playlist_ins[$key];
		} catch(Exception $e){
			//Illegal operation
			$this->request->redirect($this->module_name);
		}
		$arr_tmp_draw_area = $this->model->sel_arr_draw_area_by_draw_tmpl_id($playlist_ins['draw_tmpl_id']);
		$arr_draw_area = array();
		foreach($arr_tmp_draw_area as $draw_area){
			array_push($arr_draw_area, array(
				"draw_area_id" => $draw_area->draw_area_id,
				"draw_size_id" => $draw_area->draw_size_id,
				"draw_area_name" => $draw_area->draw_area_name,
				"cts_type" => $draw_area->cts_type,
				"rotate_flag" => $draw_area->rotate_flag,
				"arr_cts" => array()
			));
		}

		$this->search->offset = $pagination->offset;
		$search = new stdClass;
		$search->offset = 0;
		$search->ants_version = ANTS_TWO_KIND;

		if(!in_array($this->act, array('conf', 'back'))){
			if($this->act === "ins"){
				$this->regist_process('ins');
			} else if($this->act === "cts_search"){
				$this->cts_search_process('ins');
			} else if($this->act === "cts_setting"){
				$this->cts_setting_process('ins');
			}
		 } else if($this->act === "conf"){
			$ret = true;
			$this->conf_process('ins');
		} else if($this->act === "back"){
			$this->back_process('ins');
		} else {
			//Illegal operation
			$this->request->redirect($this->module_name);
		}
		$this->search->sta_dt = $sta_dt;
		$this->search->end_dt = $end_dt;
		$arr_movie = $this->model->sel_arr_movie($this->search);
//		if(!empty($arr_movie)){
			$this->template->arr_all_movie = array();
			foreach($arr_movie as $movie){
				$this->template->arr_all_movie[$movie->movie_id] = array(
					'movie_name'     => $movie->movie_name,
					'sta_dt'         => $movie->sta_dt,
					'end_dt'         => $movie->end_dt,
					'movie_tag_name' => $movie->movie_tag_name,
				);
			}
//		}

		$this->set_template_registerpage($playlist_ins, 'ins');
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();

		if($ret){
			$db = Database::instance();
			$image_rec = Model_Util::sel_arr_image_draw_area_by_draw_tmpl_id($this->post["draw_tmpl_id"]);
			$arr_movie_rec = Model_Util::sel_arr_draw_area_by_draw_tmpl_id($this->post["draw_tmpl_id"]);

			//If not_empty is not included in the condition, empty characters are ignored, so change the condition here
			if(!empty($image_rec[0]) || (count($arr_movie_rec) === 1 && $arr_movie_rec[0]->cts_type === "movie")){
				//Template containing images
				$this->validation = Validation::factory($this->post)
					->rule('playlist_name', 'not_empty')
					->rule('playlist_name', 'max_length', array(':value', '60'))
					->rule('playlist_name', 'playlist_name_exists')
						;
			} else {
				//Template without image
				$this->validation = Validation::factory($this->post)
					->rule('playlist_name', 'not_empty')
					->rule('playlist_name', 'max_length', array(':value', '60'))
					->rule('playlist_name', 'playlist_name_exists')
						;
			}
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
		$playlist_ins = $this->session->get('commonplaylist.ins_post');
		$playlist_name = $playlist_ins["playlist_name"];
		$draw_tmpl_id = $playlist_ins["draw_tmpl_id"];
		$ants_version = $playlist_ins["ants_version"];

		$this->model->db->begin();
		$playlist_id = $this->model->sel_next_playlist_id();
		if(is_null($playlist_id)){
			$ret = false;
		} else {
			$playlist = new Db_Ins();
			foreach ($this->model->getPostDataKeys() as $key) $playlist->$key = $playlist_ins[$key];
			$playlist->playlist_id   = $playlist_id;
			$playlist->client_id     = null; // Common
			$playlist->playlist_desc = null;
//			$playlist->image_intvl   = (isset($this->post["image_intvl"])) ? $this->post["image_intvl"] : 0;
			$playlist->image_intvl   = 1; // Because the minimum value is 1, 1 fixed
			$playlist->random_flag   = (isset($this->post["random"])) ? $this->post["random"] : 0;

			$arr_movie = array();
//			if(isset($this->post["arr_movie"])){
//				$this->post["arr_movie"] = array_unique($this->post["arr_movie"]);
//			}
			$arr_tmp_movie_id = $this->post["arr_movie"];
			foreach($arr_tmp_movie_id as $tmp_movie_id){
				// Restore duplication prevention ID
				$tmp_movie_id = explode("_", $tmp_movie_id);
				$tmp_movie_id = $tmp_movie_id[0];

				//Regular terminal confirmation
				$movie_exists = $this->model->sel_movie($tmp_movie_id);
				if(!empty($movie_exists[0])){
					$movie = new StdClass();
					$movie->movie_id = $tmp_movie_id;
					array_push($arr_movie, $movie);
				}
			}

		}

		//DB registration (play list)
		if($ret){
			$playlist->sta_dt = $playlist->sta_dt . " 00:00:00";
			$playlist->end_dt = $playlist->end_dt . " 23:59:59";
			$ret = $this->model->ins_playlist($playlist);
		}

		if($ret){
			$i = 0;
			foreach($arr_movie as $movie){
				$playlist_movie_rela = new Db_Ins();
				$playlist_movie_rela->playlist_id = $playlist->playlist_id;
				$playlist_movie_rela->movie_id = $movie->movie_id;
				$playlist_movie_rela->draw_area_id = DRAW_AREA_LAND_MOVIE;
				$playlist_movie_rela->display_order = $i;
				$ret = $this->model->ins_playlist_movie_rela($playlist_movie_rela);
				$i++;
			}
		}
/*
		// Currently, playback using a still image (telop) file can not be performed, so do not include it in the playlist.
		// DB registration (related to playlist image)
		foreach($arr_playlist_image as $playlist_image){
			$playlist_image_rela = new Db_Ins();
			$playlist_image_rela->playlist_id = $playlist->playlist_id;
			$playlist_image_rela->image_id = $playlist_image->image_id;
			$playlist_image_rela->draw_area_id = $playlist_image->draw_area_id;
			$playlist_image_rela->display_order = $playlist_image->display_order;
			$this->model->ins_playlist_image_rela($playlist_image_rela);
		}
*/
		return $this->model->db->end($ret);
	}

	/**
	 * Template selection screen display
	 */
	private function disp_up_seltmpl(){

		if($this->act === "seltmpl"){
			if($this->up_seltmpl()){
				//Store in session
				$this->session->set('commonplaylist.up_post', $this->post);
				parent::disp_up_before();
				$this->disp_up();
				parent::disp_up_after();
				return;
			} else {
				//Input check NG
				$this->session->set($this->module_name, array(ACTION_UP => false));
			}
		} else {
			//If there is session data set as initial value
			try{
				$playlist_id = $this->post["playlist_id"];
			}catch(Exception $e){
				//When parameter invalid, return to the list screen
				$this->request->redirect($this->module_name);
			}
			$playlist = $this->model->sel_playlist($playlist_id);
			if(empty($playlist[0])){
				//Target absence
				$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
				$this->request->redirect($this->module_name);
			}
			$this->template->playlist_id    = $playlist_id;
			$playlist = $playlist[0];
			foreach ($this->model->getPostDataKeys() as $key) $this->post[$key] = $playlist->$key;

			if($this->session->get('commonplaylist.up_post')){
				$this->post = $this->session->get('commonplaylist.up_post');
				$this->session->delete('commonplaylist.up_post');
			}
		}
		//Set value to template
		$this->template->set_filename("commonplaylist.up.seltmpl.template");
		$this->template->arr_all_draw_tmpl = Controller_Template::get_arr_draw_tmpl();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();

		$arr_time_zone = array();
		$sel_all_time_zone = Controller_Template::get_arr_time_zone(false);
		$arr_time_zone[0] = "";
		$i = 1;
		foreach($sel_all_time_zone as $time_zone){
			if ( $time_zone != "全日" ){
				$arr_time_zone[$i] = $time_zone;
			}
			$i++;
		}
		$this->template->arr_time_zone      = $arr_time_zone;
		$this->set_template_common();

		if (isset($playlist_id) && $playlist_id !== "") {
			$this->template->playlist_id = $playlist_id;
			$this->post["playlist_id"]   = $playlist_id;
		}
	}

	/**
	 * Template selection processing
	 */
	private function up_seltmpl(){
		$ret = true;

		// Check existing data and delivery period duplication
		$ret = $this->check_overlap($this->post);
		$this->validation = Validation::factory($this->post)
			->rule('playlist_name', 'not_empty')
			->rule('playlist_name', 'max_length', array(':value', '60'))
			->rule('playlist_name', 'commonplaylist_name_exists_exclude_id', array(':validation', 'playlist_name', 'playlist_id'))
			->rule('sex_id', 'not_empty')
			->rule('sex_id', 'digit')
			->rule('sex_id', 'sex_id')
			->rule('timezone_id', 'not_empty')
			->rule('timezone_id', 'digit')
			->rule('timezone_id', 'timezone_id')
			->rule('deliverymonth_id', 'not_empty')
			->rule('deliverymonth_id', 'digit')
			->rule('deliverymonth_id', 'deliverymonth_id')
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
		return $ret;
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		$playlist_up = $this->session->get('commonplaylist.up_post');
		$this->post["draw_tmpl_id"] = DRAW_TMPL_LAND_MOVIE;
		$this->post["ants_version"] = ANTS_TWO_KIND;
		$playlist_up['draw_tmpl_id'] = DRAW_TMPL_LAND_MOVIE;
		$playlist_up['ants_version'] = ANTS_TWO_KIND;
		$this->chk_sess_post($playlist_up);
		try{
			//Prerequisite
			foreach ($this->model->getPostDataKeys() as $key) ${$key} = $playlist_up[$key];
			$playlist_id = $playlist_up["playlist_id"];
		} catch(Exception $e){
			//Illegal operation
			$this->request->redirect($this->module_name);
		}
		$this->template->playlist_id = $playlist_id;
		$this->post["playlist_id"]   = $playlist_id;

		$this->search->offset = $pagination->offset;
		$search = new stdClass;
		$search->offset = 0;
		$search->ants_version = ANTS_TWO_KIND;

		if(!in_array($this->act, array('conf', 'back'))){
			if($this->act === "up"){
				$this->regist_process('up');
			} else if($this->act === "cts_search"){
				$this->cts_search_process('up');
			} else {
				$this->cts_setting_process('up');
			}
		 } else if($this->act === "conf"){
			$ret = true;
			$this->conf_process('up');
		} else if($this->act === "back"){
			$this->back_process('up');
		} else {
			//Illegal operation
			$this->request->redirect($this->module_name);
		}
		$this->search->sta_dt = $sta_dt;
		$this->search->end_dt = $end_dt;
		$arr_movie = $this->model->sel_arr_movie($this->search, true);
//		if(!empty($arr_movie)){
			$this->template->arr_all_movie = array();
			foreach($arr_movie as $movie){
				$this->template->arr_all_movie[$movie->movie_id] = array(
					'movie_name'     => $movie->movie_name,
					'sta_dt'         => $movie->sta_dt,
					'end_dt'         => $movie->end_dt,
					'movie_tag_name' => $movie->movie_tag_name,
				);
			}
//		}

		$this->set_template_registerpage($playlist_up, 'up');
	}


	/**
	 * Replicated screen display
	 */
	private function disp_copy(){
		$this->disp_up();
	}

	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$db = Database::instance();

			$image_rec = Model_Util::sel_arr_image_draw_area_by_draw_tmpl_id($this->post["draw_tmpl_id"]);
			$arr_movie_rec = Model_Util::sel_arr_draw_area_by_draw_tmpl_id($this->post["draw_tmpl_id"]);

			//If not_empty is not included in the condition, empty characters are ignored, so change the condition here
			if(!empty($image_rec[0]) || (count($arr_movie_rec) === 1 && $arr_movie_rec[0]->cts_type === "movie")){
				//Template containing images
				$this->validation = Validation::factory($this->post)
					->rule('playlist_id', 'not_empty')
					->rule('playlist_id', 'digit')
					->rule('playlist_id', 'playlist_id')
//					->rule('playlist_name', 'not_empty')
//					->rule('playlist_name', 'max_length', array(':value', '60'))
//					->rule('playlist_name', 'playlist_name_exists_exclude_id', array(':validation', 'playlist_name', 'playlist_id'))
						;
			} else {
				//Template without image
				$this->validation = Validation::factory($this->post)
					->rule('playlist_id', 'not_empty')
					->rule('playlist_id', 'digit')
					->rule('playlist_id', 'playlist_id')
//					->rule('playlist_name', 'not_empty')
//					->rule('playlist_name', 'max_length', array(':value', '60'))
//					->rule('playlist_name', 'playlist_name_exists_exclude_id', array(':validation', 'playlist_name', 'playlist_id'))
						;
			}
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
		$playlist_up  = $this->session->get('commonplaylist.up_post');
		$draw_tmpl_id = $playlist->draw_tmpl_id;

		$playlist = $this->model->sel_playlist($playlist_up["playlist_id"]);
		$playlist = $playlist[0];

		$playlist = new Db_Up();
		foreach ($this->model->getPostDataKeys() as $key) $playlist->$key = $playlist_up[$key];
		$playlist->playlist_id   = $playlist_up["playlist_id"];
		$playlist->draw_area_id  = DRAW_AREA_LAND_MOVIE;
		$playlist->playlist_desc = null;
//		$playlist->image_intvl   = (isset($this->post["image_intvl"])) ? $this->post["image_intvl"] : 0;
		$playlist->image_intvl   = 1; // Because the minimum value is 1, 1 fixed
		$playlist->random_flag   = (isset($this->post["random"])) ? $this->post["random"] : 0;

		$arr_movie = array();
//		if(isset($this->post["arr_movie"])){
//			$this->post["arr_movie"] = array_unique($this->post["arr_movie"]);
//		}
		$arr_tmp_movie_id = $this->post["arr_movie"];
		$i = 0;
		foreach($arr_tmp_movie_id as $tmp_movie_id){
			// Restore duplication prevention ID
			$tmp_movie_id = explode("_", $tmp_movie_id);
			$tmp_movie_id = $tmp_movie_id[0];

			//Regular terminal confirmation
			$movie_exists = $this->model->sel_movie($tmp_movie_id);
			if(!empty($movie_exists[0])){
				$movie = new StdClass();
				$movie->movie_id = $tmp_movie_id;
				$movie->draw_area_id = DRAW_AREA_LAND_MOVIE;
				$movie->display_order = $i;
				$i++;
				array_push($arr_movie, $movie);
			}
		}
		//DB registration (play list)
		$this->model->db->begin();
		$playlist->sta_dt = $playlist->sta_dt . " 00:00:00";
		$playlist->end_dt = $playlist->end_dt . " 23:59:59";
		$ret = $this->model->up_playlist($playlist);

		if($ret){
			$arr_old_playlist_movie = $this->model->sel_arr_movie_by_playlist_id_draw_area_id($playlist->playlist_id, $playlist->draw_area_id);

			foreach($arr_old_playlist_movie as $old_playlist_movie){
				$exists = false;
				foreach($arr_movie as $playlist_movie){
					if($playlist->draw_area_id !== $old_playlist_movie->draw_area_id){
						$exists = true;
						break;
					}
					if($old_playlist_movie->display_order === $playlist_movie->display_order &&
					  (string)$old_playlist_movie->movie_id === $playlist_movie->movie_id){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$playlist_movie_rela = new Db_Up();
					$playlist_movie_rela->playlist_id   = $playlist->playlist_id;
					$playlist_movie_rela->movie_id      = $old_playlist_movie->movie_id;
					$playlist_movie_rela->draw_area_id  = $old_playlist_movie->draw_area_id;
					$playlist_movie_rela->display_order = $old_playlist_movie->display_order;
					$this->model->del_playlist_movie_rela($playlist_movie_rela);
				}
			}

			foreach($arr_movie as $playlist_movie){
				if($playlist->draw_area_id === $playlist_movie->draw_area_id){
					$exists = false;
					foreach($arr_old_playlist_movie as $old_playlist_movie){
						if($old_playlist_movie->display_order === $playlist_movie->display_order && (string)$old_playlist_movie->movie_id === $playlist_movie->movie_id){
							$exists = true;
							break;
						}
					}
					if(!$exists){
						//If it does not exist, register
						$playlist_movie_rela = new Db_Ins();
						$playlist_movie_rela->playlist_id = $playlist->playlist_id;
						$playlist_movie_rela->movie_id = $playlist_movie->movie_id;
						$playlist_movie_rela->draw_area_id = $playlist_movie->draw_area_id;
						$playlist_movie_rela->display_order = $playlist_movie->display_order;
						$this->model->ins_playlist_movie_rela($playlist_movie_rela);
					}
				}
			}
		}
		// t_playlist_movie_rela and t_playlist are updated.

		// 紐づけプレイリスト処理
		if($ret){
			$ret = $this->up_playlist_rela($playlist);
		}

		//Program guide update
		// Since the relation ID is only updated, updating of the program table is unnecessary


		if($ret){
			//Retrieve list of terminals for which playlist is set
			$arr_dev = $this->model->sel_arr_dev_by_playlist_id($playlist->playlist_id);
			//Reset DL status
			$dev_dlLog = new Db_Up();
			foreach($arr_dev as $dev){
				$dev_dlLog->dev_id = $dev->dev_id;
				$this->model->sel_dlLog_up($dev_dlLog);
			}
		}

		return $this->model->db->end($ret);
	}


	/**
	 * Playlist related registration
	 */
	private function up_playlist_rela($common_playlist){
		$ret = true;

		// Acquire the individual playlist ID of the influence target from the playlist linkage DB based on the ID of the common playlist
		$playlist_rela = new stdClass();
		$playlist_rela->common_playlist_id = $common_playlist->playlist_id;
		$arr_playlist_rela = $this->model->id_name_playlist_rela($playlist_rela);
		foreach($arr_playlist_rela as $playlist_rela_extra){

			// Get ID list of individual playlist related to t_playlist_rela here
			$del_playlist_flag = 0;

			if( $common_playlist->sex_id != $playlist_rela_extra->sex_id ){
				// Gender has changed
			}

			if( $common_playlist->timezone_id != $playlist_rela_extra->timezone_id ){
				// The time zone has changed
			}

			// To be affected by time zone and sex, because it is judged by validation at the time of preliminary common playlist registration / change,
			// It is impossible that data is suffering at this point.

			if( ( $common_playlist->sta_dt != $playlist_rela_extra->sta_dt ) || ( $common_playlist->end_dt != $playlist_rela_extra->end_dt ) ){
				// The deadline has changed
				// Since it is not possible to register with multiple deadlines for one individual playlist,
				// If the deadline is changed, delete that data
				$del_playlist_flag = 1;
			}
			if( $common_playlist->deliverymonth_id != $playlist_rela_extra->deliverymonth_id){
				// Distribution month changed
				// Since it is not possible to register with multiple deadlines for one individual playlist,
				// If the deadline is changed, delete that data
				$del_playlist_flag = 1;
			}

			// Delete existing data once: Playlist related
			$del_playlist_rela = new Db_Up();
			$del_playlist_rela->playlist_id = $playlist_rela_extra->playlist_id;
			$retD = $this->model->del_playlist_rela($del_playlist_rela);

			// Delete existing data once: Playlist video related (individual playlist)
			// Video related to common playlist has already been updated with up ()
			$del_playlist_movie_rela = new Db_Up();
			$del_playlist_movie_rela->playlist_id      = $playlist_rela_extra->playlist_id;
			$del_playlist_movie_rela->playlist_rela_id = $playlist_rela_extra->playlist_rela_id;
			$retC = $this->model->del_playlist_movie_rela_by_playlist_id($del_playlist_movie_rela);

			if( $del_playlist_flag === 1 ){
				// Skip without re-registering data
				continue;
			}

			// Playlist related registration processing
			// Create registration array
			$playlist_rela_array    = array();
			$or_list_array          = array();

			$client_id              = $playlist_rela_extra->client_id;
			$playlist_id            = $playlist_rela_extra->playlist_id;
			$extra_cnt = 0;

			// Acquire registered playlist information
			$default_chk        = 0;
			$morning_chk        = (EXTRA_PLAYLIST_MAX_MOVIE * ( TIME_ZONE_MORNING - 1));
			$afternoon_chk      = (EXTRA_PLAYLIST_MAX_MOVIE * ( TIME_ZONE_NOON - 1));
			$night_chk          = (EXTRA_PLAYLIST_MAX_MOVIE * ( TIME_ZONE_EVENING - 1));

			// Perform association process again
			$sel_playlist_rela_extra = new stdClass;
			$sel_playlist_rela_extra->playlist_rela_id = NULL;
			$sel_playlist_rela_extra->playlist_id = $playlist_rela_extra->playlist_id;
			$playlist_movie_rela = $this->model->sel_arr_playlist_movie_rela($sel_playlist_rela_extra);
			foreach($playlist_movie_rela as $movie_rela){
				$order_num = $movie_rela->display_order;
				$i          = 0;
				$sex_id     = SEX_KIND_MAN;
				// 時間帯 3種 * 2曲以上の登録があれば 性別のカウントを増やす。
				// Because there are 4 types of time zones, we will reduce one count

				if( $night_chk <= $order_num ) {
					$i      = (EXTRA_PLAYLIST_MAX_MOVIE * ( TIME_ZONE_EVENING - 1));
					$order_num = $order_num - $i;
					$sex_id = SEX_KIND_WOMAN;
				}
				$movie_rela->sex_id = $sex_id;

				if( $default_chk <= $order_num && $order_num < $morning_chk ) {
					// Morning
					$movie_rela->timezone_id = TIME_ZONE_MORNING;
				} else if( $morning_chk <= $order_num && $order_num < $afternoon_chk) {
					// Noon
					$movie_rela->timezone_id = TIME_ZONE_NOON;
				} else if( $afternoon_chk <= $order_num && $order_num < $night_chk) {
					// Night
					$movie_rela->timezone_id = TIME_ZONE_EVENING;
				}
				$or_list_array[$movie_rela->sex_id][$movie_rela->timezone_id][$extra_cnt] = $movie_rela;
				$extra_cnt++;
			}

			// Get common playlist
			$search = new stdClass;
			$search->offset         = $pagination->offset;
			$search->commonplaylist = true;
			$search->sta_dt         = $playlist_rela_extra->sta_dt;
			$search->end_dt         = $playlist_rela_extra->end_dt;

			$allitem      = array();
			$playlist_mov = array();

			$cnt = 0;
			//Data acquisition (Get list of common playlists)
			$cm_arr_playlist            = $this->model->sel_arr_common_playlist($search);
			foreach($cm_arr_playlist as $cm_playlist){
				$common_playlist_id     = $cm_playlist->playlist_id;
				$deliverymonth_id       = $cm_playlist->deliverymonth_id;
				$sex_id                 = $cm_playlist->sex_id;
				$timezone_id            = $cm_playlist->timezone_id;
				$sta_dt                 = $cm_playlist->sta_dt;
				$end_dt                 = $cm_playlist->end_dt;

				$playlist_id            = $playlist_rela_extra->playlist_id;
				// Confirm that there is no playlist cooperation table with the common playlist and the ID of the individual playlist cooperated
				$search = new stdClass;
				$search->offset             = 0;
				$search->common_playlist_id = $common_playlist_id;
				$search->sex_id             = $sex_id;
				$search->timezone_id        = $timezone_id;
				$search->sta_dt             = $sta_dt;
				$search->end_dt             = $end_dt;
				$search->client_id          = $playlist_rela_extra->client_id;
				$search->playlist_id        = $playlist_rela_extra->playlist_id;

				// Number assignment
				$playlist_rela_id = $this->model->sel_next_playlist_rela_id();

				// Acquire video relation information of common playlist
				$playlist_movie_common_rela = $this->model->sel_arr_id_name_playlist_movie_rela($cm_playlist);

				// Combine the relation information of the common playlist and relation information of the individual playlist
				foreach($playlist_movie_common_rela as $movie_common_rela ){

					$playlist_movie_rela                = new Db_Ins();
					$playlist_movie_rela->playlist_rela_id = $playlist_rela_id;
					$playlist_movie_rela->playlist_id   = $movie_common_rela->playlist_id;
					$playlist_movie_rela->movie_id      = $movie_common_rela->movie_id;
					$playlist_movie_rela->draw_area_id  = DRAW_AREA_LAND_MOVIE;

					$playlist_movie_rela->sex_id        = $sex_id;
					$playlist_movie_rela->deliverymonth_id = $deliverymonth_id;
					$playlist_movie_rela->timezone_id   = $timezone_id;
					$playlist_movie_rela->sta_dt        = $sta_dt;
					$playlist_movie_rela->end_dt        = $end_dt;

					$playlist_mov[$cnt] = $playlist_movie_rela;
					$cnt++;
				}

				// Link to a common playlist for each individual playlist
				$playlist_rela = new Db_Ins();
				$playlist_rela->playlist_rela_id   = $playlist_rela_id;
				$playlist_rela->timezone_id        = $timezone_id;
				$playlist_rela->playlist_id        = $playlist_id;
				$playlist_rela->client_id          = $client_id;
				$playlist_rela->common_playlist_id = $common_playlist_id;
				$playlist_rela->deliverymonth_id   = $deliverymonth_id;
				$playlist_rela->sex_id             = $sex_id;
				$playlist_rela->timezone_id        = $timezone_id;

				// Since there are cases where there are two common playlists within the individual playlist period,
				// Set based on start to end timing of common playlist
				$playlist_rela->sta_dt             = $sta_dt;
				$playlist_rela->end_dt             = $end_dt;

				// Add playlist linkage DB to array
				array_push($playlist_rela_array, $playlist_rela );
			}

			foreach ($or_list_array as $tmp_sex_id => $value1) {
				foreach ($value1 as $tmp_timezone_id => $value2) {

					// If there is no individual playlist value, continue
					if( 0 == count($value2)){
						continue;
					}
					$i = 0;
					// Since only the update process is executed and the relation individual playlist exists, the relationship ID is necessarily assigned, so acquisition
					$playlist_rela_id_commit = $playlist_rela_extra->playlist_rela_id;
					foreach ($playlist_mov as $cm_mov_rela){
						// Register as much as there are songs in the common playlist
						// There are no specifications for 0 common playlists (because it will be promised for each client and it will be unlimited)

						if( $cm_mov_rela->sex_id != $tmp_sex_id) {
							continue;
						}

						if( $cm_mov_rela->timezone_id != $tmp_timezone_id) {
							continue;
						}
						$playlist_movie_rela = new Db_Ins();
						$playlist_movie_rela->playlist_rela_id= $playlist_rela_id_commit;      // Register as linkage ID
						$playlist_movie_rela->playlist_id     = $cm_mov_rela->playlist_id;
						$playlist_movie_rela->movie_id        = $cm_mov_rela->movie_id;
						$playlist_movie_rela->display_order   = $i;
						$ret = $this->model->ins_playlist_movie_rela($playlist_movie_rela);
						$i++;
					}
					// Add for each individual playlist
					foreach ($value2 as $mov_rela){
						$playlist_movie_rela = new Db_Ins();
						$playlist_movie_rela->playlist_rela_id= $playlist_rela_id_commit;      // Register as linkage ID
						$playlist_movie_rela->playlist_id     = $mov_rela->playlist_id;
						$playlist_movie_rela->movie_id        = $mov_rela->movie_id;
						$playlist_movie_rela->display_order   = $i;
						$ret = $this->model->ins_playlist_movie_rela($playlist_movie_rela);
						$i++;
					}

				}
			}

			// Register playlist linkage DB
			foreach($playlist_rela_array as $playlist_rela ){
				$ret = $this->model->ins_playlist_rela($playlist_rela);
			}
		}

		return $ret;
	}


	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$playlist_id = $this->post["playlist_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
/*
		$cnt = $this->model->sel_cnt_prog_by_playlist_id($playlist_id);
		if(empty($cnt[0])){
			$this->session->set($this->module_name, array(ACTION_DEL => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$cnt = $cnt[0];
		if($cnt->prog_cnt_now > 0 || $cnt->prog_cnt_future > 0 || $cnt->prog_cnt_rgl > 0){
			//When returning to the list screen when setting the program guide
			$this->request->redirect($this->module_name);
		}
*/
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($playlist_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$playlist = $this->model->sel_playlist_name($playlist_id);
			if(!empty($playlist[0])){
				$playlist = $playlist[0];
			} else {
				$playlist = null;
			}
		}
		//Set value to template
		if(!is_null($playlist)){
			$this->template->playlist_id   = $playlist_id;
			$this->template->playlist_name = $playlist->playlist_name;
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
			->rule('playlist_id', 'not_empty')
			->rule('playlist_id', 'digit')
			->rule('playlist_id', 'playlist_id')
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
	private function del($playlist_id){
		$this->model->db->begin();
		$playlist = new Db_Up();
		$playlist->playlist_id = $playlist_id;
		$ret = $this->model->del_playlist($playlist);
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_lump_del(){
		try{
			$dummy2 =  $this->post["hoge"];
			$loop_cnt = count($dummy2);
			$arr_playlist_name = null;
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		for($i=0;$i<$loop_cnt;$i++){
			try{
				$playlist_id = $this->post["hoge"][$i];
			}catch(Exception $e){
				//When parameter invalid, return to the list screen
				$this->request->redirect($this->module_name);
			}
			$cnt = $this->model->sel_cnt_prog_by_playlist_id($playlist_id);
			if(empty($cnt[0])){
				$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false, TARGET_NOT_FOUND_ERROR => true));
				$this->request->redirect($this->module_name);
			}
			$cnt = $cnt[0];
			if($cnt->prog_cnt_now > 0 || $cnt->prog_cnt_future > 0 || $cnt->prog_cnt_rgl > 0){
				//When returning to the list screen when setting the program guide
				$this->request->redirect($this->module_name);
			}

			if($this->act === "lump_del"){
				//Delete data
				if($this->chk_token() && $this->lump_del_validation() && $this->lump_del($this->model)){
					//Redirect to list on success
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => true));
					$this->request->redirect($this->module_name);
				} else {
					//Data registration failure display
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false));
				}
			} else {
				//display
				$playlist = $this->model->sel_playlist_name($playlist_id);
				if(!empty($playlist[0])){
					$playlist = $playlist[0];
					$arr_playlist_name[$i] = $playlist->playlist_name;
				} else {
					$playlist = null;
					$arr_playlist_name = null;
				}
			}
			$arr_playlist_id[$i] = $playlist_id;
		}

		//Set value to template
		if(!is_null($arr_playlist_id)){
			$this->template->playlist_id = $arr_playlist_id;
			$this->template->playlist_name = $arr_playlist_name;
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
			->rule('hoge', 'not_empty')
			//->rule('playlist_id', 'digit')
			//->rule('playlist_id', 'playlist_id')
		;
		if($this->validation->check() === false){
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Bulk delete processing
	 */
	private function lump_del($playlist_id){
		$this->model->db->begin();
		$playlist = new Db_Up();
		$del_cnt = count($this->post["hoge"]);
		for($i=0;$i<$del_cnt;$i++){
			$playlist->playlist_id = $this->post["hoge"][$i];
			$ret = $this->model->del_playlist($playlist);
		}
		return $this->model->db->end($ret);
	}

	/**
	 * registration process
	 *
	 * @param {string} $act ins: New registration up: Update
	 */
	private function regist_process($act) {
		//With data registration
		$this->post = $this->session->get('commonplaylist.' . $act . '_post');
		$action = ($act == 'ins') ? ACTION_INS : ACTION_UP;
		if ($this->chk_token() && $this->{$act . '_validation'}() && $this->$act()) {
			//Discard session
			$this->session->delete('commonplaylist.' . $act . '_post');

			//Redirect to list on success
			$this->session->set($this->module_name, array($action => true));
			$this->request->redirect($this->module_name);
		} else {
			//On failure
			$this->session->set($this->module_name, array($action => false));
		}
	}

	/**
	 * Search processing
	 *
	 * @param {string} $act ins: New registration up: Update
	 */
	private function cts_search_process($act) {
		// Search
		$movie_name       = $this->post["movie_name"];
		$movie_tag_1      = $this->post["movie_tag_1"];
		$this->search->movie_name      = $movie_name;
		$this->search->movie_tag_1     = $movie_tag_1;

		$sel_arr_movie = array();
		$arr_tmp_movie_id = $this->post["arr_movie"];

		$i = 0;
		foreach($arr_tmp_movie_id as $tmp_movie_id){
			// Restore duplication prevention ID
			$tmp_movie_id = explode("_", $tmp_movie_id);
			$tmp_movie_id = $tmp_movie_id[0];

			$movie_exists = $this->model->sel_movie($tmp_movie_id);
			if(!empty($movie_exists[0])){
				$movie = new StdClass();
				$movie->movie_id   = $movie_exists[0]->movie_id;
				$movie->movie_name = $movie_exists[0]->movie_name;
				$sel_arr_movie[$movie->movie_id . "_" . $i] = $movie->movie_name;
				$i++;
			}
		}

		$this->template->arr_movie     = $sel_arr_movie;
		$this->template->arr_sel_movie = $sel_arr_movie;
		$this->post["arr_movies"]      = null;
		$this->post["cp_playlist_id"]  = null;
		$this->post = array_merge($this->session->get('commonplaylist.' . $act . '_post'), $this->post);
	}

	/**
	 * Registration confirmation processing
	 *
	 * @param {string} $act ins: New registration up: Update
	 */
	private function conf_process($act) {
		$arr_movies = array();
		$sel_arr_movie = array();
		$arr_tmp_movie_id = $this->post["arr_movie"];
		$i = 0;
		foreach($arr_tmp_movie_id as $tmp_movie_id){
			// 重複防止IDを元に戻す
			$tmp_movie_id = explode("_", $tmp_movie_id);
			$tmp_movie_id = $tmp_movie_id[0];
			$sel_arr_movie[$i] = $tmp_movie_id;
			$i++;
			$movie_exists = $this->model->sel_movie($tmp_movie_id);
			if(!empty($movie_exists[0])){
				$movie = new StdClass();
				$movie->movie_id   = $movie_exists[0]->movie_id;
				$movie->movie_name = $movie_exists[0]->movie_name;
				$arr_movies[$movie->movie_id . "_" . $i] = $movie->movie_name;
			}
		}
		$this->template->arr_movie    = $sel_arr_movie;
		$this->post["arr_movies"]     = $arr_movies;
		$this->post["cp_playlist_id"] = null;
		$this->post["movie_name"]     = null;
		$this->post["movie_tag_1"]    = null;
		$this->post = array_merge($this->session->get('commonplaylist.' .$act . '_post'), $this->post);
		if($this->{$act . '_validation'}()){
			//Store in session
			$this->session->set('commonplaylist.' . $act . '_post', $this->post);
			//Template selection
			$this->template->set_filename('commonplaylist.' . $act . '_conf.template');
			$this->template->arr_effe_rec = $arr_effe_rec;
		}
	}

	/**
	 * Return processing
	 *
	 * @param {string} $act ins: New registration up: Update
	 */
	private function back_process($act) {
		// If there is session data set as initial value
		if ($this->session->get('commonplaylist.' . $act . '_post')) {
			$this->post = $this->session->get('commonplaylist.' . $act . '_post');
		}
	}

	/**
	 * Edit screen initial display processing
	 *
	 * @param {string} $act ins: New registration up: Update
	 */
	private function cts_setting_process($act) {
		$playlist = $this->session->get('commonplaylist.' . $act . '_post');
		foreach (array('sta_dt', 'end_dt', 'playlist_id') as $val) ${$val} = $playlist[$val];

		// Search
		$cp_playlist_id   = $this->post["cp_playlist_id"];
		$draw_area_id     = DRAW_AREA_LAND_MOVIE;

		if ($act != 'ins' && isset($cp_playlist_id) && $cp_playlist_id !== "") {
			$playlist_id = $cp_playlist_id;
		}

		if(
			($act != 'ins' && isset($playlist_id) && $playlist_id !== "") ||
			($act == 'ins' && isset($cp_playlist_id) && $cp_playlist_id !== "")
		){
			$arr_ret = array();
			$tmp_arr_movie = array();
			$sta_dt_set = $sta_dt . " 00:00:00";
			$end_dt_set = $end_dt . " 23:59:59";
			$arr_playlist_movie = $this->model->sel_arr_movie_by_playlist_id_draw_area_id_dt((($act == 'ins') ? $cp_playlist_id : $playlist_id), $draw_area_id, $sta_dt_set, $end_dt_set );
			$i = 0;
			foreach($arr_playlist_movie as $playlist_movie){
				$movie_url = null;
				$movie = new stdClass();
				$movie->movie_url = $movie_url;
				$arr_ret[$playlist_movie->movie_id . "_" . $i] = $playlist_movie->movie_name;
				$i++;
			}
			$this->template->arr_movie     = $arr_ret;
			$this->template->arr_sel_movie = $arr_ret;
		}
		$this->post["arr_movies"] = null;
		$this->post["movie_name"] = null;
		$this->post["movie_tag_1"] = null;
		$this->post = array_merge($this->session->get('commonplaylist.' . $act . '_post'), $this->post);
	}

	/**
	 * List screen drawing area acquisition (movie)
	 *
	 * @param {object} $playlist playlist
	 * @param {object} $draw_area Drawing area
	 */
	private function get_movie($playlist, &$draw_area) {
		$tmp_arr_movie = array();
		$arr_playlist_movie = $this->model->sel_arr_movie_by_playlist_id_draw_area_id($playlist->playlist_id, $draw_area->draw_area_id);
		foreach($arr_playlist_movie as $playlist_movie){
			$movie_url = null;
			if(!empty($playlist_movie->movie_orig_file_exte)){
				if((string)$playlist->ants_version === (string)ANTS_ONE_KIND){
					$movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $playlist_movie->movie_orig_file_name_480p . $playlist_movie->movie_orig_file_exte_480p;
				}else{
					$movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $playlist_movie->file_name . $playlist_movie->movie_orig_file_exte;
				}
			}
			$movie = new stdClass();
			$movie->movie_id      = $playlist_movie->movie_id;
			$movie->movie_name    = $playlist_movie->movie_name;
			$movie->sta_dt        = $playlist_movie->sta_dt;
			$movie->end_dt        = $playlist_movie->end_dt;
			$movie->display_order = $playlist_movie->display_order;
			$movie->movie_url     = $movie_url;
			$tmp_arr_movie[$playlist_movie->display_order] = $movie;
		}
		if(count($playlist->arr_draw_area) === 1){
			$arr_playlist_image = $this->model->sel_arr_image_by_playlist_id_draw_area_id($playlist->playlist_id, $draw_area->draw_area_id);
			foreach($arr_playlist_image as $playlist_image){
				$image_url = null;
				if(!empty($playlist_image->orig_file_exte)){
					$image_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/image/" . $playlist_image->file_name . $playlist_image->orig_file_exte;
				}
				$movie = new stdClass();
				$movie->movie_id   = "image_" . $playlist_image->image_id;
				$movie->movie_name = $playlist_image->image_name;
				$movie->sta_dt     = $playlist_image->sta_dt;
				$movie->end_dt     = $playlist_image->end_dt;
				$movie->movie_url  = $image_url;
				$tmp_arr_movie[$playlist_image->display_order] = $movie;
			}
		}
		ksort($tmp_arr_movie);
		foreach($tmp_arr_movie as $movie){
			array_push($draw_area->arr_cts, $movie);
		}
	}

	/**
	 * List screen drawing area acquisition (sound)
	 *
	 * @param {object} $playlist playlist
	 * @param {object} $draw_area Drawing area
	 */
	private function get_sound($playlist, &$draw_area) {
		$arr_playlist_sound = $this->model->sel_arr_movie_by_playlist_id_draw_area_id($playlist->playlist_id, $draw_area->draw_area_id);
		foreach($arr_playlist_sound as $playlist_sound){
			$sound_url = null;
			if(!empty($playlist_sound->sound_orig_file_exte)){
				$movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $playlist_sound->file_name . $playlist_sound->sound_orig_file_exte;
			}
			$sound = new stdClass();
			$sound->movie_id   = $playlist_sound->movie_id;
			$sound->movie_name = $playlist_sound->movie_name;
			$sound->sta_dt     = $playlist_sound->sta_dt;
			$sound->end_dt     = $playlist_sound->end_dt;
			$sound->movie_url  = $movie_url;
			array_push($draw_area->arr_cts, $sound);
		}
	}

	/**
	 * List screen drawing area acquisition (image)
	 *
	 * @param {object} $playlist playlist
	 * @param {object} $draw_area Drawing area
	 */
	private function get_image($playlist, &$draw_area) {
		$arr_playlist_image = $this->model->sel_arr_image_by_playlist_id_draw_area_id($playlist->playlist_id, $draw_area->draw_area_id);
		foreach($arr_playlist_image as $playlist_image){
			$image_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/image/" . $playlist_image->file_name . $playlist_image->orig_file_exte;
			$image = new stdClass();
			$image->image_id   = $playlist_image->image_id;
			$image->image_name = $playlist_image->image_name;
			$image->sta_dt     = $playlist_image->sta_dt;
			$image->end_dt     = $playlist_image->end_dt;
			$image->image_url  = $image_url;
			array_push($draw_area->arr_cts, $image);
		}
	}

	/**
	 * List screen drawing area acquisition (text)
	 *
	 * @param {object} $playlist playlist
	 * @param {object} $draw_area Drawing area
	 */
	private function get_text($playlist, &$draw_area) {
		$arr_playlist_text = $this->model->sel_arr_text_by_playlist_id_draw_area_id($playlist->playlist_id, $draw_area->draw_area_id);
		foreach($arr_playlist_text as $playlist_text){
			$text = new stdClass();
			$text->text_id   = $playlist_text->text_id;
			$text->text_name = $playlist_text->text_name;
			$text->sta_dt    = $playlist_text->sta_dt;
			$text->end_dt    = $playlist_text->end_dt;
			array_push($draw_area->arr_cts, $text);
		}
	}

	/**
	 * Set value to template of registration / update screen
	 *
	 * @param {array} $data Data entered into session
	 * @param {string} $act ins: New registration up: Update
	 */
	private function set_template_registerpage($data, $act) {
		//Set value to template
		$this->head_add                       = 'head.commonplaylist.' . $act . '.template';
		$this->template->playlist_name        = $data['playlist_name'];
		$this->template->draw_tmpl_name       = $data['draw_tmpl_name'];
		$this->template->arr_draw_area        = $data['arr_draw_area'];
		$this->template->ants_version         = $data['ants_version'];
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->arr_time_zone        = Controller_Template::get_arr_time_zone(false);
		$this->template->arr_all_tag          = Controller_Template::get_arr_movie_tag();
		$this->template->arr_all_playlist     = Controller_Template::get_arr_commonplaylist();
		// Video list
//		if (empty($this->template->arr_all_movie)) {
//			$this->template->arr_all_movie = Controller_Template::get_arr_all_movie(ANTS_TWO_KIND,false,false,true);
//		}

		// プレイリスト
		$this->set_template_common();
		if (!empty($this->post["arr_movies"])) {
			$this->template->arr_sel_movie  = $this->post["arr_movies"];
		}
	}

	/**
	 * (Common) Set value to template
	 */
	private function set_template_common() {
		$this->template->arr_all_client     = Controller_Template::get_arr_client();
		$this->template->arr_delivery_month = Controller_Template::get_arr_delivery_month();
		$this->template->arr_delivery_kind  = Controller_Template::get_arr_delivery_kind();
		$this->template->arr_sex            = Controller_Template::get_arr_sex();
	}


	/**
	 * Duplicate confirmation of period
	 */
	private function check_overlap($post){
		$ret = true;

		// Perform gender and time zone checks
		$search = new stdClass;
		$search->offset             = 0;
		$search->sex_id             = $post["sex_id"];
		$search->playlist_id        = $post["playlist_id"];
		$search->timezone_id        = $post["timezone_id"];
		$search->sta_dt             = $post["sta_dt"] . " 00:00:00";
		$search->end_dt             = $post["end_dt"] . " 23:59:59";
//		$search->deliverymonth_id   = $post["deliverymonth_id"];
		$search->commonplaylist     = true;

		$arr_playlist          = $this->model->sel_arr_common_playlist_overlap($search);
		if(0 < count($arr_playlist)){
			// If there is data with the same client ID, sex, distribution month, time zone, start date to end date, duplicate error
			$this->arr_ret_error["time"] = array("exists");
			$ret = false;
		}

		return $ret;
	}
}
