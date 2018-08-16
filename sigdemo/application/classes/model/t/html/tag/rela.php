<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Html_Tag_Rela extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
//		$this->client_id = $client_id;
		$this->client_id = null; // 20180109 hit_update
	}
	
	/**
	 * HTML tag related registration
	 *
	 * @param stdClass	$html_tag_rela	HTML tag related
	 * @return bool						true = success, false = failure
	 */
	public function ins($html_tag_rela)
	{
		if(isset($html_tag_rela->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_html_tag_rela( ";
			$query_str .= "		html_id, ";
			$query_str .= "		html_tag_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:html_id,";
			$query_str .= "		:html_tag_id,";
			$query_str .= "		:client_id,";
			$query_str .= "		:create_user,";
			$query_str .= "		:create_dt,";
			$query_str .= "		:update_user,";
			$query_str .= "		:update_dt";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":html_id"]     = $html_tag_rela->html_id;
			$arr_bind_param[":html_tag_id"] = $html_tag_rela->html_tag_id;
			$arr_bind_param[":client_id"]   = $html_tag_rela->client_id;
			$arr_bind_param[":create_user"] = $html_tag_rela->create_user;
			$arr_bind_param[":create_dt"]   = $html_tag_rela->create_dt;
			$arr_bind_param[":update_user"] = $html_tag_rela->update_user;
			$arr_bind_param[":update_dt"]   = $html_tag_rela->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * true = success, false = failure
	 *
	 * @param stdClass	$html_tag_rela	HTML tag related
	 * @return bool						true = success, false = failure
	 */
	public function del($html_tag_rela)
	{
//		if(isset($html_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_html_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	html_tag_rela_id = :html_tag_rela_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"]      = $html_tag_rela->update_user;
			$arr_bind_param[":update_dt"]        = $html_tag_rela->update_dt;
			$arr_bind_param[":html_tag_rela_id"] = $html_tag_rela->html_tag_rela_id;
			$arr_bind_param[":client_id"]        = $html_tag_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * true = success, false = failure
	 *
	 * @param stdClass	$html_tag_rela	HTML tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_html_id($html_tag_rela)
	{
//		if(isset($html_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_html_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	html_id = :html_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $html_tag_rela->update_user;
			$arr_bind_param[":update_dt"] = $html_tag_rela->update_dt;
			$arr_bind_param[":html_id"] = $html_tag_rela->html_id;
//			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * HTML tag related delete
	 *
	 * @param stdClass	$html_tag_rela	HTML tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_html_id_html_tag_id($html_tag_rela)
	{
//		if(isset($html_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_html_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	html_id = :html_id and ";
			$query_str .= "	html_tag_id = :html_tag_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $html_tag_rela->update_user;
			$arr_bind_param[":update_dt"]   = $html_tag_rela->update_dt;
//			$arr_bind_param[":client_id"]   = $html_tag_rela->client_id;
			$arr_bind_param[":html_id"]     = $html_tag_rela->html_id;
			$arr_bind_param[":html_tag_id"] = $html_tag_rela->html_tag_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * HTML tag related delete
	 *
	 * @param stdClass	$html_tag_rela	HTML tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_client_id($html_tag_rela)
	{
		if(isset($html_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_html_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $html_tag_rela->update_user;
			$arr_bind_param[":update_dt"]   = $html_tag_rela->update_dt;
			$arr_bind_param[":client_id"]   = $html_tag_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}