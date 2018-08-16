<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Util extends Model
{
	/**
	 * Retrieve store tag list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_shop_tag($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_shop_tag = new Model_M_Shop_Tag($db, $client_id);
			$ret = $m_shop_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get terminal tag list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_dev_tag($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_dev_tag = new Model_M_Dev_Tag($db, $client_id);
			$ret = $m_dev_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get movie tag list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_movie_tag($client_id)
	{
		$ret = true;
		try{
//			if(isset($client_id)){
				$db = Database::instance();
				$m_movie_tag = new Model_M_Movie_Tag($db, $client_id);
				$ret = $m_movie_tag->sel_arr_id_name();
//			} else {
//				$ret = false;
//			}
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get image tag list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_image_tag($client_id)
	{
		$ret = true;
		try{
//			if(isset($client_id)){
				$db = Database::instance();
				$m_image_tag = new Model_M_Image_Tag($db, $client_id);
				$ret = $m_image_tag->sel_arr_id_name();
//			} else {
//				$ret = false;
//			}
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get text tag list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_text_tag($client_id)
	{
		$ret = true;
		try{
			if(isset($client_id)){
				$db = Database::instance();
				$m_text_tag = new Model_M_Text_Tag($db, $client_id);
				$ret = $m_text_tag->sel_arr_id_name();
			} else {
				$ret = false;
			}
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get HTML tag list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_html_tag($client_id)
	{
		$ret = true;
		try{
			if(isset($client_id)){
				$db = Database::instance();
				$m_html_tag = new Model_M_Html_Tag($db, $client_id);
				$ret = $m_html_tag->sel_arr_id_name();
			} else {
				$ret = false;
			}
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get attribute list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_property($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_property = new Model_M_Property($db, $client_id);
			$ret = $m_property->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Acquire all common movie
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_common_movie($ants_version, $exclude_swf = false, $rotate_flag = null, $get_tag_flag = false)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_common_movie = new Model_M_Common_Movie($db);
			$ret = $m_common_movie->sel_arr_movie_id_name($ants_version, $exclude_swf, $rotate_flag, $get_tag_flag);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Acquire all common sound
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_common_sound()
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_common_movie = new Model_M_Common_Movie($db);
			$ret = $m_common_movie->sel_arr_sound_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get all text
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_common_text()
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_common_text = new Model_M_Common_Text($db);
			$ret = $m_common_text->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Acquire all movies
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_movie($ants_version, $client_id, $exclude_swf, $rotate_flag = null, $get_tag_flag = false)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_movie = new Model_M_Movie($db, $client_id);
			$ret = $m_movie->sel_arr_movie_id_name($ants_version, $exclude_swf, $rotate_flag, $get_tag_flag);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get movie list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public static function sel_arr_movie_list($client_id, $search = null)
	{
		//Search condition
		if(isset($search->movie_id) && $search->movie_id !== ""){
			$movie_id = $search->movie_id;
		}
		if(isset($search->client_id) && $search->client_id !== ""){
			$this->client_id = $search->client_id;
		}
		if(isset($search->ad_flag) && $search->ad_flag !== ""){
			$ad_flag = $search->ad_flag;
		}
		if(isset($search->movie_date) && $search->movie_date !== ""){
			$sta_dt = $search->movie_date . " 00:00:00";
			$end_dt = $search->movie_date . " 23:59:59";
		}
		
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}
		$arr_playlist_id = array();
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			array_push($arr_playlist_id, $search->playlist_id);
		}
		if(isset($search->movie_tag_1) && $search->movie_tag_1 !== ""){
			$movie_tag_1 = $search->movie_tag_1;
		}
		if(isset($search->movie_tag_2) && $search->movie_tag_2 !== ""){
			$movie_tag_2 = $search->movie_tag_2;
		}
		$tag_and_or = "and";
		if(isset($search->tag_and_or) && $search->tag_and_or !== ""){
			$tag_and_or = $search->tag_and_or;
		}
		$offset = $search->offset;
		
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.image_id, ";
		$query_str .= "	m_movie.movie_name, ";
		$query_str .= "	m_movie.ad_flag, ";
		$query_str .= "	m_movie.play_time, ";
		$query_str .= "	m_movie.rotate_flag, ";
		$query_str .= "	m_movie.ad_flag, ";
		$query_str .= "	m_movie.orig_file_dir, ";
		$query_str .= "	m_movie.file_name, ";
		$query_str .= "	m_movie.movie_orig_file_name, ";
		$query_str .= "	m_movie.movie_orig_file_exte, ";
		$query_str .= "	m_movie.movie_enc_file_size, ";
		$query_str .= "	m_movie.sound_orig_file_name, ";
		$query_str .= "	m_movie.sound_orig_file_exte, ";
		$query_str .= "	m_movie.sound_enc_file_size, ";
		$query_str .= "	m_movie.sta_dt, ";
		$query_str .= "	m_movie.end_dt, ";
		$query_str .= "	m_movie.property_id, ";
		$query_str .= "	m_movie.update_user, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_movie.client_id = m_client.client_id and ";
		//Search condition (client name) added
		if(!empty($arr_client_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_client_name as $client_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_client.client_name ilike :client_name_" . $i ;
				$arr_bind_param[":client_name_" . $i] = "%" . $client_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		
		// Valid period determination
		if(!empty($sta_dt) && sta_dt !== ""){
			$query_str .= "	m_movie.sta_dt <= :end_dt and ";
			$query_str .= "	(m_movie.end_dt > :sta_dt or m_movie.end_dt is null) and ";
			
			$arr_bind_param[":sta_dt"] = $sta_dt;
			$arr_bind_param[":end_dt"] = $end_dt;
		}
		
		//Add search condition (tag)
		if(isset($movie_tag_1) && isset($movie_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($movie_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_movie_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_movie_tag_rela.movie_id = m_movie.movie_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_movie_tag_rela.movie_tag_id = :movie_tag_id_1 ";
			$arr_bind_param[":movie_tag_id_1"] = $movie_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_movie_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_movie_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($movie_tag_1) && isset($movie_tag_2)){
			if($tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($movie_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_movie_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_movie_tag_rela.movie_id = m_movie.movie_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_movie_tag_rela.movie_tag_id = :movie_tag_id_2 ";
			$arr_bind_param[":movie_tag_id_2"] = $movie_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_movie_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_movie_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($movie_tag_1) && isset($movie_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($movie_tag_1) || isset($movie_tag_2)){
			$query_str .= " and ";
		}
		
		//Add search condition (playlist ID)
		if(!empty($arr_playlist_id)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_movie_rela ";
			$query_str .= "		where ";
			$query_str .= "			m_movie.movie_id = t_playlist_movie_rela.movie_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_playlist_id as $playlist_id){
				if($i > 0){
					 $query_str .= " or ";
				}
				$query_str .= "				t_playlist_movie_rela.playlist_id = :playlist_id_" . $i;
				$arr_bind_param[":playlist_id_" . $i] = $playlist_id;
				$i++;
			}
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_playlist_movie_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_playlist_movie_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}
		
		//Search condition (Movie name) added
		if(!empty($arr_movie_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_movie_name as $movie_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_movie.movie_name ilike :movie_name_" . $i ;
				$arr_bind_param[":movie_name_" . $i] = "%" . $movie_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		//Add search condition (movie name)
		if(isset($movie_id)){
			$query_str .= "	m_movie.movie_id = :movie_id and ";
			$arr_bind_param[":movie_id"] = $movie_id;
		}
		//Add search condition (advertisement type)
		if(isset($ad_flag)){
			$query_str .= "	m_movie.ad_flag = :ad_flag and ";
			$arr_bind_param[":ad_flag"] = $ad_flag;
		}
		
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "order by ";
		if(is_null($this->client_id)){
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	convert_to(m_movie.movie_name,'UTF8'), ";
		$query_str .= "	m_movie.movie_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Acquire all sounds
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_sound($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_movie = new Model_M_Movie($db, $client_id);
			$ret = $m_movie->sel_arr_sound_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get all text
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_text($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_text = new Model_M_Text($db, $client_id);
			$ret = $m_text->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Acquire all HTML
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_html($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_html = new Model_M_Html($db, $client_id);
			$ret = $m_html->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get playlist list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_playlist($ants_version = null , $client_id)
	{
		$ret = true;
		try{
//			if(isset($client_id)){
				$db = Database::instance();
				$t_playlist = new Model_T_Playlist($db, $client_id);
				$ret = $t_playlist->sel_arr_id_name($ants_version);
//			} else {
//				$ret = false;
//			}
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get playlist list (all clients)
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_playlist_client()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.playlist_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.client_id = m_client.client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.playlist_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	
	/**
	 * Get common playlist list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_commonplaylist($ants_version = null , $client_id)
	{
		$ret = true;
		try{
//			if(isset($client_id)){
				$db = Database::instance();
				$t_playlist = new Model_T_Commonplaylist($db, $client_id);
				$ret = $t_playlist->sel_arr_id_name($ants_version);
//			} else {
//				$ret = false;
//			}
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get playlist list (all clients)
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_commonplaylist_client()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.playlist_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.client_id = m_client.client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.playlist_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Get client list
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_client()
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_client = new Model_M_Client($db);
			$ret = $m_client->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get client
	 * 
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_client_max_total_cts_file_size($client_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_client.max_total_cts_file_size ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	m_client.client_id = :client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		
		$arr_bind_param[":client_id"] = $client_id;
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Acquire store list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_shop($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_shop = new Model_M_Shop($db, $client_id);
			$ret = $m_shop->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Booth list acquisition
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_booth($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_booth = new Model_M_Booth($db, $client_id);
			$ret = $m_booth->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Floor list acquisition
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_floor($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_floor = new Model_M_Floor($db, $client_id);
			$ret = $m_floor->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Acquisition of distribution time list
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_time_zone($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_timezone = new Model_M_Timezone($db, $client_id);
			$ret = $m_timezone->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Acquire module list
	 * 
	 * @return	array				Acquisition record
	 */
	public static function sel_arr_module()
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_module = new Model_M_Module($db);
			$ret = $m_module->sel_arr_module();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Acquire authority list
	 * 
	 * @param String	$module		module
	 * @return	array				Acquisition record
	 */
	public static function sel_arr_auth_by_module($module)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_auth.auth_id, ";
		$query_str .= "	m_func.func_name as auth_name, ";
		$query_str .= "	m_func.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_auth ";
		$query_str .= "join ";
		$query_str .= "	m_module ";
		$query_str .= "on ";
		$query_str .= "	m_module.module = :module and ";
		$query_str .= "	m_auth.module_id = m_module.module_id and ";
		$query_str .= "	m_module.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_func ";
		$query_str .= "on ";
		$query_str .= "	m_auth.func_id = m_func.func_id and ";
		$query_str .= "	m_func.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_auth.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_func.display_order, ";
		$query_str .= "	m_auth.auth_id ";
		
		$arr_bind_param[":module"] = $module;
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Acquire authority group list
	 * 
	 * @param String	$client_id	Client ID
	 * @return	array				Acquisition record
	 */
	public static function sel_arr_auth_grp($client_id)
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_auth_grp = new Model_M_Auth_Grp($db, $client_id);
			$ret = $m_auth_grp->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get user name
	 * 
	 * @param String	$client_id	Client ID
	 * @param String	$user_id	User ID
	 * @return array				Acquisition record
	 */
	public static function sel_user_name($client_id, $user_id)
	{
		$ret = true;
		try{
			if(isset($client_id)){
				$db = Database::instance();
				$m_user = new Model_M_User($db, $client_id);
				$ret = $m_user->sel_name($user_id);
			} else {
				$ret = false;
			}
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get drawing area template all
	 *
	 * @return array				Acquisition record
	 */
	public static function sel_arr_draw_tmpl()
	{
		$ret = true;
		try{
			$db = Database::instance();
			$m_draw_tmpl = new Model_M_Draw_Tmpl($db);
			$ret = $m_draw_tmpl->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get image drawing size list
	 *
	 * @return array					Acquisition record
	 */
	public static function sel_arr_image_draw_size()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_draw_size.draw_size_id, ";
		$query_str .= "	m_draw_size.draw_size_name, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height ";
		$query_str .= "from ";
		$query_str .= "	m_draw_size ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			m_draw_area.draw_area_id ";
		$query_str .= "		from ";
		$query_str .= "			m_draw_area ";
		$query_str .= "		where ";
		$query_str .= "			m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "			m_draw_area.cts_type = 'image' and ";
		$query_str .= "			m_draw_area.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_draw_size.width desc, ";
		$query_str .= "	m_draw_size.height desc, ";
		$query_str .= "	m_draw_size.draw_size_name, ";
		$query_str .= "	m_draw_size.draw_size_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Get image list
	 *
	 * @param String	$draw_size_id	Drawing size ID
	 * @param String	$rotate_flag	Rotation flag 
	 * @return array					Acquisition record
	 */
	public static function sel_arr_common_image_by_draw_size_id_rotate_flag($draw_size_id, $rotate_flag)
	{
		$query_str = "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	m_common_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "join ";
		$query_str .= "	t_image_draw_size_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_image.image_id = t_image_draw_size_rela.image_id and ";
		$query_str .= "	t_image_draw_size_rela.rotate_flag = :rotate_flag and ";
		$query_str .= "	t_image_draw_size_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_image_draw_size_rela.draw_size_id = :draw_size_id and ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_common_image.image_name, ";
		$query_str .= "	m_common_image.image_id desc ";
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_size_id"] = $draw_size_id;
		$arr_bind_param[":rotate_flag"] = $rotate_flag;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Get image list
	 *
	 * @return array					Acquisition record
	 */
	public static function sel_arr_common_image_all()
	{
		$query_str = "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	m_common_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_common_image.image_name, ";
		$query_str .= "	m_common_image.image_id desc ";
	
		$arr_bind_param = array();

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute(Database::instance(), true);

	
	}

	/**
	 * Get image list
	 *
	 * @param String	$draw_size_id	Drawing size ID
	 * @return array					Acquisition record
	 */
	public static function sel_arr_common_image_by_draw_tmpl_id($draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	m_common_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		if(isset($draw_tmpl_id)){
			if((string)$draw_tmpl_id === "5"){
				$query_str .= "	m_common_image.width = 1280 and ";
				$query_str .= "	m_common_image.height = 720 and ";
			}
		}
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_common_image.image_name, ";
		$query_str .= "	m_common_image.image_id desc ";
	
		$arr_bind_param = array();

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Get image list
	 *
	 * @param String	$client_id		Client ID
	 * @param String	$draw_size_id	Drawing size ID
	 * @param String	$rotate_flag	Rotation flag 
	 * @return array					Acquisition record
	 */
	public static function sel_arr_image_by_draw_size_id_rotate_flag($client_id, $draw_size_id, $rotate_flag)
	{
		$query_str = "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "join ";
		$query_str .= "	t_image_draw_size_rela ";
		$query_str .= "on ";
		$query_str .= "	m_image.image_id = t_image_draw_size_rela.image_id and ";
		$query_str .= "	t_image_draw_size_rela.rotate_flag = :rotate_flag and ";
		$query_str .= "	t_image_draw_size_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_image_draw_size_rela.draw_size_id = :draw_size_id and ";
		if(isset($client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	image_name, ";
		$query_str .= "	image_id desc ";
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_size_id"] = $draw_size_id;
		$arr_bind_param[":rotate_flag"] = $rotate_flag;
		if(isset($client_id)){
			$arr_bind_param[":client_id"] = $client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}

	/**
	 * Get image list
	 *
	 * @param String	$client_id		Client ID
	 * @return array					Acquisition record
	 */
	public static function sel_arr_image_all($client_id)
	{
		$query_str = "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "where ";
		if(isset($client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	image_name, ";
		$query_str .= "	image_id desc ";
	
		$arr_bind_param = array();
		if(isset($client_id)){
			$arr_bind_param[":client_id"] = $client_id;
		}
	
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Get image list
	 *
	 * @param String	$client_id		Client ID
	 * @param String	$draw_size_id	Drawing size ID
	 * @return array					Acquisition record
	 */
	public static function sel_arr_image_by_draw_tmpl_id($client_id, $draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "where ";
		if(isset($client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		if(isset($draw_tmpl_id)){
			if((string)$draw_tmpl_id === "5"){
				$query_str .= "	m_image.width = 1280 and ";
				$query_str .= "	m_image.height = 720 and ";				
			}
		}
		
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	image_name, ";
		$query_str .= "	image_id desc ";
	
		$arr_bind_param = array();
		if(isset($client_id)){
			$arr_bind_param[":client_id"] = $client_id;
		}
	
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute(Database::instance(), true);
	}
	
	
	/**
	 * Acquire image rendering area list from template ID
	 *
	 * @param String	$draw_tmpl_id	Drawing template ID
	 * @return array					Acquisition record
	 */
	public static function sel_arr_image_draw_area_by_draw_tmpl_id($draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	m_draw_area.draw_area_id ";
		$query_str .= "from ";
		$query_str .= "	m_draw_area ";
		$query_str .= "where ";
		$query_str .= "	m_draw_area.draw_tmpl_id = :draw_tmpl_id and ";
		$query_str .= "	m_draw_area.cts_type = 'image' and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_tmpl_id"] = $draw_tmpl_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Get rendering area list from template ID
	 *
	 * @param String	$draw_tmpl_id	Drawing template ID
	 * @return array					Acquisition record
	 */
	public static function sel_arr_draw_area_by_draw_tmpl_id($draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	m_draw_area.cts_type ";
		$query_str .= "from ";
		$query_str .= "	m_draw_area ";
		$query_str .= "where ";
		$query_str .= "	m_draw_area.draw_tmpl_id = :draw_tmpl_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_tmpl_id"] = $draw_tmpl_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Get terminal name · store name list
	 *
	 * @param String	$client_id	Client ID
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public static function sel_arr_dev_shop($client_id, $search = null)
	{
		//Search condition
		if(isset($search->arr_serial_no)){
			$arr_serial_no = $search->arr_serial_no;
		}
		if(isset($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(isset($search->arr_note)){
			$arr_note = $search->arr_note;
		}
		if(isset($search->dev_tag_1) && $search->dev_tag_1 !== ""){
			$dev_tag_1 = $search->dev_tag_1;
		}
		if(isset($search->dev_tag_2) && $search->dev_tag_2 !== ""){
			$dev_tag_2 = $search->dev_tag_2;
		}
		$dev_tag_and_or = "and";
		if(isset($search->dev_tag_and_or) && $search->dev_tag_and_or !== ""){
			$dev_tag_and_or = $search->dev_tag_and_or;
		}
		if(isset($search->arr_shop_name)){
			$arr_shop_name = $search->arr_shop_name;
		}
		if(isset($search->shop_tag_1) && $search->shop_tag_1 !== ""){
			$shop_tag_1 = $search->shop_tag_1;
		}
		if(isset($search->shop_tag_2) && $search->shop_tag_2 !== ""){
			$shop_tag_2 = $search->shop_tag_2;
		}
		$shop_tag_and_or = "and";
		if(isset($search->shop_tag_and_or) && $search->shop_tag_and_or !== ""){
			$shop_tag_and_or = $search->shop_tag_and_or;
		}
		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.serial_no, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.invalid_flag, ";
		$query_str .= "	m_shop.shop_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "where ";
		
		//Search condition (terminal tag) addition
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($dev_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_dev_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_dev_tag_rela.dev_id = m_dev.dev_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_dev_tag_rela.dev_tag_id = :dev_tag_id_1 ";
			$arr_bind_param[":dev_tag_id_1"] = $dev_tag_1;
			$query_str .= "			) and ";
			if(isset($client_id)){
				$query_str .= "			t_dev_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_dev_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			if($dev_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($dev_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_dev_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_dev_tag_rela.dev_id = m_dev.dev_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_dev_tag_rela.dev_tag_id = :dev_tag_id_2 ";
			$arr_bind_param[":dev_tag_id_2"] = $dev_tag_2;
			$query_str .= "			) and ";
			if(isset($client_id)){
				$query_str .= "			t_dev_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_dev_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($dev_tag_1) || isset($dev_tag_2)){
			$query_str .= " and ";
		}
		
		//Add search condition (store tag)
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($shop_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_shop_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_shop_tag_rela.shop_id = m_dev.shop_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_shop_tag_rela.shop_tag_id = :shop_tag_id_1 ";
			$arr_bind_param[":shop_tag_id_1"] = $shop_tag_1;
			$query_str .= "			) and ";
			if(isset($client_id)){
				$query_str .= "			t_shop_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_shop_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			if($shop_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($shop_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_shop_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_shop_tag_rela.shop_id = m_dev.shop_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_shop_tag_rela.shop_tag_id = :shop_tag_id_2 ";
			$arr_bind_param[":shop_tag_id_2"] = $shop_tag_2;
			$query_str .= "			) and ";
			if(isset($client_id)){
				$query_str .= "			t_shop_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_shop_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($shop_tag_1) || isset($shop_tag_2)){
			$query_str .= " and ";
		}
		
		//Add search condition (serial number)
		if(!empty($arr_serial_no)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_serial_no as $serial_no){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.serial_no ilike :serial_no_" . $i . " ";
				$arr_bind_param[":serial_no_" . $i] = "%" . $serial_no . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		
		//Search condition (terminal name) added
		if(!empty($arr_dev_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_dev_name as $dev_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.dev_name ilike :dev_name_" . $i . " ";
				$arr_bind_param[":dev_name_" . $i] = "%" . $dev_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		
		//Search condition (terminal name) added
		if(!empty($arr_note)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_note as $note){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.note ilike :note_" . $i . " ";
				$arr_bind_param[":note_" . $i] = "%" . $note . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		
		//Add search condition (store name)
		if(!empty($arr_shop_name)){
			$i = 0;
			foreach($arr_shop_name as $shop_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "				m_shop.shop_name ilike :shop_name" . $i . " ";
				$arr_bind_param[":shop_name" . $i] =  "%" . $shop_name . "%";
				$i++;
			}
			$query_str .= "	and ";
		}

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " m_dev.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}

		$query_str .= "	m_dev.invalid_flag = 0 and ";
		if(isset($client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $client_id;
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.dev_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute(Database::instance(), true);
	}
	
	/**
	 * Acquisition service acquisition
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public static function sel_arr_service($client_id)
	{
		$arr_bind_param = array();
	
		$query_str = "select ";
		$query_str .= "	m_service.service_id, ";
		$query_str .= "	m_service.service_name ";
		$query_str .= "from ";
		$query_str .= "	m_service ";
		$query_str .= "where ";
		$query_str .= "	m_service.del_flag = 0 ";
	
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute(Database::instance(), true);
	}
}
