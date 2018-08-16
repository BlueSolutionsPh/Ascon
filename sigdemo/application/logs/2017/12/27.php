<?php defined('SYSPATH') or die('No direct script access.'); ?>

2017-12-27 15:43:51 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = '2' and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-27 15:43:51 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = '2' and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
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