<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Devprog extends Model
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
	 * Acquire all terminals
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_dev($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(isset($search->dev_tag_1) && $search->dev_tag_1 !== ""){
			$dev_tag_1 = $search->dev_tag_1;
		}
		if(isset($search->dev_tag_2) && $search->dev_tag_2 !== ""){
			$dev_tag_2 = $search->dev_tag_2;
		}
		$dev_tag_and_or = "and";
		if(isset($search->dev_tag_and_or) && $search->dev_tag_and_or !== ""){
			$dev_tag_and_or = $search->dev_tag_and_or;
		}
		if(!empty($search->arr_shop_name)){
			$arr_shop_name = $search->arr_shop_name;
		}
		if(isset($search->shop_tag_1) && $search->shop_tag_1 !== ""){
			$shop_tag_1 = $search->shop_tag_1;
		}
		if(isset($search->shop_tag_2) && $search->shop_tag_2 !== ""){
			$shop_tag_2 = $search->shop_tag_2;
		}
		$shop_tag_and_or = "and";
		if(isset($search->shop_tag_and_or) && $search->shop_tag_and_or !== ""){
			$shop_tag_and_or = $search->shop_tag_and_or;
		}
		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(dev.dev_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.client_id = m_shop.client_id and ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_shop.client_id = m_client.client_id and ";
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

		//Search condition (terminal tag) addition
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($dev_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_dev_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_dev_tag_rela.dev_id = m_dev.dev_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_dev_tag_rela.dev_tag_id = :dev_tag_id_1 ";
			$arr_bind_param[":dev_tag_id_1"] = $dev_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_dev_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_dev_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			if($dev_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($dev_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_dev_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_dev_tag_rela.dev_id = m_dev.dev_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_dev_tag_rela.dev_tag_id = :dev_tag_id_2 ";
			$arr_bind_param[":dev_tag_id_2"] = $dev_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_dev_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_dev_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($dev_tag_1) || isset($dev_tag_2)){
			$query_str .= " and ";
		}

		//Add search condition (store tag)
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($shop_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_shop_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_shop_tag_rela.shop_id = m_dev.shop_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_shop_tag_rela.shop_tag_id = :shop_tag_id_1 ";
			$arr_bind_param[":shop_tag_id_1"] = $shop_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_shop_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_shop_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			if($shop_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($shop_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_shop_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_shop_tag_rela.shop_id = m_dev.shop_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_shop_tag_rela.shop_tag_id = :shop_tag_id_2 ";
			$arr_bind_param[":shop_tag_id_2"] = $shop_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_shop_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_shop_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($shop_tag_1) || isset($shop_tag_2)){
			$query_str .= " and ";
		}

		//Search condition (terminal name) added
		if(!empty($arr_dev_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_dev_name as $dev_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.dev_name ilike :dev_name_" . $i . " ";
				$arr_bind_param[":dev_name_" . $i] = "%" . $dev_name . "%";
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

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " m_dev.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}

		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= ") dev ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get terminal list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(isset($search->dev_tag_1) && $search->dev_tag_1 !== ""){
			$dev_tag_1 = $search->dev_tag_1;
		}
		if(isset($search->dev_tag_2) && $search->dev_tag_2 !== ""){
			$dev_tag_2 = $search->dev_tag_2;
		}
		$dev_tag_and_or = "and";
		if(isset($search->dev_tag_and_or) && $search->dev_tag_and_or !== ""){
			$dev_tag_and_or = $search->dev_tag_and_or;
		}
		if(!empty($search->arr_shop_name)){
			$arr_shop_name = $search->arr_shop_name;
		}
		if(isset($search->shop_tag_1) && $search->shop_tag_1 !== ""){
			$shop_tag_1 = $search->shop_tag_1;
		}
		if(isset($search->shop_tag_2) && $search->shop_tag_2 !== ""){
			$shop_tag_2 = $search->shop_tag_2;
		}
		$shop_tag_and_or = "and";
		if(isset($search->shop_tag_and_or) && $search->shop_tag_and_or !== ""){
			$shop_tag_and_or = $search->shop_tag_and_or;
		}
		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.serial_no, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.invalid_flag, ";
		$query_str .= "	m_dev.ants_version, ";
		$query_str .= "	m_shop.shop_id, ";
		$query_str .= "	m_shop.shop_name, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "( ";
		$query_str .= "	select ";
		$query_str .= "		t_prog_rgl_grp.prog_rgl_grp_id ";
		$query_str .= "	from ";
		$query_str .= "		t_prog_rgl_grp ";
		$query_str .= "	where ";
		$query_str .= "		m_dev.dev_id = t_prog_rgl_grp.dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "		t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "		t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "	order by ";
		$query_str .= "		t_prog_rgl_grp.prog_rgl_grp_id desc ";
		$query_str .= "	limit 1 ";
		$query_str .= ") as prog_rgl_grp_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.client_id = m_shop.client_id and ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_shop.client_id = m_client.client_id and ";
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

		//Search condition (terminal tag) addition
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($dev_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_dev_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_dev_tag_rela.dev_id = m_dev.dev_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_dev_tag_rela.dev_tag_id = :dev_tag_id_1 ";
			$arr_bind_param[":dev_tag_id_1"] = $dev_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_dev_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_dev_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			if($dev_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($dev_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_dev_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_dev_tag_rela.dev_id = m_dev.dev_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_dev_tag_rela.dev_tag_id = :dev_tag_id_2 ";
			$arr_bind_param[":dev_tag_id_2"] = $dev_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_dev_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_dev_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($dev_tag_1) && isset($dev_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($dev_tag_1) || isset($dev_tag_2)){
			$query_str .= " and ";
		}

		//Add search condition (store tag)
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($shop_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_shop_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_shop_tag_rela.shop_id = m_dev.shop_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_shop_tag_rela.shop_tag_id = :shop_tag_id_1 ";
			$arr_bind_param[":shop_tag_id_1"] = $shop_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_shop_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_shop_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			if($shop_tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($shop_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_shop_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_shop_tag_rela.shop_id = m_dev.shop_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_shop_tag_rela.shop_tag_id = :shop_tag_id_2 ";
			$arr_bind_param[":shop_tag_id_2"] = $shop_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_shop_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_shop_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($shop_tag_1) && isset($shop_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($shop_tag_1) || isset($shop_tag_2)){
			$query_str .= " and ";
		}

		//Search condition (terminal name) added
		if(!empty($arr_dev_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_dev_name as $dev_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.dev_name ilike :dev_name_" . $i . " ";
				$arr_bind_param[":dev_name_" . $i] = "%" . $dev_name . "%";
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
		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " m_dev.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.dev_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get terminal tag list
	 * @param	String	$dev_id		Device ID
	 * @return	array				Acquisition record
	 */
	public function sel_arr_dev_tag_by_dev_id($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev_tag.dev_tag_id, ";
		$query_str .= "	m_dev_tag.dev_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_dev_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_dev ";
		$query_str .= "		on ";
		$query_str .= "			t_dev_tag_rela.dev_id = m_dev.dev_id and ";
		$query_str .= "			m_dev.dev_id = :dev_id and ";
		$query_str .= "			m_dev.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_dev_tag.dev_tag_id = t_dev_tag_rela.dev_tag_id and ";
		$query_str .= "			t_dev_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
		}
		$query_str .= "	del_flag = 0 ";

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
	 * Retrieve store tag list
	 * @param	String	$shop_id	Store ID
	 * @return	array				Acquisition record
	 */
	public function sel_arr_shop_tag_by_shop_id($shop_id)
	{
		$query_str = "select ";
		$query_str .= "	m_shop_tag.shop_tag_id, ";
		$query_str .= "	m_shop_tag.shop_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_shop_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_shop_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_shop ";
		$query_str .= "		on ";
		$query_str .= "			t_shop_tag_rela.shop_id = m_shop.shop_id and ";
		$query_str .= "			m_shop.shop_id = :shop_id and ";
		$query_str .= "			m_shop.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_shop_tag.shop_tag_id = t_shop_tag_rela.shop_tag_id and ";
		$query_str .= "			t_shop_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
		}
		$query_str .= "	del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":shop_id"] = $shop_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire active program list (repeat designation)
	 *
	 * @param String	$dev_id		Device ID
	 * @param String	$prog_date	Delivery date(yyyy/mm/dd)
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog_rgl($dev_id, $prog_date, $client_id){
		$keys = array("year", "month", "day", "hour", "minute", "second");
		$date_1 = array_combine($keys, preg_split("/[-: ]/", $prog_date));

		$date_1["dow"] = date("w", strtotime($prog_date));

		$arr_bind_param = array();	//Sequence for search condition
		$arr_bind_param[":year"] = $date_1["year"];
		$arr_bind_param[":month"] = $date_1["month"];
		$arr_bind_param[":day"] = $date_1["day"];
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($client_id)){
			$arr_bind_param[":client_id"] = $client_id;
		}

		$query_str = "select ";
		$query_str .= "	t_prog_rgl_grp.prog_name, ";
		$query_str .= "	t_prog_rgl.prog_id, ";
		$query_str .= "	t_prog_rgl.client_id, ";
		$query_str .= "	t_prog_rgl.sta_time, ";
		$query_str .= "	t_prog_rgl.end_time, ";
		$query_str .= "	t_prog_rgl.year, ";
		$query_str .= "	t_prog_rgl.month, ";
		$query_str .= "	t_prog_rgl.day ";
//		$query_str .= "	t_prog_rgl.day, ";
//		$query_str .= "	t_prog_rgl.mon, ";
//		$query_str .= "	t_prog_rgl.tues, ";
//		$query_str .= "	t_prog_rgl.wednes, ";
//		$query_str .= "	t_prog_rgl.thurs, ";
//		$query_str .= "	t_prog_rgl.fri, ";
//		$query_str .= "	t_prog_rgl.satur, ";
//		$query_str .= "	t_prog_rgl.sun ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "join ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "on ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		$query_str .= "	( ";
		$query_str .= "		( ";
		switch($date_1["dow"]){
			case 0:
				$query_str .= "			t_prog_rgl.sun = 1 and ";
				break;
			case 1:
				$query_str .= "			t_prog_rgl.mon = 1 and ";
				break;
			case 2:
				$query_str .= "			t_prog_rgl.tues = 1 and ";
				break;
			case 3:
				$query_str .= "			t_prog_rgl.wednes = 1 and ";
				break;
			case 4:
				$query_str .= "			t_prog_rgl.thurs = 1 and ";
				break;
			case 5:
				$query_str .= "			t_prog_rgl.fri = 1 and ";
				break;
			case 6:
				$query_str .= "			t_prog_rgl.satur = 1 and ";
				break;
		}
		$query_str .= "			(t_prog_rgl.year = :year or t_prog_rgl.year = 0) and ";
		$query_str .= "			(t_prog_rgl.month = :month or t_prog_rgl.month = 0) and ";
		$query_str .= "			(t_prog_rgl.day = :day or t_prog_rgl.day = 0) ";
		$query_str .= "		) ";
		$query_str .= "	) and ";
		if(isset($client_id)){
			$query_str .= "			t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl.del_flag = 0 ";
		$query_str .= "where ";
//		$query_str .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		if(isset($client_id)){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_rgl.priority desc, ";
		$query_str .= "	t_prog_rgl.sta_time, ";
		$query_str .= "	t_prog_rgl.prog_id desc ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get an active program guide
	 *
	 * @param String	$dev_id		Device ID
	 * @param String	$prog_date	Delivery date(yyyy/mm/dd)
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog($dev_id, $prog_date){
		$sta_dt = $prog_date . " 00:00:00";
		$end_dt = $prog_date . " 23:59:59";

		$arr_bind_param = array();	//Sequence for search condition
		$arr_bind_param[":dev_id"] = $dev_id;
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query_str = "select ";
		$query_str .= "	arr_prog.prog_id, ";
		$query_str .= "	arr_prog.prog_name, ";
		$query_str .= "	arr_prog.sta_dt, ";
		$query_str .= "	arr_prog.end_dt ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "	select ";
		$query_str .= "		t_prog.prog_id, ";
		$query_str .= "		t_prog.prog_name, ";
		$query_str .= "		t_prog.sta_dt, ";
		$query_str .= "		t_prog.end_dt ";
		$query_str .= "	from ";
		$query_str .= "		m_dev ";
		$query_str .= "	join ";
		$query_str .= "		t_prog ";
		$query_str .= "	on ";
		$query_str .= "		m_dev.dev_id = t_prog.dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog.client_id = :client_id and ";
		}
		$query_str .= "		t_prog.del_flag = 0 ";
		$query_str .= "	join ";
		$query_str .= "		( ";
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
		$query_str .= "						t_prog_inner.sta_dt <= :end_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :sta_dt or t_prog_inner.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "					t_prog_inner.client_id = :client_id and ";
		}
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
		$query_str .= "				t_prog_outer.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_outer.client_id = :client_id and ";
		}
		$query_str .= "				t_prog_outer.del_flag = 0 ";
		$query_str .= "			group by ";
		$query_str .= "				t_prog_outer.sta_dt, ";
		$query_str .= "				t_prog_outer.end_dt, ";
		$query_str .= "				t_prog_outer.dev_id ";
		$query_str .= "		) tmp_prog ";
		$query_str .= "	on ";
		$query_str .= "		t_prog.prog_id = tmp_prog.prog_id ";
		$query_str .= "	where ";
		$query_str .= "		m_dev.invalid_flag = 0 and ";
		$query_str .= "		m_dev.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_dev.client_id = :client_id and ";
		}
		$query_str .= "		m_dev.del_flag = 0 ";
		$query_str .= "	) arr_prog ";
		$query_str .= "	order by ";
		$query_str .= "		arr_prog.sta_dt desc, ";
		$query_str .= "		arr_prog.end_dt, ";
		$query_str .= "		arr_prog.prog_id desc ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get active playlist list
	 *
	 * @param String	$prog_id	Program guide ID
	 * @return array				Acquisition record
	 */
	function sel_arr_playlist_by_prog_id($prog_id){
		$query_str = "select ";
//		$query_str .= "	t_prog_playlist_rela.ch, ";
//		$query_str .= "	t_playlist.playlist_id, ";
//		$query_str .= "	t_playlist.draw_tmpl_id, ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.client_id, ";
		$query_str .= "	t_playlist.sex_id, ";
		$query_str .= "	t_playlist.timezone_id ";
		$query_str .= "from ";
		$query_str .= "	t_prog_playlist_rela ";
		$query_str .= "join ";
		$query_str .= "	t_playlist ";
		$query_str .= "on ";
		$query_str .= "	t_prog_playlist_rela.playlist_id = t_playlist.playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_prog_playlist_rela.prog_id = :prog_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_playlist_rela.ch";

		$arr_bind_param = array();
		$arr_bind_param[":prog_id"] = $prog_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}


	/**
	 * Get playlist count
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_cnt_playlist($search)
	{
		//	Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
//		if(!empty($search->arr_playlist_name)){
//			$arr_playlist_name = $search->arr_playlist_name;
//		}
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
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

		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}

		if(isset($search->sta_dt) && $search->sta_dt !== ""){
			$sta_dt= $search->sta_dt;
		}
		if(isset($search->end_dt) && $search->end_dt !== ""){
			$end_dt = $search->end_dt;
		}
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(playlist.playlist_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	t_playlist.playlist_id ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and ";
		$query_str .= "	m_draw_tmpl.del_flag = 0 ";
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
		$query_str .= "where ";
		if(!empty($sta_dt) && sta_dt !== ""){
			$query_str .= "	t_playlist.sta_dt <= :end_dt and ";
			$query_str .= "	(t_playlist.end_dt > :sta_dt or t_playlist.end_dt is null) and ";

			$arr_bind_param[":sta_dt"] = $sta_dt;
			$arr_bind_param[":end_dt"] = $end_dt;
		}

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

		if(isset($search->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $search->client_id;
		}
		if(isset($commonplaylist) && $commonplaylist == true){
			$query_str .= "	t_playlist.timezone_id <> 1 and ";
		} elseif(isset($commonplaylist) && $commonplaylist == false){
			$query_str .= "	t_playlist.timezone_id = 1 and ";
		}
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= ") playlist ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
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
//		if(!empty($search->arr_playlist_name)){
//			$arr_playlist_name = $search->arr_playlist_name;
//		}
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

		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;

		if(isset($search->sta_dt) && $search->sta_dt !== ""){
			$arr_bind_param[":sta_dt"] = $search->sta_dt;
		}
		if(isset($search->end_dt) && $search->end_dt !== ""){
			$arr_bind_param[":end_dt"] = $search->end_dt;
		}

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
		$query_str .= "						t_prog_inner.sta_dt <= :sta_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :end_dt or t_prog_inner.end_dt is null) and ";
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "						t_prog_inner.client_id = :client_id and ";
		}
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
		$query_str .= "				(t_prog_outer.end_dt > :end_dt or t_prog_outer.end_dt is null) and ";
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
		$query_str .= "				t_prog_outer.sta_dt > :sta_dt and ";
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
		$query_str .= "	t_playlist.sta_dt <= :end_dt and ";
		$query_str .= "	(t_playlist.end_dt > :sta_dt or t_playlist.end_dt is null) and ";

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
	 * Get playlist list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_arr_playlist2($search)
	{
		//Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
//		if(!empty($search->arr_playlist_name)){
//			$arr_playlist_name = $search->arr_playlist_name;
//		}
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
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;

		if(isset($search->sta_dt) && $search->sta_dt !== ""){
			$arr_bind_param[":sta_dt"] = $search->sta_dt;
		}
		if(isset($search->end_dt) && $search->end_dt !== ""){
			$arr_bind_param[":end_dt"] = $search->end_dt;
		}

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
		$query_str .= "						t_prog_inner.sta_dt <= :sta_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :end_dt or t_prog_inner.end_dt is null) and ";
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "						t_prog_inner.client_id = :client_id and ";
		}
*/
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
		$query_str .= "				(t_prog_outer.end_dt > :end_dt or t_prog_outer.end_dt is null) and ";
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
*/
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
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
*/
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
		$query_str .= "				t_prog_outer.sta_dt > :sta_dt and ";
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "				t_prog_outer.client_id = :client_id and ";
		}
*/
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
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
*/
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_future, ";	//CH割り当て有無判断用
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(t_prog_rgl.prog_id) ";
		$query_str .= "		from ";
		$query_str .= "			t_prog_rgl_grp ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_rgl ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "				t_prog_rgl.client_id = :client_id and ";
		}
*/
		$query_str .= "			t_prog_rgl.del_flag = 0 ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
*/
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "		where ";
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
*/
		$query_str .= "			t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_rgl, ";	//CH割り当て有無判断用
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "	m_client.client_id, ";
			$query_str .= "	m_client.client_name, ";
		}
*/
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and ";
		$query_str .= "	m_draw_tmpl.del_flag = 0 ";
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "join ";
			$query_str .= "	m_client ";
			$query_str .= "on ";
			$query_str .= "	t_playlist.client_id = m_client.client_id and ";
			//検索条件(クライアント名称)追加
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
*/
		$query_str .= "join ";
		$query_str .= "	m_timezone ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_playlist.sta_dt <= :end_dt and ";
		$query_str .= "	(t_playlist.end_dt > :sta_dt or t_playlist.end_dt is null) and ";

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
/*
		if(isset($search->client_id) && $search->client_id !== ""){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $search->client_id;
		}
*/
		if(isset($commonplaylist) && $commonplaylist !== ""){
			$query_str .= "	t_playlist.timezone_id <> 1 and ";
		}
		if(isset($extraplaylist) && $extraplaylist !== ""){
			$query_str .= "	t_playlist.timezone_id = 1 and ";
		}

		$query_str .= "	t_playlist.del__flag = 0 ";
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
	 * Get drawing area list in template
	 *
	 * @param String	$draw_tmpl_id	Drawing area template ID
	 * @return array					Acquisition record
	 */
	function sel_arr_draw_area_by_draw_tmpl_id($draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	m_draw_area.draw_area_id, ";
		$query_str .= "	m_draw_area.draw_area_name, ";
		$query_str .= "	m_draw_area.draw_size_id, ";
		$query_str .= "	m_draw_area.cts_type, ";
		$query_str .= "	m_draw_area.rotate_flag ";
		$query_str .= "from ";
		$query_str .= "	m_draw_area ";
		$query_str .= "where ";
		$query_str .= "	m_draw_area.draw_tmpl_id = :draw_tmpl_id and ";
		$query_str .= "	m_draw_area.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_draw_area.draw_area_id ";

		$arr_bind_param = array();
		$arr_bind_param[":draw_tmpl_id"] = $draw_tmpl_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}


	/**
	 * Get movie list in playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$draw_area_id	Drawing area ID
	 * @return array					Acquisition record
	 */
	function sel_arr_movie_by_playlist_id_draw_area_id($playlist_id, $draw_area_id)
	{
		$query_str = "select ";
		$query_str .= "	playlist_movie.movie_id, ";
		$query_str .= "	playlist_movie.movie_name, ";
		$query_str .= "	playlist_movie.orig_file_dir, ";
		$query_str .= "	playlist_movie.file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_exte, ";
		$query_str .= "	playlist_movie.movie_orig_file_name_480p, ";
		$query_str .= "	playlist_movie.movie_orig_file_exte_480p, ";
		$query_str .= "	playlist_movie.sound_orig_file_name, ";
		$query_str .= "	playlist_movie.sound_orig_file_exte, ";
		$query_str .= "	to_char(playlist_movie.sta_dt, 'YY-MM-DD HH24:MI') as sta_dt, ";
		$query_str .= "	to_char(playlist_movie.end_dt, 'YY-MM-DD HH24:MI') as end_dt, ";
		$query_str .= "	playlist_movie.draw_area_id, ";
		$query_str .= "	playlist_movie.display_order ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.movie_name, ";
		$query_str .= "	m_movie.orig_file_dir, ";
		$query_str .= "	m_movie.file_name, ";
		$query_str .= "	m_movie.movie_orig_file_name, ";
		$query_str .= "	m_movie.movie_orig_file_exte, ";
		$query_str .= "	m_movie.movie_orig_file_name_480p, ";
		$query_str .= "	m_movie.movie_orig_file_exte_480p, ";
		$query_str .= "	m_movie.sound_orig_file_name, ";
		$query_str .= "	m_movie.sound_orig_file_exte, ";
		$query_str .= "	m_movie.sta_dt, ";
		$query_str .= "	m_movie.end_dt, ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	'(共通) ' || m_common_movie.movie_name, ";
		$query_str .= "	m_common_movie.orig_file_dir, ";
		$query_str .= "	m_common_movie.file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_exte, ";
		$query_str .= "	m_common_movie.movie_orig_file_name_480p, ";
		$query_str .= "	m_common_movie.movie_orig_file_exte_480p, ";
		$query_str .= "	m_common_movie.sound_orig_file_name, ";
		$query_str .= "	m_common_movie.sound_orig_file_exte, ";
		$query_str .= "	m_common_movie.sta_dt, ";
		$query_str .= "	m_common_movie.end_dt, ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= ") as playlist_movie ";
		$query_str .= "order by ";
		$query_str .= "	playlist_movie.display_order ";

		$arr_bind_param = array();
		$arr_bind_param[":draw_area_id"] = $draw_area_id;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get video list in playlist (with date specified)
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$draw_area_id	Drawing area ID
	 * @param String	$sta_dt			Start date and time
	 * @param String	$end_dt			End date and time
	 * @return array					Acquisition record
	 */
	function sel_arr_movie_by_playlist_id_draw_area_id_dt($playlist_id, $draw_area_id, $sta_dt, $end_dt)
	{
		$query_str = "select ";
		$query_str .= "	playlist_movie.movie_id, ";
		$query_str .= "	playlist_movie.movie_name, ";
		$query_str .= "	playlist_movie.orig_file_dir, ";
		$query_str .= "	playlist_movie.file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_name, ";
		$query_str .= "	playlist_movie.movie_orig_file_exte, ";
		$query_str .= "	playlist_movie.sound_orig_file_name, ";
		$query_str .= "	playlist_movie.sound_orig_file_exte, ";
		$query_str .= "	playlist_movie.draw_area_id, ";
		$query_str .= "	playlist_movie.display_order ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.movie_name, ";
		$query_str .= "	m_movie.orig_file_dir, ";
		$query_str .= "	m_movie.file_name, ";
		$query_str .= "	m_movie.movie_orig_file_name, ";
		$query_str .= "	m_movie.movie_orig_file_exte, ";
		$query_str .= "	m_movie.sound_orig_file_name, ";
		$query_str .= "	m_movie.sound_orig_file_exte, ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_movie.sta_dt <= :end_dt or m_movie.sta_dt is null) and ";
		$query_str .= "	(m_movie.end_dt >= :sta_dt or m_movie.end_dt is null) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	'(共通) ' || m_common_movie.movie_name, ";
		$query_str .= "	m_common_movie.orig_file_dir, ";
		$query_str .= "	m_common_movie.file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_name, ";
		$query_str .= "	m_common_movie.movie_orig_file_exte, ";
		$query_str .= "	m_common_movie.sound_orig_file_name, ";
		$query_str .= "	m_common_movie.sound_orig_file_exte, ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id, ";
		$query_str .= "	t_playlist_movie_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and ";
		$query_str .= "	t_playlist_movie_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_movie_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_movie_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_movie_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	(m_common_movie.sta_dt <= :end_dt or m_common_movie.sta_dt is null) and ";
		$query_str .= "	(m_common_movie.end_dt >= :sta_dt or m_common_movie.end_dt is null) and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		$query_str .= ") as playlist_movie ";
		$query_str .= "order by ";
		$query_str .= "	playlist_movie.display_order ";

		$arr_bind_param = array();
		$arr_bind_param[":draw_area_id"] = $draw_area_id;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}


	/**
	 * Get image list in playlist
	 *
	 * @param String	$playlist_id	Playlist ID
	 * @param String	$draw_area_id	Drawing area ID
	 * @return array					Acquisition record
	 */
	function sel_arr_image_by_playlist_id_draw_area_id($playlist_id, $draw_area_id)
	{
		$query_str = "select ";
		$query_str .= "	playlist_image.image_id, ";
		$query_str .= "	playlist_image.image_name, ";
		$query_str .= "	playlist_image.orig_file_dir, ";
		$query_str .= "	playlist_image.file_name, ";
		$query_str .= "	playlist_image.orig_file_name, ";
		$query_str .= "	playlist_image.orig_file_exte, ";
		$query_str .= "	to_char(playlist_image.sta_dt, 'YY-MM-DD HH24:MI') as sta_dt, ";
		$query_str .= "	to_char(playlist_image.end_dt, 'YY-MM-DD HH24:MI') as end_dt, ";
		$query_str .= "	playlist_image.draw_area_id, ";
		$query_str .= "	playlist_image.display_order ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.image_name, ";
		$query_str .= "	m_image.orig_file_dir, ";
		$query_str .= "	m_image.file_name, ";
		$query_str .= "	m_image.orig_file_name, ";
		$query_str .= "	m_image.orig_file_exte, ";
		$query_str .= "	m_image.sta_dt, ";
		$query_str .= "	m_image.end_dt, ";
		$query_str .= "	t_playlist_image_rela.draw_area_id, ";
		$query_str .= "	t_playlist_image_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "on ";
		$query_str .= "	m_image.image_id = t_playlist_image_rela.image_id and ";
		$query_str .= "	t_playlist_image_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";

		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	'(共通) ' || m_common_image.image_name, ";
		$query_str .= "	m_common_image.orig_file_dir, ";
		$query_str .= "	m_common_image.file_name, ";
		$query_str .= "	m_common_image.orig_file_name, ";
		$query_str .= "	m_common_image.orig_file_exte, ";
		$query_str .= "	m_common_image.sta_dt, ";
		$query_str .= "	m_common_image.end_dt, ";
		$query_str .= "	t_playlist_image_rela.draw_area_id, ";
		$query_str .= "	t_playlist_image_rela.display_order ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "join ";
		$query_str .= "	t_playlist_image_rela ";
		$query_str .= "on ";
		$query_str .= "	m_common_image.image_id = t_playlist_image_rela.image_id and ";
		$query_str .= "	t_playlist_image_rela.draw_area_id = :draw_area_id and ";
		$query_str .= "	t_playlist_image_rela.playlist_id = :playlist_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_playlist_image_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_playlist_image_rela.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		$query_str .= "	) as playlist_image ";
		$query_str .= "order by ";
		$query_str .= "	playlist_image.display_order ";

		$arr_bind_param = array();
		$arr_bind_param[":draw_area_id"] = $draw_area_id;
		$arr_bind_param[":playlist_id"] = $playlist_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

		/**
	 * Get all client IDs and name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_id_name()
	{
		$query_str = "select ";
		$query_str .= "	client_id, ";
		$query_str .= "	client_name ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	client_name, ";
		$query_str .= "	client_id desc ";

		$query = DB::query(Database::SELECT, $query_str);

		return $query->execute($this->db, true);
	}


	/**
	 * Get playlist list
	 *
	 * @param stdClass	$search			Search condition
	 * @return array					Acquisition record
	 */
	function sel_arr_playlist_extra($search)
	{
		//Search condition
		$now = Request::$request_dt;
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_playlist_name)){
			$arr_playlist_name = $search->arr_playlist_name;
		}
		if(!empty($search->arr_movie_name)){
			$arr_movie_name = $search->arr_movie_name;
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

		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		$offset = $search->offset;

		$arr_bind_param = array();
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;
		if((isset($search->sta_dt) && $search->sta_dt !== "") && (isset($search->end_dt) && $search->end_dt !== "")){
			$sta_dt = $search->sta_dt;
			$end_dt = $search->end_dt;
			$arr_bind_param[":sta_dt"] = $sta_dt;
			$arr_bind_param[":end_dt"] = $end_dt;
		}

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
		$query_str .= "						t_prog_inner.sta_dt <= :sta_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :end_dt or t_prog_inner.end_dt is null) and ";
		if(isset($search->client_id)){
			$query_str .= "						t_prog_inner.client_id = :client_id and ";
		}
		$query_str .= "						t_prog_inner.del_flag = 0 ";
		$query_str .= "				) and ";
		$query_str .= "				(t_prog_outer.end_dt > :end_dt or t_prog_outer.end_dt is null) and ";
		if(isset($search->client_id)){
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
		if(isset($search->client_id)){
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
		$query_str .= "				t_prog_outer.sta_dt > :sta_dt and ";
		if(isset($search->client_id)){
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
		if(isset($search->client_id)){
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
		if(isset($search->client_id)){
			$query_str .= "				t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl.del_flag = 0 ";
		$query_str .= "		join ";
		$query_str .= "			t_prog_playlist_rela ";
		$query_str .= "		on ";
		$query_str .= "			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and ";
		$query_str .= "			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and ";
		if(isset($search->client_id)){
			$query_str .= "			t_prog_playlist_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_playlist_rela.del_flag = 0 ";
		$query_str .= "		where ";
		if(isset($search->client_id)){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "			t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "	) as prog_cnt_rgl, ";	//For judging CH allocation
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	m_timezone.timezone_id, ";
		$query_str .= "	m_timezone.timezone_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and ";
		$query_str .= "	m_draw_tmpl.del_flag = 0 ";
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
		$query_str .= "join ";
		$query_str .= "	m_timezone ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.timezone_id = m_timezone.timezone_id and ";
		$query_str .= "	m_timezone.del_flag = 0 ";
		$query_str .= "where ";
		// Valid period determination
		if(!empty($sta_dt) && $sta_dt !== ""){
			$query_str .= "	t_playlist.sta_dt <= :end_dt and ";
			$query_str .= "	(t_playlist.end_dt > :sta_dt or t_playlist.end_dt is null) and ";
		}

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

		if(isset($commonplaylist) && $commonplaylist == true){
			$query_str .= "	t_playlist.timezone_id <> 1 and ";
		} elseif(isset($commonplaylist) && $commonplaylist == false){
			$query_str .= "	t_playlist.timezone_id = 1 and ";
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
		if(isset($search->client_id)){
			$query_str .= "	t_playlist.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $search->client_id;
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
}
