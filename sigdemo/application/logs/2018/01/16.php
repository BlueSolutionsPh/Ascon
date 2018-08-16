<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-16 09:39:54 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000004" requires 2 [ insert into 	m_image( 		image_id, 		client_id, 		image_name, 		orig_file_dir, 		file_name, 		orig_file_name, 		orig_file_exte, 		orig_file_size, 		orig_hash, 		width, 		height, 		sta_dt, 		end_dt, 		property_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		33, 		1, 		'静止画6', 		'0000000000/image/0000000000/', 		'0000000033', 		'620_300', 		'.png', 		20158, 		'ae883c1592c491ad2f1e29805cacb40b7d54bc822e63221e9cd830a57344a818', 		:width, 		:height, 		'2018-01-04 00:00', 		'2018-01-23 23:59', 		NULL, 		'user_1', 		'2018/01/16 09:39:54', 		'user_1', 		'2018/01/16 09:39:54' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 09:45:06 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000004" requires 2 [ insert into 	m_image( 		image_id, 		client_id, 		image_name, 		orig_file_dir, 		file_name, 		orig_file_name, 		orig_file_exte, 		orig_file_size, 		orig_hash, 		width, 		height, 		sta_dt, 		end_dt, 		property_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		35, 		1, 		'静止画3_1', 		'0000000000/image/0000000000/', 		'0000000035', 		'620_300', 		'.png', 		20158, 		'ae883c1592c491ad2f1e29805cacb40b7d54bc822e63221e9cd830a57344a818', 		:width, 		:height, 		'2018-01-03 00:00', 		'2018-01-24 23:59', 		NULL, 		'user_1', 		'2018/01/16 09:45:06', 		'user_1', 		'2018/01/16 09:45:06' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 10:10:24 --- ERROR: ErrorException [ 1 ]: Class 'Model_M_Image2' not found ~ MODPATH/movie/classes/model/movie.php [ 727 ]
2018-01-16 10:10:24 --- STRACE: ErrorException [ 1 ]: Class 'Model_M_Image2' not found ~ MODPATH/movie/classes/model/movie.php [ 727 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 10:16:02 --- ERROR: ErrorException [ 1 ]: Class 'Model_M_Image2' not found ~ MODPATH/movie/classes/model/movie.php [ 756 ]
2018-01-16 10:16:02 --- STRACE: ErrorException [ 1 ]: Class 'Model_M_Image2' not found ~ MODPATH/movie/classes/model/movie.php [ 756 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 10:17:47 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ insert into 	m_image( 		image_id, 		client_id, 		image_name, 		orig_file_dir, 		file_name, 		orig_file_name, 		orig_file_exte, 		orig_file_size, 		orig_hash, 		width, 		height, 		sta_dt, 		end_dt, 		property_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		NULL, 		1, 		'テロップ', 		NULL, 		NULL, 		'620_300', 		'.png', 		NULL, 		NULL, 		:width, 		:height, 		'2018-01-04 00:00:00', 		'2018-01-24 23:59:59', 		0, 		'user_1', 		'2018/01/16 10:17:47', 		'user_1', 		'2018/01/16 10:17:47' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 10:17:57 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ insert into 	m_image( 		image_id, 		client_id, 		image_name, 		orig_file_dir, 		file_name, 		orig_file_name, 		orig_file_exte, 		orig_file_size, 		orig_hash, 		width, 		height, 		sta_dt, 		end_dt, 		property_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		NULL, 		1, 		'テロップ', 		NULL, 		NULL, 		'620_300', 		'.png', 		NULL, 		NULL, 		:width, 		:height, 		'2018-01-04 00:00:00', 		'2018-01-24 23:59:59', 		0, 		'user_1', 		'2018/01/16 10:17:57', 		'user_1', 		'2018/01/16 10:17:57' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 10:23:50 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ insert into 	m_image( 		image_id, 		client_id, 		image_name, 		orig_file_dir, 		file_name, 		orig_file_name, 		orig_file_exte, 		orig_file_size, 		orig_hash, 		width, 		height, 		sta_dt, 		end_dt, 		property_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		47, 		1, 		'テロップ', 		'0000000001/image/0000000000/', 		'0000000047', 		'620_300', 		'.png', 		20158, 		'ae883c1592c491ad2f1e29805cacb40b7d54bc822e63221e9cd830a57344a818', 		:width, 		:height, 		'2018-01-03 00:00:00', 		'2018-01-25 23:59:59', 		0, 		'user_1', 		'2018/01/16 10:23:50', 		'user_1', 		'2018/01/16 10:23:50' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:10:43 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')' ~ MODPATH/movie/classes/controller/movie.php [ 527 ]
2018-01-16 14:10:43 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')' ~ MODPATH/movie/classes/controller/movie.php [ 527 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 14:17:13 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-05 00:00 00:00:00"
LINE 1: ...age_name = '動画テスト0116_12テロップ',  sta_dt = '2018-01-0...
                                                             ^ [ update 	m_image set 	image_name = '動画テスト0116_12テロップ', 	sta_dt = '2018-01-05 00:00 00:00:00', 	end_dt = '2018-01-25 23:59 23:59:59', 	property_id = NULL, 	update_user = 'user_1', 	update_dt = '2018/01/16 14:17:13' where 	image_id = '61' and 	client_id = '2' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:18:52 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-05 00:00 00:00:00"
LINE 1: ...age_name = '動画テスト0116_12テロップ',  sta_dt = '2018-01-0...
                                                             ^ [ update 	m_image set 	image_name = '動画テスト0116_12テロップ', 	sta_dt = '2018-01-05 00:00 00:00:00', 	end_dt = '2018-01-25 23:59 23:59:59', 	property_id = NULL, 	update_user = 'user_1', 	update_dt = '2018/01/16 14:18:52' where 	image_id = '61' and 	client_id = '2' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:18:52 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-05 00:00 00:00:00"
LINE 1: ...',  play_time = NULL,  rotate_flag = 0,  sta_dt = '2018-01-0...
                                                             ^ [ update 	m_movie set 	movie_name = '動画テスト0116_12', 	play_time = NULL, 	rotate_flag = 0, 	sta_dt = '2018-01-05 00:00 00:00:00', 	end_dt = '2018-01-25 23:59 23:59:59', 	property_id = NULL, 	update_user = 'user_1', 	update_dt = '2018/01/16 14:18:52' where 	movie_id = '33' and 	client_id = '2' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:23:10 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-05 00:00 00:00:00"
LINE 1: ...age_name = '動画テスト0116_12テロップ',  sta_dt = '2018-01-0...
                                                             ^ [ update 	m_image set 	image_name = '動画テスト0116_12テロップ', 	sta_dt = '2018-01-05 00:00 00:00:00', 	end_dt = '2018-01-25 23:59 23:59:59', 	property_id = NULL, 	update_user = 'user_1', 	update_dt = '2018/01/16 14:23:10' where 	image_id = '61' and 	client_id = '2' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:23:10 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "ad_flg" of relation "m_movie" does not exist
LINE 1: ...ie_name = '動画テスト0116_12',  client_id = '2',  ad_flg = N...
                                                             ^ [ update 	m_movie set 	movie_name = '動画テスト0116_12', 	client_id = '2', 	ad_flg = NULL, 	play_time = NULL, 	rotate_flag = 0, 	sta_dt = '2018-01-05 00:00 00:00:00', 	end_dt = '2018-01-25 23:59 23:59:59', 	property_id = NULL, 	update_user = 'user_1', 	update_dt = '2018/01/16 14:23:10' where 	movie_id = '33' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:25:23 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-05 00:00 00:00:00"
LINE 1: ...age_name = '動画テスト0116_12テロップ',  sta_dt = '2018-01-0...
                                                             ^ [ update 	m_image set 	image_name = '動画テスト0116_12テロップ', 	sta_dt = '2018-01-05 00:00 00:00:00', 	end_dt = '2018-01-25 23:59 23:59:59', 	property_id = NULL, 	update_user = 'user_1', 	update_dt = '2018/01/16 14:25:23' where 	image_id = '61' and 	client_id = '2' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:25:23 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-01-05 00:00 00:00:00"
LINE 1: ...',  play_time = NULL,  rotate_flag = 0,  sta_dt = '2018-01-0...
                                                             ^ [ update 	m_movie set 	movie_name = '動画テスト0116_12', 	client_id = '2', 	ad_flag = '1', 	play_time = NULL, 	rotate_flag = 0, 	sta_dt = '2018-01-05 00:00 00:00:00', 	end_dt = '2018-01-25 23:59 23:59:59', 	property_id = NULL, 	update_user = 'user_1', 	update_dt = '2018/01/16 14:25:23' where 	movie_id = '33' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 14:57:43 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._user,  update_dt from  m_image where  image_id = '' and  de...
                                                             ^ [ select 	image_id, 	client_id, 	image_name, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	enc_file_exte, 	enc_file_size, 	enc_hash, 	orig_file_name, 	orig_file_exte, 	orig_hash, 	sta_dt, 	end_dt, 	property_id, 	width, 	height, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_image where 	image_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 15:06:16 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._user,  update_dt from  m_image where  image_id = '' and  de...
                                                             ^ [ select 	image_id, 	client_id, 	image_name, 	active_file_dir, 	enc_file_dir, 	orig_file_dir, 	file_name, 	enc_file_exte, 	enc_file_size, 	enc_hash, 	orig_file_name, 	orig_file_exte, 	orig_hash, 	sta_dt, 	end_dt, 	property_id, 	width, 	height, 	del_flag, 	create_user, 	create_dt, 	update_user, 	update_dt from 	m_image where 	image_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 15:58:04 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_image_name() ~ MODPATH/movie/classes/controller/movie.php [ 780 ]
2018-01-16 15:58:04 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_image_name() ~ MODPATH/movie/classes/controller/movie.php [ 780 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 15:59:42 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_image_name() ~ MODPATH/movie/classes/controller/movie.php [ 780 ]
2018-01-16 15:59:42 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Movie::sel_image_name() ~ MODPATH/movie/classes/controller/movie.php [ 780 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 16:24:29 --- ERROR: ErrorException [ 1 ]: Call to a member function sel_image() on a non-object ~ MODPATH/movie/classes/controller/movie.php [ 845 ]
2018-01-16 16:24:29 --- STRACE: ErrorException [ 1 ]: Call to a member function sel_image() on a non-object ~ MODPATH/movie/classes/controller/movie.php [ 845 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 16:34:12 --- ERROR: ErrorException [ 1 ]: Call to a member function del_image() on a non-object ~ MODPATH/movie/classes/controller/movie.php [ 855 ]
2018-01-16 16:34:12 --- STRACE: ErrorException [ 1 ]: Call to a member function del_image() on a non-object ~ MODPATH/movie/classes/controller/movie.php [ 855 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 17:01:07 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL $post["movie_orig_file_name"] was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-01-16 17:01:07 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL $post["movie_orig_file_name"] was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2018-01-16 17:03:26 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL $post["movie_orig_file_name"] was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-01-16 17:03:26 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL $post["movie_orig_file_name"] was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2018-01-16 18:50:43 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'timezone' at 'MODPATH/timezone' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2018-01-16 18:50:43 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'timezone' at 'MODPATH/timezone' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2018-01-16 19:56:09 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
2018-01-16 19:56:09 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 19:56:19 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
2018-01-16 19:56:19 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 19:57:48 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
2018-01-16 19:57:48 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 19:57:55 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
2018-01-16 19:57:55 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING, expecting '(' ~ APPPATH/classes/controller/template.php [ 1009 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 19:58:30 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/timezone/classes/model/timezone.php [ 92 ]
2018-01-16 19:58:30 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/timezone/classes/model/timezone.php [ 92 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 20:01:21 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/timezone/classes/model/timezone.php [ 94 ]
2018-01-16 20:01:21 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/timezone/classes/model/timezone.php [ 94 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-16 20:10:47 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_timezone.sta_time does not exist
LINE 1: ...timezone.timezone_id,  m_timezone.timezone_name,  m_timezone...
                                                             ^ [ select 	m_timezone.timezone_id, 	m_timezone.timezone_name, 	m_timezone.sta_time, 	m_timezone.end_time from 	m_timezone where 	m_timezone.del_flag = 0 order by 	m_timezone.timezone_name, 	m_timezone.timezone_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 20:10:47 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_timezone.sta_time does not exist
LINE 1: ...timezone.timezone_id,  m_timezone.timezone_name,  m_timezone...
                                                             ^ [ select 	m_timezone.timezone_id, 	m_timezone.timezone_name, 	m_timezone.sta_time, 	m_timezone.end_time from 	m_timezone where 	m_timezone.del_flag = 0 order by 	m_timezone.timezone_name, 	m_timezone.timezone_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_timez...', true, Array)
#1 /var/www/html/simplesig/modules/timezone/classes/model/timezone.php(78): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(27): Model_Timezone->sel_arr_timezone()
#3 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(15): Controller_Timezone->disp_up()
#4 [internal function]: Controller_Timezone->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Timezone))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-16 20:10:53 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_timezone.sta_time does not exist
LINE 1: ...timezone.timezone_id,  m_timezone.timezone_name,  m_timezone...
                                                             ^ [ select 	m_timezone.timezone_id, 	m_timezone.timezone_name, 	m_timezone.sta_time, 	m_timezone.end_time from 	m_timezone where 	m_timezone.del_flag = 0 order by 	m_timezone.timezone_name, 	m_timezone.timezone_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 20:10:53 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_timezone.sta_time does not exist
LINE 1: ...timezone.timezone_id,  m_timezone.timezone_name,  m_timezone...
                                                             ^ [ select 	m_timezone.timezone_id, 	m_timezone.timezone_name, 	m_timezone.sta_time, 	m_timezone.end_time from 	m_timezone where 	m_timezone.del_flag = 0 order by 	m_timezone.timezone_name, 	m_timezone.timezone_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_timez...', true, Array)
#1 /var/www/html/simplesig/modules/timezone/classes/model/timezone.php(78): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(27): Model_Timezone->sel_arr_timezone()
#3 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(15): Controller_Timezone->disp_up()
#4 [internal function]: Controller_Timezone->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Timezone))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-16 20:15:25 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_timezone.sta_time does not exist
LINE 1: ...timezone.timezone_id,  m_timezone.timezone_name,  m_timezone...
                                                             ^ [ select 	m_timezone.timezone_id, 	m_timezone.timezone_name, 	m_timezone.sta_time, 	m_timezone.end_time from 	m_timezone where 	m_timezone.del_flag = 0 order by 	m_timezone.timezone_name, 	m_timezone.timezone_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-16 20:15:25 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_timezone.sta_time does not exist
LINE 1: ...timezone.timezone_id,  m_timezone.timezone_name,  m_timezone...
                                                             ^ [ select 	m_timezone.timezone_id, 	m_timezone.timezone_name, 	m_timezone.sta_time, 	m_timezone.end_time from 	m_timezone where 	m_timezone.del_flag = 0 order by 	m_timezone.timezone_name, 	m_timezone.timezone_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_timez...', true, Array)
#1 /var/www/html/simplesig/modules/timezone/classes/model/timezone.php(78): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(27): Model_Timezone->sel_arr_timezone()
#3 /var/www/html/simplesig/modules/timezone/classes/controller/timezone.php(15): Controller_Timezone->disp_up()
#4 [internal function]: Controller_Timezone->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Timezone))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}