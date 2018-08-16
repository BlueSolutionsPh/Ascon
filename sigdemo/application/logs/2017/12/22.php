<?php defined('SYSPATH') or die('No direct script access.'); ?>

2017-12-22 11:10:01 --- ERROR: Database_Exception [ 23505 ]: SQLSTATE[23505]: Unique violation: 7 ERROR:  duplicate key value violates unique constraint "pk_m_dev2"
DETAIL:  Key (dev_id)=(1) already exists. [ insert into 	m_dev( 		dev_id, 		shop_id, 		client_id, 		dev_cat, 		dev_name, 		serial_no, 		note, 		ants_version, 		invalid_flag, 		mail_flag, 		service_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		1, 		'1', 		1, 		0, 		'端末２', 		'00000000', 		'端末２', 		'1', 		'0', 		'0', 		'1', 		'user_1', 		'2017/12/22 11:10:00', 		'user_1', 		'2017/12/22 11:10:00' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 11:56:56 --- ERROR: Database_Exception [ 23505 ]: SQLSTATE[23505]: Unique violation: 7 ERROR:  duplicate key value violates unique constraint "pk_m_dev2"
DETAIL:  Key (dev_id)=(2) already exists. [ insert into 	m_dev( 		dev_id, 		shop_id, 		client_id, 		dev_cat, 		dev_name, 		serial_no, 		note, 		ants_version, 		invalid_flag, 		mail_flag, 		service_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		2, 		'2', 		1, 		0, 		'端末２', 		'22222222', 		'端末２', 		'1', 		'0', 		'0', 		'1', 		'user_1', 		'2017/12/22 11:56:56', 		'user_1', 		'2017/12/22 11:56:56' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 13:06:36 --- ERROR: Database_Exception [ 23503 ]: SQLSTATE[23503]: Foreign key violation: 7 ERROR:  insert or update on table "t_dev_property_rela" violates foreign key constraint "fk_dev_id"
DETAIL:  Key (dev_id)=(3) is not present in table "m_dev_old". [ insert into 	t_dev_property_rela( 		dev_id, 		property_id, 		client_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		3, 		'1', 		1, 		'user_1', 		'2017/12/22 13:06:36', 		'user_1', 		'2017/12/22 13:06:36' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 13:06:58 --- ERROR: Database_Exception [ 23503 ]: SQLSTATE[23503]: Foreign key violation: 7 ERROR:  insert or update on table "t_dev_property_rela" violates foreign key constraint "fk_dev_id"
DETAIL:  Key (dev_id)=(4) is not present in table "m_dev_old". [ insert into 	t_dev_property_rela( 		dev_id, 		property_id, 		client_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		4, 		'1', 		1, 		'user_1', 		'2017/12/22 13:06:58', 		'user_1', 		'2017/12/22 13:06:58' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 13:07:04 --- ERROR: Database_Exception [ 23503 ]: SQLSTATE[23503]: Foreign key violation: 7 ERROR:  insert or update on table "t_dev_property_rela" violates foreign key constraint "fk_dev_id"
DETAIL:  Key (dev_id)=(5) is not present in table "m_dev_old". [ insert into 	t_dev_property_rela( 		dev_id, 		property_id, 		client_id, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		5, 		'1', 		1, 		'user_1', 		'2017/12/22 13:07:04', 		'user_1', 		'2017/12/22 13:07:04' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 15:35:39 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 15:35:39 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(b...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(152): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(44): Model_Booth->sel_cnt_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2017-12-22 17:09:03 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 17:09:03 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(b...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(152): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(44): Model_Booth->sel_cnt_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2017-12-22 17:27:36 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-22 17:27:36 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(b...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(152): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(44): Model_Booth->sel_cnt_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}