<?php
require_once(dirname(__FILE__) . '/db.php');

class setDownLoadStatusDb extends Db{
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
		$queryStr .= "	m_dev.dev_id ";
		$queryStr .= "from ";
		$queryStr .= "	m_dev ";
		$queryStr .= "where ";
		$queryStr .= "	m_dev.serial_no = ? and ";
		$queryStr .= "	m_dev.invalid_flag = 0 and ";
		$queryStr .= "	m_dev.del_flag = 0 ";
		
		return $this->selectRecord($queryStr, $bindArr, $row);
	}
	
	/**
	 * Download status registration
	 *
	 * @param String	$devId				Device ID
	 * @param String	$dlStatus			status
	 * @return bool							True=success, false=failed
	 */
	function upDevDlStatus($devId, $dlStatus){
		$bindArr = array();	//Sequence for search condition
		$now = date("Y/m/d H:i:s");	// Current date and time
		array_push($bindArr, $dlStatus);
		array_push($bindArr, DB_USER_PREFIX_DEV . $devId);
		array_push($bindArr, $now);
		array_push($bindArr, $devId);
	
		$queryStr = "update ";
		$queryStr .= "	m_dev ";
		$queryStr .= "set ";
		$queryStr .= "	download_status = ?, ";
		$queryStr .= "	update_user = ?, ";
		$queryStr .= "	update_dt = ? ";
		$queryStr .= "where ";
		$queryStr .= "	dev_id = ? and ";
		$queryStr .= "	del_flag = 0 ";
	
		return $this->execStatement($queryStr, $bindArr);
	}
}
?>