<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Loader extends Controller_Template {
	/**
	 * Search processing
	 */
	public function action_js(){
		$js_file_name = $this->request->param("param1", false);
		if($js_file_name === false){
			$this->response->status(404);
		} else {
			$this->auto_render = false;
			$this->template = View::factory($js_file_name . ".js");
			$this->response->headers("Content-type", "application/x-javascript");
			$this->response->body($this->template->render());
		}
	}
}
