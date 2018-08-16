<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Draw_Tmpl extends Model
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
	 * Acquire drawing area template ID (existence confirmation)
	 *
	 * @param String	$draw_tmpl_id	Drawing area template ID
	 * @return array					Acquisition record
	 */
	public function sel_id($draw_tmpl_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_draw_tmpl.draw_tmpl_id ";
		$query_str .= "from ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "where ";
		$query_str .= "	m_draw_tmpl.draw_tmpl_id = :draw_tmpl_id and ";
		$arr_bind_param[":draw_tmpl_id"] = $draw_tmpl_id;
		$query_str .= "	m_draw_tmpl.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Obtain drawing area template list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	draw_tmpl_id, ";
		$query_str .= "	draw_tmpl_name ";
		$query_str .= "from ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	draw_tmpl_name, ";
		$query_str .= "	draw_tmpl_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Drawing area template deleted
	 *
	 * @param stdClass	$draw_tmpl	Drawing area template
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($draw_tmpl)
	{
		if(isset($draw_tmpl->client_id)){
			$query_str = "update ";
			$query_str .= "	m_draw_tmpl ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $draw_tmpl->update_user;
			$arr_bind_param[":update_dt"]   = $draw_tmpl->update_dt;
			$arr_bind_param[":client_id"]   = $draw_tmpl->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}