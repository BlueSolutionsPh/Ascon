<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Playcnt extends Model
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
	 * Terminal acquisition
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_dev($dev_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_shop.shop_name, ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$query_str .= "	m_dev.ants_version, ";
		}
		$query_str .= "	m_dev.dev_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
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
	 * Acquire number of display contents
	 * @param	String	$dev_id				Device ID
	 * @param	String	$playcnt_sta_dt		Start date and time
	 * @param	String	$playcnt_end_dt		End date and time
	 * @return	array						Acquisition record
	 */
	public function sel_cnt_contents($dev_id, $playcnt_sta_dt, $playcnt_end_dt)
	{
		$query_str = "select ";
		$query_str .= "	count(cts.play_file_name) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= " play_file_name, count(*) as playcount ";
		$query_str .= "from ";
		$query_str .= " t_dev_play_count ";
		$query_str .= "where ";
		$query_str .= "	t_dev_play_count.dev_id = :dev_id and ";
		if(isset($playcnt_sta_dt) && isset($playcnt_end_dt)){
			$query_str .= "	t_dev_play_count.play_dt >= :playcnt_sta_dt and ";
			$query_str .= " t_dev_play_count.play_dt < :playcnt_end_dt and ";
		}
		$query_str .= "	t_dev_play_count.del_flag = 0 ";
		$query_str .= "group by ";
		$query_str .= " play_file_name ";
		$query_str .= ") cts ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($playcnt_sta_dt) && isset($playcnt_end_dt)){
			$arr_bind_param[":playcnt_sta_dt"] = $playcnt_sta_dt;
			$arr_bind_param[":playcnt_end_dt"] = $playcnt_end_dt;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Retrieve the number of terminal content playback count
	 * @param	String	$dev_id				Device ID
	 * @param	String	$playcnt_sta_dt		Start date and time
	 * @param	String	$playcnt_end_dt		End date and time
	 * @param stdClass	$search				Search condition
	 * @return	array						Acquisition record
	 */
	public function sel_dev_playcnt_by_dev_id_playcnt_dt($dev_id, $playcnt_sta_dt, $playcnt_end_dt, $offset)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= " t_dev_play_count.play_file_name, ";
		$query_str .= " sum(t_dev_play_count.play_count) ";
		$query_str .= "from ";
		$query_str .= " t_dev_play_count ";
		$query_str .= "where ";
		$query_str .= "	t_dev_play_count.dev_id = :dev_id and ";
		if(isset($playcnt_sta_dt) && isset($playcnt_end_dt)){
			$query_str .= "	t_dev_play_count.play_dt >= :playcnt_sta_dt and ";
			$query_str .= " t_dev_play_count.play_dt < :playcnt_end_dt and ";
		}
		$query_str .= "	t_dev_play_count.del_flag = 0 ";
		$query_str .= "group by ";
		$query_str .= " t_dev_play_count.play_file_name ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";

		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($playcnt_sta_dt) && isset($playcnt_end_dt)){
			$arr_bind_param[":playcnt_sta_dt"] = $playcnt_sta_dt;
			$arr_bind_param[":playcnt_end_dt"] = $playcnt_end_dt;
		}
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Terminal content playback count Number of acquisition days
	 * @param	String	$dev_id				Device ID
	 * @param	String	$playcnt_sta_dt		Start date and time
	 * @param	String	$playcnt_end_dt		End date and time
	 * @param stdClass	$search				Search condition
	 * @return	array						Acquisition record
	 */
	public function sel_dev_playcnt_by_dev_id_playcnt_dt_by_day($dev_id, $playcnt_sta_dt, $playcnt_end_dt, $offset)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= " t_dev_play_count.play_file_name, to_char(t_dev_play_count.play_dt,'YYYY-MM-DD') as day, ";
		$query_str .= " sum(t_dev_play_count.play_count) ";
		$query_str .= "from ";
		$query_str .= " t_dev_play_count ";
		$query_str .= "where ";
		$query_str .= "	t_dev_play_count.dev_id = :dev_id and ";
		if(isset($playcnt_sta_dt) && isset($playcnt_end_dt)){
			$query_str .= "	t_dev_play_count.play_dt >= :playcnt_sta_dt and ";
			$query_str .= " t_dev_play_count.play_dt < :playcnt_end_dt and ";
		}
		$query_str .= "	t_dev_play_count.del_flag = 0 ";
		$query_str .= "group by ";
		$query_str .= " t_dev_play_count.play_file_name, t_dev_play_count.play_dt ";
		$query_str .= "order by ";
		$query_str .= " t_dev_play_count.play_file_name, t_dev_play_count.play_dt ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";

		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($playcnt_sta_dt) && isset($playcnt_end_dt)){
			$arr_bind_param[":playcnt_sta_dt"] = $playcnt_sta_dt;
			$arr_bind_param[":playcnt_end_dt"] = $playcnt_end_dt;
		}
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire image name from file name
	 * @param	String	$file_name			file name
	 * @return	array						Acquisition record
	 */
	public function sel_image_name_by_file_name($file_name)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_image.file_name = :file_name ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.file_name = :file_name ";
		$query_str .= "limit 1 ";

		$arr_bind_param[":file_name"] = $file_name;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get movie name from file name
	 * @param	String	$file_name			file name
	 * @return	array						Acquisition record
	 */
	public function sel_movie_name_by_file_name($file_name)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_movie.movie_name ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_movie.file_name = :file_name ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.file_name = :file_name ";
		$query_str .= "limit 1 ";

		$arr_bind_param[":file_name"] = $file_name;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}
}
