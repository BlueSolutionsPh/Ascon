<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Accesslog extends Controller_Template {
	private $file_name;

	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();

		//Access log display (logged in)
		parent::disp_list_before();
		$this->disp_list();
	}

	/**
	 * Access log display
	 */
	private function disp_list(){
		$this->auto_render = false;
		if($this->request->param("dev_id", false)){
			if(Session::is_admin()){
				$this->model = new Model_Accesslog(null);
			} else {
				$this->model = new Model_Accesslog($this->get_target_client_id());
			}
			$dev_id = $this->request->param("dev_id");
			$dev = $this->model->sel_dev($dev_id);
			if(!empty($dev[0])){
				$dev = $dev[0];
				$client_id_zero_pad = str_pad(strval($dev->client_id), ACCESS_LOG_HTML_FILE_PAD_LEN, "0", STR_PAD_LEFT);
				$dev_id_zero_pad = str_pad(strval($dev_id), ACCESS_LOG_HTML_FILE_PAD_LEN, "0", STR_PAD_LEFT);
				if($this->request->param("file_name", false)){
					$file_name = $this->request->param("file_name");
					$file_exte = ".html";
				} else {
					$file_name = "awstats." . $dev_id_zero_pad;
					$file_exte = ".html";
				}
				$file = ACCESS_LOG_HTML_DIR . $client_id_zero_pad . "/" . $dev_id_zero_pad . "/" . $file_name . $file_exte;
				if(is_file($file)){
					File::echo_file($file);
				} else {
					//Log file absence
					$this->response->status(404);
				}
			} else {
				//Terminal absence
				$this->response->status(404);
			}
		} else {
			//Illegal operation
			$this->response->status(404);
		}
	}
}
