<?php
require_once(dirname(__FILE__) . '/signageDb.php');

class GetProgDb extends SignageDb{
	/**
	 * Get an active program guide
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$devId		Device ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrActiveProg($now, $devId, &$rows){
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
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
		array_push($bindArr, $devId);
		
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
		$queryStr .= "						t_prog_inner.sta_dt <= ? and ";
		$queryStr .= "						(t_prog_inner.end_dt > ? or t_prog_inner.end_dt is null) and ";
		$queryStr .= "						t_prog_inner.del_flag = 0 ";
		$queryStr .= "				) and ";
		$queryStr .= "				(t_prog_outer.end_dt > ? or t_prog_outer.end_dt is null) and ";
		$queryStr .= "				t_prog_outer.dev_id = ? and ";
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
		$queryStr .= "		m_dev.dev_id = ? and ";
		$queryStr .= "		m_dev.del_flag = 0 ";
		$queryStr .= "	) arr_prog ";
		$queryStr .= "	order by ";
		$queryStr .= "		arr_prog.sta_dt desc, ";
		$queryStr .= "		arr_prog.prog_id desc, ";
		$queryStr .= "		arr_prog.end_dt ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Acquire active program list (repeat designation)
	 *
	 * @param String	$now		Run time date and time
	 * @param String	$devId		Device ID
	 * @param array		$rows		Acquisition records
	 * @return bool					true = get, false = do not get it
	 */
	function getArrActiveProgRgl($now, $devId, &$rows){
		$bindArr = array();	//Sequence for search condition
		$keys = array("year", "month", "day", "hour", "minute", "second");
		$date_1 = array_combine($keys, preg_split("/[\/: ]/", $now));
		$date_1["dow"] = date("w", strtotime($now));
		$date_1["sta_time"] = STB_DAILY_SYNC_END_TIME_HOUR . ":" . STB_DAILY_SYNC_END_TIME_MIN . ":00";
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
					$queryStr .= "			sun = ? and ";
					break;
				case 1:
					$queryStr .= "			mon = ? and ";
					break;
				case 2:
					$queryStr .= "			tues = ? and ";
					break;
				case 3:
					$queryStr .= "			wednes = ? and ";
					break;
				case 4:
					$queryStr .= "			thurs = ? and ";
					break;
				case 5:
					$queryStr .= "			fri = ? and ";
					break;
				case 6:
					$queryStr .= "			satur = ? and ";
					break;
			}
			$queryStr .= "			(t_prog_rgl.year = ? or t_prog_rgl.year = 0) and ";
			$queryStr .= "			(t_prog_rgl.month = ? or t_prog_rgl.month = 0) and ";
			$queryStr .= "			(t_prog_rgl.day = ? or t_prog_rgl.day = 0) and ";
			$queryStr .= "			t_prog_rgl.sta_time <= ? and ";
			$queryStr .= "			t_prog_rgl.end_time > ? ";
			$queryStr .= "		) or ( ";
			switch($date_2["dow"]){
				case 0:
					$queryStr .= "			t_prog_rgl.sun = ? and ";
					break;
				case 1:
					$queryStr .= "			t_prog_rgl.mon = ? and ";
					break;
				case 2:
					$queryStr .= "			t_prog_rgl.tues = ? and ";
					break;
				case 3:
					$queryStr .= "			t_prog_rgl.wednes = ? and ";
					break;
				case 4:
					$queryStr .= "			t_prog_rgl.thurs = ? and ";
					break;
				case 5:
					$queryStr .= "			t_prog_rgl.fri = ? and ";
					break;
				case 6:
					$queryStr .= "			t_prog_rgl.satur = ? and ";
					break;
			}
			$queryStr .= "			(t_prog_rgl.year = ? or t_prog_rgl.year = 0) and ";
			$queryStr .= "			(t_prog_rgl.month = ? or t_prog_rgl.month = 0) and ";
			$queryStr .= "			(t_prog_rgl.day = ? or t_prog_rgl.day = 0) and ";
			$queryStr .= "			t_prog_rgl.sta_time <= ? and ";
			$queryStr .= "			t_prog_rgl.end_time > ? ";
			$queryStr .= "		) ";
			$queryStr .= "	) and ";
			
			array_push($bindArr, 1);
			array_push($bindArr, $date_1["year"]);
			array_push($bindArr, $date_1["month"]);
			array_push($bindArr, $date_1["day"]);
			array_push($bindArr, $date_1["sta_time"]);
			array_push($bindArr, $date_1["end_time"]);
			array_push($bindArr, 1);
			array_push($bindArr, $date_2["year"]);
			array_push($bindArr, $date_2["month"]);
			array_push($bindArr, $date_2["day"]);
			array_push($bindArr, $date_2["sta_time"]);
			array_push($bindArr, $date_2["end_time"]);
		} else {
			//Day by day nothing
			$queryStr .= "	( ";
			$queryStr .= "		( ";
			switch($date_1["dow"]){
				case 0:
					$queryStr .= "			t_prog_rgl.sun = ? and ";
					break;
				case 1:
					$queryStr .= "			t_prog_rgl.mon = ? and ";
					break;
				case 2:
					$queryStr .= "			t_prog_rgl.tues = ? and ";
					break;
				case 3:
					$queryStr .= "			t_prog_rgl.wednes = ? and ";
					break;
				case 4:
					$queryStr .= "			t_prog_rgl.thurs = ? and ";
					break;
				case 5:
					$queryStr .= "			t_prog_rgl.fri = ? and ";
					break;
				case 6:
					$queryStr .= "			t_prog_rgl.satur = ? and ";
					break;
			}
			$queryStr .= "			(t_prog_rgl.year = ? or t_prog_rgl.year = 0) and ";
			$queryStr .= "			(t_prog_rgl.month = ? or t_prog_rgl.month = 0) and ";
			$queryStr .= "			(t_prog_rgl.day = ? or t_prog_rgl.day = 0) and ";
			$queryStr .= "			t_prog_rgl.sta_time <= ? and ";
			$queryStr .= "			t_prog_rgl.end_time > ? ";
			$queryStr .= "		) ";
			$queryStr .= "	) and ";
			array_push($bindArr, 1);
			array_push($bindArr, $date_1["year"]);
			array_push($bindArr, $date_1["month"]);
			array_push($bindArr, $date_1["day"]);
			array_push($bindArr, $date_1["sta_time"]);
			array_push($bindArr, $date_1["end_time"]);
		}
		$queryStr .= "	t_prog_rgl.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_prog_rgl_grp.dev_id = ? and ";
		array_push($bindArr, $devId);
		$queryStr .= "	t_prog_rgl_grp.del_flag = 0 ";
		$queryStr .= "order by ";
		$queryStr .= "	t_prog_rgl.priority desc, ";
		$queryStr .= "	t_prog_rgl.sta_time, ";
		$queryStr .= "	t_prog_rgl.prog_id desc ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Get playlist list for each program guides
	 *
	 * @param String	$progId	Program guide ID
	 * @param array		$rows	Acquisition record
	 * @return bool				true = get, false = do not get it
	 */
	function getArrActivePlaylist($progId, $sexId, &$rows){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $sexId);
		array_push($bindArr, $progId);
		
		$queryStr = "select ";
		$queryStr .= "	t_prog_playlist_rela.prog_id, ";
		$queryStr .= "	t_prog_playlist_rela.ch, ";
		$queryStr .= "	t_playlist.playlist_id, ";
		$queryStr .= "	t_playlist.draw_tmpl_id, ";
		$queryStr .= "	t_playlist.random_flag, ";
		$queryStr .= "	t_playlist.image_intvl, ";
		$queryStr .= "	t_playlist.ants_version, ";
		$queryStr .= "	t_playlist_rela.playlist_rela_id, ";
		$queryStr .= "	t_playlist_rela.sex_id, ";
		$queryStr .= "	t_playlist_rela.timezone_id, ";
		$queryStr .= "	t_prog_rgl.sta_time ";
		$queryStr .= "from ";
		$queryStr .= "	t_prog_playlist_rela ";
		$queryStr .= "join ";
		$queryStr .= "	t_playlist ";
		$queryStr .= "on ";
		$queryStr .= "	t_prog_playlist_rela.playlist_id = t_playlist.playlist_id and ";
		$queryStr .= "	t_playlist.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	t_playlist_rela ";
		$queryStr .= "on ";
		$queryStr .= "	t_prog_playlist_rela.playlist_id = t_playlist_rela.playlist_id and ";
		$queryStr .= "	t_playlist_rela.sex_id = ? and ";
		$queryStr .= "	t_playlist_rela.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	t_prog_rgl ";
		$queryStr .= "on ";
		$queryStr .= "	t_prog_playlist_rela.prog_id = t_prog_rgl.prog_id and ";
		$queryStr .= "	t_prog_rgl.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	t_prog_playlist_rela.prog_id = ? and ";
		$queryStr .= "	t_prog_playlist_rela.del_flag = 0 ";
		$queryStr .= "order by ";
		$queryStr .= "	t_prog_playlist_rela.ch";

		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	
	/**
	 * Whether it is a playlist with a time slot
	 *
	 * @param String	$timezoneId	Time zone ID
	 * @param String	$sta_time	Starting time
	 * @return bool				true = get, false = do not get it
	 */
	function getActivePlaylistExtra($timezoneId, $sta_time, &$rows){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $timezoneId);
		array_push($bindArr, $sta_time);
		
		$queryStr = "select ";
		$queryStr .= "	timezone_id, ";
		$queryStr .= "	sta_time ";
		$queryStr .= "from ";
		$queryStr .= "	m_timezone ";
		$queryStr .= "where ";
		$queryStr .= "	timezone_id = ? and ";
		$queryStr .= "	sta_time = ? and ";
		$queryStr .= "	del_flag = 0 ";

		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Count drawing area template associated with drawing template
	 *
	 * @param String	$draw_tmpl_id	Program guide ID
	 * @param array		$rows			Acquisition record
	 * @return bool						true = get, false = do not get it
	 */
	function getArrDrawArea($draw_tmpl_id, &$rows){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $draw_tmpl_id);
		
		$queryStr = "select ";
		$queryStr .= "	m_draw_area.draw_area_id, ";
		$queryStr .= "	m_draw_area.cts_type ";
		$queryStr .= "from ";
		$queryStr .= "	m_draw_area ";
		$queryStr .= "where ";
		$queryStr .= "	m_draw_area.draw_tmpl_id = ? and ";
		$queryStr .= "	m_draw_area.del_flag = 0 ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
    /**
     * Get ants version from terminal ID
     *
     * @param String	$devId		Device ID
     * @param array		$rows		Acquisition record
     * @return bool					true = get, false = do not get it
     */
    function getDevidAntsVersion($devId, &$rows){
        $bindArr = array();	//Sequence for search condition
        array_push($bindArr, $devId);
        
        $queryStr = "select ";
        $queryStr .= "	m_dev.ants_version ";
        $queryStr .= "from ";
        $queryStr .= "	m_dev ";
        $queryStr .= "where ";
        $queryStr .= "	m_dev.dev_id = ? and ";
        $queryStr .= "	m_dev.del_flag = 0 ";
        
        return $this->selectRecords($queryStr, $bindArr, $rows);
    }
}
?>