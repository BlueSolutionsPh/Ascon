<?php
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/common/define.php');
require_once(dirname(__FILE__) . '/db/setDevHtmlRelaDlEndDb.php');

$serialNo = $_GET['serialNo'];
$devHtmlRelaDlLogId = $_GET['devHtmlRelaDlLogId'];

//Obtain terminal ID from STB serial
$db = new SetDevHtmlRelaDlEndDb();
if($db->getDev($serialNo, $row)){
	//Authorized terminal
	$devId = $row["dev_id"];
} else {
	//Unauthorized terminal
	return;
}

//Acquire the program guide ID to be distributed from the terminal ID
if(!$db->upDevHtmlRelaDlEndLog($devHtmlRelaDlLogId, $devId)){
	return;
}

//Update with or without judgment
if($db->getEffectedRowCount() == 0){
	return;
}
echo("true");
?>