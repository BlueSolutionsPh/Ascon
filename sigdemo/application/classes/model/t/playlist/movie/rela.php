<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Playlist_Movie_Rela extends Model
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
	 * Playlist Movie Related Registration
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist Video related
	 * @return bool								true = success, false = failure
	 */
	public function ins($playlist_movie_rela)
	{
		$query_str = "insert into ";
		$query_str .= "	t_playlist_movie_rela( ";
		$query_str .= "		playlist_id, ";
		$query_str .= "		playlist_rela_id, ";
		$query_str .= "		movie_id, ";
		$query_str .= "		draw_area_id, ";
		$query_str .= "		client_id, ";
		$query_str .= "		display_order, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:playlist_id,";
		$query_str .= "		:playlist_rela_id,";
		$query_str .= "		:movie_id,";
		$query_str .= "		:draw_area_id,";
		$query_str .= "		:client_id,";
		$query_str .= "		:display_order,";
		$query_str .= "		:create_user,";
		$query_str .= "		:create_dt,";
		$query_str .= "		:update_user,";
		$query_str .= "		:update_dt";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":playlist_id"]      = $playlist_movie_rela->playlist_id;
		$arr_bind_param[":playlist_rela_id"] = $playlist_movie_rela->playlist_rela_id;
		$arr_bind_param[":movie_id"]         = $playlist_movie_rela->movie_id;
		$arr_bind_param[":draw_area_id"]     = $playlist_movie_rela->draw_area_id;
		$arr_bind_param[":client_id"]        = $playlist_movie_rela->client_id;
		$arr_bind_param[":display_order"]    = $playlist_movie_rela->display_order;
		$arr_bind_param[":create_user"]      = $playlist_movie_rela->create_user;
		$arr_bind_param[":create_dt"]        = $playlist_movie_rela->create_dt;
		$arr_bind_param[":update_user"]      = $playlist_movie_rela->update_user;
		$arr_bind_param[":update_dt"]        = $playlist_movie_rela->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Video Playlist Related Delete
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist Video related
	 * @return bool								true = success, false = failure
	 */
	public function del_by_playlist_id_movie_id_draw_area_id_display_order($playlist_movie_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	playlist_id = :playlist_id and ";
		$query_str .= "	movie_id = :movie_id and ";
		$query_str .= "	draw_area_id = :draw_area_id and ";
		$query_str .= "	display_order = :display_order and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"]   = $playlist_movie_rela->update_user;
		$arr_bind_param[":update_dt"]     = $playlist_movie_rela->update_dt;
		$arr_bind_param[":playlist_id"]   = $playlist_movie_rela->playlist_id;
		$arr_bind_param[":movie_id"]      = $playlist_movie_rela->movie_id;
		$arr_bind_param[":draw_area_id"]  = $playlist_movie_rela->draw_area_id;
		$arr_bind_param[":display_order"] = $playlist_movie_rela->display_order;
//		$arr_bind_param[":client_id"]     = $playlist_movie_rela->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Video Playlist Related Delete
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist Video related
	 * @return bool								true = success, false = failure
	 */
	public function del_by_movie_id($playlist_movie_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	movie_id = :movie_id and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $playlist_movie_rela->update_user;
		$arr_bind_param[":update_dt"]   = $playlist_movie_rela->update_dt;
		$arr_bind_param[":movie_id"]    = $playlist_movie_rela->movie_id;
//		$arr_bind_param[":client_id"]   = $playlist_movie_rela->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Video Playlist Related Delete
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist Video related
	 * @return bool								true = success, false = failure
	 */
	public function del_by_playlist_id($playlist_movie_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	playlist_id = :playlist_id and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $playlist_movie_rela->update_user;
		$arr_bind_param[":update_dt"]   = $playlist_movie_rela->update_dt;
		$arr_bind_param[":playlist_id"] = $playlist_movie_rela->playlist_id;
//		$arr_bind_param[":client_id"]   = $playlist_movie_rela->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Video Playlist Related Delete
	 *
	 * @param stdClass	$playlist_movie_rela	Playlist Video related
	 * @return bool								true = success, false = failure
	 */
	public function del_by_client_id($playlist_movie_rela)
	{
		if(isset($playlist_movie_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_playlist_movie_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $playlist_movie_rela->update_user;
			$arr_bind_param[":update_dt"]   = $playlist_movie_rela->update_dt;
			$arr_bind_param[":client_id"]   = $playlist_movie_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	
	/**
	 * Get playlist _ Video collaboration DB list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name_playlist_movie_rela($playlist_movie_rela)
	{
		$bindArr = array();
		
		$query_str = "select ";
		$query_str .= "	playlist_movie_rela_id, ";
		$query_str .= "	playlist_id, ";
		$query_str .= "	movie_id, ";
		$query_str .= "	draw_area_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	display_order ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "where ";
		if(isset($playlist_movie_rela->playlist_id) && $playlist_movie_rela->playlist_id !== ""){
			$query_str .= " playlist_id = :playlist_id and ";
			$bindArr[":playlist_id"] = $playlist_movie_rela->playlist_id;
		}
		if(isset($playlist_movie_rela->playlist_rela_id) && $playlist_movie_rela->playlist_rela_id !== ""){
			$query_str .= " playlist_rela_id = :playlist_rela_id and ";
			$bindArr[":playlist_rela_id"] = $playlist_movie_rela->playlist_rela_id;
		} else {
			$query_str .= " playlist_rela_id is NULL and ";
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	playlist_id, ";
 		$query_str .= "	display_order desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($bindArr);
		return $query->execute($this->db, true);
	}
}