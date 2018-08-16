<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Text extends Model
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
	 * Acquire text number
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_text($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_text_name)){
			$arr_text_name = $search->arr_text_name;
		}
		$arr_playlist_id = array();
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			array_push($arr_playlist_id, $search->playlist_id);
		}
		if(isset($search->text_tag_1) && $search->text_tag_1 !== ""){
			$text_tag_1 = $search->text_tag_1;
		}
		if(isset($search->text_tag_2) && $search->text_tag_2 !== ""){
			$text_tag_2 = $search->text_tag_2;
		}
		$tag_and_or = "and";
		if(isset($search->tag_and_or) && $search->tag_and_or !== ""){
			$tag_and_or = $search->tag_and_or;
		}
		
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	count(text.text_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_text.text_id ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_text.client_id = m_client.client_id and ";
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
		if(isset($text_tag_1) && isset($text_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($text_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_text_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_text_tag_rela.text_id = m_text.text_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_text_tag_rela.text_tag_id = :text_tag_id_1 ";
			$arr_bind_param[":text_tag_id_1"] = $text_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_text_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_text_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($text_tag_1) && isset($text_tag_2)){
			if($tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($text_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_text_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_text_tag_rela.text_id = m_text.text_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_text_tag_rela.text_tag_id = :text_tag_id_2 ";
			$arr_bind_param[":text_tag_id_2"] = $text_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_text_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_text_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($text_tag_1) && isset($text_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($text_tag_1) || isset($text_tag_2)){
			$query_str .= " and ";
		}
		
		//Add search condition (playlist ID)
		if(!empty($arr_playlist_id)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_text_rela ";
			$query_str .= "		where ";
			$query_str .= "			m_text.text_id = t_playlist_text_rela.text_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_playlist_id as $playlist_id){
				if($i > 0){
					 $query_str .= " or ";
				}
				$query_str .= "				t_playlist_text_rela.playlist_id = :playlist_id_" . $i;
				$arr_bind_param[":playlist_id_" . $i] = $playlist_id;
				$i++;
			}
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_playlist_text_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_playlist_text_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}
		
		//Search condition (text name) added
		if(!empty($arr_text_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_text_name as $text_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_text.text_name ilike :text_name_" . $i ;
				$arr_bind_param[":text_name_" . $i] = "%" . $text_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_text.del_flag = 0 ";
		$query_str .= ") text ";
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get text list
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_text($search)
	{
		//Search condition Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		if(!empty($search->arr_text_name)){
			$arr_text_name = $search->arr_text_name;
		}
		$arr_playlist_id = array();
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			array_push($arr_playlist_id, $search->playlist_id);
		}
		if(isset($search->text_tag_1) && $search->text_tag_1 !== ""){
			$text_tag_1 = $search->text_tag_1;
		}
		if(isset($search->text_tag_2) && $search->text_tag_2 !== ""){
			$text_tag_2 = $search->text_tag_2;
		}
		$tag_and_or = "and";
		if(isset($search->tag_and_or) && $search->tag_and_or !== ""){
			$tag_and_or = $search->tag_and_or;
		}
		$offset = $search->offset;
		
		$arr_bind_param = array();
		
		$query_str = "select ";
		$query_str .= "	m_text.text_id, ";
		$query_str .= "	m_text.text_name, ";
		$query_str .= "	m_text.text_msg, ";
		$query_str .= "	m_text.sta_dt, ";
		$query_str .= "	m_text.end_dt, ";
		$query_str .= "	m_text.property_id, ";
		$query_str .= "	m_text.update_user, ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	m_text.client_id = m_client.client_id and ";
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
		if(isset($text_tag_1) && isset($text_tag_2)){
			$query_str .= " ( ";
		}
		if(isset($text_tag_1)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_text_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_text_tag_rela.text_id = m_text.text_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_text_tag_rela.text_tag_id = :text_tag_id_1 ";
			$arr_bind_param[":text_tag_id_1"] = $text_tag_1;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_text_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_text_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($text_tag_1) && isset($text_tag_2)){
			if($tag_and_or == "and"){
				$query_str .= " and ";
			} else {
				$query_str .= " or ";
			}
		}
		if(isset($text_tag_2)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_text_tag_rela ";
			$query_str .= "		where ";
			$query_str .= "			t_text_tag_rela.text_id = m_text.text_id and ";
			$query_str .= "			( ";
			$query_str .= "				t_text_tag_rela.text_tag_id = :text_tag_id_2 ";
			$arr_bind_param[":text_tag_id_2"] = $text_tag_2;
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_text_tag_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_text_tag_rela.del_flag = 0 ";
			$query_str .= "	) ";
		}
		if(isset($text_tag_1) && isset($text_tag_2)){
			$query_str .= " ) ";
		}
		if(isset($text_tag_1) || isset($text_tag_2)){
			$query_str .= " and ";
		}
		
		//Add search condition (playlist ID)
		if(!empty($arr_playlist_id)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_text_rela ";
			$query_str .= "		where ";
			$query_str .= "			m_text.text_id = t_playlist_text_rela.text_id and ";
			$query_str .= "			( ";
			$i = 0;
			foreach($arr_playlist_id as $playlist_id){
				if($i > 0){
					 $query_str .= " or ";
				}
				$query_str .= "				t_playlist_text_rela.playlist_id = :playlist_id_" . $i;
				$arr_bind_param[":playlist_id_" . $i] = $playlist_id;
				$i++;
			}
			$query_str .= "			) and ";
			if(isset($this->client_id)){
				$query_str .= "			t_playlist_text_rela.client_id = :client_id and ";
			}
			$query_str .= "			t_playlist_text_rela.del_flag = 0 ";
			$query_str .= "	) and ";
		}
		
		//Search condition (text name) added
		if(!empty($arr_text_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_text_name as $text_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_text.text_name ilike :text_name_" . $i ;
				$arr_bind_param[":text_name_" . $i] = "%" . $text_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		if(isset($this->client_id)){
			$query_str .= "	m_text.client_id = :client_id and ";
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		$query_str .= "	m_text.del_flag = 0 ";
		$query_str .= "order by ";
		if(is_null($this->client_id)){
			$query_str .= "	m_client.client_name, ";
		}
		$query_str .= "	convert_to(m_text.text_name,'UTF8'), ";
		$query_str .= "	m_text.text_id desc ";
		$query_str .= "limit " . MAX_CNT_PER_PAGE . " ";
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get text
	 *
	 * @param String	$text_id	Text ID
	 * @return array				Acquisition record
	 */
	public function sel_text($text_id)
	{
		$ret = true;
		try{
			$m_text = new Model_M_Text($this->db, $this->client_id);
			$ret = $m_text->sel($text_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Get text tag
	 *
	 * @param String	$text_id	Text ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_text_tag_by_text_id($text_id)
	{
		$query_str = "select ";
		$query_str .= "	m_text_tag.text_tag_id, ";
		$query_str .= "	m_text_tag.text_tag_name ";
		$query_str .= "from ";
		$query_str .= "	m_text_tag ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_text_tag_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_text ";
		$query_str .= "		on ";
		$query_str .= "			t_text_tag_rela.text_id = m_text.text_id and ";
		$query_str .= "			m_text.text_id = :text_id and ";
		if(isset($this->client_id)){
			$query_str .= "			m_text.client_id = :client_id and ";
		}
		$query_str .= "			m_text.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			m_text_tag.text_tag_id = t_text_tag_rela.text_tag_id and ";
		if(isset($this->client_id)){
			$query_str .= "			t_text_tag_rela.client_id = :client_id and ";
		}
		$query_str .= "			t_text_tag_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	m_text_tag.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_text_tag.text_tag_name, ";
		$query_str .= "	m_text_tag.text_tag_id desc ";
		
		$arr_bind_param = array();
		$arr_bind_param[":text_id"] = $text_id;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Get text name
	 *
	 * @param String	$text_id		Text ID
	 * @return array					Acquisition record
	 */
	public function sel_text_name($text_id)
	{
		$query_str = "select ";
		$query_str .= "	m_text.text_name ";
		$query_str .= "from ";
		$query_str .= "	m_text ";
		$query_str .= "where ";
		$query_str .= "	m_text.text_id = :text_id and ";
		$query_str .= "	m_text.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":text_id"] = $text_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 *Get playlist name using text of argument
	 *
	 * @param String	$text_id		Text ID
	 * @return array					Acquisition record
	 */
	public function sel_arr_playlist_by_text_id($text_id)
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
		$query_str .= "			t_playlist_text_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_text ";
		$query_str .= "		on ";
		$query_str .= "			t_playlist_text_rela.text_id = m_text.text_id and ";
		$query_str .= "			m_text.text_id = :text_id and ";
		$query_str .= "			m_text.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			t_playlist.playlist_id = t_playlist_text_rela.playlist_id and ";
		$query_str .= "			t_playlist_text_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	t_playlist.playlist_name, ";
		$query_str .= "	t_playlist.playlist_id desc ";
		
		$arr_bind_param = array();
		$arr_bind_param[":text_id"] = $text_id;
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * Text Primary key number assignment
	 *
	 * @return int		Number of assigned text_id
	 */
	public function sel_next_text_id()
	{
		$text_id = null;
		try{
			$m_text = new Model_M_Text($this->db, $this->client_id);
			$text_id = $m_text->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$text_id = null;
		}
		return $text_id;
	}
	
	/**
	 * Text Registration
	 *
	 * @param String	$text		text
	 * @return bool					true = success, false = failure
	 */
	public function ins_text($text)
	{
		$ret = true;
		try{
			$m_text = new Model_M_Text($this->db, $this->client_id);
			$ret = $m_text->ins($text);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Text update
	 *
	 * @param stdClass	$text		text
	 * @return bool					true = success, false = failure
	 */
	public function up_text($text)
	{
		$ret = true;
		try{
			$m_text = new Model_M_Text($this->db, $this->client_id);
			$m_text->up($text);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Delete text
	 *
	 * @param stdClass	$text		text
	 * @return bool					true = success, false = failure
	 */
	public function del_text($text)
	{
		$ret = true;
		try{
			//Text playlist related
			$t_playlist_text_rela = new Model_T_Playlist_Text_Rela($this->db, $this->client_id);
			$playlist_text_rela = new stdClass();
			$playlist_text_rela->text_id = $text->text_id;
			$playlist_text_rela->update_user = $text->update_user;
			$playlist_text_rela->update_dt = $text->update_dt;
			$t_playlist_text_rela->del_by_text_id($playlist_text_rela);
			
			//Text tag related
			$t_text_tag_rela = new Model_T_Text_Tag_Rela($this->db, $this->client_id);
			$text_tag_rela = new stdClass();
			$text_tag_rela->text_id = $text->text_id;
			$text_tag_rela->update_user = $text->update_user;
			$text_tag_rela->update_dt = $text->update_dt;
			$t_text_tag_rela->del_by_text_id($text_tag_rela);
			
			//Text tag related
			$m_text = new Model_M_Text($this->db, $this->client_id);
			$m_text->del($text);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * Text master
	 *
	 * @param stdClass	$text_tag_rela		Text tag related
	 * @return bool		true = success, false = failure
	 */
	public function ins_text_tag_rela($text_tag_rela)
	{
		$ret = true;
		try{
			$t_text_tag_rela = new Model_T_Text_Tag_Rela($this->db, $this->client_id);
			$ret = $t_text_tag_rela->ins($text_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
	
	/**
	 * true = success, false = failure
	 *
	 * @param stdClass	$text_tag_rela		Text tag related delete
	 * @return bool		Text tag related
	 */
	public function del_text_tag_rela($text_tag_rela)
	{
		$ret = true;
		try{
			$t_text_tag_rela = new Model_T_Text_Tag_Rela($this->db, $this->client_id);
			$ret = $t_text_tag_rela->del_by_text_id_text_tag_id($text_tag_rela);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}