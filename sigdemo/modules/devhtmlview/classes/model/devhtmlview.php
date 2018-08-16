<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Devhtmlview extends Model
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
	 * Get HTML distribution name
	 *
	 * @param String	$dev_html_rela_id	Terminal HTML related ID
	 * @return array						Acquisition record
	 */
	function sel_dev_html_rela($dev_html_rela_id){
		$query_str = "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_html.html_name ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "join ";
		$query_str .= "	m_dev ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.dev_id = m_dev.dev_id and ";
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id = :dev_html_rela_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_html_rela_id"] = $dev_html_rela_id;
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
	 * @return array				取得レコード
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
	 * Acquire active terminal HTML relation from terminal ID
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	function sel_arr_dev_html_rela($dev_id){
		$now = Request::$request_dt;
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	dev_html_rela.sta_dt, ";
		$query_str .= "	dev_html_rela.end_dt, ";
		$query_str .= "	dev_html_rela.html_id, ";
		$query_str .= "	dev_html_rela.html_name, ";
		$query_str .= "	dev_html_rela.file_name, ";
		$query_str .= "	dev_html_rela.orig_file_exte ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	m_html.html_id, ";
		$query_str .= "	m_html.html_name, ";
		$query_str .= "	m_html.file_name, ";
		$query_str .= "	m_html.orig_file_exte ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "join ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			max(t_dev_html_rela_outer.dev_html_rela_id) dev_html_rela_id, ";
		$query_str .= "			t_dev_html_rela_outer.sta_dt, ";
		$query_str .= "			t_dev_html_rela_outer.end_dt, ";
		$query_str .= "			t_dev_html_rela_outer.dev_id ";
		$query_str .= "		from ";
		$query_str .= "			t_dev_html_rela t_dev_html_rela_outer ";
		$query_str .= "		where ";
		$query_str .= "			t_dev_html_rela_outer.dev_id = :dev_id and ";
		$query_str .= "			t_dev_html_rela_outer.sta_dt = ( ";
		$query_str .= "				select ";
		$query_str .= "					max(t_dev_html_rela_inner.sta_dt) ";
		$query_str .= "				from ";
		$query_str .= "					t_dev_html_rela t_dev_html_rela_inner ";
		$query_str .= "				where ";
		$query_str .= "					t_dev_html_rela_inner.dev_id = :dev_id and ";
		$query_str .= "					t_dev_html_rela_inner.sta_dt <= :sta_dt and ";
		$query_str .= "					t_dev_html_rela_inner.end_dt > :end_dt and ";
		if(isset($this->client_id)){
			$query_str .= "					t_dev_html_rela_inner.client_id = :client_id and ";
		}
		$query_str .= "					t_dev_html_rela_inner.del_flag = 0 ";
		$query_str .= "				group by ";
		$query_str .= "					t_dev_html_rela_inner.dev_id ";
		$query_str .= "			) and ";
		if(isset($this->client_id)){
			$query_str .= "			t_dev_html_rela_outer.client_id = :client_id and ";
		}
		$query_str .= "			t_dev_html_rela_outer.del_flag = 0 ";
		$query_str .= "		group by ";
		$query_str .= "			t_dev_html_rela_outer.sta_dt, ";
		$query_str .= "			t_dev_html_rela_outer.end_dt, ";
		$query_str .= "			t_dev_html_rela_outer.dev_id ";
		$query_str .= "	) tmp_dev_html_rela ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id = tmp_dev_html_rela.dev_html_rela_id ";
		$query_str .= "left join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_dev_html_rela.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";

		$query_str .= "union all ";

		$query_str .= "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	m_html.html_id, ";
		$query_str .= "	m_html.html_name, ";
		$query_str .= "	m_html.file_name, ";
		$query_str .= "	m_html.orig_file_exte ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "left join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_dev_html_rela.dev_id = :dev_id and ";
		$query_str .= "	t_dev_html_rela.sta_dt > :sta_dt and ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";
		$query_str .= ") dev_html_rela ";
		$query_str .= "order by ";
		$query_str .= "	dev_html_rela.sta_dt, ";
		$query_str .= "	dev_html_rela.end_dt ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE;

		$arr_bind_param[":dev_id"] = $dev_id;
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
	 * Terminal HTML related primary key numbering
	 *
	 * @return int		Numbered dev_html_rela_id
	 */
	public function sel_next_dev_html_rela_id()
	{
		$dev_html_rela_id = null;
		try{
			$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $this->client_id);
			$dev_html_rela_id = $t_dev_html_rela->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$dev_html_rela_id = null;
		}
		return $dev_html_rela_id;
	}

	/**
	 * 端末HTML関連登録
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function ins_dev_html_rela($dev_html_rela)
	{
		$ret = true;
		try{
			$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $this->client_id);
			$ret = $t_dev_html_rela->ins($dev_html_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Terminal HTML related delete
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
 * @return bool							true = success, false = failure
	 */
	public function del_dev_html_rela($dev_html_rela)
	{
		$ret = true;
		try{
			$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $this->client_id);
			$t_dev_html_rela->del($dev_html_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
