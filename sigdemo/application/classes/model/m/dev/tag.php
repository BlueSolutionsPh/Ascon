<?php if (!defined('SYSPATH')) exit('No direct script access');

class Model_M_Dev_Tag extends Model
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
	 * Terminal tag ID acquisition (existence confirmation)
	 *
	 * @param String	$tag_id		Tag ID
	 * @return array				Acquisition record
	 */
	public function sel_id($tag_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_dev_tag.dev_tag_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev_tag ";
		$query_str .= "where ";
		$arr_bind_param[":dev_tag_id"] = $tag_id;
		if(isset($this->client_id)){
			$query_str .= "	m_dev_tag.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_dev_tag.dev_tag_id = :dev_tag_id and ";
		$query_str .= "	m_dev_tag.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get terminal tag
	 *
	 * @param String	$tag_name		Tag name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($tag_name)
	{
		$query_str = "select ";
		$query_str .= "	m_dev_tag.dev_tag_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev_tag ";
		$query_str .= "where ";
		$query_str .= "	m_dev_tag.dev_tag_name = :tag_name and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_dev_tag.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":tag_name"] = $tag_name;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all terminal tag ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	dev_tag_id, ";
		$query_str .= "	dev_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev_tag ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= " client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	dev_tag_name, ";
		$query_str .= "	dev_tag_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Register terminal tag
	 *
	 * @param stdClass	$dev_tag	Terminal tag
	 * @return bool					true = success, false = failure
	 */
	public function ins($dev_tag)
	{
		if(isset($this->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_dev_tag( ";
			if(isset($dev_tag->dev_tag_id)){
				$query_str .= "		dev_tag_id, ";
			}
			$query_str .= "		client_id, ";
			$query_str .= "		dev_tag_name, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			if(isset($dev_tag->dev_tag_id)){
				$query_str .= "		:dev_tag_id, ";
			}
			$query_str .= "		:client_id, ";
			$query_str .= "		:dev_tag_name, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			if(isset($dev_tag->dev_tag_id)){
				$arr_bind_param[":dev_tag_id"] = $dev_tag->dev_tag_id;
			}
			$arr_bind_param[":client_id"] = $this->client_id;
			$arr_bind_param[":dev_tag_name"] = $dev_tag->dev_tag_name;
			$arr_bind_param[":create_user"] = $dev_tag->create_user;
			$arr_bind_param[":create_dt"] = $dev_tag->create_dt;
			$arr_bind_param[":update_user"] = $dev_tag->update_user;
			$arr_bind_param[":update_dt"] = $dev_tag->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Terminal tag update
	 *
	 * @param stdClass	$dev_tag	Terminal tag
	 * @return bool					true = success, false = failure
	 */
	public function up($dev_tag)
	{
		if(isset($dev_tag->client_id)){
			$query_str = "update ";
			$query_str .= "	m_dev_tag ";
			$query_str .= "set ";
//			$query_str .= "	parent_dev_tag_id = :parent_dev_tag_id, ";
			$query_str .= "	dev_tag_name = :dev_tag_name, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_tag_id = :dev_tag_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
//			$arr_bind_param[":parent_dev_tag_id"] = $dev_tag->parent_dev_tag_id;
			$arr_bind_param[":dev_tag_name"]      = $dev_tag->dev_tag_name;
			$arr_bind_param[":update_user"]       = $dev_tag->update_user;
			$arr_bind_param[":update_dt"]         = $dev_tag->update_dt;
			$arr_bind_param[":dev_tag_id"]        = $dev_tag->dev_tag_id;
			$arr_bind_param[":client_id"]         = $dev_tag->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete device tag
	 *
	 * @param stdClass	$dev_tag	Terminal tag
	 * @return bool					true = success, false = failure
	 */
	public function del($dev_tag)
	{
//		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_dev_tag ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_tag_id = :dev_tag_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $dev_tag->update_user;
			$arr_bind_param[":update_dt"]   = $dev_tag->update_dt;
			$arr_bind_param[":dev_tag_id"]  = $dev_tag->dev_tag_id;
//			$arr_bind_param[":client_id"]   = $this->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Delete device tag
	 *
	 * @param stdClass	$dev_tag	Terminal tag
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($dev_tag)
	{
//		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	m_dev_tag ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $dev_tag->update_user;
			$arr_bind_param[":update_dt"]   = $dev_tag->update_dt;
//			$arr_bind_param[":client_id"]   = $this->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}