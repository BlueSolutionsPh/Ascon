<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Property extends Model
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
	 * Get attribute list
	 * 
	 * @return	array				Acquisition record
	 */
	public function sel_arr_property()
	{
		$ret = true;
		try{
			$m_property = new Model_M_Property($this->db, $this->client_id);
			$ret = $m_property->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	
	/**
	 * Get attribute name
	 *
	 * @param String	$property_id			Attribute ID
	 * @return array					Acquisition record
	 */
	public function sel_property_name($property_id)
	{
		$query_str = "select ";
		$query_str .= "	m_property.property_name as property_name ";
		$query_str .= "from ";
		$query_str .= "	m_property ";
		$query_str .= "where ";
		$query_str .= "	m_property.property_id = :property_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_property.client_id = :client_id and ";
		}
		$query_str .= "	m_property.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":property_id"] = $property_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
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
	public function ins_property($property)
	{
		$ret = true;
		try{
			$m_property = new Model_M_Property($this->db, $this->client_id);
			$ret = $m_property->ins($property);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete attribute
	 *
	 * @param stdClass	$property	attribute
	 * @return bool					true = success, false = failure
	 */
	public function del_property($property)
	{
		$ret = true;
		try{
			$m_property = new Model_M_Property($this->db, $this->client_id);
			$m_property->del($property);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	

	/**
	 * Attribute update
	 *
	 * @param stdClass	$property		attribute
	 * @return bool					true = success, false = failure
	 */
	public function up_property($property)
	{
		$ret = true;
		try{
			$m_property = new Model_M_Property($this->db, $this->client_id);
			$m_property->up($property);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
}