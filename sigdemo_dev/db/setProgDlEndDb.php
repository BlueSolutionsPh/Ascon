<?php
require_once(dirname(__FILE__) . '/db.php');

class SetProgDlEndDb extends Db{
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
		$queryStr .= "	dev_id ";
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "where ";
		$queryStr .= "	m_dev.invalid_flag = 0 and ";
		$queryStr .= "	m_dev.serial_no = ? and ";
		$queryStr .= "	m_dev.del_flag = 0 ";
		
		return $this->selectRecord($queryStr, $bindArr, $row);
	}
	
	/**
	 * Download complete log registration
	 *
	 * @param String	$devProgDlLogId		Terminal program guide download log ID
	 * @param String	$devId				Device ID
	 * @return bool							True=success, false=failed
	 */
	function upDevProgDlEndLog($devProgDlLogId, $devId){
		$bindArr = array();	//Sequence for search condition
		$now = date("Y/m/d H:i:s");	// Current date and time
		array_push($bindArr, $now);
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
		array_push($bindArr, $now);
		array_push($bindArr, $devProgDlLogId);
		array_push($bindArr, $devId);
		
		$queryStr = "update ";
		$queryStr .= "	t_dev_prog_dl_log ";
		$queryStr .= "set ";
		$queryStr .= "	end_dt = ?, ";
		$queryStr .= "	update_user = ?, ";
		$queryStr .= "	update_dt = ? ";
		$queryStr .= "where ";
		$queryStr .= "	dev_prog_dl_log_id = ? and ";
		$queryStr .= "	dev_id = ? and ";
		$queryStr .= "	del_flag = 0 ";
		
		return $this->execStatement($queryStr, $bindArr);
	}
}
?>