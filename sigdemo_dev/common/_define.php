<?php
//URL setting
define('DEFAULT_SERVER_URL', 'http://signage-zero.net-ants.com/ants2_cts/');	//Default distribution server
define('DEFAULT_SERVER_ENC_URL', 'http://signage-zero.net-ants.com/ants2_enc_cts/');  //Default distribution server (with encryption)
define('LOG_URL', 'https://signage-zero.net-ants.com/ants2_log/');	//Log save destination URL

//DB connection settings
define("CONNECT_DSN", "pgsql:host=157.7.140.130;dbname=ants2db");
define("CONNECT_USER", "ants2");
define("CONNECT_PASSWORD", "QmzrB8S6");

//File encryption, distribution server synchronization setting setting
define("ENCRYPT_ENABLED", true);
define("SERVER_SYNC_ENABLED_MOVIE", true);
define("SERVER_SYNC_ENABLED_IMAGE", true);
define("SERVER_SYNC_ENABLED_HTML", true);

//Various numerical setting
define("STB_DAILY_SYNC_IN_DAYS", 1);								//○ Daily program list acquisition setting range: numerical value equal to or larger than 0
define("STB_DAILY_SYNC_IN_TIME", "00:00:00");						//Return program list on the last day after hour
define("STB_DAILY_SYNC_END_TIME_HOUR", 23);							//Program table delivery end time (hour) Setting range: 0 - 23
define("STB_DAILY_SYNC_END_TIME_MIN", 59);							//Program table delivery end time (minutes) Setting range: 0 - 59

//Communication restriction parameter
define("DL_OK_START_TIME", "09:00");								//Available downloading start time (00:00 notation)
define("DL_OK_END_TIME", "23:00");									//End of downloadable time (00: 00 notation) If start and end are the same, it is considered to be downloadable for 24 hours
define("POLLING_INTERVAL", 5);										//Polling interval (minutes)
define("RANDOM_MARGIN", 1);											//Width of fluctuation at the start of communication (minutes) Value to disperse so that each terminal does not access all at once

//Directory path setting
define("ORIG_FILE_DIR", "/data/ants2/original/");						//Directory for unencrypted files
define("ENC_FILE_DIR", "/data/ants2/encrypted/");						//Encrypted file directory
define("ACTIVE_FILE_DIR", "/data/ants2/active/");						//Distribution target file directory
define("TMP_ACTIVE_FILE_DIR", "/tmp/signage/ants2/tmp_active/");			//Temporary directory for movie file synchronization operation
define("MOVIE_FILE_DIR", "movie/");									//Movie file placement directory
define("IMAGE_FILE_DIR", "image/");									//Image file placement directory
define("HTML_FILE_DIR", "html/");									//Directory for placing HTML files

//Terminal log related
define("DEV_LOG_DIR", "/var/log/signage/ants2/dev/log/");			//Terminal state log storage directory
define("DEV_LOG_FILE_PAD_LEN", 10);							//Access log HTML file name Number of digits

//DB user
define('DB_USER_PREFIX_DEV', 'dev_');								//Terminal ID prefix
//Constant setting
define("FILE_EXTE_SWF", ".swf");									//Constant setting
define("MOVIE_TYPE_MOVIE_AND_SOUND", 1);							//Movie Type Movie + Audio
define("MOVIE_TYPE_SOUND_ONLY", 2);									//Movie type audio only
define("MOVIE_TYPE_FLASH", 3);										//Movie type Flash
define("STAND_ALONE_CH", 1);										//Standalone playlist download ch

//awstats log summary directory path setting
define("LOG_FILE_DIR", "/var/log/signage/ants2/dev/accesslog/");			//Directory for log files
define("AWSTATS_HTML_FILE_DIR", "/var/log/signage/ants2/dev/html/");		//awstats log total result HTML directory

//Number of views directory path setting
define("PLAY_CNT_FILE_DIR", "/var/log/signage/ants2/dev/playcnt/");			//Directory for log files

//Provided service
define("SERVICE_ANTS_ONE_ENABLE", true);	//ANTS valid flag

// ANT 'S type
define("ANTS_ONE_KIND", 1);
define("ANTS_TWO_KIND", 2);
?>
