<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Timezone extends Model
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
	 * Acquire all delivery times
	 *
	 * @param stdClass	$search		Search condition
	 * @return	array				Acquisition record
	 */
	public function sel_cnt_timezone($search)
	{
		//Search condition
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(timezone.timezone_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_timezone.timezone_id ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= ") timezone ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition of distribution time list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_timezone($search)
	{
		$offset = $search->offset;
		
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name, ";
		$query_str .= "	m_timezone.sta_time, ";
		$query_str .= "	m_timezone.end_time ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name desc ";
		$query_str .= "limit :limit ";
		$arr_bind_param[":limit"] = MAX_CNT_PER_PAGE;
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get delivery time
	 *
	 * @param String	$timezone_id		Delivery time ID
	 * @return array					Acquisition records
	 */
	public function sel_timezone($timezone_id)
	{
		$query_str = "select ";
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name, ";
		$query_str .= "	m_timezone.sta_time, ";
		$query_str .= "	m_timezone.end_time ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		$query_str .= "	m_timezone.timezone_id = :timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":timezone_id"] = $timezone_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get delivery time name
	 *
	 * @param String	$timezone_id		Delivery time ID
	 * @return array					Acquisition record
	 */
	public function sel_timezone_name($timezone_id)
	{
		$query_str = "select ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		$query_str .= "	m_timezone.timezone_id = :timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":timezone_id"] = $timezone_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	
	/**
	 * Delivery time Main key number assignment
	 *
	 * @return int		Timezone_id numbered
	 */
	public function sel_next_timezone_id()
	{
		$timezone_id = null;
		try{
			$m_timezone = new Model_M_timezone($this->db, $this->client_id);
			$timezone_id = $m_timezone->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$timezone_id = null;
		}
		return $timezone_id;
	}
	
	/**
	 * Delivery time update
	 *
	 * @param stdClass	$timezone		Delivery time
	 * @return bool					true = success, false = failure
	 */
	public function up_timezone($timezone)
	{
		$ret = true;
		try{
			$m_timezone = new Model_M_Timezone($this->db, $this->client_id);
			$m_timezone->up($timezone);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delivery time update
	 *
	 * @param stdClass	$timezone		Delivery time
	 * @return bool					true = success, false = failure
	 */
	public function up_t_prog_rgl_time($timezone)
	{
		$ret = true;
		try{
			$t_prog_rgl = new Model_T_Prog_Rgl($this->db, $this->client_id);
			$t_prog_rgl->up_time($timezone);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
}