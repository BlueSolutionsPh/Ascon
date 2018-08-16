<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-10 14:52:58 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "offset"
LINE 1: ...ooth_name,  m_booth.booth_id desc limit 100 offset 0offset 0
                                                               ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.shop_id, 	m_booth.sex_id, 	m_booth.twentyfour_flg, 	m_booth.sta_time, 	m_booth.end_time, 	m_booth.wifissid, 	m_booth.wifipass, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_floor.floor_id, 	m_floor.floor_name from 	m_booth join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_booth.del_flag = 0 order by 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-10 14:52:58 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "offset"
LINE 1: ...ooth_name,  m_booth.booth_id desc limit 100 offset 0offset 0
                                                               ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.shop_id, 	m_booth.sex_id, 	m_booth.twentyfour_flg, 	m_booth.sta_time, 	m_booth.end_time, 	m_booth.wifissid, 	m_booth.wifipass, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_floor.floor_id, 	m_floor.floor_name from 	m_booth join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_booth.del_flag = 0 order by 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_booth...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(371): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(55): Model_Booth->sel_arr_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-10 14:53:04 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/classes/model/m/booth.php [ 99 ]
2018-01-10 14:53:04 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/classes/model/m/booth.php [ 99 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-10 14:53:25 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/classes/model/m/booth.php [ 99 ]
2018-01-10 14:53:25 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ APPPATH/classes/model/m/booth.php [ 99 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-10 14:59:30 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_client"
LINE 1: ...th.wifipass,  m_shop.shop_id,  m_shop.shop_name,  m_client.c...
                                                             ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.sex_id, 	m_booth.twentyfour_flg, 	m_booth.sta_time, 	m_booth.end_time, 	m_booth.wifissid, 	m_booth.wifipass, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_floor.floor_id, 	m_floor.floor_name from 	m_booth join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_booth.del_flag = 0 order by 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-10 14:59:30 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_client"
LINE 1: ...th.wifipass,  m_shop.shop_id,  m_shop.shop_name,  m_client.c...
                                                             ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.sex_id, 	m_booth.twentyfour_flg, 	m_booth.sta_time, 	m_booth.end_time, 	m_booth.wifissid, 	m_booth.wifipass, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_floor.floor_id, 	m_floor.floor_name from 	m_booth join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_booth.del_flag = 0 order by 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_booth...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(368): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(55): Model_Booth->sel_arr_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-10 15:00:40 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_client"
LINE 1: ...th.wifipass,  m_shop.shop_id,  m_shop.shop_name,  m_client.c...
                                                             ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.sex_id, 	m_booth.twentyfour_flg, 	m_booth.sta_time, 	m_booth.end_time, 	m_booth.wifissid, 	m_booth.wifipass, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_floor.floor_id, 	m_floor.floor_name from 	m_booth join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_booth.del_flag = 0 order by 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-10 15:00:40 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_client"
LINE 1: ...th.wifipass,  m_shop.shop_id,  m_shop.shop_name,  m_client.c...
                                                             ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.sex_id, 	m_booth.twentyfour_flg, 	m_booth.sta_time, 	m_booth.end_time, 	m_booth.wifissid, 	m_booth.wifipass, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_floor.floor_id, 	m_floor.floor_name from 	m_booth join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_booth.del_flag = 0 order by 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_booth...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(368): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(55): Model_Booth->sel_arr_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-10 19:35:11 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_dev"
LINE 1: ...m_floor.floor_id and  m_floor.del_flag = 0 where  m_dev.shop...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.shop_id = '3' and 	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-10 19:35:11 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_dev"
LINE 1: ...m_floor.floor_id and  m_floor.del_flag = 0 where  m_dev.shop...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.shop_id = '3' and 	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(b...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(210): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(44): Model_Booth->sel_cnt_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-10 19:36:12 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_dev"
LINE 1: ...m_floor.floor_id and  m_floor.del_flag = 0 where  m_dev.floo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.floor_id = '1' and 	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-10 19:36:12 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  missing FROM-clause entry for table "m_dev"
LINE 1: ...m_floor.floor_id and  m_floor.del_flag = 0 where  m_dev.floo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_shop on 	m_booth.client_id = m_shop.client_id and 	m_booth.shop_id = m_shop.shop_id and 	m_shop.del_flag = 0 join 	m_floor on 	m_booth.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.floor_id = '1' and 	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(b...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(210): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(44): Model_Booth->sel_cnt_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}