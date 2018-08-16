<?php if (!defined('SYSPATH')) exit('No direct script access');

class Model_M_Module extends Model
{
	protected $db;
	
	public function __construct(&$db)
	{
		$this->db = $db;
	}
	
	/**
	 * Acquire module list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_module()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_module.module, ";
		$query_str .= "	m_module.module_name ";
		$query_str .= "from ";
		$query_str .= "	m_module ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_module.display_order, ";
		$query_str .= "	m_module.module_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
}