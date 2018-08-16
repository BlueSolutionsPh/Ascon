<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Playlistall extends Model
{
	public $db;
	public $client_id;

	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Get client
	 *
	 * @param String	$arr_client_id		Client ID list
 	 * @return array						Acquisition record
	 */
	public function sel_arr_client($arr_client_id)
	{
		$ret = false;
		if(!empty($arr_client_id)){
			$arr_bind_param = array();

			$query_str = "select ";
			$query_str .= "	m_client.client_id, ";
			$query_str .= "	m_client.client_name ";
			$query_str .= "from ";
			$query_str .= "	m_client ";
			$query_str .= "where ";
			$query_str .= "( ";
			foreach($arr_client_id as $index => $client_id){
				if($index > 0){
					$query_str .= " or ";
				}
				$query_str .= "	m_client.client_id = :client_id_" . $index . " ";
				$arr_bind_param[":client_id_" . $index] = $client_id;
			}
			$query_str .= ") and ";
			$query_str .= "	m_client.del_flag = 0 ";
			$query_str .= "order by ";
			$query_str .= "	m_client.client_name, ";
			$query_str .= "	m_client.client_id desc ";

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			$ret = $query->execute($this->db, true);
		}
		return $ret;
	}

	/**
	 * Get drawing area template
	 *
	 * @param String	$draw_tmpl_id	Drawing area template ID
	 * @return array					Acquisition record
	 */
	public function sel_draw_tmpl_name($draw_tmpl_id)
	{
		$query_str = "select ";
		$query_str .= "	draw_tmpl_name ";
		$query_str .= "from ";
		$query_str .= "	m_draw_tmpl ";
		$query_str .= "where ";
		$query_str .= "	draw_tmpl_id = :draw_tmpl_id and ";
		$query_str .= "	del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":draw_tmpl_id"] = $draw_tmpl_id;

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

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Playlist primary key numbering
	 *
	 * @return int		Number assigned playlist_id
	 */
	public function sel_next_playlist_id()
	{
		$playlist_id = null;
		try{
			$t_playlist = new Model_T_Playlist($this->db, $this->client_id);
			$playlist_id = $t_playlist->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$playlist_id = null;
		}
		return $playlist_id;
	}

	/**
	 * Playlist registration
	 *
	 * @param stdClass	$playlist	playlist
	 * @return bool				true = success, false = failure
	 */
	public function ins_playlist($playlist)
	{
		$ret = true;
		try{
			$t_playlist = new Model_T_Playlist($this->db, $this->client_id);
			$ret = $t_playlist->ins($playlist);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * プレイリスト動画関連登録
	 *
	 * @param stdClass	$playlist_movie_rela	プレイリスト動画関連
	 * @return bool								true=成功、false=失敗
	 */
	public function ins_playlist_movie_rela($playlist_movie_rela)
	{
		$ret = true;
		try{
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_rela($this->db, $this->client_id);
			$ret = $t_playlist_movie_rela->ins($playlist_movie_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Playlist image related registration
	 *
	 * @param stdClass	$playlist_image_rela	Playlist image related
	 * @return bool								true = success, false = failure
	 */
	public function ins_playlist_image_rela($playlist_image_rela)
	{
		$ret = true;
		try{
			$t_playlist_image_rela = new Model_T_Playlist_Image_rela($this->db, $this->client_id);
			$ret = $t_playlist_image_rela->ins($playlist_image_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Registration related to playlist text
	 *
	 * @param stdClass	$playlist_text_rela	Playlist text related
	 * @return bool							true = success, false = failure
	 */
	public function ins_playlist_text_rela($playlist_text_rela)
	{
		$ret = true;
		try{
			$t_playlist_text_rela = new Model_T_Playlist_Text_rela($this->db, $this->client_id);
			$ret = $t_playlist_text_rela->ins($playlist_text_rela);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}
}
