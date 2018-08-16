<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Authgrp extends Model
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
	}

	/**
	 * Acquire number of authority groups
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_auth_grp($search)
	{
		//Search condition
		if(!empty($search->arr_auth_grp_name)){
			$arr_auth_grp_name = $search->arr_auth_grp_name;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(auth_grp.auth_grp_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_auth_grp.auth_grp_id ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";

		//Search condition (authority group name) added
		if(!empty($arr_auth_grp_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_auth_grp_name as $auth_grp_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_auth_grp.auth_grp_name ilike :auth_grp_name_" . $i ;
				$arr_bind_param[":auth_grp_name_" . $i] = "%" . $auth_grp_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_auth_grp.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_auth_grp.del_flag = 0 ";
		$query_str .= ") auth_grp ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire authority group list
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_auth_grp($search)
	{
		//Search condition
		if(!empty($search->arr_auth_grp_name)){
			$arr_auth_grp_name = $search->arr_auth_grp_name;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_auth_grp.auth_grp_id, ";
		$query_str .= "	m_auth_grp.auth_grp_name, ";
		$query_str .= "	m_auth_grp.update_user ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";

		//Search condition (authority group name) added
		if(!empty($arr_auth_grp_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_auth_grp_name as $auth_grp_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_auth_grp.auth_grp_name ilike :auth_grp_name_" . $i ;
				$arr_bind_param[":auth_grp_name_" . $i] = "%" . $auth_grp_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_auth_grp.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_auth_grp.auth_grp_name, ";
		$query_str .= "	m_auth_grp.auth_grp_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire authority group
	 *
	 * @param String	$auth_grp_id	Authority group ID
	 * @return array					Acquisition record
	 */
	public function sel_auth_grp($auth_grp_id)
	{
		$ret = true;
		try{
			$m_auth_grp = new Model_M_Auth_Grp($this->db, $this->client_id);
			$ret = $m_auth_grp->sel($auth_grp_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Acquire authority group association
	 *
	 * @param String	$auth_grp_id	Authority group ID
	 * @return array					Acquisition record
	 */
	public function sel_arr_auth_grp_rela($auth_grp_id)
	{
		$query_str = "select ";
		$query_str .= "	t_auth_grp_rela.auth_id ";
		$query_str .= "from ";
		$query_str .= "	t_auth_grp_rela ";
		$query_str .= "where ";
		$query_str .= "	t_auth_grp_rela.auth_grp_id = :auth_grp_id and ";
		$query_str .= "	t_auth_grp_rela.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":auth_grp_id"] = $auth_grp_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Retrieve authority group name
	 *
	 * @param String	$auth_grp_id	Authority group ID
	 * @return array					Acquisition record
	 */
	public function sel_auth_grp_name($auth_grp_id)
	{
		$query_str = "select ";
		$query_str .= "	m_auth_grp.auth_grp_name ";
		$query_str .= "from ";
		$query_str .= "	m_auth_grp ";
		$query_str .= "where ";
		$query_str .= "	m_auth_grp.auth_grp_id = :auth_grp_id and ";
		$query_str .= "	m_auth_grp.del_flag = 0 ";

		$arr_bind_param = array();
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
	public function sel_next_auth_grp_id()
	{
		$auth_grp_id = null;
		try{
			$m_auth_grp = new Model_M_Auth_Grp($this->db, $this->client_id);
			$auth_grp_id = $m_auth_grp->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::auth_grp($e))->write();
			$auth_grp_id = null;
		}
		return $auth_grp_id;
	}

	/**
	 * Create authority group
	 *
	 * @param String	$auth_grp		Authority group
	 * @return bool					true = success, false = failure
	 */
	public function ins_auth_grp($auth_grp)
	{
		$ret = true;
		try{
			$m_auth_grp = new Model_M_Auth_Grp($this->db, $this->client_id);
			$ret = $m_auth_grp->ins($auth_grp);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Authorization group update
	 *
	 * @param stdClass	$auth_grp		Authority group
	 * @return bool					true = success, false = failure
	 */
	public function up_auth_grp($auth_grp)
	{
		$ret = true;
		try{
			$m_auth_grp = new Model_M_Auth_Grp($this->db, $this->client_id);
			$m_auth_grp->up($auth_grp);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Delete authority group
	 *
	 * @param stdClass	$auth_grp	Authority group
	 * @return bool					true = success, false = failure
	 */
	public function del_auth_grp($auth_grp)
	{
		$ret = true;
		try{
			//Authority group authority related
			$t_auth_grp_rela = new Model_T_Auth_Grp_Rela($this->db, $this->client_id);
			$auth_grp_rela = new stdClass();
			$auth_grp_rela->auth_grp_id = $auth_grp->auth_grp_id;
			$auth_grp_rela->update_user = $auth_grp->update_user;
			$auth_grp_rela->update_dt = $auth_grp->update_dt;
			$t_auth_grp_rela->del_by_auth_grp_id($auth_grp_rela);

			//Authority group master
			$m_auth_grp = new Model_M_Auth_Grp($this->db, $this->client_id);
			$m_auth_grp->del($auth_grp);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Authority group tag related registration
	 *
	 * @param stdClass	$auth_grp_rela		Authority group tag related
	 * @return bool							true = success, false = failure
	 */
	public function ins_auth_grp_rela($auth_grp_rela)
	{
		$ret = true;
		try{
			$t_auth_grp_rela = new Model_T_Auth_Grp_Rela($this->db, $this->client_id);
			$ret = $t_auth_grp_rela->ins($auth_grp_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Authority group tag Delete
	 *
	 * @param stdClass	$auth_grp_rela		Authority group tag related
	 * @return bool							true = success, false = failure
	 */
	public function del_auth_grp_rela($auth_grp_rela)
	{
		$ret = true;
		try{
			$t_auth_grp_rela = new Model_T_Auth_Grp_Rela($this->db, $this->client_id);
			$ret = $t_auth_grp_rela->del_by_auth_id_auth_grp_id($auth_grp_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
