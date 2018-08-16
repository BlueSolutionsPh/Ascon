<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_User extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
// 		$this->client_id = $client_id;
		$this->client_id = null; // 20180109 hit_update
	}
	
	/**
	 * Get user ID from user name
	 *
	 * @param String	$user_name		User name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($user_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_user.user_id ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_user.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_user.user_name = :user_name and ";
		$arr_bind_param[":user_name"] = $user_name;
		$query_str .= "	m_user.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition record
	 *
	 * @param String	$user_name		User name
	 * @param String	$user_id		User ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($user_name, $user_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_user.user_id ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_user.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_user.user_id <> :user_id and ";
		$query_str .= "	m_user.user_name = :user_name and ";
		$query_str .= "	m_user.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param[":user_name"] = $user_name;
		$arr_bind_param[":user_id"] = $user_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Retrieve user ID from login account
	 *
	 * @param String	$login_acnt		Login account
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_login_acnt($login_acnt)
	{
		$query_str = "select ";
		$query_str .= "	m_user.user_id ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		$query_str .= "	m_user.login_acnt = :login_acnt and ";
		$query_str .= "	m_user.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":login_acnt"] = $login_acnt;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Retrieve user ID from login account from user login account Get ID
	 *
	 * @param String	$login_acnt		Login account
	 * @param String	$user_id		User ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_login_acnt_exclude_id($login_acnt, $user_id)
	{
		$query_str = "select ";
		$query_str .= "	m_user.user_id ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		$query_str .= "	m_user.user_id <> :user_id and ";
		$query_str .= "	m_user.login_acnt = :login_acnt and ";
		$query_str .= "	m_user.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":login_acnt"] = $login_acnt;
		$arr_bind_param[":user_id"] = $user_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire user ID (existence confirmation)
	 *
	 * @param String	$user_id	User ID
	 * @return array				Acquisition record
	 */
	public function sel_id($user_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_user.user_id ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		$arr_bind_param[":user_id"] = $user_id;
		if(isset($this->client_id)){
			$query_str .= "	m_user.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_user.user_id = :user_id and ";
		$query_str .= "	m_user.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get user name
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_name($user_id)
	{
		$arr_bind_param = array();
		$arr_bind_param[":user_id"] = $user_id;
		
		$query_str = "select ";
		$query_str .= "	m_user.user_name ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		$query_str .= "	user_id = :user_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all users
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(user_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
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
	 * User primary key number assignment
	 *
	 * @return int		Number assigned user_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_user', 'user_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * user registration
	 *
	 * @param stdClass	$user		A user
	 * @return bool					true=成功、false=失敗
	 */
	public function ins($user)
	{
		if(isset($user->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_user( ";
			$query_str .= "		user_id, ";
			$query_str .= "		client_id, ";
//			$query_str .= "		shop_id, ";
			$query_str .= "		auth_grp_id, ";
			$query_str .= "		login_acnt, ";
			$query_str .= "		passwd, ";
			$query_str .= "		user_name, ";
//			$query_str .= "		note, ";
			$query_str .= "		admin_flag, ";
			$query_str .= "		invalid_flag, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:user_id, ";
			$query_str .= "		:client_id, ";
//			$query_str .= "		:shop_id, ";
			$query_str .= "		:auth_grp_id, ";
			$query_str .= "		:login_acnt, ";
			$query_str .= "		md5(:passwd), ";
			$query_str .= "		:user_name, ";
//			$query_str .= "		:note, ";
			$query_str .= "		:admin_flag, ";
			$query_str .= "		:invalid_flag, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":user_id"]      = $user->user_id;
			$arr_bind_param[":client_id"]    = $user->client_id;
//			$arr_bind_param[":shop_id"]      = $user->shop_id;
			$arr_bind_param[":auth_grp_id"]  = $user->auth_grp_id;
			$arr_bind_param[":login_acnt"]   = $user->login_acnt;
			$arr_bind_param[":passwd"]       = $user->passwd;
			$arr_bind_param[":user_name"]    = $user->user_name;
//			$arr_bind_param[":note"]         = $user->note;
			$arr_bind_param[":admin_flag"]   = $user->admin_flag;
			$arr_bind_param[":invalid_flag"] = $user->invalid_flag;
			$arr_bind_param[":create_user"]  = $user->create_user;
			$arr_bind_param[":create_dt"]    = $user->create_dt;
			$arr_bind_param[":update_user"]  = $user->update_user;
			$arr_bind_param[":update_dt"]    = $user->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * User update
	 *
	 * @param stdClass	$user		A user
	 * @return bool					true = success, false = failure
	 */
	public function up($user)
	{
		if(isset($user->client_id)){
			$query_str = "update ";
			$query_str .= "	m_user ";
			$query_str .= "set ";
//			$query_str .= "	shop_id = :shop_id, ";
			$query_str .= "	client_id = :client_id, ";
			$query_str .= "	auth_grp_id = :auth_grp_id, ";
			$query_str .= "	login_acnt = :login_acnt, ";
			$query_str .= "	passwd = md5(:passwd), ";
			$query_str .= "	user_name = :user_name, ";
//			$query_str .= "	note = :note, ";
//			$query_str .= "	admin_flag = :admin_flag, ";
			$query_str .= "	invalid_flag = :invalid_flag, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	user_id = :user_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
//			$arr_bind_param[":shop_id"]      = $user->shop_id;
			$arr_bind_param[":client_id"]    = $user->client_id;
			$arr_bind_param[":auth_grp_id"]  = $user->auth_grp_id;
			$arr_bind_param[":login_acnt"]   = $user->login_acnt;
			$arr_bind_param[":passwd"]       = $user->passwd;
			$arr_bind_param[":user_name"]    = $user->user_name;
//			$arr_bind_param[":note"]         = $user->note;
//			$arr_bind_param[":admin_flag"]   = $user->admin_flag;
			$arr_bind_param[":invalid_flag"] = $user->invalid_flag;
			$arr_bind_param[":update_user"]  = $user->update_user;
			$arr_bind_param[":update_dt"]    = $user->update_dt;
			$arr_bind_param[":user_id"]      = $user->user_id;
//			$arr_bind_param[":client_id"]    = $user->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete user
	 *
	 * @param stdClass	$user	A user
	 * @return bool				true = success, false = failure
	 */
	public function del($user)
	{
		if(isset($user)){
			$query_str = "update ";
			$query_str .= "	m_user ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	user_id = :user_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $user->update_user;
			$arr_bind_param[":update_dt"]   = $user->update_dt;
			$arr_bind_param[":user_id"]     = $user->user_id;
//			$arr_bind_param[":client_id"]   = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete user
	 *
	 * @param stdClass	$user		A user
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($user)
	{
		if(isset($user->client_id)){
			$query_str = "update ";
			$query_str .= "	m_user ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $user->update_user;
			$arr_bind_param[":update_dt"]   = $user->update_dt;
			$arr_bind_param[":client_id"]   = $user->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}