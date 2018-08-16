<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Commonplaylist extends Model
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
	 * Post Return the key name of the data to be sent
	 */
	public function getPostDataKeys() {
		return array(
			"draw_tmpl_id",
			"playlist_name",
			"sex_id",
			"sta_dt",
			"end_dt",
			"timezone_id",
			"deliverymonth_id",
			"ants_version",
		);
	}

	/**
	 * Acquire number of use of program guide
	 *
	 * @param String	$playlist_id 	Playlist ID
	 * @return array					Acquisition record
	 */
	function sel_cnt_prog_by_playlist_id($playlist_id)
	{
		$now = Request::$request_dt;

		$query_str = "select ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(tmp_t_prog.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			( ";
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
		$query_str .= "						t_prog_inner.sta_dt <= :sta_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :end_dt or t_prog_inner.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "						t_prog_inner.client_id = :client_id and ";
		}
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
		$query_str .= "				(t_prog_outer.end_dt > :end_dt or t_prog_outer.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			) tmp_t_prog";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_now, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(tmp_t_prog.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			( ";
		$query_str .= "			select ";
		$query_str .= "				max(t_prog_outer.prog_id) prog_id, ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			from ";
		$query_str .= "				t_prog t_prog_outer ";
		$query_str .= "			where ";
		$query_str .= "				t_prog_outer.sta_dt > :sta_dt and ";
		if(isset($this->client_id)){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			) tmp_t_prog";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_playlist_rela.client_id = client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_future, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(t_prog_rgl.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			t_prog_rgl_grp ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_rgl ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		if(isset($this->client_id)){
			$query_str .= "				t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl.del_flag = 0 ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "		where ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_rgl ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		$query_str .= "	t_playlist.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":playlist_id"] = $playlist_id;
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get playlist count
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_cnt_playlist($search)
	{
		//Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_playlist_name)){
			$arr_playlist_name = $search->arr_playlist_name;
		}
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}

		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			$playlist_id = $search->playlist_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->timezone_id) && $search->timezone_id !== ""){
			$timezone_id = $search->timezone_id;
		}
		if(isset($search->deliverymonth_id) && $search->deliverymonth_id !== ""){
			$deliverymonth_id = $search->deliverymonth_id;
		}

		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(playlist.playlist_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	t_playlist.playlist_id ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and ";
		$query_str .= "	m_draw_tmpl.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.client_id = m_client.client_id and ";
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
//		$query_str .= "	m_timezone ";
//		$query_str .= "on ";
//		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
//		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "where ";

		//Add search condition (playlist name)
		if(!empty($arr_playlist_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_playlist_name as $playlist_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "		t_playlist.playlist_name ilike :playlist_name" . $i . " ";
				$arr_bind_param[":playlist_name" . $i] = "%" . $playlist_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		//Search condition (Movie name) added
		if(!empty($arr_movie_name)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_movie_rela ";
			$query_str .= "		join ";
			$query_str .= "			m_movie ";
			$query_str .= "		on ";
			$query_str .= "			t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_movie_name as $movie_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "				m_movie.movie_name ilike :movie_name" . $i . " ";
				$arr_bind_param[":movie_name" . $i] =  "%" . $movie_name . "%";
				$i++;
			}
			$query_str .= "			) and ";
			$query_str .= "			m_movie.del_flag = 0 ";
			$query_str .= "		where ";
			$query_str .= "			t_playlist.playlist_id = t_playlist_movie_rela.playlist_id and ";
			$query_str .= "			t_playlist_movie_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}

		//Add search condition (playlist ID)
		if(isset($playlist_id)){
			$query_str .= "	t_playlist.playlist_id = :playlist_id and ";
			$arr_bind_param[":playlist_id"] = $playlist_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	t_playlist.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}
		//Add search condition (distribution time zone)
		if(isset($timezone_id)){
			$query_str .= "	t_playlist.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $timezone_id;
		}
		//Search condition (distribution month) added
		if(isset($deliverymonth_id)){
			$query_str .= "	t_playlist.deliverymonth_id = :deliverymonth_id and ";
			$arr_bind_param[":deliverymonth_id"] = $deliverymonth_id;
		}

		//Add search condition (drawing area ID)
		if(isset($search->draw_tmpl_id) && $search->draw_tmpl_id !== ""){
			$query_str .= "	t_playlist.draw_tmpl_id = :draw_tmpl_id and ";
			$arr_bind_param[":draw_tmpl_id"] = $search->draw_tmpl_id;
		}

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " t_playlist.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}

		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_playlist.timezone_id <> 1 and ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= ") playlist ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get playlist list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_arr_playlist($search)
	{
		//Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_playlist_name)){
			$arr_playlist_name = $search->arr_playlist_name;
		}
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}

		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			$playlist_id = $search->playlist_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->timezone_id) && $search->timezone_id !== ""){
			$timezone_id = $search->timezone_id;
		}
		if(isset($search->deliverymonth_id) && $search->deliverymonth_id !== ""){
			$deliverymonth_id = $search->deliverymonth_id;
		}

		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		$offset = $search->offset;

		$arr_bind_param = array();
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;

		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.client_id, ";
		$query_str .= "	t_playlist.draw_tmpl_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.ants_version, ";
		$query_str .= "	t_playlist.sex_id, ";
		$query_str .= "	t_playlist.deliverymonth_id, ";
		$query_str .= "	t_playlist.sta_dt, ";
		$query_str .= "	t_playlist.end_dt, ";
		$query_str .= "	m_draw_tmpl.draw_tmpl_name, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(tmp_t_prog.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			( ";
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
		$query_str .= "						t_prog_inner.sta_dt <= :sta_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :end_dt or t_prog_inner.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "						t_prog_inner.client_id = :client_id and ";
		}
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
		$query_str .= "				(t_prog_outer.end_dt > :end_dt or t_prog_outer.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			) tmp_t_prog";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_now, ";	//For judging CH allocation
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(tmp_t_prog.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			( ";
		$query_str .= "			select ";
		$query_str .= "				max(t_prog_outer.prog_id) prog_id, ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			from ";
		$query_str .= "				t_prog t_prog_outer ";
		$query_str .= "			where ";
		$query_str .= "				t_prog_outer.sta_dt > :sta_dt and ";
		if(isset($this->client_id)){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			) tmp_t_prog";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_future, ";	//For judging CH allocation
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(t_prog_rgl.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			t_prog_rgl_grp ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_rgl ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		if(isset($this->client_id)){
			$query_str .= "				t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl.del_flag = 0 ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "		where ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_rgl, ";	//For judging CH allocation
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and ";
		$query_str .= "	m_draw_tmpl.del_flag = 0 ";

		$query_str .= "join ";
		$query_str .= "	m_timezone ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "where ";

		//For assigning CH assignment a Search condition (playlist name) added...
		if(!empty($arr_playlist_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_playlist_name as $playlist_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "		t_playlist.playlist_name ilike :playlist_name" . $i . " ";
				$arr_bind_param[":playlist_name" . $i] = "%" . $playlist_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		//Search condition (Movie name) added
		if(!empty($arr_movie_name)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_movie_rela ";
			$query_str .= "		join ";
			$query_str .= "			m_movie ";
			$query_str .= "		on ";
			$query_str .= "			t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_movie_name as $movie_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "				m_movie.movie_name ilike :movie_name" . $i . " ";
				$arr_bind_param[":movie_name" . $i] =  "%" . $movie_name . "%";
				$i++;
			}
			$query_str .= "			) and ";
			$query_str .= "			m_movie.del_flag = 0 ";
			$query_str .= "		where ";
			$query_str .= "			t_playlist.playlist_id = t_playlist_movie_rela.playlist_id and ";
			$query_str .= "			t_playlist_movie_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}

		//Add search condition (playlist ID)
		if(isset($playlist_id)){
			$query_str .= "	t_playlist.playlist_id = :playlist_id and ";
			$arr_bind_param[":playlist_id"] = $playlist_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	t_playlist.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}
		//Add search condition (distribution time zone)
		if(isset($timezone_id)){
			$query_str .= "	t_playlist.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $timezone_id;
		}
		//Search condition (distribution month) added
		if(isset($deliverymonth_id)){
			$query_str .= "	t_playlist.deliverymonth_id = :deliverymonth_id and ";
			$arr_bind_param[":deliverymonth_id"] = $deliverymonth_id;
		}
		//Add search condition (drawing area ID)
		if(isset($search->draw_tmpl_id) && $search->draw_tmpl_id !== ""){
			$query_str .= "	t_playlist.draw_tmpl_id = :draw_tmpl_id and ";
			$arr_bind_param[":draw_tmpl_id"] = $search->draw_tmpl_id;
		}

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " t_playlist.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_playlist.timezone_id <> 1 and ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(t_playlist.playlist_name,'UTF8'), ";
		$query_str .= "	t_playlist.playlist_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get playlist
	 *
	 * @param String	$playlist_name	Playlist name
	 * @return array					Acquisition record
	 */
	function sel_arr_playlist_by_playlist_name($playlist_name)
	{
		$query_str = "select ";
		$query_str .= "	playlist_id ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		$query_str .= "	playlist_name = :playlist_name and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
		}
		$query_str .= "	del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":playlist_name"] = $playlist_name;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
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
		$query_str .= "	draw_tmpl_id, ";
		$query_str .= "	image_intvl, ";
		$query_str .= "	random_flag, ";
		$query_str .= "	playlist_name, ";
		$query_str .= "	sex_id, ";
		$query_str .= "	timezone_id, ";
		$query_str .= "	deliverymonth_id, ";
		$query_str .= "	sta_dt, ";
		$query_str .= "	end_dt, ";
		$query_str .= "	ants_version ";
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
	 * Get playlist name
	 *
	 * @param String	$playlist_id	プレイリストID
	 * @return array					Acquisition record
	 */
	function sel_playlist_name($playlist_id)
	{
		$query_str = "select ";
		$query_str .= "	playlist_name ";
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
	 * Get drawing area template
	 *
	 * @param String	$draw_tmpl_id	Drawing area template ID
	 * @return array					Acquisition record
	 */
	public function sel_draw_tmpl_name($draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	draw_tmpl_name ";
		$query_str .= "from ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "where ";
		$query_str .= "	draw_tmpl_id = :draw_tmpl_id and ";
		$query_str .= "	del_flag = 0 ";

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
	 * Get movie list
	 * @param	array	$search	Acquisition record
	 * @return	array	$tagFlg	When acquiring the tag name true (default: false)
	 * @return	array		Acquisition record
	 */
	public function sel_arr_movie($search, $tagFlg = false)
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
		if((isset($search->sta_dt) && $search->sta_dt !== "") && (isset($search->end_dt) && $search->end_dt !== "")){
			$sta_dt = $search->sta_dt . " 00:00:00";
			$end_dt = $search->end_dt . " 23:59:59";
		}

		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->movie_name)){
			$movie_name = $search->movie_name;
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
		if ($tagFlg) {
			$query_str .= "	, m_movie_tag.movie_tag_name ";
		}
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_movie.client_id = m_client.client_id ";
		if ($tagFlg) {
			$query_str .= "left join ";
			$query_str .= "	t_movie_tag_rela ";
			$query_str .= "on ";
			$query_str .= "	m_movie.movie_id = t_movie_tag_rela.movie_id ";
			$query_str .= "left join ";
			$query_str .= "	m_movie_tag ";
			$query_str .= "on ";
			$query_str .= "	t_movie_tag_rela.movie_tag_id = m_movie_tag.movie_tag_id ";
		}
		$query_str .= "and ";
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
		if(!empty($sta_dt) && $sta_dt !== ""){
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
//			if(isset($this->client_id)){
//				$query_str .= "			t_movie_tag_rela.client_id = :client_id and ";
//			}
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
//			if(isset($this->client_id)){
//				$query_str .= "			t_movie_tag_rela.client_id = :client_id and ";
//			}
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
		if(!empty($movie_name)){
			$query_str .= "	( ";
			$query_str .= "		m_movie.movie_name ilike :movie_name"  ;
			$arr_bind_param[":movie_name" ] = "%" . $movie_name . "%";
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
	 * Get movie list in playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$draw_area_id	Drawing area ID
	 * @return array					Acquisition record
	 */
	function sel_arr_movie_by_playlist_id_draw_area_id($playlist_id, $draw_area_id)
	{
		$query_str = "select ";
		$query_str .= "	playlist_movie.movie_id, ";
		$query_str .= "	playlist_movie.movie_name, ";
		$query_str .= "	playlist_movie.orig_file_dir, ";
		$query_str .= "	playlist_movie.file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_exte, ";
		$query_str .= "	playlist_movie.movie_orig_file_name_480p, ";
		$query_str .= "	playlist_movie.movie_orig_file_exte_480p, ";
		$query_str .= "	playlist_movie.sound_orig_file_name, ";
		$query_str .= "	playlist_movie.sound_orig_file_exte, ";
		$query_str .= "	to_char(playlist_movie.sta_dt, 'YY-MM-DD HH24:MI') as sta_dt, ";
		$query_str .= "	to_char(playlist_movie.end_dt, 'YY-MM-DD HH24:MI') as end_dt, ";
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
		$query_str .= "	m_movie.movie_orig_file_name_480p, ";
		$query_str .= "	m_movie.movie_orig_file_exte_480p, ";
		$query_str .= "	m_movie.sound_orig_file_name, ";
		$query_str .= "	m_movie.sound_orig_file_exte, ";
		$query_str .= "	m_movie.sta_dt, ";
		$query_str .= "	m_movie.end_dt, ";
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
		$query_str .= "	t_playlist_movie_rela.playlist_rela_id is NULL and ";
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
		$query_str .= "	m_common_movie.movie_orig_file_name_480p, ";
		$query_str .= "	m_common_movie.movie_orig_file_exte_480p, ";
		$query_str .= "	m_common_movie.sound_orig_file_name, ";
		$query_str .= "	m_common_movie.sound_orig_file_exte, ";
		$query_str .= "	m_common_movie.sta_dt, ";
		$query_str .= "	m_common_movie.end_dt, ";
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
		$query_str .= "	t_playlist_movie_rela.playlist_rela_id is NULL and ";
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

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get video list in playlist (with date specified)
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
		$query_str .= "	t_playlist_movie_rela.playlist_rela_id is NULL and ";
		$query_str .= "	(m_movie.sta_dt <= :end_dt or m_movie.sta_dt is null) and ";
		$query_str .= "	(m_movie.end_dt >= :sta_dt or m_movie.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	'(Common) ' || m_common_movie.movie_name, ";
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
		$query_str .= "	t_playlist_movie_rela.playlist_rela_id is NULL and ";
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
	 * @return array					Acquisition record
	 */
	function sel_arr_image_by_playlist_id_draw_area_id($playlist_id, $draw_area_id)
	{
		$query_str = "select ";
		$query_str .= "	playlist_image.image_id, ";
		$query_str .= "	playlist_image.image_name, ";
		$query_str .= "	playlist_image.orig_file_dir, ";
		$query_str .= "	playlist_image.file_name, ";
		$query_str .= "	playlist_image.orig_file_name, ";
		$query_str .= "	playlist_image.orig_file_exte, ";
		$query_str .= "	to_char(playlist_image.sta_dt, 'YY-MM-DD HH24:MI') as sta_dt, ";
		$query_str .= "	to_char(playlist_image.end_dt, 'YY-MM-DD HH24:MI') as end_dt, ";
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
		$query_str .= "	m_image.sta_dt, ";
		$query_str .= "	m_image.end_dt, ";
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
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";

		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	'(共通) ' || m_common_image.image_name, ";
		$query_str .= "	m_common_image.orig_file_dir, ";
		$query_str .= "	m_common_image.file_name, ";
		$query_str .= "	m_common_image.orig_file_name, ";
		$query_str .= "	m_common_image.orig_file_exte, ";
		$query_str .= "	m_common_image.sta_dt, ";
		$query_str .= "	m_common_image.end_dt, ";
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

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get text list in playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$draw_area_id	Drawing area ID
	 * @return array					Acquisition record
	 */
	function sel_arr_text_by_playlist_id_draw_area_id($playlist_id, $draw_area_id)
	{
		$query_str = "select ";
		$query_str .= "	playlist_text.text_id, ";
		$query_str .= "	playlist_text.text_name, ";
		$query_str .= "	to_char(playlist_text.sta_dt, 'YY-MM-DD HH24:MI') as sta_dt, ";
		$query_str .= "	to_char(playlist_text.end_dt, 'YY-MM-DD HH24:MI') as end_dt, ";
		$query_str .= "	playlist_text.draw_area_id, ";
		$query_str .= "	playlist_text.display_order ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_text.text_id, ";
		$query_str .= "	m_text.text_name, ";
		$query_str .= "	m_text.sta_dt, ";
		$query_str .= "	m_text.end_dt, ";
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
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
		}
		$query_str .= "	m_text.del_flag = 0 ";

		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_text.text_id, ";
		$query_str .= "	'(共通) ' || m_common_text.text_name, ";
		$query_str .= "	m_common_text.sta_dt, ";
		$query_str .= "	m_common_text.end_dt, ";
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
		$query_str .= "	m_draw_area.cts_type, ";
		$query_str .= "	m_draw_area.rotate_flag ";
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
	 * Playlist primary key numbering
	 *
	 * @return int		Number assigned playlist_id
	 */
	public function sel_next_playlist_id()
	{
		$playlist_id = null;
		try{
			$t_playlist = new Model_T_Playlist($this->db, $this->client_id);
			$playlist_id = $t_playlist->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$playlist_id = null;
		}
		return $playlist_id;
	}

	/**
	 * Playlist registration
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function ins_playlist($playlist)
	{
		$ret = true;
		try{
			$t_playlist = new Model_T_Playlist($this->db, $this->client_id);
			$ret = $t_playlist->ins($playlist);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Update playlist
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function up_playlist($playlist)
	{
		$ret = true;
		try{
			$t_playlist = new Model_T_Playlist($this->db, $this->client_id);
			$t_playlist->up($playlist);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Acquire repeatedly designated program guide ID being used by repeat-designated program guide group
	 *
	 * @param String	$prog_rgl_grp_id	Repeatedly specified program guide group ID
	 * @return array					Acquisition record
	 */
	public function sel_arr_prog_rgl_id($prog_id)
	{
		$query_str = "select ";
		$query_str .= "	t_prog_rgl.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl.prog_id = :prog_id and ";
		$query_str .= "	t_prog_rgl.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":prog_id"] = $prog_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}


	/**
	 * Delete Playlist
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function del_playlist($playlist)
	{
		$ret = true;
		try{
			// Acquire the individual playlist ID of the influence target from the playlist linkage DB based on the ID of the common playlist
			$playlist_rela = new stdClass();
			$playlist_rela->common_playlist_id = $playlist->playlist_id;
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $this->client_id);
			$arr_playlist_rela = $t_playlist_rela->sel_arr_id_name_playlist_rela($playlist_rela);

			foreach($arr_playlist_rela as $playlist_rela_extra){

				// Get ID list of related individual playlist here

				//Acquire program guide ID from individual playlist ID
				$prog_playlist_rela = new stdClass();
				$prog_playlist_rela->playlist_id = $playlist_rela_extra->playlist_id;
				$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
				$arr_prog_rgl_grp = $t_prog_playlist_rela->sel_arr_id_name_prog_playlist_rela($prog_playlist_rela);

				foreach($arr_prog_rgl_grp as $prog_rgl_grp){
					// prog_id
					// playlist_id (Individual)
					// prog_rgl_grp_id
					// client_id

					$prog_id         = $prog_rgl_grp->prog_id;
					$prog_rgl_grp_id = $prog_rgl_grp->prog_rgl_grp_id;

					//Repeat Specified Program Guide Playlist Related
					$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $client->client_id);
					$prog_playlist_rela = new stdClass();
					$prog_playlist_rela->prog_id     = $prog_id;
					$prog_playlist_rela->update_user = $playlist->update_user;
					$prog_playlist_rela->update_dt   = $playlist->update_dt;
					$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

					//Repeatedly specified program guide
					$t_prog_rgl = new Model_T_Prog_Rgl($this->db, $client->client_id);
					$prog_rgl = new stdClass();
					$prog_rgl->prog_id     = $prog_id;
					$prog_rgl->update_user = $playlist->update_user;
					$prog_rgl->update_dt   = $playlist->update_dt;
					$t_prog_rgl->del($prog_rgl);

					//Repeatedly designated program guide group
					$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $client->client_id);
					$prog_rgl_grp = new stdClass();
					$prog_rgl_grp->prog_rgl_grp_id = $prog_rgl_grp_id;
					$prog_rgl_grp->update_user     = $playlist->update_user;
					$prog_rgl_grp->update_dt       = $playlist->update_dt;
					$t_prog_rgl_grp->del($prog_rgl_grp);
				}

				//Text playlist related
				$t_playlist_text_rela = new Model_T_Playlist_Text_Rela($this->db, $this->client_id);
				$playlist_text_rela = new stdClass();
				$playlist_text_rela->playlist_id = $playlist_rela_extra->playlist_id;
				$playlist_text_rela->update_user = $playlist->update_user;
				$playlist_text_rela->update_dt   = $playlist->update_dt;
				$t_playlist_text_rela->del_by_playlist_id($playlist_text_rela);

				//Program table Play list related (From common play list ID)
				$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
				$prog_playlist_rela = new stdClass();
				$prog_playlist_rela->playlist_id = $playlist_rela_extra->playlist_id;
				$prog_playlist_rela->update_user = $playlist->update_user;
				$prog_playlist_rela->update_dt   = $playlist->update_dt;
				$t_prog_playlist_rela->del_by_playlist_id($prog_playlist_rela);

				//Playlist (delete individual)
				$t_playlist_extra = new Model_T_Playlist($this->db, $this->client_id);
				$playlist_extra_rela = new stdClass();
				$playlist_extra_rela->playlist_id = $playlist_rela_extra->playlist_id;
				$playlist_extra_rela->update_user = $playlist->update_user;
				$playlist_extra_rela->update_dt   = $playlist->update_dt;
				$t_playlist_extra->del($playlist_extra_rela);
			}
			//Playlist (delete common)
			$t_playlist = new Model_T_Playlist($this->db, $this->client_id);
			$t_playlist->del($playlist);

		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Playlist linkage registration
	 *
	 * @param stdClass	playlist_rela	Playlist related
	 * @return bool						true = success, false = failure
	 */
	public function id_name_playlist_rela($playlist_rela)
	{
		$ret = true;
		try{
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $this->client_id);
			$ret = $t_playlist_rela->sel_arr_id_name_playlist_rela($playlist_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Playlist linkage registration
	 *
	 * @param stdClass	playlist_rela	Playlist related
	 * @return bool						true = success, false = failure
	 */
	public function ins_playlist_rela($playlist)
	{
		$ret = true;
		try{
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $this->client_id);
			$ret = $t_playlist_rela->ins($playlist);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Delete playlist collaboration
	 *
	 * @param stdClass	playlist_rela	Playlist related
	 * @return bool						true = success, false = failure
	 */
	public function del_playlist_rela($playlist)
	{
		$ret = true;
		try{
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $this->client_id);
			$ret = $t_playlist_rela->del($playlist);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}



	/**
	 * Playlist Movie Related Registration
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist video related
	 * @return bool								true = success, false = failure
	 */
	public function ins_playlist_movie_rela($playlist_movie_rela)
	{
		$ret = true;
		try{
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_rela($this->db, $this->client_id);
			$ret = $t_playlist_movie_rela->ins($playlist_movie_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Playlist Movie Related Delete
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist video related
	 * @return bool								true = success, false = failure
	 */
	public function del_playlist_movie_rela($playlist_movie_rela)
	{
		$ret = true;
		try{
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_rela($this->db, $this->client_id);
			$ret = $t_playlist_movie_rela->del_by_playlist_id_movie_id_draw_area_id_display_order($playlist_movie_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Playlist Movie Delete (Playlist ID related video all at once)
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist video related
	 * @return bool								true = success, false = failure
	 */
	public function del_playlist_movie_rela_by_playlist_id($playlist_movie_rela)
	{
		$ret = true;
		try{
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_rela($this->db, $this->client_id);
			$ret = $t_playlist_movie_rela->del_by_playlist_id($playlist_movie_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}


	/**
	 * Playlist image related registration
	 *
	 * @param stdClass	$playlist_image_rela	Playlist image related
	 * @return bool								true = success, false = failure
	 */
	public function ins_playlist_image_rela($playlist_image_rela)
	{
		$ret = true;
		try{
			$t_playlist_image_rela = new Model_T_Playlist_Image_rela($this->db, $this->client_id);
			$ret = $t_playlist_image_rela->ins($playlist_image_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Playlist image related delete
	 *
	 * @param stdClass	$playlist_image_rela	Playlist image related
	 * @return bool								true = success, false = failure
	 */
	public function del_playlist_image_rela($playlist_image_rela)
	{
		$ret = true;
		try{
			$t_playlist_image_rela = new Model_T_Playlist_Image_rela($this->db, $this->client_id);
			$ret = $t_playlist_image_rela->del_by_playlist_id_image_id_draw_area_id_display_order($playlist_image_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Registration related to playlist text
	 *
	 * @param stdClass	$playlist_text_rela	Playlist text related
	 * @return bool								true = success, false = failure
	 */
	public function ins_playlist_text_rela($playlist_text_rela)
	{
		$ret = true;
		try{
			$t_playlist_text_rela = new Model_T_Playlist_Text_rela($this->db, $this->client_id);
			$ret = $t_playlist_text_rela->ins($playlist_text_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Playlist Text Related Delete
	 *
	 * @param stdClass	$playlist_text_rela	Playlist text related
	 * @return bool								true = success, false = failure
	 */
	public function del_playlist_text_rela($playlist_text_rela)
	{
		$ret = true;
		try{
			$t_playlist_text_rela = new Model_T_Playlist_Text_rela($this->db, $this->client_id);
			$ret = $t_playlist_text_rela->del_by_playlist_id_text_id_draw_area_id_display_order($playlist_text_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Obtain list of terminals using program guide
	 *
	 * @param stdClass	$playlist_id	Playlist ID
	 * @return bool						true = success, false = failure
	 */
	public function sel_arr_dev_by_playlist_id($playlist_id)
	{
		$query_str = "select ";
		$query_str .= "	t_prog.dev_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "join ";
		$query_str .= "	t_prog_playlist_rela ";
		$query_str .= "on ";
		$query_str .= "	t_prog_playlist_rela.playlist_id = :playlist_id and ";
		$query_str .= "	t_prog_playlist_rela.prog_id = t_prog.prog_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
		}
		$query_str .= "	t_prog.del_flag = 0 ";
		$query_str .= "union ";
		$query_str .= "select ";
		$query_str .= "	t_prog_rgl_grp.dev_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "join ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "on ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	t_prog_playlist_rela ";
		$query_str .= "on ";
		$query_str .= "	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "	t_prog_playlist_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";

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
	 * Get movie list
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$ret = true;
		try{
			$m_movie = new Model_M_Movie($this->db, $this->client_id);
			$ret = $m_movie->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Get movie related list
	 * @return array				Acquisition record
	 */
	public function sel_arr_playlist_movie_rela($playlist_movie_rela)
	{
		$ret = true;
		try{
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_rela($this->db, $this->client_id);
			$ret = $t_playlist_movie_rela->sel_arr_id_name_playlist_movie_rela($playlist_movie_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}


	/**
	 * * Playlist _ Acquire video linkage DB list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name_playlist_movie_rela($playlist_movie_rela)
	{
		$bindArr = array();

		$query_str = "select ";
		$query_str .= "	playlist_movie_rela_id, ";
		$query_str .= "	playlist_id, ";
		$query_str .= "	movie_id, ";
		$query_str .= "	draw_area_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	display_order ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "where ";
		if(isset($playlist_movie_rela->playlist_id) && $playlist_movie_rela->playlist_id !== ""){
			$query_str .= " playlist_id = :playlist_id and ";
			$bindArr[":playlist_id"] = $playlist_movie_rela->playlist_id;
		}
		if(isset($playlist_movie_rela->playlist_rela_id) && $playlist_movie_rela->playlist_rela_id !== ""){
			$query_str .= " playlist_rela_id = :playlist_rela_id and ";
			$bindArr[":playlist_rela_id"] = $playlist_movie_rela->playlist_rela_id;
		} else {
			$query_str .= " playlist_rela_id is NULL and ";
		}

		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	playlist_id, ";
 		$query_str .= "	display_order desc ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($bindArr);
		return $query->execute($this->db, true);
	}

	/**
	 * Get video ID from video name
	 *
	 * @param String	$movie_name		Movie name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($movie_name)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.image_id ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "where ";
		$query_str .= "	m_movie.movie_name = :movie_name and ";
		$arr_bind_param[":movie_name"] = $movie_name;
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "limit 1 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);

	}


	/**
	 * Get playlist list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_arr_common_playlist($search)
	{
		//Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_playlist_name)){
			$arr_playlist_name = $search->arr_playlist_name;
		}
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}

		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->timezone_id) && $search->timezone_id !== ""){
			$timezone_id = $search->timezone_id;
		}
		if(isset($search->deliverymonth_id) && $search->deliverymonth_id !== ""){
			$deliverymonth_id = $search->deliverymonth_id;
		}
		if(isset($search->commonplaylist) && $search->commonplaylist !== ""){
			$commonplaylist = $search->commonplaylist;
		}

		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		$offset = $search->offset;

		$arr_bind_param = array();
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;

		if(isset($search->sta_dt) && $search->sta_dt !== ""){
			$arr_bind_param[":sta_dt"] = $search->sta_dt;
		}
		if(isset($search->end_dt) && $search->end_dt !== ""){
			$arr_bind_param[":end_dt"] = $search->end_dt;
		}

		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.client_id, ";
		$query_str .= "	t_playlist.draw_tmpl_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.ants_version, ";
		$query_str .= "	t_playlist.sex_id, ";
		$query_str .= "	t_playlist.deliverymonth_id, ";
		$query_str .= "	t_playlist.sta_dt, ";
		$query_str .= "	t_playlist.end_dt, ";
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_timezone ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "where ";

		if(isset($commonplaylist) && $commonplaylist == true){
			$query_str .= "	t_playlist.timezone_id <> 1 and ";
		} elseif(isset($commonplaylist) && $commonplaylist == false){
			$query_str .= "	t_playlist.timezone_id = 1 and ";
		}

		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	t_playlist.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}
		//Add search condition (distribution time zone)
		if(isset($timezone_id)){
			$query_str .= "	t_playlist.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $timezone_id;
		}
		//Search condition (distribution month) added
		if(isset($deliverymonth_id)){
			$query_str .= "	t_playlist.deliverymonth_id = :deliverymonth_id and ";
			$arr_bind_param[":deliverymonth_id"] = $deliverymonth_id;
		}
		//Add search condition (drawing area ID)
		if(isset($search->draw_tmpl_id) && $search->draw_tmpl_id !== ""){
			$query_str .= "	t_playlist.draw_tmpl_id = :draw_tmpl_id and ";
			$arr_bind_param[":draw_tmpl_id"] = $search->draw_tmpl_id;
		}

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " t_playlist.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}
//		if(isset($search->client_id)){
//			$query_str .= "	t_playlist.client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $search->client_id;
//		}
		// Valid period determination
		if(!empty($search->sta_dt) && $search->sta_dt !== ""){
			$query_str .= "	t_playlist.sta_dt <= :end_dt and ";
			$query_str .= "	(t_playlist.end_dt > :sta_dt or t_playlist.end_dt is null) and ";
		}
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(t_playlist.playlist_name,'UTF8'), ";
		$query_str .= "	t_playlist.playlist_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get playlist list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_arr_common_playlist_overlap($search)
	{
		//Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_playlist_name)){
			$arr_playlist_name = $search->arr_playlist_name;
		}
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			$playlist_id = $search->playlist_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->timezone_id) && $search->timezone_id !== ""){
			$timezone_id = $search->timezone_id;
		}
		if(isset($search->deliverymonth_id) && $search->deliverymonth_id !== ""){
			$deliverymonth_id = $search->deliverymonth_id;
		}
		if(isset($search->commonplaylist) && $search->commonplaylist !== ""){
			$commonplaylist = $search->commonplaylist;
		}

		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		$offset = $search->offset;

		$arr_bind_param = array();
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;

		if(isset($search->sta_dt) && $search->sta_dt !== ""){
			$arr_bind_param[":sta_dt"] = $search->sta_dt;
		}
		if(isset($search->end_dt) && $search->end_dt !== ""){
			$arr_bind_param[":end_dt"] = $search->end_dt;
		}

		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.client_id, ";
		$query_str .= "	t_playlist.draw_tmpl_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.ants_version, ";
		$query_str .= "	t_playlist.sex_id, ";
		$query_str .= "	t_playlist.deliverymonth_id, ";
		$query_str .= "	t_playlist.sta_dt, ";
		$query_str .= "	t_playlist.end_dt, ";
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_timezone ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "where ";

		if(isset($commonplaylist) && $commonplaylist == true){
			$query_str .= "	t_playlist.timezone_id <> 1 and ";
		} elseif(isset($commonplaylist) && $commonplaylist == false){
			$query_str .= "	t_playlist.timezone_id = 1 and ";
		}

		if(isset($playlist_id)){
			$query_str .= "	playlist_id <> :playlist_id and ";
			$arr_bind_param[":playlist_id"] = $playlist_id;
		}

		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	t_playlist.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}
		//Add search condition (distribution time zone)
		if(isset($timezone_id)){
			$query_str .= "	t_playlist.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $timezone_id;
		}
		//Search condition (distribution month) added
		if(isset($deliverymonth_id)){
			$query_str .= "	t_playlist.deliverymonth_id = :deliverymonth_id and ";
			$arr_bind_param[":deliverymonth_id"] = $deliverymonth_id;
		}
		//Add search condition (drawing area ID)
		if(isset($search->draw_tmpl_id) && $search->draw_tmpl_id !== ""){
			$query_str .= "	t_playlist.draw_tmpl_id = :draw_tmpl_id and ";
			$arr_bind_param[":draw_tmpl_id"] = $search->draw_tmpl_id;
		}

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " t_playlist.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}
//		if(isset($search->client_id)){
//			$query_str .= "	t_playlist.client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $search->client_id;
//		}
		// Valid period determination
		if(!empty($search->sta_dt) && $search->sta_dt !== ""){
			$query_str .= "	t_playlist.sta_dt <= :end_dt and ";
			$query_str .= "	(t_playlist.end_dt > :sta_dt or t_playlist.end_dt is null) and ";
		}
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(t_playlist.playlist_name,'UTF8'), ";
		$query_str .= "	t_playlist.playlist_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Play list linkage Primary key number assignment
	 *
	 * @return int		Number assigned playlist_rela_id
	 */
	public function sel_next_playlist_rela_id()
	{
		$playlist_rela_id = null;
		try{
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $this->client_id);
			$playlist_rela_id = $t_playlist_rela->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$playlist_rela_id = null;
		}
		return $playlist_rela_id;
	}



	/**
	 * Get terminal list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_serial_no)){
			$arr_serial_no = $search->arr_serial_no;
		}
		if(!empty($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(!empty($search->arr_note)){
			$arr_note = $search->arr_note;
		}
		if(isset($search->invalid_flag) && $search->invalid_flag !== ""){
			$invalid_flag = $search->invalid_flag;
		}
		if(isset($search->mail_flag) && $search->mail_flag !== ""){
			$mail_flag = $search->mail_flag;
		}
		if(isset($search->dl_status) && $search->dl_status !== ""){
			$dl_status = $search->dl_status;
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
		if(!empty($search->arr_shop_name)){
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
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.serial_no, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.invalid_flag, ";
		$query_str .= "	m_dev.mail_flag, ";
		$query_str .= "	m_dev.service_id, ";
		$query_str .= "	m_dev.download_status, ";
		$query_str .= "	m_shop.shop_id, ";
		$query_str .= "	m_shop.shop_name, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.client_id = m_shop.client_id and ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($search->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_shop.client_id = m_client.client_id and ";
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
			if(isset($search->client_id)){
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
			if(isset($search->client_id)){
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
			if(isset($search->client_id)){
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
			if(isset($search->client_id)){
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

		//Search condition (remarks) added
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

		//Search condition (state) addition
		if(isset($invalid_flag) && $invalid_flag !== ""){
			$query_str .= "		m_dev.invalid_flag = :invalid_flag and ";
			$arr_bind_param[":invalid_flag"] = $invalid_flag;
		}

		//Add search condition (monitoring)
		if(isset($mail_flag) && $mail_flag !== ""){
			$query_str .= "		m_dev.mail_flag = :mail_flag and ";
			$arr_bind_param[":mail_flag"] = $mail_flag;
		}

		//Add search condition (DL)
		if(isset($dl_status) && $dl_status !== ""){
			$query_str .= "		m_dev.download_status = :dl_status and ";
			$arr_bind_param[":dl_status"] = $dl_status;
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
		if(isset($search->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $search->client_id;
		}

		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.dev_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}


	/**
	 * Acquire active program list
	 *
	 * @param stdClass	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	function sel_arr_prog_rgl_grp_by_dev_id($dev){
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		if(isset($dev->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $dev->client_id;
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$arr_bind_param[":dev_id"] = $dev->dev_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}


	/**
	 * Program guide (repeated designation) group deletion
	 *
	 * @param stdClass	$prog_rgl_grp	Program guide (repeated designation) group
	 * @return bool						true = success, false = failure
	 */
	public function del_prog_rgl_grp($prog_rgl_grp)
	{
		$ret = true;
		try{
			$arr_prog_rgl = $this->sel_arr_prog_rgl_by_prog_rgl_grp_id($prog_rgl_grp);

			foreach($arr_prog_rgl as $tmp_prog_rgl){
				//Program guide (repeated designation)
				$t_prog_rgl = new Model_T_Prog_Rgl($this->db, $this->client_id);
				$prog_rgl = new stdClass();
				$prog_rgl->prog_id = $tmp_prog_rgl->prog_id;
				$prog_rgl->client_id = $prog_rgl_grp->client_id;
				$prog_rgl->update_user = $prog_rgl_grp->update_user;
				$prog_rgl->update_dt = $prog_rgl_grp->update_dt;
				$t_prog_rgl->del($prog_rgl);

				//Program list Play list related
				$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
				$prog_playlist_rela = new stdClass();
				$prog_playlist_rela->prog_id = $tmp_prog_rgl->prog_id;
				$prog_playlist_rela->client_id = $prog_rgl_grp->client_id;
				$prog_playlist_rela->update_user = $prog_rgl_grp->update_user;
				$prog_playlist_rela->update_dt = $prog_rgl_grp->update_dt;
				$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);
			}

			//Program guide (repeated designation) group
			$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $this->client_id);
			$t_prog_rgl_grp->del($prog_rgl_grp);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}


	/**
	 * Acquire program list (repeated designation) list
	 *
	 * @param String	$prog_rgl_grp_id	Program guide (repeated designation) group ID
	 * @return array						Acquisition record
	 */
	function sel_arr_prog_rgl_by_prog_rgl_grp_id($prog_rgl_grp){
		$query_str = "select ";
		$query_str .= "	t_prog_rgl.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl.prog_rgl_grp_id = :prog_rgl_grp_id and ";
		if(isset($prog_rgl_grp->client_id)){
			$query_str .= "	t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= " t_prog_rgl.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl_grp->prog_rgl_grp_id;
		if(isset($prog_rgl_grp->client_id)){
			$arr_bind_param[":client_id"] = $prog_rgl_grp->client_id;
		}
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}


	/**
	 * Program guide (repeated designation) group primary key number assignment
	 *
	 * @return int		Number assigned prog_rgl_grp_id
	 */
	public function sel_next_prog_rgl_grp_id()
	{
		$prog_rgl_grp_id = null;
		try{
			$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $this->client_id);
			$prog_rgl_grp_id = $t_prog_rgl_grp->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$prog_id = null;
		}
		return $prog_rgl_grp_id;
	}


	/**
	 * Program list (repeated designation) Group registration
	 *
		 * @param stdClass	$prog_rgl_grp	Program guide (repeated designation) group
	 * @return bool						true = success, false = failure
	 */
	public function ins_prog_rgl_grp($prog_rgl_grp)
	{
		$ret = true;
		try{
			$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $this->client_id);
			$ret = $t_prog_rgl_grp->ins($prog_rgl_grp);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
