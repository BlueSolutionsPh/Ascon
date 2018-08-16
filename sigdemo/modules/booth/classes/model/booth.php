<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Booth extends Model
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
	 * Acquire all booths
	 *
	 * @param stdClass	$search		Search condition
	 * @return	array				Acquisition record
	 */
	public function sel_cnt_booth($search)
	{
		//Search condition
		if(isset($search->client_id) && $search->client_id !== ""){
			$this->client_id = $search->client_id;
		}
		if(isset($search->shop) && $search->shop !== ""){
			$shop_id = $search->shop;
		}
		if(isset($search->floor_id) && $search->floor_id !== ""){
			$floor_id = $search->floor_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}

		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_shop_name)){
			$arr_shop_name = $search->arr_shop_name;
		}
		if(isset($search->booth_tag_1) && $search->booth_tag_1 !== ""){
			$booth_tag_1 = $search->booth_tag_1;
		}
		if(isset($search->booth_tag_2) && $search->booth_tag_2 !== ""){
			$booth_tag_2 = $search->booth_tag_2;
		}
		$booth_tag_and_or = "and";
		if(isset($search->booth_tag_and_or) && $search->booth_tag_and_or !== ""){
			$booth_tag_and_or = $search->booth_tag_and_or;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(booth.booth_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_booth.booth_id ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_booth.client_id = m_client.client_id and ";
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
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_booth.client_id = m_shop.client_id and ";
		$query_str .= "	m_booth.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_floor ";
		$query_str .= "on ";
		$query_str .= "	m_booth.floor_id = m_floor.floor_id and ";
		$query_str .= "	m_floor.del_flag = 0 ";
		$query_str .= "where ";

		//Search condition (facility name) addition
		if(isset($shop_id)){
			$query_str .= "	m_booth.shop_id = :shop_id and ";
			$arr_bind_param[":shop_id"] = $shop_id;
		}
		//Search condition (installation floor) added
		if(isset($floor_id)){
			$query_str .= "	m_booth.floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $floor_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	m_booth.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}

		//Search condition (boost tag) added
		if(isset($booth_tag_1) && isset($booth_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($booth_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_booth_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_booth_tag_rela.booth_id = m_booth.booth_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_booth_tag_rela.booth_tag_id = :booth_tag_id_1 ";
			$arr_bind_param[":booth_tag_id_1"] = $booth_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_booth_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_booth_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($booth_tag_1) && isset($booth_tag_2)){
			if($booth_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($booth_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_booth_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_booth_tag_rela.booth_id = m_booth.booth_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_booth_tag_rela.booth_tag_id = :booth_tag_id_2 ";
			$arr_bind_param[":booth_tag_id_2"] = $booth_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_booth_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_booth_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($booth_tag_1) && isset($booth_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($booth_tag_1) || isset($booth_tag_2)){
			$query_str .= " and ";
		}

		//Search condition (Booth name) added
		if(!empty($arr_booth_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_booth_name as $booth_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_booth.booth_name ilike :booth_name_" . $i . " ";
				$arr_bind_param[":booth_name_" . $i] = "%" . $booth_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		//Add search condition (store name)
		if(!empty($arr_shop_name)){
			$i = 0;
			foreach($arr_shop_name as $shop_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "				m_shop.shop_name ilike :shop_name" . $i . " ";
				$arr_bind_param[":shop_name" . $i] =  "%" . $shop_name . "%";
				$i++;
			}
			$query_str .= "	and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_booth.client_id = :client_id and";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_booth.del_flag = 0 ";
		$query_str .= ") booth ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Booth list acquisition
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_booth($search)
	{
		//Search condition
		if(isset($search->client_id) && $search->client_id !== ""){
			$this->client_id = $search->client_id;
		}
		if(isset($search->shop) && $search->shop !== ""){
			$shop_id = $search->shop;
		}
		if(isset($search->floor_id) && $search->floor_id !== ""){
			$floor_id = $search->floor_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}

		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_shop_name)){
			$arr_shop_name = $search->arr_shop_name;
		}
		if(isset($search->booth_tag_1) && $search->booth_tag_1 !== ""){
			$booth_tag_1 = $search->booth_tag_1;
		}
		if(isset($search->booth_tag_2) && $search->booth_tag_2 !== ""){
			$booth_tag_2 = $search->booth_tag_2;
		}
		$booth_tag_and_or = "and";
		if(isset($search->booth_tag_and_or) && $search->booth_tag_and_or !== ""){
			$booth_tag_and_or = $search->booth_tag_and_or;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_booth.booth_id, ";
		$query_str .= "	m_booth.booth_name, ";
		$query_str .= "	m_booth.sex_id, ";
		$query_str .= "	m_booth.twentyfour_flg, ";
		$query_str .= "	m_booth.sta_time, ";
		$query_str .= "	m_booth.end_time, ";
		$query_str .= "	m_booth.wifissid, ";
		$query_str .= "	m_booth.wifipass, ";
		$query_str .= "	m_shop.shop_id, ";
		$query_str .= "	m_shop.shop_name, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	m_floor.floor_id, ";
		$query_str .= "	m_floor.floor_name, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(dev_id) ";
		$query_str .= "		from ";
		$query_str .= "			m_dev ";
		$query_str .= "		where ";
		$query_str .= "			m_dev.booth_id = m_booth.booth_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_dev.client_id = :client_id and ";
		}
		$query_str .= "			m_dev.del_flag = 0 ";
		$query_str .= "	) as dev_cnt ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_booth.client_id = m_shop.client_id and ";
		$query_str .= "	m_booth.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_booth.client_id = m_client.client_id and ";
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
		$query_str .= "join ";
		$query_str .= "	m_floor ";
		$query_str .= "on ";
		$query_str .= "	m_booth.floor_id = m_floor.floor_id and ";
		$query_str .= "	m_floor.del_flag = 0 ";

		$query_str .= "where ";

		//Search condition (facility name) addition
		if(isset($shop_id)){
			$query_str .= "	m_booth.shop_id = :shop_id and ";
			$arr_bind_param[":shop_id"] = $shop_id;
		}
		//Search condition (installation floor) added
		if(isset($floor_id)){
			$query_str .= "	m_booth.floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $floor_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	m_booth.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}

		//Search condition (boost tag) added
		if(isset($booth_tag_1) && isset($booth_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($booth_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_booth_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_booth_tag_rela.booth_id = m_booth.booth_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_booth_tag_rela.booth_tag_id = :booth_tag_id_1 ";
			$arr_bind_param[":booth_tag_id_1"] = $booth_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_booth_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_booth_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($booth_tag_1) && isset($booth_tag_2)){
			if($booth_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($booth_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_booth_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_booth_tag_rela.booth_id = m_booth.booth_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_booth_tag_rela.booth_tag_id = :booth_tag_id_2 ";
			$arr_bind_param[":booth_tag_id_2"] = $booth_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_booth_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_booth_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($booth_tag_1) && isset($booth_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($booth_tag_1) || isset($booth_tag_2)){
			$query_str .= " and ";
		}

		//Add search condition (store name)
		if(!empty($arr_shop_name)){
			$i = 0;
			foreach($arr_shop_name as $shop_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "				m_shop.shop_name ilike :shop_name" . $i . " ";
				$arr_bind_param[":shop_name" . $i] =  "%" . $shop_name . "%";
				$i++;
			}
			$query_str .= "	and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_booth.client_id = :client_id and";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_booth.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_booth.booth_name, ";
		$query_str .= "	m_booth.booth_id desc ";
		$query_str .= "limit :limit ";
		$arr_bind_param[":limit"] = MAX_CNT_PER_PAGE;
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Booth tag acquisition
	 * @param	String	$booth_id	Booth ID
	 * @return	array				Acquisition record
	 */
	public function sel_arr_booth_tag_by_booth_id($booth_id)
	{
		$query_str = "select ";
		$query_str .= "	booth_tag_id, ";
		$query_str .= "	booth_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_booth_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_booth_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_booth ";
		$query_str .= "		on ";
		$query_str .= "			t_booth_tag_rela.booth_id = m_booth.booth_id and ";
		$query_str .= "			m_booth.booth_id = :booth_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_booth.client_id = :client_id and ";
		}
		$query_str .= "			m_booth.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_booth_tag.booth_tag_id = t_booth_tag_rela.booth_tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_booth_tag.client_id = :client_id and ";
		}
		$query_str .= "			t_booth_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	booth_tag_name, ";
		$query_str .= "	booth_tag_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":booth_id"] = $booth_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get Booth
	 *
	 * @param String	$booth_id		Booth ID
	 * @return array					Acquisition record
	 */
	public function sel_booth($booth_id)
	{
		$query_str = "select ";
		$query_str .= "	m_booth.booth_id, ";
		$query_str .= "	m_booth.booth_name, ";
		$query_str .= "	m_booth.client_id, ";
		$query_str .= "	m_booth.shop_id, ";
		$query_str .= "	m_booth.floor_id, ";
		$query_str .= "	m_booth.sex_id, ";
		$query_str .= "	m_booth.twentyfour_flg, ";
		$query_str .= "	m_booth.sta_time, ";
		$query_str .= "	m_booth.end_time, ";
		$query_str .= "	m_booth.wifissid, ";
		$query_str .= "	m_booth.wifipass, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_booth.client_id = m_client.client_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_client.client_id = :client_id and ";
		}
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_booth.booth_id = :booth_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_booth.client_id = :client_id and ";
		}
		$query_str .= "	m_booth.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":booth_id"] = $booth_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get booth name
	 *
	 * @param String	$booth_id		Booth ID
	 * @return array					Acquisition record
	 */
	public function sel_booth_name($booth_id)
	{
		$query_str = "select ";
		$query_str .= "	m_booth.booth_name, ";
		$query_str .= "	m_booth.client_id ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "where ";
		$query_str .= "	m_booth.booth_id = :booth_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_booth.client_id = :client_id and ";
		}
		$query_str .= "	m_booth.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":booth_id"] = $booth_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire the terminal ID being used by the booth
	 *
	 * @param String	$booth_id	Booth ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev_id($booth_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.booth_id = :booth_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":booth_id"] = $booth_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire the program guide ID being used by the terminal
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog_id($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	t_prog.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog ";
		$query_str .= "where ";
		$query_str .= "	t_prog.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
		}
		$query_str .= "	t_prog.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Booth primary key numbering
	 *
	 * @return int		Numbered booth_id
	 */
	public function sel_next_booth_id()
	{
		$booth_id = null;
		try{
			$m_booth = new Model_M_Booth($this->db, $this->client_id);
			$booth_id = $m_booth->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$booth_id = null;
		}
		return $booth_id;
	}

	/**
	 * Booth registration
	 *
	 * @param stdClass	$booth		booth
	 * @return bool					true = success, false = failure
	 */
	public function ins_booth($booth)
	{
		$ret = true;
		try{
			$m_booth = new Model_M_Booth($this->db, $this->client_id);
			$ret = $m_booth->ins($booth);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Booth update
	 *
	 * @param stdClass	$booth		booth
	 * @return bool					true = success, false = failure
	 */
	public function up_booth($booth)
	{
		$ret = true;
		try{
			$m_booth = new Model_M_Booth($this->db, $this->client_id);
			$m_booth->up($booth);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Booth deletion
	 *
	 * @param stdClass	$booth		booth
	 * @return bool					true = success, false = failure
	 */
	public function del_booth($booth)
	{
		$ret = true;
		try{
			//Delete terminal in booth
			$arr_dev = $this->sel_arr_dev_id($booth->booth_id);
			foreach($arr_dev as $dev){
				$dev_id = $dev->dev_id;

				//Terminal HTML related download log
				$t_dev_html_rela_dl_log = new Model_T_Dev_Html_Rela_Dl_Log($this->db);
				$dev_html_rela_dl_log = new stdClass();
				$dev_html_rela_dl_log->dev_id = $dev_id;
				$dev_html_rela_dl_log->client_id   = $booth->client_id;
				$dev_html_rela_dl_log->update_user = $booth->update_user;
				$dev_html_rela_dl_log->update_dt = $booth->update_dt;
				$t_dev_html_rela_dl_log->del_by_dev_id($dev_html_rela_dl_log);

				//Terminal HTML related
				$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $this->client_id);
				$dev_html_rela = new stdClass();
				$dev_html_rela->dev_id = $dev_id;
				$dev_html_rela->client_id   = $booth->client_id;
				$dev_html_rela->update_user = $booth->update_user;
				$dev_html_rela->update_dt = $booth->update_dt;
				$t_dev_html_rela->del_by_dev_id($dev_html_rela);

				//Program guide download log
				$t_dev_prog_dl_log = new Model_T_Dev_Prog_Dl_Log($this->db);
				$dev_prog_dl_log = new stdClass();
				$dev_prog_dl_log->dev_id = $dev_id;
				$dev_prog_dl_log->client_id   = $booth->client_id;
				$dev_prog_dl_log->update_user = $booth->update_user;
				$dev_prog_dl_log->update_dt = $booth->update_dt;
				$t_dev_prog_dl_log->del_by_dev_id($dev_prog_dl_log);

				//Device status log
				$t_dev_status_log = new Model_T_Dev_Status_Log($this->db);
				$dev_status_log = new stdClass();
				$dev_status_log->dev_id = $dev_id;
				$dev_status_log->client_id   = $booth->client_id;
				$dev_status_log->update_user = $booth->update_user;
				$dev_status_log->update_dt = $booth->update_dt;
				$t_dev_status_log->del_by_dev_id($dev_status_log);

				//Acquire program list while using terminal
				$arr_prog = $this->sel_arr_prog_id($dev_id);
				foreach($arr_prog as $prog){
					$prog_id = $prog->prog_id;

					//Program list Play list related
					$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
					$prog_playlist_rela = new stdClass();
					$prog_playlist_rela->prog_id = $prog_id;
					$prog_playlist_rela->client_id   = $booth->client_id;
					$prog_playlist_rela->update_user = $booth->update_user;
					$prog_playlist_rela->update_dt = $booth->update_dt;
					$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

					//A TV schedule
					$t_prog = new Model_T_Prog($this->db, $this->client_id);
					$prog = new stdClass();
					$prog->prog_id = $prog_id;
					$prog->client_id   = $booth->client_id;
					$prog->update_user = $booth->update_user;
					$prog->update_dt = $booth->update_dt;
					$t_prog->del($prog);
				}

				//Acquire repetitively specified program list while using terminal
				$arr_prog_rgl_grp = $this->sel_arr_prog_rgl_grp_id($dev->dev_id);
				foreach($arr_prog_rgl_grp as $prog_rgl_grp){
					$prog_rgl_grp_id = $prog_rgl_grp->prog_rgl_grp_id;
					$arr_prog_rgl = $this->sel_arr_prog_rgl_id($prog_rgl_grp_id);
					foreach($arr_prog_rgl as $prog_rgl){
						$prog_id = $prog_rgl->prog_id;

						//Repeat Specified Program Guide Playlist Related
						$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $booth->client_id);
						$prog_playlist_rela = new stdClass();
						$prog_playlist_rela->prog_id     = $prog_id;
						$prog_playlist_rela->client_id   = $booth->client_id;
						$prog_playlist_rela->update_user = $booth->update_user;
						$prog_playlist_rela->update_dt   = $booth->update_dt;
						$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

						//Repeatedly specified program guide
						$t_prog_rgl = new Model_T_Prog_Rgl($this->db, $booth->client_id);
						$prog_rgl = new stdClass();
						$prog_rgl->prog_id     = $prog_id;
						$prog_rgl->client_id   = $booth->client_id;
						$prog_rgl->update_user = $booth->update_user;
						$prog_rgl->update_dt   = $booth->update_dt;
						$t_prog_rgl->del($prog_rgl);
					}

					//Repeatedly designated program guide group
					$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $booth->client_id);
					$prog_rgl_grp = new stdClass();
					$prog_rgl_grp->prog_rgl_grp_id = $prog_rgl_grp_id;
					$prog_rgl_grp->client_id       = $booth->client_id;
					$prog_rgl_grp->update_user     = $booth->update_user;
					$prog_rgl_grp->update_dt       = $booth->update_dt;
					$t_prog_rgl_grp->del($prog_rgl_grp);
				}

				//Terminal tag related
				$t_dev_tag_rela = new Model_T_Dev_Tag_Rela($this->db, $booth->client_id);
				$dev_tag_rela = new stdClass();
				$dev_tag_rela->dev_id = $dev_id;
				$dev_tag_rela->client_id   = $booth->client_id;
				$dev_tag_rela->update_user = $booth->update_user;
				$dev_tag_rela->update_dt = $booth->update_dt;
				$t_dev_tag_rela->del_by_dev_id($dev_tag_rela);

				//Terminal master
				$m_dev = new Model_M_Dev($this->db, $booth->client_id);
				$dev = new stdClass();
				$dev->dev_id = $dev_id;
				$dev->client_id   = $booth->client_id;
				$dev->update_user = $booth->update_user;
				$dev->update_dt = $booth->update_dt;
				$m_dev->del($dev);
			}

//			//Booth tag related
//			$t_booth_tag_rela = new Model_T_Booth_Tag_Rela($this->db, $booth->client_id);
//			$booth_tag_rela = new stdClass();
//			$booth_tag_rela->booth_id = $booth->booth_id;
//			$booth_tag_rela->update_user = $booth->update_user;
//			$booth_tag_rela->update_dt = $booth->update_dt;
//			$t_booth_tag_rela->del_by_booth_id($booth_tag_rela);

			//Booth master
			$m_booth = new Model_M_Booth($this->db, $booth->client_id);
			$m_booth->del($booth);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Booth tag related registration
	 *
	 * @param stdClass	$booth_tag_rela	Booth tag related
	 * @return bool						true = success, false = failure
	 */
	public function ins_booth_tag_rela($booth_tag_rela)
	{
		$ret = true;
		try{
			$t_booth_tag_rela = new Model_T_Booth_Tag_Rela($this->db, $this->client_id);
			$ret = $t_booth_tag_rela->ins($booth_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Booth tag related delete
	 *
	 * @param stdClass	$booth_tag_rela	Booth tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_booth_tag_rela($booth_tag_rela)
	{
		$ret = true;
		try{
			$t_booth_tag_rela = new Model_T_Booth_Tag_Rela($this->db, $this->client_id);
			$ret = $t_booth_tag_rela->del_by_booth_id_booth_tag_id($booth_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}


	/**
	 * Get terminal list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev($search)
	{
		//Search condition
		if(isset($search->booth_id) && $search->booth_id !== ""){
			$booth_id = $search->booth_id;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	dev_id, ";
		$query_str .= "	serial_no, ";
		$query_str .= "	sex_id, ";
		$query_str .= "	dev_name, ";
		$query_str .= "	unit_flag, ";
		$query_str .= "	ants_version, ";
		$query_str .= "	invalid_flag, ";
		$query_str .= "	mail_flag, ";
		$query_str .= "	service_id, ";
		$query_str .= "	download_status, ";
		$query_str .= "	shop_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	booth_id, ";
		$query_str .= "	floor_id ";
		$query_str .= "from ";
		$query_str .= "m_dev ";
		$query_str .= "where ";

		//Add search condition (Booth)
		if(isset($booth_id)){
			$query_str .= "	booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $booth_id;
		}

		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	dev_name, ";
		$query_str .= "	dev_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Device update
	 *
	 * @param stdClass	$dev		Terminal
	 * @return bool					true = success, false = failure
	 */
	public function up_dev($dev)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $dev->client_id);
			$m_dev->up($dev);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Acquire active program list
	 *
	 * @param stdClass	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	function sel_arr_prog_rgl_grp_by_dev_id($dev){
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id, ";
		$query_str .= "	t_prog_rgl_grp.client_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		if(isset($dev->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $dev->client_id;
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$arr_bind_param[":dev_id"] = $dev->dev_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Program guide (repeated designation) group deletion
	 *
	 * @param stdClass	$prog_rgl_grp	Program guide (repeated designation) group
	 * @return bool					true = success, false = failure
	 */
	public function del_prog_rgl_grp($prog_rgl_grp)
	{
		$ret = true;

		try{
			$arr_prog_rgl = $this->sel_arr_prog_rgl_by_prog_rgl_grp_id($prog_rgl_grp);

			foreach($arr_prog_rgl as $tmp_prog_rgl){
				//Program guide (repeated designation)
				$t_prog_rgl = new Model_T_Prog_Rgl($this->db, $this->client_id);
				$prog_rgl = new stdClass();
				$prog_rgl->prog_id     = $tmp_prog_rgl->prog_id;
				$prog_rgl->client_id   = $prog_rgl_grp->client_id;
				$prog_rgl->update_user = $prog_rgl_grp->update_user;
				$prog_rgl->update_dt   = $prog_rgl_grp->update_dt;
				$t_prog_rgl->del($prog_rgl);

				//Program list Play list related
				$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
				$prog_playlist_rela = new stdClass();
				$prog_playlist_rela->prog_id     = $tmp_prog_rgl->prog_id;
				$prog_playlist_rela->client_id   = $prog_rgl_grp->client_id;
				$prog_playlist_rela->update_user = $prog_rgl_grp->update_user;
				$prog_playlist_rela->update_dt   = $prog_rgl_grp->update_dt;
				$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);
			}
			//Program guide (repeated designation) group
			$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $this->client_id);
			$t_prog_rgl_grp->del($prog_rgl_grp);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Acquire program list (repeated designation) list
	 *
	 * @param String	$prog_rgl_grp_id	Program guide (repeated designation) group ID
	 * @return array						Acquisition record
	 */
	function sel_arr_prog_rgl_by_prog_rgl_grp_id($prog_rgl_grp){
		$query_str = "select ";
		$query_str .= "	t_prog_rgl.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl.prog_rgl_grp_id = :prog_rgl_grp_id and ";
		if(isset($prog_rgl_grp->client_id)){
			$query_str .= "	t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= " t_prog_rgl.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl_grp->prog_rgl_grp_id;
		if(isset($prog_rgl_grp->client_id)){
			$arr_bind_param[":client_id"] = $prog_rgl_grp->client_id;
		}
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Program guide (repeated designation) group primary key number assignment
	 *
	 * @return int		Number assigned prog_rgl_grp_id
	 */
	public function sel_next_prog_rgl_grp_id()
	{
		$prog_rgl_grp_id = null;
		try{
			$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $this->client_id);
			$prog_rgl_grp_id = $t_prog_rgl_grp->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$prog_id = null;
		}
		return $prog_rgl_grp_id;
	}

	/**
	 * Program guide registration
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool					true = success, false = failure
	 */
	public function ins_prog($prog)
	{
		$ret = true;
		try{
			$t_prog = new Model_T_Prog_Rgl($this->db, $this->client_id);
			$ret = $t_prog->ins($prog);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	/**
	 * Program list (repeated designation) Group registration
	 *
	 * @param stdClass	$prog_rgl_grp	Program guide (repeated designation) group
	 * @return bool						true = success, false = failure
	 */
	public function ins_prog_rgl_grp($prog_rgl_grp)
	{
		$ret = true;
		try{
			$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $this->client_id);
			$ret = $t_prog_rgl_grp->ins($prog_rgl_grp);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Program guide Primary key number assignment
	 *
	 * @return int		Number assigned prog_id
	 */
	public function sel_next_prog_id()
	{
		$prog_id = null;
		try{
			$t_prog = new Model_T_Prog($this->db, $this->client_id);
			$prog_id = $t_prog->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$prog_id = null;
		}
		return $prog_id;
	}


	/**
	 * Get playlist list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_arr_playlist($search)
	{
		//Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}

		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
		}

		if(isset($search->client_id) && $search->client_id !== ""){
			$client_id = $search->client_id;
			$this->client_id = $search->client_id;
		}
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			$playlist_id = $search->playlist_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}
		if(isset($search->timezone_id) && $search->timezone_id !== ""){
			$timezone_id = $search->timezone_id;
		}
		if(isset($search->deliverymonth_id) && $search->deliverymonth_id !== ""){
			$deliverymonth_id = $search->deliverymonth_id;
		}
		if(isset($search->commonplaylist) && $search->commonplaylist !== ""){
			$commonplaylist = $search->commonplaylist;
		}
		if(isset($search->extraplaylist) && $search->extraplaylist !== ""){
			$extraplaylist = $search->extraplaylist;
		}

		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		$offset = $search->offset;

		$arr_bind_param = array();
//		$arr_bind_param[":sta_dt"] = $now;
//		$arr_bind_param[":end_dt"] = $now;

//		if(isset($search->sta_dt) && $search->sta_dt !== ""){
//			$arr_bind_param[":sta_dt"] = $search->sta_dt;
//		}
//		if(isset($search->end_dt) && $search->end_dt !== ""){
//			$arr_bind_param[":end_dt"] = $search->end_dt;
//		}

		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.draw_tmpl_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.ants_version, ";
		$query_str .= "	t_playlist.sex_id, ";
		$query_str .= "	t_playlist.deliverymonth_id, ";
		$query_str .= "	t_playlist.sta_dt, ";
		$query_str .= "	t_playlist.end_dt, ";
		$query_str .= "	m_draw_tmpl.draw_tmpl_name, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(tmp_t_prog.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			( ";
		$query_str .= "			select ";
		$query_str .= "				max(t_prog_outer.prog_id) prog_id, ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			from ";
		$query_str .= "				t_prog t_prog_outer ";
		$query_str .= "			where ";
		$query_str .= "				exists ( ";
		$query_str .= "					select ";
		$query_str .= "						t_prog_inner.prog_id ";
		$query_str .= "					from ";
		$query_str .= "						t_prog t_prog_inner ";
		$query_str .= "					where ";
		$query_str .= "						t_prog_outer.prog_id = t_prog_inner.prog_id and ";
		$query_str .= "						t_prog_outer.dev_id = t_prog_inner.dev_id and ";
//		$query_str .= "						t_prog_inner.sta_dt <= :sta_dt and ";
//		$query_str .= "						(t_prog_inner.end_dt > :end_dt or t_prog_inner.end_dt is null) and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "						t_prog_inner.client_id = :client_id and ";
		}
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
//		$query_str .= "				(t_prog_outer.end_dt > :end_dt or t_prog_outer.end_dt is null) and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			) tmp_t_prog";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_now, ";	//For judging CH allocation
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(tmp_t_prog.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			( ";
		$query_str .= "			select ";
		$query_str .= "				max(t_prog_outer.prog_id) prog_id, ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			from ";
		$query_str .= "				t_prog t_prog_outer ";
		$query_str .= "			where ";
//		$query_str .= "				t_prog_outer.sta_dt > :sta_dt and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "			) tmp_t_prog";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_future, ";	//For judging CH allocation
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(t_prog_rgl.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			t_prog_rgl_grp ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_rgl ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "				t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl.del_flag = 0 ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "		where ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_rgl, ";	//For judging CH allocation
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "	m_client.client_id, ";
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and ";
		$query_str .= "	m_draw_tmpl.del_flag = 0 ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "join ";
			$query_str .= "	m_client ";
			$query_str .= "on ";
			$query_str .= "	t_playlist.client_id = m_client.client_id and ";
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
		}
		$query_str .= "join ";
		$query_str .= "	m_timezone ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "where ";
//		$query_str .= "	t_playlist.sta_dt <= :end_dt and ";
//		$query_str .= "	(t_playlist.end_dt > :sta_dt or t_playlist.end_dt is null) and ";

		//Add search condition (playlist name)
		if(!empty($arr_playlist_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_playlist_name as $playlist_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "		t_playlist.playlist_name ilike :playlist_name" . $i . " ";
				$arr_bind_param[":playlist_name" . $i] = "%" . $playlist_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		//Search condition (Movie name) added
		if(!empty($arr_movie_name)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_movie_rela ";
			$query_str .= "		join ";
			$query_str .= "			m_movie ";
			$query_str .= "		on ";
			$query_str .= "			t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_movie_name as $movie_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "				m_movie.movie_name ilike :movie_name" . $i . " ";
				$arr_bind_param[":movie_name" . $i] =  "%" . $movie_name . "%";
				$i++;
			}
			$query_str .= "			) and ";
			$query_str .= "			m_movie.del_flag = 0 ";
			$query_str .= "		where ";
			$query_str .= "			t_playlist.playlist_id = t_playlist_movie_rela.playlist_id and ";
			$query_str .= "			t_playlist_movie_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}

		//Add search condition (playlist name)
		if(isset($playlist_id)){
			$query_str .= "	t_playlist.playlist_id = :playlist_id and ";
			$arr_bind_param[":playlist_id"] = $playlist_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	t_playlist.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}
		//Add search condition (distribution time zone)
		if(isset($timezone_id)){
			$query_str .= "	t_playlist.timezone_id = :timezone_id and ";
			$arr_bind_param[":timezone_id"] = $timezone_id;
		}
		//Search condition (distribution month) added
		if(isset($deliverymonth_id)){
			$query_str .= "	t_playlist.deliverymonth_id = :deliverymonth_id and ";
			$arr_bind_param[":deliverymonth_id"] = $deliverymonth_id;
		}
		//Add search condition (drawing area ID)
		if(isset($search->draw_tmpl_id) && $search->draw_tmpl_id !== ""){
			$query_str .= "	t_playlist.draw_tmpl_id = :draw_tmpl_id and ";
			$arr_bind_param[":draw_tmpl_id"] = $search->draw_tmpl_id;
		}

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " t_playlist.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $search->client_id;
		}

		if(isset($commonplaylist) && $commonplaylist !== ""){
			$query_str .= "	t_playlist.timezone_id <> 1 and ";
		}
		if(isset($extraplaylist) && $extraplaylist !== ""){
			$query_str .= "	t_playlist.timezone_id = 1 and ";
		}

		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(t_playlist.playlist_name,'UTF8'), ";
		$query_str .= "	t_playlist.playlist_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Program list Playlist related registration
	 *
	 * @param stdClass	$prog_playlist_rela		Program list Play list related
	 * @return bool								true = success, false = failure
	 */
	public function ins_prog_playlist_rela($prog_playlist_rela)
	{
		$ret = true;
		try{
			$t_prog_playlist_rela = new Model_T_Prog_Playlist_rela($this->db, $this->client_id);
			$ret = $t_prog_playlist_rela->ins($prog_playlist_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * DL status reset
	 *
	 * @param String	$dev		Terminal
	 * @return array				Acquisition record
	 */
	public function sel_dlLog_up($dev)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$ret = $m_dev->dlLog_up($dev);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}


	/**
	 * Acquire repeat-designated program guide group ID being used by terminal
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog_rgl_grp_id($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}
	/**
	 * Acquire repeatedly designated program guide ID being used by repeat-designated program guide group
	 *
	 * @param String	$prog_rgl_grp_id	Repeatedly specified program guide group ID
	 * @return array						Acquisition record
	 */
	public function sel_arr_prog_rgl_id($prog_rgl_grp_id)
	{
		$query_str = "select ";
		$query_str .= "	t_prog_rgl.prog_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl.prog_rgl_grp_id = :prog_rgl_grp_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":prog_rgl_grp_id"] = $prog_rgl_grp_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get playlist start and end times
	 *
	 * @param stdClass	$timezome_id	Playlist video related
	 * @return bool								true = success, false = failure
	 */
	public function get_timezone_time($timezome){
		$ret = true;
		try{
			$m_timezone = new Model_M_Timezone($this->db, $this->client_id);
			$ret = $m_timezone->sel_arr_time_by_id($timezome);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

}
