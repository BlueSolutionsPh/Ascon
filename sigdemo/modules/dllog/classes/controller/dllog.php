<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Dllog extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index()
	{
		parent::action_index_before();

		parent::disp_list_before();
		$this->disp_list();
		parent::disp_list_after();
	}

	/**
	 * List screen display
	 */
	private function disp_list()
	{
		//Always obtain terminal ID from URL
		if($this->request->param("param1", false)){
			$dev_id = $this->request->param("param1");
			$this->post["dev_id"] = $dev_id;

			$dl_sta_date = null;
			if(isset($this->post["sta_date"]) && $this->post["sta_date"] !== ""){
				$dl_sta_date = $this->post["sta_date"];
			} else {
				$this->post["sta_date"] = "";
			}
			$dl_end_date = null;
			if(isset($this->post["end_date"]) && $this->post["end_date"] !== ""){
				$dl_end_date = $this->post["end_date"];
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

		$arr_dl_log = array();
		$model_dllog = new Model_Dllog($this->get_target_client_id());

		$dev = $model_dllog->sel_dev($dev_id);
		$dev = $dev[0];
		if(isset($dev->dev_name)){
			//Validation
			$this->post["dt"] = $this->post["end_date"];//Error display dummy
			$this->validation = Validation::factory($this->post)
				->rule('sta_date', 'date')
				->rule('end_date', 'date')
				->rule('sta_date', 'dt_future')
//				->rule('dt', 'dt_equal', array(':validation', 'sta_date', 'end_date'))
				->rule('dt', 'dt_reverse', array(':validation', 'sta_date', 'end_date'))
			;
			if($this->validation->check()){
				if(isset($dl_sta_date)&& isset($dl_end_date)){
					//Start end specified
					$sta_year = date("Y", strtotime($dl_sta_date));
					$sta_month = date("m", strtotime($dl_sta_date));
					$sta_day = date("d", strtotime($dl_sta_date));
					$dl_sta_dt = date("Y/m/d", mktime(0, 0, 0, $sta_month, $sta_day, $sta_year));
					$end_year = date("Y", strtotime($dl_sta_date));
					$end_month = date("m", strtotime($dl_end_date));
					$end_day = date("d", strtotime($dl_end_date));
					$dl_end_dt = date("Y/m/d", strtotime("+1 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
				} else if(isset($dl_sta_date)&& !isset($dl_end_date)){
					//Specify start only
					$sta_year = date("Y", strtotime($dl_sta_date));
					$sta_month = date("m", strtotime($dl_sta_date));
					$sta_day = date("d", strtotime($dl_sta_date));
					$dl_sta_dt = date("Y/m/d", mktime(0, 0, 0, $sta_month, $sta_day, $sta_year));
					$end_year = $sta_year;
					$end_month = $sta_month;
					$end_day = $sta_day;
					$dl_end_dt = date("Y/m/d", strtotime("+8 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
				} else if(!isset($dl_sta_date)&& isset($dl_end_date)){
					//Specify end only
					$end_year = date("Y", strtotime($dl_end_date));
					$end_month = date("m", strtotime($dl_end_date));
					$end_day = date("d", strtotime($dl_end_date));
					$dl_end_dt = date("Y/m/d", strtotime("+1 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
					$dl_sta_dt = date("Y/m/d", strtotime("-7 day", mktime(0, 0, 0, $end_month, $end_day, $end_year)));
				} else {
					//Start end designation not specified
					$year = date("Y");
					$month = date("m");
					$day = date("d");
					$dl_sta_dt = date("Y/m/d", strtotime("-7 day", mktime(0, 0, 0, $month, $day, $year)));
					$dl_end_dt = date("Y/m/d", strtotime("+1 day", mktime(0, 0, 0, $month, $day, $year)));
				}

				//Acquisition of data number
				$arr_dev_html_rela_dl_log_cnt = $model_dllog->sel_cnt_dev_html_rela_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt);
				$arr_dev_prog_dl_log_cnt = $model_dllog->sel_cnt_dev_prog_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt);
				$cnt = max($arr_dev_html_rela_dl_log_cnt[0]->cnt, $arr_dev_prog_dl_log_cnt[0]->cnt);

				//Pagination
				$pagination = Pagination::factory(array(
					'current_page'  => array('source' => 'query_string', 'key' => 'page'),
					'items_per_page' => MAX_CNT_PER_PAGE,
					'total_items'   => $cnt,
				));

				//Data acquisition
				$offset = $pagination->offset;
				$arr_dev_html_rela_dl_log = $model_dllog->sel_arr_dev_html_rela_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt, $offset);
				$arr_dev_prog_dl_log = $model_dllog->sel_arr_dev_prog_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt, $offset);

				foreach($arr_dev_html_rela_dl_log as $rownum => $dev_html_rela_dl_log){
					$arr_dl_log[$rownum] = array();
					if(isset($dev_html_rela_dl_log->sta_dt)){
						$sta_dow = date("w", strtotime($dev_html_rela_dl_log->sta_dt));
						$dev_html_rela_dl_log->sta_dt = substr($dev_html_rela_dl_log->sta_dt, 0, 10) . "(" . Text::get_japanese_day_of_week($sta_dow) . ")" .substr($dev_html_rela_dl_log->sta_dt, 10);
					}
					if(isset($dev_html_rela_dl_log->end_dt)){
						$end_dow = date("w", strtotime($dev_html_rela_dl_log->end_dt));
						$dev_html_rela_dl_log->end_dt = substr($dev_html_rela_dl_log->end_dt, 0, 10) . "(" . Text::get_japanese_day_of_week($end_dow) . ")" .substr($dev_html_rela_dl_log->end_dt, 10);
					}
					$arr_dl_log[$rownum]["html"] = $dev_html_rela_dl_log;
				}
				foreach($arr_dev_prog_dl_log as $rownum => $dev_prog_dl_log){
					if(!isset($arr_dl_log[$rownum])){
						$arr_dl_log[$rownum] = array();
					}
					if(isset($dev_prog_dl_log->sta_dt)){
						$sta_dow = date("w", strtotime($dev_prog_dl_log->sta_dt));
						$dev_prog_dl_log->sta_dt = substr($dev_prog_dl_log->sta_dt, 0, 10) . "(" . Text::get_japanese_day_of_week($sta_dow) . ")" .substr($dev_prog_dl_log->sta_dt, 10);
					}
					if(isset($dev_prog_dl_log->end_dt)){
						$end_dow = date("w", strtotime($dev_prog_dl_log->end_dt));
						$dev_prog_dl_log->end_dt = substr($dev_prog_dl_log->end_dt, 0, 10) . "(" . Text::get_japanese_day_of_week($end_dow) . ")" .substr($dev_prog_dl_log->end_dt, 10);
					}
					$arr_dl_log[$rownum]["prog"] = $dev_prog_dl_log;
				}
			} else {
				//Date format invalid
				$arr_dev_html_rela_dl_log = array();
				$arr_dev_prog_dl_log = array();
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			}

			//Set value to template
			$this->head_add = "head.dllog.template";
			$this->template->post = $this->post;
			$this->template->shop_name = $dev->shop_name;
			$this->template->dev_name = $dev->dev_name;
			$this->template->arr_dl_log = $arr_dl_log;
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
