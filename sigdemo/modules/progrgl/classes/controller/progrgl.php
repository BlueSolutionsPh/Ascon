<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Progrgl extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Progrgl($this->get_target_client_id());
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
			default:
				//List
				$this->request->redirect(MODULE_NAME_DEVPROG);
				break;
		}
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('progrgl.ins_post');
			if($this->chk_token(MODULE_NAME_DEVPROG) && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('progrgl.ins_post');

				//Redirect to list on success
				$this->session->set(MODULE_NAME_DEVPROG, array(ACTION_INS => true));
				$this->request->redirect(MODULE_NAME_DEVPROG);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Store in session
				$this->session->set('progrgl.ins_post', $this->post);

				//Sort order correspondence
				if(isset($this->post['sta_time'])){
					foreach($this->post['sta_time'] as $key => $val){
						$sta_time_arr = $end_time_arr = $playlist_arr = array();
						$this->padding_time($this->post['sta_time'][$key]);
						$this->padding_time($this->post['end_time'][$key]);
						asort($this->post['sta_time'][$key]);
						foreach($this->post['sta_time'][$key] as $key2 => $val2){
							if($val2 === '') continue;
							$sta_time_arr[] = $this->post['sta_time'][$key][$key2];
							$end_time_arr[] = $this->post['end_time'][$key][$key2];
							$playlist_arr[] = $this->post['playlist'][$key][$key2];
						}
						$this->post['playlist'][$key] = $playlist_arr;
						$this->post['end_time'][$key] = $end_time_arr;
						$this->post['sta_time'][$key] = array_merge($sta_time_arr);	//Reschedule sidekey
					}
				}

				//Supplement missing elements
				$this->add_time();

				//Template selection
				$this->template->set_filename("progrgl.ins_conf.template");
			}
		} else {
			//No data registration (initial display)
			if(isset($this->post['dev_id'])){
				$dev_id = $this->post['dev_id'];
				if(isset($this->post['ants_version'])){
					//If dev_id is set, set the ant's type of the terminal
					$ants_version = $this->post['ants_version'];
				} else {
					$ants_version = ANTS_TWO_KIND;
				}
			} else {
				//If dev_id is not set, ant's type sets ant's2
				$ants_version = ANTS_TWO_KIND;
			}

			$this->post = array();
			$this->post["prog_name"] = "";
			$this->post["arr_dev"] = array();
			$this->post["base"] = array();
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				$this->post["base"][$i] = "";
			}
			$this->post["sta_time"] = array();
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				$this->post["sta_time"][$i] = array();
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					$this->post["sta_time"][$i][$j] = "";
				}
			}
			$this->post["end_time"] = array();
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				$this->post["end_time"][$i] = array();
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					$this->post["end_time"][$i][$j] = "";
				}
			}
			$this->post["playlist"] = array();
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				$this->post["playlist"][$i] = array();
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					$this->post["playlist"][$i][$j] = "";
				}
			}

			//Default terminal selection
			if(isset($dev_id)){
				$this->post["arr_dev"] = array($dev_id);
			}
			//Set ant's type
			$this->post["ants_version"] = $ants_version;

			//If there is session data set as initial value
			if($this->session->get('progrgl.ins_post') ) {
				$this->post = $this->session->get('progrgl.ins_post');
				$this->session->delete('progrgl.ins_post');
			}
		}

		$arr_ret_dev = array();
		$arr_sel_dev = array();
		$arr_dev = $this->model->sel_arr_dev_shop($ants_version);
		if(!empty($arr_dev)){
			foreach($arr_dev as $dev){
				$arr_ret_dev[$dev->dev_id] = $dev->dev_name . " (" . $dev->shop_name . ")";
				if(isset($this->post["arr_dev"])){
					$this->post["arr_dev"] = array_unique($this->post["arr_dev"]);
					foreach($this->post["arr_dev"] as $sel_dev_id){
						if($dev->dev_id == $sel_dev_id){
							$arr_sel_dev[$dev->dev_id] = $dev->dev_name . " (" . $dev->shop_name . ")";
						}
					}
				}
			}
		}

		//Acquire playlist information
		if(SERVICE_ANTS_ONE_ENABLE === false){
			$arr_playlist_name = Controller_Template::get_arr_playlist(ANTS_TWO_KIND,true);
		} else {
			$arr_playlist_info = Controller_Template::get_arr_playlist_ants_version();

			//Set playlist name
			$arr_playlist_ants_version = array();
			$arr_playlist_ants_version[""] = "";
			if(!empty($arr_playlist_info)){
				foreach($arr_playlist_info as $all){
					$arr_playlist_ants_version[$all->playlist_id] = $all->ants_version;
				}
			}
			$this->post["playlist_ants_version"] = $arr_playlist_ants_version;

			//Set playlist name
			$arr_playlist_name = array();
			$arr_playlist_name[""] = "";
			if(!empty($arr_playlist_info)){
				foreach($arr_playlist_info as $all){
					$arr_playlist_name[$all->playlist_id] = $all->playlist_name;
				}
			}
		}

		//Set value to template
		$this->head_add = "head.progrgl.up.template";
		$this->template->arr_prog_rgl = array();
		$this->template->arr_all_tag = Controller_Template::get_arr_dev_tag();
		$this->template->arr_all_playlist = $arr_playlist_name;
		$this->template->arr_all_dev = $arr_ret_dev;
		$this->template->arr_sel_dev = $arr_sel_dev;
		$this->finalize_time();
		$this->template->time = Controller_Template::get_arr_time();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version(false);
	}

	/**
	 * Registration validation processing
	 */
	private function ins_validation(){
		$ret = $this->chk_post(MODULE_NAME_DEVPROG);
		if($ret){
			//Time check
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				//Basic check
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					$sta_time_ok = false;
					$sta_time_no_set = false;
					$end_time_ok = false;
					$end_time_no_set = false;
					$playlist_ok = false;
					$playlist_no_set = false;

					//Start time setting
					if((isset($this->post["sta_time_h"][$i][$j]) && $this->post["sta_time_h"][$i][$j] !== "") || (isset($this->post["sta_time_m"][$i][$j]) && $this->post["sta_time_m"][$i][$j] !== "")){
						$this->post["sta_time"][$i][$j] = $this->post["sta_time_h"][$i][$j] . ":" . $this->post["sta_time_m"][$i][$j];
						if(Valid::time($this->post["sta_time"][$i][$j])){
							$sta_time_ok = true;
						}
					} else {
						$sta_time_no_set = true;
					}

					//End time setting
					if((isset($this->post["end_time_h"][$i][$j]) && $this->post["end_time_h"][$i][$j] !== "") || (isset($this->post["end_time_m"][$i][$j]) && $this->post["end_time_m"][$i][$j] !== "")){
						$this->post["end_time"][$i][$j] = $this->post["end_time_h"][$i][$j] . ":" . $this->post["end_time_m"][$i][$j];
						if(Valid::time($this->post["end_time"][$i][$j])){
							$end_time_ok = true;
						}
					} else {
						$end_time_no_set = true;
					}

					//playlist
					if(isset($this->post["playlist"][$i][$j]) && $this->post["playlist"][$i][$j] !== ""){
						$playlist_ok = true;
					} else {
						$playlist_no_set = true;
					}

					//Error checking
					if(!($sta_time_no_set && $end_time_no_set && $playlist_no_set) && ($sta_time_no_set || $end_time_no_set || $playlist_no_set)){
						//Item invalid
						if($sta_time_no_set){
							$this->arr_ret_error["sta_time"] = array("not_empty");
							$ret = false;
							break;
						} else if($end_time_no_set){
							$this->arr_ret_error["end_time"] = array("not_empty");
							$ret = false;
							break;
						} else {
							$this->arr_ret_error["playlist"] = array("not_empty");
							$ret = false;
							break;
						}
					} else if($sta_time_ok === false && $sta_time_no_set === false){
						//Start time format
						$this->arr_ret_error["sta_time"] = array("time");
						$ret = false;
						break;
					} else if($end_time_ok === false && $end_time_no_set === false){
						//End time format
						$this->arr_ret_error["end_time"] = array("time");
						$ret = false;
						break;
					} else if($sta_time_ok && $end_time_ok && strtotime($this->post["sta_time"][$i][$j]) > strtotime($this->post["end_time"][$i][$j])){
						//Around time
						$this->arr_ret_error["time"] = array("reverse");
						$ret = false;
						break;
					} else if($sta_time_ok && $end_time_ok && strtotime($this->post["sta_time"][$i][$j]) === strtotime($this->post["end_time"][$i][$j])){
						//Start end time Same
						$this->arr_ret_error["time"] = array("equal");
						$ret = false;
						break;
					} else if($sta_time_ok && $end_time_ok && $playlist_ok){
						//Range overlap
						$sta_time_1 = $this->post["sta_time"][$i][$j];
						$end_time_1 = $this->post["end_time"][$i][$j];
						for($k = 0; $k < MAX_PROGRGL_PLAYLIST; $k++){
							if($j === $k){
								continue;
							}
							if(isset($this->post["sta_time"][$i][$k]) && $this->post["sta_time"][$i][$k] !== "" && isset($this->post["end_time"][$i][$k]) && $this->post["end_time"][$i][$k] !== ""){
								$sta_time_2 = $this->post["sta_time"][$i][$k];
								$end_time_2 = $this->post["end_time"][$i][$k];

								if($sta_time_1 <= $sta_time_2 && $sta_time_2 < $end_time_1){
									$this->arr_ret_error["time"] = array("exists");
									$ret = false;
									break;
								} else if($sta_time_1 < $end_time_2 && $end_time_2 <= $end_time_1){
									$this->arr_ret_error["time"] = array("exists");
									$ret = false;
									break;
								}
							}
						}
						if($ret === false){
							break;
						}
					}
				}
				if($ret === false){
					break;
				}
			}

			//Common item validation
			$this->validation = Validation::factory($this->post)
				->rule('prog_name', 'not_empty')
				->rule('prog_name', 'max_length', array(':value', '20'))
				->rule('arr_dev', 'not_empty')
			;
			if($this->validation->check() === false){
				//Validation NG
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
		$this->model->db->begin();
		$arr_dev = array();

		//Distribution by terminal
		$arr_tmp_dev_id = $this->post["arr_dev"];
		foreach($arr_tmp_dev_id as $tmp_dev_id){
			//Regular terminal confirmation
			$dev_exists = $this->model->sel_dev($tmp_dev_id);
			if(!empty($dev_exists[0])){
				$dev = new StdClass();
				$dev->dev_id = $tmp_dev_id;
				array_push($arr_dev, $dev);
			}
		}

		foreach($arr_dev as $dev){
			//Delete existing record
			$arr_prog_rgl_grp = $this->model->sel_arr_prog_rgl_grp_by_dev_id($dev->dev_id);
			foreach($arr_prog_rgl_grp as $tmp_prog_rgl_grp){
				$prog_rgl_grp = new Db_Up();
				$prog_rgl_grp->prog_rgl_grp_id = $tmp_prog_rgl_grp->prog_rgl_grp_id;
				$ret = $this->model->del_prog_rgl_grp($prog_rgl_grp);
				if($ret === false){
					break;
				}
			}
			if($ret === false){
				break;
			}

			//Get id
			$prog_rgl_grp_id = $this->model->sel_next_prog_rgl_grp_id();
			if(is_null($prog_rgl_grp_id)){
				$ret = false;
				break;
			}
			$prog_rgl_grp = new Db_Ins();
			$prog_rgl_grp->prog_rgl_grp_id = $prog_rgl_grp_id;
			$prog_rgl_grp->dev_id = $dev->dev_id;
			$prog_rgl_grp->prog_name = $this->post["prog_name"];

			//DB registration (program guide (repeated designation) group)
			if($ret){
				$ret = $this->model->ins_prog_rgl_grp($prog_rgl_grp);
				if($ret === false){
					break;
				}
			}

			//Select day of the week
			$mon_idx = $this->post["mon"];
			$tues_idx = $this->post["tues"];
			$wednes_idx = $this->post["wednes"];
			$thurs_idx = $this->post["thurs"];
			$fri_idx = $this->post["fri"];
			$satur_idx = $this->post["satur"];
			$sun_idx = $this->post["sun"];
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				//base
				if(isset($this->post["base"][$i])){
					$playlist_id = $this->post["base"][$i];
					$prog_id = $this->model->sel_next_prog_id();
					$prog_rgl = new Db_Ins();
					$prog_rgl->prog_id = $prog_id;
					$prog_rgl->prog_rgl_grp_id = $prog_rgl_grp_id;
					$prog_rgl->sta_time = PROGRGL_BASE_STA_TIME;
					$prog_rgl->end_time = PROGRGL_BASE_END_TIME;
					$prog_rgl->year = 0;
					$prog_rgl->month = 0;
					$prog_rgl->day = 0;
					$ins = false;
					if($mon_idx === (string)$i){
						$ins = true;
						$prog_rgl->mon = 1;
					} else {
						$prog_rgl->mon = 0;
					}
					if($tues_idx === (string)$i){
						$ins = true;
						$prog_rgl->tues = 1;
					} else {
						$prog_rgl->tues = 0;
					}
					if($wednes_idx === (string)$i){
						$ins = true;
						$prog_rgl->wednes = 1;
					} else {
						$prog_rgl->wednes = 0;
					}
					if($thurs_idx === (string)$i){
						$ins = true;
						$prog_rgl->thurs = 1;
					} else {
						$prog_rgl->thurs = 0;
					}
					if($fri_idx === (string)$i){
						$ins = true;
						$prog_rgl->fri = 1;
					} else {
						$prog_rgl->fri = 0;
					}
					if($satur_idx === (string)$i){
						$ins = true;
						$prog_rgl->satur = 1;
					} else {
						$prog_rgl->satur = 0;
					}
					if($sun_idx === (string)$i){
						$ins = true;
						$prog_rgl->sun = 1;
					} else {
						$prog_rgl->sun = 0;
					}
					$prog_rgl->priority = 0;
					$prog_rgl->col_id = $i;
					$prog_rgl->row_id = 0;
					if($ins){
						//DB registration (program table)
						if($ret){
							$ret = $this->model->ins_prog($prog_rgl);
							if($ret === false){
								break;
							}
						}

						//DB registration (program list play list related)
						if($ret && $playlist_id !== ""){
							$prog_playlist_rela = new Db_Ins();
							$prog_playlist_rela->prog_id = $prog_id;
							$prog_playlist_rela->playlist_id = $playlist_id;
							$prog_playlist_rela->ch = 1;
							$ret = $this->model->ins_prog_playlist_rela($prog_playlist_rela);
							if($ret === false){
								break;
							}
						}
					}
				}

				//Individual
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					if(!isset($this->post["playlist"][$i][$j]) || $this->post["playlist"][$i][$j] === ""){
						continue;
					}
					$playlist_id = $this->post["playlist"][$i][$j];
					$prog_id = $this->model->sel_next_prog_id();
					$prog_rgl = new Db_Ins();
					$prog_rgl->prog_id = $prog_id;
					$prog_rgl->prog_rgl_grp_id = $prog_rgl_grp_id;
					$prog_rgl->sta_time = $this->post["sta_time"][$i][$j];
					$prog_rgl->end_time = $this->post["end_time"][$i][$j];
					$prog_rgl->year = 0;
					$prog_rgl->month = 0;
					$prog_rgl->day = 0;

					//Seconds completion
					if($prog_rgl->sta_time){
						$prog_rgl->sta_time = $this->supple_sec($prog_rgl->sta_time);
					}
					if($prog_rgl->end_time){
						$prog_rgl->end_time = $this->supple_sec($prog_rgl->end_time);
					}

					$ins = false;
					if($mon_idx === (string)$i){
						$ins = true;
						$prog_rgl->mon = 1;
					} else {
						$prog_rgl->mon = 0;
					}
					if($tues_idx === (string)$i){
						$ins = true;
						$prog_rgl->tues = 1;
					} else {
						$prog_rgl->tues = 0;
					}
					if($wednes_idx === (string)$i){
						$ins = true;
						$prog_rgl->wednes = 1;
					} else {
						$prog_rgl->wednes = 0;
					}
					if($thurs_idx === (string)$i){
						$ins = true;
						$prog_rgl->thurs = 1;
					} else {
						$prog_rgl->thurs = 0;
					}
					if($fri_idx === (string)$i){
						$ins = true;
						$prog_rgl->fri = 1;
					} else {
						$prog_rgl->fri = 0;
					}
					if($satur_idx === (string)$i){
						$ins = true;
						$prog_rgl->satur = 1;
					} else {
						$prog_rgl->satur = 0;
					}
					if($sun_idx === (string)$i){
						$ins = true;
						$prog_rgl->sun = 1;
					} else {
						$prog_rgl->sun = 0;
					}
					$prog_rgl->priority = 1;
					$prog_rgl->col_id = $i;
					$prog_rgl->row_id = $j;

					if($ins){
						//DB registration (program table)
						if($ret){
							$ret = $this->model->ins_prog($prog_rgl);
							if($ret === false){
								break;
							}
						}

						//DB registration (program list play list related)
						if($ret){
							$prog_playlist_rela = new Db_Ins();
							$prog_playlist_rela->prog_id = $prog_id;
							$prog_playlist_rela->playlist_id = $playlist_id;
							$prog_playlist_rela->ch = 1;
							$ret = $this->model->ins_prog_playlist_rela($prog_playlist_rela);
							if($ret === false){
								break;
							}
						}
					}
				}

				// DL Reset status
				if($ret){
					$dev_dlLog = new Db_Up();
					$dev_dlLog->dev_id = $dev->dev_id;
					$ret = $this->model->sel_dlLog_up($dev_dlLog);
					if($ret === false){
						break;
					}
				}

				if($ret === false){
					break;
				}

			}
			if($ret === false){
				break;
			}
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
		$prog_rgl_grp = $this->model->sel_prog_rgl_grp($dev_id);
		if(empty($prog_rgl_grp[0])){
			//When object is not present
			$this->session->set(MODULE_NAME_DEVPROG, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		$prog_rgl_grp = $prog_rgl_grp[0];
		$this->post["dev_name"] = $prog_rgl_grp->dev_name;
		$this->post["prog_name"] = $prog_rgl_grp->prog_name;

		//Keep ant's type
		$ants_version = $this->post["ants_version"];
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('progrgl.up_post');
			if($this->chk_token(MODULE_NAME_DEVPROG) && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('progrgl.up_post');

				//Redirect to list on success
				$this->session->set(MODULE_NAME_DEVPROG, array(ACTION_UP => true));
				$this->request->redirect(MODULE_NAME_DEVPROG);
			} else {
				//失敗時
				$this->session->set($this->module_name, array(ACTION_UP => false));
			}
		} else if($this->act === "conf"){
			$dev_id = $this->post["dev_id"];
			if($this->up_validation()){
				//Store in session
				$this->session->set('progrgl.up_post', $this->post);

				//Sort order correspondence
				if(isset($this->post['sta_time'])){
					foreach($this->post['sta_time'] as $key => $val){
						$sta_time_arr = $end_time_arr = $playlist_arr = array();
						$this->padding_time($this->post['sta_time'][$key]);
						$this->padding_time($this->post['end_time'][$key]);
						asort($this->post['sta_time'][$key]);
						foreach($this->post['sta_time'][$key] as $key2 => $val2){
							if($val2 === '') continue;
							$sta_time_arr[] = $this->post['sta_time'][$key][$key2];
							$end_time_arr[] = $this->post['end_time'][$key][$key2];
							$playlist_arr[] = $this->post['playlist'][$key][$key2];
						}
						$this->post['playlist'][$key] = $playlist_arr;
						$this->post['end_time'][$key] = $end_time_arr;
						$this->post['sta_time'][$key] = array_merge($sta_time_arr);	//Reschedule sidekey
					}
				}

				//Supplement missing elements
				$this->add_time();

				//Template selection
				$this->template->set_filename("progrgl.up_conf.template");
			}
		} else {
			//No data registration (initial display)
			$prog_rgl_grp_id = $prog_rgl_grp->prog_rgl_grp_id;

			$this->post = array();
			$this->post["dev_id"] = $dev_id;
			$this->post["prog_name"] = $prog_rgl_grp->prog_name;
			$this->post["dev_name"] = $prog_rgl_grp->dev_name;
			$this->post["base"] = array();
			$this->post["sta_time_h"] = array();
			$this->post["sta_time_m"] = array();
			$this->post["end_time_h"] = array();
			$this->post["end_time_m"] = array();
			$this->post["playlist"] = array();
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				$this->post["sta_time_h"][$i] = array();
				$this->post["sta_time_m"][$i] = array();
				$this->post["end_time_h"][$i] = array();
				$this->post["end_time_m"][$i] = array();
				$this->post["playlist"][$i] = array();
			}

			$arr_prog_rgl = $this->model->sel_arr_prog_rgl($prog_rgl_grp_id);
			foreach($arr_prog_rgl as $prog_rgl){
				$col_id = $prog_rgl->col_id;
				$row_id = $prog_rgl->row_id;
				$sta_time = $prog_rgl->sta_time;
				$end_time = $prog_rgl->end_time;
				$playlist_id = $prog_rgl->playlist_id;
				$playlist_name = $prog_rgl->playlist_name;
				$mon = $prog_rgl->mon;
				if($mon === 1){
					$this->post["mon"] = $col_id;
				}
				$tues = $prog_rgl->tues;
				if($tues === 1){
					$this->post["tues"] = $col_id;
				}
				$wednes = $prog_rgl->wednes;
				if($wednes === 1){
					$this->post["wednes"] = $col_id;
				}
				$thurs = $prog_rgl->thurs;
				if($thurs === 1){
					$this->post["thurs"] = $col_id;
				}
				$fri = $prog_rgl->fri;
				if($fri === 1){
					$this->post["fri"] = $col_id;
				}
				$satur = $prog_rgl->satur;
				if($satur === 1){
					$this->post["satur"] = $col_id;
				}
				$sun = $prog_rgl->sun;
				if($sun === 1){
					$this->post["sun"] = $col_id;
				}
				$priority = $prog_rgl->priority;
				if($priority === 0){
					$this->post["base"][$col_id] = $playlist_id;
				} else {
					$arr_sta_time = explode(":", $sta_time);
					$arr_end_time = explode(":", $end_time);
					$this->post["sta_time_h"][$col_id][$row_id] = $arr_sta_time[0];
					$this->post["sta_time_m"][$col_id][$row_id] = $arr_sta_time[1];
					$this->post["end_time_h"][$col_id][$row_id] = $arr_end_time[0];
					$this->post["end_time_m"][$col_id][$row_id] = $arr_end_time[1];
					$this->post["playlist"][$col_id][$row_id] = $playlist_id;
				}
			}
			for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					if(!isset($this->post["sta_time_h"][$i][$j])){
						$this->post["sta_time_h"][$i][$j] = "";
					}
					if(!isset($this->post["sta_time_m"][$i][$j])){
						$this->post["sta_time_m"][$i][$j] = "";
					}
					if(!isset($this->post["end_time_h"][$i][$j])){
						$this->post["end_time_h"][$i][$j] = "";
					}
					if(!isset($this->post["end_time_m"][$i][$j])){
						$this->post["end_time_m"][$i][$j] = "";
					}
					if(!isset($this->post["playlist"][$i][$j])){
						$this->post["playlist"][$i][$j] = "";
					}
				}
			}

			//Set as initial value if there is session data Set only when coming from return button
			if($this->act === "back"){
				if($this->session->get('progrgl.up_post')){
					$this->post = $this->session->get('progrgl.up_post');
					$this->session->delete('progrgl.up_post');
				}
			}
		}
		$this->post["ants_version"] = $ants_version;

		//Set value to template
		$this->head_add = "head.progrgl.up.template";
		$arr_ret_dev = array();
		if(!empty($arr_dev)){
			foreach($arr_dev as $dev){
				$arr_ret_dev[$dev->dev_id] = $dev->dev_name . " (" . $dev->shop_name . ")";
			}
		}

		$this->template->arr_all_dev = $arr_ret_dev;
		$this->template->arr_all_playlist = Controller_Template::get_arr_playlist($ants_version);
		$this->finalize_time();
		$this->template->time = Controller_Template::get_arr_time();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
	}

	/**
	 * Update validation processing
	 */
	private function up_validation(){
		$this->post["arr_dev"] = array($this->post["dev_id"]);
		return $this->ins_validation();
	}

	/**
	 * Update processing
	 */
	private function up(){
		$this->post["arr_dev"] = array($this->post["dev_id"]);
		return $this->ins();
	}

	/**
	 * Missing element replenishment (registration update confirmation screen)
	 */
	private function add_time(){
		for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
			if(!isset($this->post['sta_time'][$i])){
				$this->post["sta_time"][$i] = array();
			}
			for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
				if(!isset($this->post['sta_time'][$i][$j])){
					$this->post["sta_time"][$i][$j] = "";
				}
			}
		}
		for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
			if(!isset($this->post['end_time'][$i])){
				$this->post["end_time"][$i] = array();
			}
			for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
				if(!isset($this->post['end_time'][$i][$j])){
					$this->post["end_time"][$i][$j] = "";
				}
			}
		}
		for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
			if(!isset($this->post['playlist'][$i])){
				$this->post["playlist"][$i] = array();
			}
			for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
				if(!isset($this->post['playlist'][$i][$j])){
					$this->post["playlist"][$i][$j] = "";
				}
			}
		}
	}

	/**
	 * Missing element replenishment (final processing)
	 */
	private function finalize_time(){
		for($i = 0; $i < MAX_PROGRGL_DOW; $i++){
			if(!isset($this->post["base"][$i])){
				$this->post["base"][$i] = "";
			}
			if(!isset($this->post["sta_time"][$i])){
				$this->post["sta_time"][$i] = array();
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					$this->post["sta_time"][$i][$j] = "";
				}
			}
			if(!isset($this->post["end_time"][$i])){
				$this->post["end_time"][$i] = array();
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					$this->post["end_time"][$i][$j] = "";
				}
			}
			if(!isset($this->post["playlist"][$i])){
				$this->post["playlist"][$i] = array();
				for($j = 0; $j < MAX_PROGRGL_PLAYLIST; $j++){
					$this->post["playlist"][$i][$j] = "";
				}
			}
		}
	}
}
