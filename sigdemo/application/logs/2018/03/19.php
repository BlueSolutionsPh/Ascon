<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-03-19 10:10:25 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')', expecting ',' or ';' ~ MODPATH/playlist/views/playlist.up.seltmpl.template.php [ 30 ]
2018-03-19 10:10:25 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')', expecting ',' or ';' ~ MODPATH/playlist/views/playlist.up.seltmpl.template.php [ 30 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-03-19 10:10:56 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ')', expecting ',' or ';' ~ MODPATH/playlist/views/playlist.up.seltmpl.template.php [ 30 ]
2018-03-19 10:10:56 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ')', expecting ',' or ';' ~ MODPATH/playlist/views/playlist.up.seltmpl.template.php [ 30 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-03-19 14:18:17 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 14:18:17 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1190): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(625): Model_Playlist->sel_playlist('')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-03-19 14:19:57 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 14:19:57 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	client_id, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1190): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(625): Model_Playlist->sel_playlist('')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up_seltmpl()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-03-19 18:44:39 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...update_dt  ) values (   54,   '321321',   '11',   '',   '2',...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    sta_time, 	    end_time, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		54, 		'321321', 		'11', 		'', 		'2', 		'0', 		'1', 		'00:00:00', 		'00:00:00', 		'1111', 		'1111', 		'user_32', 		'2018/03/19 18:44:39', 		'user_32', 		'2018/03/19 18:44:39' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 18:45:59 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...user,   update_dt  ) values (   55,   '321321',   '',   '30'...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    sta_time, 	    end_time, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		55, 		'321321', 		'', 		'30', 		'2', 		'0', 		'1', 		'00:00:00', 		'00:00:00', 		'1111', 		'1111', 		'user_32', 		'2018/03/19 18:45:59', 		'user_32', 		'2018/03/19 18:45:59' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 18:49:58 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...  update_dt  ) values (   56,   '1111',   '11',   '',   '1',...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    sta_time, 	    end_time, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		56, 		'1111', 		'11', 		'', 		'1', 		'0', 		0, 		'00:00:00', 		'00:00:00', 		'', 		'', 		'user_32', 		'2018/03/19 18:49:58', 		'user_32', 		'2018/03/19 18:49:58' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:08:21 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:08:21' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:08:21 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	dev_id, 	serial_no, 	sex_id, 	dev_name, 	unit_flag, 	ants_version, 	invalid_flag, 	mail_flag, 	service_id, 	download_status, 	shop_id, 	client_id, 	booth_id, 	floor_id from m_dev where 	booth_id = '59' and 	del_flag = 0 order by 	dev_name, 	dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:08:21 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	dev_id, 	serial_no, 	sex_id, 	dev_name, 	unit_flag, 	ants_version, 	invalid_flag, 	mail_flag, 	service_id, 	download_status, 	shop_id, 	client_id, 	booth_id, 	floor_id from m_dev where 	booth_id = '59' and 	del_flag = 0 order by 	dev_name, 	dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?dev_id,...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(914): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(387): Model_Booth->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(243): Controller_Booth->up()
#4 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#5 [internal function]: Controller_Booth->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-03-19 19:13:44 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:13:44' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:13:44 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	dev_id, 	serial_no, 	sex_id, 	dev_name, 	unit_flag, 	ants_version, 	invalid_flag, 	mail_flag, 	service_id, 	download_status, 	shop_id, 	client_id, 	booth_id, 	floor_id from m_dev where 	booth_id = '59' and 	del_flag = 0 order by 	dev_name, 	dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:13:44 --- STRACE: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ select 	dev_id, 	serial_no, 	sex_id, 	dev_name, 	unit_flag, 	ants_version, 	invalid_flag, 	mail_flag, 	service_id, 	download_status, 	shop_id, 	client_id, 	booth_id, 	floor_id from m_dev where 	booth_id = '59' and 	del_flag = 0 order by 	dev_name, 	dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?dev_id,...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(914): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(387): Model_Booth->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(243): Controller_Booth->up()
#4 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(21): Controller_Booth->disp_up()
#5 [internal function]: Controller_Booth->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-03-19 19:18:24 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:18:24' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:18:43 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:18:43' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:21:07 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ... update_dt  ) values (   60,   '87987',   '11',   '',   '10'...
                                                             ^ [ insert into 	m_booth( 		booth_id, 		booth_name, 		client_id, 		shop_id, 		floor_id, 		sex_id, 		twentyfour_flg, 	    sta_time, 	    end_time, 	    wifissid, 	    wifipass, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		60, 		'87987', 		'11', 		'', 		'10', 		'0', 		0, 		'00:00:00', 		'00:00:00', 		'', 		'', 		'user_32', 		'2018/03/19 19:21:07', 		'user_32', 		'2018/03/19 19:21:07' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:21:28 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...oth_name = '87987',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '87987', 	client_id = '11', 	shop_id = '', 	floor_id = '10', 	sex_id = '0', 	twentyfour_flg = 0, 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '', 	wifipass = '', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:21:28' where 	booth_id = '61' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:23:07 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:23:07' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:23:33 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:23:33' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:26:20 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:26:20' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:28:46 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:28:46' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:29:15 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:29:15' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:29:48 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:29:48' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-03-19 19:31:59 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ..._name = '11112222',  client_id = '11',  shop_id = '',  floor...
                                                             ^ [ update 	m_booth set 	booth_name = '11112222', 	client_id = '11', 	shop_id = '', 	floor_id = '1', 	sex_id = '0', 	twentyfour_flg = '1', 	sta_time = '00:00:00', 	end_time = '00:00:00', 	wifissid = '11223344', 	wifipass = '11223344', 	update_user = 'user_32', 	update_dt = '2018/03/19 19:31:59' where 	booth_id = '59' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]