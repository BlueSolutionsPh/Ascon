<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-18 10:17:58 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/movie/classes/controller/movie.php [ 180 ]
2018-01-18 10:17:58 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected ';' ~ MODPATH/movie/classes/controller/movie.php [ 180 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-18 12:01:32 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
2018-01-18 12:01:32 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-18 12:09:41 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
2018-01-18 12:09:41 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-18 12:10:15 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
2018-01-18 12:10:15 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-18 12:11:25 --- ERROR: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
2018-01-18 12:11:25 --- STRACE: ErrorException [ 1 ]: Call to undefined method Model_Playlist::sel_arr_movie() ~ MODPATH/playlist/classes/controller/playlist.php [ 418 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-18 13:07:41 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-18 13:07:41 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: ""
LINE 1: ...nts_version from  t_playlist where  playlist_id = '' and  de...
                                                             ^ [ select 	draw_tmpl_id, 	image_intvl, 	random_flag, 	playlist_name, 	sex_id, 	deliverymonth_id, 	sta_dt, 	end_dt, 	ants_version from 	t_playlist where 	playlist_id = '' and 	del_flag = 0  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?draw_tm...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(670): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(597): Model_Playlist->sel_playlist('')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(39): Controller_Playlist->disp_up()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-18 17:30:10 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-18 17:30:10 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('movie_id[]', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(174): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-18 17:47:39 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-18 17:47:39 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('movie->movie_id', Object(Database_Result_Cached), NULL, Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(174): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-18 19:02:03 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting ')' ~ MODPATH/playlist/views/playlist.ins.template.php [ 28 ]
2018-01-18 19:02:03 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting ')' ~ MODPATH/playlist/views/playlist.ins.template.php [ 28 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-18 19:02:26 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting ')' ~ MODPATH/playlist/views/playlist.ins.template.php [ 28 ]
2018-01-18 19:02:26 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_CONSTANT_ENCAPSED_STRING, expecting ')' ~ MODPATH/playlist/views/playlist.ins.template.php [ 28 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}