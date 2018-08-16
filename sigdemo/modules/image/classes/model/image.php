<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Image extends Model
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
		$this->client_id = null; // 20180109 hit_update
	}

	/**
	 * Get image drawing size list
	 *
	 * @return array					Acquisition record
	 */
	public function sel_arr_image_draw_size()
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_draw_size.draw_size_id, ";
		$query_str .= "	m_draw_size.draw_size_name, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height ";
		$query_str .= "from ";
		$query_str .= "	m_draw_size ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			m_draw_area.draw_area_id ";
		$query_str .= "		from ";
		$query_str .= "			m_draw_area ";
		$query_str .= "		where ";
		$query_str .= "			m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$query_str .= "			m_draw_area.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_draw_size.width desc, ";
		$query_str .= "	m_draw_size.height desc, ";
		$query_str .= "	m_draw_size.draw_size_name, ";
		$query_str .= "	m_draw_size.draw_size_id desc ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire drawing size
	 *
	 * @param String	$draw_size_id	Drawing size ID
	 * @return array					Acquisition record
	 */
	public function sel_draw_size($draw_size_id)
	{
		$ret = true;
		try{
			$m_draw_size = new Model_M_Draw_Size($this->db);
			$ret = $m_draw_size->sel($draw_size_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
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
		$query_str .= "	m_draw_size.draw_size_name, ";
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
		$arr_bind_param[":image_id"] = $image_id;
		if(isset($this->client_id)){
			$query_str .= "	t_image_draw_size_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_image_draw_size_rela.del_flag = 0 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquisition of number of images
	 *
	 * @param stdClass	$search			Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_image($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_image_name)){
			$arr_image_name = $search->arr_image_name;
		}
		$arr_playlist_id = array();
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			array_push($arr_playlist_id, $search->playlist_id);
		}
		if(isset($search->image_tag_1) && $search->image_tag_1 !== ""){
			$image_tag_1 = $search->image_tag_1;
		}
		if(isset($search->image_tag_2) && $search->image_tag_2 !== ""){
			$image_tag_2 = $search->image_tag_2;
		}
		$tag_and_or = "and";
		if(isset($search->tag_and_or) && $search->tag_and_or !== ""){
			$tag_and_or = $search->tag_and_or;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(image.image_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_image.image_id ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_image.client_id = m_client.client_id and ";
		//Search condition (client name) added
		if(!empty($arr_client_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_client_name as $client_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_client.client_name ilike :client_name_" . $i ;
				$arr_bind_param[":client_name_" . $i] = "%" . $client_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";

		//Add search condition (tag)
		if(isset($image_tag_1) && isset($image_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($image_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_image_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_image_tag_rela.image_id = m_image.image_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_image_tag_rela.image_tag_id = :image_tag_id_1 ";
			$arr_bind_param[":image_tag_id_1"] = $image_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_image_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_image_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($image_tag_1) && isset($image_tag_2)){
			if($tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($image_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_image_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_image_tag_rela.image_id = m_image.image_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_image_tag_rela.image_tag_id = :image_tag_id_2 ";
			$arr_bind_param[":image_tag_id_2"] = $image_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_image_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_image_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($image_tag_1) && isset($image_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($image_tag_1) || isset($image_tag_2)){
			$query_str .= " and ";
		}

		//Add search condition (playlist ID)
		if(!empty($arr_playlist_id)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_image_rela ";
			$query_str .= "		where ";
			$query_str .= "			m_image.image_id = t_playlist_image_rela.image_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_playlist_id as $playlist_id){
				if($i > 0){
					 $query_str .= " or ";
				}
				$query_str .= "				t_playlist_image_rela.playlist_id = :playlist_id_" . $i;
				$arr_bind_param[":playlist_id_" . $i] = $playlist_id;
				$i++;
			}
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_playlist_image_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_playlist_image_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}

		//Search condition (image name) addition
		if(!empty($arr_image_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_image_name as $image_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_image.image_name ilike :image_name_" . $i ;
				$arr_bind_param[":image_name_" . $i] = "%" . $image_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= ") image ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get image list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	public function sel_arr_image($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_image_name)){
			$arr_image_name = $search->arr_image_name;
		}
		$arr_playlist_id = array();
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			array_push($arr_playlist_id, $search->playlist_id);
		}
		if(isset($search->image_tag_1) && $search->image_tag_1 !== ""){
			$image_tag_1 = $search->image_tag_1;
		}
		if(isset($search->image_tag_2) && $search->image_tag_2 !== ""){
			$image_tag_2 = $search->image_tag_2;
		}
		$tag_and_or = "and";
		if(isset($search->tag_and_or) && $search->tag_and_or !== ""){
			$tag_and_or = $search->tag_and_or;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.image_name, ";
		$query_str .= "	m_image.orig_file_dir, ";
		$query_str .= "	m_image.file_name, ";
		$query_str .= "	m_image.enc_file_size, ";
		$query_str .= "	m_image.orig_file_name, ";
		$query_str .= "	m_image.orig_file_exte, ";
		$query_str .= "	m_image.orig_file_size, ";
		$query_str .= "	m_image.width, ";
		$query_str .= "	m_image.height, ";
		$query_str .= "	m_image.sta_dt, ";
		$query_str .= "	m_image.end_dt, ";
		$query_str .= "	m_image.property_id, ";
		$query_str .= "	m_image.update_user, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_image.client_id = m_client.client_id and ";
		//Search condition (client name) added
		if(!empty($arr_client_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_client_name as $client_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_client.client_name ilike :client_name_" . $i ;
				$arr_bind_param[":client_name_" . $i] = "%" . $client_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";

		//Add search condition (tag)
		if(isset($image_tag_1) && isset($image_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($image_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_image_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_image_tag_rela.image_id = m_image.image_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_image_tag_rela.image_tag_id = :image_tag_id_1 ";
			$arr_bind_param[":image_tag_id_1"] = $image_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_image_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_image_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($image_tag_1) && isset($image_tag_2)){
			if($tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($image_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_image_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_image_tag_rela.image_id = m_image.image_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_image_tag_rela.image_tag_id = :image_tag_id_2 ";
			$arr_bind_param[":image_tag_id_2"] = $image_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_image_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_image_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($image_tag_1) && isset($image_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($image_tag_1) || isset($image_tag_2)){
			$query_str .= " and ";
		}

		//Add search condition (playlist ID)
		if(!empty($arr_playlist_id)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_image_rela ";
			$query_str .= "		where ";
			$query_str .= "			m_image.image_id = t_playlist_image_rela.image_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_playlist_id as $playlist_id){
				if($i > 0){
					 $query_str .= " or ";
				}
				$query_str .= "				t_playlist_image_rela.playlist_id = :playlist_id_" . $i;
				$arr_bind_param[":playlist_id_" . $i] = $playlist_id;
				$i++;
			}
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_playlist_image_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_playlist_image_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}

		//Search condition (image name) addition
		if(!empty($arr_image_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_image_name as $image_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_image.image_name ilike :image_name_" . $i ;
				$arr_bind_param[":image_name_" . $i] = "%" . $image_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "order by ";
		if(is_null($this->client_id)){
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	convert_to(m_image.image_name,'UTF8'), ";
		$query_str .= "	m_image.image_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
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
	 * Image tag acquisition
	 *
	 * @param String	$image_id	Image ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_image_tag_by_image_id($image_id)
	{
		$query_str = "select ";
		$query_str .= "	m_image_tag.image_tag_id, ";
		$query_str .= "	m_image_tag.image_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_image_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_image_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_image ";
		$query_str .= "		on ";
		$query_str .= "			t_image_tag_rela.image_id = m_image.image_id and ";
		$query_str .= "			m_image.image_id = :image_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_image.client_id = :client_id and ";
		}
		$query_str .= "			m_image.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_image_tag.image_tag_id = t_image_tag_rela.image_tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_image_tag_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_image_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	m_image_tag.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_image_tag.image_tag_name, ";
		$query_str .= "	m_image_tag.image_tag_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":image_id"] = $image_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 *Image size acquisition 23: 04 2012/02/29 - add
	 *
	 * @param String	$image_id	Image ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_image_draw_size_by_image_id($image_id)
	{
		$query_str = "select ";
		$query_str .= "	m_draw_size.draw_size_id, ";
		$query_str .= "	m_draw_size.draw_size_name, ";
		$query_str .= "	m_draw_size.width, ";
		$query_str .= "	m_draw_size.height ";
		$query_str .= "from ";
		$query_str .= "	m_draw_size ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_image_draw_size_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_image ";
		$query_str .= "		on ";
		$query_str .= "			t_image_draw_size_rela.image_id = m_image.image_id and ";
		$query_str .= "			m_image.image_id = :image_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_image.client_id = :client_id and ";
		}
		$query_str .= "			m_image.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_draw_size.draw_size_id = t_image_draw_size_rela.draw_size_id and ";
		$query_str .= "			t_image_draw_size_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	m_draw_size.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_draw_size.draw_size_name, ";
		$query_str .= "	m_draw_size.draw_size_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":image_id"] = $image_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
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
	 * Get playlist name using image of argument
	 *
	 * @param String	$image_id		Image ID
	 * @return array					Acquisition record
	 */
	public function sel_arr_playlist_by_image_id($image_id)
	{
		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_playlist_image_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_image ";
		$query_str .= "		on ";
		$query_str .= "			t_playlist_image_rela.image_id = m_image.image_id and ";
		$query_str .= "			m_image.image_id = :image_id and ";
		$query_str .= "			m_image.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			t_playlist.playlist_id = t_playlist_image_rela.playlist_id and ";
		$query_str .= "			t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.playlist_id desc ";

		$arr_bind_param = array();
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
	public function sel_next_image_id()
	{
		$image_id = null;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$image_id = $m_image->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$image_id = null;
		}
		return $image_id;
	}

	/**
	 * Image registration
	 *
	 * @param String	$image		image
	 * @return bool					true = success, false = failure
	 */
	public function ins_image($image)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$ret = $m_image->ins($image);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Image update
	 *
	 * @param stdClass	$image		image
	 * @return bool				true = success, false = failure
	 */
	public function up_image($image)
	{
		$ret = true;
		try{
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$m_image->up($image);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Delete image
	 *
	 * @param stdClass	$image		画像
	 * @return bool					true = success, false = failure
	 */
	public function del_image($image)
	{
		$ret = true;
		try{
			//Image playlist related
			$t_playlist_image_rela = new Model_T_Playlist_Image_Rela($this->db, $this->client_id);
			$playlist_image_rela = new stdClass();
			$playlist_image_rela->image_id = $image->image_id;
			$playlist_image_rela->update_user = $image->update_user;
			$playlist_image_rela->update_dt = $image->update_dt;
			$t_playlist_image_rela->del_by_image_id($playlist_image_rela);

			//Image drawing size related
			$t_image_draw_size_rela = new Model_T_Image_Draw_Size_Rela($this->db, $this->client_id);
			$image_draw_size_rela = new stdClass();
			$image_draw_size_rela->image_id = $image->image_id;
			$image_draw_size_rela->update_user = $image->update_user;
			$image_draw_size_rela->update_dt = $image->update_dt;
			$t_image_draw_size_rela->del_by_image_id($image_draw_size_rela);

			//Image tag related
			$t_image_tag_rela = new Model_T_Image_Tag_Rela($this->db, $this->client_id);
			$image_tag_rela = new stdClass();
			$image_tag_rela->image_id = $image->image_id;
			$image_tag_rela->update_user = $image->update_user;
			$image_tag_rela->update_dt = $image->update_dt;
			$t_image_tag_rela->del_by_image_id($image_tag_rela);

			//Image master
			$m_image = new Model_M_Image($this->db, $this->client_id);
			$m_image->del($image);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Image drawing size related registration
	 *
	 * @param stdClass	$image_draw_size_rela		Image drawing size related
	 * @return bool		true = success, false = failure
	 */
	public function ins_image_draw_size_rela($image_draw_size_rela)
	{
		$ret = true;
		try{
			$t_image_draw_size_rela = new Model_T_Image_Draw_Size_Rela($this->db, $this->client_id);
			$ret = $t_image_draw_size_rela->ins($image_draw_size_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Image tag related registration
	 *
	 * @param stdClass	$image_tag_rela		Image tag related
	 * @return bool	true = success, false = failure
	 */
	public function ins_image_tag_rela($image_tag_rela)
	{
		$ret = true;
		try{
			$t_image_tag_rela = new Model_T_Image_Tag_Rela($this->db, $this->client_id);
			$ret = $t_image_tag_rela->ins($image_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Image tag related delete
	 *
	 * @param stdClass	$image_tag_rela		Image tag related
	 * @return bool		true = success, false = failure
	 */
	public function del_image_tag_rela($image_tag_rela)
	{
		$ret = true;
		try{
			$t_image_tag_rela = new Model_T_Image_Tag_Rela($this->db, $this->client_id);
			$ret = $t_image_tag_rela->del_by_image_id_image_tag_id($image_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
