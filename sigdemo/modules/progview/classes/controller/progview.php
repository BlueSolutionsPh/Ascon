<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Progview extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Progview($this->get_target_client_id());

		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				//It is unnecessary because disp_list_after is called in the function
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
		//Always obtain terminal ID from URL
		if($this->request->param("param1", false)){
			$dev_id = $this->request->param("param1");
			$this->post["dev_id"] = $dev_id;
			if(isset($this->post["prog_date"])){
				//Redirect when searching
				$this->request->redirect(MODULE_NAME_PROGVIEW . "/index/" . $dev_id . "/" . $this->post["prog_date"]);
			} else if($this->request->param("param2", false)){
				$prog_date = $this->request->param("param2");
				$this->post["prog_date"] = $prog_date;
			} else {
				//Redirect on current day in case of initial display
				$prog_date = str_replace("/", "-", substr(Request::$request_dt, 0, 10));
				$this->post["prog_date"] = $prog_date;
				$this->request->redirect(MODULE_NAME_PROGVIEW . "/index/" . $dev_id . "/" . $this->post["prog_date"]);
			}
			
			$ants_version_obj = $this->model->sel_dev_id_ants_version($dev_id);
			$ants_version = array();
			if(!empty($ants_version_obj)){
				foreach($ants_version_obj as $ants_ver){
					$ants_version = $ants_ver->ants_version;
				}
			}
			$this->post["ants_version"] = $ants_version;
			
		} else {
			//Redirect to menu in case of illegal operation
			$this->request->redirect(MODULE_NAME_MENU);
		}
		
		$arr_ret_prog = array();
		if(isset($prog_date)){
			//Validation
			$this->validation = Validation::factory($this->post)
				->rule('prog_date', 'not_empty')
				->rule('prog_date', 'date')
			;
			
			if($this->validation->check()){
				//Program guide (repeated designation)
				$search_prog_date = $prog_date . " 00:00:00";
				$keys = array("year", "month", "day", "hour", "minute", "second");
				$date_1 = array_combine($keys, preg_split("/[-: ]/", $search_prog_date));
				$arr_prog_rgl = array();
				$rows = $this->model->sel_arr_prog_rgl($dev_id, $search_prog_date);
				foreach($rows as $row){
					$prog_id = $row->prog_id;
					$prog_name = $row->prog_name;
					$sta_time = $row->sta_time;
					$tmp_sta_dt = explode(":", $sta_time);
					$sta_hour = $tmp_sta_dt[0];
					$sta_min = $tmp_sta_dt[1];
					$sta_second = $tmp_sta_dt[2];
					$end_time = $row->end_time;
					$tmp_end_dt = explode(":", $end_time);
					$end_hour = $tmp_end_dt[0];
					$end_min = $tmp_end_dt[1];
					$end_second = $tmp_end_dt[2];
					$year = $row->year;
					$month = $row->month;
					$day = $row->day;
					$mon = $row->mon;
					$tues = $row->tues;
					$wednes = $row->wednes;
					$thurs = $row->thurs;
					$fri = $row->fri;
					$satur = $row->satur;
					$sun = $row->sun;
					
					$sta_dt = date("Y-m-d H:i:s", mktime($sta_hour, $sta_min, $sta_second, $date_1["month"], $date_1["day"], $date_1["year"]));
					$end_dt = date("Y-m-d H:i:s", mktime($end_hour, $end_min, $end_second, $date_1["month"], $date_1["day"], $date_1["year"]));
					
					$prog_rgl = new stdClass();
					$prog_rgl->prog_id = $prog_id;
					$prog_rgl->prog_name = $prog_name;
					$prog_rgl->prog_cat = PROG_RGL_STR;
					$prog_rgl->sta_dt = $sta_dt;
					$prog_rgl->end_dt = $end_dt;
					
					array_push($arr_prog_rgl, $prog_rgl);
				}
				
				//Program guide (date designation)
				$arr_prog = array(); 
				$rows = $this->model->sel_arr_prog($dev_id, $prog_date);
				foreach($rows as $row){
					$row->prog_cat = PROG_INST_STR;
				}
				
				foreach($rows as $row){
					$this->merge_prog($row, $arr_prog);
				}
				
				//Merging the program guide (repeated designation) and the program guide
				foreach($arr_prog_rgl as $prog_rgl){
					$this->merge_prog($prog_rgl, $arr_prog);
				}
				if(!empty($arr_prog)){
					$arr_tmp_prog = array(array(), array(), array(), array(), array());
					foreach($arr_prog as $prog){
						array_push($arr_tmp_prog[0], $prog->prog_id);
						array_push($arr_tmp_prog[1], $prog->prog_name);
						array_push($arr_tmp_prog[2], $prog->sta_dt);
						array_push($arr_tmp_prog[3], $prog->end_dt);
						array_push($arr_tmp_prog[4], $prog->prog_cat);
					}
					array_multisort($arr_tmp_prog[2], SORT_ASC, SORT_STRING, $arr_tmp_prog[3], SORT_ASC, SORT_STRING, $arr_tmp_prog[1], SORT_ASC, SORT_STRING, $arr_tmp_prog[0], SORT_DESC, SORT_NUMERIC, $arr_tmp_prog[4], SORT_ASC, SORT_STRING);
					$arr_prog = array();
					for($i = 0; $i < count($arr_tmp_prog[0]); $i++ ){
						$prog = new stdClass();
						$prog->prog_id = $arr_tmp_prog[0][$i];
						$prog->prog_name = $arr_tmp_prog[1][$i];
						$prog->sta_dt = $arr_tmp_prog[2][$i];
						$prog->end_dt = $arr_tmp_prog[3][$i];
						$prog->prog_cat = $arr_tmp_prog[4][$i];
						array_push($arr_prog, $prog);
					}
					foreach($arr_prog as $prog){
						$ret_prog = new stdClass();
						$ret_prog->prog_id = $prog->prog_id;
						$ret_prog->prog_name = $prog->prog_name;
						$ret_prog->dt_flag = false;	//Multiple day flag
						$ret_prog->sta_dt = $prog->sta_dt;
						if(strtotime($prog->sta_dt) < strtotime($prog_date)){
							$ret_prog->sta_time = substr(date("Y-m-d H:i:s", mktime(0, 0, 0, $date_1["month"], $date_1["day"], $date_1["year"])), -8);;
							$ret_prog->dt_flag = true;
						} else {
							$ret_prog->sta_time = substr($prog->sta_dt, -8);
							$arr_sta_time = explode(":", $ret_prog->sta_time);
							$ret_prog->sta_time_h = $arr_sta_time[0];
							$ret_prog->sta_time_m = $arr_sta_time[1];
						}
						$ret_prog->end_dt = $prog->end_dt;
						$tmp_end_dt = date("Y-m-d H:i:s", mktime(23, 59, 59, $date_1["month"], $date_1["day"], $date_1["year"]));
						if(strtotime($prog->end_dt) > strtotime($tmp_end_dt)){
							$ret_prog->end_time = substr($tmp_end_dt, -8);
							$ret_prog->dt_flag = true;
						} else {
							$ret_prog->end_time = substr($prog->end_dt, -8);
							$arr_end_time = explode(":", $ret_prog->end_time);
							$ret_prog->end_time_h = $arr_end_time[0];
							$ret_prog->end_time_m = $arr_end_time[1];
						}
						$ret_prog->prog_cat = $prog->prog_cat;
						
						$arr_playlist = $this->model->sel_arr_playlist_by_prog_id($ret_prog->prog_id);
						foreach($arr_playlist as $playlist){
							$ch = "ch_" . $playlist->ch;
							$ret_prog->$ch = new stdClass();
							$ret_prog->$ch->playlist_id = $playlist->playlist_id;
							$ret_prog->$ch->playlist_name = $playlist->playlist_name;
							$ret_prog->$ch->arr_draw_area = $this->model->sel_arr_draw_area_by_draw_tmpl_id($playlist->draw_tmpl_id);
							foreach($ret_prog->$ch->arr_draw_area as $draw_area){
								$draw_area->arr_cts = array();
								switch($draw_area->cts_type){
									case "movie":
										$tmp_arr_movie = array();
										$arr_playlist_movie = $this->model->sel_arr_movie_by_playlist_id_draw_area_id_dt($playlist->playlist_id, $draw_area->draw_area_id, $ret_prog->sta_dt, $ret_prog->end_dt);
										foreach($arr_playlist_movie as $playlist_movie){
											$movie_url = null;
											if(!empty($playlist_movie->movie_orig_file_exte)){
												$movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $playlist_movie->file_name . $playlist_movie->movie_orig_file_exte;
											}
											$movie = new stdClass();
											$movie->movie_id = $playlist_movie->movie_id;
											$movie->movie_name = $playlist_movie->movie_name;
											$movie->display_order = $playlist_movie->display_order;
											$movie->movie_url = $movie_url;
											$tmp_arr_movie[$playlist_movie->display_order] = $movie;
										}
										if(count($ret_prog->$ch->arr_draw_area) === 1){
											$arr_playlist_image = $this->model->sel_arr_image_by_playlist_id_draw_area_id_dt($playlist->playlist_id, $draw_area->draw_area_id, $ret_prog->sta_dt, $ret_prog->end_dt);
											foreach($arr_playlist_image as $playlist_image){
												$image_url = null;
												if(!empty($playlist_image->orig_file_exte)){
													$image_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/image/" . $playlist_image->file_name . $playlist_image->orig_file_exte;
												}
												$movie = new stdClass();
												$movie->movie_id = "image_" . $playlist_image->image_id;
												$movie->movie_name = $playlist_image->image_name;
												$movie->movie_url = $image_url;
												$tmp_arr_movie[$playlist_image->display_order] = $movie;
											}
										}
										ksort($tmp_arr_movie);
										foreach($tmp_arr_movie as $movie){
											array_push($draw_area->arr_cts, $movie);
										}
										break;
									case "sound":
										$arr_playlist_movie = $this->model->sel_arr_movie_by_playlist_id_draw_area_id_dt($playlist->playlist_id, $draw_area->draw_area_id, $ret_prog->sta_dt, $ret_prog->end_dt);
										foreach($arr_playlist_movie as $playlist_movie){
											$movie_url = null;
											if(!empty($playlist_movie->movie_orig_file_exte)){
												$movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $playlist_movie->file_name . $playlist_movie->movie_orig_file_exte;
											} else if(!empty($playlist_movie->sound_orig_file_exte)){
												$movie_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/movie/" . $playlist_movie->file_name . $playlist_movie->sound_orig_file_exte;
											}
											$movie = new stdClass();
											$movie->movie_id = $playlist_movie->movie_id;
											$movie->movie_name = $playlist_movie->movie_name;
											$movie->movie_url = $movie_url;
											array_push($draw_area->arr_cts, $movie);
										}
										break;
									case "image":
										$arr_playlist_image = $this->model->sel_arr_image_by_playlist_id_draw_area_id_dt($playlist->playlist_id, $draw_area->draw_area_id, $ret_prog->sta_dt, $ret_prog->end_dt);
										foreach($arr_playlist_image as $playlist_image){
											$image_url = URL::base($this->request) . MODULE_NAME_CTSDL . "/index/image/" . $playlist_image->file_name . $playlist_image->orig_file_exte;
											$image = new stdClass();
											$image->image_id = $playlist_image->image_id;
											$image->image_name = $playlist_image->image_name;
											$image->image_url = $image_url;
											array_push($draw_area->arr_cts, $image);
										}
										break;
									case "text":
										$arr_playlist_text = $this->model->sel_arr_text_by_playlist_id_draw_area_id_dt($playlist->playlist_id, $draw_area->draw_area_id, $ret_prog->sta_dt, $ret_prog->end_dt);
										foreach($arr_playlist_text as $playlist_text){
											$text = new stdClass();
											$text->text_id = $playlist_text->text_id;
											$text->text_name = $playlist_text->text_name;
											array_push($draw_area->arr_cts, $text);
										}
										break;
								}
							}
						}
						array_push($arr_ret_prog, $ret_prog);
					}
				}
			} else {
				//Date format invalid
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			}
		} else {
			//Initial display
		}
		
		//Set value to template
		$this->head_add = "head.progview.ins.template";
		$dev = $this->model->sel_dev($dev_id);
		if(empty($dev[0])){
			//When object is not present
			$this->request->redirect(MODULE_NAME_MENU);
		}
		$dev = $dev[0];
		$this->template->dev_name = $dev->dev_name;
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->prog_rgl_grp_id = $dev->prog_rgl_grp_id;
		$this->template->arr_all_playlist = Controller_Template::get_arr_playlist($ants_version);
		$this->template->arr_prog = $arr_ret_prog;
		$this->template->time = Controller_Template::get_arr_time(false);
	}
	
	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			if($this->ins_validation() && $this->ins()){
				//success
				$this->session->set($this->module_name, array(ACTION_INS => true));
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
				$this->post["prog_date"] = null; 
			}
		} else {
			//Illegal operation
		}
		parent::disp_list_before();
		$this->disp_list();
		parent::disp_list_after();
	}
	
	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = true;
		$this->post["arr_dev"] = array($this->post["dev_id"]);
		$this->post["sta_time"] = $this->post["sta_time_h"] . ":" . $this->post["sta_time_m"];
		$this->post["end_time"] = $this->post["end_time_h"] . ":" . $this->post["end_time_m"];
		$this->post["sta_dt"] = $this->post["prog_date"] . " " . $this->post["sta_time"];
		$this->post["end_dt"] = $this->post["prog_date"] . " " . $this->post["end_time"];
		$this->post["dt"] = $this->post["prog_date"];	//Dummy variables for error display
		$this->validation = Validation::factory($this->post)
			->rule('dev_id', 'not_empty')
			->rule('dev_id', 'digit')
			->rule('dev_id', 'dev_id')
			->rule('prog_name', 'not_empty')
			->rule('prog_name', 'max_length', array(':value', '20'))
			->rule('prog_date', 'not_empty')
			->rule('prog_date', 'date')
			->rule('sta_time', 'not_empty')
			->rule('sta_time', 'time')
			->rule('end_time', 'not_empty')
			->rule('end_time', 'time')
			->rule('end_dt', 'dt_past')
			->rule('sta_time', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
			->rule('sta_time', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
			->rule('dt', 'prog_dt_exists', array(':validation', 'arr_dev', 'sta_dt', 'end_dt'))
		;
		if($this->validation->check() === false){
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * registration process
	 */
	private function ins(){
		$ret = true;
		$this->model->db->begin();
		$dev_id = $this->post["dev_id"];
		$prog_id = $this->model->sel_next_prog_id();
		if(is_null($prog_id)){
			$ret = false;
		} else {
			//Only when the end time is 23:59, it extends to 23: 59: 59
			if(preg_match('/.*23:59$/',$this->post["end_time"])){
				$this->post["end_time"] = $this->post["end_time"] . ':59';
			}

			//Seconds completion
			if($this->post["sta_time"]){
				$this->post["sta_time"] = $this->supple_sec($this->post["sta_time"]);
			}
			if($this->post["end_time"]){
				$this->post["end_time"] = $this->supple_sec($this->post["end_time"]);
			}
			$prog = new Db_Ins();
			$prog->prog_id = $prog_id;
			$prog->dev_id = $dev_id;
			$prog->prog_name = $this->post["prog_name"];
			$prog->sta_dt = $this->post["prog_date"] . " " . $this->post["sta_time"];
			$prog->end_dt = $this->post["prog_date"] . " " . $this->post["end_time"];
			$prog->inst_flag = 1;	//TODO Immediate flag
			$arr_prog_playlist_rela = array();
			$arr_prog_playlist_rela[1] = $this->post["ch_1"];
		}
		
		//DB registration (program table)
		if($ret){
			$ret = $this->model->ins_prog($prog);
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
		
		//Reset DL log
		if($ret){
			$dev_dlLog = new Db_Up();
			$dev_dlLog->dev_id = $dev_id;
			$ret = $this->model->sel_dlLog_up($dev_dlLog);
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
			$prog_id = $this->post["prog_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		
		if($this->act === "up"){
			//With data registration
			if($this->up_validation() && $this->up()){
				//success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				parent::disp_list_before();
				$this->disp_list();
				parent::disp_list_after();
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
				$this->post["prog_date"] = null;
				parent::disp_list_before();
				$this->disp_list();
				parent::disp_list_after();
				
				//Restore edited content
				foreach($this->template->arr_prog as &$prog){
					if($prog->prog_id == $prog_id){
						if(isset($this->post["sta_dt"])){
							$prog->sta_dt = $this->post["sta_dt"];
						}
						if(isset($this->post["sta_time"])){
							$prog->sta_time = $this->post["sta_time"];
						}
						if(isset($this->post["end_dt"])){
							$prog->end_dt = $this->post["end_dt"];
						}
						if(isset($this->post["end_time"])){
							$prog->end_time = $this->post["end_time"];
						}
						$prog->prog_name = $this->post["prog_name"];
						if(isset($prog->ch_1)){
							$prog->ch_1->playlist_id = $this->post["ch_1"];
						}
					}
				}
				$this->template->prog_id = $prog_id;
			}
		} else {
			//Display list screen in edit mode
			parent::disp_list_before();
			$this->disp_list();
			parent::disp_list_after();
			if($this->del_validation()){
				$this->template->prog_id = $prog_id;
			}
		}
	}
	
	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = true;
		$this->post["arr_dev"] = array($this->post["dev_id"]);
		if(isset($this->post["sta_dt"])){
			$arr_sta_dt = explode(" ", $this->post["sta_dt"]);
			if(isset($arr_sta_dt[1])){
				$this->post["sta_time"] = $this->supple_sec($arr_sta_dt[1]);
			}
		} else {
			$this->post["sta_time"] = $this->post["sta_time_h"] . ":" . $this->post["sta_time_m"];
			$this->post["sta_dt"] = $this->post["prog_date"] . " " . $this->supple_sec($this->post["sta_time"]);
		}
		if(isset($this->post["end_dt"])){
			$arr_end_dt = explode(" ", $this->post["end_dt"]);
			if(isset($arr_end_dt[1])){
				$this->post["end_time"] = $this->supple_sec($arr_end_dt[1]);
			}
		} else {
			$this->post["end_time"] = $this->post["end_time_h"] . ":" . $this->post["end_time_m"];
			$this->post["end_dt"] = $this->post["prog_date"] . " " . $this->supple_sec($this->post["end_time"]);
		}
		$this->post["dt"] = $this->post["prog_date"];	//Dummy variables for error display
		$this->validation = Validation::factory($this->post)
			->rule('dev_id', 'not_empty')
			->rule('dev_id', 'digit')
			->rule('dev_id', 'dev_id')
			->rule('prog_id', 'not_empty')
			->rule('prog_id', 'digit')
			->rule('prog_id', 'prog_id')
			->rule('prog_name', 'not_empty')
			->rule('prog_name', 'max_length', array(':value', '20'))
			->rule('prog_date', 'not_empty')
			->rule('prog_date', 'date')
			->rule('sta_time', 'not_empty')
			->rule('sta_time', 'time')
			->rule('sta_time', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
			->rule('sta_time', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
			->rule('end_time', 'not_empty')
			->rule('end_time', 'time')
			->rule('sta_dt', 'date')
			->rule('end_dt', 'dt_past')
			->rule('end_dt', 'date')
			->rule('dt', 'prog_dt_exists_exclude_id', array(':validation', 'arr_dev', 'sta_dt', 'end_dt', 'prog_id'))
		;
		if($this->validation->check() === false){
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Update processing
	 */
	private function up(){
		$this->model->db->begin();
		$dev_id = $this->post["dev_id"];
		$prog_id = $this->post["prog_id"];
		
		$prog = new Db_Up();
		$prog->prog_id = $prog_id;
		$ret = $this->model->del_prog($prog);
		
		$prog_id = $this->model->sel_next_prog_id();
		if(is_null($prog_id)){
			$ret = false;
		} else {
			//Only when the end time is 23:59, it extends to 23: 59: 59
			if(preg_match('/.*23:59$/',$this->post["end_dt"])){
				$this->post["end_dt"] = $this->post["end_dt"] . ':59';
			}

			$prog = new Db_Ins();
			$prog->prog_id = $prog_id;
			$prog->dev_id = $dev_id;
			$prog->prog_name = $this->post["prog_name"];
			$prog->sta_dt = $this->post["sta_dt"];
			$prog->end_dt = $this->post["end_dt"];
			$prog->inst_flag = 1;	//TODO Immediate flag
			
			$arr_prog_playlist_rela = array();
			$arr_prog_playlist_rela[1] = $this->post["ch_1"];
		}
		
		//DB registration (program table)
		if($ret){
			$ret = $this->model->ins_prog($prog);
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
				}
			}
		}
		//Reset DL status
		if($ret){
			$dev_dlLog = new Db_Up();
			$dev_dlLog->dev_id = $dev_id;
			$ret = $this->model->sel_dlLog_up($dev_dlLog);
			if($ret === false){
				break;
			}
		}
		return $this->model->db->end($ret);
	}
	
	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$prog_id = $this->post["prog_id"];
		}catch(Exception $e){
			//TODO Return to the menu screen when the parameter is invalid
			$this->request->redirect();
		}
		
		$prog = null;
		if($this->act === "del"){
			//Delete data
			if($this->chk_token($this->module_name, $this->request->uri()) && $this->del_validation() && $this->del($prog_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->request->uri());
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$prog = $this->model->sel_prog($prog_id);
			if(!empty($prog[0])){
				$prog = $prog[0];
				$prog->arr_playlist = $this->model->sel_arr_playlist_by_prog_id($prog->prog_id);
			} else {
				$prog = null;
			}
		}
		
		//Set value to template
		if(!is_null($prog)){
			$this->template->url = $this->request->uri();
			$this->template->prog_id = $prog_id;
			$this->template->prog = $prog;
			$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		} else {
			//Redirect to list if parameter is invalid
			$this->session->set($this->module_name, array(ACTION_DEL => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->request->uri());
		}
	}
	
	/**
	 * Validation for deletion processing
	 */
	private function del_validation(){
		$ret = true;
		$this->validation = Validation::factory($this->post)
			->rule('prog_id', 'not_empty')
			->rule('prog_id', 'digit')
			->rule('prog_id', 'prog_id')
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
	private function del($prog_id){
		$this->model->db->begin();
		$prog = new Db_Up();
		$prog->prog_id = $this->post["prog_id"];
		$ret = $this->model->del_prog($prog);
		//Reset DL status
		if($ret){
			$dev_dlLog = new Db_Up();
			$dev_dlLog->dev_id = $this->request->param("param1");
			$ret = $this->model->sel_dlLog_up($dev_dlLog);
			if($ret === false){
				break;
			}
		}
		return $this->model->db->end($ret);
	}
}