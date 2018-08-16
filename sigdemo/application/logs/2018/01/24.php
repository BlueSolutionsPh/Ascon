<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-24 10:28:51 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_shop.post does not exist
LINE 1: ... m_shop.shop_name,  m_shop.sta_t,  m_shop.end_t,  m_shop.pos...
                                                             ^ [ select 	m_shop.shop_id, 	m_shop.shop_name, 	m_shop.sta_t, 	m_shop.end_t, 	m_shop.post, 	m_shop.address, 	m_shop.lat, 	m_shop.lon, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.shop_id = m_shop.shop_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_client.client_id, 	m_client.client_name from 	m_shop join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_shop.del_flag = 0 order by 	m_client.client_name, 	m_shop.shop_name, 	m_shop.shop_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-24 10:28:51 --- STRACE: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column m_shop.post does not exist
LINE 1: ... m_shop.shop_name,  m_shop.sta_t,  m_shop.end_t,  m_shop.pos...
                                                             ^ [ select 	m_shop.shop_id, 	m_shop.shop_name, 	m_shop.sta_t, 	m_shop.end_t, 	m_shop.post, 	m_shop.address, 	m_shop.lat, 	m_shop.lon, 	m_client.client_name, 	( 		select 			count(dev_id) 		from 			m_dev 		where 			m_dev.shop_id = m_shop.shop_id and 			m_dev.del_flag = 0 	) as dev_cnt, 	m_client.client_id, 	m_client.client_name from 	m_shop join 	m_client on 	m_shop.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_shop.del_flag = 0 order by 	m_client.client_name, 	m_shop.shop_name, 	m_shop.shop_id desc limit 100 offset 0 ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_shop....', true, Array)
#1 /var/www/html/simplesig/modules/shop/classes/model/shop.php(315): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/shop/classes/controller/shop.php(66): Model_Shop->sel_arr_shop(Object(stdClass))
#3 /var/www/html/simplesig/modules/shop/classes/controller/shop.php(33): Controller_Shop->disp_list()
#4 [internal function]: Controller_Shop->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Shop))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-24 10:44:09 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2018-01-24 10:44:09 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#1 {main}
2018-01-24 10:44:09 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2018-01-24 10:44:09 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#1 {main}
2018-01-24 10:44:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2018-01-24 10:44:36 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#1 {main}
2018-01-24 10:44:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2018-01-24 10:44:36 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#1 {main}
2018-01-24 10:56:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2018-01-24 10:56:36 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#1 {main}
2018-01-24 10:56:36 --- ERROR: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
2018-01-24 10:56:36 --- STRACE: HTTP_Exception_404 [ 404 ]: Unable to find a route to match the URI: css/shop.css ~ SYSPATH/classes/kohana/request.php [ 1126 ]
--
#0 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#1 {main}
2018-01-24 10:59:49 --- ERROR: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
2018-01-24 10:59:49 --- STRACE: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
--
#0 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#1 [internal function]: Controller_Template->after()
#2 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Util))
#3 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#6 {main}
2018-01-24 11:08:19 --- ERROR: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
2018-01-24 11:08:19 --- STRACE: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
--
#0 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#1 [internal function]: Controller_Template->after()
#2 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Util))
#3 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#6 {main}
2018-01-24 11:08:41 --- ERROR: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
2018-01-24 11:08:41 --- STRACE: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
--
#0 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#1 [internal function]: Controller_Template->after()
#2 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Util))
#3 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#6 {main}
2018-01-24 11:18:53 --- ERROR: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
2018-01-24 11:18:53 --- STRACE: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
--
#0 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#1 [internal function]: Controller_Template->after()
#2 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Util))
#3 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#6 {main}
2018-01-24 11:20:37 --- ERROR: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
2018-01-24 11:20:37 --- STRACE: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
--
#0 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#1 [internal function]: Controller_Template->after()
#2 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Util))
#3 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#6 {main}
2018-01-24 11:22:41 --- ERROR: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
2018-01-24 11:22:41 --- STRACE: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
--
#0 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#1 [internal function]: Controller_Template->after()
#2 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Util))
#3 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#6 {main}
2018-01-24 13:24:55 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
2018-01-24 13:24:55 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 13:29:50 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
2018-01-24 13:29:50 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 13:30:13 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
2018-01-24 13:30:13 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 13:40:05 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/commonplaylist/views/commonplaylist.ins.template.php [ 29 ]
2018-01-24 13:40:05 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/commonplaylist/views/commonplaylist.ins.template.php [ 29 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 13:46:50 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 13:46:50 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 13:58:23 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 13:58:23 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 13:59:40 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 13:59:40 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 14:19:22 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 14:19:22 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 14:38:12 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 14:38:12 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 14:40:07 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 14:40:07 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 14:40:43 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
2018-01-24 14:40:43 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 15:50:03 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "draw_tmpl_id" violates not-null constraint [ insert into 	t_playlist( 		playlist_id, 		draw_tmpl_id, 		client_id, 		playlist_name, 		playlist_desc, 		image_intvl, 		random_flag, 		ants_version, 		sex_id, 		timezone_id, 		deliverymonth_id, 		sta_dt, 		end_dt, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		19, 		NULL, 		1, 		'プレイリストテスト0117_01', 		NULL, 		0, 		0, 		NULL, 		'1', 		'4', 		'0', 		'2018-01-03', 		'2018-01-30', 		'user_1', 		'2018/01/24 15:50:03', 		'user_1', 		'2018/01/24 15:50:03' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-24 16:04:51 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 16:04:51 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 16:06:06 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
2018-01-24 16:06:06 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 16:18:28 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 16:18:28 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 16:18:39 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 16:18:39 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 16:20:40 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 16:20:40 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 16:20:50 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
2018-01-24 16:20:50 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 353 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 16:36:02 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_PRIVATE ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 444 ]
2018-01-24 16:36:02 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_PRIVATE ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 444 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 16:36:09 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_PRIVATE ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 444 ]
2018-01-24 16:36:09 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_PRIVATE ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 444 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 18:22:05 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 373 ]
2018-01-24 18:22:05 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_VARIABLE ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 373 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 18:52:02 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 18:52:02 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(75): Kohana_Form::select('tmp_arr_movie[]', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 18:52:24 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 18:52:24 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(75): Kohana_Form::select('tmp_arr_movie[]', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 18:53:19 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 18:53:19 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(75): Kohana_Form::select('tmp_arr_movie[]', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 18:53:44 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 18:53:44 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(75): Kohana_Form::select('tmp_arr_movie[]', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 18:56:35 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 18:56:35 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(75): Kohana_Form::select('tmp_arr_movie[]', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 19:17:00 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting ')' ~ MODPATH/commonplaylist/views/commonplaylist.ins.template.php [ 54 ]
2018-01-24 19:17:00 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting ')' ~ MODPATH/commonplaylist/views/commonplaylist.ins.template.php [ 54 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 19:41:29 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 374 ]
2018-01-24 19:41:29 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected '=' ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 374 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 19:55:15 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 361 ]
2018-01-24 19:55:15 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 361 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 19:55:30 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 361 ]
2018-01-24 19:55:30 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 361 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 19:55:49 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 361 ]
2018-01-24 19:55:49 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_FOREACH ~ MODPATH/commonplaylist/classes/controller/commonplaylist.php [ 361 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-24 20:22:37 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:22:37 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:22:42 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:22:42 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:23:15 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:23:15 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:23:40 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:23:40 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:28:08 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:28:08 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:28:25 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:28:25 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:29:36 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:29:36 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:31:39 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:31:39 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:33:27 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:33:27 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:34:57 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:34:57 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:35:29 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:35:29 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:37:10 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:37:10 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:40:42 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:40:42 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:41:37 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:41:37 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-24 20:41:57 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-24 20:41:57 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/commonplaylist/views/commonplaylist.ins.template.php(66): Kohana_Form::select('arr_search_movi...', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}