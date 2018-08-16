<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Movie extends Model
{
	public $db;
	public $client_id;

	public function __construct($client_id)
	{
		$this->db = Database::instance();
		if($client_id !== false){
			$this->client_id = $client_id;
		} else {
			$this->client_id = null;
		}
		$this->client_id = null; // 20180109 hit_update
	}

	/**
	 * Acquire all movies
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_movie($search)
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

		$arr_bind_param = array();
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;

		$query_str = "select ";
		$query_str .= "	count(movie.movie_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_movie.movie_id ";
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
//		$query_str .= "join ";
//		$query_str .= "	m_image ";
//		$query_str .= "on ";
//		$query_str .= "	m_movie.image_id = m_image.image_id and ";
//		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "where ";

		// Valid period determination
		if(!empty($sta_dt) && sta_dt !== ""){
			$query_str .= "	m_movie.sta_dt <= :end_dt and ";
			$query_str .= "	(m_movie.end_dt > :sta_dt or m_movie.end_dt is null) and ";
		}
		//Add search condition (advertisement type)
		if(isset($ad_flag)){
			$query_str .= "	m_movie.ad_flag = :ad_flag and ";
			$arr_bind_param[":ad_flag"] = $ad_flag;
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
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= ") movie ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get movie list
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_movie($search)
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
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;

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
//		$query_str .= "join ";
//		$query_str .= "	m_image ";
//		$query_str .= "on ";
//		$query_str .= "	m_movie.image_id = m_image.image_id and ";
//		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "where ";

		// Valid period determination
		if(!empty($sta_dt) && sta_dt !== ""){
			$query_str .= "	m_movie.sta_dt <= :end_dt and ";
			$query_str .= "	(m_movie.end_dt > :sta_dt or m_movie.end_dt is null) and ";
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

		//Search condition (Movie name) addeds
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
		//Add search condition (video name)
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

		return $query->execute($this->db, true);
	}

	/**
	 * Movie acquisition
	 *
	 * @param String	$movie_id	Video ID
	 * @return array				Acquisition record
	 */
	public function sel_movie($movie_id)
	{
		$ret = true;
		try{
			$m_movie = new Model_M_Movie($this->db, $this->client_id);
			$ret = $m_movie->sel($movie_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Video tag acquisition
	 *
	 * @param String	$movie_id	Video ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_movie_tag_by_movie_id($movie_id)
	{
		$query_str = "select ";
		$query_str .= "	m_movie_tag.movie_tag_id, ";
		$query_str .= "	m_movie_tag.movie_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_movie_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_movie_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_movie ";
		$query_str .= "		on ";
		$query_str .= "			t_movie_tag_rela.movie_id = m_movie.movie_id and ";
		$query_str .= "			m_movie.movie_id = :movie_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_movie.client_id = :client_id and ";
		}
		$query_str .= "			m_movie.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_movie_tag.movie_tag_id = t_movie_tag_rela.movie_tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_movie_tag_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_movie_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	m_movie_tag.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_movie_tag.movie_tag_name, ";
		$query_str .= "	m_movie_tag.movie_tag_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":movie_id"] = $movie_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get video name
	 *
	 * @param String	$movie_id		Video ID
	 * @return array					Acquisition record
	 */
	public function sel_movie_name($movie_id)
	{
		$query_str = "select ";
		$query_str .= "	m_movie.movie_name ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "where ";
		$query_str .= "	m_movie.movie_id = :movie_id and ";
		$query_str .= "	m_movie.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":movie_id"] = $movie_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get the name of the playlist that is using the animation of the argument
	 *
	 * @param String	$movie_id		Video ID
	 * @return array					Acquisition record
	 */
	public function sel_arr_playlist_by_movie_id($movie_id)
	{
		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_playlist_movie_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_movie ";
		$query_str .= "		on ";
		$query_str .= "			t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
		$query_str .= "			m_movie.movie_id = :movie_id and ";
		$query_str .= "			m_movie.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			t_playlist.playlist_id = t_playlist_movie_rela.playlist_id and ";
		$query_str .= "			t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.playlist_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":movie_id"] = $movie_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Movie primary key number assignment
	 *
	 * @return int		Numbered movie_id
	 */
	public function sel_next_movie_id()
	{
		$movie_id = null;
		try{
			$m_movie = new Model_M_Movie($this->db, $this->client_id);
			$movie_id = $m_movie->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$movie_id = null;
		}
		return $movie_id;
	}

	/**
	 * Video registration
	 *
	 * @param String	$movie		Video
	 * @return bool					true = success, false = failure
	 */
	public function ins_movie($movie)
	{
		$ret = true;
		try{
			$m_movie = new Model_M_Movie($this->db, $this->client_id);
			$ret = $m_movie->ins($movie);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Update video
	 *
	 * @param stdClass	$movie		Video
	 * @return bool					true = success, false = failure
	 */
	public function up_movie($movie)
	{
		$ret = true;
		try{
			$m_movie = new Model_M_Movie($this->db, $this->client_id);
			$m_movie->up($movie);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Delete video
	 *
	 * @param stdClass	$movie		Video
	 * @return bool					true = success, false = failure
	 */
	public function del_movie($movie)
	{
		$ret = true;
		try{
			//Video playlist related
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_Rela($this->db, $this->client_id);
			$playlist_movie_rela = new stdClass();
			$playlist_movie_rela->movie_id = $movie->movie_id;
			$playlist_movie_rela->client_id = $movie->client_id;
			$playlist_movie_rela->update_user = $movie->update_user;
			$playlist_movie_rela->update_dt = $movie->update_dt;
			$t_playlist_movie_rela->del_by_movie_id($playlist_movie_rela);

			//Video tag related
			$t_movie_tag_rela = new Model_T_Movie_Tag_Rela($this->db, $this->client_id);
			$movie_tag_rela = new stdClass();
			$movie_tag_rela->movie_id = $movie->movie_id;
			$movie_tag_rela->client_id = $movie->client_id;
			$movie_tag_rela->update_user = $movie->update_user;
			$movie_tag_rela->update_dt = $movie->update_dt;
			$t_movie_tag_rela->del_by_movie_id($movie_tag_rela);

			//Video master
			$m_movie = new Model_M_Movie($this->db, $this->client_id);
			$m_movie->client_id = $movie->client_id;
			$m_movie->del($movie);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Video tag related registration
	 *
	 * @param stdClass	$movie_tag_rela		Video tag related
	 * @return bool		true = success, false = failure
	 */
	public function ins_movie_tag_rela($movie_tag_rela)
	{
		$ret = true;
		try{
			$t_movie_tag_rela = new Model_T_Movie_Tag_Rela($this->db, $this->client_id);
			$ret = $t_movie_tag_rela->ins($movie_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Video tag related delete
	 *
	 * @param stdClass	$movie_tag_rela		Video tag related
	 * @return bool		true = success, false = failure
	 */
	public function del_movie_tag_rela($movie_tag_rela)
	{
		$ret = true;
		try{
			$t_movie_tag_rela = new Model_T_Movie_Tag_Rela($this->db, $this->client_id);
			$ret = $t_movie_tag_rela->del_by_movie_id_movie_tag_id($movie_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}




	/**
	 * Image Main key number assignment
	 *
	 * @return int		Numbered image_id
	 */
	public function sel_next_image_id()
	{
		$image_id = null;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$image_id = $m_image->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$image_id = null;
		}
		return $image_id;
	}

	/**
	 * Get ticker
	 *
	 * @param String	$image_id	Image ID
	 * @return array				Acquisition record
	 */
	public function sel_image($image_id)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$ret = $m_image->sel($image_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Get image name
	 *
	 * @param String	$image_id		Image ID
	 * @return array					Acquisition record
	 */
	public function sel_image_name($image_id)
	{
		$query_str = "select ";
		$query_str .= "	m_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "where ";
		$query_str .= "	m_image.image_id = :image_id and ";
		$query_str .= "	m_image.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":image_id"] = $image_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Ticker registration
	 *
	 * @param stdClass	$image		telop
	 * @return bool	true = success, false = failure
	 */
	public function ins_image($image)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$ret = $m_image->ins($image);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Ticker update
	 *
	 * @param stdClass	$image		telop
	 * @return bool					true = success, false = failure
	 */
	public function up_image($image)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$m_image->up($image);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Delete telop
	 *
	 * @param stdClass	$image		telop
	 * @return bool					true = success, false = failure
	 */
	public function del_image($image)
	{
		$ret = true;
		try{
			//Image playlist related
			$t_playlist_image_rela = new Model_T_Playlist_Image_Rela($this->db, $this->client_id);
			$playlist_image_rela = new stdClass();
			$playlist_image_rela->image_id = $image->image_id;
			$playlist_image_rela->client_id = $image->client_id;
			$playlist_image_rela->update_user = $image->update_user;
			$playlist_image_rela->update_dt = $image->update_dt;
			$t_playlist_image_rela->del_by_image_id($playlist_image_rela);

			//Image drawing size related
			$t_image_draw_size_rela = new Model_T_Image_Draw_Size_Rela($this->db, $this->client_id);
			$image_draw_size_rela = new stdClass();
			$image_draw_size_rela->image_id = $image->image_id;
			$image_draw_size_rela->client_id = $image->client_id;
			$image_draw_size_rela->update_user = $image->update_user;
			$image_draw_size_rela->update_dt = $image->update_dt;
			$t_image_draw_size_rela->del_by_image_id($image_draw_size_rela);

			//Image tag related
			$t_image_tag_rela = new Model_T_Image_Tag_Rela($this->db, $this->client_id);
			$image_tag_rela = new stdClass();
			$image_tag_rela->image_id = $image->image_id;
			$image_tag_rela->client_id = $image->client_id;
			$image_tag_rela->update_user = $image->update_user;
			$image_tag_rela->update_dt = $image->update_dt;
			$t_image_tag_rela->del_by_image_id($image_tag_rela);

			//Image master
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$m_image->client_id = $image->client_id;
			$m_image->del($image);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Image tag related registration
	 *
	 * @param stdClass	$image_tag_rela		Image tag related
	 * @return bool		true = success, false = failure
	 */
	public function ins_image_tag_rela($image_tag_rela)
	{
		$ret = true;
		try{
			$t_image_tag_rela = new Model_T_Image_Tag_Rela($this->db, $this->client_id);
			$ret = $t_image_tag_rela->ins($image_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Image tag related delete
	 *
	 * @param stdClass	$image_tag_rela		Image tag related
	 * @return bool		ttrue = success, false = failure
	 */
	public function del_image_tag_rela($image_tag_rela)
	{
		$ret = true;
		try{
			$t_image_tag_rela = new Model_T_Image_Tag_Rela($this->db, $this->client_id);
			$ret = $t_image_tag_rela->del_by_image_id_image_tag_id($image_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

}
