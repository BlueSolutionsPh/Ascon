<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Html extends Model
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
	 * Acquire HTMLID (existence confirmation)
	 *
	 * @param String	$html_id	HTMLID
	 * @return array				Acquisition record
	 */
	public function sel_id($html_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_html.html_id ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_html.html_id = :html_id and ";
		$arr_bind_param[":html_id"] = $html_id;
		$query_str .= "	m_html.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get HTMLID from HTML name
	 *
	 * @param String	$html_name		HTML name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($html_name)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_html.html_id ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_html.html_name = :html_name and ";
		$arr_bind_param[":html_name"] = $html_name;
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get HTMLID from HTML name
	 *
	 * @param String	$html_name		HTML name
	 * @param String	$html_id		HTMLID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($html_name, $html_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_html.html_id ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_html.html_id <> :html_id and ";
		$arr_bind_param[":html_id"] = $html_id;
		$query_str .= "	m_html.html_name = :html_name and ";
		$arr_bind_param[":html_name"] = $html_name;
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get all HTMLID, name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	html_id, ";
		$query_str .= "	html_name ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	html_name, ";
		$query_str .= "	html_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all HTML number
	 *
	 * @return array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(html_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
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
	 * HTML primary key number assignment
	 *
	 * @return int		Number assigned html_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_html', 'html_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * HTML registration
	 *
	 * @param stdClass	$html		HTML
	 * @return bool					true = success, false = failure
	 */
	public function ins($html)
	{
		if(isset($html->client_id)){
			$query_str = "insert into ";
			$query_str .= "	m_html( ";
			$query_str .= "		html_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		html_name, ";
			$query_str .= "		orig_file_dir, ";
			$query_str .= "		file_name, ";
			$query_str .= "		orig_file_name, ";
			$query_str .= "		orig_file_exte, ";
			$query_str .= "		orig_file_size, ";
			$query_str .= "		orig_hash, ";
			$query_str .= "		sta_dt, ";
			$query_str .= "		end_dt, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:html_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:html_name, ";
			$query_str .= "		:orig_file_dir, ";
			$query_str .= "		:file_name, ";
			$query_str .= "		:orig_file_name, ";
			$query_str .= "		:orig_file_exte, ";
			$query_str .= "		:orig_file_size, ";
			$query_str .= "		:orig_hash, ";
			$query_str .= "		:sta_dt, ";
			$query_str .= "		:end_dt, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":html_id"]        = $html->html_id;
			$arr_bind_param[":client_id"]      = $html->client_id;
			$arr_bind_param[":html_name"]      = $html->html_name;
			$arr_bind_param[":orig_file_dir"]  = $html->orig_file_dir;
			$arr_bind_param[":file_name"]      = $html->file_name;
			$arr_bind_param[":orig_file_name"] = $html->orig_file_name;
			$arr_bind_param[":orig_file_exte"] = $html->orig_file_exte;
			$arr_bind_param[":orig_file_size"] = $html->orig_file_size;
			$arr_bind_param[":orig_hash"]      = $html->orig_hash;
			$arr_bind_param[":sta_dt"]         = $html->sta_dt;
			$arr_bind_param[":end_dt"]         = $html->end_dt;
			$arr_bind_param[":create_user"]    = $html->create_user;
			$arr_bind_param[":create_dt"]      = $html->create_dt;
			$arr_bind_param[":update_user"]    = $html->update_user;
			$arr_bind_param[":update_dt"]      = $html->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * HTML update
	 *
	 * @param stdClass	$html		HTML
	 * @return bool					true = success, false = failure
	 */
	public function up($html)
	{
		if(isset($html->client_id)){
			$query_str = "update ";
			$query_str .= "	m_html ";
			$query_str .= "set ";
			$query_str .= "	html_name = :html_name, ";
			$query_str .= "	sta_dt = :sta_dt, ";
			$query_str .= "	end_dt = :end_dt, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	html_id = :html_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":html_name"]   = $html->html_name;
			$arr_bind_param[":sta_dt"]      = $html->sta_dt;
			$arr_bind_param[":end_dt"]      = $html->end_dt;
			$arr_bind_param[":update_user"] = $html->update_user;
			$arr_bind_param[":update_dt"]   = $html->update_dt;
			$arr_bind_param[":html_id"]     = $html->html_id;
			$arr_bind_param[":client_id"]   = $html->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete HTML
	 *
	 * @param stdClass	$html		HTML
	 * @return bool					true = success, false = failure
	 */
	public function del($html)
	{
//		if(isset($html->client_id)){
			$query_str = "update ";
			$query_str .= "	m_html ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	html_id = :html_id and ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $html->update_user;
			$arr_bind_param[":update_dt"]   = $html->update_dt;
			$arr_bind_param[":html_id"]     = $html->html_id;
//			$arr_bind_param[":client_id"]   = $html->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
	
	/**
	 * Delete HTML
	 *
	 * @param stdClass	$html		HTML
	 * @return bool					true = success, false = failure
	 */
	public function del_by_client_id($html)
	{
		if(isset($html->client_id)){
			$query_str = "update ";
			$query_str .= "	m_html ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $html->update_user;
			$arr_bind_param[":update_dt"]   = $html->update_dt;
			$arr_bind_param[":client_id"]   = $html->client_id;
	
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}