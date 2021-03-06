<?php
/************** specification ***********************
 * Assumed to accept transmission from the following form
 * <form enctype="multipart/form-data" action = "uploadLogFile.php" method = "post" >
 *   <input type="file" name="file_data1" />
 *   <input type="submit" name="Send" value="Send FILE" />
 * </form>
 * 
 * html form of name="file_data1" It is assumed that the file is uploaded by specifying
 * The file name to be up is access.log only. If the others are up, return failed and exit.
 *
 * Save according to the directory structure below
 * /var/log/signage/dev/accesslog/<client_id>/<dev_id>/Log files
 * /var/log/signage/dev/html/<client_id>/<dev_id>/awstats generated HTML files (updated as needed)
 *
 * When successful：succeded　　When it fails：failed　And returns the output
 *******************************************/


ini_set( 'display_errors', 1 ); 
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/common/define.php');
require_once(dirname(__FILE__) . '/db/signageDb.php');

// Display request parameter information.
if(isset($_GET["serial"])){
	$serial = $_GET["serial"];
}else{
	echo "error: serial".PHP_EOL;
	echo "failed".PHP_EOL;
	exit;
}

$db = new SignageDb();
$db->getClientIdFromDev($_GET["serial"],$row);

if(is_null($row['client_id'])){
	echo "error: no device".PHP_EOL;
	echo "failed".PHP_EOL;
	exit;
}

//Debug with output
/*
echo "Client ID：　" . $row['client_id'].PHP_EOL;
echo "Upload file name　：　" . $_FILES["file_data1"]["name"] .PHP_EOL;
echo "MIME type　：　" . $_FILES["file_data1"]["type"] . PHP_EOL;
echo "file size　：　" , $_FILES["file_data1"]["size"] .PHP_EOL;
echo "Temporary file name　：　" , $_FILES["file_data1"]["tmp_name"] .PHP_EOL;
echo "Error code　：　" , $_FILES["file_data1"]["error"] .PHP_EOL;
*/

// Specify the file path to store the upload file
// If it does not exist, create a directory
$clientId = str_pad($row['client_id'],10,'0',STR_PAD_LEFT);
$devId = str_pad($row['dev_id'],10,'0',STR_PAD_LEFT);
$uploadDir = LOG_FILE_DIR . $clientId . "/" . $devId ;
if(!is_dir(LOG_FILE_DIR . $clientId)){
	mkdir(LOG_FILE_DIR . $clientId);
}
if(!is_dir($uploadDir)){
	mkdir($uploadDir);
}


//Check up for up file name
if($_FILES["file_data1"]["name"] !== "access.log"){
	echo "error: file_name".PHP_EOL;
	echo "failed".PHP_EOL;
	exit;
}
//Checking the size of up files
if ( $_FILES["file_data1"]["size"] === 0 ) {
	echo "error: file_size".PHP_EOL;
	echo "failed".PHP_EOL;
	exit;
}

$filename = $uploadDir . "/" . "access.log";

//If there is a logCreater.php process, it is considered that log analysis is in progress and no further processing is performed
exec('ps ax|grep logCreater|grep -v grep',$output);
if(sizeof($output)!=0 ){
	echo "error: logCreater exist now.".PHP_EOL;
	echo "failed".PHP_EOL;
	exit;
}

// Copy the uploaded temporary file to the file storage path
$result = @move_uploaded_file( $_FILES["file_data1"]["tmp_name"], $filename);
if ( $result === true ) {
	$result = chmod($filename, 0777);
}
if ( $result === true ) {
	echo "succeeded".PHP_EOL;
} else {
	echo "error: internal_server_error".PHP_EOL;
	echo "failed".PHP_EOL;
}

?>
