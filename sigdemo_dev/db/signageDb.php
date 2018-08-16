<?php
require_once(dirname(__FILE__) . '/db.php');

class SignageDb extends Db{
	/**
	 * Get a device
	 *
	 * @param String	$serialNo	Device serial number
	 * @param array		$row		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getDev($serialNo, &$row){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $serialNo);
		
		$queryStr = "select ";
		$queryStr .= "	m_dev.dev_id, ";
		$queryStr .= "	m_dev.sex_id, ";
		$queryStr .= "	m_dev.client_id ";
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "where ";
		$queryStr .= "	m_dev.invalid_flag = 0 and ";
		$queryStr .= "	m_dev.serial_no = ? and ";
		$queryStr .= "	m_dev.del_flag = 0 ";
		
		return $this->selectRecord($queryStr, $bindArr, $row);
	}
	
	/**
	 * Get active text list
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$playlistId	Playlist ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrActiveText($now, $playlistId, &$rows, $devId){
		// Setting of the program guide acquisition date and time
		$now_time = date("H:i:s");
		if($now_time >= STB_DAILY_SYNC_IN_TIME){
			$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS;
		} else {
			if(STB_DAILY_SYNC_IN_DAYS === 0){
				$stbDailySyncInDays = 0;
			} else {
				$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS - 1;
			}
		}
		
		$endDt = date("Y/m/d H:i:s", mktime(STB_DAILY_SYNC_END_TIME_HOUR, STB_DAILY_SYNC_END_TIME_MIN, 0, date("m"), date("d") + $stbDailySyncInDays, date("y")));

		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $endDt);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
		array_push($bindArr, $playlistId);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
		array_push($bindArr, $playlistId);
		
		$queryStr = "select ";
		$queryStr .= "	playlist_text.display_order, ";
		$queryStr .= "	playlist_text.x, ";
		$queryStr .= "	playlist_text.y, ";
		$queryStr .= "	playlist_text.width, ";
		$queryStr .= "	playlist_text.height, ";
		$queryStr .= "	playlist_text.text_id, ";
		$queryStr .= "	playlist_text.text_name, ";
		$queryStr .= "	playlist_text.text_msg, ";
		$queryStr .= "	playlist_text.sta_dt, ";
		$queryStr .= "	playlist_text.end_dt, ";
		$queryStr .= "	playlist_text.property_id ";
		$queryStr .= "from ";
		$queryStr .= "	( ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_text_rela.playlist_text_rela_id, ";
		$queryStr .= "	t_playlist_text_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_text.text_id, ";
		$queryStr .= "	m_text.text_name, ";
		$queryStr .= "	m_text.text_msg, ";
		$queryStr .= "	m_text.sta_dt, ";
		$queryStr .= "	m_text.end_dt, ";
		$queryStr .= "	m_text.property_id ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_text_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_text ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_text_rela.text_id = m_text.text_id and ";
		$queryStr .= "	(m_text.sta_dt is null or m_text.sta_dt <= ?) and ";
		$queryStr .= "	(m_text.end_dt is null or m_text.end_dt >= ?) and ";
		$queryStr .= "	(m_text.property_id in ";
		$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
		$queryStr .= "		or m_text.property_id is null ) and ";
		$queryStr .= "	m_text.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_text_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_text_rela.playlist_id = ? and ";
		$queryStr .= "	t_playlist_text_rela.del_flag = 0 ";
		$queryStr .= "union all ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_text_rela.playlist_text_rela_id, ";
		$queryStr .= "	t_playlist_text_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_common_text.text_id, ";
		$queryStr .= "	m_common_text.text_name, ";
		$queryStr .= "	m_common_text.text_msg, ";
		$queryStr .= "	m_common_text.sta_dt, ";
		$queryStr .= "	m_common_text.end_dt, ";
		$queryStr .= "	m_common_text.property_id ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_text_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_common_text ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_text_rela.text_id = m_common_text.text_id and ";
		$queryStr .= "	(m_common_text.end_dt is null or m_common_text.end_dt >= ?) and ";
		$queryStr .= "	(m_common_text.property_id in ";
		$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
		$queryStr .= "		or m_common_text.property_id is null ) and ";
		$queryStr .= "	m_common_text.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_text_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_text_rela.playlist_id = ? and ";
		$queryStr .= "	t_playlist_text_rela.del_flag = 0 ";
		$queryStr .= ") as playlist_text ";
		$queryStr .= "order by ";
		$queryStr .= "	playlist_text.display_order, ";
		$queryStr .= "	playlist_text.playlist_text_rela_id desc ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Get active image list
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$playlistId	Playlist ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrActiveImage($now, $playlistId, &$rows, $devId){
		// Setting of the program guide acquisition date and time
		$now_time = date("H:i:s");
		if($now_time >= STB_DAILY_SYNC_IN_TIME){
			$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS;
		} else {
			if(STB_DAILY_SYNC_IN_DAYS === 0){
				$stbDailySyncInDays = 0;
			} else {
				$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS - 1;
			}
		}
		
		$endDt = date("Y/m/d H:i:s", mktime(STB_DAILY_SYNC_END_TIME_HOUR, STB_DAILY_SYNC_END_TIME_MIN, 0, date("m"), date("d") + $stbDailySyncInDays, date("y")));

		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $endDt);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
		array_push($bindArr, $playlistId);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
		array_push($bindArr, $playlistId);
		
		$queryStr = "select ";
		$queryStr .= "	playlist_image.display_order, ";
		$queryStr .= "	playlist_image.x, ";
		$queryStr .= "	playlist_image.y, ";
		$queryStr .= "	playlist_image.width, ";
		$queryStr .= "	playlist_image.height, ";
		$queryStr .= "	playlist_image.image_id, ";
		$queryStr .= "	playlist_image.image_name, ";
		$queryStr .= "	playlist_image.orig_hash, ";
		$queryStr .= "	playlist_image.enc_hash, ";
		$queryStr .= "	playlist_image.sta_dt, ";
		$queryStr .= "	playlist_image.end_dt, ";
		$queryStr .= "	playlist_image.property_id, ";
		$queryStr .= "	playlist_image.orig_file_dir, ";
		$queryStr .= "	playlist_image.enc_file_dir, ";
		$queryStr .= "	playlist_image.active_file_dir, ";
		$queryStr .= "	playlist_image.file_name, ";
		$queryStr .= "	playlist_image.orig_file_exte, ";
		$queryStr .= "	playlist_image.orig_file_size, ";
		$queryStr .= "	playlist_image.enc_file_exte, ";
		$queryStr .= "	playlist_image.enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	( ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_image_rela.playlist_image_rela_id, ";
		$queryStr .= "	t_playlist_image_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_image.image_id, ";
		$queryStr .= "	m_image.image_name, ";
		$queryStr .= "	m_image.orig_hash, ";
		$queryStr .= "	m_image.enc_hash, ";
		$queryStr .= "	m_image.sta_dt, ";
		$queryStr .= "	m_image.end_dt, ";
		$queryStr .= "	m_image.property_id, ";
		$queryStr .= "	m_image.orig_file_dir, ";
		$queryStr .= "	m_image.enc_file_dir, ";
		$queryStr .= "	m_image.active_file_dir, ";
		$queryStr .= "	m_image.file_name, ";
		$queryStr .= "	m_image.orig_file_exte, ";
		$queryStr .= "	m_image.orig_file_size, ";
		$queryStr .= "	m_image.enc_file_exte, ";
		$queryStr .= "	m_image.enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_image_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_image ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_image_rela.image_id = m_image.image_id and ";
		$queryStr .= "	(m_image.sta_dt is null or m_image.sta_dt <= ?) and ";
		$queryStr .= "	(m_image.end_dt is null or m_image.end_dt >= ?) and ";
		$queryStr .= "	(m_image.property_id in ";
		$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
		$queryStr .= "		or m_image.property_id is null ) and ";
		$queryStr .= "	m_image.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_image_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_image_rela.playlist_id = ? and ";
		$queryStr .= "	t_playlist_image_rela.del_flag = 0 ";
		$queryStr .= "union all ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_image_rela.playlist_image_rela_id, ";
		$queryStr .= "	t_playlist_image_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_common_image.image_id, ";
		$queryStr .= "	m_common_image.image_name, ";
		$queryStr .= "	m_common_image.orig_hash, ";
		$queryStr .= "	m_common_image.enc_hash, ";
		$queryStr .= "	m_common_image.sta_dt, ";
		$queryStr .= "	m_common_image.end_dt, ";
		$queryStr .= "	m_common_image.property_id, ";
		$queryStr .= "	m_common_image.orig_file_dir, ";
		$queryStr .= "	m_common_image.enc_file_dir, ";
		$queryStr .= "	m_common_image.active_file_dir, ";
		$queryStr .= "	m_common_image.file_name, ";
		$queryStr .= "	m_common_image.orig_file_exte, ";
		$queryStr .= "	m_common_image.orig_file_size, ";
		$queryStr .= "	m_common_image.enc_file_exte, ";
		$queryStr .= "	m_common_image.enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_image_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_common_image ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_image_rela.image_id = m_common_image.image_id and ";
		$queryStr .= "	(m_common_image.end_dt is null or m_common_image.end_dt >= ?) and ";
		$queryStr .= "	(m_common_image.property_id in ";
		$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
		$queryStr .= "		or m_common_image.property_id is null ) and ";
		$queryStr .= "	m_common_image.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_image_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_image_rela.playlist_id = ? and ";
		$queryStr .= "	t_playlist_image_rela.del_flag = 0 ";
		$queryStr .= ") as playlist_image ";
		$queryStr .= "order by ";
		$queryStr .= "	playlist_image.display_order, ";
		$queryStr .= "	playlist_image.playlist_image_rela_id desc ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Acquire active movie list (for signage)
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$playlistId	Playlist ID
	 * @param String	$playlistRelaId	Playlist related ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrActiveMovieSignage($now, $playlistId, $playlistRelaId, &$rows, $randomFlag){
		// Setting of the program guide acquisition date and time
		$now_time = date("H:i:s");
		if($now_time >= STB_DAILY_SYNC_IN_TIME){
			$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS;
		} else {
			if(STB_DAILY_SYNC_IN_DAYS === 0){
				$stbDailySyncInDays = 0;
			} else {
				$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS - 1;
			}
		}
		
		$endDt = date("Y/m/d H:i:s", mktime(STB_DAILY_SYNC_END_TIME_HOUR, STB_DAILY_SYNC_END_TIME_MIN, 0, date("m"), date("d") + $stbDailySyncInDays, date("y")));

		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $endDt);
		array_push($bindArr, $now);
		array_push($bindArr, $playlistId);
		array_push($bindArr, $endDt);
		array_push($bindArr, $now);
		array_push($bindArr, $playlistRelaId);
		array_push($bindArr, $now);
		array_push($bindArr, $playlistRelaId);
		
		$queryStr = "select ";
		$queryStr .= "	playlist_movie.display_order, ";
		$queryStr .= "	playlist_movie.x, ";
		$queryStr .= "	playlist_movie.y, ";
		$queryStr .= "	playlist_movie.width, ";
		$queryStr .= "	playlist_movie.height, ";
		$queryStr .= "	playlist_movie.movie_id, ";
		$queryStr .= "	playlist_movie.movie_name, ";
		$queryStr .= "	playlist_movie.play_time, ";
		$queryStr .= "	playlist_movie.movie_orig_hash, ";
		$queryStr .= "	playlist_movie.movie_enc_hash, ";
		$queryStr .= "	playlist_movie.sound_orig_hash, ";
		$queryStr .= "	playlist_movie.sound_enc_hash, ";
		$queryStr .= "	playlist_movie.sta_dt, ";
		$queryStr .= "	playlist_movie.end_dt, ";
		$queryStr .= "	playlist_movie.orig_file_dir, ";
		$queryStr .= "	playlist_movie.enc_file_dir, ";
		$queryStr .= "	playlist_movie.active_file_dir, ";
		$queryStr .= "	playlist_movie.file_name, ";
		$queryStr .= "	playlist_movie.movie_orig_file_exte, ";
		$queryStr .= "	playlist_movie.movie_orig_file_size, ";
		$queryStr .= "	playlist_movie.movie_enc_file_exte, ";
		$queryStr .= "	playlist_movie.movie_enc_file_size, ";
		$queryStr .= "	playlist_movie.sound_orig_file_exte, ";
		$queryStr .= "	playlist_movie.sound_orig_file_size, ";
		$queryStr .= "	playlist_movie.sound_enc_file_exte, ";
		$queryStr .= "	playlist_movie.sound_enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	( ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
		$queryStr .= "	t_playlist_movie_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_movie.movie_id, ";
		$queryStr .= "	m_movie.movie_name, ";
		$queryStr .= "	m_movie.play_time, ";
		$queryStr .= "	m_movie.movie_orig_hash, ";
		$queryStr .= "	m_movie.movie_enc_hash, ";
		$queryStr .= "	m_movie.sound_orig_hash, ";
		$queryStr .= "	m_movie.sound_enc_hash, ";
		$queryStr .= "	m_movie.sta_dt, ";
		$queryStr .= "	m_movie.end_dt, ";
		$queryStr .= "	m_movie.orig_file_dir, ";
		$queryStr .= "	m_movie.enc_file_dir, ";
		$queryStr .= "	m_movie.active_file_dir, ";
		$queryStr .= "	m_movie.file_name, ";
		$queryStr .= "	m_movie.movie_orig_file_exte, ";
		$queryStr .= "	m_movie.movie_orig_file_size, ";
		$queryStr .= "	m_movie.movie_enc_file_exte, ";
		$queryStr .= "	m_movie.movie_enc_file_size, ";
		$queryStr .= "	m_movie.sound_orig_file_exte, ";
		$queryStr .= "	m_movie.sound_orig_file_size, ";
		$queryStr .= "	m_movie.sound_enc_file_exte, ";
		$queryStr .= "	m_movie.sound_enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_movie_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_movie ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
		$queryStr .= "	(m_movie.sta_dt is null or m_movie.sta_dt <= ?) and ";
		$queryStr .= "	(m_movie.end_dt is null or m_movie.end_dt >= ?) and ";
		$queryStr .= "	m_movie.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	t_playlist ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist.playlist_id = ? and ";
		$queryStr .= "	(t_playlist.sta_dt is null or t_playlist.sta_dt <= ?) and ";
		$queryStr .= "	(t_playlist.end_dt is null or t_playlist.end_dt >= ?) and ";
		$queryStr .= "	t_playlist.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = ? and ";
		$queryStr .= "	t_playlist_movie_rela.del_flag = 0 ";
		$queryStr .= "union all ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
		$queryStr .= "	t_playlist_movie_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_common_movie.movie_id, ";
		$queryStr .= "	m_common_movie.movie_name, ";
		$queryStr .= "	m_common_movie.play_time, ";
		$queryStr .= "	m_common_movie.movie_orig_hash, ";
		$queryStr .= "	m_common_movie.movie_enc_hash, ";
		$queryStr .= "	m_common_movie.sound_orig_hash, ";
		$queryStr .= "	m_common_movie.sound_enc_hash, ";
		$queryStr .= "	m_common_movie.sta_dt, ";
		$queryStr .= "	m_common_movie.end_dt, ";
		$queryStr .= "	m_common_movie.orig_file_dir, ";
		$queryStr .= "	m_common_movie.enc_file_dir, ";
		$queryStr .= "	m_common_movie.active_file_dir, ";
		$queryStr .= "	m_common_movie.file_name, ";
		$queryStr .= "	m_common_movie.movie_orig_file_exte, ";
		$queryStr .= "	m_common_movie.movie_orig_file_size, ";
		$queryStr .= "	m_common_movie.movie_enc_file_exte, ";
		$queryStr .= "	m_common_movie.movie_enc_file_size, ";
		$queryStr .= "	m_common_movie.sound_orig_file_exte, ";
		$queryStr .= "	m_common_movie.sound_orig_file_size, ";
		$queryStr .= "	m_common_movie.sound_enc_file_exte, ";
		$queryStr .= "	m_common_movie.sound_enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_movie_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_common_movie ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.movie_id = m_common_movie.movie_id and ";
		$queryStr .= "	(m_common_movie.end_dt is null or m_common_movie.end_dt >= ?) and ";
		$queryStr .= "	m_common_movie.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = ? and ";
		$queryStr .= "	t_playlist_movie_rela.del_flag = 0 ";
		$queryStr .= ") as playlist_movie ";
		$queryStr .= "order by ";
		if($randomFlag){
			$queryStr .= "          random() ";
		} else {
			$queryStr .= "        playlist_movie.display_order, ";
			$queryStr .= "        playlist_movie.playlist_movie_rela_id desc ";
		}
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Get active movie list
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$playlistId	Playlist ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrActiveMovie($now, $playlistId, $playlistRelaId, &$rows, $randomFlag, $devId){
		// Setting of the program guide acquisition date and time
		$now_time = date("H:i:s");
		if($now_time >= STB_DAILY_SYNC_IN_TIME){
			$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS;
		} else {
			if(STB_DAILY_SYNC_IN_DAYS === 0){
				$stbDailySyncInDays = 0;
			} else {
				$stbDailySyncInDays = STB_DAILY_SYNC_IN_DAYS - 1;
			}
		}
		
		$endDt = date("Y/m/d H:i:s", mktime(STB_DAILY_SYNC_END_TIME_HOUR, STB_DAILY_SYNC_END_TIME_MIN, 0, date("m"), date("d") + $stbDailySyncInDays, date("y")));
		
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $endDt);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
//		if(SERVICE_ANTS_ONE_ENABLE === true){
//			array_push($bindArr, (int)ANTS_TWO_KIND);
//		}
//		array_push($bindArr, $playlistId);
		array_push($bindArr, $playlistRelaId);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
//		if(SERVICE_ANTS_ONE_ENABLE === true){
//			array_push($bindArr, (int)ANTS_TWO_KIND);
//		}
//		array_push($bindArr, $playlistId);
		array_push($bindArr, $playlistRelaId);
		if(SERVICE_ANTS_ONE_ENABLE === true){
			array_push($bindArr, $endDt);
			array_push($bindArr, $now);
			array_push($bindArr, $devId);
//			array_push($bindArr, (int)ANTS_ONE_KIND);
//			array_push($bindArr, $playlistId);
			array_push($bindArr, $playlistRelaId);
			array_push($bindArr, $now);
			array_push($bindArr, $devId);
//			array_push($bindArr, (int)ANTS_ONE_KIND);
//			array_push($bindArr, $playlistId);
			array_push($bindArr, $playlistRelaId);
		}
		
		$queryStr = "select ";
		$queryStr .= "	playlist_movie.display_order, ";
		$queryStr .= "	playlist_movie.x, ";
		$queryStr .= "	playlist_movie.y, ";
		$queryStr .= "	playlist_movie.width, ";
		$queryStr .= "	playlist_movie.height, ";
		$queryStr .= "	playlist_movie.movie_id, ";
		$queryStr .= "	playlist_movie.movie_name, ";
		$queryStr .= "	playlist_movie.play_time, ";
		$queryStr .= "	playlist_movie.movie_orig_hash, ";
		$queryStr .= "	playlist_movie.movie_enc_hash, ";
		$queryStr .= "	playlist_movie.sound_orig_hash, ";
		$queryStr .= "	playlist_movie.sound_enc_hash, ";
		$queryStr .= "	playlist_movie.sta_dt, ";
		$queryStr .= "	playlist_movie.end_dt, ";
		$queryStr .= "	playlist_movie.property_id, ";
		$queryStr .= "	playlist_movie.orig_file_dir, ";
		$queryStr .= "	playlist_movie.enc_file_dir, ";
		$queryStr .= "	playlist_movie.active_file_dir, ";
		$queryStr .= "	playlist_movie.file_name, ";
		$queryStr .= "	playlist_movie.movie_orig_file_exte, ";
		$queryStr .= "	playlist_movie.movie_orig_file_size, ";
		$queryStr .= "	playlist_movie.movie_enc_file_exte, ";
		$queryStr .= "	playlist_movie.movie_enc_file_size, ";
		$queryStr .= "	playlist_movie.sound_orig_file_exte, ";
		$queryStr .= "	playlist_movie.sound_orig_file_size, ";
		$queryStr .= "	playlist_movie.sound_enc_file_exte, ";
		$queryStr .= "	playlist_movie.sound_enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	( ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
		$queryStr .= "	t_playlist_movie_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_movie.movie_id, ";
		$queryStr .= "	m_movie.movie_name, ";
		$queryStr .= "	m_movie.play_time, ";
		$queryStr .= "	m_movie.movie_orig_hash, ";
		$queryStr .= "	m_movie.movie_enc_hash, ";
		$queryStr .= "	m_movie.sound_orig_hash, ";
		$queryStr .= "	m_movie.sound_enc_hash, ";
		$queryStr .= "	m_movie.sta_dt, ";
		$queryStr .= "	m_movie.end_dt, ";
		$queryStr .= "	m_movie.property_id, ";
		$queryStr .= "	m_movie.orig_file_dir, ";
		$queryStr .= "	m_movie.enc_file_dir, ";
		$queryStr .= "	m_movie.active_file_dir, ";
		$queryStr .= "	m_movie.file_name, ";
		$queryStr .= "	m_movie.movie_orig_file_exte, ";
		$queryStr .= "	m_movie.movie_orig_file_size, ";
		$queryStr .= "	m_movie.movie_enc_file_exte, ";
		$queryStr .= "	m_movie.movie_enc_file_size, ";
		$queryStr .= "	m_movie.sound_orig_file_exte, ";
		$queryStr .= "	m_movie.sound_orig_file_size, ";
		$queryStr .= "	m_movie.sound_enc_file_exte, ";
		$queryStr .= "	m_movie.sound_enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_movie_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_movie ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
		$queryStr .= "	(m_movie.sta_dt is null or m_movie.sta_dt <= ?) and ";
		$queryStr .= "	(m_movie.end_dt is null or m_movie.end_dt >= ?) and ";
		$queryStr .= "	(m_movie.property_id in ";
		$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
		$queryStr .= "		or m_movie.property_id is null ) and ";
		$queryStr .= "	m_movie.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$queryStr .= "join ";
			$queryStr .= "	t_playlist_rela ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = t_playlist_rela.playlist_rela_id and ";
			$queryStr .= "	t_playlist_rela.del_flag = 0 ";
		}
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = ? and ";
		$queryStr .= "	t_playlist_movie_rela.del_flag = 0 ";
		$queryStr .= "union all ";
		$queryStr .= "select ";
		$queryStr .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
		$queryStr .= "	t_playlist_movie_rela.display_order, ";
		$queryStr .= "	m_draw_area.x, ";
		$queryStr .= "	m_draw_area.y, ";
		$queryStr .= "	m_draw_size.width, ";
		$queryStr .= "	m_draw_size.height, ";
		$queryStr .= "	m_common_movie.movie_id, ";
		$queryStr .= "	m_common_movie.movie_name, ";
		$queryStr .= "	m_common_movie.play_time, ";
		$queryStr .= "	m_common_movie.movie_orig_hash, ";
		$queryStr .= "	m_common_movie.movie_enc_hash, ";
		$queryStr .= "	m_common_movie.sound_orig_hash, ";
		$queryStr .= "	m_common_movie.sound_enc_hash, ";
		$queryStr .= "	m_common_movie.sta_dt, ";
		$queryStr .= "	m_common_movie.end_dt, ";
		$queryStr .= "	m_common_movie.property_id, ";
		$queryStr .= "	m_common_movie.orig_file_dir, ";
		$queryStr .= "	m_common_movie.enc_file_dir, ";
		$queryStr .= "	m_common_movie.active_file_dir, ";
		$queryStr .= "	m_common_movie.file_name, ";
		$queryStr .= "	m_common_movie.movie_orig_file_exte, ";
		$queryStr .= "	m_common_movie.movie_orig_file_size, ";
		$queryStr .= "	m_common_movie.movie_enc_file_exte, ";
		$queryStr .= "	m_common_movie.movie_enc_file_size, ";
		$queryStr .= "	m_common_movie.sound_orig_file_exte, ";
		$queryStr .= "	m_common_movie.sound_orig_file_size, ";
		$queryStr .= "	m_common_movie.sound_enc_file_exte, ";
		$queryStr .= "	m_common_movie.sound_enc_file_size ";
		$queryStr .= "from ";
		$queryStr .= "	t_playlist_movie_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_common_movie ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.movie_id = m_common_movie.movie_id and ";
		$queryStr .= "	(m_common_movie.end_dt is null or m_common_movie.end_dt >= ?) and ";
		$queryStr .= "	(m_common_movie.property_id in ";
		$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
		$queryStr .= "		or m_common_movie.property_id is null ) and ";
		$queryStr .= "	m_common_movie.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "on ";
		$queryStr .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	m_draw_size ";
		$queryStr .= "on ";
		$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
		$queryStr .= "	m_draw_size.del_flag = 0 ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$queryStr .= "join ";
			$queryStr .= "	t_playlist_rela ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = t_playlist_rela.playlist_rela_id and ";
			$queryStr .= "	t_playlist_rela.del_flag = 0 ";
		}
		$queryStr .= "where ";
		$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = ? and ";
		$queryStr .= "	t_playlist_movie_rela.del_flag = 0 ";
		if(SERVICE_ANTS_ONE_ENABLE === true){
			$queryStr .= "union all ";
			$queryStr .= "select ";
			$queryStr .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
			$queryStr .= "	t_playlist_movie_rela.display_order, ";
			$queryStr .= "	m_draw_area.x, ";
			$queryStr .= "	m_draw_area.y, ";
			$queryStr .= "	m_draw_size.width, ";
			$queryStr .= "	m_draw_size.height, ";
			$queryStr .= "	m_movie.movie_id, ";
			$queryStr .= "	m_movie.movie_name, ";
			$queryStr .= "	m_movie.play_time, ";
			$queryStr .= "	m_movie.movie_orig_hash_480p, ";
			$queryStr .= "	m_movie.movie_enc_hash_480p, ";
			$queryStr .= "	m_movie.sound_orig_hash, ";
			$queryStr .= "	m_movie.sound_enc_hash, ";
			$queryStr .= "	m_movie.sta_dt, ";
			$queryStr .= "	m_movie.end_dt, ";
			$queryStr .= "	m_movie.property_id, ";
			$queryStr .= "	m_movie.orig_file_dir, ";
			$queryStr .= "	m_movie.enc_file_dir, ";
			$queryStr .= "	m_movie.active_file_dir, ";
			$queryStr .= "	m_movie.movie_orig_file_name_480p, ";
			$queryStr .= "	m_movie.movie_orig_file_exte_480p, ";
			$queryStr .= "	m_movie.movie_orig_file_size_480p, ";
			$queryStr .= "	m_movie.movie_enc_file_exte_480p, ";
			$queryStr .= "	m_movie.movie_enc_file_size_480p, ";
			$queryStr .= "	m_movie.sound_orig_file_exte, ";
			$queryStr .= "	m_movie.sound_orig_file_size, ";
			$queryStr .= "	m_movie.sound_enc_file_exte, ";
			$queryStr .= "	m_movie.sound_enc_file_size ";
			$queryStr .= "from ";
			$queryStr .= "	t_playlist_movie_rela ";
			$queryStr .= "join ";
			$queryStr .= "	m_movie ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.movie_id = m_movie.movie_id and ";
			$queryStr .= "	(m_movie.sta_dt is null or m_movie.sta_dt <= ?) and ";
			$queryStr .= "	(m_movie.end_dt is null or m_movie.end_dt >= ?) and ";
			$queryStr .= "	(m_movie.property_id in ";
			$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
			$queryStr .= "		or m_movie.property_id is null ) and ";
			$queryStr .= "	m_movie.del_flag = 0 ";
			$queryStr .= "join ";
			$queryStr .= "	m_draw_area ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
			$queryStr .= "	m_draw_area.del_flag = 0 ";
			$queryStr .= "join ";
			$queryStr .= "	m_draw_size ";
			$queryStr .= "on ";
			$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
			$queryStr .= "	m_draw_size.del_flag = 0 ";
			$queryStr .= "join ";
			$queryStr .= "	t_playlist_rela ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = t_playlist_rela.playlist_rela_id and ";
			$queryStr .= "	t_playlist_rela.del_flag = 0 ";
			$queryStr .= "where ";
			$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = ? and ";
			$queryStr .= "	t_playlist_movie_rela.del_flag = 0 ";
			$queryStr .= "union all ";
			$queryStr .= "select ";
			$queryStr .= "	t_playlist_movie_rela.playlist_movie_rela_id, ";
			$queryStr .= "	t_playlist_movie_rela.display_order, ";
			$queryStr .= "	m_draw_area.x, ";
			$queryStr .= "	m_draw_area.y, ";
			$queryStr .= "	m_draw_size.width, ";
			$queryStr .= "	m_draw_size.height, ";
			$queryStr .= "	m_common_movie.movie_id, ";
			$queryStr .= "	m_common_movie.movie_name, ";
			$queryStr .= "	m_common_movie.play_time, ";
			$queryStr .= "	m_common_movie.movie_orig_hash_480p, ";
			$queryStr .= "	m_common_movie.movie_enc_hash_480p, ";
			$queryStr .= "	m_common_movie.sound_orig_hash, ";
			$queryStr .= "	m_common_movie.sound_enc_hash, ";
			$queryStr .= "	m_common_movie.sta_dt, ";
			$queryStr .= "	m_common_movie.end_dt, ";
			$queryStr .= "	m_common_movie.property_id, ";
			$queryStr .= "	m_common_movie.orig_file_dir, ";
			$queryStr .= "	m_common_movie.enc_file_dir, ";
			$queryStr .= "	m_common_movie.active_file_dir, ";
			$queryStr .= "	m_common_movie.movie_orig_file_name_480p, ";
			$queryStr .= "	m_common_movie.movie_orig_file_exte_480p, ";
			$queryStr .= "	m_common_movie.movie_orig_file_size_480p, ";
			$queryStr .= "	m_common_movie.movie_enc_file_exte_480p, ";
			$queryStr .= "	m_common_movie.movie_enc_file_size_480p, ";
			$queryStr .= "	m_common_movie.sound_orig_file_exte, ";
			$queryStr .= "	m_common_movie.sound_orig_file_size, ";
			$queryStr .= "	m_common_movie.sound_enc_file_exte, ";
			$queryStr .= "	m_common_movie.sound_enc_file_size ";
			$queryStr .= "from ";
			$queryStr .= "	t_playlist_movie_rela ";
			$queryStr .= "join ";
			$queryStr .= "	m_common_movie ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.movie_id = m_common_movie.movie_id and ";
			$queryStr .= "	(m_common_movie.end_dt is null or m_common_movie.end_dt >= ?) and ";
			$queryStr .= "	(m_common_movie.property_id in ";
			$queryStr .= "		( select property_id from t_dev_property_rela where dev_id = ? and del_flag = 0 ) ";
			$queryStr .= "		or m_common_movie.property_id is null ) and ";
			$queryStr .= "	m_common_movie.del_flag = 0 ";
			$queryStr .= "join ";
			$queryStr .= "	m_draw_area ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.draw_area_id = m_draw_area.draw_area_id and ";
			$queryStr .= "	m_draw_area.del_flag = 0 ";
			$queryStr .= "join ";
			$queryStr .= "	m_draw_size ";
			$queryStr .= "on ";
			$queryStr .= "	m_draw_area.draw_size_id = m_draw_size.draw_size_id and ";
			$queryStr .= "	m_draw_size.del_flag = 0 ";
			$queryStr .= "join ";
			$queryStr .= "	t_playlist_rela ";
			$queryStr .= "on ";
			$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = t_playlist_rela.playlist_rela_id and ";
			$queryStr .= "	t_playlist_rela.del_flag = 0 ";
			$queryStr .= "where ";
			$queryStr .= "	t_playlist_movie_rela.playlist_rela_id = ? and ";
			$queryStr .= "	t_playlist_movie_rela.del_flag = 0 ";
		}
		$queryStr .= ") as playlist_movie ";
		$queryStr .= "order by ";
		if($randomFlag){
			$queryStr .= "          random() ";
		} else {
			$queryStr .= "        playlist_movie.display_order, ";
                	$queryStr .= "        playlist_movie.playlist_movie_rela_id desc ";
		}

		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Acquire distribution server list
	 *
	 * @param String	$now		Run time date and time
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrServer($now, &$rows){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $now);
		array_push($bindArr, $now);
		
		$queryStr = "select ";
		$queryStr .= "	t_server_order.server_order_id, ";
		//Because it locks when setting the next server flag when processing with multi-core CPU
		//The sequence incremented immediately before is divided by the number of servers, and the remainder is set as the next server.
		//2013.01.09 Okamoto
		//$queryStr .= "	t_server_order.next_use_flag, ";
		$queryStr .= "	case when mod((select last_value from t_dev_prog_dl_log_dev_prog_dl_log_id_seq),count(*) over (partition by t_server_order.del_flag))+1 = rank() over (partition by t_server_order.del_flag order by t_server_order.server_order_id) then 1 else 0 end next_use_flag, ";
		$queryStr .= "	m_server.http_server_url ";
		$queryStr .= "from ";
		$queryStr .= "	m_server ";
		$queryStr .= "join ";
		$queryStr .= "	t_server_order ";
		$queryStr .= "on ";
		$queryStr .= "	t_server_order.server_id = m_server.server_id and ";
		$queryStr .= "	t_server_order.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	m_server.contract_sta_date <= ? and ";
		$queryStr .= "	m_server.contract_end_date >= ? and ";
		$queryStr .= "	m_server.status = 0 and ";
		$queryStr .= "	m_server.del_flag = 0 ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Retrieve the server list holding the target image
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$imageId	Image ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrImageServer($now, $imageId, &$rows){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $now);
		array_push($bindArr, $now);
		array_push($bindArr, $imageId);
		
		$queryStr = "select ";
		$queryStr .= "	t_server_order.server_order_id, ";
		$queryStr .= "	t_server_order.next_use_flag, ";
		$queryStr .= "	m_server.http_server_url ";
		$queryStr .= "from ";
		$queryStr .= "	t_server_image_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_server ";
		$queryStr .= "on ";
		$queryStr .= "	t_server_image_rela.server_id = m_server.server_id and ";
		$queryStr .= "	m_server.contract_sta_date <= ? and ";
		$queryStr .= "	m_server.contract_end_date >= ? and ";
		$queryStr .= "	m_server.status = 0 and ";
		$queryStr .= "	m_server.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	t_server_order ";
		$queryStr .= "on ";
		$queryStr .= "	t_server_order.server_id = m_server.server_id and ";
		$queryStr .= "	t_server_order.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_server_image_rela.image_id = ? and ";
		$queryStr .= "	t_server_image_rela.status = 1 and ";
		$queryStr .= "	t_server_image_rela.del_flag = 0 ";
		$queryStr .= "order by ";
		$queryStr .= "	t_server_order.server_order ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Retrieve server list holding target movie
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$movieId	movie ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrMovieServer($now, $movieId, &$rows, $ants_version){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $now);
		array_push($bindArr, $now);
		array_push($bindArr, $movieId);
		array_push($bindArr, $ants_version);
		
		$queryStr = "select ";
		$queryStr .= "	t_server_order.server_order_id, ";
		$queryStr .= "	t_server_order.next_use_flag, ";
		$queryStr .= "	m_server.http_server_url ";
		$queryStr .= "from ";
		$queryStr .= "	t_server_movie_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_server ";
		$queryStr .= "on ";
		$queryStr .= "	t_server_movie_rela.server_id = m_server.server_id and ";
		$queryStr .= "	m_server.contract_sta_date <= ? and ";
		$queryStr .= "	m_server.contract_end_date >= ? and ";
		$queryStr .= "	m_server.status = 0 and ";
		$queryStr .= "	m_server.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	t_server_order ";
		$queryStr .= "on ";
		$queryStr .= "	t_server_order.server_id = m_server.server_id and ";
		$queryStr .= "	t_server_order.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_server_movie_rela.movie_id = ? and ";
		$queryStr .= "	t_server_movie_rela.status = 1 and ";
		$queryStr .= "	t_server_movie_rela.ants_version = ? and ";
		$queryStr .= "	t_server_movie_rela.del_flag = 0 ";
		$queryStr .= "order by ";
		$queryStr .= "	t_server_order.server_order ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Update used server
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$devId		Device ID
	 * @param String	$serverId	Server ID
	 * @return bool					True=success, false=failed
	 */
	function upServerNextFlagOff($now, $devId){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
		array_push($bindArr, $now);
		
		$queryStr = "update ";
		$queryStr .= "	t_server_order ";
		$queryStr .= "set ";
		$queryStr .= "	next_use_flag = 0, ";
		$queryStr .= "	update_user = ?, ";
		$queryStr .= "	update_dt = ? ";
		
		return $this->execStatement($queryStr, $bindArr);
	}

	/**
	 * Set next use server
	 *
	 * @param String	$now			Run time date and time
	 * @param String	$devId			Device ID
	 * @param String	$serverOrderId	Server sequence ID
	 * @return bool						True=success, false=failed
	 */
	function upServerNextFlagOn($now, $devId, $serverOrderId){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
		array_push($bindArr, $now);
		array_push($bindArr, $serverOrderId);
		
		$queryStr = "update ";
		$queryStr .= "	t_server_order ";
		$queryStr .= "set ";
		$queryStr .= "	next_use_flag = 1, ";
		$queryStr .= "	update_user = ?, ";
		$queryStr .= "	update_dt = ? ";
		$queryStr .= "where ";
		$queryStr .= "	server_order_id = ? and ";
		$queryStr .= "	del_flag = 0 ";
		
		return $this->execStatement($queryStr, $bindArr);
	}

	/**
	 * Number of download log ID
	 *
	 * @param array		$row		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getNextDevProgDlLogId(&$row){
		$queryStr = "select nextval(pg_catalog.pg_get_serial_sequence('t_dev_prog_dl_log', 'dev_prog_dl_log_id'))";
		return $this->selectRecord($queryStr, null, $row);
	}
	
	/**
	 * Move download log
	 *
	 * @param String	$now			Run time date and time
	 * @param String	$devId				Device ID
	 * @return bool							True=success, false=failed
	 */
	function moveDevProgDlStaLog($now, $devId){
		$queryStr = "select ";
		$queryStr .= "	dev_prog_dl_log_id, ";
		$queryStr .= "	dev_id, ";
		$queryStr .= "	sta_dt, ";
		$queryStr .= "	end_dt, ";
		$queryStr .= "	del_flag, ";
		$queryStr .= "	create_user, ";
		$queryStr .= "	create_dt, ";
		$queryStr .= "	update_user, ";
		$queryStr .= "	update_dt ";
		$queryStr .= "from  ";
		$queryStr .= "	t_dev_prog_dl_log ";
		$queryStr .= "where ";
		$queryStr .= "	dev_id = ? ";
		
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $devId);
		
		if($this->selectRecords($queryStr, $bindArr, $rows)){
			//Existing record exists
			foreach($rows as $row){
				//Move to OLD table
				$queryStr = "insert into ";
				$queryStr .= "	t_dev_prog_dl_log_old ";
				$queryStr .= "( ";
				$queryStr .= "	dev_prog_dl_log_id, ";
				$queryStr .= "	dev_id, ";
				$queryStr .= "	sta_dt, ";
				$queryStr .= "	end_dt, ";
				$queryStr .= "	del_flag, ";
				$queryStr .= "	create_user, ";
				$queryStr .= "	create_dt, ";
				$queryStr .= "	update_user, ";
				$queryStr .= "	update_dt, ";
				$queryStr .= "	delete_user, ";
				$queryStr .= "	delete_dt ";
				$queryStr .= ") values ( ";
				$queryStr .= "	?,?,?,?,?, ";
				$queryStr .= "	?,?,?,?,?, ";
				$queryStr .= "	? ";
				$queryStr .= ") ";
				
				$bindArr = array();
				array_push($bindArr, $row["dev_prog_dl_log_id"]);
				array_push($bindArr, $row["dev_id"]);
				array_push($bindArr, $row["sta_dt"]);
				array_push($bindArr, $row["end_dt"]);
				array_push($bindArr, $row["del_flag"]);
				array_push($bindArr, $row["create_user"]);
				array_push($bindArr, $row["create_dt"]);
				array_push($bindArr, $row["update_user"]);
				array_push($bindArr, $row["update_dt"]);
				array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
				array_push($bindArr, $now);
				
				if(!$this->execStatement($queryStr, $bindArr)){
					//When insert fails
					return false;
				}
			}
		}
		
		//Delete records
		$queryStr = "delete from ";
		$queryStr .= "	t_dev_prog_dl_log ";
		$queryStr .= "where ";
		$queryStr .= "	dev_id = ? ";
		
		$bindArr = array();
		array_push($bindArr, $devId);
		
		return $this->execStatement($queryStr, $bindArr);
	}
	
	/**
	 * Download start log registration
	 *
	 * @param String	$now				Run time date and time
	 * @param String	$devProgDlLogId		Terminal program guide download log ID
	 * @param String	$devId				Device ID
	 * @param array		$arrProgId			Program guide ID list
	 * @return bool							True=success, false=failed
	 */
	function insDevProgDlStaLog($now, $devProgDlLogId, $devId, $arrProgId){
		$bindArr = array();	//Sequence for search condition
		
		array_push($bindArr, $devProgDlLogId);
		array_push($bindArr, $devId);
		array_push($bindArr, $now);
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
		array_push($bindArr, $now);
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
		array_push($bindArr, $now);
		
		$queryStr = "insert into ";
		$queryStr .= "	t_dev_prog_dl_log ";
		$queryStr .= "( ";
		$queryStr .= "	dev_prog_dl_log_id, ";
		$queryStr .= "	dev_id, ";
		$queryStr .= "	sta_dt, ";
		$queryStr .= "	create_user, ";
		$queryStr .= "	create_dt, ";
		$queryStr .= "	update_user, ";
		$queryStr .= "	update_dt ";
		$queryStr .= ") values ( ";
		$queryStr .= "	?,?,?,?,?, ";
		$queryStr .= "	?,? ";
		$queryStr .= ") ";
		
		if(!$this->execStatement($queryStr, $bindArr)){
			//When insert fails
			return false;
		}
		
		foreach($arrProgId as $progId){
			$bindArr = array();	//Sequence for search condition
			
			array_push($bindArr, $devProgDlLogId);
			array_push($bindArr, $progId);
			array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
			array_push($bindArr, $now);
			array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
			array_push($bindArr, $now);
			
			$queryStr = "insert into ";
			$queryStr .= "	t_dev_prog_dl_log_rela ";
			$queryStr .= "( ";
			$queryStr .= "	dev_prog_dl_log_id, ";
			$queryStr .= "	prog_id, ";
			$queryStr .= "	create_user, ";
			$queryStr .= "	create_dt, ";
			$queryStr .= "	update_user, ";
			$queryStr .= "	update_dt ";
			$queryStr .= ") values ( ";
			$queryStr .= "	?,?,?,?,?, ";
			$queryStr .= "	? ";
			$queryStr .= ") ";
			
			if(!$this->execStatement($queryStr, $bindArr)){
				//When insert fails
				return false;
			}
		}
		
		return true;
	}

	/**
	 * Get device ID and client ID from terminal serial
	 *
	 * @param String	$serialNo	Device serial number
	 * @param array		$row		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getClientIdFromDev($serialNo, &$row){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $serialNo);
		
		$queryStr = "select ";
		$queryStr .= "	dev_id, client_id ";
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "where ";
		$queryStr .= "	m_dev.invalid_flag = 0 and ";
		$queryStr .= "	m_dev.serial_no = ? and ";
		$queryStr .= "	m_dev.del_flag = 0 ";
		
		return $this->selectRecord($queryStr, $bindArr, $row);
	}
	
	/**
	 * Acquire information on the store to which the terminal belongs
	 * 
	 * @param String	$devId		Device ID
	 * @param array		$row		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getShop($devId, &$row){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $devId);

		$queryStr = "select ";
		$queryStr .= "	shop_id, shop_name, sta_t, end_t ";
		$queryStr .= "from ";
		$queryStr .= "	m_shop ";
		$queryStr .= "where ";
		$queryStr .= "	m_shop.shop_id = ( ";
		$queryStr .= "	  select shop_id from m_dev where m_dev.dev_id = ? ";
		$queryStr .= "	) and ";
		$queryStr .= "	m_shop.del_flag = 0 ";
		
		return $this->selectRecord($queryStr, $bindArr, $row);
	}
}
?>