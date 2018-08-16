<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Playlistdl extends Controller_Template {
	private $playlist_id;
	private $file_name;

	/**
	 * Main controller
	 */
	public function action_index(){
		if($this->request->param("playlist_id", false) && $this->request->param("file_name", false)){
			$this->playlist_id = $this->request->param("playlist_id");
			$this->file_name = $this->request->param("file_name");

			switch($this->file_name){
				case STAND_ALONE_BAT_FILE_NAME:
					//bat download (logged in)
					parent::action_index_before();
					parent::disp_list_before();
					$this->bat_dl();
					parent::disp_list_after();
					break;
				case STAND_ALONE_XML_FILE_NAME:
					//XML file download (not logged in)
					$this->xml_dl();
					break;
				default:
					// Content file download (not logged in)
					$this->cts_dl();
					break;
			}
		} else {
			//Redirect to menu in case of illegal operation
			$this->request->redirect(MODULE_NAME_MENU);
		}
	}

	/**
	 * bat Download
	 */
	private function bat_dl(){
		$this->model = new Model_Playlistdl($this->get_target_client_id());

		//Playlist existence check
		$playlist = $this->model->sel_playlist($this->playlist_id);
		if(empty($playlist[0])){
			$this->request->redirect(MODULE_NAME_MENU);
		}

		//Acquire user password
		$user_id = Auth::instance()->get_user();
		$user = $this->model->sel_user($user_id);
		if(!empty($user[0])){
			$user = $user[0];
			$login_acnt = $user->login_acnt;
			$passwd = $user->passwd;
		}
		if(!empty($passwd)){
			//Set values in template Do not change view file for bat from SJIS / CRLF
			$this->auto_render = false;
			$this->template->url = URL::base("https") . $this->module_name . "/index/" . $login_acnt . "/" . $passwd . "/" .$this->playlist_id . "/" . STAND_ALONE_XML_FILE_NAME;
			$body = $this->template->render();
			$this->response->headers("Content-type", "application/octet-stream");
			$this->response->body($body);
		} else {
			//Unauthorized user
			$this->response->status(404);
		}
	}

	/**
	 * Download program guide file
	 */
	private function xml_dl(){
		$this->auto_render = false;
		$this->response->headers("Content-type", "application/octet-stream");
		if($this->request->param("login_acnt", false) && $this->request->param("passwd", false)){
			//If you are already logged in, log out
			if(Auth::instance()->logged_in() === true){
				Auth::instance()->logout(true);
			}

			//Login
			$login_acnt = $this->request->param("login_acnt");
			$passwd = $this->request->param("passwd");
			$is_login = Auth::instance()->login_hash($login_acnt, $passwd);
			if($is_login){
				//Authorized User
				$this->model = new Model_Playlistdl($this->get_target_client_id());
				$xml_dev_prog_dl = new Xml_Dev_Prog_Dl();
				$prog_Id = "999999";
				$sta_dt = "2000-01-01 00:00:00";
				$end_dt = "2038-01-01 00:00:00";
				$xml_prog = new Xml_Prog();
				$xml_prog->set_prog_id($prog_Id);
				$xml_prog->set_sta_dt($sta_dt);
				$xml_prog->set_end_dt($end_dt);

				//Generate program guide from program guide ID
				$playlist = $this->model->sel_playlist($this->playlist_id);
				if(!empty($playlist[0])){
					$playlist = $playlist[0];
					$xml_playlist = new Xml_Playlist();
					$playlist_id = $playlist->playlist_id;
					$draw_tmpl_id = $playlist->draw_tmpl_id;
					$image_intvl = $playlist->image_intvl;
					$ch = STAND_ALONE_CH;
					$xml_playlist->set_playlist_id($playlist_id);
					$xml_playlist->set_image_intvl($image_intvl);
					$xml_playlist->set_ch($ch);

					//text
					$arr_text = $this->model->sel_arr_active_text($playlist_id);
					foreach($arr_text as $text){
						$xml_text = new Xml_Text((array)$text);
						$xml_text->set_sta_dt($sta_dt);
						$xml_text->set_end_dt($end_dt);
						$xml_playlist->add_arr_text($xml_text);
					}

					//Video
					$arr_movie = $this->model->sel_arr_active_movie($playlist_id);
					foreach($arr_movie as $movie){
						$xml_movie = new Xml_Movie((array)$movie, $playlist_id, $login_acnt, $passwd, $this->request);
						$xml_movie->set_sta_dt($sta_dt);
						$xml_movie->set_end_dt($end_dt);
						$xml_playlist->add_arr_movie($xml_movie);
					}

					//image
					$arr_image = $this->model->sel_arr_active_image($playlist_id);
					foreach($arr_image as $image){
						$xml_image = new Xml_Image((array)$image, $playlist_id, $login_acnt, $passwd, $this->request);
						$xml_image->set_sta_dt($sta_dt);
						$xml_image->set_end_dt($end_dt);
						$xml_playlist->add_arr_image($xml_image);
					}

					//Merge image into movie due to restriction by terminal side processing (limited to movie of single drawing area)
					$arr_draw_area = $this->model->sel_arr_draw_area($draw_tmpl_id);
					if(!empty($arr_draw_area[0])){
						if(count($arr_draw_area) === 1 && $arr_draw_area[0]->cts_type === "movie"){
							$arr_tmp_movie = array();
							foreach($xml_playlist->get_arr_image() as $image){
								$tmp_movie_image_row = array();
								$tmp_movie_image_row["movie_id"] = "image_" . $image->get_image_id();
								$tmp_movie_image_row["movie_name"] = $image->get_image_name();
								$tmp_movie_image_row["display_order"] = $image->get_display_order();
								$tmp_movie_image_row["play_time"] = null;
								$tmp_movie_image_row["orig_file_dir"] = null;
								$tmp_movie_image_row["enc_file_dir"] = null;
								$tmp_movie_image_row["active_file_dir"] = null;
								$tmp_movie_image_row["movie_orig_file_size"] = null;
								$tmp_movie_image_row["sound_orig_file_size"] = null;
								$tmp_movie_image_row["movie_enc_file_size"] = null;
								$tmp_movie_image_row["sound_enc_file_size"] = null;
								$tmp_movie_image_row["movie_orig_hash"] = null;
								$tmp_movie_image_row["sound_orig_hash"] = null;
								$tmp_movie_image_row["movie_enc_hash"] = null;
								$tmp_movie_image_row["sound_enc_hash"] = null;
								$tmp_movie_image_row["movie_orig_file_exte"] = null;
								$tmp_movie_image_row["sound_orig_file_exte"] = null;
								$tmp_movie_image_row["movie_enc_file_exte"] = null;
								$tmp_movie_image_row["sound_enc_file_exte"] = null;
								$tmp_movie_image_row["sta_dt"] = $image->get_sta_dt();
								$tmp_movie_image_row["end_dt"] = $image->get_end_dt();
								$tmp_movie_image_row["file_name"] = null;
								$tmp_movie_image_row["x"] = $image->get_x();;
								$tmp_movie_image_row["y"] = $image->get_y();
								$tmp_movie_image_row["width"] = $image->get_width();
								$tmp_movie_image_row["height"] = $image->get_height();

								$xml_movie = new Xml_Movie($tmp_movie_image_row, $playlist_id, $login_acnt, $passwd, $this->request);
								$xml_movie->set_movie_file($image->get_image_file());
								$arr_tmp_movie[$image->get_display_order()] = $xml_movie;
							}
							foreach($xml_playlist->get_arr_movie() as $movie){
								$arr_tmp_movie[$movie->get_display_order()] = $movie;
							}
							ksort($arr_tmp_movie);
							$xml_playlist->set_arr_movie($arr_tmp_movie);
							$xml_playlist->set_arr_image(array());
						}
					}
					$xml_prog->add_arr_playlist($xml_playlist);
				}
				$xml_dev_prog_dl->add_arr_prog($xml_prog);
				$this->response->body($xml_dev_prog_dl->get_xml());
			} else {
				//Unauthorized user
				$this->response->status(404);
			}
		} else {
			//Illegal operation
			$this->response->status(404);
		}
	}

	/**
	 * Content file download
	 */
	private function cts_dl(){
		$this->auto_render = false;
		if($this->request->param("login_acnt", false) && $this->request->param("passwd", false) && $this->request->param("file_exte", false) && $this->request->param("cts_cat", false)){
			//If you are already logged in, log out
			if(Auth::instance()->logged_in() === true){
				Auth::instance()->logout(true);
			}

			//Login
			$login_acnt = $this->request->param("login_acnt");
			$passwd = $this->request->param("passwd");
			$cts_cat = $this->request->param("cts_cat");
			$is_login = Auth::instance()->login_hash($login_acnt, $passwd);
			if($is_login){
				//Authorized User
				$this->model = new Model_Playlistdl($this->get_target_client_id());
				$file_exte = "." . $this->request->param("file_exte");

				//Confirm that the specified file exists in the specified playlist
				if($cts_cat === "movie"){
					$cts = $this->model->sel_arr_movie_by_playlist_id_file_name_exte($this->playlist_id, $this->file_name, $file_exte);
				} else if($cts_cat === "image"){
					$cts = $this->model->sel_arr_image_by_playlist_id_file_name_exte($this->playlist_id, $this->file_name, $file_exte);
				} else {
					//Illegal operation
					$this->response->status(404);
				}
				if(!empty($cts[0])){
					//File return
					$cts = $cts[0];
					$file = ORIG_FILE_DIR . $cts->orig_file_dir . $this->file_name . $file_exte;
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
				//Unauthorized user
				$this->response->status(404);
			}
		} else {
			//Illegal operation
			$this->response->status(404);
		}

		//ログアウト
		if(Auth::instance()->logged_in() === true){
			Auth::instance()->logout(true);
		}
	}
}
