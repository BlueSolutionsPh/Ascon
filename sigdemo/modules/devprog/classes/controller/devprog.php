<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Devprog extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){

		$val = trim(ini_get('memory_limit'));
		$last = strtolower($val[strlen($val)-1]);
		if($last == 'g')
			$val = $val*1024*1024*1024;
		if($last == 'm')
			$val = $val*1024*1024;
		if($last == 'k')
			$val = $val*1024;
		if($val < 256*1024*1024)
			ini_set('memory_limit', '256M');

		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Devprog($this->get_target_client_id());
		if($this->disp === "progview"){
			//Screen transition
			$this->disp_progview();
		}
		//Normal display
		parent::disp_list_before();
		$this->disp_list();
		parent::disp_list_after();
	}


	/**
	 * List screen display
	 */
	private function disp_list(){
		if(SERVICE_ANTS_ONE_ENABLE === false){
			$this->search->ants_version = ANTS_TWO_KIND;
		}

		//Set value to template
		// Set today's year, month, day
		$year  = date("Y");
		$month = date("m");
		$day   = date("d");

		// When date and time are specified, change from that date as a base point
		if(isset($this->search->devprog_date) && $this->search->devprog_date !== ""){
			// If the date is specified as the search target, designate that day as the start date
			list($year, $month, $day) = explode('-', $this->search->devprog_date);
		}

		//Set today, or year, month, day of the designated date + 7 days
		$arr_date = array();
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)), date("m/d", mktime(0, 0, 0, $month, $day, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day, $year)))));
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day + 1, $year)), date("m/d", mktime(0, 0, 0, $month, $day + 1, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day + 1, $year)))));
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day + 2, $year)), date("m/d", mktime(0, 0, 0, $month, $day + 2, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day + 2, $year)))));
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day + 3, $year)), date("m/d", mktime(0, 0, 0, $month, $day + 3, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day + 3, $year)))));
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day + 4, $year)), date("m/d", mktime(0, 0, 0, $month, $day + 4, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day + 4, $year)))));
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day + 5, $year)), date("m/d", mktime(0, 0, 0, $month, $day + 5, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day + 5, $year)))));
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day + 6, $year)), date("m/d", mktime(0, 0, 0, $month, $day + 6, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day + 6, $year)))));
		array_push($arr_date, array(date("Y-m-d", mktime(0, 0, 0, $month, $day + 7, $year)), date("m/d", mktime(0, 0, 0, $month, $day + 7, $year)), Text::get_japanese_day_of_week(date("w", mktime(0, 0, 0, $month, $day + 7, $year)))));


		$data_table = array( 0 => array(), array(),
												array(), array(),
												array(), array(),
												array(), array(),
												array(), array(),
												array(), array(),
												array(), array(),
												array(), array(),
											);


	// Get common playlist

		$this->search->offset = $pagination->offset;
		$this->search->commonplaylist = 1;
		$this->search->sta_dt = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)) . " 00:00:00";
		$this->search->end_dt = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)) . " 23:59:59";

		//Acquisition of data number
		$cm_all_playlist_cnt = $this->model->sel_cnt_playlist($this->search);

		//Pagination
		$pagination = Pagination::factory(array(
			'current_page'  => array('source' => 'query_string', 'key' => 'page'),
			'items_per_page' => MAX_CNT_PER_PAGE,
			'total_items'   => $cm_all_playlist_cnt[0]->cnt,
		));

		//Data acquisition
		$cm_arr_playlist = $this->model->sel_arr_playlist($this->search);
//echo '<pre>';var_dump($cm_arr_playlist);exit;
		$cms_search = new stdClass;
		$cms_search->offset = 0;
		$cms_search->commonplaylist = true;
		$cms_search->sta_dt = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)) . " 00:00:00";
		$cms_search->end_dt = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year)) . " 23:59:59";
		$cm_arr_all_playlist = $this->model->sel_arr_playlist($cms_search);

		$this->template->arr_playlist = array();
		$this->template->arr_playlist[""] = "";
		foreach($cm_arr_all_playlist as $playlist){
			$this->template->arr_playlist[$playlist->playlist_id] = $playlist->playlist_name;
		}
	// Retrieve the playlist list by contract client

		// Fixed the "whole day" time zone.
		$b_search = new stdClass;
		$b_search->offset = 0;
		$b_search->extraplaylist = 1;

		//Acquisition of data number
		$all_playlist_cnt = $this->model->sel_cnt_playlist($b_search);

		$day_count=0;
		$array_cnt = 0;
		$cm_client_id = 0;

		$arr_x = array();
		$arr_y = array();

		$cnt = 0;

		// Get client type
		$arr_all_client = $this->model->sel_arr_id_name();


		// Repeat for seven days
		foreach ($arr_date as $date){

			// Repeat for the number of clients
			foreach ($arr_all_client as $clients){
				$s_client_id   = $clients->client_id;
				$s_client_name = $clients->client_name;

				$cm_search = new stdClass;
				$cm_search->offset = 0;
				$cm_search->sta_dt = $date[0] . " 00:00:00";
				$cm_search->end_dt = $date[0] . " 23:59:59";
				$cm_search->sex_id = $this->search->sex_id;

				//Data acquisition (Acquire common playlist of target date)
				$cm_search->commonplaylist = 1;
				$cm_playlist_week_cnt   = $this->model->sel_cnt_playlist($cm_search);

				// Acquire a list of "common playlists" corresponding to the corresponding dates
				// Since there is no element that can specify sex and time, multiple items can be acquired
				$cm_playlist_week       = $this->model->sel_arr_playlist($cm_search);

				//Acquire data (Get individual playlist of target date)
				$search = new stdClass;
				$search->offset        = $pagination->offset;
				$search->extraplaylist = true;
				$search->client_id     = $s_client_id;

				$search->sta_dt        = $date[0] . " 00:00:00";
				$search->end_dt        = $date[0] . " 23:59:59";
				// Acquire "Individual Playlist" corresponding to the relevant date (only when acquiring period overlap prevention processing, acquire only one)

				$ot_playlist_week       = $this->model->sel_arr_playlist_extra($search);
				$x = 0;
				// Repeat for a list of common playlists
				foreach ($cm_playlist_week as $cm_playlist){

					$x++;
					$ret_prog_post = new stdClass;
					$ret_prog_post->sta_dt               = $cm_playlist->sta_dt;
					$ret_prog_post->end_dt               = $cm_playlist->end_dt;
					$ret_prog_post->client_id            = $s_client_id;
					$ret_prog_post->client_name          = $s_clientt_name;
					$ret_prog_post->sex_id               = $cm_playlist->sex_id;
					$ret_prog_post->timezone_id          = $cm_playlist->timezone_id;
					$ret_prog_post->common_playlist_name = $cm_playlist->playlist_name;

					// If there is no individual playlist, only the common playlist is registered
					if( count($ot_playlist_week) == 0 ){
						// $ret_prog_post->playlist_name = null;
						// $ret_prog_post->client_name = $s_clientt_name;
						$ret_prog_post->cnt           = $x;

						if(9 > $day_count){
							if(1000 > count($data_table[$day_count*2])){
								array_push($data_table[$day_count*2], $ret_prog_post);
							} else{
								array_push($data_table[$day_count*2+1], $ret_prog_post);
							}
							$arr_x[] = end($arr_y);
						}
					} else {
						// Repeat for individual playlists (once only)
						foreach ($ot_playlist_week as $ot_playlist){
							$ret_prog_post->playlist_id   = $ot_playlist->playlist_id;
							$ret_prog_post->playlist_name = $ot_playlist->playlist_name;
							$ret_prog_post->client_name   = $ot_playlist->client_name;
							$ret_prog_post->cnt           = $x;

							array_push($data_table[$day_count*2], $ret_prog_post);
							$arr_x[] = end($arr_y);

						} // foreach ($ot_playlist_week as $ot_playlist){

					} // if( $ot_playlist_week_cnt == 0 ){

				} // foreach ($cm_playlist_week as $cm_playlist){

			} // foreach ($arr_all_client as $client){
			$day_count++;
		} // Loop for 7 days

		$this->template->arr_1st_line_prog = $data_table[0];
		$this->template->arr_2nd_line_prog = $data_table[2];
		$this->template->arr_3rd_line_prog = $data_table[4];
		$this->template->arr_4st_line_prog = $data_table[6];
		$this->template->arr_5st_line_prog = $data_table[8];
		$this->template->arr_6st_line_prog = $data_table[10];
		$this->template->arr_7st_line_prog = $data_table[12];
		$this->template->arr_8st_line_prog = $data_table[14];

		$this->template->arr_1st_line2_prog = $data_table[1];
		$this->template->arr_2nd_line2_prog = $data_table[3];
		$this->template->arr_3rd_line2_prog = $data_table[5];
		$this->template->arr_4st_line2_prog = $data_table[7];
		$this->template->arr_5st_line2_prog = $data_table[9];
		$this->template->arr_6st_line2_prog = $data_table[11];
		$this->template->arr_7st_line2_prog = $data_table[13];
		$this->template->arr_8st_line2_prog = $data_table[15];

		//Set value to template
		$this->head_add = "head.devprog.template";
		$this->template->arr_date             = $arr_date;
//		$this->template->arr_x                = $arr_y;
		$this->template->arr_all_dev_tag      = Controller_Template::get_arr_dev_tag();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->arr_all_shop_tag     = Controller_Template::get_arr_shop_tag();
		$this->template->arr_all_shop         = Controller_Template::get_arr_shop();
		$this->template->tag_and_or           = Controller_Template::get_arr_tag_and_or(false);
		$this->template->all_playlist_cnt     = $cm_all_playlist_cnt[0]->cnt;
		$this->template->arr_all_client       = $arr_all_client;

		$this->template->arr_all_playlist     = $cm_arr_playlist;
		$this->template->arr_all_draw_tmpl    = Controller_Template::get_arr_draw_tmpl();
		$this->template->arr_all_ants_version = Controller_Template::get_arr_ants_version();
		$this->template->arr_delivery_month   = Controller_Template::get_arr_delivery_month();
/*
		$arr_time_zone = array();
		$sel_all_time_zone = Controller_Template::get_arr_time_zone(false);
		$arr_time_zone[0] = "";
		$i = 1;
		foreach($sel_all_time_zone as $time_zone){
			if ( $time_zone != "全日" ){
				$arr_time_zone[$i] = $time_zone;
			}
			$i++;
		}
*/
		$this->template->arr_time_zone        = Controller_Template::get_arr_time_zone();
		$this->template->arr_sex              = Controller_Template::get_arr_sex();
		$this->template->pagination           = $pagination->render();


	}

	/**
	 * Display registration screen
	 */
	private function disp_progview(){
		//Formatting for search
		if(isset($this->post["tmp_prog_date"]) && $this->post["tmp_prog_date"] !== ""){
			$this->post["prog_date"] = str_replace("/", "-", $this->post["tmp_prog_date"]);
			$this->post["prog_date"] = $this->post["prog_date"];
		}

		//Validation
		$this->validation = Validation::factory($this->post)
			->rule('dev_id', 'not_empty')
			->rule('tmp_prog_date', 'not_empty')
			->rule('prog_date', 'date')
		;
		if($this->validation->check()){
			//Validation OK
			$dev_id = $this->post["dev_id"];
			$prog_date = $this->post["prog_date"];
			$this->request->redirect(MODULE_NAME_PROGVIEW . "/index/" . $dev_id . "/" . $prog_date);
		} else {
			//Validation NG
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			parent::disp_list_before();
			$this->disp_list();
			parent::disp_list_after();
		}
	}
}
