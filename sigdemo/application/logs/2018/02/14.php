<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-02-14 10:25:02 --- ERROR: ErrorException [ 1 ]: Call to undefined function ins_prog() ~ MODPATH/playlist/classes/controller/playlist.php [ 810 ]
2018-02-14 10:25:02 --- STRACE: ErrorException [ 1 ]: Call to undefined function ins_prog() ~ MODPATH/playlist/classes/controller/playlist.php [ 810 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-14 10:26:59 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::del_prog_rgl_grp() ~ MODPATH/playlist/classes/controller/playlist.php [ 838 ]
2018-02-14 10:26:59 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::del_prog_rgl_grp() ~ MODPATH/playlist/classes/controller/playlist.php [ 838 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-14 10:29:28 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_prog_rgl_by_prog_rgl_grp_id() ~ MODPATH/playlist/classes/model/playlist.php [ 2258 ]
2018-02-14 10:29:28 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_prog_rgl_by_prog_rgl_grp_id() ~ MODPATH/playlist/classes/model/playlist.php [ 2258 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-14 17:03:15 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_dev_" does not exist
LINE 1: ...  m_client.client_id,  m_client.client_name from  m_dev_ joi...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.dev_name, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name from 	m_dev_ join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = '1' and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_dev.client_id = '1' and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 17:03:15 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_dev_" does not exist
LINE 1: ...  m_client.client_id,  m_client.client_name from  m_dev_ joi...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.dev_name, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name from 	m_dev_ join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = '1' and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_dev.client_id = '1' and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2118): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(832): Model_Playlist->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(811): Controller_Playlist->ins_prog(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(320): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-14 17:05:15 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl_grp.dev__id does not exist
LINE 1: ...l_grp.prog_rgl_grp_id from  t_prog_rgl_grp where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl_grp.prog_rgl_grp_id from 	t_prog_rgl_grp where 	t_prog_rgl_grp.dev__id = 1 and 	t_prog_rgl_grp.client_id = '1' and 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 17:05:15 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl_grp.dev__id does not exist
LINE 1: ...l_grp.prog_rgl_grp_id from  t_prog_rgl_grp where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl_grp.prog_rgl_grp_id from 	t_prog_rgl_grp where 	t_prog_rgl_grp.dev__id = 1 and 	t_prog_rgl_grp.client_id = '1' and 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog_...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2147): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(837): Model_Playlist->sel_arr_prog_rgl_grp_by_dev_id(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(811): Controller_Playlist->ins_prog(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(320): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-14 17:15:59 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl_grp.dev__id does not exist
LINE 1: ...l_grp.prog_rgl_grp_id from  t_prog_rgl_grp where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl_grp.prog_rgl_grp_id from 	t_prog_rgl_grp where 	t_prog_rgl_grp.dev__id = 1 and 	t_prog_rgl_grp.client_id = '1' and 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 17:15:59 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl_grp.dev__id does not exist
LINE 1: ...l_grp.prog_rgl_grp_id from  t_prog_rgl_grp where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl_grp.prog_rgl_grp_id from 	t_prog_rgl_grp where 	t_prog_rgl_grp.dev__id = 1 and 	t_prog_rgl_grp.client_id = '1' and 	t_prog_rgl_grp.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_prog_...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(2147): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(837): Model_Playlist->sel_arr_prog_rgl_grp_by_dev_id(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(811): Controller_Playlist->ins_prog(Object(Db_Ins))
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(320): Controller_Playlist->ins()
#5 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#6 [internal function]: Controller_Playlist->action_index()
#7 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#8 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#9 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#10 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#11 {main}
2018-02-14 17:18:27 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl.prog_rgl_grp__id does not exist
LINE 1: ...elect  t_prog_rgl.prog_id from  t_prog_rgl where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl.prog_id from 	t_prog_rgl where 	t_prog_rgl.prog_rgl_grp__id = 2 and 	t_prog_rgl.client_id = '1' and  t_prog_rgl.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 17:18:34 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl.prog_rgl_grp__id does not exist
LINE 1: ...elect  t_prog_rgl.prog_id from  t_prog_rgl where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl.prog_id from 	t_prog_rgl where 	t_prog_rgl.prog_rgl_grp__id = 2 and 	t_prog_rgl.client_id = '1' and  t_prog_rgl.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 17:28:16 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl.prog_rgl_grp__id does not exist
LINE 1: ...elect  t_prog_rgl.prog_id from  t_prog_rgl where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl.prog_id from 	t_prog_rgl where 	t_prog_rgl.prog_rgl_grp__id = 2 and 	t_prog_rgl.client_id = '1' and  t_prog_rgl.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 17:51:55 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column t_prog_rgl.prog_rgl_grp__id does not exist
LINE 1: ...elect  t_prog_rgl.prog_id from  t_prog_rgl where  t_prog_rgl...
                                                             ^ [ select 	t_prog_rgl.prog_id from 	t_prog_rgl where 	t_prog_rgl.prog_rgl_grp__id = 11 and 	t_prog_rgl.client_id = '2' and  t_prog_rgl.del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 17:53:56 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_0000000f" requires 1 [ insert into 	t_prog_rgl_grp( 		prog_rgl_grp_id, 		dev_id, 		client_id, 		prog_name, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		18, 		:dev__id, 		'2', 		'1518598429', 		'user_1', 		'2018/02/14 17:53:56', 		'user_1', 		'2018/02/14 17:53:56' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 18:39:32 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000011" requires 1 [ insert into 	t_prog_rgl_grp( 		prog_rgl_grp_id, 		dev_id, 		client_id, 		prog_name, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		19, 		:dev__id, 		'2', 		'1518601165', 		'user_1', 		'2018/02/14 18:39:32', 		'user_1', 		'2018/02/14 18:39:32' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-02-14 18:50:17 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 955 ]
2018-02-14 18:50:17 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 955 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-14 18:51:39 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 956 ]
2018-02-14 18:51:39 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 956 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-14 19:03:15 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 956 ]
2018-02-14 19:03:15 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 956 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-14 19:10:24 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 956 ]
2018-02-14 19:10:24 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::ins_prog_neko() ~ MODPATH/playlist/classes/controller/playlist.php [ 956 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-02-14 20:15:33 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/devprog/classes/controller/devprog.php [ 375 ]
2018-02-14 20:15:33 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_STRING ~ MODPATH/devprog/classes/controller/devprog.php [ 375 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}