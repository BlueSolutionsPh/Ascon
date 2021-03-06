<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Auth_Grp_Rela extends Model
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
	 * true = success, false = failure
	 *
	 * @param stdClass	$auth_grp_rela	Authority group related
	 * @return bool						true = success, false = failure
	 */
	public function ins($auth_grp_rela)
	{
//		if(isset($auth_grp_rela->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_auth_grp_rela( ";
			$query_str .= "		auth_grp_id, ";
			$query_str .= "		auth_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:auth_grp_id, ";
			$query_str .= "		:auth_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":auth_grp_id"] = $auth_grp_rela->auth_grp_id;
			$arr_bind_param[":auth_id"]     = $auth_grp_rela->auth_id;
			$arr_bind_param[":client_id"]   = $auth_grp_rela->client_id;
			$arr_bind_param[":create_user"] = $auth_grp_rela->create_user;
			$arr_bind_param[":create_dt"]   = $auth_grp_rela->create_dt;
			$arr_bind_param[":update_user"] = $auth_grp_rela->update_user;
			$arr_bind_param[":update_dt"]   = $auth_grp_rela->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Authority group association deleted
	 *
	 * @param stdClass	$auth_grp_rela	Authority group related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_auth_grp_id($auth_grp_rela)
	{
//		if(isset($auth_grp_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_auth_grp_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	auth_grp_id = :auth_grp_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $auth_grp_rela->update_user;
			$arr_bind_param[":update_dt"]   = $auth_grp_rela->update_dt;
			$arr_bind_param[":auth_grp_id"] = $auth_grp_rela->auth_grp_id;
//			$arr_bind_param[":client_id"]   = $auth_grp_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Authority group association deleted
	 *
	 * @param stdClass	$auth_grp_rela	Authority group related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_auth_id_auth_grp_id($auth_grp_rela)
	{
//		if(isset($auth_grp_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_auth_grp_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	auth_id = :auth_id and ";
			$query_str .= "	auth_grp_id = :auth_grp_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $auth_grp_rela->update_user;
			$arr_bind_param[":update_dt"]   = $auth_grp_rela->update_dt;
			$arr_bind_param[":auth_id"]     = $auth_grp_rela->auth_id;
			$arr_bind_param[":auth_grp_id"] = $auth_grp_rela->auth_grp_id;
//			$arr_bind_param[":client_id"]   = $auth_grp_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Authority group association deleted
	 *
	 * @param stdClass	$auth_grp_rela	Authority group related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_client_id($auth_grp_rela)
	{
		if(isset($auth_grp_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_auth_grp_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $auth_grp_rela->update_user;
			$arr_bind_param[":update_dt"]   = $auth_grp_rela->update_dt;
			$arr_bind_param[":client_id"]   = $auth_grp_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}