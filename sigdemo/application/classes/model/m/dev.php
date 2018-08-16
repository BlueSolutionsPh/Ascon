<?php if (!defined('SYSPATH')) exit('No direct script access');

class Model_M_Dev extends Model
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
	 * Get terminal ID from terminal name
	 *
	 * @param String	$dev_name		Device name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($dev_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_dev.dev_name = :dev_name and ";
		$arr_bind_param[":dev_name"] = $dev_name;
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get terminal ID from terminal name
	 *
	 * @param String	$dev_name		Device name
	 * @param String	$dev_id			Device ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($dev_name, $dev_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_dev.dev_id <> :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= "	m_dev.dev_name = :dev_name and ";
		$arr_bind_param[":dev_name"] = $dev_name;
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get terminal ID from serial number (ignore client ID)
	 *
	 * @param String	$serial_no		Serial number
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_serial_no($serial_no)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.serial_no = :serial_no and ";
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":serial_no"] = $serial_no;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get terminal ID from serial number (ignore client ID)
	 *
	 * @param String	$serial_no		Serial number
	 * @param String	$dev_id			Device ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_serial_no_exclude_id($serial_no, $dev_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.dev_id <> :dev_id and ";
		$query_str .= "	m_dev.serial_no = :serial_no and ";
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":serial_no"] = $serial_no;
		$arr_bind_param[":dev_id"] = $dev_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Terminal ID acquisition (existence confirmation)
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_id($dev_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_dev.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= "	m_dev.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get terminal name
	 *
	 * @param String	$dev_id			Get terminal name
	 * @return array					Acquisition record
	 */
	public function sel_name($dev_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_dev.dev_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_dev.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= "	m_dev.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all terminal ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	dev_id, ";
		$query_str .= "	dev_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	dev_name, ";
		$query_str .= "	dev_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Retrieve the in-store terminal list
	 *
	 * @param String	$shop_id	Store ID
	 * @return array				Acquisition record
	 */
	function sel_arr_by_shop_id($shop_id){
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.dev_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.shop_id = :shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.dev_id desc ";
		
		$arr_bind_param = array();
		$arr_bind_param[":shop_id"] = $shop_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all terminals
	 *
	 * @return array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(dev_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Device main key number assignment
	 *
	 * @return int		The assigned dev_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_dev', 'dev_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Device registration
	 *
	 * @param stdClass	$dev		Terminal
	 * @return bool					true = success, false = failure
	 */
	public function ins($dev)
	{
		if(isset($dev->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_dev( ";
			$query_str .= "		dev_id, ";
			$query_str .= "		shop_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		booth_id, ";
			$query_str .= "		floor_id, ";
			$query_str .= "		sex_id, ";
			$query_str .= "		dev_cat, ";
			$query_str .= "		dev_name, ";
			$query_str .= "		serial_no, ";
			$query_str .= "		note, ";
			$query_str .= "		ants_version, ";
			$query_str .= "		invalid_flag, ";
			$query_str .= "		unit_flag, ";
			$query_str .= "		mail_flag, ";
			$query_str .= "		service_id, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:dev_id, ";
			$query_str .= "		:shop_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:booth_id, ";
			$query_str .= "		:floor_id, ";
			$query_str .= "		:sex_id, ";
			$query_str .= "		:dev_cat, ";
			$query_str .= "		:dev_name, ";
			$query_str .= "		:serial_no, ";
			$query_str .= "		:note, ";
			$query_str .= "		:ants_version, ";
			$query_str .= "		:invalid_flag, ";
			$query_str .= "		:unit_flag, ";
			$query_str .= "		:mail_flag, ";
			$query_str .= "		:service_id, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":dev_id"]       = $dev->dev_id;
			$arr_bind_param[":shop_id"]      = $dev->shop_id;
			$arr_bind_param[":client_id"]    = $dev->client_id;
			$arr_bind_param[":booth_id"]     = $dev->booth_id;
			$arr_bind_param[":floor_id"]     = $dev->floor_id;
			$arr_bind_param[":sex_id"]       = $dev->sex_id;
			$arr_bind_param[":dev_cat"]      = $dev->dev_cat;
			$arr_bind_param[":dev_name"]     = $dev->dev_name;
			$arr_bind_param[":serial_no"]    = $dev->serial_no;
			$arr_bind_param[":note"]         = $dev->note;
			$arr_bind_param[":ants_version"] = $dev->ants_version;
			$arr_bind_param[":invalid_flag"] = $dev->invalid_flag;
			$arr_bind_param[":unit_flag"]    = $dev->unit_flag;
			$arr_bind_param[":mail_flag"]    = $dev->mail_flag;
			$arr_bind_param[":service_id"]   = $dev->service_id;
			$arr_bind_param[":create_user"]  = $dev->create_user;
			$arr_bind_param[":create_dt"]    = $dev->create_dt;
			$arr_bind_param[":update_user"]  = $dev->update_user;
			$arr_bind_param[":update_dt"]    = $dev->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Device update
	 *
	 * @param stdClass	$dev		Terminal
	 * @return bool					true = success, false = failure
	 */
	public function up($dev)
	{
		if(isset($dev->client_id)){
			$query_str = "update ";
			$query_str .= "	m_dev ";
			$query_str .= "set ";
			$query_str .= "	shop_id = :shop_id, ";
			$query_str .= "	client_id = :client_id, ";
			$query_str .= "	booth_id = :booth_id, ";
			$query_str .= "	floor_id = :floor_id, ";
			$query_str .= "	sex_id = :sex_id, ";
			$query_str .= "	serial_no = :serial_no, ";
			$query_str .= "	invalid_flag = :invalid_flag, ";
			$query_str .= "	unit_flag = :unit_flag, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_id = :dev_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":shop_id"]      = $dev->shop_id;
			$arr_bind_param[":client_id"]    = $dev->client_id;
			$arr_bind_param[":booth_id"]     = $dev->booth_id;
			$arr_bind_param[":floor_id"]     = $dev->floor_id;
			$arr_bind_param[":sex_id"]       = $dev->sex_id;
			$arr_bind_param[":serial_no"]    = $dev->serial_no;
			$arr_bind_param[":invalid_flag"] = $dev->invalid_flag;
			$arr_bind_param[":unit_flag"]    = $dev->unit_flag;
			$arr_bind_param[":update_user"]  = $dev->update_user;
			$arr_bind_param[":update_dt"]    = $dev->update_dt;
			$arr_bind_param[":dev_id"]       = $dev->dev_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * DL log reset
	 *
	 * @param stdClass	$dev		Terminal
	 * @return bool					true = success, false = failure
	 */
	public function dlLog_up($dev)
	{
//		if(isset($dev->client_id)){
			$query_str = "update ";
			$query_str .= "	m_dev ";
			$query_str .= "set ";
			$query_str .= "	download_status = :download_status, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_id = :dev_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
				
			$arr_bind_param = array();
			$arr_bind_param[":download_status"] = 0;
			$arr_bind_param[":update_user"] = $dev->update_user;
			$arr_bind_param[":update_dt"]   = $dev->update_dt;
			$arr_bind_param[":dev_id"]      = $dev->dev_id;
//			$arr_bind_param[":client_id"]   = $dev->client_id;
				
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
				
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Delete terminal
	 *
	 * @param stdClass	$dev		Terminal
	 * @return bool					true = success, false = failure
	 */
	public function del($dev)
	{
		if(isset($dev)){
			//Terminal master
			$query_str = "update ";
			$query_str .= "	m_dev ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_id = :dev_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $dev->update_user;
			$arr_bind_param[":update_dt"] = $dev->update_dt;
			$arr_bind_param[":dev_id"] = $dev->dev_id;
//			$arr_bind_param[":client_id"] = $dev->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}
