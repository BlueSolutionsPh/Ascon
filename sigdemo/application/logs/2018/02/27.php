<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-27 10:12:24 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:12:24 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:12:24 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:12:24 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:12:24 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:12:24 --- ERROR: Database_Exception [ 22007 ]: SQLSTATE[22007]: Invalid datetime format: 7 ERROR:  invalid input syntax for type timestamp: "2018-02-28 00:00:00 23:59:59"
LINE 1: ...t,  end_dt from  t_playlist_rela where  sta_dt  ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:18:50 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:18:50 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3232): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1274): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1180): Controller_Playlist->up_seltmpl()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 10:26:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...d  client_id = '2' and  playlist_id  '189' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	playlist_id  '189' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 10:26:40 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...d  client_id = '2' and  playlist_id  '189' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	playlist_id  '189' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3232): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1274): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1180): Controller_Playlist->up_seltmpl()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 14:53:16 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 14:53:16 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3232): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(275): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(213): Controller_Playlist->ins_seltmpl()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 15:02:45 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 15:02:45 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3232): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(275): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(213): Controller_Playlist->ins_seltmpl()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 15:26:14 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "prog_name" violates not-null constraint [ insert into 	t_prog_rgl_grp( 		prog_rgl_grp_id, 		dev_id, 		client_id, 		prog_name, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		226, 		21, 		'2', 		NULL, 		'user_1', 		'2018/02/27 15:26:13', 		'user_1', 		'2018/02/27 15:26:13' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 17:37:56 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...playlist_movie_rela where  playlist_id = 193 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 193 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 17:37:56 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...playlist_movie_rela where  playlist_id = 193 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 193 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2481): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(697): Model_Playlist->sel_arr_id_name_playlist_movie_rela2(Object(Db_Ins))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 17:40:25 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...playlist_movie_rela where  playlist_id = 194 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 194 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 17:40:25 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...playlist_movie_rela where  playlist_id = 194 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 194 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2481): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(698): Model_Playlist->sel_arr_id_name_playlist_movie_rela2(Object(Db_Ins))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(678): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 17:50:42 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '3' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '3' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 17:50:42 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '3' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '3' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2659): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(275): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(213): Controller_Playlist->ins_seltmpl()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 17:52:19 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '1' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '1' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 17:52:19 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '1' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '1' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2659): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(275): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(213): Controller_Playlist->ins_seltmpl()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 17:57:05 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 17:57:05 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ... deliverymonth_id = '1' and  client_id = '2' and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	sex_id = 0 and 	timezone_id = 3 and 	deliverymonth_id = '1' and 	client_id = '2' and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2659): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(275): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(213): Controller_Playlist->ins_seltmpl()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 17:57:56 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_playlist_neco() ~ MODPATH/playlist/classes/controller/playlist.php [ 746 ]
2018-02-27 17:57:56 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_playlist_neco() ~ MODPATH/playlist/classes/controller/playlist.php [ 746 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-27 18:17:24 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...t > '2018-02-01 00:00:00' or end_dt is null) and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:17:24 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...t > '2018-02-01 00:00:00' or end_dt is null) and  del__flag ...
                                                             ^ [ select 	playlist_rela_id, 	common_playlist_id, 	playlist_id, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt from 	t_playlist_rela where 	sta_dt  '2018-02-01 00:00:00' or end_dt is null) and 	del__flag = 0 order by 	playlist_rela_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2659): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(742): Model_Playlist->sel_arr_playlist_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 18:23:15 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/27 18:23:15' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/27 18:23:15' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/27 18:23:15' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:23:15 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/27 18:23:15' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/27 18:23:15' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/27 18:23:15' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2985): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(742): Model_Playlist->sel_arr_playlist_neco(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 18:29:25 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_playlist_movie_rela2() ~ MODPATH/playlist/classes/controller/playlist.php [ 856 ]
2018-02-27 18:29:25 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_playlist_movie_rela2() ~ MODPATH/playlist/classes/controller/playlist.php [ 856 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-27 18:30:00 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "update___dt" of relation "t_playlist_movie_rela" does not exist
LINE 1: ...der,   create_user,   create_dt,   update_user,   update___d...
                                                             ^ [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update___dt 	) values ( 		208,		0,		31,		10,		'1',		0,		'user_1',		'2018/02/27 18:30:00',		'user_1',		'2018/02/27 18:30:00'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:30:00 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "update___dt" of relation "t_playlist_movie_rela" does not exist
LINE 1: ...der,   create_user,   create_dt,   update_user,   update___d...
                                                             ^ [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update___dt 	) values ( 		208,		0,		31,		10,		'1',		0,		'user_1',		'2018/02/27 18:30:00',		'user_1',		'2018/02/27 18:30:00'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(2, 'insert into ?t_...', false, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3039): Kohana_Database_Query->execute(Object(Database_PDO))
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(856): Model_Playlist->ins_playlist_movie_rela2(Object(Db_Ins))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 18:36:57 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "update___dt" of relation "t_playlist_movie_rela" does not exist
LINE 1: ...der,   create_user,   create_dt,   update_user,   update___d...
                                                             ^ [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update___dt 	) values ( 		209,		0,		31,		10,		'1',		0,		'user_1',		'2018/02/27 18:36:57',		'user_1',		'2018/02/27 18:36:57'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:36:57 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "update___dt" of relation "t_playlist_movie_rela" does not exist
LINE 1: ...der,   create_user,   create_dt,   update_user,   update___d...
                                                             ^ [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update___dt 	) values ( 		209,		0,		31,		10,		'1',		0,		'user_1',		'2018/02/27 18:36:57',		'user_1',		'2018/02/27 18:36:57'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(2, 'insert into ?t_...', false, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3039): Kohana_Database_Query->execute(Object(Database_PDO))
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(856): Model_Playlist->ins_playlist_movie_rela2(Object(Db_Ins))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 18:43:33 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/27 18:43:33' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/27 18:43:33' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/27 18:43:33' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:43:33 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist.del__flag does not exist
LINE 1: ..._flag = 0 where  t_playlist.timezone_id  1 and  t_playlist...
                                                             ^ [ select 	t_playlist.playlist_id, 	t_playlist.draw_tmpl_id, 	t_playlist.playlist_name, 	t_playlist.ants_version, 	t_playlist.sex_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, 	m_draw_tmpl.draw_tmpl_name, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				exists ( 					select 						t_prog_inner.prog_id 					from 						t_prog t_prog_inner 					where 						t_prog_outer.prog_id = t_prog_inner.prog_id and 						t_prog_outer.dev_id = t_prog_inner.dev_id and 						t_prog_inner.sta_dt  '2018/02/27 18:43:33' or t_prog_inner.end_dt is null) and 						t_prog_inner.del_flag = 0 				) and 				(t_prog_outer.end_dt > '2018/02/27 18:43:33' or t_prog_outer.end_dt is null) and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_now, 	( 		select 			count(tmp_t_prog.prog_id) 		from 			( 			select 				max(t_prog_outer.prog_id) prog_id, 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			from 				t_prog t_prog_outer 			where 				t_prog_outer.sta_dt > '2018/02/27 18:43:33' and 				t_prog_outer.del_flag = 0 			group by 				t_prog_outer.sta_dt, 				t_prog_outer.end_dt, 				t_prog_outer.dev_id 			) tmp_t_prog		join 			t_prog_playlist_rela 		on 			tmp_t_prog.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 	) as prog_cnt_future, 	( 		select 			count(t_prog_rgl.prog_id) 		from 			t_prog_rgl_grp 		join 			t_prog_rgl 		on 			t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 			t_prog_rgl.del_flag = 0 		join 			t_prog_playlist_rela 		on 			t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 			t_playlist.playlist_id = t_prog_playlist_rela.playlist_id and 			t_prog_playlist_rela.del_flag = 0 		where 			t_prog_rgl_grp.del_flag = 0 	) as prog_cnt_rgl, 	m_timezone.timezone_id, 	m_timezone.timezone_name from 	t_playlist join 	m_draw_tmpl on 	t_playlist.draw_tmpl_id = m_draw_tmpl.draw_tmpl_id and 	m_draw_tmpl.del_flag = 0 join 	m_timezone on 	t_playlist.timezone_id = m_timezone.timezone_id and 	m_timezone.del_flag = 0 where 	t_playlist.timezone_id  1 and 	t_playlist.del__flag = 0 order by 	convert_to(t_playlist.playlist_name,'UTF8'), 	t_playlist.playlist_id desc limit 100 offset NULL ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2985): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(742): Model_Playlist->sel_arr_playlist_neco(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 18:45:17 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...playlist_movie_rela where  playlist_id = 200 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 200 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:45:17 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "del__flag" does not exist
LINE 1: ...playlist_movie_rela where  playlist_id = 200 and  del__flag ...
                                                             ^ [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = 200 and 	del__flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2460): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(767): Model_Playlist->sel_arr_id_name_playlist_movie_rela2(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 18:46:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "update___dt" of relation "t_playlist_movie_rela" does not exist
LINE 1: ...der,   create_user,   create_dt,   update_user,   update___d...
                                                             ^ [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update___dt 	) values ( 		200,		211,		31,		10,		'1',		0,		'user_1',		'2018/02/27 18:46:51',		'user_1',		'2018/02/27 18:46:51'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:46:51 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "update___dt" of relation "t_playlist_movie_rela" does not exist
LINE 1: ...der,   create_user,   create_dt,   update_user,   update___d...
                                                             ^ [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update___dt 	) values ( 		200,		211,		31,		10,		'1',		0,		'user_1',		'2018/02/27 18:46:51',		'user_1',		'2018/02/27 18:46:51'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(2, 'insert into ?t_...', false, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(3018): Kohana_Database_Query->execute(Object(Database_PDO))
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(844): Model_Playlist->ins_playlist_movie_rela2(Object(Db_Ins))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(677): Controller_Playlist->ins_playlist_rela(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(348): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 18:58:49 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "create_user" violates not-null constraint [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		'213',		NULL,		'32',		10,		'1',		2,		NULL,		NULL,		'user_1',		'2018/02/27 18:58:49'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:58:49 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '213' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '213' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 18:58:49 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	t_prog.dev_id from 	t_prog join 	t_prog_playlist_rela on 	t_prog_playlist_rela.playlist_id = '213' and 	t_prog_playlist_rela.prog_id = t_prog.prog_id and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog.del_flag = 0 union select 	t_prog_rgl_grp.dev_id from 	t_prog_rgl_grp join 	t_prog_rgl on 	t_prog_rgl_grp.prog_rgl_grp_id = t_prog_rgl.prog_rgl_grp_id and 	t_prog_rgl.del_flag = 0 join 	t_prog_playlist_rela on 	t_prog_rgl.prog_id = t_prog_playlist_rela.prog_id and 	t_prog_playlist_rela.playlist_id = '213' and 	t_prog_playlist_rela.del_flag = 0 where 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog....', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1718): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1582): Model_Playlist->sel_arr_dev_by_playlist_id('213')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1166): Controller_Playlist->up()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 19:02:24 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "create_user" violates not-null constraint [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		'213',		NULL,		'32',		10,		'1',		2,		NULL,		NULL,		'user_1',		'2018/02/27 19:02:23'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:02:24 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = '213' and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:02:24 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = '213' and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2427): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1615): Model_Playlist->sel_arr_id_name_playlist_movie_rela(Object(Db_Up))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1584): Controller_Playlist->up_playlist_rela(Object(Db_Up))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1166): Controller_Playlist->up()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 19:05:08 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "create_user" violates not-null constraint [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		'213',		NULL,		'32',		10,		'1',		2,		NULL,		NULL,		'user_1',		'2018/02/27 19:05:08'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:05:08 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = '213' and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:05:08 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = '213' and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2427): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1615): Model_Playlist->sel_arr_id_name_playlist_movie_rela(Object(Db_Up))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1584): Controller_Playlist->up_playlist_rela(Object(Db_Up))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1166): Controller_Playlist->up()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 19:07:53 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "create_user" violates not-null constraint [ insert into 	t_playlist_movie_rela( 		playlist_id, 		playlist_rela_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		'213',		NULL,		'32',		10,		'1',		2,		NULL,		NULL,		'user_1',		'2018/02/27 19:07:53'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:07:53 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = '213' and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:07:53 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	playlist_movie_rela_id, 	playlist_id, 	movie_id, 	draw_area_id, 	client_id, 	display_order from 	t_playlist_movie_rela where  playlist_id = '213' and 	del_flag = 0 order by 	playlist_id, 	display_order desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2427): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1615): Model_Playlist->sel_arr_id_name_playlist_movie_rela(Object(Db_Up))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1584): Controller_Playlist->up_playlist_rela(Object(Db_Up))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(1166): Controller_Playlist->up()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(45): Controller_Playlist->disp_up()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-27 19:27:05 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_movie_rela.del__flag does not exist
LINE 1: ...d  t_playlist_movie_rela.playlist_id = '200' and  t_playlist...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del__flag = 0 where 	t_playlist_movie_rela.playlist_rela_id = NULL and 	(m_common_movie.sta_dt = '2018-02-01 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:27:05 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_movie_rela.del__flag does not exist
LINE 1: ...d  t_playlist_movie_rela.playlist_id = '200' and  t_playlist...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del__flag = 0 where 	t_playlist_movie_rela.playlist_rela_id = NULL and 	(m_common_movie.sta_dt = '2018-02-01 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(1196): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(811): Model_Commonplaylist->sel_arr_movie_by_playlist_id_draw_area_id_dt('200', 10, '2018-02-01 00:0...', '2018-03-31 23:5...')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(622): Controller_Commonplaylist->disp_up()
#4 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(40): Controller_Commonplaylist->disp_up_seltmpl()
#5 [internal function]: Controller_Commonplaylist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 19:28:21 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_movie_rela.del__flag does not exist
LINE 1: ...d  t_playlist_movie_rela.playlist_id = '200' and  t_playlist...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del_flag = 0 where 	t_playlist_movie_rela.playlist_rela_id = NULL and 	(m_movie.sta_dt = '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del__flag = 0 where 	t_playlist_movie_rela.playlist_rela_id = NULL and 	(m_common_movie.sta_dt = '2018-02-01 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:28:21 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_movie_rela.del__flag does not exist
LINE 1: ...d  t_playlist_movie_rela.playlist_id = '200' and  t_playlist...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del_flag = 0 where 	t_playlist_movie_rela.playlist_rela_id = NULL and 	(m_movie.sta_dt = '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del__flag = 0 where 	t_playlist_movie_rela.playlist_rela_id = NULL and 	(m_common_movie.sta_dt = '2018-02-01 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(1198): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(811): Model_Commonplaylist->sel_arr_movie_by_playlist_id_draw_area_id_dt('200', 10, '2018-02-01 00:0...', '2018-03-31 23:5...')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(622): Controller_Commonplaylist->disp_up()
#4 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(40): Controller_Commonplaylist->disp_up_seltmpl()
#5 [internal function]: Controller_Commonplaylist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-02-27 19:32:14 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_movie_rela.del__flag does not exist
LINE 1: ...d  t_playlist_movie_rela.playlist_id = '200' and  t_playlist...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del_flag = 0 where 	t_playlist_movie_rela.playlist_rela_id is NULL and 	(m_movie.sta_dt = '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del__flag = 0 where 	t_playlist_movie_rela.playlist_rela_id is NULL and 	(m_common_movie.sta_dt = '2018-02-01 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-27 19:32:14 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_playlist_movie_rela.del__flag does not exist
LINE 1: ...d  t_playlist_movie_rela.playlist_id = '200' and  t_playlist...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del_flag = 0 where 	t_playlist_movie_rela.playlist_rela_id is NULL and 	(m_movie.sta_dt = '2018-02-01 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = '200' and 	t_playlist_movie_rela.del__flag = 0 where 	t_playlist_movie_rela.playlist_rela_id is NULL and 	(m_common_movie.sta_dt = '2018-02-01 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/commonplaylist/classes/model/commonplaylist.php(1198): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(811): Model_Commonplaylist->sel_arr_movie_by_playlist_id_draw_area_id_dt('200', 10, '2018-02-01 00:0...', '2018-03-31 23:5...')
#3 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(622): Controller_Commonplaylist->disp_up()
#4 /var/www/html/simplesig/modules/commonplaylist/classes/controller/commonplaylist.php(40): Controller_Commonplaylist->disp_up_seltmpl()
#5 [internal function]: Controller_Commonplaylist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}