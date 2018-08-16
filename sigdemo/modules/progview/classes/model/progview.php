<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Progview extends Model
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
	 * Acquire program guide
	 *
	 * @param String	$prog_id	Program guide ID
	 * @return array				Acquisition record
	 */
	function sel_prog($prog_id){
		$query_str = "select ";
		$query_str .= "	t_prog.prog_id, ";
		$query_str .= "	t_prog.dev_id, ";
		$query_str .= "	t_prog.client_id, ";
		$query_str .= "	t_prog.prog_name, ";
		$query_str .= "	t_prog.sta_dt, ";
		$query_str .= "	t_prog.end_dt, ";
		$query_str .= "	t_prog.inst_flag, ";
		$query_str .= "	t_prog.create_user, ";
		$query_str .= "	t_prog.create_dt, ";
		$query_str .= "	t_prog.update_user, ";
		$query_str .= "	t_prog.update_dt, ";
		$query_str .= "	m_dev.ants_version, ";
		$query_str .= "	m_dev.dev_name ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "join ";
		$query_str .= "	m_dev ";
		$query_str .= "on ";
		$query_str .= "	t_prog.dev_id = m_dev.dev_id and ";
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_prog.prog_id = :prog_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
		}
		$query_str .= "	t_prog.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":prog_id"] = $prog_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Terminal acquisition
	 * 
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_dev($dev_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_prog_rgl_grp.prog_rgl_grp_id ";
		$query_str .= "	from ";
		$query_str .= "		t_prog_rgl_grp ";
		$query_str .= "	where ";
		$query_str .= "		m_dev.dev_id = t_prog_rgl_grp.dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "		t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "		t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "	order by ";
		$query_str .= "		t_prog_rgl_grp.prog_rgl_grp_id desc ";
		$query_str .= "	limit 1 ";
		$query_str .= ") as prog_rgl_grp_id ";
		
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get an active program guide
	 *
	 * @param String	$dev_id		Device ID
	 * @param String	$prog_date	Delivery date (yyyy / mm / dd)
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog($dev_id, $prog_date){
		$sta_dt = $prog_date . " 00:00:00";
		$end_dt = $prog_date . " 23:59:59";
		
		$arr_bind_param = array();	//Sequence for search condition
		$arr_bind_param[":dev_id"] = $dev_id;
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query_str = "select ";
		$query_str .= "	arr_prog.prog_id, ";
		$query_str .= "	arr_prog.prog_name, ";
		$query_str .= "	arr_prog.sta_dt, ";
		$query_str .= "	arr_prog.end_dt ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "	select ";
		$query_str .= "		t_prog.prog_id, ";
		$query_str .= "		t_prog.prog_name, ";
		$query_str .= "		t_prog.sta_dt, ";
		$query_str .= "		t_prog.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		m_dev ";
		$query_str .= "	join ";
		$query_str .= "		t_prog ";
		$query_str .= "	on ";
		$query_str .= "		m_dev.dev_id = t_prog.dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
		}
		$query_str .= "		t_prog.del_flag = 0 ";
		$query_str .= "	join ";
		$query_str .= "		( ";
		$query_str .= "			select ";
		$query_str .= "				max(t_prog_outer.prog_id) prog_id, ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			from ";
		$query_str .= "				t_prog t_prog_outer ";
		$query_str .= "			where ";
		$query_str .= "				exists ( ";
		$query_str .= "					select ";
		$query_str .= "						t_prog_inner.prog_id ";
		$query_str .= "					from ";
		$query_str .= "						t_prog t_prog_inner ";
		$query_str .= "					where ";
		$query_str .= "						t_prog_outer.prog_id = t_prog_inner.prog_id and ";
		$query_str .= "						t_prog_outer.dev_id = t_prog_inner.dev_id and ";
		$query_str .= "						t_prog_inner.sta_dt <= :end_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :sta_dt or t_prog_inner.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "					t_prog_inner.client_id = :client_id and ";
		}
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
		$query_str .= "				t_prog_outer.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "		) tmp_prog ";
		$query_str .= "	on ";
		$query_str .= "		t_prog.prog_id = tmp_prog.prog_id ";
		$query_str .= "	where ";
		$query_str .= "		m_dev.invalid_flag = 0 and ";
		$query_str .= "		m_dev.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_dev.client_id = :client_id and ";
		}
		$query_str .= "		m_dev.del_flag = 0 ";
		$query_str .= "	) arr_prog ";
		$query_str .= "	order by ";
		$query_str .= "		arr_prog.sta_dt desc, ";
		$query_str .= "		arr_prog.end_dt, ";
		$query_str .= "		arr_prog.prog_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire active program list (repeat designation)
	 *
	 * @param String	$dev_id		Device ID
	 * @param String	$prog_date	Delivery date (yyyy / mm / dd)
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog_rgl($dev_id, $prog_date){
		$keys = array("year", "month", "day", "hour", "minute", "second");
		$date_1 = array_combine($keys, preg_split("/[-: ]/", $prog_date));
		
		$date_1["dow"] = date("w", strtotime($prog_date));
		
		$arr_bind_param = array();	//Sequence for search condition
		$arr_bind_param[":year"] = $date_1["year"];
		$arr_bind_param[":month"] = $date_1["month"];
		$arr_bind_param[":day"] = $date_1["day"];
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query_str = "select ";
		$query_str .= "	t_prog_rgl_grp.prog_name, ";
		$query_str .= "	t_prog_rgl.prog_id, ";
		$query_str .= "	t_prog_rgl.sta_time, ";
		$query_str .= "	t_prog_rgl.end_time, ";
		$query_str .= "	t_prog_rgl.year, ";
		$query_str .= "	t_prog_rgl.month, ";
		$query_str .= "	t_prog_rgl.day, ";
		$query_str .= "	t_prog_rgl.mon, ";
		$query_str .= "	t_prog_rgl.tues, ";
		$query_str .= "	t_prog_rgl.wednes, ";
		$query_str .= "	t_prog_rgl.thurs, ";
		$query_str .= "	t_prog_rgl.fri, ";
		$query_str .= "	t_prog_rgl.satur, ";
		$query_str .= "	t_prog_rgl.sun ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "join ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "on ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		$query_str .= "	( ";
		$query_str .= "		( ";
		switch($date_1["dow"]){
			case 0:
				$query_str .= "			t_prog_rgl.sun = 1 and ";
				break;
			case 1:
				$query_str .= "			t_prog_rgl.mon = 1 and ";
				break;
			case 2:
				$query_str .= "			t_prog_rgl.tues = 1 and ";
				break;
			case 3:
				$query_str .= "			t_prog_rgl.wednes = 1 and ";
				break;
			case 4:
				$query_str .= "			t_prog_rgl.thurs = 1 and ";
				break;
			case 5:
				$query_str .= "			t_prog_rgl.fri = 1 and ";
				break;
			case 6:
				$query_str .= "			t_prog_rgl.satur = 1 and ";
				break;
		}
		$query_str .= "			(t_prog_rgl.year = :year or t_prog_rgl.year = 0) and ";
		$query_str .= "			(t_prog_rgl.month = :month or t_prog_rgl.month = 0) and ";
		$query_str .= "			(t_prog_rgl.day = :day or t_prog_rgl.day = 0) ";
		$query_str .= "		) ";
		$query_str .= "	) and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_rgl.priority desc, ";
		$query_str .= "	t_prog_rgl.sta_time, ";
		$query_str .= "	t_prog_rgl.prog_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get active playlist list
	 *
	 * @param String	$prog_id	Program guide ID
	 * @return array				Acquisition record
	 */
	function sel_arr_playlist_by_prog_id($prog_id){
		$query_str = "select ";
		$query_str .= "	t_prog_playlist_rela.ch, ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.draw_tmpl_id, ";
		$query_str .= "	t_playlist.playlist_name ";
		$query_str .= "from ";
		$query_str .= "	t_prog_playlist_rela ";
		$query_str .= "join ";
		$query_str .= "	t_playlist ";
		$query_str .= "on ";
		$query_str .= "	t_prog_playlist_rela.playlist_id = t_playlist.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_prog_playlist_rela.prog_id = :prog_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_playlist_rela.ch";
		
		$arr_bind_param = array();
		$arr_bind_param[":prog_id"] = $prog_id;
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
	 * @param String	$draw_area_id	Drawing area ID
	 * @param String	$sta_dt			Start date and time
	 * @param String	$end_dt			End date and time
	 * @return array					Acquisition record
	 */
	function sel_arr_movie_by_playlist_id_draw_area_id_dt($playlist_id, $draw_area_id, $sta_dt, $end_dt)
	{
		$query_str = "select ";
		$query_str .= "	playlist_movie.movie_id, ";
		$query_str .= "	playlist_movie.movie_name, ";
		$query_str .= "	playlist_movie.orig_file_dir, ";
		$query_str .= "	playlist_movie.file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_exte, ";
		$query_str .= "	playlist_movie.sound_orig_file_name, ";
		$query_str .= "	playlist_movie.sound_orig_file_exte, ";
		$query_str .= "	playlist_movie.draw_area_id, ";
		$query_str .= "	playlist_movie.display_order ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.movie_name, ";
		$query_str .= "	m_movie.orig_file_dir, ";
		$query_str .= "	m_movie.file_name, ";
		$query_str .= "	m_movie.movie_orig_file_name, ";
		$query_str .= "	m_movie.movie_orig_file_exte, ";
		$query_str .= "	m_movie.sound_orig_file_name, ";
		$query_str .= "	m_movie.sound_orig_file_exte, ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_movie.sta_dt <= :end_dt or m_movie.sta_dt is null) and ";
		$query_str .= "	(m_movie.end_dt >= :sta_dt or m_movie.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	'(共通) ' || m_common_movie.movie_name, ";
		$query_str .= "	m_common_movie.orig_file_dir, ";
		$query_str .= "	m_common_movie.file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_exte, ";
		$query_str .= "	m_common_movie.sound_orig_file_name, ";
		$query_str .= "	m_common_movie.sound_orig_file_exte, ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_common_movie.sta_dt <= :end_dt or m_common_movie.sta_dt is null) and ";
		$query_str .= "	(m_common_movie.end_dt >= :sta_dt or m_common_movie.end_dt is null) and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= ") as playlist_movie ";
		$query_str .= "order by ";
		$query_str .= "	playlist_movie.display_order ";
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_area_id"] = $draw_area_id;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get image list in playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$draw_area_id	Drawing area ID
	 * @param String	$sta_dt			Start date and time
	 * @param String	$end_dt			End date and time
	 * @return array					Acquisition record
	 */
	function sel_arr_image_by_playlist_id_draw_area_id_dt($playlist_id, $draw_area_id, $sta_dt, $end_dt)
	{
		$query_str = "select ";
		$query_str .= "	playlist_image.image_id, ";
		$query_str .= "	playlist_image.image_name, ";
		$query_str .= "	playlist_image.orig_file_dir, ";
		$query_str .= "	playlist_image.file_name, ";
		$query_str .= "	playlist_image.orig_file_name, ";
		$query_str .= "	playlist_image.orig_file_exte, ";
		$query_str .= "	playlist_image.draw_area_id, ";
		$query_str .= "	playlist_image.display_order ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.image_name, ";
		$query_str .= "	m_image.orig_file_dir, ";
		$query_str .= "	m_image.file_name, ";
		$query_str .= "	m_image.orig_file_name, ";
		$query_str .= "	m_image.orig_file_exte, ";
		$query_str .= "	t_playlist_image_rela.draw_area_id, ";
		$query_str .= "	t_playlist_image_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "on ";
		$query_str .= "	m_image.image_id = t_playlist_image_rela.image_id and ";
		$query_str .= "	t_playlist_image_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_image.sta_dt <= :end_dt or m_image.sta_dt is null) and ";
		$query_str .= "	(m_image.end_dt >= :sta_dt or m_image.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	'(Common) ' || m_common_image.image_name, ";
		$query_str .= "	m_common_image.orig_file_dir, ";
		$query_str .= "	m_common_image.file_name, ";
		$query_str .= "	m_common_image.orig_file_name, ";
		$query_str .= "	m_common_image.orig_file_exte, ";
		$query_str .= "	t_playlist_image_rela.draw_area_id, ";
		$query_str .= "	t_playlist_image_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_image.image_id = t_playlist_image_rela.image_id and ";
		$query_str .= "	t_playlist_image_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_common_image.sta_dt <= :end_dt or m_common_image.sta_dt is null) and ";
		$query_str .= "	(m_common_image.end_dt >= :sta_dt or m_common_image.end_dt is null) and ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "	) as playlist_image ";
		$query_str .= "order by ";
		$query_str .= "	playlist_image.display_order ";
		
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_area_id"] = $draw_area_id;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get text list in playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$draw_area_id	Drawing area ID
	 * @param String	$sta_dt			Start date and time
	 * @param String	$end_dt			End date and time
	 * @return array					Acquisition record
	 */
	function sel_arr_text_by_playlist_id_draw_area_id_dt($playlist_id, $draw_area_id, $sta_dt, $end_dt)
	{
		$query_str = "select ";
		$query_str .= "	playlist_text.text_id, ";
		$query_str .= "	playlist_text.text_name, ";
		$query_str .= "	playlist_text.draw_area_id, ";
		$query_str .= "	playlist_text.display_order ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_text.text_id, ";
		$query_str .= "	m_text.text_name, ";
		$query_str .= "	t_playlist_text_rela.draw_area_id, ";
		$query_str .= "	t_playlist_text_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_text_rela ";
		$query_str .= "on ";
		$query_str .= "	m_text.text_id = t_playlist_text_rela.text_id and ";
		$query_str .= "	t_playlist_text_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_text_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_text_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_text_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_text.sta_dt <= :end_dt or m_text.sta_dt is null) and ";
		$query_str .= "	(m_text.end_dt >= :sta_dt or m_text.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
		}
		$query_str .= "	m_text.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_text.text_id, ";
		$query_str .= "	'(Common) ' || m_common_text.text_name, ";
		$query_str .= "	t_playlist_text_rela.draw_area_id, ";
		$query_str .= "	t_playlist_text_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_common_text ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_text_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_text.text_id = t_playlist_text_rela.text_id and ";
		$query_str .= "	t_playlist_text_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_text_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_text_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_text_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_common_text.sta_dt <= :end_dt or m_common_text.sta_dt is null) and ";
		$query_str .= "	(m_common_text.end_dt >= :sta_dt or m_common_text.end_dt is null) and ";
		$query_str .= "	m_common_text.del_flag = 0 ";
		$query_str .= "	) as playlist_text ";
		$query_str .= "order by ";
		$query_str .= "	playlist_text.display_order ";
		
		
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_area_id"] = $draw_area_id;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get drawing area list in template
	 *
	 * @param String	$draw_tmpl_id	Drawing area template ID
	 * @return array					Acquisition record
	 */
	function sel_arr_draw_area_by_draw_tmpl_id($draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	m_draw_area.draw_area_id, ";
		$query_str .= "	m_draw_area.draw_area_name, ";
		$query_str .= "	m_draw_area.draw_size_id, ";
		$query_str .= "	m_draw_area.cts_type ";
		$query_str .= "from ";
		$query_str .= "	m_draw_area ";
		$query_str .= "where ";
		$query_str .= "	m_draw_area.draw_tmpl_id = :draw_tmpl_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_draw_area.draw_area_id ";
		
		$arr_bind_param = array();
		$arr_bind_param[":draw_tmpl_id"] = $draw_tmpl_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}

	/**
	 * Acquire ant's type from terminal ID
	 *
	 * @param String	$dev_id	Device ID
	 * @return int	Acquisition record
	 */
	function sel_dev_id_ants_version($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.ants_version ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.dev_id = :dev_id and ";
		$query_str .= "	m_dev.del_flag = 0 ";
	
		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db, true);
	}

	/**
	 * Program guide Primary key number assignment
	 *
	 * @return int		Number assigned prog_id
	 */
	public function sel_next_prog_id()
	{
		$prog_id = null;
		try{
			$t_prog = new Model_T_Prog($this->db, $this->client_id);
			$prog_id = $t_prog->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$prog_id = null;
		}
		return $prog_id;
	}
	
	/**
	 * Program guide registration
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function ins_prog($prog)
	{
		$ret = true;
		try{
			$t_prog = new Model_T_Prog($this->db, $this->client_id);
			$ret = $t_prog->ins($prog);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete program guide
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function del_prog($prog)
	{
		$ret = true;
		try{
			//Program list Play list related
			$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
			$prog_playlist_rela = new stdClass();
			$prog_playlist_rela->prog_id = $prog->prog_id;
			$prog_playlist_rela->update_user = $prog->update_user;
			$prog_playlist_rela->update_dt = $prog->update_dt;
			$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);
			
			//A TV schedule
			$t_prog = new Model_T_Prog($this->db, $this->client_id);
			$t_prog->del($prog);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Program list Playlist related registration
	 *
	 * @param stdClass	$prog_playlist_rela		Program list Play list related
	 * @return bool								true = success, false = failure
	 */
	public function ins_prog_playlist_rela($prog_playlist_rela)
	{
		$ret = true;
		try{
			$t_prog_playlist_rela = new Model_T_Prog_Playlist_rela($this->db, $this->client_id);
			$ret = $t_prog_playlist_rela->ins($prog_playlist_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * DL status reset
	 *
	 * @param String	$dev		Terminal
	 * @return array				Acquisition record
	 */
	public function sel_dlLog_up($dev)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$ret = $m_dev->dlLog_up($dev);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}