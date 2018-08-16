<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Playlistall extends Controller_Template {
	private $playlist_name = "";
	private $arr_client_name = array();

	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->model = new Model_Playlistall();
		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
				break;
			default:
				//Template selection
				parent::disp_ins_before();
				$this->disp_ins_seltmpl();
				parent::disp_ins_after();
				break;
		}
	}

	/**
	 * Template selection screen display
	 */
	private function disp_ins_seltmpl(){
		if($this->act === "seltmpl"){
			if($this->ins_seltmpl()){
				//Store in session
				$this->session->set('playlistall.ins_post', $this->post);
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
			if($this->session->get('playlistall.ins_post')){
				$this->post = $this->session->get('playlistall.ins_post');
				$this->session->delete('playlistall.ins_post');
			}
		}

		//Set value to template
		$this->head_add = "head.playlistall.ins.seltmpl.template";
		$this->template->set_filename("playlistall.ins.seltmpl.template");
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->arr_all_draw_tmpl = Controller_Template::get_arr_draw_tmpl();
	}

	/**
	 * Template selection processing
	 */
	private function ins_seltmpl(){
		$ret = true;
		$this->validation = Validation::factory($this->post)
			->rule('playlist_name', 'not_empty')
			->rule('playlist_name', 'max_length', array(':value', '20'))
			->rule('playlist_name', 'all_playlist_name_exists')
			->rule('ants_version', 'not_empty')
			->rule('ants_version', 'digit')
			->rule('ants_version', 'ants_version')
			->rule('draw_tmpl_id', 'not_empty')
			->rule('draw_tmpl_id', 'digit')
			->rule('draw_tmpl_id', 'draw_tmpl_id')
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
		$playlist_ins = $this->session->get('playlistall.ins_post');
		$this->chk_sess_post($playlist_ins);
		try{
			//Prerequisite
			$draw_tmpl_id = $playlist_ins["draw_tmpl_id"];
			$playlist_name = $playlist_ins["playlist_name"];
			$ants_version = $playlist_ins["ants_version"];
		} catch(Exception $e){
			//Illegal operation
			$this->request->redirect($this->module_name);
		}
		if(!in_array($this->act, array('conf', 'back'))){
			if($this->act === "ins"){
				//With data registration
				$this->post = array_merge($this->post, $this->session->get('playlistall.ins_post'));
				if($this->chk_token() && $this->ins_validation() && $this->ins()){
					//Discard session
					$this->session->delete('playlistall.ins_post');

					//In case of success, set display message and redirect to list
					$disp_msg = "<div id=\"msg\"><h3 class=\"title\">登録データ</h3><div class=\"content\"><div style=\"color:#00F;\">";
					$disp_msg .= "<div>プレイリスト名：" . $this->playlist_name . "</div>";
					$disp_msg .= "<div>クライアント名：";
					foreach($this->arr_client_name as $index => $client_name){
						if($index !== 0){
							$disp_msg .= " / ";
						}
						$disp_msg .= $client_name;
					}
					$disp_msg .= "</div></div></div></div>";
					$this->session->set(SESS_IRREGULAR_DISP_MSG, $disp_msg);
					$this->session->set(MODULE_NAME_MENU, array(ACTION_INS => true));
					$this->request->redirect(MODULE_NAME_MENU);
				} else {
					//On failure
					$this->session->set($this->module_name, array(ACTION_INS => false));
				}
			} else if($this->act === "cts_add"){
				//Content addition
				$draw_area_id = $this->post["draw_area_id"];
				if(empty($this->post["cts"])){
					$this->post["cts"] = array();
				}
				if(isset($this->post["cts"][$draw_area_id])){
					array_push($this->post["cts"][$draw_area_id], null);
				} else {
					$this->post["cts"][$draw_area_id] = array();
					array_push($this->post["cts"][$draw_area_id], null);
				}
				$this->post = array_merge($this->session->get('playlistall.ins_post'), $this->post);
			} else if($this->act === "cts_del"){
				//Delete content
				$draw_area_id = $this->post["draw_area_id"];
				$display_order = $this->post["display_order"];
				unset($this->post["cts"][$draw_area_id][$display_order]);
				$this->post["cts"][$draw_area_id] = array_values($this->post["cts"][$draw_area_id]);
				$this->post = array_merge($this->session->get('playlistall.ins_post'), $this->post);
			}
		} else if($this->act === "conf"){
			$ret = true;
			$this->post = array_merge($this->session->get('playlistall.ins_post'), $this->post);
			if($this->ins_validation()){
				//Store in session
				$this->session->set('playlistall.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("playlistall.ins_conf.template");

				//Selected client name set
				if($this->post["target_client"] === "1"){
					//Selected client
					if(!empty($this->post["arr_client"])){
						$arr_client_id = $this->post["arr_client"];
						$arr_client = $this->model->sel_arr_client($arr_client_id);
						if($arr_client){
							foreach($arr_client as $client){
								array_push($this->arr_client_name, $client->client_name);
							}
						} else {
							$ret = false;
						}
					}
					$this->template->arr_client_name = $this->arr_client_name;
				}
			}
		} else if($this->act === "back"){
			//If there is session data set as initial value
			if($this->session->get('playlistall.ins_post')){
				$this->post = $this->session->get('playlistall.ins_post');
			}
		} else {
			//Illegal operation
			$this->request->redirect($this->module_name);
		}
		$draw_tmpl_name = $this->model->sel_draw_tmpl_name($playlist_ins["draw_tmpl_id"]);
		$draw_tmpl_name = $draw_tmpl_name[0]->draw_tmpl_name;
		$arr_tmp_draw_area = $this->model->sel_arr_draw_area_by_draw_tmpl_id($playlist_ins["draw_tmpl_id"]);
		$arr_draw_area = array();
		$arr_ret_all_image = array();
		foreach($arr_tmp_draw_area as $draw_area){
			array_push($arr_draw_area, array("draw_area_id" => $draw_area->draw_area_id, "draw_area_name" => $draw_area->draw_area_name, "cts_type" => $draw_area->cts_type, "rotate_flag" => $draw_area->rotate_flag, "arr_cts" => array()));
			if(!isset($this->post["cts"][$draw_area->draw_area_id])){
				$this->post["cts"][$draw_area->draw_area_id] = array();
				array_push($this->post["cts"][$draw_area->draw_area_id], null);
			}
			Controller_Template::get_arr_common_image($arr_ret_all_image, $draw_area);

			//In the case of a full-screen movie, a still image of the same resolution can be registered as a moving image
			if(count($arr_tmp_draw_area) === 1){
				if((string)$ants_version === (string)ANTS_ONE_KIND){
					$arr_ret_all_movie_image = Controller_Template::get_arr_all_common_movie_image_ants_one($draw_tmpl_id, $draw_area->rotate_flag);
				}else{
					$arr_ret_all_movie_image = Controller_Template::get_arr_common_movie_image($draw_area->draw_size_id, $draw_area->rotate_flag);
				}
			}
		}

		//Set value to template
		$this->head_add = "head.playlistall.ins.template";
		$this->template->playlist_name = $playlist_name;
		$this->template->ants_version = $ants_version;
		$this->template->draw_tmpl_name = $draw_tmpl_name;
		$this->template->arr_draw_area = $arr_draw_area;
		$this->template->arr_all_client = Controller_Template::get_arr_client(false);
		$this->template->arr_all_image = $arr_ret_all_image;
		$this->template->arr_all_movie = Controller_Template::get_arr_common_movie($ants_version);
// 		$this->template->arr_no_rotated_movie = Controller_Template::get_arr_no_rotated_common_movie($ants_version);
// 		$this->template->arr_no_rotated_movie_exclude_swf = Controller_Template::get_arr_no_rotated_common_movie($ants_version,true, true);
// 		$this->template->arr_rotated_movie = Controller_Template::get_arr_rotated_common_movie($ants_version);
// 		$this->template->arr_rotated_movie_exclude_swf = Controller_Template::get_arr_rotated_common_movie($ants_version,true, true);
		if(!empty($arr_ret_all_movie_image)){
			foreach($arr_ret_all_movie_image as $idx => $ret_all_movie_image){
				$this->template->arr_all_movie[$idx] = $ret_all_movie_image;
// 				$this->template->arr_no_rotated_movie[$idx] = $ret_all_movie_image;
// 				$this->template->arr_no_rotated_movie_exclude_swf[$idx] =  $ret_all_movie_image;
// 				$this->template->arr_rotated_movie[$idx] = $ret_all_movie_image;
// 				$this->template->arr_rotated_movie_exclude_swf[$idx] = $ret_all_movie_image;
			}
		}
		$this->template->arr_all_sound = Controller_Template::get_arr_common_sound();
		$this->template->arr_all_text = Controller_Template::get_arr_common_text();
		$this->template->arr_map_img = Controller_Template::get_arr_map_img();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
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
					->rule('playlist_name', 'max_length', array(':value', '20'))
					->rule('playlist_name', 'all_playlist_name_exists')
					->rule('image_intvl', 'not_empty')
					->rule('image_intvl', 'digit')
					->rule('image_intvl', 'positive_int')
					->rule('image_intvl', 'max_length', array(':value', '5'))
					->rule('target_client', 'target_client', array(':validation', 'target_client', 'arr_client'))
					->rule('ants_version', 'not_empty')
					->rule('ants_version', 'digit')
					->rule('ants_version', 'ants_version')
				;
			} else {
				//Template without image
				$this->validation = Validation::factory($this->post)
					->rule('playlist_name', 'not_empty')
					->rule('playlist_name', 'max_length', array(':value', '20'))
					->rule('playlist_name', 'all_playlist_name_exists')
					->rule('image_intvl', 'digit')
					->rule('image_intvl', 'positive_int')
					->rule('image_intvl', 'max_length', array(':value', '5'))
					->rule('target_client', 'target_client', array(':validation', 'target_client', 'arr_client'))
					->rule('ants_version', 'not_empty')
					->rule('ants_version', 'digit')
					->rule('ants_version', 'ants_version')
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
		$playlist_ins = $this->session->get('playlistall.ins_post');
		$playlist_name = $playlist_ins["playlist_name"];
		$draw_tmpl_id = $playlist_ins["draw_tmpl_id"];
		$ants_version = $playlist_ins["ants_version"];

		$arr_client_id = array();
		if($this->post["target_client"] === "0"){
			//All clients
			$arr_client = Model_Util::sel_arr_client();
			foreach($arr_client as $client){
				array_push($arr_client_id, $client->client_id);
				array_push($this->arr_client_name, $client->client_name);
			}
		} else if($this->post["target_client"] === "1"){
			//Selected client
			if(!empty($this->post["arr_client"])){
				$arr_client = $this->model->sel_arr_client($this->post["arr_client"]);
				if($arr_client){
					foreach($arr_client as $client){
						array_push($arr_client_id, $client->client_id);
						array_push($this->arr_client_name, $client->client_name);
					}
				} else {
					$ret = false;
				}
			}
		}

		$this->model->db->begin();
		foreach($arr_client_id as $client_id){
			$playlist_id = $this->model->sel_next_playlist_id();
			if(is_null($playlist_id)){
				$ret = false;
			} else {
				$this->model->client_id = $client_id;
				$playlist = new Db_Ins();
				$playlist->playlist_id = $playlist_id;
				$playlist->draw_tmpl_id = $draw_tmpl_id;
				$playlist->playlist_name = $playlist_name;
				$playlist->playlist_desc = null;
				$playlist->ants_version = $ants_version;
				$playlist->random_flag = 0;
				if(isset($this->post["image_intvl"])){
					$playlist->image_intvl = $this->post["image_intvl"];
				} else {
					$playlist->image_intvl = 0;;
				}

				//Movie, image, text sorting
				$arr_draw_area = $this->model->sel_arr_draw_area_by_draw_tmpl_id($draw_tmpl_id);
				$arr_playlist_movie = array();
				$arr_playlist_image = array();
				$arr_playlist_text = array();
				if(isset($this->post["cts"])){
					$arr_cts = $this->post["cts"];
					foreach($arr_draw_area as $draw_area){
						$i = 0;
						foreach($arr_cts as $draw_area_id => $cts){
							if($draw_area->draw_area_id === $draw_area_id){
								foreach($cts as $display_order => $cts_id){
									if(isset($cts_id) && $cts_id !== ""){
										$tmp_cts = new stdClass();
										$tmp_cts->display_order = $i;
										$i++;
										$tmp_cts->draw_area_id = $draw_area_id;
										switch($draw_area->cts_type){
											case "movie":
												if(strpos($cts_id, "image_") !== false){
													$tmp_cts->image_id = str_replace("image_" , "", $cts_id);
													array_push($arr_playlist_image, $tmp_cts);
												} else {
													$tmp_cts->movie_id = $cts_id;
													array_push($arr_playlist_movie, $tmp_cts);
												}
												break;
											case "sound":
												$tmp_cts->movie_id = $cts_id;
												array_push($arr_playlist_movie, $tmp_cts);
												break;
											case "image":
												$tmp_cts->image_id = $cts_id;
												array_push($arr_playlist_image, $tmp_cts);
												break;
											case "text":
												$tmp_cts->text_id = $cts_id;
												array_push($arr_playlist_text, $tmp_cts);
												break;
										}
									}
								}
							}
						}
					}
				}
			}

			//DB registration (play list)
			if($ret){
				$ret = $this->model->ins_playlist($playlist);
			}

			//DB registration (related to playlist video)
			foreach($arr_playlist_movie as $playlist_movie){
				$playlist_movie_rela = new Db_Ins();
				$playlist_movie_rela->playlist_id = $playlist->playlist_id;
				$playlist_movie_rela->movie_id = $playlist_movie->movie_id;
				$playlist_movie_rela->draw_area_id = $playlist_movie->draw_area_id;
				$playlist_movie_rela->display_order = $playlist_movie->display_order;
				$this->model->ins_playlist_movie_rela($playlist_movie_rela);
			}

			//DB registration (related to playlist image)
			foreach($arr_playlist_image as $playlist_image){
				$playlist_image_rela = new Db_Ins();
				$playlist_image_rela->playlist_id = $playlist->playlist_id;
				$playlist_image_rela->image_id = $playlist_image->image_id;
				$playlist_image_rela->draw_area_id = $playlist_image->draw_area_id;
				$playlist_image_rela->display_order = $playlist_image->display_order;
				$this->model->ins_playlist_image_rela($playlist_image_rela);
			}

			//DB registration (related to playlist text)
			foreach($arr_playlist_text as $playlist_text){
				$playlist_text_rela = new Db_Ins();
				$playlist_text_rela->playlist_id = $playlist->playlist_id;
				$playlist_text_rela->text_id = $playlist_text->text_id;
				$playlist_text_rela->draw_area_id = $playlist_text->draw_area_id;
				$playlist_text_rela->display_order = $playlist_text->display_order;
				$this->model->ins_playlist_text_rela($playlist_text_rela);
			}
		}
		$this->playlist_name = $playlist_name;
		return $this->model->db->end($ret);
	}
}
