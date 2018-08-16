<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Timezone extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
// 		$this->client_id = $client_id;
		$this->client_id = null;  // 20180109 hit_update
	}
	
	/**
	 * 配信時間名から配信時間IDを取得
	 *
	 * @param String	$timezone_name		配信時間名
 	 * @return array					取得レコード
	 */
	public function sel_arr_id_by_name($timezone_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_timezone.timezone_id ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		if(isset($this->timezone_id)){
			$query_str .= "	m_timezone.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $this->timezone_id;
		}
		$query_str .= "	m_timezone.timezone_name = :timezone_name and ";
		$arr_bind_param[":timezone_name"] = $timezone_name;
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * 配信時間IDから配信開始、終了時間を取得
	 *
	 * @param String	$timezone_name		配信時間名
 	 * @return array					取得レコード
	 */
	public function sel_arr_time_by_id($timezone)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	timezone_id, ";
		$query_str .= "	sta_time, ";
		$query_str .= "	end_time ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		$query_str .= "	timezone_id = :timezone_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param[":timezone_id"] = $timezone->timezone_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * 配信時間名から配信時間IDを取得
	 *
	 * @param String	$timezone_name		配信時間名
	 * @param String	$timezone_id		配信時間ID
 	 * @return array					取得レコード
	 */
	public function sel_arr_id_by_name_exclude_id($timezone_name, $timezone_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_timezone.timezone_id ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		if(isset($this->timezone_id)){
			$query_str .= "	m_timezone.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $this->timezone_id;
		}
		$query_str .= "	m_timezone.timezone_id <> :timezone_id and ";
		$query_str .= "	m_timezone.timezone_name = :timezone_name and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param[":timezone_name"] = $timezone_name;
		$arr_bind_param[":timezone_id"] = $timezone_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all distribution time ID and name list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	timezone_id, ";
		$query_str .= "	timezone_name ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		if(isset($this->timezone_id)){
			$query_str .= "	timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $this->timezone_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	timezone_id, ";
		$query_str .= "	timezone_name desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all delivery times
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(timezone_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		if(isset($this->timezone_id)){
			$query_str .= "	timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $this->timezone_id;
		}
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition of delivery time ID (existence confirmation)
	 *
	 * @param String	$timezone_id	Delivery time ID
	 * @return array				Acquisition record
	 */
	public function sel_id($timezone_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_timezone.timezone_id ";
		$query_str .= "from ";
		$query_str .= "	m_timezone ";
		$query_str .= "where ";
		if(isset($this->timezone_id)){
			$query_str .= "	m_timezone.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $this->timezone_id;
		}
		$query_str .= "	m_timezone.timezone_id = :timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		
		$arr_bind_param[":timezone_id"] = $timezone_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Delivery time update
	 *
	 * @param stdClass	$timezone		Delivery time
	 * @return bool					true = success, false = failure
	 */
	public function up($timezone)
	{
		$query_str = "update ";
		$query_str .= "	m_timezone ";
		$query_str .= "set ";
		$query_str .= "	sta_time = :sta_time, ";
		$query_str .= "	end_time = :end_time, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	timezone_id = :timezone_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":sta_time"] = $timezone->sta_time;
		$arr_bind_param[":end_time"] = $timezone->end_time;
		$arr_bind_param[":update_user"] = $timezone->update_user;
		$arr_bind_param[":update_dt"] = $timezone->update_dt;
		$arr_bind_param[":client_id"] = $timezone->client_id;
		$arr_bind_param[":timezone_id"] = $timezone->timezone_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
}