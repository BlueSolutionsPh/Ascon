<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Soldout extends Controller_Template {
	/**
	 * Main controller
	 */
	public function action_index(){
		parent::action_index_before();
		$this->model = new Model_Soldout($this->get_target_client_id());
		
		//Update screen display
		parent::disp_up_before();
		$this->disp_up();
		parent::disp_up_after();
	}
	
	/**
	 * Update screen display
	 */
	private function disp_up(){
		if($this->act === "up"){
			//With data registration
			if($this->up_validation() && $this->up()){
				//Log out on success
				Auth::instance()->logout(true);
				$this->template->set_filename("soldout.comp.template");
			} else {
				//On failure
				$this->session->set($this->module_name, array(ACTION_UP => false));
			}
		} else {
			//No data registration (initial display)
		}
		
		//Set value to template
		$this->body_header = null;
		$this->body_footer = null;
	}
	
	/**
	 * Validation for updating
	 */
	private function up_validation(){
		$ret = true;
		
		//File check
		if(!empty($_FILES["image_file"])){
			$image_file = $_FILES["image_file"]["name"];
			if(!empty($image_file) && is_uploaded_file($_FILES["image_file"]["tmp_name"])){
				$this->post["file_size"] = filesize($_FILES["image_file"]["tmp_name"]);
				$orig_file_name = substr($image_file, 0, strrpos($image_file, '.'));
				$this->post["orig_file_name"] = $orig_file_name;
				$orig_file_exte = substr($image_file, strrpos($image_file, '.'));
				$this->post["orig_file_exte"] = $orig_file_exte;
				
				$exte_err = true;
				$arr_exte = Controller_Image::$arr_image_exte;
				foreach($arr_exte as $exte){
					if($orig_file_exte === $exte){
						$exte_err = false;
						break;
					}
				}
				if($exte_err){
					//File format error
					$this->arr_ret_error["image_file"] = array("exte");
					$ret = false;
				}
			}
		} else {
			//Error if file does not exist
			$this->arr_ret_error = array("image_file" => array("not_empty"));
			$ret = false;
		}
		
		//Image file size consistency check
		$temp_image_file = $_FILES["image_file"]["tmp_name"];
		try{
			$im = new imagick($temp_image_file);
			$geo = $im->getImageGeometry();
			$width = $geo["width"];
			$height = $geo["height"];
		}catch(Exception $e){
			//File format error
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$this->arr_ret_error["image_file"] = array("file");
			$ret = false;
		}
		
		//Validation
		$this->validation = Validation::factory($this->post)
			->rule('orig_file_name', 'not_empty')
			->rule('orig_file_name', 'max_length', array(':value', '256'))
			->rule('orig_file_exte', 'not_empty')
			->rule('orig_file_exte', 'max_length', array(':value', '8'))
			->rule('orig_file_name', 'image_file_name_exists_soldout', array(':validation', 'orig_file_name', 'orig_file_exte'))
			->rule('file_size', 'client_total_file_size')
		;
		if($this->validation->check() === false){
			$this->arr_ret_error = array_merge($this->arr_ret_error, $this->validation->errors());
			$ret = false;
		}
		
		return $ret;
	}
	
	/**
	 * Update processing
	 */
	private function up(){
		$ret = true;
		$orig_file_name_1 = substr($this->post["orig_file_name"], 0, strlen($this->post["orig_file_name"]) - 1) . "1";
		$orig_file_name_2 = substr($this->post["orig_file_name"], 0, strlen($this->post["orig_file_name"]) - 1) . "2";
		$orig_file_exte = $this->post["orig_file_exte"];
		$image = $this->model->sel_image_by_orig_file_name_exte($orig_file_name_1, $orig_file_name_2, $orig_file_exte);
		$image = $image[0];
		if(isset($image->image_id)){
			$draw_size = $this->model->sel_draw_size_by_image_id($image->image_id);
			$draw_size = $draw_size[0];
		} else {
			$this->arr_ret_error["image_file"] = array("not_exists");
			$ret = false;
		}
		if($ret){
			$this->model->db->begin();
			$temp_image_file = $_FILES["image_file"]["tmp_name"];
			try{
				$im = new imagick($temp_image_file);
				$geo = $im->getImageGeometry();
				$width = $geo["width"];
				$height = $geo["height"];
				$draw_size = $this->model->sel_draw_size_by_image_id($image->image_id);
				$draw_size = $draw_size[0];
				if($height === $draw_size->width && $width === $draw_size->height){
					$im->rotateImage(new ImagickPixel(), ROTATE_ANGLE);
					$im->writeImage($temp_image_file);
					$geo = $im->getImageGeometry();
					$width = $geo["width"];
					$height = $geo["height"];
				}
			}catch(Exception $e){
				//File format error
				Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
				$this->arr_ret_error["image_file"] = array("file");
				$ret = false;
			}
			
			$up_image = new Db_Up();
			$up_image->image_id = $image->image_id;
			$up_image->orig_file_name = $orig_file_name_2;
			
			//Data file move
			if($ret){
				$client_dir = str_pad(strval($this->get_target_client_id()), CTS_FILE_PAD_LEN, "0", STR_PAD_LEFT) . "/";
				if(file_exists(ORIG_FILE_DIR . $client_dir) === false){
					mkdir(ORIG_FILE_DIR . $client_dir);
					chmod(ORIG_FILE_DIR . $client_dir, 0775);
				}
				if(file_exists(ORIG_FILE_DIR . $client_dir . IMAGE_FILE_DIR) === false){
					mkdir(ORIG_FILE_DIR . $client_dir . IMAGE_FILE_DIR);
					chmod(ORIG_FILE_DIR . $client_dir . IMAGE_FILE_DIR, 0775);
				}
				if(file_exists(ORIG_FILE_DIR . $image->orig_file_dir) === false){
					mkdir(ORIG_FILE_DIR . $image->orig_file_dir);
					chmod(ORIG_FILE_DIR . $image->orig_file_dir, 0775);
				}
				
				$temp_image_file = $_FILES["image_file"]["tmp_name"];
				$dest_image_file = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . $image->orig_file_exte;
				if(move_uploaded_file($temp_image_file, $dest_image_file)){
					chmod($dest_image_file, 0664);
					$up_image->orig_hash = hash_file(HASH_ALGO, $dest_image_file);
					$up_image->orig_file_size = filesize($dest_image_file);
				}
			}
			
			//DB update (image)
			if($ret){
				$ret = $this->model->up_image($up_image);
			}
		}
		return $this->model->db->end($ret);
	}
}