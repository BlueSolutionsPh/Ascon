<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Playlist_Text_Rela extends Model
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
	 * Registration related to playlist text
	 *
	 * @param stdClass	$playlist_text_rela		Playlist text related
	 * @return bool								true = success, false = failure
	 */
	public function ins($playlist_text_rela)
	{
		$query_str = "insert into ";
		$query_str .= "	t_playlist_text_rela( ";
		$query_str .= "		playlist_id, ";
		$query_str .= "		text_id, ";
		$query_str .= "		draw_area_id, ";
		$query_str .= "		client_id, ";
		$query_str .= "		display_order, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:playlist_id,";
		$query_str .= "		:text_id,";
		$query_str .= "		:draw_area_id,";
		$query_str .= "		:client_id,";
		$query_str .= "		:display_order,";
		$query_str .= "		:create_user,";
		$query_str .= "		:create_dt,";
		$query_str .= "		:update_user,";
		$query_str .= "		:update_dt";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":playlist_id"]   = $playlist_text_rela->playlist_id;
		$arr_bind_param[":text_id"]       = $playlist_text_rela->text_id;
		$arr_bind_param[":draw_area_id"]  = $playlist_text_rela->draw_area_id;
		$arr_bind_param[":client_id"]     = $playlist_text_rela->client_id;
		$arr_bind_param[":display_order"] = $playlist_text_rela->display_order;
		$arr_bind_param[":create_user"]   = $playlist_text_rela->create_user;
		$arr_bind_param[":create_dt"]     = $playlist_text_rela->create_dt;
		$arr_bind_param[":update_user"]   = $playlist_text_rela->update_user;
		$arr_bind_param[":update_dt"]     = $playlist_text_rela->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Playlist Text Related Delete
	 *
	 * @param stdClass	$playlist_text_rela		Playlist text related
	 * @return bool								true = success, false = failure
	 */
	public function del_by_playlist_id_text_id_draw_area_id_display_order($playlist_text_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_playlist_text_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	playlist_id = :playlist_id and ";
		$query_str .= "	text_id = :text_id and ";
		$query_str .= "	draw_area_id = :draw_area_id and ";
		$query_str .= "	display_order = :display_order and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"]   = $playlist_text_rela->update_user;
		$arr_bind_param[":update_dt"]     = $playlist_text_rela->update_dt;
		$arr_bind_param[":playlist_id"]   = $playlist_text_rela->playlist_id;
		$arr_bind_param[":text_id"]       = $playlist_text_rela->text_id;
		$arr_bind_param[":draw_area_id"]  = $playlist_text_rela->draw_area_id;
		$arr_bind_param[":display_order"] = $playlist_text_rela->display_order;
//		$arr_bind_param[":client_id"]     = $playlist_text_rela->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Playlist Text Related Delete
	 *
	 * @param String	$playlist_text_rela	Playlist text related
	 * @return bool							true = success, false = failure
	 */
	public function del_by_playlist_id($playlist_text_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_playlist_text_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	playlist_id = :playlist_id and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $playlist_text_rela->update_user;
		$arr_bind_param[":update_dt"]   = $playlist_text_rela->update_dt;
		$arr_bind_param[":playlist_id"] = $playlist_text_rela->playlist_id;
//		$arr_bind_param[":client_id"]   = $playlist_text_rela->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Playlist Text Related Delete
	 *
	 * @param String	$playlist_text_rela	Playlist text related
	 * @return bool							true = success, false = failure
	 */
	public function del_by_text_id($playlist_text_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_playlist_text_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	text_id = :text_id and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $playlist_text_rela->update_user;
		$arr_bind_param[":update_dt"]   = $playlist_text_rela->update_dt;
		$arr_bind_param[":text_id"]     = $playlist_text_rela->text_id;
//		$arr_bind_param[":client_id"]   = $playlist_text_rela->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Playlist Text Related Delete
	 *
	 * @param String	$playlist_text_rela	Playlist text related
	 * @return bool							true = success, false = failure
	 */
	public function del_by_client_id($playlist_text_rela)
	{
		if(isset($playlist_text_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_playlist_text_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $playlist_text_rela->update_user;
			$arr_bind_param[":update_dt"]   = $playlist_text_rela->update_dt;
			$arr_bind_param[":client_id"]   = $playlist_text_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}