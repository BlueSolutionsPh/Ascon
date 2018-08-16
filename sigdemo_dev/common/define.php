<?php
//URL setting
define('DEFAULT_SERVER_URL', 'http://signage118.net-ants.com/sigdemo_cts/');	//Default distribution servers
define('DEFAULT_SERVER_ENC_URL', 'http://signage118.net-ants.com/sigdemo_enc_cts/');  //Default distribution server (with encryption)
define('LOG_URL', 'https://signage118.net-ants.com/sigdemo_log/');	//Log save destination URL

//DB connection settings
define("CONNECT_DSN", "pgsql:host=103.14.212.20;dbname=sigdemodb");
define("CONNECT_USER", "sigdemo");
define("CONNECT_PASSWORD", "fL8tgZ2C");

//File encryption, distribution server synchronization setting setting
define("ENCRYPT_ENABLED", false);
define("SERVER_SYNC_ENABLED_MOVIE", false);
define("SERVER_SYNC_ENABLED_IMAGE", false);
define("SERVER_SYNC_ENABLED_HTML", false);

//Various numerical setting
define("STB_DAILY_SYNC_IN_DAYS", 1);								//○ Daily program list acquisition setting range: numerical value equal to or larger than 0
define("STB_DAILY_SYNC_IN_TIME", "00:00:00");						//Return program list on the last day after hour
define("STB_DAILY_SYNC_END_TIME_HOUR", 23);							//Program table delivery end time (hour) Setting range: 0 - 23
define("STB_DAILY_SYNC_END_TIME_MIN", 59);							//Program table delivery end time (minutes) Setting range: 0 - 59

//Communication restriction parameter
define("DL_OK_START_TIME", "00:00");								//Available downloading start time (00:00 notation)
define("DL_OK_END_TIME", "23:59");									//Downloadable time end (00: 00 notation) If you want to set it to 24 hours, set it at 00: 00 - 23: 59
define("POLLING_INTERVAL", 60);										//Polling interval (minutes)
define("RANDOM_MARGIN", 1);											//Width of fluctuation at the start of communication (minutes) Value to disperse so that each terminal does not access all at once

//Directory path setting
define("ORIG_FILE_DIR", "/data/sigdemo/original/");						//Directory for unencrypted files
define("ENC_FILE_DIR", "/data/sigdemo/encrypted/");						//Encrypted file directory
define("ACTIVE_FILE_DIR", "/data/sigdemo/active/");						//Distribution target file directory
define("TMP_ACTIVE_FILE_DIR", "/tmp/signage/sigdemo/tmp_active/");			//Temporary directory for movie file synchronization operation
define("MOVIE_FILE_DIR", "movie/");									//Movie file placement directory
define("IMAGE_FILE_DIR", "image/");									//Image file placement directory
define("HTML_FILE_DIR", "html/");									//Directory for placing HTML files

//Terminal log related
define("DEV_LOG_DIR", "/var/log/signage/sigdemo/dev/log/");			//Terminal state log storage directory
define("DEV_LOG_FILE_PAD_LEN", 10);							//Access log HTML file name Number of digits

//DB user
define('DB_USER_PREFIX_DEV', 'dev_');								//Terminal ID prefix

//Constant setting
define("FILE_EXTE_SWF", ".swf");									//FlashPlayer uses discriminating arbitrage
define("MOVIE_TYPE_MOVIE_AND_SOUND", 1);							//Movie Type Movie + Audio
define("MOVIE_TYPE_SOUND_ONLY", 2);									//Movie type audio only
define("MOVIE_TYPE_FLASH", 3);										//Movie type Flash
define("STAND_ALONE_CH", 1);										//Standalone playlist download ch

//awstats log summary directory path setting
define("LOG_FILE_DIR", "/var/log/signage/sigdemo/dev/accesslog/");			//Directory for log files
define("AWSTATS_HTML_FILE_DIR", "/var/log/signage/sigdemo/dev/html/");		//awstats log total result HTML directory

//Number of views directory path setting
define("PLAY_CNT_FILE_DIR", "/var/log/signage/sigdemo/dev/playcnt/");			//Directory for log files

//Provided service
define("SERVICE_ANTS_ONE_ENABLE", true);	//ANTS valid flag

//ANT 'S type
define("ANTS_ONE_KIND", 1);
define("ANTS_TWO_KIND", 2);
?>
