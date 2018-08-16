<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Booth extends Model
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
	 * Get booth ID from booth name
	 *
	 * @param String	$booth_name		Booth name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($booth_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_booth.booth_id ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_booth.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		if(isset($this->booth_id)){
			$query_str .= "	m_booth.booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $this->booth_id;
		}
		$query_str .= "	m_booth.booth_name = :booth_name and ";
		$arr_bind_param[":booth_name"] = $booth_name;
		$query_str .= "	m_booth.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get booth ID from booth name
	 *
	 * @param String	$booth_name		Booth name
	 * @param String	$booth_id		Booth ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($booth_name, $booth_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_booth.booth_id ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_booth.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_booth.booth_id <> :booth_id and ";
		$query_str .= "	m_booth.booth_name = :booth_name and ";
		$query_str .= "	m_booth.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param[":booth_id"] = $booth_id;
		$arr_bind_param[":booth_name"] = $booth_name;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * All booth ID and name list obtained
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	booth_id, ";
		$query_str .= "	booth_name, ";
		$query_str .= "	sex_id, ";
		$query_str .= "	shop_id, ";
		$query_str .= "	floor_id ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		if(isset($this->booth_id)){
			$query_str .= "	booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $this->booth_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	booth_name, ";
		$query_str .= "	booth_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all booths
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(booth_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		if(isset($this->booth_id)){
			$query_str .= "	booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $this->booth_id;
		}
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Booth ID acquisition (existence confirmation)
	 *
	 * @param String	$booth_id	Booth ID
	 * @return array				Acquisition record
	 */
	public function sel_id($booth_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_booth.booth_id ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_booth.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		if(isset($this->booth_id)){
			$query_str .= "	m_booth.booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $this->booth_id;
		}
		$query_str .= "	m_booth.booth_id = :booth_id and ";
		$query_str .= "	m_booth.del_flag = 0 ";
		
		$arr_bind_param[":booth_id"] = $booth_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Booth primary key numbering
	 *
	 * @return int		Numbered booth_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_booth', 'booth_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Booth registration
	 *
	 * @param stdClass	$booth		booth
	 * @return bool					true = success, false = failure
	 */
	public function ins($booth)
	{
		if(isset($booth->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_booth( ";
			$query_str .= "		booth_id, ";
			$query_str .= "		booth_name, ";
			$query_str .= "		client_id, ";
			$query_str .= "		shop_id, ";
			$query_str .= "		floor_id, ";
			$query_str .= "		sex_id, ";
			$query_str .= "		twentyfour_flg, ";
			$query_str .= "	    sta_time, ";
			$query_str .= "	    end_time, ";
			$query_str .= "	    wifissid, ";
			$query_str .= "	    wifipass, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:booth_id, ";
			$query_str .= "		:booth_name, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:shop_id, ";
			$query_str .= "		:floor_id, ";
			$query_str .= "		:sex_id, ";
			$query_str .= "		:twentyfour_flg, ";
			$query_str .= "		:sta_time, ";
			$query_str .= "		:end_time, ";
			$query_str .= "		:wifissid, ";
			$query_str .= "		:wifipass, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":booth_id"]    = $booth->booth_id;
			$arr_bind_param[":booth_name"]  = $booth->booth_name;
			$arr_bind_param[":client_id"]   = $booth->client_id;
			$arr_bind_param[":shop_id"]     = $booth->shop_id;
			$arr_bind_param[":floor_id"]    = $booth->floor_id;
			$arr_bind_param[":sex_id"]      = $booth->sex_id;
			$arr_bind_param[":twentyfour_flg"] = $booth->twentyfour_flg;
			$arr_bind_param[":sta_time"]    = $booth->sta_time;
			$arr_bind_param[":end_time"]    = $booth->end_time;
			$arr_bind_param[":wifissid"]    = $booth->wifissid;
			$arr_bind_param[":wifipass"]    = $booth->wifipass;
			$arr_bind_param[":create_user"] = $booth->create_user;
			$arr_bind_param[":create_dt"]   = $booth->create_dt;
			$arr_bind_param[":update_user"] = $booth->update_user;
			$arr_bind_param[":update_dt"]   = $booth->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Booth update
	 *
	 * @param stdClass	$booth		booth
	 * @return bool					true = success, false = failure
	 */
	public function up($booth)
	{
		if(isset($booth->client_id)){
			$query_str = "update ";
			$query_str .= "	m_booth ";
			$query_str .= "set ";
			$query_str .= "	booth_name = :booth_name, ";
			$query_str .= "	client_id = :client_id, ";
			$query_str .= "	shop_id = :shop_id, ";
			$query_str .= "	floor_id = :floor_id, ";
			$query_str .= "	sex_id = :sex_id, ";
			$query_str .= "	twentyfour_flg = :twentyfour_flg, ";
			$query_str .= "	sta_time = :sta_time, ";
			$query_str .= "	end_time = :end_time, ";
			$query_str .= "	wifissid = :wifissid, ";
			$query_str .= "	wifipass = :wifipass, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	booth_id = :booth_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":booth_name"]  = $booth->booth_name;
			$arr_bind_param[":client_id"]   = $booth->client_id;
			$arr_bind_param[":shop_id"]     = $booth->shop_id;
			$arr_bind_param[":floor_id"]    = $booth->floor_id;
			$arr_bind_param[":sex_id"]      = $booth->sex_id;
			$arr_bind_param[":twentyfour_flg"] = $booth->twentyfour_flg;
			$arr_bind_param[":sta_time"]    = $booth->sta_time;
			$arr_bind_param[":end_time"]    = $booth->end_time;
			$arr_bind_param[":wifissid"]    = $booth->wifissid;
			$arr_bind_param[":wifipass"]    = $booth->wifipass;
			$arr_bind_param[":update_user"] = $booth->update_user;
			$arr_bind_param[":update_dt"]   = $booth->update_dt;
			$arr_bind_param[":booth_id"]    = $booth->booth_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Booth deletion
	 *
	 * @param stdClass	$booth		booth
	 * @return bool					true = success, false = failure
	 */
	public function del($booth)
	{
//		if(isset($booth->client_id)){
			$query_str = "update ";
			$query_str .= "	m_booth ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	booth_id = :booth_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $booth->update_user;
			$arr_bind_param[":update_dt"]   = $booth->update_dt;
//			$arr_bind_param[":client_id"]   = $booth->client_id;
			$arr_bind_param[":booth_id"]    = $booth->booth_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	
	/**
	 * Booth deletion
	 *
	 * @param stdClass	$movie		booth
	 * @return bool					true=成功、false=失敗
	 */
	public function del_by_client_id($booth)
	{
		if(isset($booth->client_id)){
			$query_str = "update ";
			$query_str .= "	m_booth ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $booth->update_user;
			$arr_bind_param[":update_dt"]   = $booth->update_dt;
			$arr_bind_param[":client_id"]   = $booth->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
}
