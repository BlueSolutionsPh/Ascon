<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Dev_Html_Rela extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id = null)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * Terminal HTML related ID acquisition (existence confirmation)
	 *
	 * @param String	$dev_html_rela_id	Terminal HTML related ID
	 * @return array						Acquisition record
	 */
	public function sel_id($dev_html_rela_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_dev_html_rela.dev_html_rela_id = :dev_html_rela_id and ";
		$arr_bind_param[":dev_html_rela_id"] = $dev_html_rela_id;
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition of program guide ID (existence confirmation)
	 *
	 * @param array		$arr_dev_id	Device ID
	 * @param String	$sta_dt		Start date and time
	 * @param String	$end_dt		End date and time
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_by_arr_dev_id_sta_dt_end_dt($arr_dev_id, $sta_dt, $end_dt)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	( ";
		foreach($arr_dev_id as $index => $dev_id){
			if($index > 0){
				$query_str .= "	or ";
			}
			$query_str .= "	t_dev_html_rela.dev_id = :dev_id_" . $index . " ";
			$arr_bind_param[":dev_id_" . $index] = $dev_id;
		}
		$query_str .= "	) and ";
		$query_str .= "	( ";
		$query_str .= "	t_dev_html_rela.sta_dt <= :sta_dt and t_dev_html_rela.end_dt > :sta_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt < :end_dt and t_dev_html_rela.end_dt >= :end_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt >= :sta_dt and t_dev_html_rela.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition of program guide ID (existence confirmation)
	 *
	 * @param array		$arr_dev_id			Device ID
	 * @param String	$sta_dt				Start date and time
	 * @param String	$end_dt				End date and time
	 * @param String	$dev_html_rela_id	Terminal HTML related ID
	 * @return array						Acquisition record
	 */
	public function sel_arr_id_by_arr_dev_id_sta_dt_end_dt_exclude_id($arr_dev_id, $sta_dt, $end_dt, $dev_html_rela_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	( ";
		foreach($arr_dev_id as $index => $dev_id){
			if($index > 0){
				$query_str .= "	or ";
			}
			$query_str .= "	t_dev_html_rela.dev_id = :dev_id_" . $index . " ";
			$arr_bind_param[":dev_id_" . $index] = $dev_id;
		}
		$query_str .= "	) and ";
		$query_str .= "	( ";
		$query_str .= "	t_dev_html_rela.sta_dt <= :sta_dt and t_dev_html_rela.end_dt > :sta_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt < :end_dt and t_dev_html_rela.end_dt >= :end_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt >= :sta_dt and t_dev_html_rela.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id <> :dev_html_rela_id and ";
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";
		$arr_bind_param[":dev_html_rela_id"] = $dev_html_rela_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Primary key numbering
	 *
	 * @return int		Number assigned id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('t_dev_html_rela', 'dev_html_rela_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Terminal HTML related registration
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function ins($dev_html_rela)
	{
		$query_str = "insert into ";
		$query_str .= "	t_dev_html_rela( ";
		$query_str .= "		dev_id, ";
		$query_str .= "		html_id, ";
		$query_str .= "		client_id, ";
		$query_str .= "		dev_html_rela_name, ";
		$query_str .= "		sta_dt, ";
		$query_str .= "		end_dt, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:dev_id,";
		$query_str .= "		:html_id,";
		$query_str .= "		:client_id,";
		$query_str .= "		:dev_html_rela_name, ";
		$query_str .= "		:sta_dt,";
		$query_str .= "		:end_dt,";
		$query_str .= "		:create_user,";
		$query_str .= "		:create_dt,";
		$query_str .= "		:update_user,";
		$query_str .= "		:update_dt";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_html_rela->dev_id;
		$arr_bind_param[":html_id"] = $dev_html_rela->html_id;
		$arr_bind_param[":client_id"] = $dev_html_rela->client_id;
		$arr_bind_param[":dev_html_rela_name"] = $dev_html_rela->dev_html_rela_name;
		$arr_bind_param[":sta_dt"] = $dev_html_rela->sta_dt;
		$arr_bind_param[":end_dt"] = $dev_html_rela->end_dt;
		$arr_bind_param[":create_user"] = $dev_html_rela->create_user;
		$arr_bind_param[":create_dt"] = $dev_html_rela->create_dt;
		$arr_bind_param[":update_user"] = $dev_html_rela->update_user;
		$arr_bind_param[":update_dt"] = $dev_html_rela->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Terminal HTML related delete
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function del($dev_html_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	dev_html_rela_id = :dev_html_rela_id and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $dev_html_rela->update_user;
		$arr_bind_param[":update_dt"] = $dev_html_rela->update_dt;
		$arr_bind_param[":dev_html_rela_id"] = $dev_html_rela->dev_html_rela_id;
//		$arr_bind_param[":client_id"] = $this->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Terminal HTML related delete
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_dev_id_html_id($dev_html_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	dev_id = :dev_id and ";
		$query_str .= "	html_id = :html_id and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $dev_html_rela->update_user;
		$arr_bind_param[":update_dt"] = $dev_html_rela->update_dt;
//		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":dev_id"] = $dev_html_rela->dev_id;
		$arr_bind_param[":html_id"] = $dev_html_rela->html_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Terminal HTML related delete
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_html_id($dev_html_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	html_id = :html_id and ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $dev_html_rela->update_user;
		$arr_bind_param[":update_dt"] = $dev_html_rela->update_dt;
		$arr_bind_param[":html_id"] = $dev_html_rela->html_id;
//		$arr_bind_param[":client_id"] = $this->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Terminal HTML related delete
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_dev_id($dev_html_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
//		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	dev_id = :dev_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $dev_html_rela->update_user;
		$arr_bind_param[":update_dt"] = $dev_html_rela->update_dt;
//		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":dev_id"] = $dev_html_rela->dev_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
}