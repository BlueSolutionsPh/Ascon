<?php defined('SYSPATH') or die('No direct script access.'); ?>

2018-01-12 10:08:42 --- ERROR: Database_Exception [ 23502 ]: SQLSTATE[23502]: Not null violation: 7 ERROR:  null value in column "client_id" violates not-null constraint [ insert into 	m_movie_tag( 		movie_tag_name, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		'動画タグ3', 		'user_1', 		'2018/01/12 10:08:41', 		'user_1', 		'2018/01/12 10:08:41' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-12 11:11:31 --- ERROR: ErrorException [ 1 ]: Call to undefined method Controller_Template::get_arr_ad() ~ MODPATH/movie/classes/controller/movie.php [ 93 ]
2018-01-12 11:11:31 --- STRACE: ErrorException [ 1 ]: Call to undefined method Controller_Template::get_arr_ad() ~ MODPATH/movie/classes/controller/movie.php [ 93 ]
--
#0 [internal function]: Kohana_Core::shutdown_handler()
#1 {main}
2018-01-12 11:19:21 --- ERROR: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
2018-01-12 11:19:21 --- STRACE: Kohana_Exception [ 0 ]: Database results are read-only ~ MODPATH/database/classes/kohana/database/result.php [ 252 ]
--
#0 /var/www/html/simplesig/system/classes/kohana/form.php(332): Kohana_Database_Result->offsetSet('0', '<option value="...')
#1 /var/www/html/simplesig/modules/movie/views/movie.template.php(19): Kohana_Form::select('movie_id', Object(Database_Result_Cached), '', Array)
#2 /var/www/html/simplesig/system/classes/kohana/view.php(61): include('/var/www/html/s...')
#3 /var/www/html/simplesig/system/classes/kohana/view.php(343): Kohana_View::capture('/var/www/html/s...', Array)
#4 /var/www/html/simplesig/application/classes/controller/template.php(173): Kohana_View->render()
#5 [internal function]: Controller_Template->after()
#6 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(121): ReflectionMethod->invoke(Object(Controller_Movie))
#7 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#8 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#9 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#10 {main}
2018-01-12 11:28:46 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: arr_all_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
2018-01-12 11:28:46 --- STRACE: Kohana_Exception [ 0 ]: View variable is not set: arr_all_movie ~ SYSPATH/classes/kohana/view.php [ 171 ]
--
#0 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(63): Kohana_View->__get('arr_all_movie')
#1 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(39): Controller_Movie->disp_list()
#2 [internal function]: Controller_Movie->action_index()
#3 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Movie))
#4 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#5 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#6 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#7 {main}
2018-01-12 16:33:02 --- ERROR: Database_Exception [ 42703 ]: SQLSTATE[42703]: Undefined column: 7 ERROR:  column "client_id" does not exist
LINE 1: ...eate_dt,   update_user,   update_dt  ) values (   client_id,...
                                                             ^ [ insert into 	m_movie_tag( 		client_id, 		movie_tag_name, 		create_user, 		create_dt, 		update_user, 		update_dt 	) values ( 		client_id, 		'動画タグ7', 		'user_1', 		'2018/01/12 16:33:02', 		'user_1', 		'2018/01/12 16:33:02' 	)  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-12 18:15:44 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_image on 	m_movie.image_id = m_image.image_id and 	m_image.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-12 18:15:44 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 join 	m_image on 	m_movie.image_id = m_image.image_id and 	m_image.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(m...', true, Array)
#1 /var/www/html/simplesig/modules/movie/classes/model/movie.php(212): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(50): Model_Movie->sel_cnt_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(39): Controller_Movie->disp_list()
#4 [internal function]: Controller_Movie->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Movie))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-12 18:17:07 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-12 18:17:07 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(m...', true, Array)
#1 /var/www/html/simplesig/modules/movie/classes/model/movie.php(212): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(50): Model_Movie->sel_cnt_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(39): Controller_Movie->disp_list()
#4 [internal function]: Controller_Movie->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Movie))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-12 18:20:50 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-12 18:20:50 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(m...', true, Array)
#1 /var/www/html/simplesig/modules/movie/classes/model/movie.php(212): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(50): Model_Movie->sel_cnt_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(39): Controller_Movie->disp_list()
#4 [internal function]: Controller_Movie->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Movie))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-12 18:22:48 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-12 18:22:48 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(m...', true, Array)
#1 /var/www/html/simplesig/modules/movie/classes/model/movie.php(214): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(50): Model_Movie->sel_cnt_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(39): Controller_Movie->disp_list()
#4 [internal function]: Controller_Movie->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Movie))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}
2018-01-12 18:22:56 --- ERROR: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
2018-01-12 18:22:56 --- STRACE: Database_Exception [ 08P01 ]: SQLSTATE[08P01]: : 7 ERROR:  bind message supplies 0 parameters, but prepared statement "pdo_stmt_00000001" requires 2 [ select 	count(movie.movie_id) as cnt from ( select 	m_movie.movie_id from 	m_movie join 	m_client on 	m_movie.client_id = m_client.client_id and 	m_client.del_flag = 0 where 	m_movie.sta_dt  :sta_dt or m_movie.end_dt is null) and 	m_movie.del_flag = 0 ) movie  ] ~ MODPATH/database/classes/kohana/database/pdo.php [ 157 ]
--
#0 /var/www/html/simplesig/modules/database/classes/kohana/database/query.php(245): Kohana_Database_PDO->query(1, 'select ?count(m...', true, Array)
#1 /var/www/html/simplesig/modules/movie/classes/model/movie.php(214): Kohana_Database_Query->execute(Object(Database_PDO), true)
#2 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(50): Model_Movie->sel_cnt_movie(Object(stdClass))
#3 /var/www/html/simplesig/modules/movie/classes/controller/movie.php(39): Controller_Movie->disp_list()
#4 [internal function]: Controller_Movie->action_index()
#5 /var/www/html/simplesig/system/classes/kohana/request/client/internal.php(118): ReflectionMethod->invoke(Object(Controller_Movie))
#6 /var/www/html/simplesig/system/classes/kohana/request/client.php(64): Kohana_Request_Client_Internal->execute_request(Object(Request))
#7 /var/www/html/simplesig/system/classes/kohana/request.php(1138): Kohana_Request_Client->execute(Object(Request))
#8 /var/www/html/simplesig/index.php(109): Kohana_Request->execute()
#9 {main}