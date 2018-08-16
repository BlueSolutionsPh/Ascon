<?php defined('SYSPATH') or die('No direct script access.'); ?>

2017-12-21 13:41:57 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-21 13:41:57 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/user/views/user.template.php(17): Kohana_Form::select('user_name', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(168): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_User))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2017-12-21 13:46:45 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_user_name ~ SYSPATH/classes/kohana/view.php [ 171 ]
2017-12-21 13:46:45 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_user_name ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/user/classes/controller/user.php(66): Kohana_View->__get('arr_user_name')
#1 /var/www/html/simplesig/modules/user/classes/controller/user.php(33): Controller_User->disp_list()
#2 [internal function]: Controller_User->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_User))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2017-12-21 14:58:31 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_BOOTH was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2017-12-21 14:58:31 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_BOOTH was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2017-12-21 16:54:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL agreeclient was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2017-12-21 16:54:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL agreeclient was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2017-12-21 17:01:55 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL agreeclient was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2017-12-21 17:01:55 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL agreeclient was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2017-12-21 17:12:02 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:12:02 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:12:14 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:12:14 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:13:20 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:13:20 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:13:23 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:13:23 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:13:26 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:13:26 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:17:26 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:17:26 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:17:30 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:17:30 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:17:37 --- ERROR: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
2017-12-21 17:17:37 --- STRACE: Kohana_Exception [ 0 ]: Attempted to load an invalid or missing module 'booth' at 'MODPATH/booth' ~ SYSPATH/classes/kohana/core.php [ 542 ]
--
#0 /var/www/html/simplesig/application/bootstrap.php(156): Kohana_Core::modules(Array)
#1 /var/www/html/simplesig/index.php(102): require('/var/www/html/s...')
#2 {main}
2017-12-21 17:36:15 --- ERROR: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
LINE 1: ..._id) as cnt from ( select  m_booth.booth_id from  m_booth jo...
                                                             ^ [ select 	count(booth.booth_id) as cnt from ( select 	m_booth.booth_id from 	m_booth join 	m_client on 	m_booth.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_booth.client_id = 1 and	m_booth.del_flag = 0 ) booth  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-21 17:36:15 --- STRACE: Database_Exception [ 42P01 ]: SQLSTATE[42P01]: Undefined table: 7 ERROR:  relation "m_booth" does not exist
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