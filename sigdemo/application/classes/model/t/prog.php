<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Prog extends Model
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
	 * Acquisition of program guide ID (existence confirmation)
	 *
	 * @param String	$prog_id	Program guide ID
	 * @return array				Acquisition record
	 */
	public function sel_id($prog_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_prog.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_prog.prog_id = :prog_id and ";
		$arr_bind_param[":prog_id"] = $prog_id;
		$query_str .= "	t_prog.del_flag = 0 ";
		
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
		$query_str .= "	t_prog.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	( ";
		foreach($arr_dev_id as $index => $dev_id){
			if($index > 0){
				$query_str .= "	or ";
			}
			$query_str .= "	t_prog.dev_id = :dev_id_" . $index . " ";
			$arr_bind_param[":dev_id_" . $index] = $dev_id;
		}
		$query_str .= "	) and ";
		$query_str .= "	( ";
		$query_str .= "	t_prog.sta_dt <= :sta_dt and t_prog.end_dt > :sta_dt or ";
		$query_str .= "	t_prog.sta_dt < :end_dt and t_prog.end_dt >= :end_dt or ";
		$query_str .= "	t_prog.sta_dt >= :sta_dt and t_prog.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_prog.del_flag = 0 ";
		
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
	 * @param array		$prog_id	Program guide ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_by_arr_dev_id_sta_dt_end_dt_exclude_id($arr_dev_id, $sta_dt, $end_dt, $prog_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	t_prog.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	( ";
		foreach($arr_dev_id as $index => $dev_id){
			if($index > 0){
				$query_str .= "	or ";
			}
			$query_str .= "	t_prog.dev_id = :dev_id_" . $index . " ";
			$arr_bind_param[":dev_id_" . $index] = $dev_id;
		}
		$query_str .= "	) and ";
		$query_str .= "	( ";
		$query_str .= "	t_prog.sta_dt <= :sta_dt and t_prog.end_dt > :sta_dt or";
		$query_str .= "	t_prog.sta_dt < :end_dt and t_prog.end_dt >= :end_dt or ";
		$query_str .= "	t_prog.sta_dt >= :sta_dt and t_prog.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_prog.prog_id <> :prog_id and ";
		$arr_bind_param[":prog_id"] = $prog_id;
		$query_str .= "	t_prog.del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
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
	 * @param stdClass	$prog		A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function ins($prog)
	{
		if(isset($prog->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_prog( ";
			$query_str .= "		prog_id, ";
			$query_str .= "		dev_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		prog_name, ";
			$query_str .= "		sta_dt, ";
			$query_str .= "		end_dt, ";
			$query_str .= "		inst_flag, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:prog_id, ";
			$query_str .= "		:dev_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:prog_name, ";
			$query_str .= "		:sta_dt, ";
			$query_str .= "		:end_dt, ";
			$query_str .= "		:inst_flag, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":prog_id"]     = $prog->prog_id;
			$arr_bind_param[":dev_id"]      = $prog->dev_id;
			$arr_bind_param[":client_id"]   = $prog->client_id;
			$arr_bind_param[":prog_name"]   = $prog->prog_name;
			$arr_bind_param[":sta_dt"]      = $prog->sta_dt;
			$arr_bind_param[":end_dt"]      = $prog->end_dt;
			$arr_bind_param[":inst_flag"]   = $prog->inst_flag;
			$arr_bind_param[":create_user"] = $prog->create_user;
			$arr_bind_param[":create_dt"]   = $prog->create_dt;
			$arr_bind_param[":update_user"] = $prog->update_user;
			$arr_bind_param[":update_dt"]   = $prog->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Program guide update
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function up($prog)
	{
		if(isset($prog->client_id)){
			$query_str = "update ";
			$query_str .= "	t_prog ";
			$query_str .= "set ";
			$query_str .= "	sta_dt = :sta_dt, ";
			$query_str .= "	end_dt = :end_dt, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	prog_id = :prog_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":sta_dt"]      = $prog->sta_dt;
			$arr_bind_param[":end_dt"]      = $prog->end_dt;
			$arr_bind_param[":update_user"] = $prog->update_user;
			$arr_bind_param[":update_dt"]   = $prog->update_dt;
			$arr_bind_param[":client_id"]   = $prog->client_id;
			$arr_bind_param[":prog_id"]     = $prog->prog_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Delete program guide
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function del($prog)
	{
//		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	t_prog ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	prog_id = :prog_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $prog->update_user;
			$arr_bind_param[":update_dt"] = $prog->update_dt;
//			$arr_bind_param[":client_id"] = $this->client_id;
			$arr_bind_param[":prog_id"] = $prog->prog_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}