<?php if (!defined('SYSPATH')) exit('No direct script access.');

class Model_Client extends Model
{
	public $db;
	public function __construct()
	{
		$this->db = Database::instance();
	}

	/**
	 * Acquire all clients
	 *
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_cnt_client($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	count(client.client_id) as cnt ";
		$query_str .= "from ( ";
		$query_str .= "select ";
		$query_str .= "	m_client.client_id ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";

		//Search condition (client name) added
		if(!empty($arr_client_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_client_name as $client_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_client.client_name ilike :client_name_" . $i . " ";
				$arr_bind_param[":client_name_" . $i] = "%" . $client_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= ") client ";

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get client list
	 * @param stdClass	$search		Search condition
	 * @return array				Acquisition record
	 */
	public function sel_arr_client($search)
	{
		//Search condition
		if(!empty($search->arr_client_name)){
			$arr_client_name = $search->arr_client_name;
		}
		$offset = $search->offset;

		$arr_bind_param = array();

		$query_str = "select ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(shop_id) ";
		$query_str .= "		from ";
		$query_str .= "			m_shop ";
		$query_str .= "		where ";
		$query_str .= "			m_shop.client_id = m_client.client_id and ";
		$query_str .= "			m_shop.del_flag = 0 ";
		$query_str .= "	) as shop_cnt, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(dev_id) ";
		$query_str .= "		from ";
		$query_str .= "			m_dev ";
		$query_str .= "		where ";
		$query_str .= "			m_dev.client_id = m_client.client_id and ";
		$query_str .= "			m_dev.del_flag = 0 ";
		$query_str .= "	) as dev_cnt, ";
		$query_str .= "	( ";
		$query_str .= "		select ";
		$query_str .= "			count(booth_id) ";
		$query_str .= "		from ";
		$query_str .= "			m_booth ";
		$query_str .= "		where ";
		$query_str .= "			m_booth.client_id = m_client.client_id and ";
		$query_str .= "			m_booth.del_flag = 0 ";
		$query_str .= "	) as booth_cnt ";
		$query_str .= "from ";
		$query_str .= "	m_client ";
		$query_str .= "where ";

		//Search condition (client name) added
		if(!empty($arr_client_name)){
			$query_str .= "	( ";
			$i = 0;
			foreach($arr_client_name as $client_name){
				if($i > 0){
					$query_str .= " and ";
				}
				$query_str .= "		m_client.client_name ilike :client_name_" . $i . " ";
				$arr_bind_param[":client_name_" . $i] = "%" . $client_name . "%";
				$i++;
			}
			$query_str .= "	) and ";
		}

		$query_str .= "	m_client.del_flag = 0 ";
		$query_str .= "order by ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	m_client.client_id desc ";
		$query_str .= "limit :limit ";
		$arr_bind_param[":limit"] = MAX_CNT_PER_PAGE;
		$query_str .= "offset :offset";
		$arr_bind_param[":offset"] = $offset;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Get client
	 *
	 * @param String	$client_id		Client ID
 	 * @return array					Acquisition record
	 */
	public function sel_client($client_id)
	{
		$query_str = "select ";
		$query_str .= "	m_client.client_id, ";
		$query_str .= "	m_client.client_name, ";
		$query_str .= "	m_client.max_total_cts_file_size, ";
		$query_str .= "	m_client.note ";
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
	 * Retrieve the store ID in use by the client
	 *
	 * @param String	$client_id	Store ID
 	 * @return array				Acquisition record
	 */
	public function sel_arr_shop_id($client_id)
	{
		$query_str = "select ";
		$query_str .= "	m_shop.shop_id ";
		$query_str .= "from ";
		$query_str .= "	m_shop ";
		$query_str .= "where ";
		$query_str .= "	m_shop.client_id = :client_id and ";
		$query_str .= "	m_shop.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":client_id"] = $client_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Retrieve the terminal ID in use by the store
	 *
	 * @param String	$shop_id	Store ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_dev_id($shop_id)
	{
		$query_str = "select ";
		$query_str .= "	m_dev.dev_id ";
		$query_str .= "from ";
		$query_str .= "	m_dev ";
		$query_str .= "where ";
		$query_str .= "	m_dev.shop_id = :shop_id and ";
		$query_str .= "	m_dev.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":shop_id"] = $shop_id;

		$query = DB::query(Database::SELECT, $query_str);
		$query->parameters($arr_bind_param);

		return $query->execute($this->db, true);
	}

	/**
	 * Store acquires booth ID in use
	 *
	 * @param String	$shop_id	Store ID
	 * @return array				Acquisition record
	 */
	public function sel_arr_booth_id($shop_id)
	{
		$query_str = "select ";
		$query_str .= "	m_booth.booth_id ";
		$query_str .= "from ";
		$query_str .= "	m_booth ";
		$query_str .= "where ";
		$query_str .= "	m_booth.shop_id = :shop_id and ";
		$query_str .= "	m_booth.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":shop_id"] = $shop_id;

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
		$query_str .= "	t_prog.del_flag = 0 ";

		$arr_bind_param = array();
		$arr_bind_param[":dev_id"] = $dev_id;

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
	 * Get movie list
	 * @return array				Acquisition record
	 */
	public function sel_arr_movie($client_id)
	{
//		if(isset($client_id) && $client_id !== ""){
			$query_str = "select ";
			$query_str .= "	m_movie.movie_id, ";
			$query_str .= "	m_movie.orig_file_dir, ";
			$query_str .= "	m_movie.enc_file_dir, ";
			$query_str .= "	m_movie.file_name, ";
			$query_str .= "	m_movie.movie_orig_file_exte, ";
			$query_str .= "	m_movie.sound_orig_file_exte, ";
			$query_str .= "	m_movie.movie_enc_file_exte, ";
			$query_str .= "	m_movie.sound_enc_file_exte ";
			$query_str .= "from ";
			$query_str .= "	m_movie ";
			$query_str .= "where ";
			$query_str .= "	m_movie.client_id = :client_id and ";
			$query_str .= "	m_movie.del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":client_id"] = $client_id;

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			return $query->execute($this->db, true);
//		} else {
//			return false;
//		}
	}

	/**
	 * Get image list
	 * @return array				Acquisition record
	 */
	public function sel_arr_image($client_id)
	{
		if(isset($client_id) && $client_id !== ""){
			$query_str = "select ";
			$query_str .= "	m_image.image_id, ";
			$query_str .= "	m_image.orig_file_dir, ";
			$query_str .= "	m_image.enc_file_dir, ";
			$query_str .= "	m_image.file_name, ";
			$query_str .= "	m_image.orig_file_exte, ";
			$query_str .= "	m_image.enc_file_exte ";
			$query_str .= "from ";
			$query_str .= "	m_image ";
			$query_str .= "where ";
			$query_str .= "	m_image.client_id = :client_id and ";
			$query_str .= "	m_image.del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":client_id"] = $client_id;

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			return $query->execute($this->db, true);
		} else {
			return false;
		}
	}

	/**
	 * Get HTML list
	 * @return array				Acquisition record
	 */
	public function sel_arr_html($client_id)
	{
		if(isset($client_id) && $client_id !== ""){
			$query_str = "select ";
			$query_str .= "	m_html.html_id, ";
			$query_str .= "	m_html.orig_file_dir, ";
			$query_str .= "	m_html.enc_file_dir, ";
			$query_str .= "	m_html.file_name, ";
			$query_str .= "	m_html.orig_file_exte, ";
			$query_str .= "	m_html.enc_file_exte ";
			$query_str .= "from ";
			$query_str .= "	m_html ";
			$query_str .= "where ";
			$query_str .= "	m_html.client_id = :client_id and ";
			$query_str .= "	m_html.del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":client_id"] = $client_id;

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			return $query->execute($this->db, true);
		} else {
			return false;
		}
	}

	/**
	 * Get e-mail address list
	 * @return array				Acquisition record
	 */
	public function sel_arr_mail($client_id)
	{
		if(isset($client_id) && $client_id !== ""){
			$query_str = "select ";
			$query_str .= "	m_mail.mail_id, ";
			$query_str .= "	m_mail.client_id, ";
			$query_str .= "	m_mail.mail_addr, ";
			$query_str .= "	m_mail.note ";
			$query_str .= "from ";
			$query_str .= "	m_mail ";
			$query_str .= "where ";
			$query_str .= "	m_mail.client_id = :client_id and ";
			$query_str .= "	m_mail.del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":client_id"] = $client_id;

			$query = DB::query(Database::SELECT, $query_str);
			$query->parameters($arr_bind_param);

			return $query->execute($this->db, true);
		} else {
			return false;
		}
	}

	/**
	 * Client primary key numbering
	 *
	 * @return int		Number assigned client_id
	 */
	public function sel_next_client_id()
	{
		$client_id = null;
		try{
			$m_client = new Model_M_Client($this->db);
			$client_id = $m_client->sel_next_id();
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$client_id = null;
		}
		return $client_id;
	}

	/**
	 * クライアント登録
	 *
	 * @param stdClass	$client		client
	 * @return bool					true = success, false = failure
	 */
	public function ins_client($client)
	{
		$ret = true;
		try{
			$m_client = new Model_M_Client($this->db);
			$ret = $m_client->ins($client);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Client update
	 *
	 * @param stdClass	$client		client
	 * @return bool					true = success, false = failure
	 */
	public function up_client($client)
	{
		$ret = true;
		try{
			$m_client = new Model_M_Client($this->db);
			$m_client->up($client);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Delete client
	 *
	 * @param stdClass	$client		client
	 * @return bool					true = success, false = failure
	 */
	public function del_client($client)
	{
		$ret = true;
		try{
			//Delete store in client
			$arr_shop = $this->sel_arr_shop_id($client->client_id);
			foreach($arr_shop as $shop){
				$shop_id = $shop->shop_id;

				//Delete terminal in store
				$arr_dev = $this->sel_arr_dev_id($shop_id);
				foreach($arr_dev as $dev){
					$dev_id = $dev->dev_id;

					//Terminal HTML related download log
					$t_dev_html_rela_dl_log = new Model_T_Dev_Html_Rela_Dl_Log($this->db);
					$dev_html_rela_dl_log = new stdClass();
					$dev_html_rela_dl_log->dev_id      = $dev_id;
					$dev_html_rela_dl_log->client_id   = $client->client_id;
					$dev_html_rela_dl_log->update_user = $client->update_user;
					$dev_html_rela_dl_log->update_dt   = $client->update_dt;
					$t_dev_html_rela_dl_log->del_by_dev_id($dev_html_rela_dl_log);

					//Terminal HTML related
					$t_dev_html_rela = new Model_T_Dev_Html_Rela($this->db, $client->client_id);
					$dev_html_rela = new stdClass();
					$dev_html_rela->dev_id      = $dev_id;
					$dev_html_rela->client_id   = $client->client_id;
					$dev_html_rela->update_user = $client->update_user;
					$dev_html_rela->update_dt   = $client->update_dt;
					$t_dev_html_rela->del_by_dev_id($dev_html_rela);

					//Program guide download log
					$t_dev_prog_dl_log = new Model_T_Dev_Prog_Dl_Log($this->db);
					$dev_prog_dl_log = new stdClass();
					$dev_prog_dl_log->dev_id      = $dev_id;
					$dev_prog_dl_log->client_id   = $client->client_id;
					$dev_prog_dl_log->update_user = $client->update_user;
					$dev_prog_dl_log->update_dt   = $client->update_dt;
					$t_dev_prog_dl_log->del_by_dev_id($dev_prog_dl_log);

					//Device status log
					$t_dev_status_log = new Model_T_Dev_Status_Log($this->db);
					$dev_status_log = new stdClass();
					$dev_status_log->dev_id      = $dev_id;
					$dev_status_log->client_id   = $client->client_id;
					$dev_status_log->update_user = $client->update_user;
					$dev_status_log->update_dt   = $client->update_dt;
					$t_dev_status_log->del_by_dev_id($dev_status_log);

					//Acquire program list while using terminal
					$arr_prog = $this->sel_arr_prog_id($dev_id);
					foreach($arr_prog as $prog){
						$prog_id = $prog->prog_id;

						//Program list Play list related
						$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $client->client_id);
						$prog_playlist_rela = new stdClass();
						$prog_playlist_rela->prog_id     = $prog_id;
						$prog_playlist_rela->client_id   = $client->client_id;
						$prog_playlist_rela->update_user = $client->update_user;
						$prog_playlist_rela->update_dt   = $client->update_dt;
						$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

						//A TV schedule
						$t_prog = new Model_T_Prog($this->db, $client->client_id);
						$prog = new stdClass();
						$prog->prog_id     = $prog_id;
						$prog->client_id   = $client->client_id;
						$prog->update_user = $client->update_user;
						$prog->update_dt   = $client->update_dt;
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
							$t_prog_playlist_rela = new Model_T_Prog_Playlist_Rela($this->db, $client->client_id);
							$prog_playlist_rela = new stdClass();
							$prog_playlist_rela->prog_id     = $prog_id;
							$prog_playlist_rela->client_id   = $client->client_id;
							$prog_playlist_rela->update_user = $client->update_user;
							$prog_playlist_rela->update_dt   = $client->update_dt;
							$t_prog_playlist_rela->del_by_prog_id($prog_playlist_rela);

							//Repeatedly specified program guide
							$t_prog_rgl = new Model_T_Prog_Rgl($this->db, $client->client_id);
							$prog_rgl = new stdClass();
							$prog_rgl->prog_id     = $prog_id;
							$prog_rgl->client_id   = $client->client_id;
							$prog_rgl->update_user = $client->update_user;
							$prog_rgl->update_dt   = $client->update_dt;
							$t_prog_rgl->del($prog_rgl);
						}

						//Repeatedly designated program guide group
						$t_prog_rgl_grp = new Model_T_Prog_Rgl_Grp($this->db, $client->client_id);
						$prog_rgl_grp = new stdClass();
						$prog_rgl_grp->prog_rgl_grp_id = $prog_rgl_grp_id;
						$prog_rgl_grp->client_id       = $client->client_id;
						$prog_rgl_grp->update_user     = $client->update_user;
						$prog_rgl_grp->update_dt       = $client->update_dt;
						$t_prog_rgl_grp->del($prog_rgl_grp);
					}

					//Terminal tag related
					$t_dev_tag_rela = new Model_T_Dev_Tag_Rela($this->db, $client->client_id);
					$dev_tag_rela = new stdClass();
					$dev_tag_rela->dev_id      = $dev_id;
					$dev_tag_rela->client_id   = $client->client_id;
					$dev_tag_rela->update_user = $client->update_user;
					$dev_tag_rela->update_dt   = $client->update_dt;
					$t_dev_tag_rela->del_by_dev_id($dev_tag_rela);

					//Terminal master
					$m_dev = new Model_M_Dev($this->db, $client->client_id);
					$dev = new stdClass();
					$dev->dev_id      = $dev_id;
					$dev->client_id   = $client->client_id;
					$dev->update_user = $client->update_user;
					$dev->update_dt   = $client->update_dt;
					$m_dev->del($dev);
				}

				$arr_booth = $this->sel_arr_booth_id($shop_id);
				foreach($arr_booth as $booth){
					$booth_id = $booth->booth_id;

					// Booth master
					$m_booth = new Model_M_Booth($this->db, $client->client_id);
					$booth = new stdClass();
					$booth->shop_id     = $shop_id;
					$booth->booth_id    = $booth_id;
					$booth->client_id   = $client->client_id;
					$booth->update_user = $client->update_user;
					$booth->update_dt   = $client->update_dt;
					$m_booth->del($booth);
				}

				//Store tag related
				$t_shop_tag_rela = new Model_T_Shop_Tag_Rela($this->db, $client->client_id);
				$shop_tag_rela = new stdClass();
				$shop_tag_rela->shop_id     = $shop_id;
				$shop_tag_rela->client_id   = $client->client_id;
				$shop_tag_rela->update_user = $client->update_user;
				$shop_tag_rela->update_dt   = $client->update_dt;
				$t_shop_tag_rela->del_by_shop_id($shop_tag_rela);

				//Store master
				$m_shop = new Model_M_Shop($this->db, $client->client_id);
				$shop = new stdClass();
				$shop->shop_id     = $shop_id;
				$shop->client_id   = $client->client_id;
				$shop->update_user = $client->update_user;
				$shop->update_dt   = $client->update_dt;
				$m_shop->del($shop);
			}
			//Terminal tag master
			$m_dev_tag = new Model_M_Dev_Tag($this->db, $client->client_id);
			$dev_tag = new stdClass();
			$dev_tag->client_id   = $client->client_id;
			$dev_tag->update_user = $client->update_user;
			$dev_tag->update_dt   = $client->update_dt;
			$m_dev_tag->del_by_client_id($dev_tag);

			//Store Tag Master
			$m_shop_tag = new Model_M_Shop_Tag($this->db, $client->client_id);
			$shop_tag = new stdClass();
			$shop_tag->client_id   = $client->client_id;
			$shop_tag->update_user = $client->update_user;
			$shop_tag->update_dt   = $client->update_dt;
			$m_shop_tag->del_by_client_id($shop_tag);

			//Server video related
			$t_server_movie_rela = new Model_T_Server_Movie_Rela($this->db, $client->client_id);
			$server_movie_rela = new stdClass();
			$server_movie_rela->client_id   = $client->client_id;
			$server_movie_rela->update_user = $client->update_user;
			$server_movie_rela->update_dt   = $client->update_dt;
			$t_server_movie_rela->del_by_client_id($server_movie_rela);

			//Server image related
			$t_server_image_rela = new Model_T_Server_Image_Rela($this->db, $client->client_id);
			$server_image_rela = new stdClass();
			$server_image_rela->client_id   = $client->client_id;
			$server_image_rela->update_user = $client->update_user;
			$server_image_rela->update_dt   = $client->update_dt;
			$t_server_image_rela->del_by_client_id($server_image_rela);

			//Server HTML related
			$t_server_html_rela = new Model_T_Server_Html_Rela($this->db, $client->client_id);
			$server_html_rela = new stdClass();
			$server_html_rela->client_id   = $client->client_id;
			$server_html_rela->update_user = $client->update_user;
			$server_html_rela->update_dt   = $client->update_dt;
			$t_server_html_rela->del_by_client_id($server_html_rela);

			//Playlist video related
			$t_playlist_movie_rela = new Model_T_Playlist_Movie_Rela($this->db, $client->client_id);
			$playlist_movie_rela = new stdClass();
			$playlist_movie_rela->client_id   = $client->client_id;
			$playlist_movie_rela->update_user = $client->update_user;
			$playlist_movie_rela->update_dt   = $client->update_dt;
			$t_playlist_movie_rela->del_by_client_id($playlist_movie_rela);

			//Playlist image related
			$t_playlist_image_rela = new Model_T_Playlist_Image_Rela($this->db, $client->client_id);
			$playlist_image_rela = new stdClass();
			$playlist_image_rela->client_id   = $client->client_id;
			$playlist_image_rela->update_user = $client->update_user;
			$playlist_image_rela->update_dt   = $client->update_dt;
			$t_playlist_image_rela->del_by_client_id($playlist_image_rela);

			//Playlist text related
			$t_playlist_text_rela = new Model_T_Playlist_Text_Rela($this->db, $client->client_id);
			$playlist_text_rela = new stdClass();
			$playlist_text_rela->client_id   = $client->client_id;
			$playlist_text_rela->update_user = $client->update_user;
			$playlist_text_rela->update_dt   = $client->update_dt;
			$t_playlist_text_rela->del_by_client_id($playlist_text_rela);

			//playlist
			$t_playlist = new Model_T_Playlist($this->db, $client->client_id);
			$playlist = new stdClass();
			$playlist->client_id   = $client->client_id;
			$playlist->update_user = $client->update_user;
			$playlist->update_dt   = $client->update_dt;
			$t_playlist->del_by_client_id($playlist);

			//Playlist related
			$t_playlist_rela = new Model_T_Playlist_Rela($this->db, $client->client_id);
			$playlist_rela = new stdClass();
			$playlist_rela->client_id   = $client->client_id;
			$playlist_rela->update_user = $client->update_user;
			$playlist_rela->update_dt   = $client->update_dt;
			$t_playlist_rela->del_by_client_id($playlist_rela);

			// The common playlist (commonplaylist) does not depend on the client, so do not delete it.

			// Since the installation floor and the time zone (timezone) are fixed values, do not delete them.

			//Video tag related
			$t_movie_tag_rela = new Model_T_Movie_Tag_Rela($this->db, $client->client_id);
			$movie_tag_rela = new stdClass();
			$movie_tag_rela->client_id   = $client->client_id;
			$movie_tag_rela->update_user = $client->update_user;
			$movie_tag_rela->update_dt   = $client->update_dt;
			$t_movie_tag_rela->del_by_client_id($movie_tag_rela);
/*
			//Video Tag Master
			$m_movie_tag = new Model_M_Movie_Tag($this->db, $client->client_id);
			$movie_tag = new stdClass();
			$movie_tag->client_id   = $client->client_id;
			$movie_tag->update_user = $client->update_user;
			$movie_tag->update_dt   = $client->update_dt;
			$m_movie_tag->del_by_client_id($movie_tag);
*/
			//Video master
			$m_movie = new Model_M_Movie($this->db, $client->client_id);
			$movie = new stdClass();
			$movie->client_id   = $client->client_id;
			$movie->update_user = $client->update_user;
			$movie->update_dt   = $client->update_dt;
			$m_movie->del_by_client_id($movie);

			//Image tag related
			$t_image_tag_rela = new Model_T_Image_Tag_Rela($this->db, $client->client_id);
			$image_tag_rela = new stdClass();
			$image_tag_rela->client_id   = $client->client_id;
			$image_tag_rela->update_user = $client->update_user;
			$image_tag_rela->update_dt   = $client->update_dt;
			$t_image_tag_rela->del_by_client_id($image_tag_rela);

			//Image tag master
			$m_image_tag = new Model_M_Image_Tag($this->db, $client->client_id);
			$image_tag = new stdClass();
			$image_tag->client_id   = $client->client_id;
			$image_tag->update_user = $client->update_user;
			$image_tag->update_dt   = $client->update_dt;
			$m_image_tag->del_by_client_id($image_tag);

			//Image master
			$m_image = new Model_M_Image($this->db, $client->client_id);
			$image = new stdClass();
			$image->client_id   = $client->client_id;
			$image->update_user = $client->update_user;
			$image->update_dt   = $client->update_dt;
			$m_image->del_by_client_id($image);

			//Text tag related
			$t_text_tag_rela = new Model_T_Text_Tag_Rela($this->db, $client->client_id);
			$text_tag_rela = new stdClass();
			$text_tag_rela->client_id   = $client->client_id;
			$text_tag_rela->update_user = $client->update_user;
			$text_tag_rela->update_dt   = $client->update_dt;
			$t_text_tag_rela->del_by_client_id($text_tag_rela);

			//Text tag master
			$m_text_tag = new Model_M_Text_Tag($this->db, $client->client_id);
			$text_tag = new stdClass();
			$text_tag->client_id   = $client->client_id;
			$text_tag->update_user = $client->update_user;
			$text_tag->update_dt   = $client->update_dt;
			$m_text_tag->del_by_client_id($text_tag);

			//Text master
			$m_text = new Model_M_Text($this->db, $client->client_id);
			$text = new stdClass();
			$text->client_id   = $client->client_id;
			$text->update_user = $client->update_user;
			$text->update_dt   = $client->update_dt;
			$m_text->del_by_client_id($text);

			//HTML tag related
			$t_html_tag_rela = new Model_T_Html_Tag_Rela($this->db, $client->client_id);
			$html_tag_rela = new stdClass();
			$html_tag_rela->client_id   = $client->client_id;
			$html_tag_rela->update_user = $client->update_user;
			$html_tag_rela->update_dt   = $client->update_dt;
			$t_html_tag_rela->del_by_client_id($html_tag_rela);

			//HTML Tag Master
			$m_html_tag = new Model_M_Html_Tag($this->db, $client->client_id);
			$html_tag = new stdClass();
			$html_tag->client_id   = $client->client_id;
			$html_tag->update_user = $client->update_user;
			$html_tag->update_dt   = $client->update_dt;
			$m_html_tag->del_by_client_id($html_tag);

			//HTML master
			$m_html = new Model_M_Html($this->db, $client->client_id);
			$html = new stdClass();
			$html->client_id   = $client->client_id;
			$html->update_user = $client->update_user;
			$html->update_dt   = $client->update_dt;
			$m_html->del_by_client_id($html);

			//Drawing area template master
			$m_draw_tmpl = new Model_M_Draw_Tmpl($this->db, $client->client_id);
			$draw_tmpl = new stdClass();
			$draw_tmpl->client_id   = $client->client_id;
			$draw_tmpl->update_user = $client->update_user;
			$draw_tmpl->update_dt   = $client->update_dt;
			$m_draw_tmpl->del_by_client_id($draw_tmpl);

			//Drawing area master
			$m_draw_area = new Model_M_Draw_Area($this->db, $client->client_id);
			$draw_area = new stdClass();
			$draw_area->client_id   = $client->client_id;
			$draw_area->update_user = $client->update_user;
			$draw_area->update_dt   = $client->update_dt;
			$m_draw_area->del_by_client_id($draw_area);

			//Drawing size master
			$m_draw_size = new Model_M_Draw_Size($this->db, $client->client_id);
			$draw_size = new stdClass();
			$draw_size->client_id   = $client->client_id;
			$draw_size->update_user = $client->update_user;
			$draw_size->update_dt   = $client->update_dt;
			$m_draw_size->del_by_client_id($draw_size);

			//User login history
			$t_user_login_hist = new Model_T_User_Login_Hist($this->db, $client->client_id);
			$user_login_hist = new stdClass();
			$user_login_hist->client_id   = $client->client_id;
			$user_login_hist->update_user = $client->update_user;
			$user_login_hist->update_dt   = $client->update_dt;
			$t_user_login_hist->del_by_client_id($user_login_hist);

			//User master
			$m_user = new Model_M_User($this->db, $client->client_id);
			$user = new stdClass();
			$user->update_user = $client->update_user;
			$user->client_id   = $client->client_id;
			$user->update_dt   = $client->update_dt;
			$user->client_id   = $client->client_id;
			$m_user->del_by_client_id($user);

			//Authority group related
			$t_auth_grp_rela = new Model_T_Auth_Grp_Rela($this->db, $client->client_id);
			$auth_grp_rela = new stdClass();
			$auth_grp_rela->client_id   = $client->client_id;
			$auth_grp_rela->update_user = $client->update_user;
			$auth_grp_rela->update_dt   = $client->update_dt;
			$t_auth_grp_rela->del_by_client_id($auth_grp_rela);

			//Authority group master
			$m_auth_grp = new Model_M_Auth_Grp($this->db, $client->client_id);
			$auth_grp = new stdClass();
			$auth_grp->client_id   = $client->client_id;
			$auth_grp->update_user = $client->update_user;
			$auth_grp->update_dt   = $client->update_dt;
			$m_auth_grp->del_by_client_id($auth_grp);

			//Client master
			$m_client = new Model_M_Client($this->db);
			$m_client->del($client);
		} catch(Exception $e){
			Kohana::$log->add(Log::ERROR, Kohana_Exception::text($e))->write();
			$ret = false;
		}
		return $ret;
	}

	/**
	 * Client update
	 *
	 * @param array		$mail_row		Email address list
	 * @param stdClass	$client_id		Client ID
	 * @return bool					true = success, false = failure
	 */
	public function del_mail($mail_row, $client_id)
	{
		if(isset($client_id)){
			$query_str = "update ";
			$query_str .= "	m_mail ";
			$query_str .= "set ";
			$query_str .= "	del_flag = 1, ";
			$query_str .= "	update_user = :update_user, ";
			$query_str .= "	update_dt = :update_dt ";
			$query_str .= "where ";
			$query_str .= "	mail_id = :mail_id and ";
			$query_str .= "	client_id = :client_id and ";
			$query_str .= "	del_flag = 0 ";

			$arr_bind_param = array();
			$arr_bind_param[":update_user"] = Session::get_login_db_user();
			$arr_bind_param[":update_dt"] = Request::$request_dt;
			$arr_bind_param[":mail_id"] = $mail_row->mail_id;
			$arr_bind_param[":client_id"] = $mail_row->client_id;

			$query = DB::query(Database::UPDATE, $query_str);
			$query->parameters($arr_bind_param);

			return $query->execute($this->db);
		} else {
			return false;
		}
	}
}
