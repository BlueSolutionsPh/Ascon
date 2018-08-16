<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Util extends Controller_Template {
	/**
	 * Search processing
	 */
	public function action_search(){
		if($this->request->param("param1", false) === false){
			$this->response->status(404);
		}
		parent::action_index_before();
		
		$this->search = new stdClass();
		if(!empty($this->post)){
			foreach($this->post as $key => $val){
				if($key === "disp" || $key === "act"){
					continue;
				}
				$this->search->$key = $val;
				if(preg_match("/_name$/", $key)){
					$arr_key = "arr_" . $key;
					if(isset($val) && $val !== ""){
						$this->search->$arr_key = explode(" ", $val);
					} else {
						$this->search->$arr_key = array();
					}
				} else if(preg_match("/serial_no$/", $key)){
					$arr_key = "arr_" . $key;
					if(isset($val) && $val !== ""){
						$this->search->$arr_key = explode(" ", $val);
					} else {
						$this->search->$arr_key = array();
					}
				} else if(preg_match("/note$/", $key)){
					$arr_key = "arr_" . $key;
					if(isset($val) && $val !== ""){
						$this->search->$arr_key = explode(" ", $val);
					} else {
						$this->search->$arr_key = array();
					}
				}
			}
		}
		$this->search->page = 0;	//TODO Present page fixing
		
		$act = $this->request->param("param1", false);
		switch($act){
			case "dev":
				$arr_dev = Model_Util::sel_arr_dev_shop($this->get_target_client_id(), $this->search);
				$arr_ret_dev = array();
				if(!empty($arr_dev)){
					foreach($arr_dev as $dev){
						$arr_ret_dev[$dev->dev_id] = $dev->dev_name . " (" . $dev->shop_name . ")";
					}
				}
				$this->auto_render = false;
				$this->response->headers("Content-type", "text/xml");
				$this->template = View::factory("util.search.dev.template");
				$this->template->arr_dev = $arr_ret_dev;
				$this->response->body($this->template->render());
				break;
			case "movie":
				$arr_movie = Model_Util::sel_arr_movie_list($this->get_target_client_id(), $this->search);
				$arr_ret_movie = array();
				if(!empty($arr_movie)){
					foreach($arr_movie as $movie){
						$arr_ret_movie[$movie->movie_id] = $movie->movie_name;
					}
				}
				$this->auto_render = false;
				$this->response->headers("Content-type", "text/xml");
				$this->template = View::factory("util.search.movie.template");
				$this->template->arr_movie = $arr_ret_movie;
				$this->response->body($this->template->render());
				break;
		}
	}
}