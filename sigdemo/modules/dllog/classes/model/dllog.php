<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Dllog extends Model
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
	 * Acquire number of terminal program list download logs
	 * @param	String	$dev_id			Device ID
	 * @param	String	$dl_sta_dt		Download start date and time
	 * @param	String	$dl_end_dt		Download end date and time
	 * @return	array					Acquisition record
	 */
	public function sel_cnt_dev_prog_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt)
	{
		$query_str = "select ";
		$query_str .= "	count(prog_dl_log_cnt.dev_prog_dl_log_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "select ";
		$query_str .= "	prog_dl_log.dev_prog_dl_log_id ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "select ";
		$query_str .= "		inner_prog_dl_log_1.dev_prog_dl_log_id, ";
		$query_str .= "		inner_prog_dl_log_1.sta_dt, ";
		$query_str .= "		inner_prog_dl_log_1.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_prog_dl_log.dev_prog_dl_log_id, ";
		$query_str .= "		t_dev_prog_dl_log.sta_dt, ";
		$query_str .= "		t_dev_prog_dl_log.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_prog_dl_log ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_prog_dl_log.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_prog_dl_log.sta_dt >= :dl_sta_dt and t_dev_prog_dl_log.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_prog_dl_log.end_dt >= :dl_sta_dt and t_dev_prog_dl_log.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_prog_dl_log.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_prog_dl_log.dev_prog_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= ") inner_prog_dl_log_1 ";
		$query_str .= " union all ";
		$query_str .= "select ";
		$query_str .= "		inner_prog_dl_log_2.dev_prog_dl_log_id, ";
		$query_str .= "		inner_prog_dl_log_2.sta_dt, ";
		$query_str .= "		inner_prog_dl_log_2.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_prog_dl_log_old.dev_prog_dl_log_id, ";
		$query_str .= "		t_dev_prog_dl_log_old.sta_dt, ";
		$query_str .= "		t_dev_prog_dl_log_old.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_prog_dl_log_old ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_prog_dl_log_old.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_prog_dl_log_old.sta_dt >= :dl_sta_dt and t_dev_prog_dl_log_old.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_prog_dl_log_old.end_dt >= :dl_sta_dt and t_dev_prog_dl_log_old.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_prog_dl_log_old.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_prog_dl_log_old.dev_prog_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_DLLOG_OLD . " ";
		$query_str .= ") inner_prog_dl_log_2 ";
		$query_str .= ") prog_dl_log ";
		$query_str .= ") prog_dl_log_cnt ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$arr_bind_param[":dl_sta_dt"] = $dl_sta_dt;
			$arr_bind_param[":dl_end_dt"] = $dl_end_dt;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Obtain terminal list download list download log list
	 * @param	String	$dev_id			Device ID
	 * @param	String	$dl_sta_dt		Download start date and time
	 * @param	String	$dl_end_dt		Download end date and time
	 * @param	String	$offset			offset
	 * @return	array					Acquisition record
	 */
	public function sel_arr_dev_prog_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt, $offset)
	{
		$query_str = "select ";
		$query_str .= "	prog_dl_log.sta_dt, ";
		$query_str .= "	prog_dl_log.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "select ";
		$query_str .= "		inner_prog_dl_log_1.dev_prog_dl_log_id, ";
		$query_str .= "		inner_prog_dl_log_1.sta_dt, ";
		$query_str .= "		inner_prog_dl_log_1.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_prog_dl_log.dev_prog_dl_log_id, ";
		$query_str .= "		t_dev_prog_dl_log.sta_dt, ";
		$query_str .= "		t_dev_prog_dl_log.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_prog_dl_log ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_prog_dl_log.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_prog_dl_log.sta_dt >= :dl_sta_dt and t_dev_prog_dl_log.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_prog_dl_log.end_dt >= :dl_sta_dt and t_dev_prog_dl_log.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_prog_dl_log.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_prog_dl_log.dev_prog_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= ") inner_prog_dl_log_1 ";
		$query_str .= " union all ";
		$query_str .= "select ";
		$query_str .= "		inner_prog_dl_log_2.dev_prog_dl_log_id, ";
		$query_str .= "		inner_prog_dl_log_2.sta_dt, ";
		$query_str .= "		inner_prog_dl_log_2.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_prog_dl_log_old.dev_prog_dl_log_id, ";
		$query_str .= "		t_dev_prog_dl_log_old.sta_dt, ";
		$query_str .= "		t_dev_prog_dl_log_old.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_prog_dl_log_old ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_prog_dl_log_old.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_prog_dl_log_old.sta_dt >= :dl_sta_dt and t_dev_prog_dl_log_old.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_prog_dl_log_old.end_dt >= :dl_sta_dt and t_dev_prog_dl_log_old.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_prog_dl_log_old.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_prog_dl_log_old.dev_prog_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_DLLOG_OLD . " ";
		$query_str .= ") inner_prog_dl_log_2 ";
		$query_str .= ") prog_dl_log ";
		$query_str .= "order by ";
		$query_str .= "	prog_dl_log.dev_prog_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		$arr_bind_param[":offset"] = $offset;
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$arr_bind_param[":dl_sta_dt"] = $dl_sta_dt;
			$arr_bind_param[":dl_end_dt"] = $dl_end_dt;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquisition of number of terminal HTML related download logs
	 * @param	String	$dev_id			Device ID
	 * @param	String	$dl_sta_dt		Download start date and time
	 * @param	String	$dl_end_dt		Download end date and time
	 * @return	array					Acquisition record
	 */
	public function sel_cnt_dev_html_rela_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt)
	{
		$query_str = "select ";
		$query_str .= "	count(html_rela_dl_log_cnt.dev_html_rela_dl_log_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "select ";
		$query_str .= "	html_rela_dl_log.dev_html_rela_dl_log_id ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "select ";
		$query_str .= "		inner_html_rela_dl_log_1.dev_html_rela_dl_log_id, ";
		$query_str .= "		inner_html_rela_dl_log_1.sta_dt, ";
		$query_str .= "		inner_html_rela_dl_log_1.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_html_rela_dl_log.dev_html_rela_dl_log_id, ";
		$query_str .= "		t_dev_html_rela_dl_log.sta_dt, ";
		$query_str .= "		t_dev_html_rela_dl_log.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_html_rela_dl_log ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_html_rela_dl_log.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_html_rela_dl_log.sta_dt >= :dl_sta_dt and t_dev_html_rela_dl_log.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_html_rela_dl_log.end_dt >= :dl_sta_dt and t_dev_html_rela_dl_log.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_html_rela_dl_log.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_html_rela_dl_log.dev_html_rela_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= ") inner_html_rela_dl_log_1 ";
		$query_str .= " union all ";
		$query_str .= "select ";
		$query_str .= "		inner_html_rela_dl_log_2.dev_html_rela_dl_log_id, ";
		$query_str .= "		inner_html_rela_dl_log_2.sta_dt, ";
		$query_str .= "		inner_html_rela_dl_log_2.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_html_rela_dl_log_old.dev_html_rela_dl_log_id, ";
		$query_str .= "		t_dev_html_rela_dl_log_old.sta_dt, ";
		$query_str .= "		t_dev_html_rela_dl_log_old.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_html_rela_dl_log_old ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_html_rela_dl_log_old.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_html_rela_dl_log_old.sta_dt >= :dl_sta_dt and t_dev_html_rela_dl_log_old.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_html_rela_dl_log_old.end_dt >= :dl_sta_dt and t_dev_html_rela_dl_log_old.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_html_rela_dl_log_old.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_html_rela_dl_log_old.dev_html_rela_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_DLLOG_OLD . " ";
		$query_str .= ") inner_html_rela_dl_log_2 ";
		$query_str .= ") html_rela_dl_log ";
		$query_str .= ") html_rela_dl_log_cnt ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$arr_bind_param[":dl_sta_dt"] = $dl_sta_dt;
			$arr_bind_param[":dl_end_dt"] = $dl_end_dt;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Obtain terminal related HTML download log list
	 * @param	String	$dev_id			Device ID
	 * @param	String	$dl_sta_dt		Download start date and time
	 * @param	String	$dl_end_dt		Download end date and time
	 * @param	String	$offset			offset
	 * @return	array					Acquisition record
	 */
	public function sel_arr_dev_html_rela_dl_log_by_dev_id_dl_dt($dev_id, $dl_sta_dt, $dl_end_dt, $offset)
	{
		$query_str = "select ";
		$query_str .= "	html_rela_dl_log.sta_dt, ";
		$query_str .= "	html_rela_dl_log.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "select ";
		$query_str .= "		inner_html_rela_dl_log_1.dev_html_rela_dl_log_id, ";
		$query_str .= "		inner_html_rela_dl_log_1.sta_dt, ";
		$query_str .= "		inner_html_rela_dl_log_1.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_html_rela_dl_log.dev_html_rela_dl_log_id, ";
		$query_str .= "		t_dev_html_rela_dl_log.sta_dt, ";
		$query_str .= "		t_dev_html_rela_dl_log.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_html_rela_dl_log ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_html_rela_dl_log.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_html_rela_dl_log.sta_dt >= :dl_sta_dt and t_dev_html_rela_dl_log.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_html_rela_dl_log.end_dt >= :dl_sta_dt and t_dev_html_rela_dl_log.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_html_rela_dl_log.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_html_rela_dl_log.dev_html_rela_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= ") inner_html_rela_dl_log_1 ";
		$query_str .= " union all ";
		$query_str .= "select ";
		$query_str .= "		inner_html_rela_dl_log_2.dev_html_rela_dl_log_id, ";
		$query_str .= "		inner_html_rela_dl_log_2.sta_dt, ";
		$query_str .= "		inner_html_rela_dl_log_2.end_dt ";
		$query_str .= "from ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_dev_html_rela_dl_log_old.dev_html_rela_dl_log_id, ";
		$query_str .= "		t_dev_html_rela_dl_log_old.sta_dt, ";
		$query_str .= "		t_dev_html_rela_dl_log_old.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		t_dev_html_rela_dl_log_old ";
		$query_str .= "	where ";
		$query_str .= "		t_dev_html_rela_dl_log_old.dev_id = :dev_id and ";
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$query_str .= "	( ";
			$query_str .= "	(t_dev_html_rela_dl_log_old.sta_dt >= :dl_sta_dt and t_dev_html_rela_dl_log_old.sta_dt < :dl_end_dt) or ";
			$query_str .= "	(t_dev_html_rela_dl_log_old.end_dt >= :dl_sta_dt and t_dev_html_rela_dl_log_old.end_dt < :dl_end_dt) ";
			$query_str .= "	) and ";
		}
		$query_str .= "		t_dev_html_rela_dl_log_old.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_html_rela_dl_log_old.dev_html_rela_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_DLLOG_OLD . " ";
		$query_str .= ") inner_html_rela_dl_log_2 ";
		$query_str .= ") html_rela_dl_log ";
		$query_str .= "order by ";
		$query_str .= "	html_rela_dl_log.dev_html_rela_dl_log_id desc ";
		$query_str .= "	limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		$arr_bind_param[":offset"] = $offset;
		if(isset($dl_sta_dt) && isset($dl_end_dt)){
			$arr_bind_param[":dl_sta_dt"] = $dl_sta_dt;
			$arr_bind_param[":dl_end_dt"] = $dl_end_dt;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}
}
