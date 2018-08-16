<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-29 10:49:08 --- ERROR: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
2018-01-29 10:49:08 --- STRACE: ErrorException [ 1 ]: Using $this when not in object context ~ APPPATH/classes/model/util.php [ 443 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-29 15:25:42 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "undefined"
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = 'undefined...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = ' 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = ' 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-29 15:25:42 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "undefined"
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = 'undefined...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = ' 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = ' 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1187): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(394): Model_Playlist->sel_arr_movie_by_playlist_id_draw_area_id_dt('undefined', 10, ' 00:00:00', ' 23:59:59')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-29 15:27:54 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "undefined"
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = 'undefined...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = ' 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = ' 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-29 15:27:54 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "undefined"
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = 'undefined...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = ' 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = ' 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1187): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(398): Model_Playlist->sel_arr_movie_by_playlist_id_draw_area_id_dt('undefined', 10, ' 00:00:00', ' 23:59:59')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-29 15:28:01 --- ERROR: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "undefined"
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = 'undefined...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = ' 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = ' 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-29 15:28:01 --- STRACE: Database_Exception [ 22P02 ]: SQLSTATE[22P02]: Invalid text representation: 7 ERROR:  invalid input syntax for integer: "undefined"
LINE 1: ..._id = 10 and  t_playlist_movie_rela.playlist_id = 'undefined...
                                                             ^ [ select 	playlist_movie.movie_id, 	playlist_movie.movie_name, 	playlist_movie.orig_file_dir, 	playlist_movie.file_name, 	playlist_movie.movie_orig_file_name, 	playlist_movie.movie_orig_file_exte, 	playlist_movie.sound_orig_file_name, 	playlist_movie.sound_orig_file_exte, 	playlist_movie.draw_area_id, 	playlist_movie.display_order from 	( select 	m_movie.movie_id, 	m_movie.movie_name, 	m_movie.orig_file_dir, 	m_movie.file_name, 	m_movie.movie_orig_file_name, 	m_movie.movie_orig_file_exte, 	m_movie.sound_orig_file_name, 	m_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_movie join 	t_playlist_movie_rela on 	m_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_movie.sta_dt = ' 00:00:00' or m_movie.end_dt is null) and 	m_movie.del_flag = 0 union all select 	m_common_movie.movie_id, 	'(共通) ' || m_common_movie.movie_name, 	m_common_movie.orig_file_dir, 	m_common_movie.file_name, 	m_common_movie.movie_orig_file_name, 	m_common_movie.movie_orig_file_exte, 	m_common_movie.sound_orig_file_name, 	m_common_movie.sound_orig_file_exte, 	t_playlist_movie_rela.draw_area_id, 	t_playlist_movie_rela.display_order from 	m_common_movie join 	t_playlist_movie_rela on 	m_common_movie.movie_id = t_playlist_movie_rela.movie_id and 	t_playlist_movie_rela.draw_area_id = 10 and 	t_playlist_movie_rela.playlist_id = 'undefined' and 	t_playlist_movie_rela.del_flag = 0 where 	(m_common_movie.sta_dt = ' 00:00:00' or m_common_movie.end_dt is null) and 	m_common_movie.del_flag = 0 ) as playlist_movie order by 	playlist_movie.display_order  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?playlis...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(1187): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(398): Model_Playlist->sel_arr_movie_by_playlist_id_draw_area_id_dt('undefined', 10, ' 00:00:00', ' 23:59:59')
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(33): Controller_Playlist->disp_ins()
#4 [internal function]: Controller_Playlist->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-29 16:00:40 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_playlist was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-01-29 16:00:40 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_playlist was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2018-01-29 16:01:04 --- ERROR: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_playlist was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
2018-01-29 16:01:04 --- STRACE: HTTP_Exception_404 [ 404 ]: The requested URL MODULE_NAME_playlist was not found on this server. ~ SYSPATH/classes/kohana/request/client/internal.php [ 87 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#1 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#2 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#3 {main}
2018-01-29 16:31:25 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 16:31:25 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:04:45 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:04:45 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:04:50 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:04:50 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:04:59 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:04:59 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:29:14 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:29:14 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:30:32 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:30:32 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:30:59 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:30:59 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:32:48 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_BOOLEAN_AND ~ MODPATH/playlist/classes/model/playlist.php [ 647 ]
2018-01-29 17:32:48 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_BOOLEAN_AND ~ MODPATH/playlist/classes/model/playlist.php [ 647 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-29 17:32:48 --- ERROR: ErrorException [ 4 ]: syntax error, unexpected T_BOOLEAN_AND ~ MODPATH/playlist/classes/model/playlist.php [ 647 ]
2018-01-29 17:32:48 --- STRACE: ErrorException [ 4 ]: syntax error, unexpected T_BOOLEAN_AND ~ MODPATH/playlist/classes/model/playlist.php [ 647 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-29 17:33:13 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:33:13 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:37:30 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:37:30 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:38:18 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...month_id,  t_playlist.sta_dt,  t_playlist.end_dt, from  t_pl...
                                                             ^ [ select 	m_client.client_id, 	m_client.client_name, 	t_playlist.ants_version, 	t_playlist.playlist_id, 	t_playlist.playlist_name, 	t_playlist.sex_id, 	t_playlist.timezone_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, from 	t_playlist join 	m_client on 	t_playlist.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	t_playlist.timezone_id = 1 and 	t_playlist.del_flag = 0 order by 	m_client.client_name, 	t_playlist.playlist_name, 	t_playlist.playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-29 17:38:18 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...month_id,  t_playlist.sta_dt,  t_playlist.end_dt, from  t_pl...
                                                             ^ [ select 	m_client.client_id, 	m_client.client_name, 	t_playlist.ants_version, 	t_playlist.playlist_id, 	t_playlist.playlist_name, 	t_playlist.sex_id, 	t_playlist.timezone_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, from 	t_playlist join 	m_client on 	t_playlist.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	t_playlist.timezone_id = 1 and 	t_playlist.del_flag = 0 order by 	m_client.client_name, 	t_playlist.playlist_name, 	t_playlist.playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?m_clien...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(655): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(490): Model_Playlist->sel_arr_id_name_playlist(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:39:52 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "where"
LINE 1: ...month_id,  t_playlist.sta_dt,  t_playlist.end_dt, where  t_p...
                                                             ^ [ select 	t_playlist.client_id, 	t_playlist.ants_version, 	t_playlist.playlist_id, 	t_playlist.playlist_name, 	t_playlist.sex_id, 	t_playlist.timezone_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, where 	t_playlist.timezone_id = 1 and 	t_playlist.del_flag = 0 order by 	t_playlist.client_name, 	t_playlist.playlist_name, 	t_playlist.playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-29 17:39:52 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "where"
LINE 1: ...month_id,  t_playlist.sta_dt,  t_playlist.end_dt, where  t_p...
                                                             ^ [ select 	t_playlist.client_id, 	t_playlist.ants_version, 	t_playlist.playlist_id, 	t_playlist.playlist_name, 	t_playlist.sex_id, 	t_playlist.timezone_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, where 	t_playlist.timezone_id = 1 and 	t_playlist.del_flag = 0 order by 	t_playlist.client_name, 	t_playlist.playlist_name, 	t_playlist.playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(645): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(490): Model_Playlist->sel_arr_id_name_playlist(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:40:35 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...month_id,  t_playlist.sta_dt,  t_playlist.end_dt, from  t_pl...
                                                             ^ [ select 	t_playlist.client_id, 	t_playlist.ants_version, 	t_playlist.playlist_id, 	t_playlist.playlist_name, 	t_playlist.sex_id, 	t_playlist.timezone_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, from 	t_playlist where 	t_playlist.timezone_id = 1 and 	t_playlist.del_flag = 0 order by 	t_playlist.client_id, 	t_playlist.playlist_name, 	t_playlist.playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-29 17:40:35 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...month_id,  t_playlist.sta_dt,  t_playlist.end_dt, from  t_pl...
                                                             ^ [ select 	t_playlist.client_id, 	t_playlist.ants_version, 	t_playlist.playlist_id, 	t_playlist.playlist_name, 	t_playlist.sex_id, 	t_playlist.timezone_id, 	t_playlist.deliverymonth_id, 	t_playlist.sta_dt, 	t_playlist.end_dt, from 	t_playlist where 	t_playlist.timezone_id = 1 and 	t_playlist.del_flag = 0 order by 	t_playlist.client_id, 	t_playlist.playlist_name, 	t_playlist.playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?t_playl...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(647): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(490): Model_Playlist->sel_arr_id_name_playlist(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:41:05 --- ERROR: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...timezone_id,  deliverymonth_id,  sta_dt,  end_dt, from  t_pl...
                                                             ^ [ select 	client_id, 	ants_version, 	playlist_id, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, from 	t_playlist where 	timezone_id = 1 and 	del_flag = 0 order by 	client_id, 	playlist_name, 	playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-29 17:41:05 --- STRACE: Database_Exception [ 42601 ]: SQLSTATE[42601]: Syntax error: 7 ERROR:  syntax error at or near "from"
LINE 1: ...timezone_id,  deliverymonth_id,  sta_dt,  end_dt, from  t_pl...
                                                             ^ [ select 	client_id, 	ants_version, 	playlist_id, 	playlist_name, 	sex_id, 	timezone_id, 	deliverymonth_id, 	sta_dt, 	end_dt, from 	t_playlist where 	timezone_id = 1 and 	del_flag = 0 order by 	client_id, 	playlist_name, 	playlist_id desc  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?client_...', true, Array)
#1 /var/www/html/simplesig/modules/playlist/classes/model/playlist.php(647): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(490): Model_Playlist->sel_arr_id_name_playlist(Object(stdClass))
#3 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(217): Controller_Playlist->disp_ins()
#4 /var/www/html/simplesig/modules/playlist/classes/controller/playlist.php(27): Controller_Playlist->disp_ins_seltmpl()
#5 [internal function]: Controller_Playlist->action_index()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:42:33 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:42:33 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:46:16 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:46:16 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:46:43 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:46:43 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-29 17:53:28 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-29 17:53:28 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/playlist/views/playlist.ins.template.php(44): Kohana_Form::select('playlist_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(176): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Playlist))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}