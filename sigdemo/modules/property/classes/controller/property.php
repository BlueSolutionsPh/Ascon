<?php defined('SYSPATH') or die('No direct script access.');

class Controller_property extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Property($this->get_target_client_id());
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
		$arr_property = $this->model->sel_arr_property();
		
		//Set value to template
		$this->template->arr_property = $arr_property;
	}
	
	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('property.ins_post');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('property.ins_post');
				
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
				$this->session->set('property.ins_post', $this->post);
				
				//Template selection
				$this->template->set_filename("property.ins_conf.template");
			}
		} else {
			//If there is session data set as initial value
			if($this->session->get('property.ins_post')){
				$this->post = $this->session->get('property.ins_post');
				$this->session->delete('property.ins_post');
			}
		}
	}
	
	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('property_name', 'not_empty')
				->rule('property_name', 'max_length', array(':value', '40'))
				->rule('property_name', 'property_name_exists', array(':validation', 'property_name'))
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
		$property = new Db_Ins();
		$property->property_name = $this->post["property_name"];
		$ret = $this->model->ins_property($property);
		return $this->model->db->end($ret);
	}
	
	/**
	 * Delete screen display
	 */
	private function disp_del(){
		try{
			$property_id = $this->post["property_id"];
		}catch(Exception $e){
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		if($this->act === "del"){
			//Delete data
			if($this->chk_token() && $this->del_validation() && $this->del($property_id)){
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_DEL => true));
				$this->request->redirect($this->module_name);
			} else {
				//Data registration failure display
				$this->session->set($this->module_name, array(ACTION_DEL => false));
			}
		} else {
			//display
			$property = $this->model->sel_property_name($property_id);

			if(!empty($property[0])){
				$property = $property[0];
			} else {
				$property = null;
			}
		}
		
		//Set value to template
		if(isset($property)){
			$this->template->property_id = $property_id;
			$this->template->property_name = $property->property_name;
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
			->rule('property_id', 'not_empty')
			->rule('property_id', 'digit')
			->rule('property_id', 'property_id', array(':validation', 'property_id'))
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
	private function del($property_id){
		$this->model->db->begin();
		$property = new Db_Up();
		$property->property_id = $property_id;
		$ret = $this->model->del_property($property);

		return $this->model->db->end($ret);
	}

	/**
	 * Update screen display
	 */
	private function disp_up(){
		try{
			$property_id = $this->post["property_id"];
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			//When parameter invalid, return to the list screen
			$this->request->redirect($this->module_name);
		}
		
		$arr = $this->model->sel_arr_property();
		foreach($arr as $key => $value){
			if($value->property_id == $property_id){
				$property_name = $value->property_name;
				break;
			}
		}
		if(empty($property_name)){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		if($this->act === "up"){
			//With data registration
			$this->post = $this->session->get('property.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('property.up_post');
				
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('property.up_post', $this->post);
				
				//Template selection
				$this->template->set_filename("property.up_conf.template");
			}
		} else {
			$this->post['property_id'] = $property_id;
			$this->post['property_name'] = $property_name;
			//If there is session data set as initial value
			if($this->session->get('property.up_post')){
				$this->post = $this->session->get('property.up_post');
				$this->session->delete('property.up_post');
			}
		}
	}
	
	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		if($ret){
			$this->validation = Validation::factory($this->post)
				->rule('property_id', 'not_empty')
				->rule('property_name', 'not_empty')
				->rule('property_name', 'max_length', array(':value', '40'))
				->rule('property_name', 'property_name_exists', array(':validation', 'property_name'))
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
		$property = new Db_Up();
		$property->property_id = $this->post["property_id"];
		$property->property_name = $this->post["property_name"];
		$ret = $this->model->up_property($property);

		return $this->model->db->end($ret);
	}
	
}