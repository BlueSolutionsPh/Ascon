<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Draw_Size extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id = null)
	{
		$this->db = $db;
//		$this->client_id = $client_id;
		$this->client_id = null; // 20180109 hit_update
	}
	
	/**
	 * Acquire drawing size
	 *
	 * @param String	$draw_size_id	Drawing size ID
	 * @return array					Acquisition record
	 */
	public function sel($draw_size_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_draw_size.draw_size_id, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height ";
		$query_str .= "from ";
		$query_str .= "	m_draw_size ";
		$query_str .= "where ";
		$query_str .= "	m_draw_size.draw_size_id = :draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_draw_size.width desc, ";
		$query_str .= "	m_draw_size.height desc, ";
		$query_str .= "	m_draw_size.draw_size_name, ";
		$query_str .= "	m_draw_size.draw_size_id desc ";
		
		$arr_bind_param[":draw_size_id"] = $draw_size_id;
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Delete drawing size
	 *
	 * @param stdClass	$draw_size	Drawing size
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($draw_area)
	{
		if(isset($draw_area->client_id)){
			$query_str = "update ";
			$query_str .= "	m_draw_size ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $draw_area->update_user;
			$arr_bind_param[":update_dt"]   = $draw_area->update_dt;
			$arr_bind_param[":client_id"]   = $draw_area->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}