<?php
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/common/define.php');
require_once(dirname(__FILE__) . '/db/setProgDlEndDb.php');

$serialNo = $_GET['serialNo'];
$devProgDlLogId = $_GET['devProgDlLogId'];

//Obtain terminal ID from STB serial
$db = new SetProgDlEndDb();
if($db->getDev($serialNo, $row)){
	//Authorized terminal
	$devId = $row["dev_id"];
} else {
	//Unauthorized terminal
	return;
}

//Acquire the program guide ID to be distributed from the terminal ID
if(!$db->upDevProgDlEndLog($devProgDlLogId, $devId)){
	return;
}

echo("true");

?>