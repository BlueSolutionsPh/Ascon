<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Text extends Model
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
	 * Acquire text ID (existence confirmation)
	 *
	 * @param String	$text_id	Text ID
	 * @return array				Acquisition record
	 */
	public function sel_id($text_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_text.text_id ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_text.text_id = :text_id and ";
		$arr_bind_param[":text_id"] = $text_id;
		$query_str .= "	m_text.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get text ID from text name
	 *
	 * @param String	$text_name		Text name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($text_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_text.text_id ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_text.text_name = :text_name and ";
		$arr_bind_param[":text_name"] = $text_name;
		$query_str .= "	m_text.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get text ID from text name
	 *
	 * @param String	$text_name		Text name
	 * @param String	$text_id		Text ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($text_name, $text_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_text.text_id ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_text.text_id <> :text_id and ";
		$arr_bind_param[":text_id"] = $text_id;
		$query_str .= "	m_text.text_name = :text_name and ";
		$arr_bind_param[":text_name"] = $text_name;
		$query_str .= "	m_text.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all text ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	text_id, ";
		$query_str .= "	text_name ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	text_name, ";
		$query_str .= "	text_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all texts
	 *
	 * @return array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(text_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
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
	 * Acquire all text items
	 *
	 * @param String	$text_id	Text ID
	 * @return array				Acquisition record
	 */
	public function sel($text_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	text_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	text_name, ";
		$query_str .= "	text_msg, ";
		$query_str .= "	sta_dt, ";
		$query_str .= "	end_dt, ";
		$query_str .= "	property_id, ";
		$query_str .= "	del_flag, ";
		$query_str .= "	create_user, ";
		$query_str .= "	create_dt, ";
		$query_str .= "	update_user, ";
		$query_str .= "	update_dt ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "where ";
		$query_str .= "	text_id = :text_id and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param[":text_id"] = $text_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Text Primary key number assignment
	 *
	 * @return int		Number of assigned text_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_text', 'text_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Text Registration
	 *
	 * @param stdClass	$text	text
	 * @return int				Text_id of registered text
	 */
	public function ins($text)
	{
		if(isset($text->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_text( ";
			$query_str .= "		text_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		text_name, ";
			$query_str .= "		text_msg, ";
			$query_str .= "		sta_dt, ";
			$query_str .= "		end_dt, ";
			$query_str .= "		property_id, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:text_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:text_name, ";
			$query_str .= "		:text_msg, ";
			$query_str .= "		:sta_dt, ";
			$query_str .= "		:end_dt, ";
			$query_str .= "		:property_id, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":text_id"]     = $text->text_id;
			$arr_bind_param[":client_id"]   = $text->client_id;
			$arr_bind_param[":text_name"]   = $text->text_name;
			$arr_bind_param[":text_msg"]    = $text->text_msg;
			$arr_bind_param[":sta_dt"]      = $text->sta_dt;
			$arr_bind_param[":end_dt"]      = $text->end_dt;
			$arr_bind_param[":property_id"] = $text->property_id;
			$arr_bind_param[":create_user"] = $text->create_user;
			$arr_bind_param[":create_dt"]   = $text->create_dt;
			$arr_bind_param[":update_user"] = $text->update_user;
			$arr_bind_param[":update_dt"]   = $text->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Text update
	 *
	 * @param stdClass	$text		text
	 * @return bool					true = success, false = failure
	 */
	public function up($text)
	{
		if(isset($text->client_id)){
			$query_str = "update ";
			$query_str .= "	m_text ";
			$query_str .= "set ";
			$query_str .= "	text_name = :text_name, ";
			$query_str .= "	text_msg = :text_msg, ";
			$query_str .= "	sta_dt = :sta_dt, ";
			$query_str .= "	end_dt = :end_dt, ";
			$query_str .= "	property_id = :property_id, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	text_id = :text_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":text_name"]   = $text->text_name;
			$arr_bind_param[":text_msg"]    = $text->text_msg;
			$arr_bind_param[":sta_dt"]      = $text->sta_dt;
			$arr_bind_param[":end_dt"]      = $text->end_dt;
			$arr_bind_param[":property_id"] = $text->property_id;
			$arr_bind_param[":update_user"] = $text->update_user;
			$arr_bind_param[":update_dt"]   = $text->update_dt;
			$arr_bind_param[":text_id"]     = $text->text_id;
			$arr_bind_param[":client_id"]   = $text->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete text
	 *
	 * @param stdClass	$text		text
	 * @return bool					true = success, false = failure
	 */
	public function del($text)
	{
//		if(isset($text->client_id)){
			$query_str = "update ";
			$query_str .= "	m_text ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	text_id = :text_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $text->update_user;
			$arr_bind_param[":update_dt"]   = $text->update_dt;
			$arr_bind_param[":text_id"]     = $text->text_id;
//			$arr_bind_param[":client_id"]   = $text->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Delete text
	 *
	 * @param stdClass	$text		text
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($text)
	{
		if(isset($text->client_id)){
			$query_str = "update ";
			$query_str .= "	m_text ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $text->update_user;
			$arr_bind_param[":update_dt"]   = $text->update_dt;
			$arr_bind_param[":client_id"]   = $text->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}