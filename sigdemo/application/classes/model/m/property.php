<?php if (!defined('SYSPATH')) exit('No direct script access');

class Model_M_Property extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * Attribute ID acquisition (existence confirmation)
	 *
	 * @param String	$property_id		Attribute ID
	 * @return array				Acquisition record
	 */
	public function sel_id($property_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_property.property_id ";
		$query_str .= "from ";
		$query_str .= "	m_property ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_property.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_property.property_id = :property_id and ";
		$arr_bind_param[":property_id"] = $property_id;
		$query_str .= "	m_property.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get attribute
	 *
	 * @param String	$property_name		Attribute name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($property_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_property.property_id ";
		$query_str .= "from ";
		$query_str .= "	m_property ";
		$query_str .= "where ";
		$query_str .= "	m_property.property_name = :property_name and ";
		$arr_bind_param[":property_name"] = $property_name;
		if(isset($this->client_id)){
			$query_str .= "	m_property.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_property.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all attribute ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		if(!isset($this->client_id)){
			$query_str .= "	m_client.client_id, ";
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	m_property.property_id, ";
		$query_str .= "	m_property.property_name ";
		$query_str .= "from ";
		$query_str .= "	m_property ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_property.client_id = m_client.client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_property.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_property.del_flag = 0 ";
		$query_str .= "order by ";
		if(!isset($this->client_id)){
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	m_property.property_name, ";
		$query_str .= "	m_property.property_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Attribute registration
	 *
	 * @param stdClass	$property	attribute
	 * @return bool					true = success, false = failure
	 */
	public function ins($property)
	{
		if(isset($this->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_property( ";
			if(isset($property->property_id)){
				$query_str .= "		property_id, ";
			}
			$query_str .= "		client_id, ";
			$query_str .= "		property_name, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			if(isset($property->property_id)){
				$query_str .= "		:property_id, ";
			}
			$query_str .= "		:client_id, ";
			$query_str .= "		:property_name, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			if(isset($property->property_id)){
				$arr_bind_param[":property_id"] = $property->property_id;
			}
			$arr_bind_param[":client_id"] = $this->client_id;
			$arr_bind_param[":property_name"] = $property->property_name;
			$arr_bind_param[":create_user"] = $property->create_user;
			$arr_bind_param[":create_dt"] = $property->create_dt;
			$arr_bind_param[":update_user"] = $property->update_user;
			$arr_bind_param[":update_dt"] = $property->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Attribute update
	 *
	 * @param stdClass	$property	attribute
	 * @return bool					true = success, false = failure
	 */
	public function up($property)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_property ";
			$query_str .= "set ";
			$query_str .= "	property_name = :property_name, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	property_id = :property_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag =0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":property_name"] = $property->property_name;
			$arr_bind_param[":update_user"] = $property->update_user;
			$arr_bind_param[":update_dt"] = $property->update_dt;
			$arr_bind_param[":property_id"] = $property->property_id;
			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete attribute
	 *
	 * @param stdClass	$property	attribute
	 * @return bool					true = success, false = failure
	 */
	public function del($property)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_property ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	property_id = :property_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $property->update_user;
			$arr_bind_param[":update_dt"] = $property->update_dt;
			$arr_bind_param[":property_id"] = $property->property_id;
			$arr_bind_param[":client_id"] = $this->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete attribute
	 *
	 * @param stdClass	$property	attribute
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($property)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_property ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $property->update_user;
			$arr_bind_param[":update_dt"] = $property->update_dt;
			$arr_bind_param[":client_id"] = $this->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}