<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Playlistdl extends Model
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
	}

	/**
	 * User acquisition
	 *
	 * @param String	$user_id	User ID
	 * @return array				Acquisition record
	 */
	function sel_user($user_id)
	{
		$query_str = "select ";
		$query_str .= "	m_user.login_acnt, ";
		$query_str .= "	m_user.passwd ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		$query_str .= "	m_user.user_id = :user_id and ";
		$query_str .= "	del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":user_id"] = $user_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @return array					Acquisition record
	 */
	function sel_playlist($playlist_id)
	{
		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.draw_tmpl_id, ";
		$query_str .= "	t_playlist.image_intvl ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		$query_str .= "	playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
		}
		$query_str .= "	del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get movie list in playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$file_name		file name
	 * @param String	$file_exte		File extension
	 * @return array					Acquisition record
	 */
	function sel_arr_movie_by_playlist_id_file_name_exte($playlist_id, $file_name, $file_exte)
	{
		$query_str = "select ";
		$query_str .= "	playlist_movie.movie_id, ";
		$query_str .= "	playlist_movie.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_movie.file_name = :file_name and ";
		$query_str .= "	( m_movie.movie_orig_file_exte = :file_exte or m_movie.sound_orig_file_exte = :file_exte ) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	m_common_movie.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.file_name = :file_name and ";
		$query_str .= "	( m_common_movie.movie_orig_file_exte = :file_exte or m_common_movie.sound_orig_file_exte = :file_exte ) and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_movie.movie_orig_file_name_480p  = :file_name and ";
		$query_str .= "	( m_movie.movie_orig_file_exte = :file_exte or m_movie.sound_orig_file_exte = :file_exte ) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	m_common_movie.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.movie_orig_file_name_480p  = :file_name and ";
		$query_str .= "	( m_common_movie.movie_orig_file_exte = :file_exte or m_common_movie.sound_orig_file_exte = :file_exte ) and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= ") as playlist_movie ";

		$arr_bind_param = array();
		$arr_bind_param[":file_name"] = $file_name;
		$arr_bind_param[":file_exte"] = $file_exte;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get image list in playlist
	 *
	 * @param String	$playlist_id	プレイリストID
	 * @param String	$file_name		file name
	 * @param String	$file_exte		File extension
	 * @return array					Acquisition record
	 */
	function sel_arr_image_by_playlist_id_file_name_exte($playlist_id, $file_name, $file_exte)
	{
		$query_str = "select ";
		$query_str .= "	playlist_image.image_id, ";
		$query_str .= "	playlist_image.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "on ";
		$query_str .= "	m_image.image_id = t_playlist_image_rela.image_id and ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_image.file_name = :file_name and ";
		$query_str .= "	m_image.orig_file_exte = :file_exte and ";
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";

		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	m_common_image.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_image.image_id = t_playlist_image_rela.image_id and ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.file_name = :file_name and ";
		$query_str .= "	m_common_image.orig_file_exte = :file_exte and ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "	) as playlist_image ";

		$arr_bind_param = array();
		$arr_bind_param[":file_name"] = $file_name;
		$arr_bind_param[":file_exte"] = $file_exte;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get active text list
	 *
	 * @param String	$playlistId		Playlist ID
	 * @return array					Acquisition record
	 */
	function sel_arr_active_text($playlistId){
		$query_str = "select ";
		$query_str .= "	playlist_text.display_order, ";
		$query_str .= "	playlist_text.x, ";
		$query_str .= "	playlist_text.y, ";
		$query_str .= "	playlist_text.width, ";
		$query_str .= "	playlist_text.height, ";
		$query_str .= "	playlist_text.text_id, ";
		$query_str .= "	playlist_text.text_name, ";
		$query_str .= "	playlist_text.text_msg, ";
		$query_str .= "	playlist_text.sta_dt, ";
		$query_str .= "	playlist_text.end_dt ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	t_playlist_text_rela.playlist_text_rela_id, ";
		$query_str .= "	t_playlist_text_rela.display_order, ";
		$query_str .= "	m_draw_area.x, ";
		$query_str .= "	m_draw_area.y, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height, ";
		$query_str .= "	m_text.text_id, ";
		$query_str .= "	m_text.text_name, ";
		$query_str .= "	m_text.text_msg, ";
		$query_str .= "	m_text.sta_dt, ";
		$query_str .= "	m_text.end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_text_rela ";
		$query_str .= "join ";
		$query_str .= "	m_text ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_text_rela.text_id = m_text.text_id and ";
		$query_str .= "	(m_text.sta_dt is null or m_text.sta_dt <= :now) and ";
		$query_str .= "	(m_text.end_dt is null or m_text.end_dt >= :now) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
		}
		$query_str .= "	m_text.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_area ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_text_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_size ";
		$query_str .= "on ";
		$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_playlist_text_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_text_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_text_rela.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	t_playlist_text_rela.playlist_text_rela_id, ";
		$query_str .= "	t_playlist_text_rela.display_order, ";
		$query_str .= "	m_draw_area.x, ";
		$query_str .= "	m_draw_area.y, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height, ";
		$query_str .= "	m_common_text.text_id, ";
		$query_str .= "	m_common_text.text_name, ";
		$query_str .= "	m_common_text.text_msg, ";
		$query_str .= "	m_common_text.sta_dt, ";
		$query_str .= "	m_common_text.end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_text_rela ";
		$query_str .= "join ";
		$query_str .= "	m_common_text ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_text_rela.text_id = m_common_text.text_id and ";
		$query_str .= "	(m_common_text.sta_dt is null or m_common_text.sta_dt <= :now) and ";
		$query_str .= "	(m_common_text.end_dt is null or m_common_text.end_dt >= :now) and ";
		$query_str .= "	m_common_text.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_area ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_text_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_size ";
		$query_str .= "on ";
		$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_playlist_text_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_text_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_text_rela.del_flag = 0 ";
		$query_str .= ") as playlist_text ";
		$query_str .= "order by ";
		$query_str .= "	playlist_text.display_order, ";
		$query_str .= "	playlist_text.playlist_text_rela_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":now"] = Request::$request_dt;
		$arr_bind_param[":playlist_id"] = $playlistId;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get active image list
	 *
	 * @param String	$playlistId		Playlist ID
	 * @return array					Acquisition record
	 */
	function sel_arr_active_image($playlistId){
		$query_str = "select ";
		$query_str .= "	playlist_image.display_order, ";
		$query_str .= "	playlist_image.x, ";
		$query_str .= "	playlist_image.y, ";
		$query_str .= "	playlist_image.width, ";
		$query_str .= "	playlist_image.height, ";
		$query_str .= "	playlist_image.image_id, ";
		$query_str .= "	playlist_image.image_name, ";
		$query_str .= "	playlist_image.orig_hash, ";
		$query_str .= "	playlist_image.enc_hash, ";
		$query_str .= "	playlist_image.sta_dt, ";
		$query_str .= "	playlist_image.end_dt, ";
		$query_str .= "	playlist_image.orig_file_dir, ";
		$query_str .= "	playlist_image.file_name, ";
		$query_str .= "	playlist_image.orig_file_exte, ";
		$query_str .= "	playlist_image.orig_file_size, ";
		$query_str .= "	playlist_image.enc_file_size ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	t_playlist_image_rela.playlist_image_rela_id, ";
		$query_str .= "	t_playlist_image_rela.display_order, ";
		$query_str .= "	m_draw_area.x, ";
		$query_str .= "	m_draw_area.y, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height, ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.image_name, ";
		$query_str .= "	m_image.orig_hash, ";
		$query_str .= "	m_image.enc_hash, ";
		$query_str .= "	m_image.sta_dt, ";
		$query_str .= "	m_image.end_dt, ";
		$query_str .= "	m_image.orig_file_dir, ";
		$query_str .= "	m_image.file_name, ";
		$query_str .= "	m_image.orig_file_exte, ";
		$query_str .= "	m_image.orig_file_size, ";
		$query_str .= "	m_image.enc_file_size ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "join ";
		$query_str .= "	m_image ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_image_rela.image_id = m_image.image_id and ";
		$query_str .= "	(m_image.sta_dt is null or m_image.sta_dt <= :now) and ";
		$query_str .= "	(m_image.end_dt is null or m_image.end_dt >= :now) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_area ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_image_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_size ";
		$query_str .= "on ";
		$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	t_playlist_image_rela.playlist_image_rela_id, ";
		$query_str .= "	t_playlist_image_rela.display_order, ";
		$query_str .= "	m_draw_area.x, ";
		$query_str .= "	m_draw_area.y, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height, ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	m_common_image.image_name, ";
		$query_str .= "	m_common_image.orig_hash, ";
		$query_str .= "	m_common_image.enc_hash, ";
		$query_str .= "	m_common_image.sta_dt, ";
		$query_str .= "	m_common_image.end_dt, ";
		$query_str .= "	m_common_image.orig_file_dir, ";
		$query_str .= "	m_common_image.file_name, ";
		$query_str .= "	m_common_image.orig_file_exte, ";
		$query_str .= "	m_common_image.orig_file_size, ";
		$query_str .= "	m_common_image.enc_file_size ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "join ";
		$query_str .= "	m_common_image ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_image_rela.image_id = m_common_image.image_id and ";
		$query_str .= "	(m_common_image.sta_dt is null or m_common_image.sta_dt <= :now) and ";
		$query_str .= "	(m_common_image.end_dt is null or m_common_image.end_dt >= :now) and ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_area ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_image_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_size ";
		$query_str .= "on ";
		$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= ") as playlist_image ";
		$query_str .= "order by ";
		$query_str .= "	playlist_image.display_order, ";
		$query_str .= "	playlist_image.playlist_image_rela_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":now"] = Request::$request_dt;
		$arr_bind_param[":playlist_id"] = $playlistId;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get active video list
	 *
	 * @param String	$playlistId		Playlist ID
	 * @return array					Acquisition record
	 */
	function sel_arr_active_movie($playlistId){
		$query_str = "select ";
		$query_str .= "	playlist_movie.display_order, ";
		$query_str .= "	playlist_movie.x, ";
		$query_str .= "	playlist_movie.y, ";
		$query_str .= "	playlist_movie.width, ";
		$query_str .= "	playlist_movie.height, ";
		$query_str .= "	playlist_movie.movie_id, ";
		$query_str .= "	playlist_movie.movie_name, ";
		$query_str .= "	playlist_movie.play_time, ";
		$query_str .= "	playlist_movie.movie_orig_hash, ";
		$query_str .= "	playlist_movie.movie_enc_hash, ";
		$query_str .= "	playlist_movie.sound_orig_hash, ";
		$query_str .= "	playlist_movie.sound_enc_hash, ";
		$query_str .= "	playlist_movie.sta_dt, ";
		$query_str .= "	playlist_movie.end_dt, ";
		$query_str .= "	playlist_movie.orig_file_dir, ";
		$query_str .= "	playlist_movie.file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_exte, ";
		$query_str .= "	playlist_movie.movie_orig_file_size, ";
		$query_str .= "	playlist_movie.movie_enc_file_size, ";
		$query_str .= "	playlist_movie.sound_orig_file_exte, ";
		$query_str .= "	playlist_movie.sound_orig_file_size, ";
		$query_str .= "	playlist_movie.sound_enc_file_size ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order, ";
		$query_str .= "	m_draw_area.x, ";
		$query_str .= "	m_draw_area.y, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height, ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.movie_name, ";
		$query_str .= "	m_movie.play_time, ";
		$query_str .= "	m_movie.movie_orig_hash, ";
		$query_str .= "	m_movie.movie_enc_hash, ";
		$query_str .= "	m_movie.sound_orig_hash, ";
		$query_str .= "	m_movie.sound_enc_hash, ";
		$query_str .= "	m_movie.sta_dt, ";
		$query_str .= "	m_movie.end_dt, ";
		$query_str .= "	m_movie.orig_file_dir, ";
		$query_str .= "	m_movie.file_name, ";
		$query_str .= "	m_movie.movie_orig_file_exte, ";
		$query_str .= "	m_movie.movie_orig_file_size, ";
		$query_str .= "	m_movie.movie_enc_file_size, ";
		$query_str .= "	m_movie.sound_orig_file_exte, ";
		$query_str .= "	m_movie.sound_orig_file_size, ";
		$query_str .= "	m_movie.sound_enc_file_size ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "join ";
		$query_str .= "	m_movie ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
		$query_str .= "	(m_movie.sta_dt is null or m_movie.sta_dt <= :now) and ";
		$query_str .= "	(m_movie.end_dt is null or m_movie.end_dt >= :now) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_area ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_size ";
		$query_str .= "on ";
		$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$query_str .= "join ";
			$query_str .= "	t_playlist ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.playlist_id = t_playlist.playlist_id and ";
			$query_str .= "	t_playlist.ants_version = :ants_version2 and ";
			$query_str .= "	t_playlist.del_flag = 0 ";
		}
		$query_str .= "where ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order, ";
		$query_str .= "	m_draw_area.x, ";
		$query_str .= "	m_draw_area.y, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height, ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	m_common_movie.movie_name, ";
		$query_str .= "	m_common_movie.play_time, ";
		$query_str .= "	m_common_movie.movie_orig_hash, ";
		$query_str .= "	m_common_movie.movie_enc_hash, ";
		$query_str .= "	m_common_movie.sound_orig_hash, ";
		$query_str .= "	m_common_movie.sound_enc_hash, ";
		$query_str .= "	m_common_movie.sta_dt, ";
		$query_str .= "	m_common_movie.end_dt, ";
		$query_str .= "	m_common_movie.orig_file_dir, ";
		$query_str .= "	m_common_movie.file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_exte, ";
		$query_str .= "	m_common_movie.movie_orig_file_size, ";
		$query_str .= "	m_common_movie.movie_enc_file_size, ";
		$query_str .= "	m_common_movie.sound_orig_file_exte, ";
		$query_str .= "	m_common_movie.sound_orig_file_size, ";
		$query_str .= "	m_common_movie.sound_enc_file_size ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "join ";
		$query_str .= "	m_common_movie ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_movie_rela.movie_id = m_common_movie.movie_id and ";
		$query_str .= "	(m_common_movie.sta_dt is null or m_common_movie.sta_dt <= :now) and ";
		$query_str .= "	(m_common_movie.end_dt is null or m_common_movie.end_dt >= :now) and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_area ";
		$query_str .= "on ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_draw_size ";
		$query_str .= "on ";
		$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$query_str .= "join ";
			$query_str .= "	t_playlist ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.playlist_id = t_playlist.playlist_id and ";
			$query_str .= "	t_playlist.ants_version = :ants_version2 and ";
			$query_str .= "	t_playlist.del_flag = 0 ";
		}
		$query_str .= "where ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$query_str .= "union all ";
			$query_str .= "select ";
			$query_str .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
			$query_str .= "	t_playlist_movie_rela.display_order, ";
			$query_str .= "	m_draw_area.x, ";
			$query_str .= "	m_draw_area.y, ";
			$query_str .= "	m_draw_size.width, ";
			$query_str .= "	m_draw_size.height, ";
			$query_str .= "	m_movie.movie_id, ";
			$query_str .= "	m_movie.movie_name, ";
			$query_str .= "	m_movie.play_time, ";
			$query_str .= "	m_movie.movie_orig_hash_480p, ";
			$query_str .= "	m_movie.movie_enc_hash_480p, ";
			$query_str .= "	m_movie.sound_orig_hash, ";
			$query_str .= "	m_movie.sound_enc_hash, ";
			$query_str .= "	m_movie.sta_dt, ";
			$query_str .= "	m_movie.end_dt, ";
			$query_str .= "	m_movie.orig_file_dir, ";
			$query_str .= "	m_movie.movie_orig_file_name_480p, ";
			$query_str .= "	m_movie.movie_orig_file_exte_480p, ";
			$query_str .= "	m_movie.movie_orig_file_size_480p, ";
			$query_str .= "	m_movie.movie_enc_file_size_480p, ";
			$query_str .= "	m_movie.sound_orig_file_exte, ";
			$query_str .= "	m_movie.sound_orig_file_size, ";
			$query_str .= "	m_movie.sound_enc_file_size ";
			$query_str .= "from ";
			$query_str .= "	t_playlist_movie_rela ";
			$query_str .= "join ";
			$query_str .= "	m_movie ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
			$query_str .= "	(m_movie.sta_dt is null or m_movie.sta_dt <= :now) and ";
			$query_str .= "	(m_movie.end_dt is null or m_movie.end_dt >= :now) and ";
			if(isset($this->client_id)){
				$query_str .= "	m_movie.client_id = :client_id and ";
			}
			$query_str .= "	m_movie.del_flag = 0 ";
			$query_str .= "join ";
			$query_str .= "	m_draw_area ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
			$query_str .= "	m_draw_area.del_flag = 0 ";
			$query_str .= "join ";
			$query_str .= "	m_draw_size ";
			$query_str .= "on ";
			$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
			$query_str .= "	m_draw_size.del_flag = 0 ";
			$query_str .= "join ";
			$query_str .= "	t_playlist ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.playlist_id = t_playlist.playlist_id and ";
			$query_str .= "	t_playlist.ants_version = :ants_version1 and ";
			$query_str .= "	t_playlist.del_flag = 0 ";
			$query_str .= "where ";
			$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
			if(isset($this->client_id)){
				$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
			}
			$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
			$query_str .= "union all ";
			$query_str .= "select ";
			$query_str .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
			$query_str .= "	t_playlist_movie_rela.display_order, ";
			$query_str .= "	m_draw_area.x, ";
			$query_str .= "	m_draw_area.y, ";
			$query_str .= "	m_draw_size.width, ";
			$query_str .= "	m_draw_size.height, ";
			$query_str .= "	m_common_movie.movie_id, ";
			$query_str .= "	m_common_movie.movie_name, ";
			$query_str .= "	m_common_movie.play_time, ";
			$query_str .= "	m_common_movie.movie_orig_hash_480p, ";
			$query_str .= "	m_common_movie.movie_enc_hash_480p, ";
			$query_str .= "	m_common_movie.sound_orig_hash, ";
			$query_str .= "	m_common_movie.sound_enc_hash, ";
			$query_str .= "	m_common_movie.sta_dt, ";
			$query_str .= "	m_common_movie.end_dt, ";
			$query_str .= "	m_common_movie.orig_file_dir, ";
			$query_str .= "	m_common_movie.movie_orig_file_name_480p, ";
			$query_str .= "	m_common_movie.movie_orig_file_exte_480p, ";
			$query_str .= "	m_common_movie.movie_orig_file_size_480p, ";
			$query_str .= "	m_common_movie.movie_enc_file_size_480p, ";
			$query_str .= "	m_common_movie.sound_orig_file_exte, ";
			$query_str .= "	m_common_movie.sound_orig_file_size, ";
			$query_str .= "	m_common_movie.sound_enc_file_size ";
			$query_str .= "from ";
			$query_str .= "	t_playlist_movie_rela ";
			$query_str .= "join ";
			$query_str .= "	m_common_movie ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.movie_id = m_common_movie.movie_id and ";
			$query_str .= "	(m_common_movie.sta_dt is null or m_common_movie.sta_dt <= :now) and ";
			$query_str .= "	(m_common_movie.end_dt is null or m_common_movie.end_dt >= :now) and ";
			$query_str .= "	m_common_movie.del_flag = 0 ";
			$query_str .= "join ";
			$query_str .= "	m_draw_area ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
			$query_str .= "	m_draw_area.del_flag = 0 ";
			$query_str .= "join ";
			$query_str .= "	m_draw_size ";
			$query_str .= "on ";
			$query_str .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
			$query_str .= "	m_draw_size.del_flag = 0 ";
			$query_str .= "join ";
			$query_str .= "	t_playlist ";
			$query_str .= "on ";
			$query_str .= "	t_playlist_movie_rela.playlist_id = t_playlist.playlist_id and ";
			$query_str .= "	t_playlist.ants_version = :ants_version1 and ";
			$query_str .= "	t_playlist.del_flag = 0 ";
			$query_str .= "where ";
			$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
			if(isset($this->client_id)){
				$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
			}
			$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		}
		$query_str .= ") as playlist_movie ";
		$query_str .= "order by ";
		$query_str .= "	playlist_movie.display_order, ";
		$query_str .= "	playlist_movie.playlist_movie_rela_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":now"] = Request::$request_dt;
		$arr_bind_param[":playlist_id"] = $playlistId;
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$arr_bind_param[":ants_version1"] = (int)ANTS_ONE_KIND;
			$arr_bind_param[":ants_version2"] = (int)ANTS_TWO_KIND;
		}
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Count drawing area template associated with drawing template
	 *
	 * @param String	$draw_tmpl_id	Program guide ID
	 * @return array					Acquisition record
	 */
	function sel_arr_draw_area($draw_tmpl_id){
		$arr_bind_param = array();	//Sequence for search condition
		$arr_bind_param[":draw_tmpl_id"] = $draw_tmpl_id;

		$query_str = "select ";
		$query_str .= "	m_draw_area.draw_area_id, ";
		$query_str .= "	m_draw_area.cts_type ";
		$query_str .= "from ";
		$query_str .= "	m_draw_area ";
		$query_str .= "where ";
		$query_str .= "	m_draw_area.draw_tmpl_id = :draw_tmpl_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}
}
