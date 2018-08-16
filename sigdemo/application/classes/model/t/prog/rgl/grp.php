<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Prog_Rgl_Grp extends Model
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
	 * Program guide (repeated designation) Primary key number assignment
	 *
	 * @return int		Number assigned prog_rgl_grp_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('t_prog_rgl_grp', 'prog_rgl_grp_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Program guide (repeated designation) registration
	 *
	 * @param stdClass	$prog_rgl	A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function ins($prog_rgl_grp)
	{
		if(isset($prog_rgl_grp->client_id)){
			$query_str = "insert into ";
			$query_str .= "	t_prog_rgl_grp( ";
			$query_str .= "		prog_rgl_grp_id, ";
			$query_str .= "		dev_id, ";
			$query_str .= "		client_id, ";
			$query_str .= "		prog_name, ";
			$query_str .= "		create_user, ";
			$query_str .= "		create_dt, ";
			$query_str .= "		update_user, ";
			$query_str .= "		update_dt ";
			$query_str .= "	) values ( ";
			$query_str .= "		:prog_rgl_grp_id, ";
			$query_str .= "		:dev_id, ";
			$query_str .= "		:client_id, ";
			$query_str .= "		:prog_name, ";
			$query_str .= "		:create_user, ";
			$query_str .= "		:create_dt, ";
			$query_str .= "		:update_user, ";
			$query_str .= "		:update_dt ";
			$query_str .= "	) ";
			
			$arr_bind_param = array();
			$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl_grp->prog_rgl_grp_id;
			$arr_bind_param[":dev_id"] = $prog_rgl_grp->dev_id;
			$arr_bind_param[":client_id"] = $prog_rgl_grp->client_id;
			$arr_bind_param[":prog_name"] = $prog_rgl_grp->prog_name;
			$arr_bind_param[":create_user"] = $prog_rgl_grp->create_user;
			$arr_bind_param[":create_dt"] = $prog_rgl_grp->create_dt;
			$arr_bind_param[":update_user"] = $prog_rgl_grp->update_user;
			$arr_bind_param[":update_dt"] = $prog_rgl_grp->update_dt;
			
			$query = DB::query(Database::INSERT, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
	
	/**
	 * Program guide (repeated designation) group deletion
	 *
	 * @param stdClass	$prog_rgl_grp	Program guide (repeated designation) group
	 * @return bool						true = success, false = failure
	 */
	public function del($prog_rgl_grp)
	{
//		if(isset($prog_rgl_grp->client_id)){
			$query_str = "update ";
			$query_str .= "	t_prog_rgl_grp ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
//			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	prog_rgl_grp_id = :prog_rgl_grp_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $prog_rgl_grp->update_user;
			$arr_bind_param[":update_dt"] = $prog_rgl_grp->update_dt;
//			$arr_bind_param[":client_id"] = $prog_rgl_grp->client_id;
			$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl_grp->prog_rgl_grp_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
			
			return $query->execute($this->db);
//		} else {
//			return false;
//		}
	}
}