<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Accesslog extends Model
{
	public $db;
	public $client_id;
	
	public function __construct($client_id)
	{
		$this->db = Database::instance();
		if($client_id !== false){
			$this->client_id = $client_id;
		} else {
			$this->client_id = null;
		}
	}
	
	/**
	 * 端末を取得
	 *
	 * @param String	$dev_id		端末ID
	 * @return array				取得レコード
	 */
	public function sel_dev($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.client_id, ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		
		$arr_bind_param = array();		
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
}