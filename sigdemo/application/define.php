	<?php
//URL setting
define('SERVER_URL', 'https://signage118.net-ants.com/sigdemo_cts/');	//サーバURL

//File encryption setting
define("ENCRYPT_ENABLED", false);

//Digest authentication setting
define("DIGEST_AUTH_ENABLED", true);
define("DIGEST_AUTH_USER", "sigdemo");
define("DIGEST_AUTH_PASSWD", "R9j8faVT");

//Various settings
define("CHUNK_SIZE", 1024 * 1024);					//Chunk size at file return
define("CTS_PER_DIR", 1000);						//Number of contents stored per directory
define("CTS_FILE_PAD_LEN", 10);						//File name number of digits
define("CTS_DIR_PAD_LEN", 10);						//Directory name number of digits
define("ACCESS_LOG_HTML_FILE_PAD_LEN", 10);			//Access log HTML file name Number of digits
define("MAX_PAGE_CNT", 10);							//Maximum number of pages per screen
define("MAX_CNT_PER_PAGE", 100);					//Maximum number of display items per page
define("MAX_CNT_PER_PARENT", 5);					//Maximum number of child records per parent record
define("MAX_PLAYLIST_MOVIE", 50);					//Maximum number of Movie per playlist
define("MAX_COMMONPLAYLIST", 38);					//1 Maximum number of contents per common playlist
define("MAX_PROGRGL_DOW", 3);						//Number of days of the week division of program guide (repeated designation) Setting range: 1 to 7
define("MAX_PROGRGL_PLAYLIST", 10);					//Number of settable playlists for program guide (repeated designation)
define("PROGRGL_BASE_STA_TIME", "00:00:00");		//Base start time of program guide (repeated designation)
define("PROGRGL_BASE_END_TIME", "23:59:59");		//Base end time of program guide (repeated designation)
define("LOGIN_FAULT_THRE", 5);						//Error login failure error screen transition threshold
define("PROGRGL_STA_HOUR", 8);						//Repeat designation execution setting start time (hour)
define("PROGRGL_STA_MIN", 0);						//Repeat Specified Execution Setting Start Time (Minutes)
define("PROGRGL_END_HOUR", 21);						//Repeat designation execution setting end time (hour)
define("PROGRGL_END_MIN",30);						//Repeat Specified Execution Setting End Time (Minute)
define("PROGRGL_INTVL_HOUR", 0);					//Repeat designation execution setting interval (hour)
define("PROGRGL_INTVL_MIN", 30);					//Repeat specification execution setting interval (minutes)
define("ROTATE_ANGLE",270);							//Angle at which the still image is automatically rotated at registration Left side comes up Vertical monitor = 270 Left side comes down Vertical monitor = 90
define("MAX_CNT_DLLOG_OLD", 999);					//Maximum number of download histories by terminal
//Program guide indicator string
define("PROG_INST_STR", "inst");	//Specify date
define("PROG_RGL_STR", "rgl");		//Repeated designation

//URL setting
define("ORIG_FILE_URL", "/original/");				//Unencrypted file directory (URL)

//Setting for standalone
define("STAND_ALONE_BAT_FILE_NAME", "getProg.bat" );
define("STAND_ALONE_XML_FILE_NAME", "ch.xml" );
define("FILE_EXTE_SWF", ".swf");						//FlashPlayer uses discriminating arbitrage
define("MOVIE_TYPE_MOVIE_AND_SOUND", 1);				//Movie Type Movie + Audio
define("MOVIE_TYPE_SOUND_ONLY", 2);						//Movie type audio only
define("MOVIE_TYPE_FLASH", 3);							//Movie type Flash
define("STAND_ALONE_CH", 1);							//Standalone playlist download ch

//Directory path setting
define("TEMP_FILE_DIR", "/data/tmp/sigdemo/cts/");		//Temp directory
define("ORIG_FILE_DIR", "/data/sigdemo/original/");		//Directory for unencrypted files (local)
define("ENC_FILE_DIR", "/data/sigdemo/encrypted/");		//Encrypted file directory (local)
define("ACTIVE_FILE_DIR", "/data/sigdemo/active/");		//Distribution target file directory (local)
define("COMMON_FILE_DIR", "common/");					//Movie file placement directory
define("MOVIE_FILE_DIR", "movie/");					//Movie file placement directory
define("IMAGE_FILE_DIR", "image/");					//Image file placement directory
define("HTML_FILE_DIR", "html/");					//Directory for placing HTML files
define("ACCESS_LOG_HTML_DIR", "/var/log/signage/sigdemo/dev/html/");	//Access analysis HTML storage directory
define("DEV_LOG_DIR", "/var/log/signage/sigdemo/dev/log/");	//Terminal log storage directory

//Log file name
define("VERSION_FILE_NAME", "stb_version");	//sw version file name
define("EXCEL_DEV_LOG_FILE", "./excel/dev_log_tmpl.xlsx");	//Terminal log EXCEL file
define("EXCEL_DEV_PLAY_COUNT_FILE", "./excel/dev_log_play_count_tmpl.xlsx");	//Content play count log EXCEL file
define("EXCEL_TMP_PATH", "/tmp/signage/excel/");

//Algorithm setting
define("HASH_ALGO", "sha256");						//hash
define("ENC_ALGO", "aes-256-cbc");					//File encryption

//Module classification
define("MODULE_CAT_SIGNAGE", "signage");
define("MODULE_CAT_SIGNAGE_CTS", "signage_cts");
define("MODULE_CAT_SIGNAGE_COMMON_CTS", "signage_common_cts");
define("MODULE_CAT_SIGNAGE_SET", "signage_set");
define("MODULE_CAT_HTML", "html");
define("MODULE_CAT_HTML_CTS", "html_cts");
define("MODULE_CAT_HTML_SET", "html_set");
define("MODULE_CAT_MST", "mst");
define("MODULE_CAT_DL", "dl");
define("MODULE_CAT_LOG", "log");

//Module classification name
define("MODULE_DISP_CAT_SIGNAGE", "Signage management");
define("MODULE_DISP_CAT_SIGNAGE_CTS", "Content Management");
define("MODULE_DISP_CAT_SIGNAGE_COMMON_CTS", "Common Content Management");
define("MODULE_DISP_CAT_SIGNAGE_SET", "Delivery management");
define("MODULE_DISP_CAT_HTML", "Smart phone delivery management");
define("MODULE_DISP_CAT_HTML_CTS", "Content Management");
define("MODULE_DISP_CAT_HTML_SET", "Delivery management");
define("MODULE_DISP_CAT_MST", "Master Admin");
define("MODULE_DISP_CAT_DL", "Download management");
define("MODULE_DISP_CAT_LOG", "Log management");

//Module name
define("MODULE_NAME_AUTHGRP", "authgrp");
define("MODULE_NAME_ACCESSLOG", "accesslog");
define("MODULE_NAME_BOOTH", "booth");
define("MODULE_NAME_CLIENT", "client");
define("MODULE_NAME_COMMONIMAGE", "commonimage");
define("MODULE_NAME_COMMONMOVIE", "commonmovie");
define("MODULE_NAME_COMMONTEXT", "commontext");
define("MODULE_NAME_CTSDL", "ctsdl");
define("MODULE_NAME_DEV", "dev");
define("MODULE_NAME_DEVHTML", "devhtml");
define("MODULE_NAME_DEVHTMLVIEW", "devhtmlview");
define("MODULE_NAME_DEVPROG", "devprog");
define("MODULE_NAME_DLLOG", "dllog");
define("MODULE_NAME_HTML", "html");
define("MODULE_NAME_IMAGE", "image");
define("MODULE_NAME_LOGIN", "login");
define("MODULE_NAME_LORDER", "loader");
define("MODULE_NAME_MENU", "menu");
define("MODULE_NAME_MOVIE", "movie");
define("MODULE_NAME_COMMONPLAYLIST", "commonplaylist");
define("MODULE_NAME_PLAYLIST", "playlist");
define("MODULE_NAME_PLAYLISTALL", "playlistall");
define("MODULE_NAME_PLAYLISTDL", "playlistdl");
define("MODULE_NAME_PROG", "prog");
define("MODULE_NAME_PROGRGL", "progrgl");
define("MODULE_NAME_PROGVIEW", "progview");
define("MODULE_NAME_SHOP", "shop");
define("MODULE_NAME_SOLDOUT", "soldout");
define("MODULE_NAME_TAG", "tag");
define("MODULE_NAME_TEXT", "text");
define("MODULE_NAME_TIMEZONE", "timezone");
define("MODULE_NAME_USER", "user");
define("MODULE_NAME_MAIL", "mail");
define("MODULE_NAME_PLAYCNT", "playcnt");
define("MODULE_NAME_PHPEXCEL", "phpexcel");
define("MODULE_NAME_RANDOM", "random");
define("MODULE_NAME_SOUNDALL", "soundall");
define("MODULE_NAME_PROPERTY", "property");

//Module name (for header display)
define("MODULE_DISP_NAME_AUTHGRP", "Authority management");
define("MODULE_DISP_NAME_ACCESSLOG", "Access log display");
define("MODULE_DISP_NAME_BOOTH", "booth");
define("MODULE_DISP_NAME_CLIENT", "Contract client");
define("MODULE_DISP_NAME_COMMONIMAGE", "Common static painting management");
define("MODULE_DISP_NAME_COMMONMOVIE", "Common movie management");
define("MODULE_DISP_NAME_COMMONTEXT", "Common text management");
define("MODULE_DISP_NAME_CTSDL", "Content Download");
define("MODULE_DISP_NAME_DEV", "Terminal");
define("MODULE_DISP_NAME_DEVHTML", "Smart phone delivery management");
define("MODULE_DISP_NAME_DEVHTMLVIEW", "Smartphone distribution by terminal");
define("MODULE_DISP_NAME_DEVPROG", "Program guide management");
define("MODULE_DISP_NAME_DLLOG", "Download log");
define("MODULE_DISP_NAME_HTML", "Smartphone content management");
define("MODULE_DISP_NAME_IMAGE", "Still painting management");
define("MODULE_DISP_NAME_LOGIN", "Login");
define("MODULE_DISP_NAME_MENU", "Signage trafficking management");
define("MODULE_DISP_NAME_MOVIE", "Movie management");
define("MODULE_DISP_NAME_COMMONPLAYLIST", "Common playlist management");
define("MODULE_DISP_NAME_PLAYLIST", "Playlist management");
define("MODULE_DISP_NAME_PLAYLISTALL", "Register playlist in bulk");
define("MODULE_DISP_NAME_PLAYLISTDL", "Download playlist");
define("MODULE_DISP_NAME_PROG", "Program guide (date designation) management");
define("MODULE_DISP_NAME_PROGRGL", "Program guide (repeated designation) management");
define("MODULE_DISP_NAME_PROGVIEW", "Display by TV program table");
define("MODULE_DISP_NAME_SHOP", "Facility");
define("MODULE_DISP_NAME_SOLDOUT", "Sold out still image replacement");
define("MODULE_DISP_NAME_TAG", "Tag management");
define("MODULE_DISP_NAME_TEXT", "Text management");
define("MODULE_DISP_NAME_TIMEZONE", "Delivery time type");
define("MODULE_DISP_NAME_USER", "Delivery time type");
define("MODULE_DISP_NAME_MAIL", "Mail settings");
define("MODULE_DISP_NAME_PLAYCNT", "View count");
define("MODULE_DISP_NAME_PHPEXCEL", "Excel export");
define("MODULE_DISP_NAME_RANDOM", "Random play");
define("MODULE_DISP_NAME_SOUNDALL", "Batch bulk registration");
define("MODULE_DISP_NAME_PROPERTY", "Attribute management");

//Operation name
define("ACTION_SEL", "sel");
define("ACTION_INS_SELTMPL", "ins_seltmpl");
define("ACTION_INS", "ins");
define("ACTION_INS_CLITMPL", "ins_clitmpl");
define("ACTION_UP_SELTMPL", "up_seltmpl");
define("ACTION_UP", "up");
define("ACTION_COPY", "copy");
define("ACTION_DEL", "del");
define("ACTION_EXCEL", "excel");
define("ACTION_EXCEL_PLAY_COUNT", "excel_play_count");
define("ACTION_LUMP_DEL", "lump_del");
define("MOVE_ERROR", "move_err");
define("TARGET_NOT_FOUND_ERROR", "target_not_found_err");

//Client Content File Size Capacity (GB)
define('CLIENT_MAX_TOTAL_SIZE_DEFAULT', 10);

//Device name
define('DEV_NAME_DEFAULT', 'device');

//Device ID
define("DEV_CAT_ID_STB", 0);

//DB user
define('DB_USER_PREFIX_USER', 'user_');				//Prefix for uploading site users

//Provisional drawing area ID
define('TMP_DRAW_AREA_ID', '1');

//Key for session registration
define("SESS_DISP_MODULE_NAME", "disp_module_name");

//Provided service
define("SERVICE_SIGNAGE", 1);		//signage
define("SERVICE_SMARTPHONE", 2);	//smartphone
define("SERVICE_ANTS_ONE_ENABLE", true);	//ANTS valid flag

//ANT 'S type
define("ANTS_ONE_KIND", 1);
define("ANTS_TWO_KIND", 2);

//ANT'S type name
define("ANTS_ONE_KIND_NAME", "ant's1");
define("ANTS_TWO_KIND_NAME", "ant's2");

//sex
define("SEX_KIND_MAN", 0);
define("SEX_KIND_WOMAN", 1);

//Number of registered songs by contract Contents upper limit
define("EXTRA_PLAYLIST_MAX_MOVIE", 2);

//Distribution time type type
define("TIME_ZONE_ALL", 1);
define("TIME_ZONE_MORNING", 2);
define("TIME_ZONE_NOON", 3);
define("TIME_ZONE_EVENING", 4);

//Playlist Template Type: Horizontal Full Screen (Movie)
define("DRAW_TMPL_LAND_MOVIE", 5);

// Drawing area type: horizontal full screen (movie)
define("DRAW_AREA_LAND_MOVIE", 10);

define("SESS_LOGIN_TRY_CNT", "login_try_count");
define("SESS_LOGIN_USER_CLIENT_ID", "user_client_id");
define("SESS_LOGIN_USER_CLIENT_NAME", "user_client_name");
define("SESS_LOGIN_TARGET_CLIENT_ID", "target_client_id");
define("SESS_LOGIN_TARGET_CLIENT_NAME", "target_client_name");
define("SESS_LOGIN_ADMIN_FLAG", "admin_flag");
define("SESS_ARR_USER_AUTH", "arr_auth");
define("SESS_IRREGULAR_DISP_MSG", "irregular_disp_msg");
define("SESS_TOKEN", "token");

//Check if the program guide is continuous
//Various numerical setting
define("ENABLE_CHECK_PROGRAM",false); //Enable / disable checking
define("STB_DAILY_CHECK_IN_DAYS", 1); //○ Daily program list acquisition setting range: numerical value equal to or larger than 0
define("CHECK_STA_TIME","09:00"); //Continuous check start time of program guide
define("CHECK_END_TIME","22:00"); //Continuous check end time of program guide
define("STB_DAILY_CHECK_END_TIME_HOUR", 23);							//Continuous check end time of program guide
define("STB_DAILY_CHECK_END_TIME_MIN", 59);							//Program table delivery end time (minutes) Setting range: 0 - 59
?>
