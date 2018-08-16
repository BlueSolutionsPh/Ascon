<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Commontext extends Model
{
	public $db;

	public function __construct()
	{
		$this->db = Database::instance();
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
		if(!empty($search->arr_text_name)){
			$arr_text_name = $search->arr_text_name;
		}
		$arr_playlist_id = array();
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			array_push($arr_playlist_id, $search->playlist_id);
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(common_text.text_id) cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_common_text.text_id ";
		$query_str .= "from ";
		$query_str .= "	m_common_text ";
		$query_str .= "where ";

		//Add search condition (playlist ID)
		if(!empty($arr_playlist_id)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_text_rela ";
			$query_str .= "		where ";
			$query_str .= "			m_common_text.text_id = t_playlist_text_rela.text_id and ";
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
				$query_str .= "		m_common_text.text_name ilike :text_name_" . $i ;
				$arr_bind_param[":text_name_" . $i] = "%" . $text_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_common_text.del_flag = 0 ";
		$query_str .= ") common_text ";

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
		//Search condition
		if(!empty($search->arr_text_name)){
			$arr_text_name = $search->arr_text_name;
		}
		$arr_playlist_id = array();
		if(isset($search->playlist_id) && $search->playlist_id !== ""){
			array_push($arr_playlist_id, $search->playlist_id);
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_common_text.text_id, ";
		$query_str .= "	m_common_text.text_name, ";
		$query_str .= "	m_common_text.text_msg, ";
		$query_str .= "	m_common_text.sta_dt, ";
		$query_str .= "	m_common_text.end_dt, ";
		$query_str .= "	m_common_text.update_user ";
		$query_str .= "from ";
		$query_str .= "	m_common_text ";
		$query_str .= "where ";

		//Add search condition (playlist ID)
		if(!empty($arr_playlist_id)){
			$query_str .= "	exists( ";
			$query_str .= "		select ";
			$query_str .= "			1 ";
			$query_str .= "		from ";
			$query_str .= "			t_playlist_text_rela ";
			$query_str .= "		where ";
			$query_str .= "			m_common_text.text_id = t_playlist_text_rela.text_id and ";
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
				$query_str .= "		m_common_text.text_name ilike :text_name_" . $i ;
				$arr_bind_param[":text_name_" . $i] = "%" . $text_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}
		$query_str .= "	m_common_text.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	convert_to(m_common_text.text_name,'UTF8'), ";
		$query_str .= "	m_common_text.text_id desc ";
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
			$m_common_text = new Model_M_Common_Text($this->db);
			$ret = $m_common_text->sel($text_id);
		}catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
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
		$query_str .= "	m_common_text.text_name ";
		$query_str .= "from ";
		$query_str .= "	m_common_text ";
		$query_str .= "where ";
		$query_str .= "	m_common_text.text_id = :text_id and ";
		$query_str .= "	m_common_text.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":text_id"] = $text_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get playlist name using text of argument
	 *
	 * @param String	$text_id		Text ID
	 * @return array					Acquisition record
	 */
	public function sel_arr_playlist_by_text_id($text_id)
	{
		$query_str = "select ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	t_playlist.playlist_name ";
		$query_str .= "from ";
		$query_str .= "	t_playlist ";
		$query_str .= "join ";
		$query_str .= "	m_client ";
		$query_str .= "on ";
		$query_str .= "	t_playlist.client_id = m_client.client_id and ";
		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "where ";
		$query_str .= "	exists( ";
		$query_str .= "		select ";
		$query_str .= "			1 ";
		$query_str .= "		from ";
		$query_str .= "			t_playlist_text_rela ";
		$query_str .= "		join ";
		$query_str .= "			m_common_text ";
		$query_str .= "		on ";
		$query_str .= "			t_playlist_text_rela.text_id = m_common_text.text_id and ";
		$query_str .= "			m_common_text.text_id = :text_id and ";
		$query_str .= "			m_common_text.del_flag = 0 ";
		$query_str .= "		where ";
		$query_str .= "			t_playlist.playlist_id = t_playlist_text_rela.playlist_id and ";
		$query_str .= "			t_playlist_text_rela.del_flag = 0 ";
		$query_str .= "	) and ";
		$query_str .= "	t_playlist.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_client.client_name, ";
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
			$m_common_text = new Model_M_Common_Text($this->db);
			$text_id = $m_common_text->sel_next_id();
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
			$m_common_text = new Model_M_Common_Text($this->db);
			$ret = $m_common_text->ins($text);
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
			$m_common_text = new Model_M_Common_Text($this->db);
			$m_common_text->up($text);
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
			$t_playlist_text_rela = new Model_T_Playlist_Text_Rela($this->db);
			$playlist_text_rela = new stdClass();
			$playlist_text_rela->text_id = $text->text_id;
			$playlist_text_rela->update_user = $text->update_user;
			$playlist_text_rela->update_dt = $text->update_dt;
			$t_playlist_text_rela->del_by_text_id($playlist_text_rela);

			//Text master
			$m_common_text = new Model_M_Common_Text($this->db);
			$m_common_text->del($text);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
