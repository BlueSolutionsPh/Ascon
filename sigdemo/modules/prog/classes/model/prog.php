<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Prog extends Model
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
	 * Get playlist list
	 *
	 * @return array				Acquisition record
	 */
	function sel_arr_playlist(){
		$ret = true;
		try{
			$t_playlist = new Model_T_Playlist($this->db, $this->client_id);
			$ret = $t_playlist->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
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
	 * Get terminal name
	 *
	 * @param String	$dev_id			Device ID
	 * @return array					Acquisition record
	 */
	public function sel_dev_name($dev_id)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$ret = $m_dev->sel_name($dev_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Retrieve store name
	 *
	 * @param String	$dev_id			Device ID
	 * @return array					Acquisition record
	 */
	public function sel_shop_name($dev_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_shop.shop_name ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		$query_str .= " m_shop.shop_id =  ";
		$query_str .= "(";
		$query_str .= "select ";
		$query_str .= "	m_dev.shop_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= " m_dev.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= " m_dev.del_flag = 0 ";
		$query_str .= ") and ";
		$query_str .= "	m_shop.del_flag = 0 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire number of program listings
	 *
	 * @param array		$dev_id		Device ID
	 * @param String	$sta_dt		Start date and time
	 * @param String	$end_dt		End date and time
	 * @return array				Acquisition record
	 */
	public function sel_cnt_prog_by_arr_dev_id_sta_dt_end_dt($dev_id, $sta_dt, $end_dt)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(t_prog.prog_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_prog.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= "	( ";
		$query_str .= "	t_prog.sta_dt <= :sta_dt and t_prog.end_dt > :sta_dt or ";
		$query_str .= "	t_prog.sta_dt < :end_dt and t_prog.end_dt >= :end_dt or ";
		$query_str .= "	t_prog.sta_dt >= :sta_dt and t_prog.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_prog.del_flag = 0 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire program guide
	 *
	 * @param array		$dev_id		Device ID
	 * @param String	$sta_dt		Start date and time
	 * @param String	$end_dt		End date and time
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog_by_arr_dev_id_sta_dt_end_dt($dev_id, $sta_dt, $end_dt, $limit = true)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	t_prog.prog_id, ";
		$query_str .= "	to_char(t_prog.sta_dt, 'YYYY-MM-DD HH24:MI') as sta_dt, ";
		$query_str .= "	to_char(t_prog.end_dt, 'YYYY-MM-DD HH24:MI') as end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_prog.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= "	( ";
		$query_str .= "	t_prog.sta_dt <= :sta_dt and t_prog.end_dt > :sta_dt or ";
		$query_str .= "	t_prog.sta_dt < :end_dt and t_prog.end_dt >= :end_dt or ";
		$query_str .= "	t_prog.sta_dt >= :sta_dt and t_prog.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_prog.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog.sta_dt, ";
		$query_str .= "	t_prog.end_dt, ";
		$query_str .= "	t_prog.prog_id desc ";
		if($limit){
			$query_str .= "limit " . MAX_CNT_PER_PARENT;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get an active playlist
	 *
	 * @param String	$prog_id	Program guide ID
	 * @return array				Acquisition record
	 */
	function sel_playlist_by_prog_id($prog_id){
		$query_str = "select ";
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
		$query_str .= "	t_prog_playlist_rela.ch ";
		$query_str .= "limit 1";

		$arr_bind_param = array();
		$arr_bind_param[":prog_id"] = $prog_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true, $arr_bind_param);
	}

	/**
	 * Get terminal name · store name list
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev_shop($search = null)
	{
		//Search condition
		if(isset($search->arr_serial_no)){
			$arr_serial_no = $search->arr_serial_no;
		}
		if(isset($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
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
		if(isset($search->arr_shop_name)){
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
		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}

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
			if(isset($this->client_id)){
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
			if(isset($this->client_id)){
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
			if(isset($this->client_id)){
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
			if(isset($this->client_id)){
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

		$query_str .= "	m_dev.invalid_flag = 0 and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		if(isset($ants_version)){
			$query_str .= "	m_dev.ants_version = :ants_version and ";
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
	 * Program guide update
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool				true = success, false = failure
	 */
	public function up_prog($prog)
	{
		$ret = true;
		try{
			//A TV schedule
			$t_prog = new Model_T_Prog($this->db, $this->client_id);
			$t_prog->up($prog);
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
	 * @return bool									true = success, false = failure
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
