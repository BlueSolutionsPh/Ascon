<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Prog extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Prog($this->get_target_client_id());
		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
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
		if(SERVICE_ANTS_ONE_ENABLE === true){
			//Keep ant's version
			if(isset($this->post['ants_version_tmp'])){
				$ants_version = $this->post['ants_version_tmp'];
				$ants_version_tmp = $this->post['ants_version_tmp'];
			} else {
				$ants_version = ANTS_TWO_KIND;
				$ants_version_tmp = ANTS_TWO_KIND;
			}
		}

		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('prog.ins_post');
			if($this->chk_token(MODULE_NAME_DEVPROG) && $this->ins_validation() && $this->ins()){
				//Redirect to list on success
				$this->session->set(MODULE_NAME_DEVPROG, array(ACTION_INS => true));
				$this->session->delete('prog.ins_post');
				$this->request->redirect(MODULE_NAME_DEVPROG);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
			}
		} else if($this->act === "conf"){
			$ret = true;
			if($this->ins_validation()){
				//In case of overwriting setting for each terminal Retrieve the affected record
				$arr_effe_rec = array();
				if(isset($this->post["over_write"]) && $this->post["over_write"] === "true"){
					foreach($this->post["arr_dev"] as $dev_id){
						$effe_rec = array();

						//Get terminal name
						$dev = $this->model->sel_dev_name($dev_id);
						if(empty($dev[0])){
							continue;
						}
						$dev = $dev[0];

						//Acquire store name
						$shop = $this->model->sel_shop_name($dev_id);
						$shop = $shop[0];

						$effe_rec["dev_name"] = $dev->dev_name . "（" . $shop->shop_name . "）";

						//Number of cases
						$prog_cnt = $this->model->sel_cnt_prog_by_arr_dev_id_sta_dt_end_dt($dev_id, $this->post["sta_dt"], $this->post["end_dt"]);
						$prog_cnt = $prog_cnt[0];
						$this->post["prog_cnt"] = $prog_cnt->cnt;

						//Record acquisition
						$arr_tmp_prog = array();
						$arr_prog = $this->model->sel_arr_prog_by_arr_dev_id_sta_dt_end_dt($dev_id, $this->post["sta_dt"], $this->post["end_dt"]);
						foreach($arr_prog as $prog){
							if($this->post["sta_dt"] <= $prog->sta_dt && $prog->end_dt <= $this->post["end_dt"]){
								//Deletes as it contains everything
								$prog->sta_dt_after = "";
								$prog->end_dt_after = "";
							} else if($this->post["sta_dt"] <= $prog->sta_dt && $this->post["end_dt"] <= $prog->end_dt){
								//Influence only on the start date and time
								$prog->sta_dt_after = $this->post["end_dt"];
								$prog->end_dt_after = $prog->end_dt;
							} else if($prog->sta_dt <= $this->post["sta_dt"] && $prog->end_dt <= $this->post["end_dt"]){
								//Impact on end date and time only
								$prog->sta_dt_after = $prog->sta_dt;
								$prog->end_dt_after = $this->post["sta_dt"];
							} else if($prog->sta_dt <= $this->post["sta_dt"] && $this->post["end_dt"] <= $prog->end_dt){
								//Originally it is divided into two, but it affects only the end date and time
								$prog->sta_dt_after = $prog->sta_dt;
								$prog->end_dt_after = $this->post["sta_dt"];
							}

							$playlist = $this->model->sel_playlist_by_prog_id($prog->prog_id);
							if(!empty($playlist[0])){
								$playlist = $playlist[0];
							} else {
								$playlist = new stdClass();
								$playlist->playlist_name = "";
							}
							array_push($arr_tmp_prog, array("prog_id" => $prog->prog_id, "sta_dt" => $prog->sta_dt, "sta_dt_after" => $prog->sta_dt_after, "end_dt" => $prog->end_dt, "end_dt_after" => $prog->end_dt_after, "playlist_name" => $playlist->playlist_name));
						}
						$effe_rec["arr_prog"] = $arr_tmp_prog;
						array_push($arr_effe_rec, $effe_rec);
					}
				}

				//Store in session
				$this->session->set('prog.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("prog.ins_conf.template");
				$this->template->arr_effe_rec = $arr_effe_rec;
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('prog.ins_post')){
				$this->post = $this->session->get('prog.ins_post');
				$this->session->delete('prog.ins_post');
			}
		}

		$arr_ret_dev = array();
		$arr_sel_dev = array();
		if(SERVICE_ANTS_ONE_ENABLE === false){
			$search = new stdClass;
			$search->offset = 0;
			$search->ants_version = ANTS_TWO_KIND;
			$arr_dev = $this->model->sel_arr_dev_shop($search);
		} else {
			$arr_dev = $this->model->sel_arr_dev_shop();
		}

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
		$this->head_add = "head.prog.ins.template";
		$this->template->arr_all_playlist = $arr_playlist_name;
		$this->template->arr_all_tag = Controller_Template::get_arr_dev_tag();
		$this->template->arr_all_dev = $arr_ret_dev;
		$this->template->arr_sel_dev = $arr_sel_dev;
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version(false);

		if(SERVICE_ANTS_ONE_ENABLE === true){
			$this->post["ants_version"] = $ants_version;
			$this->post["ants_version_tmp"] = $ants_version_tmp;
			$this->template->ants_version = $ants_version;
			$this->template->ants_version_tmp = $ants_version_tmp;
			$this->template->arr_all_ants_version_tmp = Controller_Template::get_arr_ants_version(false);
		}
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post(MODULE_NAME_DEVPROG);
		if($ret){
			$this->post["dt"] = $this->post["sta_dt"];	//Dummy variables for error display
			$this->validation = Validation::factory($this->post)
				->rule('prog_name', 'not_empty')
				->rule('prog_name', 'max_length', array(':value', '20'))
				->rule('sta_dt', 'not_empty')
				->rule('sta_dt', 'date')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
				->rule('end_dt', 'not_empty')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('arr_dev', 'not_empty')
			;
			if(!isset($this->post["over_write"]) || $this->post["over_write"] !== "true"){
				$this->validation = $this->validation
					->rule('dt', 'prog_dt_exists', array(':validation', 'arr_dev', 'sta_dt', 'end_dt'))
				;
			}
			if($this->validation->check() === false){
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
				$ret = false;
			}
			//playlist
			if(isset($this->post["ch_1"]) && $this->post["ch_1"] !== ""){
				//Because it is ok, I do not do anything
			} else {
				$this->arr_ret_error["playlist"] = array("not_empty");
				$ret = false;
			}
		}
		return $ret;
	}

	/**
	 * registration process
	 */
	private function ins(){
		//Only when the end time is 23:59, it extends to 23: 59: 59
		if(preg_match('/.*23:59$/',$this->post["end_dt"])){
			$this->post["end_dt"] = $this->post["end_dt"] . ':59';
		}

		$ret = true;
		$this->model->db->begin();
		$arr_dev = array();
		if(isset($this->post["arr_dev"])){
			$this->post["arr_dev"] = array_unique($this->post["arr_dev"]);
		}
		$arr_tmp_dev_id = $this->post["arr_dev"];
		foreach($arr_tmp_dev_id as $tmp_dev_id){
			//正規端末確認
			$dev_exists = $this->model->sel_dev($tmp_dev_id);
			if(!empty($dev_exists[0])){
				$dev = new StdClass();
				$dev->dev_id = $tmp_dev_id;
				array_push($arr_dev, $dev);
			}
		}

		foreach($arr_dev as $dev){
			$prog_id = $this->model->sel_next_prog_id();
			if(is_null($prog_id)){
				$ret = false;
			} else {
				//DB update
				$arr_tmp_prog = array();
				$arr_prog = $this->model->sel_arr_prog_by_arr_dev_id_sta_dt_end_dt($dev->dev_id, $this->post["sta_dt"], $this->post["end_dt"], false);
				foreach($arr_prog as $prog){
					$prog_db = new Db_Up();
					if($this->post["sta_dt"] <= $prog->sta_dt && $prog->end_dt <= $this->post["end_dt"]){
						//Deletes as it contains everything
						$prog_db->prog_id = $prog->prog_id;
						$ret = $this->model->del_prog($prog_db);
					} else if($this->post["sta_dt"] <= $prog->sta_dt && $this->post["end_dt"] <= $prog->end_dt){
						//Influence only on the start date and time
						$prog_db->prog_id = $prog->prog_id;
						$prog_db->sta_dt = $this->post["end_dt"];
						$prog_db->end_dt = $prog->end_dt;
						$ret = $this->model->up_prog($prog_db);
					} else if($prog->sta_dt <= $this->post["sta_dt"] && $prog->end_dt <= $this->post["end_dt"]){
						//Impact on end date and time only
						$prog_db->prog_id = $prog->prog_id;
						$prog_db->sta_dt = $prog->sta_dt;
						$prog_db->end_dt = $this->post["sta_dt"];
						$ret = $this->model->up_prog($prog_db);
					} else if($prog->sta_dt <= $this->post["sta_dt"] && $this->post["end_dt"] <= $prog->end_dt){
						//Originally it is divided into two, but it affects only the end date and time
						$prog_db->prog_id = $prog->prog_id;
						$prog_db->sta_dt = $prog->sta_dt;
						$prog_db->end_dt = $this->post["sta_dt"];
						$ret = $this->model->up_prog($prog_db);
					}
				}
			}

			//DB registration (program table)
			if($ret){
				$prog = new Db_Ins();
				$prog->prog_id = $prog_id;
				$prog->dev_id = $dev->dev_id;
				$prog->prog_name = $this->post["prog_name"];
				$prog->sta_dt = $this->post["sta_dt"];
				$prog->end_dt = $this->post["end_dt"];
				$prog->inst_flag = 1;	//TODO Immediate flag

				$arr_prog_playlist_rela = array();
				$arr_prog_playlist_rela[1] = $this->post["ch_1"];
				$ret = $this->model->ins_prog($prog);
				if($ret === false){
					break;
				}
			}

			//DB registration (program list play list related)
			if($ret){
				foreach($arr_prog_playlist_rela as $ch => $playlist_id){
					if(isset($playlist_id) && $playlist_id !== ""){
						$prog_playlist_rela = new Db_Ins();
						$prog_playlist_rela->prog_id = $prog_id;
						$prog_playlist_rela->playlist_id = $playlist_id;
						$prog_playlist_rela->ch = $ch;
						$ret = $this->model->ins_prog_playlist_rela($prog_playlist_rela);
						if($ret === false){
							break;
						}
					}
				}
			}

			//Reset DL status
			if($ret){
				$dev_dlLog = new Db_Up();
				$dev_dlLog->dev_id = $dev->dev_id;
				$ret = $this->model->sel_dlLog_up($dev_dlLog);
				if($ret === false){
					break;
				}
			}
		}
		return $this->model->db->end($ret);
	}
}
