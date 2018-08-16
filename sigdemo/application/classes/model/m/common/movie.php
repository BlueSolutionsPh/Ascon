<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Common_Movie extends Model
{
	protected $db;
	
	public function __construct(&$db)
	{
		$this->db = $db;
	}
	
	/**
	 * Get all Movie ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	movie_id, ";
		$query_str .= "	movie_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(movie_name,'UTF8'), ";
		$query_str .= "	movie_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all Movie ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_movie_id_name($ants_version = ANTS_TWO_KIND, $exclude_swf = false, $rotate_flag = null)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	movie_id, ";
		$query_str .= "	movie_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
// 		$query_str .= "	movie_orig_file_exte is not null and ";
		if(isset($ants_version)){
			if((string)$ants_version === (string)ANTS_ONE_KIND){
				$query_str .= "	movie_orig_file_exte is not null and ";
				$query_str .= "	movie_orig_file_exte_480p is not null and ";
			}else{
				$query_str .= "	movie_orig_file_exte is not null and ";
			}
		}else{
			$query_str .= "	movie_orig_file_exte is not null and ";
		}
		
		if($exclude_swf === true){
			$query_str .= "	movie_orig_file_exte <> '.swf' and ";
		}
		if(isset($rotate_flag)){
			$query_str .= "	rotate_flag = :rotate_flag and ";
			$arr_bind_param[":rotate_flag"] = $rotate_flag;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(movie_name,'UTF8'), ";
		$query_str .= "	movie_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all Movie ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_sound_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	movie_id, ";
		$query_str .= "	movie_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	movie_orig_file_exte is null and ";
		$query_str .= "	sound_orig_file_exte is not null and ";
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(movie_name,'UTF8'), ";
		$query_str .= "	movie_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all movies
	 *
	 * @return array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(movie_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	
	/**
	 * Movie ID acquisition (existence confirmation)
	 *
	 * @param String	$movie_id	Movie ID
	 * @return array				Acquisition record
	 */
	public function sel_id($movie_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_common_movie.movie_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.movie_id = :movie_id and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		
		$arr_bind_param[":movie_id"] = $movie_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get Movie ID from Movie name
	 *
	 * @param String	$movie_name		Movie name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($movie_name)
	{
		$query_str = "select ";
		$query_str .= "	m_common_movie.movie_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.movie_name = :movie_name and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":movie_name"] = $movie_name;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get Movie ID from Movie name
	 *
	 * @param String	$movie_name		Movie name
	 * @param String	$movie_id		Movie ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($movie_name, $movie_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_common_movie.movie_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.movie_id <> :movie_id and ";
		$arr_bind_param[":movie_id"] = $movie_id;
		$query_str .= "	m_common_movie.movie_name = :movie_name and ";
		$arr_bind_param[":movie_name"] = $movie_name;
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * All Movie items acquired
	 *
	 * @param String	$movie_id	Movie ID
	 * @return array				Acquisition record
	 */
	public function sel($movie_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	movie_id, ";
		$query_str .= "	movie_name, ";
		$query_str .= "	play_time, ";
		$query_str .= "	rotate_flag, ";
		$query_str .= "	active_file_dir, ";
		$query_str .= "	enc_file_dir, ";
		$query_str .= "	orig_file_dir, ";
		$query_str .= "	file_name, ";
		$query_str .= "	movie_enc_file_exte, ";
		$query_str .= "	movie_enc_file_size, ";
		$query_str .= "	movie_enc_hash, ";
		$query_str .= "	movie_orig_file_name, ";
		$query_str .= "	movie_orig_file_exte, ";
		$query_str .= "	movie_orig_file_size, ";
		$query_str .= "	movie_orig_hash, ";
		$query_str .= "	movie_enc_file_exte_480p, ";
		$query_str .= "	movie_enc_file_size_480p, ";
		$query_str .= "	movie_enc_hash_480p, ";
		$query_str .= "	movie_orig_file_name_480p, ";
		$query_str .= "	movie_orig_file_exte_480p, ";
		$query_str .= "	movie_orig_hash_480p, ";
		$query_str .= "	sound_enc_file_exte, ";
		$query_str .= "	sound_enc_file_size, ";
		$query_str .= "	sound_enc_hash, ";
		$query_str .= "	sound_orig_file_name, ";
		$query_str .= "	sound_orig_file_exte, ";
		$query_str .= "	sound_orig_file_size, ";
		$query_str .= "	sound_orig_hash, ";
		$query_str .= "	sta_dt, ";
		$query_str .= "	end_dt, ";
		$query_str .= "	del_flag, ";
		$query_str .= "	create_user, ";
		$query_str .= "	create_dt, ";
		$query_str .= "	update_user, ";
		$query_str .= "	update_dt ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	movie_id = :movie_id and ";
		$query_str .= "	del_flag = 0 ";
		
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
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_movie', 'movie_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Movie registration
	 *
	 * @param stdClass	$movie	Movie
	 * @return int				Movie_id of the registered Movie
	 */
	public function ins($movie)
	{
		$query_str = "insert into ";
		$query_str .= "	m_common_movie( ";
		$query_str .= "		movie_id, ";
		$query_str .= "		movie_name, ";
		$query_str .= "		play_time, ";
		$query_str .= "		rotate_flag, ";
		$query_str .= "		orig_file_dir, ";
		$query_str .= "		file_name, ";
		$query_str .= "		movie_orig_file_name, ";
		$query_str .= "		movie_orig_file_exte, ";
		$query_str .= "		movie_orig_file_size, ";
		$query_str .= "		movie_orig_hash, ";
		$query_str .= "		sound_orig_file_name, ";
		$query_str .= "		sound_orig_file_exte, ";
		$query_str .= "		sound_orig_file_size, ";
		$query_str .= "		sound_orig_hash, ";
		$query_str .= "		sta_dt, ";
		$query_str .= "		end_dt, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:movie_id, ";
		$query_str .= "		:movie_name, ";
		$query_str .= "		:play_time, ";
		$query_str .= "		:rotate_flag, ";
		$query_str .= "		:orig_file_dir, ";
		$query_str .= "		:file_name, ";
		$query_str .= "		:movie_orig_file_name, ";
		$query_str .= "		:movie_orig_file_exte, ";
		$query_str .= "		:movie_orig_file_size, ";
		$query_str .= "		:movie_orig_hash, ";
		$query_str .= "		:sound_orig_file_name, ";
		$query_str .= "		:sound_orig_file_exte, ";
		$query_str .= "		:sound_orig_file_size, ";
		$query_str .= "		:sound_orig_hash, ";
		$query_str .= "		:sta_dt, ";
		$query_str .= "		:end_dt, ";
		$query_str .= "		:create_user, ";
		$query_str .= "		:create_dt, ";
		$query_str .= "		:update_user, ";
		$query_str .= "		:update_dt ";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":movie_id"] = $movie->movie_id;
		$arr_bind_param[":movie_name"] = $movie->movie_name;
		$arr_bind_param[":play_time"] = $movie->play_time;
		$arr_bind_param[":rotate_flag"] = $movie->rotate_flag;
		$arr_bind_param[":orig_file_dir"] = $movie->orig_file_dir;
		$arr_bind_param[":file_name"] = $movie->file_name;
		$arr_bind_param[":movie_orig_file_name"] = $movie->movie_orig_file_name;
		$arr_bind_param[":movie_orig_file_exte"] = $movie->movie_orig_file_exte;
		$arr_bind_param[":movie_orig_file_size"] = $movie->movie_orig_file_size;
		$arr_bind_param[":movie_orig_hash"] = $movie->movie_orig_hash;
		$arr_bind_param[":sound_orig_file_name"] = $movie->sound_orig_file_name;
		$arr_bind_param[":sound_orig_file_exte"] = $movie->sound_orig_file_exte;
		$arr_bind_param[":sound_orig_file_size"] = $movie->sound_orig_file_size;
		$arr_bind_param[":sound_orig_hash"] = $movie->sound_orig_hash;
		$arr_bind_param[":sta_dt"] = $movie->sta_dt;
		$arr_bind_param[":end_dt"] = $movie->end_dt;
		$arr_bind_param[":create_user"] = $movie->create_user;
		$arr_bind_param[":create_dt"] = $movie->create_dt;
		$arr_bind_param[":update_user"] = $movie->update_user;
		$arr_bind_param[":update_dt"] = $movie->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Update Movie
	 *
	 * @param stdClass	$movie		Movie
	 * @return bool					true = success, false = failure
	 */
	public function up($movie)
	{
		$query_str = "update ";
		$query_str .= "	m_common_movie ";
		$query_str .= "set ";
		$query_str .= "	movie_name = :movie_name, ";
		$query_str .= "	play_time = :play_time, ";
		$query_str .= "	rotate_flag = :rotate_flag, ";
		$query_str .= "	sta_dt = :sta_dt, ";
		$query_str .= "	end_dt = :end_dt, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	movie_id = :movie_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":movie_name"] = $movie->movie_name;
		$arr_bind_param[":play_time"] = $movie->play_time;
		$arr_bind_param[":rotate_flag"] = $movie->rotate_flag;
		$arr_bind_param[":sta_dt"] = $movie->sta_dt;
		$arr_bind_param[":end_dt"] = $movie->end_dt;
		$arr_bind_param[":update_user"] = $movie->update_user;
		$arr_bind_param[":update_dt"] = $movie->update_dt;
		$arr_bind_param[":movie_id"] = $movie->movie_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
			
		return $query->execute($this->db);
	}
	
	/**
	 * Delete Movie
	 *
	 * @param stdClass	$movie		Movie
	 * @return bool					true = success, false = failure
	 */
	public function del($movie)
	{
		$query_str = "update ";
		$query_str .= "	m_common_movie ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	movie_id = :movie_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $movie->update_user;
		$arr_bind_param[":update_dt"] = $movie->update_dt;
		$arr_bind_param[":movie_id"] = $movie->movie_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
}