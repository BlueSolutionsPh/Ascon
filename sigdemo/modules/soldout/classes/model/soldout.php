<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Soldout extends Model
{
	public $db;
	public $client_id;
	
	public function __construct($client_id)
	{
		$this->db = Database::instance();
		$this->client_id = $client_id;
	}
	
	/**
	 * Image acquisition
	 *
	 * @param String	$image_id	Image ID
	 * @return array				Acquisition record
	 */
	public function sel_image($image_id)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$ret = $m_image->sel($image_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get images
	 *
	 * @param String	$image_name		Image name
	 * @return array					Acquisition record
	 */
	public function sel_arr_image_by_image_name($image_name)
	{
		$query_str = "select ";
		$query_str .= "	m_image.image_id ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "where ";
		$query_str .= "	m_image.image_name = :image_name and ";
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":image_name"] = $image_name;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get images
	 *
	 * @param String	$orig_file_name_1	Image file name 1
	 * @param String	$orig_file_name_2	Image file name 2
	 * @param String	$orig_file_exte		Image file extension
	 * @return array						Acquisition record
	 */
	public function sel_image_by_orig_file_name_exte($orig_file_name_1, $orig_file_name_2, $orig_file_exte)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$ret = $m_image->sel_image_by_orig_file_name_exte($orig_file_name_1, $orig_file_name_2, $orig_file_exte);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get image name
	 *
	 * @param String	$image_id		Image ID
	 * @return array					Acquisition record
	 */
	public function sel_image_name($image_id)
	{
		$query_str = "select ";
		$query_str .= "	m_image.image_name ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "where ";
		$query_str .= "	m_image.image_id = :image_id and ";
		$query_str .= "	m_image.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":image_id"] = $image_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquire drawing size
	 *
	 * @param String	$image_id		Image ID
	 * @return array					Acquisition record
	 */
	public function sel_draw_size_by_image_id($image_id)
	{
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_draw_size.draw_size_id, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height ";
		$query_str .= "from ";
		$query_str .= "	t_image_draw_size_rela ";
		$query_str .= "join ";
		$query_str .= "	m_draw_size ";
		$query_str .= "on ";
		$query_str .= "	t_image_draw_size_rela.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_image_draw_size_rela.image_id = :image_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_image_draw_size_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_image_draw_size_rela.del_flag = 0 ";
		$query_str .= "limit 1 ";
		
		$arr_bind_param[":image_id"] = $image_id;
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Image update
	 *
	 * @param stdClass	$image		image
	 * @return bool					true = success, false = failure
	 */
	public function up_image($image)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$m_image->up_soldout($image);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}