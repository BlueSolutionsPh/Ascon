<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Playlist_Rela extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id = null)
	{
		$this->db = $db;
//		$this->client_id = $client_id;
		$this->client_id = null;  // 20180109 hit_update
	}
	
	
	
	/**
	 * Acquire all play list linked ID list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name_playlist_rela($playlist)
	{
		$query_str = "select ";
		$query_str .= "	playlist_rela_id, ";
		$query_str .= "	common_playlist_id, ";
		$query_str .= "	playlist_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	sex_id, ";
		$query_str .= "	timezone_id, ";
		$query_str .= "	deliverymonth_id, ";
		$query_str .= "	sta_dt, ";
		$query_str .= "	end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_rela ";
		$query_str .= "where ";
		if(isset($playlist->playlist_id) && $playlist->playlistid !== ""){
			$query_str .= "	playlist_id = :playlist_id and ";
		}
		if(isset($playlist->common_playlist_id) && $playlist->common_playlist_id !== ""){
			$query_str .= "	common_playlist_id = :common_playlist_id and ";
		}
		if(isset($playlist->extra_flg) && $playlist->extra_flg !== ""){
			$query_str .= "	common_playlist_id IS NOT NULL and ";
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	client_id, ";
		$query_str .= "	playlist_id desc ";
		
		$arr_bind_param = array();
		if(isset($playlist->playlist_id) && $playlist->playlistid !== ""){
			$arr_bind_param[":playlist_id"] = $playlist->playlist_id;
		}
		if(isset($playlist->common_playlist_id) && $playlist->common_playlist_id !== ""){
			$arr_bind_param[":common_playlist_id"] = $playlist->common_playlist_id;
		}
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get playlist cooperation count
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_cnt_playlist_rela($search)
	{
		//Search condition
		$now = Request::$request_dt;
		
		if(isset($search->playlistid) && $search->playlistid !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->common_playlist_id) && $search->common_playlist_id !== ""){
			$common_playlist_id = $search->common_playlist_id;
		}
		if(isset($search->client_id) && $search->client_id !== ""){
			$client_id = $search->client_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->timezone_id) && $search->timezone_id !== ""){
			$timezone_id = $search->timezone_id;
		}
		if(isset($search->deliverymonth_id) && $search->deliverymonth_id !== ""){
			$deliverymonth_id = $search->deliverymonth_id;
		}
		
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(playlist.playlist_rela_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	t_playlist_rela.playlist_rela_id ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_rela ";
		$query_str .= "where ";
	
		//Add search condition (playlist ID)
		if(isset($playlistid)){
			$query_str .= "	t_playlist_rela.playlistid = :playlistid and ";
			$arr_bind_param[":playlistid"] = $playlistid;
		}
		//Add search condition (common playlist ID)
		if(isset($common_playlist_id)){
			$query_str .= "	t_playlist_rela.common_playlist_id = :common_playlist_id and ";
			$arr_bind_param[":common_playlist_id"] = $common_playlist_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	t_playlist_rela.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}
		//Add search condition (distribution time zone)
		if(isset($timezone_id)){
			$query_str .= "	t_playlist_rela.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $timezone_id;
		}
		//Search condition (distribution month) added
		if(isset($deliverymonth_id)){
			$query_str .= "	t_playlist_rela.deliverymonth_id = :deliverymonth_id and ";
			$arr_bind_param[":deliverymonth_id"] = $deliverymonth_id;
		}
		if(isset($client_id)){
			$query_str .= "	t_playlist_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $client_id;
		}
		$query_str .= "	t_playlist_rela.del__flag = 0 ";
		$query_str .= ") playlist ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get playlist list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_arr_playlist_rela($search)
	{
		//Search condition
		$now = Request::$request_dt;
		
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			$playlist_id = $search->playlist_id;
		}
		if(isset($search->common_playlist_id) && $search->common_playlist_id !== ""){
			$common_playlist_id = $search->common_playlist_id;
		}
		if(isset($search->client_id) && $search->client_id !== ""){
			$client_id = $search->client_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->timezone_id) && $search->timezone_id !== ""){
			$timezone_id = $search->timezone_id;
		}
		if(isset($search->deliverymonth_id) && $search->deliverymonth_id !== ""){
			$deliverymonth_id = $search->deliverymonth_id;
		}
		
		$offset = $search->offset;
		$arr_bind_param = array();
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;
		if(isset($search->sta_dt) && $search->sta_dt !== ""){
			$sta_dt = $search->sta_dt . " 00:00:00";
		}
		if(isset($search->end_dt) && $search->end_dt !== ""){
			$end_dt = $search->end_dt . " 23:59:59";
		}
		
		$query_str = "select ";
		$query_str .= "	playlist_rela_id, ";
		$query_str .= "	common_playlist_id, ";
		$query_str .= "	playlist_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	sex_id, ";
		$query_str .= "	timezone_id, ";
		$query_str .= "	deliverymonth_id, ";
		$query_str .= "	sta_dt, ";
		$query_str .= "	end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_rela ";
		$query_str .= "where ";
		
		if(!empty($sta_dt) && $sta_dt !== ""){
			$query_str .= "	sta_dt <= :end_dt and ";
			$query_str .= "	(end_dt > :sta_dt or end_dt is null) and ";
			
			$arr_bind_param[":sta_dt"] = $sta_dt;
			$arr_bind_param[":end_dt"] = $end_dt;
		}
		// Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}
		// Add search condition (distribution time zone)
		if(isset($timezone_id)){
			$query_str .= "	timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $timezone_id;
		}
		// Search condition (distribution month) added
		if(isset($deliverymonth_id)){
			$query_str .= "	deliverymonth_id = :deliverymonth_id and ";
			$arr_bind_param[":deliverymonth_id"] = $deliverymonth_id;
		}
		// Add search condition (client ID)
		if(isset($client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $client_id;
		}
		if(isset($playlist_id)){
			$query_str .= "	playlist_id <> :playlist_id and ";
			$arr_bind_param[":playlist_id"] = $playlist_id;
		} 
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	playlist_rela_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Client cooperation registration
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function ins($playlist)
	{
		$query_str = "insert into ";
		$query_str .= "	t_playlist_rela( ";
		$query_str .= "		playlist_rela_id, ";
		$query_str .= "		common_playlist_id, ";
		$query_str .= "		playlist_id, ";
		$query_str .= "		client_id, ";
		$query_str .= "		sex_id, ";
		$query_str .= "		timezone_id, ";
		$query_str .= "		deliverymonth_id, ";
		$query_str .= "		sta_dt, ";
		$query_str .= "		end_dt, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:playlist_rela_id, ";
		$query_str .= "		:common_playlist_id, ";
		$query_str .= "		:playlist_id, ";
		$query_str .= "		:client_id, ";
		$query_str .= "		:sex_id, ";
		$query_str .= "		:timezone_id, ";
		$query_str .= "		:deliverymonth_id, ";
		$query_str .= "		:sta_dt, ";
		$query_str .= "		:end_dt, ";
		$query_str .= "		:create_user, ";
		$query_str .= "		:create_dt, ";
		$query_str .= "		:update_user, ";
		$query_str .= "		:update_dt ";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":playlist_rela_id"]   = $playlist->playlist_rela_id;
		$arr_bind_param[":common_playlist_id"] = $playlist->common_playlist_id;
		$arr_bind_param[":playlist_id"]        = $playlist->playlist_id;
		$arr_bind_param[":client_id"]          = $playlist->client_id;
		$arr_bind_param[":sex_id"]             = $playlist->sex_id;
		$arr_bind_param[":timezone_id"]        = $playlist->timezone_id;
		$arr_bind_param[":deliverymonth_id"]   = $playlist->deliverymonth_id;
		$arr_bind_param[":sta_dt"]             = $playlist->sta_dt;
		$arr_bind_param[":end_dt"]             = $playlist->end_dt;
		$arr_bind_param[":create_user"]        = $playlist->create_user;
		$arr_bind_param[":create_dt"]          = $playlist->create_dt;
		$arr_bind_param[":update_user"]        = $playlist->update_user;
		$arr_bind_param[":update_dt"]          = $playlist->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Primary key numbering
	 *
	 * @return int		The assigned dev_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('t_playlist_rela', 'playlist_rela_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	
	/**
	 * Delete playlist collaboration
	 *
	 * @param stdClass	$playlist_rela	Playlist cooperation
	 * @return bool					true = success, false = failure
	 */
	public function del($playlist_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_playlist_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	playlist_id = :playlist_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"]      = $playlist_rela->update_user;
		$arr_bind_param[":update_dt"]        = $playlist_rela->update_dt;
		$arr_bind_param[":playlist_id"]      = $playlist_rela->playlist_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	
	/**
	 * Playlist related delete
	 *
	 * @param stdClass	$playlist_rela	playlist
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($playlist_rela)
	{
		if(isset($playlist_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_playlist_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $playlist_rela->update_user;
			$arr_bind_param[":update_dt"]   = $playlist_rela->update_dt;
			$arr_bind_param[":client_id"]   = $playlist_rela->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}
