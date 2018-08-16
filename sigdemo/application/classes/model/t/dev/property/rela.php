<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Dev_Property_Rela extends Model
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
	 * Terminal attribute related registration
	 *
	 * @param stdClass	$dev_property_rela	Terminal attribute related
	 * @return bool						true = success, false = failure
	 */
	public function ins($dev_property_rela)
	{
		if(isset($dev_property_rela->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_dev_property_rela( ";
			$query_str .= "		dev_id, ";
			$query_str .= "		property_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:dev_id, ";
			$query_str .= "		:property_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":dev_id"] = $dev_property_rela->dev_id;
			$arr_bind_param[":property_id"] = $dev_property_rela->property_id;
			$arr_bind_param[":client_id"] = $this->client_id;
			$arr_bind_param[":create_user"] = $dev_property_rela->create_user;
			$arr_bind_param[":create_dt"] = $dev_property_rela->create_dt;
			$arr_bind_param[":update_user"] = $dev_property_rela->update_user;
			$arr_bind_param[":update_dt"] = $dev_property_rela->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Terminal attribute relation delete
	 *
	 * @param String	$dev_property_rela	Terminal attribute related
	 * @return bool						true = success, false = failure
	 */
	public function del($dev_property_rela)
	{
//		if(isset($dev_property_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_dev_property_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_property_rela_id = :dev_property_rela_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $dev_property_rela->update_user;
			$arr_bind_param[":update_dt"] = $dev_property_rela->update_dt;
			$arr_bind_param[":dev_property_rela_id"] = $dev_property_rela->dev_property_rela_id;
//			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Terminal attribute relation delete
	 *
	 * @param String	$dev_property_rela	Terminal attribute related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_dev_id($dev_property_rela)
	{
//		if(isset($dev_property_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_dev_property_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_id = :dev_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $dev_property_rela->update_user;
			$arr_bind_param[":update_dt"] = $dev_property_rela->update_dt;
			$arr_bind_param[":dev_id"] = $dev_property_rela->dev_id;
//			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Terminal attribute relation delete
	 *
	 * @param String	$dev_property_rela	Terminal attribute related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_dev_id_property_id($dev_property_rela)
	{
//		if(isset($dev_property_rela->client_id)){
			$query_str = "update ";
			$query_str .= "	t_dev_property_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	dev_id = :dev_id and ";
			$query_str .= "	property_id = :property_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $dev_property_rela->update_user;
			$arr_bind_param[":update_dt"] = $dev_property_rela->update_dt;
			$arr_bind_param[":dev_id"] = $dev_property_rela->dev_id;
			$arr_bind_param[":property_id"] = $dev_property_rela->property_id;
//			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}