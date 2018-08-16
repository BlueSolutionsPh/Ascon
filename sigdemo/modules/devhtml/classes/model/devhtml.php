<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Devhtml extends Model
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
	}

	/**
	 * Terminal acquisition
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_dev($dev_id)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$ret = $m_dev->sel_id($dev_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Get terminal name · store name list
	 *
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev_shop()
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.serial_no, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.invalid_flag, ";
		$query_str .= "	m_shop.shop_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	m_dev.invalid_flag = 0 and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.dev_id desc ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get active terminal count
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	function sel_cnt_dev($search){
		$now = Request::$request_dt;
		$arr_bind_param = array();

		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(!empty($search->arr_dev_html_rela_name)){
			$arr_dev_html_rela_name = $search->arr_dev_html_rela_name;
		}
		if(!empty($search->arr_shop_name)){
			$arr_shop_name = $search->arr_shop_name;
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

		$query_str = "select ";
		$query_str .= "	count(dev.dev_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "left join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "exists ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_dev_html_rela ";
		$query_str .= "		where ";
		$query_str .= "			t_dev_html_rela.dev_id = m_dev.dev_id and ";
		$query_str .= "			t_dev_html_rela.end_dt >= :end_dt and ";
		if(isset($this->client_id)){
			$query_str .= "			t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_dev_html_rela.del_flag = 0 ";
		$query_str .= "	) and ";

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
				$query_str .= "	t_dev_tag_rela.client_id = :client_id and ";
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
				$query_str .= "	t_dev_tag_rela.client_id = :client_id and ";
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
				$query_str .= "	t_shop_tag_rela.client_id = :client_id and ";
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
				$query_str .= "	t_shop_tag_rela.client_id = :client_id and ";
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

		//検索条件（端末名）追加
		if(!empty($arr_dev_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_dev_name as $dev_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "		m_dev.dev_name ilike :dev_name" . $i . " ";
				$arr_bind_param[":dev_name" . $i] = "%" . $dev_name . "%";
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

		$query_str .= "	m_dev.invalid_flag = 0 and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= ") dev ";

		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$arr_bind_param[":end_dt"] = $now;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire active terminal list
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	function sel_arr_dev($search){
		$now = Request::$request_dt;
		$arr_bind_param = array();

		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(!empty($search->arr_dev_html_rela_name)){
			$arr_dev_html_rela_name = $search->arr_dev_html_rela_name;
		}
		if(!empty($search->arr_shop_name)){
			$arr_shop_name = $search->arr_shop_name;
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
		if(isset($search->offset)){
			$offset = $search->offset;
		}

		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.dev_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "left join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "exists ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_dev_html_rela ";
		$query_str .= "		where ";
		$query_str .= "			t_dev_html_rela.dev_id = m_dev.dev_id and ";
		$query_str .= "			t_dev_html_rela.end_dt >= :end_dt and ";
		if(isset($this->client_id)){
			$query_str .= "			t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_dev_html_rela.del_flag = 0 ";
		$query_str .= "	) and ";

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
				$query_str .= "	t_dev_tag_rela.client_id = :client_id and ";
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
				$query_str .= "	t_dev_tag_rela.client_id = :client_id and ";
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
				$query_str .= "	t_shop_tag_rela.client_id = :client_id and ";
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
				$query_str .= "	t_shop_tag_rela.client_id = :client_id and ";
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

		//Search condition (terminal name) addition
		if(!empty($arr_dev_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_dev_name as $dev_name){
				if($i > 0){
					$query_str .=  " and ";
				}
				$query_str .= "		m_dev.dev_name ilike :dev_name" . $i . " ";
				$arr_bind_param[":dev_name" . $i] = "%" . $dev_name . "%";
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

		$query_str .= "	m_dev.invalid_flag = 0 and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.dev_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE;
		if(isset($offset)){
			$query_str .= "offset :offset";
			$arr_bind_param[":offset"] = $offset;
		}

		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$arr_bind_param[":end_dt"] = $now;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire active terminal HTML relation from terminal ID
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	function sel_arr_dev_html_rela($dev_id){
		$now = Request::$request_dt;
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	dev_html_rela.sta_dt, ";
		$query_str .= "	dev_html_rela.end_dt, ";
		$query_str .= "	dev_html_rela.update_user, ";
		$query_str .= "	dev_html_rela.html_name ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	t_dev_html_rela.update_user, ";
		$query_str .= "	m_html.html_name ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			max(t_dev_html_rela_outer.dev_html_rela_id) dev_html_rela_id, ";
		$query_str .= "			t_dev_html_rela_outer.sta_dt, ";
		$query_str .= "			t_dev_html_rela_outer.end_dt, ";
		$query_str .= "			t_dev_html_rela_outer.dev_id ";
		$query_str .= "		from ";
		$query_str .= "			t_dev_html_rela t_dev_html_rela_outer ";
		$query_str .= "		where ";
		$query_str .= "			t_dev_html_rela_outer.dev_id = :dev_id and ";
		$query_str .= "			t_dev_html_rela_outer.sta_dt = ( ";
		$query_str .= "				select ";
		$query_str .= "					max(t_dev_html_rela_inner.sta_dt) ";
		$query_str .= "				from ";
		$query_str .= "					t_dev_html_rela t_dev_html_rela_inner ";
		$query_str .= "				where ";
		$query_str .= "					t_dev_html_rela_inner.dev_id = :dev_id and ";
		$query_str .= "					t_dev_html_rela_inner.sta_dt <= :sta_dt and ";
		$query_str .= "					t_dev_html_rela_inner.end_dt > :end_dt and ";
		if(isset($this->client_id)){
			$query_str .= "					t_dev_html_rela_inner.client_id = :client_id and ";
		}
		$query_str .= "					t_dev_html_rela_inner.del_flag = 0 ";
		$query_str .= "				group by ";
		$query_str .= "					t_dev_html_rela_inner.dev_id ";
		$query_str .= "			) and ";
		if(isset($this->client_id)){
			$query_str .= "			t_dev_html_rela_outer.client_id = :client_id and ";
		}
		$query_str .= "			t_dev_html_rela_outer.del_flag = 0 ";
		$query_str .= "		group by ";
		$query_str .= "			t_dev_html_rela_outer.sta_dt, ";
		$query_str .= "			t_dev_html_rela_outer.end_dt, ";
		$query_str .= "			t_dev_html_rela_outer.dev_id ";
		$query_str .= "	) tmp_dev_html_rela ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id = tmp_dev_html_rela.dev_html_rela_id ";
		$query_str .= "where ";
		$query_str .= "	t_dev_html_rela.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";

		$query_str .= "union all ";

		$query_str .= "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	t_dev_html_rela.update_user, ";
		$query_str .= "	m_html.html_name ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_dev_html_rela.dev_id = :dev_id and ";
		$query_str .= "	t_dev_html_rela.sta_dt > :sta_dt and ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";
		$query_str .= ") dev_html_rela ";
		$query_str .= "order by ";
		$query_str .= "	dev_html_rela.sta_dt, ";
		$query_str .= "	dev_html_rela.end_dt ";
		$query_str .= "limit " . MAX_CNT_PER_PARENT;

		$arr_bind_param[":dev_id"] = $dev_id;
		$arr_bind_param[":sta_dt"] = $now;
		$arr_bind_param[":end_dt"] = $now;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

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
	 * Acquire terminal HTML related name
	 *
	 * @param String	$dev_html_rela_id	Terminal HTML related ID
	 * @return array						Acquisition record
	 */
	function sel_dev_html_rela($dev_html_rela_id){
		$query_str = "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_html.html_name ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "join ";
		$query_str .= "	m_dev ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.dev_id = m_dev.dev_id and ";
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id = :dev_html_rela_id and ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
		}
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_html_rela_id"] = $dev_html_rela_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Retrieve the in-store terminal list
	 *
	 * @param String	$shop_id	Store ID
	 * @return array				Acquisition record
	 */
	function sel_arr_dev_by_shop_id($shop_id){
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$ret = $m_dev->sel_arr_by_shop_id($shop_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Terminal HTML related registration
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function ins_dev_html_rela($dev_html_rela)
	{
		$ret = true;
		try{
			$t_dev_html_rela = new Model_T_Dev_html_Rela($this->db, $this->client_id);
			$ret = $t_dev_html_rela->ins($dev_html_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Terminal HTML related delete
	 *
	 * @param stdClass	$dev_html_rela	Terminal HTML related
	 * @return bool						true = success, false = failure
	 */
	public function del_dev_html_rela($dev_html_rela)
	{
		$ret = true;
		try{
			$t_dev_html_rela = new Model_T_Dev_html_Rela($this->db, $this->client_id);
			$t_dev_html_rela->del($dev_html_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Get terminal name
	 *
	 * @param String	$dev_id			Device ID
	 * @return array					Acquisition record
	 */
	public function sel_dev_name($dev_id)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$ret = $m_dev->sel_name($dev_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Retrieve store name
	 *
	 * @param String	$dev_id			Device ID
	 * @return array					Acquisition record
	 */
	public function sel_shop_name($dev_id)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_shop.shop_name ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		$query_str .= " m_shop.shop_id =  ";
		$query_str .= "(";
		$query_str .= "select ";
		$query_str .= "	m_dev.shop_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= " m_dev.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= " m_dev.del_flag = 0 ";
		$query_str .= ") and ";
		$query_str .= "	m_shop.del_flag = 0 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get number of smartphone delivery
	 *
	 * @param array		$dev_id		Device ID
	 * @param String	$sta_dt		Start date and time
	 * @param String	$end_dt		End date and time
	 * @return array				Acquisition record
	 */
	public function sel_cnt_devhtml_by_arr_dev_id_sta_dt_end_dt($dev_id, $sta_dt, $end_dt)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(t_dev_html_rela.dev_html_rela_id) as cnt ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_dev_html_rela.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= "	( ";
		$query_str .= "	t_dev_html_rela.sta_dt <= :sta_dt and t_dev_html_rela.end_dt > :sta_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt < :end_dt and t_dev_html_rela.end_dt >= :end_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt >= :sta_dt and t_dev_html_rela.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get smartphone delivery
	 *
	 * @param array		$dev_id		Device ID
	 * @param String	$sta_dt		Start date and time
	 * @param String	$end_dt		End date and time
	 * @return array				取得レコード
	 */
	public function sel_arr_devhtml_by_arr_dev_id_sta_dt_end_dt($dev_id, $sta_dt, $end_dt, $limit = true)
	{
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.html_id, ";
		$query_str .= "	to_char(t_dev_html_rela.sta_dt, 'YYYY-MM-DD HH24:MI') as sta_dt, ";
		$query_str .= "	to_char(t_dev_html_rela.end_dt, 'YYYY-MM-DD HH24:MI') as end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	t_dev_html_rela.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	t_dev_html_rela.dev_id = :dev_id and ";
		$arr_bind_param[":dev_id"] = $dev_id;
		$query_str .= "	( ";
		$query_str .= "	t_dev_html_rela.sta_dt <= :sta_dt and t_dev_html_rela.end_dt > :sta_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt < :end_dt and t_dev_html_rela.end_dt >= :end_dt or ";
		$query_str .= "	t_dev_html_rela.sta_dt >= :sta_dt and t_dev_html_rela.end_dt <= :end_dt ";
		$arr_bind_param[":sta_dt"] = $sta_dt;
		$arr_bind_param[":end_dt"] = $end_dt;
		$query_str .= "	) and ";
		$query_str .= "	t_dev_html_rela.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id desc ";
		if($limit){
			$query_str .= "limit " . MAX_CNT_PER_PARENT;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get smart content name
	 *
	 * @param String	$html_id	HTMLID
	 * @return array				Acquisition record
	 */
	function sel_html_name_by_html_id($html_id){
		$query_str = "select ";
		$query_str .= "	m_html.html_name ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		$query_str .= "	m_html.html_id = :html_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "limit 1";

		$arr_bind_param = array();
		$arr_bind_param[":html_id"] = $html_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true, $arr_bind_param);
	}

	/**
	 * Sumaho delivery update
	 *
	 * @param stdClass	$devhtml	Smooth distribution
	 * @return bool					true = success, false = failure
	 */
	public function up_dev_html_rela($devhtml)
	{
		if(isset($this->client_id)){
			$query_str = "update ";
			$query_str .= "	t_dev_html_rela ";
			$query_str .= "set ";
			$query_str .= "	sta_dt = :sta_dt, ";
			$query_str .= "	end_dt = :end_dt, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	dev_html_rela_id = :dev_html_rela_id and ";
			$query_str .= "	del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":sta_dt"] = $devhtml->sta_dt;
			$arr_bind_param[":end_dt"] = $devhtml->end_dt;
			$arr_bind_param[":update_user"] = $devhtml->update_user;
			$arr_bind_param[":update_dt"] = $devhtml->update_dt;
			$arr_bind_param[":client_id"] = $this->client_id;
			$arr_bind_param[":dev_html_rela_id"] = $devhtml->dev_html_rela_id;

			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);

			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}
