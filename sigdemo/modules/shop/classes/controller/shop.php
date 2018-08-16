<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Shop extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Shop($this->get_target_client_id());
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
		$all_shop_cnt = $this->model->sel_cnt_shop($this->search);
		
		if (isset($this->search->map)) {
			$mode = 'map';
			$arr_shop = $this->model->sel_arr_shop($this->search);
			$shops = array();
			foreach ($arr_shop as $key => $val) $shops[$key] = (array)$val;
			$arr_shop = $shops;

			$this->template->json = json_encode($arr_shop);
			$this->head_add = "head.shop.map.template";
		} else {
			$mode = 'list';
			//Pagination
			$pagination = Pagination::factory(array(
				'current_page'  => array('source' => 'query_string', 'key' => 'page'),
				'items_per_page' => MAX_CNT_PER_PAGE,
				'total_items'   => $all_shop_cnt[0]->cnt,
			));

			//Data acquisition
			$this->search->offset = $pagination->offset;
			$arr_shop = $this->model->sel_arr_shop($this->search);
			foreach($arr_shop as $shop){
				//tag
				$arr_shop_tag = $this->model->sel_arr_shop_tag_by_shop_id($shop->shop_id);
				$shop->arr_tag = $arr_shop_tag;
				//Signage start and end time format conversion
				$shop->sta_t = $this->toggle_time_format($shop->sta_t);
				$shop->end_t = $this->toggle_time_format($shop->end_t);
			}

			$this->template->pagination = $pagination->render();
			$this->head_add = "head.shop.template";
		}

		//Set value to template
		$this->template->arr_all_shop_tag = Controller_Template::get_arr_shop_tag();
		$this->template->tag_and_or = Controller_Template::get_arr_tag_and_or(false);
		$this->template->all_shop_cnt = $all_shop_cnt[0]->cnt;
		$this->template->arr_shop = $arr_shop;
		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->mode = $mode;
	}
	
	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('shop.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('shop.ins_post');
				
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
				$this->session->set('shop.ins_post', $this->post);
				
				//Template selection
				$this->template->set_filename("shop.ins_conf.template");
			}
		} else if ($this->act === "map") {
			//No data update (initial display)

			//If there is session data set as initial value
			if($this->session->get('shop.ins_post')){
				$this->post = $this->session->get('shop.ins_post');
				$this->session->delete('shop.ins_post');
			}
			$this->head_add = "head.shop.map.ins.template";
		} else if($this->act === "back"){
			
			//If there is session data set as initial value
			if($this->session->get('shop.ins_post')){
				$this->post = $this->session->get('shop.ins_post');
				$this->session->delete('shop.ins_post');
			}
			$this->head_add = "head.shop.map.ins.template";
		} else {
			//No data update (initial display)

			//If there is session data set as initial value
			if($this->session->get('shop.ins_post')){
				$this->post = $this->session->get('shop.ins_post');
				$this->session->delete('shop.ins_post');
			}
		}
		
		//Set value to template
        if (!isset($this->head_add)) $this->head_add = "head.shop.ins.template" ;
		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->arr_all_tag = Controller_Template::get_arr_shop_tag(false);
		$this->template->map_list = Controller_Template::get_arr_time(false);
        $this->template->json = json_encode($this->post);
        
	}
	
	/**
	 * Registration validation
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('shop_name', 'not_empty')
				->rule('shop_name', 'max_length', array(':value', '60'))
				->rule('shop_name', 'shop_name_exists')
				->rule('post', 'not_empty')
				->rule('post', 'digit')
				->rule('post', 'max_length', array(':value', '10'))
				->rule('lat', 'not_empty')
				->rule('lat', 'numeric')
				->rule('lat', 'max_length', array(':value', '20'))
				->rule('lon', 'not_empty')
				->rule('lon', 'numeric')
				->rule('lon', 'max_length', array(':value', '20'))
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
		$shop = new Db_Ins();
		$shop->shop_name = $this->post["shop_name"];
		if(isset($this->post["sta_t-h"]) && isset($this->post["sta_t-m"]) && $this->post["sta_t-h"] !== "" && $this->post["sta_t-m"] !== ""){
			$shop->sta_t = $this->toggle_time_format(sprintf('%02d:%02d', $this->post["sta_t-h"], $this->post["sta_t-m"]));
		} else {
			$shop->sta_t = 0;
		}
		if(isset($this->post["end_t-h"]) && isset($this->post["end_t-m"]) && $this->post["end_t-h"] !== "" && $this->post["end_t-m"] !== ""){
			$shop->end_t = $this->toggle_time_format(sprintf('%02d:%02d', $this->post["end_t-h"], $this->post["end_t-m"]));
		} else {
			$shop->end_t = 0;
		}
		$shop->note = $this->post["note"];
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		
		$this->model->db->begin();
		$shop_id = $this->model->sel_next_shop_id(); // Primary key numbering
		$shop->shop_id = $shop_id;
		$shop->client_id = $this->post["client_id"];
		$shop->address   = $this->post["address"];
		$shop->post      = $this->post["post"];
		$shop->lat       = (float)$this->post["lat"];
		$shop->lon       = (float)$this->post["lon"];
		$ret = $this->model->ins_shop($shop);

		return $this->model->db->end($ret);
	}
	
	
	
	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$shop_id   = $this->post["shop_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		$shop = null;
		$shop->shop_id   = $this->post["shop_id"];
		$arr_sel_tag = $this->model->sel_arr_shop_tag_by_shop_id($shop);
		$shop = $this->model->sel_shop($shop);
		if(empty($shop[0])){
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$shop = $shop[0];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('shop.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('shop.up_post');
				
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
				$this->session->set('shop.up_post', $this->post);
				
				//Template selection
				$this->template->set_filename("shop.up_conf.template");
			}
		} else if ($this->act === "map") {
			//No data update (initial display)
			// $this->post = array();
			$this->post["shop_id"] = $shop->shop_id;
			$this->post["shop_name"] = $shop->shop_name;
			// list($this->post["sta_t-h"], $this->post["sta_t-m"]) = explode(':', $this->toggle_time_format($shop->sta_t));
			// list($this->post["end_t-h"], $this->post["end_t-m"]) = explode(':', $this->toggle_time_format($shop->end_t));
			$this->post["note"] = $shop->note;
			$this->post["arr_tag"] = array();
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->shop_tag_id);
			}
			$this->post["address"] = $shop->address;
			$this->post["post"] = $shop->post;
			$this->post["lat"] = $shop->lat;
			$this->post["lon"] = $shop->lon;
			$this->post["client_id"] = $shop->client_id;
			$this->post["map"] = true;
			
			//If there is session data set as initial value
			if($this->session->get('shop.up_post')){
				$this->post = $this->session->get('shop.up_post');
				$this->session->delete('shop.up_post');
			}
			$this->head_add = "head.shop.map.up.template";
		} else if($this->act === "back"){
			//If there is session data set as initial value
			if($this->session->get('shop.up_post')){
				$this->post = $this->session->get('shop.up_post');
				$this->session->delete('shop.up_post');
			}
			$this->head_add = "head.shop.map.up.template";
		} else {
			//No data update (initial display)
			$this->post = array();
			$this->post["shop_id"] = $shop->shop_id;
			$this->post["shop_name"] = $shop->shop_name;
			list($this->post["sta_t-h"], $this->post["sta_t-m"]) = explode(':', $this->toggle_time_format($shop->sta_t));
			list($this->post["end_t-h"], $this->post["end_t-m"]) = explode(':', $this->toggle_time_format($shop->end_t));
			$this->post["note"] = $shop->note;
			$this->post["arr_tag"] = array();
			foreach($arr_sel_tag as $sel_tag){
				array_push($this->post["arr_tag"], $sel_tag->shop_tag_id);
			}
			$this->post["address"] = $shop->address;
			$this->post["post"] = $shop->post;
			$this->post["lat"] = $shop->lat;
			$this->post["lon"] = $shop->lon;
			
			//If there is session data set as initial value
			if($this->session->get('shop.up_post')){
				$this->post = $this->session->get('shop.up_post');
				$this->session->delete('shop.up_post');
			}
		}
		$this->post["client_name"] = $shop->client_name;
		
		//Set value to template
        if (!isset($this->head_add)) $this->head_add = "head.shop.ins.template" ;
		$this->template->arr_all_client = Controller_Template::get_arr_client();
		$this->template->arr_all_tag = Controller_Template::get_arr_shop_tag(false);
		$this->template->map_list = Controller_Template::get_arr_time(false);
        $this->template->json = json_encode($this->post);
	}
	
	/**
	 * Update validation
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('shop_name', 'not_empty')
				->rule('shop_name', 'max_length', array(':value', '60'))
				->rule('shop_name', 'shop_name_exists_exclude_id', array(':validation', 'shop_name', 'shop_id'))
				->rule('shop_id', 'not_empty')
				->rule('shop_id', 'digit')
				->rule('shop_id', 'shop_id')
				->rule('post', 'not_empty')
				->rule('post', 'digit')
				->rule('post', 'max_length', array(':value', '10'))
				->rule('lat', 'not_empty')
				->rule('lat', 'numeric')
				->rule('lat', 'max_length', array(':value', '20'))
				->rule('lon', 'not_empty')
				->rule('lon', 'numeric')
				->rule('lon', 'max_length', array(':value', '20'))
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
		$shop = new Db_Up();
		$shop->shop_id = $this->post["shop_id"];
		$shop->shop_name = $this->post["shop_name"];
		if(isset($this->post["sta_t-h"]) && isset($this->post["sta_t-m"]) && $this->post["sta_t-h"] !== "" && $this->post["sta_t-m"] !== ""){
			$shop->sta_t = $this->toggle_time_format(sprintf('%02d:%02d', $this->post["sta_t-h"], $this->post["sta_t-m"]));
		} else {
			$shop->sta_t = 0;
		}
		if(isset($this->post["end_t-h"]) && isset($this->post["end_t-m"]) && $this->post["end_t-h"] !== "" && $this->post["end_t-m"] !== ""){
			$shop->end_t = $this->toggle_time_format(sprintf('%02d:%02d', $this->post["end_t-h"], $this->post["end_t-m"]));
		} else {
			$shop->end_t = 0;
		}
		$shop->note = $this->post["note"];
		if(!empty($this->post["arr_tag"])){
			$arr_tag = $this->post["arr_tag"];
		} else {
			$arr_tag = array();
		}
		$shop->client_id = $this->post["client_id"];
		$shop->post = $this->post["post"];
		$shop->lat = (float)$this->post["lat"];
		$shop->lon = (float)$this->post["lon"];
		$shop->address = $this->post["address"];
		
		//DB registration (store)
		$this->model->db->begin();
		$ret = $this->model->up_shop($shop);

		// Related DB update
		// Based on shop_id, if there is Booth information of cooperation destination, update
		
		$search = new stdClass;
		$search->offset             = 0;
		$search->shop               = $shop->shop_id;
		$arr_all_booth = $this->model->sel_arr_booth($search);
		
		foreach($arr_all_booth as $booth){
			
			$up_booth = new Db_Up();
			$up_booth->client_id      = $shop->client_id;
			$up_booth->shop_id        = $shop->shop_id;
			$up_booth->booth_name     = $booth->booth_name;
			$up_booth->floor_id       = $booth->floor_id;
			$up_booth->sex_id         = $booth->sex_id;
			$up_booth->twentyfour_flg = $booth->twentyfour_flg;
			$up_booth->sta_time       = $booth->sta_time;
			$up_booth->end_time       = $booth->end_time;
			$up_booth->wifissid       = $booth->wifissid;
			$up_booth->wifipass       = $booth->wifipass;
			$up_booth->booth_id       = $booth->booth_id;
			
			// Reregistration
			$ret = $this->model->up_booth($up_booth);
		}
		
		
		// Related DB update
		// Update based on shop_id, dev information of cooperation destination
		
		if(!$ret){
			return $ret;
		}
		
		
		$search = new stdClass;
		$search->offset             = 0;
		$search->shop               = $shop->shop_id;
		$arr_all_dev = $this->model->sel_arr_dev($search);
		
		foreach($arr_all_dev as $dev){
			
			$up_dev = new Db_Up();
			$up_dev->client_id      = $shop->client_id;
			$up_dev->shop_id        = $shop->shop_id;
			$up_dev->booth_id       = $dev->booth_id;
			$up_dev->floor_id       = $dev->floor_id;
			$up_dev->sex_id         = $dev->sex_id;
			$up_dev->serial_no      = $dev->serial_no;
			$up_dev->invalid_flag   = $dev->invalid_flag;
			$up_dev->unit_flag      = $dev->unit_flag;
			$up_dev->dev_id         = $dev->dev_id;
			
			// Reregistration
			$ret = $this->model->up_dev($up_dev);
			
			// Program guide update
			$ret = $this->up_prog_dev($up_dev);
		}
		
		return $this->model->db->end($ret);
	}
	
	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$shop_id   = $this->post["shop_id"];
			$client_id = $this->post["client_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		
		$shop = null;
		$shop->shop_id   = $shop_id;
		$shop->client_id = $client_id;
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($shop)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$shop = $this->model->sel_shop_name($shop_id);
			if(!empty($shop[0])){
				$shop = $shop[0];
			} else {
				$shop = null;
			}
		}
		
		//Set value to template
		if(!is_null($shop)){
			$this->template->shop_id   = $shop_id;
			$this->template->client_id = $shop->client_id;
			$this->template->shop_name = $shop->shop_name;
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
			->rule('shop_id', 'not_empty')
			->rule('shop_id', 'digit')
			->rule('shop_id', 'shop_id')
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
	private function del($shop){
		$this->model->db->begin();
		$shops = new Db_Up();
		$shops->shop_id   = $shop->shop_id;
		$shops->client_id = $shop->client_id;
		$ret = $this->model->del_shop($shops);
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

		// Select day of the week
		$search = new stdClass;
		$search->offset             = 0;
		$search->client_id          = $dev->client_id;
		$search->extra_playlist     = true;
		$extra_playlist = $this->model->sel_arr_playlist($search);
		// Acquire individual playlist information to be related based on dev information to be registered and updated
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


