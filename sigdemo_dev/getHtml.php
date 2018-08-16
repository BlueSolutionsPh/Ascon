<?php
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/common/define.php');
require_once(dirname(__FILE__) . '/db/getHtmlDb.php');
require_once(dirname(__FILE__) . '/xml/htmlXml.php');

$serialNo = $_GET['serialNo'];
$now = date("Y/m/d H:i:s");	// Current date and time

//Return credit XML
$htmlXml = new HtmlXml();

//Obtain terminal ID from STB serial
$db = new GetHtmlDb();
if($db->getDev($serialNo, $row)){
	//Authorized terminal
	$devId = $row["dev_id"];
	$clientID = $row["client_id"];
} else {
	//Unauthorized terminal
	echo($htmlXml->getXml());
	return;
}

//Acquire HTMLID to be delivered from terminal ID
if($db->getHtml($now, $devId, $row)){
	$htmlId = $row["html_id"];
	$htmlName = $row["html_name"];
	$activeFileDir = $row["active_file_dir"];
	$encFileDir = $row["enc_file_dir"];
	$origFileDir = $row["orig_file_dir"];
	$fileName = $row["file_name"];
	$origFileExte = $row["orig_file_exte"];
	$origFileSize = $row["orig_file_size"];
	$encFileExte = $row["enc_file_exte"];
	$encFileSize = $row["enc_file_size"];
	$encHash = $row["enc_hash"];
	$origHash = $row["orig_hash"];
	$staDt = $row["sta_dt"];
	$endDt = $row["end_dt"];
	if(ENCRYPT_ENABLED){
		//Encryption enabled
		$defaultFileDir = $encFileDir;
		$fileExte = $encFileExte;
	} else {
		//Invalid encryption
		$defaultFileDir = $origFileDir;
		$fileExte = $origFileExte;
	}
	
	if(SERVER_SYNC_ENABLED_HTML){
		//Server synchronization enabled
		if($db->getArrHtmlServer($now, $htmlId, $serverRows)){
			$serverRowNum = 0;
			foreach($serverRows as $serverRow){
				$nextUseFlag = $serverRow["next_use_flag"];
				if($nextUseFlag === 1){
					break;
				} else {
					//Unused server
					if($serverRowNum == (count($serverRows) - 1)){
						//When the next use flag is all 0, use the first server
						$serverRowNum = 0;
						break;
					}
				}
				$serverRowNum++;
			}
			
			//Keep server ID to be used next
			if($serverRowNum == (count($serverRows) - 1)){
				//When the selected line is the last line
				$nextServerOrderId = $serverRows[0]["server_order_id"];
			} else {
				$nextServerOrderId = $serverRows[$serverRowNum + 1]["server_order_id"];
			}
			
			//Next used server flag update (Disabled for multi-core measures: 20130109 Okamoto)
			//$db->upServerNextFlagOff($now, $devId);
			//$db->upServerNextFlagOn($now, $devId, $nextServerOrderId);
			
			//Set the server priority
			$arrServerUrl = array();
			for($i = $serverRowNum; $i < count($serverRows); $i++){
				if(count($arrServerUrl) <= 3){
					//Up to 4 URLs to keep
					array_push($arrServerUrl, $serverRows[$i]["http_server_url"] . $activeFileDir);
				} else {
					break;
				}
			}
			for($i = 0; $i < $serverRowNum; $i++){
				if(count($arrServerUrl) <= 3){
					//Up to 4 URLs to keep
					array_push($arrServerUrl, $serverRows[$i]["http_server_url"] . $activeFileDir);
				} else {
					break;
				}
			}
			//The final URL is always the default server
			if(ENCRYPT_ENABLED){
				array_push($arrServerUrl, DEFAULT_SERVER_ENC_URL . $defaultFileDir);
			} else {
				array_push($arrServerUrl, DEFAULT_SERVER_URL . $defaultFileDir);
			}
			if(!empty($arrServerUrl)){
				foreach($arrServerUrl as $i => $serverUrl){
					$member = "setUrl" . ($i + 1);
					$htmlXml->$member($serverUrl . $fileName . $fileExte);
				}
				$htmlXml->setHtmlId($htmlId);
				$htmlXml->setOrigHash($origHash);
				$htmlXml->setOrigFileSize($origFileSize);
				if(ENCRYPT_ENABLED){
					$htmlXml->setEncHash($encHash);
					$htmlXml->setEncFileSize($encFileSize);
				}
			}
		} else {
			//HTML is being distributed, but it is not delivered because it is not transferred
			$htmlXml->setWaitServerSync("true");
		}
	} else {
		//Server sync disabled
		if(ENCRYPT_ENABLED){
			$htmlXml->setUrl1(DEFAULT_SERVER_ENC_URL . $defaultFileDir . $fileName . $fileExte);
		} else {
			$htmlXml->setUrl1(DEFAULT_SERVER_URL . $defaultFileDir . $fileName . $fileExte);
		}
		$htmlXml->setHtmlId($htmlId);
		$htmlXml->setOrigHash($origHash);
		$htmlXml->setOrigFileSize($origFileSize);
		if(ENCRYPT_ENABLED){
			$htmlXml->setEncHash($encHash);
			$htmlXml->setEncFileSize($encFileSize);
		}
	}
} else {
	//HTML does not exist
}

//Log storage directory
$client_id_zero_pad = str_pad(strval($clientID), DEV_LOG_FILE_PAD_LEN, "0", STR_PAD_LEFT);
$dev_id_zero_pad = str_pad(strval($devId), DEV_LOG_FILE_PAD_LEN, "0", STR_PAD_LEFT);
$log_dir = DEV_LOG_DIR . $client_id_zero_pad . "/" . $dev_id_zero_pad . "/";
if(!is_dir(DEV_LOG_DIR . $client_id_zero_pad)){
	mkdir(DEV_LOG_DIR . $client_id_zero_pad);
	chmod(DEV_LOG_DIR . $client_id_zero_pad, 0775);
}
if(!is_dir($log_dir)){
	mkdir($log_dir);
	chmod($log_dir, 0775);
}
$log_url = LOG_URL . $client_id_zero_pad . "/" . $dev_id_zero_pad . "/";
$htmlXml->setDevLogDir($log_url);

//Start transaction for log change
$db->startTransaction();
if($db->getNextDevHtmlRelaDlLogId($row)){
	$devHtmlRelaDlLogId = $row["nextval"];
	$htmlXml->setDevHtmlRelaDlLogId($devHtmlRelaDlLogId);
	
	//Move old log
	$db->moveDevHtmlRelaDlStaLog($now, $devId);
	
	//Create log
	$db->insDevHtmlRelaDlStaLog($now, $devHtmlRelaDlLogId, $devId, $devHtmlRelaDlLogId);
}
if($db->isInTransaction()){
	//End transaction
	$db->endTransaction();
}

echo($htmlXml->getXml());

?>