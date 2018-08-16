<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Booth extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Booth($this->get_target_client_id());
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
		$all_booth_cnt = $this->model->sel_cnt_booth($this->search);

		//ページネーション
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $all_booth_cnt[0]->cnt,
		));

		//Data acquisition
		$this->search->offset = $pagination->offset;
		$arr_booth = $this->model->sel_arr_booth($this->search);
		foreach($arr_booth as $booth){
			//タグ
//			$arr_booth_tag = $this->model->sel_arr_booth_tag_by_booth_id($booth->booth_id);
//			$booth->arr_tag = $arr_booth_tag;
			//Signage start and end time format conversion
			$booth->sta_time = $this->toggle_time_format($booth->sta_time);
			$booth->end_time = $this->toggle_time_format($booth->end_time);
		}

		//Set value to template
		$this->head_add = "head.booth.template";
//		$this->template->arr_all_booth_tag = Controller_Template::get_arr_booth_tag();
		$this->template->tag_and_or = Controller_Template::get_arr_tag_and_or(false);
		$this->template->all_booth_cnt = $all_booth_cnt[0]->cnt;
		$this->template->arr_booth = $arr_booth;
		$this->template->pagination = $pagination->render();

		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->arr_all_shop = Controller_Template::get_arr_shop_with_client();
		$this->template->arr_all_floor = Controller_Template::get_arr_floor();
		$this->template->arr_all_sex_id = Controller_Template::get_arr_sex();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('booth.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('booth.ins_post');

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
				$this->session->set('booth.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("booth.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('booth.ins_post')){
				$this->post = $this->session->get('booth.ins_post');
				$this->session->delete('booth.ins_post');
			}
		}

		//Set value to template
		$this->head_add = "head.booth.ins.template";
//		$this->template->arr_all_tag = Controller_Template::get_arr_booth_tag(false);
		$this->template->map_list = Controller_Template::get_arr_time(false);

		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->arr_all_shop = Controller_Template::get_arr_shop_with_client();
		$this->template->arr_all_floor = Controller_Template::get_arr_floor();
		$this->template->arr_all_sex_id = Controller_Template::get_arr_sex();
	}

	/**
	 * Registration validation
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('booth_name', 'not_empty')
				->rule('booth_name', 'max_length', array(':value', '20'))
				->rule('booth_name', 'booth_name_exists')
				->rule('shop', 'not_empty')
				->rule('shop', 'digit')
				->rule('shop', 'shop_id')
				->rule('client_id', 'not_empty')
				->rule('client_id', 'digit')
				->rule('client_id', 'client_id')
				->rule('floor_id', 'not_empty')
				->rule('floor_id', 'digit')
				->rule('floor_id', 'floor_id')
				->rule('sex_id', 'not_empty')
				->rule('sex_id', 'digit')
				->rule('sex_id', 'sex_id')
				->rule('wifissid', 'alpha_dash')
				->rule('wifipass', 'alpha_dash')
			;
			if($this->validation->check() === false){
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
				$ret = false;
			}

			if($ret){
				$ret = $this->start_end_time_validation();
			}
		}
		return $ret;
	}

	/**
	 * registration process
	 */
	private function ins(){
		$booth = new Db_Ins();
		$booth->booth_name = $this->post["booth_name"];
//		if(isset($this->post["sta_t-h"]) && isset($this->post["sta_t-m"]) && isset($this->post["sta_t-s"]) && $this->post["sta_t-h"] !== "" && $this->post["sta_t-m"] !== "" && $this->post["sta_t-s"] !== ""){
//			$booth->sta_time = $this->toggle_time_format(sprintf('%02d:%02d:%02d', $this->post["sta_t-h"], $this->post["sta_t-m"], $this->post["sta_t-s"])); // 秒まで入力するUIだった場合に対応
		if(isset($this->post["sta_t-h"]) && isset($this->post["sta_t-m"]) && $this->post["sta_t-h"] !== "" && $this->post["sta_t-m"] !== "" ){
			$booth->sta_time = sprintf('%02d:%02d:%02d', $this->post["sta_t-h"], $this->post["sta_t-m"], 0);
		} else {
			$booth->sta_time = '00:00:00';
		}

//		if(isset($this->post["end_t-h"]) && isset($this->post["end_t-m"]) && isset($this->post["sta_t-s"]) && $this->post["end_t-h"] !== "" && $this->post["end_t-m"] !== "" && $this->post["end_t-s"] !== "" ){
//			$booth->end_time = $this->toggle_time_format(sprintf('%02d:%02d:%02d', $this->post["end_t-h"], $this->post["end_t-m"], $this->post["end_t-s"])); // 秒まで入力するUIだった場合に対応
		if(isset($this->post["end_t-h"]) && isset($this->post["end_t-m"]) && $this->post["end_t-h"] !== "" && $this->post["end_t-m"] !== "" ){
			$booth->end_time = sprintf('%02d:%02d:%02d', $this->post["end_t-h"], $this->post["end_t-m"], 0);
		} else {
			$booth->end_time = '00:00:00';
		}
//		$booth->note = $this->post["note"];

		$booth->client_id = $this->post["client_id"];
		$booth->shop_id = $this->post["shop"];
		$booth->floor_id = $this->post["floor_id"];
		$booth->sex_id = $this->post["sex_id"];
		if(isset($this->post["twentyfour_flg"]) && $this->post["twentyfour_flg"] === "1"){
			$booth->twentyfour_flg = $this->post["twentyfour_flg"];
		} else {
			$booth->twentyfour_flg = 0;
		}
		$booth->wifissid = $this->post["wifissid"];
		$booth->wifipass = $this->post["wifipass"];

		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}

		//Get id
		$this->model->db->begin();
		$booth_id = $this->model->sel_next_booth_id();
		$booth->booth_id = $booth_id;
		$ret = $this->model->ins_booth($booth);

		//DB registration (tag)
		if($ret && !empty($arr_tag)){
			foreach($arr_tag as $tag){
				$booth_tag_rela = new Db_Ins();
				$booth_tag_rela->booth_id = $booth->booth_id;
				$booth_tag_rela->booth_tag_id = $tag;
				$ret = $this->model->ins_booth_tag_rela($booth_tag_rela);
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
			$booth_id = $this->post["booth_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

//		$arr_sel_tag = $this->model->sel_arr_booth_tag_by_booth_id($booth_id);
		$booth = $this->model->sel_booth($booth_id);
		if(empty($booth[0])){
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$booth = $booth[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('booth.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('booth.up_post');

				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
				if(empty($this->post["arr_tag"])){
					$this->post["arr_tag"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('booth.up_post', $this->post);

				//Template selection
				$this->template->set_filename("booth.up_conf.template");
			}
		} else {
			//No data update (initial display)
			$this->post = array();
			$this->post["booth_id"] = $booth->booth_id;
			$this->post["booth_name"] = $booth->booth_name;
			list($this->post["sta_t-h"], $this->post["sta_t-m"], $this->post["sta_t-s"]) = explode(':', $booth->sta_time);
			list($this->post["end_t-h"], $this->post["end_t-m"], $this->post["end_t-s"]) = explode(':', $booth->end_time);
//			$this->post["note"] = $booth->note;
			$this->post["arr_tag"] = array();
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->booth_tag_id);
			}

			$this->post["shop"] = $booth->shop_id;
			$this->post["client_id"] = $booth->client_id;
			$this->post["floor_id"] = $booth->floor_id;
			$this->post["sex_id"] = $booth->sex_id;
			$this->post["twentyfour_flg"] = $booth->twentyfour_flg;
			$this->post["wifissid"] = $booth->wifissid;
			$this->post["wifipass"] = $booth->wifipass;

			//If there is session data set as initial value
			if($this->session->get('booth.up_post')){
				$this->post = $this->session->get('booth.up_post');
				$this->session->delete('booth.up_post');
			}
		}
		$this->post["client_name"] = $booth->client_name;

		//Set value to template
		$this->head_add = "head.booth.ins.template";
//		$this->template->arr_all_tag = Controller_Template::get_arr_booth_tag(false);
		$this->template->map_list = Controller_Template::get_arr_time(false);

		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->arr_all_shop = Controller_Template::get_arr_shop_with_client();
		$this->template->arr_all_floor = Controller_Template::get_arr_floor();
		$this->template->arr_all_sex_id = Controller_Template::get_arr_sex();
	}

	/**
	 * Update validation
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('booth_id', 'not_empty')
				->rule('booth_id', 'digit')
				->rule('booth_id', 'booth_id')
				->rule('booth_name', 'not_empty')
				->rule('booth_name', 'max_length', array(':value', '20'))
				->rule('booth_name', 'booth_name_exists_exclude_id', array(':validation', 'booth_name', 'booth_id'))
				->rule('shop', 'not_empty')
				->rule('shop', 'digit')
				->rule('shop', 'shop_id')
				->rule('client_id', 'not_empty')
				->rule('client_id', 'digit')
				->rule('client_id', 'client_id')
				->rule('floor_id', 'not_empty')
				->rule('floor_id', 'digit')
				->rule('floor_id', 'floor_id')
				->rule('sex_id', 'not_empty')
				->rule('sex_id', 'digit')
				->rule('sex_id', 'sex_id')
				->rule('wifissid', 'alpha_dash')
				->rule('wifipass', 'alpha_dash')
			;
			if($this->validation->check() === false){
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
				$ret = false;
			}
			if($ret){
				$ret = $this->start_end_time_validation();
			}
		}
		return $ret;
	}

	/**
	 * Update processing
	 */
	private function up(){
		$booth = new Db_Up();
		$booth->booth_id = $this->post["booth_id"]; // Get value from booth.template
		$booth->booth_name = $this->post["booth_name"];
//		if(isset($this->post["sta_t-h"]) && isset($this->post["sta_t-m"]) && isset($this->post["sta_t-s"]) && $this->post["sta_t-h"] !== "" && $this->post["sta_t-m"] !== "" && $this->post["sta_t-s"] !== ""){
//			$booth->sta_time = $this->toggle_time_format(sprintf('%02d:%02d:%02d', $this->post["sta_t-h"], $this->post["sta_t-m"], $this->post["sta_t-s"]));
		if(isset($this->post["sta_t-h"]) && isset($this->post["sta_t-m"]) && $this->post["sta_t-h"] !== "" && $this->post["sta_t-m"] !== "" ){
			$booth->sta_time = sprintf('%02d:%02d:%02d', $this->post["sta_t-h"], $this->post["sta_t-m"], 0);
		} else {
			$booth->sta_time = '00:00:00';
		}

//		if(isset($this->post["end_t-h"]) && isset($this->post["end_t-m"]) && isset($this->post["sta_t-s"]) && $this->post["end_t-h"] !== "" && $this->post["end_t-m"] !== "" && $this->post["end_t-s"] !== "" ){
//			$booth->end_time = $this->toggle_time_format(sprintf('%02d:%02d:%02d', $this->post["end_t-h"], $this->post["end_t-m"], $this->post["end_t-s"]));
		if(isset($this->post["end_t-h"]) && isset($this->post["end_t-m"]) && $this->post["end_t-h"] !== "" && $this->post["end_t-m"] !== "" ){
			$booth->end_time = sprintf('%02d:%02d:%02d', $this->post["end_t-h"], $this->post["end_t-m"], 0);
		} else {
			$booth->end_time = '00:00:00';
		}
//		$booth->note = $this->post["note"];

		$booth->client_id = $this->post["client_id"];
		$booth->shop_id = $this->post["shop"];
		$booth->floor_id = $this->post["floor_id"];
		$booth->sex_id = $this->post["sex_id"];
		if(isset($this->post["twentyfour_flg"]) && $this->post["twentyfour_flg"] === "1"){
			$booth->twentyfour_flg = $this->post["twentyfour_flg"];
		} else {
			$booth->twentyfour_flg = 0;
		}
		$booth->wifissid = $this->post["wifissid"];
		$booth->wifipass = $this->post["wifipass"];

		$booth->note = $this->post["note"];
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		//DB registration (store)
		$this->model->db->begin();
		$ret = $this->model->up_booth($booth);
		if($ret){

			// Related DB update
			// Based on booth_id update terminal information of cooperation destination
			$search = new stdClass;
			$search->offset             = 0;
			$search->booth_id           = $booth->booth_id;
			$arr_all_dev = $this->model->sel_arr_dev($search);

			foreach($arr_all_dev as $dev){
				// client_id -> shop_id -> floor_id -> both_id -> sex_id
				// Although they are compatible data, checking is done at the time of input, so do not check at registration.
				$up_dev = new Db_Up();
				$up_dev->booth_id       = $booth->booth_id;
				$up_dev->client_id      = $booth->client_id;
				$up_dev->shop_id        = $booth->shop_id;
				$up_dev->floor_id       = $booth->floor_id;
				$up_dev->sex_id         = $booth->sex_id;

				$up_dev->serial_no      = $dev->serial_no;
				$up_dev->invalid_flag   = $dev->invalid_flag;
				$up_dev->unit_flag      = $dev->unit_flag;
				$up_dev->dev_id         = $dev->dev_id;

				// Reregistration
				$ret = $this->model->up_dev($up_dev);

				// Program guide update
				$ret = $this->up_prog_dev($up_dev);
			}

			//DB registration (tag)
	//		$arr_old_tag = $this->model->sel_arr_booth_tag_by_booth_id($booth->booth_id);
	//		if($ret){
	//			foreach($arr_old_tag as $old_tag){
	//				$exists = false;
	//				foreach($arr_tag as $tag){
	//					if($old_tag->booth_tag_id == $tag){
	//						$exists = true;
	//						break;
	//					}
	//				}
	//				if(!$exists){
	//					//Delete if it does not exist
	//					$booth_tag_rela = new Db_Up();
	//					$booth_tag_rela->booth_id = $booth->booth_id;
	//					$booth_tag_rela->booth_tag_id = $old_tag->booth_tag_id;
	//					$this->model->del_booth_tag_rela($booth_tag_rela);
	//				}
	//			}
	//
	//			foreach($arr_tag as $tag){
	//				$exists = false;
	//				foreach($arr_old_tag as $old_tag){
	//					if($old_tag->booth_tag_id == $tag){
	//						$exists = true;
	//						break;
	//					}
	//				}
	//				if(!$exists){
	//					//If it does not exist, register
	//					$booth_tag_rela = new Db_Ins();
	//					$booth_tag_rela->booth_id = $booth->booth_id;
	//					$booth_tag_rela->booth_tag_id = $tag;
	//					$this->model->ins_booth_tag_rela($booth_tag_rela);
	//				}
	//			}
	//		}

		}
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$booth_id = $this->post["booth_id"];
			$client_id = $this->post["client_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		$booth = null;
		$booth->booth_id  = $booth_id;
		$booth->client_id = $client_id;
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($booth)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$booth = $this->model->sel_booth_name($booth_id);
			if(!empty($booth[0])){
				$booth = $booth[0];
			} else {
				$booth = null;
			}
		}

		//Set value to template
		if(!is_null($booth)){
			$this->template->booth_id = $booth_id;
			$this->template->booth_name = $booth->booth_name;
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
			->rule('booth_id', 'not_empty')
			->rule('booth_id', 'digit')
			->rule('booth_id', 'booth_id')
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
	private function del($booth){
		$this->model->db->begin();
		$booths = new Db_Up();
		$booths->booth_id  = $booth->booth_id;
		$booths->client_id = $booth->client_id;

		$ret = $this->model->del_booth($booths);
		return $this->model->db->end($ret);
	}

	/**
	 * Validation of signage start and end time
	 */
	private function start_end_time_validation(){
		$ret = true;
		//Since it is restricted so that it becomes numerical value only within the range with UI, only the validation is carried out below. Error text display is not implemented yet.
		if($this->post['sta_t-h'] < 0 || $this->post['sta_t-h'] > 23 || $this->post['sta_t-m'] < 0 || $this->post['sta_t-m'] > 59){
			$this->arr_ret_error['sta_t'] = 'time';
			$ret = false;
		}
		if($this->post['end_t-h'] < 0 || $this->post['end_t-h'] > 23 || $this->post['end_t-m'] < 0 || $this->post['end_t-m'] > 59){
			$this->arr_ret_error['sta_t'] = 'time';
			$ret = false;
		}
		return $ret;
	}



	/**
	 * registration process
	 */
	private function up_prog_dev($dev){
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
		// As playlists with the same client ID and different periods exist, re-implement cooperation of all playlists that were able to be acquired
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
