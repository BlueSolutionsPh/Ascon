<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Shop extends Model
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
	 * Retrieve store ID from shop name
	 *
	 * @param String	$shop_name		Store name
 	 * @return array					Acquisition recordRetrieve store ID from shop name
	 */
	public function sel_arr_id_by_name($shop_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_shop.shop_id ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_shop.shop_name = :shop_name and ";
		$arr_bind_param[":shop_name"] = $shop_name;
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Retrieve store ID from shop name
	 *
	 * @param String	$shop_name		Store name
	 * @param String	$shop_id		Store ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($shop_name, $shop_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_shop.shop_id ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_shop.shop_id <> :shop_id and ";
		$query_str .= "	m_shop.shop_name = :shop_name and ";
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param[":shop_name"] = $shop_name;
		$arr_bind_param[":shop_id"] = $shop_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Retrieve all shop ID and name lists
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	shop_id, ";
		$query_str .= "	shop_name, ";
		$query_str .= "	client_id ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	shop_name, ";
		$query_str .= "	shop_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition of all stores
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(shop_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Store ID acquisition (existence confirmation)
	 *
	 * @param String	$shop_id	Store ID
	 * @return array				Acquisition record
	 */
	public function sel_id($shop_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_shop.shop_id ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_shop.shop_id = :shop_id and ";
		$query_str .= "	m_shop.del_flag = 0 ";
		
		$arr_bind_param[":shop_id"] = $shop_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Store primary key number
	 *
	 * @return int		Number assigned shop_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_shop', 'shop_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Store registration
	 *
	 * @param stdClass	$shop		Store
	 * @return bool					true = success, false = failure
	 */
	public function ins($shop)
	{
		if(isset($shop->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_shop( ";
			$query_str .= "		shop_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		shop_name, ";
			$query_str .= "	    sta_t, ";
			$query_str .= "	    end_t, ";
			$query_str .= "		note, ";
			$query_str .= "		post, ";
			$query_str .= "		address, ";
			$query_str .= "		lat, ";
			$query_str .= "		lon, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:shop_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:shop_name, ";
			$query_str .= "		:sta_t, ";
			$query_str .= "		:end_t, ";
			$query_str .= "		:note, ";
			$query_str .= "		:post, ";
			$query_str .= "		:address, ";
			$query_str .= "		:lat, ";
			$query_str .= "		:lon, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":shop_id"]     = $shop->shop_id;
			$arr_bind_param[":client_id"]   = $shop->client_id;
			$arr_bind_param[":shop_name"]   = $shop->shop_name;
			$arr_bind_param[":sta_t"]       = $shop->sta_t;
			$arr_bind_param[":end_t"]       = $shop->end_t;
			$arr_bind_param[":note"]        = $shop->note;
			$arr_bind_param[":post"]        = $shop->post;
			$arr_bind_param[":address"]     = $shop->address;
			$arr_bind_param[":lat"]         = $shop->lat;
			$arr_bind_param[":lon"]         = $shop->lon;
			$arr_bind_param[":create_user"] = $shop->create_user;
			$arr_bind_param[":create_dt"]   = $shop->create_dt;
			$arr_bind_param[":update_user"] = $shop->update_user;
			$arr_bind_param[":update_dt"]   = $shop->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Store update
	 *
	 * @param stdClass	$shop		Store
	 * @return bool					true = success, false = failure
	 */
	public function up($shop)
	{
		if(isset($shop->client_id)){
			$query_str = "update ";
			$query_str .= "	m_shop ";
			$query_str .= "set ";
			$query_str .= "	shop_name = :shop_name, ";
			$query_str .= "	client_id = :client_id, ";
//			$query_str .= "	sta_t = :sta_t, ";
//			$query_str .= "	end_t = :end_t, ";
//			$query_str .= "	note = :note, ";
            $query_str .= "	post = :post, ";
			$query_str .= "	address = :address, ";
			$query_str .= "	lat = :lat, ";
			$query_str .= "	lon = :lon, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	shop_id = :shop_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":shop_name"]   = $shop->shop_name;
			$arr_bind_param[":client_id"]   = $shop->client_id;
//			$arr_bind_param[":sta_t"]       = $shop->sta_t;
//			$arr_bind_param[":end_t"]       = $shop->end_t;
//			$arr_bind_param[":note"]        = $shop->note;
			$arr_bind_param[":post"]        = $shop->post;
			$arr_bind_param[":address"]     = $shop->address;
			$arr_bind_param[":lat"]         = $shop->lat;
			$arr_bind_param[":lon"]         = $shop->lon;
			$arr_bind_param[":update_user"] = $shop->update_user;
			$arr_bind_param[":update_dt"]   = $shop->update_dt;
			$arr_bind_param[":shop_id"]     = $shop->shop_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete store
	 *
	 * @param stdClass	$shop		Store
	 * @return bool					true = success, false = failure
	 */
	public function del($shop)
	{
//		if(isset($shop->client_id)){
			$query_str = "update ";
			$query_str .= "	m_shop ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	shop_id = :shop_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $shop->update_user;
			$arr_bind_param[":update_dt"]   = $shop->update_dt;
//			$arr_bind_param[":client_id"]   = $shop->client_id;
			$arr_bind_param[":shop_id"]     = $shop->shop_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}
