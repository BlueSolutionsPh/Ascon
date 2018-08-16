<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Html extends Model
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
	 * Acquire all HTML number
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_html($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_html_name)){
			$arr_html_name = $search->arr_html_name;
		}
		if(isset($search->html_tag_1) && $search->html_tag_1 !== ""){
			$html_tag_1 = $search->html_tag_1;
		}
		if(isset($search->html_tag_2) && $search->html_tag_2 !== ""){
			$html_tag_2 = $search->html_tag_2;
		}
		$tag_and_or = "and";
		if(isset($search->tag_and_or) && $search->tag_and_or !== ""){
			$tag_and_or = $search->tag_and_or;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(html.html_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_html.html_id ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_html.client_id = m_client.client_id and ";
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
		if(isset($html_tag_1) && isset($html_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($html_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_html_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_html_tag_rela.html_id = m_html.html_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_html_tag_rela.html_tag_id = :html_tag_id_1 ";
			$arr_bind_param[":html_tag_id_1"] = $html_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_html_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_html_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($html_tag_1) && isset($html_tag_2)){
			if($tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($html_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_html_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_html_tag_rela.html_id = m_html.html_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_html_tag_rela.html_tag_id = :html_tag_id_2 ";
			$arr_bind_param[":html_tag_id_2"] = $html_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_html_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_html_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($html_tag_1) && isset($html_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($html_tag_1) || isset($html_tag_2)){
			$query_str .= " and ";
		}

		//Search condition (HTML name) added
		if(!empty($arr_html_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_html_name as $html_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_html.html_name ilike :html_name_" . $i . " ";
				$arr_bind_param[":html_name_" . $i] = "%" . $html_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= ") html ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get HTML list
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_html($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_html_name)){
			$arr_html_name = $search->arr_html_name;
		}
		if(isset($search->html_tag_1) && $search->html_tag_1 !== ""){
			$html_tag_1 = $search->html_tag_1;
		}
		if(isset($search->html_tag_2) && $search->html_tag_2 !== ""){
			$html_tag_2 = $search->html_tag_2;
		}
		$tag_and_or = "and";
		if(isset($search->tag_and_or) && $search->tag_and_or !== ""){
			$tag_and_or = $search->tag_and_or;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_html.html_id, ";
		$query_str .= "	m_html.html_name, ";
		$query_str .= "	m_html.orig_file_dir, ";
		$query_str .= "	m_html.file_name, ";
		$query_str .= "	m_html.enc_file_size, ";
		$query_str .= "	m_html.orig_file_name, ";
		$query_str .= "	m_html.orig_file_exte, ";
		$query_str .= "	m_html.orig_file_size, ";
		$query_str .= "	m_html.sta_dt, ";
		$query_str .= "	m_html.end_dt, ";
		$query_str .= "	m_html.update_user, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_html.client_id = m_client.client_id and ";
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
		if(isset($html_tag_1) && isset($html_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($html_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_html_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_html_tag_rela.html_id = m_html.html_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_html_tag_rela.html_tag_id = :html_tag_id_1 ";
			$arr_bind_param[":html_tag_id_1"] = $html_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_html_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_html_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($html_tag_1) && isset($html_tag_2)){
			if($tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($html_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_html_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_html_tag_rela.html_id = m_html.html_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_html_tag_rela.html_tag_id = :html_tag_id_2 ";
			$arr_bind_param[":html_tag_id_2"] = $html_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_html_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_html_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($html_tag_1) && isset($html_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($html_tag_1) || isset($html_tag_2)){
			$query_str .= " and ";
		}

		//Search condition (HTML name) added
		if(!empty($arr_html_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_html_name as $html_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_html.html_name ilike :html_name_" . $i . " ";
				$arr_bind_param[":html_name_" . $i] = "%" . $html_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_html.del_flag = 0 ";
		$query_str .= "order by ";
			if(is_null($this->client_id)){
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	m_html.html_name, ";
		$query_str .= "	m_html.html_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get HTML tag
	 *
	 * @param String	$html_id	HTMLID
	 * @return array				Acquisition record
	 */
	public function sel_arr_html_tag_by_html_id($html_id)
	{
		$query_str = "select ";
		$query_str .= "	m_html_tag.html_tag_id, ";
		$query_str .= "	m_html_tag.html_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_html_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_html_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_html ";
		$query_str .= "		on ";
		$query_str .= "			t_html_tag_rela.html_id = m_html.html_id and ";
		$query_str .= "			m_html.html_id = :html_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_html.client_id = :client_id and ";
		}
		$query_str .= "			m_html.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_html_tag.html_tag_id = t_html_tag_rela.html_tag_id and ";
		$query_str .= "			t_html_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html_tag.client_id = :client_id and ";
		}
		$query_str .= "	m_html_tag.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_html_tag.html_tag_name, ";
		$query_str .= "	m_html_tag.html_tag_id desc ";

		$arr_bind_param = array();
		$arr_bind_param[":html_id"] = $html_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get HTML
	 *
	 * @param String	$html_id	HTMLID
	 * @return array				Acquisition record
	 */
	public function sel_html($html_id)
	{
		$query_str = "select ";
		$query_str .= "	m_html.html_id, ";
		$query_str .= "	m_html.html_name, ";
		$query_str .= "	m_html.sta_dt, ";
		$query_str .= "	m_html.end_dt, ";
		$query_str .= "	m_html.file_name, ";
		$query_str .= "	m_html.orig_file_dir, ";
		$query_str .= "	m_html.orig_file_name, ";
		$query_str .= "	m_html.orig_file_exte ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		$query_str .= "	m_html.html_id = :html_id and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":html_id"] = $html_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get HTML
	 *
	 * @param String	$html_name	HTML name
	 * @return array				Acquisition record
	 */
	public function sel_arr_html_by_html_name($html_name)
	{
		$query_str = "select ";
		$query_str .= "	m_html.html_id ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		$query_str .= "	m_html.html_name = :html_name and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":html_name"] = $html_name;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Acquire HTML name
	 *
	 * @param String	$html_id		HTMLID
	 * @return array					Acquisition record
	 */
	public function sel_html_name($html_id)
	{
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

		$arr_bind_param = array();
		$arr_bind_param[":html_id"] = $html_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * HTML primary key number assignment
	 *
	 * @return int		Number assigned html_id
	 */
	public function sel_next_html_id()
	{
		$html_id = null;
		try{
			$m_html = new Model_M_Html($this->db, $this->client_id);
			$html_id = $m_html->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$html_id = null;
		}
		return $html_id;
	}

	/**
	 * HTML registration
	 *
	 * @param stdClass	$html		HTML
	 * @return bool					true = success, false = failure
	 */
	public function ins_html($html)
	{
		$ret = true;
		try{
			$m_html = new Model_M_Html($this->db, $this->client_id);
			$ret = $m_html->ins($html);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * HTML update
	 *
	 * @param stdClass	$html		HTML
	 * @return bool					true = success, false = failure
	 */
	public function up_html($html)
	{
		$ret = true;
		try{
			$m_html = new Model_M_Html($this->db, $this->client_id);
			$m_html->up($html);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Delete HTML
	 *
	 * @param stdClass	$html		HTML
	 * @return bool				true = success, false = failure
	 */
	public function del_html($html)
	{
		$ret = true;
		try{
			//HTML terminal related
			$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $this->client_id);
			$dev_html_rela = new stdClass();
			$dev_html_rela->html_id = $html->html_id;
			$dev_html_rela->update_user = $html->update_user;
			$dev_html_rela->update_dt = $html->update_dt;
			$t_dev_html_rela->del_by_html_id($dev_html_rela);

			//HTML tag related
			$t_html_tag_rela = new Model_T_Html_Tag_Rela($this->db, $this->client_id);
			$html_tag_rela = new stdClass();
			$html_tag_rela->html_id = $html->html_id;
			$html_tag_rela->update_user = $html->update_user;
			$html_tag_rela->update_dt = $html->update_dt;
			$t_html_tag_rela->del_by_html_id($html_tag_rela);

			//HTML master
			$m_html = new Model_M_Html($this->db, $this->client_id);
			$m_html->del($html);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * HTML tag related registration
	 *
	 * @param stdClass	$html_tag_rela		HTML tag related
	 * @return bool							true = success, false = failure
	 */
	public function ins_html_tag_rela($html_tag_rela)
	{
		$ret = true;
		try{
			$t_html_tag_rela = new Model_T_Html_Tag_Rela($this->db, $this->client_id);
			$ret = $t_html_tag_rela->ins($html_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * HTML tag related delete
	 *
	 * @param stdClass	$html_tag_rela		HTML tag related
	 * @return bool							true = success, false = failure
	 */
	public function del_html_tag_rela($html_tag_rela)
	{
		$ret = true;
		try{
			$t_html_tag_rela = new Model_T_Html_Tag_Rela($this->db, $this->client_id);
			$ret = $t_html_tag_rela->del_by_html_id_html_tag_id($html_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
