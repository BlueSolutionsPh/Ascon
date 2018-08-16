<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-01 10:01:49 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-01 10:01:49 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_movie...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1017): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(444): Model_Playlist->sel_arr_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-01 10:07:36 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-01 10:07:36 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_movie...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1017): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(445): Model_Playlist->sel_arr_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-01 10:24:10 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-01 10:24:10 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_movie...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1017): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(445): Model_Playlist->sel_arr_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-01 10:24:38 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-01 10:24:38 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000003" requires 2 [ select 	m_movie.movie_id, 	m_movie.image_id, 	m_movie.movie_name, 	m_movie.ad_flag, 	m_movie.play_time, 	m_movie.rotate_flag, 	m_movie.ad_flag, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.movie_enc_file_size, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	m_movie.sound_enc_file_size, 	m_movie.sta_dt, 	m_movie.end_dt, 	m_movie.property_id, 	m_movie.update_user, 	m_client.client_id, 	m_client.client_name from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 order by 	m_client.client_name, 	convert_to(m_movie.movie_name,'UTF8'), 	m_movie.movie_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_movie...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1017): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(445): Model_Playlist->sel_arr_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-01 14:15:58 --- ERROR: ErrorException [ 1 ]: Call to a member function check() on a non-object ~ MODPATH/playlist/classes/controller/playlist.php [ 522 ]
2018-02-01 14:15:58 --- STRACE: ErrorException [ 1 ]: Call to a member function check() on a non-object ~ MODPATH/playlist/classes/controller/playlist.php [ 522 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 14:43:07 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "sex_id" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		client_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		ants_version, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		27, 		5, 		1, 		'プレイリストテスト0131', 		NULL, 		0, 		0, 		2, 		NULL, 		NULL, 		'0', 		'2018-01-01', 		'2018-02-28', 		'user_1', 		'2018/02/01 14:43:07', 		'user_1', 		'2018/02/01 14:43:07' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-01 15:08:44 --- ERROR: ErrorException [ 1 ]: Maximum execution time of 30 seconds exceeded ~ MODPATH/playlist/classes/controller/playlist.php [ 572 ]
2018-02-01 15:08:44 --- STRACE: ErrorException [ 1 ]: Maximum execution time of 30 seconds exceeded ~ MODPATH/playlist/classes/controller/playlist.php [ 572 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 15:10:50 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "timezone_id" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		client_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		ants_version, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		29, 		5, 		1, 		'プレイリストテスト0131', 		NULL, 		0, 		0, 		2, 		NULL, 		NULL, 		'1', 		'2018-02-01', 		'2018-02-28', 		'user_1', 		'2018/02/01 15:10:50', 		'user_1', 		'2018/02/01 15:10:50' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-01 16:14:06 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
2018-02-01 16:14:06 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(427): Kohana_View->__get('arr_movie')
#1 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#2 [internal function]: Controller_Playlist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-02-01 18:35:18 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
2018-02-01 18:35:18 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 18:38:05 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
2018-02-01 18:38:05 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 18:38:25 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
2018-02-01 18:38:25 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 18:38:36 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
2018-02-01 18:38:36 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 18:38:37 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
2018-02-01 18:38:37 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE, expecting ']' ~ MODPATH/playlist/classes/controller/playlist.php [ 419 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 19:35:17 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_movie_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 572 ]
2018-02-01 19:35:17 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_movie_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 572 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 19:44:21 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_movie_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 582 ]
2018-02-01 19:44:21 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_movie_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 582 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 20:04:00 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting T_STRING or T_VARIABLE or '{' or '$' ~ MODPATH/playlist/classes/controller/playlist.php [ 430 ]
2018-02-01 20:04:00 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting T_STRING or T_VARIABLE or '{' or '$' ~ MODPATH/playlist/classes/controller/playlist.php [ 430 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-01 20:04:34 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
2018-02-01 20:04:34 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(430): Kohana_View->__get('arr_movie')
#1 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#2 [internal function]: Controller_Playlist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-02-01 20:05:20 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
2018-02-01 20:05:20 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(430): Kohana_View->__get('arr_movie')
#1 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#2 [internal function]: Controller_Playlist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-02-01 20:06:37 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
2018-02-01 20:06:37 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(430): Kohana_View->__get('arr_movie')
#1 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#2 [internal function]: Controller_Playlist->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}