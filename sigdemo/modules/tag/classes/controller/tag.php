<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Tag extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Tag($this->get_target_client_id());
		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
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
		//Data acquisition
		$arr_movie_tag = $this->model->sel_arr_movie_tag();
		$arr_image_tag = $this->model->sel_arr_image_tag();
		$arr_text_tag = $this->model->sel_arr_text_tag();
		$arr_html_tag = $this->model->sel_arr_html_tag();
		$arr_dev_tag = $this->model->sel_arr_dev_tag();
		$arr_shop_tag = $this->model->sel_arr_shop_tag();
		
		//Set value to template
		$this->template->arr_movie_tag = $arr_movie_tag;
		$this->template->arr_image_tag = $arr_image_tag;
		$this->template->arr_text_tag = $arr_text_tag;
		$this->template->arr_html_tag = $arr_html_tag;
		$this->template->arr_dev_tag = $arr_dev_tag;
		$this->template->arr_shop_tag = $arr_shop_tag;
	}
	
	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('tag.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('tag.ins_post');
				
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Store in session
				$this->session->set('tag.ins_post', $this->post);
				
				//Template selection
				$this->template->set_filename("tag.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('tag.ins_post')){
				$this->post = $this->session->get('tag.ins_post');
				$this->session->delete('tag.ins_post');
			}
		}
		//Set value to template
		$this->template->arr_all_tag_cat = Controller_Template::get_arr_tag_cat();
	}
	
	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('tag_cat_id', 'not_empty')
				->rule('tag_name', 'not_empty')
				->rule('tag_name', 'max_length', array(':value', '20'))
				->rule('tag_name', 'tag_name_exists', array(':validation', 'tag_name', 'tag_cat_id'))
			;
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
		$this->model->db->begin();
		$tag = new Db_Ins();
		switch($this->post["tag_cat_id"]){
			case "movie":
				$tag->movie_tag_name = $this->post["tag_name"];
				$ret = $this->model->ins_movie_tag($tag);
				break;
			case "image":
				$tag->image_tag_name = $this->post["tag_name"];
				$ret = $this->model->ins_image_tag($tag);
				break;
			case "text":
				$tag->text_tag_name = $this->post["tag_name"];
				$ret = $this->model->ins_text_tag($tag);
				break;
			case "html":
				$tag->html_tag_name = $this->post["tag_name"];
				$ret = $this->model->ins_html_tag($tag);
				break;
			case "dev":
				$tag->dev_tag_name = $this->post["tag_name"];
				$ret = $this->model->ins_dev_tag($tag);
				break;
			case "shop":
				$tag->shop_tag_name = $this->post["tag_name"];
				$ret = $this->model->ins_shop_tag($tag);
				break;
		}
		return $this->model->db->end($ret);
	}
	
	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$tag_id = $this->post["tag_id"];
			$tag_cat_id = $this->post["tag_cat_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($tag_id, $tag_cat_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			switch($tag_cat_id){
				case "movie":
					$tag = $this->model->sel_movie_tag_name($tag_id);
					break;
				case "image":
					$tag = $this->model->sel_image_tag_name($tag_id);
					break;
				case "text":
					$tag = $this->model->sel_text_tag_name($tag_id);
					break;
				case "html":
					$tag = $this->model->sel_html_tag_name($tag_id);
					break;
				case "dev":
					$tag = $this->model->sel_dev_tag_name($tag_id);
					break;
				case "shop":
					$tag = $this->model->sel_shop_tag_name($tag_id);
					break;
			}
			if(!empty($tag[0])){
				$tag = $tag[0];
			} else {
				$tag = null;
			}
		}
		
		//Set value to template
		if(isset($tag)){
			$this->template->tag_id = $tag_id;
			$this->template->tag_cat_id = $tag_cat_id;
			$this->template->tag_name = $tag->tag_name;
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
			->rule('tag_id', 'not_empty')
			->rule('tag_id', 'digit')
			->rule('tag_id', 'tag_id', array(':validation', 'tag_id', 'tag_cat_id'))
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
	private function del($tag_id, $tag_cat_id){
		$this->model->db->begin();
		$tag = new Db_Up();
		switch($tag_cat_id){
			case "movie":
				$tag->movie_tag_id = $tag_id;
				$ret = $this->model->del_movie_tag($tag);
				break;
			case "image":
				$tag->image_tag_id = $tag_id;
				$ret = $this->model->del_image_tag($tag);
				break;
			case "text":
				$tag->text_tag_id = $tag_id;
				$ret = $this->model->del_text_tag($tag);
				break;
			case "html":
				$tag->html_tag_id = $tag_id;
				$ret = $this->model->del_html_tag($tag);
				break;
			case "dev":
				$tag->dev_tag_id = $tag_id;
				$ret = $this->model->del_dev_tag($tag);
				break;
			case "shop":
				$tag->shop_tag_id = $tag_id;
				$ret = $this->model->del_shop_tag($tag);
				break;
		}
		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$tag_id = $this->post["tag_id"];
			$tag_cat_id = $this->post["tag_cat_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		
		switch($tag_cat_id){
			case "movie":
				$arr_tag = $this->model->sel_arr_movie_tag();
				foreach($arr_tag as $key => $value){
					if($value->movie_tag_id == $tag_id){
						$tag_name = $value->movie_tag_name;
						break;
					}
				}
				break;
			case "image":
				$arr_tag = $this->model->sel_arr_image_tag($tag_id);
				foreach($arr_tag as $key => $value){
					if($value->image_tag_id == $tag_id){
						$tag_name = $value->image_tag_name;
						break;
					}
				}
				break;
			case "text":
				$arr_tag = $this->model->sel_arr_text_tag($tag_id);
				foreach($arr_tag as $key => $value){
					if($value->text_tag_id == $tag_id){
						$tag_name = $value->text_tag_name;
						break;
					}
				}
				break;
			case "html":
				$arr_tag = $this->model->sel_arr_html_tag($tag_id);
				foreach($arr_tag as $key => $value){
					if($value->html_tag_id == $tag_id){
						$tag_name = $value->html_tag_name;
						break;
					}
				}
				break;
			case "dev":
				$arr_tag = $this->model->sel_arr_dev_tag($tag_id);
				foreach($arr_tag as $key => $value){
					if($value->dev_tag_id == $tag_id){
						$tag_name = $value->dev_tag_name;
						break;
					}
				}
				break;
			case "shop":
				$arr_tag = $this->model->sel_arr_shop_tag($tag_id);
				foreach($arr_tag as $key => $value){
					if($value->shop_tag_id == $tag_id){
						$tag_name = $value->shop_tag_name;
						break;
					}
				}
				break;
		}
		if(empty($tag_name)){
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		if($this->act === "up"){
			//With data registration
			$this->post = $this->session->get('tag.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('tag.up_post');
				
				//Redirect to list on successc
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('tag.up_post', $this->post);
				
				//Template selection
				$this->template->set_filename("tag.up_conf.template");
			}
		} else {
			$this->post['tag_id'] = $tag_id;
			$this->post['tag_name'] = $tag_name;
			//If there is session data set as initial value
			if($this->session->get('tag.up_post')){
				$this->post = $this->session->get('tag.up_post');
				$this->session->delete('tag.up_post');
			}
		}
		//Set value to template
		$this->template->arr_all_tag_cat = Controller_Template::get_arr_tag_cat();
	}
	
	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('tag_id', 'not_empty')
				->rule('tag_name', 'not_empty')
				->rule('tag_name', 'max_length', array(':value', '20'))
				->rule('tag_name', 'tag_name_exists', array(':validation', 'tag_name', 'tag_cat_id'))
			;
			if($this->validation->check() === false){
				$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
				$ret = false;
			}
		}
		return $ret;
	}
	
	/**
	 * Update processing
	 */
	private function up(){
		$this->model->db->begin();
		$tag = new Db_Up();
		switch($this->post["tag_cat_id"]){
			case "movie":
				$tag->movie_tag_id = $this->post["tag_id"];
				$tag->movie_tag_name = $this->post["tag_name"];
				$ret = $this->model->up_movie_tag($tag);
				break;
			case "image":
				$tag->image_tag_id = $this->post["tag_id"];
				$tag->image_tag_name = $this->post["tag_name"];
				$ret = $this->model->up_image_tag($tag);
				break;
			case "text":
				$tag->text_tag_id = $this->post["tag_id"];
				$tag->text_tag_name = $this->post["tag_name"];
				$ret = $this->model->up_text_tag($tag);
				break;
			case "html":
				$tag->html_tag_id = $this->post["tag_id"];
				$tag->html_tag_name = $this->post["tag_name"];
				$ret = $this->model->up_html_tag($tag);
				break;
			case "dev":
				$tag->dev_tag_id = $this->post["tag_id"];
				$tag->dev_tag_name = $this->post["tag_name"];
				$ret = $this->model->up_dev_tag($tag);
				break;
			case "shop":
				$tag->shop_tag_id = $this->post["tag_id"];
				$tag->shop_tag_name = $this->post["tag_name"];
				$ret = $this->model->up_shop_tag($tag);
				break;
		}
		return $this->model->db->end($ret);
	}
	
}