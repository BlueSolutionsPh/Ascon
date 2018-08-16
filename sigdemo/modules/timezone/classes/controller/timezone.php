<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Timezone extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Timezone($this->get_target_client_id());
		switch($this->disp){
			default:
				//update
				parent::disp_up_before();
				$this->disp_up();
				parent::disp_up_after();
				break;
		}
	}
	
	
	/**
	 * Update screen display
	 */
	private function disp_up(){

		$arr_all_timezone_host = $this->model->sel_arr_timezone();
		if(empty($arr_all_timezone_host[0])){
			//When object is not present
			$this->session->set($this->module_name, array(ACTION_UP => false, TARGET_NOT_FOUND_ERROR => true));
			$this->request->redirect($this->module_name);
		}
		
		if($this->act === "up"){
			//With data update
			$this->post = $this->session->get('timezone.up_post');
			if($this->chk_token() && $this->up_validation() && $this->up()){
				//Discard session
				$this->session->delete('timezone.up_post');
				
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_UP => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
				if(empty($this->post["arr_tag"])){
					$this->post["arr_tag"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->up_validation()){
				//Store in session
				$this->session->set('timezone.up_post', $this->post);
				
				//Template selection
				$this->template->set_filename("timezone.up_conf.template");
			}
		} else {
			//No data update (initial display)
			$this->post = array();
			foreach($arr_all_timezone_host as $timezone){
				$time_id = $timezone->timezone_id;
				list($this->post["sta_t-h_".$time_id], $this->post["sta_t-m_".$time_id], $this->post["sta_t-s_".$time_id]) = explode(':', $timezone->sta_time);
				list($this->post["end_t-h_".$time_id], $this->post["end_t-m_".$time_id], $this->post["end_t-s_".$time_id]) = explode(':', $timezone->end_time);
			}
			//If there is session data set as initial value
			if($this->session->get('timezone.up_post')){
				$this->post = $this->session->get('timezone.up_post');
				$this->session->delete('timezone.up_post');
			}
		}
		
		//Set value to template
		//$this->head_add = "head.timezone.up.template";
		$this->template->arr_all_timezone = $arr_all_timezone_host;
		$this->template->map_list = Controller_Template::get_arr_time(false);
	}
	
	/**
	 * Update validation
	 */
	private function up_validation(){
		$ret = $this->chk_post();
		
		
		// Get start time to end time of each set time zone
		$arr_all_timezone = $this->model->sel_arr_timezone();
		foreach($arr_all_timezone as $timezone){
			if(TIME_ZONE_ALL == $timezone->timezone_id){
				// Do not edit all day data
				continue;
			}
			$time_id = intval($timezone->timezone_id);
			
			if(isset($this->post["sta_t-h_".$time_id]) && 
			   isset($this->post["sta_t-m_".$time_id]) && 
			   $this->post["sta_t-h_".$time_id] !== "" && 
			   $this->post["sta_t-m_".$time_id] !== "" ){
				$timezone->sta_time = sprintf('%02d:%02d:%02d', $this->post["sta_t-h_".$time_id], $this->post["sta_t-m_".$time_id], 0);
			} else {
				$timezone->sta_time = '00:00:00';
			}
			
			if(isset($this->post["end_t-h_".$time_id]) && 
			   isset($this->post["end_t-m_".$time_id]) && 
			   $this->post["end_t-h_".$time_id] !== "" && 
			   $this->post["end_t-m_".$time_id] !== "" ){
				$timezone->end_time = sprintf('%02d:%02d:%02d', $this->post["end_t-h_".$time_id], $this->post["end_t-m_".$time_id], 0);
			} else {
				$timezone->end_time = '00:00:00';
			}
			$this->post['sta_time_' . $time_id] = $timezone->sta_time;
			$this->post['end_time_' . $time_id] = $timezone->end_time;
			$this->post['before_end_time' . ( $time_id + 1 ) ] = $timezone->end_time;
		}
		
		foreach($arr_all_timezone as $timezone){
			if(TIME_ZONE_ALL == $timezone->timezone_id){
				// Do not edit all day data
				continue;
			}
			$time_id = intval($timezone->timezone_id);
			
			if( strtotime( $this->post['sta_time_' . $time_id] ) > strtotime( $this->post['end_time_' . $time_id] ) ){
				// Around time
				$this->arr_ret_error["time"] = array("reverse");
				$ret = false;
			} elseif( strtotime( $this->post['sta_time_' . $time_id] ) == strtotime( $this->post['end_time_' . $time_id] ) ){
				// Start end time Same
				$this->arr_ret_error["time"] = array("equal");
				$ret = false;
			} elseif( TIME_ZONE_MORNING !== $timezone->timezone_id ){
				if( strtotime( $this->post['sta_time_' . $time_id] ) < strtotime( $this->post['before_end_time' . $time_id ] ) ){
					// When morning > day, or noon > night, overlapping time intersects
					$this->arr_ret_error["time"] = array("exists");
					$ret = false;
				}
			}
		}
		return $ret;
	}
	
	/**
	 * Update processing
	 */
	private function up(){
		$ret = true;
		
		//DB registration (store)
		$this->model->db->begin();
		
		$arr_all_timezone = $this->model->sel_arr_timezone();
		foreach($arr_all_timezone as $timezone){
			if(TIME_ZONE_ALL == $timezone->timezone_id){
				// Do not edit all day data
				continue;
			}
			// Get start time to end time before change
			$origin_sta_time = $timezone->sta_time;
			$origin_end_time = $timezone->end_time;
			
			$time_id = intval($timezone->timezone_id);
			$timezone->sta_time = $this->post['sta_time_' . $time_id];
			$timezone->end_time = $this->post['end_time_' . $time_id];
			$timezone->update_user = Session::get_login_db_user();
			$timezone->update_dt   = Request::$request_dt;
			
			// Update time zone
			if($ret){
				$ret = $this->model->up_timezone($timezone);
			}
			
			// Change start time to end time of program guide
			
			if($ret){
				$timezone->origin_sta_time = $origin_sta_time;
				$timezone->origin_end_time = $origin_end_time;
				$ret = $this->model->up_t_prog_rgl_time($timezone);
			}
		}
		return $this->model->db->end($ret);
	}
	

	/**
	 * Validation of signage start and end time
	 */
	private function start_end_time_validation(){
		$ret = true;
		//Since it is restricted so that it becomes numerical value only within the range with UI, only the validation is carried out below. Error text display is not implemented yet.
		if($this->post['sta_t-h'] < 0 || $this->post['sta_t-h'] > 23 || $this->post['sta_t-m'] < 0 || $this->post['sta_t-m'] > 59){
			$this->arr_ret_error['sta_t'] = 'time';
			$ret = false;
		}
		if($this->post['end_t-h'] < 0 || $this->post['end_t-h'] > 23 || $this->post['end_t-m'] < 0 || $this->post['end_t-m'] > 59){
			$this->arr_ret_error['sta_t'] = 'time';
			$ret = false;
		}
		return $ret;
	}
}