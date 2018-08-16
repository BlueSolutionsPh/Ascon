<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Prog_Rgl extends Model
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
	 * Program guide Primary key number assignment
	 *
	 * @return int		Number assigned prog_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('t_prog', 'prog_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Program guide registration
	 *
	 * @param stdClass	$prog_rgl	A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function ins($prog_rgl)
	{
		if(isset($prog_rgl->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_prog_rgl( ";
			$query_str .= "		prog_id, ";
			$query_str .= "		prog_rgl_grp_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		sta_time, ";
			$query_str .= "		end_time, ";
			$query_str .= "		year, ";
			$query_str .= "		month, ";
			$query_str .= "		day, ";
			$query_str .= "		mon, ";
			$query_str .= "		tues, ";
			$query_str .= "		wednes, ";
			$query_str .= "		thurs, ";
			$query_str .= "		fri, ";
			$query_str .= "		satur, ";
			$query_str .= "		sun, ";
			$query_str .= "		priority, ";
			$query_str .= "		col_id, ";
			$query_str .= "		row_id, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:prog_id, ";
			$query_str .= "		:prog_rgl_grp_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:sta_time, ";
			$query_str .= "		:end_time, ";
			$query_str .= "		:year, ";
			$query_str .= "		:month, ";
			$query_str .= "		:day, ";
			$query_str .= "		:mon, ";
			$query_str .= "		:tues, ";
			$query_str .= "		:wednes, ";
			$query_str .= "		:thurs, ";
			$query_str .= "		:fri, ";
			$query_str .= "		:satur, ";
			$query_str .= "		:sun, ";
			$query_str .= "		:priority, ";
			$query_str .= "		:col_id, ";
			$query_str .= "		:row_id, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":prog_id"] = $prog_rgl->prog_id;
			$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl->prog_rgl_grp_id;
			$arr_bind_param[":client_id"] = $prog_rgl->client_id;
			$arr_bind_param[":sta_time"] = $prog_rgl->sta_time;
			$arr_bind_param[":end_time"] = $prog_rgl->end_time;
			$arr_bind_param[":year"] = $prog_rgl->year;
			$arr_bind_param[":month"] = $prog_rgl->month;
			$arr_bind_param[":day"] = $prog_rgl->day;
			$arr_bind_param[":mon"] = $prog_rgl->mon;
			$arr_bind_param[":tues"] = $prog_rgl->tues;
			$arr_bind_param[":wednes"] = $prog_rgl->wednes;
			$arr_bind_param[":thurs"] = $prog_rgl->thurs;
			$arr_bind_param[":fri"] = $prog_rgl->fri;
			$arr_bind_param[":satur"] = $prog_rgl->satur;
			$arr_bind_param[":sun"] = $prog_rgl->sun;
			$arr_bind_param[":priority"] = $prog_rgl->priority;
			$arr_bind_param[":col_id"] = $prog_rgl->col_id;
			$arr_bind_param[":row_id"] = $prog_rgl->row_id;
			$arr_bind_param[":create_user"] = $prog_rgl->create_user;
			$arr_bind_param[":create_dt"] = $prog_rgl->create_dt;
			$arr_bind_param[":update_user"] = $prog_rgl->update_user;
			$arr_bind_param[":update_dt"] = $prog_rgl->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	
	/**
	 * Delivery time update
	 *
	 * @param stdClass	$timezone		Delivery time
	 * @return bool					true = success, false = failure
	 */
	public function up_time($timezone)
	{
		$query_str = "update ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "set ";
		$query_str .= "	sta_time = :sta_time, ";
		$query_str .= "	end_time = :end_time, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	sta_time = :origin_sta_time and ";
		$query_str .= "	end_time = :origin_end_time and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":sta_time"]       = $timezone->sta_time;
		$arr_bind_param[":end_time"]       = $timezone->end_time;
		$arr_bind_param[":origin_sta_time"] = $timezone->origin_sta_time;
		$arr_bind_param[":origin_end_time"] = $timezone->origin_end_time;
		$arr_bind_param[":update_user"]    = $timezone->update_user;
		$arr_bind_param[":update_dt"]      = $timezone->update_dt;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Delete program guide
	 *
	 * @param stdClass	$prog_rgl	A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function del($prog_rgl)
	{
//		if(isset($prog_rgl->client_id)){
			$query_str = "update ";
			$query_str .= "	t_prog_rgl ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	prog_id = :prog_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $prog_rgl->update_user;
			$arr_bind_param[":update_dt"] = $prog_rgl->update_dt;
//			$arr_bind_param[":client_id"] = $prog_rgl->client_id;
			$arr_bind_param[":prog_id"] = $prog_rgl->prog_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}