<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_User extends Model
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
	 * Acquire all users
	 *
	 * @param stdClass	$search		Search condition
	 * @return	array				Acquisition record
	 */
	public function sel_cnt_user($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_user_name)){
			$arr_user_name = $search->arr_user_name;
		}
		if(isset($search->auth_grp_id) && $search->auth_grp_id !== ""){
			$auth_grp_id = $search->auth_grp_id;
		}
		
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(users.user_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_user.user_id ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "left join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_user.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "left join ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "on ";
		$query_str .= "	m_user.auth_grp_id = m_auth_grp.auth_grp_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_auth_grp.client_id = :client_id and ";
		}
		$query_str .= "	m_auth_grp.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_user.client_id = m_client.client_id and ";
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
		
		//Add search condition (user authority group)
		if(isset($auth_grp_id)){
			$query_str .= "	m_user.auth_grp_id = :auth_grp_id and ";
			$arr_bind_param[":auth_grp_id"] = $auth_grp_id;
		}
		
		//Add search condition (user name)
		if(!empty($arr_user_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_user_name as $user_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_user.user_name ilike :user_name_" . $i . " ";
				$arr_bind_param[":user_name_" . $i] = "%" . $user_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_user.client_id = :client_id and";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_user.del_flag = 0 ";
		$query_str .= ") users ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get user list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_user($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_user_name)){
			$arr_user_name = $search->arr_user_name;
		}
		if(isset($search->auth_grp_id) && $search->auth_grp_id !== ""){
			$auth_grp_id = $search->auth_grp_id;
		}
		$offset = $search->offset;
		
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_user.user_id, ";
		$query_str .= "	m_user.user_name, ";
		$query_str .= "	m_user.login_acnt, ";
		$query_str .= "	m_user.admin_flag, ";
		$query_str .= "	m_user.invalid_flag, ";
		$query_str .= "	m_shop.shop_name, ";
		$query_str .= "	m_auth_grp.auth_grp_name, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "left join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_user.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "left join ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "on ";
		$query_str .= "	m_user.auth_grp_id = m_auth_grp.auth_grp_id and ";
//		if(isset($this->client_id)){
//			$query_str .= "	m_auth_grp.client_id = :client_id and ";
//		}
		$query_str .= "	m_auth_grp.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_user.client_id = m_client.client_id and ";
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
		
		//Add search condition (user authority group)
		if(isset($auth_grp_id)){
			$query_str .= "	m_user.auth_grp_id = :auth_grp_id and ";
			$arr_bind_param[":auth_grp_id"] = $auth_grp_id;
		}
		
		//Add search condition (user name)
		if(!empty($arr_user_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_user_name as $user_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_user.user_name ilike :user_name_" . $i . " ";
				$arr_bind_param[":user_name_" . $i] = "%" . $user_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_user.client_id = :client_id and";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_user.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_user.user_name, ";
		$query_str .= "	m_user.user_id desc ";
		$query_str .= "limit :limit ";
		$arr_bind_param[":limit"] = MAX_CNT_PER_PAGE;
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get user
	 *
	 * @param String	$user_id		User ID
 	 * @return array					Acquisition record
	 */
	public function sel_user($user_id)
	{
		$query_str = "select ";
		$query_str .= "	m_user.user_id, ";
		$query_str .= "	m_user.shop_id, ";
		$query_str .= "	m_user.client_id, ";
		$query_str .= "	m_user.auth_grp_id, ";
		$query_str .= "	m_user.login_acnt, ";
		$query_str .= "	m_user.user_name, ";
		$query_str .= "	m_user.note, ";
		$query_str .= "	m_user.admin_flag, ";
		$query_str .= "	m_user.invalid_flag ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		$query_str .= "	m_user.user_id = :user_id and ";
//		if(isset($this->client_id)){
//			$query_str .= "	m_user.client_id = :client_id and ";
//		}
		$query_str .= "	m_user.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":user_id"] = $user_id;
//		if(isset($this->client_id)){
//			$arr_bind_param[":client_id"] = $this->client_id;
//		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get user name
	 *
	 * @param String	$user_id		User ID
 	 * @return array					Acquisition record
	 */
	public function sel_user_name($user_id)
	{
		$query_str = "select ";
		$query_str .= "	m_user.user_name ";
		$query_str .= "from ";
		$query_str .= "	m_user ";
		$query_str .= "where ";
		$query_str .= "	m_user.user_id = :user_id and ";
//		if(isset($this->client_id)){
//			$query_str .= "	m_user.client_id = :client_id and ";
//		}
		$query_str .= "	m_user.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":user_id"] = $user_id;
//		if(isset($this->client_id)){
//			$arr_bind_param[":client_id"] = $this->client_id;
//		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * User primary key number assignment
	 *
	 * @return int		Number assigned user_id
	 */
	public function sel_next_user_id()
	{
		$user_id = null;
		try{
			$m_user = new Model_M_User($this->db, $this->client_id);
			$user_id = $m_user->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$user_id = null;
		}
		return $user_id;
	}
	
	/**
	 * user registration
	 *
	 * @param stdClass	$user		A user
	 * @return bool					true = success, false = failure
	 */
	public function ins_user($user)
	{
		$ret = true;
		try{
			$m_user = new Model_M_User($this->db, $user->client_id);
			$ret = $m_user->ins($user);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * User update
	 *
	 * @param stdClass	$user		A user
	 * @return bool					true = success, false = failure
	 */
	public function up_user($user)
	{
		$ret = true;
		try{
			$m_user = new Model_M_User($this->db, $user->client_id);
			$ret = $m_user->up($user);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete user
	 *
	 * @param stdClass	$user		A user
	 * @return bool					true = success, false = failure
	 */
	public function del_user($user)
	{
		$ret = true;
		try{
			//User login history
			$t_user_login_hist = new Model_T_User_Login_Hist($this->db, $this->client_id);
			$user_login_hist = new stdClass();
			$user_login_hist->user_id = $user->user_id;
			$user_login_hist->update_user = $user->update_user;
			$user_login_hist->update_dt = $user->update_dt;
			$t_user_login_hist->del_by_user_id($user_login_hist);
			
			//User master
			$m_user = new Model_M_User($this->db, $this->client_id);
			$ret = $m_user->del($user);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}