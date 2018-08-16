<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dev extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Dev($this->get_target_client_id());
		$this->modelDevprog = new Model_Devprog($this->get_target_client_id());
		$this->modelProperty = new Model_Property($this->get_target_client_id());

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
			case ACTION_EXCEL:
				$this->excel_dl();
				break;
			case ACTION_EXCEL_PLAY_COUNT:
				$this->excel_dl_play_count();
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

		if(SERVICE_ANTS_ONE_ENABLE === false){
			$this->search->ants_version=ANTS_TWO_KIND;
		}
		$all_dev_cnt = $this->model->sel_cnt_dev($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_dev_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_dev = $this->model->sel_arr_dev($this->search);

		foreach($arr_dev as $dev){
			//Terminal tag
			$arr_dev_tag = $this->model->sel_arr_dev_tag_by_dev_id($dev);
			$dev->arr_dev_tag = $arr_dev_tag;

			//attribute
			$arr_dev_property = $this->model->sel_arr_dev_property_by_dev_id($dev);
			$dev->arr_dev_property = $arr_dev_property;

			//Store tag
			$arr_shop_tag = $this->model->sel_arr_shop_tag_by_shop_id($dev->shop_id);
			$dev->arr_shop_tag = $arr_shop_tag;

			//Program guide download log
			$arr_dev_prog_dl_log = $this->model->sel_arr_dev_prog_dl_log_by_dev_id($dev->dev_id);
			if(!empty($arr_dev_prog_dl_log[0])){
				$dev->dev_prog_dl_log = $arr_dev_prog_dl_log[0];
			} else {
				$dev->dev_prog_dl_log = new stdClass();
				$dev->dev_prog_dl_log->sta_dt = "";
				$dev->dev_prog_dl_log->end_dt = "";
			}

			//HTML download log
			$arr_dev_html_rela_dl_log = $this->model->sel_arr_dev_html_rela_dl_log_by_dev_id($dev->dev_id);
			if(!empty($arr_dev_html_rela_dl_log[0])){
				$dev->dev_html_rela_dl_log = $arr_dev_html_rela_dl_log[0];
			} else {
				$dev->dev_html_rela_dl_log = new stdClass();
				$dev->dev_html_rela_dl_log->sta_dt = "";
				$dev->dev_html_rela_dl_log->end_dt = "";
			}

			//Playing list name being played back
			$tmp_prog = null;
			$playlist = null;
			$prog_rgl = $this->model->sel_arr_prog_rgl($dev->dev_id);
			if(!empty($prog_rgl[0])){
				$tmp_prog = $prog_rgl[0];
				$tmp_prog->sta_dt = str_replace("/", "-", substr(Request::$request_dt, 0, 10)) . " " . $tmp_prog->sta_time;
			}
			$prog = $this->model->sel_prog($dev->dev_id);
			if(!empty($prog[0])){
				$prog = $prog[0];
				$tmp_prog = $prog;
			}
			if(isset($tmp_prog)){
				$playlist = $this->model->sel_playlist_by_prog_id($tmp_prog->prog_id);
			}
			if(isset($playlist) && !empty($playlist[0])){
				$playlist = $playlist[0];
				$dev->playlist_id = $playlist->playlist_id;
				$dev->playlist_name = $playlist->playlist_name;
			} else {
				$dev->playlist_id = "";
				$dev->playlist_name = "";
			}

			//Distribution HTML name
			$dev_html_rela = $this->model->sel_dev_html_rela($dev->dev_id);
			if(!empty($dev_html_rela[0])){
				$dev_html_rela = $dev_html_rela[0];
				$dev->html_id = $dev_html_rela->html_id;
				$dev->html_name = $dev_html_rela->html_name;
			} else {
				$dev->html_id = "";
				$dev->html_name = "";
			}

			//Presence / absence of log
			$client_id_zero_pad = str_pad(strval($dev->client_id), ACCESS_LOG_HTML_FILE_PAD_LEN, "0", STR_PAD_LEFT);
			$dev_id_zero_pad = str_pad(strval($dev->dev_id), ACCESS_LOG_HTML_FILE_PAD_LEN, "0", STR_PAD_LEFT);
			$file_name = "awstats." . $dev_id_zero_pad;
			$file_exte = ".html";
			$file = ACCESS_LOG_HTML_DIR . $client_id_zero_pad . "/" . $dev_id_zero_pad . "/" . $file_name . $file_exte;
			$dev->log_exists = is_file($file);
		}

		//Program guide check of each terminal
		$checkStr = array();
		if(ENABLE_CHECK_PROGRAM){
			$client_id = $this->get_target_client_id();
			$devList = null;
			$ants_version = "";
			if(SERVICE_ANTS_ONE_ENABLE === false){
				$ants_version=ANTS_TWO_KIND;
			}
			$devList = $this->model->getLsDev($client_id, $ants_version);
			foreach($devList as $dev){
				$res = $this->checkProgList($dev);
				if(count($res)>1) $checkStr[] = $res;
			}
		}

		//Set value to template
		$this->head_add = "head.dev.template";
		$this->template->arr_all_dev_tag      = Controller_Template::get_arr_dev_tag();
		$this->template->arr_all_shop_tag     = Controller_Template::get_arr_shop_tag();
		$this->template->arr_all_shop         = Controller_Template::get_arr_shop_with_client();
		$this->template->tag_and_or           = Controller_Template::get_arr_tag_and_or(false);
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->arr_all_invalid_flag = Controller_Template::get_arr_invalid();
		$this->template->arr_all_unit_flag    = Controller_Template::get_arr_unit();
		$this->template->arr_all_sex_id       = Controller_Template::get_arr_sex();
		$this->template->arr_all_mail_flag    = Controller_Template::get_arr_mail();
		$this->template->arr_all_dl_status    = Controller_Template::get_arr_dlstatus();
		$this->template->all_dev_cnt          = $all_dev_cnt[0]->cnt;
		$this->template->arr_dev              = $arr_dev;
		$this->template->checkStr             = $checkStr;
		$this->template->pagination           = $pagination->render();
		$this->template->arr_all_client       = Controller_Template::get_arr_client();
		$this->template->arr_all_booth        = Controller_Template::get_arr_booth_with_sex_shop_floor();
		$this->template->arr_all_floor        = Controller_Template::get_arr_floor();

		//Set value to template Number of times of playback Date and time specified for select box
		$this->template->arr_month = array();
		for($i=1;$i<13;$i++){
			$this->template->arr_month[$i] = $i;
		}
		$this->template->arr_year = array();
		$thisYear = date('Y');
		for($i=$thisYear;$i>2011;$i--){
			$this->template->arr_year[$i] = $i;
		}

	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('dev.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('dev.ins_post');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
				if(empty($this->post["arr_tag"])){
					$this->post["arr_tag"] = array();
				}
				if(empty($this->post["arr_property"])){
					$this->post["arr_property"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Store in session
				$this->session->set('dev.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("dev.ins_conf.template");
			}
		} else{
			//If there is session data set as initial value
			if($this->session->get('dev.ins_post')){
				$this->post = $this->session->get('dev.ins_post');
				$this->session->delete('dev.ins_post');
			}
		}

		//Set value to template
		$this->head_add = "head.dev.ins.template";
		$this->template->arr_all_tag          = Controller_Template::get_arr_dev_tag(false);
		$this->template->arr_all_property     = Controller_Template::get_arr_property(false);
		$this->template->arr_all_shop         = Controller_Template::get_arr_shop_with_client();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->arr_all_invalid_flag = Controller_Template::get_arr_invalid();
		$this->template->arr_all_unit_flag    = Controller_Template::get_arr_unit();
		$this->template->arr_all_sex_id       = Controller_Template::get_arr_sex();
		$this->template->arr_all_mail_flag    = Controller_Template::get_arr_mail();
		$this->template->arr_all_service      = Controller_Template::get_arr_service();
		$this->template->arr_all_client       = Controller_Template::get_arr_client();
		$this->template->arr_all_booth        = Controller_Template::get_arr_booth_with_sex_shop_floor();
		$this->template->arr_all_floor        = Controller_Template::get_arr_floor();
	}

	/**
	 * Registration validation
	 */
	private function ins_validation(){
		$ret = $this->chk_post();

		if($ret){
			$ret = $this->check_status($this->post);
		}

		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('serial_no', 'not_empty')
				->rule('serial_no', 'alpha_numeric')
				->rule('serial_no', 'max_length', array(':value', '20'))
				->rule('serial_no', 'serial_no_exists')
				->rule('shop', 'not_empty')
				->rule('shop', 'digit')
				->rule('shop', 'shop_id')
				->rule('invalid_flag', 'not_empty')
				->rule('invalid_flag', 'digit')
				->rule('invalid_flag', 'invalid_flag')
				->rule('unit_flag', 'not_empty')
				->rule('unit_flag', 'digit')
				->rule('unit_flag', 'unit_flag')
				->rule('client_id', 'not_empty')
				->rule('client_id', 'digit')
				->rule('client_id', 'client_id')
				->rule('floor_id', 'not_empty')
				->rule('floor_id', 'digit')
				->rule('floor_id', 'floor_id')
				->rule('booth_id', 'not_empty')
				->rule('booth_id', 'digit')
				->rule('booth_id', 'booth_id')
				->rule('sex_id', 'not_empty')
				->rule('sex_id', 'digit')
				->rule('sex_id', 'sex_id')
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
		$dev = new Db_Ins();
		$dev->serial_no    = $this->post["serial_no"];
		$dev->shop_id      = $this->post["shop"];
		$dev->client_id    = $this->post["client_id"];
		$dev->floor_id     = $this->post["floor_id"];
		$dev->booth_id     = $this->post["booth_id"];
//		$dev->dev_name     = $this->post["dev_name"];
//		$dev->ants_version = $this->post["ants_version"];
		$dev->ants_version = ANTS_TWO_KIND;	// Since the input UI has disappeared, 2 fixed
		$dev->invalid_flag = $this->post["invalid_flag"];
		$dev->unit_flag    = $this->post["unit_flag"];
		$dev->sex_id       = $this->post["sex_id"];
//		$dev->mail_flag    = $this->post["mail_flag"];
		$dev->mail_flag    = 0;	// Fixed to 0 because the input UI disappeared
//		$dev->service_id   = $this->post["service"];
		$dev->service_id   = SERVICE_SIGNAGE;	// Since the input UI has disappeared, 2 fixed
//		$dev->note = $this->post["note"];
		$dev->note = ' ';
		$dev->dev_cat = DEV_CAT_ID_STB;	//TODO Fixed to 0 for current STB only
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		if(!empty($this->post["arr_property"])){
			$arr_property = $this->post["arr_property"];
		} else {
			$arr_property = array();
		}

		//Get id
		$this->model->db->begin();
		$dev_id = $this->model->sel_next_dev_id();
		$dev->dev_id = $dev_id;
		$dev->dev_name = DEV_NAME_DEFAULT.$dev_id;	// Since the input UI disappeared, 'device' + ID

		//DB registration (terminal)
		$ret = $this->model->ins_dev($dev);

		//DB registration (tag)
		if($ret && !empty($arr_tag)){
			foreach($arr_tag as $tag){
				$dev_tag_rela = new Db_Ins();
				$dev_tag_rela->dev_id     = $dev->dev_id;
				$dev_tag_rela->client_id  = $dev->client_id;
				$dev_tag_rela->dev_tag_id = $tag;
				$dev_tag_rela->client_id  = $dev->client_id;
				$ret = $this->model->ins_dev_tag_rela($dev_tag_rela);
				if($ret === false){
					break;
				}
			}
		}

		//DB registration (tag)
		if($ret && !empty($arr_property)){
			foreach($arr_property as $property){
				$dev_property_rela = new Db_Ins();
				$dev_property_rela->client_id   = $dev->client_id;
				$dev_property_rela->dev_id      = $dev->dev_id;
				$dev_property_rela->property_id = $property;
				$ret = $this->model->ins_dev_property_rela($dev_property_rela);
				if($ret === false){
					break;
				}
			}
		}

		// Program guide update
		if($ret){
			$ret = $this->ins_prog($dev);
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$dev_id = $this->post["dev_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		$dev = $this->model->sel_dev($dev_id);
		$arr_sel_tag = $this->model->sel_arr_dev_tag_by_dev_id($dev);
		$arr_sel_property = $this->model->sel_arr_dev_property_by_dev_id($dev);
		if(empty($dev[0])){
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$dev = $dev[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('dev.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('dev.up_post');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
				if(empty($this->post["arr_tag"])){
					$this->post["arr_tag"] = array();
				}
				$this->session->set($this->module_name, array(ACTION_UP => false));
				if(empty($this->post["arr_property"])){
					$this->post["arr_property"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('dev.up_post', $this->post);

				//Template selection
				$this->template->set_filename("dev.up_conf.template");
			}
		} else {
			//No data update (initial display)
			$this->post = array();
			$this->post["dev_id"] = $dev_id;
			$this->post["shop"] = $dev->shop_id;
			$this->post["client_id"] = $dev->client_id;
			$this->post["floor_id"] = $dev->floor_id;
			$this->post["booth_id"] = $dev->booth_id;
			$this->post["dev_name"] = $dev->dev_name;
			$this->post["serial_no"] = $dev->serial_no;
			$this->post["invalid_flag"] = $dev->invalid_flag;
			$this->post["unit_flag"] = $dev->unit_flag;
			$this->post["sex_id"] = $dev->sex_id;
			$this->post["mail_flag"] = $dev->mail_flag;
			$this->post["service"] = $dev->service_id;
			$this->post["note"] = $dev->note;
			$this->post["arr_tag"] = array();
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->dev_tag_id);
			}
			$this->post["arr_property"] = array();
			foreach($arr_sel_property as $sel_property){
				array_push($this->post["arr_property"], $sel_property->property_id);
			}
			//If there is session data set as initial value
			if($this->session->get('dev.up_post')){
				$this->post = $this->session->get('dev.up_post');
				$this->session->delete('dev.up_post');
			}
		}
		$this->post["ants_version"] = $dev->ants_version;

		//Set value to template
		$this->head_add = "head.dev.ins.template";
		$this->template->arr_all_tag          = Controller_Template::get_arr_dev_tag(false);
		$this->template->arr_all_property     = Controller_Template::get_arr_property(false);
		$this->template->arr_all_shop         = Controller_Template::get_arr_shop_with_client();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->arr_all_invalid_flag = Controller_Template::get_arr_invalid();
		$this->template->arr_all_unit_flag    = Controller_Template::get_arr_unit();
		$this->template->arr_all_sex_id       = Controller_Template::get_arr_sex();
		$this->template->arr_all_mail_flag    = Controller_Template::get_arr_mail();
		$this->template->arr_all_service      = Controller_Template::get_arr_service();
		$this->template->arr_all_client       = Controller_Template::get_arr_client();
		$this->template->arr_all_booth        = Controller_Template::get_arr_booth_with_sex_shop_floor();
		$this->template->arr_all_floor        = Controller_Template::get_arr_floor();
	}

	/**
	 * Update validation
	 */
	private function up_validation(){
		$ret = $this->chk_post();

		if($ret){
			$ret = $this->check_status($this->post);
		}

		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('serial_no', 'not_empty')
				->rule('serial_no', 'alpha_numeric')
				->rule('serial_no', 'max_length', array(':value', '20'))
				->rule('shop', 'not_empty')
				->rule('shop', 'digit')
				->rule('shop', 'shop_id')
				->rule('invalid_flag', 'not_empty')
				->rule('invalid_flag', 'digit')
				->rule('invalid_flag', 'invalid_flag')
				->rule('unit_flag', 'not_empty')
				->rule('unit_flag', 'digit')
				->rule('unit_flag', 'unit_flag')
				->rule('client_id', 'not_empty')
				->rule('client_id', 'digit')
				->rule('client_id', 'client_id')
				->rule('floor_id', 'not_empty')
				->rule('floor_id', 'digit')
				->rule('floor_id', 'floor_id')
				->rule('booth_id', 'not_empty')
				->rule('booth_id', 'digit')
				->rule('booth_id', 'booth_id')
				->rule('sex_id', 'not_empty')
				->rule('sex_id', 'digit')
				->rule('sex_id', 'sex_id')
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
		$dev = new Db_Up();
		$dev->dev_id       = $this->post["dev_id"];
		$dev->shop_id      = $this->post["shop"];
		$dev->serial_no    = $this->post["serial_no"];
		$dev->client_id    = $this->post["client_id"];
		$dev->floor_id     = $this->post["floor_id"];
		$dev->booth_id     = $this->post["booth_id"];
		$dev->sex_id       = $this->post["sex_id"];
		$dev->invalid_flag = $this->post["invalid_flag"];
		$dev->unit_flag    = $this->post["unit_flag"];

		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		if(!empty($this->post["arr_property"])){
			$arr_property = $this->post["arr_property"];
		} else {
			$arr_property = array();
		}

		//DB registration (terminal)
		$this->model->db->begin();
		$ret = $this->model->up_dev($dev);

		//DB registration (tag)
		$arr_old_tag = $this->model->sel_arr_dev_tag_by_dev_id($dev->dev_id);
		if($ret){
			foreach($arr_old_tag as $old_tag){
				$exists = false;
				foreach($arr_tag as $tag){
					if($old_tag->dev_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$dev_tag_rela = new Db_Up();
					$dev_tag_rela->dev_id     = $dev->dev_id;
					$dev_tag_rela->client_id  = $dev->client_id;
					$dev_tag_rela->dev_tag_id = $old_tag->dev_tag_id;
					$this->model->del_dev_tag_rela($dev_tag_rela);
				}
			}

			foreach($arr_tag as $tag){
				$exists = false;
				foreach($arr_old_tag as $old_tag){
					if($old_tag->dev_tag_id == $tag){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//If it does not exist, register
					$dev_tag_rela = new Db_Ins();
					$dev_tag_rela->dev_id     = $dev->dev_id;
					$dev_tag_rela->client_id  = $dev->client_id;
					$dev_tag_rela->dev_tag_id = $tag;
					$this->model->ins_dev_tag_rela($dev_tag_rela);
				}
			}
		}

		//DB registration (attribute)
		$arr_old_property = $this->model->sel_arr_dev_property_by_dev_id($dev->dev_id);
		if($ret){
			foreach($arr_old_property as $old_property){
				$exists = false;
				foreach($arr_property as $property){
					if($old_property->property_id == $property){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//Delete if it does not exist
					$dev_property_rela = new Db_Up();
					$dev_property_rela->dev_id      = $dev->dev_id;
					$dev_property_rela->client_id   = $dev->client_id;
					$dev_property_rela->property_id = $old_property->property_id;
					$this->model->del_dev_property_rela($dev_property_rela);
				}
			}

			foreach($arr_property as $property){
				$exists = false;
				foreach($arr_old_property as $old_property){
					if($old_property->property_id == $property){
						$exists = true;
						break;
					}
				}
				if(!$exists){
					//If it does not exist, register
					$dev_property_rela = new Db_Ins();
					$dev_property_rela->dev_id      = $dev->dev_id;
					$dev_property_rela->client_id   = $dev->client_id;
					$dev_property_rela->property_id = $property;
					$this->model->ins_dev_property_rela($dev_property_rela);
				}
			}
		}
		// Program guide update
		if($ret){
			$ret = $this->ins_prog($dev);
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$dev_id    = $this->post["dev_id"];
			$client_id = $this->post["client_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$dev = null;
		$dev->dev_id    = $dev_id;
		$dev->client_id = $client_id;
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($dev)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$dev = $this->model->sel_dev($dev_id);
			if(!empty($dev[0])){
				$dev = $dev[0];
			} else {
				$dev = null;
			}
		}

		//Set value to template
		if(!is_null($dev)){
			$this->template->dev_id    = $dev->dev_id;
			$this->template->client_id = $dev->client_id;
			$this->template->dev_name  = $dev->dev_name;
			$this->template->serial_no = $dev->serial_no;
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
			->rule('dev_id', 'not_empty')
			->rule('dev_id', 'digit')
			->rule('dev_id', 'dev_id')
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
	private function del($dev){
		$this->model->db->begin();
		$devs = new Db_Up();
		$devs->dev_id = $dev->dev_id;
		$ret = $this->model->del_dev($devs);
		return $this->model->db->end($ret);
	}

	/**
	 * Excel download
	 */
	private function excel_dl(){
		//Excel export
		$reader = PHPExcel_IOFactory::createReader('Excel2007');
		$cell_style = array(
				'borders' => array(
						'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
						'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
				)
		);

		//Excel file name setting
		$now = date("Ymd");
		$excel_name = "dev_log_" . $now . ".xlsx";

		$excel = $reader->load(EXCEL_DEV_LOG_FILE);
		$excel->setActiveSheetIndex(0);
		$sheet = $excel->getActiveSheet();

		//Retrieve number of signage terminals
		$ants_version = "";
		if(SERVICE_ANTS_ONE_ENABLE === false){
			$ants_version=ANTS_TWO_KIND;
		}
		$all_signage_dev_cnt = $this->model->sel_cnt_service_dev(SERVICE_SIGNAGE, $ants_version);
		if(!empty($all_signage_dev_cnt[0]->cnt)){
			$arr_signage_dev = $this->model->sel_arr_service_dev(SERVICE_SIGNAGE, $ants_version);
			$idx = 3;
			$col = 1;
			foreach($arr_signage_dev as $signage_dev){
				//SW version
				$client_id_zero_pad = str_pad(strval($signage_dev->client_id), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT);
				$dev_id_zero_pad = str_pad(strval($signage_dev->dev_id), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT);
				$version_file_path = DEV_LOG_DIR . $client_id_zero_pad . "/" . $dev_id_zero_pad . "/" . VERSION_FILE_NAME;
				if(is_file($version_file_path)){
					if($fp = fopen($version_file_path,"r")){
						$tmp_str = fgets($fp);
						$signage_dev->sw_version = str_replace(array("\r\n","\r","\n"), '', $tmp_str);
					} else {
						$signage_dev->sw_version = "-";
					}
				} else {
					$signage_dev->sw_version = "-";
				}

				//Program guide download log
				$arr_dev_prog_dl_log = $this->model->sel_arr_dev_prog_dl_log_by_dev_id($signage_dev->dev_id);
				if(!empty($arr_dev_prog_dl_log[0])){
					$signage_dev->dev_prog_dl_log = $arr_dev_prog_dl_log[0];
				} else {
					$signage_dev->dev_prog_dl_log = new stdClass();
					$signage_dev->dev_prog_dl_log->sta_dt = "";
					$signage_dev->dev_prog_dl_log->end_dt = "";
				}

				//Device name
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $signage_dev->dev_name);
				//Installation store name
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $signage_dev->shop_name);
				//dev_id
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $signage_dev->dev_id);
				//Serial number
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $signage_dev->serial_no);
				//SW version
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $signage_dev->sw_version);
				//Program guide DL (start)
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $signage_dev->dev_prog_dl_log->sta_dt);
				//Program table DL (end)
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $signage_dev->dev_prog_dl_log->end_dt);

				$idx++;
				$col = 1;
			}
		}

		$excel->setActiveSheetIndex(1);
		$sheet = $excel->getActiveSheet();

		//Acquisition of number of smartphone delivery terminals
		$all_smartphone_dev_cnt = $this->model->sel_cnt_service_dev(SERVICE_SMARTPHONE);
		if(!empty($all_smartphone_dev_cnt[0]->cnt)){
			$arr_smartphone_dev = $this->model->sel_arr_service_dev(SERVICE_SMARTPHONE);
			$idx = 3;
			$col = 1;
			foreach($arr_smartphone_dev as $smartphone_dev){
				//SW version
				$client_id_zero_pad = str_pad(strval($smartphone_dev->client_id), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT);
				$dev_id_zero_pad = str_pad(strval($smartphone_dev->dev_id), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT);
				$version_file_path = DEV_LOG_DIR . $client_id_zero_pad . "/" . $dev_id_zero_pad . "/" . VERSION_FILE_NAME;
				if(is_file($version_file_path)){
					if($fp = fopen($version_file_path,"r")){
						$tmp_str = fgets($fp);
						$smartphone_dev->sw_version = str_replace(array("\r\n","\r","\n"), '', $tmp_str);
					} else {
						$smartphone_dev->sw_version = "-";
					}
				} else {
					$smartphone_dev->sw_version = "-";
				}

				//HTML download log
				$arr_dev_html_rela_dl_log = $this->model->sel_arr_dev_html_rela_dl_log_by_dev_id($smartphone_dev->dev_id);
				if(!empty($arr_dev_html_rela_dl_log[0])){
					$smartphone_dev->dev_html_rela_dl_log = $arr_dev_html_rela_dl_log[0];
				} else {
					$smartphone_dev->dev_html_rela_dl_log = new stdClass();
					$smartphone_dev->dev_html_rela_dl_log->sta_dt = "-";
					$smartphone_dev->dev_html_rela_dl_log->end_dt = "-";
				}

				//Device name
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $smartphone_dev->dev_name);
				//Installation store name
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $smartphone_dev->shop_name);
				//dev_id
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $smartphone_dev->dev_id);
				//Serial number
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $smartphone_dev->serial_no);
				//SW version
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $smartphone_dev->sw_version);
				//HTML DL (Start)
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $smartphone_dev->dev_html_rela_dl_log->sta_dt);
				//HTML DL (Exit)
				$sheet->getStyleByColumnAndRow($col, $idx)->applyFromArray($cell_style);
				$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $smartphone_dev->dev_html_rela_dl_log->end_dt);

				$idx++;
				$col = 1;
			}
		}

		$file = tempnam(EXCEL_TMP_PATH, "DL_");
		$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$writer->save($file);
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment;filename=$excel_name");
		File::echo_file($file);
	}

	/**
	 * View count Excel download
	 */
	private function excel_dl_play_count(){
		//Excel export
		$reader = PHPExcel_IOFactory::createReader('Excel2007');

		$m_playcnt = new Model_Playcnt($this->get_target_client_id());

		//Year / month designated validation
		if( !isset($_POST['year']) || !preg_match('/[0-9]{4}/',$_POST['year']) ){
			return ;
		}
		if( !isset($_POST['month']) || !preg_match('/[0-9]{1,2}/',$_POST['month']) ){
			return ;
		}

		//Get a device
		$dummyObj = new stdClass();
		$dummyObj->offset = 0;
		if(SERVICE_ANTS_ONE_ENABLE === false){
			$dummyObj->ants_version=ANTS_TWO_KIND;
		}
		$arr_dev = $this->model->sel_arr_dev( $dummyObj );
		$arr_all_dev_playcnt = array();
		foreach($arr_dev as $dev){
			$dev_id = $dev->dev_id;

			//Output target for the month of the specified month
			$sta_year = $_POST['year'];
			$sta_month = $_POST['month'];
			$sta_day = 1;
			$playcnt_sta_dt = date("Y/m/d", mktime(0, 0, 0, $sta_month, $sta_day, $sta_year));
			//Since the end date is not included at the time of searching, specify the day of the next month
			if($sta_month > 11){
				$end_year = $sta_year + 1;
				$end_month = 1;
			}else{
				$end_year = $sta_year;
				$end_month = $sta_month + 1;
			}
			$end_day = 1;
			$playcnt_end_dt = date("Y/m/d", mktime(0, 0, 0, $end_month, $end_day, $end_year));

			//Data acquisition
			$arr_dev_playcnt = array();
			$arr_tmp_dev_playcnt = $m_playcnt->sel_dev_playcnt_by_dev_id_playcnt_dt_by_day($dev_id, $playcnt_sta_dt, $playcnt_end_dt, 0);

			foreach($arr_tmp_dev_playcnt as $rownum => $tmp_dev_playcnt){
				//Acquire name from file name
				$file_info = pathinfo($tmp_dev_playcnt->play_file_name);
				if(empty($file_info['extension'])){
					continue;
				}
				if($file_info['extension'] === "png"){
					$arr_image_name = $m_playcnt->sel_image_name_by_file_name($file_info['filename']);
					if(!isset($arr_image_name[0]->image_name)){
						continue;
					}
					$cts_name = $arr_image_name[0]->image_name;
				} else {
					if(strpos($file_info['filename'],"_480p") === false){
						//When "_480 p" is not included
						$fileName = $file_info['filename'];
					} else {
						//When "_480 p" is included
						$fileName = str_replace("_480p" , "", $file_info['filename']);
					}
					$arr_movie_name = $m_playcnt->sel_movie_name_by_file_name($fileName);
					if(!isset($arr_movie_name[0]->movie_name)){
						continue;
					}
					$cts_name = $arr_movie_name[0]->movie_name;
				}
				$arr_dev_playcnt[$rownum] = array();
				$arr_dev_playcnt[$rownum]["cts_name"] = $cts_name;
				$arr_dev_playcnt[$rownum]["extension"] = $file_info['extension'];
				$arr_dev_playcnt[$rownum]["cnt"] = $tmp_dev_playcnt;
			}
			$dev->arr_play_cnt = $arr_dev_playcnt;
			$arr_all_dev_playcnt[] = $dev;
		}
		//Excel file name setting
		$now = $sta_year . str_pad($sta_month, 2, "0", STR_PAD_LEFT);
		$excel_name = "dev_log_play_cnt_" . $now . ".xlsx";

		$excel = $reader->load(EXCEL_DEV_PLAY_COUNT_FILE);
		$excel->setActiveSheetIndex(0);
		$sheet = $excel->getActiveSheet();

		//Header row output
		$sheet->setCellValueExplicitByColumnAndRow(4, 1, $sta_year . '年' . $sta_month . '月');
		$last_day = date("t", mktime(0, 0, 0, $sta_month, 1, $sta_year));
		for($i=1;$i<=$last_day;$i++){
			$sheet->setCellValueExplicitByColumnAndRow(3+$i, 2, $i);
			$datetime = new DateTime($sta_year . "/" . $sta_month . "/" . $i);
			$w = (int)$datetime->format('w');
			if($w==0){ //Red background color on Sunday
				$sheet->getStyleByColumnAndRow(3+$i, 2)->getFill()->getStartColor()->setARGB('FFFF7F50');
			}else if($w==6){ //Blue background color on Saturday
				$sheet->getStyleByColumnAndRow(3+$i, 2)->getFill()->getStartColor()->setARGB('FF87CEFF');
			}
		}

		//Data output
		$idx = 3;
		$col = 0;
		$cell_style = array(
				'borders' => array(
						'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
				)
		);
		foreach($arr_all_dev_playcnt as $dev){
			//端末最初の行は線を引く
			for($i=0;$i<36;$i++){
				$sheet->getStyleByColumnAndRow($i, $idx)->applyFromArray($cell_style);
			}
			$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $dev->shop_name);
			$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $dev->dev_name);
			$tmp_cts_name = null;
			foreach($dev->arr_play_cnt as $arr_dev_playcnt){
				if($tmp_cts_name != $arr_dev_playcnt['cts_name']){
					if($tmp_cts_name != null){
						$idx++;
					}
					//Set calculation formula of subtotal
					$sheet->setCellValueByColumnAndRow(35, $idx, '=sum(E' . $idx . ':AI' . $idx . ')');
					$tmp_cts_name = $arr_dev_playcnt['cts_name'];
					$col = 2;
					$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $arr_dev_playcnt['cts_name']);
					$sheet->setCellValueExplicitByColumnAndRow($col++, $idx, $arr_dev_playcnt['extension']);
					$sheet->getStyleByColumnAndRow($col, $idx)->getBorders()->
						getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
				}
				$cntObj = $arr_dev_playcnt['cnt'];
				$col = (int)substr($cntObj->day,-2) + 3; //Move to date column
				$sheet->setCellValueByColumnAndRow($col++, $idx, $cntObj->sum);
			}
			$idx++;
			$col = 0;

		}

		$file = tempnam(EXCEL_TMP_PATH, "DL_");
		$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$writer->save($file);
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header("Content-Disposition: attachment;filename=$excel_name");
		File::echo_file($file);
	}

	/**
	 * A function that checks the continuity of the program guide for each terminal
	 *
	 */
	private function checkProgList($dev){
		$serialNo = $dev->serial_no;
		$now = date("Y/m/d H:i:s");	// Current date and time

		//Obtain terminal ID from STB serial
		$devInfo = $this->model->getDev($serialNo);
		$devId = $devInfo[0]->dev_id;

		//Program guide (repeated designation)
		$keys = array("year", "month", "day", "hour", "minute", "second");
		$date_1 = array_combine($keys, preg_split("/[\/: ]/", $now));
		$arrProgRgl = array();
		for($i = 0; $i <= STB_DAILY_CHECK_IN_DAYS; $i++){
			if($i === 0){
				$tmp_now = $now;
			} else {
				$tmp_now = date("Y/m/d H:i:s", mktime(0, 0, 0, $date_1["month"], $date_1["day"] + $i, $date_1["year"]));
			}
			$tmp_date = array_combine($keys, preg_split("/[\/: ]/", $tmp_now));

			$rows = $this->model->getArrActiveProgRgl($tmp_now, $devId)->as_array();
			if(isset($rows)){
				foreach($rows as &$row){
					$progId = $row->prog_id;
					$staTime = $row->sta_time;
					$tmpStaDt = explode(":", $staTime);
					$staHour = $tmpStaDt[0];
					$staMin = $tmpStaDt[1];
					$staSecond = $tmpStaDt[2];
					$endTime = $row->end_time;
					$tmpEndDt = explode(":", $endTime);
					$endHour = $tmpEndDt[0];
					$endMin = $tmpEndDt[1];
					$endSecond = $tmpEndDt[2];

					$staDt = date("Y-m-d H:i:s", mktime($staHour, $staMin, $staSecond, $tmp_date["month"], $tmp_date["day"], $tmp_date["year"]));
					if(($i) === STB_DAILY_CHECK_IN_DAYS){
						//Retrieve only the data up to the set time on the last day of delivery target
						$endDt = date("Y-m-d H:i:s", mktime(STB_DAILY_CHECK_END_TIME_HOUR, STB_DAILY_CHECK_END_TIME_MIN, 0, $tmp_date["month"], $tmp_date["day"], $tmp_date["year"]));
					} else {
						$endDt = date("Y-m-d H:i:s", mktime($endHour, $endMin, $endSecond, $tmp_date["month"], $tmp_date["day"], $tmp_date["year"]));
					}

					array_push($arrProgRgl, array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $endDt));
				}
			}
		}

		//Acquire the program guide to be distributed from the terminal ID
		$arrProg = array();
		$rows = null;
		$rows = $this->model->getArrActiveProg($now, $devId)->as_array();
		$rowsNew = array();
		if(isset($rows)){
			foreach($rows as &$row){
				$rowNew = array();
				$rowNew["prog_id"] = $row->prog_id;
				if(is_null($row->sta_dt) || strtotime($row->sta_dt) < strtotime($now)){
					$rowNew["sta_dt"] = date("Y-m-d H:i:s", mktime(0, 0, 0, $date_1["month"], $date_1["day"], $date_1["year"]));
				}else{
					$rowNew["sta_dt"] = $row->sta_dt;
				}

				//Consider settings that cross date
				$tmpEndDt = date("Y-m-d H:i:s", mktime(STB_DAILY_CHECK_END_TIME_HOUR, STB_DAILY_CHECK_END_TIME_MIN, 0, $date_1["month"], $date_1["day"] + STB_DAILY_CHECK_IN_DAYS, $date_1["year"]));
				if(strtotime($row->end_dt) > strtotime($tmpEndDt)){
					$rowNew["end_dt"] = $tmpEndDt;
				}else{
					$rowNew["end_dt"] = $row->end_dt;
				}
				$rowsNew[] = $rowNew;
			}
			foreach($rowsNew as $rowNew){
				$this->calc($rowNew, $arrProg);
			}
		}

		//Merging the program guide (repeated designation) and the program guide
		foreach($arrProgRgl as $progRgl){
			$this->calc($progRgl, $arrProg);
		}

		if(!empty($arrProg)){
			$arrTmpProg = array(array(),array(),array());
			foreach($arrProg as $prog){
				array_push($arrTmpProg[0], $prog["prog_id"]);
				array_push($arrTmpProg[1], $prog["sta_dt"]);
				array_push($arrTmpProg[2], $prog["end_dt"]);
			}
			array_multisort($arrTmpProg[1], SORT_ASC, SORT_STRING, $arrTmpProg[2], SORT_ASC, SORT_STRING, $arrTmpProg[0], SORT_DESC, SORT_NUMERIC);
			$arrProg = array();
			for($i = 0; $i < count($arrTmpProg[0]); $i++ ){
				array_push($arrProg, array("prog_id" => $arrTmpProg[0][$i], "sta_dt" => $arrTmpProg[1][$i], "end_dt" => $arrTmpProg[2][$i]));
			}


		} else {
			//Program guide absence
		}

		//番組表ID
		$arrProgId = array();
		foreach($arrProg as $prog){
			array_push($arrProgId, $prog["prog_id"]);
		}

		//Set comparison time
		$cursor = new DateTime(substr($now,0,10) . ' ' . CHECK_STA_TIME);
		//echo $cursor->format('Y-m-d H:i:s');

		//output
		$resultStr = array();
		$resultStr['dev_name'] = $serialNo . ' ' . $dev->dev_name . ' ';
		if(sizeof($arrProg) < 1){
			$resultStr['date'] = $cursor->format('Y-m-d');
			$resultStr['reason'] = '<span style="color:#D74300;">番組表がありません</span><br>';
			return $resultStr;
		}

		$checkEndDt = new DateTime();
		$checkEndDt = new DateTime($checkEndDt->format('Y-m-d') . ' ' . CHECK_END_TIME);
		$checkEndDt = $checkEndDt->add(new DateInterval('P'.STB_DAILY_CHECK_IN_DAYS.'D'));

		foreach($arrProg as $key => $prog){
			$t = new DateTime($prog['sta_dt']);

			//Make sure that a valid playlist is specified
			$arr_playlist = $this->modelDevprog->sel_arr_playlist_by_prog_id($prog["prog_id"]);
			if(!isset($arr_playlist) || sizeof($arr_playlist)<1){
				$resultStr['date'] = $cursor->format('Y-m-d');
				$resultStr['reason'] = '<span style="color:#D74300;">有効なプレイリストが指定されていません</span><br>';
				return $resultStr;
			}

			//Confirm that the program guide is contiguous
			if($t <= $cursor){
				$cursor = new DateTime($prog['end_dt']);
				$cursor->add(new DateInterval('PT1M')); //Consider it as "continuous" within 1 minute
				$end_cursor = new DateTime($cursor->format('Y-m-d') . ' ' . CHECK_END_TIME);
				//If the check end time has passed, the next day checking time is set
				if($end_cursor < $cursor){
					$cursor->add(new DateInterval('P1D'));
					$cursor = new DateTime($cursor->format('Y-m-d') . ' ' . CHECK_STA_TIME);
				}
			}else{
				$resultStr['date'] = $cursor->format('Y-m-d');
				$resultStr['reason'] = '<span style="color:#D74300;">番組が連続していません</span><br>';
				return $resultStr;
			}
		}
		if($cursor <= $checkEndDt){
				$resultStr['date'] = $cursor->format('Y-m-d');
				$resultStr['reason'] = '<span style="color:#D74300;">番組が連続していません</span><br>';
				return $resultStr;
		}


//		$resultSt['reason'] = 'Programs are contiguous<br>';
//		return $resultStr;
		return ''; //When it is continuous, nothing is displayed
	} // end of checkProgList()


	private function calc($row, &$arrTmpProg){
		$progId = $row["prog_id"];
		$staDt = $row["sta_dt"];
		$endDt = $row["end_dt"];
		if(empty($arrTmpProg)){
			array_push($arrTmpProg, array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $endDt));
		} else {
			$push = true;
			foreach($arrTmpProg as $prog){
				if($prog["sta_dt"] <= $staDt && $prog["end_dt"] >= $endDt){
					//Completely included
					$push = false;
					continue;
				} else if($prog["sta_dt"] > $endDt || $prog["end_dt"] < $staDt){
					//It is not included at all
					continue;
				} else if($prog["sta_dt"] > $staDt && $prog["end_dt"] < $endDt){
					//Complete inclusion (necessity of division)
					$this->calc(array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $prog["sta_dt"]), $arrTmpProg);
					$this->calc(array("prog_id" => $progId, "sta_dt" => $prog["end_dt"], "end_dt" => $endDt), $arrTmpProg);
					return;
				} else {
					//Including part
					if($prog["sta_dt"] < $endDt && $prog["end_dt"] >= $endDt){
						$endDt = $prog["sta_dt"];
					}
					if($prog["end_dt"] > $staDt && $prog["sta_dt"] <= $staDt){
						$staDt = $prog["end_dt"];
					}
				}
			}
			if($push){
				array_push($arrTmpProg, array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $endDt));
			}
		}
	}

	/**
	 * Confirm whether the registration information exists
	 */
	private function check_status($dev_post){
		$ret = true;
		// Confirm whether there is a combination of facility, booth, installation floor, and gender regarding input information.
		$search = new stdClass;
		$search->offset = 0;
		$search->client_id = $dev_post["client_id"];
		$search->shop      = $dev_post["shop"];
		$search->floor_id  = $dev_post["floor_id"];
		$search->booth_id  = $dev_post["booth_id"];
		$search->sex_id    = $dev_post["sex_id"];

		$valid_cnt = $this->model->sel_cnt_booth($search);
		if( $valid_cnt[0]->cnt === 0){
			$this->arr_ret_error["booth"] = array("matches");
			$ret = false;
		}
		return $ret;
	}


	/**
	 * registration process
	 */
	private function ins_prog($dev){
		$ret = true;

		//Delete existing record
		$arr_prog_rgl_grp = $this->model->sel_arr_prog_rgl_grp_by_dev_id($dev);
		foreach($arr_prog_rgl_grp as $tmp_prog_rgl_grp){
			$orijin_client_id = $tmp_prog_rgl_grp->client_id;

			$prog_rgl_grp = new Db_Up();
			$prog_rgl_grp->prog_rgl_grp_id = $tmp_prog_rgl_grp->prog_rgl_grp_id;
			$prog_rgl_grp->client_id       = $tmp_prog_rgl_grp->client_id;
			$ret = $this->model->del_prog_rgl_grp($prog_rgl_grp);
			if($ret === false){
				break;
			}
		}
		if($ret === false){
			return $ret;
		}

		//Get id
		$prog_rgl_grp_id = $this->model->sel_next_prog_rgl_grp_id();
		if(is_null($prog_rgl_grp_id)){
			$ret = false;
			return $ret;
		}
		$prog_rgl_grp = new Db_Ins();
		$prog_rgl_grp->prog_rgl_grp_id = $prog_rgl_grp_id;
		$prog_rgl_grp->dev_id    = $dev->dev_id;
		$prog_rgl_grp->client_id = $dev->client_id;
		$prog_rgl_grp->prog_name = $this->post["prog_name"];

		//DB registration (program guide (repeated designation) group)
		if($ret){
			$ret = $this->model->ins_prog_rgl_grp($prog_rgl_grp);
			if($ret === false){
				return $ret;
			}
		}

		$days = array('mon', 'tues', 'wednes', 'thurs', 'fri', 'satur', 'sun');
		//Select day of the week
		foreach ($days as $day) ${$day . '_idx'} = 0; // $this->post[$day];

		// Acquire individual playlist information to be related based on dev information to be registered and updated
		$search = new stdClass;
		$search->offset             = 0;
		$search->client_id          = $dev->client_id;
		$search->extra_playlist     = true;
		$extra_playlist = $this->model->sel_arr_playlist($search);
		//As playlists with the same client ID and different periods exist, re-implement cooperation of all playlists that were able to be acquired
		foreach ($extra_playlist as $playlist){
			$playlist_id = $playlist->playlist_id;

			for($i = 0; $i < 1; $i++){
				//base
				$prog_id = $this->model->sel_next_prog_id();

				$prog_rgl = new Db_Ins();
				$prog_rgl->prog_id         = $prog_id;
				$prog_rgl->prog_rgl_grp_id = $prog_rgl_grp_id;
				$prog_rgl->client_id       = $dev->client_id;
				$prog_rgl->sta_time        = PROGRGL_BASE_STA_TIME;
				$prog_rgl->end_time        = PROGRGL_BASE_END_TIME;
				$prog_rgl->year            = 0;
				$prog_rgl->month           = 0;
				$prog_rgl->day             = 0;

				$ins = false;
				foreach ($days as $day) {
					if (${$day . '_idx'} == $i) $ins = true;
					$prog_rgl->{$day} = (${$day . '_idx'} == $i) ? 1 : 0;
				}

				$prog_rgl->priority = 0;
				$prog_rgl->col_id   = $i;
				$prog_rgl->row_id   = 0;
				//DB registration (program table)
				if($ins){
					if($ret){
						$ret = $this->model->ins_prog($prog_rgl);
						if($ret === false){
							break;
						}
					}
				}

				//Individual
				for($j = TIME_ZONE_MORNING; $j <= TIME_ZONE_EVENING; $j++){

					$search = new stdClass;
					$search->timezone_id = $j;
					$timezone_time = $this->model->get_timezone_time($search);
					$timezone_time = $timezone_time[0];

					$prog_id = $this->model->sel_next_prog_id();
					$prog_rgl = new Db_Ins();
					$prog_rgl->prog_id         = $prog_id;
					$prog_rgl->prog_rgl_grp_id = $prog_rgl_grp_id;
					$prog_rgl->client_id       = $playlist->client_id;
					$prog_rgl->sex_id          = $dev->sex_id;
					$prog_rgl->sta_time        = $timezone_time->sta_time;
					$prog_rgl->end_time        = $timezone_time->end_time;
					$prog_rgl->year            = 0;
					$prog_rgl->month           = 0;
					$prog_rgl->day             = 0;

					$ins = false;
					foreach ($days as $day) {
						if (${$day . '_idx'} == $i) $ins = true;
						$prog_rgl->{$day} = (${$day . '_idx'} == $i) ? 1 : 0;
					}

					$prog_rgl->priority = 1;
					$prog_rgl->col_id = $i;
					$prog_rgl->row_id = $j - TIME_ZONE_MORNING;

					if($ins){
						//DB registration (program table)
						if($ret){
							$ret = $this->model->ins_prog($prog_rgl);
							if($ret === false) break;
						}

						//DB registration (program list play list related)
						if($ret && $playlist_id !== ""){
							$prog_playlist_rela = new Db_Ins();
							$prog_playlist_rela->prog_id     = $prog_id;
							$prog_playlist_rela->playlist_id = $playlist_id;
							$prog_playlist_rela->ch          = 1;
							$prog_playlist_rela->client_id   = $dev->client_id;
							$ret = $this->model->ins_prog_playlist_rela($prog_playlist_rela);
							if($ret === false) break;
						}
					}
				}

				//Reset DL status
				if($ret){
					$dev_dlLog = new Db_Up();
					$dev_dlLog->dev_id    = $dev->dev_id;
					$dev_dlLog->client_id = $orijin_client_id;
					$ret = $this->model->sel_dlLog_up($dev_dlLog);
					if($ret === false) break;
				}
				if($ret === false) break;
			}
			if($ret === false) break;
		}

		return $ret;
	}

}
