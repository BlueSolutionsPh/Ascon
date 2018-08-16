<?php defined('SYSPATH') or die('No direct script access.'); ?>

2017-12-19 17:06:43 --- ERROR: Database_Exception [ 23505 ]: SQLSTATE[23505]: Unique violation: 7 ERROR:  duplicate key value violates unique constraint "pk_m_user"
DETAIL:  Key (user_id)=(2) already exists. [ insert into 	m_user( 		user_id, 		client_id, 		shop_id, 		auth_grp_id, 		login_acnt, 		passwd, 		user_name, 		note, 		admin_flag, 		invalid_flag, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		2, 		'1', 		NULL, 		'3', 		'admin', 		md5('admin'), 		'admin', 		NULL, 		0, 		'0', 		'user_1', 		'2017/12/19 17:06:43', 		'user_1', 		'2017/12/19 17:06:43' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2017-12-19 17:07:15 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_BOOTH was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2017-12-19 17:07:15 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_BOOTH was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2017-12-19 18:26:26 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 18:26:26 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
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
2017-12-19 18:58:12 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/user/views/user.template.php [ 18 ]
2017-12-19 18:58:12 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/user/views/user.template.php [ 18 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2017-12-19 18:59:00 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 18:59:00 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
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
2017-12-19 18:59:11 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 18:59:11 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
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
2017-12-19 18:59:42 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 18:59:42 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
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
2017-12-19 19:00:19 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 19:00:19 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
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
2017-12-19 19:02:30 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 19:02:30 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
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
2017-12-19 19:02:51 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 19:02:51 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
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
2017-12-19 19:31:00 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2017-12-19 19:31:00 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/user/views/user.template.php(17): Kohana_Form::select('user_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(168): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_User))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}