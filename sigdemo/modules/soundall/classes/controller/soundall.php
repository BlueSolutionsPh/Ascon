<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Soundall extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->target_client_check();
		$this->model = new Model_Movie($this->get_target_client_id());
		switch($this->disp){
			case ACTION_INS:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
				break;
			default:
				//Registration
				parent::disp_ins_before();
				$this->disp_ins();
				parent::disp_ins_after();
				break;
		}
	}
	
	/**
	 * Display registration screen
	 */
	private function disp_ins(){
		if($this->act === "ins"){
			//With data registration
			$this->post = $this->session->get('soundall.ins_post');
			$_FILES = $this->session->get('soundall.ins_file');
			if($this->chk_token() && $this->ins_validation() && $this->ins()){
				//Discard session
				$this->session->delete('soundall.ins_post');
				$this->session->delete('soundall.ins_file');
				
				//Redirect to list on success
				$this->session->set($this->module_name, array(ACTION_INS => true));
				$this->request->redirect($this->module_name);
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_INS => false));
				if(empty($this->post["arr_tag"])){
					$this->post["arr_tag"] = array();
				}
			}
		} else if($this->act === "conf"){
			if($this->ins_validation()){
				//Move temporary file
				for ($i = 0; $i< count($_FILES["arr_sound_file"]["tmp_name"]); $i++) {
					$temp_sound_file = TEMP_FILE_DIR.basename($_FILES["arr_sound_file"]["tmp_name"][$i]);
					if(move_uploaded_file($_FILES["arr_sound_file"]["tmp_name"][$i], $temp_sound_file)){
						$_FILES["arr_sound_file"]["tmp_name"][$i] = $temp_sound_file;
					}
				}
				
				//Store in session
				$this->session->set('soundall.ins_post', $this->post);
				$this->session->set('soundall.ins_file', $_FILES);
				
				//Template selection
				$this->template->set_filename("soundall.ins_conf.template");
			}
		} else {
			$this->post["property_id"] = "";
			//If there is session data set as initial value
			if($this->session->get('soundall.ins_post')){
				$this->post = $this->session->get('soundall.ins_post');
				$this->session->delete('soundall.ins_post');
				$this->session->delete('soundall.ins_file');
			}
		}
		
		//Set value to template
		$this->head_add = "head.soundall.template";
		$this->template->arr_all_tag = Controller_Template::get_arr_movie_tag(false);
		$this->template->arr_all_property = array(""=>"なし");
		foreach(Controller_Template::get_arr_property(false) as $key => $value ){
			$this->template->arr_all_property[$key] = $value;
		}
	}
	
	/**
	 * Validation for registration
	 */
	private function ins_validation(){
		$ret = $this->chk_post();

		if($ret){
			//Audio file
			if(!empty($_FILES["arr_sound_file"])){
				$arr_sound_file = $_FILES["arr_sound_file"]["name"];

				$totalFileSize = 0;
				for ($i = 0; $i< count($_FILES["arr_sound_file"]["tmp_name"]); $i++) {
					if(is_uploaded_file($_FILES["arr_sound_file"]["tmp_name"][$i])){
						$this->post["file_size"][$i] = filesize($_FILES["arr_sound_file"]["tmp_name"][$i]);
						$totalFileSize += intval($this->post["file_size"][$i]);
						$sound_orig_file_name[$i] = substr($arr_sound_file[$i], 0, strrpos($arr_sound_file[$i], '.'));
						$this->post["sound_orig_file_name"][$i] = $sound_orig_file_name[$i];
						$sound_orig_file_exte[$i] = substr($arr_sound_file[$i], strrpos($arr_sound_file[$i], '.'));
						$this->post["sound_orig_file_exte"][$i] = $sound_orig_file_exte[$i];
						
						$exte_err = true;
						$arr_exte = Controller_Movie::$arr_sound_exte;
						foreach($arr_exte as $exte){
							if($sound_orig_file_exte[$i] === $exte){
								$exte_err = false;
								break;
							}
						}
						if($exte_err){
							//File format error
							$this->arr_ret_error["arr_sound_file"] = array("exte");
							$ret = false;
						}
					}
				}
			}
			
			//Validation
			$this->validation = Validation::factory($this->post)
				->rule('file_size', 'client_total_file_size', array('totalFileSize'))
				->rule('sound_orig_file_name', 'sound_name_length', array(':value', '60'))
				->rule('sound_orig_file_name', 'sound_name_exists', array(':data', 'sound_orig_file_name'))
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
		for ($i = 0; $i< count($_FILES["arr_sound_file"]["tmp_name"]); $i++) {
			$sound = new Db_Ins();
			$sound->movie_name = $this->post["sound_orig_file_name"][$i];
			$sound->rotate_flag = 0;
			$sound->play_time = null;
			$sound->sta_dt = Text::chk_str($this->post, "sta_dt", null);
			$sound->end_dt = Text::chk_str($this->post, "end_dt", null);
			
			$sound->sound_orig_file_name = $this->post["sound_orig_file_name"][$i];
			$sound->sound_orig_file_exte = $this->post["sound_orig_file_exte"][$i];
			$sound->movie_orig_file_name = null;
			$sound->movie_orig_file_exte = null;
			
			if(!empty($this->post["arr_tag"])){
				$arr_tag = $this->post["arr_tag"];
			} else {
				$arr_tag = array();
			}
			$sound->property_id = Text::chk_str($this->post, "property_id", null);
			
			$sound->orig_file_dir = null;
			$sound->movie_orig_hash = null;
			$sound->sound_orig_hash = null;
			$sound->movie_orig_file_size = null;
			$sound->sound_orig_file_size = null;
			$sound->file_name = null;
			
			//DB registration
			$src_movie_file = null;
			$src_sound_file = null;
			$movie_id = $this->model->sel_next_movie_id();
			if(is_null($movie_id)){
				$ret = false;
			} else {
				$sound->movie_id = $movie_id;
				$sound->file_name = str_pad(strval($sound->movie_id), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT);
				$client_dir = str_pad(strval($this->get_target_client_id()), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT) . "/";
				$sound->orig_file_dir = $client_dir . MOVIE_FILE_DIR . str_pad(strval(intval(sqrt($sound->movie_id / CTS_PER_DIR))), CTS_DIR_PAD_LEN, "0", STR_PAD_LEFT) . "/";
			}
			
			//Data file move
			if(file_exists(ORIG_FILE_DIR . $client_dir) === false){
				mkdir(ORIG_FILE_DIR . $client_dir);
				chmod(ORIG_FILE_DIR . $client_dir, 0775);
			}
			if(file_exists(ORIG_FILE_DIR . $client_dir . MOVIE_FILE_DIR) === false){
				mkdir(ORIG_FILE_DIR . $client_dir . MOVIE_FILE_DIR);
				chmod(ORIG_FILE_DIR . $client_dir . MOVIE_FILE_DIR, 0775);
			}
			if(file_exists(ORIG_FILE_DIR . $sound->orig_file_dir) === false){
				mkdir(ORIG_FILE_DIR . $sound->orig_file_dir);
				chmod(ORIG_FILE_DIR . $sound->orig_file_dir, 0775);
			}
			
			$movie_file = $_FILES["arr_sound_file"]["name"][$i];
			if(!empty($movie_file)){
				$temp_sound_file = $_FILES["arr_sound_file"]["name"][$i];
				$dest_sound_file = ORIG_FILE_DIR . $sound->orig_file_dir . $sound->file_name . $sound->sound_orig_file_exte;
				if(is_null($src_sound_file)){
					$temp_sound_file = $_FILES["arr_sound_file"]["tmp_name"][$i];
					$ret = (rename($temp_sound_file, $dest_sound_file));
				} else {
					$temp_sound_file = $src_sound_file;
					$ret = (is_file($temp_sound_file) && copy($temp_sound_file, $dest_sound_file));
				}
					
				if($ret){
					$src_sound_file = $dest_sound_file;
					chmod($dest_sound_file, 0664);
					$sound->sound_orig_hash = hash_file(HASH_ALGO, $dest_sound_file);
					$sound->sound_orig_file_size = filesize($dest_sound_file);
				}
					
				//DB registration (movie)
				if($ret){
					$ret = $this->model->ins_movie($sound);
				}
					
				//DB registration (tag)
				if($ret && !empty($arr_tag)){
					foreach($arr_tag as $tag){
						$movie_tag_rela = new Db_Ins();
						$movie_tag_rela->movie_id = $sound->movie_id;
						$movie_tag_rela->movie_tag_id = $tag;
						$ret = $this->model->ins_movie_tag_rela($movie_tag_rela);
						if($ret === false){
							break;
						}
					}
				}
			}
		}
		return $this->model->db->end($ret);
	}
}