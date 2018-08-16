<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-23 17:02:14 --- ERROR: PDOException [ 0 ]: There is no active transaction ~ MODPATH/database/classes/kohana/database/pdo.php [ 230 ]
2018-02-23 17:16:27 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 17:16:27 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1012): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1159): Model_Playlist->sel_playlist('')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-23 17:19:37 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 17:19:37 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1012): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1159): Model_Playlist->sel_playlist('')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-02-23 17:48:13 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...and  playlist_id = 50 and  playlist_id = 999 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id from 	t_playlist_movie_rela where  playlist_id = 1 and  playlist_id = 2 and  playlist_id = 28 and  playlist_id = 50 and  playlist_id = 999 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 17:48:13 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...and  playlist_id = 50 and  playlist_id = 999 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id from 	t_playlist_movie_rela where  playlist_id = 1 and  playlist_id = 2 and  playlist_id = 28 and  playlist_id = 50 and  playlist_id = 999 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2737): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(892): Model_Playlist->sel_arr_debug(1, 2, 28, 50, 999)
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-23 17:50:07 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...and  playlist_id = 50 and  playlist_id = 999 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id from 	t_playlist_movie_rela where  playlist_id = 1 and  playlist_id = 2 and  playlist_id = 28 and  playlist_id = 50 and  playlist_id = 999 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 17:50:07 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...and  playlist_id = 50 and  playlist_id = 999 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id from 	t_playlist_movie_rela where  playlist_id = 1 and  playlist_id = 2 and  playlist_id = 28 and  playlist_id = 50 and  playlist_id = 999 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2737): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(892): Model_Playlist->sel_arr_debug(1, 2, 28, 50, 999)
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(758): Controller_Playlist->ins_playlist_rera(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(310): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-23 18:50:15 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
2018-02-23 18:50:15 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-23 18:51:29 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
2018-02-23 18:51:29 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-23 18:52:14 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
2018-02-23 18:52:14 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-23 18:52:32 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
2018-02-23 18:52:32 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '[' ~ MODPATH/playlist/classes/controller/playlist.php [ 947 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-23 18:54:19 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_OBJECT_OPERATOR ~ MODPATH/playlist/classes/controller/playlist.php [ 955 ]
2018-02-23 18:54:19 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_OBJECT_OPERATOR ~ MODPATH/playlist/classes/controller/playlist.php [ 955 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-23 19:45:43 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "playlist_rela_id" violates not-null constraint [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		NULL, 		50, 		154, 		'1', 		1, 		2, 		1, 		'2018-02-01 00:00:00', 		'2018-02-28 00:00:00', 		'user_1', 		'2018/02/23 19:45:43', 		'user_1', 		'2018/02/23 19:45:43' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:45:43 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		NULL, 		3, 		154, 		'1', 		0, 		3, 		1, 		'2018-02-01 00:00:00', 		'2018-02-28 00:00:00', 		'user_1', 		'2018/02/23 19:45:43', 		'user_1', 		'2018/02/23 19:45:43' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:45:43 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		NULL, 		15, 		154, 		'1', 		0, 		2, 		1, 		'2018-02-01 00:00:00', 		'2018-02-28 00:00:00', 		'user_1', 		'2018/02/23 19:45:43', 		'user_1', 		'2018/02/23 19:45:43' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:54:05 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...  ) values (   129,   NULL,   NULL,   '1',   0,   '',   NULL...
                                                             ^ [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		129, 		NULL, 		NULL, 		'1', 		0, 		'', 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 19:54:04', 		'user_1', 		'2018/02/23 19:54:04' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:54:05 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		130, 		NULL, 		NULL, 		'1', 		0, 		4, 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 19:54:04', 		'user_1', 		'2018/02/23 19:54:04' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:54:05 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		131, 		NULL, 		NULL, 		'1', 		0, 		2, 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 19:54:04', 		'user_1', 		'2018/02/23 19:54:04' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:56:58 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...t  ) values (   132,   NULL,   156,   '1',   0,   '',   NULL...
                                                             ^ [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		132, 		NULL, 		156, 		'1', 		0, 		'', 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 19:56:58', 		'user_1', 		'2018/02/23 19:56:58' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:56:58 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		133, 		NULL, 		156, 		'1', 		0, 		4, 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 19:56:58', 		'user_1', 		'2018/02/23 19:56:58' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 19:56:58 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		134, 		NULL, 		156, 		'1', 		0, 		2, 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 19:56:58', 		'user_1', 		'2018/02/23 19:56:58' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 20:06:47 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...t  ) values (   135,   NULL,   157,   '1',   0,   '',   NULL...
                                                             ^ [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		135, 		NULL, 		157, 		'1', 		0, 		'', 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 20:06:47', 		'user_1', 		'2018/02/23 20:06:47' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 20:06:47 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		136, 		NULL, 		157, 		'1', 		0, 		4, 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 20:06:47', 		'user_1', 		'2018/02/23 20:06:47' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 20:06:47 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		137, 		NULL, 		157, 		'1', 		0, 		3, 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 20:06:47', 		'user_1', 		'2018/02/23 20:06:47' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 20:06:47 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_rela( 		playlist_rela_id, 		common_playlist_id, 		playlist_id, 		client_id, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		138, 		NULL, 		157, 		'1', 		0, 		2, 		NULL, 		NULL, 		NULL, 		'user_1', 		'2018/02/23 20:06:47', 		'user_1', 		'2018/02/23 20:06:47' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-23 20:17:13 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')' ~ MODPATH/playlist/classes/controller/playlist.php [ 871 ]
2018-02-23 20:17:13 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')' ~ MODPATH/playlist/classes/controller/playlist.php [ 871 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-23 20:17:14 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')' ~ MODPATH/playlist/classes/controller/playlist.php [ 871 ]
2018-02-23 20:17:14 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')' ~ MODPATH/playlist/classes/controller/playlist.php [ 871 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}