<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Ctsdl extends Model
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
	 * 動画取得
	 *
	 * @param String	$file_name		ファイル名
	 * @param String	$file_exte		ファイル拡張子
	 * @return array					取得レコード
	 */
	function sel_arr_movie_by_file_name_exte($file_name, $file_exte)
	{
		$query_str = "select ";
		$query_str .= "	m_movie.movie_id, ";
		$query_str .= "	m_movie.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_movie ";
		$query_str .= "where ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$query_str .= "	( m_movie.file_name = :file_name or m_movie.movie_orig_file_name_480p = :file_name ) and ";
		} else {
			$query_str .= "	m_movie.file_name = :file_name and ";
		}
		$query_str .= "	(m_movie.movie_orig_file_exte = :file_exte or m_movie.sound_orig_file_exte = :file_exte) and ";
		if(isset($this->client_id)){
			$query_str .= "	m_movie.client_id = :client_id and ";
		}
		$query_str .= "	m_movie.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_movie.movie_id, ";
		$query_str .= "	m_common_movie.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_common_movie ";
		$query_str .= "where ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$query_str .= "	( m_common_movie.file_name = :file_name or m_common_movie.movie_orig_file_name_480p = :file_name ) and ";
		} else {
			$query_str .= "	m_common_movie.file_name = :file_name and ";
		}
		$query_str .= "	(m_common_movie.movie_orig_file_exte = :file_exte or m_common_movie.sound_orig_file_exte = :file_exte) and ";
		$query_str .= "	m_common_movie.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":file_name"] = $file_name;
		$arr_bind_param[":file_exte"] = $file_exte;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * 画像取得
	 *
	 * @param String	$file_name		ファイル名
	 * @param String	$file_exte		ファイル拡張子
	 * @return array					取得レコード
	 */
	function sel_arr_image_by_file_name_exte($file_name, $file_exte)
	{
		$query_str = "select ";
		$query_str .= "	m_image.image_id, ";
		$query_str .= "	m_image.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_image ";
		$query_str .= "where ";
		$query_str .= "	m_image.file_name = :file_name and ";
		$query_str .= "	m_image.orig_file_exte = :file_exte and ";
		if(isset($this->client_id)){
			$query_str .= "	m_image.client_id = :client_id and ";
		}
		$query_str .= "	m_image.del_flag = 0 ";
		$query_str .= "union all ";
		$query_str .= "select ";
		$query_str .= "	m_common_image.image_id, ";
		$query_str .= "	m_common_image.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_common_image ";
		$query_str .= "where ";
		$query_str .= "	m_common_image.file_name = :file_name and ";
		$query_str .= "	m_common_image.orig_file_exte = :file_exte and ";
		$query_str .= "	m_common_image.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":file_name"] = $file_name;
		$arr_bind_param[":file_exte"] = $file_exte;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
	
	/**
	 * HTML取得
	 *
	 * @param String	$file_name		ファイル名
	 * @param String	$file_exte		ファイル拡張子
	 * @return array					取得レコード
	 */
	function sel_arr_html_by_file_name_exte($file_name, $file_exte)
	{
		$query_str = "select ";
		$query_str .= "	m_html.html_id, ";
		$query_str .= "	m_html.orig_file_dir ";
		$query_str .= "from ";
		$query_str .= "	m_html ";
		$query_str .= "where ";
		$query_str .= "	m_html.file_name = :file_name and ";
		$query_str .= "	m_html.orig_file_exte = :file_exte and ";
		if(isset($this->client_id)){
			$query_str .= "	m_html.client_id = :client_id and ";
		}
		$query_str .= "	m_html.del_flag = 0 ";
		
		$arr_bind_param = array();
		$arr_bind_param[":file_name"] = $file_name;
		$arr_bind_param[":file_exte"] = $file_exte;
		if(isset($this->client_id)){
			$arr_bind_param[":client_id"] = $this->client_id;
		}
		
		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);
		
		return $query->execute($this->db, true);
	}
}