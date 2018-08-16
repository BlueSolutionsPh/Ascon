<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Prog_Playlist_Rela extends Model
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
	 * Acquire program list related ID list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name_prog_playlist_rela($playlist)
	{
	
		$query_str = "select ";
		$query_str .= "	t_prog_playlist_rela.prog_id, ";
		$query_str .= "	t_prog_playlist_rela.playlist_id, ";
		$query_str .= "	t_prog_playlist_rela.client_id, ";
		$query_str .= "	t_prog_playlist_rela.ch, ";
		$query_str .= "	t_prog_playlist_rela.create_user, ";
		$query_str .= "	t_prog_playlist_rela.create_dt, ";
		$query_str .= "	t_prog_playlist_rela.update_user, ";
		$query_str .= "	t_prog_playlist_rela.update_dt, ";
		$query_str .= "	t_prog_rgl.prog_rgl_grp_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_playlist_rela ";
		$query_str .= "join ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "on ";
		$query_str .= "	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "	t_prog_rgl.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_prog_playlist_rela.playlist_id = :playlist_id and ";
		$query_str .= "	t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_playlist_rela.client_id, ";
		$query_str .= "	t_prog_playlist_rela.playlist_id desc ";
		
		$arr_bind_param = array();
		$arr_bind_param[":playlist_id"] = $playlist->playlist_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db, true);
	}
	
	/**
	 * Program list Playlist related registration
	 *
	 * @param stdClass	$prog_playlist_rela	Program list Play list related
	 * @return bool							true = success, false = failure
	 */
	public function ins($prog_playlist_rela)
	{
		if(isset($prog_playlist_rela->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_prog_playlist_rela( ";
			$query_str .= "		prog_id, ";
			$query_str .= "		playlist_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		ch, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:prog_id,";
			$query_str .= "		:playlist_id,";
			$query_str .= "		:client_id,";
			$query_str .= "		:ch,";
			$query_str .= "		:create_user,";
			$query_str .= "		:create_dt,";
			$query_str .= "		:update_user,";
			$query_str .= "		:update_dt";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":prog_id"] = $prog_playlist_rela->prog_id;
			$arr_bind_param[":playlist_id"] = $prog_playlist_rela->playlist_id;
			$arr_bind_param[":client_id"]   = $prog_playlist_rela->client_id;
			$arr_bind_param[":ch"]          = $prog_playlist_rela->ch;
			$arr_bind_param[":create_user"] = $prog_playlist_rela->create_user;
			$arr_bind_param[":create_dt"]   = $prog_playlist_rela->create_dt;
			$arr_bind_param[":update_user"] = $prog_playlist_rela->update_user;
			$arr_bind_param[":update_dt"]   = $prog_playlist_rela->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Program list Play list related delete
	 *
	 * @param stdClass	$prog_playlist_rela	Program list Play list related
	 * @return bool							true = success, false = failure
	 */
	public function del_by_playlist_id($prog_playlist_rela)
	{
//		if(isset($prog_playlist_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_prog_playlist_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	playlist_id = :playlist_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $prog_playlist_rela->update_user;
			$arr_bind_param[":update_dt"]   = $prog_playlist_rela->update_dt;
			$arr_bind_param[":playlist_id"] = $prog_playlist_rela->playlist_id;
//			$arr_bind_param[":client_id"]   = $prog_playlist_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}

	/**
	 * Program list Play list related delete
	 *
	 * @param stdClass	$prog_playlist_rela	Program list Play list related
	 * @return bool							true = success, false = failure
	 */
	public function del_by_common_playlist_id($prog_playlist_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_prog_playlist_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	common_playlist_id = :common_playlist_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"]        = $prog_playlist_rela->update_user;
		$arr_bind_param[":update_dt"]          = $prog_playlist_rela->update_dt;
		$arr_bind_param[":common_playlist_id"] = $prog_playlist_rela->playlist_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Program list Play list related delete
	 *
	 * @param stdClass	$prog_playlist_rela	Program list Play list related
	 * @return bool							true = success, false = failure
	 */
	public function del_by_prog_id($prog_playlist_rela)
	{
//		if(isset($prog_playlist_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_prog_playlist_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	prog_id = :prog_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $prog_playlist_rela->update_user;
			$arr_bind_param[":update_dt"]   = $prog_playlist_rela->update_dt;
			$arr_bind_param[":prog_id"]     = $prog_playlist_rela->prog_id;
//			$arr_bind_param[":client_id"]   = $prog_playlist_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}