<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Commonmovie extends Model
{
	public $db;

	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Acquire all movies
	 *
	 * @return array				Acquisition record
	 */
	public function sel_cnt_movie()
	{
		//Search condition
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(common_movie.movie_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";

		//Search condition (Movie name) added
		if(!empty($arr_movie_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_movie_name as $movie_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_common_movie.movie_name ilike :movie_name_" . $i ;
				$arr_bind_param[":movie_name_" . $i] = "%" . $movie_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= ") common_movie ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get movie list
	 *
	 * @param stdClass	$search			Search condition
	 */
	public function sel_arr_movie($search)
	{
		//Search condition
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	m_common_movie.movie_name, ";
		$query_str .= "	m_common_movie.play_time, ";
		$query_str .= "	m_common_movie.rotate_flag, ";
		$query_str .= "	m_common_movie.orig_file_dir, ";
		$query_str .= "	m_common_movie.file_name, ";
		$query_str .= "	m_common_movie.movie_enc_file_size, ";
		$query_str .= "	m_common_movie.movie_orig_file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_exte, ";
		$query_str .= "	m_common_movie.movie_orig_file_size, ";
		$query_str .= "	m_common_movie.sound_enc_file_size, ";
		$query_str .= "	m_common_movie.sound_orig_file_name, ";
		$query_str .= "	m_common_movie.sound_orig_file_exte, ";
		$query_str .= "	m_common_movie.sound_orig_file_size, ";
		$query_str .= "	m_common_movie.sta_dt, ";
		$query_str .= "	m_common_movie.end_dt, ";
		$query_str .= "	m_common_movie.update_user ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";

		//Search condition (Movie name) added
		if(!empty($arr_movie_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_movie_name as $movie_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_common_movie.movie_name ilike :movie_name_" . $i ;
				$arr_bind_param[":movie_name_" . $i] = "%" . $movie_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(m_common_movie.movie_name,'UTF8'), ";
		$query_str .= "	m_common_movie.movie_id desc ";
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
			$m_common_movie = new Model_M_Common_Movie($this->db);
			$ret = $m_common_movie->sel($movie_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
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
		$query_str .= "	m_common_movie.movie_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.movie_id = :movie_id and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";

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
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	t_playlist.playlist_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.client_id = m_client.client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_playlist_movie_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_common_movie ";
		$query_str .= "		on ";
		$query_str .= "			t_playlist_movie_rela.movie_id = m_common_movie.movie_id and ";
		$query_str .= "			m_common_movie.movie_id = :movie_id and ";
		$query_str .= "			m_common_movie.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			t_playlist.playlist_id = t_playlist_movie_rela.playlist_id and ";
		$query_str .= "			t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_client.client_name, ";
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
			$m_common_movie = new Model_M_Common_Movie($this->db);
			$movie_id = $m_common_movie->sel_next_id();
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
			$m_common_movie = new Model_M_Common_Movie($this->db);
			$ret = $m_common_movie->ins($movie);
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
	 * @return bool				true = success, false = failure
	 */
	public function up_movie($movie)
	{
		$ret = true;
		try{
			$m_common_movie = new Model_M_Common_Movie($this->db);
			$m_common_movie->up($movie);
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
	 * @return bool			true = success, false = failure
	 */
	public function del_movie($movie)
	{
		$ret = true;
		try{
			//Video playlist related
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_Rela($this->db);
			$playlist_movie_rela = new stdClass();
			$playlist_movie_rela->movie_id = $movie->movie_id;
			$playlist_movie_rela->update_user = $movie->update_user;
			$playlist_movie_rela->update_dt = $movie->update_dt;
			$t_playlist_movie_rela->del_by_movie_id($playlist_movie_rela);

			//Video master
			$m_common_movie = new Model_M_Common_Movie($this->db);
			$m_common_movie->del($movie);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
