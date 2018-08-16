<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Playlist extends Model
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
	 * Acquire playlist ID (existence confirmation)
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @return array					Acquisition record
	 */
	public function sel_id($playlist_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_playlist.playlist_id = :playlist_id and ";
		$arr_bind_param[":playlist_id"] = $playlist_id;
		$query_str .= "	t_playlist.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get playlist ID from playlist name
	 *
	 * @param String	$playlist_name	Playlist name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($playlist_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_playlist.playlist_name = :playlist_name and ";
		$arr_bind_param[":playlist_name"] = $playlist_name;
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get playlist ID from playlist name
	 *
	 * @param String	$playlist_name		Playlist name
	 * @param String	$playlist_id		Playlist ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($playlist_name, $playlist_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_playlist.playlist_id <> :playlist_id and ";
		$arr_bind_param[":playlist_id"] = $playlist_id;
		$query_str .= "	t_playlist.playlist_name = :playlist_name and ";
		$arr_bind_param[":playlist_name"] = $playlist_name;
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all playlist ID and name list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name($ants_version = null)
	{
		$arr_bind_param = array();
		$query_str = "select ";
//		if(!isset($this->client_id)){
			$query_str .= "	m_client.client_id, ";
			$query_str .= "	m_client.client_name, ";
//		}
		$query_str .= "	t_playlist.ants_version, ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.sex_id, ";
		$query_str .= "	t_playlist.deliverymonth_id, ";
		$query_str .= "	t_playlist.sta_dt, ";
		$query_str .= "	t_playlist.end_dt, ";
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.client_id = m_client.client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_timezone ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";

		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= " t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " t_playlist.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		if(!isset($this->client_id)){
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.playlist_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all playlist count
	 *
	 * @return	array				Acquisition record
	 */
	function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(t_playlist.playlist_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= " client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_playlist.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	
	/**
	 * Playlist primary key numbering
	 *
	 * @return int		Number assigned playlist_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('t_playlist', 'playlist_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Playlist registration
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function ins($playlist)
	{
//		if(isset($playlist->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_playlist( ";
			$query_str .= "		playlist_id, ";
			$query_str .= "		draw_tmpl_id, ";
			if(isset($playlist->client_id)){
				$query_str .= "		client_id, ";
			}
			$query_str .= "		playlist_name, ";
			$query_str .= "		playlist_desc, ";
			$query_str .= "		image_intvl, ";
			$query_str .= "		random_flag, ";
			$query_str .= "		ants_version, ";
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
			$query_str .= "		:playlist_id, ";
			$query_str .= "		:draw_tmpl_id, ";
			if(isset($playlist->client_id)){
				$query_str .= "		:client_id, ";
			}
			$query_str .= "		:playlist_name, ";
			$query_str .= "		:playlist_desc, ";
			$query_str .= "		:image_intvl, ";
			$query_str .= "		:random_flag, ";
			$query_str .= "		:ants_version, ";
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
			$arr_bind_param[":playlist_id"] = $playlist->playlist_id;
			$arr_bind_param[":draw_tmpl_id"] = $playlist->draw_tmpl_id;
			if(isset($playlist->client_id)){
				$arr_bind_param[":client_id"] = $playlist->client_id;
			}
			$arr_bind_param[":playlist_name"] = $playlist->playlist_name;
			$arr_bind_param[":playlist_desc"] = $playlist->playlist_desc;
			$arr_bind_param[":image_intvl"] = $playlist->image_intvl;
			$arr_bind_param[":random_flag"] = $playlist->random_flag;
			$arr_bind_param[":ants_version"] = $playlist->ants_version;
			$arr_bind_param[":sex_id"] = $playlist->sex_id;
			$arr_bind_param[":timezone_id"] = $playlist->timezone_id;
			$arr_bind_param[":deliverymonth_id"] = $playlist->deliverymonth_id;
			$arr_bind_param[":sta_dt"] = $playlist->sta_dt;
			$arr_bind_param[":end_dt"] = $playlist->end_dt;
			$arr_bind_param[":ants_version"] = $playlist->ants_version;
			$arr_bind_param[":create_user"] = $playlist->create_user;
			$arr_bind_param[":create_dt"] = $playlist->create_dt;
			$arr_bind_param[":update_user"] = $playlist->update_user;
			$arr_bind_param[":update_dt"] = $playlist->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Update playlist
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function up($playlist)
	{
//		if(isset($playlist->client_id)){
			$query_str = "update ";
			$query_str .= "	t_playlist ";
			$query_str .= "set ";
			$query_str .= "	playlist_name = :playlist_name, ";
			$query_str .= "	playlist_desc = :playlist_desc, ";
			$query_str .= "	client_id = :client_id, ";
			$query_str .= "	image_intvl = :image_intvl, ";
			$query_str .= "	random_flag = :random_flag, ";
			$query_str .= "	sex_id = :sex_id, ";
			$query_str .= "	timezone_id = :timezone_id, ";
			$query_str .= "	deliverymonth_id = :deliverymonth_id, ";
			$query_str .= "	sta_dt = :sta_dt, ";
			$query_str .= "	end_dt = :end_dt, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	playlist_id = :playlist_id and ";
			$query_str .= "	del_flag = 0";
			
			$arr_bind_param = array();
			$arr_bind_param[":playlist_name"] = $playlist->playlist_name;
			$arr_bind_param[":playlist_desc"] = $playlist->playlist_desc;
			$arr_bind_param[":image_intvl"] = $playlist->image_intvl;
			$arr_bind_param[":random_flag"] = $playlist->random_flag;
			$arr_bind_param[":sex_id"] = $playlist->sex_id;
			$arr_bind_param[":timezone_id"] = $playlist->timezone_id;
			$arr_bind_param[":deliverymonth_id"] = $playlist->deliverymonth_id;
			$arr_bind_param[":sta_dt"] = $playlist->sta_dt;
			$arr_bind_param[":end_dt"] = $playlist->end_dt;
			$arr_bind_param[":update_user"] = $playlist->update_user;
			$arr_bind_param[":update_dt"] = $playlist->update_dt;
			$arr_bind_param[":playlist_id"] = $playlist->playlist_id;
			$arr_bind_param[":client_id"] = $playlist->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Delete Playlist
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function del($playlist)
	{
//		if(isset($playlist->client_id)){
			$query_str = "update ";
			$query_str .= "	t_playlist ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	playlist_id = :playlist_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $playlist->update_user;
			$arr_bind_param[":update_dt"]   = $playlist->update_dt;
			$arr_bind_param[":playlist_id"] = $playlist->playlist_id;
//			$arr_bind_param[":client_id"]   = $playlist->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Delete Playlist
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($playlist)
	{
		if(isset($playlist->client_id)){
			$query_str = "update ";
			$query_str .= "	t_playlist ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $playlist->update_user;
			$arr_bind_param[":update_dt"]   = $playlist->update_dt;
			$arr_bind_param[":client_id"]   = $playlist->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}