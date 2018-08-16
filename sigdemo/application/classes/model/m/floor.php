<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Floor extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * Acquire installation floor ID from installation floor name
	 *
	 * @param String	$floor_name		Installation floor name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($floor_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_floor.floor_id ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "where ";
		if(isset($this->floor_id)){
			$query_str .= "	m_floor.floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $this->floor_id;
		}
		$query_str .= "	m_floor.floor_name = :floor_name and ";
		$arr_bind_param[":floor_name"] = $floor_name;
		$query_str .= "	m_floor.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire installation floor ID from installation floor name
	 *
	 * @param String	$floor_name		Installation floor name
	 * @param String	$floor_id		Installation floor ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($floor_name, $floor_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_floor.floor_id ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "where ";
		if(isset($this->floor_id)){
			$query_str .= "	m_floor.floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $this->floor_id;
		}
		$query_str .= "	m_floor.floor_id <> :floor_id and ";
		$query_str .= "	m_floor.floor_name = :floor_name and ";
		$query_str .= "	m_floor.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param[":floor_name"] = $floor_name;
		$arr_bind_param[":floor_id"] = $floor_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all installation floor ID and name list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	floor_id, ";
		$query_str .= "	floor_name ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "where ";
		if(isset($this->floor_id)){
			$query_str .= "	floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $this->floor_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	floor_id, ";
		$query_str .= "	floor_name desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all installed floors
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(floor_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "where ";
		if(isset($this->floor_id)){
			$query_str .= "	floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $this->floor_id;
		}
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Installation floor ID acquisition (existence confirmation)
	 *
	 * @param String	$floor_id	Installation floor ID
	 * @return array				Acquisition record
	 */
	public function sel_id($floor_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_floor.floor_id ";
		$query_str .= "from ";
		$query_str .= "	m_floor ";
		$query_str .= "where ";
		if(isset($this->floor_id)){
			$query_str .= "	m_floor.floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $this->floor_id;
		}
		$query_str .= "	m_floor.floor_id = :floor_id and ";
		$query_str .= "	m_floor.del_flag = 0 ";
		
		$arr_bind_param[":floor_id"] = $floor_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Installation floor Main key number assignment
	 *
	 * @return int		Number assigned floor_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_floor', 'floor_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Registration on the floor
	 *
	 * @param stdClass	$floor		Installation floor
	 * @return bool					true = success, false = failure
	 */
	public function ins($floor)
	{
		if(isset($this->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_floor( ";
			$query_str .= "		floor_id, ";
			$query_str .= "		floor_name, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:floor_id, ";
			$query_str .= "		:floor_name, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":floor_id"] = $floor->floor_id;
			$arr_bind_param[":floor_name"] = $floor->floor_name;
			$arr_bind_param[":create_user"] = $floor->create_user;
			$arr_bind_param[":create_dt"] = $floor->create_dt;
			$arr_bind_param[":update_user"] = $floor->update_user;
			$arr_bind_param[":update_dt"] = $floor->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Installation floor renewal
	 *
	 * @param stdClass	$floor		Installation floor
	 * @return bool					true = success, false = failure
	 */
	public function up($floor)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_floor ";
			$query_str .= "set ";
			$query_str .= "	floor_name = :floor_name, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	floor_id = :floor_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":floor_name"] = $floor->floor_name;
			$arr_bind_param[":update_user"] = $floor->update_user;
			$arr_bind_param[":update_dt"] = $floor->update_dt;
			$arr_bind_param[":floor_id"] = $floor->floor_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Installation floor removed
	 *
	 * @param stdClass	$floor		Installation floor
	 * @return bool					true = success, false = failure
	 */
	public function del($floor)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_floor ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	floor_id = :floor_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $floor->update_user;
			$arr_bind_param[":update_dt"] = $floor->update_dt;
			$arr_bind_param[":floor_id"] = $floor->floor_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}