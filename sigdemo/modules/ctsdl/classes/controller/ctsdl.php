<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ctsdl extends Controller_Template {
	private $file_name;

	/**
	 * Main controller
	 */
	public function action_index(){
		if(Auth::instance()->logged_in() !== true){
			//404 if you are not logged in
			$this->auto_render = false;
			$this->response->status(404);
		} else {
			//Content file download (logged in)
			$this->cts_dl();
		}
	}

	/**
	 * Content file download
	 */
	private function cts_dl(){
		$this->auto_render = false;
		if($this->request->param("file_name", false) && $this->request->param("file_exte", false) && $this->request->param("cts_cat", false)){
			if(Session::is_admin()){
				$this->model = new Model_Ctsdl(null);
			} else {
				$this->model = new Model_Ctsdl($this->get_target_client_id());
			}
			$cts_cat = $this->request->param("cts_cat");
			$file_name = $this->request->param("file_name");
			$file_exte = "." . $this->request->param("file_exte");

			//Confirm that the file exists
			if($cts_cat === "movie"){
				$cts = $this->model->sel_arr_movie_by_file_name_exte($file_name, $file_exte);
			} else if($cts_cat === "image"){
				$cts = $this->model->sel_arr_image_by_file_name_exte($file_name, $file_exte);
			} else if($cts_cat === "html"){
				$cts = $this->model->sel_arr_html_by_file_name_exte($file_name, $file_exte);
			} else {
				//Illegal operation
				$this->response->status(404);
			}
			if(!empty($cts[0])){
				//File return
				$cts = $cts[0];
				$file = ORIG_FILE_DIR . $cts->orig_file_dir . $file_name . $file_exte;
				if(is_file($file)){
					header("Content-type: application/octet-stream");
					File::echo_file($file);
				} else {
					//Invalid file
					$this->response->status(404);
				}
			} else {
				//Invalid file
				$this->response->status(404);
			}
		} else {
			//Illegal operation
			$this->response->status(404);
		}
	}
}
