<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Progrgl extends Model
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
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$ret = $m_dev->sel_id($dev_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * 端末名・店舗名一覧取得
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev_shop($ants_version)
	{
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
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_dev.invalid_flag = 0 and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " m_dev.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.dev_id desc ";

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
	function sel_arr_prog_rgl_grp_by_dev_id($dev_id){
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$arr_bind_param[":dev_id"] = $dev_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire program list (repeated designation) list
	 *
	 * @param String	$prog_rgl_grp_id	Program guide (repeated designation) group ID
	 * @return array						Acquisition record
	 */
	function sel_arr_prog_rgl($prog_rgl_grp_id){
		$query_str = "select ";
		$query_str .= "	t_prog_rgl.prog_id, ";
		$query_str .= "	to_char(t_prog_rgl.sta_time, 'HH24:MI') as sta_time, ";
		$query_str .= "	to_char(t_prog_rgl.end_time, 'HH24:MI') as end_time, ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_prog_rgl.mon, ";
		$query_str .= "	t_prog_rgl.tues, ";
		$query_str .= "	t_prog_rgl.wednes, ";
		$query_str .= "	t_prog_rgl.thurs, ";
		$query_str .= "	t_prog_rgl.fri, ";
		$query_str .= "	t_prog_rgl.satur, ";
		$query_str .= "	t_prog_rgl.sun, ";
		$query_str .= "	t_prog_rgl.priority, ";
		$query_str .= "	t_prog_rgl.col_id, ";
		$query_str .= "	t_prog_rgl.row_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "left join ";
		$query_str .= "	t_prog_playlist_rela ";
		$query_str .= "on ";
		$query_str .= "	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= " t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "left join ";
		$query_str .= "	t_playlist ";
		$query_str .= "on ";
		$query_str .= "	t_prog_playlist_rela.playlist_id = t_playlist.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
		}
		$query_str .= " t_playlist.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl.prog_rgl_grp_id = :prog_rgl_grp_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= " t_prog_rgl.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_rgl.sta_time ";

		$arr_bind_param = array();
		$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl_grp_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire program list (repeated designation) list
	 *
	 * @param String	$prog_rgl_grp_id	Program guide (repeated designation) group ID
	 * @return array						Acquisition record
	 */
	function sel_arr_prog_rgl_by_prog_rgl_grp_id($prog_rgl_grp_id){
		$query_str = "select ";
		$query_str .= "	t_prog_rgl.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl.prog_rgl_grp_id = :prog_rgl_grp_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= " t_prog_rgl.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl_grp_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Program guide (repeated designation) group acquisition
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	function sel_prog_rgl_grp($dev_id){
		$query_str = "select ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id, ";
		$query_str .= "	t_prog_rgl_grp.prog_name, ";
		$query_str .= "	m_dev.dev_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "on ";
		$query_str .= "	m_dev.dev_id = t_prog_rgl_grp.dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_dev.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id desc ";
		$query_str .= "limit 1 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
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
	 * 番組表(繰り返し指定)グループ登録
	 *
	 * @param stdClass	$prog_rgl_grp	Program guide (repeated designation) group
	 * @return bool					true = success, false = failure
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

	/**
	 * 番組表登録
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool				true = success, false = failure
	 */
	public function ins_prog($prog)
	{
		$ret = true;
		try{
			$t_prog = new Model_T_Prog_Rgl($this->db, $this->client_id);
			$ret = $t_prog->ins($prog);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
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
			$arr_prog_rgl = $this->sel_arr_prog_rgl_by_prog_rgl_grp_id($prog_rgl_grp->prog_rgl_grp_id);

			foreach($arr_prog_rgl as $tmp_prog_rgl){
				//Program guide (repeated designation)
				$t_prog_rgl = new Model_T_Prog_Rgl($this->db, $this->client_id);
				$prog_rgl = new stdClass();
				$prog_rgl->prog_id = $tmp_prog_rgl->prog_id;
				$prog_rgl->update_user = $prog_rgl_grp->update_user;
				$prog_rgl->update_dt = $prog_rgl_grp->update_dt;
				$t_prog_rgl->del($prog_rgl);

				//Program list Play list related
				$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
				$prog_playlist_rela = new stdClass();
				$prog_playlist_rela->prog_id = $tmp_prog_rgl->prog_id;
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
	 * Program list Playlist related registration
	 *
	 * @param stdClass	$prog_playlist_rela		Program list Play list related
	 * @return bool							true = success, false = failure
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
