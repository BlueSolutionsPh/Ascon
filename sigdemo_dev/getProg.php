<?php
error_reporting(E_ALL);

require_once(dirname(__FILE__) . '/common/define.php');
require_once(dirname(__FILE__) . '/db/getProgDb.php');
require_once(dirname(__FILE__) . '/xml/devProgDlXml.php');
require_once(dirname(__FILE__) . '/xml/progXml.php');
require_once(dirname(__FILE__) . '/xml/playlistXml.php');
require_once(dirname(__FILE__) . '/xml/textXml.php');
require_once(dirname(__FILE__) . '/xml/imageXml.php');
require_once(dirname(__FILE__) . '/xml/movieXml.php');
require_once(dirname(__FILE__) . '/xml/fileXml.php');

$serialNo = $_GET['serialNo'];
$firstMovieFlag = true;
$publOkFlag = false;
$beforeEncFlag = false;
$now = date("Y/m/d H:i:s");	// Current date and time

//Return credit XML
$devProgDlXml = new DevProgDlXml();

//Obtain terminal ID from STB serial
$db = new GetProgDb();
if($db->getDev($serialNo, $row)){
	//Authorized terminal
	$devId = $row["dev_id"];
	$sexId = $row["sex_id"];
	$clientID = $row["client_id"];
} else {
	//Unauthorized terminal
	echo($devProgDlXml->getXml());
	return;
}

//When server synchronization is enabled
if(SERVER_SYNC_ENABLED_MOVIE || SERVER_SYNC_ENABLED_IMAGE || SERVER_SYNC_ENABLED_HTML){
	//Acquire server
	if(!$db->getArrServer($now, $serverRows)){
		//Server absence
		echo($devProgDlXml->getXml());
		return;
	}
}

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

//Program guide (repeated designation)
$keys = array("year", "month", "day", "hour", "minute", "second");
$date_1 = array_combine($keys, preg_split("/[\/: ]/", $now));
$arrProgRgl = array();
for($i = 0; $i <= $stbDailySyncInDays; $i++){
	if($i === 0){
		$tmp_now = $now;
	} else {
		$tmp_now = date("Y/m/d H:i:s", mktime(0, 0, 0, $date_1["month"], $date_1["day"] + $i, $date_1["year"]));
	}
	$tmp_date = array_combine($keys, preg_split("/[\/: ]/", $tmp_now));
	
	if($db->getArrActiveProgRgl($tmp_now, $devId, $rows)){
		$roopCount = 0;
		foreach($rows as $row){
			$roopCount++;
			$progId = $row["prog_id"];
			$staTime = $row["sta_time"];
			$tmpStaDt = explode(":", $staTime);
			$staHour = $tmpStaDt[0];
			$staMin = $tmpStaDt[1];
			$staSecond = $tmpStaDt[2];
			$endTime = $row["end_time"];
			$tmpEndDt = explode(":", $endTime);
			$endHour = $tmpEndDt[0];
			$endMin = $tmpEndDt[1];
			$endSecond = $tmpEndDt[2];
			
			$year = $row["year"];
			$month = $row["month"];
			$day = $row["day"];
			$mon = $row["mon"];
			$tues = $row["tues"];
			$wednes = $row["wednes"];
			$thurs = $row["thurs"];
			$fri = $row["fri"];
			$satur = $row["satur"];
			$sun = $row["sun"];
			
			$staDt = date("Y-m-d H:i:s", mktime($staHour, $staMin, $staSecond, $tmp_date["month"], $tmp_date["day"], $tmp_date["year"]));
			if(($i) === $stbDailySyncInDays && $roopCount === count($rows)){
				//Retrieve only the data up to the set time on the last day of delivery target
				$endDt = date("Y-m-d H:i:s", mktime(STB_DAILY_SYNC_END_TIME_HOUR, STB_DAILY_SYNC_END_TIME_MIN, 0, $tmp_date["month"], $tmp_date["day"], $tmp_date["year"]));
			} else {
				$endDt = date("Y-m-d H:i:s", mktime($endHour, $endMin, $endSecond, $tmp_date["month"], $tmp_date["day"], $tmp_date["year"]));
			}
			
			array_push($arrProgRgl, array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $endDt));
		}
	}
}

//Acquire the program guide to be distributed from the terminal ID
$arrProg = array(); 
if($db->getArrActiveProg($now, $devId, $rows)){
	foreach($rows as &$row){
		if(is_null($row["sta_dt"]) || strtotime($row["sta_dt"]) < strtotime($now)){
			$row["sta_dt"] = date("Y-m-d H:i:s", mktime(0, 0, 0, $date_1["month"], $date_1["day"], $date_1["year"]));
		}
		
		//Consider settings that cross date
		$tmpEndDt = date("Y-m-d H:i:s", mktime(STB_DAILY_SYNC_END_TIME_HOUR, STB_DAILY_SYNC_END_TIME_MIN, 0, $date_1["month"], $date_1["day"] + $stbDailySyncInDays, $date_1["year"]));
		if(strtotime($row["end_dt"]) > strtotime($tmpEndDt)){
			$row["end_dt"] = $tmpEndDt;
		}
	}
	foreach($rows as &$row){
		calc($row, $arrProg);
	}
}

//Merging the program guide (repeated designation) and the program guide
foreach($arrProgRgl as $progRgl){
	calc($progRgl, $arrProg);
}

if(!empty($arrProg)){
	$arrTmpProg = array(array(),array(),array());
	foreach($arrProg as $prog){
		array_push($arrTmpProg[0], $prog["prog_id"]);
		array_push($arrTmpProg[1], $prog["sta_dt"]);
		array_push($arrTmpProg[2], $prog["end_dt"]);
	}
	array_multisort($arrTmpProg[1], SORT_ASC, SORT_STRING, $arrTmpProg[2], SORT_ASC, SORT_STRING, $arrTmpProg[0], SORT_DESC, SORT_NUMERIC);
	$arrProg = array();
	for($i = 0; $i < count($arrTmpProg[0]); $i++ ){
		array_push($arrProg, array("prog_id" => $arrTmpProg[0][$i], "sta_dt" => $arrTmpProg[1][$i], "end_dt" => $arrTmpProg[2][$i]));
	}
	//Content acquisition from merged effective program table
	foreach($arrProg as $row){
		$progId = $row["prog_id"];
		$staDt = $row["sta_dt"];
		$endDt = $row["end_dt"];
		$progXml = new ProgXml();
		$progXml->setProgId($progId);
		$progXml->setStaDt($staDt);
		$progXml->setEndDt($endDt);
		
		//Generate program guide from program guide ID
		if($db->getArrActivePlaylist($progId, $sexId, $playlistRows)){
			foreach($playlistRows as $playlistRow){
				$playlistXml    = new PlaylistXml();
				$playlistId     = $playlistRow["playlist_id"];
				$playlistRelaId = $playlistRow["playlist_rela_id"];
				$imageIntvl     = $playlistRow["image_intvl"];
				$ch             = $playlistRow["ch"];
				$randomFlg      = $playlistRow["random_flag"];
				$timezoneId     = $playlistRow["timezone_id"];
				$sta_time       = $playlistRow["sta_time"];
				$playlistXml->setPlaylistId($playlistId);
				$playlistXml->setPlaylistRelaId($playlistRelaId);
				$playlistXml->setImageIntvl($imageIntvl);
				$playlistXml->setCh($ch);
				if($randomFlg === 1){
					$playlistXml->setRandomFlg("true");
				} else {
					$playlistXml->setRandomFlg("false");
				}
				$ants_version = $playlistRow["ants_version"];
				// Acquire a program table with time zones
				if($db->getActivePlaylistExtra($timezoneId, $sta_time, $timezoneRows)){
					// movie
					if($db->getArrActiveMovieSignage($now, $playlistId, $playlistRelaId, $movieRows, $randomFlag)){
						foreach($movieRows as $movieRow){
							$arrServerUrl = array();
							$movieXml = new MovieXml($movieRow);
							//Switch processing with distribution server synchronization
							if(SERVER_SYNC_ENABLED_MOVIE){
								//Server synchronization enabled
								$movieId = $movieRow["movie_id"];
								$activeFileDir = $movieRow["active_file_dir"];
								$movieOrigFileSize = $movieRow["movie_orig_file_size"];
								$soundOrigFileSize = $movieRow["sound_orig_file_size"];
								$movieEncFileSize  = $movieRow["movie_enc_file_size"];
								$soundEncFileSize  = $movieRow["sound_enc_file_size"];
								$movieOrigHash     = $movieRow["movie_orig_hash"];
								$soundOrigHash     = $movieRow["sound_orig_hash"];
								$movieEncHash      = $movieRow["movie_enc_hash"];
								$soundEncHash      = $movieRow["sound_enc_hash"];
								$fileName = $movieRow["file_name"];
								if(ENCRYPT_ENABLED){
									$defaultFileDir = $movieRow["enc_file_dir"];
									$movieFileExte = $movieRow["movie_enc_file_exte"];
									$soundFileExte = $movieRow["sound_enc_file_exte"];
									if(is_null($movieFileExte) && is_null($soundFileExte)){
										//Ignored if it is before encryption
										if(strtotime($staDt) <= strtotime($now) && strtotime($now) < strtotime($endDt)){
											$beforeEncFlag = true;
										}
										continue;
									}
								} else {
									$defaultFileDir = $movieRow["orig_file_dir"];
									$movieFileExte = $movieRow["movie_orig_file_exte"];
									$soundFileExte = $movieRow["sound_orig_file_exte"];
								}

								$serverUp = $db->getArrMovieServer($now, $movieId, $movieServerRows , $ants_version);
								if($firstMovieFlag && $serverUp){
									$publOkFlag = true;	//If the first movie exists in the distribution server, it is expected that subsequent movies also have been uploaded at the start of the download
								}

								if($publOkFlag && $serverUp){
									$serverRowNum = 0;
									foreach($serverRows as $serverRow){
										$nextUseFlag = $serverRow["next_use_flag"];
										if($nextUseFlag === 1){
											//Used server
											$serverUrl = $serverRow["http_server_url"];
											break;
										} else {
											//Unused server
											if($serverRowNum == (count($serverRows) - 1)){
												//When the next use flag is all 0, use the first server
												$serverUrl = $serverRows[0]["http_server_url"];
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
									
									//The final URL is always the default server a
									if(ENCRYPT_ENABLED){
										array_push($arrServerUrl, DEFAULT_SERVER_ENC_URL . $defaultFileDir);
									} else {
										array_push($arrServerUrl, DEFAULT_SERVER_URL . $defaultFileDir);
									}
								}
								
								if(!empty($arrServerUrl)){
									if(!empty($movieFileExte)){
										$movieFile = new fileXml();
										$movieFile->setOrigHash($movieOrigHash);
										if(ENCRYPT_ENABLED){
											$movieFile->setEncHash($movieEncHash);
											$movieFile->setFileSize($movieEncFileSize);
										} else {
											$movieFile->setFileSize($movieOrigFileSize);
										}
										$movieFile->setOrigFileSize($movieOrigFileSize);
										foreach($arrServerUrl as $i => $serverUrl){
											$member = "setUrl" . ($i + 1);
											$movieFile->$member($serverUrl . $fileName . $movieFileExte);
										}
										$movieXml->setMovieFile($movieFile);
									}
									if(!empty($soundFileExte)){
										$soundFile = new fileXml();
										$soundFile->setOrigHash($soundOrigHash);
										if(ENCRYPT_ENABLED){
											$soundFile->setEncHash($soundEncHash);
											$soundFile->setFileSize($soundEncFileSize);
										} else {
											$soundFile->setFileSize($soundOrigFileSize);
										}
										$soundFile->setOrigFileSize($soundOrigFileSize);
										foreach($arrServerUrl as $i => $serverUrl){
											$member = "setUrl" . ($i + 1);
											$soundFile->$member($serverUrl . $fileName . $soundFileExte);
										}
										$movieXml->setSoundFile($soundFile);
									}
									
									if($movieFileExte === FILE_EXTE_SWF){
										//Flash
										$movieXml->setMovieType(MOVIE_TYPE_FLASH);
									} else if(!empty($soundFileExte) && empty($movieFileExte)){
										//Audio Only
										$movieXml->setMovieType(MOVIE_TYPE_SOUND_ONLY);
									} else {
										//Movie + sound
										$movieXml->setMovieType(MOVIE_TYPE_MOVIE_AND_SOUND);
									}
									$playlistXml->addArrMovie($movieXml);
								} else {
									//Do not publish it because the distribution server has not been transferred yet
								}
								$firstMovieFlag = false;
							} else {
								//Server sync disabled
								if(ENCRYPT_ENABLED){
									$movieFileExte = $movieRow["movie_enc_file_exte"];
									$soundFileExte = $movieRow["sound_enc_file_exte"];
									if(is_null($movieFileExte) && is_null($soundFileExte)){
										//Ignored if it is before encryption
										if(strtotime($staDt) <= strtotime($now) && strtotime($now) < strtotime($endDt)){
											$beforeEncFlag = true;
										}
										continue;
									}
								}
								$playlistXml->addArrMovie($movieXml);
								$publOkFlag == true;
							}
						}
					}
					
					//image
					if($db->getArrActiveImage($now, $playlistId, $imageRows, $devId)){
						foreach($imageRows as $imageRow){
							$arrServerUrl = array();
							$imageXml = new ImageXml($imageRow);
							//Switch processing with distribution server synchronization
							if(SERVER_SYNC_ENABLED_IMAGE){
								//Server synchronization enabled
								$imageId = $imageRow["image_id"];
								$imageName = $imageRow["image_name"];
								$displayOrder = $imageRow["display_order"];
								$origHash = $imageRow["orig_hash"];
								$encHash = $imageRow["enc_hash"];
								$activeFileDir = $imageRow["active_file_dir"];
								$encFileDir = $imageRow["enc_file_dir"];
								$origFileDir = $imageRow["orig_file_dir"];
								$origFileSize = $imageRow["orig_file_size"];
								$encFileSize = $imageRow["enc_file_size"];
								$origFileExte = $imageRow["orig_file_exte"];
								$encFileExte = $imageRow["enc_file_exte"];
								$fileName = $imageRow["file_name"];
								if(ENCRYPT_ENABLED){
									$defaultFileDir = $encFileDir;
									$fileExte = $encFileExte;
									if(is_null($fileExte)){
										//Ignored if it is before encryption
										if(strtotime($staDt) <= strtotime($now) && strtotime($now) < strtotime($endDt)){
											$beforeEncFlag = true;
										}
										continue;
									}
								} else {
									$defaultFileDir = $origFileDir;
									$fileExte = $origFileExte;
								}
								
								//If no movie is delivered, or if even one of them has been uploaded
								//I expect that the following image has been uploaded
								//(Originally you should check one file at a time)
	//							if($db->getArrImageServer($imageId, $serverRows)){
								if(($firstMovieFlag || $publOkFlag) && !empty($serverRows)){
									$serverRowNum = 0;
									foreach($serverRows as $serverRow){
										$nextUseFlag = $serverRow["next_use_flag"];
										if($nextUseFlag === 1){
											//Used server
											$serverUrl = $serverRow["http_server_url"];
											break;
										} else {
											//Unused server
											if($serverRowNum == (count($serverRows) - 1)){
												//When the next use flag is all 0, use the first server
												$serverUrl = $serverRows[0]["http_server_url"];
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
								}
								
								if(!empty($arrServerUrl)){
									$imageFile = new fileXml();
									$imageFile->setOrigHash($origHash);
									if(ENCRYPT_ENABLED){
										$imageFile->setEncHash($encHash);
										$imageFile->setFileSize($encFileSize);
									} else {
										$imageFile->setFileSize($origFileSize);
									}
									$imageFile->setOrigFileSize($origFileSize);
									foreach($arrServerUrl as $i => $serverUrl){
										$member = "setUrl" . ($i + 1);
										$imageFile->$member($serverUrl . $fileName . $fileExte);
									}
									$imageXml->setImageFile($imageFile);
									$playlistXml->addArrImage($imageXml);
									$publOkFlag = true;
								} else {
									//Do not publish it because the distribution server has not been transferred yet
								}
							} else {
								if(ENCRYPT_ENABLED){
									$encFileExte = $imageRow["enc_file_exte"];
									if(is_null($encFileExte)){
										//Ignored if it is before encryption
										if(strtotime($staDt) <= strtotime($now) && strtotime($now) < strtotime($endDt)){
											$beforeEncFlag = true;
										}
										continue;
									}
								}
								$playlistXml->addArrImage($imageXml);
								$publOkFlag = true;
							}
						}
					}
					
					//text
					if($db->getArrActiveText($now, $playlistId, $textRows, $devId)){
						foreach($textRows as $textRow){
							$textXml = new TextXml($textRow);
							$playlistXml->addArrText($textXml);
							$publOkFlag = true;
						}
					}
					
					//Merge image into movie due to restriction by terminal side processing (limited to movie of single drawing area)
					if($db->getArrDrawArea($playlistRow["draw_tmpl_id"], $drawAreaRows)){
						if(count($drawAreaRows) === 1 && $drawAreaRows[0]["cts_type"] === "movie"){
							$arrTmpMovie = array();
							foreach($playlistXml->getArrImage() as $image){
								$tmpMovieImageRow = array();
								$tmpMovieImageRow["movie_id"] = "image_" . $image->getImageId();
								$tmpMovieImageRow["movie_name"] = $image->getImageName();
								$tmpMovieImageRow["display_order"] = $image->getDisplayOrder();
								$tmpMovieImageRow["play_time"] = null;
								$tmpMovieImageRow["orig_file_dir"] = null;
								$tmpMovieImageRow["enc_file_dir"] = null;
								$tmpMovieImageRow["active_file_dir"] = null;
								$tmpMovieImageRow["movie_orig_file_size"] = null;
								$tmpMovieImageRow["sound_orig_file_size"] = null;
								$tmpMovieImageRow["movie_enc_file_size"] = null;
								$tmpMovieImageRow["sound_enc_file_size"] = null;
								$tmpMovieImageRow["movie_orig_hash"] = null;
								$tmpMovieImageRow["sound_orig_hash"] = null;
								$tmpMovieImageRow["movie_enc_hash"] = null;
								$tmpMovieImageRow["sound_enc_hash"] = null;
								$tmpMovieImageRow["movie_orig_file_exte"] = null;
								$tmpMovieImageRow["sound_orig_file_exte"] = null;
								$tmpMovieImageRow["movie_enc_file_exte"] = null;
								$tmpMovieImageRow["sound_enc_file_exte"] = null;
								$tmpMovieImageRow["sta_dt"] = $image->getStaDt();
								$tmpMovieImageRow["end_dt"] = $image->getEndDt();
								$tmpMovieImageRow["file_name"] = null;
								$tmpMovieImageRow["x"] = $image->getX();;
								$tmpMovieImageRow["y"] = $image->getY();
								$tmpMovieImageRow["width"] = $image->getWidth();
								$tmpMovieImageRow["height"] = $image->getHeight();
								
								$movieXml = new MovieXml($tmpMovieImageRow);
								$movieXml->setMovieFile($image->getImageFile());
								$arrTmpMovie[$image->getDisplayOrder()] = $movieXml;
							}
							foreach($playlistXml->getArrMovie() as $movie){
								$arrTmpMovie[$movie->getDisplayOrder()] = $movie;
							}
							ksort($arrTmpMovie);
							$playlistXml->setArrMovie($arrTmpMovie);
							$playlistXml->setArrImage(array());
						}
					}
					$progXml->addArrPlaylist($playlistXml);
				}
			}
		}
		
		//If the program table currently being reproduced is being encrypted and there is no public content, it is treated as synchronization (restriction on terminal side processing)
		if($beforeEncFlag && strtotime($staDt) <= strtotime($now) && strtotime($now) < strtotime($endDt)){
			$tmpEncFlag = true;
			foreach($progXml->getArrPlaylist() as $playlist){
				if(count($playlistXml->getArrImage()) > 0 || count($playlistXml->getArrMovie()) > 0 || count($playlistXml->getArrText()) > 0){
					$tmpEncFlag = false;
				}
			}
			if($tmpEncFlag){
				$devProgDlXml->setWaitServerSync("true");
			}
		}
		$devProgDlXml->addArrProg($progXml);
	}
	
	//Program table is being delivered but not delivered because it is not transferred server
	if($firstMovieFlag == false && $publOkFlag == false){
		$devProgDlXml->setWaitServerSync("true");
	}
} else {
	//The group table does not exist
}

//Program guide ID
$arrProgId = array();
foreach($arrProg as $prog){
	array_push($arrProgId, $prog["prog_id"]);
}

//Get ants version from terminal ID
$db->getDevidAntsVersion($devId,$antsVersionRows);
$devIdAntsVersion = $antsVersionRows[0]["ants_version"];

//Program guide download time setting
if($devIdAntsVersion == ANTS_TWO_KIND){
    //Set time only when terminal is ants2
    $devProgDlXml->setDevProgDlTime(date("Y/m/d H:i:s"));
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
$devProgDlXml->setDevLogDir($log_url);

//Set the signage start end time
if($db->getShop($devId, $row)){
	//Authorized terminal
} else {
	//Unauthorized terminal
	echo($devProgDlXml->getXml());
	return;
}
$devProgDlXml->setStartTime( $devProgDlXml->toggle_time_format($row["sta_t"]) );
$devProgDlXml->setEndTime( $devProgDlXml->toggle_time_format($row["end_t"]) );

//Start transaction for log change
$db->startTransaction();
if($db->getNextDevProgDlLogId($row)){
	$devProgDlLogId = $row["nextval"];
	$devProgDlXml->setDevProgDlLogId($devProgDlLogId);
	
	//Move old log
	$db->moveDevProgDlStaLog($now, $devId);
	
	//Create log
	$db->insDevProgDlStaLog($now, $devProgDlLogId, $devId, $arrProgId);
}
if($db->isInTransaction()){
	//End transaction
	$db->endTransaction();
}

echo($devProgDlXml->getXml());

function calc($row, &$arrTmpProg){
	$progId = $row["prog_id"];
	$staDt = $row["sta_dt"];
	$endDt = $row["end_dt"];
	if(empty($arrTmpProg)){
		array_push($arrTmpProg, array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $endDt));
	} else {
		$push = true;
		foreach($arrTmpProg as $prog){
			if($prog["sta_dt"] <= $staDt && $prog["end_dt"] >= $endDt){
				//Completely included
				$push = false;
				continue;
			} else if($prog["sta_dt"] > $endDt || $prog["end_dt"] < $staDt){
				//It is not included at all
				continue;
			} else if($prog["sta_dt"] > $staDt && $prog["end_dt"] < $endDt){
				//Complete inclusion (necessity of division)
				calc(array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $prog["sta_dt"]), $arrTmpProg);
				calc(array("prog_id" => $progId, "sta_dt" => $prog["end_dt"], "end_dt" => $endDt), $arrTmpProg);
				return;
			} else {
				//Including part
				if($prog["sta_dt"] < $endDt && $prog["end_dt"] >= $endDt){
					$endDt = $prog["sta_dt"];
				}
				if($prog["end_dt"] > $staDt && $prog["sta_dt"] <= $staDt){
					$staDt = $prog["end_dt"];
				}
			}
		}
		if($push){
			array_push($arrTmpProg, array("prog_id" => $progId, "sta_dt" => $staDt, "end_dt" => $endDt));
		}
	}
}
?>
