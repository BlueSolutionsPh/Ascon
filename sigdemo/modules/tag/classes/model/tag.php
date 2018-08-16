<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Tag extends Model
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
		$this->client_id = null;  // 20180109 hit_update
	}
	
	/**
	 * Get movie tag list
	 * 
	 * @return	array				Acquisition record
	 */
	public function sel_arr_movie_tag()
	{
		$ret = true;
		try{
			$m_movie_tag = new Model_M_Movie_Tag($this->db, $this->client_id);
			$ret = $m_movie_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get image tag list
	 * 
	 * @return	array				Acquisition record
	 */
	public function sel_arr_image_tag()
	{
		$ret = true;
		try{
			$m_image_tag = new Model_M_Image_Tag($this->db, $this->client_id);
			$ret = $m_image_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get text tag list
	 * 
	 * @return	array				Acquisition record
	 */
	public function sel_arr_text_tag()
	{
		$ret = true;
		try{
			$m_text_tag = new Model_M_Text_Tag($this->db, $this->client_id);
			$ret = $m_text_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get HTML tag list
	 * 
	 * @return	array				Acquisition record
	 */
	public function sel_arr_html_tag()
	{
		$ret = true;
		try{
			$m_html_tag = new Model_M_Html_Tag($this->db, $this->client_id);
			$ret = $m_html_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get terminal tag list
	 * 
	 * @return	array				Acquisition record
	 */
	public function sel_arr_dev_tag()
	{
		$ret = true;
		try{
			$m_dev_tag = new Model_M_Dev_Tag($this->db, $this->client_id);
			$ret = $m_dev_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Retrieve store tag list
	 * 
	 * @return	array				Acquisition record
	 */
	public function sel_arr_shop_tag()
	{
		$ret = true;
		try{
			$m_shop_tag = new Model_M_Shop_Tag($this->db, $this->client_id);
			$ret = $m_shop_tag->sel_arr_id_name();
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get movie tag name
	 *
	 * @param String	$tag_id			Tag ID
	 * @return array					Acquisition record
	 */
	public function sel_movie_tag_name($tag_id)
	{
		$query_str = "select ";
		$query_str .= "	m_movie_tag.movie_tag_name as tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_movie_tag ";
		$query_str .= "where ";
		$query_str .= "	m_movie_tag.movie_tag_id = :tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_movie_tag.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":tag_id"] = $tag_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get image tag name
	 *
	 * @param String	$tag_id			Tag ID
	 * @return array					Acquisition record
	 */
	public function sel_image_tag_name($tag_id)
	{
		$query_str = "select ";
		$query_str .= "	m_image_tag.image_tag_name as tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_image_tag ";
		$query_str .= "where ";
		$query_str .= "	m_image_tag.image_tag_id = :tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_image_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_image_tag.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":tag_id"] = $tag_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition record
	 *
	 * @param String	$tag_id			Tag ID
	 * @return array					Acquisition record
	 */
	public function sel_text_tag_name($tag_id)
	{
		$query_str = "select ";
		$query_str .= "	m_text_tag.text_tag_name as tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_text_tag ";
		$query_str .= "where ";
		$query_str .= "	m_text_tag.text_tag_id = :tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_text_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_text_tag.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":tag_id"] = $tag_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get HTML tag name
	 *
	 * @param String	$tag_id			Tag ID
	 * @return array					Acquisition record
	 */
	public function sel_html_tag_name($tag_id)
	{
		$query_str = "select ";
		$query_str .= "	m_html_tag.html_tag_name as tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_html_tag ";
		$query_str .= "where ";
		$query_str .= "	m_html_tag.html_tag_id = :tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_html_tag.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":tag_id"] = $tag_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get terminal tag name
	 *
	 * @param String	$tag_id			Tag ID
	 * @return array					Acquisition record
	 */
	public function sel_dev_tag_name($tag_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev_tag.dev_tag_name as tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev_tag ";
		$query_str .= "where ";
		$query_str .= "	m_dev_tag.dev_tag_id = :tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_dev_tag.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":tag_id"] = $tag_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Acquisition record
	 *
	 * @param String	$tag_id			Tag ID
	 * @return array					Acquisition record
	 */
	public function sel_shop_tag_name($tag_id)
	{
		$query_str = "select ";
		$query_str .= "	m_shop_tag.shop_tag_name as tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_shop_tag ";
		$query_str .= "where ";
		$query_str .= "	m_shop_tag.shop_tag_id = :tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_shop_tag.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":tag_id"] = $tag_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * movie tag registration
	 *
	 * @param stdClass	$movie_tag	movie tag
	 * @return bool					true = success, false = failure
	 */
	public function ins_movie_tag($movie_tag)
	{
		$ret = true;
		try{
			$m_movie_tag = new Model_M_Movie_Tag($this->db, $this->client_id);
			$ret = $m_movie_tag->ins($movie_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete movie tag
	 *
	 * @param stdClass	$movie_tag	movie tag
	 * @return bool					true = success, false = failure
	 */
	public function del_movie_tag($movie_tag)
	{
		$ret = true;
		try{
			$m_movie_tag = new Model_M_Movie_Tag($this->db, $this->client_id);
			$m_movie_tag->del($movie_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Image tag registration
	 *
	 * @param stdClass	$image_tag	Image tag
	 * @return bool					true = success, false = failure
	 */
	public function ins_image_tag($image_tag)
	{
		$ret = true;
		try{
			$m_image_tag = new Model_M_Image_Tag($this->db, $this->client_id);
			$ret = $m_image_tag->ins($image_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete Image Tag
	 *
	 * @param stdClass	$image_tag	Image tag
	 * @return bool					true = success, false = failure
	 */
	public function del_image_tag($image_tag)
	{
		$ret = true;
		try{
			$m_image_tag = new Model_M_Image_Tag($this->db, $this->client_id);
			$m_image_tag->del($image_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Text tag registration
	 *
	 * @param stdClass	$text_tag	Text tag
	 * @return bool					true = success, false = failure
	 */
	public function ins_text_tag($text_tag)
	{
		$ret = true;
		try{
			$m_text_tag = new Model_M_Text_Tag($this->db, $this->client_id);
			$ret = $m_text_tag->ins($text_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete text tag
	 *
	 * @param stdClass	$text_tag	Text tag
	 * @return bool					true = success, false = failure
	 */
	public function del_text_tag($text_tag)
	{
		$ret = true;
		try{
			$m_text_tag = new Model_M_Text_Tag($this->db, $this->client_id);
			$m_text_tag->del($text_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * HTML tag registration
	 *
	 * @param stdClass	$html_tag	HTML Tag
	 * @return bool					true = success, false = failure
	 */
	public function ins_html_tag($html_tag)
	{
		$ret = true;
		try{
			$m_html_tag = new Model_M_Html_Tag($this->db, $this->client_id);
			$ret = $m_html_tag->ins($html_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete HTML tag
	 *
	 * @param stdClass	$html_tag	HTML Tag
	 * @return bool					true = success, false = failure
	 */
	public function del_html_tag($html_tag)
	{
		$ret = true;
		try{
			$m_html_tag = new Model_M_Html_Tag($this->db, $this->client_id);
			$m_html_tag->del($html_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Register terminal tag
	 *
	 * @param stdClass	$dev_tag	Terminal tag
	 * @return bool					true = success, false = failure
	 */
	public function ins_dev_tag($dev_tag)
	{
		$ret = true;
		try{
			$m_dev_tag = new Model_M_Dev_Tag($this->db, $this->client_id);
			$ret = $m_dev_tag->ins($dev_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete device tag
	 *
	 * @param stdClass	$dev_tag	Terminal tag
	 * @return bool					true = success, false = failure
	 */
	public function del_dev_tag($dev_tag)
	{
		$ret = true;
		try{
			$m_dev_tag = new Model_M_Dev_Tag($this->db, $this->client_id);
			$m_dev_tag->del($dev_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Store tag registration
	 *
	 * @param stdClass	$shop_tag	Store tag
	 * @return bool					true = success, false = failure
	 */
	public function ins_shop_tag($shop_tag)
	{
		$ret = true;
		try{
			$m_shop_tag = new Model_M_Shop_Tag($this->db, $this->client_id);
			$ret = $m_shop_tag->ins($shop_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete store tag
	 *
	 * @param stdClass	$shop_tag	Store tag
	 * @return bool					true = success, false = failure
	 */
	public function del_shop_tag($shop_tag)
	{
		$ret = true;
		try{
			$m_shop_tag = new Model_M_Shop_Tag($this->db, $this->client_id);
			$m_shop_tag->del($shop_tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * movie tag update
	 *
	 * @param stdClass	$tag		tag
	 * @return bool					true = success, false = failure
	 */
	public function up_movie_tag($tag)
	{
		$ret = true;
		try{
			$m_movie = new Model_M_Movie_Tag($this->db, $this->client_id);
			$m_movie->up($tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Static image tag update
	 *
	 * @param stdClass	$tag		tag
	 * @return bool					true = success, false = failure
	 */
	public function up_image_tag($tag)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image_Tag($this->db, $this->client_id);
			$m_image->up($tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Text tag update
	 *
	 * @param stdClass	$tag		tag
	 * @return bool					true = success, false = failure
	 */
	public function up_text_tag($tag)
	{
		$ret = true;
		try{
			$m_text = new Model_M_Text_Tag($this->db, $this->client_id);
			$m_text->up($tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * html tag update
	 *
	 * @param stdClass	$tag		tag
	 * @return bool					true = success, false = failure
	 */
	public function up_html_tag($tag)
	{
		$ret = true;
		try{
			$m_html = new Model_M_Html_Tag($this->db, $this->client_id);
			$m_html->up($tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Terminal tag update
	 *
	 * @param stdClass	$tag		tag
	 * @return bool					true = success, false = failure
	 */
	public function up_dev_tag($tag)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev_Tag($this->db, $this->client_id);
			$m_dev->up($tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Store tag update
	 *
	 * @param stdClass	$tag		tag
	 * @return bool					true = success, false = failure
	 */
	public function up_shop_tag($tag)
	{
		$ret = true;
		try{
			$m_shop = new Model_M_Shop_Tag($this->db, $this->client_id);
			$m_shop->up($tag);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}