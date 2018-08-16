<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Movie_Tag_Rela extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id)
	{
		$this->db = $db;
//		$this->client_id = $client_id;
		$this->client_id = null;  // 20180109 hit_update
	}
	
	/**
	 * true = success, false = failure
	 *
	 * @param stdClass	$movie_tag_rela	Movie tag related
	 * @return bool						true = success, false = failure
	 */
	public function ins($movie_tag_rela)
	{
		if(isset($movie_tag_rela->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_movie_tag_rela( ";
			$query_str .= "		movie_id, ";
			$query_str .= "		movie_tag_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:movie_id,";
			$query_str .= "		:movie_tag_id,";
			$query_str .= "		:client_id,";
			$query_str .= "		:create_user,";
			$query_str .= "		:create_dt,";
			$query_str .= "		:update_user,";
			$query_str .= "		:update_dt";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":movie_id"] = $movie_tag_rela->movie_id;
			$arr_bind_param[":movie_tag_id"] = $movie_tag_rela->movie_tag_id;
			$arr_bind_param[":client_id"] = $movie_tag_rela->client_id;
			$arr_bind_param[":create_user"] = $movie_tag_rela->create_user;
			$arr_bind_param[":create_dt"] = $movie_tag_rela->create_dt;
			$arr_bind_param[":update_user"] = $movie_tag_rela->update_user;
			$arr_bind_param[":update_dt"] = $movie_tag_rela->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Movie tag related delete
	 *
	 * @param stdClass	$movie_tag_rela	Movie tag related
	 * @return bool						true = success, false = failure
	 */
	public function del($movie_tag_rela)
	{
//		if(isset($movie_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_movie_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	movie_tag_rela_id = :movie_tag_rela_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $movie_tag_rela->update_user;
			$arr_bind_param[":update_dt"] = $movie_tag_rela->update_dt;
			$arr_bind_param[":movie_tag_rela_id"] = $movie_tag_rela->movie_tag_rela_id;
//			$arr_bind_param[":client_id"] = $movie_tag_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Movie tag related delete
	 *
	 * @param stdClass	$movie_tag_rela	Movie tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_movie_id($movie_tag_rela)
	{
//		if(isset($movie_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_movie_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	movie_id = :movie_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $movie_tag_rela->update_user;
			$arr_bind_param[":update_dt"] = $movie_tag_rela->update_dt;
			$arr_bind_param[":movie_id"] = $movie_tag_rela->movie_id;
//			$arr_bind_param[":client_id"] = $movie_tag_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Movie tag related delete
	 *
	 * @param stdClass	$movie_tag_rela	Movie tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_movie_id_movie_tag_id($movie_tag_rela)
	{
//		if(isset($movie_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_movie_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	movie_id = :movie_id and ";
			$query_str .= "	movie_tag_id = :movie_tag_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"]  = $movie_tag_rela->update_user;
			$arr_bind_param[":update_dt"]    = $movie_tag_rela->update_dt;
			$arr_bind_param[":movie_id"]     = $movie_tag_rela->movie_id;
			$arr_bind_param[":movie_tag_id"] = $movie_tag_rela->movie_tag_id;
//			$arr_bind_param[":client_id"]    = $movie_tag_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Movie tag related delete
	 *
	 * @param stdClass	$movie_tag_rela	Movie tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_client_id($movie_tag_rela)
	{
		if(isset($movie_tag_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_movie_tag_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $movie_tag_rela->update_user;
			$arr_bind_param[":update_dt"]   = $movie_tag_rela->update_dt;
			$arr_bind_param[":client_id"]   = $movie_tag_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}