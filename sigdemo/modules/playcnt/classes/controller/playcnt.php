<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Playcnt extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		parent::disp_list_before();
		$this->disp_list();
		parent::disp_list_after();
	}

	/**
	 * List screen display
	 */
	private function disp_list(){
		//Always obtain terminal ID from URL
		if($this->request->param("param1", false)){
			$dev_id = $this->request->param("param1");
			$this->post["dev_id"] = $dev_id;

			$playcnt_sta_date = null;
			if(isset($this->post["sta_date"]) && $this->post["sta_date"] !== ""){
				$playcnt_sta_date = $this->post["sta_date"];
			} else {
				$this->post["sta_date"] = "";
			}
			$playcnt_end_date = null;
			if(isset($this->post["end_date"]) && $this->post["end_date"] !== ""){
				$playcnt_end_date = $this->post["end_date"];
			} else {
				$this->post["end_date"] = "";
			}
			$page = null;
			if(isset($this->post["page"]) && $this->post["page"] !== ""){
				$page = $this->post["page"];
			} else {
				$this->post["page"] = "";
			}
		} else {
			//Redirect to menu in case of illegal operation
			$this->request->redirect(MODULE_NAME_MENU);
		}

		$m_playcnt = new Model_Playcnt($this->get_target_client_id());

		//Get a device
		$dev = $m_playcnt->sel_dev($dev_id);
		$dev = $dev[0];
		if(isset($dev->dev_name)){
			//Validation
			$this->post["dt"] = $this->post["end_date"];//Error display dummy
			$this->validation = Validation::factory($this->post)
			->rule('sta_date', 'date')
			->rule('end_date', 'date')
			->rule('sta_date', 'dt_future')
			->rule('dt', 'dt_reverse', array(':validation', 'sta_date', 'end_date'))
			;
			if($this->validation->check()){
				if(isset($playcnt_sta_date)&& isset($playcnt_end_date)){
					//Start end specified
					$sta_year = date("Y", strtotime($playcnt_sta_date));
					$sta_month = date("m", strtotime($playcnt_sta_date));
					$sta_day = date("d", strtotime($playcnt_sta_date));
					$playcnt_sta_dt = date("Y/m/d", mktime(0, 0, 0, $sta_month, $sta_day, $sta_year));
					$end_year = date("Y", strtotime($playcnt_end_date));
					$end_month = date("m", strtotime($playcnt_end_date));
					$end_day = date("d", strtotime($playcnt_end_date));
					$playcnt_end_dt = date("Y/m/d", strtotime("+1 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
				} else if(isset($playcnt_sta_date)&& !isset($playcnt_end_date)){
					//Specify start only
					$sta_year = date("Y", strtotime($playcnt_sta_date));
					$sta_month = date("m", strtotime($playcnt_sta_date));
					$sta_day = date("d", strtotime($playcnt_sta_date));
					$playcnt_sta_dt = date("Y/m/d", mktime(0, 0, 0, $sta_month, $sta_day, $sta_year));
					$end_year = $sta_year;
					$end_month = $sta_month;
					$end_day = $sta_day;
					$playcnt_end_dt = date("Y/m/d", strtotime("+8 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
				} else if(!isset($playcnt_sta_date)&& isset($playcnt_end_date)){
					//Specify end only
					$end_year = date("Y", strtotime($playcnt_end_date));
					$end_month = date("m", strtotime($playcnt_end_date));
					$end_day = date("d", strtotime($playcnt_end_date));
					$playcnt_end_dt = date("Y/m/d", strtotime("+1 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
					$playcnt_sta_dt = date("Y/m/d", strtotime("-7 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
				} else {
					//Start end designation not specified
					$year = date("Y");
					$month = date("m");
					$day = date("d");
					$playcnt_sta_dt = date("Y/m/d", strtotime("-7 day", mktime(0, 0, 0, $month, $day, $year)));
					$playcnt_end_dt = date("Y/m/d", strtotime("+1 day", mktime(0, 0, 0, $month, $day, $year)));
				}

				//Number of cases
				$cts_cnt = $m_playcnt->sel_cnt_contents($dev_id, $playcnt_sta_dt, $playcnt_end_dt);

				//Pagination
				$pagination = Pagination::factory(array(
						'current_page'  => array('source' => 'query_string', 'key' => 'page'),
						'items_per_page' => MAX_CNT_PER_PAGE,
						'total_items'   => $cts_cnt[0]->cnt,
				));
				$offset = $pagination->offset;

				//Data acquisition
				$arr_dev_playcnt = array();
				$arr_tmp_dev_playcnt = $m_playcnt->sel_dev_playcnt_by_dev_id_playcnt_dt($dev_id, $playcnt_sta_dt, $playcnt_end_dt, $offset);

				foreach($arr_tmp_dev_playcnt as $rownum => $tmp_dev_playcnt){
					//Acquire name from file name
					$file_info = pathinfo($tmp_dev_playcnt->play_file_name);
					if(strpos($file_info['filename'],"_480p") === false){
						//When "_480 p" is not included
						$file_name = $file_info['filename'];
					} else {
						//When "_480 p" is included
						$file_name = str_replace("_480p" , "", $file_info['filename']);
					}

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
						$arr_movie_name = $m_playcnt->sel_movie_name_by_file_name($file_name);
						if(!isset($arr_movie_name[0]->movie_name)){
							continue;
						}
						$cts_name = $arr_movie_name[0]->movie_name;
					}
					$arr_dev_playcnt[$rownum] = array();
					$arr_dev_playcnt[$rownum]["cts_name"] = $cts_name;
					$arr_dev_playcnt[$rownum]["extension"] = $file_info['extension'];
					$arr_dev_playcnt[$rownum]["cnt"] = $tmp_dev_playcnt->sum;
				}
			} else {
				$arr_dev_playcnt = array();
				$playcnt_sta_dt = "";
				$playcnt_end_dt = "";
				//Date format invalid
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			}

			//Set value to template
			$this->head_add = "head.playcnt.template";
			$this->template->post = $this->post;
			$this->template->shop_name = $dev->shop_name;
			$this->template->dev_name = $dev->dev_name;
			$this->template->ants_version = $dev->ants_version;
			$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
			$this->template->st_dt = $playcnt_sta_dt;
			if(!empty($playcnt_end_dt)){
				$this->template->end_dt = date("Y/m/d", strtotime("-1 day",strtotime($playcnt_end_dt)));
			} else {
				$this->template->end_dt = "";
			}
			$this->template->arr_dev_playcnt = $arr_dev_playcnt;
			$this->template->arr_error = $this->arr_ret_error;
			if(!empty($pagination)){
				$this->template->pagination = $pagination->render();
			} else {
				$this->template->pagination = "";
			}
		} else {
			//No corresponding terminal
			$this->request->redirect(MODULE_NAME_DEV);
		}
	}
}
