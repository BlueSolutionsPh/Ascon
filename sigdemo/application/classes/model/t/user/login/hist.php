<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_User_Login_Hist extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * User login history registration
	 *
	 * @param stdClass	$user_login_hist	User login history
	 * @return bool							true = success, false = failure
	 */
	public function ins($user_login_hist)
	{
		if(isset($this->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_user_login_hist( ";
			$query_str .= "		user_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		success, ";
			$query_str .= "		ip_addr, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:user_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:success, ";
			$query_str .= "		:ip_addr, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":user_id"] = $user_login_hist->user_id;
			$arr_bind_param[":client_id"] = $this->client_id;
			$arr_bind_param[":success"] = $user_login_hist->success;
			$arr_bind_param[":ip_addr"] = $user_login_hist->ip_addr;
			$arr_bind_param[":create_user"] = $user_login_hist->create_user;
			$arr_bind_param[":create_dt"] = $user_login_hist->create_dt;
			$arr_bind_param[":update_user"] = $user_login_hist->update_user;
			$arr_bind_param[":update_dt"] = $user_login_hist->update_dt;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete user login history
	 *
	 * @param stdClass	$user_login_hist	User login history
	 * @return bool							true=成功、false=失敗
	 */
	public function del_by_user_id($user_login_hist)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	t_user_login_hist ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	user_id = :user_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $user_login_hist->update_user;
			$arr_bind_param[":update_dt"] = $user_login_hist->update_dt;
			$arr_bind_param[":user_id"] = $user_login_hist->user_id;
			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete user login history
	 *
	 * @param stdClass	$user_login_hist	Delete user login history
	 * @return bool							true = success, false = failure
	 */
	public function del_by_client_id($user_login_hist)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	t_user_login_hist ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $user_login_hist->update_user;
			$arr_bind_param[":update_dt"] = $user_login_hist->update_dt;
			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}