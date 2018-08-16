<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-23 13:54:25 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/playlist/views/playlist.ins.clitmpl.template.php [ 29 ]
2018-01-23 13:54:25 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/playlist/views/playlist.ins.clitmpl.template.php [ 29 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-23 13:55:22 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/playlist/views/playlist.ins.clitmpl.template.php [ 29 ]
2018-01-23 13:55:22 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/playlist/views/playlist.ins.clitmpl.template.php [ 29 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-23 13:59:02 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/playlist/views/playlist.ins.template.php [ 32 ]
2018-01-23 13:59:02 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/playlist/views/playlist.ins.template.php [ 32 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-23 17:12:58 --- ERROR: View_Exception [ 0 ]: The requested view commonhead.playlist.ins.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2018-01-23 17:12:58 --- STRACE: View_Exception [ 0 ]: The requested view commonhead.playlist.ins.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/view.php(137): Kohana_View->set_filename('commonhead.play...')
#1 /var/www/html/simplesig/system/classes/kohana/view.php(30): Kohana_View->__construct('commonhead.play...', NULL)
#2 /var/www/html/simplesig/application/classes/controller/template.php(165): Kohana_View::factory('commonhead.play...')
#3 [internal function]: Controller_Template->after()
#4 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#5 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#8 {main}
2018-01-23 17:13:21 --- ERROR: View_Exception [ 0 ]: The requested view commonhead.playlist.ins.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
2018-01-23 17:13:21 --- STRACE: View_Exception [ 0 ]: The requested view commonhead.playlist.ins.seltmpl.template could not be found ~ SYSPATH/classes/kohana/view.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/view.php(137): Kohana_View->set_filename('commonhead.play...')
#1 /var/www/html/simplesig/system/classes/kohana/view.php(30): Kohana_View->__construct('commonhead.play...', NULL)
#2 /var/www/html/simplesig/application/classes/controller/template.php(165): Kohana_View::factory('commonhead.play...')
#3 [internal function]: Controller_Template->after()
#4 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Commonplaylist))
#5 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#6 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#7 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#8 {main}
2018-01-23 19:41:08 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "client_id" violates not-null constraint [ insert into 	t_playlist_movie_rela( 		playlist_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		17,		'32',		NULL,		NULL,		0,		'user_1',		'2018/01/23 19:41:08',		'user_1',		'2018/01/23 19:41:08'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-23 19:41:08 --- ERROR: Database_Exception [ 25P02 ]: SQLSTATE[25P02]: In failed sql transaction: 7 ERROR:  current transaction is aborted, commands ignored until end of transaction block [ insert into 	t_playlist_movie_rela( 		playlist_id, 		movie_id, 		draw_area_id, 		client_id, 		display_order, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		17,		'28',		NULL,		NULL,		1,		'user_1',		'2018/01/23 19:41:08',		'user_1',		'2018/01/23 19:41:08'	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-23 20:10:49 --- ERROR: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
2018-01-23 20:10:49 --- STRACE: View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 339 ]
--
#0 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#1 [internal function]: Controller_Template->after()
#2 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Util))
#3 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#4 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#5 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#6 {main}