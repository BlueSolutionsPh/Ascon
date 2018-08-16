<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Client extends Model
{
	protected $db;
	public function __construct(&$db)
	{
		$this->db = $db;
	}
	
	/**
	 * Get client ID from client name
	 *
	 * @param String	$client_name	client name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($client_name)
	{
		$query_str = "select ";
		$query_str .= "	m_client.client_id ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	m_client.client_name = :client_name and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":client_name"] = $client_name;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get client ID from client name
	 *
	 * @param String	$client_name	client name
	 * @param String	$client_id		Client ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($client_name, $client_id)
	{
		$query_str = "select ";
		$query_str .= "	m_client.client_id ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	m_client.client_id <> :client_id and ";
		$query_str .= "	m_client.client_name = :client_name and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":client_name"] = $client_name;
		$arr_bind_param[":client_id"] = $client_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get client
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public function sel($client_id)
	{
		$query_str = "select ";
		$query_str .= "	client_id, ";
		$query_str .= "	client_name ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":client_id"] = $client_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all client IDs and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$query_str = "select ";
		$query_str .= "	client_id, ";
		$query_str .= "	client_name ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	client_name, ";
		$query_str .= "	client_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all clients
	 *
	 * @return array				Acquisition record
	 */
	public function sel_cnt()
	{
		$query_str = "select ";
		$query_str .= "	count(client_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Client ID acquisition (existence confirmation)
	 *
	 * @param String	$client_id	Client ID
	 * @return array				Acquisition record
	 */
	public function sel_id($client_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_client.client_id ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	m_client.client_id = :client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		
		$arr_bind_param[":client_id"] = $client_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Client primary key numbering
	 *
	 * @return int		Number assigned client_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_client', 'client_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Client registration
	 *
	 * @param stdClass	$client		client
	 * @return bool					true = success, false = failure
	 */
	public function ins($client)
	{
		$query_str = "insert into ";
		$query_str .= "	m_client( ";
		$query_str .= "		client_id, ";
		$query_str .= "		client_name, ";
		$query_str .= "		max_total_cts_file_size, ";
		$query_str .= "		note, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:client_id, ";
		$query_str .= "		:client_name, ";
		$query_str .= "		:max_total_cts_file_size, ";
		$query_str .= "		:note, ";
		$query_str .= "		:create_user, ";
		$query_str .= "		:create_dt, ";
		$query_str .= "		:update_user, ";
		$query_str .= "		:update_dt ";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":client_id"]   = $client->client_id;
		$arr_bind_param[":client_name"] = $client->client_name;
		$arr_bind_param[":max_total_cts_file_size"] = $client->max_total_cts_file_size;
		$arr_bind_param[":note"]        = $client->note;
		$arr_bind_param[":create_user"] = $client->create_user;
		$arr_bind_param[":create_dt"]   = $client->create_dt;
		$arr_bind_param[":update_user"] = $client->update_user;
		$arr_bind_param[":update_dt"]   = $client->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Client update
	 *
	 * @param stdClass	$client		client
	 * @return bool					true = success, false = failure
	 */
	public function up($client)
	{
		$query_str = "update ";
		$query_str .= "	m_client ";
		$query_str .= "set ";
		$query_str .= "	client_name = :client_name, ";
		$query_str .= "	max_total_cts_file_size = :max_total_cts_file_size, ";
		$query_str .= "	note = :note, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":client_name"] = $client->client_name;
		$arr_bind_param[":max_total_cts_file_size"] = $client->max_total_cts_file_size;
		$arr_bind_param[":note"]        = $client->note;
		$arr_bind_param[":update_user"] = $client->update_user;
		$arr_bind_param[":update_dt"]   = $client->update_dt;
		$arr_bind_param[":client_id"]   = $client->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Delete client
	 *
	 * @param stdClass	$client		client
	 * @return bool					true = success, false = failure
	 */
	public function del($client)
	{
		$query_str = "update ";
		$query_str .= "	m_client ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $client->update_user;
		$arr_bind_param[":update_dt"]   = $client->update_dt;
		$arr_bind_param[":client_id"]   = $client->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
}