<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Service extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * Acquire service ID (existence confirmation)
	 *
	 * @param String	$service_id	Service ID
	 * @return array				Acquisition record
	 */
	public function sel_id($service_id)
	{
		$arr_bind_param = array();
	
		$query_str = "select ";
		$query_str .= "	m_service.service_id ";
		$query_str .= "from ";
		$query_str .= "	m_service ";
		$query_str .= "where ";
		$query_str .= "	m_service.del_flag = 0 ";
	
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db, true);
	}
}