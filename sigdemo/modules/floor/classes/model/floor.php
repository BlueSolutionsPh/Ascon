<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Floor extends Model
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
	 * Acquire all installed floors
	 *
	 * @param stdClass	$search		Search condition
	 * @return	array				Acquisition record
	 */
	public function sel_cnt_floor($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_floor_name)){
			$arr_floor_name = $search->arr_floor_name;
		}
		if(isset($search->floor_tag_1) && $search->floor_tag_1 !== ""){
			$floor_tag_1 = $search->floor_tag_1;
		}
		if(isset($search->floor_tag_2) && $search->floor_tag_2 !== ""){
			$floor_tag_2 = $search->floor_tag_2;
		}
		$floor_tag_and_or = "and";
		if(isset($search->floor_tag_and_or) && $search->floor_tag_and_or !== ""){
			$floor_tag_and_or = $search->floor_tag_and_or;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(floor.floor_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_floor.floor_id ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_floor.client_id = m_client.client_id and ";
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

		//Search condition (installation floor tag) addition
		if(isset($floor_tag_1) && isset($floor_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($floor_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_floor_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_floor_tag_rela.floor_id = m_floor.floor_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_floor_tag_rela.floor_tag_id = :floor_tag_id_1 ";
			$arr_bind_param[":floor_tag_id_1"] = $floor_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_floor_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_floor_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($floor_tag_1) && isset($floor_tag_2)){
			if($floor_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($floor_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_floor_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_floor_tag_rela.floor_id = m_floor.floor_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_floor_tag_rela.floor_tag_id = :floor_tag_id_2 ";
			$arr_bind_param[":floor_tag_id_2"] = $floor_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_floor_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_floor_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($floor_tag_1) && isset($floor_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($floor_tag_1) || isset($floor_tag_2)){
			$query_str .= " and ";
		}

		//Search condition (installation floor name) added
		if(!empty($arr_floor_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_floor_name as $floor_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_floor.floor_name ilike :floor_name_" . $i . " ";
				$arr_bind_param[":floor_name_" . $i] = "%" . $floor_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_floor.client_id = :client_id and";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_floor.del_flag = 0 ";
		$query_str .= ") floor ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquisition of installation floor list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_floor($search)
	{
		//Search condition
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_floor.floor_id, ";
		$query_str .= "	m_floor.floor_name ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "where ";
		$query_str .= "	m_floor.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_floor.floor_name, ";
		$query_str .= "	m_floor.floor_id desc ";
		$query_str .= "limit :limit ";
		$arr_bind_param[":limit"] = MAX_CNT_PER_PAGE;
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Obtain installation list tag list
	 * @param	String	$floor_id	Installation floor ID
	 * @return	array				Acquisition record
	 */
	public function sel_arr_floor_tag_by_floor_id($floor_id)
	{
		$query_str = "select ";
		$query_str .= "	floor_tag_id, ";
		$query_str .= "	floor_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_floor_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_floor_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_floor ";
		$query_str .= "		on ";
		$query_str .= "			t_floor_tag_rela.floor_id = m_floor.floor_id and ";
		$query_str .= "			m_floor.floor_id = :floor_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_floor.client_id = :client_id and ";
		}
		$query_str .= "			m_floor.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_floor_tag.floor_tag_id = t_floor_tag_rela.floor_tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_floor_tag.client_id = :client_id and ";
		}
		$query_str .= "			t_floor_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	floor_tag_name, ";
		$query_str .= "	floor_tag_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":floor_id"] = $floor_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire installation floor
	 *
	 * @param String	$floor_id		Installation floor ID
	 * @return array					Acquisition record
	 */
	public function sel_floor($floor_id)
	{
		$query_str = "select ";
		$query_str .= "	m_floor.floor_id, ";
		$query_str .= "	m_floor.floor_name, ";
		$query_str .= "	m_floor.sta_time, ";
		$query_str .= "	m_floor.end_time, ";
		$query_str .= "	m_floor.note, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_floor.client_id = m_client.client_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_client.client_id = :client_id and ";
		}
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_floor.floor_id = :floor_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_floor.client_id = :client_id and ";
		}
		$query_str .= "	m_floor.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":floor_id"] = $floor_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire installation floor name
	 *
	 * @param String	$floor_id		Installation floor ID
	 * @return array					Acquisition record
	 */
	public function sel_floor_name($floor_id)
	{
		$query_str = "select ";
		$query_str .= "	m_floor.floor_name ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "where ";
		$query_str .= "	m_floor.floor_id = :floor_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_floor.client_id = :client_id and ";
		}
		$query_str .= "	m_floor.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":floor_id"] = $floor_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire the terminal ID being used by the installation floor
	 *
	 * @param String	$floor_id	Installation floor ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev_id($floor_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.floor_id = :floor_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":floor_id"] = $floor_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire the program guide ID being used by the terminal
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog_id($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	t_prog.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "where ";
		$query_str .= "	t_prog.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
		}
		$query_str .= "	t_prog.del_flag = 0 ";

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
	 * Installation floor Main key number assignment
	 *
	 * @return int		Number assigned floor_id
	 */
	public function sel_next_floor_id()
	{
		$floor_id = null;
		try{
			$m_floor = new Model_M_Shop($this->db, $this->client_id);
			$floor_id = $m_floor->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$floor_id = null;
		}
		return $floor_id;
	}

	/**
	 * Registration on the floor
	 *
	 * @param stdClass	$floor		Installation floor
	 * @return bool					true = success, false = failure
	 */
	public function ins_floor($floor)
	{
		$ret = true;
		try{
			$m_floor = new Model_M_Shop($this->db, $this->client_id);
			$ret = $m_floor->ins($floor);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Installation floor renewal
	 *
	 * @param stdClass	$floor		Installation floor
	 * @return bool					true = success, false = failure
	 */
	public function up_floor($floor)
	{
		$ret = true;
		try{
			$m_floor = new Model_M_Shop($this->db, $this->client_id);
			$m_floor->up($floor);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Installation floor removed
	 *
	 * @param stdClass	$floor		Installation floor
	 * @return bool					true = success, false = failure
	 */
	public function del_floor($floor)
	{
		$ret = true;
		try{
			//Delete terminal on installation floor
			$arr_dev = $this->sel_arr_dev_id($floor->floor_id);
			foreach($arr_dev as $dev){
				$dev_id = $dev->dev_id;

				//Terminal HTML related download log
				$t_dev_html_rela_dl_log = new Model_T_Dev_Html_Rela_Dl_Log($this->db);
				$dev_html_rela_dl_log = new stdClass();
				$dev_html_rela_dl_log->dev_id = $dev_id;
				$dev_html_rela_dl_log->update_user = $floor->update_user;
				$dev_html_rela_dl_log->update_dt = $floor->update_dt;
				$t_dev_html_rela_dl_log->del_by_dev_id($dev_html_rela_dl_log);

				//Terminal HTML related
				$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $this->client_id);
				$dev_html_rela = new stdClass();
				$dev_html_rela->dev_id = $dev_id;
				$dev_html_rela->update_user = $floor->update_user;
				$dev_html_rela->update_dt = $floor->update_dt;
				$t_dev_html_rela->del_by_dev_id($dev_html_rela);

				//Program guide download log
				$t_dev_prog_dl_log = new Model_T_Dev_Prog_Dl_Log($this->db);
				$dev_prog_dl_log = new stdClass();
				$dev_prog_dl_log->dev_id = $dev_id;
				$dev_prog_dl_log->update_user = $floor->update_user;
				$dev_prog_dl_log->update_dt = $floor->update_dt;
				$t_dev_prog_dl_log->del_by_dev_id($dev_prog_dl_log);

				//Device status log
				$t_dev_status_log = new Model_T_Dev_Status_Log($this->db);
				$dev_status_log = new stdClass();
				$dev_status_log->dev_id = $dev_id;
				$dev_status_log->update_user = $floor->update_user;
				$dev_status_log->update_dt = $floor->update_dt;
				$t_dev_status_log->del_by_dev_id($dev_status_log);

				//Acquire program list while using terminal
				$arr_prog = $this->sel_arr_prog_id($dev_id);
				foreach($arr_prog as $prog){
					$prog_id = $prog->prog_id;

					//Program list Play list related
					$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
					$prog_playlist_rela = new stdClass();
					$prog_playlist_rela->prog_id = $prog_id;
					$prog_playlist_rela->update_user = $floor->update_user;
					$prog_playlist_rela->update_dt = $floor->update_dt;
					$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

					//A TV schedule
					$t_prog = new Model_T_Prog($this->db, $this->client_id);
					$prog = new stdClass();
					$prog->prog_id = $prog_id;
					$prog->update_user = $floor->update_user;
					$prog->update_dt = $floor->update_dt;
					$t_prog->del($prog);
				}

				//Terminal tag related
				$t_dev_tag_rela = new Model_T_Dev_Tag_Rela($this->db, $this->client_id);
				$dev_tag_rela = new stdClass();
				$dev_tag_rela->dev_id = $dev_id;
				$dev_tag_rela->update_user = $floor->update_user;
				$dev_tag_rela->update_dt = $floor->update_dt;
				$t_dev_tag_rela->del_by_dev_id($dev_tag_rela);

				//Terminal master
				$m_dev = new Model_M_Dev($this->db, $this->client_id);
				$dev = new stdClass();
				$dev->dev_id = $dev_id;
				$dev->update_user = $floor->update_user;
				$dev->update_dt = $floor->update_dt;
				$m_dev->del($dev);
			}

			//Installation floor tag related
			$t_floor_tag_rela = new Model_T_Shop_Tag_Rela($this->db, $this->client_id);
			$floor_tag_rela = new stdClass();
			$floor_tag_rela->floor_id = $floor->floor_id;
			$floor_tag_rela->update_user = $floor->update_user;
			$floor_tag_rela->update_dt = $floor->update_dt;
			$t_floor_tag_rela->del_by_floor_id($floor_tag_rela);

			//Installation floor master
			$m_floor = new Model_M_Shop($this->db, $this->client_id);
			$m_floor->del($floor);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Installation floor tag related registration
	 *
	 * @param stdClass	$floor_tag_rela	Installation floor tag related
	 * @return bool						true = success, false = failure
	 */
	public function ins_floor_tag_rela($floor_tag_rela)
	{
		$ret = true;
		try{
			$t_floor_tag_rela = new Model_T_Shop_Tag_Rela($this->db, $this->client_id);
			$ret = $t_floor_tag_rela->ins($floor_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Installation floor Tag related Delete
	 *
	 * @param stdClass	$floor_tag_rela	設置階タグ関連
	 * @return bool						true = success, false = failure
	 */
	public function del_floor_tag_rela($floor_tag_rela)
	{
		$ret = true;
		try{
			$t_floor_tag_rela = new Model_T_Shop_Tag_Rela($this->db, $this->client_id);
			$ret = $t_floor_tag_rela->del_by_floor_id_floor_tag_id($floor_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
