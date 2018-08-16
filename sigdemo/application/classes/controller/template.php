<?php defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Template extends Kohana_Controller_Template {
	public static $arr_movie_exte = array(".mp4", ".wmv", ".mov");	//Registration permission extension (movie)
// 	public static $arr_sound_exte = array(".aac");			//Registration permission extension (voice)
	public static $arr_sound_exte = array();			//Registration permission extension (voice)
	public static $arr_image_exte = array(".png");			//Registration permission extension (still image)
	public static $arr_html_exte = array(".zip");			//Registration permission extension (HTML)
	public static $arr_module_disp_name_map = array(
		MODULE_NAME_ACCESSLOG => MODULE_DISP_NAME_ACCESSLOG,
		MODULE_NAME_AUTHGRP => MODULE_DISP_NAME_AUTHGRP,
		MODULE_NAME_BOOTH => MODULE_DISP_NAME_BOOTH,
		MODULE_NAME_CLIENT => MODULE_DISP_NAME_CLIENT,
		MODULE_NAME_COMMONIMAGE => MODULE_DISP_NAME_COMMONIMAGE,
		MODULE_NAME_COMMONMOVIE => MODULE_DISP_NAME_COMMONMOVIE,
		MODULE_NAME_COMMONTEXT => MODULE_DISP_NAME_COMMONTEXT,
		MODULE_NAME_CTSDL => MODULE_DISP_NAME_CTSDL,
		MODULE_NAME_DEV => MODULE_DISP_NAME_DEV,
		MODULE_NAME_DEVHTML => MODULE_DISP_NAME_DEVHTML,
		MODULE_NAME_DEVHTMLVIEW => MODULE_DISP_NAME_DEVHTMLVIEW,
		MODULE_NAME_DEVPROG => MODULE_DISP_NAME_DEVPROG,
		MODULE_NAME_DLLOG => MODULE_DISP_NAME_DLLOG,
		MODULE_NAME_FLOOR => MODULE_DISP_NAME_FLOOR,
		MODULE_NAME_HTML => MODULE_DISP_NAME_HTML,
		MODULE_NAME_IMAGE => MODULE_DISP_NAME_IMAGE,
		MODULE_NAME_LOGIN => MODULE_DISP_NAME_LOGIN,
		MODULE_NAME_MENU => MODULE_DISP_NAME_MENU,
		MODULE_NAME_MOVIE => MODULE_DISP_NAME_MOVIE,
		MODULE_NAME_COMMONPLAYLIST => MODULE_DISP_NAME_COMMONPLAYLIST,
		MODULE_NAME_PLAYLIST => MODULE_DISP_NAME_PLAYLIST,
		MODULE_NAME_PLAYLISTDL => MODULE_DISP_NAME_PLAYLISTDL,
		MODULE_NAME_PLAYLISTALL => MODULE_DISP_NAME_PLAYLISTALL,
		MODULE_NAME_PROG => MODULE_DISP_NAME_PROG,
		MODULE_NAME_PROGRGL => MODULE_DISP_NAME_PROGRGL,
		MODULE_NAME_PROGVIEW => MODULE_DISP_NAME_PROGVIEW,
		MODULE_NAME_SHOP => MODULE_DISP_NAME_SHOP,
		MODULE_NAME_SOLDOUT => MODULE_DISP_NAME_SOLDOUT,
		MODULE_NAME_TAG => MODULE_DISP_NAME_TAG,
		MODULE_NAME_TEXT => MODULE_DISP_NAME_TEXT,
		MODULE_NAME_TIMEZONE => MODULE_DISP_NAME_TIMEZONE,
		MODULE_NAME_USER => MODULE_DISP_NAME_USER,
		MODULE_NAME_MAIL => MODULE_DISP_NAME_MAIL,
		MODULE_NAME_PROPERTY => MODULE_DISP_NAME_PROPERTY,
		MODULE_NAME_PLAYCNT => MODULE_DISP_NAME_PLAYCNT,
		MODULE_NAME_PHPEXCEL => MODULE_DISP_NAME_PHPEXCEL,
		MODULE_NAME_RANDOM => MODULE_DISP_NAME_RANDOM,
		MODULE_NAME_SOUNDALL => MODULE_DISP_NAME_SOUNDALL
	);
	
	public static $arr_module_cat_disp_name_map = array(
		MODULE_CAT_SIGNAGE => MODULE_DISP_CAT_SIGNAGE,
		MODULE_CAT_SIGNAGE_CTS => MODULE_DISP_CAT_SIGNAGE_CTS,
		MODULE_CAT_SIGNAGE_COMMON_CTS => MODULE_DISP_CAT_SIGNAGE_COMMON_CTS,
		MODULE_CAT_SIGNAGE_SET => MODULE_DISP_CAT_SIGNAGE_SET,
		MODULE_CAT_HTML => MODULE_DISP_CAT_HTML,
		MODULE_CAT_HTML_CTS => MODULE_DISP_CAT_HTML_CTS, 
		MODULE_CAT_HTML_SET => MODULE_DISP_CAT_HTML_SET,
		MODULE_CAT_MST => MODULE_DISP_CAT_MST,
		MODULE_CAT_LOG => MODULE_DISP_CAT_LOG
	);
	
	public static $arr_module_name_cat_map = array(
		MODULE_CAT_SIGNAGE_CTS => MODULE_CAT_SIGNAGE,
		MODULE_NAME_MOVIE => MODULE_CAT_SIGNAGE_CTS,
		MODULE_NAME_IMAGE => MODULE_CAT_SIGNAGE_CTS,
		MODULE_NAME_TEXT => MODULE_CAT_SIGNAGE_CTS,
		MODULE_NAME_SOLDOUT => MODULE_CAT_SIGNAGE_CTS,
		MODULE_NAME_SOUNDALL => MODULE_CAT_SIGNAGE_CTS,
		
		MODULE_CAT_SIGNAGE_COMMON_CTS => MODULE_CAT_SIGNAGE,
		MODULE_NAME_COMMONMOVIE => MODULE_CAT_SIGNAGE_COMMON_CTS,
		MODULE_NAME_COMMONIMAGE => MODULE_CAT_SIGNAGE_COMMON_CTS,
		MODULE_NAME_COMMONTEXT => MODULE_CAT_SIGNAGE_COMMON_CTS,
		
		MODULE_CAT_SIGNAGE_SET => MODULE_CAT_SIGNAGE,
		MODULE_NAME_COMMONPLAYLIST => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_PLAYLIST => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_PLAYLISTALL => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_PLAYLISTDL => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_CTSDL => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_DEVPROG => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_PROG => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_PROGRGL => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_PROGVIEW => MODULE_CAT_SIGNAGE_SET,
		MODULE_NAME_RANDOM => MODULE_CAT_SIGNAGE_SET,
		
		MODULE_CAT_HTML_CTS => MODULE_CAT_HTML,
		MODULE_NAME_HTML => MODULE_CAT_HTML_CTS,
		
		MODULE_CAT_HTML_SET => MODULE_CAT_HTML,
		MODULE_NAME_DEVHTML => MODULE_CAT_HTML_SET,
		MODULE_NAME_DEVHTMLVIEW => MODULE_CAT_HTML_SET,
		
		MODULE_CAT_MST => MODULE_CAT_MST,
		MODULE_NAME_TAG => MODULE_CAT_MST,
		MODULE_NAME_BOOTH => MODULE_CAT_MST,
		MODULE_NAME_DEV => MODULE_CAT_MST,
		MODULE_NAME_FLOOR => MODULE_CAT_MST,
		MODULE_NAME_SHOP => MODULE_CAT_MST,
		MODULE_NAME_USER => MODULE_CAT_MST,
		MODULE_NAME_AUTHGRP => MODULE_CAT_MST,
		MODULE_NAME_TIMEZONE => MODULE_CAT_MST,
		MODULE_NAME_CLIENT => MODULE_CAT_MST,
		MODULE_NAME_MAIL => MODULE_CAT_MST,
		MODULE_NAME_PROPERTY => MODULE_CAT_MST,
		
		MODULE_CAT_LOG => MODULE_CAT_LOG,
		MODULE_NAME_DLLOG => MODULE_CAT_LOG,
		MODULE_NAME_ACCESSLOG => MODULE_CAT_LOG,
		MODULE_NAME_PLAYCNT => MODULE_CAT_LOG,
		MODULE_NAME_PHPEXCEL => MODULE_CAT_LOG
	);
	
	public $template = null;
	public $head = 'head';
	public $body_header = 'body_header';
	public $body_footer = 'body_footer';
	public $head_add = null;
	
	protected $disp = "";
	protected $act = "";
	protected $db = null;
	protected $model = null;
	protected $model_util = null;
	protected $session = null;
	protected $post = null;
	protected $token = null;
	protected $validation = array();
	protected $arr_ret_error = array();
	protected $search = null;
	
	public function __construct(Request $request, Response $response){
		parent::__construct($request, $response);
		$this->module_name = $request->controller();
		$this->post = $request->post();
		if(isset($this->post["token"])){
			$this->token = $this->post["token"];
		}
		$this->db = Database::instance();
		$this->session = Session::instance();
		if(isset(Controller_Template::$arr_module_disp_name_map[$this->module_name])){
			$this->session->set(SESS_DISP_MODULE_NAME, Controller_Template::$arr_module_disp_name_map[$this->module_name]);
		}
	}
	
	public function before(){
		if ($this->auto_render === TRUE){
			$this->template = View::factory($this->template);
			$this->head = View::factory($this->head);
			$this->body_header = View::factory($this->body_header);
			$this->body_footer = View::factory($this->body_footer);
		}
	}
	
	public function after(){
		if ($this->auto_render === TRUE){
			$body = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
			$body .= "<html xmlns=\"http://www.w3.org/1999/xhtml\">\n";
			$body .= "<head>\n";
			$body .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\n";
			if(isset($this->head)){
				$body .= $this->head->render();
			}
			if(isset($this->head_add)){
				$this->head_add = View::factory($this->head_add);
				$body .= $this->head_add->render();
			}
			$body .= "</head>\n";
			
			$body .= "<body>\n";
			$body .= "<div class=\"all_container\">\n";
			if(isset($this->body_header)){
				$body .= $this->body_header->render();
			}
			if(isset($this->template)){
				$body .= $this->template->render();
			}
			if(isset($this->body_footer)){
				$body .= $this->body_footer->render();
			}
			$body .= "</div><!-- /all_container -->\n";
			$body .= "</body>\n";
			$body .= "</html>";
			$this->response->body($body);
		}
	}
	
	public function get_user_name_from_db_user($db_user){
		$ret = "";
		$user_id = $this->get_user_id_from_db_user($db_user);
		if($user_id !== false){
			$user_name = Model_Util::sel_user_name(Session::get_target_client_id(), $user_id);
			if(!empty($user_name[0])){
				$ret = $user_name[0]->user_name;
			}
		}
		return $ret;
	}
	
	public function get_user_id_from_db_user($db_user){
		$ret = false;
		if(isset($db_user) && $db_user !== ""){
			$ret = str_replace(DB_USER_PREFIX_USER, "", $db_user);
			if(preg_match("/^[0-9]+$/", $ret) === 0){
				$ret = false;
			}
		}
		return $ret;
	}
	public function action_index_before(){
		$this->login_check();
		if(!empty($this->post)){
			foreach($this->post as $key => $val){
				if($key === "disp"){
					$this->disp = $val;
					continue;
				} else if($key === "act"){
					$this->act = $val;
					continue;
				}
			}
		}
	}
	
	protected function disp_list_before(){
		$this->auth_check($this->module_name, ACTION_SEL);
		try{
			$this->template->set_filename($this->module_name . ".template");
		} catch(Exception $e){
			$this->template = View::factory();
		}
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
		
		//Confirmation screen Retain all information (provisional countermeasure)
		$this->session->delete("authgrp.ins_post");
		$this->session->delete("authgrp.up_post");
		$this->session->delete("booth.ins_post");
		$this->session->delete("booth.up_post");
		$this->session->delete("client.ins_post");
		$this->session->delete("client.up_post");
		$this->session->delete("commonimage.ins_file");
		$this->session->delete("commonimage.ins_post");
		$this->session->delete("commonimage.up_post");
		$this->session->delete("commonmovie.ins_file");
		$this->session->delete("commonmovie.ins_post");
		$this->session->delete("commonmovie.up_post");
		$this->session->delete("commontext.ins_post");
		$this->session->delete("commontext.up_post");
		$this->session->delete("dev.ins_post");
		$this->session->delete("dev.up_post");
		$this->session->delete("devhtml.ins_post");
		$this->session->delete("html.ins_file");
		$this->session->delete("html.ins_post");
		$this->session->delete("html.up_post");
		$this->session->delete("image.ins_file");
		$this->session->delete("image.ins_post");
		$this->session->delete("image.up_post");
		$this->session->delete("movie.ins_file");
		$this->session->delete("movie.ins_post");
		$this->session->delete("movie.up_post");
		$this->session->delete("commonplaylist.ins_seltmpl_post");
		$this->session->delete("commonplaylist.ins_post");
		$this->session->delete("commonplaylist.up_post");
		$this->session->delete("commonplaylist.up_seltmpl_post");
		$this->session->delete("commonplaylistall.ins_post");
		$this->session->delete("playlist.ins_seltmpl_post");
		$this->session->delete("playlist.ins_clitmpl_post");
		$this->session->delete("playlist.ins_post");
		$this->session->delete("playlist.up_post");
		$this->session->delete("playlistall.ins_post");
		$this->session->delete("prog.ins_post");
		$this->session->delete("progrgl.ins_post");
		$this->session->delete("progrgl.up_post");
		$this->session->delete("shop.ins_post");
		$this->session->delete("shop.up_post");
		$this->session->delete("tag.ins_post");
		$this->session->delete("text.ins_post");
		$this->session->delete("text.up_post");
		$this->session->delete("timezone.up_post");
		$this->session->delete("user.ins_post");
		$this->session->delete("user.up_post");
		$this->session->delete("mail.ins_post");
		$this->session->delete("mail.up_post");
		$this->session->delete("soundall.ins_post");
		$this->session->delete("soundall.ins_file");
	}
	
	protected function disp_list_after(){
		$this->template->post = $this->post;
		$this->template->arr_error = $this->arr_ret_error;
		$this->template->arr_action_result = $this->get_action_result();
		$this->session->set(SESS_TOKEN, Request::$token);
		$this->template->token = Request::$token;
	}
	
	protected function disp_ins_before(){
		$this->auth_check($this->module_name, ACTION_INS);
		try{
			$this->template->set_filename($this->module_name . ".ins.template");
		} catch(Exception $e){
			$this->template = View::factory();
		}
	}
	
	protected function disp_ins_after(){
		$this->template->post = $this->post;
		$this->template->arr_error = $this->arr_ret_error;
		$this->template->arr_action_result = $this->get_action_result();
		$this->session->set(SESS_TOKEN, Request::$token);
		$this->template->token = Request::$token;
	}
	
	protected function disp_up_before(){
		$this->auth_check($this->module_name, ACTION_UP);
		try{
			$this->template->set_filename($this->module_name . ".up.template");
		} catch(Exception $e){
			$this->template = View::factory();
		}
	}
	
	protected function disp_up_after(){
		$this->template->post = $this->post;
		$this->template->arr_error = $this->arr_ret_error;
		$this->template->arr_action_result = $this->get_action_result();
		$this->session->set(SESS_TOKEN, Request::$token);
		$this->template->token = Request::$token;
	}
	
	protected function disp_del_before(){
		$this->auth_check($this->module_name, ACTION_DEL);
		try{
			$this->template->set_filename($this->module_name . ".del.template");
		} catch(Exception $e){
			$this->template = View::factory();
		}
	}
	
	protected function disp_del_after(){
		$this->template->post = $this->post;
		$this->template->arr_error = $this->arr_ret_error;
		$this->template->arr_action_result = $this->get_action_result();
		$this->session->set(SESS_TOKEN, Request::$token);
		$this->template->token = Request::$token;
	}
	
	protected function disp_lump_del_before(){
		$this->auth_check($this->module_name, ACTION_DEL);
		try{
			$this->template->set_filename($this->module_name . ".lumpdel.template");
		} catch(Exception $e){
			$this->template = View::factory();
		}
	}
	
	protected function disp_lump_del_after(){
		$this->template->post = $this->post;
		$this->template->arr_error = $this->arr_ret_error;
		$this->template->arr_action_result = $this->get_action_result();
		$this->session->set(SESS_TOKEN, Request::$token);
		$this->template->token = Request::$token;
	}
	
	protected function get_action_result(){
		$arr_action_result = array();
		if(!is_null($this->session->get($this->module_name))){
			$arr_action_result[$this->module_name] = $this->session->get($this->module_name);
		}
		return $arr_action_result;
	}
	
	public static function get_arr_booth_tag($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_booth_tag(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->booth_tag_id] = $all->booth_tag_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_shop_tag($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_shop_tag(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->shop_tag_id] = $all->shop_tag_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_dev_tag($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_dev_tag(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->dev_tag_id] = $all->dev_tag_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_movie_tag($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_movie_tag(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_tag_id] = $all->movie_tag_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_image_tag($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_image_tag(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->image_tag_id] = $all->image_tag_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_text_tag($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_text_tag(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->text_tag_id] = $all->text_tag_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_html_tag($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_html_tag(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->html_tag_id] = $all->html_tag_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_property($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_property(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->property_id] = $all->property_name;
			}
		}
		return $arr_ret;
	}

	public static function get_arr_client($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_client();
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->client_id] = $all->client_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_booth($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_booth(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->booth_id] = $all->booth_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_booth_with_sex_shop_floor($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_booth(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->booth_id] = array(
					'booth_name' => $all->booth_name,
					'sex_id'     => $all->sex_id,
					'shop_id'    => $all->shop_id,
					'floor_id'    => $all->floor_id,
				);
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_floor($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_floor(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->floor_id] = $all->floor_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_shop($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_shop(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->shop_id] = $all->shop_name;
			}
		}
		return $arr_ret;
	}

	public static function get_arr_shop_with_client($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_shop(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->shop_id] = array(
					'shop_name' => $all->shop_name,
					'client_id' => $all->client_id,
				);
			}
		}
		return $arr_ret;
	}

	public static function get_arr_all_movie($ants_version, $empty_opt_flag = true, $exclude_swf = false, $get_tag_flag = false){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_all = Model_Util::sel_arr_movie($ants_version, Session::get_target_client_id(), $exclude_swf, null, $get_tag_flag);
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				if ($get_tag_flag) {
					$arr_ret[$all->movie_id] = array(
					    'movie_name'     => $all->movie_name,
						'sta_dt'         => $all->sta_dt,
						'end_dt'         => $all->end_dt,
						'movie_tag_name' => $all->movie_tag_name,
					);
				} else {
					$arr_ret[$all->movie_id] = $all->movie_name;
				}
			}
		}
		$arr_all = Model_Util::sel_arr_common_movie($ants_version, $exclude_swf, null, $get_tag_flag);
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				if ($get_tag_flag) {
					$arr_ret[$all->movie_id] = array(
					    'movie_name'     => "(Common) " . $all->movie_name,
						'sta_dt'         => $all->sta_dt,
						'end_dt'         => $all->end_dt,
						'movie_tag_name' => $all->movie_tag_name,
					);
				} else {
					$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
				}
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_no_rotated_movie($ants_version, $empty_opt_flag = true, $exclude_swf = false){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_all = Model_Util::sel_arr_movie($ants_version, Session::get_target_client_id(), $exclude_swf, 0);
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = $all->movie_name;
			}
		}
		$arr_all = Model_Util::sel_arr_common_movie($ants_version, $exclude_swf, 0);
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_rotated_movie($ants_version, $empty_opt_flag = true, $exclude_swf = false){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_all = Model_Util::sel_arr_movie($ants_version, Session::get_target_client_id(), $exclude_swf, 1);
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = $all->movie_name;
			}
		}
		$arr_all = Model_Util::sel_arr_common_movie($ants_version, $exclude_swf, 1);
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_all_sound($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_all = Model_Util::sel_arr_sound(Session::get_target_client_id());
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = $all->movie_name;
			}
		}
		$arr_all = Model_Util::sel_arr_common_sound();
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
			}
		}
		
		return $arr_ret;
	}
	
	public static function get_arr_all_image(&$arr_ret_all_image, $draw_area){
		$arr_image = Model_Util::sel_arr_image_all(Session::get_target_client_id());
		if(!empty($arr_image[0])){
			if(!isset($arr_ret_all_image[$draw_area["draw_area_id"]])){
				$arr_ret_all_image[$draw_area["draw_area_id"]] = array();
				$arr_ret_all_image[$draw_area["draw_area_id"]][""] = "";
			}
			if(!empty($arr_image)){
				foreach($arr_image as $image){
					$arr_ret_all_image[$draw_area["draw_area_id"]][$image->image_id] = $image->image_name;
				}
			}
		}
		$arr_image = Model_Util::sel_arr_common_image_all();
		if(!empty($arr_image[0])){
			if(!isset($arr_ret_all_image[$draw_area["draw_area_id"]])){
				$arr_ret_all_image[$draw_area["draw_area_id"]] = array();
				$arr_ret_all_image[$draw_area["draw_area_id"]][""] = "";
			}
			if(!empty($arr_image)){
				foreach($arr_image as $image){
					$arr_ret_all_image[$draw_area["draw_area_id"]][$image->image_id] = "(Common) " . $image->image_name;
				}
			}
		}
	}
	
	public static function get_arr_all_movie_image($draw_size_id, $rotate_flag){
		$arr_ret_all_image = array();
		$arr_image = Model_Util::sel_arr_image_all(Session::get_target_client_id());
		if(!empty($arr_image[0])){
			foreach($arr_image as $image){
				$arr_ret_all_image["image_" . $image->image_id] = "(Still image) " . $image->image_name;
			}
		}
		$arr_image = Model_Util::sel_arr_common_image_all();
		if(!empty($arr_image[0])){
			foreach($arr_image as $image){
				$arr_ret_all_image["image_" . $image->image_id] = "(Common still image) " . $image->image_name;
			}
		}
		return $arr_ret_all_image;
	}
	
	public static function get_arr_common_movie_image($draw_size_id, $rotate_flag){
		$arr_ret_all_image = array();
		$arr_image = Model_Util::sel_arr_common_image_all();
		if(!empty($arr_image[0])){
			foreach($arr_image as $image){
				$arr_ret_all_image["image_" . $image->image_id] = "(Common still image) " . $image->image_name;
			}
		}
		return $arr_ret_all_image;
	}
	
	public static function get_arr_all_movie_image_ants_one($draw_tmpl_id, $rotate_flag){
		$arr_ret_all_image = array();
		$arr_image = Model_Util::sel_arr_image_by_draw_tmpl_id(Session::get_target_client_id(), $draw_tmpl_id);
		if(!empty($arr_image[0])){
			foreach($arr_image as $image){
				$arr_ret_all_image["image_" . $image->image_id] = "(Still image) " . $image->image_name;
			}
		}
		$arr_image = Model_Util::sel_arr_common_image_by_draw_tmpl_id($draw_tmpl_id);
		if(!empty($arr_image[0])){
			foreach($arr_image as $image){
				$arr_ret_all_image["image_" . $image->image_id] = "(Common still image) " . $image->image_name;
			}
		}
		return $arr_ret_all_image;
	}
	
	public static function get_arr_all_common_movie_image_ants_one($draw_tmpl_id, $rotate_flag){
		$arr_ret_all_image = array();
		$arr_image = Model_Util::sel_arr_common_image_by_draw_tmpl_id($draw_tmpl_id);
		if(!empty($arr_image[0])){
			foreach($arr_image as $image){
				$arr_ret_all_image["image_" . $image->image_id] = "(Common still image) " . $image->image_name;
			}
		}
		return $arr_ret_all_image;
	}
	
	
	
	public static function get_arr_all_text($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_all = Model_Util::sel_arr_text(Session::get_target_client_id());
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->text_id] = $all->text_name;
			}
		}
		$arr_all = Model_Util::sel_arr_common_text();
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->text_id] = "(Common) " . $all->text_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_common_movie($ants_version, $empty_opt_flag = true, $exclude_swf = false){
		$arr_all = Model_Util::sel_arr_common_movie($ants_version ,$exclude_swf);
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_no_rotated_common_movie($ants_version, $empty_opt_flag = true, $exclude_swf = false){
		$arr_all = Model_Util::sel_arr_common_movie($ants_version, $exclude_swf, 0);
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_rotated_common_movie($ants_version, $empty_opt_flag = true, $exclude_swf = false){
		$arr_all = Model_Util::sel_arr_common_movie($ants_version, $exclude_swf, 1);
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_common_sound($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_common_sound();
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = "(Common) " . $all->movie_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_common_image(&$arr_ret_all_image, $draw_area){
		$arr_image = Model_Util::sel_arr_common_image_all();
		if(!empty($arr_image[0])){
			$arr_ret_all_image[$draw_area->draw_area_id] = array();
			$arr_ret_all_image[$draw_area->draw_area_id][""] = "";
			if(!empty($arr_image)){
				foreach($arr_image as $image){
					$arr_ret_all_image[$draw_area->draw_area_id][$image->image_id] = "(Common) " . $image->image_name;
				}
			}
		}
	}
	
	public static function get_arr_common_text($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_common_text();
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->text_id] = "(Common) " . $all->text_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_movie($ants_version, $empty_opt_flag = true, $exclude_swf = false){
		$arr_all = Model_Util::sel_arr_movie($ants_version, Session::get_target_client_id(), $exclude_swf);
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->movie_id] = $all->movie_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_image(&$arr_ret_all_image, $draw_area){
		$arr_image = Model_Util::sel_arr_image_all(Session::get_target_client_id());
		if(!empty($arr_image[0])){
			$arr_ret_all_image[$draw_area->draw_area_id] = array();
			$arr_ret_all_image[$draw_area->draw_area_id][""] = "";
			if(!empty($arr_image)){
				foreach($arr_image as $image){
					$arr_ret_all_image[$draw_area->draw_area_id][$image->image_id] = $image->image_name;
				}
			}
		}
	}
	
	public static function get_arr_text($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_text(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->text_id] = $all->text_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_html($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_html(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->html_id] = $all->html_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_commonplaylist($ants_version = null, $empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_commonplaylist($ants_version, Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->playlist_id] = $all->playlist_name;
			}
		}
		return $arr_ret;
	}

	public static function get_arr_commonplaylist_ants_version(){
		$ants_version = null;
		$arr_all = Model_Util::sel_arr_commonplaylist($ants_version,Session::get_target_client_id());

		return $arr_all;
	}
	
	public static function get_arr_commonplaylist_client($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_commonplaylist_client();
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->playlist_id] = "(" . $all->client_name . ") " . $all->playlist_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_playlist($ants_version = null, $empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_playlist($ants_version, Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->playlist_id] = $all->playlist_name;
			}
		}
		return $arr_ret;
	}

	public static function get_arr_playlist_ants_version(){
		$ants_version = null;
		$arr_all = Model_Util::sel_arr_playlist($ants_version,Session::get_target_client_id());

		return $arr_all;
	}
	
	public static function get_arr_playlist_client($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_playlist_client();
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->playlist_id] = "(" . $all->client_name . ") " . $all->playlist_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_auth(){
		$arr_ret = array();
		$arr_module = Model_Util::sel_arr_module();
		foreach($arr_module as $module){
			$arr_tmp_ret = array();
			$arr_all = Model_Util::sel_arr_auth_by_module($module->module);
			foreach($arr_all as $all){
				array_push($arr_tmp_ret, array("auth_id" => $all->auth_id, "auth_name" => $all->auth_name, "display_order" => $all->display_order));
			}
			array_push($arr_ret, array("module" => $module->module, "module_name" => $module->module_name, "arr_auth" => $arr_tmp_ret));
		}
		return $arr_ret;
	}
	
	public static function get_arr_auth_grp($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_auth_grp(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->auth_grp_id] = $all->auth_grp_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_draw_size($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_all = Model_Util::sel_arr_image_draw_size();
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->draw_size_id] = $all->width . "*" . $all-> height . " (" . $all->draw_size_name . ")";
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_draw_tmpl($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_all = Model_Util::sel_arr_draw_tmpl();
		if(!empty($arr_all)){
			foreach($arr_all as $all){
				$arr_ret[$all->draw_tmpl_id] = $all->draw_tmpl_name;
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_tag_and_or($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["and"] = "AND";
		$arr_ret["or"] = "OR";
		return $arr_ret;
	}
	
	public static function get_arr_ants_version($empty_opt_flag = true){
		$arr_ret = array();
		if(SERVICE_ANTS_ONE_ENABLE === true){
			if($empty_opt_flag){
				$arr_ret[""] = "";
			}
			$arr_ret[ANTS_ONE_KIND] = ANTS_ONE_KIND_NAME;
			$arr_ret[ANTS_TWO_KIND] = ANTS_TWO_KIND_NAME;
		}else{
			$arr_ret[ANTS_TWO_KIND] = ANTS_TWO_KIND_NAME;
		}
		return $arr_ret;
	}
	
	public static function get_arr_delivery_month($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "January";
		$arr_ret["1"] = "February";
		$arr_ret["2"] = "In March";
		$arr_ret["3"] = "April";
		$arr_ret["4"] = "May";
		$arr_ret["5"] = "June";
		$arr_ret["6"] = "July";
		$arr_ret["7"] = "August";
		$arr_ret["8"] = "September";
		$arr_ret["9"] = "October";
		$arr_ret["10"] = "November";
		$arr_ret["11"] = "December";
		return $arr_ret;
	}
	

	public static function get_arr_time_zone($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_time_zone(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			if(!empty($arr_all)){
				foreach($arr_all as $all){
					$arr_ret[$all->timezone_id] = $all->timezone_name;
				}
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_delivery_kind($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "weekly";
		$arr_ret["1"] = "spot";
		return $arr_ret;
	}
	
	
	public static function get_arr_ad($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "General advertisement";
		$arr_ret["1"] = "Facilities advertisement";
		$arr_ret["2"] = "Hit Ad";
		return $arr_ret;
	}
	
	public static function get_arr_sex($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "Man";
		$arr_ret["1"] = "woman";
		return $arr_ret;
	}
	
	public static function get_arr_unit($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "Master unit";
		$arr_ret["1"] = "Cordless handset";
		return $arr_ret;
	}
	
	public static function get_arr_invalid($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "Effectiveness";
		$arr_ret["1"] = "Disabled";
		return $arr_ret;
	}
	
	public static function get_arr_mail($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "Effectiveness";
		$arr_ret["1"] = "Disabled";
		return $arr_ret;
	}
	
	public static function get_arr_dlstatus($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["0"] = "Not yet";
		$arr_ret["1"] = "processing";
		$arr_ret["2"] = "success";
		$arr_ret["3"] = "Failure";
		return $arr_ret;
	}
	
	public static function get_arr_service($empty_opt_flag = true){
		$arr_all = Model_Util::sel_arr_service(Session::get_target_client_id());
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		if(!empty($arr_all)){
			if(!empty($arr_all)){
				foreach($arr_all as $all){
					$arr_ret[$all->service_id] = $all->service_name;
				}
			}
		}
		return $arr_ret;
	}
	
	public static function get_arr_tag_cat($empty_opt_flag = true){
		$arr_ret = array();
		if($empty_opt_flag){
			$arr_ret[""] = "";
		}
		$arr_ret["movie"] = "Video";
		$arr_ret["image"] = "Still image";
		$arr_ret["text"] = "telop";
		$arr_ret["html"] = "Smurf content";
		$arr_ret["dev"] = "Terminal";
		$arr_ret["booth"] = "booth";
		$arr_ret["shop"] = "Store";
		return $arr_ret;
	}
	
	public static function get_arr_playtime($empty_opt_flag = true){
		if($empty_opt_flag){
			$play_time_m[""] = "";
			$play_time_s[""] = "";
		}
		for($i = 0; $i <= 59; $i++) $playtime_m[sprintf('%02d', $i)] = sprintf('%02d', $i);
		for($i = 0; $i <= 59; $i++) $playtime_s[sprintf('%02d', $i)] = sprintf('%02d', $i);
		$arr_ret = array(
			'play_time-m' => $playtime_m,
			'play_time-s' => $playtime_s,
		);
		return $arr_ret;
	}
	
	public static function get_arr_time($empty_opt_flag = true){
		if($empty_opt_flag){
			$time_h[""] = "";
			$time_m[""] = "";
		}
		for($i = 0; $i <= 23; $i++) $time_h[sprintf('%02d', $i)] = sprintf('%02d', $i);
		for($i = 0; $i <= 59; $i++) $time_m[sprintf('%02d', $i)] = sprintf('%02d', $i);
		$arr_ret = array(
			'time_h' => $time_h,
			'time_m' => $time_m,
		);
		return $arr_ret;
	}
	
	public static function get_arr_map_img(){
		return array(
		  '1' => array(
			'path' => 'images/temp_01.png',
			'name' => 'Vertical movie still image',
		  ),
		  '2' => array(
			'path' => 'images/temp_03.png',
			'name' => 'Vertical still image',
		  ),
		  '3' => array(
			'path' => 'images/temp_04.png',
			'name' => 'Vertical full still image',
		  ),
		  '4' => array(
			'path' => 'images/temp_05.png',
			'name' => 'Landscape All Movies',
		  ),
		  '5' => array(
			'path' => 'images/temp_06.png',
			'name' => 'Horizontal full still image',
		  ),
		  '6' => array(
			'path' => 'images/temp_02.png',
			'name' => 'Vertical still image still image',
		  ),
		  '8' => array(
			'path' => 'images/temp_08.png',
			'name' => 'Vertical movie still image',
		  ),
		  '9' => array(
			'path' => 'images/temp_09.gif',
			'name' => 'Vertical All Movies',
		  ),
		  '10' => array(
			'path' => 'images/temp_10.gif',
			'name' => 'Vertical still image movie',
		  ),
		  '11' => array(
			'path' => 'images/temp_11.gif',
			'name' => 'Vertical still image',
		  ),
		  '12' => array(
			'path' => 'images/temp_12.gif',
			'name' => 'Vertical still image still image',
		  ),
		  '13' => array(
			'path' => 'images/temp_13.gif',
			'name' => 'Vertical still image movie',
		  )
		);
	}
	
	public function chk_sess_post($sess_post, $redirect_target = null){
		$ret = true;
		if(is_null($sess_post)){
			$ret = false;
			if(isset($redirect_target)){
				$this->session->set($redirect_target, array(MOVE_ERROR => true));
				$this->request->redirect($redirect_target);
			} else {
				$this->session->set($this->module_name, array(MOVE_ERROR => true));
				$this->request->redirect($this->module_name);
			}
		}
		return $ret;
	}
	
	public function chk_post($redirect_target = null){
		$ret = true;
		if(is_null($this->post)){
			$ret = false;
			if(isset($redirect_target)){
				$this->session->set($redirect_target, array(MOVE_ERROR => true));
				$this->request->redirect($redirect_target);
			} else {
				$this->session->set($this->module_name, array(MOVE_ERROR => true));
				$this->request->redirect($this->module_name);
			}
		}
		return $ret;
	}
	
	public function chk_token($module = null, $redirect_target = null){
		$ret = true;
		if($this->session->get(SESS_TOKEN, false) !== $this->token){
			$ret = false;
			if(isset($module)){
				$this->session->set($module, array(MOVE_ERROR => true));
			} else {
				$this->session->set($this->module_name, array(MOVE_ERROR => true));
			}
			
			if(isset($redirect_target)){
				$this->request->redirect($redirect_target);
			} else if(isset($module)){
				$this->request->redirect($module);
			} else {
				$this->request->redirect($this->module_name);
			}
		}
		return $ret;
	}
	
	protected function merge_prog($row, &$arr_tmp_prog){
		$prog_id = $row->prog_id;
		$prog_name = $row->prog_name;
		$sta_dt = $row->sta_dt;
		$end_dt = $row->end_dt;
		$prog_cat = $row->prog_cat;
		if(empty($arr_tmp_prog)){
			$tmp_prog = new stdClass();
			$tmp_prog->prog_id = $prog_id;
			$tmp_prog->prog_name = $prog_name;
			$tmp_prog->sta_dt = $sta_dt;
			$tmp_prog->end_dt = $end_dt;
			$tmp_prog->prog_cat = $prog_cat;
			array_push($arr_tmp_prog, $tmp_prog);
		} else {
			$push = true;
			foreach($arr_tmp_prog as $prog){
				if($prog->sta_dt <= $sta_dt && $prog->end_dt >= $end_dt){
					//Completely included
					$push = false;
					continue;
				} else if($prog->sta_dt > $end_dt || $prog->end_dt < $sta_dt){
					//It is not included at all
					continue;
				} else if($prog->sta_dt > $sta_dt && $prog->end_dt < $end_dt){
					//Complete inclusion (necessity of division)
					$tmp_prog = new stdClass();
					$tmp_prog->prog_id = $prog_id;
					$tmp_prog->prog_name = $prog_name;
					$tmp_prog->sta_dt = $sta_dt;
					$tmp_prog->end_dt = $prog->sta_dt;
					$tmp_prog->prog_cat = $prog_cat;
					$this->merge_prog($tmp_prog, $arr_tmp_prog);
					
					$tmp_prog = new stdClass();
					$tmp_prog->prog_id = $prog_id;
					$tmp_prog->prog_name = $prog_name;
					$tmp_prog->sta_dt = $prog->end_dt;
					$tmp_prog->end_dt = $end_dt;
					$tmp_prog->prog_cat = $prog_cat;
					$this->merge_prog($tmp_prog, $arr_tmp_prog);
					return;
				} else {
					//Including part
					if($prog->sta_dt < $end_dt && $prog->end_dt >= $end_dt){
						$end_dt = $prog->sta_dt;
					}
					if($prog->end_dt > $sta_dt && $prog->sta_dt <= $sta_dt){
						$sta_dt = $prog->end_dt;
					}
				}
			}
			if($push){
				$tmp_prog = new stdClass();
				$tmp_prog->prog_id = $prog_id;
				$tmp_prog->prog_name = $prog_name;
				$tmp_prog->sta_dt = $sta_dt;
				$tmp_prog->end_dt = $end_dt;
				$tmp_prog->prog_cat = $prog_cat;
				array_push($arr_tmp_prog, $tmp_prog);
			}
		}
	}
	
	protected function supple_sec($str){
		$sta_time = explode(':', $str);
		if(!isset($sta_time[2])){
			$ret = $str . ':00';
		} else {
			$ret = $str;
		}
		return $ret;
	}
	
	/**
	 * Partial including ⇔ 00:00 mutual conversion
	 */
	protected function toggle_time_format($time){
		if ( is_null($time) ) return null; 

		if ( is_int($time) ) {
			$m = intval($time / 60);
			$s = $time - $m * 60;
			return sprintf('%02d:%02d', $m, $s);
		} else {
			list( $m, $s ) = explode(':', $time);
			return intval($m) * 60 + intval($s);
		}
	}
	
	protected function padding_time(&$arr){
		foreach($arr as $key => $val){
			if($val === '') continue;
			if(strlen($arr[$key]) !== 5){
				$arr_tmp_sta_time = explode(":" , $arr[$key]);
				$arr[$key] = sprintf("%02d:%02d", $arr_tmp_sta_time[0], $arr_tmp_sta_time[1]);
			}
		}
	}
}
