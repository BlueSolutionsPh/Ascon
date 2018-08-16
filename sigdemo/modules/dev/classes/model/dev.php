<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Dev extends Model
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
	 * Acquire store
	 *
	 * @param String	$shop_id	店舗ID
	 * @return array				Acquisition record
	 */
	public function sel_shop($shop_id)
	{
		$query_str = "select ";
		$query_str .= "	m_shop.shop_id, ";
		$query_str .= "	m_shop.client_id ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_shop.client_id = m_client.client_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_client.client_id = :client_id and ";
		}
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		if(isset($this->client_id)){
			$query_str .= "	m_shop.client_id = :client_id and ";
		}
		$query_str .= "	m_shop.shop_id = :shop_id and ";
		$query_str .= "	m_shop.del_flag = 0 ";

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
	 * Acquire all terminals
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_dev($search)
	{
		//Search condition
		if(isset($search->client_id) && $search->client_id !== ""){
			$this->client_id = $search->client_id;
		}
		if(isset($search->shop) && $search->shop !== ""){
			$shop_id = $search->shop;
		}
		if(isset($search->booth_id) && $search->booth_id !== ""){
			$booth_id = $search->booth_id;
		}
		if(isset($search->floor_id) && $search->floor_id !== ""){
			$floor_id = $search->floor_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}

		if(!empty($search->arr_serial_no)){
			$arr_serial_no = $search->arr_serial_no;
		}
		if(!empty($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		if(!empty($search->arr_note)){
			$arr_note = $search->arr_note;
		}
		if(isset($search->invalid_flag) && $search->invalid_flag !== ""){
			$invalid_flag = $search->invalid_flag;
		}
		if(isset($search->mail_flag) && $search->mail_flag !== ""){
			$mail_flag = $search->mail_flag;
		}
		if(isset($search->dl_status) && $search->dl_status !== ""){
			$dl_status = $search->dl_status;
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
		$query_str .= "join ";
		$query_str .= "	m_booth ";
		$query_str .= "on ";
		$query_str .= "	m_dev.booth_id = m_booth.booth_id and ";
		$query_str .= "	m_booth.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_floor ";
		$query_str .= "on ";
		$query_str .= "	m_dev.floor_id = m_floor.floor_id and ";
		$query_str .= "	m_floor.del_flag = 0 ";
		$query_str .= "where ";

		//Search condition (facility name) addition
		if(isset($shop_id)){
			$query_str .= "	m_dev.shop_id = :shop_id and ";
			$arr_bind_param[":shop_id"] = $shop_id;
		}
		//Add search condition (booth name)
		if(isset($booth_id)){
			$query_str .= "	m_dev.booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $booth_id;
		}
		//Search condition (installation floor) added
		if(isset($floor_id)){
			$query_str .= "	m_dev.floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $floor_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	m_dev.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}

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

		//Search condition (terminal tag) addition
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

		//Add search condition (serial number)
		if(!empty($arr_serial_no)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_serial_no as $serial_no){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.serial_no ilike :serial_no_" . $i . " ";
				$arr_bind_param[":serial_no_" . $i] = "%" . $serial_no . "%";
				$i++;
			}
			$query_str .= "	) and ";
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

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= "		m_dev.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}

		//Search condition (remarks) added
		if(!empty($arr_note)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_note as $note){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.note ilike :note_" . $i . " ";
				$arr_bind_param[":note_" . $i] = "%" . $note . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		//Search condition (state) addition
		if(isset($invalid_flag) && $invalid_flag !== ""){
			$query_str .= "		m_dev.invalid_flag = :invalid_flag and ";
			$arr_bind_param[":invalid_flag"] = $invalid_flag;
		}

		//Add search condition (monitoring)
		if(isset($mail_flag) && $mail_flag !== ""){
			$query_str .= "		m_dev.mail_flag = :mail_flag and ";
			$arr_bind_param[":mail_flag"] = $mail_flag;
		}

		//Add search condition (DL)
		if(isset($dl_status) && $dl_status !== ""){
			$query_str .= "		m_dev.download_status = :dl_status and ";
			$arr_bind_param[":dl_status"] = $dl_status;
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
		if(isset($search->client_id) && $search->client_id !== ""){
			$this->client_id = $search->client_id;
		}
		if(isset($search->shop) && $search->shop !== ""){
			$shop_id = $search->shop;
		}
		if(isset($search->booth_id) && $search->booth_id !== ""){
			$booth_id = $search->booth_id;
		}
		if(isset($search->floor_id) && $search->floor_id !== ""){
			$floor_id = $search->floor_id;
		}
		if(isset($search->sex_id) && $search->sex_id !== ""){
			$sex_id = $search->sex_id;
		}

		if(!empty($search->arr_serial_no)){
			$arr_serial_no = $search->arr_serial_no;
		}
		if(!empty($search->arr_dev_name)){
			$arr_dev_name = $search->arr_dev_name;
		}
		if(isset($search->ants_version) && $search->ants_version !== ""){
			$ants_version = $search->ants_version;
		}
		if(!empty($search->arr_note)){
			$arr_note = $search->arr_note;
		}
		if(isset($search->invalid_flag) && $search->invalid_flag !== ""){
			$invalid_flag = $search->invalid_flag;
		}
		if(isset($search->mail_flag) && $search->mail_flag !== ""){
			$mail_flag = $search->mail_flag;
		}
		if(isset($search->dl_status) && $search->dl_status !== ""){
			$dl_status = $search->dl_status;
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
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.serial_no, ";
		$query_str .= "	m_dev.sex_id, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.unit_flag, ";
		$query_str .= "	m_dev.ants_version, ";
		$query_str .= "	m_dev.invalid_flag, ";
		$query_str .= "	m_dev.mail_flag, ";
		$query_str .= "	m_dev.service_id, ";
		$query_str .= "	m_dev.download_status, ";
		$query_str .= "	m_shop.shop_id, ";
		$query_str .= "	m_shop.shop_name, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	m_booth.booth_id, ";
		$query_str .= "	m_booth.booth_name, ";
		$query_str .= "	m_floor.floor_id, ";
		$query_str .= "	m_floor.floor_name ";
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
		$query_str .= "join ";
		$query_str .= "	m_booth ";
		$query_str .= "on ";
		$query_str .= "	m_dev.booth_id = m_booth.booth_id and ";
		$query_str .= "	m_booth.del_flag = 0 ";
		$query_str .= "join ";
		$query_str .= "	m_floor ";
		$query_str .= "on ";
		$query_str .= "	m_dev.floor_id = m_floor.floor_id and ";
		$query_str .= "	m_floor.del_flag = 0 ";

		$query_str .= "where ";

		//Search condition (facility name) addition
		if(isset($shop_id)){
			$query_str .= "	m_dev.shop_id = :shop_id and ";
			$arr_bind_param[":shop_id"] = $shop_id;
		}
		//Add search condition (booth name)
		if(isset($booth_id)){
			$query_str .= "	m_dev.booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $booth_id;
		}
		//Search condition (installation floor) added
		if(isset($floor_id)){
			$query_str .= "	m_dev.floor_id = :floor_id and ";
			$arr_bind_param[":floor_id"] = $floor_id;
		}
		//Search condition (gender) addition
		if(isset($sex_id)){
			$query_str .= "	m_dev.sex_id = :sex_id and ";
			$arr_bind_param[":sex_id"] = $sex_id;
		}

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

		//Add search condition (serial number)
		if(!empty($arr_serial_no)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_serial_no as $serial_no){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.serial_no ilike :serial_no_" . $i . " ";
				$arr_bind_param[":serial_no_" . $i] = "%" . $serial_no . "%";
				$i++;
			}
			$query_str .= "	) and ";
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

		//Search condition (ant's version) added
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= "		m_dev.ants_version = :ants_version and ";
			$arr_bind_param[":ants_version"] = $ants_version;
		}

		//Search condition (remarks) added
		if(!empty($arr_note)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_note as $note){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_dev.note ilike :note_" . $i . " ";
				$arr_bind_param[":note_" . $i] = "%" . $note . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		//Search condition (state) addition
		if(isset($invalid_flag) && $invalid_flag !== ""){
			$query_str .= "		m_dev.invalid_flag = :invalid_flag and ";
			$arr_bind_param[":invalid_flag"] = $invalid_flag;
		}

		//Add search condition (monitoring)
		if(isset($mail_flag) && $mail_flag !== ""){
			$query_str .= "		m_dev.mail_flag = :mail_flag and ";
			$arr_bind_param[":mail_flag"] = $mail_flag;
		}

		//Add search condition (DL)
		if(isset($dl_status) && $dl_status !== ""){
			$query_str .= "		m_dev.download_status = :dl_status and ";
			$arr_bind_param[":dl_status"] = $dl_status;
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
	 * @param	String	$dev		Terminal information
	 * @return	array				Acquisition record
	 */
	public function sel_arr_dev_tag_by_dev_id($dev)
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
		$query_str .= "order by ";
		$query_str .= "	m_dev_tag.dev_tag_name ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev->dev_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * 端末属性一覧取得
	 * @param	String	$dev		Terminal information
	 * @return	array				Acquisition record
	 */
	public function sel_arr_dev_property_by_dev_id($dev)
	{
		$query_str = "select ";
		$query_str .= "	m_property.property_id, ";
		$query_str .= "	m_property.property_name ";
		$query_str .= "from ";
		$query_str .= "	m_property ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_dev_property_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_dev ";
		$query_str .= "		on ";
		$query_str .= "			t_dev_property_rela.dev_id = m_dev.dev_id and ";
		$query_str .= "			m_dev.dev_id = :dev_id and ";
		$query_str .= "			m_dev.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_property.property_id = t_dev_property_rela.property_id and ";
		$query_str .= "			t_dev_property_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		if(isset($this->client_id)){
			$query_str .= "	client_id = :client_id and ";
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_property.property_name ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev->dev_id;
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
		$query_str .= "order by ";
		$query_str .= "	m_shop_tag.shop_tag_name ";

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
	 * Obtain terminal list download list download log list
	 * @param	String	$dev_id		Device ID
	 * @return	array				Acquisition record
	 */
	public function sel_arr_dev_prog_dl_log_by_dev_id($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	t_dev_prog_dl_log.sta_dt, ";
		$query_str .= "	t_dev_prog_dl_log.end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_dev_prog_dl_log ";
		$query_str .= "where ";
		$query_str .= "	t_dev_prog_dl_log.dev_id = :dev_id and ";
		$query_str .= "	t_dev_prog_dl_log.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_prog_dl_log.dev_prog_dl_log_id desc ";
		$query_str .= "limit 1 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Obtain terminal related HTML download log list
	 * @param	String	$dev_id		Device ID
	 * @return	array				Acquisition record
	 */
	public function sel_arr_dev_html_rela_dl_log_by_dev_id($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	t_dev_html_rela_dl_log.sta_dt, ";
		$query_str .= "	t_dev_html_rela_dl_log.end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela_dl_log ";
		$query_str .= "where ";
		$query_str .= "	t_dev_html_rela_dl_log.dev_id = :dev_id and ";
		$query_str .= "	t_dev_html_rela_dl_log.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_dev_html_rela_dl_log.dev_html_rela_dl_log_id desc ";
		$query_str .= "limit 1 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get a device
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_dev($dev_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.client_id, ";
		$query_str .= "	m_dev.booth_id, ";
		$query_str .= "	m_dev.floor_id, ";
		$query_str .= "	m_dev.sex_id, ";
		$query_str .= "	m_dev.unit_flag, ";
		$query_str .= "	m_dev.shop_id, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.serial_no, ";
		$query_str .= "	m_dev.ants_version, ";
		$query_str .= "	m_dev.note, ";
		$query_str .= "	m_dev.invalid_flag, ";
		$query_str .= "	m_dev.mail_flag, ";
		$query_str .= "	m_dev.service_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_dev.client_id = :client_id and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";

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
	 * Retrieve the number of terminals for each service
	 *
	 * @param stdClass	$service_id		Service ID
	 * @return array					Acquisition record
	 */
	public function sel_cnt_service_dev($service_id)
	{
		$query_str = "select ";
		$query_str .= "	count(dev.dev_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
//		$query_str .= "	m_dev.client_id = :client_id and ";
		$query_str .= "	m_dev.service_id = :service_id and ";
		$query_str .= "	m_dev.invalid_flag = 0 and ";
		$query_str .= "	m_dev.del_flag = 0 ";
		$query_str .= ") dev ";

		$arr_bind_param = array();
//		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":service_id"] = $service_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get terminal list of each service
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_service_dev($service_id, $ants_version)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id, ";
		$query_str .= "	m_dev.client_id, ";
		$query_str .= "	m_dev.booth_id, ";
		$query_str .= "	m_dev.floor_id, ";
		$query_str .= "	m_dev.sex_id, ";
		$query_str .= "	m_dev.unit_flag, ";
		$query_str .= "	m_dev.serial_no, ";
		$query_str .= "	m_dev.dev_name, ";
		$query_str .= "	m_dev.shop_id, ";
		$query_str .= "	m_shop.shop_name ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "join ";
		$query_str .= "	m_shop ";
		$query_str .= "on ";
		$query_str .= "	m_dev.shop_id = m_shop.shop_id and ";
		$query_str .= "	m_shop.del_flag = 0 ";
		$query_str .= "where ";
//		$query_str .= "	m_dev.client_id = :client_id and ";
		$query_str .= "	m_dev.service_id = :service_id and ";
		$query_str .= "	m_dev.invalid_flag = 0 and ";
		if(isset($ants_version) && $ants_version !== ""){
			$query_str .= " m_dev.ants_version = :ants_version and ";
		}
		$query_str .= "	m_dev.del_flag = 0 ";

		$arr_bind_param = array();
//		$arr_bind_param[":client_id"] = $this->client_id;
		$arr_bind_param[":service_id"] = $service_id;
		if(isset($ants_version) && $ants_version !== ""){
			$arr_bind_param[":ants_version"] = $ants_version;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
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
	 * Acquire active terminal HTML relation from terminal ID
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	function sel_dev_html_rela($dev_id){
		$now = Request::$request_dt;
		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	dev_html_rela.html_id, ";
		$query_str .= "	dev_html_rela.html_name ";
		$query_str .= "from ";
		$query_str .= "	( ";
		$query_str .= "select ";
		$query_str .= "	t_dev_html_rela.dev_html_rela_id, ";
		$query_str .= "	t_dev_html_rela.sta_dt, ";
		$query_str .= "	t_dev_html_rela.end_dt, ";
		$query_str .= "	m_html.html_id, ";
		$query_str .= "	m_html.html_name ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
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
		$query_str .= "left join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";
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
		$query_str .= "	m_html.html_id, ";
		$query_str .= "	m_html.html_name ";
		$query_str .= "from ";
		$query_str .= "	t_dev_html_rela ";
		$query_str .= "left join ";
		$query_str .= "	m_html ";
		$query_str .= "on ";
		$query_str .= "	t_dev_html_rela.html_id = m_html.html_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_html.client_id = :client_id and ";
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
		$query_str .= "limit 1 ";

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
	 * Get an active program guide
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_prog($dev_id){
		$arr_bind_param = array();	//Sequence for search condition
		$arr_bind_param[":dev_id"] = $dev_id;
		$arr_bind_param[":sta_dt"] = Request::$request_dt;
		$arr_bind_param[":end_dt"] = Request::$request_dt;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query_str = "select ";
		$query_str .= "	arr_prog.prog_id, ";
		$query_str .= "	arr_prog.sta_dt ";
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
		$query_str .= "						t_prog_inner.sta_dt <= :sta_dt and ";
		$query_str .= "						(t_prog_inner.end_dt > :end_dt or t_prog_inner.end_dt is null) and ";
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
		$query_str .= "	limit 1 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire active program list (repeat designation)
	 *
	 * @param String	$dev_id		Device ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_prog_rgl($dev_id){
		$prog_date = Request::$request_dt;
		$keys = array("year", "month", "day", "hour", "minute", "second");
		$date_1 = array_combine($keys, preg_split("/[\/: ]/", $prog_date));
		$date_1["dow"] = date("w", strtotime($prog_date));

		$arr_bind_param = array();	//検索条件用配列
		$arr_bind_param[":sta_time"] = substr(Request::$request_dt, 11, 8);
		$arr_bind_param[":end_time"] = substr(Request::$request_dt, 11, 8);
		$arr_bind_param[":year"] = $date_1["year"];
		$arr_bind_param[":month"] = $date_1["month"];
		$arr_bind_param[":day"] = $date_1["day"];
		$arr_bind_param[":dev_id"] = $dev_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query_str = "select ";
		$query_str .= "	t_prog_rgl.prog_id, ";
		$query_str .= "	t_prog_rgl.sta_time ";
		$query_str .= "from ";
		$query_str .= "	t_prog_rgl_grp ";
		$query_str .= "join ";
		$query_str .= "	t_prog_rgl ";
		$query_str .= "on ";
		$query_str .= "	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		$query_str .= "	(t_prog_rgl.sta_time <= :sta_time or t_prog_rgl.sta_time is null) and ";
		$query_str .= "	(t_prog_rgl.end_time > :end_time or t_prog_rgl.end_time is null) and ";
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
		if(isset($this->client_id)){
			$query_str .= "			t_prog_rgl.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_prog_rgl_grp.client_id = :client_id and ";
		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_prog_rgl.priority desc, ";
		$query_str .= "	t_prog_rgl.sta_time desc, ";
		$query_str .= "	t_prog_rgl.prog_id desc ";
		$query_str .= "limit 1 ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get an active playlist
	 *
	 * @param String	$prog_id	Program guide ID
	 * @return array				Acquisition record
	 */
	function sel_playlist_by_prog_id($prog_id){
		$query_str = "select ";
		$query_str .= "	t_playlist.playlist_id, ";
		$query_str .= "	t_playlist.playlist_name ";
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
		$query_str .= "	t_prog_playlist_rela.ch ";
		$query_str .= "limit 1 ";	//Because 1ch is fixed

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
	 * Acquire date-and-time designated program table ID being used by terminal
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
	 * Get client name
	 *
	 * @param String	$client_id		Client ID
	 * @return array					Acquisition record
	 */
	public function sel_client_name($client_id)
	{
		$query_str = "select ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";
		$query_str .= "	m_client.client_id = :client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":client_id"] = $client_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Device main key number assignment
	 *
	 * @return int		The assigned dev_id
	 */
	public function sel_next_dev_id()
	{
		$dev_id = null;
		try{
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$dev_id = $m_dev->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$dev_id = null;
		}
		return $dev_id;
	}

	/**
	 * Device registration
	 *
	 * @param stdClass	$dev		Terminal
	 * @return bool					true = success, false = failure
	 */
	public function ins_dev($dev)
	{
		$ret = true;
		try{
			$m_dev = new Model_M_Dev($this->db, $dev->client_id);
			$ret = $m_dev->ins($dev);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
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
	 * Delete terminal
	 *
	 * @param String	$dev		Terminal
	 * @return bool					true = success, false = failure
	 */
	public function del_dev($dev)
	{
		$ret = true;
		try{
			//Terminal HTML related download log
			$t_dev_html_rela_dl_log = new Model_T_Dev_Html_Rela_Dl_Log($this->db);
			$dev_html_rela_dl_log = new stdClass();
			$dev_html_rela_dl_log->dev_id      = $dev->dev_id;
			$dev_html_rela_dl_log->update_user = $dev->update_user;
			$dev_html_rela_dl_log->update_dt   = $dev->update_dt;
			$t_dev_html_rela_dl_log->del_by_dev_id($dev_html_rela_dl_log);

			//Terminal HTML related
			$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $this->client_id);
			$dev_html_rela = new stdClass();
			$dev_html_rela->dev_id      = $dev->dev_id;
			$dev_html_rela->update_user = $dev->update_user;
			$dev_html_rela->update_dt   = $dev->update_dt;
			$t_dev_html_rela->del_by_dev_id($dev_html_rela);

			//Program guide download log
			$t_dev_prog_dl_log = new Model_T_Dev_Prog_Dl_Log($this->db);
			$dev_prog_dl_log = new stdClass();
			$dev_prog_dl_log->dev_id = $dev->dev_id;
			$dev_prog_dl_log->update_user = $dev->update_user;
			$dev_prog_dl_log->update_dt = $dev->update_dt;
			$t_dev_prog_dl_log->del_by_dev_id($dev_prog_dl_log);

			//Device status log
			$t_dev_status_log = new Model_T_Dev_Status_Log($this->db);
			$dev_status_log = new stdClass();
			$dev_status_log->dev_id = $dev->dev_id;
			$dev_status_log->update_user = $dev->update_user;
			$dev_status_log->update_dt = $dev->update_dt;
			$t_dev_status_log->del_by_dev_id($dev_status_log);

			//Acquisition of date and time designated program list during terminal use
			$arr_prog = $this->sel_arr_prog_id($dev->dev_id);
			foreach($arr_prog as $prog){
				$prog_id = $prog->prog_id;

				//Date Specified Program Guide Playlist Related
				$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
				$prog_playlist_rela = new stdClass();
				$prog_playlist_rela->prog_id     = $prog_id;
				$prog_playlist_rela->update_user = $dev->update_user;
				$prog_playlist_rela->update_dt   = $dev->update_dt;
				$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

				//Date Specified Program Guide
				$t_prog = new Model_T_Prog($this->db, $this->client_id);
				$prog = new stdClass();
				$prog->prog_id     = $prog_id;
				$prog->update_user = $dev->update_user;
				$prog->update_dt   = $dev->update_dt;
				$t_prog->del($prog);
			}

			//Acquire repetitively specified program list while using terminal
			$arr_prog_rgl_grp = $this->sel_arr_prog_rgl_grp_id($dev->dev_id);
			foreach($arr_prog_rgl_grp as $prog_rgl_grp){
				$prog_rgl_grp_id = $prog_rgl_grp->prog_rgl_grp_id;
				$arr_prog_rgl    = $this->sel_arr_prog_rgl_id($prog_rgl_grp_id);
				foreach($arr_prog_rgl as $prog_rgl){
					$prog_id = $prog_rgl->prog_id;

					//Repeat Specified Program Guide Playlist Related
					$t_prog_playlist_rela            = new Model_T_Prog_Playlist_Rela($this->db, $this->client_id);
					$prog_playlist_rela              = new stdClass();
					$prog_playlist_rela->prog_id     = $prog_id;
					$prog_playlist_rela->update_user = $dev->update_user;
					$prog_playlist_rela->update_dt   = $dev->update_dt;
					$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

					//Repeatedly specified program guide
					$t_prog_rgl            = new Model_T_Prog_Rgl($this->db, $this->client_id);
					$prog_rgl              = new stdClass();
					$prog_rgl->prog_id     = $prog_id;
					$prog_rgl->update_user = $dev->update_user;
					$prog_rgl->update_dt   = $dev->update_dt;
					$t_prog_rgl->del($prog_rgl);
				}

				//Repeatedly designated program guide group
				$t_prog_rgl_grp                = new Model_T_Prog_Rgl_Grp($this->db, $this->client_id);
				$prog_rgl_grp                  = new stdClass();
				$prog_rgl_grp->prog_rgl_grp_id = $prog_rgl_grp_id;
				$prog_rgl_grp->update_user     = $dev->update_user;
				$prog_rgl_grp->update_dt       = $dev->update_dt;
				$t_prog_rgl_grp->del($prog_rgl_grp);
			}

			//Terminal tag related
			$t_dev_tag_rela = new Model_T_Dev_Tag_Rela($this->db, $this->client_id);
			$dev_tag_rela = new stdClass();
			$dev_tag_rela->dev_id = $dev->dev_id;
			$dev_tag_rela->update_user = $dev->update_user;
			$dev_tag_rela->update_dt = $dev->update_dt;
			$t_dev_tag_rela->del_by_dev_id($dev_tag_rela);

			//Terminal attribute related
			$t_dev_property_rela = new Model_T_Dev_Property_Rela($this->db, $this->client_id);
			$dev_property_rela = new stdClass();
			$dev_property_rela->dev_id      = $dev->dev_id;
			$dev_property_rela->update_user = $dev->update_user;
			$dev_property_rela->update_dt   = $dev->update_dt;
			$t_dev_property_rela->del_by_dev_id($dev_property_rela);

			//Terminal master
			$m_dev = new Model_M_Dev($this->db, $this->client_id);
			$m_dev->del($dev);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Tag tag related registration
	 *
	 * @param stdClass	dev_tag_rela	Terminal tag related
	 * @return bool						true = success, false = failure
	 */
	public function ins_dev_tag_rela($dev_tag_rela)
	{
		$ret = true;
		try{
			$m_dev_tag_rela = new Model_T_Dev_Tag_Rela($this->db, $dev_tag_rela->client_id);
			$ret = $m_dev_tag_rela->ins($dev_tag_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Terminal attribute related registration
	 *
	 * @param stdClass	dev_property_rela	Terminal tag related
	 * @return bool						true = success, false = failure
	 */
	public function ins_dev_property_rela($dev_property_rela)
	{
		$ret = true;
		try{
			$m_dev_property_rela = new Model_T_Dev_Property_Rela($this->db, $this->client_id);
			$ret = $m_dev_property_rela->ins($dev_property_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Delete terminal tag deletion
	 *
	 * @param stdClass	$dev_tag_rela	Terminal tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_dev_tag_rela($dev_tag_rela)
	{
		$ret = true;
		try{
			$t_dev_tag_rela = new Model_T_Dev_Tag_Rela($this->db, $this->client_id);
			$ret = $t_dev_tag_rela->del_by_dev_id_dev_tag_id($dev_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * 端末属性関連削除
	 *
	 * @param stdClass	$dev_property_rela	Terminal tag related
	 * @return bool						true = success, false = failure
	 */
	public function del_dev_property_rela($dev_property_rela)
	{
		$ret = true;
		try{
			$t_dev_property_rela = new Model_T_Dev_Property_Rela($this->db, $this->client_id);
			$ret = $t_dev_property_rela->del_by_dev_id_property_id($dev_property_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Get an active program guide
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$devId		Device ID
	 * @return array Acquisition record
	 */
	function getArrActiveProg($now, $devId){
		$endDt = date("Y/m/d H:i:s", mktime(STB_DAILY_CHECK_END_TIME_HOUR, STB_DAILY_CHECK_END_TIME_MIN, 0, date("m"), date("d") + STB_DAILY_CHECK_IN_DAYS, date("y")));

		$bindArr = array();	//Sequence for search condition
		$bindArr[':endDt'] = $endDt;
		$bindArr[':now'] = $now;
		$bindArr[':now2'] = $now;
		$bindArr[':devId'] = $devId;
		$bindArr[':devId2'] = $devId;

		$queryStr = "select ";
		$queryStr .= "	arr_prog.prog_id, ";
		$queryStr .= "	arr_prog.sta_dt, ";
		$queryStr .= "	arr_prog.end_dt ";
		$queryStr .= "from ";
		$queryStr .= "	( ";
		$queryStr .= "	select ";
		$queryStr .= "		t_prog.prog_id, ";
		$queryStr .= "		t_prog.sta_dt, ";
		$queryStr .= "		t_prog.end_dt ";
		$queryStr .= "	from ";
		$queryStr .= "		m_dev ";
		$queryStr .= "	join ";
		$queryStr .= "		t_prog ";
		$queryStr .= "	on ";
		$queryStr .= "		m_dev.dev_id = t_prog.dev_id and ";
		$queryStr .= "		t_prog.del_flag = 0 ";
		$queryStr .= "	join ";
		$queryStr .= "		( ";
		$queryStr .= "			select ";
		$queryStr .= "				max(t_prog_outer.prog_id) prog_id, ";
		$queryStr .= "				t_prog_outer.sta_dt, ";
		$queryStr .= "				t_prog_outer.end_dt, ";
		$queryStr .= "				t_prog_outer.dev_id ";
		$queryStr .= "			from ";
		$queryStr .= "				t_prog t_prog_outer ";
		$queryStr .= "			where ";
		$queryStr .= "				exists ( ";
		$queryStr .= "					select ";
		$queryStr .= "						t_prog_inner.prog_id ";
		$queryStr .= "					from ";
		$queryStr .= "						t_prog t_prog_inner ";
		$queryStr .= "					where ";
		$queryStr .= "						t_prog_outer.prog_id = t_prog_inner.prog_id and ";
		$queryStr .= "						t_prog_outer.dev_id = t_prog_inner.dev_id and ";
		$queryStr .= "						t_prog_inner.sta_dt <= :endDt and ";
		$queryStr .= "						(t_prog_inner.end_dt > :now or t_prog_inner.end_dt is null) and ";
		$queryStr .= "						t_prog_inner.del_flag = 0 ";
		$queryStr .= "				) and ";
		$queryStr .= "				(t_prog_outer.end_dt > :now2 or t_prog_outer.end_dt is null) and ";
		$queryStr .= "				t_prog_outer.dev_id = :devId and ";
		$queryStr .= "				t_prog_outer.del_flag = 0 ";
		$queryStr .= "			group by ";
		$queryStr .= "				t_prog_outer.sta_dt, ";
		$queryStr .= "				t_prog_outer.end_dt, ";
		$queryStr .= "				t_prog_outer.dev_id ";
		$queryStr .= "		) tmp_prog ";
		$queryStr .= "	on ";
		$queryStr .= "		t_prog.prog_id = tmp_prog.prog_id ";
		$queryStr .= "	where ";
		$queryStr .= "		m_dev.invalid_flag = 0 and ";
		$queryStr .= "		m_dev.dev_id = :devId2 and ";
		$queryStr .= "		m_dev.del_flag = 0 ";
		$queryStr .= "	) arr_prog ";
		$queryStr .= "	order by ";
		$queryStr .= "		arr_prog.sta_dt desc, ";
		$queryStr .= "		arr_prog.prog_id desc, ";
		$queryStr .= "		arr_prog.end_dt ";

		$query = DB::query(Database::SELECT, $queryStr);
		$query->parameters($bindArr);
		return $query->execute($this->db, true);
	}

	/**
	 * Acquire active program list (repeat designation)
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$devId		Device ID
	 * @return array Acquisition record
	 */
	function getArrActiveProgRgl($now, $devId){
		$bindArr = array();	//Sequence for search condition
		$keys = array("year", "month", "day", "hour", "minute", "second");
		$date_1 = array_combine($keys, preg_split("/[\/: ]/", $now));
		$date_1["dow"] = date("w", strtotime($now));
		$date_1["sta_time"] = STB_DAILY_CHECK_END_TIME_HOUR . ":" . STB_DAILY_CHECK_END_TIME_MIN . ":00";
		$date_1["end_time"] = $date_1["hour"] . ":" . $date_1["minute"] . ":" . $date_1["second"];

		$queryStr = "select ";
		$queryStr .= "	t_prog_rgl.prog_id, ";
		$queryStr .= "	t_prog_rgl.sta_time, ";
		$queryStr .= "	t_prog_rgl.end_time, ";
		$queryStr .= "	t_prog_rgl.year, ";
		$queryStr .= "	t_prog_rgl.month, ";
		$queryStr .= "	t_prog_rgl.day, ";
		$queryStr .= "	t_prog_rgl.mon, ";
		$queryStr .= "	t_prog_rgl.tues, ";
		$queryStr .= "	t_prog_rgl.wednes, ";
		$queryStr .= "	t_prog_rgl.thurs, ";
		$queryStr .= "	t_prog_rgl.fri, ";
		$queryStr .= "	t_prog_rgl.satur, ";
		$queryStr .= "	t_prog_rgl.sun ";
		$queryStr .= "from ";
		$queryStr .= "	t_prog_rgl_grp ";
		$queryStr .= "join ";
		$queryStr .= "	t_prog_rgl ";
		$queryStr .= "on ";
		$queryStr .= "	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and ";
		if(isset($date_2)){
			//Day by day
			$queryStr .= "	( ";
			$queryStr .= "		( ";
			switch($date_1["dow"]){
				case 0:
					$queryStr .= "			sun = :dow and ";
					break;
				case 1:
					$queryStr .= "			mon = :dow and ";
					break;
				case 2:
					$queryStr .= "			tues = :dow and ";
					break;
				case 3:
					$queryStr .= "			wednes = :dow and ";
					break;
				case 4:
					$queryStr .= "			thurs = :dow and ";
					break;
				case 5:
					$queryStr .= "			fri = :dow and ";
					break;
				case 6:
					$queryStr .= "			satur = :dow and ";
					break;
			}
			$queryStr .= "			(t_prog_rgl.year = :year or t_prog_rgl.year = 0) and ";
			$queryStr .= "			(t_prog_rgl.month = :month or t_prog_rgl.month = 0) and ";
			$queryStr .= "			(t_prog_rgl.day = :day or t_prog_rgl.day = 0) and ";
			$queryStr .= "			t_prog_rgl.sta_time <= :sta_time and ";
			$queryStr .= "			t_prog_rgl.end_time > :end_time ";
			$queryStr .= "		) or ( ";
			switch($date_2["dow"]){
				case 0:
					$queryStr .= "			t_prog_rgl.sun = :dow2 and ";
					break;
				case 1:
					$queryStr .= "			t_prog_rgl.mon = :dow2 and ";
					break;
				case 2:
					$queryStr .= "			t_prog_rgl.tues = :dow2 and ";
					break;
				case 3:
					$queryStr .= "			t_prog_rgl.wednes = :dow2 and ";
					break;
				case 4:
					$queryStr .= "			t_prog_rgl.thurs = :dow2 and ";
					break;
				case 5:
					$queryStr .= "			t_prog_rgl.fri = :dow2 and ";
					break;
				case 6:
					$queryStr .= "			t_prog_rgl.satur = :dow2 and ";
					break;
			}
			$queryStr .= "			(t_prog_rgl.year = :year2 or t_prog_rgl.year = 0) and ";
			$queryStr .= "			(t_prog_rgl.month = :month2 or t_prog_rgl.month = 0) and ";
			$queryStr .= "			(t_prog_rgl.day = :day2 or t_prog_rgl.day = 0) and ";
			$queryStr .= "			t_prog_rgl.sta_time <= :sta_time2 and ";
			$queryStr .= "			t_prog_rgl.end_time > :end_time2 ";
			$queryStr .= "		) ";
			$queryStr .= "	) and ";

			$bindArr[':dow'] = 1;
			$bindArr[':year'] = $date_1["year"];
			$bindArr[':month'] = $date_1["month"];
			$bindArr[':day'] = $date_1["day"];
			$bindArr[':sta_time'] = $date_1["sta_time"];
			$bindArr[':end_time'] = $date_1["end_time"];
			$bindArr[':dow2'] = 1;
			$bindArr[':year2'] = $date_2["year"];
			$bindArr[':month2'] = $date_2["month"];
			$bindArr[':day2'] = $date_2["day"];
			$bindArr[':sta_time2'] = $date_2["sta_time"];
			$bindArr[':end_time2'] = $date_2["end_time"];
		} else {
			//Day by day nothing
			$queryStr .= "	( ";
			$queryStr .= "		( ";
			switch($date_1["dow"]){
				case 0:
					$queryStr .= "			t_prog_rgl.sun = :dow and ";
					break;
				case 1:
					$queryStr .= "			t_prog_rgl.mon = :dow and ";
					break;
				case 2:
					$queryStr .= "			t_prog_rgl.tues = :dow and ";
					break;
				case 3:
					$queryStr .= "			t_prog_rgl.wednes = :dow and ";
					break;
				case 4:
					$queryStr .= "			t_prog_rgl.thurs = :dow and ";
					break;
				case 5:
					$queryStr .= "			t_prog_rgl.fri = :dow and ";
					break;
				case 6:
					$queryStr .= "			t_prog_rgl.satur = :dow and ";
					break;
			}
			$queryStr .= "			(t_prog_rgl.year = :year or t_prog_rgl.year = 0) and ";
			$queryStr .= "			(t_prog_rgl.month = :month or t_prog_rgl.month = 0) and ";
			$queryStr .= "			(t_prog_rgl.day = :day or t_prog_rgl.day = 0) and ";
			$queryStr .= "			t_prog_rgl.sta_time <= :sta_time and ";
			$queryStr .= "			t_prog_rgl.end_time > :end_time ";
			$queryStr .= "		) ";
			$queryStr .= "	) and ";
			$bindArr[':dow'] = 1;
			$bindArr[':year'] = $date_1["year"];
			$bindArr[':month'] = $date_1["month"];
			$bindArr[':day'] = $date_1["day"];
			$bindArr[':sta_time'] = $date_1["sta_time"];
			$bindArr[':end_time'] = $date_1["end_time"];
		}
		$queryStr .= "	t_prog_rgl.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_prog_rgl_grp.dev_id = :dev_id and ";
		$bindArr[':dev_id'] = $devId;
		$queryStr .= "	t_prog_rgl_grp.del_flag = 0 ";
		$queryStr .= "order by ";
		$queryStr .= "	t_prog_rgl.priority desc, ";
		$queryStr .= "	t_prog_rgl.sta_time, ";
		$queryStr .= "	t_prog_rgl.prog_id desc ";

		$query = DB::query(Database::SELECT, $queryStr);
		$query->parameters($bindArr);
		return $query->execute($this->db, true);
	}

	/**
	 * Retrieve list of terminals to be checked for program guide setting
	 *
	 */
	function getLsDev($client_id, $ants_version){
		$bindArr = array();	//Sequence for search condition
		$bindArr[":client_id"] = $client_id;

		$queryStr = "select ";
		$queryStr .= "	m_dev.dev_id, ";
		$queryStr .= "	m_dev.serial_no, ";
		$queryStr .= "	m_dev.dev_name ";
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "where ";
		$queryStr .= "	client_id = :client_id and ";
		$queryStr .= "	del_flag = 0 and ";
		$queryStr .= "	invalid_flag = 0 and ";
		if(isset($ants_version) && $ants_version !== ""){
			$queryStr .= " m_dev.ants_version = :ants_version and ";
			$bindArr[":ants_version"] = $ants_version;
		}
//		$queryStr .= "	and mail_flag = 0 and ";
		$queryStr .= "	dev_cat = 0 ";

		$query = DB::query(Database::SELECT, $queryStr);
		$query->parameters($bindArr);

		return $query->execute($this->db, true);
	}

	/**
	 * Get a device
	 *
	 * @param String	$serialNo	Device serial number
	 * @param array		$row		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getDev($serialNo){
		$bindArr = array();	//Sequence for search condition
		$bindArr[':serial_no'] = $serialNo;

		$queryStr = "select ";
		$queryStr .= "	m_dev.dev_id, ";
		$queryStr .= "	m_dev.client_id ";
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "where ";
		$queryStr .= "	m_dev.invalid_flag = 0 and ";
		$queryStr .= "	m_dev.serial_no = :serial_no and ";
		$queryStr .= "	m_dev.del_flag = 0 ";

		$query = DB::query(Database::SELECT, $queryStr);
		$query->parameters($bindArr);

		return $query->execute($this->db, true);
	}


	/**
	 * 番組表(繰り返し指定)グループ主キー採番
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
	 * Get all playlist ID and name list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name_playlist($dev)
	{
		$bindArr = array();

		$query_str = "select ";
		$query_str .= "	client_id, ";
		$query_str .= "	playlist_id, ";
		$query_str .= "	playlist_name, ";
		$query_str .= "	sex_id, ";
		$query_str .= "	deliverymonth_id, ";
		$query_str .= "	timezone_id, ";
		$query_str .= "	sta_dt, ";
		$query_str .= "	end_dt ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "where ";
		if(isset($dev->client_id) && $dev->client_id !== ""){
			$queryStr .= " client_id = :client_id and ";
			$bindArr[":client_id"] = $dev->client_id;
		}
		if(isset($dev->sex_id) && $dev->sex_id !== ""){
			$queryStr .= " sex_id = :sex_id and ";
			$bindArr[":sex_id"] = $dev->sex_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	client_id, ";
		$query_str .= "	playlist_name, ";
		$query_str .= "	playlist_id desc ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($bindArr);
		return $query->execute($this->db, true);
	}


	/**
	 * Get playlist _ video collaboration DB list
	 *
	 * @return	array				Acquisition record
	 */
	public function sel_arr_id_name_playlist_movie_rela($playlist)
	{
		$bindArr = array();

		$query_str = "select ";
		$query_str .= "	playlist_movie_rela_id, ";
		$query_str .= "	playlist_id, ";
		$query_str .= "	movie_id, ";
		$query_str .= "	draw_area_id, ";
		$query_str .= "	client_id, ";
		$query_str .= "	display_order ";
		$query_str .= "from ";
		$query_str .= "	t_playlist_movie_rela ";
		$query_str .= "where ";
		if(isset($playlist->playlist_id) && $playlist->playlist_id !== ""){
			$queryStr .= " playlist = :playlist and ";
			$bindArr[":playlist"] = $playlist->playlist_id;
		}
		$query_str .= "	del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	playlist_id, ";
 		$query_str .= "	display_order desc ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($bindArr);
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
		//検索条件
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
	 * Playlist linkage registration
	 *
	 * @param stdClass	playlist_rela	Playlist related
	 * @return bool						true = success, false = failure
	 */
	public function ins_playlist_rela($playlist)
	{
		$ret = true;
		try{
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $this->client_id);
			$ret = $t_playlist_rela->ins($playlist);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}

		return $ret;
	}

	/**
	 * Play list linkage Primary key number assignment
	 *
	 * @return int		Number assigned playlist_rela_id
	 */
	public function sel_next_playlist_rela_id()
	{
		$playlist_rela_id = null;
		try{
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $this->client_id);
			$playlist_rela_id = $t_playlist_rela->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$playlist_rela_id = null;
		}
		return $playlist_rela_id;
	}

	/**
	 * Program guide registration
	 *
	 * @param stdClass	$prog		A TV schedule
	 * @return bool				true = success, false = failure
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
	 * 番組表プレイリスト関連登録
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
	 * Program list (repeated designation) Group registration
	 *
	 * @param stdClass	$prog_rgl_grp	Program guide (repeated designation) group
	 * @return bool					true = success, false = failure
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
	 *Acquire program list (repeated designation) list
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
	 *Program guide (repeated designation) group deletion
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
//		if(isset($dev->client_id)){
//			$query_str .= "	t_prog_rgl_grp.client_id = :client_id and ";
//			$arr_bind_param[":client_id"] = $dev->client_id;
//		}
		$query_str .= "	t_prog_rgl_grp.del_flag = 0 ";
		$arr_bind_param[":dev_id"] = $dev->dev_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
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
		if(isset($search->booth_id) && $search->booth_id !== ""){
			$booth_id = $search->booth_id;
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
		if(isset($booth_id)){
			$query_str .= "	m_booth.booth_id = :booth_id and ";
			$arr_bind_param[":booth_id"] = $booth_id;
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
}
