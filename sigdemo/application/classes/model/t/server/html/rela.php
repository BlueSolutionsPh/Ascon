<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Server_Html_Rela extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * Server HTML related deletion
	 *
	 * @param stdClass	$server_html_rela	Server HTML related
	 * @return bool							true = success, false = failure
	 */
	public function del_by_client_id($server_html_rela)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_user ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $server_html_rela->update_user;
			$arr_bind_param[":update_dt"] = $server_html_rela->update_dt;
			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}