<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Auth extends Model
{
	public $db;
	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Acquire user information
	 *
	 * @param String	$login_acnt	Account String
	 * @param String	$passwd		password
	 * @return array				Acquisition record
	 */
	public function sel_user_by_login_acnt_passwd($login_acnt, $passwd)
	{
		$ret = false;
		if(isset($login_acnt) && $login_acnt !== "" && isset($passwd) && $passwd !== ""){
			$query_str = "select ";
			$query_str .= "	m_user.user_id, ";
			$query_str .= "	m_user.auth_grp_id, ";
			$query_str .= "	m_user.client_id, ";
			$query_str .= "	m_user.admin_flag ";
			$query_str .= "from ";
			$query_str .= "	m_user ";
			$query_str .= "where ";
			$query_str .= "	m_user.login_acnt = :login_acnt and ";
			$query_str .= "	m_user.passwd = md5(:passwd) and ";
			$query_str .= "	m_user.invalid_flag = 0 and ";
			$query_str .= "	m_user.del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":login_acnt"] = $login_acnt;
			$arr_bind_param[":passwd"] = $passwd;

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			$ret = $query->execute($this->db, true);
		}

		return $ret;
	}

	/**
	 * Acquire user information (password hashed)
	 *
	 * @param String	$login_acnt	Account String
	 * @param String	$passwd		Password (hash)
	 * @return array				Acquisition record
	 */
	public function sel_user_by_login_acnt_passwd_hash($login_acnt, $passwd)
	{
		$ret = false;
		if(isset($login_acnt) && $login_acnt !== "" && isset($passwd) && $passwd !== ""){
			$query_str = "select ";
			$query_str .= "	m_user.user_id, ";
			$query_str .= "	m_user.auth_grp_id, ";
			$query_str .= "	m_user.client_id, ";
			$query_str .= "	m_user.admin_flag ";
			$query_str .= "from ";
			$query_str .= "	m_user ";
			$query_str .= "where ";
			$query_str .= "	m_user.login_acnt = :login_acnt and ";
			$query_str .= "	m_user.passwd = :passwd and ";
			$query_str .= "	m_user.invalid_flag = 0 and ";
			$query_str .= "	m_user.del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":login_acnt"] = $login_acnt;
			$arr_bind_param[":passwd"] = $passwd;

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			$ret = $query->execute($this->db, true);
		}

		return $ret;
	}

	/**
	 * Acquire user information
	 *
	 * @param String	$login_acnt	Login account
	 * @return array				Acquisition record
	 */
	public function sel_user_by_login_acnt($login_acnt)
	{
		$ret = false;
		if(isset($login_acnt) && $login_acnt !== ""){
			$query_str = "select ";
			$query_str .= "	m_user.user_id, ";
			$query_str .= "	m_user.client_id ";
			$query_str .= "from ";
			$query_str .= "	m_user ";
			$query_str .= "where ";
			$query_str .= "	m_user.login_acnt = :login_acnt and ";
			$query_str .= "	m_user.del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":login_acnt"] = $login_acnt;

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			$ret = $query->execute($this->db, true);
		}

		return $ret;
	}

	/**
	 * Acquire user authority list
	 *
	 * @param String	$auth_grp_id	Authority group ID
	 * @param String	$client_id		Client ID
	 * @return array					Acquisition record
	 */
	public function sel_arr_user_auth_rela($auth_grp_id, $client_id)
	{
		$query_str = "select ";
		$query_str .= "	m_module.module as module, ";
		$query_str .= "	m_func.func as auth ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "join ";
		$query_str .= "	t_auth_grp_rela ";
		$query_str .= "on ";
		$query_str .= "	m_auth_grp.auth_grp_id = t_auth_grp_rela.auth_grp_id and ";
		$query_str .= "	t_auth_grp_rela.auth_grp_id = :auth_grp_id and ";
//		$query_str .= "	t_auth_grp_rela.client_id = :client_id and ";
		$query_str .= "	t_auth_grp_rela.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_auth ";
		$query_str .= "on ";
		$query_str .= "	t_auth_grp_rela.auth_id = m_auth.auth_id and ";
		$query_str .= "	m_auth.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_func ";
		$query_str .= "on ";
		$query_str .= "	m_auth.func_id = m_func.func_id and ";
		$query_str .= "	m_func.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_module ";
		$query_str .= "on ";
		$query_str .= "	m_auth.module_id = m_module.module_id and ";
		$query_str .= "	m_module.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_auth_grp.auth_grp_id = :auth_grp_id and ";
//		$query_str .= "	m_auth_grp.client_id = :client_id and ";
		$query_str .= "	m_auth_grp.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":auth_grp_id"] = $auth_grp_id;
//		$arr_bind_param[":client_id"] = $client_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);;
	}

	/**
	 * Register user login history
	 *
	 * @param String	$user_login_hist	User login history
	 * @return array						Acquisition record
	 */
	public function ins_user_login_hist($user_login_hist)
	{
		$ret = true;
		try{
			$t_user_login_hist = new Model_T_User_Login_Hist($this->db, $user_login_hist->client_id);
			$ret = $t_user_login_hist->ins($user_login_hist);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
