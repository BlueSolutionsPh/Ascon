<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_T_Image_Draw_Size_Rela extends Model
{
	protected $db;
	public $client_id;
	
	public function __construct(&$db, $client_id = null)
	{
		$this->db = $db;
		$this->client_id = $client_id;
	}
	
	/**
	 * Image drawing size related registration
	 *
	 * @param stdClass	$image_draw_size_rela	Image drawing size related
	 * @return bool						true = success, false = failure
	 */
	public function ins($image_draw_size_rela)
	{
		$query_str = "insert into ";
		$query_str .= "	t_image_draw_size_rela( ";
		$query_str .= "		image_id, ";
		$query_str .= "		draw_size_id, ";
		$query_str .= "		client_id, ";
		$query_str .= "		rotate_flag, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:image_id,";
		$query_str .= "		:draw_size_id,";
		$query_str .= "		:client_id,";
		$query_str .= "		:rotate_flag, ";
		$query_str .= "		:create_user,";
		$query_str .= "		:create_dt,";
		$query_str .= "		:update_user,";
		$query_str .= "		:update_dt";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":image_id"] = $image_draw_size_rela->image_id;
		$arr_bind_param[":draw_size_id"] = $image_draw_size_rela->draw_size_id;
		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":rotate_flag"] = $image_draw_size_rela->rotate_flag;
		$arr_bind_param[":create_user"] = $image_draw_size_rela->create_user;
		$arr_bind_param[":create_dt"] = $image_draw_size_rela->create_dt;
		$arr_bind_param[":update_user"] = $image_draw_size_rela->update_user;
		$arr_bind_param[":update_dt"] = $image_draw_size_rela->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Image drawing size relation deleted
	 *
	 * @param stdClass	$image_draw_size_rela	Image drawing size related
	 * @return bool						true = success, false = failure
	 */
	public function del($image_draw_size_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_image_draw_size_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	image_draw_size_rela_id = :image_draw_size_rela_id and ";
		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	del_flag = 0";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $image_draw_size_rela->update_user;
		$arr_bind_param[":update_dt"] = $image_draw_size_rela->update_dt;
		$arr_bind_param[":image_draw_size_rela_id"] = $image_draw_size_rela->image_draw_size_rela_id;
		$arr_bind_param[":client_id"] = $this->client_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Image drawing size relation deleted
	 *
	 * @param stdClass	$image_draw_size_rela	Image drawing size related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_image_id($image_draw_size_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_image_draw_size_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	image_id = :image_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $image_draw_size_rela->update_user;
		$arr_bind_param[":update_dt"] = $image_draw_size_rela->update_dt;
		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":image_id"] = $image_draw_size_rela->image_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Image drawing size relation deleted
	 *
	 * @param stdClass	$image_draw_size_rela	Image drawing size related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_image_id_draw_size_id($image_draw_size_rela)
	{
		$query_str = "update ";
		$query_str .= "	t_image_draw_size_rela ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	client_id = :client_id and ";
		$query_str .= "	image_id = :image_id and ";
		$query_str .= "	draw_size_id = :draw_size_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $image_draw_size_rela->update_user;
		$arr_bind_param[":update_dt"] = $image_draw_size_rela->update_dt;
		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":image_id"] = $image_draw_size_rela->image_id;
		$arr_bind_param[":draw_size_id"] = $image_draw_size_rela->draw_size_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
	
	/**
	 * Image drawing size relation deleted
	 *
	 * @param stdClass	$image_draw_size_rela	Image drawing size related
	 * @return bool						true = success, false = failure
	 */
	public function del_by_client_id($image_draw_size_rela)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	t_image_draw_size_rela ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";
			
			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = $image_draw_size_rela->update_user;
			$arr_bind_param[":update_dt"] = $image_draw_size_rela->update_dt;
			$arr_bind_param[":client_id"] = $this->client_id;
			
			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);
		
			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}