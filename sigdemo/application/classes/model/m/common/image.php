<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_M_Common_Image extends Model
{
	protected $db;
	
	public function __construct(&$db)
	{
		$this->db = $db;
	}
	
	/**
	 * Acquire all image ID and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	image_id, ";
		$query_str .= "	image_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(image_name,'UTF8'), ";
		$query_str .= "	image_id desc ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all images
	 *
	 * @return array				Acquisition record
	 */
	public function sel_cnt()
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(image_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Image ID acquisition (presence confirmation)
	 *
	 * @param String	$image_id	Image ID
	 * @return array				Acquisition record
	 */
	public function sel_id($image_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_common_image.image_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.image_id = :image_id and ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		
		$arr_bind_param[":image_id"] = $image_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire image ID from image name
	 *
	 * @param String	$image_name		Image name
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name($image_name)
	{
		$query_str = "select ";
		$query_str .= "	m_common_image.image_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.image_name = :image_name and ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":image_name"] = $image_name;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire image ID from image name
	 *
	 * @param String	$image_name		Image name
	 * @param String	$image_id		Image ID
 	 * @return array					Acquisition record
	 */
	public function sel_arr_id_by_name_exclude_id($image_name, $image_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_common_image.image_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.image_id <> :image_id and ";
		$arr_bind_param[":image_id"] = $image_id;
		$query_str .= "	m_common_image.image_name = :image_name and ";
		$arr_bind_param[":image_name"] = $image_name;
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire image ID from image file name
	 *
	 * @param String	$orig_file_name		Image file name
	 * @param String	$orig_file_exte		Image file extension
 	 * @return array						Acquisition record
	 */
	public function sel_arr_id_by_orig_file_name_exte($orig_file_name, $orig_file_exte)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_common_image.image_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.orig_file_name = :orig_file_name and ";
		$arr_bind_param[":orig_file_name"] = $orig_file_name;
		$query_str .= "	m_common_image.orig_file_exte = :orig_file_exte and ";
		$arr_bind_param[":orig_file_exte"] = $orig_file_exte;
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire all images
	 *
	 * @param String	$image_id	Image ID
	 * @return array				Acquisition record
	 */
	public function sel($image_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	image_id, ";
		$query_str .= "	image_name, ";
		$query_str .= "	active_file_dir, ";
		$query_str .= "	enc_file_dir, ";
		$query_str .= "	orig_file_dir, ";
		$query_str .= "	file_name, ";
		$query_str .= "	enc_file_exte, ";
		$query_str .= "	enc_file_size, ";
		$query_str .= "	enc_hash, ";
		$query_str .= "	orig_file_name, ";
		$query_str .= "	orig_file_exte, ";
		$query_str .= "	orig_file_size, ";
		$query_str .= "	orig_hash, ";
		$query_str .= "	width, ";
		$query_str .= "	height, ";
		$query_str .= "	sta_dt, ";
		$query_str .= "	end_dt, ";
		$query_str .= "	del_flag, ";
		$query_str .= "	create_user, ";
		$query_str .= "	create_dt, ";
		$query_str .= "	update_user, ";
		$query_str .= "	update_dt ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	image_id = :image_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param[":image_id"] = $image_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Image Main key number assignment
	 *
	 * @return int		Numbered image_id
	 */
	public function sel_next_id()
	{
		$query_str = "select nextval(pg_catalog.pg_get_serial_sequence('m_image', 'image_id'))";
		$query = DB::query(Database::SELECT, $query_str);
		$seq = $query->execute($this->db, true);
		
		return $seq[0]->nextval;
	}
	
	/**
	 * Image registration
	 *
	 * @param stdClass	$image	image
	 * @return int				Image_id of the registered image
	 */
	public function ins($image)
	{
		$query_str = "insert into ";
		$query_str .= "	m_common_image( ";
		$query_str .= "		image_id, ";
		$query_str .= "		image_name, ";
		$query_str .= "		orig_file_dir, ";
		$query_str .= "		file_name, ";
		$query_str .= "		orig_file_size, ";
		$query_str .= "		orig_file_name, ";
		$query_str .= "		orig_file_exte, ";
		$query_str .= "		orig_hash, ";
		$query_str .= "		width, ";
		$query_str .= "		height, ";
		$query_str .= "		sta_dt, ";
		$query_str .= "		end_dt, ";
		$query_str .= "		create_user, ";
		$query_str .= "		create_dt, ";
		$query_str .= "		update_user, ";
		$query_str .= "		update_dt ";
		$query_str .= "	) values ( ";
		$query_str .= "		:image_id, ";
		$query_str .= "		:image_name, ";
		$query_str .= "		:orig_file_dir, ";
		$query_str .= "		:file_name, ";
		$query_str .= "		:orig_file_size, ";
		$query_str .= "		:orig_file_name, ";
		$query_str .= "		:orig_file_exte, ";
		$query_str .= "		:orig_hash, ";
		$query_str .= "		:width, ";
		$query_str .= "		:height, ";
		$query_str .= "		:sta_dt, ";
		$query_str .= "		:end_dt, ";
		$query_str .= "		:create_user, ";
		$query_str .= "		:create_dt, ";
		$query_str .= "		:update_user, ";
		$query_str .= "		:update_dt ";
		$query_str .= "	) ";
		
		$arr_bind_param = array();
		$arr_bind_param[":image_id"] = $image->image_id;
		$arr_bind_param[":image_name"] = $image->image_name;
		$arr_bind_param[":orig_file_dir"] = $image->orig_file_dir;
		$arr_bind_param[":file_name"] = $image->file_name;
		$arr_bind_param[":orig_file_size"] = $image->orig_file_size;
		$arr_bind_param[":orig_file_name"] = $image->orig_file_name;
		$arr_bind_param[":orig_file_exte"] = $image->orig_file_exte;
		$arr_bind_param[":orig_hash"] = $image->orig_hash;
		$arr_bind_param[":width"] = $image->width;
		$arr_bind_param[":height"] = $image->height;
		$arr_bind_param[":sta_dt"] = $image->sta_dt;
		$arr_bind_param[":end_dt"] = $image->end_dt;
		$arr_bind_param[":create_user"] = $image->create_user;
		$arr_bind_param[":create_dt"] = $image->create_dt;
		$arr_bind_param[":update_user"] = $image->update_user;
		$arr_bind_param[":update_dt"] = $image->update_dt;
		
		$query = DB::query(Database::INSERT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Image update
	 *
	 * @param stdClass	$image		image
	 * @return bool					true = success, false = failure
	 */
	public function up($image)
	{
		$query_str = "update ";
		$query_str .= "	m_common_image ";
		$query_str .= "set ";
		$query_str .= "	image_name = :image_name, ";
		$query_str .= "	sta_dt = :sta_dt, ";
		$query_str .= "	end_dt = :end_dt, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	image_id = :image_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":image_name"] = $image->image_name;
		$arr_bind_param[":sta_dt"] = $image->sta_dt;
		$arr_bind_param[":end_dt"] = $image->end_dt;
		$arr_bind_param[":update_user"] = $image->update_user;
		$arr_bind_param[":update_dt"] = $image->update_dt;
		$arr_bind_param[":image_id"] = $image->image_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db);
	}
	
	/**
	 * Delete image
	 *
	 * @param stdClass	$image		image
	 * @return bool					true = success, false = failure
	 */
	public function del($image)
	{
		$query_str = "update ";
		$query_str .= "	m_common_image ";
		$query_str .= "set ";
		$query_str .= "	del_flag = 1, ";
		$query_str .= "	update_user = :update_user, ";
		$query_str .= "	update_dt = :update_dt ";
		$query_str .= "where ";
		$query_str .= "	image_id = :image_id and ";
		$query_str .= "	del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":update_user"] = $image->update_user;
		$arr_bind_param[":update_dt"] = $image->update_dt;
		$arr_bind_param[":image_id"] = $image->image_id;
		
		$query = DB::query(Database::UPDATE, $query_str);
		$query->parameters($arr_bind_param);
	
		return $query->execute($this->db);
	}
}