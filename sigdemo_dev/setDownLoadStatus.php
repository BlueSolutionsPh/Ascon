<?php
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/common/define.php');
require_once(dirname(__FILE__) . '/db/setDownLoadStatusDb.php');

$serialNo = $_GET['serialNo'];
$dlStatus = $_GET['dlStatus'];		// 0: not yet, 1: being processed, 2: success, 3: failure
//Obtain terminal ID from STB serial
$db = new setDownLoadStatusDb();
if($db->getDev($serialNo, $row)){
	//Authorized terminal
	$devId = $row["dev_id"];
} else {
	//Unauthorized terminal
	echo(false);
	return;
}

if(0 <= $dlStatus && $dlStatus <= 4){
	$db->upDevDlStatus($devId, $dlStatus);
} else {
	// Value invalid
	echo(false);
	return;
}

if($db->isInTransaction()){
	//End transaction
	$db->endTransaction();
}

echo(true);

?>