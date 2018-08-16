<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Dev_Html_Rela_Dl_Log extends Model
{
	protected $db;
	public function __construct(&$db)
	{
		$this->db = $db;
	}
	
	/**
	 * Delete terminal tag deletion
	 *
	 * @param String	$dev_html_rela_dl_log	Terminal HTML related download log
	 * @return bool								true = success, false = failure
	 */
	public function del_by_dev_id($dev_html_rela_dl_log)
	{
		$query_str = "update ";
		$query_str .= "	t_dev_html_rela_dl_log ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	dev_id = :dev_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $dev_html_rela_dl_log->update_user;
		$arr_bind_param[":update_dt"] = $dev_html_rela_dl_log->update_dt;
		$arr_bind_param[":dev_id"] = $dev_html_rela_dl_log->dev_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
}