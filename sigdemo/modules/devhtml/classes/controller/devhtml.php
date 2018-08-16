<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Devhtml extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Devhtml($this->get_target_client_id());
		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
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
			$arr_ret_devhtml = array();
			$arr_devhtml = $this->model->sel_arr_dev_html_rela($dev->dev_id);
			foreach($arr_devhtml as $devhtml){
				$ret_devhtml = new stdClass();
				$ret_devhtml->dev_html_rela_id = $devhtml->dev_html_rela_id;
				$ret_devhtml->html_name = $devhtml->html_name;
				$ret_devhtml->sta_dt = $devhtml->sta_dt;
				$ret_devhtml->end_dt = $devhtml->end_dt;
				$ret_devhtml->update_user = $this->get_user_name_from_db_user($devhtml->update_user);
				array_push($arr_ret_devhtml, $ret_devhtml);
			}
			$dev->arr_devhtml = $arr_ret_devhtml;
		}

		//Set value to template
		$this->head_add = "head.devhtml.template";
		$this->template->arr_all_dev_tag = Controller_Template::get_arr_dev_tag();
		$this->template->arr_all_shop_tag = Controller_Template::get_arr_shop_tag();
		$this->template->arr_all_shop = Controller_Template::get_arr_shop();
		$this->template->tag_and_or = Controller_Template::get_arr_tag_and_or(false);
		$this->template->arr_dev = $arr_dev;
		$this->template->pagination = $pagination->render();
	}

	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('devhtml.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->session->delete('devhtml.ins_post');
				$this->request->redirect($this->module_name);
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

						//Get terminal names
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
						$devhtml_cnt = $this->model->sel_cnt_devhtml_by_arr_dev_id_sta_dt_end_dt($dev_id, $this->post["sta_dt"], $this->post["end_dt"]);
						$devhtml_cnt = $devhtml_cnt[0];
						$this->post["devhtml_cnt"] = $devhtml_cnt->cnt;

						//Record acquisition
						$arr_tmp_devhtml = array();
						$arr_devhtml = $this->model->sel_arr_devhtml_by_arr_dev_id_sta_dt_end_dt($dev_id, $this->post["sta_dt"], $this->post["end_dt"]);
						foreach($arr_devhtml as $devhtml){
							if($this->post["sta_dt"] <= $devhtml->sta_dt && $devhtml->end_dt <= $this->post["end_dt"]){
								//Deletes as it contains everything
								$devhtml->sta_dt_after = "";
								$devhtml->end_dt_after = "";
							} else if($this->post["sta_dt"] <= $devhtml->sta_dt && $this->post["end_dt"] <= $devhtml->end_dt){
								//Influence only on the start date and time
								$devhtml->sta_dt_after = $this->post["end_dt"];
								$devhtml->end_dt_after = $devhtml->end_dt;
							} else if($devhtml->sta_dt <= $this->post["sta_dt"] && $devhtml->end_dt <= $this->post["end_dt"]){
								//Impact on end date and time only
								$devhtml->sta_dt_after = $devhtml->sta_dt;
								$devhtml->end_dt_after = $this->post["sta_dt"];
							} else if($devhtml->sta_dt <= $this->post["sta_dt"] && $this->post["end_dt"] <= $devhtml->end_dt){
								//Originally it is divided into two, but it affects only the end date and time
								$devhtml->sta_dt_after = $devhtml->sta_dt;
								$devhtml->end_dt_after = $this->post["sta_dt"];
							}

							$html_name = $this->model->sel_html_name_by_html_id($devhtml->html_id);
							if(!empty($html_name[0])){
								$html_name = $html_name[0];
							} else {
								$html_name = new stdClass();
								$html_name->html_name = "";
							}
							array_push($arr_tmp_devhtml, array("dev_html_rela_id" => $devhtml->dev_html_rela_id, "sta_dt" => $devhtml->sta_dt, "sta_dt_after" => $devhtml->sta_dt_after, "end_dt" => $devhtml->end_dt, "end_dt_after" => $devhtml->end_dt_after, "html_name" => $html_name->html_name));
						}
						$effe_rec["arr_devhtml"] = $arr_tmp_devhtml;
						array_push($arr_effe_rec, $effe_rec);
					}
				}

				//Store in session
				$this->session->set('devhtml.ins_post', $this->post);

				//Template selection
				$this->template->set_filename("devhtml.ins_conf.template");
				$this->template->arr_effe_rec = $arr_effe_rec;
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('devhtml.ins_post')){
				$this->post = $this->session->get('devhtml.ins_post');
				$this->session->delete('devhtml.ins_post');
			}
		}

		$arr_ret_dev = array();
		$arr_sel_dev = array();
		$arr_dev = $this->model->sel_arr_dev_shop();
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

		//Set value to template
		$this->head_add = "head.devhtml.ins.template";
		$this->template->arr_all_html = Controller_Template::get_arr_html();
		$this->template->arr_all_tag = Controller_Template::get_arr_dev_tag();
		$this->template->arr_all_dev = $arr_ret_dev;
		$this->template->arr_sel_dev = $arr_sel_dev;
	}

	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->post["dt"] = $this->post["sta_dt"];	//Dummy data for error display
			$this->validation = Validation::factory($this->post)
				->rule('arr_dev', 'not_empty')
				->rule('dev_html_rela_name', 'not_empty')
				->rule('dev_html_rela_name', 'max_length', array(':value', '20'))
				->rule('sta_dt', 'not_empty')
				->rule('sta_dt', 'date')
				->rule('sta_dt', 'dt_equal', array(':validation', 'sta_dt', 'end_dt'))
				->rule('sta_dt', 'dt_reverse', array(':validation', 'sta_dt', 'end_dt'))
				->rule('end_dt', 'not_empty')
				->rule('end_dt', 'date')
				->rule('end_dt', 'dt_past')
				->rule('html', 'not_empty')
				->rule('html', 'digit')
				->rule('html', 'html_id')
			;
			if(!isset($this->post["over_write"]) || $this->post["over_write"] !== "true"){
				$this->validation = $this->validation
				->rule('dt', 'dev_html_rela_dt_exists', array(':validation', 'arr_dev', 'sta_dt', 'end_dt'))
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
		$this->model->db->begin();
		$arr_dev = array();

		//Distribution by terminal
		if(isset($this->post["arr_dev"])){
			$this->post["arr_dev"] = array_unique($this->post["arr_dev"]);
		}
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
			//DB update
			$arr_devhtml = $this->model->sel_arr_devhtml_by_arr_dev_id_sta_dt_end_dt($dev->dev_id, $this->post["sta_dt"], $this->post["end_dt"], false);
			foreach($arr_devhtml as $devhtml){
				$devhtml_db = new Db_Up();
				if($this->post["sta_dt"] <= $devhtml->sta_dt && $devhtml->end_dt <= $this->post["end_dt"]){
					//Deletes as it contains everything
					$devhtml_db->dev_html_rela_id = $devhtml->dev_html_rela_id;
					$ret = $this->model->del_dev_html_rela($devhtml_db);
				} else if($this->post["sta_dt"] <= $devhtml->sta_dt && $this->post["end_dt"] <= $devhtml->end_dt){
					//Influence only on the start date and time
					$devhtml_db->dev_html_rela_id = $devhtml->dev_html_rela_id;
					$devhtml_db->sta_dt = $this->post["end_dt"];
					$devhtml_db->end_dt = $devhtml->end_dt;
					$ret = $this->model->up_dev_html_rela($devhtml_db);
				} else if($devhtml->sta_dt <= $this->post["sta_dt"] && $devhtml->end_dt <= $this->post["end_dt"]){
					//Impact on end date and time only
					$devhtml_db->dev_html_rela_id = $devhtml->dev_html_rela_id;
					$devhtml_db->sta_dt = $devhtml->sta_dt;
					$devhtml_db->end_dt = $this->post["sta_dt"];
					$ret = $this->model->up_dev_html_rela($devhtml_db);
				} else if($devhtml->sta_dt <= $this->post["sta_dt"] && $this->post["end_dt"] <= $devhtml->end_dt){
					//Originally it is divided into two, but it affects only the end date and time
					$devhtml_db->dev_html_rela_id = $devhtml->dev_html_rela_id;
					$devhtml_db->sta_dt = $devhtml->sta_dt;
					$devhtml_db->end_dt = $this->post["sta_dt"];
					$ret = $this->model->up_dev_html_rela($devhtml_db);
				}
			}

			$devhtml = new Db_Ins();
			$devhtml->dev_id = $dev->dev_id;
			$devhtml->dev_html_rela_name = $this->post["dev_html_rela_name"];
			$devhtml->html_id = $this->post["html"];
			$devhtml->sta_dt = $this->post["sta_dt"];
			$devhtml->end_dt = Text::chk_str($this->post, "end_dt", null);
			$devhtml->inst_flag = 1;	//TODO Immediate flag

			// DB registration (terminal HTML related)
			if($ret){
				$ret = $this->model->ins_dev_html_rela($devhtml);
				if($ret === false){
					break;
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
			$dev_html_rela_id = $this->post["dev_html_rela_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($dev_html_rela_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$dev_html_rela = $this->model->sel_dev_html_rela($dev_html_rela_id);
			if(!empty($dev_html_rela[0])){
				$dev_html_rela = $dev_html_rela[0];
			} else {
				$dev_html_rela = null;
			}
		}

		//Set value to template
		if(!is_null($dev_html_rela)){
			$this->template->dev_html_rela_id = $dev_html_rela->dev_html_rela_id;
			$this->template->dev_html_rela = $dev_html_rela;
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
			->rule('dev_html_rela_id', 'not_empty')
			->rule('dev_html_rela_id', 'digit')
			->rule('dev_html_rela_id', 'dev_html_rela_id')
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
	private function del($dev_html_rela_id){
		$ret = false;
		$this->model->db->begin();
		$devhtml = new Db_Up();
		$devhtml->dev_html_rela_id = $dev_html_rela_id;
		$ret = $this->model->del_dev_html_rela($devhtml);
		return $this->model->db->end($ret);
	}

	/**
	 * Delete screen display
	 */
	private function disp_lump_del(){
		try{
			$temp_buff =  $this->post["chk_devhtml"];
			$loop_cnt = count($temp_buff);
			$arr_devhtml_name = null;
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}

		for($i=0;$i<$loop_cnt;$i++){
			try{
				$dev_html_rela_id = $this->post["chk_devhtml"][$i];
			}catch(Exception $e){
				//When parameter invalid, return to the list screen
				$this->request->redirect($this->module_name);
			}
			if($this->act === "lump_del"){
				//Delete data
				if($this->chk_token() && $this->lump_del_validation() && $this->lump_del($dev_html_rela_id)){
					//Redirect to list on success
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => true));
					$this->request->redirect($this->module_name);
				} else {
					//Data registration failure display
					$this->session->set($this->module_name, array(ACTION_LUMP_DEL => false));
				}
			} else {
				//display
				$dev_html_rela = $this->model->sel_dev_html_rela($dev_html_rela_id);
				if(!empty($dev_html_rela[0])){
					$dev_html_rela = $dev_html_rela[0];
					$arr_devhtml_name[$i] = $dev_html_rela;
					$arr_devhtml_id[$i] = $dev_html_rela->dev_html_rela_id;
				} else {
					$dev_html_rela = null;
				}
			}
		}
		//Set value to template
		if(!is_null($dev_html_rela)){
			$this->template->dev_html_rela_id = $arr_devhtml_id;
			$this->template->dev_html_rela = $arr_devhtml_name;
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
			->rule('chk_devhtml', 'not_empty')
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
	private function lump_del($dev_html_rela_id){
		$ret = false;
		$this->model->db->begin();
		$devhtml = new Db_Up();

		$del_cnt = count($this->post["chk_devhtml"]);

		for($i=0;$i<$del_cnt;$i++){
			$devhtml->dev_html_rela_id = $this->post["chk_devhtml"][$i];
			$ret = $this->model->del_dev_html_rela($devhtml);
		}
		return $this->model->db->end($ret);
	}
}
