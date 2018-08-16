<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-05 09:44:39 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 09:44:39 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
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
2018-01-05 10:50:27 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_client.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 10:50:27 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_client.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(712): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 10:50:31 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_client.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 10:50:31 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_client.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(712): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 10:56:08 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 10:56:08 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(713): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 10:56:09 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 10:56:09 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...m_client.client_id,  m_client.client_name  m_booth.booth_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.floor_id, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name 	m_booth.booth_id, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(713): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 11:15:56 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_booth() ~ APPPATH/classes/controller/template.php [ 522 ]
2018-01-05 11:15:56 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_booth() ~ APPPATH/classes/controller/template.php [ 522 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 11:28:11 --- ERROR: ErrorException [ 1 ]: Class 'Model_M_Booth' not found ~ APPPATH/classes/model/util.php [ 427 ]
2018-01-05 11:28:11 --- STRACE: ErrorException [ 1 ]: Class 'Model_M_Booth' not found ~ APPPATH/classes/model/util.php [ 427 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 11:28:18 --- ERROR: ErrorException [ 1 ]: Class 'Model_M_Booth' not found ~ APPPATH/classes/model/util.php [ 427 ]
2018-01-05 11:28:18 --- STRACE: ErrorException [ 1 ]: Class 'Model_M_Booth' not found ~ APPPATH/classes/model/util.php [ 427 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 11:28:20 --- ERROR: ErrorException [ 1 ]: Class 'Model_M_Booth' not found ~ APPPATH/classes/model/util.php [ 427 ]
2018-01-05 11:28:20 --- STRACE: ErrorException [ 1 ]: Class 'Model_M_Booth' not found ~ APPPATH/classes/model/util.php [ 427 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 13:01:59 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_booth.sta_t does not exist
LINE 1: select  m_booth.booth_id,  m_booth.booth_name,  m_booth.sta_...
                                                        ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.sta_t, 	m_booth.end_t, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.client_id = 1 and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_client.client_id, 	m_client.client_name from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 order by 	m_client.client_name, 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 13:01:59 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_booth.sta_t does not exist
LINE 1: select  m_booth.booth_id,  m_booth.booth_name,  m_booth.sta_...
                                                        ^ [ select 	m_booth.booth_id, 	m_booth.booth_name, 	m_booth.sta_t, 	m_booth.end_t, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.booth_id = m_booth.booth_id and 			m_dev.client_id = 1 and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_client.client_id, 	m_client.client_name from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 order by 	m_client.client_name, 	m_booth.booth_name, 	m_booth.booth_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_booth...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(311): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(55): Model_Booth->sel_arr_booth(Object(stdClass))
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 13:04:31 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth_tag" does not exist
LINE 1: select  booth_tag_id,  booth_tag_name from  m_booth_tag wher...
                                                    ^ [ select 	booth_tag_id, 	booth_tag_name from 	m_booth_tag where 	exists( 		select 			1 		from 			t_booth_tag_rela 		join 			m_booth 		on 			t_booth_tag_rela.booth_id = m_booth.booth_id and 			m_booth.booth_id = 1 and 			m_booth.client_id = 1 and 			m_booth.del_flag = 0 		where 			m_booth_tag.booth_tag_id = t_booth_tag_rela.booth_tag_id and 			m_booth_tag.client_id = 1 and 			t_booth_tag_rela.del_flag = 0 	) and 	client_id = 1 and 	del_flag = 0 order by 	booth_tag_name, 	booth_tag_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 13:04:31 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth_tag" does not exist
LINE 1: select  booth_tag_id,  booth_tag_name from  m_booth_tag wher...
                                                    ^ [ select 	booth_tag_id, 	booth_tag_name from 	m_booth_tag where 	exists( 		select 			1 		from 			t_booth_tag_rela 		join 			m_booth 		on 			t_booth_tag_rela.booth_id = m_booth.booth_id and 			m_booth.booth_id = 1 and 			m_booth.client_id = 1 and 			m_booth.del_flag = 0 		where 			m_booth_tag.booth_tag_id = t_booth_tag_rela.booth_tag_id and 			m_booth_tag.client_id = 1 and 			t_booth_tag_rela.del_flag = 0 	) and 	client_id = 1 and 	del_flag = 0 order by 	booth_tag_name, 	booth_tag_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?booth_t...', true, Array)
#1 /var/www/html/simplesig/modules/booth/classes/model/booth.php(365): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(58): Model_Booth->sel_arr_booth_tag_by_booth_id(1)
#3 /var/www/html/simplesig/modules/booth/classes/controller/booth.php(33): Controller_Booth->disp_list()
#4 [internal function]: Controller_Booth->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Booth))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 13:22:40 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_booth_tag() ~ APPPATH/classes/controller/template.php [ 394 ]
2018-01-05 13:22:40 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_booth_tag() ~ APPPATH/classes/controller/template.php [ 394 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 15:27:24 --- ERROR: ErrorException [ 1 ]: Call to undefined method Controller_Template::get_arr_floor() ~ MODPATH/dev/classes/controller/dev.php [ 182 ]
2018-01-05 15:27:24 --- STRACE: ErrorException [ 1 ]: Call to undefined method Controller_Template::get_arr_floor() ~ MODPATH/dev/classes/controller/dev.php [ 182 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 16:24:17 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '=' ~ APPPATH/classes/controller/template.php [ 1009 ]
2018-01-05 16:24:17 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '=' ~ APPPATH/classes/controller/template.php [ 1009 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 17:59:34 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_booth.floor does not exist
LINE 1: ...nt_id,  m_client.client_name,  m_booth.booth_id,  m_booth.fl...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.floor, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 17:59:34 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_booth.floor does not exist
LINE 1: ...nt_id,  m_client.client_name,  m_booth.booth_id,  m_booth.fl...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.floor, 	m_booth.booth_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(713): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:04:50 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:04:50 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:15:38 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:15:38 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:15:43 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:15:43 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:15:57 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:15:57 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:15:59 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:15:59 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:16:46 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:16:46 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:16:54 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:16:54 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:20:24 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:20:24 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(733): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:28:06 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:28:06 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(762): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:28:28 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:28:28 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "."
LINE 1: ...e,  m_booth.booth_id,  m_booth.booth_name  m_floor.floor_id,...
                                                             ^ [ select 	m_dev.dev_id, 	m_dev.serial_no, 	m_dev.sex_id, 	m_dev.dev_name, 	m_dev.ants_version, 	m_dev.invalid_flag, 	m_dev.mail_flag, 	m_dev.service_id, 	m_dev.download_status, 	m_shop.shop_id, 	m_shop.shop_name, 	m_client.client_id, 	m_client.client_name, 	m_booth.booth_id, 	m_booth.booth_name 	m_floor.floor_id, 	m_floor.floor_name from 	m_dev join 	m_shop on 	m_dev.client_id = m_shop.client_id and 	m_dev.shop_id = m_shop.shop_id and 	m_shop.client_id = 1 and 	m_shop.del_flag = 0 join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_booth on 	m_dev.booth_id = m_booth.booth_id and 	m_booth.del_flag = 0 join 	m_floor on 	m_dev.floor_id = m_floor.floor_id and 	m_floor.del_flag = 0 where 	m_dev.client_id = 1 and 	m_dev.del_flag = 0 order by 	m_dev.dev_name, 	m_dev.dev_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_dev.d...', true, Array)
#1 /var/www/html/simplesig/modules/dev/classes/model/dev.php(762): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(68): Model_Dev->sel_arr_dev(Object(stdClass))
#3 /var/www/html/simplesig/modules/dev/classes/controller/dev.php(42): Controller_Dev->disp_list()
#4 [internal function]: Controller_Dev->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Dev))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-05 18:32:55 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
2018-01-05 18:32:55 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 18:44:09 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
2018-01-05 18:44:09 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 18:52:14 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
2018-01-05 18:52:14 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 18:52:18 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
2018-01-05 18:52:18 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 538 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 18:56:23 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 540 ]
2018-01-05 18:56:23 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Util::sel_arr_floor() ~ APPPATH/classes/controller/template.php [ 540 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-05 18:57:45 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:57:52 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 18:57:57 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:01:17 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:01:21 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:01:25 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:10:40 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:10:48 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:10:52 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:10:56 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:10:59 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:12:03 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:14:50 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-05 19:15:17 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...elect  floor_id,  floor_name from  m_floor where  client_id ...
                                                             ^ [ select 	floor_id, 	floor_name from 	m_floor where 	client_id = 1 and 	del_flag = 0 order by 	floor_name, 	floor_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]