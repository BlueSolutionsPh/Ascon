<?php
require_once(dirname(__FILE__) . '/db.php');

class GetHtmlDb extends Db{
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
		$queryStr .= "	m_dev.client_id "; 
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "where ";
		$queryStr .= "	m_dev.serial_no = ? and ";
		$queryStr .= "	m_dev.invalid_flag = 0 and ";
		$queryStr .= "	m_dev.del_flag = 0 ";
		
		return $this->selectRecord($queryStr, $bindArr, $row);
	}
	
	/**
	 * Get HTML
	 *
	 * @param String	$now		Current date and time
	 * @param String	$devId		Device ID
	 * @param array		$row		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getHtml($now, $devId, &$row){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $now);
		array_push($bindArr, $now);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
		
		$queryStr = "select ";
		$queryStr .= "	m_html.html_id, ";
		$queryStr .= "	m_html.html_name, ";
		$queryStr .= "	m_html.active_file_dir, ";
		$queryStr .= "	m_html.enc_file_dir, ";
		$queryStr .= "	m_html.orig_file_dir, ";
		$queryStr .= "	m_html.file_name, ";
		$queryStr .= "	m_html.orig_file_exte, ";
		$queryStr .= "	m_html.orig_file_size, ";
		$queryStr .= "	m_html.enc_file_exte, ";
		$queryStr .= "	m_html.enc_file_size, ";
		$queryStr .= "	m_html.enc_hash, ";
		$queryStr .= "	m_html.orig_hash, ";
		$queryStr .= "	m_html.sta_dt, ";
		$queryStr .= "	m_html.end_dt ";
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "left join ";
		$queryStr .= "	m_shop ";
		$queryStr .= "on ";
		$queryStr .= "	m_dev.shop_id = m_shop.shop_id and ";
		$queryStr .= "	m_shop.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	t_dev_html_rela ";
		$queryStr .= "on ";
		$queryStr .= "	m_dev.dev_id = t_dev_html_rela.dev_id and ";
		$queryStr .= "	t_dev_html_rela.del_flag = 0 ";
		$queryStr .= "join ";
		$queryStr .= "	( ";
		$queryStr .= "		select ";
		$queryStr .= "			max(t_dev_html_rela_outer.dev_html_rela_id) dev_html_rela_id, ";
		$queryStr .= "			t_dev_html_rela_outer.sta_dt, ";
		$queryStr .= "			t_dev_html_rela_outer.end_dt, ";
		$queryStr .= "			t_dev_html_rela_outer.dev_id ";
		$queryStr .= "		from ";
		$queryStr .= "			t_dev_html_rela t_dev_html_rela_outer ";
		$queryStr .= "		where ";
		$queryStr .= "			t_dev_html_rela_outer.sta_dt = ( ";
		$queryStr .= "				select ";
		$queryStr .= "					max(t_dev_html_rela_inner.sta_dt) ";
		$queryStr .= "				from ";
		$queryStr .= "					t_dev_html_rela t_dev_html_rela_inner ";
		$queryStr .= "				where ";
		$queryStr .= "					t_dev_html_rela_outer.dev_id = t_dev_html_rela_inner.dev_id and ";
		$queryStr .= "					t_dev_html_rela_inner.sta_dt <= ? and ";
		$queryStr .= "					(t_dev_html_rela_inner.end_dt is null or t_dev_html_rela_inner.end_dt > ?) and ";
		$queryStr .= "					t_dev_html_rela_inner.del_flag = 0 ";
		$queryStr .= "				group by ";
		$queryStr .= "					t_dev_html_rela_inner.dev_id ";
		$queryStr .= "			) and ";
		$queryStr .= "			t_dev_html_rela_outer.del_flag = 0 ";
		$queryStr .= "		group by ";
		$queryStr .= "			t_dev_html_rela_outer.sta_dt, ";
		$queryStr .= "			t_dev_html_rela_outer.end_dt, ";
		$queryStr .= "			t_dev_html_rela_outer.dev_id ";
		$queryStr .= "	) tmp_dev_html_rela ";
		$queryStr .= "on ";
		$queryStr .= "	t_dev_html_rela.dev_html_rela_id = tmp_dev_html_rela.dev_html_rela_id ";
		$queryStr .= "join ";
		$queryStr .= "	m_html ";
		$queryStr .= "on ";
		$queryStr .= "	m_html.html_id = t_dev_html_rela.html_id and ";
		$queryStr .= "	(m_html.end_dt is null or m_html.end_dt >= ?) and ";
		$queryStr .= "	m_html.del_flag = 0 ";
		$queryStr .= "where ";
		$queryStr .= "	m_dev.dev_id = ? and ";
		$queryStr .= "	m_dev.invalid_flag = 0 and ";
		$queryStr .= "	m_dev.del_flag = 0 ";
		
		return $this->selectRecord($queryStr, $bindArr, $row);
	}
	
	/**
	 * Acquire server
	 *
	 * @param String	$now		Current date and times
	 * @param String	$htmlId		Movie ID
	 * @param array		$rows		Acquisition record
	 * @return bool					true = get, false = do not get it
	 */
	function getArrHtmlServer($now, $htmlId, &$rows){
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $now);
		array_push($bindArr, $now);
		array_push($bindArr, $htmlId);
		
		$queryStr = "select ";
		$queryStr .= "	t_server_order.server_order_id, ";
		//Because it locks when setting the next server flag when processing with multi-core CPU
		//The sequence incremented immediately before is divided by the number of servers, and the remainder is set as the next server.s
		//2013.01.09 Okamoto
		//$queryStr .= "	t_server_order.next_use_flag, ";
		$queryStr .= "	case when mod((select last_value from t_dev_html_rela_dl_log_dev_html_rela_dl_log_id_seq),count(*) over (partition by t_server_order.del_flag))+1 = rank() over (partition by t_server_order.del_flag order by t_server_order.server_order_id) then 1 else 0 end next_use_flag, ";
		$queryStr .= "	m_server.http_server_url ";
		$queryStr .= "from ";
		$queryStr .= "	t_server_html_rela ";
		$queryStr .= "join ";
		$queryStr .= "	m_server ";
		$queryStr .= "on ";
		$queryStr .= "	t_server_html_rela.server_id = m_server.server_id and ";
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
		$queryStr .= "	t_server_html_rela.html_id = ? and ";
		$queryStr .= "	t_server_html_rela.status = 1 and ";
		$queryStr .= "	t_server_html_rela.del_flag = 0 ";
		$queryStr .= "order by ";
		$queryStr .= "	t_server_order.server_order ";
		
		return $this->selectRecords($queryStr, $bindArr, $rows);
	}
	
	/**
	 * Update used server
	 *
	 * @param String	$now		Current date and time
	 * @param String	$devId		Device IDs
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
	 * @param String	$now			Current date and time
	 * @param String	$devId			Device ID
	 * @param String	$serverOrderId	Device ID
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
	function getNextDevHtmlRelaDlLogId(&$row){
		$queryStr = "select nextval(pg_catalog.pg_get_serial_sequence('t_dev_html_rela_dl_log', 'dev_html_rela_dl_log_id'))";
		return $this->selectRecord($queryStr, null, $row);
	}
	
	/**
	 * Move download log
	 *
	 * @param String	$now		Current date and time
	 * @param String	$devId		Device ID
	 * @return bool					True=success, false=failed
	 */
	function moveDevHtmlRelaDlStaLog($now, $devId){
		$queryStr = "select ";
		$queryStr .= "	dev_html_rela_dl_log_id, ";
		$queryStr .= "	dev_id, ";
		$queryStr .= "	dev_html_rela_id, ";
		$queryStr .= "	sta_dt, ";
		$queryStr .= "	end_dt, ";
		$queryStr .= "	del_flag, ";
		$queryStr .= "	create_user, ";
		$queryStr .= "	create_dt, ";
		$queryStr .= "	update_user, ";
		$queryStr .= "	update_dt ";
		$queryStr .= "from  ";
		$queryStr .= "	t_dev_html_rela_dl_log ";
		$queryStr .= "where ";
		$queryStr .= "	dev_id = ? ";
		
		$bindArr = array();	//Sequence for search condition
		array_push($bindArr, $devId);
		
		if($this->selectRecords($queryStr, $bindArr, $rows)){
			//Existing record exists
			foreach($rows as $row){
				//Move to OLD table
				$queryStr = "insert into ";
				$queryStr .= "	t_dev_html_rela_dl_log_old ";
				$queryStr .= "( ";
				$queryStr .= "	dev_html_rela_dl_log_id, ";
				$queryStr .= "	dev_id, ";
				$queryStr .= "	dev_html_rela_id, ";
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
				$queryStr .= "	?,? ";
				$queryStr .= ") ";
				
				$bindArr = array();
				array_push($bindArr, $row["dev_html_rela_dl_log_id"]);
				array_push($bindArr, $row["dev_id"]);
				array_push($bindArr, $row["dev_html_rela_id"]);
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
		$queryStr .= "	t_dev_html_rela_dl_log ";
		$queryStr .= "where ";
		$queryStr .= "	dev_id = ? ";
		
		$bindArr = array();
		array_push($bindArr, $devId);
		
		return $this->execStatement($queryStr, $bindArr);
	}
	
	/**
	 * Download start log registration
	 *
	 * @param String	$now					Current date and time
	 * @param String	$devHtmlRelaDlLogId		Terminal program guide download log ID
	 * @param String	$devId					Device ID
	 * @param String	$devHtmlRelaId			Terminal HTML related ID terminal HTML related ID
	 * @return bool								True=success, false=failed
	 */
	function insDevHtmlRelaDlStaLog($now, $devHtmlRelaDlLogId, $devId, $devHtmlRelaId){
		$bindArr = array();	//True=success, false=failed
		
		array_push($bindArr, $devHtmlRelaDlLogId);
		array_push($bindArr, $devId);
		array_push($bindArr, $devHtmlRelaId);
		array_push($bindArr, $now);
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);		
		array_push($bindArr, $now);
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);		
		array_push($bindArr, $now);
		
		$queryStr = "insert into ";
		$queryStr .= "	t_dev_html_rela_dl_log ";
		$queryStr .= "( ";
		$queryStr .= "	dev_html_rela_dl_log_id, ";
		$queryStr .= "	dev_id, ";
		$queryStr .= "	dev_html_rela_id, ";
		$queryStr .= "	sta_dt, ";
		$queryStr .= "	create_user, ";
		$queryStr .= "	create_dt, ";
		$queryStr .= "	update_user, ";
		$queryStr .= "	update_dt ";
		$queryStr .= ") values ( ";
		$queryStr .= "	?,?,?,?,?, ";
		$queryStr .= "	?,?,? ";
		$queryStr .= ") ";
		
		return $this->execStatement($queryStr, $bindArr);
	}
}
?>