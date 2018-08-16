<?php defined('SYSPATH') or die('No direct script access.');

class File extends Kohana_File {
	public static function echo_file($file_path){
		header("Content-Length: " . filesize($file_path));
		$handle = fopen($file_path, "r");
		while(!feof($handle)) {
			$buffer = fread($handle, CHUNK_SIZE);
			echo $buffer;
			ob_flush();
			flush();
		}
		$status = fclose($handle);
	}
	
	public static function get_client_file_size($client_dir){
		$cmd = exec("du -s -b " . ORIG_FILE_DIR . $client_dir);
		if(preg_match("([0-9]+)", $cmd, $reg)){
			$all_file_size = (int)$reg[0];
		} else {
			$all_file_size = 0;
		}
		return $all_file_size;
	}
	
	
	
	public static function get_all_movie_size($client_dir){
		$cmd = exec("du -s -b " . ENC_FILE_DIR . $client_dir . MOVIE_FILE_DIR);
		if(preg_match("([0-9]+)", $cmd, $reg)){
			$all_file_size = (int)$reg[0];
		} else {
			$all_file_size = 0;
		}
		return $all_file_size;
	}
	
	public static function get_all_image_size($client_dir){
		$cmd = exec("du -s -b " . ENC_FILE_DIR . $client_dir . IMAGE_FILE_DIR);
		if(preg_match("([0-9]+)", $cmd, $reg)){
			$all_file_size = (int)$reg[0];
		} else {
			$all_file_size = 0;
		}
		return $all_file_size;
	}
	
	public static function get_all_html_size($client_dir){
		$cmd = exec("du -s -b " . ENC_FILE_DIR . $client_dir . HTML_FILE_DIR);
		if(preg_match("([0-9]+)", $cmd, $reg)){
			$all_file_size = (int)$reg[0];
		} else {
			$all_file_size = 0;
		}
		return $all_file_size;
	}
	
	public static function del_movie_files(stdClass $movie){
		File::del_movie_orig_file($movie);
		File::del_movie_enc_file($movie);
		File::del_sound_orig_file($movie);
		File::del_sound_enc_file($movie);
		File::del_480p_movie_orig_file($movie);
		File::del_480p_movie_enc_file($movie);
		}
	
	public static function del_movie_orig_file(stdClass $movie){
		$ret = false;
		if(isset($movie->movie_orig_file_exte) && $movie->movie_orig_file_exte !== ""){
			$movie_orig_file_path = ORIG_FILE_DIR . $movie->orig_file_dir . $movie->file_name . $movie->movie_orig_file_exte;
			$ret = File::del_file($movie_orig_file_path);
		}
		return $ret;
	}
	
	public static function del_movie_enc_file(stdClass $movie){
		$ret = false;
		if(isset($movie->movie_enc_file_exte) && $movie->movie_enc_file_exte !== ""){
			$movie_enc_file_path = ENC_FILE_DIR . $movie->enc_file_dir . $movie->file_name . $movie->movie_enc_file_exte;
			$ret = File::del_file($movie_enc_file_path);
		}
		return $ret;
	}
	
	public static function del_sound_orig_file(stdClass $movie){
		$ret = false;
		if(isset($movie->sound_orig_file_exte) && $movie->sound_orig_file_exte !== ""){
			$sound_orig_file_path = ORIG_FILE_DIR . $movie->orig_file_dir . $movie->file_name . $movie->sound_orig_file_exte;
			$ret = File::del_file($sound_orig_file_path);
		}
		return $ret;
	}
	
	public static function del_sound_enc_file(stdClass $movie){
		$ret = false;
		if(isset($movie->sound_enc_file_exte) && $movie->sound_enc_file_exte !== ""){
			$sound_enc_file_path = ENC_FILE_DIR . $movie->enc_file_dir . $movie->file_name . $movie->sound_enc_file_exte;
			$ret = File::del_file($sound_enc_file_path);
		}
		return $ret;
	}
	
	public static function del_480p_movie_orig_file(stdClass $movie){
		$ret = false;
		if(isset($movie->movie_orig_file_name_480p) && $movie->movie_orig_file_exte_480p !== ""){
			$movie_480p_orig_file_path = ORIG_FILE_DIR . $movie->orig_file_dir . $movie->file_name . "_480p" . $movie->movie_orig_file_exte_480p;
			$ret = File::del_file($movie_480p_orig_file_path);
		}
		return $ret;
	}
	
	public static function del_480p_movie_enc_file(stdClass $movie){
		$ret = false;
		if(isset($movie->movie_enc_file_exte_480p) && $movie->movie_enc_file_exte_480p !== ""){
			$movie_480p_enc_file_path = ENC_FILE_DIR . $movie->enc_file_dir . $movie->file_name . "_480p" . $movie->movie_enc_file_exte_480p;
			$ret = File::del_file($movie_480p_enc_file_path);
		}
		return $ret;
	}
	
	public static function del_image_files(stdClass $image){
		File::del_image_orig_file($image);
		File::del_image_thum_file($image);
		File::del_image_enc_file($image);
	}
	
	public static function del_image_orig_file(stdClass $image){
		$ret = false;
		if(isset($image->orig_file_exte) && $image->orig_file_exte !== ""){
			$image_orig_file_path = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . $image->orig_file_exte;
			$ret = File::del_file($image_orig_file_path);
		}
		return $ret;
	}
	
	public static function del_image_thum_file(stdClass $image){
		$ret = false;
		if(isset($image->orig_file_exte) && $image->orig_file_exte !== ""){
			$image_thum_file_path = ORIG_FILE_DIR . $image->orig_file_dir . $image->file_name . "_thum" . $image->orig_file_exte;
			$ret = File::del_file($image_thum_file_path);
		}
		return $ret;
	}
	
	public static function del_image_enc_file(stdClass $image){
		$ret = false;
		if(isset($image->enc_file_exte) && $image->enc_file_exte !== ""){
			$image_enc_file_path = ENC_FILE_DIR . $image->enc_file_dir . $image->file_name . $image->enc_file_exte;
			$ret = File::del_file($image_enc_file_path);
		}
		return $ret;
	}
	
	public static function del_html_files(stdClass $html){
		File::del_html_orig_file($html);
		File::del_html_enc_file($html);
	}
	
	public static function del_html_orig_file(stdClass $html){
		$ret = false;
		if(isset($html->orig_file_exte) && $html->orig_file_exte !== ""){
			$html_orig_file_path = ORIG_FILE_DIR . $html->orig_file_dir . $html->file_name . $html->orig_file_exte;
			$ret = File::del_file($html_orig_file_path);
		}
		return $ret;
	}
	
	public static function del_html_enc_file(stdClass $html){
		$ret = false;
		if(isset($html->enc_file_exte) && $html->enc_file_exte !== ""){
			$html_enc_file_path = ENC_FILE_DIR . $html->enc_file_dir . $html->file_name . $html->enc_file_exte;
			$ret = File::del_file($html_enc_file_path);
		}
		return $ret;
	}
	
	public static function del_file($file_path){
		$ret = false;
		if(is_file($file_path)){
			$ret = unlink($file_path);
		}
		return $ret;
	}
}
