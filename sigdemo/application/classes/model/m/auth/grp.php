<?php if (!defined('SYSPATH')) exit('No direct script access');

class Model_M_Auth_Grp extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
//		$this->client_id = $client_id;
		$this->client_id = null; // 20180109 hit_update
	}
	
	/**
	 * Obtain authority group ID from authority group name
	 *
	 * @param String	$auth_grp_name	Authority group name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($auth_grp_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_auth_grp.auth_grp_id ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";
//		if(isset($this->client_id)){
//			$query_str .= "	m_auth_grp.client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $this->client_id;
//		}
		$query_str .= "	m_auth_grp.auth_grp_name = :auth_grp_name and ";
		$arr_bind_param[":auth_grp_name"] = $auth_grp_name;
		$query_str .= "	m_auth_grp.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Obtain authority group ID from authority group nam
e	 *
	 * @param String	$auth_grp_name	Authority group authority group name name
	 * @param String	$auth_grp_id	Authority group ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($auth_grp_name, $auth_grp_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_auth_grp.auth_grp_id ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";
//		if(isset($this->client_id)){
//			$query_str .= "	m_auth_grp.client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $this->client_id;
//		}
		$query_str .= "	m_auth_grp.auth_grp_id <> :auth_grp_id and ";
		$query_str .= "	m_auth_grp.auth_grp_name = :auth_grp_name and ";
		$query_str .= "	m_auth_grp.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param[":auth_grp_name"] = $auth_grp_name;
		$arr_bind_param[":auth_grp_id"] = $auth_grp_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire authority group ID (existence confirmation)
	 *
	 * @param String	$auth_grp_id	Authority group ID
	 * @return array					Acquisition record
	 */
	public function sel_id($auth_grp_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_auth_grp.auth_grp_id ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";
		$arr_bind_param[":auth_grp_id"] = $auth_grp_id;
//		if(isset($this->client_id)){
//			$query_str .= "	m_auth_grp.client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $this->client_id;
//		}
		$query_str .= "	m_auth_grp.auth_grp_id = :auth_grp_id and ";
		$query_str .= "	m_auth_grp.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire authority group ID and name list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	auth_grp_id, ";
		$query_str .= "	auth_grp_name ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";
//		if(isset($this->client_id)){
//			$query_str .= "	client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $this->client_id;
//		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	auth_grp_name, ";
		$query_str .= "	auth_grp_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all items of authority group
	 *
	 * @param String	$auth_grp_id	Authority group ID
	 * @return array					Acquisition record
	 */
	public function sel($auth_grp_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	auth_grp_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	auth_grp_name, ";
		$query_str .= "	del_flag, ";
		$query_str .= "	create_user, ";
		$query_str .= "	create_dt, ";
		$query_str .= "	update_user, ";
		$query_str .= "	update_dt ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";
		$query_str .= "	auth_grp_id = :auth_grp_id and ";
//		if(isset($this->client_id)){
//			$query_str .= "	client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $this->client_id;
//		}
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param[":auth_grp_id"] = $auth_grp_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Authority group primary key number
	 *
	 * @return int		Number assigned auth_grp_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_auth_grp', 'auth_grp_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Create authority group
	 *
	 * @param stdClass	$auth_grp	Authority group
	 * @return bool					true = success, false = failure
	 */
	public function ins($auth_grp)
	{
//		if(isset($auth_grp->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_auth_grp( ";
			$query_str .= "		auth_grp_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		auth_grp_name, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:auth_grp_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:auth_grp_name, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":auth_grp_id"]   = $auth_grp->auth_grp_id;
			$arr_bind_param[":client_id"]     = $auth_grp->client_id;
			$arr_bind_param[":auth_grp_name"] = $auth_grp->auth_grp_name;
			$arr_bind_param[":create_user"]   = $auth_grp->create_user;
			$arr_bind_param[":create_dt"]     = $auth_grp->create_dt;
			$arr_bind_param[":update_user"]   = $auth_grp->update_user;
			$arr_bind_param[":update_dt"]     = $auth_grp->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Authorization group update
	 *
	 * @param stdClass	$auth_grp	Authority group
	 * @return bool					true = success, false = failure
	 */
	public function up($auth_grp)
	{
//		if(isset($auth_grp->client_id)){
			$query_str = "update ";
			$query_str .= "	m_auth_grp ";
			$query_str .= "set ";
			$query_str .= "	auth_grp_name = :auth_grp_name, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	auth_grp_id = :auth_grp_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag =0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":auth_grp_name"] = $auth_grp->auth_grp_name;
			$arr_bind_param[":update_user"]   = $auth_grp->update_user;
			$arr_bind_param[":update_dt"]     = $auth_grp->update_dt;
			$arr_bind_param[":auth_grp_id"]   = $auth_grp->auth_grp_id;
//			$arr_bind_param[":client_id"]     = $auth_grp->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Delete authority group
	 *
	 * @param stdClass	$auth_grp	Authority group
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($auth_grp)
	{
		if(isset($auth_grp->client_id)){
			$query_str = "update ";
			$query_str .= "	m_auth_grp ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $auth_grp->update_user;
			$arr_bind_param[":update_dt"]   = $auth_grp->update_dt;
			$arr_bind_param[":client_id"]   = $auth_grp->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete authority group
	 *
	 * @param stdClass	$auth_grp	Authority group
	 * @return bool					true = success, false = failure
	 */
	public function del($auth_grp)
	{
//		if(isset($auth_grp->client_id)){
			$query_str = "update ";
			$query_str .= "	m_auth_grp ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	auth_grp_id = :auth_grp_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $auth_grp->update_user;
			$arr_bind_param[":update_dt"]   = $auth_grp->update_dt;
			$arr_bind_param[":auth_grp_id"] = $auth_grp->auth_grp_id;
//			$arr_bind_param[":client_id"]   = $auth_grp->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}